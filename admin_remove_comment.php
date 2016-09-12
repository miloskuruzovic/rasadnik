<?php
require_once 'core/init.php';

if(isset($_GET['c_id'])){
	$id =  $_GET['c_id'];
	Comments::remove($id);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);