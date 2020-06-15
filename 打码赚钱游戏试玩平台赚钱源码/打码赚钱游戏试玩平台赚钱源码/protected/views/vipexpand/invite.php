<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>个人中心—推广管理—推广福利—<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="/" />
        <meta name="description" content="/" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/vip/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/vip/inside.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/vip/jQuery.v1.8.3.js"></script>
        <script src="/scripts/vip/public.js"></script>
        <script src="/scripts/vip/laydate.js"></script>

        <style type="text/css">
            .hover5{border-top:4px solid #70a0f1; height:36px; line-height:36px; background:#4b6289;}
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
                    <form id="selfrom" method="get" action="<?php echo SITE_URL ?>vipexpand/friend/type/<?php echo $type; ?>">
                        <!--标题注释-->
                        <div class="tit">
                            <p class="p_1">
                                <span class="zhu_1">邀请好友来玩、一样可以赚钱，您将获得以下元宝福利哦！</span>
                            </p>
                        </div>
                        <!--起始时间选择-->
                        <div class="demo3 clearfix">
                            <ul class="inline clearfix">
                                <span>起始时间：</span>
                                <input type="text" class="inline laydate-icon" id="start" name="start" value="<?php echo $pages->params['start']; ?>"/>
                                <span>至：</span>
                                <input type="text" class="inline laydate-icon" id="end" name="end"  value="<?php echo $pages->params['end']; ?>"/>
                            </ul>
                            <a href="javascript:document.getElementById('selfrom').submit();" class="button_1 ann_1">查询</a>
                            <div class="xuanz">
                                <a href="<?php echo SITE_URL ?>vipexpand/invite/time/1" >今天</a>
                                <a href="<?php echo SITE_URL ?>vipexpand/invite/time/7" >最近7天</a>
                                <a href="<?php echo SITE_URL ?>vipexpand/invite/time/30" >最近30天</a>
                                <a href="<?php echo SITE_URL ?>vipexpand/invite/time/90" >最近3个月</a>
                            </div>
                        </div>
                    </form>
                    <!--切换-->
                    <div class="switch clearfix">
                        <ul class="ul_2 clearfix">
                            <li class="hover" style=" border-left:1px solid #bdbcbd;">A.提现奖励</li>
                            <li>B.提成奖励</li>
                        </ul>
                    </div>
                    <!--表格-->
                    <table class="table_2" width="100%" border="1">
                        <tr class="tit">
                            <th>累计提现奖励</th>
                            <th>一级好友</th>
                            <th>二级好友</th>
                            <th>三级好友</th>
                            <th>四级好友</th>
                        </tr>
                        <tr>
                            <td align="center" valign="middle">满10元</td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle">满10元</td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle">满10元</td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle">满10元</td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle">满10元</td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle">满10元</td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle">满10元</td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle">满10元</td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle">满10元</td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle">满10元</td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                            <td align="center" valign="middle"><span class="bi">8000</span></td>
                        </tr>
                    </table>
                    <!--上一页、下一页-->
                    <div class="sx_page clearfix">	
                        <a href="javascript:">尾页</a>
                        <a href="javascript:">下一页</a>
                        <a href="javascript:" class="hover">1</a>
                        <a href="javascript:" >2</a>
                        <a href="javascript:" >3</a>
                        <a href="javascript:" >4</a>
                        <a href="javascript:" >5</a>
                        <a href="javascript:" class="dian">...</a>
                        <a href="javascript:" class="end">上一页</a>
                        <a href="javascript:">首页</a>    
                    </div>
                </div>
            </div>
            <!--广告图-->
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
