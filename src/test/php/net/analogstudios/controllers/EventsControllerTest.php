<?php
error_reporting(E_ALL | E_STRICT);

require_once "src/main/php/net/analogstudios/controllers/EventsController.php";

/**
 *
 * name: EventsControllerTest
 *
 * @author Owen Buckley
 */
class EventsContollerTest extends PHPUnit_Framework_TestCase{
  private $eventsCtrl;
  private static $SUCCESS = 200;
  private static $CREATED = 201;
  private static $BAD_REQUEST = 400;
  private static $UNUATHORIZED = 401;
  private static $NOT_FOUND = 404;

  public function setup(){
    $db = new PDO("mysql:host=127.0.0.1;dbname=asadmin_analogstudios_2.0_test", "astester", "t3st3r");
    $this->eventsCtrl = new \net\analogstudios\controllers\EventsController($db);
  }

  public function tearDown(){
    $this->sessionCtrl = null;
  }

  //GET
  public function testGetAllEventsSuccess(){
    //get response
    $response = $this->eventsCtrl->get(1);
    $status = $response["status"];
    $data = $response["body"];

    //assert
    $this->assertEquals(self::$SUCCESS, $status);
    $this->assertNotEmpty($data);
    $this->assertGreaterThanOrEqual(1, count($data));

    for ($i = 0, $l = count($data); $i < $l; $i++) {
      $event = $data[$i];

      $this->assertArrayHasKey("id", $event);
      $this->assertArrayHasKey("title", $event);
      $this->assertArrayHasKey("description", $event);
      $this->assertArrayHasKey("start_time", $event);
      $this->assertArrayHasKey("end_time", $event);
      //$this->assertArrayHasKey("link", $event);
      //$this->assertArrayHasKey("link_facebook", $event);


      $this->assertNotEmpty("id", $event);
      $this->assertNotEmpty("title", $event);
      $this->assertNotEmpty("description", $event);
      $this->assertNotEmpty("start_time", $event);
      $this->assertNotEmpty("end_time", $event);
      //$this->assertNotEmpty("link", $event);
      //$this->assertNotEmpty("link_facebook", $event);
    }
  }

  public function testGetEventSuccess(){
    //get response
    $response = $this->eventsCtrl->get(1);
    $status = $response["status"];
    $data = $response["body"];

    //assert
    $this->assertEquals(self::$SUCCESS, $status);
    $this->assertNotEmpty($data);
    $this->assertEquals(1, count($data));

    $event = $data[0];

    $this->assertArrayHasKey("id", $event);
    $this->assertArrayHasKey("title", $event);
    $this->assertArrayHasKey("description", $event);
    $this->assertArrayHasKey("start_time", $event);
    $this->assertArrayHasKey("end_time", $event);


    $this->assertNotEmpty("id", $event);
    $this->assertNotEmpty("title", $event);
    $this->assertNotEmpty("description", $event);
    $this->assertNotEmpty("start_time", $event);
    $this->assertNotEmpty("end_time", $event);
  }

  public function testGetEventsBadRequestFailure(){
    //get response
    $response = $this->eventsCtrl->get('abc');
    $status = $response["status"];
    $data = $response["body"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
  }

  public function testGetEventNotFoundFailure(){
    //get response
    $response = $this->eventsCtrl->get(9999);
    $status = $response["status"];
    $data = $response["body"];

    //assert
    $this->assertEquals(self::$NOT_FOUND, $status);
  }
}