<?php

class Connect{
	private function __construct(){}
	
	private static $_instance = null;
	public static function getInstance(){
		if(is_null(self::$_instance)){
			self::$_instance = new PDO("mysql:host=" . Config::get('DB/host') . ";dbname=" . Config::get('DB/db_name'),Config::get('DB/user'),Config::get('DB/password'));
		}
		return self::$_instance;
	}
}