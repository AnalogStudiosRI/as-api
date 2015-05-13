<?php

//required in controller.php

/*****************/
/* Events Routes */
/*****************/
$slim->get("/api/events", function() use ($slim, $entity) {
  $response = $entity->getEvents();

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["data"]));
});

$slim->get("/api/events/:id", function($eventId) use ($slim, $entity) {
  $response = $entity->getEventById($eventId);
  
  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["data"]));
});

$slim->post("/api/events", function() use ($slim, $entity) {
  $params = json_decode($slim->request->getBody(), true);
  $response = $entity->createEvent($params);

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["data"]));
});

$slim->put("/api/events/:id", function($eventId) use ($slim, $entity) {
  $params = json_decode($slim->request->getBody(), true);
  $response = $entity->updateEvent($eventId, $params);

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["data"]));
});

$slim->delete("/api/events/:id", function($eventId) use ($slim, $entity) {
  //$params = json_decode($slim->request->getBody(), true);
  $response = $entity->deleteEvent($eventId);

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["data"]));
});

?>
