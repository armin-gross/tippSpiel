<link rel="stylesheet" href="style.css">
<div class="topbox">
  <h2 class="topboxtext">Südtirol Meisterschaft</h2>
  <img class="falgge" src="Bilder/flagge_suedtirol.png" alt="Südtirol">
</div>



<?php
require_once('datenbank.php');
require_once('fussballspiel.php');

session_start();
if(!isset($_SESSION["nickname"])){
  header("Location: login.php");
  exit;
}
$benutzer = $_SESSION["benutzer"];
if($benutzer != "admin"){
  header("Location: tippspiel.php");
}else{

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="aufSpielSetzen.js"></script>
  </head>
  <body>

    <!-- Ausgabe von Name und Punktestand -->
    <div class="benutzer">
    <text id="nutzername"></text><br>
    <script>document.getElementById("nutzername").innerHTML = "Angemeldet als: <?php echo $benutzer ?>";</script>
    <div class="dropdown">
        <span>Account Verwalten</span>
      <div class="dropdown-content">
        <a class="linkindex" href="logout.php">Abmelden</a><br>
        <a class="linkindex" href="kontoLoeschen.php">Konto Löschen</a>
      </div>
    </div>

    <form method="post">
      <button type="submit" name="button" onclick="neuesAdminFeld()">Spiel erstellen</button>
    </form>

  </body>
</html>
