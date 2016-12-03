<?php

//required in controller.php

/*****************/
/* Posts Routes */
/*****************/
$slim->get("/api/posts", function() use ($slim, $resource) {
  $response = $resource->getPosts();

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["data"]));
});

$slim->get("/api/posts/:id", function($postId) use ($slim, $resource) {
  $response = $resource->getPostById($postId);

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["data"]));
});

$slim->post("/api/posts", function() use ($slim, $resource, $hasValidLogin, $invalidLoginResponse) {
  $params = json_decode($slim->request->getBody(), true);
  $params["createdTime"] = time();

  $response = $hasValidLogin ? $resource->createPost($params) : $invalidLoginResponse;

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["data"]));
});

$slim->put("/api/posts/:id", function($postId) use ($slim, $resource, $hasValidLogin, $invalidLoginResponse) {
  $params = json_decode($slim->request->getBody(), true);
  $response = $hasValidLogin ? $resource->updatePost($postId, $params) : $invalidLoginResponse;

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["data"]));
});

$slim->delete("/api/posts/:id", function($postId) use ($slim, $resource, $hasValidLogin, $invalidLoginResponse) {
  $response = $hasValidLogin ? $resource->deletePost($postId) : $invalidLoginResponse;

  $slim->response->status($response['status']);
  $slim->response->setBody(json_encode($response["data"]));
});