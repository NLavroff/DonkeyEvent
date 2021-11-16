<?php

require_once 'connec.php';

session_start();

const BR = '<br> <br>';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Donkey Event</title>
</head>
<body>
 
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" 
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" 
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>

<h1>Recherche</h1>
<form>
    <label for="search">Je souhaite réserver</label>
    <input type="textarea" value="Céline Dion">
    <input type="submit" value="Rechercher">
</form>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
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

$query = "SELECT * FROM Session";
$statement = $pdo->query($query);
$events = $statement->fetchAll();

var_dump($events);

/* $query = "SELECT title, author.name as author, genre.name as genre, publisher.name as publisher FROM book JOIN author ON author = author.id JOIN genre ON genre = genre.id JOIN publisher ON publisher = publisher.id";
$result = $conn->query($query); */



if ($statement->rowCount() > 0) {
    foreach($events as $event): ?>
        <tr>
            <!-- <td><?php echo $event["event"]; ?></td>
            <td><?php echo $event["genre"]; ?></td>
            <td><?php echo $event["artist"]; ?></td>
            <td><?php echo $event["venue"]; ?></td>
            <td><?php echo $event["city"]; ?></td> -->
            <td><?php echo $event["date"]; ?></td>
            <td><?php echo $event["price"]; ?></td>
            <td>
                <form action="" method="post"> <?php
                    if (in_array($event["title"], $_SESSION["cart"])) { ?>
                        <button disabled>Already in your cart</button> <?php
                    } else { ?>
                    <button name="cart" value="<?php echo $row["title"]; ?>" type="submit">Add to cart</button> <?php
                    } ?>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    <?php }
?>
</table>
<br>


<ul>
    <?php foreach($events as $event): ?>
    <li><?php echo $event['date'] . ' : ' . $event['price']; ?></li>
    <?php endforeach ?>
</ul>