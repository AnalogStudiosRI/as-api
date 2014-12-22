<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace net\analogstudios\core;

/**
 * Description of Database
 *
 * @author obuckley
 */
class Database {
  private static $PATTERN = array(
    "ID" => "/^[0-9]+$/"
  );
  //private static $DB_TYPES = array();
  private static $STATUS_CODE = array(
    "BAD_REQUEST" => 400,
    "ERROR" => 500,
    "NOT_FOUND" => 404,
    "SUCCESS" => 200
  );
  private static $STATUS_MESSAGE = array(
    200 => "Success",
    400 => "Bad Request",
    404 => "Not Found",
    500 => "Internal Service Error"
  );
  private $db;
  
  function __construct($dbType, $dbConfig){
    switch ($dbType) {
      case 'PDO':
        try {  
          $this->db = new \PDO($dbConfig["dsn"], $dbConfig["username"], $dbConfig["password"]);
        } catch(PDOException $e) {  
          //echo $e->getMessage();  
        }  
        break;
      default:
        //echo 'throw expection';
    }
  }
  
  private function generateResponse ($code, $result){
    return array(
      "status" => $code || 500,
      "message" => self::$STATUS_MESSAGE[$code],
      "data" => $result
    );
  }
  
  public function select ($tableName = '', $id = '') {
    $db = $this->db;
    $validEventId = preg_match(self::$PATTERN["ID"], $id) === 1 ? TRUE : FALSE;
    $validTableName = $tableName !== '' ? true : false;
    $sql = "SELECT * FROM " . $tableName;

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
  
//  public function insert ($table, $params) {
//
//  }
//  
//  public function update ($table, $params) {
//    
//  }
//  
//  public function delete ($table, $ids) {
//  
//  }
    
}