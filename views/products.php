<?php 
include_once "modules/head.php";
include_once "modules/jumbotron.php"; 
include_once "modules/navigation.php";  

?>
<div id="main">
<?php
if (isset($arg[2])) {
  $sadnice = $arg[2];
  $i = 0;
    foreach ($sadnice as $sadnica) {
      echo ($i%3 == 0)?'<div class="container"><div class="row">':'';
      $i++;
      $sadnica->render();
      echo ($i%3 == 0)?'</div></div>':'';
    }
    echo ($i%3 != 0)?'</div></div>':'';
}else{
  $kategorije = $arg[3];
  $i = 0;
    foreach ($kategorije as $kategorija) {
      echo ($i%3 == 0)?'<div class="container-fluid"><div class="row">':'';
      $i++;
      $kategorija->render();
      echo ($i%3 == 0)?'</div></div>':'';  
    }
  echo ($i%3 != 0)?'</div></div>':'';
}
    
?>
</div>
<?php
  include_once "modules/footer.php"; 
?>
