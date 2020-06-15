<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>我的试玩体验—任务管理—个人中心-<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="/"/>
        <meta name="description" content="/"/>
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon" />
        <link href="/style/vip/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/vip/inside.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/vip/jQuery.v1.8.3.js"></script>
        <script src="/scripts/vip/public.js"></script>
        <style type="text/css">
            .hover4{border-top:4px solid #70a0f1; height:36px; line-height:36px; background:#4b6289;}
            .hover20{background: url("<?php echo IMG_URL ?>vip/img/public_db _menu_left _j.png") no-repeat scroll right center #fff; color: #cc3d12;width: 171px;}
            div .errorMessage{color:red;}
        </style>
    </head>
    <body>
        <?php $type = $pages->params['type']; ?>
        <!--头部-->
        <?php include_once("./protected/views/vipdesign/header.php") ?>
        <!--主体-->
        <div class="main clearfix">
            <!--导航-->
            <?php include_once("./protected/views/vipdesign/navicat.php") ?>
            <div class="public_db clearfix">
                <!--左菜单-->
                <?php include_once("left.php") ?>
                <!--右内容-->
                <div class="cont prizes">
                    <!--切换-->
                    <div class="switch clearfix" style=" margin-top:20px;">
                        <ul class="ul_2 clearfix">
                            <li class="<?php
                            if (empty($type)) {
                                echo "hover";
                            }
                            ?>" style="border-left:1px solid #bdbcbd;"><a href="<?php echo SITE_URL; ?>viptask/game/type/0">我已经参与的试玩</a></li>
                            <li class="<?php
                            if ($type == 1) {
                                echo "hover";
                            }
                            ?>" style="border-left:1px solid #bdbcbd;"><a href="<?php echo SITE_URL; ?>viptask/game/type/1">我还未参加的试玩
                                    <i>
                                        <?php
                                        echo "(" . $count . ")";
                                        ?>
                                    </i>
                                </a>
                            </li>
                        </ul>
                        <span class="shi">您每一次试玩体验，都促进了互联网体验试玩事业的进步与发展，感谢参与</span>
                    </div>
                    <!--表格-->
                    <div class="biao_1">
                        <table class="table_1" width="100%" border="1">
                            <?php if ($type == 1) { ?>
                                <tr>
                                    <th>试玩名称</th>
                                    <th>奖励元宝</th>
                                    <th>上线日期</th>
                                    <th>下线日期</th>
                                    <th>游戏状态</th>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <th>试玩名称</th>
                                    <th>试玩账号</th>
                                    <th>获得奖励</th>
                                    <th>试玩结束日期</th>
                                    <th>游戏状态</th>
                                </tr>
                            <?php } ?>
                            <?php
                            $game_model = Game::model();
                            $gamegradedata_model=Gamegradedata::model();
                            foreach ($posts as $model) {  //还未试玩游戏
                                if ($type == 1) {
                                    ?>
                                    <tr>
                                        <td align="center" valign="middle"><?php echo $model["name"]; ?></td>
                                        <td align="center" valign="middle">
                                            <span class="bi">
                                                <?php
                                                $impactnum = Gameimpact::model()->countBySql("select hlb FROM {{game_impact}} where game_id=" . $model["id"] . " order by rank limit 1");
                                                $gradenum = Gamegrade::model()->countBySql("select sum(hlb) FROM {{game_grade}} where game_id=" . $model["id"]);
                                                echo number_format(strval((intval($impactnum) + intval($gradenum))));
                                                ?>
                                            </span>
                                        </td>
                                        <td align="center" valign="middle"><?php echo $model["begin_time"]; ?></td>
                                        <td align="center" valign="middle"><?php echo $model["end_time"]; ?></td>
                                        <td align="center" valign="middle">
                                            <?php if (strtotime($model["end_time"]) > time()) {//游戏结束时间  ?>
                                                <i class="z" ><a href="<?php echo SITE_URL ?>game/detail/id/<?php echo $model["id"]; ?>" target="_black">进行中</a></i>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                } else { //已经试玩游戏
                                    ?>
                                    <tr>
                                        <td align="center" valign="middle">
                                            <?php
                                            $game_info = $game_model->findByPk($model["gid"]);
                                            echo $game_info["name"];
                                            ?> 
                                        </td>
                                        <td align="center" valign="middle"><?php echo $model["username"]; ?></td>
                                        <td align="center" valign="middle">
                                            <span class="bi">
                                                <?php
                                                 $gamedata_info =  $gamegradedata_model ->countBySql("select sum(hlb)     from {{game_gradedata}} where mem_id=" . $mem["id"] . " and game_id=" . $model["gid"]);
                                                echo number_format(intval($gamedata_info));      
                                                ?>
                                            </span>
                                        </td>
                                        <td align="center" valign="middle"><?php echo $game_info["end_time"]; ?></td>
                                        <td align="center" valign="middle">
                                            <?php if (strtotime($game_info["end_time"]) > time()) { //游戏结束时间       ?>
                                                <i class="z"><a href="<?php echo SITE_URL ?>game/detail/id/<?php echo $model["gid"]; ?>"  target="_black">进行中</a></i>
                                            <?php } else { ?>
                                                <i class="w">已结束</i>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                    <br/>
                    <div  style="text-align: center;height: 30px;">
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
            <?php
            if (!empty($ad_info)) {
                foreach ($ad_info as $ad) {
                    ?>
                    <a class="advertising_1" href="<?php echo $ad['url']; ?>">
                        <img src="/uploads/img/ad/<?php echo $ad['img']; ?>">
                    </a>
                    <?php
                }
            }
            ?>
        </div>
        <!--底部1-->
        <?php include_once("./protected/views/vipdesign/footer.php"); ?>
        <?php include_once("./protected/views/vipdesign/kefu.php") ?>
    </body>
</html>
