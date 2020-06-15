<!DOCTYPE html>
<html lang="cn-Zh">
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
                    <a href="/" class="side-nav-link">
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
                    <a href="/user/reg.php" pjax="no" class="btn btn-light btn-sm">注册</a>
                </div>
                <button class="button-menu-mobile open-left disable-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <section id="pjax-container">
                <div class="container-fluid" id="pjax-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-none d-md-block">
                                <div class="page-title-right">
                                    <div class="app-search py-0 d-md-block">
                                        <div class="input-group">
                                            <span class="fas fa-search"></span>
                                            <input type="text" class="form-control" placeholder="输入商品关键词" id="searchkw"
                                                   onkeydown="if(event.keyCode===13){$('#doSearch').click()}">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" id="doSearch" type="submit">搜索</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="page-title">商品列表</h4>
                            </div>
                        </div>
                        <div class="row mt-md-0" id="goodType">
                            <?php
                            $classhide = explode(',', $siterow['class']);
                            $list = $DB->select('class', '*', ['active' => 1, 'ORDER' => ['sort' => 'ASC']]);
                            foreach ($list as &$v) {
                                if ($is_fenzhan && in_array($v['cid'], $classhide)) {
                                    unset($v);
                                    continue;
                                }
                                if (empty($v["shopimg"])) {
                                    $productimg = $v["shopimg"];
                                    $v["shopimg"] = 'assets/img/Product/default.png';
                                }
                            }
                            ?>
                            <?php foreach ($list as $v): ?>
                                <div class="col-6 col-lg-4 px-1 px-md-2">
                                    <a href="javascript:void(0);" class="goodTypeChange"
                                       data-id="<?php echo $v['cid']; ?>">
                                        <div class="card mb-2 mb-md-3 shadow">
                                            <img class="card-img-top" src="<?php echo $v['shopimg']; ?>" width="100%"
                                                 alt="商品图片" style="min-height: 80px;">
                                            <div class="card-img-overlay d-none d-md-inline-block"
                                                 style="right: unset;bottom: unset;">
                                                <div class="badge badge-info text-white p-1"><?php echo $v['name']; ?></div>
                                            </div>
                                            <div class="card-body text-center py-2">
                                                <h5 class="card-title d-md-none"><?php echo $v['name']; ?></h5>
                                                <button class="btn btn-outline-primary btn-rounded btn-block">点击进入 <i
                                                            class="fas fa-chevron-circle-right"></i></button>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                            <div class="position-fixed wxd-b-menu">
                                <div class="mt-3" id="top" style="display: none;">
                                    <button class="btn btn-primary shadow wxd-b-but" style="padding:.55rem 1rem;">
                                        <i class="fas fa-angle-up" style="font-size: 30px;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-1" id="goodTypeContent" style="display: none">
                            <div class="row">
                                <div class="col-12 col-lg-6 text-center d-none d-md-inline-block mb-2">
                                    <img alt="Product" src="/assets/img/Product/default.png"
                                         class="rounded-lg border border-light shadow-sm" data-name="thumb" width="80%">
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <input type="hidden" name="cid" id="cid" value="0"/>
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
                                        <input type="text" name="need" id="need" class="form-control" disabled/>
                                    </div>
                                    <div class="input-group mb-2" id="display_left" style="display: none;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">库存数量</span>
                                        </div>
                                        <input type="text" name="leftcount" id="leftcount" class="form-control"
                                               disabled/>
                                    </div>
                                    <div class="form-group mb-2" id="display_num" style="display: none;">
                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">下单数量</span>
                                </span>
                                            <span class="input-group-btn input-group-prepend">
                                    <button id="num_min" class="btn btn-primary" type="button">━</button>
                                </span>
                                            <input id="num" name="num" class="form-control text-center" type="number"
                                                   min="1" value="1"/>
                                            <span class="input-group-btn input-group-append">
                                    <button id="num_add" class="btn btn-primary" type="button">✚</button>
                                </span>
                                            <span class="input-group-btn input-group-append">
                                    <a href="#numModel" data-toggle="modal" class="btn btn-warning text-white"><i
                                                class="fas fa-question-circle"></i></a>
                                </span>
                                        </div>
                                    </div>
                                    <div id="inputsname"></div>
                                    <input type="submit" id="submit_buy" class="btn btn-primary btn-block" value="立即购买">
                                </div>
                                <div class="col-12">
                                    <div id="alert_frame" class="alert alert-success"
                                         style="display:none;font-weight: bold;"></div>
                                </div>
                                <div class="position-fixed wxd-b-menu">
                                    <div class="mt-2">
                                        <button class="btn btn-danger shadow rounded-circle backType" title="返回重选分类">
                                            <i class="fas fa-times fa-2x"></i>
                                        </button>
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
                        var isModal = true;
                        var hashsalt = <?php echo $addsalt_js; ?>;
                    </script>
                </div>
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
    $(document).ready(function () {
        const actionDom = $("a[_action]");
        actionDom.removeClass('active');
        actionDom.parents('li').removeClass('active');
        const actionQueryDom = $("a[_action=index]");
        actionQueryDom.parents('li').addClass("active");
        actionQueryDom.addClass("active");
        if (actionQueryDom.parents('ul.collapse').length) actionQueryDom.parents('ul.collapse').addClass('in');
    });
</script>
</body>
</html>