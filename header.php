<?php

require_once 'connec.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (isset($_POST['user_login'])){
  $userLogin = trim($_POST['user_login']);
  $userPassword = trim($_POST['user_password']);
  
  $query = "SELECT * FROM User WHERE User.Name = :login";

  $statement = $pdo ->prepare($query);

  $statement->bindValue(':login', $userLogin, PDO::PARAM_STR);
  $statement->execute();

  $row = $statement->fetch(PDO::FETCH_ASSOC);
  
  if (!$row) {
    echo "Votre identifiant est inconnu.";
  } else if (password_verify($userPassword,$row["Password"])) {
      $_SESSION["user_login"] = $userLogin;
  } else {
      echo "Votre mot de passe est incorrect.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="DonkeyEvent - Toutes vos sorties à portée de clic">
    <meta name="description" content="Un concert, un ciné, une pièce de théâtre. À vous de sortir !">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <!-- social media icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="footer.css">
    <title>Donkey Event</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">DonkeyEvent</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link" href="cinema.php">Cinéma</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="theater.php">Théâtre</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="dance.php">Danse</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="exhibit.php">Expos</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="concert.php">Concert</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="standup.php">Stand Up</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <form action="searchResult.php" method="GET" autocomplete="on">
              <div class="input-group">
                <input type="hidden" name="searchDate" value=<?php if (isset($_GET["searchDate"])) { echo $_GET["searchDate"]; } ?>>
                <input type="hidden" name="searchPrice" value=100>
                <input class="form-control border-start-0 border-end-0 border-top-0 border" type="text" placeholder="Rechercher..." name="search" value="<?php if (isset($_GET["search"])) {
                                                                                                                                                            echo $_GET["search"];
                                                                                                                                                          } ?>">

                <span class="input-group-append">
                  <button class="btn btn-outline-secondary bg-white border-start-0 border-end-0 border-top-0 border ms-n5" type="submit">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
            </form>
          </li>
          <li class="nav-item">
            <form class="d-flex">
              <?php if (!isset($_SESSION['user_login'])) { ?>
                <button type='button' class="btn secondary" data-bs-toggle="modal" data-bs-target="#loginModal">Se connecter</button>
              <?php } else { ?>
                <div class="dropdown">
                  <button class="btn secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Mon compte
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="reservation.php"><button type='button' class="btn secondary">Mes réservations</button></a></li>
                    <div class="dropdown-divider"></div>
                    <li><a class="dropdown-item" href="logout.php"><button type='button' class="btn secondary">Se déconnecter</button></a></li>
                  </ul>
                </div>
              <?php } ?>
            </form>
          </li>
          <li class="nav-item">
            <i class="bi bi-cart"></i>
            <a class="cart" href="cart.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
              </svg></a>
          </li>
        </ul>
  </nav>

<!-- Modal -->
  <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content ">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">DonkeyEvent</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <img src="medias/login.jpg" class="card-img-top" alt="crowd in concert" style="width: 20rem;">
          <form method="post">
              <div class="col-sm-12">
                  <input type="text" id="login" name="user_login" placeholder="Identifiant">
              </div>
              <div class="col-sm-12">
                  <input type="password" id="password" name="user_password" placeholder="Mot de passe">
              </div>
            </div>
            <div class="modal-footer">
            <button class="btn btn-secondary" type="submit">CONNEXION</button>
          </form>
        </div>
      </div>
    </div>
  </div>