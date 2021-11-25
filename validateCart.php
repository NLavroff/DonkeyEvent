<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'loginRequired.php';
require_once 'connec.php';

const BR = '<br> <br>';

$userName = $_SESSION["user_login"];

$query = "SELECT idUser FROM User WHERE Name = '$userName'";
$statement = $pdo->query($query);
$user = $statement->fetch();

foreach ($_SESSION["cartItems"] as $session) {
    echo $user['idUser'];
    echo BR;    
    $idSession = $session["session"];
    echo $idSession;
    echo BR;
    $ticketsQuantity = $session["nbTickets"];
    echo $ticketsQuantity;
    echo BR;
    $insurance = $session["insurance"];
    echo $insurance;
    echo BR;
}

?>
<pre>
<?php
print_r($_SESSION);
?>
</pre>
<?php
/* 
$query = "INSERT INTO Reservation
SELECT idUser, " . $idSession . ", " . $ticketsQuantity . ", " . $insurance . "
FROM User
WHERE User.Name =" . $user;

$statement = $pdo->query($query);
$sessions = $statement->fetchAll();
 */
//header ('location: reservation.php');