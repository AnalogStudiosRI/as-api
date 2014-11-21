<?php

//required in route.php

/******************/
/* Login Routes */
/******************/
$slim->get("/api/login", function() use ($slim, $loginCtrl) {
  $response = $loginCtrl->get();

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["body"]));
});

$slim->post("/api/login", function() use ($slim, $loginCtrl) {
  $params = json_decode($slim->request->getBody());
  $response = $loginCtrl->create(array("username" => $params->username, "password" => $params->password));

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["body"]));
});

$slim->delete("/api/login", function() use ($slim, $loginCtrl) {
  $response = $loginCtrl->delete();

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["body"]));
});

?>
