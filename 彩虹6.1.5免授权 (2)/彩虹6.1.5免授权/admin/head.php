<?php @header('Content-Type: text/html; charset=UTF-8'); ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo $title ?></title>
    <link href="../assets/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../assets/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../assets/appui/css/main.css">
    <link rel="stylesheet" href="../assets/appui/css/themes.css">
    <link id="theme-link" rel="stylesheet"
          href="<?php echo !empty($_COOKIE['optionThemeColor']) ? $_COOKIE['optionThemeColor'] : '../assets/appui/css/themes/amethyst-2.4.css'; ?>">
    <script src="../assets/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="../assets/jquery/2.1.4/jquery.min.js"></script>
    <script src="../assets/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../assets/appui/js/plugins.js"></script>
    <script src="../assets/appui/js/app2.js"></script>
    <script src="../assets/layer/2.3/layer.js"></script>
    <!--[if lt IE 9]>
    <script src="../assets/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="../assets/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        var _hmt=_hmt||[];(function(){var hm=document.createElement("script");hm.src="https://hm.baidu.com/hm.js?430959f82a7f01776aeb986f3d46a102";var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm,s)})();
    </script>
    <style>
        .block {padding-bottom: 1rem;}
        h4 {font-family: "微软雅黑", Georgia, Serif, serif;}
    </style>
</head>
<body>
<?php if ($islogin == 1){ ?>
<!-- Start: Header -->
<div id="page-wrapper">
    <div id="page-container" class="header-fixed-top sidebar-visible-lg-full enable-cookies">
        <div id="sidebar-alt" tabindex="-1" aria-hidden="true">
            <a href="javascript:void(0)" id="sidebar-alt-close" onclick="App.sidebar('toggle-sidebar-alt');"><i
                        class="fa fa-times"></i></a>
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 888px;">
                <div id="sidebar-scroll-alt" style="overflow: hidden; width: auto; height: 888px;">
                    <div class="sidebar-content">
                        <div class="sidebar-section">
                            <h4 class="text-light">框架变色(New)</h4>
                            <br>
                            <ul class="sidebar-themes clearfix">
                                <li class="">
                                    <a href="javascript:void(0)" class="themed-background-default" data-toggle="tooltip"
                                       title="" data-theme="../assets/appui/css/themes/themes-2.2.css"
                                       data-theme-navbar="navbar-inverse" data-theme-sidebar="" data-original-title="">
                                        <span class="section-side themed-background-dark-default"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0)" class="themed-background-classy" data-toggle="tooltip"
                                       title="" data-theme="../assets/appui/css/themes/classy-2.4.css"
                                       data-theme-navbar="navbar-inverse" data-theme-sidebar="" data-original-title="">
                                        <span class="section-side themed-background-dark-classy"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0)" class="themed-background-social" data-toggle="tooltip"
                                       title="" data-theme="../assets/appui/css/themes/social-2.4.css"
                                       data-theme-navbar="navbar-inverse" data-theme-sidebar="" data-original-title="">
                                        <span class="section-side themed-background-dark-social"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0)" class="themed-background-flat" data-toggle="tooltip"
                                       title="" data-theme="../assets/appui/css/themes/flat-2.4.css"
                                       data-theme-navbar="navbar-inverse" data-theme-sidebar="" data-original-title="">
                                        <span class="section-side themed-background-dark-flat"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0)" class="themed-background-amethyst"
                                       data-toggle="tooltip" title=""
                                       data-theme="../assets/appui/css/themes/amethyst-2.4.css"
                                       data-theme-navbar="navbar-inverse" data-theme-sidebar="" data-original-title="">
                                        <span class="section-side themed-background-dark-amethyst"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0)" class="themed-background-creme" data-toggle="tooltip"
                                       title="" data-theme="../assets/appui/css/themes/creme-2.4.css"
                                       data-theme-navbar="navbar-inverse" data-theme-sidebar="" data-original-title="">
                                        <span class="section-side themed-background-dark-creme"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0)" class="themed-background-passion" data-toggle="tooltip"
                                       title="" data-theme="../assets/appui/css/themes/passion-2.4.css"
                                       data-theme-navbar="navbar-inverse" data-theme-sidebar="" data-original-title="">
                                        <span class="section-side themed-background-dark-passion"></span>
                                        <span class="section-content"></span>
                                    </a>
                                    <br>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-classy" data-toggle="tooltip"
                                       title="" data-theme="../assets/appui/css/themes/classy-2.4.css"
                                       data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light"
                                       data-original-title="">
                                        <span class="section-side"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-social" data-toggle="tooltip"
                                       title="" data-theme="../assets/appui/css/themes/social-2.4.css"
                                       data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light"
                                       data-original-title="">
                                        <span class="section-side"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-flat" data-toggle="tooltip"
                                       title="" data-theme="../assets/appui/css/themes/flat-2.4.css"
                                       data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light"
                                       data-original-title="">
                                        <span class="section-side"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-amethyst"
                                       data-toggle="tooltip" title=""
                                       data-theme="../assets/appui/css/themes/amethyst-2.4.css"
                                       data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light"
                                       data-original-title="">
                                        <span class="section-side"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-creme" data-toggle="tooltip"
                                       title="" data-theme="../assets/appui/css/themes/creme-2.4.css"
                                       data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light"
                                       data-original-title="">
                                        <span class="section-side"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-passion" data-toggle="tooltip"
                                       title="" data-theme="../assets/appui/css/themes/passion-2.4.css"
                                       data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light"
                                       data-original-title="">
                                        <span class="section-side"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>

                                <li class="">
                                    <a href="javascript:void(0)" class="themed-background-classy" data-toggle="tooltip"
                                       title="" data-theme="../assets/appui/css/themes/classy-2.4.css"
                                       data-theme-navbar="navbar-default" data-theme-sidebar="" data-original-title="">
                                        <span class="section-header"></span>
                                        <span class="section-side themed-background-dark-classy"></span>
                                        <span class="section-content"></span>
                                    </a>
                                    <br>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0)" class="themed-background-social" data-toggle="tooltip"
                                       title="" data-theme="../assets/appui/css/themes/social-2.4.css"
                                       data-theme-navbar="navbar-default" data-theme-sidebar="" data-original-title="">
                                        <span class="section-header"></span>
                                        <span class="section-side themed-background-dark-social"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-flat" data-toggle="tooltip"
                                       title="" data-theme="../assets/appui/css/themes/flat-2.4.css"
                                       data-theme-navbar="navbar-default" data-theme-sidebar="" data-original-title="">
                                        <span class="section-header"></span>
                                        <span class="section-side themed-background-dark-flat"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0)" class="themed-background-amethyst"
                                       data-toggle="tooltip" title=""
                                       data-theme="../assets/appui/css/themes/amethyst-2.4.css"
                                       data-theme-navbar="navbar-default" data-theme-sidebar="" data-original-title="">
                                        <span class="section-header"></span>
                                        <span class="section-side themed-background-dark-amethyst"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0)" class="themed-background-creme" data-toggle="tooltip"
                                       title="" data-theme="../assets/appui/css/themes/creme-2.4.css"
                                       data-theme-navbar="navbar-default" data-theme-sidebar="" data-original-title="">
                                        <span class="section-header"></span>
                                        <span class="section-side themed-background-dark-creme"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0)" class="themed-background-passion" data-toggle="tooltip"
                                       title="" data-theme="../assets/appui/css/themes/passion-2.4.css"
                                       data-theme-navbar="navbar-default" data-theme-sidebar="" data-original-title="">
                                        <span class="section-header"></span>
                                        <span class="section-side themed-background-dark-passion"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="slimScrollBar"
                     style="background: rgb(187, 187, 187); width: 3px; position: absolute; top: 0; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 888px;"></div>
                <div class="slimScrollRail"
                     style="width: 3px; height: 100%; position: absolute; top: 0; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 1; z-index: 90; right: 1px;"></div>
            </div>
        </div>
        <div id="sidebar">
            <div id="sidebar-brand" class="themed-background">
                <a href="./" class="sidebar-title">
                    <i class="fa fa-cube"></i> <span class="sidebar-nav-mini-hide">管理后台</span>
                </a>
            </div>
            <div id="sidebar-scroll">
                <div class="sidebar-content">
                    <ul class="sidebar-nav">
                        <?php
                        plugin\AdminMenu::addMenu('后台管理', './', 'index', 'fa fa-home');
                        plugin\AdminMenu::addMenu('订单管理', './orderList.php', 'orderList', 'fa fa-list');

                        plugin\AdminMenu::addMenu('商品管理','','','fa fa-shopping-cart');
                        plugin\AdminMenu::addMenu('分类列表','./classlist.php','classlist','','商品管理');
                        plugin\AdminMenu::addMenu('商品列表','./shoplist.php','shoplist,shopedit','','商品管理');
                        plugin\AdminMenu::addMenu('加价模板','./priceModel.php','priceModel','','商品管理');
                        plugin\AdminMenu::addMenu('卡密列表','./kmlist.php','kmlist','','商品管理');
                        //增加工具栏列表

                        plugin\AdminMenu::addMenu('发卡管理','','','fa fa-th');
                        plugin\AdminMenu::addMenu('库存管理','./fakalist.php','fakalist','','发卡管理');
                        plugin\AdminMenu::addMenu('添加卡密','./fakakms.php?my=add','fakakms','','发卡管理');
                        plugin\AdminMenu::addMenu('发信模板','./set.php?mod=mailcon','mailcon','','发卡管理');

                        plugin\AdminMenu::addMenu('分站管理','','','fa fa-sitemap');
                        plugin\AdminMenu::addMenu('分站列表','./sitelist.php','sitelist','','分站管理');
                        plugin\AdminMenu::addMenu('用户列表','./userlist.php','userlist','','分站管理');
                        plugin\AdminMenu::addMenu('收支明细','./record.php','record','','分站管理');
                        if($conf['fenzhan_tixian'] == 1)
                            plugin\AdminMenu::addMenu('余额提现','./tixian.php','tixian','','分站管理');
                        plugin\AdminMenu::addMenu('分站排行','./rank.php','rank','','分站管理');
                        plugin\AdminMenu::addMenu('工单列表','./workorder.php','workorder','','分站管理');
                        plugin\AdminMenu::addMenu('站内通知','./message.php','message','','分站管理');
                        plugin\AdminMenu::addMenu('分站设置','./set.php?mod=fenzhan','fenzhan','','分站管理');

                        plugin\AdminMenu::addMenu('对接设置','','','fa fa-cubes');
                        plugin\AdminMenu::addMenu('对接站点管理','./shequlist.php','shequlist,shequ','','对接设置');
                        plugin\AdminMenu::addMenu('价格监控','./pricejk.php','pricejk','','对接设置');
                        plugin\AdminMenu::addMenu('对接日志','./log.php','log','','对接设置');
                        plugin\AdminMenu::addMenu('克隆站点','./clone.php','clone,cloneset','','对接设置');


                        plugin\AdminMenu::addMenu('系统设置','','','fa fa-cog');
                        plugin\AdminMenu::addMenu('网站信息配置','./set.php?mod=site','set.php?mod=site,proxy,proxy_n','','系统设置');
                        plugin\AdminMenu::addMenu('网站公告配置','./set.php?mod=gonggao','gonggao,copygg','','系统设置');
                        plugin\AdminMenu::addMenu('发信邮箱配置','./set.php?mod=mailSetting','mailSetting','','系统设置');
                        plugin\AdminMenu::addMenu('支付接口配置','./set.php?mod=pay','pay,epay','','系统设置');
                        plugin\AdminMenu::addMenu('首页模板设置','./set.php?mod=template','template','','系统设置');
                        plugin\AdminMenu::addMenu('滑动验证配置','./set.php?mod=captcha','captcha','','系统设置');
                        plugin\AdminMenu::addMenu('网站Logo设置','./set.php?mod=upimg','upimg,upbgimg','','系统设置');
                        plugin\AdminMenu::addMenu('系统数据清理','./clean.php','clean','','系统设置');
                        plugin\AdminMenu::addMenu('检查版本更新','./update.php','update','','系统设置');

                        plugin\AdminMenu::addMenu('其它组件','','','fa fa-cogs');
                        plugin\AdminMenu::addMenu('每日签到设置','./set.php?mod=qiandao','qiandao','','其它组件');
                        plugin\AdminMenu::addMenu('推广链接设置','./invite.php','invite','','其它组件');
                        plugin\AdminMenu::addMenu('抽奖商品设置','./choujiang.php','choujiang','','其它组件');
                        plugin\AdminMenu::addMenu('防红接口设置','./set.php?mod=dwz','dwz','','其它组件');
                        
                        
                        plugin\AdminMenu::addMenu('员工管理','','','fa fa-user-circle-o');
                        plugin\AdminMenu::addMenu('新增账户','./AdminGroup.php?mod=addAdminAccount','addAdminAccount,editAdminAccount','','员工管理');
                        plugin\AdminMenu::addMenu('账户列表','./AdminGroup.php?mod=listAdminAccount','listAdminAccount','','员工管理');

//                        hook('renderAdminMenu',[]);

                        echo plugin\AdminMenu::fetch();
                        //渲染工具栏列表
                        ?>
                    </ul>
                </div>
            </div>
            <div id="sidebar-extra-info" class="sidebar-content sidebar-nav-mini-hide">
                <div class="progress progress-mini push-bit">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="100"
                         aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                </div>
                <div class="text-center">
                    <small><span id="year-copy">2018</span> © <a href="#"><?php echo $conf['sitename'] ?></a></small>
                </div>
            </div>
        </div>
        <div id="main-container">
            <header class="navbar navbar-inverse navbar-fixed-top">

                <ul class="nav navbar-nav-custom">
                    <li>
                        <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                            <i class="fa fa-ellipsis-v fa-fw animation-fadeInRight" id="sidebar-toggle-mini"></i>
                            <i class="fa fa-bars fa-fw animation-fadeInRight" id="sidebar-toggle-full"></i>菜单
                        </a>
                    </li>
                    <li>
                        <a href="javascript:" onclick="history.go(-1);">
                            <i class="fa fa-reply fa-fw animation-fadeInRight"></i> 返回
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav-custom pull-right">
                    <li>
                        <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt');this.blur();">
                            <i class="fa fa-wrench sidebar-nav-icon"></i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo ($conf['kfqq']) ? '//q2.qlogo.cn/headimg_dl?bs=qq&dst_uin=' . $conf['kfqq'] . '&src_uin=' . $conf['kfqq'] . '&fid=' . $conf['kfqq'] . '&spec=100&url_enc=0&referer=bu_interface&term_type=PC' : '../assets/img/user.png' ?>"
                                 alt="avatar">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-header text-center">
                                <strong>管理员用户</strong>
                            </li>
                            <li>
                                <a href="set.php?mod=account">
                                    <i class="fa fa-pencil-square fa-fw pull-right"></i>
                                    密码修改
                                </a>
                            </li>
                            <li>
                                <a href="../">
                                    <i class="fa fa-home fa-fw pull-right"></i>
                                    网站首页
                                </a>
                            </li>
                            <li class="divider">
                            </li>
                            <li>
                            <li>
                                <a href="login.php?logout">
                                    <i class="fa fa-power-off fa-fw pull-right"></i>
                                    退出登录
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </header>
            <div id="page-content">
                <div id="myDiv"></div>
                <div class="main pjaxmain">
                    <div class="content-header">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="header-section">
                                    <h1><?php echo $title ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php } ?>
