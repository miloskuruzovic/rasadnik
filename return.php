<?php

require_once "core/init.php";
session_start();

if (isset($_SESSION['korisnik_id'])) {
	if (isset($_GET['nid'])) {
		$nid = (!empty($_GET['nid']))?$_GET['nid']:'0';

		Narudzbenice::remove($nid);

		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
}else{
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}