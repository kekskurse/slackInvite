<?php
$app->get('/', function ($request, $response, $args) {
    return $this->view->render($response, 'index.twig');
});
$app->post("/", function($request, $response, $args) {
  $vars = $request->getParsedBody();
  $res = $this->slack->inviteMail($vars["firstname"], $vars["mail"]);
  if($res["ok"]== True)
  {
    return $this->view->render($response, 'ok.twig');
  }
  else {
    return $this->view->render($response, 'fail.twig', ["msg"=> $res["error"]]);
  }
});
