<?php

require_once 'connec.php';
require_once 'header.php';

?>

<section class="bgimage-cinema">
    <div class="container">
        <div class="centered">
            <h1>CINÉMA</h1>
        </div>
    </div>
</section>

<div class="space"></div>

        <?php
        date_default_timezone_set('Europe/Paris');
        $currentDate = date("Y-m-d H:i:s");

        $query = "SELECT idEvent, cover, Event.name as event, Event.description as description, Artist.name as artist 
FROM Event
    JOIN Session ON idEvent = Event_idEvent
    JOIN Performance ON Performance.Event_idEvent = Event.idEvent
    JOIN Artist ON Artist_idArtist = idArtist 
WHERE DATE(Session.date) >= '$currentDate' AND Genre_idGenre = 1";

        $statement = $pdo->prepare($query);
        $statement->execute();
        $movies = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <?php $movies = array_map("unserialize", array_unique(array_map("serialize", $movies))); ?>
        <?php foreach ($movies as $movie) { ?>
            <div class="container-fluid">
                <div class="row">
                <div class="col-2"></div>
                    <div class="col-lg-4">
                        <img src="Cover/<?php echo $movie['cover']; ?>" class="img-fluid">
                    </div>
                    <div class="event col col-lg-4">
                        <h1><?php echo $movie['event']; ?></h1>
                        <div class="row">
                            <div class="col">
                                <?php echo $movie['description']; ?>
                            </div>
                        </div>
                        <div class="col">
                            <form class="btn-position-right" method="GET" action="product.php" name="product">
                                <input type="hidden" name="idEvent" value="<?php echo $movie["idEvent"];?>" />
                                <button type="submit" class="btn btn-light">En savoir plus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <div class="space"></div>

        <?php }
        
        require_once 'footer.php';