<?php

require_once 'connec.php';
require_once 'index.html';
require_once 'header.php';

?>

<style>
body {
  color: #A69CAC;
}

table {
  font-family: arial, sans-serif;
  color: #F1DAC4;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #474973;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
  color: #161B33;
}
</style>


<h1>Recherche</h1>
<form action="searchResult.php" method="get" autocomplete="on">
    <label for="search">Je souhaite réserver : </label>
    <input type="text" name="search" placeholder="Céline Dion" value=<?php if (isset($_GET["search"])) { echo $_GET["search"]; } ?>>
    <label for="search">le : </label>
    <input type="date" name="searchDate" value=<?php if (isset($_GET["searchDate"])) { echo $_GET["searchDate"]; } ?>>
    <label for="searchPrice">Prix maximum par place : </label>
    <select name="searchPrice">
      <option value=100>100 €</option>
      <option value=50>50 €</option>
      <option value=20>20 €</option>
      <option value=5>5 €</option>
    </select>
    <input type="submit" value="Rechercher"><br><br>
</form>
