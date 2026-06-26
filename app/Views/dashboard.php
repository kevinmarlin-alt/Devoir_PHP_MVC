<?php 
use App\Entity\Travel;
use App\Entity\Agency;
use App\Entity\Employee;

/** @var Employee[]|array $employees */
/** @var Employee $employee */
/** @var Agency[] $agencies */
/** @var Travel[] $travels */

?>

<script src="/assets/javascript/travel.table.js" defer></script>
<script src="/assets/javascript/agencies.table.js" defer></script>
<script src="/assets/javascript/agencies.create.js" defer></script>
<script src="/assets/javascript/employee.update.js" defer></script>

<nav class="mb-4">
    <a href="/">Acceuil</a>
</nav>

<h2>Tableau de bord</h2>
<p class="mb-4" >Ce tableau de bord permet la gestion des informations pour les tarjets et leurs relations.</p>

<div class="row mb-4">
    <section class="card p-4" id="travels">
        <h3>Trajets</h3>
        <?php if($travels): ?>
            <table class="table table-bordered text-center table-sm table-striped">
                <tr class="table-primary">
                    <th>ID</th>
                    <th>Départ</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Arrivée</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Places</th>
                    <th>Propriétaire</th>
                    <th></th>
                </tr>
                <?php foreach($travels as $travel): ?>
                    <tr data-id-travel=<?= $travel->getId() ?>>
                        <td><?= $travel->getId() ?></td>
                        <td><?= $travel->getDepartureAgency() ?></td>
                        <td><?= $travel->getDepartureAt()->format('d/m/Y') ?></td>
                        <td><?= $travel->getDepartureAt()->format('H:i') ?></td>
                        <td><?= $travel->getArrivalAgency() ?></td>
                        <td><?= $travel->getArrivalAt()->format('d/m/Y') ?></td>
                        <td><?= $travel->getArrivalAt()->format('H:i') ?></td>
                        <td><?= $travel->getSeatsAvailable() ?></td>
                        <td>
                            <?php foreach($employees as $employee): ?>
                                <?php if($employee->getId() === $travel->getEmployeeId()): ?>
                                    <?= $employee->getFullname() ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <!-- Delete button -->
                            <a href="#" class="table__travel--delete text-decoration-none ">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="icon icon-delete">
                                    <!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                                    <path fill="rgb(0, 0, 0)" d="M166.2-16c-13.3 0-25.3 8.3-30 20.8L120 48 24 48C10.7 48 0 58.7 0 72S10.7 96 24 96l400 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-96 0-16.2-43.2C307.1-7.7 295.2-16 281.8-16L166.2-16zM32 144l0 304c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-304-48 0 0 304c0 8.8-7.2 16-16 16L96 464c-8.8 0-16-7.2-16-16l0-304-48 0zm160 72c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 176c0 13.3 10.7 24 24 24s24-10.7 24-24l0-176zm112 0c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 176c0 13.3 10.7 24 24 24s24-10.7 24-24l0-176z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p class="text-danger">Il y a actuellement aucun trajet enregistrée !</p>
        <?php endif; ?>
    </section>
</div>

<div class="row gap-4">
    <section class="col card p-4" id="users">
        <h3>Utilisateurs</h3>
        <?php if($employees): ?>
            <p>
                <a class="employees__updatePwdCollapse--Btn" data-bs-toggle="collapse" href="#employeesPasswordCollapse" role="button" aria-expanded="false" aria-controls="employeesPasswordCollapse">
                    Ajouter ou modifier un mot de passe
                </a>
            </p>
            <div class="collapse w-50" id="employeesPasswordCollapse">
                <div class="card card-body mb-4">
                    <form action="#" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label><br>
                                <select class="form-control" name="email" id="email" required >
                                    <option value="0" disabled>Sélectionner un email</option>
                                    <?php foreach($employees as $employee): ?>
                                        <option value="<?= $employee->getId() ?>"><?= $employee->getEmail() ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="pwd" class="form-label">Nouveau mot de passe</label>
                                <input type="password" class="form-control" name="pwd" id="pwd" required >
                                <div class="invalid-feedback">
                                    Le mot de passe ne peut être vide !
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="idEmployee" id="idEmployee" value="<?= $employee->getiD() ?>">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </div>
            </div>
            <table class="table table-bordered text-center table-sm  table-striped">
                <tr class="table-primary">
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                </tr>
                <?php foreach($employees as $employee): ?>
                    <tr>
                        <td><?= $employee->getId() ?></td>
                        <td><?= $employee->getLastname() ?></td>
                        <td><?= $employee->getFirstname() ?></td>
                        <td><?= $employee->getPhone() ?></td>
                        <td><?= $employee->getEmail() ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p class="text-danger">Il y a actuellement aucun utilisateurs enregistré !</p>
        <?php endif; ?>
    </section>
    
    <section class="col-4 card p-4"  id="agencies">
        <h3>Agences</h3>
        <p>
            <a class="" data-bs-toggle="collapse" href="#createAgencyCollapse" role="button" aria-expanded="false" aria-controls="createAgencyCollapse">
                Créer une nouvelle agence
            </a>
        </p>
        <div class="collapse" id="createAgencyCollapse">
            <div class="card card-body mb-4">
                <form action="/agencies/create" method="post" id="agency-form"  class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="city" class="form-label">Nom de la ville de l'agence</label>
                        <input type="text" class="form-control" name="city" id="city">
                        <div class="invalid-feedback">
                            Le nom de la ville ne peut être vide ou identique à une agence existante !
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
        <?php if($agencies): ?>
            <table class="table table-bordered text-center table-sm table-striped">
                <tr class="table-primary">
                    <th>ID</th>
                    <th>Ville</th>
                    <th></th>
                </tr>
                <?php foreach($agencies as $agency): ?>
                    <tr data-id-agency="<?= $agency->getId() ?>">
                        <td><?= $agency->getId() ?></td>
                        <td><?= $agency->getCity() ?></td>
                        <td>
                            <!-- Update button -->
                            <a href="/agencies/update/?id=<?= $agency->getId() ?>"  class="text-decoration-none">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon">
                                    <!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                                    <path fill="rgb(0, 0, 0)" d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152L0 424c0 48.6 39.4 88 88 88l272 0c48.6 0 88-39.4 88-88l0-112c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 112c0 22.1-17.9 40-40 40L88 464c-22.1 0-40-17.9-40-40l0-272c0-22.1 17.9-40 40-40l112 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L88 64z"/>
                                </svg>
                            </a>
                            <!-- Delete button -->
                            <a href="#" class="table__agency--delete text-decoration-none "  data-bs-toggle="modal" data-bs-target="#agencyDeleteModal">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="icon icon-delete">
                                    <!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                                    <path fill="rgb(0, 0, 0)" d="M166.2-16c-13.3 0-25.3 8.3-30 20.8L120 48 24 48C10.7 48 0 58.7 0 72S10.7 96 24 96l400 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-96 0-16.2-43.2C307.1-7.7 295.2-16 281.8-16L166.2-16zM32 144l0 304c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-304-48 0 0 304c0 8.8-7.2 16-16 16L96 464c-8.8 0-16-7.2-16-16l0-304-48 0zm160 72c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 176c0 13.3 10.7 24 24 24s24-10.7 24-24l0-176zm112 0c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 176c0 13.3 10.7 24 24 24s24-10.7 24-24l0-176z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <!-- Confirmation delete agency Modal -->
            <div class="modal fade" data-id-agency="" id="agencyDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close agency__modal--cancel" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Attention si vous supprimer cette agence, les trajets associés seront supprimé automatiquement !</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary agency__modal--cancel" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-danger agency__modal--confirm">Confirmer</button>
                    </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p class="text-danger">Il y a actuellement aucune agence enregistrée !</p>
        <?php endif; ?>
    </section>
</div>

