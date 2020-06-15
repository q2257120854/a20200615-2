<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>兑换商城—<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="手机充值卡,Q币,手机,笔记本,相机,数码产品,生活用品,免费奖品" />
        <meta name="description" content="<?php echo TIT; ?>兑奖商场是柿子赚到元宝后兑换奖品的地方，柿子通过玩网页试玩、棋牌试玩体验广告、网购等赚取元宝，通过积累一定的元宝，可以兑换虚拟奖品，如Q币，手机充值卡等，也可以兑换实物大奖，如数码产品、手机、笔记本以及生活用品、吃喝玩乐用品等等。" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/mall.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/public_js.js"></script>
        <script src="/scripts/mall.js"></script>
        <script src="/scripts/jquery.lazyload.js?v=1.9.1"></script>

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
            .hover1{ background: url(<?php echo IMG_URL; ?>img/nav_b.png) no-repeat center; font-weight: bold;}
            .hover1 a { color:#fff !important;}
        </style>
    </head>
    <body >
        <?php include_once("./protected/views/design/header.php") ?>
        <!--主体-->
        <div class="main clearfix">
            <?php include_once("left.php") ?>
            <div class="main_right clearfix">
                <!--幻灯片、个人信息-->
                <?php include_once("top.php") ?>
                <!--所有奖品-->
                <div class="exchange clearfix">
                    <div class="cont clearfix">
                        <ul class="ul_1">
                            <?php
                            foreach ($gift_info as $info) {
                                ?>
                                <li class="li_2">
                                    <a class="img img_1" href="<?php echo SITE_URL; ?>gift/detail/id/<?php echo $info['id']; ?>">
                                        <img  class="lazy" data-original="/uploads/img/gift/<?php echo $info['img']; ?>" />
                                    </a>
                                    <span class="l_c">
                                        <a class="a_1" href="<?php echo SITE_URL; ?>gift/exchange/id/<?php echo $info['id']; ?>" target="_blank">立即兑换</a>
                                        <a class="a_2" href="<?php echo SITE_URL; ?>gift/detail/id/<?php echo $info['id']; ?>" target="_blank">查看详情</a>
                                    </span>
                                    <p class="p_1">
                                        <a href="<?php echo SITE_URL; ?>gift/detail/id/<?php echo $info['id']; ?>"><?php echo $info['name']; ?></a>
                                    </p>
                                    <p class="p_2 clearfix">
                                        <em><?php echo $info['hld_num']; ?></em>
                                        <span>已兑换：<?php echo $info['exchange_num']; ?>件</span> 
                                    </p>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
    </body>
</html>
