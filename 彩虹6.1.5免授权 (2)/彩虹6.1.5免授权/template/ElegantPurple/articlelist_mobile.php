<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8"/>
    <title><?php echo $conf['sitename'] . (empty($conf['title']) ? '' : ' - ' . $conf['title']); ?></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport"/>
    <meta name="keywords" content="<?php echo $conf['keywords']; ?>">
    <meta name="description" content="<?php echo $conf['description']; ?>">
    <link rel="shortcut icon" href="/favicon.ico">
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
                                <div class="page-title-right">
                                </div>
                                <h4 class="page-title">文章教程</h4>
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
                        </div>
                        <div class="col-12">
                            <div class="app-search d-block">
                                <form action="/?mod=articlelist" method="get" data-pjax>
                                    <div class="input-group">
                                        <span class="fas fa-search"></span>
                                        <input type="text" class="form-control" placeholder="输入文章关键词" name="kw">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">搜索</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 px-1">
                            <div class="list-group">
                                <?php
                                $contents = $DB->select('article_list', ['title', 'id'], ['status' => 1, 'ORDER' => ['id' => 'DESC'], 'LIMIT' => 3]);
                                foreach ($contents as $content): ?>
                                <a target="_blank" style="font-size:13px; color:#4876FF" class="list-group-item" href="/route.php?s=index/<?php echo $content['id'] . '.html'; ?>"><?php echo strip_tags($content['title']); ?></a>
                                <?php endforeach; ?>
                                <?php if (!empty($contents)): ?>
                                <a href="/route.php?s=index/zy/" title="查看更多文章" class="btn-default btn btn-block" target="_blank">查看更多文章</a>
                                <?php else: ?>
                                <div class="text-center">暂无文章！</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <footer class="footer border-top border-light">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center ">
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
        $("a[_action=articlelist]").parents('li').addClass("active");
        $("a[_action=articlelist]").addClass("active");
        if ($("a[_action=articlelist]").parents('ul.collapse').length) $("a[_action=articlelist]").parents('ul.collapse').addClass('in');
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