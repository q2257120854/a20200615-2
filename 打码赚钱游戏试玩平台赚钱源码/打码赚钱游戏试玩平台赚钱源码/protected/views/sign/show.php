<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>签到活动-<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/sign.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/sign.js"></script>
        <script src="/scripts/public_js.js"></script>
        <script type="text/javascript" src="/scripts/signzzsc.js"></script>
        <script type="text/javascript">
            var InterValObj; //timer变量，控制时间
            var count = 10; //间隔函数，1秒执行
            var curCount;//当前剩余秒数
            curCount = count;
            InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
            function sign(memid) {
                if (memid != "") {
                    $.ajax({
                        type: "POST",
                        data: {"memid": memid, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken ?>'},
                        url: "<?php echo SITE_URL ?>sign/sign",
                        success: function(json) {
                            if (json != "今天已签到！") {
                                strs = json.split("*");
                                $("#tshlb").html("元宝：+" + strs[0]);
                                $("#tshld").html("金豆：+" + strs[1]);
                                $("#msgsuc").show();
                                $("#signbtn2").hide();
                                $("#signbtn3").show();
                            } else {
                                alert(json);
                            }
                        }
                    });
                } else {
                    alert("对不起，您还未登录！");
                }
            }
            //关闭提示
            function close() {
                $("#msgsuc").hide();
                history.go(0);
            }

            //timer处理函数
            function SetRemainTime() {
                if (curCount == 0) {
                    window.clearInterval(InterValObj);//停止计时器
                    $("#signbtn1").hide();
                    $("#signbtn2").show();
                } else {
                    curCount--;
                    $("#signbtn1").val("还有" + curCount + "秒即可签到！");
                }
            }
        </script>
    </head>
    <body style="background:url(<?php echo IMG_URL; ?>sign/body_bk.png) #9845ef no-repeat top center">
        <!--头部-->
        <?php include_once("./protected/views/game/header.php") ?>
        <!--主体-->
        <div class="main">
            <!--每日签到送xxx-->
            <div class="daily_send">
                <div class="bk clearfix">
                    <div class="left kuan">
                    </div>
                    <div class="right kuan">
                    </div>
                </div>
                <div class="bomb bomb_1">
                    <p class="tit">固定奖励</p>
                    <p>例如小明身上有100,000,000元宝，那么他在活动期间内签到将可获得<i>100,000,000*0.03%=30,000元宝</i></p>
                    <p class="tit">连续签到</p>
                    <p>连续签到每天加0.001%，10天后最高加到0.01%，那么10天后小明还继续连续签到，则他可以获得连续签到奖励为<i>100,000,000元宝*0.01%=10,000元宝</i></p>
                    <p class="zhu">注：只要出现1天没有连续签到，则连续签到天数以及奖励从0开始算。</p>
                    <p class="zong">前日总奖励：100,000,000*（0.03%+0.01%）=40,000元宝</p>
                </div>
                <div class="bomb bomb_2">
                    <p class="tit">固定奖励</p>
                    <p>例如小明身上有100,000,000金豆，那么他在活动期间内签到将可获得<i>100,000,000*0.02%=20,000金豆</i></p>
                    <p class="tit">连续签到</p>
                    <p>连续签到每天加0.001%，10天后最高加到0.01%，那么10天后小明还继续连续签到，则他可以获得连续签到奖励为<i>100,000,000金豆*0.01%=10,000金豆</i></p>
                    <p class="zhu">注：只要出现1天没有连续签到，则连续签到天数以及奖励从0开始算。</p>
                    <p class="zong">前日总奖励：100,000,000*（0.02%+0.01%）=30,000金豆</p>
                </div>
            </div>
            <!--推荐游戏、03领奖励-->
            <div class="list_1 clearfix">
                <!--推荐游戏-->
                <div id="slide" class="slide">
                    <div class="cover">
                        <ul class="ul_1 clearfix">
                            <?php
                            $gameinfo = Game::model()->findAllBySql("select * from {{game}} where valid=0 and is_sign=1 and valid=0 order by begin_time desc limit 10");
                            foreach ($gameinfo as $game) {
                                $num = Gamezm::model()->count("gid =:gid", array('gid' => $game['id']));
                                ?>
                                <li class="clearfix" data-category="tv">
                                    <a href="<?php echo SITE_URL; ?>game/detail/id/<?php echo $game['id']; ?>" target="_blank" class="img">
                                        <img src="/uploads/img/game/<?php echo $game['img']; ?>" />
                                        <p><?php echo $game["name"]; ?></p>
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
                                            <span class="span_2">参与人数：<?php echo $num * $game["gamezmbs"]; ?></span>
                                        </p>
                                        <p class="p_2 clearfix">
                                            <span>每人奖励：</span>
                                            <em><?php
                                                if (!empty($game->impactmax)) {
                                                    $impactmax = $game["impactmax"];
                                                } else {
                                                    $impactmax = Gameimpact::model()->countBySql("select hlb FROM {{game_impact}} where game_id=" . $game["id"] . " order by rank limit 1");
                                                }
                                                $gradenum = Gamegrade::model()->countBySql("select sum(hlb) FROM {{game_grade}} where game_id=" . $game["id"]);
                                                $rewardnum = intval((intval($impactmax) + intval($gradenum)) / 10000);
                                                echo $rewardnum;
                                                ?>万</em>
                                            <i></i>
                                        </p>
                                        <p class="p_3"> 充值返利：<em><?php echo $game['cz_rewards_num']; ?>%</em>
                                        </p>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <!--领取奖励-->
                <div class="reward">
                    <div class="tit"></div>
                    <table class="table_1" border="1">
                        <tr>
                            <th>潜水一族</th>
                            <th>冒泡园丁 </th>
                            <th>吐槽专家</th>
                            <th>活跃传说</th>
                        </tr>
                        <tr>
                            <td align="center">连续签到≥5天 </td>
                            <td align="center">连续签到≥10天</td>
                            <td align="center">连续签到≥20天</td>
                            <td align="center">连续签到≥30天</td>
                        </tr>
                        <tr>
                            <td align="center"><em>50元宝</em> <a class="ann <?php
                                if ($mem["sign"] >= 5) {
                                    echo "ann_y";
                                } else {
                                    echo "ann_n";
                                }
                                ?>" href="javascript:"></a> 
                            </td>
                            <td align="center"><em>100元宝</em><a class="ann <?php
                                if ($mem["sign"] >= 10) {
                                    echo "ann_y";
                                } else {
                                    echo "ann_n";
                                }
                                ?>" href="javascript:"></a>
                            </td>
                            <td align="center"><em>300元宝</em><a class="ann <?php
                                if ($mem["sign"] >= 20) {
                                    echo "ann_y";
                                } else {
                                    echo "ann_n";
                                }
                                ?>" href="javascript:"></a>
                            </td>
                            <td align="center"><em>500元宝</em><a class="ann <?php
                                if ($mem["sign"] >= 30) {
                                    echo "ann_y";
                                } else {
                                    echo "ann_n";
                                }
                                ?>" href="javascript:"></a>
                            </td>
                        </tr>
                    </table>
                    <p class="zhu">注：到达相应等级后，奖励自动发放无需领取！</p>
                </div>
            </div>
            <!--推荐活动、签到-->
            <div class="list_2 clearfix">
                <?php
                $ad_info = Ad::model()->findAllBySql("select img,url from {{ad}} where ad_type_id =7 and open=0 order by  orderby limit 2");
                if (!empty($ad_info)) {
                    ?>
                    <div class="activities">
                        <div class="cont">
                            <div class="tit">推荐活动</div>
                            <?php foreach ($ad_info as $ad) { ?>
                                <div class="tup">
                                    <a href="<?php echo $ad['url']; ?>" target="_blank">
                                        <img src="/uploads/img/ad/<?php echo $ad['img']; ?>" />
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <script type="text/javascript">
                    window.onload = function() {
                        var sign =<?php echo $mem["sign"]; ?>;
                        for (var i = 1; i <= sign; i++) {
                            $("#day" + i).html(i + "<i class='yes'></i>");
                        }
                    }
                </script>

                <!--签到-->
                <div class="sign">
                    <table class="table_2" border="1">
                        <tr>
                            <td align="center" valign="middle">&nbsp;</td>
                            <td align="center" valign="middle" id="day1">1</td>
                            <td align="center" valign="middle" id="day2">2</td>
                            <td align="center" valign="middle" id="day3">3</td>
                            <td align="center" valign="middle" id="day4">4</td>
                            <td align="center" valign="middle" id="day5">5</td>
                            <td align="center" valign="middle" id="day6">6</td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="day7">7</td>
                            <td align="center" valign="middle" id="day8">8</td>
                            <td align="center" valign="middle" id="day9">9</td>
                            <td align="center" valign="middle" id="day10">10</td>
                            <td align="center" valign="middle" id="day11">11</td>
                            <td align="center" valign="middle" id="day12">12</td>
                            <td align="center" valign="middle" id="day13">13</td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="day14">14</td>
                            <td align="center" valign="middle" id="day15">15</td>
                            <td align="center" valign="middle" id="day16">16</td>
                            <td align="center" valign="middle" id="day17">17</td>
                            <td align="center" valign="middle" id="day18">18</td>
                            <td align="center" valign="middle" id="day19">19</td>
                            <td align="center" valign="middle" id="day20">20</td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="day21">21</td>
                            <td align="center" valign="middle" id="day22">22</td>
                            <td align="center" valign="middle" id="day23">23</td>
                            <td align="center" valign="middle" id="day24">24</td>
                            <td align="center" valign="middle" id="day25">25</td>
                            <td align="center" valign="middle" id="day26">26</td>
                            <td align="center" valign="middle" id="day27">27</td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="day28">28</td>
                            <td align="center" valign="middle"  id="day29">29</td>
                            <td align="center" valign="middle"  id="day30">30</td>
                            <td align="center" valign="middle">&nbsp;</td>
                            <td align="center" valign="middle">&nbsp;</td>
                            <td align="center" valign="middle">&nbsp;</td>
                        </tr>
                    </table>
                    <p class="zhu">注：出现签到中断，重新开始累积签到天数。</p>
                    <?php
                    if (!empty($mem)) {
                        $num1 = Sign::model()->countBySql("select count(*) from {{sign}} where TO_DAYS(create_time) = (TO_DAYS(NOW())) and mem_id=" . $mem["id"]);
                        if (!empty($num1)) {
                            ?>
                            <input id="signbtn3" type="button" class="ann_n"   value="今日已签到"/>
                        <?php } else {
                            ?>
                            <input id="signbtn1" type="button" class="ann_n"/>
                            <input id="signbtn2" type="button" class="ann_y" onclick="sign('<?php echo $mem['id']; ?>')"  value="立即签到" style="display:none"/>
                            <input id="signbtn3" type="button" class="ann_n"   value="今日已签到"  style="display:none"/>
                        <?php } ?>
                    <?php } else {
                        ?>
                        <input  type="button" class="ann_y" id="loginBtns" value="立即登录"/>
                    <?php } ?>
                </div>
            </div>
            <div class="pen"></div>
        </div>
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>

        <div class="eject_db7" style=" display: none;" id="msgsuc">
            <!--兑换豆豆弹出框背景-->
            <div class="eject_bk" style="display:block"></div>
            <!--兑换豆豆弹出框-->
            <div class="eject" style="display:block">
                <div class="eject_tit">签到成功！</div>
                <div class="eject_d">
                    <span id="tshlb"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span id="tshld"></span>&nbsp;&nbsp;&nbsp;&nbsp;
<!--                    <span>翻牌次数：+100</span>-->
                </div>

                <div class="eject_list">
                    元宝总额：
                    <span class="bi"><?php echo number_format(intval($hlbnum)); ?></span>
                </div>
                <div class="eject_list">
                    金豆总额：
                    <span class="dou"><?php echo number_format(intval($hldnum)); ?></span>
                </div>
                <div class="eject_profit clearfix">
                    <span class="shouyi">本次收益&nbsp;=</span>
                    <p class="wz_1"><?php
                        $system_info = System::model()->findByPk(1);
                        if ($hlbnum >= $system_info["sign_rand_hlb"]) {
                            if (empty($mem["sign"])) {//$mem["sign"]一开始加载的时候为0
                                echo " 元宝总数（不含玩宝）*（0.03%+0.001%）";
                            } else if ($mem["sign"] == 1) {
                                echo " 元宝总数（不含玩宝）*（0.03%+0.002%）";
                            } else if ($mem["sign"] == 2) {
                                echo " 元宝总数（不含玩宝）*（0.03%+0.003%）";
                            } else if ($mem["sign"] == 3) {
                                echo " 元宝总数（不含玩宝）*（0.03%+0.004%）";
                            } else if ($mem["sign"] == 4) {
                                echo " 元宝总数（不含玩宝）*（0.03%+0.005%）";
                            } else if ($mem["sign"] == 5) {
                                echo " 元宝总数（不含玩宝）*（0.03%+0.006%）";
                            } else if ($mem["sign"] == 6) {
                                echo " 元宝总数（不含玩宝）*（0.03%+0.007%）";
                            } else if ($mem["sign"] == 7) {
                                echo " 元宝总数（不含玩宝）*（0.03%+0.008%）";
                            } else if ($mem["sign"] == 8) {
                                echo " 元宝总数（不含玩宝）*（0.03%+0.009%）";
                            } else if ($mem["sign"] >= 9) {
                                echo " 元宝总数（不含玩宝）*（0.03%+0.01%）";
                            }
                        } else {
                            echo "您的元宝余额低于" . $system_info["sign_rand_hlb"] . ",由系统随机发送奖励";
                        }
                        ?></p>
                    <p class="wz_1">
                        <?php
                        if ($hldnum >= $system_info["sign_rand_hld"]) {
                            if (empty($mem["sign"])) {
                                echo " 金豆总数（不含已押注竞猜）*（0.02%+0.001%）";
                            } else if ($mem["sign"] == 1) {
                                echo " 金豆总数（不含已押注竞猜）*（0.02%+0.002%）";
                            } else if ($mem["sign"] == 2) {
                                echo " 金豆总数（不含已押注竞猜）*（0.02%+0.003%）";
                            } else if ($mem["sign"] == 3) {
                                echo " 金豆总数（不含已押注竞猜）*（0.02%+0.004%）";
                            } else if ($mem["sign"] == 4) {
                                echo " 金豆总数（不含已押注竞猜）*（0.02%+0.005%）";
                            } else if ($mem["sign"] == 5) {
                                echo " 金豆总数（不含已押注竞猜）*（0.02%+0.006%）";
                            } else if ($mem["sign"] == 6) {
                                echo " 金豆总数（不含已押注竞猜）*（0.02%+0.007%）";
                            } else if ($mem["sign"] == 7) {
                                echo "金豆总数（不含已押注竞猜）*（0.02%+0.008%）";
                            } else if ($mem["sign"] == 8) {
                                echo " 金豆总数（不含已押注竞猜）*（0.02%+0.009%）";
                            } else if ($mem["sign"] >= 9) {
                                echo " 金豆总数（不含已押注竞猜）*（0.02%+0.01%）";
                            }
                        } else {
                            echo "您的金豆余额低于" . $system_info["sign_rand_hld"] . ",由系统随机发送奖励";
                        }
                        ?>
                    </p>
                </div>
                <a href="javascript:close();" class="eject_button">确定</a>
            </div>
        </div>
    </body>
</html>
