<?php

require_once 'connec.php';
require_once 'header.php';
require_once 'index.html';

session_start();

const BR = '<br> <br>';

$query = "SELECT * FROM Event";
$statement = $pdo->query($query);
$events = $statement->fetchAll(); 
?>

<ul>
    <?php foreach($events as $event): ?>
        <form method="GET" action="product.php" name="product">
            <input type="hidden" name="idEvent" value="<?php echo $event["idEvent"]; ?>" />
            <li><?php echo $event['name'] . BR . $event['description']; ?></li>
            <button type="submit">En savoir plus</button>
        </form>
    <?php endforeach ?>
</ul>

<?php
require_once 'footer.php';
?>