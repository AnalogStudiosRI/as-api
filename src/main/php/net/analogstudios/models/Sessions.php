<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace net\analogstudios\models;

use net\analogstudios\core as core;
/**
 * Description of Sessions
 *
 * @author obuckley
 */
class Sessions extends core\RestfulEntity{
  private $db;
  private $NO_ACTIVE_SESSION = "No active session";
  private $INVALID_LOGIN = "Invalid Login";
  
  //abstract getters
  public function getName(){
    return $this->name;
  }
  
  public function getTableName(){
    return $this->tableName;
  }
  
  public function getRequiredCreateParams(){
    return $this->createParams;
  }
  
  public function getAllowedUpdateParams(){
    return $this->updateParams;
  }
  
  private static function generateLoggedInUserResponse(){
    return array(
      "hasSession" => true,
      "username" => $_SESSION["username"],
      "displayName" => $_SESSION["displayName"]
    );
  }
}
