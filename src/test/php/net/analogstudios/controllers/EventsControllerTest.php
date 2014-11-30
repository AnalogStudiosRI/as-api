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
  private static $NOT_FOUND = 404;

  public function setup(){
    $db = new PDO("mysql:host=127.0.0.1;dbname=asadmin_analogstudios_2.0_test", "astester", "t3st3r");
    $this->eventsCtrl = new \net\analogstudios\controllers\EventsController($db);
  }

  public function tearDown(){
    $this->sessionCtrl = null;
  }

  /********/
  /* GET  */
  /********/
  public function testGetAllEventsSuccess(){
    //get response
    $response = $this->eventsCtrl->get();
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

      $this->assertNotEmpty("id", $event);
      $this->assertNotEmpty("title", $event);
      $this->assertNotEmpty("description", $event);
      $this->assertNotEmpty("start_time", $event);
      $this->assertNotEmpty("end_time", $event);
    }
  }

  public function testGetSingleEventSuccess(){
    //get response
    $response = $this->eventsCtrl->get(1);
    $status = $response["status"];
    $data = $response["body"];
    $event = $data[0];

    //assert
    $this->assertEquals(self::$SUCCESS, $status);
    $this->assertNotEmpty($data);
    $this->assertEquals(1, count($data));

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

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
  }

  public function testGetEventNotFoundFailure(){
    //get response
    $response = $this->eventsCtrl->get(9999);
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$NOT_FOUND, $status);
  }

  /********/
  /* POST */
  /********/
  public function testCreateEventSuccess(){
    $now = time();
    $newEvent = array(
      "title" => "Event Title " . $now,
      "description" => "Event Description " . $now,
      "startTime" => $now,
      "endTime" => $now + 10800000
    );

    //get response
    $response = $this->eventsCtrl->create($newEvent);

    $status = $response["status"];
    $body = $response["body"];

    //assert create
    $this->assertNotEmpty($body["createdTime"]);
    $this->assertNotEmpty($body["id"]);
    $this->assertNotEmpty($body["url"]);

    $this->assertEquals(self::$CREATED, $status);
    $this->assertEquals("/api/events/" . $body["id"], $body["url"]);
  }

  public function testCreateEventNoTitleFailure(){
    $now = time();
    $newEvent = array(
      "description" => "Event Description " . time(),
      "startTime" => $now,
      "endTime" => $now + 10800000
    );

    //get response
    $response = $this->eventsCtrl->create($newEvent);
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals("There is an error.  Expected title param", $response["body"]["message"]);
  }

  public function testCreateEventNoDescriptionFailure(){
    $now = time();
    $newEvent = array(
      "title" => "Event Title " . $now,
      "startTime" => $now,
      "endTime" => $now + 10800000
    );

    //get response
    $response = $this->eventsCtrl->create($newEvent);
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals("There is an error.  Expected description param", $response["body"]["message"]);
  }

  public function testCreateEventNoStartTimeFailure(){
    $now = time();
    $newEvent = array(
      "title" => "Event Title " . $now,
      "description" => "Event Description  " . $now,
      "endTime" => $now + 10800000
    );

    //get response
    $response = $this->eventsCtrl->create($newEvent);
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals("There is an error.  Expected startTime param", $response["body"]["message"]);
  }

  public function testCreateEventNoEndTimeFailure(){
    $now = time();
    $newEvent = array(
      "title" => "Event Title " . $now,
      "description" => "Event Description  " . $now,
      "startTime" => $now
    );

    //get response
    $response = $this->eventsCtrl->create($newEvent);
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals("There is an error.  Expected endTime param", $response["body"]["message"]);
  }

//  public function testCreateCategoryBlacklisted(){
//    //get response
//    $response = $this->categoryCtrl->create(array("categoryName" => "Other"));
//    $status = $response["status"];
//
//    //assert
//    $this->assertEquals(self::$LOCKED, $status);
//  }
//
//  public function testCreateCategoryInvalidName(){
//    //get response
//    $response = $this->categoryCtrl->create(array("categoryName" => "test###$$"));
//    $status = $response["status"];
//
//    //assert
//    $this->assertEquals(self::$BAD_REQUEST, $status);
//  }
//
//  public function testCreateCategoryExisting(){
//    //get response
//    $response = $this->categoryCtrl->create(array("categoryName" => "testob-123"));
//    $status = $response["status"];
//
//    //assert
//    $this->assertEquals(self::$CONFLICT, $status);
//  }
}