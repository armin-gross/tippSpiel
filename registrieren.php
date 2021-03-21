<?php
$host = "localhost";
$name = "tippspiel";
$user = "root";
$passwort = "";

try{
  $db = new PDO("mysql:host=$host;dbname=$name", $user, $passwort);


  ?>
  <link rel="stylesheet" href="style.css">

  <h2>Registrieren</h2>
  <form action="" method="post">

  <label for="lbl_nickname">Nickname:</label><br>
  <input type="text" id="nickname" name="nickname"><br><br>

  <label for="lbl_vorname">Passwort:</label><br>
  <input type="password" id="password" name="password"><br><br>

  <label for="lbl_vorname">Passwort wiederholen:</label><br>
  <input type="password" id="password2" name="password2"><br>

  <a href="login.php">Zurück zum Login</a><br><br>

  <button type="submit" name="registrieren" id="registrieren">Registrieren</button>
  </form>

  <?php

  if(isset($_POST["registrieren"])){
  $stmt = $db->prepare("SELECT * FROM benutzer WHERE nickname = :name"); //Überprüfen ob Nutzername bereits existiert
  $stmt->bindParam(":name", $_POST["nickname"]);
  $stmt->execute();
  $count = $stmt->rowCount();

  if($count == 0){
    //Nutzername ist frei
    if($_POST["password"] == $_POST["password2"]){ //Überprüfen ob passwörter übereinstimmen
      $stmt = $db->prepare("INSERT INTO benutzer (nickname, passwort) values (:name, :passwort)");
      $stmt->bindParam(":name", $_POST["nickname"]);
      $pwHash = password_hash($_POST["password"], PASSWORD_DEFAULT); //Passwort wird gehasht
      $stmt->bindParam(":passwort", $pwHash);
      $stmt->execute();
      echo "Dein Account wurde Angelegt";

    }else
      echo "Die Passwörter stimmen nicht überein";

  }else
    echo "Der Nutzername ist leider bereits vergeben";

  }
  }catch(PDOException $e){
      echo "Fehler:". $e->getMessage();
    }
    ?>
