<?php 
include_once "modules/head.php";
include_once "modules/jumbotron.php"; 
include_once "modules/navigation.php";
$ip = $_SERVER['REMOTE_ADDR']; 
?>
<div id="main">
<div class="container">
  <form role="form" method="POST" action="">
  <div class="row">
    <div class="col-sm-6">
      <label class="control-label col-sm-2" for="f_email">Email:</label>
      <span class="control-label col-sm-10" id="email_verify" for="f_email"></span>
      <input id="f_email" type="email" class="form-control input-sm" placeholder="Email" name="email" required>
      <label class="control-label col-sm-2" for="f_password">Password:</label>
      <input type="password" class="form-control input-sm" placeholder="Password" name="password" id="f_password" required>
    </div>
    <div class="col-sm-6">
      <label class="control-label col-sm-2" for="f_ime">Ime:</label>
      <input type="text" class="form-control input-sm" placeholder="Ime" name="ime" id="f_ime" required>
      <label class="control-label col-sm-2" for="f_prezime">Prezime:</label>
      <input type="text" class="form-control input-sm" placeholder="Prezime" name="prezime" id="f_prezime" required>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <label class="control-label col-sm-2" for="f_adresa">Adresa:</label>
      <input type="text" class="form-control input-sm" placeholder="Adresa" name="adresa" id="f_adresa" required>
      <label class="control-label col-sm-2" for="f_p_broj">Postanski&nbsp;broj:</label>
      <input type="text" class="form-control input-sm" placeholder="Postanski broj" name="p_broj" id="f_p_broj" required>
    </div>
    <div class="col-sm-6">
      <label class="control-label col-sm-2" for="f_grad" required>Grad:</label>
      <input type="text" class="form-control input-sm" placeholder="Grad" name="grad" id="f_grad" required>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <input type="hidden" name="ip" value="<?= $ip ?>" name="f_ip">
      <input type="submit" value="Registruj se" name="reg_btn" id="f_reg_btn" class="btn btn-success">
    </div>
  </div>
  </form>
</div>
</div>
<script src="js/email_verify.js"></script>
<div class="container">
  <div class="row">
<?php
if(isset($arg[2])){
  echo $arg[2];
}
?>
  </div>
</div>
<?php
  include_once "modules/footer.php"; 
?>