<?php

error_reporting(E_ALL | E_STRICT);

require_once "src/base/AbstractRestfulDatabase.php";
require_once "src/base/AbstractRestfulResource.php";
require_once "src/services/RestfulDatabaseService.php";
require_once "src/resources/AlbumsResource.php";
require_once "src/resources/RestfulResourceBuilder.php";

use resources as resource;

/**
 *
 * name: PostsResourceTest
 *
 * @author Owen Buckley
 */
class AlbumsResourceTest extends PHPUnit_Framework_TestCase{
  private $albumsResource;
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
  private static $MOCK_ALBUM_MODEL = array(
    "id" => 1,
    "title" => "Debut CD Release Party (live)",
    "description" => "The songs were played live at the CD Release party for Analog''s debut album, \"When the Media Talk About The Media\" at Captain Nick's on Block Island.  These are songs from both the debut album and Dave Flamand\\''s previous release, \"Lost Time.\"",
    "year" => 2008,
    "imageUrl" => "path/to/image/ur.jpgl",
    "downloadUrl" => "path/to/download/url.zip",
    "artistId" => 1
  );

  public function setup(){
    $builder = new resource\RestfulResourceBuilder(self::$DB_CONFIG, "albums");
    $this->albumsResource = $builder->getResource();
  }

  public function tearDown(){
    $this->albumsResource = null;
  }

  /**********/
  /* CREATE */
  /**********/
  public function testCreateAlbumSuccess(){
    $now = time();
    $newAlbum = array(
      "title" => self::$MOCK_ALBUM_MODEL["title"] . $now,
      "description" => self::$MOCK_ALBUM_MODEL["description"],
      "artistId" => self::$MOCK_ALBUM_MODEL["artistId"]
    );

    $response = $this->albumsResource->createAlbum($newAlbum);
    $status = $response["status"];
    $body = $response["data"];

    $this->assertNotEmpty($body["id"]);
    $this->assertNotEmpty($body["url"]);
    $this->assertEquals(self::$CREATED, $status);
    $this->assertEquals("/api/albums/" . $body["id"], $body["url"]);

    $artistReponse = $this->albumsResource->getAlbumById($body['id']);
    $artist = $artistReponse["data"][0];

    $this->assertEquals($artist["title"], $newAlbum["title"]);
    $this->assertEquals($artist["description"], $newAlbum["description"]);
  }

  public function testCreateFullAlbumSuccess(){
    $now = time();
    $newAlbum = array(
      "title" => self::$MOCK_ALBUM_MODEL["title"] . $now,
      "description" => self::$MOCK_ALBUM_MODEL["description"],
      "year" => self::$MOCK_ALBUM_MODEL["year"] + 1,
      "imageUrl" => $now . '/' . self::$MOCK_ALBUM_MODEL["imageUrl"],
      "downloadUrl" => $now . '/' . self::$MOCK_ALBUM_MODEL["downloadUrl"],
      "artistId" => self::$MOCK_ALBUM_MODEL["artistId"]
    );
    $response = $this->albumsResource->createAlbum($newAlbum);

    $status = $response["status"];
    $body = $response["data"];
    $this->assertNotEmpty($body["id"]);
    $this->assertNotEmpty($body["url"]);
    $this->assertEquals(self::$CREATED, $status);
    $this->assertEquals("/api/albums/" . $body["id"], $body["url"]);

    $albumsReponse = $this->albumsResource->getAlbumById($body['id']);
    $album = $albumsReponse["data"][0];

    $this->assertEquals($album["title"], $newAlbum["title"]);
    $this->assertEquals($album["description"], $newAlbum["description"]);
    $this->assertEquals($album["year"], $newAlbum["year"]);
    $this->assertEquals($album["imageUrl"], $newAlbum["imageUrl"]);
    $this->assertEquals($album["downloadUrl"], $newAlbum["downloadUrl"]);
    $this->assertEquals($album["artistId"], $newAlbum["artistId"]);
  }

  public function testCreateAlbumNoTitleFailure(){
    $newAlbum = array(
      "description" => self::$MOCK_ALBUM_MODEL["description"]
    );

    $response = $this->albumsResource->createAlbum($newAlbum);
    $status = $response["status"];

    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  Expected title param", $response["message"]);
  }

  public function testCreateAlbumNoDescriptionFailure(){
    $newAlbum = array(
      "title" => self::$MOCK_ALBUM_MODEL["title"]
    );

    //get response
    $response = $this->albumsResource->createAlbum($newAlbum);
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  Expected description param", $response["message"]);
  }

  public function testCreateAlbumNoArtistIdFailure(){
    $newAlbum = array(
      "title" => self::$MOCK_ALBUM_MODEL["title"],
      "description" => self::$MOCK_ALBUM_MODEL["description"]
    );

    //get response
    $response = $this->albumsResource->createAlbum($newAlbum);
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  Expected artistId param", $response["message"]);
  }


  /********/
  /* READ */
  /********/
  public function testGetAllAlbumsSuccess(){
    $response = $this->albumsResource->getAlbums();
    $status = $response["status"];
    $data = $response["data"];

    $this->assertEquals(self::$SUCCESS, $status);
    $this->assertNotEmpty($data);
    $this->assertGreaterThanOrEqual(1, count($data));

    for ($i = 0, $l = count($data); $i < $l; $i++) {
      $album = $data[$i];

      $this->assertArrayHasKey("id", $album);
      $this->assertArrayHasKey("title", $album);
      $this->assertArrayHasKey("description", $album);
      $this->assertArrayHasKey("artistId", $album);

      $this->assertNotEmpty("id", $album);
      $this->assertNotEmpty("title", $album);
      $this->assertNotEmpty("description", $album);
      $this->assertNotEmpty("artistId", $album);
    }
  }

  public function testGetAlbumsByIdSuccess(){
    $albums = $this->albumsResource->getAlbums();
    $randIndex = rand(1, (count($albums["data"]) - 1));

    $response = $this->albumsResource->getAlbumById($albums["data"][$randIndex]["id"]);
    $status = $response["status"];
    $data = $response["data"];
    $album = $data[0];

    $this->assertEquals(self::$SUCCESS, $status);
    $this->assertNotEmpty($data);
    $this->assertEquals(1, count($data));

    $this->assertArrayHasKey("id", $album);
    $this->assertArrayHasKey("title", $album);
    $this->assertArrayHasKey("description", $album);

    $this->assertNotEmpty("id", $album);
    $this->assertNotEmpty("title", $album);
    $this->assertNotEmpty("description", $album);
  }

  public function testGetAlbumBadRequestFailure(){
    $response = $this->albumsResource->getAlbumById('abc');
    $status = $response["status"];

    $this->assertEquals(self::$BAD_REQUEST, $status);
  }

  public function testGetArtistNotFoundFailure(){
    $response = $this->albumsResource->getAlbumById(99999999999);
    $status = $response["status"];

    $this->assertEquals(self::$NOT_FOUND, $status);
  }

  /**********/
  /* UPDATE */
  /**********/
  public function testUpdateAlbumSuccess(){
    $now = time();
    $response = $this->albumsResource->getAlbums();
    $randIndex = rand(1, (count($response["data"]) - 1));
    $randAlbum = $response["data"][$randIndex];

    $albumsReponse = $this->albumsResource->updateAlbum($randAlbum["id"], array(
      "title" => self::$MOCK_ALBUM_MODEL["title"] . $now,
      "description" => self::$MOCK_ALBUM_MODEL["description"] . $now,
    ));

    $status = $albumsReponse["status"];
    $data = $albumsReponse["data"];

    $this->assertEquals(self::$SUCCESS, $status);
    $this->assertEquals("/api/albums/" . $data["id"], $data["url"]);

    $singleAlbumReponse = $this->albumsResource->getAlbumById($data['id']);
    $singlAlbum = $singleAlbumReponse["data"][0];

    $this->assertEquals($singlAlbum["title"], self::$MOCK_ALBUM_MODEL["title"] . $now);
    $this->assertEquals($singlAlbum["description"], self::$MOCK_ALBUM_MODEL["description"] . $now);
  }

  public function testUpdateFullAlbumSuccess(){
    $now = time();
    $response = $this->albumsResource->getAlbums();
    $randIndex = rand(1, (count($response["data"]) - 1));
    $randAlbum = $response["data"][$randIndex];
    $albumsReponse = $this->albumsResource->updateAlbum($randAlbum["id"], array(
      "title" => self::$MOCK_ALBUM_MODEL["title"]  . ' ' . $now,
      "description" => self::$MOCK_ALBUM_MODEL["description"]  . ' ' . $now,
      "year" => self::$MOCK_ALBUM_MODEL["year"] + 1,
      "imageUrl" => $now . '/' . self::$MOCK_ALBUM_MODEL["imageUrl"],
      "downloadUrl" => $now . '/' . self::$MOCK_ALBUM_MODEL["downloadUrl"]
    ));

    $status = $albumsReponse["status"];
    $album = $albumsReponse["data"];

    $this->assertEquals(self::$SUCCESS, $status);
    $this->assertEquals("/api/albums/" . $album["id"], $album["url"]);

    $singleAlbumReponse = $this->albumsResource->getAlbumById($album['id']);
    $singlAlbum = $singleAlbumReponse["data"][0];

    $this->assertEquals($singlAlbum["title"], self::$MOCK_ALBUM_MODEL["title"]  . ' ' . $now);
    $this->assertEquals($singlAlbum["description"], self::$MOCK_ALBUM_MODEL["description"] . ' ' . $now);
    $this->assertEquals($singlAlbum["year"], (self::$MOCK_ALBUM_MODEL["year"] + 1));
    $this->assertEquals($singlAlbum["imageUrl"], ($now . '/' . self::$MOCK_ALBUM_MODEL["imageUrl"]));
    $this->assertEquals($singlAlbum["downloadUrl"], ($now . '/' . self::$MOCK_ALBUM_MODEL["downloadUrl"]));
  }
//
//  public function testUpdateNoArtistIdFailure(){
//    $response = $this->artistsResource->updateArtist();
//
//    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
//    $this->assertEquals(0, count($response["data"]));
//    $this->assertEquals("Bad Request.  No id provided", $response["message"]);
//  }
//
//  public function testUpdateArtistNoParamsFailure(){
//    $response = $this->artistsResource->updateArtist(1);
//
//    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
//    $this->assertEquals(0, count($response["data"]));
//    $this->assertEquals("Bad Request.  No params provided", $response["message"]);
//  }
//
//  public function testUpdateArtistNoValidParamsFailure(){
//    $response = $this->artistsResource->updateArtist(1, array("foo" => "bar"));
//
//    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
//    $this->assertEquals(0, count($response["data"]));
//    $this->assertEquals("Bad Request.  No valid params provided", $response["message"]);
//  }
//
//  public function testUpdateArtistNotFoundFailure(){
//    $response = $this->artistsResource->updateArtist(99999999999999, array("name" => "some new name", "bio" => "some bio"));
//
//    $this->assertEquals(self::$NOT_FOUND, $response["status"]);
//    $this->assertEquals(0, count($response["data"]));
//    $this->assertEquals("Resource Not Found", $response["message"]);
//  }

  /**********/
  /* DELETE */
  /**********/
//  public function testDeleteArtistSuccess(){
//    $artistsResponse = $this->artistsResource->getArtists();
//    $artist = $artistsResponse["data"][0];
//
//    $response = $this->artistsResource->deleteArtist($artist["id"]);
//
//    $this->assertEquals(self::$SUCCESS, $response["status"]);
//    $this->assertEquals(0, count($response["data"]));
//    $this->assertEquals("Resource deleted successfully", $response["message"]);
//  }
//
//  public function testDeleteNoArtistIdFailure(){
//    $response = $this->artistsResource->deleteArtist();
//
//    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
//    $this->assertEquals(0, count($response["data"]));
//    $this->assertEquals("Bad Request.  No valid id provided", $response["message"]);
//  }
//
//  public function testDeleteInvalidArtistIdFailure(){
//    $response = $this->artistsResource->deleteArtist("abc");
//
//    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
//    $this->assertEquals(0, count($response["data"]));
//    $this->assertEquals("Bad Request.  No valid id provided", $response["message"]);
//  }
//
//  public function testDeleteArtistNotFoundFailure(){
//    $response = $this->artistsResource->deleteArtist(9999999999999999);
//
//    $this->assertEquals(self::$NOT_FOUND, $response["status"]);
//    $this->assertEquals(0, count($response["data"]));
//    $this->assertEquals("No results found", $response["message"]);
//  }
}