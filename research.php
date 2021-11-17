<?php

require_once 'connec.php';
require_once 'index.html';

session_start();

const BR = '<br> <br>';

$_SESSION["cart"] = [];

?>

<h1>Recherche</h1>
<form action="" method="get">
    <label for="search">Je souhaite réserver : </label>
    <input type="text" name="search" placeholder="Céline Dion" value=<?php if (isset($_GET["search"])) { echo $_GET["search"]; } ?>>
    <label for="search">le : </label>
    <input type="date" name="searchDate" value=<?php if (isset($_GET["searchDate"])) { echo $_GET["searchDate"]; } ?>>
    <label for="searchPrice">Prix maximum par place : </label>
    <select name="searchPrice">
        <option value=100>100 €</option>
        <option value=50>50 €</option>
        <option value=20>20 €</option>
        <option value=5>5 €</option>
    </select>
    <input type="submit" value="Rechercher"><br><br>
</form>

<style>
body {
  color: #A69CAC;
}

table {
  font-family: arial, sans-serif;
  color: #F1DAC4;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #474973;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
  color: #161B33;
}
</style>

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

$search = $_GET["search"];
$price = $_GET["searchPrice"];
$date = $_GET["searchDate"];

if (!$date) {
    $query = "
        SELECT Event.name as event, Genre.name as genre, Artist.name as artist, Venue.name as venue, City.name as city, date, price 
        FROM Session 
            JOIN Event ON Event_idEvent = idEvent 
            JOIN Venue ON Venue_idVenue = idVenue 
                JOIN City ON City_idCity = idCity 
            JOIN Performance 
                JOIN Artist ON Artist_idArtist = idArtist 
                JOIN Genre ON Genre_idGenre = idGenre
        WHERE price <= '$price'
        HAVING INSTR(event,'$search') OR INSTR(genre,'$search') OR INSTR(artist,'$search') OR INSTR(venue,'$search') OR INSTR(city,'$search')
    ";
} else {
    $query = "
        SELECT Event.name as event, Genre.name as genre, Artist.name as artist, Venue.name as venue, City.name as city, date, price 
        FROM Session 
            JOIN Event ON Event_idEvent = idEvent 
            JOIN Venue ON Venue_idVenue = idVenue 
                JOIN City ON City_idCity = idCity 
            JOIN Performance 
                JOIN Artist ON Artist_idArtist = idArtist 
                JOIN Genre ON Genre_idGenre = idGenre
        WHERE price <= '$price' AND DATE(date) = '$date'
        HAVING INSTR(event,'$search') OR INSTR(genre,'$search') OR INSTR(artist,'$search') OR INSTR(venue,'$search') OR INSTR(city,'$search')
    ";
}

$statement = $pdo->query($query);
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
                <form action="" method="post"> <?php
                    if (in_array($event["event"], $_SESSION["cart"])) { ?>
                        <button disabled>Already in your cart</button> <?php
                    } else { ?>
                    <button name="cart" value="<?php echo $row["title"]; ?>" type="submit">Add to cart</button> <?php
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