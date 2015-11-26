<?php
error_reporting(E_ALL | E_STRICT);

require_once "src/services/AuthenticationService.php";

use services as service;

class AuthenticationServiceTest extends PHPUnit_Framework_TestCase{
  private static $username = "obuckley";
  private static $password = "testpwd";
  //XXX TODO mock ConfigService
  private static $CONFIG = array(
    "session.domain" => "analogstudios.thegreenhouse.io",
    "db.host" => "127.0.0.1",
    "db.name" => "asadmin_analogstudios_new_test",
    "db.user" => "astester",
    "db.password" => "t3st3r",
    "key.jwtSecret" => "PbgtB@Q3RER8dN"
  );

  public function testLoginSuccess(){
    $authService = new service\AuthenticationService(self::$CONFIG);
    $authStatus = $authService->login("astester", '$1$fDUPbgtB$Q3RER8dNV4aBbcw/dys8a/');

    $this->assertArrayHasKey("success", $authStatus);
    $this->assertArrayHasKey("message", $authStatus);
    $this->assertArrayHasKey("data", $authStatus);
    $this->assertArrayHasKey("jwt", $authStatus["data"]);

    $this->assertEquals($authStatus["success"], true);
    $this->assertEquals($authStatus["message"], "Login Success");
  }

  public function testLoginSuccessInvalidCredentials(){
    $authService = new service\AuthenticationService(self::$CONFIG);
    $authStatus = $authService->login(self::$username, self::$password);

    $this->assertArrayHasKey("success", $authStatus);
    $this->assertArrayHasKey("message", $authStatus);

    $this->assertEquals($authStatus["success"], false);
    $this->assertEquals($authStatus["message"], "Invalid Credentials");
  }

  public function testLoginFailureNoCredentials(){
    $authService = new service\AuthenticationService(self::$CONFIG);
    $authStatus = $authService->login();

    $this->assertArrayHasKey("success", $authStatus);
    $this->assertArrayHasKey("message", $authStatus);

    $this->assertEquals($authStatus["success"], false);
    $this->assertEquals($authStatus["message"], "Missing Credentials");
  }

  public function testLoginFailureNoUsernameCredential(){
    $authService = new service\AuthenticationService(self::$CONFIG);
    $authStatus = $authService->login(null, self::$password);

    $this->assertArrayHasKey("success", $authStatus);
    $this->assertArrayHasKey("message", $authStatus);

    $this->assertEquals($authStatus["success"], false);
    $this->assertEquals($authStatus["message"], "Missing Credentials");
  }

  public function testLoginFailureNoPasswordCredential(){
    $authService = new service\AuthenticationService(self::$CONFIG);
    $authStatus = $authService->login(self::$username);

    $this->assertArrayHasKey("success", $authStatus);
    $this->assertArrayHasKey("message", $authStatus);

    $this->assertEquals($authStatus["success"], false);
    $this->assertEquals($authStatus["message"], "Missing Credentials");
  }

  public function testValidateLoginSuccess(){
    $authService = new service\AuthenticationService(self::$CONFIG);
    $authStatus = $authService->login("astester", '$1$fDUPbgtB$Q3RER8dNV4aBbcw/dys8a/');
    $token = $authStatus["data"]["jwt"];

    //intentionally expire JWT
    sleep(11);

    $tokenStatus = $authService->validateLogin($token);

    $this->assertTrue($tokenStatus);
  }

  public function testValidateLoginFailureInvalidTokenParam(){
    $authService = new service\AuthenticationService(self::$CONFIG);

    $this->assertFalse($authService->validateLogin());
  }

  /**
   * @expectedException \Firebase\JWT\BeforeValidException
   */
  public function testValidateLoginFailureTokenNotBeforeTime(){
    $authService = new service\AuthenticationService(self::$CONFIG);
    $authStatus = $authService->login("astester", '$1$fDUPbgtB$Q3RER8dNV4aBbcw/dys8a/');
    $token = $authStatus["data"]["jwt"];

    $authService->validateLogin($token);
  }

}