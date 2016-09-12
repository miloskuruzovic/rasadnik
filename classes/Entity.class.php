<?php

abstract class Entity {

	public static $db;
	
	public static function get($id){
		$tableName = static::$tableName;
		$keyColumn = static::$keyColumn;
		$className = get_called_class();
		$db = Connect::getInstance();
		$res = $db->query("SET NAMES utf8");
		$res = $db->query("SELECT * FROM {$tableName} WHERE status = 1 AND {$keyColumn} = " . $id);
		$r = $res->fetchObject($className);
		return $r;
	}
	public static function getAll($filter = ""){
		$tableName = static::$tableName;
		$className = get_called_class();
		$db = Connect::getInstance();
		$res = $db->query("SET NAMES utf8");
		$res = $db->query("SELECT * FROM {$tableName} {$filter}");
		$arr = array();
		while($r = $res->fetchObject($className)){
			$arr[] = $r;
		}
		return $arr;
	}

	//new Article ;	$article->column = 'value'; Article::insert();

	public function insert(){
		$tableName = static::$tableName;
		$db = Connect::getInstance();
		$q = "INSERT INTO {$tableName} (";
		$columns = "";
		$values = "";
		foreach($this as $k=>$v){
			$columns .= $k . ", ";
			$values .= "'" . $v . "', ";
		}
		$columns = trim($columns, ', ');
		$values = trim($values, ', ');
		$q .= $columns . ') VALUES (' . $values . ')';
		$res = $db->query("SET NAMES utf8");
		$res = $db->query($q);
		return ($db->lastInsertId());
	}

	//Article::update($id,array('column'=>'new value','column2'=>'new value'))

	public static function update($id, $params = null){
		$tableName = static::$tableName;
		$keyColumn = static::$keyColumn;
		$db = Connect::getInstance();
		$res = $db->query("SET NAMES utf8");
		$q = "UPDATE {$tableName} SET ";
		$keys = array_keys($params);
		$values = array_values($params);
		foreach ($keys as $column) {
			$q.= $column . " = ?, ";
		}
		$q = trim($q,', ') . "WHERE {$keyColumn} = ?";
		$stmt = self::$db->prepare($q);
		$n = 1;
		foreach ($values as $value) {
			$stmt->bindValue($n, $value);
			$n++;
		}
		$stmt->bindValue($n, $id);
		$stmt->execute();
	}

	public static function remove($id){
		$tableName = static::$tableName;
		$keyColumn = static::$keyColumn;
		$db = Connect::getInstance();
		$res = $db->query("DELETE FROM {$tableName} WHERE {$keyColumn} = " . $id);
		return ($res->rowCount() > 0);
	}

	public static function init(){
		self::$db = Connect::getInstance();
	}
}

Entity::init();