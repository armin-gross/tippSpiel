<?php
require_once('tippspiel.php');
require_once('datenbank.php');

  function ausgabePunkte($i, $db, $benutzer_id, $punktestand){
    $stmt = $db->prepare("SELECT * FROM benutzer_tippt_fußballspiel WHERE b_id = $benutzer_id and f_id = $i");
    $stmt->execute();
    $tipp_array = $stmt->fetch();
    $tippA = $tipp_array["tipp_a"];
    $tippB = $tipp_array["tipp_b"];

    $stmt = $db->prepare("SELECT * FROM fußballspiel WHERE f_id = $i");
    $stmt->execute();
    $ergebnis_array = $stmt->fetch();
    $ergebnisA = $ergebnis_array["ergebnis_a"];
    $ergebnisB = $ergebnis_array["ergebnis_b"];


    //richtiges Ergebnis
      if($tippA == $ergebnisA && $tippB == $ergebnisB){
        $punktestand += 3;
      }

      //richtige Tordifferenz
      $ergebnisDifferenz;
      if($ergebnisA > $ergebnisB){
        $ergebnisDifferenz =$ergebnisA-$ergebnisB;
      }
      if($ergebnisA < $ergebnisB){
        $ergebnisDifferenz = $ergebnisB-$ergebnisA;
      }
      if($ergebnisA == $ergebnisB){
        $ergebnisDifferenz = 0;
      }

      $tippDifferenz;
      if($tippA > $tippB){
        $tippDifferenz =$tippA-$tippB;
      }
      if($tippA < $tippB){
        $tippDifferenz = $tippB-$tippA;
      }
      if($tippA == $tippB){
        $tippDifferenz = 0;
      }

      if($ergebnisDifferenz == $tippDifferenz){
        $punktestand += 2;
      }


      //richtiger Gewinner
      if($ergebnisA > $ergebnisB){
        if($tippA > $tippB){
          $punktestand += 1;
        }
      }

      if($ergebnisB > $ergebnisA){
        if($tippB > $tippA){
          $punktestand += 1;
        }
      }

      if($ergebnisA == $ergebnisB){
        if($tippA == $tippB){
          $punktestand += 1;
        }
      }

      $stmt = $db->prepare("UPDATE benutzer SET punktestand = $punktestand WHERE b_id = $benutzer_id");
      $stmt->execute();

  }

 ?>
