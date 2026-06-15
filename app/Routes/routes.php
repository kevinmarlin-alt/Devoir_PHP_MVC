<?php

use Buki\Router\Router;

$router = new Router();

$router->get('/home', function () {
    require __DIR__ . "/../Views/Pages/home.php";
});

$router->run();