<?php
require_once('datenbank.php');
session_start();
if(!isset($_SESSION["nickname"])){
  header("Location: login.php");
  exit;
}
$benutzer = $_SESSION["benutzer"];
$stmt = $db->prepare("SELECT punktestand FROM `benutzer` WHERE benutzer.nickname = '$benutzer'");
$stmt->execute();
$punktestand = $stmt->fetch();


$stmt = $db->prepare("SELECT mannschaft.nickname from fußballspiel, mannschaft where mannschaft.m_id = (SELECT fußballspiel.m_id_a FROM `fußballspiel` WHERE f_id = 2)");
$stmt->execute();
$spiel1_mannschaft1 = $stmt->fetch();

$stmt = $db->prepare("SELECT mannschaft.nickname from fußballspiel, mannschaft where mannschaft.m_id = (SELECT fußballspiel.m_id_b FROM `fußballspiel` WHERE f_id = 1)");
$stmt->execute();
$spiel1_mannschaft2 = $stmt->fetch();

//mannschaft a : SELECT mannschaft.nickname from fußballspiel, mannschaft where mannschaft.m_id = (SELECT fußballspiel.m_id_a FROM `fußballspiel` WHERE f_id = 1)
//mannschaft b : SELECT mannschaft.nickname from fußballspiel, mannschaft where mannschaft.m_id = (SELECT fußballspiel.m_id_b FROM `fußballspiel` WHERE f_id = 1)
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
    <h3>Fußballspiel 1:</h3>
    <p id="mannschaft1"></p>
    <p id="mannschaft2"></p>
    <script>document.getElementById("mannschaft1").innerHTML = "<?php echo $spiel1_mannschaft1["nickname"]; ?> gegen ";</script>
    <script>document.getElementById("mannschaft2").innerHTML = "<?php echo $spiel1_mannschaft2["nickname"]; ?>";</script>
    <br><br><a href="logout.php">Abmelden</a><br><br>
    <a href="kontoLoeschen.php">Konto Löschen</a>
  </body>
</html>
