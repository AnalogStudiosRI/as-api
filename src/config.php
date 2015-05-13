<?php

$CONFIG = array(
  "db" => array(
    "dsn" => "mysql:host=${db.host};dbname=${db.name}",
    "username" => "${db.user}",
    "password" => "${db.password}"
  ),

  "displayErrors" => "${runtime.displayErrors}",

  "pharfile" => "as-api-${project.version}.phar",

  "session" => array(
    "domain" => "${session.domain}"
  )

);

?>