<div class="topbox">
<h2 class="topboxtext">Südtirol Meisterschaft</h2>
<img class="falgge" src="Bilder/flagge_suedtirol.png" alt="Südtirol">
</div>

<?php
require_once('datenbank.php');
  ?>
  <link rel="stylesheet" href="style.css">
<div class="loginbox">
  <h2 class="login_titel">Registrieren</h2>
  <form action="" method="post">
  <label class="insiteloginbox" for="lbl_nickname">Nickname:</label><br>
  <input class="inputbox" type="text" id="nickname" name="nickname"><br><br>
  <label class="insiteloginbox" for="lbl_vorname">Passwort:</label><br>
  <input class="inputbox" type="password" id="password" name="password"><br><br>
  <label class="insiteloginbox" for="lbl_vorname">Passwort wiederholen:</label><br>
  <input class="inputbox" type="password" id="password2" name="password2"><br>
  </div>
<div class="link">


  <a href="login.php">Zurück zum Login</a><br><br>

  <button class="button_reg" type="submit" name="registrieren" id="registrieren">Registrieren</button>
  </form>
</div>
<div class="fehlermedlung">
  <?php

  if(isset($_POST["registrieren"])){
  $stmt = $db->prepare("SELECT * FROM benutzer WHERE nickname = :name"); //Überprüfen ob Nutzername bereits existiert
  $stmt->bindParam(":name", $_POST["nickname"]);
  $stmt->execute();
  $count = $stmt->rowCount();

if($_POST["nickname"] != null && $_POST["password"] != null){
  if($count == 0){
    //Nutzername ist frei
    if($_POST["password"] == $_POST["password2"]){ //Überprüfen ob passwörter übereinstimmen
      $stmt = $db->prepare("INSERT INTO benutzer (nickname, passwort, punktestand) values (:name, :passwort, 0)");
      $stmt->bindParam(":name", $_POST["nickname"]);
      $pwHash = password_hash($_POST["password"], PASSWORD_DEFAULT); //Passwort wird gehasht
      $stmt->bindParam(":passwort", $pwHash);
      $stmt->execute();
      header("Location: login.php");

    }else
      echo "Die Passwörter stimmen nicht überein";

  }else
    echo "Der Nutzername ist leider bereits vergeben";

  }else {
    echo "Gib bitte etwas in alle Felder ein";
  }
}
    ?>
  </div>
