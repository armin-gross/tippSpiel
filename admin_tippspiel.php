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
$benutzer = $_SESSION["benutzer"];
if($benutzer != "admin"){
  header("Location: tippspiel.php");
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="aufSpielSetzen.js"></script>
  </head>
  <body>

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



    <form method="post" id="form_spiel_erstellen">
      <button type="button" name="spiel_erstellen_Felder_button" id="spiel_erstellen_Felder_button" onclick=neueManschaftenAdmin() style="margin-top: 100px;">Spiel erstellen</button>
    </form>

    <?php

    if(isset($_POST["teamsEintragen"])){
      if(!empty($_POST["neuesTeamA"]) && !empty($_POST["neuesTeamB"]) && !ctype_space($_POST["neuesTeamA"]) && !ctype_space($_POST["neuesTeamB"])){
          $_SESSION["teamA"] = $_POST["neuesTeamA"];
          $_SESSION["teamB"] = $_POST["neuesTeamB"];
          $teamA = $_SESSION["teamA"];
          $teamB = $_SESSION["teamB"];
          $stmt = $db->prepare("INSERT INTO mannschaft (nickname) VALUES ('$teamA'),('$teamB')");
          $stmt->execute();
          ?> <script> neuesErgebnisAdmin("<?php echo $_SESSION["teamA"] ?>", "<?php echo $_SESSION["teamB"] ?>") </script> <?php
        }else{
          echo "Bitte gib in beide Felder etwas ein";
          ?> <script> neueManschaftenAdmin() </script> <?php
        }
      }

    if(isset($_POST["toreEintragen"])){
      if(!empty($_POST["toreTeamA"]) && !empty($_POST["toreTeamB"])){
        if(is_numeric($_POST["toreTeamA"]) && is_numeric($_POST["toreTeamB"])){
          if($_POST["toreTeamA"] <= 50 && $_POST["toreTeamB"] <= 50){
              $_SESSION["toreTeamA"] = $_POST["toreTeamA"];
              $_SESSION["toreTeamB"] = $_POST["toreTeamB"];
              ?> <script> datumUhrzeit() </script> <?php
            }else{
              echo "Die Eingabe darf 50 nicht übersteigen";
              ?> <script> neuesErgebnisAdmin("<?php echo $_SESSION["teamA"] ?>", "<?php echo $_SESSION["teamB"] ?>") </script> <?php
            }
          }else{
            echo "Die Eingabe muss eine Zahl sein";
            ?> <script> neuesErgebnisAdmin("<?php echo $_SESSION["teamA"] ?>", "<?php echo $_SESSION["teamB"] ?>") </script> <?php
          }
        }else {
          echo "Bitte gib in beide Felder etwas ein";
        }
      }


    if(isset($_POST["datumUhrzeitEintragen"])){
      if(!empty($_POST["uhrzeit"]) && !empty($_POST["datum"])){
        $teamA = $_SESSION["teamA"];
        $teamB = $_SESSION["teamB"];
        $toreTeamA = $_SESSION["toreTeamA"];
        $toreTeamB = $_SESSION["toreTeamB"];
        $datum = $_POST["datum"];
        $uhrzeit = $_POST["uhrzeit"];
        $stmt = $db->prepare("INSERT INTO fußballspiel(tag, zeit, ergebnis_a, ergebnis_b, m_id_a, m_id_b) VALUES
                            ('$datum', '$uhrzeit', $toreTeamA, $toreTeamB,
                            (SELECT mannschaft.m_id from mannschaft where mannschaft.nickname = '$teamA'),
                            (SELECT mannschaft.m_id from mannschaft where mannschaft.nickname = '$teamB'))"
                            );
        $stmt->execute();
        echo "Neues Fußballspiel wurde Erfolgreich hinzugefügt";
    }else {
      echo "Bitte gib Datum und Uhrzeit an";
      ?> <script> datumUhrzeit() </script> <?php
    }
}
     ?>

  </body>
</html>
