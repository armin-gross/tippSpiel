<?php
session_start();
if(!isset($_SESSION["nickname"])){
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>du existierst</h1>
    <a href="logout.php">Abmelden</a>
  </body>
</html>
