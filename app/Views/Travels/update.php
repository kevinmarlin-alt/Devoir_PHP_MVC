<?php 
use App\Entity\Travel;
use App\Entity\Agency;
use App\Entity\Employee;

/** 
 * @var Employee $employee 
 * @var Agency[] $agencies
 * @var Travel $travel
 * @var array<string,string> $user
 */

$user = $_SESSION['user'];
?>

<script src="/assets/javascript/travel.update.js" type="text/javascript" defer></script>
<nav class="mb-4">
    <a href="/">Accueil</a>
</nav>

<h2 class="mb-4">Mettre à jour le trajet</h2>

<form action="#" method="" class="needs-validation" novalidate>
    <div class="d-flex gap-4 mb-4">
        <fieldset class="w-50">
            <legend>Informations du trajet</legend>
            <div class="mb-3">
                <label class="form-label" for="departure_agency_id">Départ</label><br>
                <select class="form-control" name="departure_agency_id" id="departure_agency_id" required >
                    <?php foreach($agencies as $agency): ?>
                    
                        <?php if($travel->getDepartureAgency() === $agency->getCity()): ?>
                            <option value="<?= $agency->getId() ?>" selected ><?= $agency->getCity() ?></option>
                        <?php else: ?>
                            <option value="<?= $agency->getId() ?>"><?= $agency->getCity() ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    L'agence de départ et d'arrvié ne peuvent être identique !
                </div>
            </div>
            <div class="mb-3" >
                <div class="d-flex gap-2">
                    <div class="w-50">
                        <label class="form-label" for="departure_date">Date</label><br>
                        <input class="form-control datetime-js" type="date" name="departure_date" id="departure_date" value="<?= $travel->getDepartureAt()->format('Y-m-d') ?>" required>
                    </div>
                    <div class="w-50">
                        <label class="form-label" for="departure_time">Heure</label><br>
                        <input class="form-control datetime-js" type="time" name="departure_time" id="departure_time" value="<?= $travel->getDepartureAt()->format('H:i') ?>" required>
                    </div>
                </div>
                <div class="datetime-feedback"></div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="arrival_agency_id">Arrivée</label><br>
                <select class="form-control"  name="arrival_agency_id" id="arrival_agency_id" required >
                    <?php foreach($agencies as $agency): ?>
                        <?php if($travel->getArrivalAgency() === $agency->getCity()): ?>
                            <option value="<?= $agency->getId() ?>" selected ><?= $agency->getCity() ?></option>
                        <?php else: ?>
                            <option value="<?= $agency->getId() ?>"><?= $agency->getCity() ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    L'agence de départ et d'arrvié ne peuvent être identique !
                </div>
            </div>
            <div class="mb-3" >
                <div class="d-flex gap-2">
                    <div class="w-50">
                        <label class="form-label" for="arrival_date">Date</label><br>
                        <input class="form-control datetime-js" type="date" name="arrival_date" id="arrival_date" value="<?= $travel->getArrivalAt()->format('Y-m-d') ?>" required>
                    </div>
                    <div class="w-50">
                        <label class="form-label" for="arrival_time">Heure</label><br>
                        <input class="form-control datetime-js" type="time" name="arrival_time" id="arrival_time" value="<?= $travel->getArrivalAt()->format('H:i') ?>" required>
                    </div>
                </div>
                <div class="datetime-feedback feedback"></div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="seats_available">Nombre de places disponible</label><br>
                <input
                    class="form-control"
                    type="number"
                    name="seats_available"
                    id="seats_available"
                    min="0"
                    max="<?= $travel->getSeatsTotal() ?>"
                    value="<?= $travel->getSeatsAvailable() ?>"
                    required
                    >
                <div class="invalid-feedback">
                    Le nombre de places disponible ne peut être suppérieur au nombre de places total !
                </div>
            </div>
            <div>
                <label class="form-label" for="seats_total">Nombre total de places</label><br>
                <input
                    class="form-control"
                    type="number"
                    name="seats_total"
                    id="seats_total"
                    min="0"
                    value="<?= $travel->getSeatsTotal() ?>"
                    required
                    >
            </div>
            <input
                class="form-control"
                type="hidden"
                name="id"
                id="id"
                value="<?= $travel->getId() ?>"
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
            <input
                class="form-control"
                type="hidden"
                name="employee_id"
                id="employee_id"
                value="<?= $user['id'] ?>"
                >
            
        </fieldset>
    </div>
    <input class="btn btn-primary" type="submit" value="Mettre à jour">
</form>