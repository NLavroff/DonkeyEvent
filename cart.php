<?php

require_once 'connec.php';
require_once 'index.html';

session_start();

const BR = '<br> <br>';

if (empty($_SESSION['cartItems'])) {
    $_SESSION['cartItems'] = [];
}

if (!empty($_GET)) {
    $idSession = $_GET['idSession'];
    if (isset($_GET['nbTickets'])) {
        $nbTickets = $_GET['nbTickets'];
    } else {
        $nbTickets = 1;
    }
    if (isset($_GET['insurance'])) {
        $insurance = $_GET['insurance'];
    } else {
        $insurance = FALSE;
    }
    if (isset($_GET['cancellation'])) {
        $cancellation = $_GET['cancellation'];
    } else {
        $cancellation = FALSE;
    }
}

$_SESSION['cartItems'][$idSession] = [
"session"=>$idSession,
"nbTickets"=>$nbTickets,
"insurance"=>$insurance,
"cancellation"=>$cancellation
];

/* echo "contenu du panier";

?>
<pre>
<?php
print_r($_SESSION['cartItems']);
?>
</pre>
<?php */

foreach ($_SESSION['cartItems'] as $session => $sessionDetails) {
    echo "détails de la session : ". $sessionDetails["session"];
    $query = "SELECT capacity, Event.name as event, Genre.name as genre, Artist.name as artist, Venue.name as venue, City.name as city, date, price, idSession 
    FROM Session 
    JOIN Event ON Event_idEvent = idEvent JOIN Venue ON Venue_idVenue = idVenue JOIN City ON City_idCity = idCity JOIN Performance ON Performance.Event_idEvent = idEvent JOIN Artist ON Artist_idArtist = idArtist JOIN Genre ON Genre_idGenre = idGenre 
    WHERE idSession =" . $sessionDetails["session"];
    $statement = $pdo->query($query);
    $sessionInfo = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <pre>
    <?php
    print_r($sessionInfo);
    ?>
    </pre>
    <?php
    echo "nombre de places réservées : ". $sessionDetails["nbTickets"] .  BR;
}