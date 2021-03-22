<?php
require_once('datenbank.php');
require_once('fussballspiel.php');
require_once('erstellefussballspiel.php');

session_start();
if(!isset($_SESSION["nickname"])){
  header("Location: login.php");
  exit;
}
$benutzer = $_SESSION["benutzer"];
$stmt = $db->prepare("SELECT punktestand FROM `benutzer` WHERE benutzer.nickname = '$benutzer'");
$stmt->execute();
$punktestand = $stmt->fetch();


?>
<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>du existierst</h1>
    <p id="nutzername"></p>
    <p id="punktestand">213</p><br>
    <script>document.getElementById("nutzername").innerHTML = "Angemeldet als: <?php echo $benutzer ?>";</script>
    <script>document.getElementById("punktestand").innerHTML = "Dein Punktestand: <?php echo $punktestand["punktestand"]; ?>";</script>


    <!-- Fußball spiele: -->
    <!-- Spiel1 -->
    <h3>Fußballspiel 1:</h3>
    <p id="spiel1"></p>

    <!-- Spiel2 -->
    <h3>Fußballspiel 2:</h3>
    <p id="spiel2"></p>

    <!-- Spiel3 -->
    <h3>Fußballspiel 3:</h3>
    <p id="spiel3"></p>

    <!-- Spiel4 -->
    <h3>Fußballspiel 3:</h3>
    <p id="spiel4"></p>

    <script>setMannschaft()</script>


    <br><br><a href="logout.php">Abmelden</a><br><br>
    <a href="kontoLoeschen.php">Konto Löschen</a>
  </body>
</html>
