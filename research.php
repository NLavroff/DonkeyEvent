<?php

require_once 'connec.php';

?>

<div class="container-fluid research">
  <div class="row">
    <div class="col-5">
      <h1>Recherche</h1>
    </div>
    <form class="searchbar" action="searchResult.php" method="get" autocomplete="on">
      <div class="col-5">
        <label for="search">Je souhaite réserver : </label>
        <input class="form-control form-control-sm" type="text" name="search" placeholder="Artiste/Salle/Ville" value="<?php if (isset($_GET["search"])) {
                                                                                                                          echo $_GET["search"];
                                                                                                                        } ?>">
      </div>
      <div class="col-5">
        <label for="searchDate">le : </label>
        <input class="form-control form-control-sm" type="date" name="searchDate" value=<?php if (isset($_GET["searchDate"])) {
                                                                                          echo $_GET["searchDate"];
                                                                                        } ?>>
      </div>
      <div class="col-5">
        <label for="searchPrice">Prix maximum par place : </label>
        <select name="searchPrice" class="form-select">
          <option value=100>100 €</option>
          <option value=50>50 €</option>
          <option value=20>20 €</option>
          <option value=5>5 €</option>
        </select>
        <input class="btn btn-light" type="submit" value="Rechercher"><br><br>
    </form>
  </div>
</div>
</div>