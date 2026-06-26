<?php 

use App\Entity\Agency;

/** @var Agency $agency */

?>

<script src="/assets/javascript/agency.update.js" defer></script>
<nav class="mb-4">
    <a href="/dashboard/#agencies">Retour</a>
</nav>
<h2 class="mb-4">Mettre à jour une agence</h2>
<form action="#" class="w-50">
    <div class="mb-3">
        <label for="city" class="form-label">Nom de la ville de l'agence</label>
        <input class="form-control" type="text" name="city" id="city" value="<?= $agency->getCity() ?>">
        <input type="hidden" name="id" value="<?= $agency->getId() ?>">
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>