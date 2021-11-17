<?php

require_once 'connec.php';
require_once 'index.html';

session_start();

const BR = '<br> <br>';

$pdo = new \PDO(DSN, USER, PASS);

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
$query = "SELECT Event.name, Session.price, Session.date FROM Session, Event WHERE idEvent = $idEvent;";
$statement = $pdo->query($query);
$sessions = $statement->fetchAll();
?>

<table>
<tr>
    <th>Nom</th>
    <th>Tarif</th>
    <th>Date</th>
</tr>
<tr>
<?php
foreach ($sessions as $session) { ?>
    <td><?php echo $session['name']; ?></td>
    <td><?php echo $session['price']; ?></td>
    <td><?php echo $session['date']; ?></td>
</tr>
<?php } ?>
</table>