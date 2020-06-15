<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<style type="text/css">
#browser_err{
    display: none;
    background: #FFFF88;
    text-align: center;
    font-size: 20px;
    line-height: 1.8;
    border-bottom: 1px solid #808080;
    padding: 10px 0;
}
#browser_err a{
    color: #4D7CD9;
}
    </style>
    <div id="browser_err"></div>
    <div id="pagelet-header">
		<div class="shead">
			<div class="shead_wrap">
				<a class="shead_logo" href="/">媒体号</a>
				<div class="shead_status">
					
					<span></span>
					
				</div>
				
				<?php if($tmgetuserid) { ?>
				<div class="shead_right">
					
					<div class="sys-msg">
						<!--<div class="sys-msg-entity" ga="消息" data-node='sys_msg_entity'>
							<i class="sys-msg-sum" data-node="sys_msg_sum"></i>
							<i class="sys-msg-dot" data-node="sys_msg_dot"></i>
						</div>-->
						<div class="sys-msg-outer" data-node="sys_msg_wrapper">
							<div class="sys-msg-transparent"></div>
							
						</div>
						<div class="sys-msg-important" data-node="sys_msg_important_inform">
							<div class="sys-msg-important-inner">
								<ul class="sys-msg-impor-con" data-node="sys_msg_impor_con"></ul>
								<i class="sys-msg-close" data-node="sys_msg_close"></i>
							</div>
						</div>
					</div>
					
					<div class="user-panel">
						
						<div class="information">
							<a href="javascript:;" target="_blank" title="全部文章">
								<div class="new_user_avatar">
									<img src="<?=$userinfo['userpic']?>">
								</div>
								<div class="new_user_info">
									<div class="new_user_type">
										<span class="user_type"><?=$tmgetgroupname?></span>
									</div>
									<div class="new_user_name"><span><?=$tmgetusername?></span></div>
								</div>
							</a>
						</div>
						<div class="author_dashbord">
							<ul>
								<li class="">
									<i class=""></i>
									<span class="new_author">作者</span>
								</li>
								<li class="authors_list top"><a href="<?=$public_r['newsurl']?>e/space/?userid=<?=$tmgetuserid?>" target="_blank" title="<?=$tmgetusername?>的个人主页"><?=$tmgetusername?></a>
								</li>
								<li class="new_logout">
									<i class=""></i>
									<a href="<?=$public_r['newsurl']?>e/member/doaction.php?enews=exit" onclick="return confirm('确认要退出?');">退出</a> 
								</li>
							</ul>
						</div>
						
					</div>
				</div>
				<?php
				}
				else	//游客
				{
				?>
				<div class="shead_right">
            	
					<div class="user-panel">
						
							
						<a href="/e/member/login/" class="pgc_top_login">登录</a>
							
						
					</div>
				</div>
				
				<?php } ?>
			</div>
		</div>
	</div>