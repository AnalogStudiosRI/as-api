<?php

//required in controller.php

/*****************/
/* Events Routes */
/*****************/
$slim->get("/api/events", function() use ($slim, $resource) {
  $response = $resource->getEvents();

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["data"]));
});

$slim->get("/api/events/:id", function($eventId) use ($slim, $resource) {
  $response = $resource->getEventById($eventId);

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["data"]));
});

$slim->post("/api/events", function() use ($slim, $resource, $hasValidLogin, $invalidLoginResponse) {
  $params = json_decode($slim->request->getBody(), true);
  $response = $hasValidLogin ? $resource->createEvent($params) : $invalidLoginResponse;

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["data"]));
});

$slim->put("/api/events/:id", function($eventId) use ($slim, $resource, $hasValidLogin, $invalidLoginResponse) {
  $params = json_decode($slim->request->getBody(), true);
  $response = $hasValidLogin ? $resource->updateEvent($eventId, $params) : $invalidLoginResponse;

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["data"]));
});

$slim->delete("/api/events/:id", function($eventId) use ($slim, $resource, $hasValidLogin, $invalidLoginResponse) {
  $response = $hasValidLogin ? $resource->deleteEvent($eventId) : $invalidLoginResponse;

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["data"]));
});

?>
