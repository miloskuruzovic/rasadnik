<?php
ob_start();
include_once "modules/head.php";
include_once "modules/jumbotron.php"; 
include_once "modules/navigation.php";  
?>
<div id="main">
<div id="cartHeader">
<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<span class="cartHeaderText">Vaša Korpa</span>
		</div>
<?php if (isset($_SESSION['ip'])) { ?>
		<div class="col-sm-6 right">
			Vaša IP adresa:<br><span class="cartHeaderText"><?= $_SESSION['ip'] ?></span>
		</div>
<?php } ?>
	</div>
</div>
</div>
<?php
if (isset($arg[2])) {
  $narudzbenice = $arg[2];
?>
<div class="container">
<?php
  $total = 0;
foreach ($narudzbenice as $narudzbenica) {
 	$narudzbenica->render();
  $total += $narudzbenica->cena;
 }
}
 ?>
</div>
<div class="container">
  <div class="row">
    
    <div class="col-sm-3 right" id="cena_total">
        Ukupna cena: &nbsp;<span id="cena"><?= (isset($total))?$total:"0" ?></span> din.
    </div>
  </div>
</div>
<div class="container">
<div id="kupi_forma">
	<form action="" method="POST">
		<input type="submit" name="buy_btn" class="btn btn-default" value="Kupi">
	</form>
</div>
<?php
	echo (isset($arg[2]))?
	"":
	"<div id='prazna_korpa'>
		Vaša korpa je prazna. Ulogujte se kako biste kupovali!
	</div>";
?>
</div>
</div>
<?php
  include_once "modules/footer.php"; 
?>