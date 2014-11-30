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
  private static $OPTIONAL_CREATE_PARAMS = array("link", "link_facebook");

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

    if($validParamsNeeded === $validParamsProvided){
      $now = time();

      $stmt = $db->prepare("INSERT INTO events (title, description, start_time, end_time, created_time) VALUE (:title, :description, :start_time, :end_time, :created_time)");
      $stmt->bindValue(":title", $params["title"], $db::PARAM_STR);
      $stmt->bindValue(":description", $params["description"], $db::PARAM_STR);
      $stmt->bindValue(":start_time", $params["startTime"], $db::PARAM_INT);
      $stmt->bindValue(":end_time", $params["endTime"], $db::PARAM_INT);
      $stmt->bindValue(":created_time", $now, $db::PARAM_INT);

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
  public function update($params = array()){
//    $db = $this->db;
//    $response = array();
//    $body = array();
//    $status = 0;
//
//    $validParamsNeeded = count(self::$REQUIRED_UPDATE_PARAMS);
//    $validParamsProvided = 0;
//    $invalidParamError = "";
//
//    for($i = 0, $l = $validParamsNeeded; $i < $l; $i++){
//      $param = self::$REQUIRED_UPDATE_PARAMS[$i];
//
//      if(!isset($params[$param])){
//        $invalidParamError .= "There is an error.  Expected " . $param . " param";
//        break;
//      }else{
//        $validParamsProvided++;
//      }
//    };
//
//    if($validParamsNeeded === $validParamsProvided){
//      $stmt = $db->prepare("UPDATE orders SET buyer_name=:buyerName, completed_time=:completedTime, status=:status WHERE token=:token");
//      $stmt->bindValue(":buyerName", $params["buyerName"], $db::PARAM_STR);
//      $stmt->bindValue(":completedTime", time(), $db::PARAM_INT);
//      $stmt->bindValue(":status", $params["status"], $db::PARAM_STR);
//      $stmt->bindValue(":token", $params["token"], $db::PARAM_STR);
//
//      $stmt->execute();
//
//      if($stmt->rowCount() === 1){
//        $status = 200;
//        $body = array(
//          "url" => '/api/order/' . $db->lastInsertId(),
//          "id" => $db->lastInsertId()
//        );
//      }else{
//        $status = 500;
//        $body = $stmt->errorInfo();
//      }
//    }else{
//      $status = 400;
//      $body["message"] = $invalidParamError;
//    }
//
//    //construct response
//    $response["status"] = $status;
//    $response["body"] = $body;
//
//    return $response;
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