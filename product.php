<?php

require_once 'connec.php';
require_once 'header.php';
require_once 'index.html';

const BR = '<br> <br>';

if (!isset($_GET['idEvent'])) {
    header('location: index.php');
}

$idEvent = $_GET['idEvent'];
$query = "SELECT * FROM Event WHERE idEvent =" . $idEvent;
$statement = $pdo->query($query);
$events = $statement->fetchAll();
$query = $query . "WHERE idEvent=" . $idEvent;
date_default_timezone_set('Europe/Paris');
$currentDate = date("Y-m-d H:i:s");

?>

<div class="container">
    <div class="row">
        <?php foreach ($events as $event) { ?>
    </div>
    <div class="row">
        <?php echo $event['cover']; ?>
        Cover
    </div>
    <div class="row">
        <h1><?php echo $event['name']; ?></h1>
    </div>
    <div class="row">
        <?php echo $event['description']; ?>
    </div>
<?php } ?>
</div>

<div class="container">
    <div class="row">
        <h4>Réserver un spectacle</h4>
    </div>
</div>

<?php
$query = "
    SELECT capacity, Event.name as event, Genre.name as genre, Artist.name as artist, Venue.name as venue, City.name as city, date, price, idSession
    FROM Session
        JOIN Event ON Event_idEvent = idEvent
            JOIN Performance ON Performance.Event_idEvent = idEvent
                JOIN Artist ON Artist_idArtist = idArtist
                JOIN Genre ON Genre_idGenre = idGenre
        JOIN Venue ON Venue_idVenue = idVenue
            JOIN City ON City_idCity = idCity
    WHERE idEvent =" . $idEvent;
$statement = $pdo->query($query);
$sessions = $statement->fetchAll();
?>

<table>
    <tr>
        <th>Nom</th>
        <th>Catégorie</th>
        <th>Date</th>
        <th>Ville</th>
        <th>Salle</th>
        <th>Tarif</th>
        <th>Réserver</th>
    </tr>

    <tr>
        <?php
        foreach ($sessions as $session) { ?>
            <td><?php echo $session['event']; ?></td>
            <td><?php echo $session['genre']; ?></td>
            <td><?php echo $session['date']; ?></td>
            <td><?php echo $session['city']; ?></td>
            <td><?php echo $session['venue']; ?></td>
            <td><?php echo $session['price']; ?>€</td>
            <?php if ($currentDate >= $session['date']) { ?>
                <td>Cette événement est passé</td>
            <?php } else { ?>
                <td>
                    <form method="GET" action="cart.php" name="cart">
                        <label for="nbTickets">Nombre de places : </label>
                        <select name="nbTickets">
                            <?php
                            $capacity = (int) $session['capacity'];
                            for ($i = 1; $i <= $capacity; $i++) { ?>
                                <option value=<?php echo $i ?>><?php echo $i ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="idSession" value="<?php echo $session["idSession"]; ?>" />
                        <button type="submit">Ajouter au panier</button>
                    </form>
                </td>
            <?php } ?>
    </tr>
<?php } ?>
</table>