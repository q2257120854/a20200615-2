<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>理财专区-、官方网站</title>
        <meta name="keywords" content="网上兼职,网赚,体验营销,互动营销,免费礼品" />
        <meta name="description" content="收米吧用户通过选择感兴趣的广告，按照规则完成广告体验、商家问答，赚取元宝，兑换手机充值卡、Q币、笔记本、手机、ipad以及其他实物奖品，同时也为商家提供真实有效的广告受众。" />
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
    <body >
        <?php include_once("./protected/views/design/header.php") ?>
		
		
        <!--主体-->
       
           <iframe id="iframeId" style="width:100%;height:3200px;background-color:white;overflow:hidden; margin-top: -50px;" scrolling="no"  frameborder="0" src="http://app.wamila.com/?wcid=aa2923417094aef05c8abb455dd8a9d8&userid=<?php echo $mem['id']; ?>&action=elist"></iframe> 
       
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
    </body>
</html>
