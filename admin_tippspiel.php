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
        $teamA = $_POST["neuesTeamA"];
        $teamB = $_POST["neuesTeamB"];
        echo "Team a: ".$teamA." ";
        echo "Team B: ".$teamB." ";
      ?>
      <script> neuesErgebnisAdmin("<?php echo $teamA ?>", "<?php echo $teamB ?>") </script>
      <?php
}

    if(isset($_POST["toreEintragen"])){
        $teamA = $_POST["neuesTeamA"];
        $teamB = $_POST["neuesTeamB"];
        echo $teamA;
        echo $teamB;
      ?>
      <script> datumUhrzeit() </script>
      <?php
}

    if(isset($_POST["toreEintragen"])){
      $teamA = $_POST["neuesTeamA"];
      $teamB = $_POST["neuesTeamB"];
      echo $teamA;
      echo $teamB;
}
     ?>

  </body>
</html>
