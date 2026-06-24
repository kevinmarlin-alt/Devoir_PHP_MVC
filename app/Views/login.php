<?php
/** @var string|null $error */
?>

<div class="d-flex justify-content-center">
    <div class="card w-50">
        <div class="card-body">
            <h2 class="card-title">Connexion</h2>
            <p>Si c'est votre première connexion, veuillez contacter votre administareur afin de vous fournir votre mot de passe personnel.</p>
            <form action="/login" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label><br>
                    <input type="email" name="email" id="email" class="form-control" value="arthur.henry@email.fr">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Mot de passe</label><br>
                    <input type="password" name="password" id="password" class="form-control" value="Test">
                </div>
                <input type="submit" value="Connexion" class="btn btn-primary">
            </form>
            <!-- Message d'erreur de connexion -->
            <?php  if(isset($error)): ?>
                <p class="text-danger"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>