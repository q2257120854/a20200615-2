<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>个人中心—账户明细—元宝明细-<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="<?php echo TIT; ?>,玩宝,免费奖品,网赚,免费Q币,赚Q币,试玩,网络兼职"/>
        <meta name="description" content="<?php echo TIT; ?>是一个玩试玩元宝，购物赚元宝，打码赚元宝，兑换各种奖品的娱乐平台，通过引进各种有奖试玩和娱乐项目，使用户在、试玩平台、参与互动广告、打码平台中获得免费金豆—元宝，元宝可以换取Q币、话费、笔记本等丰富的奖品，同时也为商家提供了真实有效的用户群体。"/>
        <link rel="shortcut icon" href="Favicon.ico" type="image/x-icon"/>
        <link href="/style/vip/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/vip/inside.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/vip/jQuery.v1.8.3.js"></script>
        <script src="/scripts/vip/public.js"></script>
        <script src="/scripts/vip/laydate.js"></script>
        <style type="text/css">
            .hover2{border-top:4px solid #70a0f1; height:36px; line-height:36px; background:#4b6289;}
            .hover20{background: url("<?php echo IMG_URL ?>vip/img/public_db _menu_left _j.png") no-repeat scroll right center #fff; color: #cc3d12;width: 171px;}
        </style>
    </head>
    <body>
        <!--头部-->
        <?php include_once("./protected/views/vipdesign/header.php") ?>
        <!--主体-->
        <div class="main clearfix">
            <?php include_once("./protected/views/vipdesign/navicat.php") ?>
            <div class="public_db clearfix">
                <!--左菜单-->
                <?php include_once("left.php") ?>
                <?php $data = $pages->params['data']; ?>
                <!--右内容-->
                <div class="cont prizes">
                    <form id="selfrom" method="get" action="<?php echo SITE_URL ?>viptrade/gold/data/<?php echo $data; ?>">
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
                                <a href="<?php echo SITE_URL ?>viptrade/gold/data/<?php echo $pages->params['data']; ?>/time/1" >今天</a>
                                <a href="<?php echo SITE_URL ?>viptrade/gold/data/<?php echo $pages->params['data']; ?>/time/7" >最近7天</a>
                                <a href="<?php echo SITE_URL ?>viptrade/gold/data/<?php echo $pages->params['data']; ?>/time/30" >最近30天</a>
                                <a href="<?php echo SITE_URL ?>viptrade/gold/data/<?php echo $pages->params['data']; ?>/time/90" >最近3个月</a>
                            </div>
                        </div>
                        <!--切换-->
                        <div class="switch clearfix">
                            <ul class="ul_2 clearfix">
                                <li <?php
                                if ($data == 0) {
                                    echo "class='hover'";
                                }
                                ?> style=" border-left:1px solid #bdbcbd;"><a href="<?php echo SITE_URL ?>viptrade/gold/data/0" >全部</a></li>
                                <li <?php
                                if ($data == 1) {
                                    echo "class='hover'";
                                }
                                ?>><a href="<?php echo SITE_URL ?>viptrade/gold/data/1" >收入明细</a></li>
                                <li <?php
                                if ($data == 2) {
                                    echo "class='hover'";
                                }
                                ?>><a href="<?php echo SITE_URL ?>viptrade/gold/data/2" >支出明细</a></li>
                            </ul>
                        </div>
                    </form>
                    <!--表格-->
                    <table class="table_2" width="100%" border="1">
                        <tr class="tit">
                            <th>发生原因</th>
                            <th>元宝变化</th>
                            <th>发生时间</th>
                        </tr>
                        <?php
                        foreach ($posts as $model) {
                            ?>
                            <tr>
                                <td align="center" valign="middle"><?php echo $model['reason']; ?></td>
                                <td align="center" valign="middle"><span class="bi"><?php echo number_format($model['hlb']); ?></span></td>
                                <td align="center" valign="middle"><?php echo $model['create_time']; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                    <br/>
                    <div class="sx_page clearfix"  style="text-align: center;height: 30px;">
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
        <?php include_once("./protected/views/vipdesign/footer.php") ?>
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
