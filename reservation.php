<?php

require_once 'loginRequired.php';
require_once 'connec.php';
require_once 'header.php';
require_once 'index.html';

const BR = '<br> <br>';

$userName = $_SESSION['user_login'];

$query = "
SELECT ticketsQuantity, Session.idSession as idSession, Session.capacity as capacity, Session.price as price, Session.date as date, Event.name as event
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

<table>
<tr>
    <th>Evénement</th>
    <th>Date</th>
    <th>Prix</th>
    <th>Nombre de places</th>
    <th>Modifier</th>
    <th>Annuler</th>
</tr>

<?php
foreach ($reservations as $reservation) { ?>
    <tr>
        <td><?php echo $reservation['event']; ?></td>
        <td><?php echo $reservation['date']; ?></td>
        <td><?php echo $reservation['price']; ?></td>
        <td><?php echo $reservation['ticketsQuantity']; ?></td>
        <?php if ($currentDate >= $reservation['date']) { ?>
            <td>Cette réservation n'est plus modifiable</td>
            <td>Cette réservation n'est plus modifiable</td>
        <?php } else { ?>
            <td>
                <form method="post" action="cart.php" name="cart">
                    <label for="nbTickets">Nouveau nombre de places : </label>
                    <select name="nbTickets">
                        <?php
                        $capacity = (int) $reservation['capacity'];
                        for($i=1; $i<=$capacity && $i<=10; $i++) { ?>
                        <option <?php if ($reservation['ticketsQuantity'] == $i){ ?> selected="selected" <?php } ?> value=<?php echo $i-$reservation['ticketsQuantity'] ?>><?php echo $i ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="idSession" value="<?php echo $reservation["idSession"]; ?>" />
                    <button type="submit">Modifier</button>
                </form>
            </td>
            <td>
                <form method="post" action="cart.php" name="cart">
                    <input type="hidden" name="Cancellation" value="TRUE"/>
                    <input type="hidden" name="nbTickets" value="<?php echo -$reservation['ticketsQuantity']; ?>" />
                    <input type="hidden" name="idSession" value="<?php echo $reservation["idSession"]; ?>" />
                    <button type="submit">Annuler cette réservation</button>
                </form>
            </td>
        <?php } ?>
    </tr>
<?php } ?>
</table>
<!-- 
rendre des places seulement si assurance
gérer l'affichage de quantités négatives dans le panier => changer la phrase et afficher l'opposé
    => impossible de gérer les quanntités négatives en get via le panier, on pourrait revendre des places qu'on ne possède pas
        => on peut potentiellement acheter plus de place que la capacité de l'envent =>>> il faut tout passer en post :/
gérér le zéro
l'annulation doit passer par un autre formulaire -->