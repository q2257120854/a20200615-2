<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8"/>
    <title><?php echo $conf['sitename'] . (empty($conf['title']) ? '' : ' - ' . $conf['title']); ?></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport"/>
    <meta name="keywords" content="<?php echo $conf['keywords']; ?>">
    <meta name="description" content="<?php echo $conf['description']; ?>">
    <link rel="shortcut icon" href="../favicon.ico">
    <link href="/assets/wxds/css/all.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/wxds/css/app.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/common/fancybox/jquery.fancybox.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/common/css/style.css" rel="stylesheet" type="text/css"/>
    <script src="//lib.baomitu.com/jquery/3.4.1/jquery.min.js"></script>
    <style type="text/css">
        ul.side-nav > li.active {
            background: #ffffff38;
        }

        ul.collapse > li.active {
            background: #7f79e888;
        }

        select.form-control {
            -webkit-appearance: none;
            outline: none;
        }
    </style>
    <script type="text/javascript">
        document.addEventListener("plusready", function () {
            var is_app = true;
            $('#AppDown').hide();
            $('footer').hide();
        }, false);
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
<div class="wrapper shadow-none bg-white">
    <div class="content-page">
        <div class="content position-relative">
            <div class="navbar-custom">
                <div class="fc-button-group topbar-right-menu float-right mb-0" style="padding: calc(32px / 2) 0;">
                    <a href="/user/login.php" pjax="no" class="btn btn-primary btn-sm mr-1">登录</a>
                    <a href="/user/reg.php" pjax="no" class="btn btn-light btn-sm">注册</a>
                </div>
                <a href="../" class="logo d-inline-block ml-2" style="line-height: 70px;">
                    <img src="/assets/img/logo.png" style="height: 30px;" alt="LOGO">
                </a>
            </div>
            <section id="pjax-container">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-none d-md-block">
                                <h4 class="page-title">更多功能</h4>
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
                                $(function () {
                                    $("a[_action=more]").addClass("active");
                                })
                            </script>
                            <style type="text/css">
                                .toll-free-box i {
                                    bottom: -10px;
                                }
                            </style>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-3 px-2 mb-n2">
                                <a href="?mod=site" data-pjax
                                   class="card btn-outline-danger overflow-hidden shadow-sm px-3 py-2">
                                    <div class="card-body">
                                        <div class="toll-free-box text-center">
                                            <h3><i class="fas fa-users"></i> 成为代理</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- class="col-6 col-md-3 px-2 mb-n2">
              <a href="http://kefu.wujiawang.cc/chat.html" data-pjax class="card btn-outline-warning overflow-hidden shadow-sm px-4 py-2">
                  <div class="card-body">
                      <div class="toll-free-box text-center">
                          <h3> <i class="fab fa-qq"></i> 联系客服</h3>
                      </div>
                  </div>
              </a>
          </div-->
                            <div class="col-6 col-md-3 px-2 mb-n2">
                                <a href="?mod=invite"
                                   class="card btn-outline-danger overflow-hidden shadow-sm px-3 py-2">
                                    <div class="card-body">
                                        <div class="toll-free-box text-center">
                                            <h3><i class="fas fa-share-alt"></i> 邀请有礼</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-md-3 px-2 mb-n2">
                                <a href="?mod=articlelist"
                                   class="card btn-outline-info overflow-hidden shadow-sm px-3 py-2">
                                    <div class="card-body">
                                        <div class="toll-free-box text-center">
                                            <h3><i class="fas fa-file-alt"></i> 文章教程</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- div class="col-6 col-md-3 px-2 mb-n2">
                                 <a href="?mod=faq" data-pjax class="card btn-outline-warning overflow-hidden shadow-sm px-4 py-2">
                                     <div class="card-body">
                                         <div class="toll-free-box text-center">
                                             <h3> <i class="mdi mdi-comment-question"></i> 常见问题</h3>
                                         </div>
                                     </div>
                                 </a>
                             </div-->
                        </div>
                    </div>
                </div>
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
    if (isModal === undefined) var isModal = false;
    if (homepage === undefined) var homepage = false;
    if (is_app === undefined) var is_app = false;
    $(document).ready(function () {
        $(document).pjax('a:not(a[target=_blank],a[pjax=no])', '#pjax-container', {
            fragment: ('#pjax-container'),
            timeout: 5000,
            maxCacheLength: 0,
            dataType: null,
        });
        $(document).on('submit', 'form', function (event) {
            $.pjax.submit(event, '#pjax-container', {
                fragment: '#pjax-container', timeout: 5000
            });
        });
        $(document).on('pjax:send', function () {
            $(".loading").css("display", "block");
            //NProgress.start();
        });
        $(document).on('pjax:complete', function () {
            if (homepage === true) {
                getcount();
            }
            document.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightBlock(block);
            });
            $(".loading").css("display", "none");
            //NProgress.done();
        });
        $("a[_action=more]").parents('li').addClass("active");
        $("a[_action=more]").addClass("active");
        if ($("a[_action=more]").parents('ul.collapse').length) $("a[_action=more]").parents('ul.collapse').addClass('in');
        $(document).on("click", "a[_action]", function () {
            $("a[_action]").parents('li').removeClass('active');
            $("a[_action]").removeClass('active');
            $(this).parents('li').addClass('active');
            $(this).addClass('active');
            if (!$(this).parents('ul.collapse').length) $('ul.collapse').removeClass('in');
        });
    });
</script>
</body>
</html>