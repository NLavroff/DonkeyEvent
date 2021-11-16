<?php

require_once 'connec.php';

session_start();

const BR = '<br> <br>';

// Create connection to database
$pdo = new \PDO(DSN, USER, PASS, [
    PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC
]);
?>

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

<?php
$errors = [];
$firstname = $lastname = "";

$query = "SELECT * FROM Event";
$statement = $pdo->query($query);
$events = $statement->fetchAll(); 

?>

<ul>
    <?php foreach($events as $event): ?>
    <li><?php echo $event['name'] . ' ' . $event['description']; ?></li>
    <?php endforeach ?>
</ul>