<?php
require_once('datenbank.php');
session_start();
$benutzer = $_SESSION["benutzer"];
$stmt = $db->prepare("DELETE FROM `benutzer` WHERE `benutzer`.`nickname` = '$benutzer';");
$stmt->execute();
session_destroy();
header("Location: login.php");
 ?>
