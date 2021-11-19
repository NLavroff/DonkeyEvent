<?php

require_once 'connec.php';
require_once 'index.html';

session_start();
if (empty($_SESSION['cartItems'])) {
    $_SESSION['cartItems'] = [];
}
const BR = '<br> <br>';

?>

<h1>Mon panier</h1> <br>
<?php

if (!empty($_GET)) {
    
    $idSession = $_GET['idSession'];
  
    if (!empty($idSession)) {
        $query = "SELECT Event.name as event, Genre.name as genre, Artist.name as artist, Venue.name as venue, City.name as city, date, price, idSession 
        FROM Session 
        JOIN Event ON Event_idEvent = idEvent JOIN Venue ON Venue_idVenue = idVenue JOIN City ON City_idCity = idCity JOIN Performance ON Performance.Event_idEvent = idEvent JOIN Artist ON Artist_idArtist = idArtist JOIN Genre ON Genre_idGenre = idGenre 
        WHERE idSession =" . $idSession;
        $statement = $pdo->query($query);

        $_SESSION['cartItems'] = array_merge($_SESSION['cartItems'], $statement->fetchAll(PDO::FETCH_ASSOC));
    }
}

if (isset($_SESSION['cartItems'])) { ?>
    <table>
    <tr>
        <th>Nom</th>
        <th>Catégorie</th>
        <th>Date</th>
        <th>Ville</th>
        <th>Salle</th>
        <th>Tarif</th>
        <th>Modifier la quantité</th>
        <th>Supprimer</th>
        <th>Ajouter l'assurance annulation</th>
        <th>Total</th>
    </tr>
        <?php
        for ($i = 0; $i < count($_SESSION['cartItems']); $i++) { 
            ?>
            <tr>
                <td><?php echo $_SESSION['cartItems'][$i]['event']; ?></td>
                <td><?php echo $_SESSION['cartItems'][$i]['genre']; ?></td>
                <td><?php echo $_SESSION['cartItems'][$i]['date']; ?></td>
                <td><?php echo $_SESSION['cartItems'][$i]['city']; ?></td>
                <td><?php echo $_SESSION['cartItems'][$i]['venue']; ?></td>
                <td><?php echo $_SESSION['cartItems'][$i]['price']; ?></td>
            </tr>
    <?php } 
    } else {
            echo "<br>Votre panier est vide !";
        } ?>
    </table>

    <button type="submit">Confirmer la réservation</button>