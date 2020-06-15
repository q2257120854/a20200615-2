<?php
$databases = include_once("../application/database.php");

$host= $databases['hostname'];//数据库连接地址
$username = $databases['database'];//数据库账号
$password = $databases['password'];//数据库密码
$dbname =$databases['username'];//数据库名

try{
    $conn = new PDO("mysql:host=$host;dbname=$dbname","$username","$password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec('set names utf8');
}
catch(PDOException $e){
    die("数据库连接失败".$e->getMessage());
}



 ?>
