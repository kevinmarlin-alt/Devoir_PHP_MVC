<?php

use Buki\Router\Router;

$router = new Router();

$router->get('/', function () {
    if(!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }

    $uri .= $_SERVER['HTTP_HOST'];
    header('Location: '.$uri.'/accueil');
});

$router->get('/accueil', function () {
    $title = 'Accueil';
    $view = 'homepage';
    require_once __DIR__ . "/../Views/Layouts/index.php";
});

$router->run();