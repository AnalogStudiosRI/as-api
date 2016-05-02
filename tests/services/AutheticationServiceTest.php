<?php
error_reporting(E_ALL | E_STRICT);

require_once "src/services/AuthenticationService.php";

use services as service;

class AuthenticationServiceTest extends PHPUnit_Framework_TestCase{
  private static $username = "astester";
  private static $password = "4e7RqGEhtHKHAX6AtYnc";
  //XXX TODO mock ConfigService
  private static $CONFIG = array(
    "session.domain" => "analogstudios.thegreenhouse.io",
    "db.host" => "127.0.0.1",
    "db.name" => "analogstudios_prod",
    "db.user" => "astester",
    "db.password" => "452SsQMwMP",
    "key.jwtSecret" => "De6CA9#3b#aSF3ZVG@Q3"
  );

  public function testLoginSuccess(){
    $authService = new service\AuthenticationService(self::$CONFIG);
    $authStatus = $authService->login(self::$username, self::$password);

    $this->assertArrayHasKey("success", $authStatus);
    $this->assertArrayHasKey("message", $authStatus);
    $this->assertArrayHasKey("data", $authStatus);
    $this->assertArrayHasKey("jwt", $authStatus["data"]);

    $this->assertEquals($authStatus["success"], true);
    $this->assertEquals($authStatus["message"], "Login Success");
  }

  public function testLoginFailureInvalidCredentials(){
    $authService = new service\AuthenticationService(self::$CONFIG);
    $authStatus = $authService->login(self::$username, "&&&&");

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
    $authStatus = $authService->login(self::$username, self::$password);
    $token = $authStatus["data"]["jwt"];

    //make sure we have reached JWT used time clearance
    //sleep(11);

    //$loginStatus = $authService->validateLogin($token);

    //TODO fix this!!!
    //$this->assertEquals('VALID', $loginStatus);
  }

  public function testValidateLoginFailureInvalidTokenParam(){
    $authService = new service\AuthenticationService(self::$CONFIG);

    //$this->assertFalse($authService->validateLogin());
  }

  public function testValidateLoginFailureTokenNotBeforeTime(){
    $authService = new service\AuthenticationService(self::$CONFIG);
    $authStatus = $authService->login(self::$username, self::$password);
    $token = $authStatus["data"]["jwt"];

    $authStatus = $authService->validateLogin($token);

    //TODO should be a specific status type
    //TODO fix this!!!
    //echo 'testValidateLoginFailureTokenNotBeforeTime => ';
    //var_dump($authStatus);
    //$this->assertEquals('UNKNOWN', $authStatus);
  }

  public function testValidateLoginTokenExpired(){
    $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NTAwMjY2MDEsImp0aSI6ImJyaWhnXC9PQWc3TlhSMVgraXNZZFhBOVViZGJkV3lFV2dEUHpBVFRiRkJ3PSIsImlzcyI6ImFuYWxvZ3N0dWRpb3MudGhlZ3JlZW5ob3VzZS5pbyIsIm5iZiI6MTQ1MDAyNjYxMSwiZXhwIjoxNDUwMDI3ODExLCJkYXRhIjp7InVzZXJJZCI6IjEiLCJ1c2VyTmFtZSI6ImFzdGVzdGVyIn19.q5QC_MBR5OvctYfDM2pyHHHsEVlqd84uFa2qg1Za3riq18jeO2K9RnI8iCVjLfg89J-mm9YPArcmMmjsWU32Lw";
    $authService = new service\AuthenticationService(self::$CONFIG);

    //TODO fix this!!!
    $authStatus = $authService->validateLogin($token);
    //echo 'testValidateLoginTokenExpired => ';
    //var_dump($authStatus);
    //$this->assertEquals('EXPIRED', $authStatus);
  }

  public function testRefreshLoginSuccess(){
    $authService = new service\AuthenticationService(self::$CONFIG);
    $authStatus = $authService->login(self::$username, self::$password);

    //make sure we have reached JWT used time clearance
    sleep(11);

    $refreshToken = $authService->refreshLogin($authStatus["data"]["jwt"]);

    $this->assertNotNull($refreshToken);
  }

  public function testRefreshLoginFailureNotToken(){
    $authService = new service\AuthenticationService(self::$CONFIG);
    $refreshToken = $authService->refreshLogin();

    $this->assertNull($refreshToken);
  }

}