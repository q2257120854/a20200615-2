<div class="main_right clearfix">
    <!--试玩三步-->
    <div class="step">
        <div class="tit">
            <span>试玩三步搞定</span>
        </div>
        <div class="cont">
            <ul class="ul_1 clearfix">
                <li>
                    <a class="a_1" href="<?php echo SITE_URL ?>gamecourse/show" target="_blank"></a>
                    <p>选择试玩</p>
                </li>
                <li>
                    <a class="a_2" href="<?php echo SITE_URL ?>gamecourse/show" target="_blank"></a>
                    <p>完成体验</p>
                </li>
                <li class="none">
                    <a class="a_3" href="<?php echo SITE_URL ?>gamecourse/show" target="_blank"></a>
                    <p>领取奖励</p>
                </li>
            </ul>
        </div>
    </div>
    <!--充值返利发放进度表javascript:-->
    <a class="query" href="/message/list/pid/5" target="_blank">充值返利发放进度表</a>
    <!--试玩预告-->
    <div class="trailer">
        <div class="public_tit clearfix">
            <i class="ico trailer_ico"></i>
            <span class="sp_1">试玩预告</span>
        </div>
        <div class="cont">
            <?php
            $num1 = Game::model()->countBySql("select count(*) from {{game}} where  TO_DAYS(begin_time) = TO_DAYS(now()) ");
            if ($num1 != 0) {
                ?>
                <ul class="ul_1">
                    <li class="li_1">
                        <em><?php echo date("m月d日", time()); ?></em><i class="today">今天</i>
                    </li>
                    <?php
                    $game_info1 = Game::model()->findAllBySql("select id,name,begin_time,end_time,recruit_num from {{game}} where   to_days(begin_time) = to_days(now()) ");
                    foreach ($game_info1 as $info) {
                        $num1 = Gamezm::model()->count("gid =:gid", array('gid' => $info['id']));
                        ?>
                        <li class="li_<?php
                        if (($info['recruit_num'] <= $num1) || (time() >= strtotime($info['begin_time']))) {
                            echo "3";
                        } else {
                            echo "2";
                        }
                        ?> clearfix">
                            <p class="name">
                                <?php if (time() >= strtotime($info['begin_time'])) { ?>
                                    <a href="<?php echo SITE_URL ?>game/detail/id/<?php echo $info['id']; ?>" target="_blank"><?php echo $info['name']; ?></a>
                                <?php } else { ?>
                                    <a href="javascript:" ><?php echo $info['name']; ?></a>
                                <?php } ?>
                            </p>
                            <p class="money"><em>
                                    <?php
                                    $impactnum = Gameimpact::model()->countBySql("select hlb FROM {{game_impact}} where game_id=" . $info["id"] . " order by rank  limit 1");
                                    $gradenum = Gamegrade::model()->countBySql("select sum(hlb) FROM {{game_grade}} where game_id=" . $info["id"]);
                                    $rewardnum = intval((intval($impactnum) + intval($gradenum)) / 10000);
                                    echo $rewardnum;
                                    ?>
                                    万</em></p>  
                            <p class="state">
                                <?php
                                if ($info['recruit_num'] > $num1) {
                                    ?>
                                    <span class="sp_1">
                                        <?php
                                        if (time() >= strtotime($info['begin_time'])) {
                                            ?>
                                            <a href="<?php echo SITE_URL ?>game/detail/id/<?php echo $info['id']; ?>" target="_blank"><em>[招募中]</em></a>
                                            <?php
                                        } else {
                                            echo date('H:i', strtotime($info['begin_time']));
                                            ?>
                                            <em>[上线]</em>
                                        <?php }
                                        ?>
                                    </span>
                                <?php } else if ($info['recruit_num'] <= $num1) {
                                    ?>
                                    <span class="sp_3">
                                        <em>[招募满]</em>
                                    </span>
                                <?php } ?>
                                <?php if (time() < strtotime($info['begin_time'])) { ?>
                                    <a href="http://ctc.qzs.qq.com/snsapp/app/bee/widget/open.htm#content=<?php echo $info['name'] . "与" . $info['begin_time'] . "上线,赶紧注册试玩吧~" ?>&time=<?php echo date('Y-m-d h:i', strtotime($info['begin_time'])) ?>&advance=5&url=<?php echo SITE_URL ?>game/detail/id/<?php echo $info['id']; ?>" target="_blank" class="sp_2">设置QQ提醒</a>
                                <?php } ?>
                            </p>  
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
            <?php
            $num2 = Game::model()->countBySql("select count(*) from {{game}} where  TO_DAYS(begin_time) = (TO_DAYS(NOW())+1) ");
            if ($num2 != 0) {
                ?>
                <ul class="ul_1">
                    <li class="li_1">
                        <em><?php echo date("m月d日", strtotime("+1 day")); ?></em><i class="tomorrow">明天</i>
                    </li>
                    <?php
                    $game_info2 = Game::model()->findAllBySql("select id,name,begin_time,end_time,recruit_num from {{game}} where  TO_DAYS(begin_time) = (TO_DAYS(NOW())+1) ");
                    foreach ($game_info2 as $info) {
                        ?>
                        <li class="li_<?php
                        if (($info['recruit_num'] <= $num2) || (time() >= strtotime($info['begin_time']))) {
                            echo "3";
                        } else {
                            echo "2";
                        }
                        ?> clearfix">
                            <p class="name">
                                <?php if (time() >= strtotime($info['begin_time'])) { ?>
                                    <a href="<?php echo SITE_URL ?>game/detail/id/<?php echo $info['id']; ?>" target="_blank"><?php echo $info['name']; ?></a>
                                <?php } else { ?>
                                    <a href="javascript:" ><?php echo $info['name']; ?></a>
                                <?php } ?>
                            </p>
                            <p class="money"><em><?php
                                    $impactnum = Gameimpact::model()->countBySql("select hlb FROM {{game_impact}} where game_id=" . $info["id"] . " order by rank  limit 1");
                                    $gradenum = Gamegrade::model()->countBySql("select sum(hlb) FROM {{game_grade}} where game_id=" . $info["id"]);
                                    $rewardnum = intval((intval($impactnum) + intval($gradenum)) / 10000);
                                    echo $rewardnum;
                                    ?>万</em></p>  
                            <p class="state">
                                <?php
                                $num2 = Gamezm::model()->count("gid =:gid", array('gid' => $info['id']));
                                if ($info['recruit_num'] > $num2) {
                                    ?>
                                    <span class="sp_1">
                                        <?php
                                        if (time() >= strtotime($info['begin_time'])) {
                                            ?>
                                            <a href="<?php echo SITE_URL ?>game/detail/id/<?php echo $info['id']; ?>" target="_blank"><em>[招募中]</em></a>
                                            <?php
                                        } else {
                                            echo date('H:i', strtotime($info['begin_time']));
                                            ?>
                                            <em>[上线]</em>
                                            <?php
                                        }
                                        ?>
                                    </span>
                                <?php } else if ($info['recruit_num'] <= $num2) {
                                    ?>
                                    <span class="sp_3">
                                        <em>[招募满]</em>
                                    </span>
                                <?php } ?>

                                <?php if (time() < strtotime($info['begin_time'])) { ?>
                                    <a href="http://ctc.qzs.qq.com/snsapp/app/bee/widget/open.htm#content=<?php echo $info['name'] . "与" . $info['begin_time'] . "上线,赶紧注册试玩吧~" ?>&time=<?php echo date('Y-m-d h:i', strtotime($info['begin_time'])) ?>&advance=5&url=<?php echo SITE_URL ?>game/detail/id/<?php echo $info['id']; ?>" target="_blank" class="sp_2">设置QQ提醒</a>
                                <?php } ?>
                            </p>  
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
            <?php
            $num3 = Game::model()->countBySql("select count(*) from {{game}} where  TO_DAYS(begin_time) = (TO_DAYS(NOW())+2) ");
            if ($num3 != 0) {
                ?>
                <ul class="ul_1">
                    <li class="li_1">
                        <em><?php echo date("m月d日", strtotime("+2 day")); ?></em><i class="tomorrow">后天</i>
                    </li>
                    <?php
                    $game_info3 = Game::model()->findAllBySql("select id,name,begin_time,end_time,recruit_num from {{game}} where  TO_DAYS(begin_time) =(TO_DAYS(NOW())+2) ");
                    foreach ($game_info3 as $info) {
                        ?>
                        <li class="li_<?php
                        if (($info['recruit_num'] <= $num3) || (time() >= strtotime($info['begin_time']))) {
                            echo "3";
                        } else {
                            echo "2";
                        }
                        ?> clearfix">
                            <p class="name">
                                <?php if (time() >= strtotime($info['begin_time'])) { ?>
                                    <a href="<?php echo SITE_URL ?>game/detail/id/<?php echo $info['id']; ?>" target="_blank"><?php echo $info['name']; ?></a>
                                <?php } else { ?>
                                    <a href="javascript:" ><?php echo $info['name']; ?></a>
                                <?php } ?>
                            </p>
                            <p class="money"><em><?php
                                    $impactnum = Gameimpact::model()->countBySql("select hlb FROM {{game_impact}} where game_id=" . $info["id"] . " order by rank  limit 1");
                                    $gradenum = Gamegrade::model()->countBySql("select sum(hlb) FROM {{game_grade}} where game_id=" . $info["id"]);
                                    $rewardnum = intval((intval($impactnum) + intval($gradenum)) / 10000);
                                    echo $rewardnum;
                                    ?>万</em>
                            </p>  
                            <p class="state">
                                <?php
                                $num3 = Gamezm::model()->count("gid =:gid", array('gid' => $info['id']));
                                if ($info['recruit_num'] > $num3) {
                                    ?>
                                    <span class="sp_1">
                                        <?php
                                        if (time() >= strtotime($info['begin_time'])) {
                                            ?>
                                            <a href="<?php echo SITE_URL ?>game/detail/id/<?php echo $info['id']; ?>" target="_blank"><em>[招募中]</em></a>
                                            <?php
                                        } else {
                                            echo date('H:i', strtotime($info['begin_time']));
                                            ?>
                                            <em>[上线]</em>
                                            <?php
                                        }
                                        ?>
                                    </span>
                                <?php } else if ($info['recruit_num'] <= $num3) {
                                    ?>
                                    <span class="sp_3">
                                        <em>[招募满]</em>
                                    </span>
                                <?php } ?>
                                <?php if (time() < strtotime($info['begin_time'])) { ?>
                                    <a href="http://ctc.qzs.qq.com/snsapp/app/bee/widget/open.htm#content=<?php echo $info['name'] . "与" . $info['begin_time'] . "上线,赶紧注册试玩吧~" ?>&time=<?php echo date('Y-m-d h:i', strtotime($info['begin_time'])) ?>&advance=5&url=<?php echo SITE_URL ?>game/detail/id/<?php echo $info['id']; ?>" target="_blank" class="sp_2">设置QQ提醒</a>
                                <?php } ?>
                            </p>  
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </div>
    <!--今日排行榜、昨日试玩排行榜-->
    <div class="ranking">
        <div class="tit clearfix">
            <span class="hover" id="data1">  
                  		

				<a   href="javascript:data(1);" >11月1日开榜</a>   

				 
               <!--	 <a   href="javascript:data(1);" >今日试玩排名</a>  -->
				
            </span>
            <span id="data2">
                <a href="javascript:data(2);"  >昨日试玩排名</a>
            </span>
        </div>
        <div class="cont"   id="divData1" ></div>
        <div class="sx clearfix" id="divPage1"> </div>

        <div class="cont"   id="divData2"  style="display: none"></div>
        <div class="sx clearfix" id="divPage2" style="display: none"> </div>
        <script type="text/javascript">
            var data1 = <?php echo $data1; ?>;
            var data2 = <?php echo $data2; ?>;
            var count = <?php echo $count; ?>;
            /** 获取排行数据 **/
            function data(id) {
                if (id == 1) {
                    $("#data1").addClass("hover");
                    $("#data2").removeClass("hover");
                    $("#divData1").show();
                    $("#divPage1").show();
                    $("#divData2").hide();
                    $("#divPage2").hide();
                } else {
                    $("#data1").removeClass("hover");
                    $("#data2").addClass("hover");
                    $("#divData1").hide();
                    $("#divPage1").hide();
                    $("#divData2").show();
                    $("#divPage2").show();
                }
            }

            //arrTr 数据  js表格 生成表格代码  arrTh 表头信息
            var getTable = function(arrTh, arrTr) {
                var s = ' <ul class="ul_1 clearfix">';
                s += ' <li class="li_1 clearfix">';
                for (var i = 0; i < arrTh.length; i++) {
                    if (i == 0) {
                        s += ' <p class="p_1">' + arrTh[i] + '</p>';
                    } else if (i == 1) {
                        s += ' <p class="p_2">' + arrTh[i] + '</p>';
                    } else if (i == 2) {
                        s += ' <p class="p_3">' + arrTh[i] + '</p>';
                    } else {
                        s += '<p class="p_4"><span class="no">' + arrTh[i] + '</span></p>';
                    }
                }
                s += '</li>';
                for (var i = 0; i < arrTr.length; i++) {
                    s += '<li class="li_2 clearfix">';
                    for (var j = 0; j < arrTr[i].length; j++) {
                        if (j == 0) {
                            s += ' <p class="p_1"><span>' + arrTr[i][j] + '</span></p>';
                        } else if (j == 1) {
                            s += ' <p class="p_2"><span>' + arrTr[i][j] + '</span></p>';
                        } else if (j == 2) {
                            s += ' <p class="p_3"><span><i>' + arrTr[i][j] + '</i></span></p>';
                        } else {
                            s += '<p class="p_4"><span class="no">￥' + arrTr[i][j] + '</span></p>';
                        }
                    }
                    s += ' </li>';
                }
                s += '</ul>';
                return s;
            }

            function goPage1(pageIndex) {
                var arrTh = ['排行', '会员昵称', '试玩收入', '每日奖励'];
                var arrTr = [];
                if ((10 * pageIndex) <= count) {
                    for (var i = (pageIndex - 1) * 10; i < (10 * pageIndex); i++)
                    {
                        arrTr.push([
                            data1[i][0],
                            data1[i][1],
                            data1[i][2],
                            data1[i][3]
                        ]);
                    }
                } else {
                    for (var i = (pageIndex - 1) * 10; i < count; i++)
                    {
                        arrTr.push([
                            data1[i][0],
                            data1[i][1],
                            data1[i][2],
                            data1[i][3]
                        ]);
                    }
                }
                document.getElementById('divData1').innerHTML = getTable(arrTh, arrTr);
                jsPage('divPage1', count, 10, pageIndex, 'goPage1');
            }


            function goPage2(pageIndex) {
                var arrTh = ['排行', '会员昵称', '试玩收入', '每日奖励'];
                var arrTr = [];
                if ((10 * pageIndex) <= count) {
                    for (var i = (pageIndex - 1) * 10; i < (10 * pageIndex); i++)
                    {
                        arrTr.push([
                            data2[i][0],
                            data2[i][1],
                            data2[i][2],
                            data2[i][3]
                        ]);
                    }
                } else {
                    for (var i = (pageIndex - 1) * 10; i < count; i++)
                    {
                        arrTr.push([
                            data2[i][0],
                            data2[i][1],
                            data2[i][2],
                            data2[i][3]
                        ]);
                    }
                }
                document.getElementById('divData2').innerHTML = getTable(arrTh, arrTr);
                jsPage('divPage2', count, 10, pageIndex, 'goPage2');
            }
            goPage1(1);
            goPage2(1);
        </script>
    </div>
	<div class="public_tit clearfix" style="  background: #FFFFF0;text-align: center;">
            <i class="ico2 trailer_ico"></i>
            <span style="font-size: 18px;"><strong><span style="color: rgb(255, 0, 0);">低于10000元宝，无排行奖励</span></strong></span>
        </div>

    <?php
    $ad_infos2 = Ad::model()->findAllBySql("select img,url from {{ad}} where id =9 and open=0  ");
    if (!empty($ad_infos2)) {
        foreach ($ad_infos2 as $ad) {
            ?> 
            <!--广告宣传图-->
            <a class="advertisement_1" href="<?php echo $ad['url']; ?>" target="_blank">
                <img src="/uploads/img/ad/<?php echo $ad['img']; ?>" />
            </a>
            <?php
        }
    }
    ?>
	
	
    <!--大家都在玩-->
    <div class="play">
        <div class="public_tit clearfix">
            <i class="ico play_ico"></i>
            <span class="sp_1">大家都在玩</span>
        </div>
        <div class="cont">
            <div class="list_lh">
                <ul>
                    <?php
                    $giftdata = Gamegradedata::model()->findAllBySql("select * from {{game_gradedata}} where valid=1  order by id desc  limit 0,8");
                    foreach ($giftdata as $info) {
                        $game = Game::model()->findByPk($info['game_id']);
                        $member = Mem::model()->findByPk($info['mem_id']);
                        $memimg = Memimg::model()->findByPk($member['memimg_id']);
                        ?>
                        <li class="clearfix">
                            <span class="tou"><img src="<?php echo IMG_URL; ?>touxiang/<?php echo $memimg['img'] ?>"/></span>
                            <p class="name"><?php echo $member['mem_name']; ?></p>
                            <p class="wan">玩：
                                <a href="<?php echo SITE_URL ?>game/detail/id/<?php echo $game["id"]; ?>" target="_blank"><?php echo $game['name']; ?> </a>
                            </p>
                            <p class="lin clearfix"><span>领取了：</span><em><?php echo number_format($info['hlb']); ?></em></p>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <!--官方交流群-->
    <div class="qq_group">
        <div class="public_tit clearfix">
            <i class="ico group_ico"></i>
            <span class="sp_1">官方交流群</span>
        </div>
		
        <div class="cont">
            <ul class="ul_1">
                <li><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=62f73e8d9ee8d535aa583944177f7937e33866cdd12a5b14f35fa4917f5d8935"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="、综合交流①群" title="、综合交流①群"></a>【、①群】48999940</li>
                <li><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=7038992e8fc7e91a53ee64514fd314f99f242758356c25b997bbdb9ea250e9e3"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="、综合交流②群" title="、综合交流②群"></a>【、②群】48999980</li>
            </ul>
        </div>		
		
    </div>
    <!--客服中心-->
    <div class="customer">
        <div class="public_tit clearfix">
            <i class="ico customer_ico"></i>
            <span class="sp_1">试玩问题</span>
            <a class="public_more" href="http://009.90xqb.com/help/show/id/6" target="_blank">MORE<em>&nbsp;>></em></a>
        </div>
        <div class="cont">
            <ul class="ul_1">
                <?php
                $help = Help::model()->findAllBySql("select * from {{help}} where help_type_id=6 order by id desc limit 0,8 ");
                foreach ($help as $info) {
                    ?>
                    <li><a href="http://009.90xqb.com/help/show/id/4" target="_blank"><?php echo $info['quiz']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>