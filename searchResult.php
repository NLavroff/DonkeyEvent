<?php

require_once 'connec.php';
require_once 'header.php';


const BR = '<br> <br>';

$_SESSION["cart"] = [];
date_default_timezone_set('Europe/Paris');
$currentDate = date("Y-m-d H:i:s");
?>

<div class="p-5 text-center" style="background-color: #0D0C1D;">
    <h1 class="mb-3">RECHERCHER UN SPECTACLE</h1>
</div>

<?php
require_once 'research.php';
?>

<div class="container">
    <div class="row">
        <h1>Résultats</h1>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-light">

                <tr>
                    <th scope="col">Evénement</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Artiste</th>
                    <th scope="col">Lieu</th>
                    <th scope="col">Ville</th>
                    <th scope="col">Date</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Réserver</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $search = trim($_GET["search"]);
                $price = filter_var($_GET["searchPrice"], FILTER_SANITIZE_NUMBER_INT);
                $date = trim($_GET["searchDate"]);

                if (!$date) {
                    $query = "
        SELECT idSession, Event.name as event, Genre.name as genre, Artist.name as artist, Venue.name as venue, City.name as city, date, price 
        FROM Session 
            JOIN Event ON Event_idEvent = idEvent 
            JOIN Venue ON Venue_idVenue = idVenue 
                JOIN City ON City_idCity = idCity 
            JOIN Performance ON Performance.Event_idEvent = Event.idEvent
                JOIN Artist ON Artist_idArtist = idArtist 
                JOIN Genre ON Genre_idGenre = idGenre
        WHERE price <= :price AND DATE(date) >= '$currentDate'
        HAVING INSTR(event, :search) OR INSTR(genre, :search) OR INSTR(artist, :search) OR INSTR(venue, :search) OR INSTR(city, :search)
    ";
                } else {
                    $query = "
        SELECT idSession, Event.name as event, Genre.name as genre, Artist.name as artist, Venue.name as venue, City.name as city, date, price 
        FROM Session 
            JOIN Event ON Event_idEvent = idEvent
            JOIN Venue ON Venue_idVenue = idVenue
                JOIN City ON City_idCity = idCity
            JOIN Performance ON Performance.Event_idEvent = Event.idEvent
                JOIN Artist ON Artist_idArtist = idArtist
                JOIN Genre ON Genre_idGenre = idGenre
        WHERE price <= :price AND DATE(date) = :date
        HAVING INSTR(event, :search) OR INSTR(genre, :search) OR INSTR(artist, :search) OR INSTR(venue, :search) OR INSTR(city, :search)
    ";
                }

                $statement = $pdo->prepare($query);
                $statement->bindValue(':search', $search, \PDO::PARAM_STR);
                $statement->bindValue(':price', $price, \PDO::PARAM_INT);
                $statement->bindValue(':date', $date, \PDO::PARAM_STR);
                $statement->execute();
                $events = $statement->fetchAll();

                if ($statement->rowCount() > 0) {
                    foreach ($events as $event) : ?>
                        <tr>
                            <th scope="row"><?php echo $event["event"]; ?></th>
                            <td><?php echo $event["genre"]; ?></td>
                            <td><?php echo $event["artist"]; ?></td>
                            <td><?php echo $event["venue"]; ?></td>
                            <td><?php echo $event["city"]; ?></td>
                            <td><?php echo date('j/m/Y  - H:i', strtotime($event['date'])); ?></td>
                            <td><?php echo $event["price"] . "€"; ?></td>
                            <td>
                                <form action="cart.php" method="get"> <?php
                                                                        if (in_array($event["idSession"], $_SESSION["cart"])) { ?>
                                        <button disabled>Cet article est déjà dans le panier</button> <?php
                                                                                                    } else { ?>
                                        <button name="idSession" class="btn btn-light value=" <?php echo $event["idSession"]; ?>" type="submit">Ajouter au panier</button> <?php
                                                                                                                                                                        } ?>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php } else { ?>
                    <th><span class="alert-message">Nous n'avons pas trouvé d'évènement correspondant à votre recherche</span></th>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php
require_once 'footer.php';
