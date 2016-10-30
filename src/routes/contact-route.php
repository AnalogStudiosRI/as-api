<?php

//required in controller.php

use services as service;

/******************/
/* Contact Routes */
/******************/
$slim->post("/api/contact", function() use ($slim, $envConfig) {
  $params = json_decode($slim->request->getBody(), true);
  $contactService = new service\ContactService(array(
    "host" => $envConfig["mail.host"],
    "password" => $envConfig["mail.password"],
    "username" => $envConfig["mail.username"],
    "port" => $envConfig["mail.port"]
  ));
  //TODO add spam protection - honeypot?
  $response = $contactService->sendEmail($envConfig["mail.to"], $envConfig["mail.from"], $params["subject"], $params["message"]);

  $slim->response->status($response["status"]);
  $slim->response->setBody(json_encode(array("message" => $response["message"])));
});

?>