<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>新手任务-<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="新人任务，网赚，试玩平台，免费Q币，赚Q币，玩试玩赚钱"/>
        <meta name="description" content="<?php echo TIT; ?>新人任务版块，这里为新人提供免费的玩试玩赚钱项目，爱玩试玩的用户通过试玩平台可以轻松获得元宝，超低价兑换礼品。" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>    
        <link href="/style/newcss.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/new.js"></script>
        <script src="/scripts/public_js.js"></script>
        <script type="text/javascript">
            window.onload = function() {
                $.ajax({
                    type: "POST",
                    data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken ?>'},
                    url: "<?php echo SITE_URL ?>new/task",
                    success: function(json) {
                        $("#task").html(json);
                    }
                });
            }
            /** 删除 **/
            function bangding(memid, id) {
                if (memid != "") {
                    if (id == 1) {
                        location.href = "<?php echo SITE_URL ?>vipindex/phone1";
                    } else if (id == 2) {
                        location.href = "<?php echo SITE_URL ?>game/show";
                    } else if (id == 3) {
                        location.href = "<?php echo SITE_URL ?>vipadvance/txalipay";
                    }
                } else {
                    alert("对不起,请先登录!");
                }
            }

            /** baoxiang **/
            function chests(id) {
                $.ajax({
                    type: "POST",
                    data: {"id": id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken ?>'},
                    url: "<?php echo SITE_URL ?>new/chests",
                    success: function(json) {
                        alert(json);
                        location.reload();
                    }
                });
            }
            /** 任务 **/
            function task(id, index) {
                $("#span" + index).addClass("hover");
                if (index == 1) {
                    $("#span2").removeClass("hover");
                    $("#span3").removeClass("hover");
                    $("#span4").removeClass("hover");
                } else if (index == 2) {
                    $("#span1").removeClass("hover");
                    $("#span3").removeClass("hover");
                    $("#span4").removeClass("hover");
                } else if (index == 3) {
                    $("#span1").removeClass("hover");
                    $("#span2").removeClass("hover");
                    $("#span4").removeClass("hover");
                } else if (index == 4) {
                    $("#span1").removeClass("hover");
                    $("#span2").removeClass("hover");
                    $("#span3").removeClass("hover");
                }

                $.ajax({
                    type: "POST",
                    data: {"id": id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken ?>'},
                    url: "<?php echo SITE_URL ?>new/task",
                    success: function(json) {
                        $("#task").html(json);
                    }
                });
            }




            function copyText(memid, id) {
                if (memid != "") {
                    var cont = 0;
                    if (id == 1) {
                        cont = $("#con1").val();
                    } else if (id == 2) {
                        cont = $("#con2").val();
                    } else if (id == 3) {
                        cont = $("#con3").val();
                    } else if (id == 4) {
                        cont = $("#con4").val();
                    }
                    if (window.clipboardData) {
                        window.clipboardData.clearData();
                        window.clipboardData.setData("Text", cont);
                        alert("复制成功！")
                    } else if (navigator.userAgent.indexOf("Opera") != -1) {
                        window.location = cont;
                        alert("复制成功！");
                    } else if (window.netscape) {
                        try {
                            netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
                        } catch (e) {
                            alert("被浏览器拒绝！\n请在浏览器地址栏输入'about:config'并回车\n然后将 'signed.applets.codebase_principal_support'设置为'true'");
                        }
                        var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
                        if (!clip)
                            return;
                        var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
                        if (!trans)
                            return;
                        trans.addDataFlavor('text/unicode');
                        var str = new Object();
                        var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
                        var copytext = cont;
                        str.data = copytext;
                        trans.setTransferData("text/unicode", str, copytext.length * 2);
                        var clipid = Components.interfaces.nsIClipboard;
                        if (!clip)
                            return false;
                        clip.setData(trans, null, clipid.kGlobalClipboard);
                        alert("复制成功！")
                    }
                } else {
                    alert("对不起,请先登录!");
                }
            }

        </script>
        <style type="text/css">
            .hover8{ background: url(<?php echo IMG_URL; ?>img/nav_b.png) no-repeat center; font-weight: bold;color:#fff;}
            .hover8 a { color:#fff !important;}
        </style>
    </head>
    <body style=" background: #2d7ebd;">
        <!--头部-->
        <?php include_once("./protected/views/design/header.php") ?>
		

		
		
        <div class="head">
            <?php
            if (!Yii::app()->user->getIsGuest()) {
                ?>
                <?php $info = System::model()->findByPk(1); ?>
                <!--个人信息-->
                <div class="personal clearfix">
                    <div class="name">
                        <span>欢迎您，</span>
                        <i class="mz"><?php echo $this->show_mem_name(); ?></i>
                        <em class="close"><a  href="<?php echo SITE_URL ?>index/logout">[退出]</a></em>
                        <span>,当前元宝：</span>
                        <i class="bi"><?php echo number_format(intval($hlbnum)); ?></i>
                        <span>&nbsp;可提现
                            <?php
                            if ($hlbnum >= $info['hlb_exchange_money']) {
                                echo intval($hlbnum / $info['hlb_exchange_money']);
                            } else {
                                echo "0";
                            }
                            ?>
                            元</span>
                        <span class="li">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                        <a href="<?php echo SITE_URL; ?>captcha/show">打码赚元宝</a>
                        <span class="li">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                        <a href="<?php echo SITE_URL; ?>game/show">试玩平台赚元宝</a>
                        <span class="li">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                        <a href="javascript:">币生币</a>
                    </div>
                    <div class="ann clearfix">
                        <?php
                        $num1 = Sign::model()->countBySql("select count(*) from {{sign}} where TO_DAYS(create_time) = (TO_DAYS(NOW())) and mem_id=" . $mem["id"]);
                        if (!empty($num1)) {
                            ?>
                            <a class="qian_yes" href="javascript:">已签到</a>
                        <?php } else { ?>
                            <a class="qian" href="<?php echo SITE_URL; ?>sign/show" target="_blank">签到</a>
                        <?php } ?>
                        <a class="hueiy" href="<?php echo SITE_URL; ?>vipindex/show">进入会员中心</a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!--主体-->
        <div class="main">
            <!--第一桶金-->
            <div class="firstgold">
                <div class="public_tit">
                    <div class="tiao">完成以下任务即可领取你的第一桶金！</div>
                </div>
                <div class="cont clearfix">
                    <div class="tab">
                        <?php
                        $tasktype_model = Tasktype::model()->findAll();
                        foreach ($tasktype_model as $index => $model) {
                            if (empty($index)) {
                                ?>
                                <span onclick="task(<?php echo $model["id"]; ?>,<?php echo $index + 1; ?>)" class="hover" id="span<?php echo $index + 1; ?>"><?php echo $model["name"]; ?></span>
                            <?php } else { ?>
                                <span  onclick="task(<?php echo $model["id"]; ?>,<?php echo $index + 1; ?>)"  id="span<?php echo $index + 1; ?>"><?php echo $model["name"]; ?></span>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <ul class="task clearfix" id="task">

                    </ul>
                </div>
            </div>
            <!--神秘宝箱-->
            <div class="chest">
                <div class="public_tit">
                    <div class="tiao">试玩游戏，免费开神秘宝箱，领神秘宝藏！</div>
                </div>
                <div class="cont">
                    <?php
                    $chests_model = Chests::model();
                    $chests_info = $chests_model->findAll();
                    $hlb_model = Hlb::model();
                    if (!empty($mem)) {
                        $old = $hlb_model->countBySql("select count(*) from {{hlb}} where source = 21 and  mem_id=" . $mem['id']); //老平台会员不参与开宝箱
                        if (empty($old)) {
                            ?>
                            <p class="tit">
                                您当前试玩累计赚取
                                <i>&nbsp;
                                    <?php
                                    $gamehlb = Hlb::model()->countBySql("select sum(hlb) from {{hlb}} where source=3 and mem_id=" . $mem["id"]);
                                    echo number_format(intval($gamehlb));
                                    ?>
                                    &nbsp;
                                </i>元宝，
                                <?php
                                if ($gamehlb >= $chests_info[5]["ljhlb"]) {
                                    $chlb = -1;
                                } else if ($gamehlb >= $chests_info[4]["ljhlb"]) {
                                    $chlb = $chests_info[5]["ljhlb"] - $gamehlb;
                                } else if ($gamehlb >= $chests_info[3]["ljhlb"]) {
                                    $chlb = $chests_info[4]["ljhlb"] - $gamehlb;
                                } else if ($gamehlb >= $chests_info[2]["ljhlb"]) {
                                    $chlb = $chests_info[3]["ljhlb"] - $gamehlb;
                                } else if ($gamehlb >= $chests_info[1]["ljhlb"]) {
                                    $chlb = $chests_info[2]["ljhlb"] - $gamehlb;
                                } else if ($gamehlb >= $chests_info[0]["ljhlb"]) {
                                    $chlb = $chests_info[1]["ljhlb"] - $gamehlb;
                                } else if ($gamehlb < $chests_info[0]["ljhlb"]) {
                                    $chlb = $chests_info[0]["ljhlb"] - $gamehlb;
                                }
                                ?>
                                <?php
                                if ($chlb < 0) {
                                    echo "所有宝箱已全部打开！";
                                } else {
                                    ?>
                                    还差<i>&nbsp; <?php echo $chlb; ?> &nbsp;</i>元宝可开启下一个神秘宝箱。
                                    <?php
                                }
                                ?>
                                <a href="<?php echo SITE_URL ?>game/show">现在就去试玩赚元宝！</a>
                            </p>
                            <?php
                        } else {
                            echo " <p class='tit'>对不起,老会员不可参与新手任务,无法开启宝箱！</p>";
                        }
                    }
                    ?>
                    <ul class="ul_1 clearfix">
                        <?php
                        $chestsinfo_info = Chestsinfo::model();
                        foreach ($chests_info as $chests) {
                            ?>
                            <li>
                                <div class="baox">
                                    <img src="<?php echo IMG_URL ?>newimg/chest_<?php echo $chests["id"]; ?>.png" />
                                    <div class="explain">
                                        <p>试玩游戏满<i><?php echo $chests["ljhlb"] / 10000; ?></i>万元宝</p>
                                        <p>奖励<i><?php echo $chests["hlb"] / 10000; ?>元</i></p>
                                    </div>
                                </div>
                                <p>累计
                                    <?php echo "<span style='color:red;'>" . $chests["ljhlb"] . "</span>"; ?>
                                    元宝</p>
                                <?php
                                if (!empty($mem)) {
                                    if (empty($old)) {
                                        $chests_num = $chestsinfo_info->countBySql("select count(*) from {{chestsinfo}} where  mem_id=" . $mem["id"] . " and chests=" . $chests["id"]); //查询是否领取过
                                        if (!empty($chests_num)) {
                                            ?>
                                            <a href="javascript:">已开箱</a>
                                            <?php
                                        } else {
                                            if ($gamehlb >= $chests["ljhlb"]) {
                                                ?>
                                                <a href="javascript:chests(<?php echo $chests["id"]; ?>)" class="yes">开宝箱</a>
                                            <?php } else { ?>
                                                <a  href="javascript:">未达到</a>
                                                <?php
                                            }
                                        }
                                        ?>
                                    <?php } else { ?>
                                        <a  href="javascript:">--</a>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <a  href="javascript:">--</a>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <!--试玩游戏-->
            <div class="play_game">
                <div class="public_tit">
                    <div class="tiao">试玩一下就能开宝箱啦~！</div>
                </div>
                <div class="cont clearfix">
                    <?php
                    $gamezm_model = Gamezm::model();
                    $game_info1 = Game::model()->findAllBySql("select * from {{game}} where valid=0 and is_hpage=1 and valid=0  order by begin_time desc  limit 0,5");
                    foreach ($game_info1 as $game) {
                        $num1 = $gamezm_model->count("gid =:gid", array('gid' => $game['id']));
                        ?>
                        <div class="list_1">
                            <a class="a_1" href="<?php echo SITE_URL; ?>game/detail/id/<?php echo $game['id']; ?>" target="_blank">
                                <img src="/uploads/img/game/<?php echo $game['img']; ?>" />
                                <p class="p_1 clearfix">
                                    <em class="em_1"><?php echo $game['name']; ?></em>
                                    <?php if (date("ymd", strtotime($game['create_time'])) == date("ymd", time())) { ?>  
                                        <i class="i_1">新试玩</i>
                                    <?php } else if ($game['recruit_num'] > $num1) { ?>  
                                        <i class="i_2">招募中</i>
                                    <?php } else if ($game['recruit_num'] == $num1) { ?>  
                                        <i class="i_2">招募已满</i>
                                        <?php
                                    } else {
                                        $sql = "select count(*) from {{game}} where valid=0 and to_days(end_time) < to_days(now()) and game_type_id =" . $id;
                                        $count = $gamezm_model->countBySql($sql);
                                        if ($count != 0) {
                                            ?>
                                            <i class="i_3">已结束</i>
                                            <?php
                                        }
                                    }
                                    ?>                   
                                </p>
                                <span class="bk"></span>
                                <span class="ann">立即试玩</span>
                                <?php if ($game['is_prefecture'] == 0) { ?>
                                    <span class="sa service">
                                        <?php echo "专区"; ?>
                                    </span>
                                <?php } else if ($game['is_prefecture'] == 1) { ?>
                                    <span class="sa area"><?php echo "多服"; ?></span>
                                <?php } ?>
                                <span class="btm_bk"></span>
                                <span class="btm">
                                    <?php if ($game['is_timely'] == 0) { ?>
                                        <i class="btm_i_1">
                                            <?php echo "即"; ?>
                                        </i>
                                    <?php } else if ($game['is_prefecture'] == 1) { ?>
                                        <i class="btm_i_2">
                                            <?php echo "续"; ?>
                                        </i>
                                    <?php } ?>
                                    <span class="btm_span_1">参与人数：<em><?php echo $num1 * $game["gamezmbs"]; ?></em></span>
                                </span> 
                            </a>
                            <p class="p_2">每人奖励：<em>
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
                                </em></p>
                            <p class="p_3">充值返利：<em><?php echo $game['cz_rewards_num']; ?>%</em></p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--一劳永逸-->
            <div class="invitation">
                <div class="public_tit">
                    <div class="tiao">推荐一个好友，永久X%提成+现金奖励</div>
                </div>
                <div class="cont">
                    <p class="tit">邀请链接</p>
                    <p class="shu_1 clearfix"><input id="con1" value="<?php echo SITE_URL . $mem["id"]; ?>"  disabled="disabled" type="text" /><a href="javascript:copyText('<?php echo $mem["id"]; ?>',1);">复制</a></p>
                    <p class="zhu">你的好友在注册时，通过此链接进行注册，即可与你建立好友下线关系。</p>
                    <p class="tit">邀请范文</p>
                    <p class="zhu">把专属于你的邀请链接发给好友，好友打开此链接即可进行正常注册。(无须担心你的好友刷新页面在注册)</p>
                    <div class="k clearfix">
                        <p>
                            <textarea disabled="disabled" id="con2">、免费试玩赚钱，我刚才玩游戏赚了2元，马上到账了！老牌站不错的。另外邀请好友最高还有50%提成奖励。试玩赚钱、打码、广告体验的奖励都很高。
                                <?php echo SITE_URL . $mem["id"]; ?></textarea><a href="javascript:copyText('<?php echo $mem["id"]; ?>',2);">复制</a>
                        </p>
                        <p>
                            <textarea disabled="disabled" id="con3">大家都在、打码，那里打码资源很优质，关键是上码速度快，我打了码之后去提现立刻到账，2元就能提现。现在每日打码排行最高奖励68元现金！
                                <?php echo SITE_URL . $mem["id"]; ?></textarea><a href="javascript:copyText('<?php echo $mem["id"]; ?>',3);">复制</a>
                        </p>
                        <p>
                            <textarea disabled="disabled" id="con4">朋友都喜欢去、体验广告，那里广告来源优质，体验任务简单，现金到账快速，不费时不费力就能享受诸多好处。
                                <?php echo SITE_URL . $mem["id"]; ?></textarea><a href="javascript:copyText('<?php echo $mem["id"]; ?>',4);">复制</a>
                        </p>
                    </div>
                </div>
            </div>
            <!--活动规则标题-->
            <div class="rule_tit">
                <div class="public_tit"></div>
                <div>&nbsp;</div>
            </div>
        </div>
        <!--活动规则内容-->
        <div class="rule">
            <div class="cont">
                <p>1.成功注册 送1次挖宝藏机会</p>
                <p>2.每日签到 送1次挖宝藏机会</p>
                <p>3.每成功邀请5名好友 送1次挖宝藏机会</p>
                <p>4.每打码满5000元宝 送1次挖宝机会(每天限额20次)</p>
                <p>5.试玩平台每满3000元宝送1次 送一次挖宝藏机会(不限额)</p>
            </div>
        </div>
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
    </body>
</html>
