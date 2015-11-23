<?php

namespace services;

/**
 *
 * @author Owen Buckley
 * @email owen@analogstudios.net
 * @api as-api
 * @package services
 * @class AuthenticationService
 *
 * @since 0.3.0
 *
 * @copyright 2015
 *
 */

class AuthenticationService{

  private $db;

  public function __construct($dbConfig){
    $this->db = new \PDO($dbConfig["dsn"], $dbConfig["username"], $dbConfig["password"]);
  }

  public function login ($username = null, $password = null) {
    $response = array("success" => false, "message" => "");

    if(is_string($username) && is_string($password)){
      $db = $this->db;

      $stmt = $db->prepare("SELECT * FROM users WHERE username=:username AND password=:password");
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':password', $password);
      $stmt->execute();

      $result = $stmt->fetchAll($db::FETCH_ASSOC);
      var_dump($result);

      if(count($result) === 1){
        $response["success"] = true;
        $response["message"] = "Login Success";
      }else{
        $response["message"] = "Invalid Credentials";
      }
    }else{
      throw new \InvalidArgumentException('Messing Credentials');
    }

    return $response;
  }

}