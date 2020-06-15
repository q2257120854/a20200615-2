<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='好友列表';
$url="<a href=../../../>首页</a>&nbsp;>&nbsp;<a href=../cp/>会员中心</a>&nbsp;>&nbsp;好友列表";
require(ECMS_PATH.'e/template/incfile/header.php');
?>

<body  class="body_index">
    <?php require(ECMS_PATH.'e/template/incfile/top.php');?>
    <div id="scontent">
        
<div class="wrap1 sclearfix">
    <?php require(ECMS_PATH.'e/template/incfile/left.php');?>

    <div class="stage">
        
        <div class="indexpage">
            <div class="page_tabs sclearfix" style="border:none;border-bottom: 1px solid #d8dce4;">
                <div class="page_tab selected" style="border:none;border-bottom: 2px solid #FF5F63;top:0;bottom:-1px;">好友列表</div>
            
            </div>
            
            <div class="page_content indexpage_content">
                
				<form name=favaform method=post action="../doaction.php" onsubmit="return confirm('确认要操作?');">
				<input type=hidden value=hy name=enews>
				
				<div class="indexpage_item">
					<a>用户名</a>
					<i class="sn" style="right:300px;">备注</i>
					<i class="sn">操作</i>
				</div>
				<?php 
				while($r=$empire->fetch($sql))
				{
				?>
				
				<div class="indexpage_item">
					<?=$r[fname]?>
					<i class="sn" style="right:300px;"><input name="fsay[]" type="text" id="fsay[]" value="<?=stripSlashes($r[fsay])?>" size="32"></i>
					<i class="sn">[<a href="add/?enews=EditFriend&fid=<?=$r[fid]?>&fcid=<?=$cid?>">修改</a>] 
					  [<a href="../doaction.php?enews=DelFriend&fid=<?=$r[fid]?>&fcid=<?=$cid?>" onclick="return confirm('确认要删除?');">删除</a>]</i>
				</div>
				<?php
				}
				?>
				<tr bgcolor="#FFFFFF"> 
				  <td height="25" colspan="4"> &nbsp;&nbsp;&nbsp; 
					<?=$returnpage?></td>
				</tr>
			  </form>
        
				 
            </div>
        </div>
    </div>
    
</div>

    </div>
   <?php require(ECMS_PATH.'e/template/incfile/footer.php');?>


