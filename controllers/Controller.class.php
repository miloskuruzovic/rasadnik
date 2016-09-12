<?php

abstract class Controller {
	public function index(){
		require_once '404.php';
	}
	public static function view(){
		$arg = func_get_args();
		$viewName = $arg[0];
		$title = $arg[1];
		require_once "views/{$viewName}.php";
	}
}