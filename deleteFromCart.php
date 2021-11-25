<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$cancelledSession = $_GET["idSession"];
unset($_SESSION["cartItems"][$cancelledSession]);

header ('location: cart.php');