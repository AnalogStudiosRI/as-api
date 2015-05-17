<?php

//constants
define("INI_PATH", "../config.ini");
define("PHAR_PATH", "phar://as-api.phar");
define("TIMEZONE",  "America/New_York");

/* initial requires */
require_once PHAR_PATH . "/vendor/autoload.php";

/* get config */
$config = new config\Config(INI_PATH);
$CONFIG = $config->getConfig();

//runtime configuration
ini_set("display_errors", $CONFIG["runtime.displayErrors"]);
date_default_timezone_set(TIMEZONE);

//setup session handling
session_cache_limiter(false);
session_start();

/* new slim */
$slim = new \Slim\Slim();

/* use slim session middleware */
$slim->add(new \Slim\Middleware\SessionCookie(array(
  "domain" => $CONFIG["session.domain"]
)));

/* common response headers */
$slim->response->headers->set('Content-Type', 'application/json');

/* get login status */
//$loginCtrl    = new \net\analogstudios\controllers\LoginController($pdoDB);
//$sessionResponse  = $loginCtrl->get();
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

/* routing and controlling */
$request = $slim->request;
$path = $request->getResourceUri();
$route = '';

switch ($path){
  case strpos($path, 'events') !== FALSE:
    $route = 'events';
    break;
}

//get entity to pass to respective router
$builder = new \resources\RestfulResourceBuilder(array(
  "dsn" => "mysql:host=" . $CONFIG['db.host'] . ";dbname=" . $CONFIG['db.name'],
  "username" => $CONFIG["db.user"],
  "password" => $CONFIG["db.password"]
), $route);

$resource = $builder->getResource();

require_once PHAR_PATH . "/routes/" . $route . "-route.php";

//start slim
$slim->run();

?>