<?php

require_once 'loginRequired.php';
require_once 'connec.php';
require_once 'header.php';

const BR = '<br> <br>';

$userName = $_SESSION['user_login'];

$query = "
SELECT insurance, ticketsQuantity, Session.idSession as idSession, Session.capacity as capacity, Session.price as price, Session.date as date, Event.name as event
FROM Reservation
JOIN Session ON Session_idSession = idSession
    JOIN Event ON Event_idEvent = idEvent
WHERE EXISTS (
    SELECT Name
    FROM User
    WHERE User.idUser = Reservation.User_idUser
    AND User.name = '$userName'
)
ORDER BY date
";

$statement = $pdo->query($query);
$reservations = $statement->fetchAll();
date_default_timezone_set('Europe/Paris');
$currentDate = date("Y-m-d H:i:s");

?>
<div class="p-5 text-center" style="background-color: #0D0C1D;">
    <h1 class="mb-3">MES RÉSERVATIONS</h1>
</div>

<div class="container">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-light">

                <tr>
                    <th scope="col">Evénement</th>
                    <th scope="col">Date</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Nombre de places</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Annuler</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($reservations as $reservation) { ?>
                    <tr>
                        <td><?php echo $reservation['event']; ?></td>
                        <td><?php echo $reservation['date']; ?></td>
                        <td><?php echo $reservation['price'] . '€'; ?></td>
                        <td><?php echo $reservation['ticketsQuantity']; ?></td>
                        <?php if ($currentDate >= $reservation['date']) { ?>
                            <td>Cet événement a déjà eu lieu</td>
                            <td>Cet événement a déjà eu lieu</td>
                        <?php } else if (0 == $reservation['insurance']) { ?>
                            <td><span class="alert-message">Cette réservation n'est pas modifiable</span></td>
                            <td><span class="alert-message">Cette réservation n'est pas annulable</span></td>
                        <?php } else { ?>
                            <td>
                                <form method="post" action="cart.php" name="cart">
                                    <label for="nbTickets">Nouveau nombre de places : </label>
                                    <select name="nbTickets">
                                        <?php
                                        $capacity = (int) $reservation['capacity'];
                                        for ($i = 1; $i <= $capacity && $i <= 10; $i++) { ?>
                                            <option <?php if ($reservation['ticketsQuantity'] == $i) { ?> selected="selected" <?php } ?> value=<?php echo $i - $reservation['ticketsQuantity'] ?>><?php echo $i ?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="hidden" name="insurance" value="TRUE" />
                                    <input type="hidden" name="idSession" value="<?php echo $reservation["idSession"]; ?>" />
                                    <button type="submit">Modifier</button>
                                </form>
                            </td>
                            <td>
                                <form method="post" action="cart.php" name="cart">
                                    <input type="hidden" name="insurance" value="TRUE" />
                                    <input type="hidden" name="cancellation" value="TRUE" />
                                    <input type="hidden" name="nbTickets" value="<?php echo -$reservation['ticketsQuantity']; ?>" />
                                    <input type="hidden" name="idSession" value="<?php echo $reservation["idSession"]; ?>" />
                                    <button type="submit"><span class="alert-message">Annuler cette réservation</span></button>
                                </form>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
        </table>
    </div>
</div>
<?php
require_once 'footer.php';
