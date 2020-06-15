<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo $captcha_info["name"]; ?>-打码平台—详情-<?php echo TIT; ?>、官方网站</title>
        <meta name="keywords" content="、网络打码,打码平台，打码赚钱，打码任务，打码网赚" />
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
    </head>
    <body>
        <?php include_once("./protected/views/design/header.php") ?>
        <!--主体-->
        <div class="main clearfix">
            <div class="main_left clearfix">
                <!--打码项目详情-->
                <div class="code_details">
                    <div class="tit">
                        <span class="sp_1"><?php echo $captcha_info['name']; ?></span>
                    </div>
                    <div class="cont">
                        <div class="di_1 clearfix">
                            <div class="left_1">
                                <p class="p_1 clearfix">
                                    <span>码值：<em><?php echo $captcha_info['code_val']; ?></em></span>
                                    <span>是否换IP：
                                        <i>
                                            <?php
                                            if (empty($captcha_info['ip'])) {
                                                echo "不换";
                                            } else if ($captcha_info['ip'] == 1) {
                                                echo "换";
                                            } else if ($captcha_info['ip'] == 2) {
                                                echo "长期打码";
                                            }
                                            ?>
                                        </i>
                                    </span>
                                    <span>任务状态：<i><?php
                                            if (empty($captcha_info['open'])) {
                                                echo "进行中";
                                            } else {
                                                echo "已结束";
                                            }
                                            ?></i></span>
                                </p>
                                <p class="p_1 clearfix">
                                    <span>数据结算周期：<i><?php echo $captcha_info['jiesuan']; ?>天</i></span>
                                    <span>最近更新时间：
                                        <?php
                                        if (empty($captcha_info['update_time'])) {
                                            echo "--";
                                        } else {
                                            echo date("Y-m-d", strtotime($captcha_info['update_time']));
                                        }
                                        ?>
                                    </span>
                                    <span>参与人数：<i>
                                            <?php
                                            $num = Captchazm::model()->countBySql("select count(*) from {{captcha_zm}} where  captcha_id= " . $captcha_info["id"]);
                                            echo $num;
                                            ?>人
                                        </i>
                                    </span>
                                </p>
                                <p class="p_2 clearfix">
                                    <a class="ann_1" target="_blank" href="<?php echo $captcha_info['down_url']; ?>">下载软件</a>
                                </p>
                            </div>
                            <div class="right_1">
                                <!--广告-->
                                <?php
                                $ad_info6 = Ad::model()->findAllBySql("select img,url from {{ad}} where id=18 and open=0 ");
                                if (!empty($ad_info6)) {
                                    foreach ($ad_info6 as $ad) {
                                        ?>
                                        <!--广告图-->
                                        <a class="advertising_1" href="<?php echo $ad['url']; ?>" target="_blank">
                                            <img src="/uploads/img/ad/<?php echo $ad['img']; ?>">
                                        </a>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        if (Yii::app()->user->getIsGuest()) {
                            ?>
                            <!--未登时陆显示-->
                            <div class="di_2">
                                对不起，你尚未登陆，如果你已有帐号，请点此<a href="javascript:" class="a_1" id="dlck">立即登陆</a>，还没有帐号？点击这里<a href="<?php echo SITE_URL ?>index/regester" class="a_2">立即注册</a>
                            </div>
                            <!--未登时陆显示结束-->
                            <?php
                        } else {
                            $captchadata_model = Captchadata::model();
                            ?>
                            <div class="di_3">
                                <div class="tit_1 clearfix">
                                    <span>我的<?php echo $captcha_info['name']; ?>总收益</span>
                                </div>
                                <div class="table clearfix">
                                    <ul class="ul_1">
                                        <li class="li_1 tit_3">
                                            <p class="p_1"><span>打码工号</span></p>
                                            <p class="p_2"><span>密码</span></p>
                                            <p class="p_3"><span>码值</span></p>
                                            <p class="p_4"><span>本期数量</span></p>
                                            <p class="p_5"><span>总计数量</span></p>
                                            <p class="p_6"><span>本期元宝</span></p>
                                            <p class="p_7"><span>总计元宝</span></p>
                                            <p class="p_8"><span>最新更新时间</span></p>
                                        </li>
                                        <li class="li_1 list">
                                            <p class="p_1">
                                                <span><?php echo $captcha_info["qz"] . $mem["id"]; ?>
                                                </span>
                                            </p>
                                            <p class="p_2"><span>123456</span></p>
                                            <p class="p_3"><span><?php echo $captcha_info['code_val']; ?></span></p>
                                            <p class="p_4"><span>
                                                    <?php
                                                    $daynum2 = $captchadata_model->countBySql("select SUM(num) from {{captcha_data}} where   create_time between '" . date("Y-m-d", strtotime($captcha_info['update_time'])) . " 00:00 ' and '" . date("Y-m-d", strtotime($captcha_info['update_time'])) . " 23:59'  and mem_id=" . $mem["id"] . " and name ='" . $captcha_info["name"] . "'");
                                                    echo intval($daynum2);
                                                    ?>
                                                </span>
                                            </p>
                                            <p class="p_5"><span>
                                                    <?php
                                                    $totalnum2 = $captchadata_model->countBySql("select SUM(num) from {{captcha_data}} where  mem_id=" . $mem["id"] . " and name ='" . $captcha_info["name"] . "'");
                                                    echo intval($totalnum2);
                                                    ?>
                                                </span></p>
                                            <p class="p_6"><span><i><?php
                                                        $daynum = $captchadata_model->countBySql("select SUM(rewards_hlb) from {{captcha_data}} where   create_time between '" . date("Y-m-d", strtotime($captcha_info['update_time'])) . " 00:00 ' and '" . date("Y-m-d", strtotime($captcha_info['update_time'])) . " 23:59'  and mem_id=" . $mem["id"] . " and name ='" . $captcha_info["name"] . "'");
                                                        echo intval($daynum);
                                                        ?></i></span></p>
                                            <p class="p_7"><span><i><?php
                                                        $totalnum = $captchadata_model->countBySql("select SUM(rewards_hlb) from {{captcha_data}} where    mem_id=" . $mem["id"] . " and name ='" . $captcha_info["name"] . "'");
                                                        echo intval($totalnum);
                                                        ?></i></span></p>
                                            <p class="p_8"><span><?php echo date("Y-m-d", strtotime($captcha_info['update_time'])) ?></span></p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tit_1 clearfix">
                                    <span>领取<?php echo $captcha_info['name']; ?>每日工资</span>
                                    <a class="jc" href="<?php echo SITE_URL ?>captcha/voide">新手打码教程</a>
                                </div>
                                <div class="table_2 clearfix">
                                    <ul class="ul_1">
                                        <li class="li_1 tit_3">
                                            <p class="p_1"><span>打码日期</span></p>
                                            <p class="p_2"><span>当前数量</span></p>
                                            <p class="p_3"><span>奖励元宝</span></p>
                                            <p class="p_4"><span>发放状态</span></p>
                                        </li>
                                        <?php
                                        foreach ($posts as $model) {
                                            ?>
                                            <li class="li_1 list">
                                                <p class="p_1"><span><?php echo date("Y-m-d", strtotime($model['create_time'])); ?></span></p>
                                                <p class="p_2"><span><?php echo $model['num']; ?></span></p>
                                                <p class="p_3"><span><i><?php echo $model['rewards_hlb']; ?></i></span></p>
                                                <p class="p_4"><span><i class="w">已发放</i></span></p>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <br/><br/>
                                <div style="text-align: center;height: 30px;">
                                    <?php
                                    if ($pages->itemCount == 0) {
                                        echo "当前内容为空！";
                                    } else {
                                        $this->widget('CLinkPager', array('pages' => $pages));
                                    }
                                    ?>
                                </div>
                                <div class="zhu">注：每日打码任务工资将会自动发放，每日工资最长保留5天，如有疑问请联系在线客服</div>
                            </div>
                        <?php } ?>
                        <div class="di_3">
                            <div class="tit_1 clearfix">
                                <span>项目介绍</span>
                            </div>
                            <div class="jies">
                                <p>
                                    <?php echo $captcha_info['introduce']; ?>
                                </p>
                            </div>
                            <div class="tit_1 clearfix">
                                <span>基本常识</span>
                            </div>
                            <div class="changs">
                                <p>
                                    码值：每一码的价格(TT除外)，货币为元宝
                                    <br />
                                    打码奖励=有效码数 * 码值
                                    <br />
                                    打码奖励发放时间为清零后的48小时内(LA除外)
                                </p>
                                <p class="p_2">所有项目7天无业绩一律回收工号，长久不打的项目在开工前先在本页查看工号是否还显示，如不显示请
                                    重新领号</p>
                            </div>
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