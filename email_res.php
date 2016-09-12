<?php
require_once 'core/init.php';

$db = Connect::getInstance();
$res = $db->query("SELECT email FROM korisnici");

while ($r = $res->fetch(PDO::FETCH_OBJ)) {
	$email_list[] = $r;
}

$email_list = json_encode($email_list);

echo $email_list;