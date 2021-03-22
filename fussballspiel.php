<?php
class fussballspiel {
  public $spiel;
  public $db;
function __construct($welschesSpiel, $datenbank){
  $this->spiel = $welschesSpiel;
  $this->db = $datenbank;
}


function getManschaft($mannschaft){
  if($mannschaft == "a"){
    $stmt = $this->db->prepare("SELECT mannschaft.nickname from fußballspiel, mannschaft where mannschaft.m_id = (SELECT fußballspiel.m_id_a FROM `fußballspiel` WHERE f_id = $this->spiel)");
    $stmt->execute();
    $spiel1_mannschaft = $stmt->fetch();
}
  if($mannschaft == "b"){
    $stmt = $this->db->prepare("SELECT mannschaft.nickname from fußballspiel, mannschaft where mannschaft.m_id = (SELECT fußballspiel.m_id_b FROM `fußballspiel` WHERE f_id = $this->spiel)");
    $stmt->execute();
    $spiel1_mannschaft = $stmt->fetch();
}
return $spiel1_mannschaft["nickname"];
}


function getDatum(){
  $stmt = $this->db->prepare("SELECT `tag` FROM `fußballspiel` WHERE f_id = $this->spiel");
  $stmt->execute();
  $date = $stmt->fetch();
  return $date["tag"];
}


function getuhrzeit(){
  $stmt = $this->db->prepare("SELECT `zeit` FROM `fußballspiel` WHERE f_id = $this->spiel");
  $stmt->execute();
  $zeit = $stmt->fetch();
  return $zeit["zeit"];
}


}
 ?>