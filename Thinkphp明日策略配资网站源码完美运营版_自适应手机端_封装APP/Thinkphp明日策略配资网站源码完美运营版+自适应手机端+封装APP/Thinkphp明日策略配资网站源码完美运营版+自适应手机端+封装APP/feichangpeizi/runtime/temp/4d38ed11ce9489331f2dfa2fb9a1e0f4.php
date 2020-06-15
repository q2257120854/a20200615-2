<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:69:"/www/wwwroot/feichangpeizi/application/admin/view/module/install.html";i:1539839445;s:61:"/www/wwwroot/feichangpeizi/application/admin/view/layout.html";i:1539839443;s:46:"./application/common/builder/aside/layout.html";i:1539839468;s:53:"./application/common/builder/aside/blocks/recent.html";i:1539839466;s:53:"./application/common/builder/aside/blocks/online.html";i:1539839466;s:53:"./application/common/builder/aside/blocks/switch.html";i:1539839466;}*/ ?>
<!DOCTYPE html>
<!--[if IE 9]>         <html class="ie9 no-focus" lang="zh"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-focus" lang="zh"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title><?php echo (isset($page_title) && ($page_title !== '')?$page_title:'后台'); ?> | <?php echo config('web_site_title'); ?> </title>

    <meta name="description" content="<?php echo config('web_site_description'); ?>">
    <meta name="author" content="caiweiming">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0,user-scalable=0">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="__ADMIN_IMG__/favicons/favicon.ico">

    <link rel="icon" type="image/png" href="__ADMIN_IMG__/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="__ADMIN_IMG__/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="__ADMIN_IMG__/favicons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="__ADMIN_IMG__/favicons/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="__ADMIN_IMG__/favicons/favicon-192x192.png" sizes="192x192">

    <link rel="apple-touch-icon" sizes="57x57" href="__ADMIN_IMG__/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="__ADMIN_IMG__/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="__ADMIN_IMG__/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="__ADMIN_IMG__/favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="__ADMIN_IMG__/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="__ADMIN_IMG__/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="__ADMIN_IMG__/favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="__ADMIN_IMG__/favicons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="__ADMIN_IMG__/favicons/apple-touch-icon-180x180.png">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
    <?php if(!(empty($_css_files) || (($_css_files instanceof \think\Collection || $_css_files instanceof \think\Paginator ) && $_css_files->isEmpty()))): if(\think\Config::get('minify_status') == '1'): ?>
            <link rel="stylesheet" href="<?php echo minify('group', $_css_files); ?>">
        <?php else: if(is_array($_css_files) || $_css_files instanceof \think\Collection || $_css_files instanceof \think\Paginator): $i = 0; $__LIST__ = $_css_files;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$css): $mod = ($i % 2 );++$i;?>
            <?php echo load_assets($css); endforeach; endif; else: echo "" ;endif; endif; endif; ?>


    

    <!-- Bootstrap and OneUI CSS framework -->
    <?php if(\think\Config::get('minify_status') == '1'): ?>
    <link rel="stylesheet" id="css-main" href="<?php echo minify('group', 'libs_css,core_css'); ?>">
    <?php else: ?>
    <link rel="stylesheet" href="__LIBS__/sweetalert/sweetalert.min.css">
    <link rel="stylesheet" href="__LIBS__/bootstrap3-editable/css/bootstrap-editable.css">
    <link rel="stylesheet" href="__LIBS__/magnific-popup/magnific-popup.min.css">
    <link rel="stylesheet" href="__ADMIN_CSS__/bootstrap.min.css">
    <link rel="stylesheet" href="__ADMIN_CSS__/oneui.css">
    <link rel="stylesheet" href="__ADMIN_CSS__/dolphin.css" id="css-main">
    <?php endif; ?>
    <link rel="stylesheet" id="css-theme" href="__ADMIN_CSS__/themes/<?php echo config('system_color'); ?>.min.css">

    <!--页面css-->
    
    <?php if(!(empty($_pop) || (($_pop instanceof \think\Collection || $_pop instanceof \think\Paginator ) && $_pop->isEmpty()))): ?>
    <style>
        #page-container.sidebar-l.sidebar-o {
            padding-left: 0;
        }
        .header-navbar-fixed #main-container {
            padding-top: 0;
        }
    </style>
    <?php endif; ?>
    <!-- END Stylesheets -->

    <!--自定义css-->
    <link rel="stylesheet" href="__ADMIN_CSS__/custom.css">
    <script>
        // url
        var dolphin = {
            'top_menu_url': '<?php echo url("admin/ajax/getSidebarMenu"); ?>',
            'theme_url': '<?php echo url("admin/ajax/setTheme"); ?>',
            'jcrop_upload_url': '<?php echo url("admin/attachment/upload", ["dir" => "images", "from" => "jcrop", "module" => request()->module()]); ?>',
            'editormd_upload_url': '<?php echo url("admin/attachment/upload", ["dir" => "images", "from" => "editormd", "module" => request()->module()]); ?>',
            'editormd_mudule_path': '__LIBS__/editormd/lib/',
            'ueditor_upload_url': '<?php echo url("admin/attachment/upload", ["dir" => "images", "from" => "ueditor", "module" => request()->module()]); ?>',
            'wangeditor_upload_url': '<?php echo url("admin/attachment/upload", ["dir" => "images", "from" => "wangeditor", "module" => request()->module()]); ?>',
            'wangeditor_emotions': "__LIBS__/wang-editor/emotions.data",
            'ckeditor_img_upload_url': '<?php echo url("admin/attachment/upload", ["dir" => "images", "from" => "ckeditor", "module" => request()->module()]); ?>',
            'WebUploader_swf': '__LIBS__/webuploader/Uploader.swf',
            'file_upload_url': '<?php echo url("admin/attachment/upload", ["dir" => "files", "module" => request()->module()]); ?>',
            'image_upload_url': '<?php echo url("admin/attachment/upload", ["dir" => "images", "module" => request()->module()]); ?>',
            'upload_check_url': '<?php echo url("admin/attachment/check"); ?>',
            'get_level_data': '<?php echo url("admin/ajax/getLevelData"); ?>',
            'quick_edit_url': '<?php echo url("quickEdit"); ?>',
            'aside_edit_url': '<?php echo url("admin/system/quickEdit"); ?>',
            'triggers': <?php echo json_encode((isset($field_triggers) && ($field_triggers !== '')?$field_triggers:[])); ?>, // 触发器集合
            'field_hide': '<?php echo (isset($field_hide) && ($field_hide !== '')?$field_hide:""); ?>', // 需要隐藏的字段
            'field_values': '<?php echo (isset($field_values) && ($field_values !== '')?$field_values:""); ?>',
            'validate': '<?php echo (isset($validate) && ($validate !== '')?$validate:""); ?>', // 验证器
            'validate_fields': '<?php echo (isset($validate_fields) && ($validate_fields !== '')?$validate_fields:""); ?>', // 验证字段
            'search_field': '<?php echo input("param.search_field", ""); ?>', // 搜索字段
            // 字段过滤
            '_filter': '<?php echo \think\Request::instance()->param('_filter')?\think\Request::instance()->param('_filter') : (isset($_filter) ? $_filter : ""); ?>',
            '_filter_content': '<?php echo \think\Request::instance()->param('_filter_content')==''?(isset($_filter_content) ? $_filter_content : "") : \think\Request::instance()->param('_filter_content'); ?>',
            '_field_display': '<?php echo \think\Request::instance()->param('_field_display')?\think\Request::instance()->param('_field_display') : (isset($_field_display) ? $_field_display : ""); ?>',
            'get_filter_list': '<?php echo url("admin/ajax/getFilterList"); ?>',
            'curr_url': '<?php echo url("", \think\Request::instance()->route()); ?>',
            'curr_params': <?php echo json_encode(\think\Request::instance()->param()); ?>,
            'layer': <?php echo json_encode(config("zbuilder.pop")); ?>
        };
    </script>
</head>
<body>
<!-- Page Container -->
<div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed <?php if(!empty($_COOKIE['sidebarMini']) && $_COOKIE['sidebarMini']=='true') echo  'sidebar-mini'; ?>">
    <!-- Side Overlay-->
    <?php if(empty($_pop) || (($_pop instanceof \think\Collection || $_pop instanceof \think\Paginator ) && $_pop->isEmpty())): ?>
    
    <aside id="side-overlay">
        <!-- Side Overlay Scroll Container -->
        <div id="side-overlay-scroll">
            <!-- Side Header -->
            <div class="side-header side-content">
                <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                <button class="btn btn-default pull-right" type="button" data-toggle="layout" data-action="side_overlay_close">
                    <i class="fa fa-times"></i>
                </button>
                <span>
                    <img class="img-avatar img-avatar32" src="__ADMIN_IMG__/avatar.jpg" alt="">
                    <span class="font-w600 push-10-l"><?php echo session('user_auth.username'); ?></span>
                </span>
            </div>
            <!-- END Side Header -->
            <!--侧栏-->
            <!-- Side Content -->
<div class="side-content remove-padding-t" id="aside">
    <!-- Side Overlay Tabs -->
    <div class="block pull-r-l border-t">
        <?php if(!(empty($aside['tab_nav']) || (($aside['tab_nav'] instanceof \think\Collection || $aside['tab_nav'] instanceof \think\Paginator ) && $aside['tab_nav']->isEmpty()))): ?>
        <ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs">
            <?php if(is_array($aside['tab_nav']['tab_list']) || $aside['tab_nav']['tab_list'] instanceof \think\Collection || $aside['tab_nav']['tab_list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $aside['tab_nav']['tab_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i;?>
            <li <?php if(!empty($aside['tab_nav']['curr_tab']) && $aside['tab_nav']['curr_tab']==$key) echo 'class="active"'; ?>>
                <a href="#<?php echo $key; ?>"><?php echo $tab; ?></a>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <?php endif; if(!(empty($aside['tab_con']) || (($aside['tab_con'] instanceof \think\Collection || $aside['tab_con'] instanceof \think\Paginator ) && $aside['tab_con']->isEmpty()))): ?>
        <div class="block-content tab-content">
            <?php if(is_array($aside['tab_con']) || $aside['tab_con'] instanceof \think\Collection || $aside['tab_con'] instanceof \think\Paginator): $i = 0; $__LIST__ = $aside['tab_con'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$con): $mod = ($i % 2 );++$i;?>
            <div class="tab-pane fade fade-right <?php if(!empty($aside['tab_nav']['curr_tab']) && $aside['tab_nav']['curr_tab']==$key) echo 'in active'; ?>" id="<?php echo $key; ?>">
                <?php if(!(empty($con) || (($con instanceof \think\Collection || $con instanceof \think\Paginator ) && $con->isEmpty()))): if(is_array($con) || $con instanceof \think\Collection || $con instanceof \think\Paginator): $i = 0; $__LIST__ = $con;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_block): $mod = ($i % 2 );++$i;switch($_block['type']): case "recent": ?>
<div class="block pull-r-l">
    <div class="block-header bg-gray-lighter">
        <ul class="block-options">
            <li>
                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
            <li>
                <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
            </li>
        </ul>
        <h3 class="block-title"><?php echo (isset($_block['title']) && ($_block['title'] !== '')?$_block['title']:''); ?></h3>
    </div>
    <div class="block-content">
        <?php if(!(empty($_block['list']) || (($_block['list'] instanceof \think\Collection || $_block['list'] instanceof \think\Paginator ) && $_block['list']->isEmpty()))): ?>
        <ul class="list list-activity">
            <?php if(is_array($_block['list']) || $_block['list'] instanceof \think\Collection || $_block['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $_block['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
                <?php if(!(empty($vo['icon']) || (($vo['icon'] instanceof \think\Collection || $vo['icon'] instanceof \think\Paginator ) && $vo['icon']->isEmpty()))): ?><i class="<?php echo $vo['icon']; ?>"></i><?php endif; ?>
                <div class="font-w600"><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></div>
                <div>
                    <?php if(!(empty($vo['link']['url']) || (($vo['link']['url'] instanceof \think\Collection || $vo['link']['url'] instanceof \think\Paginator ) && $vo['link']['url']->isEmpty()))): ?>
                        <a href="<?php echo $vo['link']['url']; ?>"><?php echo (isset($vo['link']['title']) && ($vo['link']['title'] !== '')?$vo['link']['title']:''); ?></a>
                    <?php else: ?>
                        <?php echo (isset($vo['link']['title']) && ($vo['link']['title'] !== '')?$vo['link']['title']:''); endif; ?>
                </div>
                <?php if(!(empty($vo['tips']) || (($vo['tips'] instanceof \think\Collection || $vo['tips'] instanceof \think\Paginator ) && $vo['tips']->isEmpty()))): ?>
                <div><small class="text-muted"><?php echo $vo['tips']; ?></small></div>
                <?php endif; ?>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <?php endif; ?>
    </div>
</div>
<?php break; case "online": ?>
<div class="block pull-r-l">
    <div class="block-header bg-gray-lighter">
        <ul class="block-options">
            <li>
                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
            <li>
                <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
            </li>
        </ul>
        <h3 class="block-title"><?php echo (isset($_block['title']) && ($_block['title'] !== '')?$_block['title']:''); ?></h3>
    </div>
    <div class="block-content block-content-full">
        <?php if(!(empty($_block['list']) || (($_block['list'] instanceof \think\Collection || $_block['list'] instanceof \think\Paginator ) && $_block['list']->isEmpty()))): ?>
        <ul class="nav-users remove-margin-b">
            <?php if(is_array($_block['list']) || $_block['list'] instanceof \think\Collection || $_block['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $_block['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
                <a href="<?php echo (isset($vo['link']) && ($vo['link'] !== '')?$vo['link']:'javascript:void(0);'); ?>">
                    <img class="img-avatar" src="<?php echo (isset($vo['avatar']) && ($vo['avatar'] !== '')?$vo['avatar']:'__ADMIN_IMG__/avatar.jpg'); ?>" alt="">
                    <i class="fa fa-circle text-<?php echo !empty($vo['online'])?'success' : 'warning'; ?>"></i> <?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>
                    <div class="font-w400 text-muted"><small><?php echo (isset($vo['tips']) && ($vo['tips'] !== '')?$vo['tips']:''); ?></small></div>
                </a>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <?php endif; ?>
    </div>
</div>
<?php break; case "switch": ?>
<div class="block pull-r-l">
    <div class="block-header bg-gray-lighter">
        <ul class="block-options">
            <li>
                <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
            </li>
        </ul>
        <h3 class="block-title"><?php echo (isset($_block['title']) && ($_block['title'] !== '')?$_block['title']:''); ?></h3>
    </div>
    <div class="block-content">
        <?php if(!(empty($_block['list']) || (($_block['list'] instanceof \think\Collection || $_block['list'] instanceof \think\Paginator ) && $_block['list']->isEmpty()))): ?>
        <div class="form-bordered">
            <?php if(is_array($_block['list']) || $_block['list'] instanceof \think\Collection || $_block['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $_block['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-8">
                        <div class="font-s13 font-w600"><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></div>
                        <div class="font-s13 font-w400 text-muted"><?php echo (isset($vo['tips']) && ($vo['tips'] !== '')?$vo['tips']:''); ?></div>
                    </div>
                    <div class="col-xs-4 text-right">
                        <label class="css-input switch switch-sm switch-primary push-10-t">
                            <input type="checkbox" data-table="<?php echo (isset($vo['table']) && ($vo['table'] !== '')?$vo['table']:''); ?>" data-id="<?php echo (isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:''); ?>" data-field="<?php echo (isset($vo['field']) && ($vo['field'] !== '')?$vo['field']:''); ?>" <?php if(!empty($vo['checked'])) echo  'checked=""'; ?>><span></span>
                        </label>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php break; endswitch; endforeach; endif; else: echo "" ;endif; endif; ?>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <?php endif; if(!(empty($aside['blocks']) || (($aside['blocks'] instanceof \think\Collection || $aside['blocks'] instanceof \think\Paginator ) && $aside['blocks']->isEmpty()))): ?>
        <div class="block-content">
            <?php if(is_array($aside['blocks']) || $aside['blocks'] instanceof \think\Collection || $aside['blocks'] instanceof \think\Paginator): $i = 0; $__LIST__ = $aside['blocks'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_block): $mod = ($i % 2 );++$i;switch($_block['type']): case "recent": ?>
<div class="block pull-r-l">
    <div class="block-header bg-gray-lighter">
        <ul class="block-options">
            <li>
                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
            <li>
                <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
            </li>
        </ul>
        <h3 class="block-title"><?php echo (isset($_block['title']) && ($_block['title'] !== '')?$_block['title']:''); ?></h3>
    </div>
    <div class="block-content">
        <?php if(!(empty($_block['list']) || (($_block['list'] instanceof \think\Collection || $_block['list'] instanceof \think\Paginator ) && $_block['list']->isEmpty()))): ?>
        <ul class="list list-activity">
            <?php if(is_array($_block['list']) || $_block['list'] instanceof \think\Collection || $_block['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $_block['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
                <?php if(!(empty($vo['icon']) || (($vo['icon'] instanceof \think\Collection || $vo['icon'] instanceof \think\Paginator ) && $vo['icon']->isEmpty()))): ?><i class="<?php echo $vo['icon']; ?>"></i><?php endif; ?>
                <div class="font-w600"><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></div>
                <div>
                    <?php if(!(empty($vo['link']['url']) || (($vo['link']['url'] instanceof \think\Collection || $vo['link']['url'] instanceof \think\Paginator ) && $vo['link']['url']->isEmpty()))): ?>
                        <a href="<?php echo $vo['link']['url']; ?>"><?php echo (isset($vo['link']['title']) && ($vo['link']['title'] !== '')?$vo['link']['title']:''); ?></a>
                    <?php else: ?>
                        <?php echo (isset($vo['link']['title']) && ($vo['link']['title'] !== '')?$vo['link']['title']:''); endif; ?>
                </div>
                <?php if(!(empty($vo['tips']) || (($vo['tips'] instanceof \think\Collection || $vo['tips'] instanceof \think\Paginator ) && $vo['tips']->isEmpty()))): ?>
                <div><small class="text-muted"><?php echo $vo['tips']; ?></small></div>
                <?php endif; ?>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <?php endif; ?>
    </div>
</div>
<?php break; case "online": ?>
<div class="block pull-r-l">
    <div class="block-header bg-gray-lighter">
        <ul class="block-options">
            <li>
                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
            <li>
                <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
            </li>
        </ul>
        <h3 class="block-title"><?php echo (isset($_block['title']) && ($_block['title'] !== '')?$_block['title']:''); ?></h3>
    </div>
    <div class="block-content block-content-full">
        <?php if(!(empty($_block['list']) || (($_block['list'] instanceof \think\Collection || $_block['list'] instanceof \think\Paginator ) && $_block['list']->isEmpty()))): ?>
        <ul class="nav-users remove-margin-b">
            <?php if(is_array($_block['list']) || $_block['list'] instanceof \think\Collection || $_block['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $_block['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
                <a href="<?php echo (isset($vo['link']) && ($vo['link'] !== '')?$vo['link']:'javascript:void(0);'); ?>">
                    <img class="img-avatar" src="<?php echo (isset($vo['avatar']) && ($vo['avatar'] !== '')?$vo['avatar']:'__ADMIN_IMG__/avatar.jpg'); ?>" alt="">
                    <i class="fa fa-circle text-<?php echo !empty($vo['online'])?'success' : 'warning'; ?>"></i> <?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>
                    <div class="font-w400 text-muted"><small><?php echo (isset($vo['tips']) && ($vo['tips'] !== '')?$vo['tips']:''); ?></small></div>
                </a>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <?php endif; ?>
    </div>
</div>
<?php break; case "switch": ?>
<div class="block pull-r-l">
    <div class="block-header bg-gray-lighter">
        <ul class="block-options">
            <li>
                <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
            </li>
        </ul>
        <h3 class="block-title"><?php echo (isset($_block['title']) && ($_block['title'] !== '')?$_block['title']:''); ?></h3>
    </div>
    <div class="block-content">
        <?php if(!(empty($_block['list']) || (($_block['list'] instanceof \think\Collection || $_block['list'] instanceof \think\Paginator ) && $_block['list']->isEmpty()))): ?>
        <div class="form-bordered">
            <?php if(is_array($_block['list']) || $_block['list'] instanceof \think\Collection || $_block['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $_block['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-8">
                        <div class="font-s13 font-w600"><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></div>
                        <div class="font-s13 font-w400 text-muted"><?php echo (isset($vo['tips']) && ($vo['tips'] !== '')?$vo['tips']:''); ?></div>
                    </div>
                    <div class="col-xs-4 text-right">
                        <label class="css-input switch switch-sm switch-primary push-10-t">
                            <input type="checkbox" data-table="<?php echo (isset($vo['table']) && ($vo['table'] !== '')?$vo['table']:''); ?>" data-id="<?php echo (isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:''); ?>" data-field="<?php echo (isset($vo['field']) && ($vo['field'] !== '')?$vo['field']:''); ?>" <?php if(!empty($vo['checked'])) echo  'checked=""'; ?>><span></span>
                        </label>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php break; case "html": ?>
                        <?php echo (isset($_block['title']) && ($_block['title'] !== '')?$_block['title']:''); break; endswitch; endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <?php endif; ?>
    </div>
    <!-- END Side Overlay Tabs -->
</div>
<!-- END Side Content -->
        </div>
        <!-- END Side Overlay Scroll Container -->
    </aside>
    
    <?php endif; ?>
    <!-- END Side Overlay -->

    <!-- Sidebar -->
    <?php if(empty($_pop) || (($_pop instanceof \think\Collection || $_pop instanceof \think\Paginator ) && $_pop->isEmpty())): ?>
    
    <nav id="sidebar">
        <!-- Sidebar Scroll Container -->
        <div id="sidebar-scroll">
            <!-- Sidebar Content -->
            <!-- Adding .sidebar-mini-hide to an element will hide it when the sidebar is in mini mode -->
            <div class="sidebar-content">
                <!-- Side Header -->
                <div class="side-header side-content bg-white-op dolphin-header">
                    <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                    <button class="btn btn-link text-gray pull-right hidden-md hidden-lg" type="button" data-toggle="layout" data-action="sidebar_close">
                        <i class="fa fa-times"></i>
                    </button>
                    <!-- Themes functionality initialized in App() -> uiHandleTheme() -->
                    <div class="btn-group pull-right">
                        <button class="btn btn-link text-gray dropdown-toggle" data-toggle="dropdown" type="button">
                            <i class="si si-drop"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right font-s13 sidebar-mini-hide">
                            <li <?php if(!empty($system_color) && $system_color=='modern') echo  'class="active"'; ?>>
                                <a data-toggle="theme" data-theme="modern" data-css="__ADMIN_CSS__/themes/modern.min.css" tabindex="-1" href="javascript:void(0)">
                                    <i class="fa fa-circle text-modern pull-right"></i> <span class="font-w600">Modern</span>
                                </a>
                            </li>
                            <li <?php if(!empty($system_color) && $system_color=='amethyst') echo  'class="active"'; ?>>
                                <a data-toggle="theme" data-theme="amethyst" data-css="__ADMIN_CSS__/themes/amethyst.min.css" tabindex="-1" href="javascript:void(0)">
                                    <i class="fa fa-circle text-amethyst pull-right"></i> <span class="font-w600">Amethyst</span>
                                </a>
                            </li>
                            <li <?php if(!empty($system_color) && $system_color=='city') echo  'class="active"'; ?>>
                                <a data-toggle="theme" data-theme="city" data-css="__ADMIN_CSS__/themes/city.min.css" tabindex="-1" href="javascript:void(0)">
                                    <i class="fa fa-circle text-city pull-right"></i> <span class="font-w600">City</span>
                                </a>
                            </li>
                            <li <?php if(!empty($system_color) && $system_color=='flat') echo  'class="active"'; ?>>
                                <a data-toggle="theme" data-theme="flat" data-css="__ADMIN_CSS__/themes/flat.min.css" tabindex="-1" href="javascript:void(0)">
                                    <i class="fa fa-circle text-flat pull-right"></i> <span class="font-w600">Flat</span>
                                </a>
                            </li>
                            <li <?php if(!empty($system_color) && $system_color=='smooth') echo  'class="active"'; ?>>
                                <a data-toggle="theme" data-theme="smooth" data-css="__ADMIN_CSS__/themes/smooth.min.css" tabindex="-1" href="javascript:void(0)">
                                    <i class="fa fa-circle text-smooth pull-right"></i> <span class="font-w600">Smooth</span>
                                </a>
                            </li>
                            <li <?php if(!empty($system_color) && $system_color=='default') echo  'class="active"'; ?>>
                                <a data-toggle="theme" data-theme="default" tabindex="-1" href="javascript:void(0)">
                                    <i class="fa fa-circle text-default pull-right"></i> <span class="font-w600">Default</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <a class="h5 text-white" href="<?php echo url('admin/index/index'); ?>">
                        <?php if(!(empty(\think\Config::get('web_site_logo')) || ((\think\Config::get('web_site_logo') instanceof \think\Collection || \think\Config::get('web_site_logo') instanceof \think\Paginator ) && \think\Config::get('web_site_logo')->isEmpty()))): ?>
                        <img src="<?php echo get_file_path(\think\Config::get('web_site_logo')); ?>" class="logo" alt="<?php echo (\think\Config::get('web_site_title') ?: 'Dolphin PHP'); ?>">
                        <?php else: ?>
                        <img src="/public/static/admin/img/logo.png" class="logo" >
                        <?php endif; ?>

                    </a>
                </div>
                <!-- END Side Header -->

                <!-- Side Content -->
                <div class="side-content" id="sidebar-menu">
                    <?php if(!(empty($_sidebar_menus) || (($_sidebar_menus instanceof \think\Collection || $_sidebar_menus instanceof \think\Paginator ) && $_sidebar_menus->isEmpty()))): ?>
                    <ul class="nav-main" id="nav-<?php echo $_location[0]['id']; ?>">
                        <?php if(is_array($_sidebar_menus) || $_sidebar_menus instanceof \think\Collection || $_sidebar_menus instanceof \think\Paginator): $i = 0; $__LIST__ = $_sidebar_menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?>
                        <li <?php if(!empty($menu['id']) && $menu['id']==$_location[1]["id"]) echo 'class="open"'; ?>>
                            <?php if(!(empty($menu['url_value']) || (($menu['url_value'] instanceof \think\Collection || $menu['url_value'] instanceof \think\Paginator ) && $menu['url_value']->isEmpty()))): ?>
                                <a <?php if(($menu['id'] == $_location[1]["id"])): ?>class="active"<?php endif; ?> href="<?php echo $menu['url_value']; ?>" target="<?php echo $menu['url_target']; ?>"><i class="<?php echo $menu['icon']; ?>"></i><span class="sidebar-mini-hide"><?php echo $menu['title']; ?></span></a>
                            <?php else: ?>
                                <a class="nav-submenu" data-toggle="nav-submenu" href="javascript:void(0);"><i class="<?php echo $menu['icon']; ?>"></i><span class="sidebar-mini-hide"><?php echo $menu['title']; ?></span></a>
                            <?php endif; if(!(empty($menu['child']) || (($menu['child'] instanceof \think\Collection || $menu['child'] instanceof \think\Paginator ) && $menu['child']->isEmpty()))): ?>
                            <ul>
                                <?php if(is_array($menu['child']) || $menu['child'] instanceof \think\Collection || $menu['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $menu['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$submenu): $mod = ($i % 2 );++$i;?>
                                <li>
                                    <a <?php if((isset($_location[2]) && $submenu['id'] == $_location[2]["id"])): ?>class="active"<?php endif; ?> href="<?php echo $submenu['url_value']; ?>" target="<?php echo $submenu['url_target']; ?>"><i class="<?php echo $submenu['icon']; ?>"></i><?php echo $submenu['title']; ?></a>
                                </li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <?php endif; ?>
                </div>
                <!-- END Side Content -->
            </div>
            <!-- Sidebar Content -->
        </div>
        <!-- END Sidebar Scroll Container -->
    </nav>
    
    <?php endif; ?>
    <!-- END Sidebar -->

    <!-- Header -->
    <?php if(empty($_pop) || (($_pop instanceof \think\Collection || $_pop instanceof \think\Paginator ) && $_pop->isEmpty())): ?>
    
    <header id="header-navbar" class="content-mini content-mini-full">
        <!-- Header Navigation Right -->
        <ul class="nav-header pull-right">
            <li>
                <div class="btn-group">
                    <button class="btn btn-default btn-image dropdown-toggle" data-toggle="dropdown" type="button">
                        <img src="<?php echo get_avatar(\think\Session::get('user_auth.avatar')); ?>" alt="<?php echo session('user_auth.username'); ?>">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-header"><?php echo session('user_auth.username'); ?> (<?php echo session('user_auth.role_name'); ?>)</li>
                        <li>
                            <a tabindex="-1" href="<?php echo url('admin/index/profile'); ?>">
                                <i class="si si-settings pull-right"></i>个人设置
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a tabindex="-1" href="<?php echo url('user/publics/signout'); ?>">
                                <i class="si si-logout pull-right"></i>退出帐号
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a class="btn btn-default ajax-get" href="<?php echo url('admin/index/wipeCache'); ?>" data-toggle="tooltip" data-placement="bottom" data-original-title="清空缓存">
                    <i class="fa fa-trash"></i>
                </a>
            </li>
            <li>
                <a class="btn btn-default" href="/index.php" target="_blank" data-toggle="tooltip" data-placement="bottom" data-original-title="打开前台">
                    <i class="fa fa-external-link-square"></i>
                </a>
            </li>
            <li>
                <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                <button class="btn btn-default" data-toggle="layout" data-action="side_overlay_toggle" title="侧边栏" type="button">
                    <i class="fa fa-tasks"></i>
                </button>
            </li>
        </ul>
        <!-- END Header Navigation Right -->

        <!-- Header Navigation Left -->
        <ul class="nav nav-pills pull-left">
            <li class="hidden-md hidden-lg">
                <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                <a href="javascript:void(0)" data-toggle="layout" data-action="sidebar_toggle"><i class="fa fa-navicon"></i></a>
            </li>
            <li class="hidden-xs hidden-sm">
                <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                <a href="javascript:void(0)" title="打开/关闭左侧导航" data-toggle="layout" data-action="sidebar_mini_toggle"><i class="fa fa-bars"></i></a>
            </li>
            <?php if(!(empty($_top_menus) || (($_top_menus instanceof \think\Collection || $_top_menus instanceof \think\Paginator ) && $_top_menus->isEmpty()))): if(is_array($_top_menus) || $_top_menus instanceof \think\Collection || $_top_menus instanceof \think\Paginator): $i = 0; $__LIST__ = $_top_menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?>
            <li class="hidden-xs hidden-sm <?php if(!empty($menu['id']) && $menu['id']==$_location[0]['id']) echo  'active'; ?>">
                <?php if($menu['url_type'] == 'module'): ?>
                <a href="javascript:void(0);" data-module-id="<?php echo $menu['id']; ?>" data-module="<?php echo $menu['module']; ?>" data-controller="<?php echo $menu['controller']; ?>" target="<?php echo $menu['url_target']; ?>" class="top-menu"><i class="<?php echo $menu['icon']; ?>"></i> <?php echo $menu['title']; ?></a>
                <?php else: ?>
                <a href="<?php echo $menu['url_value']; ?>" target="<?php echo $menu['url_target']; ?>"><i class="<?php echo $menu['icon']; ?>"></i> <?php echo $menu['title']; ?></a>
                <?php endif; ?>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
            <li>
                <!-- Opens the Apps modal found at the bottom of the page, before including JS code -->
                <a href="#" data-toggle="modal" data-target="#apps-modal"><i class="si si-grid"></i></a>
            </li>
        </ul>
        <!-- END Header Navigation Left -->
    </header>
    
    <?php endif; ?>
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Header -->
        
        <?php if(empty($_pop) || (($_pop instanceof \think\Collection || $_pop instanceof \think\Paginator ) && $_pop->isEmpty())): ?>
        <div class="bg-gray-lighter">
            <ol class="breadcrumb">
                <li><i class="fa fa-map-marker"></i></li>
                <?php if(!(empty($_location) || (($_location instanceof \think\Collection || $_location instanceof \think\Paginator ) && $_location->isEmpty()))): if(is_array($_location) || $_location instanceof \think\Collection || $_location instanceof \think\Paginator): $i = 0; $__LIST__ = $_location;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <li><a class="link-effect" href="<?php if(!(empty($v["url_value"]) || (($v["url_value"] instanceof \think\Collection || $v["url_value"] instanceof \think\Paginator ) && $v["url_value"]->isEmpty()))): ?><?php echo url($v['url_value']); else: ?>javascript:void(0);<?php endif; ?>"><?php echo $v['title']; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </ol>
        </div>
        <?php endif; ?>
        
        <!-- END Page Header -->

        <!-- Page Content -->
        <div class="content">
            
            <?php echo hook('page_tips'); ?>
            
            
<div class="row">
    <div class="col-md-12">
        <div class="block">
            <div class="block-header bg-gray-lighter">
                <ul class="block-options">
                    <li>
                        <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="close"><i class="si si-close"></i></button>
                    </li>
                </ul>
                <h3 class="block-title"><?php echo (isset($page_title) && ($page_title !== '')?$page_title:""); ?></h3>
            </div>

            <div class="block-content tab-content">
                <div class="tab-pane active">
                    <div class="block-content">
                        <form class="form-horizontal form-builder" action="<?php echo url('install', ['name' => $name, 'confirm' => 1]); ?>" method="get">
                            <div class="form-group">
                                <h4 class="col-xs-12 push-10">模块依赖检查</h4>
                                <div class="col-sm-5">
                                    <?php if(empty($need_module) || (($need_module instanceof \think\Collection || $need_module instanceof \think\Paginator ) && $need_module->isEmpty())): ?>
                                    <div class="form-control-static">无需依赖其他模块</div>
                                    <?php else: ?>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>模块</th>
                                                <th>唯一标识</th>
                                                <th style="width: 100px;">当前版本</th>
                                                <th style="width: 100px;">所需版本</th>
                                                <th class="text-center" style="width: 100px;">检查结果</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(is_array($need_module) || $need_module instanceof \think\Collection || $need_module instanceof \think\Paginator): $i = 0; $__LIST__ = $need_module;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                            <tr>
                                                <td><?php echo $vo['module']; ?></td>
                                                <td><a href="http://www.dolphinphp.com" target="_blank" data-toggle="tooltip" title="到商城查看该模块"><?php echo $vo['identifier']; ?></a></td>
                                                <td><?php echo $vo['version']; ?></td>
                                                <td><?php echo $vo['version_need']; ?></td>
                                                <td class="text-center">
                                                    <?php echo $vo['result']; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </tbody>
                                    </table>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <h4 class="col-xs-12 push-10">插件依赖检查</h4>
                                <div class="col-sm-5">
                                    <?php if(empty($need_plugin) || (($need_plugin instanceof \think\Collection || $need_plugin instanceof \think\Paginator ) && $need_plugin->isEmpty())): ?>
                                    <div class="form-control-static">无需依赖其他插件</div>
                                    <?php else: ?>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>插件</th>
                                            <th>唯一标识</th>
                                            <th style="width: 100px;">当前版本</th>
                                            <th style="width: 100px;">所需版本</th>
                                            <th class="text-center" style="width: 100px;">检查结果</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(is_array($need_plugin) || $need_plugin instanceof \think\Collection || $need_plugin instanceof \think\Paginator): $i = 0; $__LIST__ = $need_plugin;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <tr>
                                            <td><?php echo $vo['plugin']; ?></td>
                                            <td><a href="http://www.dolphinphp.com" target="_blank" data-toggle="tooltip" title="到商城查看该插件"><?php echo $vo['identifier']; ?></a></td>
                                            <td><?php echo $vo['version']; ?></td>
                                            <td><?php echo $vo['version_need']; ?></td>
                                            <td class="text-center">
                                                <?php echo $vo['result']; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </tbody>
                                    </table>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <h4 class="col-xs-12 push-10">数据表检查</h4>
                                <div class="col-sm-5">
                                    <?php if(empty($table_check) || (($table_check instanceof \think\Collection || $table_check instanceof \think\Paginator ) && $table_check->isEmpty())): ?>
                                    <div class="form-control-static">该模块不需要数据表</div>
                                    <?php else: ?>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>数据表</th>
                                            <th class="text-center" style="width: 100px;">检查结果</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(is_array($table_check) || $table_check instanceof \think\Collection || $table_check instanceof \think\Paginator): $i = 0; $__LIST__ = $table_check;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <tr>
                                            <td><?php echo $vo['table']; ?></td>
                                            <td class="text-center">
                                                <?php echo $vo['result']; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </tbody>
                                    </table>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group " id="form_group_group">
                                <h4 class="col-xs-12 push-10">是否清除旧数据</h4>
                                <div class="col-xs-9">
                                    <label class="css-input css-radio css-radio-primary css-radio-sm push-10-r">
                                        <input type="radio" name="clear" id="clear1" value="0" checked="">
                                        <span></span> 否
                                    </label>
                                    <label class="css-input css-radio css-radio-primary css-radio-sm push-10-r">
                                        <input type="radio" name="clear" id="clear2" value="1">
                                        <span></span> 是
                                    </label>
                                    <div class="help-block">
                                        选择“是”，将删除数据库中已存在的相同数据表
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <button class="btn btn-minw btn-primary" type="button" id="install">
                                    安装
                                    </button>
                                    <button class="btn btn-default" type="button" onclick="javascript:history.back(-1);return false;">
                                        返回
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    <?php if(empty($_pop) || (($_pop instanceof \think\Collection || $_pop instanceof \think\Paginator ) && $_pop->isEmpty())): ?>
    <footer id="page-footer" class="content-mini content-mini-full font-s12 bg-gray-lighter clearfix">

    </footer>
    <?php endif; ?>
    <!-- END Footer -->
</div>
<!-- END Page Container -->

<!-- Apps Modal -->
<!-- Opens from the button in the header -->
<div class="modal fade" id="apps-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <!-- Apps Block -->
            <div class="block block-themed block-transparent">
                <div class="block-header bg-primary-dark">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">所有模块</h3>
                </div>
                <div class="block-content">
                    <div class="row text-center">
                        <?php if(!(empty($_top_menus_all) || (($_top_menus_all instanceof \think\Collection || $_top_menus_all instanceof \think\Paginator ) && $_top_menus_all->isEmpty()))): if(is_array($_top_menus_all) || $_top_menus_all instanceof \think\Collection || $_top_menus_all instanceof \think\Paginator): $i = 0; $__LIST__ = $_top_menus_all;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?>
                        <div class="col-xs-6 col-sm-3">
                            <?php if($menu['url_type'] == 'module'): ?>
                            <a class="block block-rounded top-menu" href="javascript:void(0);" data-module-id="<?php echo $menu['id']; ?>" data-module="<?php echo $menu['module']; ?>" data-controller="<?php echo $menu['controller']; ?>" target="<?php echo $menu['url_target']; ?>">
                                <div class="block-content text-white <?php echo !empty($menu['id']) && $menu['id']==$_location[0]['id']?'bg-primary' : 'bg-primary-dark'; ?>">
                                    <i class="<?php echo $menu['icon']; ?> fa-2x"></i>
                                    <div class="font-w600 push-15-t push-15"><?php echo $menu['title']; ?></div>
                                </div>
                            </a>
                            <?php else: ?>
                            <a class="block block-rounded" href="<?php echo $menu['url_value']; ?>" target="<?php echo $menu['url_target']; ?>">
                                <div class="block-content text-white <?php echo !empty($menu['id']) && $menu['id']==$_location[0]['id']?'bg-primary' : 'bg-primary-dark'; ?>">
                                    <i class="<?php echo $menu['icon']; ?> fa-2x"></i>
                                    <div class="font-w600 push-15-t push-15"><?php echo $menu['title']; ?></div>
                                </div>
                            </a>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </div>
                </div>
            </div>
            <!-- END Apps Block -->
        </div>
    </div>
</div>
<!-- END Apps Modal -->
<!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->
<?php if(\think\Config::get('minify_status') == '1'): ?>
<script src="<?php echo minify('group', 'core_js,libs_js'); ?>"></script>
<?php else: ?>
<script src="__ADMIN_JS__/core/jquery.min.js"></script>
<script src="__ADMIN_JS__/core/bootstrap.min.js"></script>
<script src="__ADMIN_JS__/core/jquery.slimscroll.min.js"></script>
<script src="__ADMIN_JS__/core/jquery.scrollLock.min.js"></script>
<script src="__ADMIN_JS__/core/jquery.appear.min.js"></script>
<script src="__ADMIN_JS__/core/jquery.countTo.min.js"></script>
<script src="__ADMIN_JS__/core/jquery.placeholder.min.js"></script>
<script src="__ADMIN_JS__/core/js.cookie.min.js"></script>
<script src="__LIBS__/bootstrap3-editable/js/bootstrap-editable.js"></script>
<script src="__LIBS__/magnific-popup/magnific-popup.min.js"></script>
<script src="__ADMIN_JS__/app.js"></script>
<script src="__ADMIN_JS__/dolphin.js"></script>
<script src="__ADMIN_JS__/builder/form.js"></script>
<script src="__ADMIN_JS__/builder/aside.js"></script>
<script src="__ADMIN_JS__/builder/table.js"></script>
<script src="__LIBS__/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="__LIBS__/sweetalert/sweetalert.min.js"></script>
<?php endif; ?>

<!-- Page JS Plugins -->
<script src="__LIBS__/layer/layer.js"></script>
<?php if(!(empty($_js_files) || (($_js_files instanceof \think\Collection || $_js_files instanceof \think\Paginator ) && $_js_files->isEmpty()))): if(\think\Config::get('minify_status') == '1'): ?>
        <script src="<?php echo minify('group', $_js_files); ?>"></script>
    <?php else: if(is_array($_js_files) || $_js_files instanceof \think\Collection || $_js_files instanceof \think\Paginator): $i = 0; $__LIST__ = $_js_files;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$js): $mod = ($i % 2 );++$i;?>
        <?php echo load_assets($js, 'js'); endforeach; endif; else: echo "" ;endif; endif; endif; ?>

<script>
    jQuery(function () {
        App.initHelpers(['appear', 'slimscroll', 'magnific-popup', 'table-tools']);
        <?php if(!(empty($_js_init) || (($_js_init instanceof \think\Collection || $_js_init instanceof \think\Paginator ) && $_js_init->isEmpty()))): ?>
        App.initHelpers(<?php echo $_js_init; ?>);
        <?php endif; ?>
    });
</script>

<!--页面js-->

<script>
    $(document).ready(function(){
        $('#install').click(function () {
            var table_exists = false;

            if ($('.form-builder i.text-danger').length) {
                Dolphin.notify('缺少依赖模块或插件', 'danger');
                return false;
            }
            if ($('.form-builder span.text-danger').length) {
                table_exists = true;
            }
            if (table_exists && $('.form-builder input[name=clear]:checked').val() == 0) {
                Dolphin.notify('数据库表存在冲突，如果需要覆盖原有数据，请选择“清除旧数据”', 'danger');
                return false;
            }

            $('.form-builder').submit();
        });
    });
</script>



<?php echo (isset($extra_html) && ($extra_html !== '')?$extra_html:''); ?>
</body>
</html>