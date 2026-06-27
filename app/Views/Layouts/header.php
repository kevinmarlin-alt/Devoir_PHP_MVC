<?php 

use App\Entity\Employee;

/** @var Employee $employee */

?>

<header class="mb-4">

    <div class="container-lg">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <?php if(!isset($_SESSION['user'])): ?>
                    <h1>Touche pas au klaxon</h1>
                    <a href="/login" class="btn btn-primary">Connexion</a>
                <?php else: ?>
                        <?php
                        /** @var array<string,string> $user */
                        $user = $_SESSION['user'];
                        switch($user['role']):
                                case 'ADMIN': ?>
                                    
                                        <a href="/dashboard"><h1>Touche pas au klaxon</h1></a>
                                    
                                    <div class="d-flex align-items-center gap-4">
                                        <ul class="navbar-nav gap-4">
                                            <li class="nav-item">
                                                <a href="/dashboard/#users" class="btn btn-secondary">Utilisateurs</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="/dashboard/#agencies" class="btn btn-secondary">Agences</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="/dashboard/#travels" class="btn btn-secondary">Trajets</a>
                                            </li>
                                        </ul>
                                        <p class="mb-0">Bonjour <?= htmlspecialchars($employee->getFullname()) ?></p>
                                        <a href="/logout" class="btn btn-primary">Déconnexion</a>
                                    </div>
                                <?php break;
                                case 'USER': ?>
                                    <h1>Touche pas au klaxon</h1>
                                    <div class="d-flex align-items-center gap-4">
                                        <a href="/travels/create" class="btn btn-secondary">Créer un trajet</a>
                                        <p class="mb-0">Bonjour <?= htmlspecialchars($employee->getFullname()) ?></p>
                                        <a href="/logout" class="btn btn-primary">Déconnexion</a>
                                    </div>
                                <?php break;
                                endswitch; ?>
        
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>