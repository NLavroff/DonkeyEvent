<?php

require_once 'connec.php';
require_once 'index.html';
require_once 'header.php';

date_default_timezone_set('Europe/Paris');
$currentDate = date("Y-m-d H:i:s");

$query = "SELECT cover, Event.name as event, Event.description as description, Artist.name as artist 
FROM Event
    JOIN Session ON idEvent = Event_idEvent
    JOIN Performance ON Performance.Event_idEvent = Event.idEvent
    JOIN Artist ON Artist_idArtist = idArtist 
WHERE DATE(Session.date) >= '$currentDate' AND Genre_idGenre = 4
";

$statement = $pdo->prepare($query);
$statement->execute();
$concerts = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="row">
        <?php $concerts = array_map("unserialize", array_unique(array_map("serialize", $concerts)));?>
        <?php foreach ($concerts as $concert) { ?>
        </div>
        <div class="row">
            <img src="Cover/<?php echo $concert['cover']; ?>">
        </div>
        <div class="row">
            <h1><?php echo $concert['event']; ?></h1>
        </div>
        <div class="row">
            <?php echo $concert['description']; ?>
        </div>
</div>

<?php } 

require_once 'footer.php'
?>