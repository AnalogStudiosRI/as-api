<?php

namespace net\analogstudios\controllers;

require_once "ControllerInterface.php";

date_default_timezone_set("America/New_York");

/**
 * name: EventsController
 * namespace: net\analogstudios\controllers
 *
 * @author Owen Buckley
 */
class EventsController implements ControllerInterface{

  private $db;
  private static $ID_PATTERN = "/^[0-9]+$/";
  private static $REQUIRED_CREATE_PARAMS = array("title", "description", "startTime", "endTime");
  //private static $OPTIONAL_CREATE_PARAMS = array("link", "link_facebook");

  /**
   * Constructor
   */
  function __construct($pdo) {
    $this->db = $pdo;
  }

  /**
   *
   * EventsController->get($eventId)
   *
   * @return array $response;
   */
  public function get($eventId = null, $filters = array()) {
    $db = $this->db;
    $validEventId = preg_match(self::$ID_PATTERN, $eventId) === 1 ? TRUE : FALSE;
    $sql = "SELECT * FROM events";
    $response = array();
    $body = array();
    $status = 0;

    if($validEventId){
      $sql .=  " WHERE id=:id";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(":id", $eventId, $db::PARAM_INT);
    }else{
      $stmt = $db->prepare($sql);
    }

    $stmt->execute();
    $result = $stmt->fetchAll($db::FETCH_ASSOC);

    //check by Id
    if($eventId){
      if(!$validEventId){
        $status = 400;
        $body["message"] = "Bad Request";
      }else if($validEventId && !$result) {
        $status = 404;
        $body["message"] = "Not Found";
      }else if($validEventId && $result){
        $status = 200;
        $body = $result;
      }
    }else if($result){
      $status = 200;
      $body = $result;
    }

    //construct response
    $response["status"] = $status;
    $response["body"] = $body;

    return $response;
  }

  /**
   *
   * EventsController->create()
   *
   * @return array $response;
   */
  public function create($params = array()) {
    $db = $this->db;
    $response = array();
    $body = array();
    $status = 0;

    $validParamsNeeded = count(self::$REQUIRED_CREATE_PARAMS);
    $validParamsProvided = 0;
    $invalidParamError = "";

    for($i = 0, $l = $validParamsNeeded; $i < $l; $i++){
      $param = self::$REQUIRED_CREATE_PARAMS[$i];

      if(!isset($params[$param])){
        $invalidParamError .= "There is an error.  Expected " . $param . " param";
        break;
      }else{
        $validParamsProvided++;
      }
    };

    if($validParamsNeeded === $validParamsProvided && $invalidParamError === ""){
      $now = time();

      $stmt = $db->prepare("INSERT INTO events (title, description, startTime, endTime, createdTime) VALUE (:title, :description, :startTime, :endTime, :createdTime)");
      $stmt->bindValue(":title", $params["title"], $db::PARAM_STR);
      $stmt->bindValue(":description", $params["description"], $db::PARAM_STR);
      $stmt->bindValue(":startTime", $params["startTime"], $db::PARAM_INT);
      $stmt->bindValue(":endTime", $params["endTime"], $db::PARAM_INT);
      $stmt->bindValue(":createdTime", $now, $db::PARAM_INT);

      $stmt->execute();

      //var_dump($stmt->errorInfo());
      if($stmt->rowCount() === 1){
        $status = 201;
        $body = array(
          "url" => '/api/events/' . $db->lastInsertId(),
          "id" => $db->lastInsertId(),
          "createdTime" => $now
        );
      }else{
        $status = 500;
        $body = "Database error.";
      }
    }else{
      $status = 400;
      $body["message"] = $invalidParamError;
    }

    //construct response
    $response["status"] = $status;
    $response["body"] = $body;

    return $response;
  }

  /**
   *
   * EventsController->update($params)
   *
   * @return array $response;
   */
  public function update($eventId = null, $params = array()){
    $db = $this->db;
    $response = array();
    $body = array();
    $status = 0;

    if(preg_match(self::$ID_PATTERN, $eventId) && count($params) > 0) {
      $query = 'UPDATE events SET ';
      $queryParams = array();

      foreach ($params as $key => $value) {
        if (in_array($key, self::$REQUIRED_CREATE_PARAMS)) {
          $query .= $key . "=:" . $key . ",";
          $queryParams[':' . $key] = $value;
        }
      };

      if(count($queryParams) > 0) {
        $query = rtrim($query, ",");
        $query .= " WHERE id=:eventId";
        $queryParams[':eventId'] = $eventId;

        var_dump($query);
        var_dump($queryParams);

        $stmt = $db->prepare($query);
        $stmt->execute($queryParams);

        if ($stmt->rowCount() === 1) {
          $status = 200;
          $body = array(
            "url" => '/api/events/' . $eventId,
            "id" => $eventId
          );
        } else if ($stmt->rowCount() === 0) {
          $status = 404;
          $body["message"] = "Event Not Found";
        } else {
          $status = 500;
          $body["message"] = $stmt->errorInfo();
        }
      }else {
        $status = 400;
        $body["message"] = "Bad Request.  No valid params provided";
      }
    }else{
      $status = 400;
      $missing = !$eventId ? "id" : "params";
      $body["message"] = "Bad Request.  No " . $missing . " provided";
    }

    //construct response
    $response["status"] = $status;
    $response["body"] = $body;

    return $response;
  }

  /**
   *
   * EventsController->delete($id)
   *
   * @return array $response;
   */
  public function delete($id = null){

  }
}

?>