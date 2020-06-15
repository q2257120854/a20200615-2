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
				<input type=hidden name=enews value=EditInfo>
				<div class="edit-cell">
					<div class="edit-main front-cover">
						<label class="edit-label">修改基本资料</label>
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
				<?php
	@include($formfile);
	?>
            </div>
			<input class="signform_btn signbasic_submit" type="submit" value="提交">
        </div>
		
		</form>
    </div>
    
</div>

    </div>
   <?php require(ECMS_PATH.'e/template/incfile/footer.php');?>


