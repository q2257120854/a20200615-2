<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8" />
    <title>订单查询<?php echo empty($conf['sitename']) ? '' : ' - '.$conf['sitename']; ?></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
    <meta name="keywords" content="<?php echo $conf['keywords']; ?>">
    <meta name="description" content="<?php echo $conf['description']; ?>">
    <link rel="shortcut icon" href="/favicon.ico">
    <link href="/assets/wxds/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/wxds/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/common/fancybox/jquery.fancybox.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/common/css/style.css" rel="stylesheet" type="text/css" />
    <script src="//lib.baomitu.com/jquery/3.4.1/jquery.min.js"></script>
    <style type="text/css">
        ul.side-nav>li.active{
            background: #ffffff38;
        }
        ul.collapse>li.active{
            background: #7f79e888;
        }
        select.form-control {
            -webkit-appearance: none;
            outline: none;
        }
    </style>
    <script type="text/javascript">
        document.addEventListener( "plusready", function(){
            var is_app = true;
            $('#AppDown').hide();
            $('footer').hide();
        }, false );
    </script>
</head>
<body class="boxed-layout sidebar-enable" data-keep-enlarged="true">
<div class="loading">
    <div id="loader"></div>
</div>
<div class="modal fade" id="kfModel">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="text-center my-3">

                    <a onclick="_AIHECONG('showChat')">联系客服</a>

                    <h3>售后客服</h3>
                </div>
                <table class="table table-hover table-bordered">
                    <tbody class="text-center">
                    <tr>
                        <th>ＱＱ客服</th>
                        <th>在线时间</th>
                    </tr>
                    <tr>
                        <td><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=97429106&site=qq&menu=yes" class="align-middle"><img class="align-middle" border="0" src="http://wpa.qq.com/pa?p=2:97429106:52" alt="点击这里给我发消息" title="点击这里给我发消息"> 97429106</a></td>
                        <td style="vertical-align: middle !important;">10:00 - 22:00</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="hzModel">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="text-center my-3">
                    <h3>商务合作</h3>
                </div>
                <div class="alert alert-danger align-middle"><i class="fas fa-exclamation-circle align-middle" style="font-size: 20px;"></i> 以下联系方式不提供任何订单相关售后服务！加好友请备注来历，谢谢！</div>
                <table class="table table-hover table-bordered">
                    <tbody>
                    <tr>
                        <td class="text-center">ＱＱ咨询：</td>
                        <td class="text-center align-middle"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=918247855&site=qq&menu=yes"><img class="align-middle" border="0" src="http://wpa.qq.com/pa?p=2:918247855:52" alt="点击这里给我发消息" title="点击这里给我发消息"> 918247855</a></td>
                    </tr>
                    <tr>
                        <td class="text-center" style="vertical-align: middle !important;">微信咨询：</td>
                        <td class="text-center" id="swwx"><a href="javascript:void(0);" class="align-middle" id="copy-btn"  data-clipboard-target="#swwx">V3753563</a> <a href="javascript:void(0);" class="font-weight-bold align-middle" style="font-size: 28px;"><i class="fas fa-qrcode" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true" data-content="<img src='../assets/img/kfwx.png' width='150px'>"></i></a></td>
                    </tr>
                    <tr>
                        <td class="text-center">邮箱咨询：</td>
                        <td class="text-center align-middle"><a target="_blank" href="mailto:m@wangxiaoda.com?subject=【爱赞商城】合作咨询">m@wangxiaoda.com</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="text-center my-3">
                    <h3>商品通知</h3>
                </div>
                <!--li class="list-group-item"><span class="badge badge-danger">推荐</span>  每日免费领取名片赞，记得收藏本站每天来领取哦  <a href="?cid=1&tid=275" pjax="no">点击领取>></a></li-->
                <li class="list-group-item">2.9.【微搏业务区】V博业务稳定快刷，价格下调！ <a href="/?cid=50&tid=454" pjax="no">点击直达>></a></li>
                <li class="list-group-item">2.9.【小Ｈ书专区】恢复接单，全部稳定快刷！  <a href="/?cid=48&tid=383" pjax="no">点击直达>></a></li>
                <li class="list-group-item">2.9.【网课刷客区】稳定商品课种齐全，物美价廉！ <a href="/?cid=62&tid=498" pjax="no">点击直达>></a></li>
                <li class="list-group-item">2.9.【抖音短视频】枓音专区，粉丝维护 其他全部正常稳定快刷！ <a href="/?cid=45&tid=450" pjax="no">点击直达>></a></li>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<div id="appDown" class="modal fade" data-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content modal-filled bg-success">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="fas fa-cloud-download-alt h1"></i>
                    <h4 class="mt-1">下载APP，下单更便捷！</h4>
                    <p class="mt-1"><img src="http://qr.topscan.com/api.php?text=https://www.lanzous.com/i4u52pg&bg=0acf97&fg=006a58&w=300&el=l" width="100%" alt="扫码下载APP"></p>
                    <p class="text-reset">注：不建议使用微信扫码，微信扫码请选择在浏览器打开！</p>
                    <div class="mt-1">
                        <a href="https://www.lanzous.com/i4u52pg" target="_blank" class="btn btn-warning text-white">直接下载</a>
                        <button type="button" class="btn btn-light" data-dismiss="modal">关闭</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wrapper shadow-none bg-white" style="min-height: 56rem;">
    <div class="left-side-menu">
        <div class="slimscroll-menu" id="left-side-menu-container">
            <!-- LOGO -->
            <a href="../" class="logo text-center">
                        <span class="logo-lg">
                            <img src="/assets/img/logo.png" alt="LOGO" height="45">
                        </span>
                <span class="logo-sm">
                            <img src="/assets/img/logo.png" alt="LOGO" height="50">
                        </span>
            </a>
            <!-- 侧栏 -->
            <ul class="metismenu side-nav">
                <li class="side-nav-title side-nav-item">功能菜单</li>

                <li class="side-nav-item">
                    <a href="/" _action="index" class="side-nav-link">
                        <i class="fas fa-home"></i>
                        <span> 网站首页 </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="?mod=query" _action="query" class="side-nav-link">
                        <i class="fas fa-search"></i>
                        <span> 查询订单 </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="?mod=site" class="side-nav-link">
                        <i class="fas fa-users"></i>
                        <span> 成为代理 </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="javascript: void(0);" class="side-nav-link">
                        <i class="fas fa-gift"></i>
                        <span> 免费福利 </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="side-nav-second-level collapse">
                        <li>
                            <a href="?mod=invite">邀请有礼</a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="side-nav-item">
                     <a href="?mod=articlelist" _action="article" class="side-nav-link">
                         <i class="fas fa-file-alt"></i>
                         <span> 文章教程 </span>
                     </a>
                 </li>
                                          <li class="side-nav-item">
                     <a href="#appDown" data-toggle="modal" class="side-nav-link">
                         <i class="fas fa-cloud-download-alt"></i>
                         <span> APP下载 </span>
                           <img src="../assets/img/hot.gif" style="max-height: 100%;"/>
                     </a>
                 </li>

                  <li class="side-nav-title side-nav-item mt-1">关于本站</li>

                 <li class="side-nav-item">
                     <a href="#kfModel" data-toggle="modal" class="side-nav-link">
                         <i class="fab fa-qq"></i>
                         <span> 联系客服 </span>
                     </a>
                 </li>
               li class="side-nav-item">
                     <a href="?mod=faq" class="side-nav-link">
                         <i class="mdi mdi-alert-circle"></i>
                         <span> 常见问题 </span>
                     </a>
                 </li-->
                <!--li class="side-nav-item">
                    <a href="#hzModel" data-toggle="modal" class="side-nav-link">
                        <i class="fas fa-coffee"></i>
                        <span> 商务合作 </span>
                    </a>
                </li-->
            </ul>
            <!--  div class="help-box text-white text-center">
                  <a href="javascript: void(0);" class="float-right close-btn text-white">
                      <i class="mdi mdi-close"></i>
                  </a>
                  <img src="../assets/wxds/images/help-icon.svg" height="90" alt="Helper Icon Image" />
                  <h5 class="mt-3">Unlimited Access</h5>
                  <p class="mb-3">Upgrade to plan to get access to unlimited reports</p>
                  <a href="javascript: void(0);" class="btn btn-outline-light btn-sm">Upgrade</a>
              </div-->
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="content-page">
        <div class="content position-relative">
            <div class="navbar-custom">
                <div class="fc-button-group topbar-right-menu float-right mb-0" style="padding: calc(32px / 2) 0;">
                    <a href="/user/login.php" pjax="no" class="btn btn-primary btn-sm mr-1">登录</a>
                    <a href="/user/reg.php" pjax="no" class="btn btn-light btn-sm" >注册</a>
                </div>
                <button class="button-menu-mobile open-left disable-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <section id="pjax-container">    <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-none d-md-block">
                                <h4 class="page-title">订单查询</h4>
                            </div>
                        </div>
                        <div class="col-12 col-lg-5">
                            <div class="alert alert-primary text-left" role="alert" >
                                <p><span class="badge badge-primary"><i class="fas fa-undo-alt"></i> 待处理</span> 订单正在等待开始处理！</p>
                                <p><span class="badge badge-warning text-white"><i class="fas fa-play fa-spin"></i> 处理中</span> 订单正在处理中，耐心等待即可！</p>
                                <p><span class="badge badge-success"><i class="fas fa-check-circle"></i> 已完成</span> 说明订单已完成（钻类订单除外），可能会有一定延迟！</p>
                                <p><span class="badge badge-danger"><i class="fas fa-info-circle"></i> 有异常</span> 下单信息有误或其他问题，请联系客服处理！</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-7">
                            <div class="custom-control custom-radio d-inline-block m-1 mb-2">
                                <input type="radio" id="query_default" name="queryType" class="custom-control-input" value="0" checked>
                                <label class="custom-control-label" for="query_default">下单账号</label>
                            </div>
                            <div class="custom-control custom-radio d-inline-block m-1 mb-2">
                                <input type="radio" id="query_order" name="queryType" class="custom-control-input" value="1">
                                <label class="custom-control-label" for="query_order">订单号</label>
                            </div>
                            <input id="searchtype" value="0" hidden>
                            <div class="form-group mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                            <span class="input-group-btn">
                            </span>
                                    </div>
                                    <input type="text" name="qq" id="qq3" value="" class="form-control pl-2 mb-2 rounded-right" placeholder="输入查询的内容（留空则显示最新订单）" onkeydown="if(event.keyCode==13){submit_query.click()}" required/>
                                    <input type="submit" id="submit_query" class="btn btn-primary btn-block" value="立即查询">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div id="result2" class="form-group" style="display:none;">
                                <center class="my-1 d-md-none"><small><font color="#ff0000">下方表单可以左右滑动哦！</font></small></center>
                                <div class="table-responsive">
                                    <table class="table table-vcenter table-hover table-condensed table-striped table-sm">
                                        <thead class="text-center">
                                        <tr>
                                            <th>状态</th>
                                            <th>商品名称</th>
                                            <th class="d-none d-md-block">下单账号</th>
                                            <th style="white-space: nowrap;">数量</th>
                                            <th class="d-none d-lg-block">购买时间</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody id="list">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        var copyTips = '复制成功！有疑问请发送给客服！';
                        $(document).ready(function(){
                            $("#submit_query").click();
                        });
                    </script>
                </div>
            </section>
        </div>
        <footer class="footer border-top border-light">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12  text-center ">
                        <?php echo date('Y'); ?> © <a href="/"><?php echo $conf['sitename']; ?></a>
                        <?php echo $conf['bottom']; ?>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<!-- END wrapper -->
<script src="/assets/wxds/js/app.min.js"></script>
<script src="/assets/wxds/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/assets/wxds/js/vendor/jquery-jvectormap-world-mill-en.js"></script>
<script src="//lib.baomitu.com/layer/3.1.1/layer.js"></script>
<script src="//lib.baomitu.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//lib.baomitu.com/clipboard.js/1.7.1/clipboard.min.js"></script>
<script src="/assets/common/js/jquery.pjax.js"></script>
<script src="/assets/common/js/index.js"></script>
<script src="/assets/common/js/highlight.pack.js"></script>
<script src="/assets/common/fancybox/jquery.fancybox.min.js"></script>
<script src="/assets/wxds/js/main.js?v=<?php echo VERSION; ?>"></script>
<script type="text/javascript">
    if (isModal === undefined) var isModal=false;
    if (homepage === undefined) var homepage=false;
    if (is_app === undefined) var is_app=false;
    $(document).ready(function(){
        $('input[name="queryType"]').change(function () {
            $('#searchtype').val($(this).val());
        });
        const actionDom = $("a[_action]");
        actionDom.removeClass('active');
        actionDom.parents('li').removeClass('active');
        const actionQueryDom = $("a[_action=query]");
        actionQueryDom.parents('li').addClass("active");
        actionQueryDom.addClass("active");
        if (actionQueryDom.parents('ul.collapse').length) actionQueryDom.parents('ul.collapse').addClass('in');
    });
</script>
</body>
</html>