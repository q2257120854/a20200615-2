<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>2015打码赚钱-打码任务-打码网赚-最好打码平台-<?php echo TIT; ?>、官方网站</title>
        <meta name="keywords" content="、打码,打码平台，打码赚钱，打码任务，打码网赚" />
        <meta name="description" content="无论你有时间没时间，均可通过打码获得相应收入，旨在为大家提供打码赚钱的平台，工资日结。" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/code.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/public_js.js"></script>
        <script src="/scripts/page.js"></script>
        <style type="text/css">
            .hover5{ background: url(<?php echo IMG_URL; ?>img/nav_b.png) no-repeat center; font-weight: bold;color:#fff;}
            .hover5 a { color:#fff !important;}
        </style>
        <script type="text/javascript">
            /** 获取排行数据 **/
            function nav(id) {
                if (id == 1) {
                    $("#nav1").addClass("hover");
                    $("#nav2").removeClass("hover");
                    $("#nav3").removeClass("hover");
                    $("#show1").show();
                    $("#show2").hide();
                    $("#show3").hide();
                } else if (id == 2) {
                    $("#nav1").removeClass("hover");
                    $("#nav2").addClass("hover");
                    $("#nav3").removeClass("hover");
                    $("#show1").hide();
                    $("#show2").show();
                    $("#show3").hide();
                } else {
                    $("#nav1").removeClass("hover");
                    $("#nav2").removeClass("hover");
                    $("#nav3").addClass("hover");
                    $("#show1").hide();
                    $("#show2").hide();
                    $("#show3").show();
                }
            }
        </script>
    </head>
    <body >
        <?php include_once("./protected/views/design/header.php"); ?>
        <!--主体-->
        <div class="main clearfix">
            <div class="main_left clearfix">
                <!--任务分类、打码辅助工具、打码视频教程...-->
                <div class="game clearfix">
                    <div class="tit clearfix">
                        <ul class="ul_1 clearfix">
                            <li class='hover' id="nav1" >
                                <a  href="javascript:nav(1);" >任务列表</a>
                            </li>
                            <li id="nav2">
                                 <a  href="javascript:nav(2);" >打码辅助工具</a>
                            </li>     
                        </ul>
                        <?php if (!empty($mem)) { ?>
                            <a href="<?php echo SITE_URL ?>viptask/captcha" class="record">我的打码记录</a>
                        <?php } ?>
                    </div>
                    <div id="show1">
                        <!--不换IP推荐任务  -->
                        <div class="cont clearfix">
                            <div class="tit_2 clearfix">
                                <span class="sp_1">不换IP推荐任务</span>
                                <span class="sp_2">&nbsp;|&nbsp;打码时不需要重复切换IP </span>
                                <span class="sp_3">打码结算时间为：次日下午17:00</span>
                            </div>
                            <div class="table clearfix">
                                <ul class="ul_1">
                                    <li class="li_1 tit">
                                        <p class="p_1"><span>任务名称</span></p>
                                        <p class="p_2"><span>每码价格</span></p>
                                        <p class="p_3"><span>是否换IP</span></p>
                                        <p class="p_4"><span>结算周期</span></p>
                                        <p class="p_5"><span>任务资源</span></p>
                                        <p class="p_6"><span>更新时间</span></p>
                                        <p class="p_7"><span>操作</span></p>
                                    </li>
                                    <?php
                                    $captcha_info = Captcha::model()->findAllBySql("SELECT * FROM {{captcha}} where ip=0 and open=0 order by orderby desc");
                                    foreach ($captcha_info as $info) {
                                        ?>
                                        <li class="li_1 list">
                                            <p class="p_1"><a href="<?php echo SITE_URL ?>captcha/detail/id/<?php echo $info["id"]; ?>"><span><?php echo $info['name'] . $info['title2']; ?></span></a></p>
                                            <p class="p_2"><span><i><?php echo $info['code_val']; ?></i></span></p>
                                            <p class="p_3"><span>否</span></p>
                                            <p class="p_4"><span><?php echo $info['jiesuan']; ?>天</span></p>
                                            <p class="p_5">
                                                <span><?php
                                                    if (empty($info['resource'])) {
                                                        echo "充足";
                                                    } else {
                                                        echo "不充足";
                                                    }
                                                    ?>
                                                </span>
                                            </p>
                                            <p class="p_6">
                                                <?php
                                                if (empty($info['update_time'])) {
                                                    ?>
                                                    <span class="no"><?php echo date("Y-m-d", strtotime($info['create_time'])); ?></span>
                                                    <?php
                                                } else {
                                                    $updatetime = date("Y-m-d", strtotime($info['update_time']));
                                                    $daytime = date("Y-m-d");
                                                    if ($updatetime == $daytime) {
                                                        ?>
                                                        <span><?php echo $updatetime ?></span>
                                                    <?php } else { ?>
                                                        <span class="no"><?php echo $updatetime ?></span>
                                                    <?php } ?>
                                                <?php } ?>
                                            </p>
                                            <p class="p_7"><span><a href="<?php echo SITE_URL ?>captcha/detail/id/<?php echo $info['id']; ?>">参与任务 <i>>></i></a></span></p>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <?php
                        $ad_info = Ad::model()->findAllBySql("select img,url from {{ad}} where id=15 and open=0 ;");
                        if (!empty($ad_info)) {
                            foreach ($ad_info as $ad) {
                                ?>
                                <a href="<?php echo $ad['url']; ?>" class="advertisement_2" target="_blank">
                                    <img src="/uploads/img/ad/<?php echo $ad['img']; ?>" />
                                </a>
                                <?php
                            }
                        }
                        ?>
                        <!--换IP推荐任务-->
                        <div class="cont clearfix">
                            <div class="tit_2">
                                <span class="sp_1_1">换IP推荐任务</span>
                                <span class="sp_2">&nbsp;|&nbsp;打码时需要重复切换IP</span>
                            </div>
                            <div class="table clearfix">
                                <ul class="ul_1">
                                    <li class="li_1 tit">
                                        <p class="p_1"><span>任务名称</span></p>
                                        <p class="p_2"><span>每码价格</span></p>
                                        <p class="p_3"><span>是否换IP</span></p>
                                        <p class="p_4"><span>结算周期</span></p>
                                        <p class="p_5"><span>任务资源</span></p>
                                        <p class="p_6"><span>更新时间</span></p>
                                        <p class="p_7"><span>操作</span></p>
                                    </li>
                                    <?php
                                    $captcha_info2 = Captcha::model()->findAllBySql("SELECT * FROM {{captcha}} where ip=1 and open=0  order by orderby desc");
                                    foreach ($captcha_info2 as $info) {
                                        ?>
                                        <li class="li_1 list">
                                            <p class="p_1"><a href="javascript:"><span><?php echo $info['name'] . $info['title2']; ?></span></a></p>
                                            <p class="p_2"><span><i><?php echo $info['code_val']; ?></i></span></p>
                                            <p class="p_3"><span>是</span></p>
                                            <p class="p_4"><span><?php echo $info['jiesuan']; ?>天</span></p>
                                            <p class="p_5">
                                                <span><?php
                                                    if (empty($info['resource'])) {
                                                        echo "充足";
                                                    } else {
                                                        echo "不充足";
                                                    }
                                                    ?>
                                                </span>
                                            </p>
                                            <p class="p_6">
                                                <?php
                                                if (empty($info['update_time'])) {
                                                    ?>
                                                    <span class="no"><?php echo date("Y-m-d", strtotime($info['create_time'])); ?></span>
                                                <?php } else { ?>
                                                    <span><?php echo date("Y-m-d", strtotime($info['update_time'])); ?></span>
                                                <?php } ?>
                                            </p>
                                            <p class="p_7"><span><a href="<?php echo SITE_URL ?>captcha/detail/id/<?php echo $info['id']; ?>">参与任务 <i>>></i></a></span></p>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <!--长期打码任务-->
                        <div class="cont clearfix">
                            <div class="tit_2">
                                <span class="sp_1_3">长期打码任务</span>
                                <span class="sp_2">&nbsp;|&nbsp;打码时需要重复切换IP</span>
                            </div>
                            <div class="table clearfix">
                                <ul class="ul_1">
                                    <li class="li_1 tit">
                                        <p class="p_1"><span>任务名称</span></p>
                                        <p class="p_2"><span>每码价格</span></p>
                                        <p class="p_3"><span>是否换IP</span></p>
                                        <p class="p_4"><span>结算周期</span></p>
                                        <p class="p_5"><span>任务资源</span></p>
                                        <p class="p_6"><span>更新时间</span></p>
                                        <p class="p_7"><span>操作</span></p>
                                    </li>
                                    <?php
                                    $captcha_info3 = Captcha::model()->findAllBySql("SELECT * FROM {{captcha}} where ip=2  and open=0 order by orderby desc");
                                    foreach ($captcha_info3 as $info) {
                                        ?>
                                        <li class="li_1 list">
                                            <p class="p_1"><a href="javascript:"><span><?php echo $info['name'] . $info['title2']; ?></span></a></p>
                                            <p class="p_2"><span><i><?php echo $info['code_val']; ?></i></span></p>
                                            <p class="p_3"><span>否</span></p>
                                            <p class="p_4"><span><?php echo $info['jiesuan']; ?>天</span></p>
                                            <p class="p_5">
                                                <span><?php
                                                    if (empty($info['resource'])) {
                                                        echo "充足";
                                                    } else {
                                                        echo "不充足";
                                                    }
                                                    ?>
                                                </span>
                                            </p>
                                            <p class="p_6">
                                                <?php
                                                if (empty($info['update_time'])) {
                                                    ?>
                                                    <span class="no"><?php echo date("Y-m-d", strtotime($info['create_time'])); ?></span>
                                                <?php } else { ?>
                                                    <span><?php echo date("Y-m-d", strtotime($info['update_time'])); ?></span>
                                                <?php } ?>
                                            </p>
                                            <p class="p_7"><span><a href="<?php echo SITE_URL ?>captcha/detail/id/<?php echo $info['id']; ?>">参与任务 <i>>></i></a></span></p>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="show2" style="display:none;">
            <!--任务分类、打码辅助工具、打码视频教程...-->
			
            <div class="code_fz clearfix">
                            <div class="code_fz_left">
                                <span class="code_fz_img"></span>
                                <p class="code_fz_text">如果您的电脑是Windows XP系统，请您参与打码前先将这个插件下载安装，并重启电脑！</p>
                                <a class="code_fz_ann" href="http://pan.baidu.com/s/1jGr94ma" target="_blank"></a>
                            </div>
                            <div class="code_fz_right">
                                <span class="code_fz_img"></span>
                                <p class="code_fz_text">如果您想知道目前什么任务有资源以及任务上码率，您可以下载此插件！</p>
                                <a class="code_fz_ann"></a>
                            </div>
                        </div>


                    </div>

                    <div id="show3" style="display:none;">
                        <!--任务分类、打码辅助工具、打码视频教程...-->

                        <!-- 我爱播放器(52player.com)/代码开始 -->
                        <script type="text/javascript" src="/CuPlayer/images/swfobject.js"></script>
                        <div class="video" id="CuPlayer">
                        </div>
                        <script type="text/javascript">
            var so = new SWFObject("/CuPlayer/CuPlayerMiniV4.swf", "CuPlayerV4", "600", "410", "9", "#000000");
            so.addParam("allowfullscreen", "true");
            so.addParam("allowscriptaccess", "always");
            so.addParam("wmode", "opaque");
            so.addParam("quality", "high");
            so.addParam("salign", "lt");
            so.addVariable("CuPlayerSetFile", "/CuPlayer/CuPlayerSetFile.php"); //播放器配置文件地址,例SetFile.xml、SetFile.asp、SetFile.php、SetFile.aspx
            so.addVariable("CuPlayerFile", "http://demo.cuplayer.com/file/test.mp4"); //视频文件地址
            so.addVariable("CuPlayerImage", "/CuPlayer/images/start.jpg");//视频略缩图,本图片文件必须正确
            so.addVariable("CuPlayerWidth", "600"); //视频宽度
            so.addVariable("CuPlayerHeight", "410"); //视频高度
            so.addVariable("CuPlayerAutoPlay", "yes"); //是否自动播放
            so.addVariable("CuPlayerLogo", "/CuPlayer/images/logo.png"); //Logo文件地址
            so.addVariable("CuPlayerPosition", "bottom-right"); //Logo显示的位置
            so.write("CuPlayer");
                        </script>
                        <!-- 我爱播放器(52player.com)/代码结束 -->
                    </div>
                    <?php
                    $ad_infos = Ad::model()->findAllBySql("select img,url from {{ad}} where id=16 and open=0; ");
                    if (!empty($ad_infos)) {
                        foreach ($ad_infos as $ad) {
                            ?>
                            <!--广告位-->
                            <a href="<?php echo $ad['url']; ?>" class="advertisement_2" target="_blank">
                                <img src="/uploads/img/ad/<?php echo $ad['img']; ?>" />
                            </a>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <?php include_once("right.php") ?>
        </div>
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
    </body>
</html>