<?php
require_once('datenbank.php');
  ?>

<div class="topbox">
<h2>Südtirol Meisterschaft</h2>
</div>
<div class="loginbox">
  <link rel="stylesheet" href="style.css">



  <h2 class="login_titel">Login</h2>

  <form action="" method="post">

  <label class="insiteloginbox" for="lbl_nickname">Nickname:</label><br>
  <input class="inputbox" type="text" id="nickname" name="nickname"><br><br>

  <label class="insiteloginbox" for="lbl_vorname">Passwort:</label><br>
  <input class="inputbox" type="password" id="password" name="password"><br>
</div>
<div class="link">


  <a href="registrieren.php">Noch kein Konto?</a><br><br>
  </div>



      <button class="button" type="submit" name="login" id="login">Einloggen</button>
  </form>




  <?php

  if(isset($_POST["login"])){
  $stmt = $db->prepare("SELECT * FROM benutzer WHERE nickname = :name"); //Überprüfen ob Nutzername bereits existiert
  $stmt->bindParam(":name", $_POST["nickname"]);
  $stmt->execute();
  $count = $stmt->rowCount();

  if($count == 1){
    //Nutzername existiert
    $row = $stmt->fetch();

    if(password_verify($_POST["password"], $row["passwort"])){ //Überprüfen ob Passwort stimmt
      session_start();
      $_SESSION["nickname"] = $row["nickname"];
      $_SESSION["benutzer"] = $_POST["nickname"];
      header("Location: tippspiel.php");

    }else{ //Passwort stimmt nicht
      echo "Der Nutzername und/oder das Passwort ist falsch";
      ?>
      <script>
        document.getElementById("nickname").value = "<?php echo $_POST["nickname"]; ?>";
      </script>
      <?php

}

}else{ //Nutzername existiert nicht
    echo "Der Nutzername und/oder das Passwort ist falsch";
    ?>
    <script>
      document.getElementById("nickname").value = "<?php echo $_POST["nickname"]; ?>";
    </script>
    <?php
}

  }
  ?>
