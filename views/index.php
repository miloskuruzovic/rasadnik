<?php 
include_once "modules/head.php";
include_once "modules/jumbotron.php"; 
include_once "modules/navigation.php";  

?>
<div id="main">
<?php
$sadnice = $arg[2];
$i = 0;
foreach ($sadnice as $sadnica) {
  echo ($i%3 == 0)?'<div class="container"><div class="row">':'';
  $i++;
  $sadnica->render();
  echo ($i%3 == 0)?'</div></div>':''; 
}
?>
</div>
<?php
  include_once "modules/footer.php"; 
?>
