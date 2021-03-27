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
$punktestand_array = $stmt->fetch();
$punktestand = $punktestand_array["punktestand"];

$stmt = $db->prepare("SELECT b_id FROM `benutzer` WHERE benutzer.nickname = '$benutzer'");
$stmt->execute();
$benutzer_id_array = $stmt->fetch();
$benutzer_id = $benutzer_id_array["b_id"];

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
    <script>document.getElementById("punktestand").innerHTML = "Dein Punktestand: <?php echo $punktestand; ?>";</script>


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
    <!-- Fußballspiel Nr i -->
    <h3>Fußballspiel <?php echo $i?>:</h3>
    <!-- erstellen von p mit id spiel+i -->
    <p id="spiel<?php echo $i?>"></p>
    <!-- button der javascript methode neuesFeld aufruft, und parameter i, mannschaftA, mannschaftB und anzahlSpiele übergibt -->
    <form method="post">
    <button type="submit" id="spiel<?php echo $i?>_bt" name="spiel<?php echo $i?>_bt"
    onclick=neuesFeld(<?php echo $i?>,"<?php echo $mA; ?>","<?php echo $mB; ?>",<?php echo $anzahlSpiele["max(f_id)"]; ?>)
    >Wette auf diesem Spiel platzieren</button>
    </form><br>
    <!-- //Ausgabe: Mannschaft A spielt gegen Mannschaft be am "Datum" umd "Uhrzeit" -->
    <script>document.getElementById("spiel<?php echo $i?>").innerHTML =
    "<?php echo $mA; ?> gegen <?php echo $mB; ?>, gespielt wird am <?php echo $spiel->getDatum(); ?> um <?php echo $spiel->getuhrzeit(); ?> Uhr";</script>
    <!-- wenn button an stelle spiel+i geklickt wird ersteller button tipp Abgeben -->
    <?php
  }

//Wenn "Tipp Abgeben" button geklickt wird, dann die zahlen der zwei felder in datenbank eintragen
  if(isset($_POST["tippen_bt"])){
    //Überprüfen ob die eingabe eine Zahl ist
    if(is_numeric($_POST["tippA"]) && is_numeric($_POST["tippB"])){
      //Überprüfen ob die Eingabe 50 nicht übersteigt
      if($_POST["tippA"] <= 50 && $_POST["tippB"] <= 50){
        $tA = $_POST["tippA"]; //Eingabe in Feld von Team A
        $tB = $_POST["tippB"]; //Eingabe in Feld von Team B
        $b_id = $benutzer_id;  //Id des aktuell angemeldeten Beuntzers
        $w_spiel = $_POST["welchesSpiel"]; //Id des Spiels dessen Button geklickt wurde
        $stmt = $db->prepare("INSERT INTO benutzer_tippt_fußballspiel (tipp_a, tipp_b, b_id, f_id) values ($tA, $tB, $b_id, $w_spiel)");
        $stmt->execute();
    }else {
      echo "Deine Tipps dürfen nicht höher als 50 sein";
    }
    }else {
      echo "Deine Tipps müssen schon Zahlen sein";
    }
  }

    ?>
    <br><br><a href="logout.php">Abmelden</a><br><br>
    <a href="kontoLoeschen.php">Konto Löschen</a>
  </body>
</html>
