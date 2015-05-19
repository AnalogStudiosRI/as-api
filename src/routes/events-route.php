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

//$slim->post("/api/events", function() use ($slim, $resource) {
//  $params = json_decode($slim->request->getBody(), true);
//  $response = $resource->createEvent($params);
//
//  $slim->response->status($response['status']);
//  $slim->response->setBody(json_encode($response["data"]));
//});
//
//$slim->put("/api/events/:id", function($eventId) use ($slim, $resource) {
//  $params = json_decode($slim->request->getBody(), true);
//  $response = $resource->updateEvent($eventId, $params);
//
//  $slim->response->status($response['status']);
//  $slim->response->setBody(json_encode($response["data"]));
//});
//
//$slim->delete("/api/events/:id", function($eventId) use ($slim, $resource) {
//  //$params = json_decode($slim->request->getBody(), true);
//  $response = $resource->deleteEvent($eventId);
//
//  $slim->response->status($response['status']);
//  $slim->response->setBody(json_encode($response["data"]));
//});

?>
