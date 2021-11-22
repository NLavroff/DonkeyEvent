<?php

require_once 'connec.php';
require_once 'index.html';

session_start();
if (empty($_SESSION['cartItems'])) {
    $_SESSION['cartItems'] = [];
}
const BR = '<br> <br>';
?>

<<<<<<< HEAD
=======


>>>>>>> f2674ed6d220ff0f5d47a241b2b3eaafadfc5660
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
<div class="container-fluid">
<<<<<<< HEAD
<h1>MON PANIER</h1>
=======
<h1>Mon panier</h1>
>>>>>>> f2674ed6d220ff0f5d47a241b2b3eaafadfc5660
    <div class="row">
        <aside class="col-lg-9">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-borderless table-shopping-cart">
                        <thead class="text-muted">
                            <tr class="small text-uppercase">
                                <th scope="col">Evènement</th>
                                <th scope="col">Catégorie</th>
                                <th scope="col">Date</th>
                                <th scope="col">Ville</th>
                                <th scope="col">Lieu</th>
                                <th scope="col">Tarif</th>
                                <th scope="col">Assurance anulation</th>
                                <th scope="col">Modifier la quantité</th>
                                <th scope="col"> Supprimer la réservation</th>
                            </tr>
                        <?php 
                        for($i = 0; $i < count($_SESSION['cartItems']); $i++) { ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $_SESSION['cartItems'][$i]['event']; ?></td>
                                    <td><?php echo $_SESSION['cartItems'][$i]['genre']; ?></td>
                                    <td><?php echo $_SESSION['cartItems'][$i]['date']; ?></td>
                                    <td><?php echo $_SESSION['cartItems'][$i]['city']; ?></td>
                                    <td><?php echo $_SESSION['cartItems'][$i]['venue']; ?></td>
                                    <td><div class="price-wrap"> <var class="price"><?php echo $_SESSION['cartItems'][$i]['price'] .'€'; ?></var></div></td>
                                    <td><div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        </div>
                                    <td><select name="form-control">
                                        <option value=1>1</option>
                                        <option value=2>2</option>
                                        <option value=3>3</option>
                                        <option value=4>4</option>
                                        </select> </td>
                                    <td class="text-right d-none d-md-block"><a href="" class="btn btn-light btn-round" data-abc="true"> Supprimer </a> </td>
                        <?php }
                        } else {
                            echo "<br>Votre panier est vide !";
                        } ?>
                                        </tr>
                                    </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </aside>
    <aside class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <dl class="dlist-align">
                    <dt>Total:</dt>
<<<<<<< HEAD
                        <dd class="text-right text-dark b ml-3"><strong>
                            <?php
                            echo $_SESSION['cartItems'][$i]['price'] .'€'; ?></strong></dd>
=======
                        <dd class="text-right text-dark b ml-3"><strong>$59.97</strong></dd>
>>>>>>> f2674ed6d220ff0f5d47a241b2b3eaafadfc5660
                </dl>
                <hr> <a href="#" class="btn btn-out btn-primary btn-square btn-main" data-abc="true"> Confirmer la réservation </a> <a href="index.php" class="btn btn-out btn-success btn-square btn-main mt-2" data-abc="true">Faire une autre réservation </a>
            </div>
        </div>
    </aside>
    </div>
<<<<<<< HEAD
</div>

<?php require_once 'footer.php' ?>
=======
</div>
>>>>>>> f2674ed6d220ff0f5d47a241b2b3eaafadfc5660
