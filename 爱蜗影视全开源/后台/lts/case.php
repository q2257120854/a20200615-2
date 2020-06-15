<?php
error_reporting(0);
header("Content-Type: text/html;charset=utf-8");
ini_set('session.cookie_httponly', 1);
session_start();
include "data.php";
date_default_timezone_set('PRC');
$sql = "SELECT * FROM chatnote";
$stmt = $conn->prepare($sql);
$stmt->execute(array());
$_data = "";
$me = $_SESSION['cn_name'];
$i=0;
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  if($row['cn_type']=="2"){
    $img = '<img id="msg2-img" src="'.$row['cn_text'].'"width="100%" height="100%">';
    $tex = $img;
  }else{
    $tex = htmlentities($row['cn_text']);
  }
	if ($row['cn_name']==$me) {
    $_data .= '
    <div class="case-box">
        <span class="case-time">'.date("Y-m-d H:i:s",$row['cn_time']).'</span>
        <div class="case-right">
          <img class="case-right-img" src="'.htmlentities($row['cn_icon']).'" />
          <span class="case-name2">'.htmlentities($row['cn_name']).'</span>
          <div class="case-msg2">
            <i class="horn2"></i>
            '.$tex.'
          </div>
        </div>
      </div>';
  }else{
    $_data .= '
    <div class="case-box">
        <span class="case-time">'.date("Y-m-d H:i:s",$row['cn_time']).'</span>
        <div class="case-left">
          <img class="case-left-img" src="'.htmlentities($row['cn_icon']).'" />
          <span class="case-name">'.htmlentities($row['cn_name']).'</span>
          <div class="case-msg">
            <i class="horn"></i>
            '.$tex.'
          </div>
        </div>
      </div>';
  }
}
$_data .= '<div class="case-top"></div>';
echo $_data;
$conn = null;