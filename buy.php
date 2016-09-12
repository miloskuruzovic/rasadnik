<?php
require_once "core/init.php";
session_start();

if(isset($_SESSION['korisnik_id'],$_SESSION['ip'])){
	$korisnik_id = $_SESSION['korisnik_id'];
	$ip = $_SESSION['ip'];
}else{
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if (isset($_POST['s_id'], $_POST['kolicina'])) {
	$sadnica_id = (!empty($_POST['s_id']))?$_POST['s_id']:"";
	$kolicina = (!empty($_POST['kolicina']))?$_POST['kolicina']:"";
	

	$sadnica = Sadnice::get($sadnica_id);
	$cena = $sadnica->cena * $kolicina;

	
	$narudzbenica = new Narudzbenice;

	$narudzbenica->korisnik = $korisnik_id;
	$narudzbenica->sadnica = $sadnica_id;
	$narudzbenica->naziv_sadnice = $sadnica->naziv;
	$narudzbenica->kolicina = $kolicina;
	$narudzbenica->cena = $cena;
	$narudzbenica->ip = $ip;

	$narudzbenica->insert();

	header('Location: Home/Korpa');

}