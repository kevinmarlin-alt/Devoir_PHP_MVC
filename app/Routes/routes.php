<?php

use App\Controllers\AgenciesController;
use App\Middlewares\AuthMiddleware;

use App\Controllers\HomepageController;
use App\Controllers\LoginController;
use App\Controllers\TravelsControllers;
use App\Controllers\DashboardController;
use App\Controllers\EmployeeController;
use App\Controllers\NotFoundController;
use App\Middlewares\AdminMiddleware;
use App\Models\EmployeeModel;
use App\Entity\Agency;

use Buki\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$router = new Router();

/**
 * Route d'entrée du site internet et redirection vers l'acceuil
 */
$router->get('/', function () {
    /** @var string $http */
    $http = $_SERVER['HTTP'];

    /** @var string $uri */
    $uri = "";
    if(!empty($http) && ('on' == $http)) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }

    /** @var string $http_host */
    $http_host = $_SERVER['HTTP_HOST'];

    $uri .= $http_host;
    header('Location: '.$uri.'/accueil');
});

/**
 * Routes de gestion du tableau de bord
 * 
 * @param Router $router
 */
$router->group('/dashboard', function(Router $router) {

    $router->get('/', function () {
        AuthMiddleware::handle();
        AdminMiddleware::handle();
        (new DashboardController)->index();
    });
});

/**
 * Routes de gestion de connexion
 * 
 * @param Router $router
 */
$router->group('/login', function(Router $router){
    
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
 * 
 * @param Router $router
 */
$router->group('/employees', function (Router $router) {

    $router->get('/:id', function(int $id, Response $response) {
        AuthMiddleware::handle();
        header('Content-Type: application/json');
        $employee = (new EmployeeModel)->findEmployeeById($id);

        if ($employee === null) {
            http_response_code(404);

            return json_encode([
                'error' => 'Employee not found'
            ]);
        }

        return json_encode($employee->toArray());
    });

    $router->put('/update/:id', function(int $id, Request $request) {
        AuthMiddleware::handle();
        AdminMiddleware::handle();
        
        /** @var array<string,string> $data */
        $data = json_decode($request->getContent(), true);

        (new EmployeeController)->updatePassword($id, $data);
        
    });
});

/**
 * Routes de gestion des agences
 * 
 * @param Router $router
 */
$router->group('/agencies', function(Router $router) {

    $router->get('/', function(Response $response) {
        AuthMiddleware::handle();
        AdminMiddleware::handle();
        header('Content-Type: application/json');

        $agencies = (new AgenciesController)->getAllAgencies();
    
        if ($agencies === []) {
            http_response_code(404);

            return json_encode([
                'error' => 'Agencies not found'
            ]);
        }

        $response = array_map(fn(Agency $agency) => $agency->toArray(), $agencies);
        return json_encode($response);

    });

    $router->post('/create', function(Request $request) {
        AuthMiddleware::handle();
        AdminMiddleware::handle();

        /** @var array{city:string} $data */
        $data = json_decode($request->getContent(), true);

        (new AgenciesController)->createNewAgency($data);
    });

    $router->delete('/:id', function(int $id) {
        AuthMiddleware::handle();
        AdminMiddleware::handle();
        (new AgenciesController)->deleteAgency($id);       
    });

    $router->get('/update/', function () {
        AuthMiddleware::handle();

        /** @var int $id */
        $id = $_GET['id'];

        (new DashboardController)->updateAgencyIndex($id);
    });

    $router->put('/update/:id', function (int $id, Request $request) {
        AuthMiddleware::handle();

        /** @var array{city: string} $data */
        $data = json_decode($request->getContent(), true);

        (new AgenciesController)->updateAgency($id, $data);
        
    });
});

/**
 * Routes de gestion des trajets
 * 
 * @param Router $router
 */
$router->group(('/travels'), function(Router $router) {

    $router->get('/:id', function(int $id, Response $response) {
        AuthMiddleware::handle();
        header('Content-Type: application/json');
        $travel = (new TravelsControllers)->getTravelById($id);
        if($travel === null) {
            return null;
        }
        return json_encode($travel->toArray());
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

        /** @var int $id */
        $id = $_GET['id'];

        (new TravelsControllers)->updateIndex($id);
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