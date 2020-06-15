<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>我的打码记录—任务管理—个人中心-<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="/" />
        <meta name="description" content="/" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon" />
        <link href="/style/vip/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/vip/inside.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/vip/jQuery.v1.8.3.js"></script>
        <script src="/scripts/vip/public.js"></script>
        <style type="text/css">
            .hover4{border-top:4px solid #70a0f1; height:36px; line-height:36px; background:#4b6289;}
            .hover22{background: url("<?php echo IMG_URL ?>vip/img/public_db _menu_left _j.png") no-repeat scroll right center #fff; color: #cc3d12;width: 171px;}
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
                            ?>" style="border-left:1px solid #bdbcbd;"><a href="<?php echo SITE_URL; ?>viptask/captcha/type/0">我已经进行的打码</a></li>
                            <li class="<?php
                            if ($type == 1) {
                                echo "hover";
                            }
                            ?>" style="border-left:1px solid #bdbcbd;"><a href="<?php echo SITE_URL; ?>viptask/captcha/type/1">我还未开始的打码
                                    <i>
                                        <?php
                                        echo "(" . $count . ")";
                                        ?>
                                    </i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--表格-->
                    <div class="biao_1">
                        <table class="table_1" width="100%" border="1">
                            <?php if ($type == 1) { ?>
                                <tr>
                                    <th>任务名称</th>
                                    <th>码值</th>
                                    <th>是否换ip</th>
                                    <th>结算周期</th>
                                    <th>任务资源</th>
                                    <th>更新时间</th>
                                    <th>参与任务</th>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <th>任务名称</th>
                                    <th>工号</th>
                                    <th>密码</th>
                                    <th>码值</th>
                                    <th>总数量</th>
                                    <th>获得奖励</th>
                                    <th>项目状态</th>
                                </tr>
                            <?php } ?>
                            <?php
                            foreach ($posts as $model) {  //还未打码的任务
                                if ($type == 1) {
                                    ?>
                                    <tr>
                                        <td align="center" valign="middle"><span class="lv"><?php echo $model["name"]; ?></span></td>
                                        <td align="center" valign="middle">
                                            <span class="bi">
                                                <?php echo $model["code_val"]; ?>
                                            </span>
                                        </td>
                                        <td align="center" valign="middle">
                                            <?php
                                            if (empty($model["ip"])) {
                                                echo "否";
                                            } else if ($model["ip"] == 1) {
                                                echo "是";
                                            } else {
                                                echo "否";
                                            }
                                            ?>
                                        </td>
                                        <td align="center" valign="middle"><?php echo $model['jiesuan']; ?></td>
                                        <td align="center" valign="middle">
                                            <?php
                                            if (empty($model['resource'])) {
                                                echo "充足";
                                            } else {
                                                echo "不充足";
                                            }
                                            ?>
                                        </td>
                                        <td align="center" valign="middle">
                                            <?php
                                            if (empty($info['update_time'])) {
                                                ?>
                                                <span class="no"><?php echo date("Y-m-d", strtotime($model['create_time'])); ?></span>
                                            <?php } else { ?>
                                                <span><?php echo date("Y-m-d", strtotime($model['update_time'])); ?></span>
                                            <?php } ?>
                                        </td>
                                        <td align="center" valign="middle">
                                            <i class="z">
                                                <a href="<?php echo SITE_URL ?>captcha/detail/id/<?php echo $model['id']; ?>">参与任务 <i>></i></a>
                                            </i>
                                        </td>
                                    </tr>
                                    <?php
                                } else { //已经打码的任务
                                    ?>
                                    <tr>
                                        <td align="center" valign="middle">
                                            <span class="lv">
                                                <?php
                                                $captcha_info = Captcha::model()->findByPk($model["captcha_id"]);
                                                echo $captcha_info["name"];
                                                ?>
                                            </span>
                                        </td>
                                        <td align="center" valign="middle">
                                            <?php echo $model["username"]; ?>
                                        </td>
                                        <td align="center" valign="middle">123456</td>
                                        <td align="center" valign="middle">
                                            <span class="bi">
                                                <?php echo $captcha_info["code_val"]; ?>
                                            </span>
                                        </td>
                                        <td align="center" valign="middle">
                                            <?php
                                            $hlb = Captchadata::model()->countBySql("select SUM(num) as hlb from {{captcha_data}} where mem_id=" . $mem["id"] . " and captcha_id=" . $model["captcha_id"]);
                                            echo intval($hlb);
                                            ?>
                                        </td>
                                        <td align="center" valign="middle">
                                            <span class="bi"><?php
                                                $hlb1 = Captchadata::model()->countBySql("select SUM(rewards_hlb) as hlb from {{captcha_data}} where mem_id=" . $mem["id"] . " and captcha_id=" . $model["captcha_id"]);
                                                echo intval($hlb1);
                                                ?>
                                            </span>
                                        </td>
                                        <td align="center" valign="middle">
                                            <i class="z"><a href="<?php echo SITE_URL ?>captcha/detail/id/<?php echo $model["captcha_id"]; ?>">进行中</a></i>
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
                    <!--广告图-->
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
