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
 * name: EventsResourceTest
 *
 * @author Owen Buckley
 */
class EventsResourceTest extends PHPUnit_Framework_TestCase{
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
  private static $MOCK_EVENT_MODEL = array(
    "id" => 1,
    "title" => "Analog @ The Tankard",
    "description" => "Analog is playing at The Tankard this Saturday, with opening act Sean Daley. Â Please come join as we prevew some of the new songs on the album.",
    "startTime" => 1454810400,
    "endTime" => 1454896799,
    "createdTime" => 1451789911
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
    $response = $this->eventsEntity->getEventById(1);
    $status = $response["status"];
    $data = $response["data"];
    $event = $data[0];

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
    $response = $this->eventsEntity->getEventById('abc');
    $status = $response["status"];

    $this->assertEquals(self::$BAD_REQUEST, $status);
  }

  public function testGetEventNotFoundFailure(){
    $response = $this->eventsEntity->getEventById(99999999999);
    $status = $response["status"];

    $this->assertEquals(self::$NOT_FOUND, $status);
  }

  /**********/
  /* CREATE */
  /**********/
  public function testCreateEventSuccess(){
    $now = time();
    $newEvent = array(
      "title" => self::$MOCK_EVENT_MODEL["title"] . ' ' . $now,
      "description" => self::$MOCK_EVENT_MODEL["description"] . ' ' . $now,
      "startTime" => $now,
      "endTime" => $now + self::$NOW_OFFSET
    );

    $response = $this->eventsEntity->createEvent($newEvent);
    $status = $response["status"];
    $body = $response["data"];

    $this->assertNotEmpty($body["createdTime"]);
    $this->assertNotEmpty($body["id"]);
    $this->assertNotEmpty($body["url"]);
    $this->assertEquals(self::$CREATED, $status);
    $this->assertEquals("/api/events/" . $body["id"], $body["url"]);
  }

  public function testCreateEventNoTitleFailure(){
    $now = time();
    $newEvent = array(
      "description" => self::$MOCK_EVENT_MODEL["description"],
      "startTime" => $now,
      "endTime" => $now + self::$NOW_OFFSET
    );

    $response = $this->eventsEntity->createEvent($newEvent);
    $status = $response["status"];

    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  Expected title param", $response["message"]);
  }

  public function testCreateEventNoDescriptionFailure(){
    $now = time();
    $newEvent = array(
      "title" => self::$MOCK_EVENT_MODEL["title"],
      "startTime" => $now,
      "endTime" => $now + self::$NOW_OFFSET
    );

    $response = $this->eventsEntity->createEvent($newEvent);
    $status = $response["status"];

    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  Expected description param", $response["message"]);
  }

  public function testCreateEventNoStartTimeFailure(){
    $newEvent = array(
      "title" => self::$MOCK_EVENT_MODEL["title"],
      "description" => self::$MOCK_EVENT_MODEL["description"],
      "endTime" => self::$MOCK_EVENT_MODEL["endTime"]
    );

    $response = $this->eventsEntity->createEvent($newEvent);
    $status = $response["status"];

    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  Expected startTime param", $response["message"]);
  }

  public function testCreateEventNoEndTimeFailure(){
    $newEvent = array(
      "title" => self::$MOCK_EVENT_MODEL["title"],
      "description" => self::$MOCK_EVENT_MODEL["description"],
      "startTime" => self::$MOCK_EVENT_MODEL["startTime"]
    );

    $response = $this->eventsEntity->createEvent($newEvent);
    $status = $response["status"];

    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  Expected endTime param", $response["message"]);
  }

  /**********/
  /* UPDATE */
  /**********/
  public function testUpdateEventSuccess(){
    $now = time() * 2;
    $eventsResponse = $this->eventsEntity->getEvents();
    $id = $eventsResponse["data"][count($eventsResponse["data"]) - 1]["id"];

    $response = $this->eventsEntity->updateEvent($id, array(
      "title" => self::$MOCK_EVENT_MODEL["title"],
      "description" => self::$MOCK_EVENT_MODEL["description"],
      "startTime" => $now,
      "endTime" =>  $now + self::$NOW_OFFSET
    ));

    $status = $response["status"];
    $data = $response["data"];

    $this->assertEquals(self::$SUCCESS, $status);
    $this->assertEquals("/api/events/" . $data["id"], $data["url"]);
  }

  public function testCreateEventDataNotChangedFailure(){
    $eventsResponse = $this->eventsEntity->getEvents();
    $event = $eventsResponse["data"][count($eventsResponse["data"]) - 1];

    $response = $this->eventsEntity->updateEvent($event["id"], array("title" => $event["title"]));
    $status = $response["status"];

    $this->assertEquals(self::$NOT_MODIFIED, $status);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Duplicate data. Resource not modified", $response["message"]);
  }

  public function testUpdateNoEventIdFailure(){
    $response = $this->eventsEntity->updateEvent();

    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  No id provided", $response["message"]);
  }

  public function testUpdateEventNoParamsFailure(){
    $response = $this->eventsEntity->updateEvent(1);

    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  No params provided", $response["message"]);
  }

  public function testUpdateEventNoValidParamsFailure(){
    $response = $this->eventsEntity->updateEvent(1, array("foo" => "bar"));

    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  No valid params provided", $response["message"]);
  }

  public function testUpdateEventNotFoundFailure(){
    $response = $this->eventsEntity->updateEvent(99999999999999, array(
      "title" => self::$MOCK_EVENT_MODEL["title"]
    ));

    $this->assertEquals(self::$NOT_FOUND, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Resource Not Found", $response["message"]);
  }

  /**********/
  /* DELETE */
  /**********/
  public function testDeleteEventSuccess(){
    $eventsResponse = $this->eventsEntity->getEvents();
    $id = $eventsResponse["data"][count($eventsResponse["data"]) - 1]["id"];

    $response = $this->eventsEntity->deleteEvent($id);

    $this->assertEquals(self::$SUCCESS, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Resource deleted successfully", $response["message"]);
  }

  public function testDeleteNoEventIdFailure(){
    $response = $this->eventsEntity->deleteEvent();

    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  No valid id provided", $response["message"]);
  }

  public function testDeleteInvalidEventIdFailure(){
    $response = $this->eventsEntity->deleteEvent("abc");

    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  No valid id provided", $response["message"]);
  }

  public function testDeleteEventNotFoundFailure(){
    $response = $this->eventsEntity->deleteEvent(9999999999999999);

    $this->assertEquals(self::$NOT_FOUND, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("No results found", $response["message"]);
  }
}