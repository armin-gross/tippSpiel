<?php
require_once('datenbank.php');
require_once('fussballspiel.php');

$spiel1 = new fussballspiel(1, $db);
$spiel2 = new fussballspiel(2, $db);
$spiel3 = new fussballspiel(3, $db);
$spiel4 = new fussballspiel(4, $db);
?>
<script>
function setMannschaft(){
document.getElementById("spiel1").innerHTML = "<?php echo $spiel1->getManschaft('a'); ?> gegen <?php  echo $spiel1->getManschaft('b'); ?>";
document.getElementById("spiel2").innerHTML = "<?php echo $spiel2->getManschaft('a'); ?> gegen <?php  echo $spiel2->getManschaft('b'); ?>";
document.getElementById("spiel3").innerHTML = "<?php echo $spiel3->getManschaft('a'); ?> gegen <?php  echo $spiel3->getManschaft('b'); ?>";
document.getElementById("spiel4").innerHTML = "<?php echo $spiel4->getManschaft('a'); ?> gegen <?php  echo $spiel4->getManschaft('b'); ?>";
}
</script>
