<?php
require_once('datenbank.php');
require_once('fussballspiel.php');

session_start();
if(!isset($_SESSION["nickname"])){
  header("Location: login.php");
  exit;
}
$benutzer = $_SESSION["benutzer"];
$stmt = $db->prepare("SELECT punktestand FROM `benutzer` WHERE benutzer.nickname = '$benutzer'");
$stmt->execute();
$punktestand = $stmt->fetch();

//erstelle fussballspiele
$spiel1 = new fussballspiel(1, $db);
$spiel2 = new fussballspiel(2, $db);
$spiel3 = new fussballspiel(3, $db);
$spiel4 = new fussballspiel(4, $db);

?>
<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="aufSpielSetzen.js"></script>
  </head>
  <body>
    <!-- Ausgabe von Name und Punktestand -->
    <p id="nutzername"></p>
    <script>document.getElementById("nutzername").innerHTML = "Angemeldet als: <?php echo $benutzer ?>";</script>
    <p id="punktestand">213</p><br>
    <script>document.getElementById("punktestand").innerHTML = "Dein Punktestand: <?php echo $punktestand["punktestand"]; ?>";</script>


    <!-- Ausgabe der Fußballspiele, und deren Datum/Uhrzeit: -->
    <!-- Spiel1 -->
    <h3>Fußballspiel 1:</h3>
    <p id="spiel1"></p>
    <form class="wette_platzieren" action="index.html" method="post">
    <button type="button" name="spiel1_bt" onclick=neuesFeld()>Wette auf diesem Spiel platzieren</button>
    </form><br>
    <script>document.getElementById("spiel1").innerHTML =
    "<?php echo $spiel1->getManschaft('a'); ?> gegen <?php echo $spiel1->getManschaft('b'); ?>, gespielt wird am <?php echo $spiel1->getDatum(); ?> um <?php echo $spiel1->getuhrzeit(); ?> Uhr";</script>

    <!-- Spiel2 -->
    <h3>Fußballspiel 2:</h3>
    <p id="spiel2"></p>
    <form class="wette_platzieren" action="index.html" method="post">
    <button type="button" name="spiel2_bt">Wette auf diesem Spiel platzieren</button>
    </form><br>
    <script>document.getElementById("spiel2").innerHTML =
    "<?php echo $spiel2->getManschaft('a'); ?> gegen <?php echo $spiel2->getManschaft('b'); ?>, gespielt wird am <?php echo $spiel2->getDatum(); ?> um <?php echo $spiel2->getuhrzeit(); ?> Uhr";</script>

    <!-- Spiel3 -->
    <h3>Fußballspiel 3:</h3>
    <p id="spiel3"></p>
    <form class="wette_platzieren" action="index.html" method="post">
    <button type="button" name="spiel3_bt">Wette auf diesem Spiel platzieren</button>
    </form><br>
    <script>document.getElementById("spiel3").innerHTML =
    "<?php echo $spiel3->getManschaft('a'); ?> gegen <?php echo $spiel3->getManschaft('b'); ?>, gespielt wird am <?php echo $spiel3->getDatum(); ?> um <?php echo $spiel3->getuhrzeit(); ?> Uhr";</script>

    <!-- Spiel4 -->
    <h3>Fußballspiel 3:</h3>
    <p id="spiel4"></p>
    <form class="wette_platzieren" action="index.html" method="post">
    <button type="button" name="spiel4_bt">Wette auf diesem Spiel platzieren</button>
    </form><br>
    <script>document.getElementById("spiel4").innerHTML =
    "<?php echo $spiel4->getManschaft('a'); ?> gegen <?php echo $spiel4->getManschaft('b'); ?>, gespielt wird am <?php echo $spiel4->getDatum(); ?> um <?php echo $spiel4->getuhrzeit(); ?> Uhr";</script>


    <br><br><a href="logout.php">Abmelden</a><br><br>
    <a href="kontoLoeschen.php">Konto Löschen</a>
  </body>
</html>
