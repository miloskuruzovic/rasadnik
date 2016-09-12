<?php
require_once 'core/init.php';
session_start();

$controller = "HomeController";
$method = "index";
$params = array();

if(isset($_GET['url'])){
  $url = explode('/', $_GET['url']);
  if(isset($url[0])){
    $controller = $url[0] . 'Controller';
    if(isset($url[1]) && !empty($url[1])){
      $method = $url[1];
    }
  }
    foreach ($url as $key => $value) {
    if($key < 2) continue;
    array_push($params, $value);
  }
}

if (class_exists($controller)) {
  $c = new $controller;
  if (method_exists($c, $method)) {
    $c->$method($params);
  }else{
    include_once '404.php';
  }
}else{
  include_once '404.php';
}
?>
