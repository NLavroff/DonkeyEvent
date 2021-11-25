<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$updatedSession = $_GET["idSession"];
$_SESSION["cartItems"][$updatedSession]["nbTickets"] = $_GET["nbTickets"];
$_SESSION["cartItems"][$updatedSession]["insurance"] = $_GET["insurance"];

header ('location: cart.php');