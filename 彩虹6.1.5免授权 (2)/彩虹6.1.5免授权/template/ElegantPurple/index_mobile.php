<?php
if (!defined('IN_CRONLITE')) exit();
$classhide = explode(',', $siterow['class']);
?>
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
                    <a href="/user/reg.php" pjax="no" class="btn btn-light btn-sm" >注册</a>
                </div>
                <a href="../" class="logo d-inline-block ml-2" style="line-height: 70px;">
                    <img alt="" src="/assets/img/logo.png" style="height: 30px;">
                </a>
            </div>
            <section id="pjax-container">    <div class="container-fluid" id="pjax-container">
                    <div class="row">
                        <div class="col-12">
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
                                    $("a[_action=index]").addClass("active");
                                })
                            </script>
                        </div>
                        <div class="col-12 px-0 mt-n1">
                            <!--  <div class="alert alert-primary text-center mb-1 position-relative" id="AppDown"><img src="../assets/img/hot.png" class="position-absolute" style="max-height: 100%;left: 0;top: 0;border-top-left-radius:.25rem; "/> <a href="https://www.lanzous.com/i4u52pg" target="_blank"><b>【APP】点击这里下载APP，下单更方便！</b></a></div>-->
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content b-0 mb-0">
                                        <!-- 商城 -->
                                        <div class="tab-pane mx-n2 active" id="shop">
                                            <div class="input-group mb-2" id="display_selectclass" >
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">选择分类</span>
                                                </div>
                                                <select name="cid" id="cid" class="form-control">
                                                    <option value="0">请选择分类</option>
                                                    <?php
                                                    $rs = $DB->select('class', '*', ['active' => 1, 'ORDER' => ['sort' => 'ASC']]);
                                                    foreach ($rs as $res) {
                                                        if ($is_fenzhan && in_array($res['cid'], $classhide)) continue;
                                                        $select_count++;
                                                        $select .= '<option value="' . $res['cid'] . '">' . $res['name'] . '</option>';
                                                    }
                                                    echo $select;
                                                    ?>
                                                </select>
                                                <div class="input-group-append">
                                                    <span class="input-group-text onclick" title="搜索商品" id="showSearchBar"><i class="fas fa-search"></i></span>
                                                </div>
                                            </div>
                                            <div class="input-group mb-2" id="display_searchBar" style="display:none;">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">搜索商品</span>
                                                </div>
                                                <input type="text" id="searchkw" class="form-control" placeholder="搜索商品" onkeydown="if(event.keyCode==13){$('#doSearch').click()}"/>
                                                <div class="input-group-append">
                                                    <span class="input-group-text onclick" title="搜索" id="doSearch"><i class="fas fa-search"></i></span>
                                                    <span class="input-group-text onclick" title="关闭" id="closeSearchBar"><i class="fas fa-times"></i></span>
                                                </div>
                                            </div>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">选择商品</span>
                                                </div>
                                                <select name="tid" id="tid" class="form-control" onchange="getPoint();">
                                                    <option value="0">请选择商品</option>
                                                </select>
                                            </div>
                                            <div class="input-group mb-2" id="display_need" style="display: none;">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">商品价格</span>
                                                </div>
                                                <input type="text" name="need" style=" center;color:#4169E1; font-weight:bold" id="need" class="form-control" disabled/>
                                            </div>
                                            <div class="input-group mb-2" id="display_left" style="display: none;">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">库存数量</span>
                                                </div>
                                                <input type="text" name="leftcount" id="leftcount" class="form-control" disabled/>
                                            </div>
                                            <div class="form-group mb-2" id="display_num" style="display: none;">
                                                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">下单数量</span>
                                        </span>
                                                    <span class="input-group-btn input-group-prepend">
                                            <button id="num_min" class="btn btn-primary" type="button">━</button>
                                        </span>
                                                    <input id="num" name="num" class="form-control text-center" type="number" min="1" value="1"/>
                                                    <span class="input-group-btn input-group-append">
                                            <button id="num_add" class="btn btn-primary" type="button">✚</button>
                                        </span>
                                                    <span class="input-group-btn input-group-append">
                                            <a href="#numModel" data-toggle="modal" class="btn btn-warning text-white"><i class="fas fa-question-circle"></i></a>
                                        </span>
                                                </div>
                                            </div>
                                            <div id="inputsname"></div>
                                            <div id="alert_frame" class="alert alert-success" style="display:none;font-weight: bold;"></div>
                                            <input type="submit" id="submit_buy" class="btn btn-primary btn-block" value="立即购买">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="numModel">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="text-center my-3"><h3>数量说明</h3></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-dismiss="modal">关闭</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        var isModal=true;
                        var hashsalt = <?php echo $addsalt_js; ?>;
                    </script>
                </div>
                <!--客服聊天代码-->
                <?php echo $conf['chatframe']; ?>
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
        $("a[_action=index]").parents('li').addClass("active");
        $("a[_action=index]").addClass("active");
        if ($("a[_action=index]").parents('ul.collapse').length) $("a[_action=index]").parents('ul.collapse').addClass('in');
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