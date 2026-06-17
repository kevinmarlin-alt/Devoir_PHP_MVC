<h2>Trajets disponible</h2>
<?php if(isset($travels) && $travels): ?>

    <p>Pour obtenir plus d'informations sur un trajet, veuillez vous connecter</p>
    <table class="table table-bordered text-center table-striped caption-top">
        <tr class="table-primary">
            <th>Départ</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Destination</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Places</th>
            <?php if(isset($_SESSION['user'])): ?>
                <th></th>
            <?php endif; ?>
        </tr>
        <?php foreach($travels as $travel): ?>
            <tr>
                <td><?= $travel->getDepartureAgency() ?></td>
                <td><?= $travel->getDepartureDate() ?></td>
                <td><?= $travel->getDepartureTime() ?></td>
                <td><?= $travel->getArrivalAgency() ?></td>
                <td><?= $travel->getArrivalDate() ?></td>
                <td><?= $travel->getArrivalTime() ?></td>
                <td><?= $travel->getSeatsAvailable() ?></td>
                <?php if(isset($_SESSION['user'])): ?>
                    <td>
                        <a href="">Read</a>
                        <?php if($travel->getEmployeeId() === $_SESSION['user']['id']): ?>
                            <a href="">Update</a>
                            <a href="">Delete</a>
                        <?php endif; ?>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Il y a aucun trajet actuellement disponible !</p>
<?php endif; ?>
