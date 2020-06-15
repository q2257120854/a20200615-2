<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>个人中心—修改头像--<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="\" />
              <meta name="description" content="\" />
              <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
            <link href="/style/vip/public.css" rel="stylesheet" type="text/css" />
            <link href="/style/vip/index.css" rel="stylesheet" type="text/css" />
            <script src="/scripts/vip/jQuery.v1.8.3.js"></script>
            <script src="/scripts/vip/public.js"></script>

    </head>
    <body>
        <!--头部-->
        <?php include_once("./protected/views/vipdesign/header.php") ?>
        <!--主体-->
        <div class="main main_index clearfix">
            <!--导航-->
            <?php include_once("./protected/views/vipdesign/navicat.php") ?>
            <div class="data">
                <!--当前位置-->
                <div class="position">
                    <span>您的位置：</span>
                    <a href="javascript:">个人中心</a>
                    <i>&nbsp;>&nbsp;</i>
                    <a href="javascript:">修改头像</a>  
                </div>
                <!--修改头像-->
                <div class="modify_tx">
                    <ul class="ul_2 clearfix">
                        <?php
                        $mem = $this->show_mem();
                        $memimg = Memimg::model()->findAll();
                        foreach ($memimg as $info) {
                            ?>
                            <li>
                                <div class="db">
                                    <img src="<?php echo IMG_URL ?>touxiang/<?php echo $info['img']; ?>" />
                                    <?php if ($mem['memimg_id'] == $info['id']) { ?>
                                        <span class="bak_2"></span>
                                        <a class="ann_2">当前使用中</a>
                                    <?php } else { ?>
                                        <span class="bak"></span>
                                        <a class="ann_1" href="<?php echo SITE_URL; ?>vipindex/memimg/id/<?php echo $info['id']; ?>">使用该头像</a>
                                    <?php } ?>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <?php
            if (!empty($ad_info)) {
                foreach ($ad_info as $ad) {
                    ?>
                    <!--广告图-->
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
