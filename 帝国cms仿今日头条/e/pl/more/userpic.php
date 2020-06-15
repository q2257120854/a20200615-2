<?php
require("../../class/connect.php");
eCheckCloseMods('pl');//╧ь╠удё©И

require("../../class/db_sql.php");
require("../../class/q_functions.php");
$link=db_connect();
$empire=new mysqlquery();


$userid=($_COOKIE[$ecms_config['cks']['ckvarpre'].'mluserid']);
if(empty($userid)){
	exit();
}

$userpic = $empire->fetch1("select * from {$dbtbpre}enewsmemberadd where userid=$userid limit 1");
if($userpic['userpic']){
	echo $userpic['userpic'];
}
db_close();
$empire=null;
?>