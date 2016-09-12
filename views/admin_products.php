<?php
include_once "modules/head.php";

if($_SESSION['status'] != 2){
	header('Location: ' . Config::get('home'));
}

$kategorije = $arg[3];
$sadnice = $arg[2];

$sel_sadnica = "";
$sel_kategorija = "";
$sel_naziv = "";
$sel_opis = "";
$sel_stanje = "";
$sel_cena = "";
$sel_akcija = "";

if (isset($arg[4])) {
	$sadnica = $arg[4];
	$sel_sadnica = $sadnica->sadnica_id;
	$sel_kategorija = $sadnica->kategorija;
	$sel_naziv = $sadnica->naziv;
	$sel_opis = $sadnica->opis;
	$sel_stanje = $sadnica->stanje;
	$sel_cena = $sadnica->cena;
	$sel_akcija = $sadnica->akcija;
}

?>
<body>
<div class="container-fluid">
	<h1>Sadnice</h1>
	<div class="row">
		<div class="col-sm-2">
		<img src="img/plants/<?= $sel_sadnica ?>.jpg" class="img-responsive" style="width:100%" alt="">
		</div>
		<div class="col-sm-10">
			<form action="admin_manage_products.php" method="post" enctype="multipart/form-data">
				<div class="row">
				<div class="col-sm-3"> 
			      <label for="f_sadnica">Sadnice:</label>
			      <select name ="sadnica" id="f_sadnica" class="form-control" onchange="window.location='Admin/Proizvodi/'+this.value">
			      	<option value="-1">Izaberi Sadnicu</option>
<?php
	foreach ($sadnice as $sadnica) {
		echo "<option " . ($sel_sadnica==$sadnica->sadnica_id?"selected":"") . " " . ($sadnica->stanje<10?"style='color:red'":"") . "value='{$sadnica->sadnica_id}'>{$sadnica->naziv}</option>";
	}
?>
			      </select>
			      <br>
			      <label for="f_kategorija">Kategorije:</label>
			      <select name="kategorija" id="f_kategorija" class="form-control">
			      	<option value="-1">Izaberi Kategoriju</option>
<?php
	foreach ($kategorije as $kategorija) {
		echo "<option " . ($sel_kategorija==$kategorija->kategorija_id?"selected":"") . " value='{$kategorija->kategorija_id}'>{$kategorija->naziv_kategorije}</option>";
	}
?>		      	
			      </select>
			    </div>
			    <div class="col-sm-3">
			      <label class="control-label col-sm-2" for="f_naziv">Naziv:</label>
			      <input type="text" class="form-control input-sm" placeholder="Naziv" name="naziv" id="f_naziv" value="<?= $sel_naziv ?>" required>
			      <label class="control-label col-sm-2" for="f_cena">Cena:</label>
			      <input type="text" class="form-control input-sm" placeholder="Cena" name="cena" id="f_cena" value="<?= $sel_cena ?>" required>
			    </div>
			    <div class="col-sm-3">
			      <label class="control-label col-sm-2" for="f_stanje">Stanje:</label>
			      <input type="number" class="form-control input-sm" placeholder="Stanje" name="stanje" id="f_stanje" value="<?= $sel_stanje ?>" required >
			      <label class="control-label col-sm-2" for="f_opis">Opis:</label>
			      <input type="text" class="form-control input-sm" placeholder="Opis" name="opis" id="f_opis" value="<?= $sel_opis ?>" required>
			    </div>
			    <div class="col-sm-3"> 
			      <div class="checkbox" id="f_akcija">
  					<label><input type="checkbox" name="akcija" value="1" <?= ($sel_akcija==1)?"checked":"" ?> >Na akciji</label>
				  </div>
				  <label class="control-label col-sm-2" for="f_slika">Slika:</label><br>
				  <input type="file" name="slika" id="f_slika" class="btn btn-default">
				  <input type="hidden" name="status" value="1">
				  <div class="btn-group" id="f_submit">
				  	<input type="submit" value="Dodaj" name="add_btn" class="btn btn-success">
				  	<input type="submit" value="Izmeni" name="upd_btn" class="btn btn-warning">
				  	<input type="submit" value="Ukloni" name="del_btn" class="btn btn-danger">
				  </div>
			    </div>
			  </div>
			</form>
  		</div>		
		</div>
	<div class="row">
		<div class="col-sm-3">
		<a href="admin.php">Povratak na admin stranu</a>
		</div>
	</div>
	</div>
	
</body>
</html>