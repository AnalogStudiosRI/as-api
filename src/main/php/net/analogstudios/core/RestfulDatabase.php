<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace net\analogstudios\core;

use net\analogstudios\base as base;

/**
 * Description of RestfulDatabase
 *
 * @author obuckley
 */
class RestfulDatabase extends base\Database{
  private static $PATTERN = array(
    "ID" => "/^[0-9]+$/"
  );

  private static $STATUS_CODE = array(
    "BAD_REQUEST" => 400,
    "CREATED" => 201,
    "ERROR" => 500,
    "NOT_FOUND" => 404,
    "NOT_MODIFIED" => 304,
    "SUCCESS" => 200
  );
  private static $STATUS_MESSAGE = array(
    200 => "Success",
    201 => "Created",
    304 => "Not Modified",
    400 => "Bad Request",
    404 => "Not Found",
    500 => "Internal Service Error"
  );
  
  private function generateResponse ($code = null, $result = array(), $msg = '') {
    $normalizedCode = $code ? $code : 500;
    $normalizedMessage = $msg ? $msg : self::$STATUS_MESSAGE[$normalizedCode];
    return array(
      "status" => $normalizedCode,
      "message" => $normalizedMessage,
      "data" => $result
    );
  }
  
  public function select ($tableName = '', $id = '') {
    $db = $this->db;
    $validEventId = preg_match(self::$PATTERN["ID"], $id) === 1 ? TRUE : FALSE;
    $validTableName = $tableName !== '' ? TRUE : FALSE;
    $sql = "SELECT * FROM " . $tableName;
    $code = null;

    if($validTableName && $validEventId){
      $sql .=  " WHERE id=:id";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(":id", $id, $db::PARAM_INT);
    }else{
      //XXX TODO test for table name
      $stmt = $db->prepare($sql);
    }

    $stmt->execute();
    $result = $stmt->fetchAll($db::FETCH_ASSOC);

    //check by Id
    if($id){
      if(!$validEventId){
        $code = self::$STATUS_CODE["BAD_REQUEST"];
        $result = array();
      }else if($validEventId && !$result) {
        $code = self::$STATUS_CODE["NOT_FOUND"];
      }else if($validEventId && $result){
        $code = self::$STATUS_CODE["SUCCESS"];
      }
    }else if($result){
      $code = self::$STATUS_CODE["SUCCESS"];
    }

    return $this->generateResponse($code, $result);
  }
  
  public function insert ($tableName = '', $requiredParams = array(), $params = array()) {
    $db = $this->db;
    $queryParams = array();
    $query = "INSERT INTO " . $tableName . " ";
    $keys = "(";
    $values = "(";
    $result = array();
    $validParamsNeeded = count($requiredParams);
    $invalidParamError = "";
    $code = null;

    for($i = 0, $l = $validParamsNeeded; $i < $l; $i++){
      $key = $requiredParams[$i];

      if(!isset($params[$key])){
        $invalidParamError .= self::$STATUS_MESSAGE[400] . ".  Expected " . $key . " param";
        break;
      }else{
        $keys .= $key . ",";
        $values .= ":" . $key . ", ";
        $queryParams[':' . $key] = $params[$key];
      }
    };

    if($validParamsNeeded === count($queryParams) && $invalidParamError === ""){
      $query = rtrim($query, ", ");
      $keys = rtrim($keys, ", ");
      $values = trim($values, ", ");      
      $query .= ($keys . ") VALUES " . $values . ") ");
      
      $stmt = $db->prepare($query);
      $stmt->execute($queryParams);

      if($stmt->rowCount() === 1){
        $code = self::$STATUS_CODE["CREATED"];
        $result = array(
          "url" => "/api/" . $tableName . "/" . $db->lastInsertId(),
          "id" => $db->lastInsertId(),
          "createdTime" => time()
        );
      }else{
        $code = self::$STATUS_CODE["ERROR"];
        $invalidParamError = "Unknown Database error.";
      }
    }else{
      $code = self::$STATUS_CODE["BAD_REQUEST"];
    }
    
    return $this->generateResponse($code, $result, $invalidParamError);
  }
  
  public function update ($tableName = '', $id = null, $updateParams = array(), $params = array()) {
    $db = $this->db;
    $invalidParamError = '';
    $result = array();
    $code = null;

    if(preg_match(self::$PATTERN["ID"], $id) && count($params) > 0) {
      $query = 'UPDATE events SET ';
      $queryParams = array();

      foreach ($params as $key => $value) {
        if (in_array($key, $updateParams)) {
          $query .= $key . "=:" . $key . ", ";
          $queryParams[':' . $key] = $value;
        }
      };

      if(count($queryParams) > 0) {
        $query = rtrim($query, ", ");
        $query .= " WHERE id=:id";
        $queryParams[":id"] = $id;
        
        $stmt = $db->prepare($query);
        $stmt->execute($queryParams);

        if ($stmt->rowCount() === 1) {
          $code = self::$STATUS_CODE["SUCCESS"];
          $result = array(
            "url" => "/api/" . $tableName . "/" . $id,
            "id" => $id
          );
        } else if ($stmt->rowCount() === 0) {
          //echo "SELECT * FROM " . $tableName . " WHERE id=:id";
          $stm = $db->prepare("SELECT * FROM " . $tableName . " WHERE id=:id");
          $stm->bindValue(':id', $id, $db::PARAM_INT);
          $stm->execute();

          $found = $stm->fetch($db::FETCH_NUM) > 0;
          $code = $found ? self::$STATUS_CODE["NOT_MODIFIED"] : self::$STATUS_CODE["NOT_FOUND"];
          $invalidParamError = $found ? "Duplicate data, event not modified" : "Event Not Found";
        } else {
          $code = self::$STATUS_CODE["ERROR"];
          $invalidParamError = "Unkown Database Error";
        }
      }else {
        $code = self::$STATUS_CODE["BAD_REQUEST"];
        $invalidParamError = "Bad Request.  No valid params provided";
      }
    }else{
      $code = self::$STATUS_CODE["BAD_REQUEST"];
      $missing = !$id ? "id" : "params";
      $invalidParamError = "Bad Request.  No " . $missing . " provided";
    }

    return $this->generateResponse($code, $result, $invalidParamError);
  }
  
  public function delete ($tableName = '', $id = null) {
    $db = $this->db;
    $result = array();
    $invalidParamError = "";
    $code = null;

    if(preg_match(self::$PATTERN["ID"], $id)) {
      $stmt = $db->prepare("DELETE FROM " . $tableName . " WHERE id=:id");
      $stmt->bindValue(":id", $id, $db::PARAM_INT);
      $stmt->execute();

      if ($stmt->rowCount() === 1) {
        $code = self::$STATUS_CODE["SUCCESS"];
        $invalidParamError = "Event deleted successfully";
      } else if ($stmt->rowCount() === 0) {
        $code = self::$STATUS_CODE["NOT_FOUND"];
        $invalidParamError = "Event not found";
      } else {
        $code = self::$STATUS_CODE["ERROR"];
        $invalidParamError = "Unknown Database Error";
      }
    }else{
      $code = self::$STATUS_CODE["BAD_REQUEST"];
      $invalidParamError = "Bad Request.  No valid event id provided";
    }

    return $this->generateResponse($code, $result, $invalidParamError);
  }
    
}