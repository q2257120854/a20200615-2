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
<body  class="body_signbasic" body-log="signbasic" gap="^注册" >
<?php require(ECMS_PATH.'e/template/incfile/top.php');?>

		<div id="scontent">
        
			<div class="signstep">
			<div class="signstep_bg">
				<div class="signstep_bgc" style="width:0%;"></div>
			</div>
			<div class="signstep_item i1">
				<div class="signstep_item_text">选择类型</div>
			</div>
			<div class="signstep_item_bg i1 "></div>
			<div class="signstep_item i2 current">
				<div class="signstep_item_text">帐号注册</div>
			</div>
			<div class="signstep_item_bg i2 current"></div>
			<div class="signstep_item i3 ">
				<div class="signstep_item_text">注册完成</div>
			</div>
			<div class="signstep_item_bg i3 "></div>
		</div>

			<div class="signbasic sclearfix" id="pagelet_signbasic">
			<div class="signbasic_mail">
				<!-- <div class="signbasic_mail_title">邮箱注册:</div> -->
				<form method=post enctype="multipart/form-data" action=../doaction.php>
					<div data-node="fields">
						<input type=hidden name=enews value=register>
						<input name="groupid" type="hidden" id="groupid" value="<?=$groupid?>">
						<input name="tobind" type="hidden" id="tobind" value="<?=$tobind?>">
						<div class="login-form-account">
							<div class="form1_dt">用户名</div>
							<div class="form1_dd">
								<input type="text" name="username" maxlength="50" class="signform_input ">
								<div class="signform_msg jmsg">请输入正确的用户名</div>
								<div class="signform_hint"></div>
							</div>
						</div>
						<div class="login-form-account">
							<div class="form1_dt">邮箱</div>
							<div class="form1_dd">
								<input type="text" name="email" maxlength="50" class="signform_input ">
								<div class="signform_msg jmsg">请输入正确的邮箱地址</div>
								<div class="signform_hint">请填写本人常用邮箱，该邮箱将作为登录帐号</div>
							</div>
						</div>
						<div style="display: none;"></div>
						<div class="login-form-account">
							<div class="form1_dt">密码</div>
							<div class="form1_dd">
								<input type="password" name="repassword" maxlength="50" class="signform_input">
								<div class="signform_msg jmsg"></div>
								<div class="signform_hint">字母、数字或者英文符号，最短8位。必须包含数字、大小写字母</div>
							</div>
						</div>
						<div class="login-form-account">
							<div class="form1_dt">确认密码</div>
							<div class="form1_dd">
								<input type="password" name="password" maxlength="50" class="signform_input">
								<div class="signform_msg jmsg"></div>
								<div class="signform_hint">请再次输入密码</div>
							</div>
						</div>
						<?
						if($public_r['regkey_ok'])
						{
						?>
						<div>
							<div class="form1_dt">验证码</div>
							<div class="form1_dd">
								<img class="signbasic_captcha_img" src="../../ShowKey/?v=reg" onclick="this.src='../../ShowKey/?v=reg&t='+Math.random()"/>
								<input maxlength="4" type="text" class="signform_input signbasic_captcha_input"  name="key">
								<div class="signform_msg"></div>
							</div>
						</div>
						<?
						}	
						?>
					</div>
					<!-- <div class="form1_checkbox signbasic_agree" data-node="agree">
				   我同意并遵守<a href="#" class="slink" target="_blank">《媒体号用户协议》</a>
					</div> -->
					<input class="signform_btn signbasic_submit" type="submit" value="马上注册" style="border:none;">
				</form>
				
			</div>
			<div class="signbasic_other">
				<div class="signbasic_other_title">用以下合作网站帐号作为登录帐号使用:</div>
				<div class="login_others">
                        <a href="/e/memberconnect/?apptype=qq" class="login_other" ga="登录_QQ帐号$"><div class="login_other_img login_other_img_qq" style="background-color:#FF6557"></div><div class="login_other_text"></div></a>
                        
                    </div>
			</div>
		</div>

	</div>
<?php require(ECMS_PATH.'e/template/incfile/footer.php');?>