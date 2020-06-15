<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8" />
    <title>成为代理<?php echo empty($conf['sitename']) ? '' : ' - '.$conf['sitename']; ?></title>
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
                    <a href="../" _action="index" class="side-nav-link">
                        <i class="fas fa-home"></i>
                        <span> 网站首页 </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="?mod=query" class="side-nav-link">
                        <i class="fas fa-search"></i>
                        <span> 查询订单 </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="?mod=site" _action="site" class="side-nav-link">
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
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="content-page">
        <div class="content position-relative">
            <div class="navbar-custom">
                <div class="fc-button-group topbar-right-menu float-right mb-0" style="padding: calc(32px / 2) 0;">
                    <a href="../user/login.php" pjax="no" class="btn btn-primary btn-sm mr-1">登录</a>
                    <a href="../user/reg.php" pjax="no" class="btn btn-light btn-sm" >注册</a>
                </div>
                <button class="button-menu-mobile open-left disable-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <section id="pjax-container">    <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-none d-md-block">
                                <h4 class="page-title">成为代理</h4>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="text-center">
                                        <img src="/assets/wxds/img/headsite.png" width="280px;" alt="File not found Image">
                                        <h3 class="mt-4">加入我们，自己也是站长</h3>
                                        <p class="text-muted">商品齐全、货源稳定、价格超低、全职售后客服，售后保障！</p>
                                        <div class="row mt-5">
                                            <div class="col-md-4">
                                                <div class="text-center mt-3 pl-1 pr-1">
                                                    <i class="fas fa-mobile bg-primary maintenance-icon text-white mb-2"></i>
                                                    <h5 class="text-uppercase">光凭一步手机也能赚钱？</h5>
                                                    <p class="text-muted">对的，每天无聊的时候发发广告，拉点下级代理，躺着也能轻松日赚几百+</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center mt-3 pl-1 pr-1">
                                                    <i class="fas fa-tachometer-alt bg-primary maintenance-icon text-white mb-2"></i>
                                                    <h5 class="text-uppercase">网站管理起来麻烦吗？</h5>
                                                    <p class="text-muted">有专业的技术人员负责服务器的维护；专人上架、整理商品；专门的售后客服；零技术门槛。</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center mt-3 pl-1 pr-1">
                                                    <i class="fas fa-bolt bg-primary maintenance-icon text-white mb-2"></i>
                                                    <h5 class="text-uppercase">为何要选择我们？</h5>
                                                    <p class="text-muted">拥有丰富优质商品，实时掌握代刷市场的动态，加入我们，只要你坚持，你不用担心不赚钱，我们即使不敢保证你月入上万！但是在网上赚点零花钱也是轻轻松松！</p>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center mt-3 d-none d-md-block">
                                                <a href="/user/regsite.php" class="btn btn-danger btn-rounded btn-block d-inline-block" target="_blank" style="max-width: 38%;"><h3>注册分站</h3></a>
                                                <a href="#siteModel" data-toggle="modal" class="btn btn-success btn-rounded d-inline-block ml-1 px-3"><h3><i class="fas fa-info-circle"></i></h3></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white position-fixed py-2 d-md-none text-center" style="bottom: 0;left: 0;right: 0;z-index: 10;">
                                <a href="/user/regsite.php" class="btn btn-danger btn-rounded btn-block d-inline-block" target="_blank" style="max-width: 50%;">注册分站</a>
                                <a href="#siteModel" data-toggle="modal" class="btn btn-success btn-rounded ml-1"><i class="fas fa-info-circle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="siteModel">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="text-center my-3">
                                        <h3>版本介绍</h3>
                                    </div>
                                    <div class="table-responsive-sm">
                                        <table class="table table-hover table-centered mb-0">
                                            <thead>
                                            <tr>
                                                <th>功能</th>
                                                <th>普及版</th>
                                                <th>专业版</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>专属代刷平台</td>
                                                <td><span class="badge badge-success-lighten badge-pill"><i class="fas fa-check"></i></span></td>
                                                <td><span class="badge badge-success-lighten badge-pill"><i class="fas fa-check"></i></span></td>
                                            </tr>
                                            <tr>
                                                <td>专属网站域名</td>
                                                <td><span class="badge badge-success-lighten badge-pill"><i class="fas fa-check"></i></span></td>
                                                <td><span class="badge badge-success-lighten badge-pill"><i class="fas fa-check"></i></span></td>
                                            </tr>
                                            <tr>
                                                <td>三网在线支付接口</td>
                                                <td><span class="badge badge-success-lighten badge-pill"><i class="fas fa-check"></i></span></td>
                                                <td><span class="badge badge-success-lighten badge-pill"><i class="fas fa-check"></i></span></td>
                                            </tr>
                                            <tr>
                                                <td>设置商品价格</td>
                                                <td><span class="badge badge-success-lighten badge-pill"><i class="fas fa-check"></i></span></td>
                                                <td><span class="badge badge-success-lighten badge-pill"><i class="fas fa-check"></i></span></td>
                                            </tr>
                                            <tr>
                                                <td>设置下级网站商品价格</td>
                                                <td><span class="badge badge-danger-lighten badge-pill"><i class="fas fa-times text-danger"></i></span></td>
                                                <td><span class="badge badge-success-lighten badge-pill"><i class="fas fa-check"></i></span></td>
                                            </tr>
                                            <tr>
                                                <td>赚取用户提成</td>
                                                <td><span class="badge badge-success-lighten badge-pill"><i class="fas fa-check"></i></span></td>
                                                <td><span class="badge badge-success-lighten badge-pill"><i class="fas fa-check"></i></span></td>
                                            </tr>
                                            <tr>
                                                <td>赚取下级网站提成</td>
                                                <td><span class="badge badge-danger-lighten badge-pill"><i class="fas fa-times text-danger"></i></span></td>
                                                <td><span class="badge badge-success-lighten badge-pill"><i class="fas fa-check"></i></span></td>
                                            </tr>
                                            <tr>
                                                <td>搭建下级网站</td>
                                                <td><span class="badge badge-danger-lighten badge-pill"><i class="fas fa-times text-danger"></i></span></td>
                                                <td><span class="badge badge-success-lighten badge-pill"><i class="fas fa-check"></i></span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-dismiss="modal">关闭</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 d-md-none"></div>
        </div>
        <footer class="footer border-top border-light">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12  text-center ">
                        <?php echo date('Y'); ?> © <a href="../"><?php echo $conf['sitename']; ?></a> •
                        <?php echo $conf['bottom']; ?>
                    </div>
                </div>
            </div>
        </footer>
        </section>
    </div>
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
    if (isModal === undefined) var isModal = false;
    if (homepage === undefined) var homepage = false;
    if (is_app === undefined) var is_app = false;
    $(document).ready(function(){
        const actionDom = $("a[_action]");
        actionDom.removeClass('active');
        actionDom.parents('li').removeClass('active');
        const actionQueryDom = $("a[_action=site]");
        actionQueryDom.parents('li').addClass("active");
        actionQueryDom.addClass("active");
        if (actionQueryDom.parents('ul.collapse').length) actionQueryDom.parents('ul.collapse').addClass('in');
    });
</script>
</body>
</html>