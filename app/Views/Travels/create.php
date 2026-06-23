<?php

use App\Entity\Agency;
use App\Entity\Employee;

/** @var Employee $employee */
/** @var Agency[] $agencies */

?>
<script src="/assets/javascript/travel.create.js" type="text/javascript" defer></script>
<nav class="mb-4">
    <a href="/">Accueil</a>
</nav>

<h2 class="mb-4">Créer un nouveau trajet</h2>

<form action="/travels/create" method="POST" class="needs-validation" novalidate>
    <div class="d-flex gap-4 mb-4">
        <fieldset class="w-50">
            <legend>Informations du trajet</legend>
            <div class="mb-3">
                <label class="form-label" for="departure_agency_id">Départ</label><br>
                <select class="form-control" name="departure_agency_id" id="departure_agency_id" required >
                    <?php foreach($agencies as $agency): ?>
                        <option value="<?= $agency->getId() ?>"><?= $agency->getCity() ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    L'agence de départ et l'agence d'arrivée ne peuvent être identique !
                </div>
            </div>
            <div class="mb-3">
                <div class="d-flex gap-2">
                    <div class="w-50">
                        <label class="form-label" for="departure_date">Date</label><br>
                        <input class="form-control datetime-js" type="date" name="departure_date" id="departure_date">
                    </div>
                    <div class="w-50">
                        <label class="form-label" for="departure_time">Heure</label><br>
                        <input class="form-control datetime-js" type="time" name="departure_time" id="departure_time">
                    </div>
                </div>
                <div class="datetime-feedback text-danger"></div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="arrival_agency_id">Arrivée</label><br>
                <select class="form-control"  name="arrival_agency_id" id="arrival_agency_id" required >
                    <?php foreach($agencies as $agency): ?>
                        <option value="<?= $agency->getId() ?>"><?= $agency->getCity() ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    L'agence de départ et l'agence d'arrivée ne peuvent être identique !
                </div>
            </div>
            <div class="mb-3">
                <div class="d-flex gap-2">
                    <div class="w-50">
                        <label class="form-label" for="arrival_date">Date</label><br>
                        <input class="form-control datetime-js" type="date" name="arrival_date" id="arrival_date">
                    </div>
                    <div class="w-50">
                        <label class="form-label" for="arrival_time">Heure</label><br>
                        <input class="form-control datetime-js" type="time" name="arrival_time" id="arrival_time">
                    </div>
                </div>
                <div class="datetime-feedback text-danger"></div>
            </div>
            <div>
                <label class="form-label" for="seats_total">Nombre total de places</label><br>
                <input
                    class="form-control"
                    type="number"
                    name="seats_total"
                    id="seats_total"
                    min="0"
                    required
                    >
            </div>
            <input
                class="form-control"
                type="hidden"
                name="employee_id"
                id="employee_id"
                value="<?= $_SESSION['user']['id'] ?>"
                >
        </fieldset>
        <fieldset class="w-50">
            <legend>Informations du propriétaire</legend>
            <div class="mb-3">
                <label class="form-label" for="firstname">Prénom</label><br>
                <input
                    class="form-control"
                    type="text"
                    name="firstname"
                    id="firstname"
                    value="<?= htmlspecialchars($employee->getFirstname()) ?>"
                    disabled
                    >
            </div>
            <div class="mb-3">
                <label class="form-label" for="lastname">Nom</label><br>
                <input class="form-control"
                    type="text"
                    name="lastname"
                    id="lastname"
                    value="<?= htmlspecialchars($employee->getLastname()) ?>"
                    disabled
                >
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Email</label><br>
                <input
                    class="form-control"
                    type="email"
                    name="email"
                    id="email"
                    value="<?= htmlspecialchars($employee->getEmail()) ?>"
                    disabled
                    >
            </div>
            <div class="mb-3">
                <label class="form-label" for="phone">Téléphone</label><br>
                <input
                    class="form-control"
                    type="tel"
                    name="phone"
                    id="phone"
                    value="<?= htmlspecialchars($employee->getPhone()) ?>"
                    disabled
                    >
            </div>
            
        </fieldset>
    </div>
    <input class="btn btn-primary" type="submit" value="Ajouter">
</form>