<?php
require_once 'core/init.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>404</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css"/>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="icon" type="image/png" href="img/icon.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
  <div id="error404">
	<div class="container">
    <div class="row">
      <div class="col-sm-7">
        
      </div>
      <div class="col-sm-5">
      <div id="error404text">
        Nazalost,stranica koju ste izabrali ne postoji.<br>
        Molimo vas da se vratite na <a href="<?= Config::get('home') ?>">pocetnu!</a>
      </div>
      </div>
    </div>
  </div>
  </div>
</body>
