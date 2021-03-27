<?php
require_once('datenbank.php');
require_once('fussballspiel.php');

session_start();
if(!isset($_SESSION["nickname"])){
  header("Location: login.php");
  exit;
}
$benutzer = $_SESSION["benutzer"];

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
$stmt = $db->prepare("SELECT max(f_id) FROM `fußballspiel`");
$stmt->execute();
$anzahlSpiele_array = $stmt->fetch();
$anzahlSpiele = $anzahlSpiele_array["max(f_id)"];


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
    <p id="nutzername"></p>
    <script>document.getElementById("nutzername").innerHTML = "Angemeldet als: <?php echo $benutzer ?>";</script>
    <p id="punktestand">213</p><br>
    <script>document.getElementById("punktestand").innerHTML = "Dein Punktestand: <?php echo $punktestand; ?>";</script>




    <?php

    for ($i=1; $i <= $anzahlSpiele; $i++) {
      $spiel = new fussballspiel($i, $db);
      $mA = $spiel->getManschaft('a');
      $mB = $spiel->getManschaft('b');
    ?>
    <!-- Ausgabe des spiels an stelle $i -->
    <h3>Fußballspiel <?php echo $i?>:</h3>
    <p id="spiel<?php echo $i?>"></p>

    <form method="post">
    <input name="welchesSpiel" value="<?php echo $i?>" readonly size="1px"><!-- input um zu wissen, wessen spiels button geklickt wurde -->
    <button type="submit" id="spiel<?php echo $i?>_bt" name="spiel_bt"
    onclick=neuesFeld(<?php echo $i?>,"<?php echo $mA; ?>","<?php echo $mB; ?>",<?php echo $anzahlSpiele; ?>)
    >Wette auf diesem Spiel platzieren</button><!-- button der onclick i, mannschaftA, mannschaftB und anzahlSpiele übergibt -->
    </form><br>
    <!-- //Ausgabe: Mannschaft A spielt gegen Mannschaft b am "Datum" umd "Uhrzeit" -->
    <script>
    document.getElementById("spiel<?php echo $i?>").innerHTML =
    "<?php echo $mA; ?> gegen <?php echo $mB; ?>, gespielt wird am <?php echo $spiel->getDatum(); ?> um <?php echo $spiel->getuhrzeit(); ?> Uhr";
    </script>
    <?php
  }



  // $w_spiel = $_POST["welchesSpiel"]; //Id des Spiels dessen Button geklickt wurde

  // überprüfen ob Benutzer schon auf Spiele getippt hat
  // $stmt = $db->prepare("SELECT * FROM benutzer_tippt_fußballspiel WHERE b_id = $benutzer_id and f_id = $w_spiel");
  // $stmt->execute();
  // $BenutzerTippsAufSpiel = $stmt->rowCount();
  //  if($BenutzerTippsAufSpiel != 0){
  //    ?>
  <!--     <script>loescheButton(<?php //echo $w_spiel ?>)</script> -->
      <?php
  //  }




//Wenn "Tipp Abgeben" button geklickt wird, dann die zahlen der zwei felder in datenbank eintragen
  if(isset($_POST["tippen_bt"])){
    // echo $_POST["spiel_bt"];
    if(is_numeric($_POST["tippA"]) && is_numeric($_POST["tippB"])){//Überprüfen ob die eingabe eine Zahl ist
      if($_POST["tippA"] <= 50 && $_POST["tippB"] <= 50){//Überprüfen ob die Eingabe 50 nicht übersteigt
        $tA = $_POST["tippA"]; //Eingabe A
        $tB = $_POST["tippB"]; //Eingabe B
        $benutzer_id;  //Id von Benutzer
        $w_spiel = $_POST["welchesSpiel"]; //Spiel dessen Button geklickt wurde
        // echo $test;
        echo $w_spiel;
        $stmt = $db->prepare("INSERT INTO benutzer_tippt_fußballspiel (tipp_a, tipp_b, b_id, f_id) values ($tA, $tB, $benutzer_id, $w_spiel)");
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
