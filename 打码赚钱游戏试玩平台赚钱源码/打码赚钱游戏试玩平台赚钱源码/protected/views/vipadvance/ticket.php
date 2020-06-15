<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>个人中心—提现管理—申请提现—<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="/" />
        <meta name="description" content="/" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/vip/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/vip/inside.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/vip/jQuery.v1.8.3.js"></script>
        <script src="/scripts/vip/public.js"></script>

        <style type="text/css">
            .hover3{border-top:4px solid #70a0f1; height:36px; line-height:36px; background:#4b6289;}
            .hover20{background: url("<?php echo IMG_URL ?>vip/img/public_db _menu_left _j.png") no-repeat scroll right center #fff; color: #cc3d12;width: 171px;}
        </style>
    </head>
    <body>
        <!--头部-->
        <?php include_once("./protected/views/vipdesign/header.php"); ?>
        <!--主体-->
        <div class="main clearfix">
            <!--导航-->
            <?php include_once("./protected/views/vipdesign/navicat.php"); ?>
            <div class="public_db clearfix">
                <!--左菜单-->
                <?php include_once("left.php") ?>
                <!--右内容-->
                <div class="cont prizes">
                    <!--标题注释-->
                    <div class="tit">
                        <p class="p_1">
                            <span class="zhu_1">提示：请根据自身情况选择相应的提现方式，请务必认真填写，以免造成不必要的损失！</span>
                        </p>
                    </div>
                    <!--切换-->
                    <div class="switch clearfix" style=" margin-top:20px;">
                        <ul class="ul_2 clearfix">
                            <li style="border-left:1px solid #bdbcbd;"><a href="<?php echo SITE_URL ?>vipadvance/txalipay">元宝提现</a></li>
                            <li class="hover"><a href="<?php echo SITE_URL ?>vipadvance/ticket">金券提现</a></li>
                        </ul>
                    </div>
                    <div>您好 ，该功能暂时未开通！</div>
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
