<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='注册会员';
$url="<a href=../../../>首页</a>&nbsp;>&nbsp;<a href=../cp/>会员中心</a>&nbsp;>&nbsp;选择注册会员类型";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<br>
<body  class="body_signbasic" body-log="signbasic" gap="^注册类型" >
<?php require(ECMS_PATH.'e/template/incfile/top.php');?>

    <div id="scontent">
        
		<div class="signstep">
			<div class="signstep_bg">
				<div class="signstep_bgc" style="width:0%;"></div>
			</div>
			<div class="signstep_item i1 current">
				<div class="signstep_item_text">选择类型</div>
			</div>
			<div class="signstep_item_bg i1 current"></div>
			<div class="signstep_item i2 ">
				<div class="signstep_item_text">帐号注册</div>
			</div>
			<div class="signstep_item_bg i2 "></div>
			<div class="signstep_item i3 ">
				<div class="signstep_item_text">注册完成</div>
			</div>
			<div class="signstep_item_bg i3 "></div>
		</div>

		<div class="signbasic sclearfix" id="pagelet_signbasic">
			<div class="signbasic_mail" style="width:100%;text-align:center">
				<div class="signbasic_mail_title">选择注册会员类型:</div>

					<div data-node="fields">
						<form name="ChRegForm" method="GET" action="index.php" class="loginform">
							<input name="tobind" type="hidden" id="tobind" value="0">
							<label><input type="radio" name="groupid" value="1" checked />普通会员</label>
							<label><input type="radio" name="groupid" value="3" />企业会员</label> 
							<div></div>
							<input type="submit" name="button" value="下一步" class="signform_btn signbasic_submit" style="border:none;margin-left:0;">
						</form>

					</div>

			   
			</div>

		</div>
	</div>
<?php require(ECMS_PATH.'e/template/incfile/footer.php');?>