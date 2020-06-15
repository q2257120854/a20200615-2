<?php
$public_diyr['pagetitle']='会员中心';
$url="<a href=../../../>首页</a>&nbsp;>&nbsp;<a href=../cp/>会员中心</a>";
require(ECMS_PATH.'e/template/incfile/header.php');

//统计
//文章数量
$articleCount=$empire->fetch1("select count(id) as count from {$dbtbpre}ecms_news where userid=$tmgetuserid and ismember=1");
$articleCount=$articleCount['count'];
//好友数量
$hyCount=$empire->fetch1("select count(*) as count from {$dbtbpre}enewshy where userid=$tmgetuserid");
$hyCount=$hyCount['count'];
//空间点击量
$spaceclickCount=$empire->fetch1("select viewstats as count from {$dbtbpre}enewsmemberadd where userid=$tmgetuserid");
$spaceclickCount=$spaceclickCount['count'];
//累计阅读量
$clickSql=$empire->query("select onclick from {$dbtbpre}ecms_news where userid=$tmgetuserid and ismember=1");
$clickNum=0;
while($click=$empire->fetch($clickSql)){
	$clickNum=$clickNum+$click['onclick'];
}
?>

<body  class="body_index">
    <?php require(ECMS_PATH.'e/template/incfile/top.php');?>
    <div id="scontent">
        
<div class="wrap1 sclearfix">
    <?php require(ECMS_PATH.'e/template/incfile/left.php');?>

    <div class="stage">
        <div class="indexsum">
            <a href="/e/DoInfo/ChangeClass.php?mid=1" class="indexsum_add" ga="发表文章按钮$">
                <i></i>
                <span>发表文章</span>
            </a>
            <div class="indexsum_btns">

                 <a class="indexsum_btn first">
                    <b><?=$articleCount?></b>
                    <span>文章数量<em title="我发布的文章总数"></em></span>
                </a>
                <a class="indexsum_btn ">
                    <b><?=$hyCount?></b>
                    <span>好友数量</span>
                </a>



                <a class="indexsum_btn">
                    <b><?=$spaceclickCount?></b>
                    <span>空间点击量<em title="我的空间点击量"></em></span>
                </a>


                <a class="indexsum_btn last">
                    <b><?=$clickNum?></b>
                    <span>累计阅读量</span>
                </a>
            </div>
        </div>
        <div class="indexpage">
            <div class="page_tabs sclearfix">
                <div class="page_tab selected">公告</div>
            </div>
            <div class="page_content indexpage_content" gap="公告">
                
				<div class="indexpage_item" style="margin-top:-10px;display:none;">
				   <a href="#" target="_blank" ga><img src="http://p3.pstatp.com/origin/3e40006e0d5428fb289" style="display:none;border-radius:4px;" onload="this.style.display='block';" width="750" height="100"></a>
				</div>
                <?php
				//输出可管理的模型
				$ggsql=$empire->query("select title,titleurl,newstime from {$dbtbpre}ecms_news where classid=21 order by id desc");
				$no=1;
				while($data=$empire->fetch($ggsql)){
				?>
				<div class="indexpage_item">
					<a href="<?=$data[titleurl]?>" target="_blank"><?=$data[title]?>
					<?php if($no==1){?>
					<span>new</span>
					<?php }?>
					</a>
					<i class="sn"><?=date('Y-m-d',$data[newstime])?></i>
				</div>
				<?php
				$no++;
				}
				?>
				 
            </div>
        </div>
    </div>
    
</div>

    </div>
   <?php require(ECMS_PATH.'e/template/incfile/footer.php');?>


