<?php
require_once 'core/init.php';

$key = array_keys($_GET);
$param = $key[0];
$value = array_values($_GET);
$korisnik_id = $value[0];

switch ($param) {
	case 'b_u_id':
		User::update($korisnik_id,array('status'=>'0'));
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		break;
	case 'a_u_id':
		User::update($korisnik_id,array('status'=>'1'));
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		break;
	case 'm_u_id':
		User::update($korisnik_id,array('status'=>'2'));
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		break;
	
	default:
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		break;
}