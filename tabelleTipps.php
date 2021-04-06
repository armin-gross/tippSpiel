<?php

function tabelle($db, $welchesSpiel){
  $stmtBenutzer = $db->prepare("SELECT * FROM benutzer");
  $stmtBenutzer->execute();
  $anzahlBenutzer = $stmtBenutzer->rowCount();

  $stmtTeams = $db->prepare("select mannschaft.nickname from mannschaft where
  mannschaft.m_id = (select fußballspiel.m_id_a from fußballspiel where fußballspiel.f_id = $welchesSpiel) or
  mannschaft.m_id = (select fußballspiel.m_id_b from fußballspiel where fußballspiel.f_id = $welchesSpiel)");
  $stmtTeams->execute();
  $anzahlTeams = $stmtTeams->rowCount();


  echo '<table border="1">';

  echo "<tr>";
  echo "<td></td>";
    for ($i=0; $i < $anzahlTeams ; $i++) {
      //ausgabe Teams
      $teams_array = $stmtTeams->fetch();
      $teams = $teams_array["nickname"];
      echo "<td>". $teams . "</td>";
    }
    echo "</tr>";

  for ($i=0; $i < $anzahlBenutzer ; $i++) {
    //ausgabe Benutzer und tipps
    $benutzer_array = $stmtBenutzer->fetch();
    $benutzer = $benutzer_array["nickname"];
    $benutzer_id = $benutzer_array["b_id"];

    $stmtTippA = $db->prepare("SELECT tipp_a FROM benutzer_tippt_fußballspiel WHERE b_id = $benutzer_id and f_id = $welchesSpiel");
    $stmtTippA->execute();
    $anzahlTippA = $stmtTippA->rowCount();

    $stmtTippB = $db->prepare("SELECT tipp_b FROM benutzer_tippt_fußballspiel WHERE b_id = $benutzer_id and f_id = $welchesSpiel");
    $stmtTippB->execute();
    $anzahlTippB = $stmtTippB->rowCount();

      if($anzahlTippA != 0 && $anzahlTippB != 0){
        $tippA_array = $stmtTippA->fetch();
        $tippA = $tippA_array["tipp_a"];

        $tippB_array = $stmtTippB->fetch();
        $tippB = $tippB_array["tipp_b"];

        echo "<tr>";
        echo "<td>" .$benutzer. "</td>";
        echo "<td>" .$tippA. "</td>";
        echo "<td>" .$tippB. "</td>";
        echo "</tr>";
      }else if($benutzer != "admin"){
        echo "<tr>";
        echo "<td>". $benutzer . "</td>";
        echo "<td>kein Tipp</td>";
        echo "<td>kein Tipp</td>";
        echo "</tr>";
      }
  }

  echo "</table>";
}

 ?>
