<?php

/**
 * 检查版本更新
**/
include "../includes/common.php";
$title = '检查版本更新';
include './head.php';
if ($islogin == 1) {
} else {
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
?>
  <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<div class="block">
<div class="block-title"><h3 class="panel-title">检查更新</h3></div>
<div class="">
<div class="alert alert-info"><font color="green">您使用的已是最新版本！</font><br>当前版本：V6.1.5 (Build 2036)</div><hr></div></div>    </div>
</div>
</body>