<?php 
include_once "modules/head.php";

if($_SESSION['status'] != 2){
	header('Location: ' . Config::get('home'));
}
?>
<body>
<div class="container-fluid">
	<h1>Narudzbenice</h1>
	<div class="row">
		<div class="col-sm-2">
			<div id="select_users">
			<ul class="list-group">
			  <a class="list-group-item" href="Admin/Porudzbine">Svi Porudzbine</a>
			  <a class="list-group-item" href="Admin/Porudzbine/Korpe">Korpe</a>
			  <a class="list-group-item" href="Admin/Porudzbine/Obrada">U obradi</a>
			  <a class="list-group-item" href="Admin/Porudzbine/Prihvacene">Prihvacene</a>
			  <a class="list-group-item" href="Admin/Porudzbine/Poslate">Poslate</a>
			  <a class="list-group-item" href="Admin/Porudzbine/Zatvorene">Zatvorene</a>
			</ul>
			</div>
			<form action="admin_clear_closed_orders.php" method="POST">
				<input type="submit" name="clear" value="Ocisti zatvorene porudzbine" class="btn btn-default">
			</form>
		</div>
		<div class="col-sm-10">
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
        				<th>Datum narucivanja</th>
        				<th>IP</th>
        				<th>ID i naziv sadnice</th>
        				<th>Kolicina</th>
        				<th>Cena</th>
        				<th>Status posiljke</th>
        				<th>Promeni status</th>
        				<th>< 10</th>
      				</tr>
    				</thead>
    				<tbody>
<?php
	$orders = $arg[2];
	foreach ($orders as $order) {
		$order->renderAdmin();
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