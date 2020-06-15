<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8" />
    <title><?php echo $conf['sitename'] . (empty($conf['title']) ? '' : ' - ' . $conf['title']); ?></title>
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
                <!--首页聊天代码-->
                <?php echo $conf['chatframe']; ?>
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
                <!--首页公告-->
                <?php echo $conf['anounce']; ?>
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
                <!--首页弹出公告-->
                <?php echo $conf['modal']; ?>
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
                    <p class="mt-1"><img
                            src="http://qr.liantu.com/api.php?text=<?php echo $conf['appurl']; ?>"
                            width="100%" alt="扫码下载APP"></p>
                    <p class="text-reset">注：不建议使用微信扫码，微信扫码请选择在浏览器打开！</p>
                    <div class="mt-1">
                        <a href="<?php echo $conf['appurl']; ?>" target="_blank" class="btn btn-warning text-white">直接下载</a>
                        <button type="button" class="btn btn-light" data-dismiss="modal">关闭</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wrapper shadow-none bg-white" >
    <div class="content-page">
        <div class="content position-relative">
            <div class="navbar-custom">
                <div class="fc-button-group topbar-right-menu float-right mb-0" style="padding: calc(32px / 2) 0;">
                    <a href="/user/login.php" pjax="no" class="btn btn-primary btn-sm mr-1">登录</a>
                    <a href="/user/reg.php" pjax="no" class="btn btn-light btn-sm" >注册</a>
                </div>
                <a href="../" class="logo d-inline-block ml-2" style="line-height: 70px;">
                    <img src="/assets/img/logo.png" style="height: 30px;" alt="LOGO">
                </a>
            </div>
            <section id="pjax-container">    <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-none d-md-block">
                                <h4 class="page-title">成为代理</h4>
                            </div>
                            <ul class="nav nav-pills nav-justified form-wizard-header mb-2" id="mobileNav">
                                <li class="nav-item">
                                    <a href="../" _action="index" class="nav-link rounded-0 pt-2 pb-2">
                                        <i class="fas fa-home mr-1"></i>
                                        <span>首页</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?mod=query" _action="query" class="nav-link rounded-0 pt-2 pb-2">
                                        <i class="fas fa-search mr-1"></i>
                                        <span>查单</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?mod=more" _action="more" class="nav-link rounded-0 pt-2 pb-2">
                                        <span>更多</span>
                                        <i class="fas fa-angle-double-right mr-1"></i>
                                    </a>
                                </li>
                            </ul>
                            <script type="text/javascript">
                                $(function(){
                                    $("a[_action=more]").addClass("active");
                                })
                            </script>                            </div>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="text-center">
                                        <img src="/assets/wxds/img/headsite.png" width="280px" alt="File not found Image">
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
            </section>
        </div>
        <footer class="footer border-top border-light">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12  text-center ">
                        <?php echo date('Y'); ?> © <a href="../"><?php echo $conf['sitename']; ?></a> •
                        <?php echo $conf['bottom']; ?>
                    </div>
                    <!--<div class="col-md-6">
                        <div class="text-md-right footer-links d-none d-md-block">
                            <a href="javascript: void(0);">About</a>
                            <a href="javascript: void(0);">Support</a>
                            <a href="javascript: void(0);">Contact Us</a>
                        </div>
                    </div>-->
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
    if(isModal === undefined) var isModal=false;
    if(homepage === undefined) var homepage=false;
    if(is_app === undefined) var is_app=false;
    $(document).ready(function(){
        $(document).pjax('a:not(a[target=_blank],a[pjax=no])', '#pjax-container', {
            fragment:('#pjax-container'),
            timeout:5000,
            maxCacheLength:0,
            dataType:null,
        });
        $(document).on('submit', 'form', function(event) {
            $.pjax.submit(event, '#pjax-container',{
                fragment:'#pjax-container', timeout:5000
            });
        });
        $(document).on('pjax:send', function() {
            $(".loading").css("display", "block");
            //NProgress.start();
        });
        $(document).on('pjax:complete', function() {
            if(homepage === true){
                getcount();
            }
            document.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightBlock(block);
            });
            $(".loading").css("display", "none");
            //NProgress.done();
        });
        $("a[_action=site]").parents('li').addClass("active");
        $("a[_action=site]").addClass("active");
        if($("a[_action=site]").parents('ul.collapse').length)$("a[_action=site]").parents('ul.collapse').addClass('in');
        $(document).on("click","a[_action]",function(){
            $("a[_action]").parents('li').removeClass('active');
            $("a[_action]").removeClass('active');
            $(this).parents('li').addClass('active');
            $(this).addClass('active');
            if(!$(this).parents('ul.collapse').length)$('ul.collapse').removeClass('in');
        });
    });
</script>
</body>
</html>