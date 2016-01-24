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
  private static $validEmail = 'owen@analogstudios.net';
  private static $invalidEmail = 'owenlogstudios.net';
  private static $subject = "A message from the website";
  private static $message = "I really like your website!";

  /********/
  /* Send Email  */
  /********/
  public function testSendEmailSuccess(){
    $response = service\ContactService::sendEmail(self::$validEmail, self::$validEmail, self::$subject, self::$message);

    $this->assertEquals($response["status"], 200);
    $this->assertEquals($response["message"], "Message sent");
  }

  public function testSendEmailInvalidToEmailFailure(){
    $response = service\ContactService::sendEmail(self::$invalidEmail, self::$validEmail, self::$subject, self::$message);

    $this->assertEquals($response["status"], 400);
    $this->assertEquals($response["message"], "Invalid to email address");
  }

  public function testSendEmailInvalidFromEmailFailure(){
    $response = service\ContactService::sendEmail(self::$validEmail, self::$invalidEmail, self::$subject, self::$message);

    $this->assertEquals($response["status"], 400);
    $this->assertEquals($response["message"], "Invalid from email address");
  }

  public function testSendEmailNoSubjectFailure(){
    $response = service\ContactService::sendEmail(self::$validEmail, self::$validEmail, '', self::$message);

    $this->assertEquals($response["status"], 400);
    $this->assertEquals($response["message"], "No subject");
  }

  public function testSendEmailNoMessageFailure(){
    $response = service\ContactService::sendEmail(self::$validEmail, self::$validEmail, self::$subject, '');

    $this->assertEquals($response["status"], 400);
    $this->assertEquals($response["message"], "No message");
  }

}