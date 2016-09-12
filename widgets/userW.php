<div id="userW">
	<span class="User"><i class="fa fa-user" aria-hidden="true"></i></span>
 	<a href="Home/Profile/<?= $_SESSION['korisnik_id'] ?>"><?= $_SESSION['ime']." ".$_SESSION['prezime']  ?></a> &nbsp;&nbsp;&nbsp;&nbsp;
 	<a href="logout.php">Izlogujte se! <i class="fa fa-sign-out" aria-hidden="true"></i></a>
 </div>