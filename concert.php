<?php

require_once 'connec.php';
require_once 'header.php';

?>

<section class="bgimage-concert">
    <div class="container-fluid">
        <div class="row">
            <div class="text-center">
                <h1>CONCERTS</h1>
            </div>
        </div>
    </div>
</section>

<div class="space"><div>

        <?php
        date_default_timezone_set('Europe/Paris');
        $currentDate = date("Y-m-d H:i:s");

        $query = "SELECT idEvent, cover, Event.name as event, Event.description as description, Artist.name as artist 
FROM Event
    JOIN Session ON idEvent = Event_idEvent
    JOIN Performance ON Performance.Event_idEvent = Event.idEvent
    JOIN Artist ON Artist_idArtist = idArtist 
WHERE DATE(Session.date) >= '$currentDate' AND Genre_idGenre = 4";

        $statement = $pdo->prepare($query);
        $statement->execute();
        $concerts = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <?php $concerts = array_map("unserialize", array_unique(array_map("serialize", $concerts))); ?>
        <?php foreach ($concerts as $concert) { ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm">
                        <img src="Cover/<?php echo $concert['cover']; ?>" class="img-fluid">
                    </div>
                    <div class="col col-lg-5">
                        <h1><?php echo $concert['event']; ?></h1>
                        <div class="row-sm">
                            <div class="col-sm">
                                <?php echo $concert['description']; ?>
                            </div>
                        </div>
                        <div class="col">
                            <form class="btn-position-right" method="GET" action="product.php" name="product">
                                <input type="hidden" name="idEvent" value="<?php echo $concert["idEvent"];?>" />
                                <button type="submit" class="btn btn-light">En savoir plus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space"><div>
        <?php }
        require_once 'footer.php';