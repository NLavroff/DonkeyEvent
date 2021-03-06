<?php

require_once 'connec.php';
require_once 'header.php';

const BR = '<br> <br>';

$total = 0;
$insurancePrice = 5;

if (empty($_SESSION['cartItems'])) {
    $_SESSION['cartItems'] = [];
}

if (!empty($_POST)) {
    $idSession = $_POST['idSession'];
    if (isset($_POST['nbTickets'])) {
        $nbTickets = $_POST['nbTickets'];
    } else {
        $nbTickets = 1;
    }
    if (isset($_POST['insurance'])) {
        $insurance = $_POST['insurance'];
    } else {
        $insurance = FALSE;
    }
    if (isset($_POST['cancellation'])) {
        $cancellation = $_POST['cancellation'];
    } else {
        $cancellation = FALSE;
    }

    $_SESSION['cartItems'][$idSession] = [
        "session" => $idSession,
        "nbTickets" => $nbTickets,
        "insurance" => $insurance,
        "cancellation" => $cancellation
    ];
} ?>

<div class="p-5 text-center" style="background-color: #0D0C1D;">
    <h1 class="mb-3">MON PANIER</h1>
</div>

<?php
if (isset($_SESSION['cartItems'])) { ?>
    <div class="container-fluid">
        <div class="row">
            <aside class="col-lg-9">
                <div class="table-responsive">
                    <table class="table table-borderless table-shopping-cart">
                        <thead class="thead-light">
                            <tr class="small text-uppercase">
                                <th scope="col">Événement</th>
                                <th scope="col">Catégorie</th>
                                <th scope="col">Date</th>
                                <th scope="col">Ville</th>
                                <th scope="col">Lieu</th>
                                <th scope="col">Tarif</th>
                                <th scope="col">Assurance anulation</th>
                                <th scope="col">Quantité</th>
                                <th scope="col">Valider les modifications</th>
                                <th scope="col">Retirer du panier</th>
                            </tr>
                            <?php
                            foreach ($_SESSION['cartItems'] as $session => $sessionDetails) {
                                $query = "SELECT capacity, Event.name as event, Genre.name as genre, Artist.name as artist, Venue.name as venue, City.name as city, date, price, idSession 
                                    FROM Session 
                                    JOIN Event ON Event_idEvent = idEvent JOIN Venue ON Venue_idVenue = idVenue JOIN City ON City_idCity = idCity JOIN Performance ON Performance.Event_idEvent = idEvent JOIN Artist ON Artist_idArtist = idArtist JOIN Genre ON Genre_idGenre = idGenre 
                                    WHERE idSession =" . $sessionDetails["session"];
                                $statement = $pdo->query($query);
                                $sessionInfo = $statement->fetchAll(PDO::FETCH_ASSOC);
                                for ($i = 0; $i < count($sessionInfo); $i++) { ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $sessionInfo[$i]['event']; ?></td>
                                            <td><?php echo $sessionInfo[$i]['genre']; ?></td>
                                            <td><?php echo $sessionInfo[$i]['date']; ?></td>
                                            <td><?php echo $sessionInfo[$i]['city']; ?></td>
                                            <td><?php echo $sessionInfo[$i]['venue']; ?></td>
                                            <td>
                                                <div class="price-wrap"><var class="price"><?php echo $sessionInfo[$i]['price'] . '€'; ?></var></div>
                                            </td>
                                            <form action="refreshCart.php" method="get">
                                                <input type="hidden" name="idSession" value="<?php echo $sessionDetails["session"]; ?>" />
                                                <td>
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" name="provisionalInsurance" value="TRUE" class="form-check-input" id="exampleCheck1" 
                                                        <?php if (isset($sessionDetails["provisionalInsurance"]) && $sessionDetails["provisionalInsurance"] == TRUE) { ?>
                                                            checked
                                                        <?php } else if ($sessionDetails["insurance"] == TRUE) { ?>
                                                            checked disabled>
                                                            <input type="hidden" name="insurance" value="TRUE"
                                                        <?php } ?>>
                                                    </div>
                                                </td>
                                                <td><select class="form-select" name="nbTickets">
                                                    <?php
                                                    if ($sessionDetails["nbTickets"] <= 0) { ?>
                                                        <option selected="selected" value=<?php echo $sessionDetails["nbTickets"] ?>><?php echo $sessionDetails["nbTickets"] ?></option>
                                                    <?php } else {
                                                        $capacity = (int) $sessionInfo[$i]['capacity'];
                                                        for ($j = 1; $j <= $capacity && $j <= 10; $j++) { ?>
                                                            <option <?php if ($sessionDetails["nbTickets"] == $j) { ?> selected="selected" <?php } ?> value=<?php echo $j ?>><?php echo $j ?></option>
                                                        <?php }
                                                    } ?>
                                                </select></td>
                                                <td><button class="btn btn-primary btn-sm btn-round" data-abc="true" type="submit">Valider</button></td>
                                            </form>
                                            <td class="text-right d-none d-md-block">
                                                <form action="deleteFromCart.php" method="get">
                                                    <input type="hidden" name="idSession" value="<?php echo $sessionDetails["session"]; ?>" />
                                                    <button class="btn btn-danger btn-sm btn-round" data-abc="true" type="submit" name="cancellation" value="TRUE">Retirer</button>
                                                </form>
                                            </td>
                                            <?php $total += $sessionDetails["nbTickets"] * $sessionInfo[$i]['price'];
                                            if (isset($sessionDetails["provisionalInsurance"]) && $sessionDetails["provisionalInsurance"] && 0 < $sessionDetails["nbTickets"]) {
                                                $total += $insurancePrice;
                                            } ?>
                                        </tr>
                                    </tbody>
                                <?php } ?>
                            <?php } ?>
                        </thead>
                    </table>
                </div>
            </aside>
            <aside class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <dl class="dlist-align">
                            <dt>Total : </dt>
                            <dd class="text-right text-dark b ml-3"><strong><?php echo $total ?> €</strong></dd>
                        </dl>
                        <hr>
                        <form action="validateCart.php">
                            <button <?php if (!isset($_SESSION['user_login'])) { ?>type='button' data-bs-toggle="modal" data-bs-target="#loginModal" <?php } ?> class="btn btn-out btn-primary btn-square btn-main" data-abc="true">
                                Confirmer
                                <?php if (!isset($_POST['cancellation'])) { ?>
                                    la réservation
                                <?php } else if ($_POST['cancellation'] == TRUE) { ?>
                                    l'annulation
                                <?php } ?>
                            </button>
                        </form>
                        <a href="index.php" class="btn btn-out btn-success btn-square btn-main mt-2" data-abc="true">Faire une autre réservation </a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4>Assurance Annulation en option</h4>
                        <p>Au cours de de votre commande de billets, il vous est proposé de souscrire à l'assurance annulation spectacle afin d'être couverts en cas d'imprévus si vous ne pouvez pas assister au spectacle. 
                            Il vous suffit de la cocher pour être immédiatement couvert à partir du jour d’achat de votre billet et de l’assurance.
                        </p>
                    </div>
                </div>
            </aside>
        </div>
    </div>
<?php }

require_once 'footer.php';
