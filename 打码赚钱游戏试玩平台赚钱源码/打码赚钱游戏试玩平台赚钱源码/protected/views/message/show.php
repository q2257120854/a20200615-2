<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>网站资讯-<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="优惠促销,游戏动态,网赚心得,打码资讯,打折信息,热卖商品,购物返利,免费申领,、" />
        <meta name="description" content="<?php echo TIT; ?>官方网站资讯栏目24小时为你提供关于网赚类的最新消息，文章以及网站最新的走势，目的是柿子们更多赚取元宝！" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/article.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/public_js.js"></script>
        <style type="text/css">
            .hover2{ background: url(<?php echo IMG_URL; ?>img/nav_b.png) no-repeat center; font-weight: bold;color:#fff;}
            .hover2 a { color:#fff !important;}
        </style>
    </head>
    <body >
        <?php include_once("./protected/views/design/header.php") ?>
        <!--主体-->
        <div class="main clearfix">
            <!--资讯-->
            <ul class="information clearfix">
                <li class="li_1 li">
                    <div class="bk">
                        <div class="tit clearfix">
                            <span class="tx">系统公告</span>
                            <a href="<?php echo SITE_URL . "message/list/pid/1"; ?>" class="mor">MORE<i>&nbsp;>></i></a>
                        </div>
                        <div class="cont">
                            <ul class="ul_1">
                                <?php
                                $message_info1 = Message::model()->findAllBySql("select id,title,create_time,color from {{message}} where message_type_id=1 order by id desc limit 8");
                                foreach ($message_info1 as $message) {
                                    ?>
                                    <li>
                                        <a href="<?php echo SITE_URL . "message/detail/id/" . $message['id'] . "/pid/1"; ?>" <?php
                                        if ($message["color"] == 2) {
                                            echo "class='red'";
                                        } else
                                        if ($message["color"] == 3) {
                                            echo "class='blue'";
                                        }
                                        ?> ><?php echo $message['title'] ?> </a><span><?php echo date('Y-m-d', strtotime($message['create_time'])); ?></span> 
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="li_2 li">
                    <div class="bk">
                        <div class="tit clearfix">
                            <span class="tx">奖励更新</span>
                            <a href="<?php echo SITE_URL . "message/list/pid/2"; ?>" class="mor">MORE<i>&nbsp;>></i></a>
                        </div>
                        <div class="cont">
                            <ul class="ul_1">
                                <?php
                                $message_info2 = Message::model()->findAllBySql("select id,title,create_time,color from {{message}} where message_type_id=2 order by id desc limit 8");
                                foreach ($message_info2 as $message) {
                                    ?>
                                    <li>
                                        <a href="<?php echo SITE_URL . "message/detail/id/" . $message['id'] . "/pid/2"; ?>" <?php
                                        if ($message["color"] == 2) {
                                            echo "class='red'";
                                        } else
                                        if ($message["color"] == 3) {
                                            echo "class='blue'";
                                        }
                                        ?> ><?php echo $message['title'] ?> </a><span><?php echo date('Y-m-d', strtotime($message['create_time'])); ?></span> 
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>  
                </li>
                <li class="li_3 li">
                    <div class="bk">
                        <div class="tit clearfix">
                            <span class="tx">试玩攻略</span>
                            <a href="<?php echo SITE_URL . "message/list/pid/3"; ?>" class="mor">MORE<i>&nbsp;>></i></a>
                        </div>
                        <div class="cont">
                            <ul class="ul_1">
                                <?php
                                $message_info3 = Message::model()->findAllBySql("select id,title,create_time,color from {{message}} where message_type_id=3 order by id desc limit 8");
                                foreach ($message_info3 as $message) {
                                    ?>
                                    <li>
                                        <a href="<?php echo SITE_URL . "message/detail/id/" . $message['id'] . "/pid/3"; ?>" <?php
                                        if ($message["color"] == 2) {
                                            echo "class='red'";
                                        } else
                                        if ($message["color"] == 3) {
                                            echo "class='blue'";
                                        }
                                        ?> ><?php echo $message['title'] ?> </a><span><?php echo date('Y-m-d', strtotime($message['create_time'])); ?></span> 
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="li_1 li">
                    <div class="bk">
                        <div class="tit clearfix">
                            <span class="tx">打码资讯</span>
                            <a href="<?php echo SITE_URL . "message/list/pid/4"; ?>" class="mor">MORE<i>&nbsp;>></i></a>
                        </div>
                        <div class="cont">
                            <ul class="ul_1">
                                <?php
                                $message_info4 = Message::model()->findAllBySql("select id,title,create_time,color from {{message}} where message_type_id=4 order by id desc limit 8");
                                foreach ($message_info4 as $message) {
                                    ?>
                                    <li>
                                        <a href="<?php echo SITE_URL . "message/detail/id/" . $message['id'] . "/pid/4"; ?>" <?php
                                        if ($message["color"] == 2) {
                                            echo "class='red'";
                                        } else
                                        if ($message["color"] == 3) {
                                            echo "class='blue'";
                                        }
                                        ?> ><?php echo $message['title'] ?> </a><span><?php echo date('Y-m-d', strtotime($message['create_time'])); ?></span> 
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="li_2 li">
                    <div class="bk">
                        <div class="tit clearfix">
                            <span class="tx">充值奖励</span>
                            <a href="<?php echo SITE_URL . "message/list/pid/5"; ?>" class="mor">MORE<i>&nbsp;>></i></a>
                        </div>
                        <div class="cont">
                            <ul class="ul_1">
                                <?php
                                $message_info5 = Message::model()->findAllBySql("select id,title,create_time,color from {{message}} where message_type_id=5 order by id desc limit 8");
                                foreach ($message_info5 as $message) {
                                    ?>
                                    <li>
                                        <a href="<?php echo SITE_URL . "message/detail/id/" . $message['id'] . "/pid/5"; ?>" <?php
                                        if ($message["color"] == 2) {
                                            echo "class='red'";
                                        } else
                                        if ($message["color"] == 3) {
                                            echo "class='blue'";
                                        }
                                        ?> ><?php echo $message['title'] ?> </a><span><?php echo date('Y-m-d', strtotime($message['create_time'])); ?></span> 
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>  
                </li>
                <li class="li_3 li">
                    <div class="bk">
                        <div class="tit clearfix">
                            <span class="tx">网赚心得</span>
                            <a href="<?php echo SITE_URL . "message/list/pid/6"; ?>" class="mor">MORE<i>&nbsp;>></i></a>
                        </div>
                        <div class="cont">
                            <ul class="ul_1">
                                <?php
                                $message_info6 = Message::model()->findAllBySql("select id,title,create_time,color from {{message}} where message_type_id=6 order by id desc limit 8");
                                foreach ($message_info6 as $message) {
                                    ?>
                                    <li>
                                        <a href="<?php echo SITE_URL . "message/detail/id/" . $message['id'] . "/pid/6"; ?>" <?php
                                        if ($message["color"] == 2) {
                                            echo "class='red'";
                                        } else
                                        if ($message["color"] == 3) {
                                            echo "class='blue'";
                                        }
                                        ?> ><?php echo $message['title'] ?> </a><span><?php echo date('Y-m-d', strtotime($message['create_time'])); ?></span> 
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>

    </body>
</html>
