<?php
require_once 'core/init.php';

if (isset($_POST['clear'])) {
	$filter = "WHERE status = 1 AND n_status = 5";
	$orders = Narudzbenice::getAll($filter);

	if(!empty($orders)){
		foreach ($orders as $order) {
			Narudzbenice::update($order->narudzbenica_id, array('status' => 0));
		}
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}