<?php

//required in controller.php

/*****************/
/* Artists Routes */
/*****************/
$slim->get("/api/artists", function() use ($slim, $resource) {
  $response = $resource->getArtists();

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["data"]));
});

$slim->get("/api/artists/:id", function($eventId) use ($slim, $resource) {
  $response = $resource->getArtistById($eventId);

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["data"]));
});

$slim->post("/api/artists", function() use ($slim, $resource, $hasValidLogin, $invalidLoginResponse) {
  $params = json_decode($slim->request->getBody(), true);
  $response = $hasValidLogin ? $resource->createArtist($params) : $invalidLoginResponse;

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["data"]));
});

$slim->put("/api/artists/:id", function($eventId) use ($slim, $resource, $hasValidLogin, $invalidLoginResponse) {
  $params = json_decode($slim->request->getBody(), true);
  $response = $hasValidLogin ? $resource->updateArtist($eventId, $params) : $invalidLoginResponse;

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["data"]));
});

$slim->delete("/api/artists/:id", function($eventId) use ($slim, $resource, $hasValidLogin, $invalidLoginResponse) {
  $response = $hasValidLogin ? $resource->deleteArtist($eventId) : $invalidLoginResponse;

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["data"]));
});

?>
