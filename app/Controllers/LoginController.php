<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\EmployeeModel;

class LoginController extends Controller {

    public function index() {
        $this->render(
            'Connexion',
            'login'
        );
    }

    public function login(): void {
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        $employee = (new EmployeeModel)->findEmployeeByEmail($email);
        $passwordMatch = password_verify($password, $employee->getPassword());
        //$passwordMatch = $password === $employee->getPassword();
        var_dump($password, $employee->getPassword(), $passwordMatch);
        if(!$passwordMatch || !$employee) {
            $error = "Email ou mot de passe incorrect !";
            $this->render('Connexion', 'login', compact('error'));
            exit;
        }
            
        $_SESSION['user'] = $employee->getId();
        var_dump($_SESSION);
    
        header('Location: /');
    }

}