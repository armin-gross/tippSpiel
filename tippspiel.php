<link rel="stylesheet" href="style.css">
<div class="topbox">
  <h2 class="topboxtext">Südtirol Meisterschaft</h2>
  <img class="falgge" src="Bilder/flagge_suedtirol.png" alt="Südtirol">
</div>



<?php
require_once('datenbank.php');
require_once('fussballspiel.php');
require_once('ermittleGewinner.php');
require_once('tabelleTipps.php');

session_start();
if(!isset($_SESSION["nickname"])){
  header("Location: login.php");
  exit;
}

$benutzer = $_SESSION["benutzer"];
if($benutzer == "admin"){
  header("Location: admin_tippspiel.php");
}

//Punktestand des Benutzes
$stmt = $db->prepare("SELECT punktestand FROM `benutzer` WHERE benutzer.nickname = '$benutzer'");
$stmt->execute();
$punktestand_array = $stmt->fetch();
$punktestand = $punktestand_array["punktestand"];

//Id des Benutzers
$stmt = $db->prepare("SELECT b_id FROM `benutzer` WHERE benutzer.nickname = '$benutzer'");
$stmt->execute();
$benutzer_id_array = $stmt->fetch();
$benutzer_id = $benutzer_id_array["b_id"];

//Anzahl an aufSpielSetzen
// $stmt = $db->prepare("SELECT max(f_id) FROM `fußballspiel`");
// $stmt->execute();
// $anzahlSpiele_array = $stmt->fetch();
// $anzahlSpiele = $anzahlSpiele_array["max(f_id)"];

$stmt = $db->prepare("SELECT * FROM `fußballspiel`");
$stmt->execute();
$anzahlSpiele = $stmt->rowCount();


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


    </div>
    <p id="punktestand">213</p><br>
    <script>document.getElementById("punktestand").innerHTML = "Dein Punktestand: <?php echo $punktestand; ?>";</script>




    <?php

    for ($i=1; $i <= $anzahlSpiele; $i++) {
      $spiel = new fussballspiel($i, $db);
          $mA = $spiel->getManschaft('a');
          $mB = $spiel->getManschaft('b');

          //Erstellen von Datum und Uhrzeit
          date_default_timezone_set("Europe/Berlin");
          $timestamp = time();
          $aktuellesDatum = date("Y-m-d",$timestamp);
          $aktuelleUhrzeit = date("H:i",$timestamp);
          $spielDatum = $spiel->getDatum();
          $spielUhrzeit = $spiel->getUhrzeit();
          if($mA != "keine Mannschaft"){
          ?>
          <div class="fußbalspielebox">
            <!-- Ausgabe des spiels an stelle $i -->
            <div class="fußbalspielinsidebox">

              <h3>Fußballspiel <?php echo $i?>:</h3>
              <p id="spiel<?php echo $i?>"></p>

              <?php
              //ausgabe Tabelle
              tabelle($db, $i);
              //Überprüfen ob Datum und Uhrzeit noch nicht überstiegen wurden
              if($aktuellesDatum <= $spielDatum){
                if($aktuelleUhrzeit <= $spielUhrzeit || $aktuellesDatum < $spielDatum){

                  //Überprüfen ob Tipp nicht schon abgegeben wurde
                  $stmt = $db->prepare("SELECT b_f_id FROM benutzer_tippt_fußballspiel WHERE b_id = $benutzer_id and f_id = $i");
                  $stmt->execute();
                  $fußballspielBenutzer = $stmt->rowCount();
                  if($fußballspielBenutzer == 0){
                    ?>
                    <form method="post">
                      <input class="nummerbox" name="welchesSpiel" value="<?php echo $i?>" readonly size="1px"><!-- input um zu wissen, wessen spiels button geklickt wurde -->
                      <button class="button_2" type="button" id="spiel<?php echo $i?>_bt" name="spiel_bt"
                        onclick=neuesFeld(<?php echo $i?>,"<?php echo $mA; ?>","<?php echo $mB; ?>",<?php echo $anzahlSpiele; ?>)
                        >Wette auf diesem Spiel platzieren</button><!-- button der onclick i, mannschaftA, mannschaftB und anzahlSpiele übergibt -->
                      </form><br>
                    </div>
                    <!-- //Ausgabe: Mannschaft A spielt gegen Mannschaft b am "Datum" umd "Uhrzeit" -->

                    <script>
                    document.getElementById("spiel<?php echo $i?>").innerHTML =
                    "<?php echo $mA; ?> gegen <?php echo $mB; ?>, gespielt wird am <?php echo $spiel->getDatum(); ?> um <?php echo $spiel->getuhrzeit(); ?> Uhr";
                    </script>

                    <?php
                    //Wenn Tipp Abgegeben
                  }else {
                  ?> <script> document.getElementById("spiel<?php echo $i ?>").innerHTML =
                  "Tipp abgegeben, Spiel findet am <?php echo $spielDatum ?> um <?php echo $spielUhrzeit ?> Uhr statt." ; </script> </div> <?php }
                    //Wenn spiel bereits stattgefunden hat
                  }else {
                    $stmt = $db->prepare("SELECT b_f_id FROM benutzer_tippt_fußballspiel WHERE b_id = $benutzer_id and f_id = $i");
                    $stmt->execute();
                    $benutzerBereitsGetippt = $stmt->rowCount();
                    if($benutzerBereitsGetippt == 1){
                    $stmt = $db->prepare("SELECT * FROM benutzer_tippt_fußballspiel WHERE b_id = $benutzer_id and f_id = $i");
                    $stmt->execute();
                    $erhaltenArray = $stmt->fetch();
                    $erhalten = $erhaltenArray["punkteErhalten"];
                    if($erhalten == 0){
                    ausgabePunkte($i, $db, $benutzer_id, $punktestand);
                    $stmt = $db->prepare("UPDATE benutzer_tippt_fußballspiel SET punkteErhalten = true WHERE b_id = $benutzer_id and f_id = $i");
                    $stmt->execute();
                  }
                  else {
                    $stmt = $db->prepare("SELECT * FROM fußballspiel WHERE f_id = $i");
                    $stmt->execute();
                    $ergebnis_array = $stmt->fetch();
                    $ergebnisA = $ergebnis_array["ergebnis_a"];
                    $ergebnisB = $ergebnis_array["ergebnis_b"];
                     ?> <script> document.getElementById("spiel<?php echo $i ?>").innerHTML =
                    "Spiel ist beendet <?php echo $mA ?> hat <?php echo $ergebnisA ?> Tore geschossen und <?php echo $mB ?> hat <?php echo $ergebnisB ?> Tore geschossen. Deine Punkte wurden dir gut geschrieben"; </script> </div> <?php
                  }
                  }else {
                    $stmt = $db->prepare("SELECT * FROM fußballspiel WHERE f_id = $i");
                    $stmt->execute();
                    $ergebnis_array = $stmt->fetch();
                    $ergebnisA = $ergebnis_array["ergebnis_a"];
                    $ergebnisB = $ergebnis_array["ergebnis_b"];
                    ?> <script> document.getElementById("spiel<?php echo $i ?>").innerHTML =
                    "Spiel ist beendet <?php echo $mA ?> hat <?php echo $ergebnisA ?> Tore geschossen und <?php echo $mB ?> hat <?php echo $ergebnisB ?> Tore geschossen. Du hast auf dieses Spiel nicht getippt" ; </script> </div> <?php
                  }
                  ?> </div> <?php
              }
                }else {
                  $stmt = $db->prepare("SELECT b_f_id FROM benutzer_tippt_fußballspiel WHERE b_id = $benutzer_id and f_id = $i");
                  $stmt->execute();
                  $benutzerBereitsGetippt = $stmt->rowCount();
                  if($benutzerBereitsGetippt == 1){
                  $stmt = $db->prepare("SELECT * FROM benutzer_tippt_fußballspiel WHERE b_id = $benutzer_id and f_id = $i");
                  $stmt->execute();
                  $erhaltenArray = $stmt->fetch();
                  $erhalten = $erhaltenArray["punkteErhalten"];
                  if($erhalten == 0){
                  ausgabePunkte($i, $db, $benutzer_id, $punktestand);
                  $stmt = $db->prepare("UPDATE benutzer_tippt_fußballspiel SET punkteErhalten = true WHERE b_id = $benutzer_id and f_id = $i");
                  $stmt->execute();
                }
                else {
                  $stmt = $db->prepare("SELECT * FROM fußballspiel WHERE f_id = $i");
                  $stmt->execute();
                  $ergebnis_array = $stmt->fetch();
                  $ergebnisA = $ergebnis_array["ergebnis_a"];
                  $ergebnisB = $ergebnis_array["ergebnis_b"];
                   ?> <script> document.getElementById("spiel<?php echo $i ?>").innerHTML =
                   "Spiel ist beendet <?php echo $mA ?> hat <?php echo $ergebnisA ?> Tore geschossen und <?php echo $mB ?> hat <?php echo $ergebnisB ?> Tore geschossen. Deine Punkte wurden dir gut geschrieben"; </script> </div> <?php
                }
              }else {
                $stmt = $db->prepare("SELECT * FROM fußballspiel WHERE f_id = $i");
                $stmt->execute();
                $ergebnis_array = $stmt->fetch();
                $ergebnisA = $ergebnis_array["ergebnis_a"];
                $ergebnisB = $ergebnis_array["ergebnis_b"];
                ?> <script> document.getElementById("spiel<?php echo $i ?>").innerHTML =
                "Spiel ist beendet <?php echo $mA ?> hat <?php echo $ergebnisA ?> Tore geschossen und <?php echo $mB ?> hat <?php echo $ergebnisB ?> Tore geschossen. Du hast auf dieses Spiel nicht getippt" ; </script> </div> <?php
              }
                ?> </div> <?php
          }
            }
          }

//Wenn "Tipp Abgeben" button geklickt wird, dann die zahlen der zwei felder in datenbank eintragen
  if(isset($_POST["tippen_bt"])){
    if(is_numeric($_POST["tippA"]) && is_numeric($_POST["tippB"])){//Überprüfen ob die eingabe eine Zahl ist
      if($_POST["tippA"] <= 50 && $_POST["tippB"] <= 50){//Überprüfen ob die Eingabe 50 nicht übersteigt
        $tA = $_POST["tippA"]; //Eingabe A
        $tB = $_POST["tippB"]; //Eingabe B
        $benutzer_id;  //Id von Benutzer
        $w_spiel = $_POST["welchesSpiel"]; //Spiel dessen Button geklickt wurde

        $stmt = $db->prepare("SELECT b_f_id FROM benutzer_tippt_fußballspiel WHERE b_id = $benutzer_id and f_id = $w_spiel");
        $stmt->execute();
        $fußballspielBenutzer = $stmt->rowCount();
        if($fußballspielBenutzer == 0){
        $stmt = $db->prepare("INSERT INTO benutzer_tippt_fußballspiel (tipp_a, tipp_b, b_id, f_id, punkteErhalten) values ($tA, $tB, $benutzer_id, $w_spiel, false)");
        $stmt->execute();
      }
      }else {
      echo "<text class='fehlermedlung'>Deine Tipps dürfen nicht höher als 50 sein</text>";
      }
      }else {
        echo "<text class='fehlermedlung'>Deine Tipps müssen schon Zahlen sein</text>";
      }
    }
    ?>

  </body>
</html>
