<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']=$word;
$url="<a href=../../../../>首页</a>&nbsp;>&nbsp;<a href=../../cp/>会员中心</a>&nbsp;>&nbsp;<a href=../../friend/?cid=".$fcid.">好友列表</a>&nbsp;>&nbsp;".$word;
require(ECMS_PATH.'e/template/incfile/header.php');
?>

<body  class="body_index">
    <?php require(ECMS_PATH.'e/template/incfile/top.php');?>
    <div id="scontent">
        
<div class="wrap1 sclearfix">
    <?php require(ECMS_PATH.'e/template/incfile/left.php');?>

    <div class="stage formbox">
        <form name="form1" method="post" action="../../doaction.php">
        <div class="">
            <div class="page_tabs sclearfix" style="border:none;border-bottom: 1px solid #d8dce4;">
                <div class="page_tab selected" style="border:none;border-bottom: 2px solid #FF5F63;bottom:-1px;top:0;"><?=$word?></div>
            </div>
            <div class="page_content indexpage_content" id="pagelet-write">
				
				<style>
				#pagelet-write img{display: block;max-width: 128px;max-height: 128px;margin-bottom:6px;}
				</style>
				<table width="100%" align="center" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5"><tbody>
				<tr>
					<td width="16%" height="25" bgcolor="ffffff">用户名：</td><td bgcolor="ffffff">
						<input name="fname" type="text" id="fname" value="<?=$fname?>">
                (*)
					</td>
				</tr>
				<tr>
					<td width="16%" height="25" bgcolor="ffffff">备注：</td><td bgcolor="ffffff">
						<input name="fsay" type="text" id="fname3" value="<?=stripSlashes($r[fsay])?>" size="38">
					</td>
				</tr>
				<input name="enews" type="hidden" id="enews" value="<?=$enews?>">
                <input name="fid" type="hidden" id="fid" value="<?=$fid?>">
                <input name="fcid" type="hidden" id="fcid" value="<?=$fcid?>">
                <input name="oldfname" type="hidden" id="oldfname" value="<?=$r[fname]?>">
				</tbody></table>
            </div>
			<input class="signform_btn signbasic_submit" type="submit" value="提交">
        </div>
		
		</form>
    </div>
    
</div>

    </div>
   <?php require(ECMS_PATH.'e/template/incfile/footer.php');?>


