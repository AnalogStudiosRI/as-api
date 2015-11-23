<?php
error_reporting(E_ALL | E_STRICT);

require_once "src/services/AuthenticationService.php";

use services as service;

class AuthenticationServiceTest extends PHPUnit_Framework_TestCase{
  private static $username = "obuckley";
  private static $password = "testpwd";
  private static $DB_CONFIG = array(
    "dsn" => "mysql:host=127.0.0.1;dbname=asadmin_analogstudios_new_test",
    "username" => "astester",
    "password" => "t3st3r"
  );

  public function testLoginSuccess(){
    $loginService = new service\AuthenticationService(self::$DB_CONFIG);
    $loginStatus = $loginService->login("astester", '$1$fDUPbgtB$Q3RER8dNV4aBbcw/dys8a/');

    $this->assertEquals($loginStatus["success"], true);
    $this->assertEquals($loginStatus["message"], "Login Success");
  }

  public function testLoginSuccessInvalidCredentials(){
    $loginService = new service\AuthenticationService(self::$DB_CONFIG);
    $loginStatus = $loginService->login(self::$username, self::$password);

    $this->assertEquals($loginStatus["success"], false);
    $this->assertEquals($loginStatus["message"], "Invalid Credentials");
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testLoginFailureNoCredentials(){
    $loginService = new service\AuthenticationService(self::$DB_CONFIG);
    $loginService->login();
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testLoginFailureNoUsernameCredential(){
    $loginService = new service\AuthenticationService(self::$DB_CONFIG);
    $loginService->login(null);
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testLoginFailureNoPasswordCredential(){
    $loginService = new service\AuthenticationService(self::$DB_CONFIG);
    $loginService->login(self::$username, null);
  }
}