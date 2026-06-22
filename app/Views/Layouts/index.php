<?php
/** @var string $view */
/** @var string $title */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site intranet pour la gestion des trajets de déplacement entre agences.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/styles/style.css">
    <title>Touche pas au klaxon - <?= $title ?></title>
</head>
<body>
    <div class="container-lg">
        <?php require __DIR__ . "/header.php" ?>
        
        <main class="container-lg my-4">
            <?php require __DIR__ . "/../" . $view . ".php" ?>
        </main>
            
        <?php require __DIR__ . "/footer.php" ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>