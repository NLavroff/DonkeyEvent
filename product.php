<?php

require_once 'connec.php';
require_once 'index.html';

session_start();

const BR = '<br> <br>';

$query = "SELECT * FROM Event";
$statement = $pdo->query($query);
$events = $statement->fetchAll();

$idEvent = $_GET['idEvent'];
$query = $query . "WHERE idEvent=" . $idEvent;

?>
<table>
<tr>
    <th>Titre</th>
    <th>Descriptif</th>
    <th>Cover</th>
</tr>
<tr>
<?php foreach ($events as $event) { ?>
    <td><?php echo $event['name']; ?></td>
    <td><?php echo $event['description']; ?></td>
    <td><?php echo $event['cover']; ?></td>
</tr>
<?php } ?>
</table>

<?php
$query = "SELECT Event.name as event, Session.price as price, Session.date as date, City.name as city, Venue.name as venue FROM Session, Event, City, Venue WHERE idEvent = $idEvent;";
$statement = $pdo->query($query);
$sessions = $statement->fetchAll();
?>

<table>
    <tr>
        <th>Nom</th>
        <th>Tarif</th>
        <th>Date</th>
        <th>Ville</th>
        <th>Salle</th>
        <th>Réserver</th>
    </tr>

    <tr>
<?php
    foreach ($sessions as $session) { ?>
        <td><?php echo $session['event']; ?></td>
        <td><?php echo $session['price']; ?></td>
        <td><?php echo $session['date']; ?></td>
        <td><?php echo $session['city']; ?></td>
        <td><?php echo $session['venue']; ?></td>
        <td> <form method="POST" action="cart.php" name="cart">
                <button type="submit">Ajouter au panier</button>
            </form></td>
    </tr>
<?php } ?>
</table>