<?php

use App\Middlewares\AuthMiddleware;

use App\Controllers\HomepageController;
use App\Controllers\LoginController;
use App\Controllers\TravelsControllers;

use App\Models\EmployeeModel;

use Buki\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        if(isset($_SESSION['user'])) {
            header('Location: /');
            exit;
        }
        (new LoginController)->index();
    });
    
    $router->post('/', function() {
        (new LoginController)->login();
    });
});

// Routes of employees
$router->group('/employees', function ($router) {

    $router->get('/:id', function(int $id, Response $response) {
        return json_encode((new EmployeeModel)->findEmployeeById($id));
    });
});

// Routes of travels
$router->group(('/travels'), function($router) {

    $router->get('/:id', function(int $id, Response $response) {
        AuthMiddleware::handle();
        return json_encode((new TravelsControllers)->getTravelById($id));
    });

    $router->get('/create', function() {
        AuthMiddleware::handle();
        (new TravelsControllers)->createIndex();
    });

    $router->post('/create', function() {
        AuthMiddleware::handle();
        (new TravelsControllers)->createNewTravel();
    });

    $router->get('/update/', function () {
        AuthMiddleware::handle();
        (new TravelsControllers)->updateIndex($_GET['id']);
    });

    $router->put('/update/:id', function (int $id, Request $request) {
        AuthMiddleware::handle();
        $data = json_decode($request->getContent(), true);
        (new TravelsControllers)->updateTravel($id, $data);
        
    });
});

$router->get('/accueil', function () {
    (new HomepageController)->index();
});

$router->run();