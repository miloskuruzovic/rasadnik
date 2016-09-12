<?php 
include_once "modules/head.php";
include_once "modules/jumbotron.php"; 
include_once "modules/navigation.php";  
?>
<div id="main">
<div class="container">
  <div class="row">
<?php
  $komentari = (isset($arg[4]))?$arg[4]:null;
  if (isset($arg[2])) {
    $sadnica = $arg[2];
    $sadnica->render(true);
?> 
  <div class="col-sm-4">
    <div class="panel panel-info">
      <div class="panel-heading">
      Ukupna cena: 
      </div>
      <div class="panel-body"><output id="cena"><?= $sadnica->cena ?></output> din.
      </div>
    </div>
    <div class="panel panel-default" id="more_info" >
      <?= $sadnica->opis ?>
    </div>
  </div>
  <div class="col-sm-4">
  <div class="panel panel-success">
    <form role="form" action="" method="post">
      <div class="form-group">
      <div class="panel-heading">
      <label for="poruka">Ostavite komentar:</label>
      </div>
      <div class="panel-body">
      <textarea name="komentar" class="form-control" rows="5" id="poruka" required></textarea>
      <br>
<?php
echo 
(isset($_SESSION['status']) && $_SESSION['status'] != 0)?
  '<input type="submit" name="add_comment" class="btn btn-default" value="Posalji" >':
  '<div id="notification" class="panel panel-danger">Morate biti ulogovani da biste ostavili komentar</div>';
?>
      
      </div>
      </div>
    </form>
  </div>
  </div>
  </div>
  <div class="row">     
    <div class="col-sm-2">
      <form action="buy.php" method="post">
        <input type="number" class="form-control input-sm" name="kolicina" min="1" max="<?= $sadnica->stanje ?>" value="1" onchange="cena.value=value*<?= $sadnica->cena ?>"><br><br>
        <input type="hidden" name="s_id" value="<?= $sadnica->sadnica_id ?>">
<?php
echo 
(isset($_SESSION['status']) && $_SESSION['status'] != 0)?
  '<input type="submit" class="btn btn-default" value="Dodaj u korpu">':
  '<div id="notification" class="panel panel-danger">Morate biti ulogovani da biste kupovali</div>';
?>      
      </form>
    </div>
    <div class="col-sm-2">
      <span id="stanje">Na stanju <span class="badge"><?= $sadnica->stanje ?></span></span>
    </div>
<?php
}
?>
    <div class="col-sm-8">
      <button data-toggle="collapse" data-target="#comments" class="btn btn-default">Prikaži poslednje komentare <span class="badge"><?= count($komentari); ?></span> </button>
      <div id="comments" class="collapse">
      <?php
        foreach ($komentari as $komentar) {
          $komentar->render();
        }
       ?>
    </div>
  </div>
</div>
</div> 
<?php
  include_once "modules/footer.php"; 
?>