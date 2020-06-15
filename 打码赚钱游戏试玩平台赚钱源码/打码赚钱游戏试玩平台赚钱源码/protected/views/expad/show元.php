<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>广告体验-牛金网-官方网站</title>
        <meta name="keywords" content="网上兼职,网赚,体验营销,互动营销,免费礼品" />
        <meta name="description" content="牛金网用户通过选择感兴趣的广告，按照规则完成广告体验、商家问答，赚取米币，兑换手机充值卡、Q币、笔记本、手机、ipad以及其他实物奖品，同时也为商家提供真实有效的广告受众。" />
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
    <link rel="shortcut icon" href="/favicon.ico" />
</head>
    <body >
        <?php include_once("./protected/views/design/header.php") ?>
		
		
        <!--主体-->
        <div class="main clearfix">
            <div class="main_left clearfix">
                <!--幻灯片-->
                <div class="mainSlider clearfix">
                    <ul class="spotlightBanner">
                        <?php
                        $ad_info = Ad::model()->findAllBySql("select img,url,hlb_num,name from {{ad}} where id in(10,11,12,13) and open =0 order by orderby limit 0,1; ");
                        if (!empty($ad_info)) {
                            foreach ($ad_info as $ad) {
                                ?>
                                <li class="selected">
                                    <a href="<?php echo $ad['url']; ?>" target="_blank"><?php echo $ad['name']; ?></a>
                                    <span class="sp_1"><?php echo $ad['hlb_num']; ?></span>
                                </li>
                                <?php
                            }
                        }
                        ?>
                        <?php
                        $ad_infos = Ad::model()->findAllBySql("select img,url,hlb_num,name from {{ad}} where id in(10,11,12,13) and open =0 order by orderby limit 1,3;");
                        if (!empty($ad_infos)) {
                            foreach ($ad_infos as $ad) {
                                ?>
                                <li>
                                    <a href="<?php echo $ad['url']; ?>" target="_blank"><?php echo $ad['name']; ?></a>
                                    <span class="sp_1"><?php echo $ad['hlb_num']; ?></span>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                    <ul class="spotlight">
                        <?php
                        if (!empty($ad_info)) {
                            foreach ($ad_info as $ad) {
                                ?>  
                                <li style="display:list-item;">
                                    <a href="<?php echo $ad['url']; ?>" target="_blank">
                                        <img src="/uploads/img/ad/<?php echo $ad['img']; ?>">
                                    </a>
                                </li>
                                <?php
                            }
                        }
                        ?>
                        <?php
                        if (!empty($ad_infos)) {
                            foreach ($ad_infos as $ad) {
                                ?>  
                                <li style="display:none;">
                                    <a href="<?php echo $ad['url']; ?>" target="_blank">
                                        <img src="/uploads/img/ad/<?php echo $ad['img']; ?>">
                                    </a>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <!--广告体验、商家问答...-->
                <div class="game clearfix">
                    <div class="tit clearfix">
                        <ul class="ul_1 clearfix">
                            <?php
                            $expadtype_info = Expadtype::model()->findAllBySql("select id,name from {{exp_ad_type}}  limit 0,3; ");
                            foreach ($expadtype_info as $expadtype) {
                                ?>  
                                <li <?php
                                if ($expadtype['id'] == $id) {
                                    echo "class='hover'";
                                }
                                ?>>
                                    <a href="<?php echo SITE_URL; ?>expad/show/id/<?php echo $expadtype['id']; ?>"><?php echo $expadtype['name']; ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php
                    $sql1 = "SELECT * FROM {{exp_ad}} where open=0 and zm_start=0 ";
                    $sql2 = "SELECT * FROM {{exp_ad}} where open=0 and zm_start=1 ";
                    $sb = '';
                    $id = $_GET['id'];
                    if (!empty($id)) {
                        $sb = $sb . "  and exp_ad_type_id=" . $id;
                    }
                    $sql1 = $sql1 . $sb . " order by begin_time ";
                    $sql2 = $sql2 . $sb . " order by begin_time ";
                    $expad_info = Expad::model()->findAllBySql($sql1);
                    $expad_info2 = Expad::model()->findAllBySql($sql2);
                    ?>
                    <!--招募中的广告-->
                    <div class="cont clearfix">
                        <div class="tit_2"> 
                            <span class="sp_1">招募中的广告</span>
                            <span class="sp_2">&nbsp;|&nbsp;正在火热招募玩家的广告  </span>
                        </div>
                        <ul class="ul_3 clearfix">
                            <?php
                            foreach ($expad_info as $expad) {
                                ?> 
                                <li>
                                    <?php if ($expad['is_timely'] == 0) { ?>
                                        <a class="a_1" href="<?php echo SITE_URL ?>expad/detailzd/id/<?php echo $expad['id']; ?>" target="_blank">
                                            <img  class="lazy" data-original="/uploads/img/expad/<?php echo $expad['img']; ?>" />
                                            <p class="p_1 clearfix">
                                                <em class="em_1"><?php echo $expad['name']; ?></em>
                                                <i class="i_1">实时返回</i>
                                            </p>
                                            <span class="bk"></span>
                                            <span class="ann">立即体验</span>
                                        </a>
                                    <?php } else { ?>
                                        <a class="a_1" href="<?php echo SITE_URL ?>expad/detailsd/id/<?php echo $expad['id']; ?>" target="_blank">
                                            <img  class="lazy" data-original="/uploads/img/expad/<?php echo $expad['img']; ?>" />
                                            <p class="p_1 clearfix">
                                                <em class="em_1"><?php echo $expad['name']; ?></em>
                                                <i class="i_3">周期审核</i>
                                            </p>
                                            <span class="bk"></span>
                                            <span class="ann">立即体验</span>
                                        </a>
                                    <?php } ?>
                                    <p class="p_2">每人奖励：<em><?php echo number_format($expad['rewards_hlb']); ?></em><span>(约<i><?php echo $expad['rewards_hlb'] / 10000 ?></i>元人民币)</span></p>
                                    <p class="p_3">
                                        广告说明：<?php echo $expad['explain']; ?>
                                    </p>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <!--招募满的广告-->
                    <div class="cont clearfix">
                        <div class="tit_2">
                            <span class="sp_1_1">招募满的广告</span>
                            <span class="sp_2">&nbsp;|&nbsp;需要的玩家已招满，但体验时间未到的广告</span>
                        </div>
                        <ul class="ul_2 clearfix">
                            <?php
                            foreach ($expad_info2 as $expad) {
                                ?> 
                                <li>
                                    <?php if ($expad['is_timely'] == 0) { ?>
                                        <a class="a_1" href="<?php echo SITE_URL ?>expad/detailzd/id/<?php echo $expad['id']; ?>" target="_blank">
                                            <img  class="lazy" data-original="/uploads/img/expad/<?php echo $expad['img']; ?>" />
                                            <p class="p_1 clearfix">
                                                <em class="em_1"><?php echo $expad['name']; ?></em>
                                                <i class="i_2">招募满</i>
                                            </p>
                                        </a>
                                    <?php } else { ?>
                                        <a class="a_1" href="<?php echo SITE_URL ?>expad/detailsd/id/<?php echo $expad['id']; ?>" target="_blank">
                                            <img  class="lazy" data-original="/uploads/img/expad/<?php echo $expad['img']; ?>" />
                                            <p class="p_1 clearfix">
                                                <em class="em_1"><?php echo $expad['name']; ?></em>
                                                <i class="i_2">招募满</i>
                                            </p>
                                        </a>
                                    <?php } ?>
                                    <p class="p_2">每人奖励：<em><?php echo number_format($expad['rewards_hlb']); ?></em></p>
                                    <p class="p_3">
                                        广告说明：<?php echo $expad['explain']; ?>
                                    </p>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php include_once("right.php") ?>
        </div>
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
    </body>
</html>
