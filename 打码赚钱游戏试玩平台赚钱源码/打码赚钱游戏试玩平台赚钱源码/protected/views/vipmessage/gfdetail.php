<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>个人中心—消息详情—<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="/" />
        <meta name="description" content="/" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/vip/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/vip/inside.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/vip/jQuery.v1.8.3.js"></script>
        <script src="/scripts/vip/public.js"></script>
    </head>
    <body>
        <!--头部-->
        <?php include_once("./protected/views/vipdesign/header.php") ?>
        <!--主体-->
        <div class="main clearfix">
            <!--导航-->
            <?php include_once("./protected/views/vipdesign/navicat.php") ?>
            <div class="public_db clearfix">
                <!--左菜单-->
                <div class="menu_left">
                    <ul class="ul_1">
                        <li class="<?php
                        if ($type == 0) {
                            echo "hover";
                        }
                        ?>"><a href="<?php echo SITE_URL ?>vipmessage/show/type/0">系统消息</a></li>
                        <li class="<?php
                        if ($type == 1) {
                            echo "hover";
                        }
                        ?>"><a href="<?php echo SITE_URL ?>vipmessage/show/type/1">官方消息</a></li>
                    </ul>
                </div>
                <!--右内容-->
                <div class="cont prizes">
                    <!--消息-->
                    <div class="news">
                        <div class="weizhi">
                            <span>当前位置：</span><a href="<?php echo SITE_URL ?>vipindex/show">个人中心</a><i> > </i><a href="<?php echo SITE_URL ?>vipmessage/show">我的站内消息 </a> <i>></i> <span>官方消息</span>  
                        </div>
                        <div class="details">
                            <div class="tit_1"><?php echo $message_info["title"]; ?></div>
                            <div class="time_date">
                                <span>发布时间：<?php echo $message_info["create_time"]; ?></span>
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;来源：<?php echo "官方消息"; ?></span>
                            </div>
                            <div class="text">
                                <?php echo $message_info["content"]; ?>
                                <p class="log">、官方</p>
                                <p class="log"><?php echo $message_info["create_time"]; ?></p>
                            </div>
                            <div class="last_next clearfix">
                                <?php
                                $prevpost = $message_info->nextpost2();
                                $nextpost = $message_info->prevpost2();
                                ?>
                                <?php if (!empty($prevpost->id)) { ?>
                                    <a class="last" href="<?php echo SITE_URL . "vipmessage/gfdetail/id/" . $prevpost->id . "/pid/" . $pid; ?>">上一篇：<?php echo $prevpost->title; ?></a>
                                <?php } ?>
                                <?php if (!empty($nextpost->id)) { ?>
                                    <a class="next" href="<?php echo SITE_URL . "vipmessage/gfdetail/id/" . $nextpost->id . "/pid/" . $pid; ?>">下一篇：<?php echo $nextpost->title; ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if (!empty($ad_info)) {
                foreach ($ad_info as $ad) {
                    ?>
                    <a class="advertising_1" href="<?php echo $ad['url']; ?>">
                        <img src="/uploads/img/ad/<?php echo $ad['img']; ?>">
                    </a>
                    <?php
                }
            }
            ?>
        </div>
        <!--底部1-->
        <?php include_once("./protected/views/vipdesign/footer.php"); ?>
        <?php include_once("./protected/views/vipdesign/kefu.php") ?>
    </body>
</html>
