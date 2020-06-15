<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>兑奖管理—兑奖明细—<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="手机充值卡,Q币,手机,笔记本,相机,数码产品,生活用品,免费奖品" />
        <meta name="description" content="<?php echo TIT; ?>兑奖商场是柿子赚到元宝 后兑换奖品的地方，柿子通过玩网页试玩、棋牌试玩体验广告、网购等赚取元宝 ，通过积累一定的元宝 ，可以兑换虚拟奖品，如Q币，手机充值卡等，也可以兑换实物大奖，如数码产品、手机、笔记本以及生活用品、吃喝玩乐用品等等。" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/vip/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/vip/inside.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/vip/jQuery.v1.8.3.js"></script>
        <script src="/scripts/vip/public.js"></script>
        <script src="/scripts/vip/laydate.js"></script>
        <style type="text/css">
            .hover6{border-top:4px solid #70a0f1; height:36px; line-height:36px; background:#4b6289;}
            .hover20{background: url("<?php echo IMG_URL ?>vip/img/public_db _menu_left _j.png") no-repeat scroll right center #fff; color: #cc3d12;width: 171px;}
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
                    <!--标题注释-->
                    <div class="tit">
                        <p class="p_1">
                            <span class="zhu_1">虚拟物品请直接打开“消息中心”查看卡号和卡密</span>
                        </p>
                    </div>
                    <form id="selfrom" method="get" action="<?php echo SITE_URL ?>vipexpiry/show">
                        <!--起始时间选择-->
                        <div class="demo3 clearfix">
                            <ul class="inline clearfix">
                                <span>起始时间：</span>
                                <input type="text" class="inline laydate-icon" id="start" name="start" value="<?php echo $pages->params['start']; ?>"/>
                                <span>至：</span>
                                <input type="text" class="inline laydate-icon" id="end" name="end"  value="<?php echo $pages->params['end']; ?>"/>
                            </ul>
                            <a href="javascript:document.getElementById('selfrom').submit();"   class="button_1 ann_1">查询</a>
                            <div class="xuanz">
                                <a href="<?php echo SITE_URL ?>vipexpiry/show/time/1" >今天</a>
                                <a href="<?php echo SITE_URL ?>vipexpiry/show/time/7" >最近7天</a>
                                <a href="<?php echo SITE_URL ?>vipexpiry/show/time/30" >最近30天</a>
                                <a href="<?php echo SITE_URL ?>vipexpiry/show/time/90" >最近3个月</a>
                            </div>
                        </div>
                    </form>
                    <!--表格-->
                    <table class="table_1" width="100%" border="1">
                        <tr>
                            <th>奖品名称</th>
                            <th>所用金豆</th>
                            <th>兑奖时间</th>
                            <th>收货人</th>
                            <th>状态</th>
                        </tr>
                        <?php
                        foreach ($posts as $model) {
                            ?>
                            <tr>
                                <td align="center" valign="middle"><?php echo $model['name']; ?></td>
                                <td align="center" valign="middle"><span class="dd"><?php echo number_format(intval($model['hld'])); ?></span></td>
                                <td align="center" valign="middle"><?php echo $model['create_time']; ?></td>
                                <td align="center" valign="middle"><span class="blue"><?php echo $model['consignee']; ?></span></td>
                                <td align="center" valign="middle"><?php
                                    if ($model['starts'] == "已兑换") {
                                        echo "<span class='z'>已兑换</span>";
                                    } else if ($model['starts'] == "已拒绝") {
                                        echo "<span class='j'>已拒绝</span>";
                                    } else {
                                        echo "兑换中";
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <br/>
                    <div  class="sx_page clearfix"  style="text-align: center;height: 30px;">
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
            <!--广告-->
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
        <!--加载时间日期选择-->
        <script>
            !function() {
                laydate({elem: '#demo3'});//绑定元素
            }();
            //日期范围限制
            var start = {
                elem: '#start',
                format: 'YYYY-MM-DD',
                max: '2099-06-16', //最大日期
                istime: true,
                istoday: false,
                choose: function(datas) {
                    end.min = datas; //开始日选好后，重置结束日的最小日期
                    end.start = datas //将结束日的初始值设定为开始日
                }
            };
            var end = {
                elem: '#end',
                format: 'YYYY-MM-DD',
                min: laydate.now(),
                max: '2099-06-16',
                istime: true,
                istoday: false,
                choose: function(datas) {
                    start.max = datas; //结束日选好后，充值开始日的最大日期
                }
            };
            laydate(start);
            laydate(end);
        </script>
    </body>
</html>
