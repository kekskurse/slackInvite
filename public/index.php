<?php
include("../vendor/autoload.php");

$app = new \Slim\App;

$container = $app->getContainer();
$container['view'] = function ($c) {
    $view = new Slim\Views\Twig(__DIR__."/../views/", ["cache"=>false, "debug"=>true, "auto_reload"=>true]);
    // Add extensions
    $view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
    $view->addExtension(new Twig_Extension_Debug());
    return $view;
};
$container['slack'] = function ($c) {
    include(__DIR__."/../config.php");
    $slack = new Lib\Slack($slack["teamname"], $slack["apiToken"]);
    return $slack;
};

include(__DIR__."/../controller/index.php");



$app->run();
