<?php

error_reporting(E_ALL | E_STRICT);

require_once "src/services/ContactService.php";

use services as service;

/**
 *
 * name: ContactServiceTest
 *
 * @author Owen Buckley
 */
class ContactServiceTest extends PHPUnit_Framework_TestCase{
  private static $validEmail = 'owenbuckley13@gmail.com';
  private static $invalidEmail = 'owenlogstudios.net';
  private static $subject = "A message from the website";
  private static $message = "I really like your website!";
  private static $MAILER_CONFIG = array(
    'host' => 'alpine85.alpineweb.net',
    'username' => 'website@analogstudios.net',
    'password' => '7RS5fUkzchsEFiZSlTNy',
    'port' => 465
  );
  private $contactService;


  public function setup(){
    $this->contactService = new service\ContactService(self::$MAILER_CONFIG);
  }

  public function tearDown(){
    $this->contactService = null;
  }

  /********/
  /* Send Email  */
  /********/
  public function testSendEmailSuccess(){
    $response = $this->contactService->sendEmail(self::$validEmail, self::$validEmail, self::$subject, self::$message);

    $this->assertEquals($response["status"], 200);
    $this->assertEquals($response["message"], "Message has been sent");
  }

  public function testSendEmailInvalidToEmailFailure(){
    $response = $this->contactService->sendEmail(self::$invalidEmail, self::$validEmail, self::$subject, self::$message);

    $this->assertEquals($response["status"], 400);
    $this->assertEquals($response["message"], "Invalid to email address");
  }

  public function testSendEmailInvalidFromEmailFailure(){
    $response = $this->contactService->sendEmail(self::$validEmail, self::$invalidEmail, self::$subject, self::$message);

    $this->assertEquals($response["status"], 400);
    $this->assertEquals($response["message"], "Invalid from email address");
  }

  public function testSendEmailNoSubjectFailure(){
    $response = $this->contactService->sendEmail(self::$validEmail, self::$validEmail, "", self::$message);

    $this->assertEquals($response["status"], 400);
    $this->assertEquals($response["message"], "No subject");
  }

  public function testSendEmailNoMessageFailure(){
    $response = $this->contactService->sendEmail(self::$validEmail, self::$validEmail, self::$subject, "");

    $this->assertEquals($response["status"], 400);
    $this->assertEquals($response["message"], "No message");
  }

}