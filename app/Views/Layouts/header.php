<header class="mb-4">
    <nav class="navbar bg-body-primary">
        <div class="container-fluid">
            <a class="navbar-brand">Touche pas au klaxon</a>
            <?php if(isset($_SESSION['user'])): ?>
                <div class="d-flex align-items-center gap-4">
                    <a href="/travels/create" class="btn btn-secondary">Créer un trajet</a>
                    <p class="align-self-center">Bonjour <?= $employee->getFullname() ?></p>
                    <a href="/logout" class="btn btn-primary">Déconnexion</a>
                </div> 
            <?php else: ?>
                <a href="/login" class="btn btn-primary">Connexion</a>
            <?php endif; ?>        
        </div>
    </nav>
</header>