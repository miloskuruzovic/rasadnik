<?php
include_once "modules/head.php";
include_once "modules/jumbotron.php"; 
include_once "modules/navigation.php";  
?>
<div id="main">

<div class="container">
<?php
if (isset($arg[2])){
$narudzbenice = $arg[2];

foreach ($narudzbenice as $narudzbenica) {
  $narudzbenica->renderTrack();
 }
}
 ?>
</div>
</div>
<?php
  include_once "modules/footer.php"; 
?>