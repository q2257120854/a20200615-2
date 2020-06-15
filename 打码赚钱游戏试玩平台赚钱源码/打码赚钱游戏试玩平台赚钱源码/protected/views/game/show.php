<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>、试玩平台-<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="、试玩平台，网赚，网页试玩，棋牌试玩，客户端试玩，玩试玩赚钱" />
        <meta name="description" content="、网络试玩平台中心版块，这里为玩家提供免费的玩试玩赚钱项目，爱玩试玩的用户通过试玩平台获得相应额度的元宝和经验值奖励，通过欢元宝的积累，用户可换取人民币以及手机充值卡、Q币、笔记本、手机以及其他实物奖品，同时也为商家提供了大量真实有效的广告受众。" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/shiwan.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/public_js.js"></script>
        <script type="text/javascript" src="/scripts/advert.js"></script>
        <script src="/scripts/jquery.lazyload.js?v=1.9.1"></script>
        <script type="text/javascript" src="/scripts/js/offlights.js"></script>
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
            .hover7{ background: url(<?php echo IMG_URL; ?>img/nav_b.png) no-repeat center; font-weight: bold;color:#fff;}
            .hover7 a {color:#fff !important; }
        </style>
    </head>
    <body >
        <?php include_once("./protected/views/design/header.php"); ?>

      
        <!--主体-->
        <div class="main clearfix">
            <div class="main_left clearfix">   
                <!--全部游戏、网页游戏、棋牌游戏...-->
                <div class="game clearfix">
                    <div class="tit clearfix">
                        <ul class="ul_1 clearfix">
                            <li  <?php
                            if (0 == $id) {
                                echo "class='hover'";
                            }
                            ?> >
                                <a href="<?php echo SITE_URL; ?>game/show/id/0">全部试玩</a>
                            </li>
                            <?php
                            $gametype_info = Gametype::model()->findAllBySql("select id,name from {{game_type}}  limit 0,4;");
                            foreach ($gametype_info as $gametype) {
                                ?>  
                                <li <?php
                                if ($gametype['id'] == $id) {
                                    echo "class='hover'";
                                }
                                ?>>
                                    <a href="<?php echo SITE_URL; ?>game/show/id/<?php echo $gametype['id']; ?>"><?php echo $gametype['name']; ?></a>
                                </li>
								<?php } ?>
							<li>
                                <a href="http://009.90xqb.com/guessing/show" target="_blank">任务墙</a>
                            </li>
								
                        </ul>
                    </div>
					

					
                    <?php if ($id == 10) { //10是随便定义的   ?>
                        <div class="cont clearfix">
                            <!-- 我爱播放器(52player.com)/代码开始 -->
                            <script type="text/javascript" src="/CuPlayer/images/swfobject.js"></script>
                            <div class="video" id="CuPlayer">
                            </div>
                            <script type="text/javascript">
            var so = new SWFObject("/game.swf", "CuPlayerV4", "600", "410", "9", "#000000");
            so.addParam("allowfullscreen", "true");
            so.addParam("allowscriptaccess", "always");
            so.addParam("wmode", "opaque");
            so.addParam("quality", "high");
            so.addParam("salign", "lt");
            so.addVariable("CuPlayerSetFile", "/CuPlayer/CuPlayerSetFile.php"); //播放器配置文件地址,例SetFile.xml、SetFile.asp、SetFile.php、SetFile.aspx
            so.addVariable("CuPlayerFile", "/game.mp4"); //视频文件地址
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
                    <?php } else { ?>
                        <!--招募中-->
                        <div class="cont clearfix">
                            <div class="tit_2">
                                <span class="sp_1">招募中的试玩</span>
                                <span class="sp_2">&nbsp;|&nbsp;正在火热招募玩家试玩 </span>
                            </div>
                            <ul class="ul_2 clearfix">
                                <?php
                                $gameimpact_model = Gameimpact::model();
                                $gamegrade_model = Gamegrade::model();
                                foreach ($game_info as $game) {
                                    $num = Gamezm::model()->count("gid =:gid", array('gid' => $game['id']));
                                    if ($game['recruit_num'] > $num && strtotime($game["end_time"]) > time() && empty($game['zc_start']) && empty($game['game_start'])) {
                                        ?>  
                                        <li>
										  <a class="a_1" href="<?php echo SITE_URL; ?>game/detail/id/<?php echo $game['id']; ?>" target="_blank" >
                                            
                                                <img  class="lazy" data-original="/uploads/img/game/<?php echo $game['img']; ?>" />
                                                <p class="p_1 clearfix">
                                                    <em class="em_1"><?php echo $game['name']; ?></em>
                                                    <i class="i_1">招募中</i>
                                                </p>
                                                <span class="bk"></span>
                                                <span class="ann">立即试玩</span>
                                                <?php if ($game['is_prefecture'] == 0) { ?>
                                                    <span class="sa service">
                                                        <?php echo "冲级赛"; ?>
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
                                                    <?php } else if ($game['is_timely'] == 1) { ?>
                                                        <i class="btm_i_2">
                                                            <?php echo "续"; ?>
                                                        </i>
                                                    <?php } ?>
													
													<?php if ($game['bustype'] == 12) { ?>
                                                     <span class="btm_span_1"></span>
                                             <?php } else if($game['bustype']!=12) { ?>
                                                      <span class="btm_span_1">参与人数：<em><?php
                                                             echo $num * $game["gamezmbs"];
                                                            ?></em></span>  <?php } ?>
													
                                                </span> 
                                            </a>
                                            <p class="p_2">每人奖励：
                                                <em><?php
                                                    if (!empty($game->impactmax)) {
                                                        $impactmax = $game["impactmax"];
                                                    } else {
                                                        $impactmax = $gameimpact_model->countBySql("select hlb FROM {{game_impact}} where game_id=" . $game["id"] . " order by rank limit 1");
                                                    }
                                                    $gradenum = $gamegrade_model->countBySql("select sum(hlb) FROM {{game_grade}} where game_id=" . $game["id"]);
                                                    $rewardnum = intval((intval($impactmax) + intval($gradenum)) / 10000);
                                                echo $rewardnum;
                                                ?>万
                                                    </em>
                                            <i></i>
                                            </p>
                                            <p class="p_3">充值返利：<em class="<?php
                                                if (empty($game['cz_rewards_num'])) {
                                                    echo "no";
                                                }
                                                ?>"><?php echo $game['cz_rewards_num']; ?>%</em></p>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <!--招募满-->
                        <div class="cont clearfix">
                            <div class="tit_2">
                                <span class="sp_1_1">招募满的试玩</span>
                                <span class="sp_2">&nbsp;|&nbsp;需要的玩家已招满，但体验时间未到的试玩</span>
                            </div>
                            <ul class="ul_2 clearfix">
                                <?php
                                foreach ($game_info as $game) {
                                    $num = Gamezm::model()->count("gid =:gid", array('gid' => $game['id']));
                                    if (($game['recruit_num'] == $num && strtotime($game["end_time"]) > time()) || (!empty($game['zc_start']) && empty($game['game_start']) && strtotime($game["end_time"]) > time())) {
                                        ?> 
                                        <li>
									  <a class="a_1" href="<?php echo SITE_URL; ?>game/detail/id/<?php echo $game['id']; ?>" target="_blank" >
                                                <img  class="lazy" data-original="/uploads/img/game/<?php echo $game['img']; ?>" />
                                                <p class="p_1 clearfix">
                                                    <em class="em_1"><?php echo $game['name']; ?></em>
                                                    <i class="i_2">招募满</i>
                                                </p>
                                                <span class="bk"></span>
                                                <span class="ann">立即试玩</span>
                                                <?php if ($game['is_prefecture'] == 0) { ?>
                                                    <span class="sa service">
                                                        <?php echo "冲级赛"; ?>
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
                                                    <?php } else if ($game['is_timely'] == 1) { ?>
                                                        <i class="btm_i_2">
                                                            <?php echo "续"; ?>
                                                        </i>
                                                    <?php } ?>
                                                   <?php if ($game['bustype'] == 12) { ?>
                                                     <span class="btm_span_1"></span>
                                             <?php } else if($game['bustype']!=12) { ?>
                                                      <span class="btm_span_1">参与人数：<em><?php
                                                             echo $num * $game["gamezmbs"];
                                                            ?></em></span>  <?php } ?>
                                                </span> 
                                            </a>
                                            <p class="p_2">每人奖励：<em><?php
                                                    if (!empty($game->impactmax)) {
                                                        $impactmax = $game["impactmax"];
                                                    } else {
                                                        $impactmax = $gameimpact_model->countBySql("select hlb FROM {{game_impact}} where game_id=" . $game["id"] . " order by rank limit 1");
                                                    }
                                                    $gradenum = $gamegrade_model->countBySql("select sum(hlb) FROM {{game_grade}} where game_id=" . $game["id"]);
                                                    echo number_format(strval((intval($impactmax) + intval($gradenum))));
                                                    ?></em>
                                            </p>
                                            <p class="p_3">充值返利：<em class="<?php
                                                if (empty($game['cz_rewards_num'])) {
                                                    echo "no";
                                                }
                                                ?>"><?php echo $game['cz_rewards_num']; ?>%</em></p>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <!--已结束-->
                        <div class="cont clearfix">
                            <div class="tit_2">
                                <span class="sp_1_2">已结束的试玩</span>
                                <span class="sp_2">&nbsp;|&nbsp;体验已到期，处于领奖期的试玩</span>
                            </div>
                            <ul class="ul_2 clearfix">
                                <?php
                                foreach ($game_info as $game) {
                                    if (strtotime($game['end_time']) < time() || !empty($game['game_start'])) {
                                        ?>  
                                        <li>
                                            <a class="a_1" href="<?php echo SITE_URL; ?>game/detail/id/<?php echo $game['id']; ?>" target="_blank" >
                                                <img  class="lazy over" id="over" data-original="/uploads/img/game/<?php echo $game['img']; ?>" />
                                                <p class="p_1 clearfix">
                                                    <em class="em_1"><?php echo $game['name']; ?></em>
                                                    <i class="i_3">已结束</i>
                                                </p>
                                            </a>
                                            <p class="p_2">每人奖励：<em><?php
                                                    if (!empty($game->impactmax)) {
                                                        $impactmax = $game["impactmax"];
                                                    } else {
                                                        $impactmax = $gameimpact_model->countBySql("select hlb FROM {{game_impact}} where game_id=" . $game["id"] . " order by rank limit 1");
                                                    }
                                                    $gradenum = $gamegrade_model->countBySql("select sum(hlb) FROM {{game_grade}} where game_id=" . $game["id"]);
                                                    echo number_format(strval((intval($impactmax) + intval($gradenum))));
                                                    ?></em></p>
                                            <p class="p_3">充值返利：
                                                <em class="<?php
                                                                    if (empty($game['cz_rewards_num'])) {
                                                                        echo "no";
                                                                    }
                                                                    ?>">
                                                    <?php echo $game['cz_rewards_num']; ?>%
                                                </em>
                                            </p>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php include_once("right.php") ?>
        </div>
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
    </body>
</html>
