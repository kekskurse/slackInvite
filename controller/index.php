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

    switch($res["error"])
    {
      case "already_in_team":
        $errorMSG = "You are already part of this Team.";
        break;
      case "user_disabled":
        $errorMSG = "Your Account is disabled.";
        break;
      default:
        $errorMSG = $res["error"];
        break;
    }
    return $this->view->render($response, 'fail.twig', ["msg"=> $errorMSG]);
  }
});
