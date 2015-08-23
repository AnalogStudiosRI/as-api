<?php

//required in controller.php

/******************/
/* Contact Routes */
/******************/
$slim->post("/api/contact", function() use ($slim) {
  $params = json_decode($slim->request->getBody(), true);
  $response = services\ContactService::sendEmail($params["to"], $params["from"], $params["subject"], $params["message"]);

  $slim->response->status($response["status"]);
  $slim->response->setBody(json_encode(array("message" => $response["message"])g));
});

?>