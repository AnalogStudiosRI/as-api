<?php

//required in route.php

/******************/
/* Login Routes */
/******************/
$slim->post("/api/login", function() use ($slim, $authService) {
  $body = json_decode($slim->request->getBody(), true);

  $authStatus = $authService->login($body["username"], $body["password"]);

  $slim->response->status(200);
  $slim->response->setBody(json_encode($authStatus));
});

?>