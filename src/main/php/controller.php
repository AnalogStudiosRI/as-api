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
$pdoDB = new \net\analogstudios\core\Database('PDO', $CONFIG["db"]);  

/* instanciate slim */
$slim = new \Slim\Slim();

/* use slim session middleware */
$slim->add(new \Slim\Middleware\SessionCookie(array(
  "domain" => $CONFIG["session"]["domain"]
)));

/* common response headers */
$slim->response->headers->set('Content-Type', 'application/json');

/* get login status */
$loginCtrl    = new \net\analogstudios\controllers\LoginController($pdoDB);
$sessionResponse  = $loginCtrl->get();
$sessionInfo      = array(
  "hasSession"          =>  $sessionResponse["body"]["hasSession"],
  "username"            =>  isset($sessionResponse["body"]["username"]) ? $sessionResponse["body"]["username"] : null,
  "noSessionResponse"   =>  array(
    "status"              => 401,
    "body"                => array(
      "message"           => "No active session"
    )
  )
);

/* routing */
$request = $slim->request;
$path = $request->getResourceUri();
$route = '';

switch ($path){
  case strpos($path, events) !== FALSE:
    $route = 'events';
    break;
}

$builder = new \net\analogstudios\builders\EntityBuilder($pdoDB);
$entity = $builder->getEntity(\net\analogstudios\builders\EntityBuilder::$ENTITY_ROUTE_MAPPER[strtoupper($route)]["TYPE"]);

require_once "phar://" . $CONFIG["pharfile"] . "/net/analogstudios/routes/" . $route . "-route.php";

//start slim
$slim->run();

?>