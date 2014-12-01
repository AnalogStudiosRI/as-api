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
  private static $NOW_OFFSET = 10800000;

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
      $this->assertArrayHasKey("startTime", $event);
      $this->assertArrayHasKey("endTime", $event);

      $this->assertNotEmpty("id", $event);
      $this->assertNotEmpty("title", $event);
      $this->assertNotEmpty("description", $event);
      $this->assertNotEmpty("startTime", $event);
      $this->assertNotEmpty("endTime", $event);
    }
  }

  public function testGetEventByIdSuccess(){
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
    $this->assertArrayHasKey("startTime", $event);
    $this->assertArrayHasKey("endTime", $event);

    $this->assertNotEmpty("id", $event);
    $this->assertNotEmpty("title", $event);
    $this->assertNotEmpty("description", $event);
    $this->assertNotEmpty("startTime", $event);
    $this->assertNotEmpty("endTime", $event);
  }

  public function testGetEventBadRequestFailure(){
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

  /********/
  /* PUT  */
  /********/
  public function testUpdateEventSuccess(){
    $now = time();
    $eventsResponse = $this->eventsCtrl->get();
    $randIndex = rand(0, (count($eventsResponse["body"]) - 1));
    $event = $eventsResponse["body"][$randIndex];

    //get response
    $response = $this->eventsCtrl->update($event["id"], array(
      "title" => "some new title" . $now,
      "description" => "some new description" . $now,
      "startTime" => $now,
      "endTime" =>  $now + self::$NOW_OFFSET
    ));
    $status = $response["status"];
    $body = $response["body"];

    //assert
    $this->assertEquals(self::$SUCCESS, $status);
    $this->assertEquals("/api/events/" . $body["id"], $body["url"]);
  }

  public function testUpdateNoEventIdFailure(){
    //get response
    $response = $this->eventsCtrl->update();
    $status = $response["status"];
    $body = $response["body"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals("Bad Request.  No id provided", $body["message"]);
  }

  public function testUpdateEventNoParamsFailure(){
    //get response
    $response = $this->eventsCtrl->update(1);
    $status = $response["status"];
    $body = $response["body"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals("Bad Request.  No params provided", $body["message"]);
  }

  public function testUpdateEventNoValidParamsFailure(){
    //get response
    $response = $this->eventsCtrl->update(1, array("foo" => "bar"));
    $status = $response["status"];
    $body = $response["body"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals("Bad Request.  No valid params provided", $body["message"]);
  }

  public function testUpdateEventNotFoundFailure(){
    //get response
    $response = $this->eventsCtrl->update(99999999999999, array("title" => "some new title"));
    $status = $response["status"];
    $body = $response["body"];

    //assert
    $this->assertEquals(self::$NOT_FOUND, $status);
    $this->assertEquals("Event Not Found", $body["message"]);
  }

  /**********/
  /* DELETE */
  /**********/
  public function testDeleteEventSuccess(){
    //get event
    $eventsResponse = $this->eventsCtrl->get();
    $randIndex = rand(0, (count($eventsResponse["body"]) - 1));
    $event = $eventsResponse["body"][$randIndex];

    //get response
    $response = $this->eventsCtrl->delete($event["id"]);
    $status = $response["status"];
    $body = $response["body"];

    //assert
    $this->assertEquals(self::$SUCCESS, $status);
    $this->assertEquals("Event deleted successfully", $body["message"]);
  }

  public function testDeleteNoEventIdFailure(){
    //get response
    $response = $this->eventsCtrl->delete();
    $status = $response["status"];
    $body = $response["body"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals("Bad Request.  No valid event id provided", $body["message"]);
  }

  public function testDeleteInvalidEventIdFailure(){
    //get response
    $response = $this->eventsCtrl->delete("abc");
    $status = $response["status"];
    $body = $response["body"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals("Bad Request.  No valid event id provided", $body["message"]);
  }

  public function testDeleteEventNotFoundFailure(){
    //get response
    $response = $this->eventsCtrl->delete(9999999999999999);
    $status = $response["status"];
    $body = $response["body"];

    //assert
    $this->assertEquals(self::$NOT_FOUND, $status);
    $this->assertEquals("Event not found", $body["message"]);
  }
}