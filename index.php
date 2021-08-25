<?php

ob_start();

require __DIR__ . "/vendor/autoload.php";

/**
 * BOOTSTRAP
 */
use Source\Core\Session;
use CoffeeCode\Router\Router;

$session = new Session();
$route = new Router(url(), ":");
$route->namespace("Source\App");

/**
 * WEB ROUTES
 */
$route->group(null);
$route->get("/", "Web:home");
$route->get("/escritorio", "Web:about");

 /**
 * ERROR ROUTES
 */
$route->group("/ops");
$route->get("/{errcode}", "Web:error");

 /**
 * ROUTE
 */
$route->dispatch();

 /**
 * ERROR REDIRECT
 */
if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();