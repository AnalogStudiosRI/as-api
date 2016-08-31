<?php

error_reporting(E_ALL | E_STRICT);

require_once "src/base/AbstractRestfulDatabase.php";
require_once "src/base/AbstractRestfulResource.php";
require_once "src/services/RestfulDatabaseService.php";
require_once "src/resources/ArtistsResource.php";
require_once "src/resources/RestfulResourceBuilder.php";

use resources as resource;

/**
 *
 * name: PostsResourceTest
 *
 * @author Owen Buckley
 */
class ArtistsResourceTest extends PHPUnit_Framework_TestCase{
  private $artistsResource;
  private static $SUCCESS = 200;
  private static $CREATED = 201;
  private static $NOT_MODIFIED = 304;
  private static $BAD_REQUEST = 400;
  private static $NOT_FOUND = 404;
  private static $DB_CONFIG = array(
    "dsn" => "mysql:host=127.0.0.1;dbname=analogstudios_prod",
    "username" => "astester",
    "password" => "452SsQMwMP"
  );

  public function setup(){
    $builder = new resource\RestfulResourceBuilder(self::$DB_CONFIG, "artists");
    $this->artistsResource = $builder->getResource();
  }

  public function tearDown(){
    $this->artistsResource = null;
  }

  /**********/
  /* CREATE */
  /**********/
  public function testCreateArtistSuccess(){
    $now = time();
    $newArtist = array(
      "name" => "Artist Title " . $now,
      "bio" => "Artist Bio " . $now
    );

    $response = $this->artistsResource->createArtist($newArtist);

    $status = $response["status"];
    $body = $response["data"];

    $this->assertNotEmpty($body["id"]);
    $this->assertNotEmpty($body["url"]);
    $this->assertEquals(self::$CREATED, $status);
    $this->assertEquals("/api/artists/" . $body["id"], $body["url"]);
  }

  public function testCreateFullArtistSuccess(){
    $now = time();
    $newArtist = array(
      "name" => "Artist Title " . $now,
      "bio" => "Artist Bio " . $now,
      "imageUrl" => "Artist Image Url " . $now,
      "genre" => "Artist Genre " . $now,
      "location" => "Artist, Location " . $now,
      "contactPhone" => 9784130134,
      "contactEmail" => "owen@analogstudios.net",
      "isActive" => 0
    );

    $response = $this->artistsResource->createArtist($newArtist);

    $status = $response["status"];
    $body = $response["data"];

    $this->assertNotEmpty($body["id"]);
    $this->assertNotEmpty($body["url"]);
    $this->assertEquals(self::$CREATED, $status);
    $this->assertEquals("/api/artists/" . $body["id"], $body["url"]);
  }


  public function testCreateArtistNoNameFailure(){
    $now = time();
    $newArtist = array(
      "bio" => "Artist Bio " . $now
    );

    $response = $this->artistsResource->createArtist($newArtist);
    $status = $response["status"];

    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  Expected name param", $response["message"]);
  }

  public function testCreatePostNoBioFailure(){
    $now = time();
    $newArtist = array(
      "name" => "Artist Name " . $now
    );

    //get response
    $response = $this->artistsResource->createArtist($newArtist);
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  Expected bio param", $response["message"]);
  }

  /********/
  /* READ */
  /********/
  public function testGetAllArtistsSuccess(){
    $response = $this->artistsResource->getArtists();
    $status = $response["status"];
    $data = $response["data"];

    $this->assertEquals(self::$SUCCESS, $status);
    $this->assertNotEmpty($data);
    $this->assertGreaterThanOrEqual(1, count($data));

    for ($i = 0, $l = count($data); $i < $l; $i++) {
      $artist = $data[$i];

      $this->assertArrayHasKey("id", $artist);
      $this->assertArrayHasKey("name", $artist);
      $this->assertArrayHasKey("bio", $artist);

      $this->assertNotEmpty("id", $artist);
      $this->assertNotEmpty("name", $artist);
      $this->assertNotEmpty("bio", $artist);
    }
  }

  public function testGetArtistByIdSuccess(){
    $artists = $this->artistsResource->getArtists();
    $randIndex = rand(1, (count($artists["data"]) - 1));

    $response = $this->artistsResource->getArtistById($artists["data"][$randIndex]["id"]);
    $status = $response["status"];
    $data = $response["data"];
    $artist = $data[0];

    $this->assertEquals(self::$SUCCESS, $status);
    $this->assertNotEmpty($data);
    $this->assertEquals(1, count($data));

    $this->assertArrayHasKey("id", $artist);
    $this->assertArrayHasKey("name", $artist);
    $this->assertArrayHasKey("bio", $artist);

    $this->assertNotEmpty("id", $artist);
    $this->assertNotEmpty("name", $artist);
    $this->assertNotEmpty("bio", $artist);
  }

  public function testGetArtistBadRequestFailure(){
    $response = $this->artistsResource->getArtistById('abc');
    $status = $response["status"];

    $this->assertEquals(self::$BAD_REQUEST, $status);
  }

  public function testGetArtistNotFoundFailure(){
    $response = $this->artistsResource->getArtistById(99999999999);
    $status = $response["status"];

    $this->assertEquals(self::$NOT_FOUND, $status);
  }

  /**********/
  /* UPDATE */
  /**********/
  public function testUpdateArtistSuccess(){
    $now = time();
    $response = $this->artistsResource->getArtists();
    $randIndex = rand(1, (count($response["data"]) - 1));
    $artist = $response["data"][$randIndex];

    $response = $this->artistsResource->updateArtist($artist["id"], array(
      "name" => "some new name" . $now,
      "bio" => "some new bio" . $now
    ));

    $status = $response["status"];
    $data = $response["data"];

    $this->assertEquals(self::$SUCCESS, $status);
    $this->assertEquals("/api/artists/" . $data["id"], $data["url"]);
  }

  public function testUpdateFullArtistSuccess(){
    $now = time();
    $response = $this->artistsResource->getArtists();
    $randIndex = rand(1, (count($response["data"]) - 1));
    $post = $response["data"][$randIndex];
    $response = $this->artistsResource->updateArtist($post["id"], array(
      "name" => "Artist Title Updated " . $now,
      "bio" => "Artist Bio Updated " . $now,
      "imageUrl" => "Artist Image Url Updated " . $now,
      "genre" => "Artist Genre Updated " . $now,
      "location" => "Artist, Location Updated" . $now,
      "contactPhone" => 1112223333,
      "contactEmail" => "Updated owen@analogstudios.net",
      "isActive" => 1
    ));
    $status = $response["status"];

    $status = $response["status"];
    $data = $response["data"];

    $this->assertEquals(self::$SUCCESS, $status);
    $this->assertEquals("/api/artists/" . $data["id"], $data["url"]);
  }

  public function testUpdateNoArtistIdFailure(){
    $response = $this->artistsResource->updateArtist();

    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  No id provided", $response["message"]);
  }

  public function testUpdateArtistNoParamsFailure(){
    $response = $this->artistsResource->updateArtist(1);

    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  No params provided", $response["message"]);
  }

  public function testUpdatePostNoValidParamsFailure(){
    $response = $this->artistsResource->updateArtist(1, array("foo" => "bar"));

    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  No valid params provided", $response["message"]);
  }

  public function testUpdateArtistNotFoundFailure(){
    $response = $this->artistsResource->updateArtist(99999999999999, array("name" => "some new name"));

    //assert
    $this->assertEquals(self::$NOT_FOUND, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Resource Not Found", $response["message"]);
  }

  /**********/
  /* DELETE */
  /**********/
  public function testDeleteArtistSuccess(){
    $artistsResponse = $this->artistsResource->getArtists();
    $artist = $artistsResponse["data"][0];

    $response = $this->artistsResource->deleteArtist($artist["id"]);

    $this->assertEquals(self::$SUCCESS, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Resource deleted successfully", $response["message"]);
  }

  public function testDeleteNoArtistIdFailure(){
    $response = $this->artistsResource->deleteArtist();

    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  No valid id provided", $response["message"]);
  }

  public function testDeleteInvalidArtistIdFailure(){
    $response = $this->artistsResource->deleteArtist("abc");

    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  No valid id provided", $response["message"]);
  }

  public function testDeleteArtistNotFoundFailure(){
    $response = $this->artistsResource->deleteArtist(9999999999999999);

    $this->assertEquals(self::$NOT_FOUND, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("No results found", $response["message"]);
  }
}