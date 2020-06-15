<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta property="qc:admins" content="3440374277651175205166375" />

    <head>


       
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>《<?php echo $game_info['name']; ?>》、-试玩平台-<?php echo TIT; ?>、官方网站</title>
        <meta name="keywords" content="<?php echo $game_info['name']; ?>，<?php echo $game_info['name']; ?>试玩" />
        <meta name="description" content="<?php echo mb_substr(strip_tags($game_info['introduce']), 1, 200, "utf-8"); ?>..." />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/css.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/js.js"></script>
        <script src="/scripts/public_js.js"></script>
        <script src="/scripts/zzsc.js"></script>
        <script src="/scripts/page.js"></script>
        <script type="text/javascript">
            $(function() {
                show_time();
            });

            function getLocalTime(nS) {
                return new Date(parseInt(nS) * 1000).getTime();
            }

            function show_time() {
                var time_start = getLocalTime(<?php echo $endtime; ?>);//设定开始时间
                var time_end = new Date().getTime(); //设定结束时间(等于系统当前时间)
                //计算时间差
                var time_distance = time_start - time_end;
                if (time_distance > 0) {
                    // 天时分秒换算
                    var int_day = Math.floor(time_distance / 86400000)
                    time_distance -= int_day * 86400000;

                    var int_hour = Math.floor(time_distance / 3600000)
                    time_distance -= int_hour * 3600000;

                    var int_minute = Math.floor(time_distance / 60000)
                    time_distance -= int_minute * 60000;

                    var int_second = Math.floor(time_distance / 1000)
                    // 时分秒为单数时、前面加零
                    if (int_day < 10) {
                        int_day = "0" + int_day;
                    }
                    if (int_hour < 10) {
                        int_hour = "0" + int_hour;
                    }
                    if (int_minute < 10) {
                        int_minute = "0" + int_minute;
                    }
                    if (int_second < 10) {
                        int_second = "0" + int_second;
                    }
                    // 显示时间
                    $("#DD").html(int_day);
                    $("#HH").html(int_hour);
                    $("#MM").html(int_minute);
                    $("#SS").html(int_second);
                    setTimeout("show_time()", 1000);
                } else {
                    $("#DD").html('00');
                    $("#HH").html('00');
                    $("#MM").html('00');
                    $("#SS").html('00');
                }
            }

            /** 刷新等级数据 **/
            function grade(guid, gid) {
                $("#ref").show();
                $.ajax({
                    type: "POST",
                    data: {"guid": guid, "gid": gid, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken ?>'},
                    url: "<?php echo SITE_URL; ?>game/selgrade",
                    success: function(json) {
                        location.reload();
                        $("#ref").hide();
                    }
                });
            }

            /** 领取奖励 **/
            function rewards(gameid, memid, level) {
                $.ajax({
                    type: "POST",
                    data: {"gameid": gameid, "memid": memid, "level": level, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken ?>'},
                    url: "<?php echo SITE_URL; ?>game/rewards",
                    success: function(json) {
                        alert(json);
                        location.reload();
                    }
                });
            }
        </script>
    </head>
    <body style="background:url(/uploads/img/game/<?php echo $game_info['bg_img']; ?>) <?php
    if (!empty($game_info["color"])) {
        echo $game_info["color"];
    } else {
        echo "#FFF ";
    }
    ?> no-repeat top center ;">
          <?php include_once("header.php") ?>
          <?php
          $gamezm_model = Gamezm::model();
          if (!empty($mem)) {
              $gamezm = $gamezm_model->findBySql("select * from {{game_zm}} where gid=" . $game_info['id'] . " and mem_id=" . $mem['id']);
          }
          ?>
        <!--主体-->
        <div class="main">
            <div class="game_bk">
                <!--游戏logo-->
                <div class="game_logo">

                    <a href="<?php echo SITE_URL; ?>"><span class="img" style="background:url(/uploads/img/game/<?php echo $game_info['logoimg']; ?>) no-repeat"></span></a>  
                </div>
                <!--厂商、服务器-->
                <div class="server clearfix">
                    <p class="bck"></p>
                    <div class="text" style=" background:url(/uploads/img/game/<?php echo $game_info['businessimg']; ?>) no-repeat left center;">
                        当前服务器：
                        <?php
                        if ($game_info['is_prefecture'] == 0) {
                            echo "专区";
                        } else if ($game_info['is_prefecture'] == 1) {
                            echo "多服";
                        } else {
                            echo "单区";
                        }
                        ?>
                    </div>
                </div>
                <?php
                $impactnum = Gameimpact::model()->countBySql("select hlb FROM {{game_impact}} where game_id=" . $game_info["id"] . " order by rank limit 1");
                $gradenum = Gamegrade::model()->countBySql("select sum(hlb) FROM {{game_grade}} where game_id=" . $game_info["id"]);
                $rewardnum = intval((intval($impactnum) + intval($gradenum)) / 10000);
                ?>
                <div class="reward_dynamic clearfix">
                    <div class="reward clearfix">
                        <?php
                        $str = strval($rewardnum);
                        for ($i = 0; $i < strlen($str); $i++) {
                            $strnum = $str[$i];
                            if ($strnum == 1) {
                                ?>
                                <span class="number_1"></span>
                            <?php } else if ($strnum == 2) { ?>
                                <span class="number_2"></span>
                            <?php } else if ($strnum == 3) { ?>
                                <span class="number_3"></span>
                            <?php } else if ($strnum == 4) { ?>
                                <span class="number_4"></span>
                            <?php } else if ($strnum == 5) { ?>
                                <span class="number_5"></span>
                            <?php } else if ($strnum == 6) { ?>
                                <span class="number_6"></span>
                            <?php } else if ($strnum == 7) { ?>
                                <span class="number_7"></span>
                            <?php } else if ($strnum == 8) { ?>
                                <span class="number_8"></span>
                            <?php } else if ($strnum == 9) { ?>
                                <span class="number_9"></span>
                            <?php } else if ($strnum == 0) { ?>
                                <span class="number_0"></span>
                                <?php
                            }
                        }
                        ?>
                        <i class="number_w"></i>
                    </div>
                    <?php if (!empty($game_info['cz_hint']) && !empty($game_info['czhref'])) { ?>
                        <div class="dynamic_text">
                            <?php echo $game_info['cz_hint']; ?>
                        </div>
                        <div class="tan">
                            <?php echo $game_info['cz_hint']; ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--试玩步骤-->
            <div class="step clearfix">
                <div class="zhuc">
                    <?php
                    $num = $gamezm_model->count("gid =:gid", array('gid' => $game_info['id']));
                    if (strtotime($game_info['end_time']) < time() || $game_info["game_start"] != 0) {
                        ?>
                        <a href="javascript:" class="button_4 butt"></a><!--试玩结束-->
                        <?php
                    } else {
                        if ($game_info['recruit_num'] > $num || $game_info["zc_start"] != 0) {
                            if ($mem['id'] != 0) {
                                $num1 = $gamezm_model->count("gid =:gid and mem_id =:mem_id", array('gid' => $game_info['id'], 'mem_id' => $mem['id']));
                                if ($num1 != 0) {
                                    ?>
                                    <a target="_black" href="<?php echo $game_info['login_url'] ?>" class="button_2 butt"></a><!--继续试玩-->
                                <?php } else { ?>
                                    <a target="_black" href="<?php echo SITE_URL . "game/jump/type/4/id/" . $game_info["id"]; ?>"  class="button_1 butt"></a><!--立即试玩-->
                                    <?php
                                }
                            } else {
                                ?>
                                <a href="javascript:" id="loginBtns" class="button_1 butt"></a><!--立即试玩-->
                            <?php } ?>
                            <?php
                        } else {
                            if ($mem['id'] != 0) {
                                $num1 = $gamezm_model->count("gid =:gid and mem_id =:mem_id", array('gid' => $game_info['id'], 'mem_id' => $mem['id']));
                                if ($num1 != 0) {
                                    ?>
                                    <a href="<?php echo $game_info['login_url'] ?>" class="button_2 butt" target="_black"></a><!--继续试玩-->
                                <?php } else {
                                    ?>
                                    <a href="javascript:" class="button_3 butt"></a><!--招募已满-->
                                    <?php
                                }
                            } else {
                                ?>
                                <a href="javascript:" class="button_3 butt"></a><!--招募已满-->
                                <?php
                            }
                        }
                    }
                    ?>
                    <a href="<?php echo SITE_URL ?>game/show/id/10" class="jc" target="_blank">查看试玩视频教程</a>
                </div>
            </div>
            <!--内容-->
            <div class="content clearfix">
                <div class="content_left">
                    <!--试玩信息-->
                    <div class="information">
                        <div class="tit_1 clearfix">
                            <span class="ioc_1">试玩信息</span>
                        </div>
                        <div class="cont">
                            <?php
                            if ($mem != 0) {
                                if ($gamezm != 0) {
                                    $info2 = Gamedata::model()->findBySql("select * from {{game_data}} where game_id=" . $game_info['id'] . " and mem_id=" . $mem['id'])
                                    ?>
                                    <p><span>绑定帐号：</span><?php echo $gamezm["username"]; ?>（ID:<?php echo $gamezm["guid"]; ?>）</p>
                                    <?php if ($info2 != 0) { ?>
                                        <p><span>角色名称：</span><?php echo $info2["role"]; ?></p>
                                        <p><span>当前等级：</span>LV.
                                            <?php echo $info2["level"]; ?>
                                        </p>
                                        <p><span>最新更新时间：</span><i><?php echo $info2["update_time"]; ?></i></p>
                                    <?php } ?>
                                    <p class="but">
                                        <a class="ann"  href="javascript:grade(<?php echo $gamezm['guid']; ?>,<?php echo $game_info['id']; ?>)">刷新试玩信息</a>
                                        <img src="<?php echo IMG_URL ?>img/loading.gif" id="ref"  style="display:none"/>
                                    </p>
                                <?php } else { ?>
                                    <p><span >您还未注册本游戏，请</span>
                                        <a target="_black" href="<?php echo SITE_URL . "game/jump/type/4/id/" . $game_info["id"]; ?>" class="button_1 butt">立即注册试玩账号</a><!--立即试玩-->
                                    </p>
                                    <?php
                                }
                            } else {
                                ?>
                                <p><span>您还未登录、，请</span><a id="ljlogin">立即登录</a></p>
                                <p><span>还未注册？</span><a href="<?php echo SITE_URL ?>index/regester">免费注册</a></p>
                            <?php } ?>
                        </div>
                    </div>
                    <!--试玩倒计时-->
                    <div class="countdown">
                        <div class="tit_1 clearfix">
                            <span class="ioc_2">试玩倒计时</span>
                        </div>
                        <div class="cont clearfix">
                            <span id="DD"></span>
                            <i>天</i>
                            <span id="HH"></span>
                            <i>时</i>
                            <span id="MM"></span>
                            <i>分</i>
                            <span id="SS"></span>
                            <i>秒</i>
                        </div>
                    </div>
                    <!--元宝、豆兑换-->


                    <!--                    <div class="exchange">
                                            <div class="tit_1 clearfix">
                                                <span class="ioc_11">兑换</span>
                                            </div>
                                            <div class="cont">
                                                <div class="tab_2 clearfix">
                                                    <span class="hover" id="tow1" onclick="setTab('tow',1,2)">元宝兑换</span>
                                                    <span id="tow2" onclick="setTab('tow',2,2)">金豆兑换</span>
                                                </div>
                                                <ul class="sr" id="con_tow_1">
                                                    <li class="clearfix">
                                                        <span class="text">兑换金额：</span>
                                                        <select class="shur xuanz_2">
                                                            <option>1000青游币</option>
                                                            <option>2000青游币</option>
                                                            <option>3000青游币</option>
                                                            <option>4000青游币</option>
                                                            <option>5000青游币</option>
                                                        </select>
                                                        <span class="sm">90:1青游币</span>
                                                    </li>
                                                    <li class="clearfix">
                                                        <span class="text">充值账号：</span>
                                                        <input class="shur shur_1" type="text" />
                                                        <span class="sm_1">充值的游戏账号</span>
                                                    </li>
                                                    <li class="clearfix">
                                                        <span class="text">确定账号：</span>
                                                        <input class="shur shur_1" type="text" />
                                                        <span class="sm_1">确定游戏账号</span>
                                                    </li>
                                                    <li class="clearfix"><a class="ann">确定兑换</a></li>
                                                </ul>
                                                <ul class="sr" id="con_tow_2" style=" display: none;">
                                                    <li class="clearfix">
                                                        <span class="text">兑换金额：</span>
                                                        <select class="shur xuanz_2">
                                                            <option>1000青游币</option>
                                                            <option>2000青游币</option>
                                                            <option>3000青游币</option>
                                                            <option>4000青游币</option>
                                                            <option>5000青游币</option>
                                                        </select>
                                                        <span class="sm">1100:1青游币</span>
                                                    </li>
                                                    <li class="clearfix">
                                                        <span class="text">充值账号：</span>
                                                        <input class="shur shur_1" type="text" />
                                                        <span class="sm_1">充值的游戏账号</span>
                                                    </li>
                                                    <li class="clearfix">
                                                        <span class="text">确定账号：</span>
                                                        <input class="shur shur_1" type="text" />
                                                        <span class="sm_1">确定游戏账号</span>
                                                    </li>
                                                    <li class="clearfix"><a class="ann">确定兑换</a></li>
                                                </ul>
                                                <div class="z">注：兑换成功后，用户需自行进入平台，将平台币兑换入游戏。<i>元宝兑换的游戏币不参与充值返利</i>。</div>
                                            </div>
                                        </div>-->
                    <script>
                        //js表格 生成表格代码
                        //arrTh 表头信息
                        //arrTr 数据
                        var getTable = function(arrTh, arrTr) {
                            var s = ' <table class="table_1" >';
                            s += '<tr>';
                            for (var i = 0; i < arrTh.length; i++) {
                                s += '<th align="center">' + arrTh[i] + '</th>';
                            }
                            s += '</tr>';
                            for (var i = 0; i < arrTr.length; i++) {
                                s += '<tr>';
                                for (var j = 0; j < arrTr[i].length; j++) {
                                    if (j == 0) {
                                        s += '<td align="center">' + arrTr[i][j] + '</td>';
                                    } else if (j == 1) {
                                        s += '<td align="center">' + arrTr[i][j] + '</td>';
                                    } else {
                                        s += '  <td align="center" class="money">>LV.<i>' + arrTr[i][j] + '</i></td>';
                                    }
                                }
                                s += '</tr>';
                            }
                            s += '<tr><td colspan="3" align="center" class="zhu">注：游戏试玩排名实时更新</td></tr>';
                            s += '</table>';
                            return s;
                        }
                    </script>
                    <!--试玩等级排名-->
                    <div class="ranking">
                        <div class="tit_1 clearfix">
                            <span class="ioc_3">试玩等级排名</span>
                        </div>
                        <div class="cont" id="divData"></div>
                        <div class="sx clearfix" id="divPage"> </div>
                    </div>
                    <script type="text/javascript">
                        function goPage(pageIndex) {
                            var arrTh = ['排行', '游戏角色名', '等级'];
                            var arrTr = [];
                            var data = <?php echo $data; ?>;
                            var count = <?php echo $count; ?>;
                            if ((10 * pageIndex) <= count) {
                                for (var i = (pageIndex - 1) * 10; i < (10 * pageIndex); i++)
                                {
                                    arrTr.push([
                                        data[i][0],
                                        data[i][1],
                                        data[i][2]

                                    ]);
                                }
                            } else {
                                for (var i = (pageIndex - 1) * 10; i < count; i++)
                                {
                                    arrTr.push([
                                        data[i][0],
                                        data[i][1],
                                        data[i][2]

                                    ]);
                                }
                            }
                            document.getElementById('divData').innerHTML = getTable(arrTh, arrTr);
                            jsPage('divPage', count, 10, pageIndex, 'goPage');
                        }
                        goPage(1);
                    </script>
                    <?php if (!empty($game_info['czhref'])) { ?>
                        <!--充值返利-->
                        <div class="rebate">
                            <div class="tit_1 clearfix">
                                <span class="ioc_4">充值返利</span>
                                <i class="zhu">成功充值即可领取相应奖励</i>
                            </div>
                            <div class="cont">
                                <p> <?php echo $game_info['cz_hint']; ?></p>
                                <p class="zhu">奖励将于每<?php echo $game_info['rewardsend_time']; ?>个工作日直接到账!</p>
                                <p class="ann clearfix">
                                    <a class="button_5" href="<?php echo $game_info['czhref']; ?>" target="_blank">立即前往充值<i>&nbsp;></i></a>
                                    <a href="javascript:" class="chak">查看充值返利情况<i>>></i></a>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                    <!--官方QQ群-->
                    <div class="qq_group">
                        <div class="tit_1 clearfix">
                            <span class="ioc_5">官方QQ群</span>
                        </div>
                        <div class="cont">
                            <p class="clearfix"><span>、游戏试玩交流群：</span>300018299</p>
                        </div>
                    </div>
                    <!--游戏介绍-->
                    <div class="introduction">
                        <div class="tit_1 clearfix">
                            <span class="ioc_1">游戏介绍</span>
                        </div>
                        <div class="cont">
                            <p> <?php echo $game_info['introduce'] ?></p>
                        </div>
                    </div>
                    <!--游戏FAQ-->
                    <div class="faq">
                        <div class="tit_1 clearfix">
                            <span class="ioc_6">游戏FAQ</span>
                        </div>
                        <div class="cont">
                            <?php
                            $help = Help::model()->findAllBySql("select * from {{help}} where help_type_id=6 limit 0,8 ");
                            foreach ($help as $info) {
                                ?>
                                <a href="<?php echo SITE_URL; ?>help/show/id/6" target="_blank"><?php echo $info['quiz']; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="content_right">
                    <!--游戏详情-->
                    <div class="game_details">
                        <p>试玩时间：<i class="red"><?php echo $game_info['begin_time']; ?>—— <?php echo $game_info['end_time']; ?></i></p>
                        <p>试玩范围：<i class="green"><?php echo $game_info['gamerange'] ?></i></p>
                        <p>更新时间：<i class="red"><?php
                                if (empty($game_info['is_timely'])) {
                                    echo "实时更新";
                                } else {
                                    echo "手动更新";
                                }
                                ?></i></p>
                        <p>奖励领取：<i class="white">请在试玩周期内自行领取奖励。</i></p>
                        <p class="yellow">严禁同一游戏账号重复体验，同一IP、同一电脑体验，否则取最高等级进行奖励。</p>
                        <p class="white">此款游戏属于<i class="green">[<?php echo $game_info['business'] ?>]</i>游戏平台，关闭游戏前请先退出账号，下次输入账号密码登陆，以免串号！</p>
                    </div>
                    <!--温馨提示-->
                    <div class="cozy">温馨提示：严禁在商家平台、QQ群等渠道，发布与、有关言论。如有违规，直接冻结账号！</div>
                    <!--试玩奖励-->
                    <div class="award">
                        <div class="tit_1 clearfix">
                            <span class="ioc_7">试玩奖励</span>
                            <i class="zhu">注：到达奖励后手动领取</i>
                        </div>
                        <div class="cont">
                            <!--表格-->
                            <table class="table_2" border="1">
                                <tr>
                                    <th align="center">奖励设置</th>
                                    <th align="center">等级要求</th>
                                    <th align="center">奖励元宝</th>
                                    <th align="center">状态</th>
                                </tr>
                                <?php
                                $gamegrade_info = Gamegrade::model()->findAllBySql("select * from {{game_grade}} where game_id=" . $game_info['id'] . " order by level ");
                                foreach ($gamegrade_info as $index => $gradeinfo) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $index + 1; ?></td>
                                        <td align="center">体验等级达到&nbsp;<i><?php echo $gradeinfo['level']; ?></i>&nbsp;级</td>
                                        <td align="center"><span><?php echo number_format(intval($gradeinfo['hlb'])); ?></span></td>
                                        <td align="center">
                                            <?php
                                            if (!empty($mem)) {
                                                $gradedata_info = Gamegradedata::model()->findBySql("select * from {{game_gradedata}} where mem_id= " . $mem['id'] . " and level=" . $gradeinfo['level'] . " and game_id=" . $game_info['id']);
                                                if (!empty($gradedata_info)) {
                                                    if (empty($gradedata_info["valid"])) {
                                                        ?>
                                                        <a  href="javascript:rewards(<?php echo $game_info['id']; ?>,<?php echo $mem['id']; ?>,<?php echo $gradeinfo['level']; ?>)"><em class="l"> 领奖</em></a>
                                                    <?php } else { ?>
                                                        <em >已领取</em>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <em class="w">未达到</em>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <em>--</em>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                            <!--试玩速成宝典-->
                            <?php if ($game_info['articleid'] != 0) { ?>
                                <div class="crash">
                                    <div class="tit_2">试玩速成宝典</div>
                                    <?php $message_info = Message::model()->findByPk($game_info['articleid']); ?>
                                    <p class="biao"><?php echo $message_info['title'] ?> &nbsp;&nbsp;&nbsp;<i>[<?php echo $message_info['author'] ?>]</i></p>
                                    <p class="text"><?php echo mb_substr(strip_tags($message_info['content']), 1, 100, "utf-8"); ?>...<a href="<?php echo SITE_URL ?>message/detail/id/<?php echo $message_info["id"]; ?>/pid/<?php echo $message_info["message_type_id"]; ?>" target="_blank">查看全部&nbsp;<i>>></i></a></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="match">
                        <div class="tit_1 clearfix">
                            <?php echo $game_info['impactcont']; ?>
                        </div>
                    </div>
                    <!--冲级比赛-->
                    <?php
                    if ($pages->itemCount != 0) {
                        ?>
                        <div class="match">
                            <div class="tit_1 clearfix">
                                <span class="ioc_8">冲级比赛</span>
                                <i class="zhu">注：冲级比赛奖励将在达到相应等级后自动发放！</i>
                            </div>
                            <div class="cont">
                                <table class="table_2" border="1">
                                    <tr>
                                        <th>名次</th>
                                        <th>等级</th>
                                        <th>角色名</th>
                                        <th>领取时间</th>
                                        <th>奖励元宝</th>
                                    </tr>
                                    <?php
                                    foreach ($posts as $model) {
                                        ?>
                                        <tr>
                                            <td align="center"><?php echo $model["rank"]; ?></td>
                                            <td align="center"><?php echo $model['level'] ?></td>
                                            <td align="center">
                                                <?php echo $model['role']; ?>
                                            </td>
                                            <td align="center">
                                                <?php echo $model['lq_time']; ?>
                                            </td>
                                            <td align="center"><span><?php echo $model['hlb']; ?></span></td>
                                        </tr>
                                    <?php } ?>
                                </table>
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
                            </div>
                        </div>
                    <?php } ?>
                    <!--游戏截图-->
                    <div class="screenshot">
                        <div class="tit_1 clearfix">
                            <span class="ioc_9">游戏截图</span>
                        </div>
                        <div class="cont">
                            <div id="slide" class="slide">
                                <div class="bd">
                                    <div class="cover">
                                        <ul>
                                            <li data-category="tv">
                                                <a rel="nofollow" href="javascript:"  title="">
                                                    <img src="/uploads/img/game/<?php echo $game_info['photos1']; ?>">
                                                        <span class="info-wrap"> </span>
                                                </a>
                                            </li>
                                            <li data-category="tv">
                                                <a rel="nofollow" href="javascript:"  title="">
                                                    <img src="/uploads/img/game/<?php echo $game_info['photos2']; ?>">
                                                        <span class="info-wrap"> </span>
                                                </a>
                                            </li>
                                            <li data-category="tv">
                                                <a rel="nofollow" href="javascript:"  title="">
                                                    <img src="/uploads/img/game/<?php echo $game_info['photos3']; ?>">
                                                        <span class="info-wrap"></span>
                                                </a>
                                            </li>
                                            <li data-category="tv">
                                                <a rel="nofollow" href="javascript:"  title="">
                                                    <img src="/uploads/img/game/<?php echo $game_info['photos4']; ?>">
                                                        <span class="info-wrap"></span>
                                                </a>
                                            </li>
                                            <?php if (!empty($game_info['photos5'])) { ?>
                                                <li data-category="tv">
                                                    <a rel="nofollow" href="javascript:"  title="">
                                                        <img src="/uploads/img/game/<?php echo $game_info['photos5']; ?>">
                                                            <span class="info-wrap"> </span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            <?php if (!empty($game_info['photos6'])) { ?>
                                                <li data-category="tv">
                                                    <a rel="nofollow" href="javascript:"  title="">
                                                        <img src="/uploads/img/game/<?php echo $game_info['photos6']; ?>">
                                                            <span class="info-wrap"> </span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            <?php if (!empty($game_info['photos7'])) { ?>
                                                <li data-category="tv">
                                                    <a rel="nofollow" href="javascript:"  title="">
                                                        <img src="/uploads/img/game/<?php echo $game_info['photos7']; ?>">
                                                            <span class="info-wrap"> </span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            <?php if (!empty($game_info['photos8'])) { ?>
                                                <li data-category="tv">
                                                    <a rel="nofollow" href="javascript:"  title="">
                                                        <img src="/uploads/img/game/<?php echo $game_info['photos8']; ?>">
                                                            <span class="info-wrap"> </span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <a rel="nofollow" href="javascript:"  class="btn left-btn" hidefocus="true"></a>
                                    <a rel="nofollow" href="javascript:"  class="btn right-btn" hidefocus="true"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--试玩条例-->
                    <div class="regulations">
                        <div class="tit_1 clearfix">
                            <span class="ioc_10">试玩条例</span>
                        </div>
                        <div class="cont">
                            <span>*在体验过程中如有以下违规行为，将不予发放元宝奖励</span>
                            <p>创建试玩账号昵称、角色名、公会或联盟名称不得跟、内容相关；</p>
                            <p>严禁在平台里发表任何有关、的话题，如"元宝奖励、毕业、走人"等；</p>
                            <p>不要在平台里发表诋毁商家的言论，如"为了赚币、奖励拿完就不玩、为了赚币才玩"等；</p>
                            <p>为了快速获取元宝奖励，使用第三方软件试玩；</p>
                            <p>严禁注册多个、账号试玩或体验广告，以非法获取元宝奖励；</p>
                            <p>严禁在试玩的同时，帮助其他玩友代玩游戏；</p>
                            <p>不要在平台里推荐其他玩家加入、，以免对合作商家造成影响；</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once("./protected/views/game/footer.php") ?>	
    </body>
</html>
