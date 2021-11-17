<?php

require_once 'connec.php';
require_once 'index.html';

session_start();

const BR = '<br> <br>';

$_SESSION["cart"] = [];
$currentDay = date("d");
$currentMonth = date("m");
$currentYear = date("Y");
$currentDate = $currentYear . "-" . $currentMonth . "-" . $currentDay;
var_dump($currentDate);

?>

<h1>Recherche</h1>
<form action="" method="get">
    <label for="search">Je souhaite réserver : </label>
    <input type="text" name="search" placeholder="Céline Dion">
    <label for="search">le : </label>
    <input type="date" name="searchDate" value="<?php echo $currentDate ?>">
    <label for="searchPrice">Prix maximum par place : </label>
    <select name="searchPrice">
        <option value=100>100 €</option>
        <option value=50>50 €</option>
        <option value=20>20 €</option>
    </select>
    <input type="submit" value="Rechercher"><br><br>
</form>

<?php
var_dump($_GET);
?>

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
echo $search;
echo $price;
echo $date;
$query = "
    SELECT Event.name as event, Genre.name as genre, Artist.name as artist, Venue.name as venue, City.name as city, date, price 
    FROM Session 
        JOIN Event ON Event_idEvent = idEvent 
        JOIN Venue ON Venue_idVenue = idVenue 
            JOIN City ON City_idCity = idCity 
        JOIN Performance 
            JOIN Artist ON Artist_idArtist = idArtist 
            JOIN Genre ON Genre_idGenre = idGenre
    HAVING INSTR(event,'$search') or INSTR(genre,'$search') or INSTR(artist,'$search') or INSTR(venue,'$search') or INSTR(city,'$search')
    and price <= '$price'
    and date = '$date'
";
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
<span>Nous n'avons pas trouvé d'évènement correspondant à votre recherche : <?php echo $search; ?></span>
<?php } ?>
</table>
<br>