<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo Messagetype::model()->findByPk($_GET["pid"])->name; ?>-网站资讯-<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="优惠促销,游戏动态,网赚心得,打码资讯,打折信息,热卖商品,购物返利,免费申领,、" />
        <meta name="description" content="<?php echo TIT; ?>官方网站资讯栏目24小时为你提供关于网赚类的最新消息，文章以及网站最新的走势，目的是柿子们更多赚取元宝！" />
        <link rel="shortcut icon" href="Favicon.ico" type="image/x-icon"/>
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
            <div class="main_left">
                <!--文章列表-->
                <div class="article_list">
                    <!--当前位置-->
                    <div class="position">
                        <span>当前位置：</span>
                        <a href="<?php echo SITE_URL; ?>">主页</a>
                        <i>&nbsp;>&nbsp;</i>
                        <a href="<?php echo SITE_URL . "message/show"; ?>">网站资讯</a>
                        <i>&nbsp;>&nbsp;</i>
                        <a href="<?php echo SITE_URL . "message/list/pid/" . $_GET["pid"]; ?>"><?php echo Messagetype::model()->findByPk($_GET["pid"])->name; ?></a>
                    </div>
                    <ul class="ul_1">
                        <?php
                        foreach ($posts as $model) {
                            ?>
                            <li>
                                <p class="p_1"><a href="<?php echo SITE_URL . "message/detail/id/" . $model['id'] . "/pid/" . $pid; ?>"><?php echo $model['title'] ?></a></p>
                                <p class="p_2"><?php echo strip_tags($model['content']); ?><a href="<?php echo SITE_URL . "message/detail/id/" . $model['id'] . "/pid/" . $pid; ?>">[查看详情]</a></p>
                                <p class="p_3">
                                    <span class="sp_1">时间：<?php echo date('Y-m-d', strtotime($model['create_time'])); ?></span>
                                    <span class="sp_2">点击：<i><?php echo $model['click'] ?></i></span>
                                </p>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <div class="sx clearfix">	
                        <?php
                        if ($pages->itemCount == 0) {
                            echo "<h3 align='center'>暂无相关资讯！<h3>";
                        } else {
                            $this->widget('CLinkPager', array('pages' => $pages));
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php include_once("right.php") ?>
        </div>
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
    </body>
</html>
