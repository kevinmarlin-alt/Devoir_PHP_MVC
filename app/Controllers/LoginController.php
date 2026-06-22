<?php
/**
 * Devoir PHP MCV
 * Site intranet pour la gestion de covoiturage des trajets entre agences
 *
 * @author Kevin Marlin
 * @version 1.0
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Models\EmployeeModel;
use App\Entity\Employee;

/**
 * Gestion de l'authentification
 */
class LoginController extends Controller {

    /**
     * Affiche la page de connexion
     * 
     * @return void
     */
    public function index(): void {
        if(isset($_SESSION['user'])) {
            header('Location: /');
            exit;
        }
        $this->render(
            'Connexion',
            'login'
        );
    }

    /**
     * Authentifie un utilisateur
     * 
     * @return void
     */
    public function login(): void {
        /** @var string $email */
        $email = $_POST["email"];
        
        /** @var string $password */
        $password = $_POST["password"];
     
        /** @var Employee|null $employee */
        $employee = (new EmployeeModel)->findEmployeeByEmail($email);
        
        if($employee === null) {
            $error = "Erreur lors de la récuperartion des données lié a cette adresse email !";
            $this->render('Connexion', 'login', compact('error'));
            exit;
        }

        $passwordMatch = password_verify($password, $employee->getPassword());
        if(!$passwordMatch) {
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

    /**
     * Déconnecte l'utilisateur
     * 
     * @return void
     */
    public function logout(): void {
        session_destroy();
        header('Location: /');
    }

}