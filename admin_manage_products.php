<?php
require_once 'core/init.php';
session_start();
ob_start();

include('src/abeautifulsite/SimpleImage.php');

if(isset($_POST['add_btn'])) {
	$sadnica = new Sadnice;
	$sadnica->naziv = $_POST['naziv'];
	$sadnica->opis = $_POST['opis'];
	$sadnica->stanje = $_POST['stanje'];
	$sadnica->cena = $_POST['cena'];
	$sadnica->akcija = (isset($_POST['akcija']))?$_POST['akcija']:"0";
	$sadnica->kategorija = $_POST['kategorija'];
	$sadnica->status = $_POST['status'];

	$id = $sadnica->insert();

	try{
		$slika = new abeautifulsite\SimpleImage($_FILES['slika']['tmp_name']);
		$slika->thumbnail(500,500);
		$slika->save("img/plants/".$id.".jpg");
	}catch(Exception $e){
		echo 'Error: ' . $e->getMessage();
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if(isset($_POST['upd_btn'])){
	$akcija = (isset($_POST['akcija']))?$_POST['akcija']:"0";
	Sadnice::update($_POST['sadnica'],
		array(
			'naziv' => $_POST['naziv'],
			'kategorija' => $_POST['kategorija'],
			'cena' => $_POST['cena'],
			'stanje' => $_POST['stanje'],
			'akcija' => $akcija,
			'opis' => $_POST['opis']
			));
if (isset($_FILES['slika']['tmp_name']) && !empty($_FILES['slika']['tmp_name'])) {
	try{
		$slika = new abeautifulsite\SimpleImage($_FILES['slika']['tmp_name']);
		$slika->thumbnail(500,500);
		$slika->save("img/plants/".$_POST['sadnica'].".jpg");
	}catch(Exception $e){
		echo 'Error: ' . $e->getMessage();
	}
}
header('Location: ' . $_SERVER['HTTP_REFERER']);	
}

if (isset($_POST['del_btn'])) {
	Sadnice::update($_POST['sadnica'],array('status' => '0'));
	header('Location: '. Config::get("home") .'Admin/Proizvodi');
}