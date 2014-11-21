<?php

namespace net\analogstudios\controllers;

require_once "ControllerInterface.php";

/**
 * name: LoginController
 * namespace: net\analogstudios\controllers
 *
 * @author Owen Buckley
 */
class LoginController implements ControllerInterface{

  private $db;
  private static $NO_ACTIVE_SESSION = "No active session";
  private static $INVALID_LOGIN = "Invalid Login";

  /** CONSTRUCTOR
   *  Initalize the Class member $db
   */
  function __construct($db) {
    $this->db = $db;
  }

  private static function generateLoggedInUserResponse(){
    return array(
      "hasSession" => true,
      "username" => $_SESSION["username"],
      "displayName" => $_SESSION["displayName"]
    );
  }

  /**
   *
   * LoginController->get()
   *
   * @return array $response;
   */
  public function get($id = null, $filters = array()) {
    $response = array();
    $body = array();
    $status = 0;

    if(isset($_SESSION["hasSession"])){
      $status = 200;

      $body = self::generateLoggedInUserResponse();
    }else{
      $status = 401;
      $body = array(
        "hasSession" => false,
        "message" => self::$NO_ACTIVE_SESSION
      );
    }

    //construct response
    $response["status"] = $status;
    $response["body"] = $body;

    return $response;
  }

  /**
   *
   * LoginController->create()
   *
   * @param string $username
   * @param string $password
   *
   * @return array $response;
   */
  public function create($params = array()) {
    $db = $this->db;
    $response = array();
    $body = array();
    $status = 0;

    $stmt = $db->prepare("SELECT * FROM users WHERE username=:username");
    $stmt->bindValue(":username", $params["username"], $db::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch($db::FETCH_ASSOC);
    $count = $stmt->rowCount();
    $passMatch = (crypt($params["password"], $result["password"]) === $result["password"]);
    //$passMatch = hash_equals( $result["password"], crypt($params["username"], $result["password"]));

    if($count === 0 || !$passMatch){
      $status = 400;
      $body = array(
        "hasSession" => false,
        "message" => self::$INVALID_LOGIN
      );
    }else if($count === 1 && $passMatch){
      $_SESSION["hasSession"] = true;
      $_SESSION["username"] = $result['username'];
      $_SESSION["displayName"] = $result["first_name"] . " " . $result["last_name"];

      $status = 201;
      $body = self::generateLoggedInUserResponse();
    };

    //construct params
    $response["status"] = $status;
    $response["body"] = $body;

    return $response;
  }

  /**
   *
   * LoginController->update()
   *
   * @return array $response;
   */
  public function update($params = array()) {
    return array();
  }


  /**
   *
   * LoginController->delete()
   *
   * @return array $response;
   */
  public function delete($ids = array()) {
    $response = array();
    $body = array();
    $status = 0;

    if(isset($_SESSION["hasSession"])){
      $_SESSION = array();
      $status = 200;
      $body = array(
        "hasSession" => false
      );
    }else{
      $status = 401;
      $body = array(
        "hasSession" => false,
        "message" => self::$NO_ACTIVE_SESSION
      );
    }

    //construct response
    $response["status"] = $status;
    $response["body"] = $body;

    return $response;
  }

}

?>