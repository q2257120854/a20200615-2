<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>广告体验-<?php echo TIT; ?>、官方网站</title>
        <meta name="keywords" content="网上兼职,网赚,体验营销,互动营销,免费礼品" />
        <meta name="description" content="、网络用户通过选择感兴趣的广告，按照规则完成广告体验、商家问答，赚取元宝，兑换手机充值卡、Q币、笔记本、手机、ipad以及其他实物奖品，同时也为商家提供真实有效的广告受众。" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/advert.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/public_js.js"></script>
        <script type="text/javascript" src="/scripts/advert.js"></script>
        <script src="/scripts/jquery.lazyload.js?v=1.9.1"></script>
        <script src="/scripts/page.js"></script>
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
            $(function() {
                $("img.lazy").lazyload({effect: "fadeIn"});
            });
        </script>
        <style type="text/css">
            .hover6{ background: url(<?php echo IMG_URL; ?>img/nav_b.png) no-repeat center; font-weight: bold;color:#fff;}
            .hover6 a { color:#fff !important;}
        </style>
    </head>
    <body style="background: #F4F4F4;">
        <?php include_once("./protected/views/design/header.php") ?>
        <!--主体-->
       
	 
	   
                    <div class="main clearfix">

                    <div class="task_notice" >
					
  <h2>温馨提示：请先登录再体验，否则没有奖励哦~</h2>
</div>




					<iframe src="http://list.offer8.cn/index?appid=offer855f6d72ea62e0&uid=<?php echo $mem['id']; ?>" style="width:1040px;height:1560px;  " frameborder="no" border="0" allowtransparency="true" >
                      </iframe>
					   </div>
                   
              
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
    </body>
</html>
