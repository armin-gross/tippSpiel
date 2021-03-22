<?php
$host = "localhost";
$name = "tippspiel";
$user = "root";
$passwort = "";

try{
  $db = new PDO("mysql:host=$host;dbname=$name", $user, $passwort);
}catch(PDOException $e){
      echo "Fehler:". $e->getMessage();
    }
 ?>
