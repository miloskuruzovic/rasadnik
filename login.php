<?php

if(isset($_POST['email'],$_POST['password'])){
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);

	if(!empty($email) && !empty($password)){
		require_once 'core/init.php';
		User::login($email,$password);
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
		
}