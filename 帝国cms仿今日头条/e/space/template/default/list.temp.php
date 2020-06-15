<!doctype html>
<html>
    <head>
        <meta charset="gb2312" />
        <meta http-equiv="X-UA-Compatible" content="IE=7" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements --> 
        <!--[if lt IE 9]>
        <script src="http://s2.pstatp.com/r2/js/lib/html5shim.js"></script>
        <![endif]-->
        
		<link href="template/default/images/main.css" rel="stylesheet" type="text/css" />
        

<title><?=$spacename?> </title>
<meta content="<?=$spacename?>" name="keywords" />
<meta content="<?=$spacename?>" name="description" />
<style>
#content{ margin-top:50px!important;}
#article{ width:730px; min-height:800px!important;}
#ColumnContainer{ width:730px}
.empty_article{ text-align:center; padding-top:100px;}
#article .pin h3 { margin: 0;}
#article .pin .close { display:none}
.control-line { float:none!important}
.control-line span.comment { display:block; float:right!important; margin-right:0!important; padding-right:0!important}
.control-line span.share{ display:none!important}
.share_list { top:0!important}

.item_info{ margin:10px 0 }
.item_info tr td{ font-size:12px!important; color:#aaa!important; padding-right:20px; }
h2.media_description{padding:10px 20px;text-align:left;word-wrap: break-word; font-family: "微软雅黑", "Helvetica Neue", Helvetica, Arial, sans-serif; line-height: 18px; margin: 0 0 9px; font-weight: normal;}
.mp_home{margin: 0 10px 20px;padding-bottom: 20px;border-bottom: 1px solid #d9d9d9;}
.mp_home a{color:#b50808;}
.side-pane hr{margin:18px 10px;}
.pagebar{
    padding: 20px 0;
    text-align: center;
}
.pagebar *{
    color: #666;
    margin-right: 6px;
}
.pagebar_step{

}
.pagebar a{
  display: inline-block;
  border-radius: 2px;
  line-height: 24px;
  padding: 0 8px;
}
.pagebar a:hover,
a.pagebar_step.pagebar_step_current{
    color: #fff;
    background-color: #f04848;
}
.article_top_icon{
	float:left;
	width:31px;
	height:26px;
	margin-right:10px;
	background:url(template/default/images/article_top.png) no-repeat left center;
}
#flow-loading-tip,
#flow-no-pin-tip{
    display:none !important;
}
</style>


        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="template/default/images/ie_fix.css" />
        <![endif]-->
        
        <!--[if IE 6]>
        <link rel="stylesheet" type="text/css" href="template/default/images/toutiao_ie6.css" />
        <script src="template/default/images/toutiao_ie6.js"></script>
        <![endif]-->
        
        <link rel="stylesheet" type="text/css" href="template/default/images/main_toutiao.css"/>
        
    </head>
    <body>

       
        
        	
<?php
//简介
$usersay=$addur['saytext']?$addur['saytext']:'暂无简介';
$usersay=RepFieldtextNbsp(stripSlashes($usersay));
?>

<div id="profile-header">
    <div class="header-bar">
    	<div class="container">
        	<div id="profile"  data-id="4327905357">
                <div class="profile_avatar">
                    <a href="/e/space/list.php?userid=<?=$userid?>&mid=1"><img src="<?=$userpic?>" alt="<?=$username?>" /></a>
                </div>
                <div class="profile_info">
                    <h1 class="profile_name" style="display:inline"> <a href="/e/space/list.php?userid=<?=$userid?>&mid=1"><?=$username?></a></h1>
                    <span class="profile_follow">
                    
                    
                    <a href="../member/friend/add/?fname=<?=$username?>">+ 好友</a>
                    
                    
                	</span>
                </div>
                <div class="profile_menu">
                 <div class="profile_item profile_about">
                 	<a href="<?=$public_r['add_siteurl']?>" target="_blank">关于<?=$public_r['add_sitetitle']?></a>
                 </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <div id="content">
            <div id="content_wrapper">
                <div class="container">
    

    <div id="article">
        <div id="ColumnContainer" style="float:none">
				<?php
				while($r=$empire->fetch($sql))
				{
					$titleurl=sys_ReturnBqTitleLink($r);//链接
					
				?>
                
                    <div class="pin">
                        
                        <div class="pin-content" data-type="context" group_id="6277368176204644610">
                            <table width="680">
                                <tr>
                                    <td height="35"> 
                                        <h3>
										
										<a href="<?=$titleurl?>" target="_blank"><?=$r[title]?></a></h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>

                                
										<?php if($r[titlepic]){?>
                                        
                                            <div style="float:left; max-height:180px; overflow:hidden; margin-right:10px"  class="img_bg shadow_img">
                                                <a target="_blank" href="<?=$titleurl?>" onClick="action_log(this)"   ga_event="source_url" ga_label="index_feed">
                                                    <img src="<?=$r[titlepic]?>" width="202"/>
                                                </a>
                                            </div>
                                        <?php }?>
                                    
                                 
                                        <div class="text"><?=$r[smalltext]?></div>

                                        <div class="clearfix"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <table class="item_info" width="100%">
                                            <tr>
                                                
                                                <td align="right"><?=date("Y-m-d H:i",$r[newstime])?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
					<?php
					}
					?>
            
        </div> 
        
        <div class="pagebar" id="pagebar">
            <?=$returnpage?>
        </div>
        
    </div>

    

<div class="side-pane">
    <div style="padding:15px 0 100px; text-align:center">
    	<div class="mp-info">
          
          <img src="<?=$userpic?>" alt="<?=$username?>">
          
          <p></p>
    	</div>
        <h2 class="media_description" style="text-align:center;"><?=nl2br($usersay)?></h2>

        
        <hr>
        
    </div>
</div>


    
                </div>
            </div>
            
        </div>
 
<div class="tools">
    <a href="#" class="back_top" title="返回顶部" onClick="back_top(); return false;"></a>
    <a href="#" class="feed_back hidden-xs" title="提点意见" onClick="feebback_togger(); return false"></a>
    <!--<a href="mailto:kefu@bytedance.com" class="feed_back visible-xs" title="提点意见"></a>-->
</div>

    </body>
</html>
