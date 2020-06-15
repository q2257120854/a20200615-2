<?php
error_reporting(0);
header("Content-Type: text/html;charset=utf-8");
ini_set('session.cookie_httponly', 1);
session_start();
$Get_time = time();
if (isset($_POST['name'])&&isset($_POST['text'])&&isset($_POST['state'])) {
	$_name = $_POST['name'];
	$_text = $_POST['text'];
	$_icon = './assets/img/icon01.png';
	$_type = $_POST['state'];
	if ($_text!='') {
		include "data.php";
		$sql = "INSERT INTO chatnote (cn_name,cn_icon,cn_type,cn_text,cn_time) VALUES ('".$_name."', '".$_icon."','".$_type."','".$_text."','".$Get_time."')";
		$conn->exec($sql);
		$conn = null;
		echo 'ok';
	}
}
if (isset($_POST['name'])&&isset($_POST['state'])) {
	$_SESSION['cn_name'] = $_POST['name'];
	echo 'ok';
}