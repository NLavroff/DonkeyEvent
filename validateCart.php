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

$idUser = $user['idUser'];

foreach ($_SESSION["cartItems"] as $session) {
    $idSession = $session["session"];
    $ticketsQuantity = $session["nbTickets"];
    if ($session["insurance"] == TRUE) {
        $insurance = 1;
    } else {
        $insurance = 0;
    }

    $query = "INSERT INTO Reservation
    VALUES ($idUser, $idSession, $ticketsQuantity, $insurance)
    ON DUPLICATE KEY UPDATE ticketsQuantity = ticketsQuantity + $ticketsQuantity, insurance = insurance + $insurance
    ";
    $pdo->exec($query);

    $query2 = "DELETE FROM Reservation WHERE ticketsQuantity = " . 0;
    $pdo->exec($query2);
}
 
unset($_SESSION["cartItems"]);

header ('location: reservation.php');