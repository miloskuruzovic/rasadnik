<?php 
include_once "modules/head.php";

if($_SESSION['status'] != 2){
	header('Location: ' . Config::get('home'));
}
?>
<body>
<div class="container-fluid">
	<h1>Upravljanje korisnicima</h1>
	<div class="row">
		<div class="col-sm-3">
			<div id="select_users">
			<ul class="list-group">
			  <a class="list-group-item" href="Admin/Korisnici">Svi korisnici</a>
			  <a class="list-group-item" href="Admin/Korisnici/Blokirani">Blokirani korisnici</a>
			  <a class="list-group-item" href="Admin/Korisnici/Aktivni">Aktivni korisnici</a>
			  <a class="list-group-item" href="Admin/Korisnici/Administratori">Administratori</a>
			</ul>
			</div>
		</div>
		<div class="col-sm-9">
			<div class="table-responsive">  
  				<table class="table">
    				<thead>
     				<tr>
        				<th>#</th>
        				<th>Email</th>
        				<th>Ime i Prezime</th>
        				<th>Adresa</th>
        				<th>Grad</th>
       					<th>Postanski broj</th>
        				<th>Datum registracije</th>
        				<th>IP</th>
        				<th>Status</th>
        				<th>Promeni status</th>
      				</tr>
    				</thead>
    				<tbody>
<?php
	$users = $arg[2];
	foreach ($users as $user) {
		$user->renderTableRow();
	}
?>
    				</tbody>
  				</table>
  			</div>		
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