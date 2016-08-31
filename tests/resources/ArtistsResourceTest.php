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

    //get response
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
//  public function testUpdatePostSuccess(){
//    $now = time();
//    $postsResource = $this->postsResource->getPosts();
//    $randIndex = rand(1, (count($postsResource["data"]) - 1));
//    $post = $postsResource["data"][$randIndex];
//
//    //get response
//    $response = $this->postsResource->updatePost($post["id"], array(
//      "title" => "some new title" . $now,
//      "summary" => "some new description" . $now
//    ));
//
//    $status = $response["status"];
//    $data = $response["data"];
//
//    //assert
//    $this->assertEquals(self::$SUCCESS, $status);
//    $this->assertEquals("/api/posts/" . $data["id"], $data["url"]);
//  }
//
//  public function testCreatePostDataNotChangedFailure(){
//    $postsResource = $this->postsResource->getPosts();
//    $randIndex = rand(1, (count($postsResource["data"]) - 1));
//    $post = $postsResource["data"][$randIndex];
//
//    //get response
//    $response = $this->postsResource->updatePost($post["id"], array("title" => $post["title"]));
//    $status = $response["status"];
//
//    //assert
//    $this->assertEquals(self::$NOT_MODIFIED, $status);
//    $this->assertEquals(0, count($response["data"]));
//    $this->assertEquals("Duplicate data. Resource not modified", $response["message"]);
//  }
//
//  public function testUpdateNoPostIdFailure(){
//    //get response
//    $response = $this->postsResource->updatePost();
//
//    //assert
//    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
//    $this->assertEquals(0, count($response["data"]));
//    $this->assertEquals("Bad Request.  No id provided", $response["message"]);
//  }
//
//  public function testUpdatePostNoParamsFailure(){
//    //get response
//    $response = $this->postsResource->updatePost(1);
//
//    //assert
//    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
//    $this->assertEquals(0, count($response["data"]));
//    $this->assertEquals("Bad Request.  No params provided", $response["message"]);
//  }
//
//  public function testUpdatePostNoValidParamsFailure(){
//    //get response
//    $response = $this->postsResource->updatePost(1, array("foo" => "bar"));
//
//    //assert
//    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
//    $this->assertEquals(0, count($response["data"]));
//    $this->assertEquals("Bad Request.  No valid params provided", $response["message"]);
//  }
//
//  public function testUpdatePostNotFoundFailure(){
//    //get response
//    $response = $this->postsResource->updatePost(99999999999999, array("title" => "some new title"));
//
//    //assert
//    $this->assertEquals(self::$NOT_FOUND, $response["status"]);
//    $this->assertEquals(0, count($response["data"]));
//    $this->assertEquals("Resource Not Found", $response["message"]);
//  }

  /**********/
  /* DELETE */
  /**********/
//  public function testDeletePostSuccess(){
//    //get post
//    $postsResource = $this->postsResource->getPosts();
//    //$randIndex = rand(0, (count($postsResource["data"]) - 1));
//    $post = $postsResource["data"][0];
//
//    //get response
//    $response = $this->postsResource->deletePost($post["id"]);
//
//    //assert
//    $this->assertEquals(self::$SUCCESS, $response["status"]);
//    $this->assertEquals(0, count($response["data"]));
//    $this->assertEquals("Resource deleted successfully", $response["message"]);
//  }
//
//  public function testDeleteNoPostIdFailure(){
//    //get response
//    $response = $this->postsResource->deletePost();
//
//
//    //assert
//    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
//    $this->assertEquals(0, count($response["data"]));
//    $this->assertEquals("Bad Request.  No valid id provided", $response["message"]);
//  }
//
//  public function testDeleteInvalidPostIdFailure(){
//    //get response
//    $response = $this->postsResource->deletePost("abc");
//
//    //assert
//    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
//    $this->assertEquals(0, count($response["data"]));
//    $this->assertEquals("Bad Request.  No valid id provided", $response["message"]);
//  }
//
//  public function testDeletePostNotFoundFailure(){
//    //get response
//    $response = $this->postsResource->deletePost(9999999999999999);
//
//    //assert
//    $this->assertEquals(self::$NOT_FOUND, $response["status"]);
//    $this->assertEquals(0, count($response["data"]));
//    $this->assertEquals("No results found", $response["message"]);
//  }
}