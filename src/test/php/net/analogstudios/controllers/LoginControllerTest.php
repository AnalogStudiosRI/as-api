q<?php
error_reporting(E_ALL | E_STRICT);

require_once 'src/main/php/net/analogstudios/controllers/LoginController.php';

/**
 *
 * name: LoginControllerTest
 *
 * @author Owen Buckley
 */
class LoginContollerTest extends PHPUnit_Framework_TestCase {
  private $loginCtrl;
  private static $USERNAME = "astester";
  private static $PASSWORD = "t3st3r";
  private static $DISPLAY_NAME = "AS Tester";
  private static $NO_ACTIVE_SESSION = "No active session";
  private static $INVALD_LOGIN = "Invalid Login";
  private static $SUCCESS = 200;
  private static $CREATED = 201;
  private static $BAD_REQUEST = 400;
  private static $UNUATHORIZED = 401;

  private static function getMockSession(){
    return array(
      "hasSession" => true,
      "username" => self::$USERNAME,
      "displayName" => self::$DISPLAY_NAME
    );
  }

  public function setup(){
    $db = new PDO('mysql:host=127.0.0.1;dbname=asadmin_analogstudios_2.0_test','astester','t3st3r');
    $this->loginCtrl = new \net\analogstudios\controllers\LoginController($db);
  }

  public function tearDown(){
    $_SESSION = array();
  }

  public function testGetLoginSuccess(){
    //set session
    $_SESSION = self::getMockSession();

    //get response
    $response = $this->loginCtrl->get();
    $status = $response["status"];
    $body = $response["body"];

    //assert
    $this->assertEquals(self::$SUCCESS, $status);
    $this->assertTrue($body["hasSession"]);
    $this->assertEquals(self::$USERNAME, $body["username"]);
    $this->assertEquals(self::$DISPLAY_NAME, $body["displayName"]);
  }

  public function testGetLoginFailure(){
    //get response
    $response = $this->loginCtrl->get();
    $status = $response["status"];
    $body = $response["body"];

    //assert
    $this->assertEquals(self::$UNUATHORIZED, $status);
    $this->assertFalse($body["hasSession"]);
    $this->assertEquals(self::$NO_ACTIVE_SESSION, $body["message"]);
  }

  public function testCreateSessionSuccess(){
    //get response
    $response = $this->loginCtrl->create(array("username" => self::$USERNAME, "password" => self::$PASSWORD));
    $status = $response["status"];
    $body = $response["body"];

    //assert
    $this->assertEquals(self::$CREATED, $status);
    $this->assertTrue($body["hasSession"]);
    $this->assertEquals(self::$USERNAME, $body["username"]);
    $this->assertEquals(self::$DISPLAY_NAME, $body["displayName"]);
  }
//
//  public function testCreateSessionFailure(){
//    //get response
//    $response = $this->sessionCtrl->create(array("username" => self::$USERNAME, "password" => "xxxxxx"));
//    $status = $response["status"];
//    $body = $response["body"];
//
//    //assert
//    $this->assertEquals(self::$BAD_REQUEST, $status);
//    $this->assertFalse($body["hasSession"]);
//    $this->assertEquals(self::$INVALD_LOGIN, $body["message"]);
//  }
//
//  public function testDeleteSessionSuccess(){
//    //set session
//    $_SESSION = self::getMockSession();
//
//    //get response
//    $response = $this->sessionCtrl->delete();
//    $status = $response["status"];
//    $body = $response["body"];
//
//    //assert
//    $this->assertEquals(self::$SUCCESS, $status);
//    $this->assertFalse($body["hasSession"]);
//  }
//
//  public function testDeleteSessionFailure(){
//    //get response
//    $response = $this->sessionCtrl->delete();
//    $status = $response["status"];
//    $body = $response["body"];
//
//    //assert
//    $this->assertEquals(self::$UNUATHORIZED, $status);
//    $this->assertFalse($body["hasSession"]);
//    $this->assertEquals(self::$NO_ACTIVE_SESSION, $body["message"]);
//  }
}