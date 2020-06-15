<?php
error_reporting(0);
header("Content-Type: text/html;charset=utf-8");
include '../other/pass.php';
ini_set('session.cookie_httponly', 1);
session_start();
$item=isset($_GET['act'])?$_GET['act']:'';
if ($item=='login') {
	if ($_POST['user']!='' && $_POST['pass']!='') {
		if ($_POST['user']==$_user&&$_POST['pass']==$_pass) {
			$_SESSION['ly_Admin'] = base64_encode($_POST['pass']);
			echo 'ok';
		}else{
			echo 'on';
		}
	}else{
		echo 'on';
	}
}

if ($item=='del') {
	include "../data.php";
	$delsql="DELETE FROM chatnote WHERE cn_id='".$_POST['cid']."'";
	$conn->exec($delsql);
	echo '删除成功';
}

if ($item=='pass') {
	if ($_POST['passwd']==$_pass) {
		$data = '<?php
$_user = "'.$_POST['name'].'";
$_pass = "'.$_POST['pass'].'";';
		file_put_contents("../other/pass.php",$data);
		echo '修改成功';
	}else{
		echo "密码错误";
	}
}