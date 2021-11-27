<?php

require_once 'connec.php';
require_once 'header.php';

?>

<section class="bgimage-exhibit">
    <div class="container">
        <div class="centered">
            <h1>EXPOSITIONS</h1>
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
WHERE DATE(Session.date) >= '$currentDate' AND Genre_idGenre = 3";

        $statement = $pdo->prepare($query);
        $statement->execute();
        $exhibits = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <?php $exhibits = array_map("unserialize", array_unique(array_map("serialize", $exhibits))); ?>
        <?php foreach ($exhibits as $exhibit) { ?>
            <div class="container-fluid">
                <div class="row">
                <div class="col-2"></div>
                    <div class="col-lg-4">
                        <img src="Cover/<?php echo $exhibit['cover']; ?>" class="img-fluid">
                    </div>
                    <div class="event col col-lg-4">
                        <h1><?php echo $exhibit['event']; ?></h1>
                        <div class="row">
                            <div class="col">
                                <?php echo $exhibit['description']; ?>
                            </div>
                        </div>
                        <div class="col">
                            <form class="btn-position-right" method="GET" action="product.php" name="product">
                                <input type="hidden" name="idEvent" value="<?php echo $exhibit["idEvent"];?>" />
                                <button type="submit" class="btn btn-light">En savoir plus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <div class="space"></div>

        <?php }
        
        require_once 'footer.php';