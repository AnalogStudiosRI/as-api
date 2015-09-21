<?php

namespace resources;

use base as base;

/**
 * Description of Session
 *
 * @author obuckley
 */
class Sessions extends base\AbstractRestfulResource{
  protected $db;
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