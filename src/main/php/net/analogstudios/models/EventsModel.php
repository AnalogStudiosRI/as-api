<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace net\analogstudios\models;

use \net\analogstudios\core as core;

/**
 * Description of EventsModel
 *
 * @author obuckley
 */
class EventsModel {
  private static $TABLE_NAME = 'events';
  private static $REQUIRED_CREATE_PARAMS = array("title", "description", "startTime", "endTime", "createdTime");
  private static $UPDATE_PARAMS = array("title", "description", "startTime", "endTime");
  public static $ENTITY_TYPE = 'Events';
  
  private $db;
  
  //put your code here
  function __construct(core\Database $db) {
    $this->db = $db;
  }
  
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
  
  public function getEvents(){
    $result = $this->db->select(self::$TABLE_NAME);
    $result["data"] = $this->modelDatabaseResult($result["data"]);
    
    return $result;
  }
  
  public function getEventById($id = null){
    $result = $this->db->select(self::$TABLE_NAME, $id);
    $result["data"] = $this->modelDatabaseResult($result["data"]);

    return $result;
  }
  
  public function createEvent($params = array()){
    $params["createdTime"] = time();
    $result = $this->db->insert(self::$TABLE_NAME, self::$REQUIRED_CREATE_PARAMS, $params);
    
    return $result;
  }
  
  public function updateEvent($id = null, $params = array()){
    $result = $this->db->update(self::$TABLE_NAME, $id, self::$UPDATE_PARAMS, $params);
    
    return $result;
  }
  
  public function deleteEvent($ids){
    
  }
}
