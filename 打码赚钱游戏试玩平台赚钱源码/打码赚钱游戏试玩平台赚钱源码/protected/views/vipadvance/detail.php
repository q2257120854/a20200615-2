<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>个人中心—提现管理-提现明细—<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="/" />
        <meta name="description" content="/" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/vip/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/vip/inside.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/vip/jQuery.v1.8.3.js"></script>
        <script src="/scripts/vip/public.js"></script>
        <style type="text/css">
            .hover3{border-top:4px solid #70a0f1; height:36px; line-height:36px; background:#4b6289;}
            .hover22{background: url("<?php echo IMG_URL ?>vip/img/public_db _menu_left _j.png") no-repeat scroll right center #fff; color: #cc3d12;width: 171px;}
        </style>
    </head>
    <body>
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
                    <div class="tit">
                        <p class="p_1">
                            <span>您当前已累计提现：</span>
                            <i>
                                <?php
                                $tx_money = Tx::model()->countBySql("select sum(money) from {{tx}} where mem_id=" . $mem['id'] . " and starts='已支付' ");
                                if (empty($tx_money)) {
                                    echo "0";
                                } else {
                                    echo $tx_money;
                                }
                                ?>￥
                            </i>
                            <span class="zhu">（欢迎使用、提现系统，提现不可累计提交，一般支付不超过24小时）</span>
                        </p>
                    </div>
                    <!--表格-->
                    <div class="biao_1">
                        <table class="table_1" width="100%" border="1">
                            <tr>
                                <th>收款账号</th>
                                <th>收款人</th>
                                <th>申请金额</th>
                                <th>奖励</th>
                                <th>手续费</th>
                                <th>实付金额</th>
                                <th>申请时间</th>
                                <th>处理时间</th>
                                <th>状态</th>
                            </tr>
                            <?php foreach ($posts as $model) { ?>
                                <tr>
                                    <td align="center" valign="middle"><?php echo $model['account'] ?></td>
                                    <td align="center" valign="middle"><?php echo $model['name'] ?></td>
                                    <td align="center" valign="middle"><span class="lv"><?php echo $model['applymoney']; ?>元</span></td>
                                    <td align="center" valign="middle"><span class="lv"><?php echo $model['rewards']; ?>元</span></td>
                                    <td align="center" valign="middle"><span class="lv"><?php echo $model['fee']; ?>元</span></td>
                                    <td align="center" valign="middle"><span class="lv"><?php echo $model['money']; ?>元</span></td>
                                    <td align="center" valign="middle"><?php echo $model['create_time'] ?></td>
                                    <td align="center" valign="middle"><?php
                                        if ($model['cl_time'] == "0000-00-00 00:00:00") {
                                            echo "--";
                                        } else {
                                            echo $model['cl_time'];
                                        }
                                        ?></td>
                                    <td align="center" valign="middle">
                                        <?php if ($model['starts'] == "待支付") { ?>
                                            <i>待支付</i>
                                        <?php } else if ($model['starts'] == "已支付") { ?>
                                            <i class="z"><?php echo $model['starts']; ?></i>
                                        <?php } else if ($model['starts'] == "已拒绝") { ?>
                                            <i class="j"><?php echo $model['starts']; ?></i>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <br/>
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
        <?php include_once("./protected/views/vipdesign/footer.php"); ?>
        <?php include_once("./protected/views/vipdesign/kefu.php") ?>
    </body>
</html>
