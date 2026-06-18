<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\EmployeeModel;

class LoginController extends Controller {

    public function index() {
        if(isset($_SESSION['user'])) {
            header('Location: /');
            exit;
        }
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

        if(!$passwordMatch || !$employee) {
            $error = "Email ou mot de passe incorrect !";
            $this->render('Connexion', 'login', compact('error'));
            exit;
        }
            
        $_SESSION['user'] = [
            'id' => $employee->getId(),
            'role' => $employee->getRole()
        ];
    
        header('Location: /');
    }

    public function logout(): void {
        session_destroy();
        header('Location: /');
    }

}