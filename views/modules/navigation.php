<div id="navWrapper">
<nav class="navbar navbar-default" data-spy="affix" data-offset-top="255" id="mainNav">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" id="btnArrow" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
      <span id="ddArrow">
      <i class="fa fa-bars" aria-hidden="true"></i>
      </span>          
      </button>
      <a class="navbar-brand" href="Home"><img id="logoimg" src="img/logo1.png"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav" id="navigation_main">
        <li <?= ($title == 'Akcija')?'class="active"':''?>><a href="Home">Akcija!</a></li>
        <li <?= ($title == 'Sadnice' || $title == 'Pretraga')?'class="active"':''?>><a href="Home/Sadnice">Sadnice</a></li>
        <li>
          <div class="dropdown">
            <button id="ddbtn" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span class="caret"></span></button>
              <ul id="ddmenu" class="dropdown-menu">
<?php
  $kategorije = $arg[3];
  foreach ($kategorije as $kategorija) {
        echo "<li><a href='Home/Sadnice/$kategorija->naziv_kategorije'>$kategorija->naziv_kategorije</a></li>";
  }
?>
                <li><form method="POST" action="Home/Pretraga"><input type="text" name="search" class="form-control input-sm" placeholder="Unesite termin">
                <input type="submit" id="searchBtn" class="btn btn-default" value="Pretrazi"></form></li>
              </ul>
          </div>
        </li>
        <li <?= ($title == 'Kontakt')?'class="active"':''?>><a href="Home/Contact">Kontakt</a></li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
<?php echo (isset($_SESSION['korisnik_id']))?"":
        '<li><a href="Home/Register"><span class="User"><i class="fa fa-user-plus" aria-hidden="true"></i></span>&nbsp;&nbsp; Nemate nalog ? </a></li>'
?>
        <li>
          <?php
          include_once (isset($_SESSION['w']))?'widgets/' . $_SESSION['w'] . '.php':'widgets/loginW.php';
          ?>
        </li>
        <li <?= ($title == 'Korpa')?'class="active"':''?>><a href="Home/Korpa"><span class="glyphicon glyphicon-shopping-cart"></span> Korpa</a></li>
      </ul>
    </div>
  </div>
</nav>
</div>