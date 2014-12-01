<?php

//required in route.php

/****************/
/* Events Routes */
/****************/
$slim->get("/api/events", function() use ($slim, $db) {
  $eventsCtrl = new \net\analogstudios\controllers\EventsController($db);

  $response = $eventsCtrl->get();

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["body"]));
});

$slim->get("/api/events/:id", function($eventId) use ($slim, $db) {
  $eventsController  = new \net\analogstudios\controllers\EventsController($db);
  $response = $eventsController->get($eventId);

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["body"]));
});

$slim->post("/api/events", function() use ($slim, $db) {
  $eventsController  = new \net\analogstudios\controllers\EventsController($db);
  $params = json_decode($slim->request->getBody(), true);

  $response = $eventsController->create($params);

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["body"]));
});

$slim->put("/api/events/:id", function($eventId) use ($slim, $db) {
  $eventsController  = new \net\analogstudios\controllers\EventsController($db);
  $params = json_decode($slim->request->getBody(), true);

  $response = $eventsController->update($eventId, $params);

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["body"]));
});

$slim->delete("/api/events/:id", function($eventId) use ($slim, $db) {
  $eventsController  = new \net\analogstudios\controllers\EventsController($db);
  $params = json_decode($slim->request->getBody(), true);

  $response = $eventsController->delete($eventId);

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["body"]));
});

?>
