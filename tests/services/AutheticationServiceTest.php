<?php
error_reporting(E_ALL | E_STRICT);

require_once "src/services/AuthenticationService.php";

use services as service;

class AuthenticationServiceTest extends PHPUnit_Framework_TestCase{
  private static $username = "obuckley";
  private static $password = "testpwd";
  //XXX TODO mock ConfigService
  private static $CONFIG = array(
    "session" => array(
      "domain" => "analogstudios.thegreenhouse.io"
    ),
    "db" => array(
      "dsn" => "mysql:host=127.0.0.1;dbname=asadmin_analogstudios_new_test",
      "username" => "astester",
      "password" => "t3st3r"
    ),
    "key" => array(
      "jwtSecret" => "PbgtB@Q3RER8dN"
    )
  );

  public function testLoginSuccess(){
    $loginService = new service\AuthenticationService(self::$CONFIG);
    $loginStatus = $loginService->login("astester", '$1$fDUPbgtB$Q3RER8dNV4aBbcw/dys8a/');

    $this->assertArrayHasKey("success", $loginStatus);
    $this->assertArrayHasKey("message", $loginStatus);
    $this->assertArrayHasKey("data", $loginStatus);
    $this->assertArrayHasKey("jwt", $loginStatus["data"]);

    $this->assertEquals($loginStatus["success"], true);
    $this->assertEquals($loginStatus["message"], "Login Success");
  }

  public function testLoginSuccessInvalidCredentials(){
    $loginService = new service\AuthenticationService(self::$CONFIG);
    $loginStatus = $loginService->login(self::$username, self::$password);

    $this->assertArrayHasKey("success", $loginStatus);
    $this->assertArrayHasKey("message", $loginStatus);

    $this->assertEquals($loginStatus["success"], false);
    $this->assertEquals($loginStatus["message"], "Invalid Credentials");
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testLoginFailureNoCredentials(){
    $loginService = new service\AuthenticationService(self::$CONFIG);
    $loginService->login();
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testLoginFailureNoUsernameCredential(){
    $loginService = new service\AuthenticationService(self::$CONFIG);
    $loginService->login(null);
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testLoginFailureNoPasswordCredential(){
    $loginService = new service\AuthenticationService(self::$CONFIG);
    $loginService->login(self::$username, null);
  }

  public function testValidateLoginSuccess(){
    $authService = new service\AuthenticationService(self::$CONFIG);
    $loginStatus = $authService->login("astester", '$1$fDUPbgtB$Q3RER8dNV4aBbcw/dys8a/');
    $token = $loginStatus["data"]["jwt"];

    sleep(11);

    $tokenStatus = $authService->validateLogin($token);

    $this->assertTrue($tokenStatus);
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testValidateLoginFailureInvalidTokenParam(){
    $authService = new service\AuthenticationService(self::$CONFIG);
    $authService->validateLogin();
  }

  /**
   * @expectedException \Firebase\JWT\BeforeValidException
   */
  public function testValidateLoginFailureTokenNotBeforeTime(){
    $authService = new service\AuthenticationService(self::$CONFIG);
    $loginStatus = $authService->login("astester", '$1$fDUPbgtB$Q3RER8dNV4aBbcw/dys8a/');
    $token = $loginStatus["data"]["jwt"];

    $authService->validateLogin($token);
  }

}