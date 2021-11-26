<?php

require_once 'connec.php';

const BR = '<br> <br>';

if (!isset($_GET['idEvent'])) {
    header('location: index.php');
}

require_once 'header.php';

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
        <img src="Cover/<?php echo $event['cover']; ?>">
    </div>
    <div class="row">
        <h1><?php echo $event['name']; ?></h1>
    </div>
    <div class="row">
        <?php echo $event['description']; ?>
    </div>
<?php } ?>

<h4>Réserver un spectacle</h4>

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

<div class="table-responsive">
<table class="table table-hover">
    <thead class="thead-light">
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Date</th>
            <th scope="col">Ville</th>
            <th scope="col">Salle</th>
            <th scope="col">Tarif</th>
            <th scope="col">Réserver</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php
            foreach ($sessions as $session) { ?>
                <th scope="row"><?php echo $session['event']; ?></td>
                <td><?php setlocale(LC_ALL, 'fr_FR'); echo date('j m Y  - H:i', strtotime($session['date'])); ?></td>
                <td><?php echo $session['city']; ?></td>
                <td><?php echo $session['venue']; ?></td>
                <td><?php echo $session['price']; ?>€</td>
                <?php if ($currentDate >= $session['date']) { ?>
                    <td>Cet événement est passé</td>
                <?php } else { ?>
                    <td>
                        <form method="post" action="cart.php" name="cart">
                            <label for="nbTickets">Nombre de places : </label>
                            <select name="nbTickets" class="form-select" >
                                <?php
                                $capacity = (int) $session['capacity'];
                                for ($i = 1; $i <= $capacity && $i <= 10; $i++) { ?>
                                    <option value=<?php echo $i ?>><?php echo $i ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="idSession" value="<?php echo $session["idSession"]; ?>" />
                            <button type="submit" class="btn btn-light">Ajouter au panier</button>
                        </form>
                    </td>
                <?php } ?>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>
</div>

<?php
require_once 'footer.php';