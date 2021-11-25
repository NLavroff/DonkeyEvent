<?php

require_once 'connec.php';
require_once 'header.php';
require_once 'index.html';
require_once 'header.php';

const BR = '<br> <br>';

$query = "SELECT * FROM Event";
$statement = $pdo->query($query);
$events = $statement->fetchAll(); 
?>

<header>

  <!-- The HTML5 video element that will create the background video on the header -->
  <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="medias/homepage_video.mp4" type="video/mp4">
  </video>

  <!-- The header content -->
  <div class="container h-100">
    <div class="d-flex h-100 text-center align-items-center">
      <div class="w-100 text-white">
        <h1 class="display-4">À vous de sortir !</h1>
      </div>
    </div>
  </div>
</header>

<div class="container">
    <div class="text-center">
        <p>È universalmente riconosciuto che un lettore che osserva il layout di una pagina viene distratto dal contenuto testuale se questo è leggibile. Lo scopo dell’utilizzo del Lorem Ipsum è che offre una normale distribuzione delle lettere (al contrario di quanto avviene se si utilizzano brevi frasi ripetute, ad esempio “testo qui”), apparendo come un normale blocco di testo leggibile. Molti software di impaginazione e di web design utilizzano Lorem Ipsum come testo modello. Molte versioni del testo sono state prodotte negli anni, a volte casualmente, a volte di proposito (ad esempio inserendo passaggi ironici).</p>     
    </div>
</div>

<div class="container img-fluid">
    <div>
      <img src="medias/cinema.jpg" alt="cinema" class="w-50">
    </div>
    <div>
      <img src="medias/expo.jpg" alt="exposition" class="w-50">
    </div>
    <div>
      <img src="medias/concert.jpg" alt="concert" class="w-50">
    </div>
    <div>
      <img src="medias/danse.jpg" alt="danse" class="w-50">
    </div>
    <div>
      <img src="medias/theatre.jpg" alt="theatre" class="w-50">
    </div>
</div>

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

