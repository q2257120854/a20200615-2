<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>、-惠享游-官方网站</title>
        <meta name="keywords" content="学生暑假兼职，电脑上网赚钱，就在收米吧试玩平台" />
        <meta name="description" content="<?php echo TIT; ?>任务平台，主要是调查与注册任务组成，是学生兼职，暑假赚钱，电脑赚钱的好去处！" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/mall.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/public_js.js"></script>
        <script src="/scripts/mall.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.list_lh li:even').addClass('lieven');
            })
            $(function() {
                $("div.list_lh").myScroll({
                    speed: 40, //数值越大，速度越慢
                    rowHeight: 86 //li的高度
                });
            });
        </script>
        <style type="text/css">
              .hover6{ background: url(<?php echo IMG_URL; ?>img/nav_b.png) no-repeat center; font-weight: bold;color:#fff;}
            .hover6 a {color:#fff !important; }
			.task_notice {
  margin: 10px auto;
  padding: 5px 10px 10px 10px;
  width: 1004px;
  background: #feeedf;
  border: #f5dbc1 1px solid;
}
.wrw_navBgr {
  width: 100%;
  height: 45px;
  background: #f6f6f6;
  border-bottom: #e5e5e5 1px solid;
}
.wrw_nav {
  margin: 0px auto;
  width: 1004px;
  height: 60px;
  font-size: 15px;
  font-family: "微软雅黑";
  position: relative;
}
   .wrw_nav a.selected {
  background: #fff;
  border: #e5e5e5 1px solid;
  border-bottom: #fff 1px solid;
  color: #e10000;
}.wrw_nav a {
  display: inline-block;
  margin-top: 10px;
  padding: 0 20px;
  height: 35px;
  line-height: 35px;
  color: #3a3a3a;
  text-align: center;
  border: #f6f6f6 1px solid;
  border-bottom: #e5e5e5 1px solid;
}     </style>
    </head>
    <body style="background: #F4F4F4;">
        <?php include_once("./protected/views/design/header.php") ?>
        <!--主体-->
       
	   
 <div class="wrw_navBgr">
  <div class="wrw_nav" style="position:relative;">
  <a href="<?php echo SITE_URL ?>guessing/show" class="">挖米啦</a>  
  <a href="<?php echo SITE_URL ?>expad/show" class="">任务吧</a>   
  <a href="<?php echo SITE_URL ?>gamecourse/show" class="selected">惠享游</a>   
  <a href="<?php echo SITE_URL ?>capcourse/show" class="">新游盟</a>  
 
  </div>
</div> 
	   
	   
                    <div class="main clearfix">

                    <div class="task_notice" >
	<p>
    <span style="font-size: 18px;"><strong><span style="color: rgb(255, 0, 0);">任务墙获得奖励已接入试玩排行榜！</span></strong></span>
</p>				
  <h2>温馨提示：请先登录再体验，否则没有奖励哦~</h2>
</div>




<iframe src="http://www.huixiangyou.com/yxq/673.html?uid=<?php echo $mem['id']; ?>" id="mainFrame" style="width:1024px; height:1560px;margin:0 auto;" frameborder="0" scrolling="no" ></iframe>

					
                      </iframe>
					   </div>
                   
              
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
    </body>
</html>