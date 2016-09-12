<?php

require_once 'core/init.php';

$key = array_keys($_GET);
$param = $key[0];
$value = array_values($_GET);
$narudzbenica_id = $value[0];

switch ($param) {
	case 'p_o_id':
		Narudzbenice::update($narudzbenica_id, array('n_status'=>'3'));
		Sadnice::updateStanje($narudzbenica_id);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		break;
	case 'i_o_id':
		Narudzbenice::update($narudzbenica_id,array('n_status'=>'4'));
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		break;
	case 'z_o_id':
		Narudzbenice::update($narudzbenica_id,array('n_status'=>'5'));
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		break;
	default:
		break;
}