<?php

try{
    $db = new mysqli("localhost", "root", "","tippspiel");
  ?>

  <link rel="stylesheet" href="login.css">

  <h2>Login</h2>

  <form action="" method="post">

  <label for="lbl_nickname">Nickname:</label><br>
  <input type="text" id="nickname" name="nickname"><br><br>

  <label for="lbl_vorname">Passwort:</label><br>
  <input type="password" id="passwort" name="passwort"><br>

  <a href="registrieren.php">Noch kein Konto?</a><br><br>

  <button type="submit" name="login" id="login">Einloggen</button>
  </form>

  <?php

  if(isset($_POST["login"])){
    $nin = $_POST["nickname"];
    $pw = $_POST["passwort"];

    $insert = "INSERT INTO `benutzer`(`nickname`, `passwort`)
  VALUES (?, ?)";

    $erg = $db->prepare($insert);
    $erg->bind_param("ss", $nin, $pw);
    $erg->execute();

    echo 'Eintrag erfolgreich';
  }
    $db->close();
    }catch(Exception $e){
      echo "Fehler:". $e->getMessage();
    }
  ?>
