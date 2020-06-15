<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>个人中心—玩宝管理——<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="/" />
        <meta name="description" content="/" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/vip/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/vip/inside.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/vip/jQuery.v1.8.3.js"></script>
        <script src="/scripts/vip/public.js"></script>
        <script src="/scripts/vip/jscharts.js" type="text/javascript"></script>
        <style type="text/css">
            .hover7{border-top:4px solid #70a0f1; height:36px; line-height:36px; background:#4b6289;}
            .hover20{background: url("<?php echo IMG_URL ?>vip/img/public_db _menu_left _j.png") no-repeat scroll right center #fff; color: #cc3d12;width: 171px;}
            div .errorMessage{color:red; display: block; padding-left:165px;}
        </style>
    </head>
    <body>
        <!--头部-->
        <?php include_once("./protected/views/vipdesign/header.php"); ?>
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
        <!--主体-->
        <div class="main clearfix">
            <!--导航-->
            <?php include_once("./protected/views/vipdesign/navicat.php") ?>
            <div class="public_db clearfix">
                <!--左菜单-->
                <?php include_once("left.php") ?>
                <?php
                $badymoney = Badymoney::model()->countBySql("select sum(hlb) as hlbsum from {{bady_money}} where  mem_id=" . $mem['id']);
                $tmobadymoeny_info = Badymoney::model()->findBySql("select hlb from {{bady_money}} where  TO_DAYS(create_time) = (TO_DAYS(NOW())-1) and mem_id=" . $mem['id']);
                $badynum = Badyzr::model()->countBySql("select sum(hlb) as hlbsum from {{bady}} where  mem_id=" . $mem['id']);
                ?>
                <!--右内容-->
                <div class="cont prizes">
                    <div class="tit">
                        <p class="p_1">
                            <span>您当前可提现：</span>
                            <i> <?php echo number_format(intval($badynum / 10000)); ?>￥</i>
                            <span class="zhu">（小累计大回报，尽在玩宝，会赚钱的玩宝）</span>
                        </p>
                    </div>
                    <!--收益-->
                    <div class="profit">
                        <ul class="ul_1 clearfix">
                            <li class="li_1">
                                <div class="list">
                                    <div class="tit_1 clearfix">
                                        <span class="text">昨日收益<i>（元宝）</i></span>
                                        <i class="dian" title=""></i>
                                    </div>
                                    <div class="cont_1">
                                        <?php echo number_format(intval($tmobadymoeny_info["hlb"])); ?>  <i class="bi">（元宝）</i>
                                    </div>
                                    <p class="ann clearfix"><a class="button_1 zr" href="javascript:">转入</a></p>
                                </div>
                            </li>
                            <li class="li_2" style="display:none;">
                                <div class="list">
                                    <div class="tit_1 clearfix">
                                        <span class="text">七日年化收益<i>（%）</i></span>
                                        <i class="dian_1" title=""></i>
                                    </div>
                                    <div class="cont_1">
                                        <?php echo number_format($year, 1); ?><i class="bi">%</i>
                                    </div>
                                    <p class="ann clearfix"><a class="button_1" href="javascript:">转入</a></p>
                                </div>
                            </li>
                            <li>
                                <div class="list">
                                    <div class="tit_1 clearfix">
                                        <span class="text">玩宝总金额<i>（元宝）</i></span>
                                    </div>
                                    <div class="cont_1">
                                        <?php echo number_format(intval($badynum)); ?><i class="bi">（元宝）</i>
                                    </div>
                                    <p class="ann clearfix"><a class="button_1 zc" href="javascript:">转出</a></p>
                                </div>
                            </li>
                            <li>
                                <div class="list">
                                    <div class="tit_1 clearfix">
                                        <span class="text">我的历史收益（<i>（元宝）</i></span>
                                    </div>
                                    <div class="cont_1">
                                        <?php echo number_format(intval($badymoney)); ?><i class="bi">（元宝）</i>
                                    </div>
                                    <p class="ann clearfix"><a class="button_1" href="<?php echo SITE_URL; ?>vipbady/money">查看详情</a></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="trend_img clearfix">
                        <div id="graph">Loading...</div>
                    </div>
                    <!--切换-->
                    <div class="switch_1">
                        <ul class="ul_1 clearfix">
                            <li><span class="hover" id="tow1" onmouseover="setTab('tow', 1, 4)">收益</span></li>
                            <li><span id="tow2" onmouseover="setTab('tow', 2, 4)">安全</span></li>
                            <li><span id="tow3" onmouseover="setTab('tow', 3, 4)">转入</span></li>
                            <li><span id="tow4" onmouseover="setTab('tow', 4, 4)">转出</span></li>
                        </ul>
                        <ul class="cont_1"  id="con_tow_1" >
                            <li>
                                <p class="tit_1"><i>>&nbsp;</i>玩宝什么时候能看到收益到账？</p>
                                <p>转入元宝在、官方确认份额的第2天可以看到收益，点此查看详情。 <a href="/message/detail/id/224/pid/1" target="_blank" style="color:#219eff">收益介绍</a>
                                <br/>如遇国家法定假期，基金公司不进行份额确认，以实际收益时间为准。</p>
                            </li>
                            <li>
                                <p class="tit_1"><i>>&nbsp;</i>玩宝每天的收益是怎么计算的？</p>
                                <p>当日收益= 玩宝转入元宝 X 日收益率。假设您的已确认资金为80,000,000 元宝，当天的日收益为0.02%，代入计算公式，您当日的收益为：16000 元宝。</p>
                            </li>
                            <li>
                                <p class="tit_1"><i>>&nbsp;</i>玩宝的收益结算有什么规则？</p>
                                <p>玩宝的收益每日结算，每天下午15:00左右前一天的收益到账。您用玩宝转出的资金可以任意金额（不得低于2000 元宝）。</p>
                            </li>
                        </ul>
                        <ul class="cont_1"  id="con_tow_2" style="display:none" >
                            <li>
                                <p class="tit_1"><i>>&nbsp;</i>转入玩宝的元宝会有风险吗？</p>
                                <p>您通过玩宝购买的是、官方的理财产品，、官方主要用于投资国债、银行存款等安全性高、收益稳定的有价证券。总体来看，玩宝作为理财产品的一种，理论上存在亏损可能，但从历史数据来看收益稳定风险极小，其本出现亏损的可能性很低。但收益会受投资市场的波动而上下浮动。、官方提醒您，虽然玩宝风险较低，但购买前请确认您已充分了解该理财产品。您需具备投资低风险理财产品的风险承受能力，因此通过玩宝购买理财产品的相关交易时，系统默认您为最低风险承受能力类型。如您不具备最低风险承受能力，请勿做该等投资</p>
                            </li>
                            <li>
                                <p class="tit_1"><i>>&nbsp;</i>玩宝存在被盗风险吗？</p>
                                <p>官方有严格的账号管理机制，在玩宝进行交易时都需要输入您的交易密码，以确保资金安全。</p>
                            </li>
                            <li>
                                <p class="tit_1"><i>>&nbsp;</i>我把账号借给好友，损失少了怎么办？</p>
                                <p>因个人原因所造成的一切损失官方不进行任何赔付，所有损失与责任有自己承担，在此提醒广大柿子珍爱自己、账号！</p>
                            </li>
                        </ul>
                        <ul class="cont_1"  id="con_tow_3" style="display:none" >
                            <li>
                                <p class="tit_1"><i>>&nbsp;</i>玩宝转入有金额限制吗？</p>
                                <p>玩宝转入单笔最低金额为2W元宝，为正整数即可。根据历史投资经验，建议您持有100W元宝以上。</p>
                            </li>
                            <li>
                                <p class="tit_1"><i>>&nbsp;</i>我可以用分批方式给玩宝转元宝吗？</p>
                                <p>玩宝是支持分批转入的（例如：小柿昨日转入10W元宝，今日转入50W元宝，那么他的收益将会进行分批次进行计算）</p>
                            </li>
                            <li>
                                <p class="tit_1"><i>>&nbsp;</i>用什么方式可以把元宝转入玩宝？</p>
                                <p>、账户直接用元宝余额转入到元宝即可。</p>
                            </li>
                        </ul>
                        <ul class="cont_1"  id="con_tow_4" style="display:none" >
                            <li>
                                <p class="tit_1"><i>>&nbsp;</i>转出到、余额有额度限制吗？</p>
                                <p>玩宝转出单笔最低金额为2W元宝，只要是大于2W的任意金额即可随意转出。</p>
                            </li>
                            <li>
                                <p class="tit_1"><i>>&nbsp;</i>玩宝转出至51转余额有次数限制吗？</p>
                                <p>目前玩宝转出不存在次数限制。</p>
                            </li>
                            <li>
                                <p class="tit_1"><i>>&nbsp;</i>玩宝转入和转出收取手续费吗？</p>
                                <p>玩宝目前转入和转出是不收取任何手续费的。</p>
                            </li>
                        </ul>
                    </div>
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
        <?php
        $badysum = $badyzr_model->countBySql("select sum(hlb) from {{bady}} where mem_id=" . $mem['id']);
        $badyprob_info = Badyprob::model()->findBySql("select * from {{bady_prob}} where  TO_DAYS(create_time) = (TO_DAYS(NOW()))");
        ?>
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
        <!--底部1-->
        <?php include_once("./protected/views/vipdesign/footer.php"); ?>
        <?php include_once("./protected/views/vipdesign/kefu.php") ?>
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
        <script type='text/javascript'>
            var lineRateJson = {"pro": <?php echo $str1; ?>};
            var lineRateJsond = {"date": <?php echo $str2; ?>};
            var lineData = new Array(new Array(), new Array());
            $(document).ready(function() {
                var mm = 0;
                var lineData = PicData(lineRateJson, mm);
                LinePic(lineRateJsond, lineData, mm);
            });
            function PicData(rateJson, mm) {
                for (var j = 0; j < rateJson.pro.length; j++) {
                    rate = eval("rateJson.pro[j].i" + mm);
                    rate = rate / 1000;
                    lineData[j] = new Array(j + 1, rate);
                }
                return lineData;
            }
            function LinePic(rateJson, data, mm) {
                var mm = eval(mm);
                var myChart = new JSChart('graph', 'line');
                myChart.setDataArray(data, 'red');
                myChart.setSize(750, 350);
                myChart.setIntervalStartY(0);
                myChart.setIntervalEndY(0.09);
                myChart.setIntervalStartX(1);
                myChart.setIntervalEndX(7);
                myChart.setAxisValuesNumberY(7);
                myChart.setAxisWidth(1);
                myChart.setLabelX([1, rateJson.date[0]]);
                myChart.setLabelX([2, rateJson.date[1]]);
                myChart.setLabelX([3, rateJson.date[2]]);
                myChart.setLabelX([4, rateJson.date[3]]);
                myChart.setLabelX([5, rateJson.date[4]]);
                myChart.setLabelX([6, rateJson.date[5]]);
                myChart.setLabelX([7, rateJson.date[6]]);
                myChart.setShowXValues(false);
                for (var i = 0; i < rateJson.date.length; i++) {
                    myChart.setTooltip([i + 1, rateJson.date[i] + '<br />利率：' + data[i][1] + " %"]);
                }
                myChart.setTitle("玩宝一周之内利率分布图");//设置图表标题，默认“JSChart”。
                myChart.setAxisNameX("");//设置x轴的名称，对饼图无效。
                //myChart.setAxisNameY("%");//设置y轴的名称，对饼图无效
                myChart.setAxisNameY("");//设置y轴的名称，对饼图无效
                myChart.draw();
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

            function badyzrclose() {
                $('#badyzrmsg').hide();
                location.href = "<?php echo SITE_URL; ?>vipbady/trade";
            }

            function badyzcclose() {
                $('#badyzcmsg').hide();
                location.href = "<?php echo SITE_URL; ?>vipbady/trade";
            }
        </script>
    </body>
</html>