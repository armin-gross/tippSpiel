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
    <p id="mannschaft1"></p>
    <p id="mannschaft8"></p>
    <script>document.getElementById("mannschaft1").innerHTML = "<?php echo $spiel1->getManschaft('a'); ?> gegen ";</script>
    <script>document.getElementById("mannschaft8").innerHTML = "<?php  echo $spiel1->getManschaft('b'); ?>";</script>

    <!-- Spiel2 -->
    <h3>Fußballspiel 2:</h3>
    <p id="mannschaft2"></p>
    <p id="mannschaft7"></p>
    <script>document.getElementById("mannschaft2").innerHTML = "<?php echo $spiel2->getManschaft('a'); ?> gegen ";</script>
    <script>document.getElementById("mannschaft7").innerHTML = "<?php  echo $spiel2->getManschaft('b'); ?>";</script>

    <!-- Spiel3 -->
    <h3>Fußballspiel 3:</h3>
    <p id="mannschaft3"></p>
    <p id="mannschaft6"></p>
    <script>document.getElementById("mannschaft3").innerHTML = "<?php echo $spiel3->getManschaft('a'); ?> gegen ";</script>
    <script>document.getElementById("mannschaft6").innerHTML = "<?php  echo $spiel3->getManschaft('b'); ?>";</script>

    <!-- Spiel4 -->
    <h3>Fußballspiel 3:</h3>
    <p id="mannschaft4"></p>
    <p id="mannschaft5"></p>
    <script>document.getElementById("mannschaft4").innerHTML = "<?php echo $spiel4->getManschaft('a'); ?> gegen ";</script>
    <script>document.getElementById("mannschaft5").innerHTML = "<?php  echo $spiel4->getManschaft('b'); ?>";</script>



    <br><br><a href="logout.php">Abmelden</a><br><br>
    <a href="kontoLoeschen.php">Konto Löschen</a>
  </body>
</html>
