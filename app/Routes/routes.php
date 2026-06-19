<?php

use App\Controllers\AgenciesController;
use App\Middlewares\AuthMiddleware;

use App\Controllers\HomepageController;
use App\Controllers\LoginController;
use App\Controllers\TravelsControllers;
use App\Controllers\DashboardController;
use App\Controllers\NotFoundController;
use App\Middlewares\AdminMiddleware;
use App\Models\EmployeeModel;

use Buki\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$router = new Router();

/**
 * Route d'entrée du site internet et redirection vers l'acceuil
 */
$router->get('/', function () {
    if(!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }

    $uri .= $_SERVER['HTTP_HOST'];
    header('Location: '.$uri.'/accueil');
});

/**
 * Routes de gestion du tableau de bord
 */
$router->group('/dashboard', function($router) {

    $router->get('/', function () {
        AuthMiddleware::handle();
        AdminMiddleware::handle();
        (new DashboardController)->index();
    });
});

/**
 * Routes de gestion de connexion
 */
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

$router->get('/logout', function() {
    AuthMiddleware::handle();
    (new LoginController)->logout();
});

/**
 * Routes de gestion des employés
 */
$router->group('/employees', function ($router) {

    $router->get('/:id', function(int $id, Response $response) {
        AuthMiddleware::handle();
        header('Content-Type: application/json');
        return json_encode((new EmployeeModel)->findEmployeeById($id)->toArray());
    });
});

/**
 * Routes de gestion des agences
 */
$router->group('/agencies', function($router) {

    $router->post('/create', function() {
        AuthMiddleware::handle();
        AdminMiddleware::handle();
        (new AgenciesController)->createNewAgency($_POST);
        header('Location: /dashboard/#agencies');
    });

    $router->delete('/:id', function(int $id) {
        AuthMiddleware::handle();
        AdminMiddleware::handle();
        (new DashboardController)->deleteAgency($id);       
    });
});

/**
 * Routes de gestion des trajets
 */
$router->group(('/travels'), function($router) {

    $router->get('/:id', function(int $id, Response $response) {
        AuthMiddleware::handle();
        header('Content-Type: application/json');
        return json_encode((new TravelsControllers)->getTravelById($id)->toArray());
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

    $router->delete('/delete/:id', function(int $id) {
        AuthMiddleware::handle();
        (new TravelsControllers)->deleteTravel($id);
    });
});

/**
 * Routes publiques
 */
$router->get('/accueil', function () {
    (new HomepageController)->index();
});

$router->notFound(function() {
    (new NotFoundController)->index();
});

$router->run();