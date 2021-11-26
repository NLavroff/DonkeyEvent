<?php

require_once 'connec.php';
require_once 'header.php';
require_once 'research.php';

const BR = '<br> <br>';

$_SESSION["cart"] = [];
date_default_timezone_set('Europe/Paris');
$currentDate = date("Y-m-d H:i:s");

?>

<h2>Résultats</h2>
<table>
    <tr>
        <th>Evénement</th>
        <th>Genre</th>
        <th>Artiste</th>
        <th>Lieu</th>
        <th>Ville</th>
        <th>Date</th>
        <th>Prix</th>
        <th>Réserver</th>
    </tr>

<?php

$search = trim($_GET["search"]);
$price = filter_var($_GET["searchPrice"], FILTER_SANITIZE_NUMBER_INT);
$date = trim($_GET["searchDate"]);

if (!$date) {
    $query = "
        SELECT idSession, Event.name as event, Genre.name as genre, Artist.name as artist, Venue.name as venue, City.name as city, date, price 
        FROM Session 
            JOIN Event ON Event_idEvent = idEvent 
            JOIN Venue ON Venue_idVenue = idVenue 
                JOIN City ON City_idCity = idCity 
            JOIN Performance ON Performance.Event_idEvent = Event.idEvent
                JOIN Artist ON Artist_idArtist = idArtist 
                JOIN Genre ON Genre_idGenre = idGenre
        WHERE price <= :price AND DATE(date) >= '$currentDate'
        HAVING INSTR(event, :search) OR INSTR(genre, :search) OR INSTR(artist, :search) OR INSTR(venue, :search) OR INSTR(city, :search)
    ";
} else {
    $query = "
        SELECT idSession, Event.name as event, Genre.name as genre, Artist.name as artist, Venue.name as venue, City.name as city, date, price 
        FROM Session 
            JOIN Event ON Event_idEvent = idEvent
            JOIN Venue ON Venue_idVenue = idVenue
                JOIN City ON City_idCity = idCity
            JOIN Performance ON Performance.Event_idEvent = Event.idEvent
                JOIN Artist ON Artist_idArtist = idArtist
                JOIN Genre ON Genre_idGenre = idGenre
        WHERE price <= :price AND DATE(date) = :date
        HAVING INSTR(event, :search) OR INSTR(genre, :search) OR INSTR(artist, :search) OR INSTR(venue, :search) OR INSTR(city, :search)
    ";
}

$statement = $pdo->prepare($query);
$statement->bindValue(':search', $search, \PDO::PARAM_STR);
$statement->bindValue(':price', $price, \PDO::PARAM_INT);
$statement->bindValue(':date', $date, \PDO::PARAM_STR);
$statement->execute();
$events = $statement->fetchAll();

if ($statement->rowCount() > 0) {
    foreach($events as $event): ?>
        <tr>
            <td><?php echo $event["event"]; ?></td>
            <td><?php echo $event["genre"]; ?></td>
            <td><?php echo $event["artist"]; ?></td>
            <td><?php echo $event["venue"]; ?></td>
            <td><?php echo $event["city"]; ?></td>
            <td><?php echo $event["date"]; ?></td>
            <td><?php echo $event["price"]; ?></td>
            <td>
                <form action="cart.php" method="get"> <?php
                    if (in_array($event["idSession"], $_SESSION["cart"])) { ?>
                        <button disabled>Already in your cart</button> <?php
                    } else { ?>
                    <button name="idSession" value="<?php echo $event["idSession"]; ?>" type="submit">Add to cart</button> <?php
                    } ?>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
<?php } else { ?>
<span>Nous n'avons pas trouvé d'évènement correspondant à votre recherche</span>
<?php } ?>
</table>
<br>

<?php
require_once 'footer.php';