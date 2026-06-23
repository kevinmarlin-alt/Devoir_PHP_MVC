<?php 

use App\Entity\Employee;

/** @var Employee $employee */

?>

<header class="mb-4">
    <nav class="navbar bg-body-primary">
        <div class="container-fluid">
            <?php if(!isset($_SESSION['user'])): ?>
                <a class="navbar-brand">Touche pas au klaxon</a>
                <a href="/login" class="btn btn-primary">Connexion</a>
            <?php else: ?>
                    <?php switch($_SESSION['user']['role']): 
                            case 'ADMIN': ?>
                                <a href="/dashboard" class="navbar-brand">Touche pas au klaxon</a>
                                <div class="d-flex align-items-center gap-4">
                                    <a href="/dashboard/#users" class="btn btn-secondary">Utilisateurs</a>
                                    <a href="/dashboard/#agencies" class="btn btn-secondary">Agences</a>
                                    <a href="/dashboard/#travels" class="btn btn-secondary">trajets</a>
                                    <p class="align-self-center">Bonjour <?= $employee->getFullname() ?></p>
                                    <a href="/logout" class="btn btn-primary">Déconnexion</a>
                                </div> 
                            <?php break;
                            case 'USER': ?>
                                <a class="navbar-brand">Touche pas au klaxon</a>
                                <div class="d-flex align-items-center gap-4">
                                    <a href="/travels/create" class="btn btn-secondary">Créer un trajet</a>
                                    <p class="align-self-center">Bonjour <?= $employee->getFullname() ?></p>
                                    <a href="/logout" class="btn btn-primary">Déconnexion</a>
                                </div>
                            <?php break;
                            endswitch; ?>
                        
            <?php endif; ?>        
        </div>
    </nav>
</header>