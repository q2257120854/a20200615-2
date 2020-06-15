<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo $message_info['title']; ?>-<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="<?php echo $message_info['title']; ?>,、" />
        <meta name="description" content="<?php echo mb_substr(strip_tags($message_info['content']), 1, 100, "utf-8"); ?>..." />
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
            <div class="main_left" style=" margin-bottom: 20px;">
                <!--文章详情-->
                <div class="details">
                    <div class="position">
                        <span>当前位置：</span>
                        <a href="<?php echo SITE_URL; ?>">主页</a>
                        <i>&nbsp;>&nbsp;</i>
                        <a href="<?php echo SITE_URL . "message/show"; ?>">网站资讯</a>
                        <i>&nbsp;>&nbsp;</i>
                        <a href="<?php echo SITE_URL . "message/list/pid/" . $message_info['message_type_id']; ?>"><?php echo Messagetype::model()->findByPk($message_info['message_type_id'])->name; ?> </a>
                    </div>
                    <div class="cont">
                        <div class="p_1"><?php echo $message_info['title']; ?></div>
                        <div class="p_2">
                            <span>发布时间：<?php echo $message_info['create_time']; ?></span>
                            <span>作者：<?php echo $message_info['author']; ?></span> 　
                            <span>点击：<?php echo $message_info['click']; ?>次</span>
                        </div>
                        <div class="neir">
                            <?php echo $message_info['content']; ?>
                        </div>
                        <div class="article clearfix"> 
                            <span class="s">上一篇:
                                <?php
                                $prevpost = $message_info->nextpost($pid);
                                echo $prevpost ? CHtml::link($prevpost->title, SITE_URL . "message/detail/id/" . $prevpost->id . "/pid/" . $pid) : '无';
                                ?>
                            </span>
                            <span class="x">下一篇:
                                <?php
                                $nextpost = $message_info->prevpost($pid);
                                echo $nextpost ? CHtml::link($nextpost->title, SITE_URL . "message/detail/id/" . $nextpost->id . "/pid/" . $pid) : '无';
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once("right.php") ?>
        </div>
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
    </body>
</html>
