<?php

namespace resources;

use base as base;


 /**
  *
  * @author Owen Buckley
  * @email owen@analogstudios.net
  * @api as-api
  * @package resources
  * @uses base base
  * @class EventsResource
  *
  * @since 0.3.0
  *
  * @copyright 2014
  *
  */
class EventsResource extends base\AbstractRestfulResource{
  private $name = "event";
  private $tableName = "events";
  private $requiredParams = array("title", "description", "startTime", "endTime", "createdTime");
  private $updateParams = array("title", "description", "startTime", "endTime");

  private function modelDatabaseResult ($data){
    $model = array();

    for($i = 0, $l = count($data); $i < $l; $i++){
      $d = $data[$i];
      $model[$i] = $d;

      $data[$i]["startTime"] = (int) $d["startTime"];
      $data[$i]["endTime"] = (int) $d["endTime"];
      $data[$i]["createdTime"] = (int) $d["createdTime"];
    }
    return $model;
  }

  //abstract getters
  public function getName(){
    return $this->name;
  }

  public function getTableName(){
    return $this->tableName;
  }

  public function getRequiredCreateParams(){
    return $this->requiredParams;
  }

  public function getAllowedUpdateParams(){
    return $this->updateParams;
  }

  //resource level methods
  public function getEvents(){
    $result = $this->db->select($this->tableName);
    $result["data"] = $this->modelDatabaseResult($result["data"]);

    return $result;
  }

  public function getEventById($id = null){
    $result = $this->db->select($this->tableName, $id);
    $result["data"] = $this->modelDatabaseResult($result["data"]);

    return $result;
  }

  public function createEvent($params = array()){
    $params["createdTime"] = time();
    $result = $this->db->insert($this->tableName, $this->getRequiredCreateParams(), $params);

    return $result;
  }

  public function updateEvent($id = null, $params = array()){
    $result = $this->db->update($this->tableName, $id, $this->getAllowedUpdateParams(), $params);

    return $result;
  }

  public function deleteEvent($id = null){
    $result = $this->db->delete($this->tableName, $id);

    return $result;
  }
}
