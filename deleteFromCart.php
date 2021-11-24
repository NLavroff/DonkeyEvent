<?php
session_start();

$cancelledSession = $_GET["idSession"];
unset($_SESSION["cartItems"][$cancelledSession]);

header ('location: cart.php');