<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
	   
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta property="qc:admins" content="3440374277651175205166375" />
        <title><?php echo TIT; ?>、-官方网站-试玩平台-打码赚钱平台-体验赚钱-<?php echo TIT; ?>网赚</title>
        <meta name="keywords" content="、,、官网,试玩平台,网页游戏,游戏试玩,网上赚钱,打码网赚,打码平台,免费赚钱,免费换奖,网赚提现" />
        <meta name="description" content="、是一个玩游戏、体验产品赚积分，兑换各种奖品的体验营销娱乐平台。这里有最新最好玩的网页游戏，让您轻松实现网上赚钱的愿望。我们打造专业的网络兼职平台，用户在游戏试玩、参与互动体验、购物返利中获得免费积分--元宝，元宝可以换取Q币、话费、笔记本等丰富的奖品，是用户网赚和网络兼职的好去处" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/index.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/public_js.js"></script>
        <script src="/scripts/index.js"></script>
    </head>
    <!--加载幻灯片js-->
    <script>
        $(document).ready(function() {
            $(".main_visual").hover(function() {
                $("#btn_prev,#btn_next").fadeIn()
            }, function() {
                $("#btn_prev,#btn_next").fadeOut()
            })
            $dragBln = false;
            $(".main_image").touchSlider({
                flexible: true,
                speed: 200,
                btn_prev: $("#btn_prev"),
                btn_next: $("#btn_next"),
                paging: $(".flicking_con .dian_1"),
                counter: function(e) {
                    $(".flicking_con .dian_1").removeClass("on").eq(e.current - 1).addClass("on");
                }
            });
            $(".main_image").bind("mousedown", function() {
                $dragBln = false;
            })
            $(".main_image").bind("dragstart", function() {
                $dragBln = true;
            })
            $(".main_image a").click(function() {
                if ($dragBln) {
                    return false;
                }
            })
            timer = setInterval(function() {
                $("#btn_next").click();
            }, 5000);
            $(".main_visual").hover(function() {
                clearInterval(timer);
            }, function() {
                timer = setInterval(function() {
                    $("#btn_next").click();
                }, 5000);
            })
            $(".main_image").bind("touchstart", function() {
                clearInterval(timer);
            }).bind("touchend", function() {
                timer = setInterval(function() {
                    $("#btn_next").click();
                }, 5000);
            })
        });
        window.onload = function() {
            var zcstart = $('#zcstart').val();
            if (zcstart == "success") {
                $("#zcmsg").show();
            }
        }
        //兑换成功提示框
        function close() {
            $("#zcmsg").hide();
            location.href = "<?php echo SITE_URL ?>";
        }
    </script>
    <!--加载大家都在玩滚动-->
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
    </script>
    <style type="text/css">
        .hover9{ background: url(<?php echo IMG_URL; ?>img/nav_b.png) no-repeat center; font-weight: bold;color:#fff;}
        .hover9 a { color:#fff !important;}
        div .errorMessage{color:red;}
    </style>
</head>
<body >
    <?php include("./protected/views/design/header.php"); ?>
    <?php
    if (Yii::app()->user->hasFlash('zcstart')) {
        ?>
        <input type="hidden" value="<?php echo Yii::app()->user->getFlash('zcstart') ?>" id="zcstart" />
    <?php } ?>
    <!--幻灯片-->
    <div class="main_visual">
        <div class="flicking_con">
            <?php
            if (Yii::app()->user->getIsGuest()) {
                ?>
                <!--用户信息未登陆-->
                <div class="user_xx1" style="display:block;">
                    <div class="information">
                    </div>
                    <div class="text">
                        <p class="tit">奖励发放累计：</p>
                        <p class="hl_b"><em>
                                <?php
                                $tx_info = Tx::model()->findAllBySql("select hlb_id from {{tx}} where starts='已支付' ");
                                $sumhlb = 0; //老平台支付的元宝
                                foreach ($tx_info as $txinfo) {
                                    $hlb_info = Hlb::model()->findByPk($txinfo["hlb_id"]);
                                    $sumhlb = $sumhlb + (-$hlb_info["hlb"]);
                                }
                                echo number_format($sumhlb);
                                ?>
                            </em><i>元宝</i></p>
                        <p class="rmb"><i>价值</i><em><?php echo number_format(intval($sumhlb / 10000)); ?></em><i>元人民币</i></p>
                        <!-- <p class="shouy">兑率：<em>10000</em>元宝=<em>1</em>RMB</p> -->
                        <a href="<?php echo SITE_URL ?>index/regester"><p class="ann">注册领红包</p></a>
                        <em class="deng" id="loginBtns">已有账号？<i>立即登录</i></em>
                    </div>
                </div>
                <!--用户信息未登陆结束-->
            <?php } else { ?>
                <!--用户信息登陆-->
                <div class="user_xx2 clearfix" >
                    <div class="information_2">
                    </div>
                    <div class="information_2_1">
                    </div>
                    <div class="text_2">
                        <a href="<?php echo SITE_URL ?>index/logout" title="退出" class="close"></a>
                        <div class="d_1 clearfix">
                            <a href="<?php echo SITE_URL; ?>vipindex/show" class="tou" target="_blank"><img src="<?php echo IMG_URL; ?>touxiang/<?php echo $memimg['img'] ?>" /></a>
                            <p class="account">
                                <a class="mz" href="<?php echo SITE_URL; ?>vipindex/show" target="_blank"><?php echo $this->show_mem_name(); ?></a>
                                <?php
                                if (empty($mem["role"])) {
                                    echo "<span style='color:red;'>会员</span>";
                                } else {
                                    echo "<span style='color:red;'>站长</span>";
                                }
                                ?><span>欢迎回来！</span>
                            </p>
                            <p class="id_1"><em>ID：
                                    <?php echo $mem['id']; ?>
                                </em><span class="tis <?php
                                if (!empty($messagenum)) {
                                    echo " tis_s";
                                }
                                ?>">
                                    <a href="<?php echo SITE_URL ?>vipmessage/show" target="_blank">未读信息
                                        <i class="red">
                                            <?php
                                            echo $messagenum;
                                            ?>条
                                        </i>
                                    </a>
                                </span></p>
                        </div>
                        <div class="d_2 clearfix">
                            <span>
                                <?php
                                $signnum = Sign::model()->countBySql("select count(*) from {{sign}} where TO_DAYS(create_time) = (TO_DAYS(NOW())) and mem_id=" . $mem["id"]);
                                if (empty($signnum)) {
                                    ?>
                                    <a href="<?php echo SITE_URL; ?>sign/show" target="_blank" class="ann ann_1">签到</a> 
                                <?php } else { ?>
                                    <a href="javascript:"  class="ann ann_1_n"><?php echo "已签" . $mem["sign"] . "天"; ?></a> 
                                <?php } ?>
                            </span>
                            <span>
                                <a href="<?php echo SITE_URL; ?>vipindex/show" target="_blank" class="ann ann_2">个人中心</a>
                            </span>
                        </div>
                        <div class="d_3">
                            <dl class="dl_1">
                                <dt>
                                    <p><em>元宝余额：</em><i class="dou"><?php
                                            echo number_format(intval($hlbnum));
                                            ?></i></p>
                                    <a href="<?php echo SITE_URL ?>vipadvance/txalipay" target="_blank">提现</a>
                                </dt>
                                <dt>
                                    <p><em>金豆余额：</em><i class="bi"><?php
                                            echo number_format(intval($hldnum));
                                            ?></i></p>
                                    <a href="<?php echo SITE_URL ?>gift/show" target="_blank">兑奖</a>
                                </dt>
                                <!--                                <dt>
                                                                    <p><em>玩宝余额：</em><i>5,00000</i></p>
                                                                    <a href="javascript:" target="_blank">转入</a>
                                                                </dt>-->
                                <dt>
                                    <p><em>今日预计上线试玩：</em><i><?php echo $gamenum; ?>个</i></p>
                                    <a href="<?php echo SITE_URL; ?>game/show" target="_blank">立即试玩</a>
                                </dt>
                            </dl>
                        </div>
                    </div>
                </div>
                <!--用户信息登陆结束-->
            <?php } ?>
            <div class="flicking_inner">
                <a class="dian_1" href="javascript:">
                </a>
                <a class="dian_1" href="javascript:">
                </a>
                <a class="dian_1" href="javascript:">
                </a>
                <a class="dian_1" href="javascript:">
                </a>
                <a class="dian_1" href="javascript:"> 5 </a>
            </div>
        </div>
        <?php
        $ad_info2 = Ad::model()->findAllBySql("select img,url from {{ad}} where ad_type_id =1 and open=0 order by orderby asc ");
        ?>
        <div class="main_image">
            <ul>
                <?php foreach ($ad_info2 as $ad) { ?>
                    <li>
                        <a href="<?php echo $ad['url']; ?>" target="_blank">
                            <span class="img_3" style=" background:url(/uploads/img/ad/<?php echo $ad['img']; ?>) no-repeat center top;"></span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <a href="javascript:;" id="btn_prev">
            </a>
            <a href="javascript:;" id="btn_next">
            </a>
        </div>
    </div>
    <!--主体-->
    <div class="conter clearfix">
        <div class="clearfix">
            <!--热门体验、热门礼品-->
            <div class="tx_jp clearfix">
                <?php $game_info = Game::model()->findAllBySql("select name,begin_time,id from {{game}} where  to_days(begin_time) = to_days(now())  order by create_time desc limit 8"); ?>
                <!--热门体验-->
                <div class="hot_tx clearfix">
                    <div class="title_index">
                        <span class="t"><i class="i_1"></i>热门体验</span>
                        <?php
                        $sql = "select count(*) from {{game}} where  to_days(begin_time) = to_days(now()) ";
                        $num = Game::model()->countBySql($sql);
                        if ($num != 0) {
                            ?>
                            <div class="trailer clearfix">
                                <span class="tit">试玩预告</span>
                                <div id="FontScroll">
                                    <ul class="ul_1 clearfix">
                                        <?php
                                        foreach ($game_info as $gameinfo) {
                                            ?>
                                            <li>
                                                <ul class="ul_2">
                                                    <li class="name">
                                                        <?php if (time() >= strtotime($gameinfo['begin_time'])) { ?>
                                                            <a href="<?php echo SITE_URL; ?>game/detail/id/<?php echo $gameinfo["id"]; ?>" target="_blank"> <?php echo $gameinfo['name']; ?> </a>
                                                        <?php } else { ?>
                                                            <a href="javascript:" > <?php echo $gameinfo['name']; ?> </a>
                                                        <?php } ?>
                                                    </li>
                                                    <li class="time">（<?php echo date("H:i", strtotime($gameinfo['begin_time'])); ?>）</li>
                                                    <li class="number">
                                                        <span class="n_1">
                                                            <?php
                                                            if (!empty($gameinfo->impactmax)) {
                                                                $impactmax = $gameinfo["impactmax"];
                                                            } else {
                                                                $impactmax = Gameimpact::model()->countBySql("select hlb FROM {{game_impact}} where game_id=" . $gameinfo["id"] . " order by rank limit 1");
                                                            }
                                                            $gradenum = Gamegrade::model()->countBySql("select sum(hlb) FROM {{game_grade}} where game_id=" . $gameinfo["id"]);
                                                            $rewardnum = intval((intval($impactmax) + intval($gradenum)) / 10000);
                                                            echo $rewardnum;
                                                            ?>万</span>
                                                    </li>
                                                    <li class="day">今日</li>
                                                </ul>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="tan">
                                    <ul>
                                        <?php
                                        foreach ($game_info as $gameinfo) {
                                            ?>
                                            <li>
                                                <ul class="ul_2">
                                                    <li class="name">
                                                        <?php if (time() >= strtotime($gameinfo['begin_time'])) { ?>
                                                            <a href="<?php echo SITE_URL; ?>game/detail/id/<?php echo $gameinfo["id"]; ?>" target="_blank"> <?php echo $gameinfo['name']; ?> </a>
                                                        <?php } else { ?>
                                                            <a href="javascript:" > <?php echo $gameinfo['name']; ?> </a>
                                                        <?php } ?>

                                                    </li>
                                                    <li class="time">（<?php echo date("H:i", strtotime($gameinfo['begin_time'])); ?>）</li>
                                                    <li class="number">
                                                        <span class="n_1"><?php
                                                            $impactnum = Gameimpact::model()->countBySql("select hlb FROM {{game_impact}} where game_id=" . $gameinfo["id"] . " order by rank  limit 1");
                                                            $gradenum = Gamegrade::model()->countBySql("select sum(hlb) FROM {{game_grade}} where game_id=" . $gameinfo["id"]);
                                                            $rewardnum = intval((intval($impactnum) + intval($gradenum)) / 10000);
                                                            echo $rewardnum;
                                                            ?>万</span>
                                                    </li>
                                                    <li class="day">今日</li>
                                                </ul>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="cont">
                        <ul class="ul_1 clearfix">
                            <?php
                            $game_info1 = Game::model()->findAllBySql("select * from {{game}} where is_hpage=1 and valid=0 order by begin_time desc limit 0,6");
                            foreach ($game_info1 as $game) {
                                $num1 = Gamezm::model()->count("gid =:gid", array('gid' => $game['id']));
                                ?>
                                <li class="clearfix">
                                    <a href="<?php echo SITE_URL; ?>game/detail/id/<?php echo $game['id']; ?>" target="_blank" class="img" title="<?php echo $game['name']; ?>">
                                        <img src="/uploads/img/game/<?php echo $game['img']; ?>" alt="<?php echo $game['name']; ?>" />
                                        <p><?php echo $game['name']; ?></p>
                                        <span class="bk"></span>
                                        <span class="ann">立即试玩</span>
                                    </a>
                                    <div class="nei">
                                        <p class="p_1 clearfix">
                                            <span class="span_1">类型：
                                                <?php
                                                $gametype = Gametype::model()->findByPk($game["game_type_id"]);
                                                echo $gametype["name"];
                                                ?>
                                            </span>
                                            <span class="span_2">参与人数：<em><?php echo $num1 * $game["gamezmbs"]; ?></em></span>
                                        </p>
                                        <p class="p_2 clearfix">
                                            <span>每人奖励：</span>
                                            <em>
                                                <?php
                                                if (!empty($game->impactmax)) {
                                                    $impactmax = $game["impactmax"];
                                                } else {
                                                    $impactmax = Gameimpact::model()->countBySql("select hlb FROM {{game_impact}} where game_id=" . $game["id"] . " order by rank limit 1");
                                                }
                                                $gradenum = Gamegrade::model()->countBySql("select sum(hlb) FROM {{game_grade}} where game_id=" . $game["id"]);
                                                $rewardnum = intval((intval($impactmax) + intval($gradenum)) / 10000);
                                                echo $rewardnum;
                                                ?>万
                                            </em>
                                            <i></i>
                                            <span>(约
                                                <a> <?php echo $rewardnum; ?></a>
                                                元人民币)
                                            </span>
                                        </p>
                                        <p class="p_3"> 充值返利：<em <?php
                                            if (empty($game['cz_rewards_num'])) {
                                                echo "class=no";
                                            }
                                            ?>><?php echo intval($game['cz_rewards_num']); ?>%</em>
                                        </p>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <!--热门礼品-->
                <div class="hot_lp clearfix">
                    <div class="title_index">
                        <span class="t"><i class="i_2"></i>热门礼品</span>
                        <a href="<?php echo SITE_URL ?>gift/show" target="_blank" class="more"> MORE <em>>></em>
                        </a>
                    </div>
                    <div class="cont">
                        <ul class="ul_1 clearfix">
                            <?php
                            $gift_info = Gift::model()->findAllBySql("select img,id,name from {{gift}} where is_hpage=1 order by create_time desc limit 4");
                            foreach ($gift_info as $giftinfo) {
                                ?>
                                <li>
                                    <a href="<?php echo SITE_URL ?>gift/detail/id/<?php echo $giftinfo["id"]; ?>" target="_blank"> 
                                        <img src="/uploads/img/gift/<?php echo $giftinfo['img']; ?>" />
                                        <p><?php echo $giftinfo['name'] ?></p>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!--最新资讯、大家都在玩、大家都在兑-->
            <div class="g_d">
                <!--最新资讯-->
                <div class="notice">
                    <div class="tit">
                        <span>最新资讯</span>
                        <a href="<?php echo SITE_URL . "message/show"; ?>" >MORE<i>&nbsp;>></i></a>
                    </div>
                    <div class="cont">
                        <ul class="ul_1 clearfix">
                            <?php
                            $message_info = Message::model()->findAllBySql("select title,id,message_type_id,color from {{message}} where is_hpage=1 order by id desc limit 10");
                            foreach ($message_info as $messinfo) {
                                ?>
                                <li>
                                    <a target="_blank" href="<?php echo SITE_URL . "message/detail/id/" . $messinfo['id'] . "/pid/" . $messinfo["message_type_id"]; ?>" <?php
                                    if ($messinfo["color"] == 2) {
                                        echo "class='red'";
                                    } else
                                    if ($messinfo["color"] == 3) {
                                        echo "class='blue'";
                                    }
                                    ?> ><?php echo $messinfo['title']; ?> </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <!--大家都在玩-->
                <div class="play">
                    <div class="tit">
                        <i class="i_1"></i>大家都在玩
                    </div>
                    <div class="bcon">
                        <div class="list_lh">
                            <ul>
                                <?php
                                $giftdata = Gamegradedata::model()->findAllBySql("select * from {{game_gradedata}} where valid=1  order by id desc  limit 0,8");
                                foreach ($giftdata as $info) {
                                    ?>
                                    <li class="clearfix">
                                        <?php
                                        $game = Game::model()->findByPk($info['game_id']);
                                        $member = Mem::model()->findByPk($info['mem_id']);
                                        $memimg = Memimg::model()->findByPk($member['memimg_id']);
                                        ?>
                                        <span class="tou"><img src="<?php echo IMG_URL; ?>touxiang/<?php echo $memimg['img'] ?>"/></span>
                                        <p class="name"><?php echo $member['mem_name']; ?></p>
                                        <p class="wan">玩：
                                            <a href="<?php echo SITE_URL ?>game/detail/id/<?php echo $game["id"]; ?>" target="_blank"><?php echo $game['name']; ?> </a>
                                        </p>
                                        <p class="lin clearfix"><span>领取了：</span><em><?php echo number_format(intval($info['hlb'])); ?></em></p>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--大家都在兑-->
                <div class="play">
                    <div class="tit">
                        <i class="i_2"></i>大家都在兑
                    </div>
                    <div class="bcon">
                        <div class="list_lh list_lh_1">
                            <ul>

                                <?php
                                $tx_info = Tx::model()->findAllBySql("select * from {{tx}} where starts='已支付' order by id desc  limit 0,8 ");
                                foreach ($tx_info as $info) {
                                    ?>
                                    <li class="clearfix">
                                        <?php
                                        $member = Mem::model()->findByPk($info['mem_id']);
                                        $memimg = Memimg::model()->findByPk($member['memimg_id']);
                                        ?>
                                        <span class="tou"><img src="<?php echo IMG_URL; ?>touxiang/<?php echo $memimg['img'] ?>" /></span>
                                        <span class="neir">
                                            <p class="name">
                                                <?php echo $member['mem_name'] ?>
                                            </p>
                                            <p class="wan">提现了:
                                                <a href="javascript:" ><span style="color:#ec6c49;"><?php echo $info['applymoney']; ?>元</span></a>
                                            </p>
                                            <p class="lin clearfix"><span><?php echo $info['cl_time'] ?></span></p>
                                        </span>
                                    </li>
                                <?php } ?>
                                <?php
                                $giftdh = Giftdh::model()->findAllBySql("select * from {{gift_dh}} order by id desc  limit 0,8 ");
                                foreach ($giftdh as $info) {
                                    ?>
                                    <li class="clearfix">
                                        <?php
                                        $gift = Gift::model()->findByPk($info['gift_id']);
                                        $member = Mem::model()->findByPk($info['mem_id']);
                                        $memimg = Memimg::model()->findByPk($member['memimg_id']);
                                        ?>
                                        <span class="tou"><img src="<?php echo IMG_URL; ?>touxiang/<?php echo $memimg['img'] ?>" /></span>
                                        <span class="neir">
                                            <p class="name">
                                                <?php echo $member['mem_name'] ?>
                                            </p>
                                            <p class="wan">兑换了:
                                                <a href="javascript:" ><?php echo $gift['name'] ?></a>
                                            </p>
                                            <p class="lin clearfix"><span><?php echo $info['dh_time'] ?></span></p>
                                        </span>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $ad_info = Ad::model()->findAllBySql("select img,url from {{ad}} where ad_type_id =1 and open =0 order by  orderby limit 5,1");
        if (!empty($ad_info)) {
            foreach ($ad_info as $ad) {
                ?>
                <!--广告图-->
                <div class="gg clearfix">
                    <a href="<?php echo $ad['url']; ?>" target="_blank">
                        <img src="/uploads/img/ad/<?php echo $ad['img']; ?>" />
                    </a>
                </div>
                <?php
            }
        }
        ?>
        <!--合作伙伴-->
        <div class="partner clearfix">
            <div class="title_index" style="width:984px;">
                <span class="t"><i class="i_3"></i>合作伙伴</span>
            </div>
            <div class="cont">
                <ul class="ul_1 clearfix">
                    <?php
                    $business_info = Business::model()->findAllBySql("select img,url from {{business}} limit 10");
                    foreach ($business_info as $business) {
                        ?>
                        <li>
                            <a href="<?php echo $business['url'] ?>" target="_blank"><img src="/uploads/img/business/<?php echo $business['img']; ?>" /> </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <!--友情链接-->
    <div class="friend clearfix">
        <div class="cont">
            <ul class="ul_1 clearfix">
                <li class="tit">友情链接：</li>
                <?php
                $links_info = Links::model()->findAllBySql("select name,url from {{links}} limit 10");
                foreach ($links_info as $link) {
                    ?>
                    <li>
                        <a href="<?php echo $link['url'] ?>" target="_blank"><?php echo $link['name'] ?> </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <?php
    $system_info = System::model()->findByPk(1);
    ?>
    <div class="red_envelopes"  id="zcmsg" style="display:none;">
        <div class="red_bk"></div>
        <div class="red_cont">
            <p class="red_tit">恭喜您注册成功</p>
            <p class="red_text">获得了系统赠送的<i class="s"><?php echo number_format(intval($system_info["zc_rewards"])); ?></i>元宝红包奖励</p>
            <a class="red_xx" href="javascript:close();" title="关闭"></a>
        </div>
    </div>
    <?php include_once("./protected/views/design/footer.php"); ?>
    <?php include_once("./protected/views/design/kefu.php"); ?>
</body>
<!--试玩预告滚动-->
<script>
    (function($) {
        $.fn.FontScroll = function(options) {
            var d = {time: 3000, s: 'fontColor', num: 1}
            var o = $.extend(d, options);
            this.children('ul').addClass('line');
            var _con = $('.line').eq(0);
            var _conH = _con.height(); //滚动总高度
            var _conChildH = _con.children().eq(0).height();//一次滚动高度
            var _temp = _conChildH;  //临时变量
            var _time = d.time;  //滚动间隔
            var _s = d.s;  //滚动间隔
            _con.clone().insertAfter(_con);//初始化克隆

            //样式控制
            var num = d.num;
            var _p = this.find('li');
            var allNum = _p.length;

            _p.eq(num).addClass(_s);


            var timeID = setInterval(Up, _time);
            this.hover(function() {
                clearInterval(timeID)
            }, function() {
                timeID = setInterval(Up, _time);
            });

            function Up() {
                _con.animate({marginTop: '-' + _conChildH});
                //样式控制
                _p.removeClass(_s);
                num += 1;
                _p.eq(num).addClass(_s);

                if (_conH == _conChildH) {
                    _con.animate({marginTop: '-' + _conChildH}, "normal", over);
                } else {
                    _conChildH += _temp;
                }
            }
            function over() {
                _con.attr("style", 'margin-top:0');
                _conChildH = _temp;
                num = 1;
                _p.removeClass(_s);
                _p.eq(num).addClass(_s);
            }
        }
    })(jQuery);
    $('#FontScroll').FontScroll({time: 3000, num: 1});
</script>
</html>
