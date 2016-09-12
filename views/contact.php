<?php 
include_once "modules/head.php";
include_once "modules/jumbotron.php"; 
include_once "modules/navigation.php";  

?>
<div id="main">
<div class="container">
<div class="row">
  <div id="contactInfo" class="col-sm-6">
    <h2>Kontaktirajte nas</h2>
      <p>Radno vreme: svakim radnim danom i subotom od 8h - 20h</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Beograd, Srbija</p>
      <p><span class="glyphicon glyphicon-phone"></span> +381 64 1234567</p>
  </div>
  <div class="col-sm-6">
<div id="contactForm">
  
  <form role="form" action="" method="post">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name='email' class="form-control" id="email" placeholder="Vas email" value="<?= (isset($_SESSION['email']))?$_SESSION['email']:'' ?>" required>
    </div>
    <div class="form-group">
      <label for="ime">Vase Ime:</label>
      <input type="text" name='ime' class="form-control" id="ime" placeholder="Vase Ime" value="<?= (isset($_SESSION['ime']))?$_SESSION['ime']:'' ?>" required>
    </div>
    <div class="form-group">
      <label for="poruka">Poruka:</label>
      <textarea name="poruka" class="form-control" rows="5" id="poruka" required></textarea>
    </div>
    <input type="submit" name='send' class="btn btn-default" value="Pošalji" >
  </form>
</div>
</div>
</div>
<div class="row">
<?php
if(isset($arg[2])){
  $response = $arg[2];
echo (isset($response))?"<div class='alert alert-success'>Vasa poruka je uspesno poslata!</div>":"<div class='alert alert-warning'>Neuspesno slanje,molim vas pokusajte ponovo!</div>";
}

?>
</div>
</div>

<div id="mapContainer" class="container-fluid">
  <div id="googleMap" style="height:600px;width:100%;"></div>
</div>
</div>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="js/gMap.js"></script>
<?php
  include_once "modules/footer.php"; 
?>