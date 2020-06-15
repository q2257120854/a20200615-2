<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='修改资料';
$url="<a href=../../../>首页</a>&nbsp;>&nbsp;<a href=../cp/>会员中心</a>&nbsp;>&nbsp;修改资料";
require(ECMS_PATH.'e/template/incfile/header.php');
?>

<body  class="body_index">
    <?php require(ECMS_PATH.'e/template/incfile/top.php');?>
    <div id="scontent">
        
<div class="wrap1 sclearfix">
    <?php require(ECMS_PATH.'e/template/incfile/left.php');?>

    <div class="stage formbox">
        <form name=userinfoform method=post enctype="multipart/form-data" action=../doaction.php>
        <div class="">
            <div class="page_tabs sclearfix" style="border:none;border-bottom: 1px solid #d8dce4;">
                <div class="page_tab selected" style="border:none;border-bottom: 2px solid #FF5F63;bottom:-1px;top:0;"><?=$word?></div>
            </div>
            <div class="page_content indexpage_content" id="pagelet-write">
				<input type=hidden name=enews value=EditSafeInfo>
				<div class="edit-cell">
					<div class="edit-main front-cover">
						<label class="edit-label">密码安全修改</label>
						<div class="edit-input">
							<div class="front-cover-type">
								<div class="front-cover-item"><?=$user[username]?></div>
							</div>
						</div>
					</div>
				</div>
				<style>
				#pagelet-write img{display: block;max-width: 128px;max-height: 128px;margin-bottom:6px;}
				</style>
				<table width='100%' border='0' align='center' cellpadding='3' cellspacing='1' class="tableborder">
					<tr> 
					  <td width='21%' height="25" bgcolor="#FFFFFF"> <div align='left'>用户名 </div></td>
					  <td width='79%' height="25" bgcolor="#FFFFFF"> 
						<?=$user[username]?>
					  </td>
					</tr>
					<tr> 
					  <td height="25" bgcolor="#FFFFFF"> <div align='left'>原密码</div></td>
					  <td height="25" bgcolor="#FFFFFF"> <input name='oldpassword' type='password' id='oldpassword' size="38" maxlength='20'>
						(修改密码或邮箱时需要密码验证)</td>
					</tr>
					<tr> 
					  <td height="25" bgcolor="#FFFFFF"> <div align='left'>新密码</div></td>
					  <td height="25" bgcolor="#FFFFFF"> <input name='password' type='password' id='password' size="38" maxlength='20'>
						(不想修改请留空)</td>
					</tr>
					<tr> 
					  <td height="25" bgcolor="#FFFFFF"> <div align='left'>确认新密码</div></td>
					  <td height="25" bgcolor="#FFFFFF"> <input name='repassword' type='password' id='repassword' size="38" maxlength='20'>
						(不想修改请留空)</td>
					</tr>
					<tr> 
					  <td height="25" bgcolor="#FFFFFF"> <div align='left'>邮箱</div></td>
					  <td height="25" bgcolor="#FFFFFF"> <input name='email' type='text' id='email' value='<?=$user[email]?>' size="38" maxlength='50'>
					  </td>
					</tr>
					
				</table>
            </div>
			<input class="signform_btn signbasic_submit" type="submit" value="提交">
        </div>
		
		</form>
    </div>
    
</div>

    </div>
   <?php require(ECMS_PATH.'e/template/incfile/footer.php');?>


