<?php
namespace App\Core;

abstract class Controller {
    protected function render(string $title, string $view, array $vars = []) {
        extract($vars);
        require_once __DIR__ . "/../Views/Layouts/index.php";
    }
}