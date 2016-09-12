<?php
require_once "core/init.php";

if (isset($_GET['hash'])) {
	$hash = $_GET['hash'];
	User::activate($hash);
	header('Location: ' . Config::get('home'));
}else{
	header('Location: ' . Config::get('home'));
}