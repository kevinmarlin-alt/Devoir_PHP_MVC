<?php

error_reporting(E_ALL);

ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', 'php://stderr');

require __DIR__ . '/../vendor/autoload.php';

session_start();

require __DIR__ . "/../app/Routes/routes.php";