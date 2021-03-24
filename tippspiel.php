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
    <?php
    // Ausgabe der anzahl an Spielen
    $stmt = $db->prepare("SELECT max(f_id) FROM `fußballspiel`");
    $stmt->execute();
    $anzahlSpiele = $stmt->fetch();
    $i;

    for ($i=1; $i <= $anzahlSpiele["max(f_id)"]; $i++) {
      $spiel = new fussballspiel($i, $db);
      $mA = $spiel->getManschaft('a');
      $mB = $spiel->getManschaft('b');
    ?>
    <!-- Ausgabe des spiels an stelle $i -->
    <h3>Fußballspiel <?php echo $i?>:</h3>
    <p id="spiel<?php echo $i?>"></p>
    <form class="wette_platzieren" action="index.html" method="post">
    <button type="button" id="spiel<?php echo $i?>_bt" name="spiel1_bt"
    onclick=neuesFeld(<?php echo $i?>,"<?php echo $mA; ?>","<?php echo $mB; ?>",<?php echo $anzahlSpiele["max(f_id)"]; ?>)
    >Wette auf diesem Spiel platzieren</button>
    </form><br>
    <script>document.getElementById("spiel<?php echo $i?>").innerHTML =
    "<?php echo $mA; ?> gegen <?php echo $mB; ?>, gespielt wird am <?php echo $spiel->getDatum(); ?> um <?php echo $spiel->getuhrzeit(); ?> Uhr";</script>
    <?php
    }

    if(isset($_POST["spiel1_bt"])){
      echo "jaaaaaaaaaaaaaaa";
    }
    ?>


    <br><br><a href="logout.php">Abmelden</a><br><br>
    <a href="kontoLoeschen.php">Konto Löschen</a>
  </body>
</html>
