<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
    <title><?php echo $conf['sitename'] ?> - <?php echo $conf['title'] ?></title>
    <meta name="keywords" content="<?php echo $conf['keywords'] ?>">
    <meta name="description" content="<?php echo $conf['description'] ?>">
    <link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo $cdnserver ?>assets/simple/css/plugins.css">
    <link rel="stylesheet" href="<?php echo $cdnserver ?>assets/simple/css/oneui.css">
    <script src="//lib.baomitu.com/modernizr/2.8.3/modernizr.min.js"></script>
    <!--[if lt IE 9]>
    <script src="//lib.baomitu.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//lib.baomitu.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--动态背景-->
    <style>
        body {
            background-image: url(<?php echo $background_image?>);
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .input-group-addon {
            background: linear-gradient(to right, pink, #ffb6c1, #ffb6c1, #ffb6c1);
        }

        .onclick {
            cursor: pointer;
            touch-action: manipulation;
        }

        .giftlist {
            overflow: hidden;
            width: 90%;
            margin: 0 auto
        }

        .giftlist ul {
            height: 270px;
            overflow: hidden;
            padding: 0
        }

        .giftlist li {
            width: 100%;
            line-height: 35px;
            padding: 0 10px;
            overflow: hidden;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box
        }

        .giftlist li strong {
            margin: 0 5px 0 0;
            font-weight: 400;
            color: #1977d8
        }
    </style>
</head>
<body>
<!--动态背景-->
<div class="modal fade" align="left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><b><font color="#E00000">查</font><font
                                color="#D1000F">看</font><font color="#C2001E">以</font><font
                                color="#B3002D">下</font><font color="#A4003C">帮</font><font
                                color="#95004B">助</font><font color="#86005A"> </font><font
                                color="#770069"><br></font><font color="#680078"> </font><font
                                color="#590087">是</font><font color="#4A0096">否</font><font
                                color="#3B00A5">需</font><font color="#2C00B4">要</font><font
                                color="#1D00C3">联</font><font color="#0E00D2">系</font><font
                                color="#0000E1">客</font><font color="#0000F0">服</font></b></h4>
            </div>
            <div class="modal-body">
                <?php echo $conf['anounce'] ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">朕知道了！</button>
            </div>
        </div>
    </div>
</div>
<br/>
<br/>
<!--弹出公告-->
<div class="modal fade" align="left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header-tabs">
                <h4 class="modal-title" style="display:none;" id="myModalLabel">网站公告</h4>
            </div>
            <div class="modal-body">
                <?php echo $conf['modal'] ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">朕知道了</button>
            </div>
        </div>
    </div>
</div>
<!--弹出公告-->
<!--新人必看-->
<div class="modal fade" id="mustsee" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary-dark">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><span a="true">X</span></button>
                        </li>
                    </ul>
                    <h4 class="block-title">新人必看</h4>
                </div>
                <div class="modal-body">
                    <?php echo $conf['anounce'] ?>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<!--新人必看-->
<!--客服-->
<div class="modal fade" id="kefu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary-dark">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><span a="true"><i
                                            class="fa  fa-times-circle"></i></span></button>
                        </li>
                    </ul>
                    <h4 class="block-title">客服列表</h4>
                </div>
                <div class="modal-body">
                    <a class="block block-rounded block-link-hover3"
                       href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']; ?>&site=qq&menu=yes">
                        <div class="block-content block-content-full clearfix">
                            <div class="pull-right">
                                <img class="img-avatar"
                                     src="http://q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']; ?>&spec=100">
                            </div>
                            <div class="pull-left push-10-t">
                                <div class="font-w600 push-5"><strong>本站站长QQ <i
                                                class="fa fa-qq text-info"></i> <?php echo $conf['kfqq']; ?></strong>
                                </div>
                                <script>var online = new Array();</script>
                                <script>
                                    if (online[0] == 0)
                                        document.write("离线,有事请留言！");
                                    else
                                        document.write("在线,有事请直说！");
                                </script>
                            </div>
                        </div>
                    </a>
                    <a class="block block-rounded block-link-hover3"
                       href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']; ?>&site=qq&menu=yes">
                        <div class="block-content block-content-full clearfix">
                            <div class="text-right pull-right push-10-t">
                                <div class="font-w600 push-5"><strong>订单售后客服 <i
                                                class="fa fa-qq text-danger"></i><?php echo $conf['kfqq']; ?></strong>
                                </div>
                                <script>var online = new Array();</script>
                                <script>
                                    if (online[0] == 0)
                                        document.write("离线,有事请留言！");
                                    else
                                        document.write("在线,有事请直说！");
                                </script>
                            </div>
                            <div class="pull-left">
                                <img class="img-avatar"
                                     src="http://q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']; ?>&spec=100">
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="modal-footer">
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>

</div>
<!--客服-->
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-4 center-block" style="float: none;">
    <div class="widget">
        <!--顶部导航-->
        <div class="block block-link-hover3" href="javascript:void(0)">
            <div class="block-content block-content-full text-center "
                 style="background-image: url('assets/xiaoxuan/bj_1.jpg'); background-size:100% 100%;">
                <div>
                    <div>
                        <img class="img-avatar img-avatar80 img-avatar-thumb animated zoomInDown"
                             src="http://q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']; ?>&spec=100">
                    </div>
                </div>
            </div>
            <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                <div class="widget-content themed-background-muted text-center ">
                    <div class="btn-group themed-background-muted">
                        <div class="btn-group btn-group-justified">

                            <a class="btn btn-default"
                               style="background: linear-gradient(to right,pink ,#FFFFFF,#FFFFFF,#FFFFFF);"
                               data-toggle="modal" href="#myModal"><i class="glyphicon glyphicon-bullhorn"></i> 售后公告</a>

                            <a style="background: linear-gradient(to right,pink ,#FFFFFF,#FFFFFF,#FFFFFF);"
                               class="btn btn-default"
                               href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq'] ?>&site=qq&menu=yes"><i
                                        class="fa fa-file"></i> 在线客服</a>
                            <a class="btn btn-default"
                               style="background: linear-gradient(to right,pink,#FFFFFF,#FFFFFF,#FFFFFF);"
                               data-toggle="modal" href="/?mod=articlelist"><font color="#FF0000"><i
                                            class="fa fa-gift fa-fw"></i>重要通知</font></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--顶部导航-->
    <?php
    //经典模式
    $rs           = $DB->select('class', '*', ['active' => 1, 'ORDER' => ['sort' => 'ASC']]);
    $select       = '<option value="0">请选择分类</option>';
    $select_count = 0;
    foreach ($rs as $content) {
        $select_count++;
        $select .= '<option value="' . $content['cid'] . '">' . $content['name'] . '</option>';
    }
    if ($select_count == 0)
        $classhide = true;
    ?>
    <div class="block full2">
        <!--TAB标签-->
        <div class="block-title">

            <ul class="nav nav-tabs" data-toggle="tabs"
                style="background: linear-gradient(to right,pink ,#ffb6c1,#ffb6c1,#ffb6c1);">

                <li style="width: 25%;" align="center"><a href="#shop" data-toggle="tab"><span style="font-weight:bold"><font
                                    color="#000000"><i class="fa fa-shopping-bag fa-fw"></i> 下单</span></font></a></li>
                <li style="width: 25%;" align="center"><a href="#search" data-toggle="tab" id="tab-query"><span
                                style="font-weight:bold"><font color="#000000"><i
                                        class="fa fa-search"></i> 查单</span></font></a></li>
                <li style="width: 25%;" align="center"><a href="#ktfz" data-toggle="tab"><span style="font-weight:bold"><font
                                    color="#ff0000"><i class="fa fa-coffee fa-fw"></i> 加盟</span></font></a></li>
                <li style="width: 25%;" align="center"><a href="#more" data-toggle="tab"><span style="font-weight:bold"><font
                                    color="#000000"><i class="fa fa-gift fa-fw"></i> 更多</span></font></a></li>
            </ul>
            <!--TAB-->
        </div>
        <div class="block-content tab-content">


            <!--在线下单-->
            <div class="tab-pane fade fade-up active in" id="shop">
                <div class="form-group" id="display_selectclass">
                    <?php echo $conf['alert'] ?>
                    <div align="center" style="color:green;font-size: 3;" class="list-group-item reed"><img src="">
                        <font color="blue"></font><font color="red">业务图片</font> <a href="#shops"
                                                                                   data-toggle="tab">点击查看</a></div>

                    <hr>
                    <div class="form-group" id="display_searchBar" style="">

                        <div class="input-group">
                            <div class="input-group-addon">搜索商品</div>
                            <input type="text" id="searchkw" class="form-control"
                                   onkeydown="if(event.keyCode==13){$('#doSearch').click()}" placeholder="输入商品关键字 再回车"/>
                            <div class="input-group-addon"><span title="搜索" id="doSearch">搜索</span></div>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon">选择分类</div>
                        <select name="tid" id="cid" class="form-control"
                                style="color:#3B3B3B;"><?php echo $select ?></select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">选择商品</div>
                        <select name="tid" id="tid" class="form-control" onchange="getPoint();"
                                style="color:#3B3B3B;"><?php echo $select2 ?></select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">商品价格</div>
                        <input type="text" name="need" id="need" class="form-control" style="color:#3B3B3B;" disabled/>
                    </div>
                </div>
                <div class="form-group" id="display_left" style="display:none;">
                    <div class="input-group">
                        <div class="input-group-addon">库存数量</div>
                        <input type="text" name="leftcount" id="leftcount" class="form-control" style="color:#3B3B3B;"
                               disabled/>
                    </div>
                </div>
                <div class="form-group" id="display_num" style="display:none;">
                    <div class="input-group">
                        <div class="input-group-addon">下单份数</div>
                        <span class="input-group-btn"><input id="num_min" type="button" class="btn"
                                                             style="background: linear-gradient(to right,#EE82EE,#EE82EE);color:#fff;"
                                                             style="border-radius: 0px;" value="减"></span>
                        <input id="num" name="num" class="form-control" type="number" min="1" value="1"
                               style="color:#3B3B3B;"/>
                        <span class="input-group-btn" style="border-radius: 0px;"><input id="num_add" type="button"
                                                                                         class="btn"
                                                                                         style="background: linear-gradient(to right,pink ,#ffb6c1,#ffb6c1,#ffb6c1);color:#fff;"
                                                                                         value="加"></span>
                        <span class="input-group-btn"><a href="#1circles" target="_blank" data-toggle="modal"
                                                         class="btn btn-danger"><i
                                        class="fa fa-info-circle"></i></a></span>
                    </div>
                </div>
                <font color="red">小提示：购买前请您先看一下商品简介和下单要求。</font>
                <div id="inputsname" style="color:#3B3B3B;"></div>
                <div id="alert_frame" class="alert alert-success animation-pullUp"
                     style="display:none;font-weight: bold;background: linear-gradient(to right,pink ,#ffb6c1,#ffb6c1,#ffb6c1);"></div>

                <input type="submit" id="submit_buy" class="btn btn-block btn-rounded"
                       style="background: linear-gradient(to right,pink ,#ffb6c1,#ffb6c1,#ffb6c1);color:#fff;"
                       value="立即购买">
                <br/>
            </div>
            <!--在线下单-->
            <!--开通分站-->
            <div class="tab-pane fade fade-up" id="ktfz">
                <div class="block block-link-hover2 text-center">
                    <div class="block-content block-content-full bg-success"
                         style="background: linear-gradient(to right,pink ,#ffb6c1,#ffb6c1,#ffb6c1);color:#fff;">
                        <div class="h4 font-w700 text-white push-10"><i
                                    class="fa fa-cny fa-fw"></i><strong><?php echo $conf['fenzhan_price'] ?>元</strong> /
                            <i
                                    class="fa fa-cny fa-fw"></i><strong><?php echo $conf['fenzhan_price2'] ?>元</strong>
                        </div>
                        <div class="h5 font-w300 text-white-op">普及版 / 专业版两种分站供你选择</div>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-condensed">
                            <tbody>
                            <tr>
                                <td>无聊时可以赚点零花钱</td>
                            </tr>
                            <tr>
                                <td>还可以锻炼自己销售口才</td>
                            </tr>
                            <tr>
                                <td>宝妈、学生等网络兼职首选</td>
                            </tr>
                            <tr>
                                <td>分站满<?php echo $conf['tixian_min']; ?>元即可申请提现</td>
                            </tr>
                            <tr>
                                <td><strong>轻轻松松推广日赚100+不是梦</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                        <a href="#userjs" data-toggle="modal" class="btn"
                           style="background: linear-gradient(to right,#3B3B3B,#3B3B3B);color:#fff;">版本介绍</a>
                        <button onclick="window.open('./user/regsite.php')" class="btn btn-danger">开通分站</button>
                    </div>
                </div>
            </div>
            <!--开通分站-->

            <div class="tab-pane" id="shops">
                <center>

                    <div class="row">
                        <div align="center" style="color:green;font-size: 3;" class="list-group-item reed"><img src="">
                            <a href="./">【返回目录】</a></div>
                        <br>
                        <?php
                        $rs = $DB->select('tjshop', '*', ['ORDER' => ['sort' => 'ASC']]);
                        foreach ($rs as $content) {
                            $rows = $DB->get('tools','*',['tid'=>$content['tid']]);
                            ?>
                            <div class="col-xs-6 col-sm-3 col-md-4 layui-anim layui-anim-scaleSpring"
                                 data-anim="layui-anim-upbit">
                                <a href="/?cid=<?php echo $rows['cid'] ?>&tid=<?php echo $rows['tid'] ?>">
                                    <div class="thumbnail" style="height:138px;">
                                        <center style="margin-top:5%;">
                                            <img src="<?php echo $rows['shopimg'] ?>" width="40" height="40"
                                                 style="border-radius: 10px">
                                            <hr class="layui-bg-blue" style="width:80%"><?php echo $content['name'] ?>
                                            <br>
                                            <font color="red">[立即购买]</font>
                                        </center>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </center>
            </div>
            <!--抽奖-->
            <div class="tab-pane" id="gift">
                <div class="panel-body text-center">
                    <div id="roll">点击下方按钮开始抽奖</div>
                    <hr>
                    <p>
                        <a class="btn btn-info" id="start" style="display:block;">开始抽奖</a>
                        <a class="btn btn-danger" id="stop" style="display:none;">停止</a>
                    </p>
                    <div id="result"></div>
                </div>
            </div>
            <!--抽奖-->
            <!--查询订单-->
            <div class="tab-pane" id="search">
                <div class="col-xs-12 well well-sm animation-pullUp">
                    <table class="table table-striped table-borderless table-vcenter remove-margin-bottom">
                        <tbody>
                        <tr class="animation-fadeInQuick2">
                            <td class="text-center" style="width: 100px;">
                                <img src="http://q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']; ?>&spec=100" alt="avatar"
                                     class="img-circle img-thumbnail img-thumbnail-avatar">
                            </td>
                            <td>
                                <h4><strong>售后客服</strong></h4>
                                <i class="gi gi-clock text-danger"></i> <br>
                                <i class="gi gi-chat text-success"></i>
                                <script>var online = new Array();</script>
                                <script src="http://webpresence.qq.com/getonline?Type=1&amp;123385570:"></script>
                                <script>
                                    if (online[24] == 8)
                                        document.write("");
                                    else
                                        document.write("");
                                </script>
                            </td>
                            <td class="text-right" style="width: 20%;">
                                <a href="#contact" target="_blank" data-toggle="modal"
                                   class="btn btn-sm btn-info">联系</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="col-xs-12 well well-sm">
                        <font color="#FF6347"><i class="fa fa-vimeo"></i></font> <font color="red">最新QQ客服：<?php echo $conf['kfqq']; ?> <br>
                        </font><br><font color="blue">查单教程：请输入下单填写的信息<br>（留空查询则根据浏览器缓存查询）</font><br/></div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <select class="form-control" id="searchtype" style="padding: 6px 4px;width:90px">
                                <option value="0">查询内容</option>
                            </select>
                        </div>
                        <input type="text" name="qq" id="qq3" value="<?php echo $qq ?>"
                               class="tooltip-show form-control" placeholder="请输入下单填写的信息（留空则根据浏览器缓存查询）"
                               data-toggle="tooltip" title="留空则查询最近购买的记录" required/>
                        <span class="input-group-btn"><a href="#cxsm" target="_blank" data-toggle="modal"
                                                         class="btn btn-warning"><i
                                        class="glyphicon glyphicon-exclamation-sign"></i></a></span>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" id="submit_query" href="#IDIDIDIDID" target="_blank" data-toggle="modal"
                           class="btn btn-block btn-rounded"
                           style="background: linear-gradient(to right,pink ,#ffb6c1,#ffb6c1,#ffb6c1);color:#fff;"
                           value="查询订单">

                </div>

                <!--查单-->
                <div class="modal fade" id="IDIDIDIDID" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="block block-themed block-transparent remove-margin-b">
                                <div class="block-header bg-primary-dark">
                                    <ul class="block-options">
                                        <li>
                                            <button data-dismiss="modal" style="text-shadow: black 1px 1px 1px;"
                                                    type="button">
                                                <button type="button" class="close" data-dismiss="modal"><span
                                                            aria-hidden="true">×</span><span
                                                            class="sr-only">Close</span></button>
                                            </button>
                                        </li>
                                    </ul>
                                    <b>
                                        <li class="list-group-item bord-top"><span
                                                    style="color: #FF0066;">如果查到的订单状态显示：</span></li>
                                        <li class="list-group-item bord-top"><span style="color: #FF0000;"><i
                                                        class="glyphicon glyphicon-refresh text-info fa-spin"></i> <font
                                                        color="blue">待处理：</font>说明订单还未开始，等待处理！<font color="red">（最迟24小时内到账）</font></span>
                                        </li>

                                        <li class="list-group-item bord-top"><span style="color: #FF9900;"><font
                                                        color="#f0a63a"><i
                                                            class="fa fa-spinner text-warning fa-spin"></i></font> 正在处理：<font
                                                        color="blue">已经在处理中，耐心等待到账！</font></span></li>
                                        <li class="list-group-item bord-top"><span style="color: #00CC00;"><font
                                                        color="#46c37b"><i class="fa fa-check-circle"></i></font>  已完成：并非已到账，只是个状态<br> <font
                                                        color="red">（一般24小时内开刷，QQ钻类0-72小时内）</font></span></li>
                                        <li class="list-group-item bord-top"><span style="color: #FF0000;"><font
                                                        color="#FF6347"><i class="fa fa-exclamation-circle"></i></font> 异 常：请联系客服处理，不要提交补单！</span>
                                        </li>

                                        <br/></span></li>
                                    </b>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <center><small><font
                                                            color="#ff0000"><b><big>手机用户可以左右滑动【查详细数据】</big></b></font></small>
                                            </center>
                                            <th>
                                                <font size="2">下单账号</font></th>
                                            <th>
                                                <font size="2">商品名称</font></th>
                                            <th class="hidden-xs">
                                                <font size="2">下单时间</font></th>
                                            <th>
                                                <font size="2">数量</font></th>
                                            <th>
                                                <font size="2">订单状态</font></th>
                                        </tr>
                                        </thead>
                                        <tbody id="list"></tbody>
                                    </table>
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">【关闭此页面】</span><span
                                                class="sr-only">Close</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--查单-->


            </div>
            <!--查询订单-->

            <!--更多-->
            <div class="tab-pane fade fade-right" id="more">
                <div class="col-xs-6 col-sm-4 col-lg-4">
                    <a class="block block-link-hover2 text-center" data-toggle="modal" href="user/reg.php">
                        <div class="block-content block-content-full bg-primary-dark">
                            <i class="fa  fa-files-o  fa-3x text-white"></i>
                            <div class="font-w600 text-white-op push-15-t">注册用户</div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-4 col-lg-4">
                    <a class="block block-link-hover2 text-center" data-toggle="modal" href="user/regsite.php">
                        <div class="block-content block-content-full bg-primary-dark">
                            <i class="fa  fa-user  fa-3x text-white"></i>
                            <div class="font-w600 text-white-op push-15-t">搭建分站</div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-4 col-lg-4">
                    <a class="block block-link-hover2 text-center" data-toggle="modal" href="#lqq">
                        <div class="block-content block-content-full bg-primary">
                            <i class="fa fa-circle-o fa-3x text-white"></i>
                            <div class="font-w600 text-white-op push-15-t">免费拉圈</div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-4 col-lg-4">
                    <a class="block block-link-hover2 text-center" data-toggle="modal" href="/?mod=invite">
                        <div class="block-content block-content-full bg-success">
                            <i class="fa fa-thumbs-up fa-3x text-white"></i>
                            <div class="font-w600 text-white-op push-15-t">推广领礼</div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-4 col-lg-4">
                    <a class="block block-link-hover2 text-center" href="user">
                        <div class="block-content block-content-full bg-city">
                            <i class="fa fa-lock fa-3x text-white"></i>
                            <div class="font-w600 text-white-op push-15-t">分站后台</div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-4 col-lg-4">
                    <a target="_blank" class="block block-link-hover2 text-center" data-toggle="tab" href="#gift"
                       rel="nofollow">
                        <div class="block-content block-content-full bg-success">
                            <i class="fa  fa-search fa-3x text-white"></i>
                            <div class="font-w600 text-white-op push-15-t">福利抽奖</div>
                        </div>
                    </a>
                </div>
            </div>
            <!--更多-->

            <!--开通分站-->
            <div class="tab-pane fade fade-up" id="ktfz">
                <div class="block block-link-hover2 text-center">
                    <div class="block-content block-content-full bg-success">
                        <div class="h4 font-w700 text-white push-10"><i class="fa fa-cny fa-fw"></i><strong>1元</strong>
                            / <i class="fa fa-cny fa-fw"></i><strong>20元</strong></div>
                        <div class="h5 font-w300 text-white-op">普通版 / 专业版两种分站供你选择</div>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-condensed">
                            <tbody>
                            <tr>
                                <td>无聊时可以赚点零花钱</td>
                            </tr>
                            <tr>
                                <td>还可以锻炼自己销售口才</td>
                            </tr>
                            <tr>
                                <td>宝妈、学生等网络兼职首选</td>
                            </tr>
                            <tr>
                                <td>分站每满5元即可申请提现</td>
                            </tr>
                            <tr>
                                <td><strong>轻轻松松推广日赚100+不是梦</strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                        <a href="#userjs" data-toggle="modal" class="btn btn-success">版本介绍</a>
                        <button onclick="window.open(&#39;./user/reg.php&#39;)" class="btn btn-danger">开通分站</button>
                    </div>
                </div>
            </div>
            <!--开通分站-->

            <!--卡密下单-->
            <div class="modal fade" id="kmxd" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-popin">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent remove-margin-b">
                            <div class="block-header bg-primary-dark">
                                <ul class="block-options">
                                    <li>
                                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                    </li>
                                </ul>
                                <h4 class="block-title">卡密下单</h4>
                            </div>
                            <div class="modal-body">
                                <div id="alert_frame" class="alert alert-info">
                                    每天可以在 <a class="label label-success">福利</a> 免费领取卡密兑换商品哦！
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">输入卡密</div>
                                        <input type="text" name="km" id="km" value="" class="form-control" required/>
                                    </div>
                                </div>
                                <input type="submit" id="submit_checkkm" class="btn btn-primary btn-block" value="检查卡密">
                                <div id="km_show_frame" style="display:none;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">商品名称</div>
                                            <input type="text" name="name" id="km_name" value="" class="form-control"
                                                   disabled/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon" id="km_inputname">下单账号</div>
                                            <input type="text" name="inputvalue" id="km_inputvalue" value=""
                                                   class="form-control" required/>
                                        </div>
                                    </div>
                                    <div id="km_inputsname"></div>
                                    <div id="km_alert_frame" class="alert alert-warning" style="display:none;"></div>
                                    <input type="submit" id="submit_card" class="btn btn-block btn-rounded"
                                           style="background: linear-gradient(to right,pink ,#ffb6c1,#ffb6c1,#ffb6c1);color:#fff;"
                                           value="立即购买">
                                    <br>
                                    <div id="result1" class="form-group text-center" style="display:none;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">关闭</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--卡密下单-->
            <!--拉圈圈-->
            <div class="modal fade" id="lqq" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-popin">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent remove-margin-b">
                            <div class="block-header bg-primary-dark">
                                <ul class="block-options">
                                    <li>
                                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                    </li>
                                </ul>
                                <h4 class="block-title">免费拉圈圈99+</h4>
                            </div>
                            <div class="modal-body">
                                <div id="alert_frame" class="alert alert-info">
                                    免费拉取圈圈标签赞 99+ ，不是100%成功哦！
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">请输入QQ</div>
                                        <input type="text" name="qq" id="qq4" value="" class="form-control" required="">
                                    </div>
                                </div>
                                <input type="submit" id="submit_lqq" class="btn btn-block btn-rounded"
                                       style="background: linear-gradient(to right,#FFC1E0,#ffaad5);color:#fff;"
                                       value="立即提交">
                                <div id="result3" class="form-group text-center" style="display:none;"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">关闭</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--拉圈圈-->
            <!--聊天-->
            <div class="modal fade" id="lqq" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-popin">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent remove-margin-b">
                            <div class="block-header bg-primary-dark">
                                <ul class="block-options">
                                    <li>
                                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                    </li>
                                </ul>
                                <h4 class="block-title">聊天交流</h4>
                            </div>
                            <div class="modal-body">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">关闭</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade fade-right" id="chat">

            </div>
            <!--聊天-->
        </div>
    </div>
    <!--版本介绍-->
    <div class="modal fade" id="userjs" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popin">
            <div class="modal-content">
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                            </li>
                        </ul>
                        <h4 class="block-title">版本介绍</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-borderless table-vcenter">
                                <thead>
                                <tr>
                                    <th style="width: 100px;">功能</th>
                                    <th class="text-center" style="width: 20px;">普及版/专业版</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="active">
                                    <td>专属代刷平台</td>
                                    <td class="text-center">
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                    </td>
                                </tr>
                                <tr class="">
                                    <td>三种在线支付接口</td>
                                    <td class="text-center">
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                    </td>
                                </tr>
                                <tr class="success">
                                    <td>专属网站域名</td>
                                    <td class="text-center">
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                    </td>
                                </tr>
                                <tr class="">
                                    <td>赚取用户提成</td>
                                    <td class="text-center">
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                    </td>
                                </tr>
                                <tr class="info">
                                    <td>赚取下级分站提成</td>
                                    <td class="text-center">
                                        <span class="btn btn-effect-ripple btn-xs btn-danger"><i
                                                    class="fa fa-close"></i></span>
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                    </td>
                                </tr>
                                <tr class="">
                                    <td>设置商品价格</td>
                                    <td class="text-center">
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                    </td>
                                </tr>
                                <tr class="warning">
                                    <td>设置下级分站商品价格</td>
                                    <td class="text-center">
                                        <span class="btn btn-effect-ripple btn-xs btn-danger"><i
                                                    class="fa fa-close"></i></span>
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                    </td>
                                </tr>
                                <tr class="">
                                    <td>搭建下级分站</td>
                                    <td class="text-center">
                                        <span class="btn btn-effect-ripple btn-xs btn-danger"><i
                                                    class="fa fa-close"></i></span>
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                    </td>
                                </tr>
                                <tr class="danger">
                                    <td>赠送专属精致APP</td>
                                    <td class="text-center">
                                        <span class="btn btn-effect-ripple btn-xs btn-danger"><i
                                                    class="fa fa-close"></i></span>
                                        <span class="btn btn-effect-ripple btn-xs btn-success"><i
                                                    class="fa fa-check"></i></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <center style="color: #b2b2b2;"><small><em>* 自己的能力决定着你的收入！</em></small></center>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
    <!--版本介绍-->
    <!--联系客服开始-->
    <div class="modal fade" align="left" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                                class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">联系客服</h4>
                </div>
                <div class="modal-body">
                    <h4>请看你的订单问题是否需要联系客服</h4>
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne1"
                                       aria-expanded="false" class="collapsed">ＱＱ刷名片赞好久没开始刷？</a>
                                </h4>
                            </div>
                            <div id="collapseOne1" class="panel-collapse collapse" style="height: 0px;"
                                 aria-expanded="false">
                                <div class="panel-body">
                                    查询订单，然后查询到你的订单是否完成，如果显示（已完成）请耐心等待刷完就好了<br>订单显示（已完成）就证明已经提交到服务器内！并不是订单已刷完。
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo2"
                                       class="collapsed" aria-expanded="false">ＱＱ空间业务好久没开始刷？</a>
                                </h4>
                            </div>
                            <div id="collapseTwo2" class="panel-collapse collapse" style="height: 0px;"
                                 aria-expanded="false">
                                <div class="panel-body">
                                    目前QQ空间访问量是在24小时左右开刷（空间必须是所有人可访问），请耐心等待就好了！<br>下单空间留言没有刷？关闭空间留言审核（需要电脑关闭）关闭过后静候24小时内开始！<br>
                                    订单显示（已完成）就证明已经提交到服务器内！并不是订单已刷完。
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree3"
                                       class="collapsed" aria-expanded="false">ＱＱ空间说说好久没开始刷？</a>
                                </h4>
                            </div>
                            <div id="collapseThree3" class="panel-collapse collapse" style="height: 0px;"
                                 aria-expanded="false">
                                <div class="panel-body">
                                    目前空间说说赞压单，请耐心等待开刷！<br>
                                    说说评论，说说浏览量正常开刷（基本下单开刷）！<br>订单显示（已完成）就证明已经提交到服务器内！并不是订单已刷完。
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive5"
                                       class="collapsed" aria-expanded="false">快手代刷业务好久没开始刷？</a>
                                </h4>
                            </div>
                            <div id="collapseFive5" class="panel-collapse collapse" style="height: 0px;"
                                 aria-expanded="false">
                                <div class="panel-body">
                                    目前快手业务限制的比较厉害，刷的慢 请耐心等待刷完！<br>
                                    订单显示（已完成）就证明已经提交到服务器内！并不是订单已刷完。
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix7"
                                       class="collapsed" aria-expanded="false">卡密/CDK没有发送我的邮箱？</a>
                                </h4>
                            </div>
                            <div id="collapseSix7" class="panel-collapse collapse" style="height: 0px;"
                                 aria-expanded="false">
                                <div class="panel-body">
                                    没有收到请检查自己邮箱的垃圾箱！也可以去查单区：输入自己下单时填写的邮箱进行查单。<br>
                                    查询到订单后点击（详细）就可以看到自己购买的卡密/cdk！
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix8"
                                       class="collapsed" aria-expanded="false">已付款了没用查询到我订单？</a>
                                </h4>
                            </div>
                            <div id="collapseSix8" class="panel-collapse collapse" style="height: 0px;"
                                 aria-expanded="false">
                                <div class="panel-body">
                                    联系客服处理，请提供（付款详细记录截图）（下单商品名称）（下单账号）<br>
                                    直接把三个信息发给客服，然后等待客服回复处理（请不要发抖动窗口或者QQ电话）！
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-borderless table-vcenter remove-margin-bottom">
                        <tbody>
                        <tr class="animation-fadeInQuick2">
                            <td class="text-center" style="width: 100px;">
                                <img src="http://q4.qlogo.cn/headimg_dl?dst_uin=123385570&spec=100" alt="avatar"
                                     class="img-circle img-thumbnail img-thumbnail-avatar">
                            </td>
                            <td>
                                <b>全职售后客服</b>
                                <i class="gi gi-chat fa-qq text-info"></i><br>
                                <i class="gi gi-clock fa-history text-danger"></i>
                                <script>var online = new Array();</script>
                                <script src=" http://webpresence.qq.com/getonline?Type=1&123385570:"></script>
                                <script>
                                    if (online[24] == 8)
                                        document.write("");
                                    else
                                        document.write("");
                                </script>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
    <!--联系客服结束-->

    <!--下单份数开始-->
    <div class="modal fade" align="left" id="1circles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                                class="sr-only">Close</span></button>
                    <h5 class="modal-title" id="myModalLabel"><b>“下单份数”是什么？</b></h5>
                </div>
                <center><br>
                    列如：特价名片赞1万
                    <br>
                    份数增加到 <b>2份</b> 那么就是：2万
                    <hr>
                    列如：我想要下单 10万 名片赞
                    <br>
                    名片赞是1万 那么就增加份数到<b>10份</b>
                    <hr>
                    其他商品以此类推 面值是多少数量就是多少倍 <br>
                    <br></center>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
    <!--下单份数结束-->
    <!--查单说明开始-->
    <div class="modal fade" align="left" id="cxsm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">查询内容是什么？<br>该输入什么？</h4>
                </div>
                <li class="list-group-item"><font color="red">请在输入框内输入您下单时，在第一个输入框内填写的信息</font></li>
                <li class="list-group-item">例如您购买的是QQ名片赞，输入下单的QQ账号即可查询订单</li>
                <li class="list-group-item">例如您购买的是邮箱类商品，需要输入您的邮箱号，输入QQ号是查询不到的</li>
                <li class="list-group-item">例如您购买的是快手商品，需要输入快手ID~去下单那里在获取一边再来查询！输入快手号是一般是查询不到的</li>
                <li class="list-group-item">例如您购买的是全民K歌商品，需要输入歌曲链接里“shareuid=”后面的，&amp;前面的一串英文数字，输入歌曲链接是查询不到的</li>
                <li class="list-group-item"><font color="red">如果您不知道下单账号是什么，可以不填写，直接点击查询，则会根据浏览器缓存查询</font></li>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>

    <div class="block">
    </div>
    <div class="block">
        <br>

        <center>温馨小提示：<a href="./

 ">手机用户第一次访问记得收藏代刷网</a>
            <br/><font color="#C00000">本</font><font color="#B5000B">站</font><font color="#AA0016">地</font><font
                    color="#9F0021">址</font><font color="#94002C">：</font><font color="red">
                <script language="javascript">host = window.location.host;
                    document.write("" + host)</script>
            </font><font color="#890037">（</font><font color="#7E0042">建议收藏本站网址</font><font
                    color="#73004D">到浏览器书签，</font><font color="#680058">方便下次</font><font color="#5D0063"></font><font
                    color="#52006E">打开</font><font color="#470079">）</font></center>
        <!--底部排版-->
        <center>
            <p>CopyRight <i class="fa fa-heart text-danger"></i> 2018 <a href="./" target="_blank">QQ代刷网,代刷网</a>
                <!--统计代码-->
                <style>
                    .elevator_item .hd-time-limited {
                        display: block;
                        position: fixed;
                        right: 0;
                        bottom: 445px;
                        width: 40px;
                        height: 140px;
                        background: url(assets/img/right.png) no-repeat center;
                    }

                    .elevator_item {
                        position: fixed;
                        right: 0;
                        bottom: 95px;
                        z-index: 11;
                    }

                    .elevator_item .feedback {
                        width: 36px;
                        height: 41px;
                        font-size: 12px;
                        padding: 5px 6px;
                        display: block;
                        border-radius: 5px;
                        text-align: center;
                        margin-top: 10px;
                        box-shadow: 0 1px 2px rgba(0, 0, 0, .35);
                        cursor: pointer;
                    }

                    .graHover {
                        position: relative;
                        overflow: hidden;
                    }
                </style>

                <!--统计代码-->
    </div>
    <script src="//lib.baomitu.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//lib.baomitu.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
    <script src="<?php echo $cdnserver ?>assets/appui/js/plugins.js"></script>
    <script src="<?php echo $cdnserver ?>assets/appui/js/app.js"></script>
    <script type="text/javascript">
        var isModal =<?php echo empty($conf['modal']) ? 'false' : 'true';?>;
        var homepage = true;
        var hashsalt =<?php echo $addsalt_js?>;
    </script>
    <script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>