<?php

error_reporting(E_ALL | E_STRICT);

require_once "src/base/AbstractRestfulDatabase.php";
require_once "src/base/AbstractRestfulResource.php";
require_once "src/services/RestfulDatabaseService.php";
require_once "src/resources/PostsResource.php";
require_once "src/resources/RestfulResourceBuilder.php";

use resources as resource;

/**
 *
 * name: PostsResourceTest
 *
 * @author Owen Buckley
 */
class PostsResourceTest extends PHPUnit_Framework_TestCase{
  private $postsResource;
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
    $builder = new resource\RestfulResourceBuilder(self::$DB_CONFIG, "posts");
    $this->postsResource = $builder->getResource();
  }

  public function tearDown(){
    $this->postsResource = null;
  }

  /**********/
  /* CREATE */
  /**********/
  public function testCreatePostSuccess(){
    $now = time();
    $newPost = array(
      "title" => "Post Title " . $now,
      "summary" => "Post Summary " . $now,
      "creeatedTime" => $now
    );

    //get response
    $response = $this->postsResource->createPost($newPost);

    $status = $response["status"];
    $body = $response["data"];

    //assert create
    $this->assertNotEmpty($body["createdTime"]);
    $this->assertNotEmpty($body["id"]);
    $this->assertNotEmpty($body["url"]);

    $this->assertEquals(self::$CREATED, $status);
    $this->assertEquals("/api/posts/" . $body["id"], $body["url"]);
  }

  public function testCreatePostNoTitleFailure(){
    $now = time();
    $newPost = array(
      "summary" => "Post Summary " . $now,
      "creeatedTime" => $now
    );

    //get response
    $response = $this->postsResource->createPost($newPost);
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  Expected title param", $response["message"]);
  }

  public function testCreatePostNoSummaryFailure(){
    $now = time();
    $newPost = array(
      "title" => "Post Title " . $now,
      "creeatedTime" => $now
    );

    //get response
    $response = $this->postsResource->createPost($newPost);
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  Expected description param", $response["message"]);
  }

  public function testCreatePostNoCreatedTimeFailure(){
    $now = time();
    $newPost = array(
      "title" => "Post Title " . $now,
      "summary" => "Post Summary " . $now
    );

    //get response
    $response = $this->postsResource->createPost($newPost);
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  Expected startTime param", $response["message"]);
  }

  /********/
  /* READ */
  /********/
  public function testGetAllPostsSuccess(){
    $response = $this->postsResource->getPosts();
    $status = $response["status"];
    $data = $response["data"];

    //assert
    $this->assertEquals(self::$SUCCESS, $status);
    $this->assertNotEmpty($data);
    $this->assertGreaterThanOrEqual(1, count($data));

    for ($i = 0, $l = count($data); $i < $l; $i++) {
      $post = $data[$i];

      $this->assertArrayHasKey("id", $post);
      $this->assertArrayHasKey("title", $post);
      $this->assertArrayHasKey("summary", $post);
      $this->assertArrayHasKey("createdTime", $post);

      $this->assertNotEmpty("id", $post);
      $this->assertNotEmpty("title", $post);
      $this->assertNotEmpty("summary", $post);
      $this->assertNotEmpty("createdTime", $post);
    }
  }

  public function testGetPostByIdSuccess(){
    //get response
    $response = $this->postsResource->getPostById(1);
    $status = $response["status"];
    $data = $response["data"];
    $post = $data[0];

    //assert
    $this->assertEquals(self::$SUCCESS, $status);
    $this->assertNotEmpty($data);
    $this->assertEquals(1, count($data));

    $this->assertArrayHasKey("id", $post);
    $this->assertArrayHasKey("title", $post);
    $this->assertArrayHasKey("summary", $post);
    $this->assertArrayHasKey("createdTime", $post);

    $this->assertNotEmpty("id", $post);
    $this->assertNotEmpty("title", $post);
    $this->assertNotEmpty("summary", $post);
    $this->assertNotEmpty("createdTime", $post);
  }

  public function testGetPostBadRequestFailure(){
    //get response
    $response = $this->postsResource->getPostById('abc');
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $status);
  }

  public function testGetPostNotFoundFailure(){
    //get response
    $response = $this->postsResource->getPostById(99999999999);
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$NOT_FOUND, $status);
  }

  /**********/
  /* UPDATE */
  /**********/
  public function testUpdatePostSuccess(){
    $now = time();
    $postsResource = $this->postsResource->getPosts();
    $randIndex = rand(1, (count($postsResource["data"]) - 1));
    $post = $postsResource["data"][$randIndex];

    //get response
    $response = $this->postsResource->updatePost($post["id"], array(
      "title" => "some new title" . $now,
      "summary" => "some new description" . $now
    ));

    $status = $response["status"];
    $data = $response["data"];

    //assert
    $this->assertEquals(self::$SUCCESS, $status);
    $this->assertEquals("/api/posts/" . $data["id"], $data["url"]);
  }

  public function testCreatePostDataNotChangedFailure(){
    $postsResource = $this->postsResource->getPosts();
    $randIndex = rand(1, (count($postsResource["data"]) - 1));
    $post = $postsResource["data"][$randIndex];

    //get response
    $response = $this->postsResource->updatePost($post["id"], array("title" => $post["title"]));
    $status = $response["status"];

    //assert
    $this->assertEquals(self::$NOT_MODIFIED, $status);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Duplicate data. Resource not modified", $response["message"]);
  }

  public function testUpdateNoPostIdFailure(){
    //get response
    $response = $this->postsResource->updatePost();

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  No id provided", $response["message"]);
  }

  public function testUpdatePostNoParamsFailure(){
    //get response
    $response = $this->postsResource->updatePost(1);

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  No params provided", $response["message"]);
  }

  public function testUpdatePostNoValidParamsFailure(){
    //get response
    $response = $this->postsResource->updatePost(1, array("foo" => "bar"));

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  No valid params provided", $response["message"]);
  }

  public function testUpdatePostNotFoundFailure(){
    //get response
    $response = $this->postsResource->updatePost(99999999999999, array("title" => "some new title"));

    //assert
    $this->assertEquals(self::$NOT_FOUND, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Resource Not Found", $response["message"]);
  }

  /**********/
  /* DELETE */
  /**********/
  public function testDeletePostSuccess(){
    //get post
    $postsResource = $this->postsResource->getPosts();
    $randIndex = rand(1, (count($postsResource["data"]) - 1));
    $post = $postsResource["data"][$randIndex];

    //get response
    $response = $this->postsResource->deletePost($post["id"]);

    //assert
    $this->assertEquals(self::$SUCCESS, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Resource deleted successfully", $response["message"]);
  }

  public function testDeleteNoPostIdFailure(){
    //get response
    $response = $this->postsResource->deletePost();


    //assert
    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  No valid id provided", $response["message"]);
  }

  public function testDeleteInvalidPostIdFailure(){
    //get response
    $response = $this->postsResource->deletePost("abc");

    //assert
    $this->assertEquals(self::$BAD_REQUEST, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("Bad Request.  No valid id provided", $response["message"]);
  }

  public function testDeletePostNotFoundFailure(){
    //get response
    $response = $this->postsResource->deletePost(9999999999999999);

    //assert
    $this->assertEquals(self::$NOT_FOUND, $response["status"]);
    $this->assertEquals(0, count($response["data"]));
    $this->assertEquals("No results found", $response["message"]);
  }
}