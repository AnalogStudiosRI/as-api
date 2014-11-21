<?php

/* initial requires */
require_once "config.php";
require_once $CONFIG["pharfile"];
require_once "phar://" . $CONFIG["pharfile"] . "/vendor/autoload.php";

//runtime configuration
ini_set("display_errors", $CONFIG["displayErrors"]);
date_default_timezone_set("America/New_York");

//setup session handling
session_cache_limiter(false);
session_start();  
    
/* DB connect */
try {  
  $dbConfig = $CONFIG["db"];
  $db = new PDO($dbConfig["dsn"], $dbConfig["user"], $dbConfig["password"]);  
} catch(PDOException $e) {  
  echo $e->getMessage();  
}  

/* instanciate slim */
$slim = new \Slim\Slim();

/* use slim session middleware */
$slim->add(new \Slim\Middleware\SessionCookie(array(
  "domain" => $CONFIG["session"]["domain"]
)));

/* common response headers */
$slim->response->headers->set('Content-Type', 'application/json');

/* get session status */
//$sessionResponse  = $sessionCtrl->get();
//$sessionInfo      = array(
//  "hasSession"          =>  $sessionResponse["body"]["hasSession"],
//  "username"            =>  isset($sessionResponse["body"]["username"]) ? $sessionResponse["body"]["username"] : null,
//  "noSessionResponse"   =>  array(
//    "status"              => 401,
//    "body"                => array(
//      "message"           => "No active session"
//    )
//  )
//);

//include routes
require_once "phar://" . $CONFIG["pharfile"] . "/net/analogstudios/routes/events-config.php";

//start slim
$slim->run();

?>