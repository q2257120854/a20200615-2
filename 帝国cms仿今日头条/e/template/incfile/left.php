<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<div class="menu">
		<div class="menu_block">
			<a href="/e/member/cp/" class="menu_h1  selected  menu_main alone"><i></i>主页</a>
		</div>
		
		
		<div class="menu_block">
			<a class="menu_h1 menu_article"><i></i>文章管理</a>
			<a href="/e/DoInfo/ListInfo.php?mid=1" class="menu_h2"><i></i>管理文章</a>
			<a href="/e/DoInfo/ChangeClass.php?mid=1" class="menu_h2">发布文章</a>
			<!--<a href="#" class="menu_h2">管理图集</a> -->       
		</div>
		
		<!--<div class="menu_block">
			<a class="menu_h1 menu_info"><i></i>会员空间</a>
			<a href="/e/space/?userid=<?=$tmgetuserid?>" target="_blank" class="menu_h2  ">预览空间</a>
			
			<a href="/e/member/mspace/SetSpace.php" class="menu_h2  ">设置空间</a>

			<a href="/e/member/mspace/gbook.php" class="menu_h2  ">管理留言</a>
			
		 
		 
		</div>
	   <div class="menu_block alone">
		<a href="/e/member/msg/" class="menu_h1  menu_notice alone"><i></i>通知<em class="new-messages-num" style=""></em></a>
		</div>-->
		<div class="menu_block">
			<a class="menu_h1 menu_settings"><i></i>设置</a>
			
			<a href="/e/member/EditInfo/" class="menu_h2  menu_account"><i></i>修改资料</a>
			<a href="/e/member/EditInfo/EditSafeInfo.php" class="menu_h2 "><i></i>修改密码</a>
			<a href="/e/member/my/" class="menu_h2 "><i></i>账号状态</a>
			<a href="/e/member/friend/" class="menu_h2 "><i></i>好友列表</a>
			<a href="/e/memberconnect/ListBind.php" class="menu_h2 "><i></i>绑定外部登录</a>
			
		</div>
	</div>