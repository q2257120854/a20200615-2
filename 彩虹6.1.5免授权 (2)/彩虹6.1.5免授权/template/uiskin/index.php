<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
    <title><?php echo $conf['sitename']; ?> - <?php echo $conf['title']; ?></title>
    <meta name="keywords" content="<?php echo $conf['keywords']; ?>">
    <meta name="description" content="<?php echo $conf['description']; ?>">
    <link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link type="text/css" href="/assets/user/css/load.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/assets/uiskin/css/slick-theme.min.css">
    <link rel="stylesheet" href="/assets/uiskin/css/slick.min.css">
    <link rel="stylesheet" href="/assets/uiskin/css/oneui.css">
    <script src="//lib.baomitu.com/modernizr/2.8.3/modernizr.min.js"></script>
    <!--[if lt IE 9]>
    <script src="//lib.baomitu.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//lib.baomitu.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>body{background: linear-gradient(to bottom,	#49BDAD,#6a67c7) fixed;}</style>
</head>
<body>
<div class="loading-back" id="sk-three-bounce">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<div style="padding-top:6px;">
    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-4 center-block" style="float: none;">
        <!--网站公告开始-->
        <div class="modal fade" id="anounce" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="block block-themed block-transparent remove-margin-b">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">平台公告</h3>
                        </div>
                        <?php echo $conf['modal']; ?>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">知道了</button>
                    </div>
                </div>
            </div>
        </div>
        <!--网站公告结束-->

        <!--商品通知开始-->
        <div class="modal fade" id="commodity" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="block block-themed block-transparent remove-margin-b">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">商品通知时间：<span id=localtime></span><script type="text/javascript">function showLocale(objD)
                                    {var str,colorhead,colorfoot;var yy = objD.getYear();
                                        if(yy<1900) yy = yy+1900;
                                        var MM = objD.getMonth()+1;
                                        if(MM<10) MM = '0' + MM;
                                        var dd = objD.getDate();
                                        var ww = objD.getDay();
                                        if  ( ww==0 )  colorhead="<font color=\"#FFFFFF \">";
                                        if  ( ww > 0 && ww < 6 )  colorhead="<font color=\"#FFFFFF \">";
                                        if  ( ww==6 )  colorhead="<font color=\"#FFFFFF \">";
                                        var hh = objD.getHours();
                                        str = colorhead + yy + "/" + MM + "/" + dd;
                                        return(str);}function tick()
                                    {var today;today = new Date();document.getElementById("localtime").innerHTML = showLocale(today);window.setTimeout("tick()", 1000);}
                                    tick();</script></h3>
                        </div>
                        <li class="list-group-item"><span style="text-align: center;display: block;">暂无商品</span></li>
<!--                        <li class="list-group-item"><span class="badge badge-danger">推荐</span> 每日免费领取名片赞，记得收藏本站每天来领取哦  <a href="/?cid=1&tid=158" pjax="no">点击领取>></a></li>-->
<!--                        <li class="list-group-item">【快手短视频】快手专区，全部正常稳定快刷！ <a href="/?cid=4" pjax="no">点击直达>></a></li>-->
<!--                        <li class="list-group-item">【会员成长值】会员成长值1800点快刷，价格下调！ <a href="/?cid=45&tid=509" pjax="no">点击直达>></a></li>-->
<!--                        <li class="list-group-item">【名片赞专区】平台会同步进度,会如实到账放心下单！  <a href="/?cid=3" pjax="no">点击直达>></a></li>-->
<!--                        <li class="list-group-item">【网课刷客区】稳定商品课种齐全，物美价廉！ <a href="/?cid=20" pjax="no">点击直达>></a></li>-->
<!--                        <li class="list-group-item">【抖音短视频】抖音专区，全部正常稳定快刷！ <a href="/?cid=10" pjax="no">点击直达>></a></li>-->
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">关闭</button>
                    </div>
                </div>
            </div>
        </div>
        <!--商品通知结束-->

        <!--查单说明开始-->
        <div class="modal fade" id="cdsm" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="block block-themed block-transparent remove-margin-b">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">查询内容是什么？该输入什么？</h3>
                        </div>
                        <li class="list-group-item"><font color="red">请在右侧的输入框内输入您下单时，在第一个输入框内填写的信息</font></li>
                        <li class="list-group-item">例如您购买的是QQ名片赞，输入下单的QQ账号即可查询订单</li>
                        <li class="list-group-item">例如您购买的是邮箱类商品，需要输入您的邮箱号，输入QQ号是查询不到的</li>
                        <li class="list-group-item"><font color="red"><b>如果您不知道下单账号是什么，可以不填写，直接点击查询，则会根据浏览器缓存查询</b></font></li>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">知道了</button>
                    </div>
                </div>
            </div>
        </div>
        <!--查单说明结束-->

        <!--ＤＷ手表开始-->
        <div class="modal fade" id="dw" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="block block-themed block-transparent remove-margin-b">
                        <div class="block-header bg-primary-dark">
                            <ul class="block-options">
                                <li>
                                    <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                </li>
                            </ul>
                            <h3 class="block-title">DW手表图片查看</h3>
                        </div>
                        <a href="https://www.danielwellington.cn/myclassic-all-watches/" target="_blank"
                           data-toggle="modal" style="text-align: center;">
                            <div class="content-mini content-mini-full bg-primary"><span
                                    class="glyphicon glyphicon-eye-open"></span>&nbsp;查看DW手表官方网站
                            </div>
                        </a>
                        <div class="panel panel-info">
                            <div class="widget-content widget-content-full">
                                <div id="info-carousel" class="carousel slide remove-margin">
                                    <ol class="carousel-indicators">
                                        <li data-target="#info-carousel" data-slide-to="1" class=""></li>
                                        <li data-target="#info-carousel" data-slide-to="2" class=""></li>
                                        <li data-target="#info-carousel" data-slide-to="3" class="active"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="item"
                                             style="width:100%; height:100%; border:none; overflow:hidden;">
                                            <img src="https://img.alicdn.com/imgextra/i1/2107975731/TB2p33Var3nBKNjSZFMXXaUSFXa_!!2107975731.jpg"
                                                 alt="image">
                                        </div>
                                        <div class="item"
                                             style="width:100%; height:100%; border:none; overflow:hidden;">
                                            <img src="https://img.alicdn.com/imgextra/i1/2107975731/TB26p0caMKTBuNkSne1XXaJoXXa_!!2107975731.jpg"
                                                 alt="image">
                                        </div>
                                    </div>
                                    <a class="left carousel-control" href="#info-carousel" data-slide="prev"><span
                                            class="glyphicon glyphicon-chevron-left"></span>
                                    </a>
                                    <a class="right carousel-control" href="#info-carousel" data-slide="next"><span
                                            class="glyphicon glyphicon-chevron-right"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--ＤＷ手表结束-->

        <!--下单份数开始-->
        <div class="modal fade" id="facevalue" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="block block-themed block-transparent remove-margin-b">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">“下单份数”是什么意思？</h3>
                        </div>
                        <center> <br>
                            列如：快刷名片赞┆1万
                            <br>
                            份数增加到 <b>2份</b> 那么就是：2万
                            <hr>
                            比如：我想要下单 10万 名片赞
                            <br>
                            名片赞是1万 那么就增加份数到<b>10份<br>
                            </b>
                            <hr>
                            下单前请看清楚商品说明，避免不必要的麻烦！
                            <br><br>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">关闭</button>
                    </div>
                </div>
            </div>
        </div>
        <!--下单份数结束-->

        <!--顶部导航-->
        <div class="block block-link-hover3" style="box-shadow:0 5px 10px 0 rgba(0, 0, 0, 0.25);">
            <div class="block-content block-content-full text-center bg-image"
                 style="background-image: url('./assets/simple/img/head3.jpg');background-size: 100% 100%;">
                <div>
                    <div>
                        <img alt="user_tx" id="user_tx" class="img-avatar img-avatar80 img-avatar-thumb"
                             src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']; ?>&spec=100">
                    </div>
                </div>
            </div>
            <center>
                <h3>  <a href="javascript:void(alert('QQ代刷网，建议收藏到浏览器书签哦！'));"><b><font color="#504dbe">QQ代刷网</font></b></a></h3>
            </center>
            <div class="block-content block-content-mini block-content-full">
                <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <a class="btn btn-default" data-toggle="modal" href="#anounce"><i class="fa fa-bell"></i>&nbsp;<span
                                style="font-weight:bold">平台公告</span></a>
                    </div>
                    <a href="<?php echo empty($conf['appurl']) ? '#' : $conf['appurl']; ?>"
                       class="btn btn-effect-ripple btn-default"><i class="fa fa-android"></i> <span
                            style="font-weight:bold">APP下载</span></a>
                    <div class="btn-group">
                        <a class="btn btn-default" data-toggle="modal" href="#commodity"><i class="fa fa-shopping-cart"></i><span style="font-weight:bold">&nbsp;商品通知</span></a>
                    </div>
                </div>
            </div>
        </div>
        <!--顶部导航-->

        <div class="block">

            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs">
                <li style="width: 25%;" align="center" class="active"><a href="#shop" data-toggle="tab"><span style="font-weight:bold"><i class="fa fa-shopping-bag "></i> 下单</span></a></li>
                <li style="width: 25%;" align="center"><a href="#search" data-toggle="tab" id="tab-query"><span style="font-weight:bold"><i class="fa fa-search-plus"></i> 查单</span></a></li>
                <li style="width: 25%;" align="center"><a href="#user" data-toggle="tab"><span style="font-weight:bold"><font color="#ff0000"><i class="fa fa-user-plus"></i> 加盟</span></font></a></li>
                <li style="width: 25%;" align="center"><a href="#more" data-toggle="tab"><span style="font-weight:bold"><i class="fa fa-tasks"></i> 更多</span></a></li>
            </ul>
            <!--TAB标签-->
            <div class="block-content tab-content">
                <!--在线下单-->
                <div class="tab-pane active" id="shop">
                    <?php include TEMPLATE_ROOT . 'default/shop.inc.php'; ?>
                    <div class="panel-body border-t">
                        <span class="glyphicon glyphicon-gift"></span> 注册后更优惠，签到免费下单
                        <a class="btn btn-xs btn-danger pull-right" href="/user/reg.php">点击注册</a>
                    </div>
                </div>
                <!--在线下单-->
                <!--查询订单-->
                <div class="tab-pane" id="search">
                    <ul class="list-group animated bounceIn">
                        <li class="list-group-item">
                            <div class="media">
                                <span class="pull-left thumb-sm"><img alt="user_tx" id="user_tx" src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']; ?>&spec=100" class="img-circle img-thumbnail img-avatar"></span>
                                <div class="pull-right push-15-t">
                                    <a href="#customerservice" target="_blank" data-toggle="modal" class="btn btn-sm btn-info">联系客服</a>
                                </div>
                                <div class="pull-left push-10-t">
                                    <div class="font-w600 push-5">订单售后QQ客服</div>
                                    <div class="text-muted">
                                        <script>var online = [];</script>
                                        <script src="http://webpresence.qq.com/getonline?Type=1&<?php echo $conf['kfqq']; ?>:"></script>
                                        <script>if (online[0] === 0) document.write('<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;'+ "8:00 - 23:00");else document.write('<i class="fa fa-circle text-success"></i>&nbsp;'+"8:00 - 23:00");</script></div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <?php echo $conf['gg_search']; ?>
                        </li>
                    </ul>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">查询内容</div>
                            <input type="text" name="qq" id="qq3" value="" class="form-control" placeholder="请输入要查询的内容"  data-toggle="tooltip" data-original-title="留空则查询最近购买的记录" onkeydown="if(event.keyCode==13){submit_query.click()}" required/>
                            <span class="input-group-btn"><a href="#cdsm" data-toggle="modal" class="btn btn-warning"><i class="glyphicon glyphicon-exclamation-sign"></i></a></span>
                        </div>
                    </div>
                    <input type="submit" id="submit_query" class="btn btn-sm btn-success btn-block btn-sm" value="查询订单">
                    <div id="result2" class="form-group" style="display:none;">
                        <div class="visible-xs" style="margin: 6px auto;"><div class="list-group-item list-group-item-success"><i class="fa fa-exclamation-circle fa-spin"></i>&nbsp;手机用户可以左右滑动查看订单详细！</div></div>
                        <div class="table-responsive">
                            <table class="table table-vcenter table-condensed table-striped">
                                <thead><tr><th>名称</th><th>数量</th><th class="hidden-xs">购买时间</th><th>状态</th><th>操作</th></tr></thead>
                                <tbody id="list">
                                </tbody>
                            </table>
                        </div>
                    </div><br/>
                </div>
                <!--查询订单-->
                <!--开通分站-->
                <div class="tab-pane" id="user">
                    <table class="table table-borderless" style="text-align: center;">
                        <tbody>
                        <tr class="active">
                            <td>
                                <h4>
            <span style="font-weight:bold">
              <font color="#FF8000">搭</font>
              <font color="#EC6D13">建</font>
              <font color="#D95A26">属</font>
              <font color="#C64739">于</font>
              <font color="#C64739">自</font>
              <font color="#A0215F">己</font>
              <font color="#8D0E72">的</font>
              <font color="#5400AB">云</font>
              <font color="#4100BE">商</font>
              <font color="#2E00D1">城</font></span>
                                </h4>
                            </td>
                        </tr>
                        <tr class="active">
                            <td>学生/上班族/创业/休闲赚钱必备工具</td></tr>
                        <tr class="active">
                            <td>
                                轻松松推广网站/日赚上千元不是梦</td></tr>
                        <tr class="active">
                            <td>
                                <span class="glyphicon glyphicon-magnet"></span>&nbsp;快加入我们成为大家庭中的一员吧</td></tr>
                        <tr>
                        </tbody>
                    </table>
                    <a href="user/reg.php" target="_blank" class="btn btn-effect-ripple  btn-warning btn-sm btn-block" ><span class="glyphicon glyphicon-arrow-right"></span>&nbsp;马上搭建网站赚钱</a><br>
                </div>
                <!--开通分站-->

                <!--抽奖-->
                <div class="modal fade" id="gift" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="block block-themed block-transparent remove-margin-b">
                                <div class="block-header bg-primary-dark">
                                    <h3 class="block-title"><span class="glyphicon glyphicon-gift"></span> 每日免费抽奖</h3></div>
                                <a target="_blank" href="/user/reg.php"></a><div class="modal-body" style="text-align: center;">
                                    <div class="tab-pane fade in" id="gift">
                                        <li class="list-group-item" style="background: linear-gradient;"><center>抽奖规则：每人每天可以免费抽奖１次！<br>奖品内容：本站Ｎ个商品，持续更新中！<hr><div id="roll"><b>
                                                        <i class="fa fa-heart text-danger animation-pulse"></i>
                                                        <font color=#CB0034>&nbsp;添&nbsp;加</font>
                                                        <font color=#CB0034>到</font>
                                                        <font color=#BE0041>浏</font>
                                                        <font color=#B1004E>览</font>
                                                        <font color=#A4005B>器</font>
                                                        <font color=#970068>书</font>
                                                        <font color=#8A0075>签</font>
                                                        <font color=#7D0082>-</font>
                                                        <font color=#5600A9>每</font>
                                                        <font color=#4900B6>天</font>
                                                        <font color=#3C00C3>必</font>
                                                        <font color=#3C00C3>抽</font>
                                                        <font color=#2F00D0>大</font>
                                                        <font color=#2200DD>奖</font></b></div></center></li><hr>
                                        <a class="btn btn-success btn-sm" id="start" style="text-shadow: Black 1px 0 1px;display:block;">开始抽奖</a>
                                        <a class="btn btn-danger btn-sm" id="stop" style="text-shadow: Black 1px 0 1px;display:none;">停止</a>
                                        <div id="result"></div>
                                    </div></div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">关闭</button></div>
                        </div>
                    </div>
                </div>
                <!--抽奖-->

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
                        <a class="block block-link-hover2 text-center" href="user">
                            <div class="block-content block-content-full bg-city">
                                <i class="fa fa-lock fa-3x text-white"></i>
                                <div class="font-w600 text-white-op push-15-t">分站后台</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-lg-4">
                        <a class="block block-link-hover2 text-center" href="#gift" target="_blank" data-toggle="modal">
                            <div class="block-content block-content-full bg-success">
                                <i class="fa  fa-search fa-3x text-white"></i>
                                <div class="font-w600 text-white-op push-15-t">福利抽奖</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--更多-->



        <!--关于我们弹窗-->
        <div class="modal fade" id="customerservice" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="block block-themed block-transparent remove-margin-b">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">联系客服</h3>
                        </div>
                        <div class="panel-body" id="accordion">
                            <ul class="list-group" style="margin-bottom: 0;">
                                <li class="list-group-item">
                                    <div class="media">
                                        <span class="pull-left thumb-sm"><img src="http://q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']; ?>&spec=100" alt="代刷网客服" class="img-circle img-thumbnail img-avatar"></span>
                                        <div class="pull-right push-15-t">
                                            <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']; ?>&site=qq&menu=yes" target="_blank"  class="btn btn-sm btn-info">联系客服</a>
                                        </div>
                                        <div class="pull-left push-10-t">
                                            <div class="font-w600 push-5">订单售后客服</div>
                                            <div class="text-muted"><b>QQ：<?php echo $conf['kfqq']; ?></b>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    售后诚信第一,有任何问题联系QQ客服或者微信客服!<br>
                                    有问题直接发下单账号+问题,直奔主题,按顺序回复!<br>
                                    订单长时间没有到账或者异常及时联系我们客服处理!<br>
                                </li>
                                <!-- <li class="list-group-item" >
                                 <img src="./assets/img/wx-kflx.png" width="100%">
                                 </li>  -->
                            </ul>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">关闭</button>
                    </div>
                </div>
            </div>
        </div>
        <!--关于我们弹窗-->
        <div class="block block-themed" style="box-shadow:0 5px 10px 0 rgba(0, 0, 0, 0.25);">
            <div class="block-header bg-amethyst" style="background-color: #6a67c7; border-color: #6a67c7; padding: 10px 10px;">
                <h3 class="block-title"><i class="fa fa-newspaper-o"></i> 文章列表</font></a></h3>
            </div>
            <?php
            $contents = $DB->select('article_list', ['title', 'id'], ['status' => 1, 'ORDER' => ['id' => 'DESC'], 'LIMIT' => 3]);
            foreach ($contents as $content): ?>
                <a target="_blank" style="font-size:13px; color:#4876FF" class="list-group-item" href="./route.php?s=index/<?php echo $content['id'] . '.html'; ?>"><?php echo strip_tags($content['title']); ?></a>
            <?php endforeach; ?>
            <?php if (!empty($contents)): ?>
            <a href="./route.php?s=index/zy/" title="查看全部商品通知" class="btn-default btn btn-block" target="_blank">查看全部商品通知</a>
            <?php else: ?>
            <span class="btn-default btn btn-block">暂无文章</span>
            <?php endif; ?>
        </div>
        <!--底部导航-->
        <a ><div class="block panel-body text-center" style="box-shadow:0 5px 10px 0 rgba(0, 0, 0, 0.25);">		<div class="row">
                    <font color="#">友情链接：</font>
                    <a target="_blank" href="//<?php echo $_SERVER['HTTP_HOST']; ?>"><font color="#0F00F0"><?php echo $conf['sitename']; ?></font></a>
                    <hr>
                    <i class="fa fa-heart text-danger animation-pulse"></i><b>
                        <font color=#CB0034>本</font>
                        <font color=#BE0041>站</font>
                        <font color=#B1004E>网</font>
                        <font color=#A4005B>址</font>
                        <font color=#970068>：<script>document.write(window.location.host);</script></font>
                        <font color=#2F00D0></font>
                        <font color=#CB0034>&nbsp;</font>
                        <font color=#CB0034>建</font>
                        <font color=#BE0041>议</font>
                        <font color=#B1004E>收</font>
                        <font color=#A4005B>藏</font>
                    </b>
        </a>
    </div>

    <!--底部导航-->
</div>
</div>

<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//lib.baomitu.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script src="<?php echo $cdnserver ?>assets/appui/js/app.js"></script>>
<script type="text/javascript">
    var isModal = <?php echo empty($conf['modal']) ? 'false' : 'true'; ?>;
    var homepage = true;
    var hashsalt = <?php echo $addsalt_js; ?>;
    $(function () {
        $("img.lazy").lazyload({effect: "fadeIn"});
    });
</script>
<script src="/assets/js/main.js?ver=<?php echo VERSION; ?>"></script>
<script src="/assets/user/js/load.js"></script>
<?php echo $conf['bottom']; ?>
</body>
</html>

