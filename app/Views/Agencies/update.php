<script src="/assets/javascript/agency.update.js" type="text/javascript" defer></script>
<nav>
    <a href="/dashboard/#agencies">Retour</a>
</nav>
<h1 class="mb-4">Mettre à jour une agence</h1>
<form action="" class="w-50">
    <div class="mb-3">
        <label for="city" class="form-label">Nom de la ville de l'agence</label>
        <input class="form-control" type="text" name="city" id="city" value="<?= $agency->getCity() ?>">
        <input type="hidden" name="id" value="<?= $agency->getId() ?>">
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>