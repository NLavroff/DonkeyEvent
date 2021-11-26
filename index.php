<?php

require_once 'connec.php';
require_once 'header.php';

const BR = '<br> <br>';

$query = "SELECT * FROM Event";
$statement = $pdo->query($query);
$events = $statement->fetchAll(); 
?>

<!-- video hero banner -->
<header>
  <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="medias/homepage_video.mp4" type="video/mp4">
  </video>

  <div class="container h-100">
    <div class="d-flex h-100 text-center align-items-center">
      <div class="w-100 text-white">
        <h1 class="display-4">À vous de sortir !</h1>
      </div>
    </div>
  </div>
</header>

<section class="genre-section">
      <div class="container">
          <div class="text-center">
              <p>È universalmente riconosciuto che un lettore che osserva il layout di una pagina viene distratto dal contenuto testuale se questo è leggibile. Lo scopo dell’utilizzo del Lorem Ipsum è che offre una normale distribuzione delle lettere (al contrario di quanto avviene se si utilizzano brevi frasi ripetute, ad esempio “testo qui”), apparendo come un normale blocco di testo leggibile. Molti software di impaginazione e di web design utilizzano Lorem Ipsum come testo modello. Molte versioni del testo sono state prodotte negli anni, a volte casualmente, a volte di proposito (ad esempio inserendo passaggi ironici).</p>     
          </div>
      </div>


      <!-- section genre -->
      <div class="container">
          <div class="container img-genre text-center">
                  <a href="cinema.php">
                  <img src="medias/cinema.jpg" alt="cinema" class="w-60 img-fluid">
                  <h2 class="genre">CINÉMA</h2>
                  </a>
          </div>

          <div class="container img-genre text-center">
                  <a href="exhibit.php">
                  <img src="medias/expo.jpg" alt="exposition" class="w-60 img-fluid">
                  <h2 class="genre">EXPOSITIONS</h2>
                  </a>
          </div>

          <div class="container img-genre text-center">
                  <a href="concert.php">
                  <img src="medias/concert.jpg" alt="concert" class="w-60 img-fluid">
                  <h2 class="genre">CONCERTS</h2>
                  </a>
          </div>

          <div class="container img-genre text-center">
                  <a href="dance.php">
                  <img src="medias/danse.jpg" alt="danse" class="w-60 img-fluid">
                  <h2 class="genre">DANSE</h2>
                  </a>
          </div>

          <div class="container img-genre text-center">
                  <a href="theater.php">
                  <img src="medias/theatre.jpg" alt="theatre" class="w-60 img-fluid">
                  <h2 class="genre">THÉÂTRE</h2>
                  </a>
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
</section>

<?php
require_once 'footer.php';