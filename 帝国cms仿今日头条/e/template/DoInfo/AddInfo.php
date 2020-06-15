<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']=$word;
$url="<a href='../../'>首页</a>&nbsp;>&nbsp;<a href='../member/cp/'>会员中心</a>&nbsp;>&nbsp;<a href='ListInfo.php?mid=".$mid."'>管理信息</a>&nbsp;>&nbsp;".$word."&nbsp;(".$mr[qmname].")";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<script src="../data/html/setday.js"></script>
<script>
function bs(){
	var f=document.add
	if(f.title.value.length==0){alert("标题还没写");f.title.focus();return false;}
	if(f.classid.value==0){alert("请选择栏目");f.classid.focus();return false;}
}
function foreColor(){
  if(!Error())	return;
  var arr = showModalDialog("../data/html/selcolor.html", "", "dialogWidth:18.5em; dialogHeight:17.5em; status:0");
  if (arr != null) document.add.titlecolor.value=arr;
  else document.add.titlecolor.focus();
}
function FieldChangeColor(obj){
  if(!Error())	return;
  var arr = showModalDialog("../data/html/selcolor.html", "", "dialogWidth:18.5em; dialogHeight:17.5em; status:0");
  if (arr != null) obj.value=arr;
  else obj.focus();
}
window.onload=function(){
	
}
</script>
<script src="../data/html/postinfo.js"></script>
<body  class="body_index">
    <?php require(ECMS_PATH.'e/template/incfile/top.php');?>
    <div id="scontent">
        
<div class="wrap1 sclearfix">
    <?php require(ECMS_PATH.'e/template/incfile/left.php');?>

    <div class="stage formbox">
        <form name="add" method="POST" enctype="multipart/form-data" action="ecms.php" onsubmit="return EmpireCMSQInfoPostFun(document.add,'<?=$mid?>');">
        <div class="">
            <div class="page_tabs sclearfix" style="border:none;border-bottom: 1px solid #d8dce4;">
                <div class="page_tab selected" style="border:none;border-bottom: 2px solid #FF5F63;bottom:-1px;top:0;"><?=$word?></div>
            </div>
            <div class="page_content indexpage_content" id="pagelet-write">
				
				  <input type=hidden value="<?=$enews?>" name=enews> 
				  <input type=hidden value="<?=$classid?>" name=classid> 
				  <input name=id type=hidden id="id" value="<?=$id?>"> 
				  <input type=hidden value="<?=$filepass?>" name=filepass> 
				  <input name=mid type=hidden id="mid" value="<?=$mid?>">
				<div class="edit-cell">
					<div class="edit-main front-cover">
						<label class="edit-label">提交者</label>
						<div class="edit-input">
							<div class="front-cover-type">
								<div class="front-cover-item">
									<?=$musername?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="edit-cell">
					<div class="edit-main front-cover">
						<label class="edit-label">栏目</label>
						<div class="edit-input">
							<div class="front-cover-type">
								<div class="front-cover-item">
									<?=$postclass?> 
								</div>
							</div>
						</div>
					</div>
				</div>
				
				 
				<?php
				  @include($modfile);
				  ?>
            </div>
			<input class="signform_btn signbasic_submit" type="submit" value="提交">
        </div>
		
		</form>
    </div>
    
</div>

    </div>
   <?php require(ECMS_PATH.'e/template/incfile/footer.php');?>


