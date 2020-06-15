<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>个人中心-<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="<?php echo TIT; ?>,玩宝,免费奖品,网赚,免费Q币,赚Q币,试玩,网络兼职" />
        <meta name="description" content="<?php echo TIT; ?>是一个玩试玩元宝，购物赚元宝，打码赚元宝，兑换各种奖品的娱乐平台，通过引进各种有奖试玩和娱乐项目，使用户在、试玩平台、参与互动广告、打码平台中获得免费金豆—元宝，元宝可以换取Q币、话费、笔记本等丰富的奖品，同时也为商家提供了真实有效的用户群体。" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/vip/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/vip/index.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/vip/jQuery.v1.8.3.js"></script>
        <script src="/scripts/vip/public.js"></script>
        <style type="text/css">
            .hover1{border-top:4px solid #70a0f1; height:36px; line-height:36px; background:#4b6289;}
            div .errorMessage{color:red; display: block; padding-left:165px;}
        </style>
        <script type="text/javascript">
            //关闭提示框
            function close() {
                $("#exchangesuc").hide();
                // history.go(0);
            }
            window.onload = function() {
                var msg = $('#msg').val();
                if (msg != null) {
                    alert(msg);
                }
                var dhhld = $('#dhhld').val();
                if (dhhld == "success") {
                    $('#duihuandd').hide();
                    $('#exchangesuc').show();
                } else if (dhhld == "error") {
                    $('#duihuandd').show();
                }

                var badyzr = $('#badyzr').val();
                if (badyzr == "success") {
                    $('#badyzr1').hide();
                    $('#badyzrmsg').show();
                } else if (badyzr == "error") {
                    $('#badyzr1').show();
                    $('#badybg').show();
                }

                var badyzc = $('#badyzc').val();
                if (badyzc == "success") {
                    $('#badyzc1').hide();
                    $('#badyzcmsg').show();
                } else if (badyzc == "error") {
                    $('#badyzc1').show();
                    $('#badybg').show();
                }
            }

            function badyzrclose() {
                $('#badyzrmsg').hide();
                location.href = "<?php echo SITE_URL; ?>vipbady/trade";
            }

            function badyzcclose() {
                $('#badyzcmsg').hide();
                location.href = "<?php echo SITE_URL; ?>vipbady/trade";
            }
        </script>
    </head>
    <body> 
        <?php include_once("./protected/views/vipdesign/header.php"); ?>
        <!--主体-->
        <div class="main main_index clearfix">
            <!--导航-->
            <?php include_once("./protected/views/vipdesign/navicat.php") ?>
            <!--个人背景图-->
            <div class="bk_img" style="background:url(<?php echo IMG_URL ?>vip/img/index_bk_img_<?php echo rand(1, 4); ?>.jpg) no-repeat center;">
                <span class="data_bk"><a href="<?php echo SITE_URL ?>vipindex/data"><em>编辑资料</em></a></span>
            </div>
            <?php
            //判断是否有提示信息
            if (Yii::app()->user->hasFlash('msg')) {
                ?>
                <input type="hidden" value="<?php echo Yii::app()->user->getFlash('msg') ?>" id="msg" />
            <?php } ?>
            <?php
            //判断是否有提示信息
            if (Yii::app()->user->hasFlash('dhhld')) {
                ?>
                <input type="hidden" value="<?php echo Yii::app()->user->getFlash('dhhld') ?>" id="dhhld" />
            <?php } ?>
            <?php
            //判断是否有提示信息
            if (Yii::app()->user->hasFlash('badyzr')) {
                ?>
                <input type="hidden" value="<?php echo Yii::app()->user->getFlash('badyzr') ?>" id="badyzr" />
            <?php } ?>
            <?php
            //判断是否有提示信息
            if (Yii::app()->user->hasFlash('badyzc')) {
                ?>
                <input type="hidden" value="<?php echo Yii::app()->user->getFlash('badyzc') ?>" id="badyzc" />
            <?php } ?>
            <!--头像、个人资料-->
            <div class="personal clearfix">
                <div class="head_img">
                    <a class="tou" target="_blank">
                        <img src="<?php echo IMG_URL; ?>touxiang/<?php echo $memimg['img'] ?>" />
                        <a href="<?php echo SITE_URL; ?>vipindex/memimg/id/<?php echo $mem['memimg_id']; ?>" class="change_toux" title="修改头像"></a>
                    </a>
                </div>
                <div class="di_1">
                    <p class="p_1">
                        <?php
                        $h = date('G');
                        if ($h >= 6 && $h < 11) {
                            echo '早上好,' . "<em class='name'>" . $this->show_mem_name() . "</em>" . "吃个营养早餐，为一天补充能量吧！";
                        } else if ($h >= 11 && $h < 14) {
                            echo '中午好,' . "<em class='name'>" . $this->show_mem_name() . "</em>" . "吃顿丰富的午餐，为身体加油吧！";
                        } else if ($h >= 14 && $h < 18) {
                            echo '下午好,' . "<em class='name'>" . $this->show_mem_name() . "</em>" . "吃点可口的下午茶，休息一下吧！";
                        } else if ($h >= 18 && $h < 21) {
                            echo '晚上好,' . "<em class='name'>" . $this->show_mem_name() . "</em>" . "吃顿丰富的晚餐，犒劳一下自己吧！";
                        } else if ($h >= 21 && $h < 23) {
                            echo '睡觉啦,' . "<em class='name'>" . $this->show_mem_name() . "</em>" . "你的被窝在呼唤你呢！";
                        } else if ($h >= 23 || $h < 6) {
                            echo '夜深了,' . "<em class='name'>" . $this->show_mem_name() . "</em>" . "快去休息，熬夜对身体不好哦！";
                        } else {
                            echo "亲爱的," . "<em class='name'>" . $this->show_mem_name() . "</em>" . "会员要适当的休息！";
                        }
                        ?>
                        <a class="xx <?php
                        if (!empty($messagenum)) {
                            echo " tis_s";
                        }
                        ?>" href="<?php echo SITE_URL ?>vipmessage/show">未读信息：
                            <i> <?php echo $messagenum; ?>条</i></a>
                    </p>
                    <p class="p_2 clearfix">
                        <span class="name">账户名：<?php echo Yii::app()->user->name; ?></span>
                        <span class="dengj clearfix">
                            <em>安全等级：
                                <?php if (!empty($mem['phone']) && $mem['email_valid'] == 1 && !empty($mem['idcode'])) { ?>高
                                <?php } else if ((!empty($mem['phone']) && $mem['email_valid'] == 1) || (!empty($mem['phone']) && !empty($mem['idcode'])) || ($mem['email_valid'] == 1 && !empty($mem['idcode']))) { ?>中
                                <?php } else { ?>差<?php } ?>
                            </em>
                            <?php if (!empty($mem['phone'])) { ?>
                                <a class="sj sj_yes" href="javascript:" title="<?php echo "您已成功绑定手机号:" . $mem['phone'] ?>" ></a>
                            <?php } else { ?>
                                <a class="sj" href="<?php echo SITE_URL ?>vipindex/second" title="立即绑定手机" target="_blank"></a>
                            <?php } ?>
                            <?php if ($mem['email_valid'] == 1) { ?>
                                <a class="yx yx_yes" href="javascript:" title="<?php echo "您的邮箱已成功验证:" . $mem['email'] ?>"></a>
                            <?php } else { ?>
                                <a class="yx" href="<?php echo SITE_URL ?>vipindex/thirdly" title="立即绑定邮箱" target="_blank"></a>
                            <?php } ?>
                            <?php if (!empty($mem['idcode'])) { ?>
                                <a class="sfz sfz_yes" href="javascript:" title="<?php echo "您已经通过身份认证:" . $mem['idcode'] ?>"></a>
                            <?php } else { ?>
                                <a class="sfz" href="<?php echo SITE_URL ?>vipindex/first" title="立即身份证认证" target="_blank"></a>
                            <?php } ?>
                        </span>
                    </p>
                </div>
                <div class="di_2">今天登录时间：<?php echo $mem['scdl_time']; ?></div>
            </div>
            <!--可用元宝、可用金豆、可用金券-->
            <div class="available clearfix">
                <ul class="ul_1 clearfix">
                    <li>
                        <p class="tit">可用元宝</p>
                        <p class="nuber"><em class="bi"><?php
                                echo number_format(intval($hlbnum));
                                ?></em><a href="<?php echo SITE_URL ?>viptrade/gold">查看明细</a></p>   
                        <p class="butt clearfix"><a class="button_1" href="<?php echo SITE_URL ?>vipadvance/txalipay">提现</a></p> 
                    </li>
                    <li>
                        <p class="tit">可用金豆</p>
                        <p class="nuber"><em class="dou"><?php
                                echo number_format(intval($hldnum));
                                ?></em><a href="<?php echo SITE_URL ?>viptrade/bean">查看明细</a></p>
                        <p class="butt clearfix">
                            <a class="button_1" href="<?php echo SITE_URL ?>gift/show">兑换礼品</a>
                            <a class="button_1 dui_dd" href="javascript:">兑换金豆</a>
                        </p>
                    </li>
                    <li class="no">
                        <p class="tit">可用金券(不可用)</p>
                        <p class="nuber"><em class="juan">0</em><!--<a href="<?php echo SITE_URL ?>viptrade/ticket">-->查看明细<!--</a>--></p>
                        <p class="butt clearfix">
                            <!--<a class="button_1" href="javascript:">-->充值<!--</a>-->
                            <!--<a class="button_1" href="<?php echo SITE_URL ?>vipadvance/txalipay">-->提现<!--</a>-->
                        </p>
                    </li>
                </ul>
            </div>
            <?php
            $num2 = Gamezm::model()->countBySql("SELECT count(*) FROM {{game_zm}} where mem_id=" . $mem["id"]);
            $sql2 = "SELECT * FROM {{game_zm}} where mem_id=" . $mem["id"];
            $gamezm_info = Gamezm::model()->findAllBySql($sql2);
            if (!empty($gamezm_info)) {
                foreach ($gamezm_info as $info) {
                    $str.=$info['gid'] . ",";
                }
                $sql3 = "SELECT count(*) FROM {{game}} where TO_DAYS(end_time) >= (TO_DAYS(NOW())) and id not in (" . substr($str, 0, -1) . ")";
            } else {
                $sql3 = "SELECT count(*) FROM {{game}} where TO_DAYS(end_time) >= (TO_DAYS(NOW()))  ";
            }
            $count = Game::model()->countBySql($sql3);
            $badysum = $badyzr_model->countBySql("select sum(hlb) from {{bady}} where mem_id=" . $mem['id']);
            $badyprob_info = Badyprob::model()->findBySql("select * from {{bady_prob}} where  TO_DAYS(create_time) = (TO_DAYS(NOW()))");
            ?>
            <!--我的试玩、推广收益、玩宝收益-->
            <div class="wth clearfix">
                <ul class="ul_1 clearfix">
                    <li class="li_1">
                        <p class="tit">我的试玩</p>
                        <div class="cyu">
                            <p class="p_1 clearfix">
                                <span>还未参与试玩：<i>
                                        <?php
                                        echo intval($count);
                                        ?>个
                                    </i>
                                </span>
                                <a class="button_1" href="<?php echo SITE_URL ?>game/show">领新任务</a>
                            </p>
                            <p class="p_1 clearfix">
                                <span>已经参与试玩：
                                    <i>
                                        <?php echo intval($num2); ?>个
                                    </i>
                                </span>
                                <a class="button_1" href="<?php echo SITE_URL ?>viptask/game">试玩明细</a>
                            </p>
                        </div>
                        <p class="total">试玩总收益：<i><?php echo number_format(Hlb::model()->countBySql("select sum(hlb) from {{hlb}} where source = 3 and mem_id=" . $mem['id'])); ?></i>元宝</p>
                    </li>
                    <li class="li_2">
                        <p class="tit">推广收益<i>（元宝）</i></p>
                        <div class="cyu">
                            <p class="p_1 clearfix">    
                                <span>我的好友总数：<i><?php
                                        $frinum = Mem::model()->countBySql("SELECT count(*) from xm_mem where INSTR(pid,'" . $mem['id'] . ",') !=0 and  (length(substring(pid,INSTR(pid,'" . $mem['id'] . ",')))-length(replace(substring(pid,INSTR(pid,'" . $mem['id'] . ",')),',','')))<5 ");
                                        echo intval($frinum);
                                        ?>个</i></span>
                            </p>
                            <p class="p_1 clearfix">
                                <span>当月推广收益：<em><?php
                                        $montynum = Hlb::model()->countBySql("select sum(hlb) from {{hlb}} where month(create_time)=month(now()) and pmem_id != 0 and mem_id=" . $mem['id']);
                                        echo number_format(intval($montynum));
                                        ?></em></span>
                                <a class="button_1" href="<?php echo SITE_URL ?>vipexpand/way">获取推广链接</a>
                            </p>
                        </div>
                        <p class="total">推广总收益：<i><?php
                                $tgsum = Hlb::model()->countBySql("select sum(hlb) from {{hlb}} where pmem_id != 0 and mem_id=" . $mem['id']);
                                echo number_format(intval($tgsum));
                                ?></i> 元宝</p>
                    </li>
                    <?php
                    $badymoney = Badymoney::model()->countBySql("select sum(hlb) as hlbsum from {{bady_money}} where  mem_id=" . $mem['id']);
                    $badymoeny_info = Badymoney::model()->findBySql("select hlb from {{bady_money}} where  TO_DAYS(create_time) = (TO_DAYS(NOW())) and mem_id=" . $mem['id']);
                    ?>
                    <!--<li class="li_3">
                        <p class="tit">玩宝收益<i>（元宝）(不可用)</i><a href="<?php echo SITE_URL; ?>vipbady/show">管理</a></p>
                        <div class="cyu">
                            <p class="p_1 clearfix">
                                <span>当前收益率：<i><?php
                                        if (!empty($badyprob_info["prob"])) {
                                            echo $badyprob_info["prob"];
                                        } else {
                                            echo 0;
                                        }
                                        ?>%</i></span>
                                <!--<a class="button_1 zr" href="javascript:">转入</a>
                            </p>
                            <p class="p_1 clearfix">
                                <span>当前收益：<em><?php echo number_format(intval($badymoeny_info["hlb"])); ?></em></span>
                                <a class="button_1 zc" href="javascript:">转出</a>
                            </p>
                        </div>
                        <p class="total">玩宝总收益：<i><?php echo number_format(intval($badymoney)); ?></i> 元宝</p>
                    </li>-->
                </ul>
            </div>
            <!--提现方式-->
            <div class="pay">
                <div class="tit clearfix">
                    <span>提现方式</span>
                </div>
                <ul class="ul_1 clearfix">
                    <li>
                        <a href="<?php echo SITE_URL ?>vipadvance/alipay" class="clearfix">
                            <span class="ico ico_1"></span>
                            <p class="p_1">支付宝提现</p>
                            <p class="p_2">
                                <?php if (!empty($mem['alipayid'])) { ?>
                                    当前绑定账号：
                                    <?php echo substr_replace(Alipay::model()->findByPk($mem['alipayid'])->account, '*****', 3, 5); ?>
                                <?php } else { ?>
                                    当前您未绑定支付宝
<?php } ?>
                            </p>
                        </a>
                    </li>
                    <li>
                        <!--<a href="<?php echo SITE_URL ?>vipadvance/treasure" class="clearfix">
                            <span class="ico ico_2"></span>
                            <p class="p_1">财付通提现</p>
                            <p class="p_2">
                                <?php if (!empty($mem['treasureid'])) { ?>
                                    当前绑定账号：
                                    <?php echo substr_replace(Treasure::model()->findByPk($mem['treasureid'])->account, '*****', 3, 5); ?>
                                <?php } else { ?>
                                    当前您未绑定财付通
<?php } ?>
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo SITE_URL ?>vipadvance/bank" class="clearfix">
                            <span class="ico ico_3"></span>
                            <p class="p_1">银行卡提现</p>
                            <p class="p_2">
                                <?php if (!empty($mem['bankid'])) { ?>
                                    当前绑定账号：
                                    <?php echo substr_replace(Bank::model()->findByPk($mem['bankid'])->account, '*****', 3, 5); ?>
                                <?php } else { ?>
                                    当前您未绑定银行卡
<?php } ?>
                            </p>
                        </a>
                    </li>-->
                </ul>
            </div>
            <?php
            if (!empty($ad_info)) {
                foreach ($ad_info as $ad) {
                    ?>
                    <a class="advertising_1" href="<?php echo $ad['url']; ?>" target="_blank">
                        <img src="/uploads/img/ad/<?php echo $ad['img']; ?>">
                    </a>
                    <?php
                }
            }
            ?>
        </div>

        <!--转入、转出弹出框-->
        <div class="turn_bk" id="badybg"></div>
        <?php
        $form1 = $this->beginWidget('CActiveForm', array("id" => "dhform1"));
        ?>
        <div class="turn turn_1" style="display:none"   id="badyzr1">
            <div class="tit clearfix">
                <span>玩宝转入</span>
                <i></i>
            </div>
            <input type="hidden" value="转入" name="Badyzr[trade_type]"/>
            <input type="hidden" value="待审核" name="Badyzr[status]"/>
            <input type="hidden" value="<?php echo $mem["id"]; ?>" name="Badyzr[mem_id]" />
            <div class="cont">
                <ul class="ul_1">
                    <li>
                        <span class="text">元宝余额：</span>
                        <span class="nuber"><em class="bi_1"><?php echo number_format(intval($hlbnum)); ?></em>&nbsp;&nbsp;&nbsp; </span>
                    </li>
                    <li>
                        <span class="text">玩宝余额：</span>
                        <span class="nuber"><em class="bi_1"><?php echo number_format(intval($badysum)); ?></em>&nbsp;&nbsp;&nbsp; </span>
                    </li>
                    <li>
                        <span class="text">转入金额：</span>
                            <?php echo $form1->textField($badyzr_model, 'hlb', array("class" => "sframe sframe_1", "placeholder" => "请输入转入金额")); ?>
                        <i></i>
                        <em class="zs">
                            <?php
                            $msghlb = $badyzr_model->getError("hlb");
                            if (!empty($msghlb)) {
                                echo $msghlb;
                            } else {
                                echo "转入元宝必须≥20,000";
                            }
                            ?>
                        </em>
                    </li>
                    <li>
                        <span class="text">交易密码：</span>
                        <?php if (!empty($mem["jy_pwd"])) { ?>
                            <?php echo $form1->passwordField($badyzr_model, 'jy_pwd', array("class" => "sframe sframe_1", "placeholder" => "请输入、交易密码")); ?>  
                        <?php } else { ?>
                            <a style="color:red" href="<?php echo SITE_URL ?>vipindex/fourthly">设置交易密码</a>
                    <?php } ?>
                        <a class="wj" href="<?php echo SITE_URL; ?>vipindex/jypwd">忘记密码？</a>
                    </li>
                        <?php echo $form1->error($badyzr_model, 'jy_pwd'); ?>
                    <li>
                        <span class="text">收益发放日期：</span>
                        <?php
                        $day = date("w");
                        $time = date('H', time());
                        $daystr = null;
                        if ($day == 1) {
                            if ($time < 15) {
                                ?>
                                <span><?php $daystr = date("Y年m月d日", time() + (3600 * 24 * 2)); ?></span>
                            <?php } else { ?>
                                <span><?php $daystr = date("Y年m月d日", time() + (3600 * 24 * 3)); ?></span>
                            <?php } ?>
                            <?php
                        } else if ($day == 2) {
                            if ($time < 15) {
                                ?>
                                <span><?php $daystr = date("Y年m月d日", time() + (3600 * 24 * 2)); ?></span>
                            <?php } else { ?>
                                <span><?php $daystr = date("Y年m月d日", time() + (3600 * 24 * 3)); ?></span>
                            <?php } ?>
                            <?php
                        } else if ($day == 3) {
                            if ($time < 15) {
                                ?>
                                <span><?php $daystr = date("Y年m月d日", time() + (3600 * 24 * 2)); ?></span>
                            <?php } else { ?>
                                <span><?php $daystr = date("Y年m月d日", time() + (3600 * 24 * 3)); ?></span>
                            <?php } ?>
                            <?php
                        } else if ($day == 4) {
                            if ($time < 15) {
                                ?>
                                <span><?php $daystr = date("Y年m月d日", time() + (3600 * 24 * 2)); ?></span>
                            <?php } else { ?>
                                <span><?php $daystr = date("Y年m月d日", time() + (3600 * 24 * 5)); ?></span>
                            <?php } ?>
                            <?php
                        } else if ($day == 5) {
                            if ($time < 15) {
                                ?>
                                <span><?php $daystr = date("Y年m月d日", time() + (3600 * 24 * 4)); ?></span>
                            <?php } else { ?>
                                <span><?php $daystr = date("Y年m月d日", time() + (3600 * 24 * 5)); ?></span>
                            <?php } ?>
                        <?php } else if ($day == 6) { ?>
                            <span><?php $daystr = date("Y年m月d日", time() + (3600 * 24 * 4)); ?></span>
                        <?php } else if ($day == 0) {
                            ?>
                            <span><?php $daystr = date("Y年m月d日", time() + (3600 * 24 * 3)); ?></span>
                            <?php
                        }
                        echo $daystr;
                        ?>
                        <a class="banz" href="javascript:" title="15:00前转入资金（以支付成功时间为准），第二个工作日确认份额，收益将在确认后次日发放，15:00后转入资金顺延1个工作日发放收益。双休日及国家法定假期，不进行份额确认。">[?]</a>
                    </li>
                    <li>
                        <a class="button_2" href="javascript:document.getElementById('dhform1').submit();">确认转入</a>
                    </li>
                </ul>
            </div>
        </div>
        <?php $this->endWidget(); ?>
        <?php
        $form2 = $this->beginWidget('CActiveForm', array("id" => "dhform2"));
        ?>
        <!--转出-->
        <div class="turn turn_2" id="badyzc1">
            <div class="tit clearfix">
                <span>玩宝转出</span>
                <i></i>
            </div>
            <input type="hidden" value="转出" name="Badyzc[trade_type]"/>
            <input type="hidden" value="待审核" name="Badyzc[status]"/>
            <input type="hidden" value="<?php echo $mem["id"]; ?>" name="Badyzc[mem_id]" />
            <div class="cont">
                <ul class="ul_1">
                    <li>
                        <span class="text">玩宝余额：</span>
                        <span class="nuber"><em class="bi_1"><?php echo number_format(intval($badysum)); ?></em> &nbsp;&nbsp;&nbsp; </span>
                    </li>
                    <li>
                        <span class="text">转出金额：</span>
                            <?php echo $form2->textField($badyzc_model, 'hlb', array("class" => "sframe sframe_1", "placeholder" => "请输入转出金额")); ?>
                        <i></i>
                        <em class="zs">
                            <?php
                            $msghlb2 = $badyzc_model->getError("hlb");
                            if (!empty($msghlb2)) {
                                echo $msghlb2;
                            } else {
                                echo " 转出元宝必须≥20,000";
                            }
                            ?>
                        </em>
                    </li>
                    <li>
                        <span class="text">交易密码：</span>
                        <?php if (!empty($mem["jy_pwd"])) { ?>
                            <?php echo $form2->passwordField($badyzc_model, 'jy_pwd', array("class" => "sframe sframe_1", "placeholder" => "请输入、交易密码")); ?>    
                        <?php } else { ?>
                            <a style="color:red" href="<?php echo SITE_URL ?>vipindex/fourthly">设置交易密码</a>
                    <?php } ?>
                        <a class="wj" href="<?php echo SITE_URL; ?>vipindex/jypwd">忘记密码？</a>
                    </li>
<?php echo $form2->error($badyzc_model, 'jy_pwd'); ?>
                    <li>
                        <a class="button_2" href="javascript:document.getElementById('dhform2').submit();">确认转出</a>
                    </li>
                </ul>
            </div>
        </div>
        <?php $this->endWidget(); ?>

        <?php include_once("./protected/views/vipdesign/footer.php") ?>
        <?php include_once("./protected/views/vipdesign/kefu.php") ?>
        <?php
        $form = $this->beginWidget('CActiveForm', array("id" => "dhform"));
        ?>
        <!--兑换金豆弹出框-->
        <div class="eject_db1" style="display:none" id="duihuandd">
            <!--兑换金豆弹出框背景-->
            <div class="eject_bk6" style="display:block"></div>
            <!--兑换金豆弹出框-->
            <div class="eject6" style="display:block">
                <div class="tit clearfix">
                    <span>兑换金豆</span>
                    <i></i>
                </div>
                <div class="cont">
                    <ul class="ul_1">
                        <li>
                            <span class="text">您当前元宝余额：</span>
                            <span class="bi"><?php echo number_format($hlbnum) ?></span>
                        </li>
                        <li>
                            <span class="text">兑换金豆：</span>
                        <?php echo $form->dropDownList($dhhld_model, 'hld', array("20000" => "2万金豆", "30000" => "3万金豆", "50000" => "5万金豆", "100000" => "10万金豆", "500000" => "50万金豆", "1000000" => "100万金豆", "5000000" => "500万金豆"), array('empty' => '请选择兑换数量', "class" => "sframe sframe_1")); ?>               
                            <span>&nbsp;&nbsp;当前兑换比例为1:1</span>
                        </li>
                            <?php echo $form->error($dhhld_model, 'hld'); ?>
                        <li>
                            <span class="text">交易密码：</span>
                            <?php if (!empty($mem["jy_pwd"])) { ?>
                                <?php echo $form->passwordField($dhhld_model, 'jy_pwd', array("class" => "sframe sframe_1")); ?>     
                                <?php echo $form->error($dhhld_model, 'jy_pwd'); ?>
                            <?php } else { ?>
                                <a style="color:red" href="<?php echo SITE_URL ?>vipindex/fourthly">设置交易密码</a>
<?php } ?>
                            <a class="wj" href="<?php echo SITE_URL; ?>vipindex/jypwd">忘记密码？</a>
                        </li>
                        <li>
                            <a class="button_2" href="javascript:document.getElementById('dhform').submit();">确定兑换</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
<?php $this->endWidget(); ?>
        <!--兑换金豆成功弹出框-->
        <div class="eject_db5" id="exchangesuc" style=" display: none;">
            <!--兑换金豆成功弹出框背景-->
            <div class="eject_bk4" style="display:block"></div>
            <!--兑换金豆成功弹出框-->
            <div class="eject4" style="display:block">
                <div class="eject1_tit">兑换金豆成功！</div>
                <div class="eject1_button clearfix">
                    <span><a href="javascript:close()" class="eject1_ann">暂不兑换礼品</a></span>
                    <span><a href="<?php echo SITE_URL ?>gift/show" class="eject1_ann">前去商城兑换礼品</a></span>
                </div>
            </div>
        </div>

        <div class="eject_db2" style=" display: none;" id="badyzcmsg">
            玩宝转出成功弹出框背景
            <div class="eject_bk1" style="display:block"></div>
            玩宝转出成功弹出框
            <div class="eject1" style="display:block">
                <div class="eject1_tit">转出成功！</div>
                <div class="eject1_text clearfix">
                    <span class="bt">当前玩宝利率：</span>
                    <span class="sl"><?php echo $badyprob_info["prob"]; ?>%</span>
                </div>
                <div class="eject1_text clearfix">
                    <span class="bt">您本次扣除额度：</span>
                    <span class="sl"><?php echo number_format(intval($hlb)); ?></span>
                    <span class="zs">元宝</span>
                </div>
                <div class="eject1_text clearfix">
                    <span class="bt">当前玩宝余额：</span>
                    <span class="sl"><?php echo number_format(intval($badysum)); ?></span>
                    <span class="zs">元宝</span>
                </div>
                <div class="eject1_button clearfix">
                    <span><a href="<?php echo SITE_URL . "vipadvance/txalipay"; ?>" class="eject1_ann" target="_blank">前去提现</a></span>
                    <span><a href="javascript:badyzcclose();" class="eject1_ann">确认</a></span>
                </div>
            </div>
        </div>

        <!--玩宝转入成功弹出框-->
        <div class="eject_db3"  style=" display: none;" id="badyzrmsg">
            玩宝转入成功弹出框背景
            <div class="eject_bk2" style="display:block"></div>
            玩宝转入成功弹出框
            <div class="eject2" style="display:block">
                <div class="eject1_tit">转入成功！</div>
                <div class="eject1_text clearfix">
                    <span class="bt">当前玩宝利率：</span>
                    <span class="sl"><?php echo $badyprob_info["prob"]; ?>%</span>
                </div>
                <div class="eject1_text clearfix">
                    <span class="bt">您本次转入金额：</span>
                    <span class="sl" id="zrmoney"><?php echo number_format(intval($hlb)); ?></span>
                    <span class="zs">元宝</span>
                </div>
                <div class="eject1_text clearfix">
                    <span class="bt">当前玩宝余额：</span>
                    <span class="sl" id="badymoney"><?php echo number_format(intval($badysum)); ?></span>
                    <span class="zs">元宝</span>
                </div>
                <div class="eject1_text3 clearfix">
                    <span class="bt">本次转入预计将在</span>
                    <span class="sl">
<?php echo $daystr; ?>
                    </span>
                    <span class="js">开始计算收益</span>
                </div>
                <div class="eject1_button clearfix">
                    <a href="javascript:badyzrclose();" class="eject1_ann">确认</a>
                </div>
            </div>
        </div>
    </body>
    <script>
        $(function() {
            //兑换金豆弹出框
            $(".main_index .available .ul_1 li .butt .dui_dd").click(function() {
                $(".eject_db1").show();
            });
            $(".eject6 .tit i").click(function() {
                $(".eject_db1").hide();
            });
            $(".eject4 .eject1_button .qx").click(function() {
                $(".eject_db5").hide();
            });
        })
    </script>
</html>
