<?php

error_reporting(E_ALL | E_STRICT);

require_once "src/base/AbstractRestfulDatabase.php";
require_once "src/base/AbstractRestfulResource.php";
require_once "src/services/RestfulDatabaseService.php";
require_once "src/resources/EventsResource.php";
require_once "src/resources/RestfulResourceBuilder.php";

use resources as resource;

/**
 *
 * name: EventResourceTest
 *
 * @author Owen Buckley
 */
class EventResourceTest extends PHPUnit_Framework_TestCase{
  private $eventsEntity;
  private static $SUCCESS = 200;
  private static $CREATED = 201;
  private static $NOT_MODIFIED = 304;
  private static $BAD_REQUEST = 400;
  private static $NOT_FOUND = 404;
  private static $NOW_OFFSET = 10800000;
  private static $DB_CONFIG = array(
    "dsn" => "mysql:host=127.0.0.1;dbname=analogstudios_prod",
    "username" => "astester",
    "password" => "452SsQMwMP"
  );

  public function setup(){
    $builder = new resource\RestfulResourceBuilder(self::$DB_CONFIG, 'events');
    $this->eventsEntity = $builder->getResource();
  }

  public function tearDown(){
    $this->eventsEntity = null;
  }

  /********/
  /* GET  */
  /********/
  public function testGetAllEventsSuccess(){
    $response = $this->eventsEntity->getEvents();
    $status = $response["status"];
    $data = $response["data"];

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
    $response = $this->eventsEntity->getEventById(1);
    $status = $response["status"];
    $data = $response["data"];
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
    $response = $this->eventsEntity->getEventById('abc');
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
  }

  public function testGetEventNotFoundFailure(){
    //get response
    $response = $this->eventsEntity->getEventById(99999999999);
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$NOT_FOUND, $status);
  }

  /**********/
  /* CREATE */
  /**********/
  public function testCreateEventSuccess(){
    $now = time();
    $newEvent = array(
      "title" => "Event Title " . $now,
      "description" => "Event Description " . $now,
      "startTime" => $now,
      "endTime" => $now + 10800000
    );

    //get response
    $response = $this->eventsEntity->createEvent($newEvent);

    $status = $response["status"];
    $body = $response["data"];

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
    $response = $this->eventsEntity->createEvent($newEvent);
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  Expected title param", $response["message"]);
  }

  public function testCreateEventNoDescriptionFailure(){
    $now = time();
    $newEvent = array(
      "title" => "Event Title " . $now,
      "startTime" => $now,
      "endTime" => $now + 10800000
    );

    //get response
    $response = $this->eventsEntity->createEvent($newEvent);
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  Expected description param", $response["message"]);
  }

  public function testCreateEventNoStartTimeFailure(){
    $now = time();
    $newEvent = array(
      "title" => "Event Title " . $now,
      "description" => "Event Description  " . $now,
      "endTime" => $now + 10800000
    );

    //get response
    $response = $this->eventsEntity->createEvent($newEvent);
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  Expected startTime param", $response["message"]);
  }

  public function testCreateEventNoEndTimeFailure(){
    $now = time();
    $newEvent = array(
      "title" => "Event Title " . $now,
      "description" => "Event Description  " . $now,
      "startTime" => $now
    );

    //get response
    $response = $this->eventsEntity->createEvent($newEvent);
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  Expected endTime param", $response["message"]);
  }

  /**********/
  /* UPDATE */
  /**********/
  public function testUpdateEventSuccess(){
    $now = time();
    $eventsResponse = $this->eventsEntity->getEvents();
    $randIndex = rand(1, (count($eventsResponse["data"]) - 1));
    $event = $eventsResponse["data"][$randIndex];

    //get response
    $response = $this->eventsEntity->updateEvent($event["id"], array(
      "title" => "some new title" . $now,
      "description" => "some new description" . $now,
      "startTime" => $now,
      "endTime" =>  $now + self::$NOW_OFFSET
    ));

    $status = $response["status"];
    $data = $response["data"];

    //assert
    $this->assertEquals(self::$SUCCESS, $status);
    $this->assertEquals("/api/events/" . $data["id"], $data["url"]);
  }

  public function testCreateEventDataNotChangedFailure(){
    $eventsResponse = $this->eventsEntity->getEvents();
    $randIndex = rand(1, (count($eventsResponse["data"]) - 1));
    $event = $eventsResponse["data"][$randIndex];

    //get response
    $response = $this->eventsEntity->updateEvent($event["id"], array("title" => $event["title"]));
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$NOT_MODIFIED, $status);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Duplicate data. Resource not modified", $response["message"]);
  }

  public function testUpdateNoEventIdFailure(){
    //get response
    $response = $this->eventsEntity->updateEvent();

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  No id provided", $response["message"]);
  }

  public function testUpdateEventNoParamsFailure(){
    //get response
    $response = $this->eventsEntity->updateEvent(1);

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  No params provided", $response["message"]);
  }

  public function testUpdateEventNoValidParamsFailure(){
    //get response
    $response = $this->eventsEntity->updateEvent(1, array("foo" => "bar"));

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  No valid params provided", $response["message"]);
  }

  public function testUpdateEventNotFoundFailure(){
    //get response
    $response = $this->eventsEntity->updateEvent(99999999999999, array("title" => "some new title"));

    //assert
    $this->assertEquals(self::$NOT_FOUND, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Resource Not Found", $response["message"]);
  }

  /**********/
  /* DELETE */
  /**********/
  public function testDeleteEventSuccess(){
    //get event
    $eventsResponse = $this->eventsEntity->getEvents();
    $randIndex = rand(1, (count($eventsResponse["data"]) - 1));
    $event = $eventsResponse["data"][$randIndex];

    //get response
    $response = $this->eventsEntity->deleteEvent($event["id"]);

    //assert
    $this->assertEquals(self::$SUCCESS, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Resource deleted successfully", $response["message"]);
  }

  public function testDeleteNoEventIdFailure(){
    //get response
    $response = $this->eventsEntity->deleteEvent();


    //assert
    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  No valid id provided", $response["message"]);
  }

  public function testDeleteInvalidEventIdFailure(){
    //get response
    $response = $this->eventsEntity->deleteEvent("abc");

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  No valid id provided", $response["message"]);
  }

  public function testDeleteEventNotFoundFailure(){
    //get response
    $response = $this->eventsEntity->deleteEvent(9999999999999999);

    //assert
    $this->assertEquals(self::$NOT_FOUND, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("No results found", $response["message"]);
  }
}