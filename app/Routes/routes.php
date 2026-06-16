<?php

use App\Controllers\HomepageController;
use App\Controllers\LoginController;
use App\Controllers\TravelsControllers;
use App\Models\EmployeeModel;
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

// Routes of login
$router->group('/login', function($router){
    
    $router->get('/', function() {
        //(new EmployeeModel)->addPassword();
        (new LoginController)->index();
    });
    
    $router->post('/', function() {
        (new LoginController)->login();
    });
});

// Routes of travels
$router->group(('/travels'), function($router) {

    $router->get('/create', function() {
        (new TravelsControllers)->createIndex();
    });

    $router->post('/create', function() {
        (new TravelsControllers)->createNewTravel();
    });
});

$router->get('/accueil', function () {
    (new HomepageController)->index();
});

$router->run();