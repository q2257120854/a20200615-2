<?php if (!defined('THINK_PATH')) exit(); /*a:45:{s:70:"/www/wwwroot/feichangpeizi/application/common/builder/form/layout.html";i:1539839478;s:61:"/www/wwwroot/feichangpeizi/application/admin/view/layout.html";i:1539839443;s:46:"./application/common/builder/aside/layout.html";i:1539839468;s:53:"./application/common/builder/aside/blocks/recent.html";i:1539839466;s:53:"./application/common/builder/aside/blocks/online.html";i:1539839466;s:53:"./application/common/builder/aside/blocks/switch.html";i:1539839466;s:49:"./application/common/builder/form/items/bmap.html";i:1539839470;s:51:"./application/common/builder/form/items/button.html";i:1539839471;s:53:"./application/common/builder/form/items/checkbox.html";i:1539839471;s:53:"./application/common/builder/form/items/ckeditor.html";i:1539839471;s:56:"./application/common/builder/form/items/colorpicker.html";i:1539839471;s:49:"./application/common/builder/form/items/date.html";i:1539839472;s:54:"./application/common/builder/form/items/daterange.html";i:1539839472;s:53:"./application/common/builder/form/items/datetime.html";i:1539839472;s:53:"./application/common/builder/form/items/editormd.html";i:1539839472;s:49:"./application/common/builder/form/items/file.html";i:1539839472;s:50:"./application/common/builder/form/items/files.html";i:1539839472;s:50:"./application/common/builder/form/items/group.html";i:1539839473;s:51:"./application/common/builder/form/items/hidden.html";i:1539839473;s:49:"./application/common/builder/form/items/icon.html";i:1539839473;s:50:"./application/common/builder/form/items/image.html";i:1539839473;s:51:"./application/common/builder/form/items/images.html";i:1539839474;s:50:"./application/common/builder/form/items/jcrop.html";i:1539839474;s:52:"./application/common/builder/form/items/linkage.html";i:1539839474;s:53:"./application/common/builder/form/items/linkages.html";i:1539839474;s:51:"./application/common/builder/form/items/masked.html";i:1539839475;s:51:"./application/common/builder/form/items/number.html";i:1539839475;s:53:"./application/common/builder/form/items/password.html";i:1539839475;s:50:"./application/common/builder/form/items/radio.html";i:1539839475;s:50:"./application/common/builder/form/items/range.html";i:1539839475;s:51:"./application/common/builder/form/items/select.html";i:1539839475;s:52:"./application/common/builder/form/items/select2.html";i:1539839476;s:49:"./application/common/builder/form/items/sort.html";i:1539839476;s:51:"./application/common/builder/form/items/static.html";i:1539839476;s:55:"./application/common/builder/form/items/summernote.html";i:1539839476;s:51:"./application/common/builder/form/items/switch.html";i:1539839477;s:49:"./application/common/builder/form/items/tags.html";i:1539839477;s:49:"./application/common/builder/form/items/text.html";i:1539839477;s:49:"./application/common/builder/form/items/time.html";i:1539839477;s:53:"./application/common/builder/form/items/textarea.html";i:1539839477;s:52:"./application/common/builder/form/items/ueditor.html";i:1539839478;s:55:"./application/common/builder/form/items/wangeditor.html";i:1539839478;s:46:"./application/common/builder/form/icon/fa.html";i:1539839469;s:46:"./application/common/builder/form/icon/gl.html";i:1539839470;s:46:"./application/common/builder/form/icon/sl.html";i:1539839470;}*/ ?>
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
    
    <?php if(!(empty($_editormd) || (($_editormd instanceof \think\Collection || $_editormd instanceof \think\Paginator ) && $_editormd->isEmpty()))): ?>
    <link href="__LIBS__/editormd/css/editormd.min.css" rel="stylesheet" type="text/css" />
    <?php endif; if(is_array($css_list) || $css_list instanceof \think\Collection || $css_list instanceof \think\Paginator): $i = 0; $__LIST__ = $css_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <link rel="stylesheet" href="__MODULE_CSS__/<?php echo $vo; ?>.css">
    <?php endforeach; endif; else: echo "" ;endif; ?>

    
    <?php echo (isset($extra_css) && ($extra_css !== '')?$extra_css:''); if(!(empty($_pop) || (($_pop instanceof \think\Collection || $_pop instanceof \think\Paginator ) && $_pop->isEmpty()))): ?>
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
            
            <?php echo hook('page_tips'); if(!(empty($page_tips) || (($page_tips instanceof \think\Collection || $page_tips instanceof \think\Paginator ) && $page_tips->isEmpty()))): ?>
    <div class="alert alert-<?php echo $tips_type; ?> alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p><?php echo $page_tips; ?></p>
    </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="block">
                <?php if(empty($_pop) || (($_pop instanceof \think\Collection || $_pop instanceof \think\Paginator ) && $_pop->isEmpty())): if(!(empty($tab_nav) || (($tab_nav instanceof \think\Collection || $tab_nav instanceof \think\Paginator ) && $tab_nav->isEmpty()))): ?>
                <ul class="nav nav-tabs">
                    <?php if(is_array($tab_nav['tab_list']) || $tab_nav['tab_list'] instanceof \think\Collection || $tab_nav['tab_list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $tab_nav['tab_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i;?>
                    <li <?php if($tab_nav['curr_tab'] == $key): ?>class="active"<?php endif; ?>>
                    <a href="<?php echo $tab['url']; ?>"><?php echo $tab['title']; ?></a>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <li class="pull-right">
                        <ul class="block-options push-10-t push-10-r">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                            </li>
                            <li>
                                <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                            </li>
                        </ul>
                    </li>
                </ul>
                <?php else: ?>
                <div class="block-header bg-gray-lighter">
                    <ul class="block-options">
                        <li>
                            <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                        </li>
                        <li>
                            <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                        </li>
                    </ul>
                    <h3 class="block-title"><?php echo (isset($page_title) && ($page_title !== '')?$page_title:""); ?></h3>
                </div>
                <?php endif; endif; ?>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="block-content">
                            <form class="form-builder row" name="form-builder" action="<?php echo (isset($post_url) && ($post_url !== '')?$post_url:''); ?>" method="post">
                                <?php if(empty($form_items) || (($form_items instanceof \think\Collection || $form_items instanceof \think\Paginator ) && $form_items->isEmpty())): ?>
                                <div class="form-empty">
                                    <p class="text-center text-muted empty-info">
                                        <i class="fa fa-database"></i> 暂无数据<br>
                                    </p>
                                </div>
                                <?php else: if(is_array($form_items) || $form_items instanceof \think\Collection || $form_items instanceof \think\Paginator): $i = 0; $__LIST__ = $form_items;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$form): $mod = ($i % 2 );++$i;switch($form['type']): case "bmap": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> js-bmap <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" data-level="<?php echo !empty($form['level']) && $form['level']==''?12 : $form['level']; ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-sm-12">
        <input class="form-control bmap-address" id="bmap-address-<?php echo $form['name']; ?>" name="<?php echo $form['name']; ?>_address" type="text" value="<?php echo (isset($form['address']) && ($form['address'] !== '')?$form['address']:''); ?>" placeholder="请输入要搜索的地址">
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
        <div class="searchResultPanel"></div>
        <input class="form-control bmap-point" type="hidden" id="<?php echo $form['name']; ?>" name="<?php echo $form['name']; ?>" value="<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?>">
        <div class="bmap push-10-t" id="bmap-canvas-<?php echo $form['name']; ?>"></div>
    </div>
</div>

<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?php echo (isset($form['ak']) && ($form['ak'] !== '')?$form['ak']:''); ?>"></script>
                                            <?php break; case "button": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?>" id="form_group_<?php echo $form['name']; ?>">
    <div class="col-xs-12 form-btn-parent">
        <?php if($form['ele_type'] == 'button'): ?>
        <button class="form-btn btn  <?php echo (isset($form['class']) && ($form['class'] !== '')?$form['class']:'btn-primary'); ?>" id="<?php echo (isset($form['id']) && ($form['id'] !== '')?$form['id']:''); ?>" type="button" <?php echo (isset($form['data']) && ($form['data'] !== '')?$form['data']:''); if(isset($form['disabled'])): ?>disabled<?php endif; ?>><i class="<?php echo (isset($form['icon']) && ($form['icon'] !== '')?$form['icon']:''); ?>"></i> <?php echo (isset($form['title']) && ($form['title'] !== '')?$form['title']:''); ?></button>
        <?php else: ?>
        <a class="form-btn btn <?php echo (isset($form['class']) && ($form['class'] !== '')?$form['class']:'btn-primary'); if(isset($form['disabled'])): ?> disabled<?php endif; ?>" id="<?php echo (isset($form['id']) && ($form['id'] !== '')?$form['id']:''); ?>" title="<?php echo (isset($form['title']) && ($form['title'] !== '')?$form['title']:''); ?>" target="<?php echo (isset($form['target']) && ($form['target'] !== '')?$form['target']:'_self'); ?>" href="<?php echo (isset($form['href']) && ($form['href'] !== '')?$form['href']:''); ?>" <?php echo (isset($form['data']) && ($form['data'] !== '')?$form['data']:''); ?>><i class="<?php echo (isset($form['icon']) && ($form['icon'] !== '')?$form['icon']:''); ?>"></i> <?php echo (isset($form['title']) && ($form['title'] !== '')?$form['title']:''); ?></a>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "checkbox": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-xs-12">
        <?php if(is_array($form['options']) || $form['options'] instanceof \think\Collection || $form['options'] instanceof \think\Paginator): $i = 0; $__LIST__ = $form['options'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
        <label class="css-input css-checkbox css-checkbox-<?php echo (isset($form['attr']['color']) && ($form['attr']['color'] !== '')?$form['attr']['color']:'primary'); ?> css-checkbox-<?php echo (isset($form['attr']['size']) && ($form['attr']['size'] !== '')?$form['attr']['size']:'sm'); ?> css-checkbox-<?php echo (isset($form['attr']['shape']) && ($form['attr']['shape'] !== '')?$form['attr']['shape']:'rounded'); ?>  <?php echo (isset($form['extra_label_class']) && ($form['extra_label_class'] !== '')?$form['extra_label_class']:''); ?>">
            <input type="checkbox" name="<?php echo $form['name']; ?>[]" id="<?php echo $form['name']; ?><?php echo $key; ?>" value="<?php echo $key; ?>" <?php $key = (string)$key; if(in_array(($key), is_array((isset($form['value']) && ($form['value'] !== '')?$form['value']:''))?(isset($form['value']) && ($form['value'] !== '')?$form['value']:''):explode(',',(isset($form['value']) && ($form['value'] !== '')?$form['value']:'')))): ?>checked<?php endif; ?> <?php echo (isset($form['extra_attr']) && ($form['extra_attr'] !== '')?$form['extra_attr']:''); ?>><span></span> <?php echo htmlspecialchars($option); ?>
        </label>
        <?php endforeach; endif; else: echo "" ;endif; if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "ckeditor": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-sm-12">
        <textarea class="js-ckeditor form-control" id="<?php echo $form['name']; ?>" data-width="<?php echo (isset($form['width']) && ($form['width'] !== '')?$form['width']:'100%'); ?>" data-height="<?php echo (isset($form['height']) && ($form['height'] !== '')?$form['height']:400); ?>" name="<?php echo $form['name']; ?>" placeholder="请输入<?php echo $form['title']; ?>"><?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?></textarea>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "colorpicker": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-sm-12">
        <div class="js-colorpicker input-group" data-colorpicker-mode="<?php echo !empty($form['mode']) && $form['mode']==''?'rgba' : $form['mode']; ?>">
            <input class="form-control" type="text" id="<?php echo $form['name']; ?>" name="<?php echo $form['name']; ?>" value="<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?>" placeholder="请从右边选择颜色" <?php echo (isset($form['extra_attr']) && ($form['extra_attr'] !== '')?$form['extra_attr']:''); ?>>
            <span class="input-group-addon"><i style="background-color: rgb(92, 144, 210);"></i></span>
        </div>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "date": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-md-12">
        <input class="js-datepicker form-control" type="text" id="<?php echo $form['name']; ?>" name="<?php echo $form['name']; ?>" value="<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?>" data-date-format="<?php echo !empty($form['format'])?$form['format'] : 'yyyy-mm-dd'; ?>" placeholder="<?php echo $form['format']; ?>" <?php echo (isset($form['extra_attr']) && ($form['extra_attr'] !== '')?$form['extra_attr']:''); ?>>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "daterange": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name_from']]) && ($_layout[$form['name_from']] !== '')?$_layout[$form['name_from']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['id']; ?>">
    <label class="col-xs-12"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-md-12">
        <div class="input-daterange input-group" data-date-format="<?php echo !empty($form['format'])?$form['format'] : 'yyyy-mm-dd'; ?>">
            <input class="form-control" type="text" id="<?php echo $form['id_from']; ?>" name="<?php echo $form['name_from']; ?>" value="<?php echo (isset($form['value_from']) && ($form['value_from'] !== '')?$form['value_from']:''); ?>" placeholder="<?php echo $form['format']; ?>" <?php echo (isset($form['extra_attr']) && ($form['extra_attr'] !== '')?$form['extra_attr']:''); ?>>
            <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
            <input class="form-control" type="text" id="<?php echo $form['id_to']; ?>" name="<?php echo $form['name_to']; ?>" value="<?php echo (isset($form['value_to']) && ($form['value_to'] !== '')?$form['value_to']:''); ?>" placeholder="<?php echo $form['format']; ?>" <?php echo (isset($form['extra_attr']) && ($form['extra_attr'] !== '')?$form['extra_attr']:''); ?>>
        </div>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "datetime": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-md-12">
        <input class="js-datetimepicker form-control" type="text" id="<?php echo $form['name']; ?>" name="<?php echo $form['name']; ?>" value="<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?>" placeholder="<?php echo $form['format']; ?>" data-side-by-side="true" data-locale="zh-cn" data-format="<?php echo !empty($form['format'])?$form['format'] : 'YYYY-MM-DD HH:mm'; ?>" <?php echo (isset($form['extra_attr']) && ($form['extra_attr'] !== '')?$form['extra_attr']:''); ?>>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "editormd": 
    $upload_image_ext = explode(',', config("upload_image_ext"));
    $upload_image_ext = json_encode($upload_image_ext);
 ?>
<div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-md-12">
        <div id="<?php echo $form['name']; ?>">
            <textarea style="display:none;" class="js-editormd" data-image-formats='<?php echo (isset($upload_image_ext) && ($upload_image_ext !== '')?$upload_image_ext:""); ?>' data-watch="<?php echo (isset($form['watch']) && ($form['watch'] !== '')?$form['watch']:true); ?>" name="<?php echo $form['name']; ?>"><?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?></textarea>
        </div>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "file": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-sm-12 js-upload-file">
        <ul class="list-group uploader-list" id="file_list_<?php echo $form['name']; ?>">
            <?php if(!(empty($form['value']) || (($form['value'] instanceof \think\Collection || $form['value'] instanceof \think\Paginator ) && $form['value']->isEmpty()))): ?>
            <li class="list-group-item file-item"><i class="fa fa-times-circle remove-file"></i> <?php echo get_file_name($form['value']); ?></li>
            <?php endif; ?>
        </ul>
        <input type="hidden" name="<?php echo $form['name']; ?>" data-multiple="false" data-size="<?php echo (isset($form['size']) && ($form['size'] !== '')?$form['size']:0); ?>" data-ext='<?php echo (isset($form["ext"]) && ($form["ext"] !== '')?$form["ext"]:""); ?>' id="<?php echo $form['name']; ?>" value="<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?>">
        <div id="picker_<?php echo $form['name']; ?>">上传单个文件</div>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "files": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-sm-12 js-upload-files">
        <ul class="list-group uploader-list" id="file_list_<?php echo $form['name']; ?>">
            <?php if(!(empty($form['value']) || (($form['value'] instanceof \think\Collection || $form['value'] instanceof \think\Paginator ) && $form['value']->isEmpty()))): if(is_array(explode(',',$form['value'])) || explode(',',$form['value']) instanceof \think\Collection || explode(',',$form['value']) instanceof \think\Paginator): $i = 0; $__LIST__ = explode(',',$form['value']);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li class="list-group-item file-item"><i class="fa fa-times-circle remove-file" data-id="<?php echo $vo; ?>"></i> <?php echo get_file_name($vo); ?></li>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </ul>
        <input type="hidden" name="<?php echo $form['name']; ?>" data-multiple="true" data-size="<?php echo (isset($form['size']) && ($form['size'] !== '')?$form['size']:0); ?>" data-ext='<?php echo (isset($form["ext"]) && ($form["ext"] !== '')?$form["ext"]:""); ?>' id="<?php echo $form['name']; ?>" value="<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?>">
        <div id="picker_<?php echo $form['name']; ?>">上传多个文件</div>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "group": ?>
                                                
                                                <div>
    <div class="col-sm-12">
        <div class="block block-bordered">
            <ul class="nav nav-tabs" data-toggle="tabs" id="builder-form-group-tab">
                <?php if(is_array($form['options']) || $form['options'] instanceof \think\Collection || $form['options'] instanceof \think\Paginator): $items_key = 0; $__LIST__ = $form['options'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($items_key % 2 );++$items_key;?>
                <li <?php if($items_key == '1'): ?>class="active"<?php endif; ?>>
                <a href="#tab-<?php echo $items_key; ?>"><?php echo htmlspecialchars($key); ?></a>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <div class="block-content tab-content block-group">
                <?php if(is_array($form['options']) || $form['options'] instanceof \think\Collection || $form['options'] instanceof \think\Paginator): $items_key = 0; $__LIST__ = $form['options'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$items): $mod = ($items_key % 2 );++$items_key;?>
                <div class="tab-pane row <?php if($items_key == '1'): ?>active<?php endif; ?>" id="tab-<?php echo $items_key; ?>" >
                    <?php if(is_array($items) || $items instanceof \think\Collection || $items instanceof \think\Paginator): $i = 0; $__LIST__ = $items;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$form_group): $mod = ($i % 2 );++$i;switch($form_group['type']): case "bmap": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> js-bmap <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" data-level="<?php echo !empty($form_group['level']) && $form_group['level']==''?12 : $form_group['level']; ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-sm-12">
        <input class="form-control bmap-address" id="bmap-address-<?php echo $form_group['name']; ?>" name="<?php echo $form_group['name']; ?>_address" type="text" value="<?php echo (isset($form_group['address']) && ($form_group['address'] !== '')?$form_group['address']:''); ?>" placeholder="请输入要搜索的地址">
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
        <div class="searchResultPanel"></div>
        <input class="form-control bmap-point" type="hidden" id="<?php echo $form_group['name']; ?>" name="<?php echo $form_group['name']; ?>" value="<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?>">
        <div class="bmap push-10-t" id="bmap-canvas-<?php echo $form_group['name']; ?>"></div>
    </div>
</div>

<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?php echo (isset($form_group['ak']) && ($form_group['ak'] !== '')?$form_group['ak']:''); ?>"></script>
                            <?php break; case "button": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <div class="col-xs-12 form-btn-parent">
        <?php if($form_group['ele_type'] == 'button'): ?>
        <button class="form-btn btn  <?php echo (isset($form_group['class']) && ($form_group['class'] !== '')?$form_group['class']:'btn-primary'); ?>" id="<?php echo (isset($form_group['id']) && ($form_group['id'] !== '')?$form_group['id']:''); ?>" type="button" <?php echo (isset($form_group['data']) && ($form_group['data'] !== '')?$form_group['data']:''); if(isset($form_group['disabled'])): ?>disabled<?php endif; ?>><i class="<?php echo (isset($form_group['icon']) && ($form_group['icon'] !== '')?$form_group['icon']:''); ?>"></i> <?php echo (isset($form_group['title']) && ($form_group['title'] !== '')?$form_group['title']:''); ?></button>
        <?php else: ?>
        <a class="form-btn btn <?php echo (isset($form_group['class']) && ($form_group['class'] !== '')?$form_group['class']:'btn-primary'); if(isset($form_group['disabled'])): ?> disabled<?php endif; ?>" id="<?php echo (isset($form_group['id']) && ($form_group['id'] !== '')?$form_group['id']:''); ?>" title="<?php echo (isset($form_group['title']) && ($form_group['title'] !== '')?$form_group['title']:''); ?>" target="<?php echo (isset($form_group['target']) && ($form_group['target'] !== '')?$form_group['target']:'_self'); ?>" href="<?php echo (isset($form_group['href']) && ($form_group['href'] !== '')?$form_group['href']:''); ?>" <?php echo (isset($form_group['data']) && ($form_group['data'] !== '')?$form_group['data']:''); ?>><i class="<?php echo (isset($form_group['icon']) && ($form_group['icon'] !== '')?$form_group['icon']:''); ?>"></i> <?php echo (isset($form_group['title']) && ($form_group['title'] !== '')?$form_group['title']:''); ?></a>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "checkbox": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-xs-12">
        <?php if(is_array($form_group['options']) || $form_group['options'] instanceof \think\Collection || $form_group['options'] instanceof \think\Paginator): $i = 0; $__LIST__ = $form_group['options'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
        <label class="css-input css-checkbox css-checkbox-<?php echo (isset($form_group['attr']['color']) && ($form_group['attr']['color'] !== '')?$form_group['attr']['color']:'primary'); ?> css-checkbox-<?php echo (isset($form_group['attr']['size']) && ($form_group['attr']['size'] !== '')?$form_group['attr']['size']:'sm'); ?> css-checkbox-<?php echo (isset($form_group['attr']['shape']) && ($form_group['attr']['shape'] !== '')?$form_group['attr']['shape']:'rounded'); ?>  <?php echo (isset($form_group['extra_label_class']) && ($form_group['extra_label_class'] !== '')?$form_group['extra_label_class']:''); ?>">
            <input type="checkbox" name="<?php echo $form_group['name']; ?>[]" id="<?php echo $form_group['name']; ?><?php echo $key; ?>" value="<?php echo $key; ?>" <?php $key = (string)$key; if(in_array(($key), is_array((isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''))?(isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''):explode(',',(isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:'')))): ?>checked<?php endif; ?> <?php echo (isset($form_group['extra_attr']) && ($form_group['extra_attr'] !== '')?$form_group['extra_attr']:''); ?>><span></span> <?php echo htmlspecialchars($option); ?>
        </label>
        <?php endforeach; endif; else: echo "" ;endif; if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "ckeditor": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-sm-12">
        <textarea class="js-ckeditor form-control" id="<?php echo $form_group['name']; ?>" data-width="<?php echo (isset($form_group['width']) && ($form_group['width'] !== '')?$form_group['width']:'100%'); ?>" data-height="<?php echo (isset($form_group['height']) && ($form_group['height'] !== '')?$form_group['height']:400); ?>" name="<?php echo $form_group['name']; ?>" placeholder="请输入<?php echo $form_group['title']; ?>"><?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?></textarea>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "colorpicker": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-sm-12">
        <div class="js-colorpicker input-group" data-colorpicker-mode="<?php echo !empty($form_group['mode']) && $form_group['mode']==''?'rgba' : $form_group['mode']; ?>">
            <input class="form-control" type="text" id="<?php echo $form_group['name']; ?>" name="<?php echo $form_group['name']; ?>" value="<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?>" placeholder="请从右边选择颜色" <?php echo (isset($form_group['extra_attr']) && ($form_group['extra_attr'] !== '')?$form_group['extra_attr']:''); ?>>
            <span class="input-group-addon"><i style="background-color: rgb(92, 144, 210);"></i></span>
        </div>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "date": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-md-12">
        <input class="js-datepicker form-control" type="text" id="<?php echo $form_group['name']; ?>" name="<?php echo $form_group['name']; ?>" value="<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?>" data-date-format="<?php echo !empty($form_group['format'])?$form_group['format'] : 'yyyy-mm-dd'; ?>" placeholder="<?php echo $form_group['format']; ?>" <?php echo (isset($form_group['extra_attr']) && ($form_group['extra_attr'] !== '')?$form_group['extra_attr']:''); ?>>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "daterange": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name_from']]) && ($_layout[$form_group['name_from']] !== '')?$_layout[$form_group['name_from']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['id']; ?>">
    <label class="col-xs-12"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-md-12">
        <div class="input-daterange input-group" data-date-format="<?php echo !empty($form_group['format'])?$form_group['format'] : 'yyyy-mm-dd'; ?>">
            <input class="form-control" type="text" id="<?php echo $form_group['id_from']; ?>" name="<?php echo $form_group['name_from']; ?>" value="<?php echo (isset($form_group['value_from']) && ($form_group['value_from'] !== '')?$form_group['value_from']:''); ?>" placeholder="<?php echo $form_group['format']; ?>" <?php echo (isset($form_group['extra_attr']) && ($form_group['extra_attr'] !== '')?$form_group['extra_attr']:''); ?>>
            <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
            <input class="form-control" type="text" id="<?php echo $form_group['id_to']; ?>" name="<?php echo $form_group['name_to']; ?>" value="<?php echo (isset($form_group['value_to']) && ($form_group['value_to'] !== '')?$form_group['value_to']:''); ?>" placeholder="<?php echo $form_group['format']; ?>" <?php echo (isset($form_group['extra_attr']) && ($form_group['extra_attr'] !== '')?$form_group['extra_attr']:''); ?>>
        </div>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "datetime": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-md-12">
        <input class="js-datetimepicker form-control" type="text" id="<?php echo $form_group['name']; ?>" name="<?php echo $form_group['name']; ?>" value="<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?>" placeholder="<?php echo $form_group['format']; ?>" data-side-by-side="true" data-locale="zh-cn" data-format="<?php echo !empty($form_group['format'])?$form_group['format'] : 'YYYY-MM-DD HH:mm'; ?>" <?php echo (isset($form_group['extra_attr']) && ($form_group['extra_attr'] !== '')?$form_group['extra_attr']:''); ?>>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "editormd": 
    $upload_image_ext = explode(',', config("upload_image_ext"));
    $upload_image_ext = json_encode($upload_image_ext);
 ?>
<div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-md-12">
        <div id="<?php echo $form_group['name']; ?>">
            <textarea style="display:none;" class="js-editormd" data-image-formats='<?php echo (isset($upload_image_ext) && ($upload_image_ext !== '')?$upload_image_ext:""); ?>' data-watch="<?php echo (isset($form_group['watch']) && ($form_group['watch'] !== '')?$form_group['watch']:true); ?>" name="<?php echo $form_group['name']; ?>"><?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?></textarea>
        </div>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "file": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-sm-12 js-upload-file">
        <ul class="list-group uploader-list" id="file_list_<?php echo $form_group['name']; ?>">
            <?php if(!(empty($form_group['value']) || (($form_group['value'] instanceof \think\Collection || $form_group['value'] instanceof \think\Paginator ) && $form_group['value']->isEmpty()))): ?>
            <li class="list-group-item file-item"><i class="fa fa-times-circle remove-file"></i> <?php echo get_file_name($form_group['value']); ?></li>
            <?php endif; ?>
        </ul>
        <input type="hidden" name="<?php echo $form_group['name']; ?>" data-multiple="false" data-size="<?php echo (isset($form_group['size']) && ($form_group['size'] !== '')?$form_group['size']:0); ?>" data-ext='<?php echo (isset($form_group["ext"]) && ($form_group["ext"] !== '')?$form_group["ext"]:""); ?>' id="<?php echo $form_group['name']; ?>" value="<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?>">
        <div id="picker_<?php echo $form_group['name']; ?>">上传单个文件</div>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "files": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-sm-12 js-upload-files">
        <ul class="list-group uploader-list" id="file_list_<?php echo $form_group['name']; ?>">
            <?php if(!(empty($form_group['value']) || (($form_group['value'] instanceof \think\Collection || $form_group['value'] instanceof \think\Paginator ) && $form_group['value']->isEmpty()))): if(is_array(explode(',',$form_group['value'])) || explode(',',$form_group['value']) instanceof \think\Collection || explode(',',$form_group['value']) instanceof \think\Paginator): $i = 0; $__LIST__ = explode(',',$form_group['value']);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li class="list-group-item file-item"><i class="fa fa-times-circle remove-file" data-id="<?php echo $vo; ?>"></i> <?php echo get_file_name($vo); ?></li>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </ul>
        <input type="hidden" name="<?php echo $form_group['name']; ?>" data-multiple="true" data-size="<?php echo (isset($form_group['size']) && ($form_group['size'] !== '')?$form_group['size']:0); ?>" data-ext='<?php echo (isset($form_group["ext"]) && ($form_group["ext"] !== '')?$form_group["ext"]:""); ?>' id="<?php echo $form_group['name']; ?>" value="<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?>">
        <div id="picker_<?php echo $form_group['name']; ?>">上传多个文件</div>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "hidden": ?>
                                
                                <div class="form-group hidden <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <input type="hidden" name="<?php echo $form_group['name']; ?>" value='<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:""); ?>' class="form-control" id="<?php echo $form_group['name']; ?>">
</div>
                            <?php break; case "icon": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-sm-12">
        <div class="input-group js-icon-picker">
            <span class="input-group-addon icon" data-toggle="tooltip" data-placement="bottom" data-original-title="点击选择图标"><i class="<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:'fa fa-plus-circle'); ?>"></i></span>
            <input class="form-control icon_input" type="text" id="<?php echo $form_group['name']; ?>" name="<?php echo $form_group['name']; ?>" value="<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?>" placeholder="请选择图标" <?php echo (isset($form_group['extra_attr']) && ($form_group['extra_attr'] !== '')?$form_group['extra_attr']:''); ?>>
            <span class="input-group-addon delete-icon" data-toggle="tooltip" data-placement="bottom" data-original-title="删除图标"><i class="fa fa-times"></i></span>
        </div>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "image": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-xs-12 js-upload-image">
        <div id="file_list_<?php echo $form_group['name']; ?>" class="uploader-list">
            <?php if(!(empty($form_group['value']) || (($form_group['value'] instanceof \think\Collection || $form_group['value'] instanceof \think\Paginator ) && $form_group['value']->isEmpty()))): ?>
            <div class="file-item thumbnail">
                <a class="img-link" href="<?php echo get_file_path($form_group['value']); ?>">
                    <img src="<?php echo get_thumb($form_group['value']); ?>" width="100">
                </a>
                <i class="fa fa-times-circle remove-picture"></i>
            </div>
            <?php endif; ?>
        </div>
        <div class="clearfix"></div>
        <input type="hidden" name="<?php echo $form_group['name']; ?>" data-multiple="false" data-size="<?php echo (isset($form_group['size']) && ($form_group['size'] !== '')?$form_group['size']:0); ?>" data-ext='<?php echo (isset($form_group["ext"]) && ($form_group["ext"] !== '')?$form_group["ext"]:""); ?>' id="<?php echo $form_group['name']; ?>" value="<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?>">
        <div id="picker_<?php echo $form_group['name']; ?>">上传单张图片</div>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "images": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-xs-12 js-upload-images">
        <div id="file_list_<?php echo $form_group['name']; ?>" class="uploader-list">
            <?php if(!(empty($form_group['value']) || (($form_group['value'] instanceof \think\Collection || $form_group['value'] instanceof \think\Paginator ) && $form_group['value']->isEmpty()))): if(is_array(explode(',',$form_group['value'])) || explode(',',$form_group['value']) instanceof \think\Collection || explode(',',$form_group['value']) instanceof \think\Paginator): $i = 0; $__LIST__ = explode(',',$form_group['value']);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <div class="file-item thumbnail">
                    <a class="img-link" href="<?php echo get_file_path($vo); ?>">
                        <img src="<?php echo get_thumb($vo); ?>" width="100">
                    </a>
                    <i class="fa fa-times-circle remove-picture" data-id="<?php echo $vo; ?>"></i>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </div>
        <div class="clearfix"></div>
        <input type="hidden" name="<?php echo $form_group['name']; ?>" data-multiple="true" data-size="<?php echo (isset($form_group['size']) && ($form_group['size'] !== '')?$form_group['size']:0); ?>" data-ext='<?php echo (isset($form_group["ext"]) && ($form_group["ext"] !== '')?$form_group["ext"]:""); ?>' id="<?php echo $form_group['name']; ?>" value="<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?>">
        <div id="picker_<?php echo $form_group['name']; ?>">上传多张图片</div>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "jcrop": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> js-jcrop-interface <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-sm-12">
        <div class="file-item thumbnail" <?php echo !empty($form_group['value'])?$form_group['value']: "style='display:none'"; ?>>
            <a class="img-link" href="<?php echo get_file_path($form_group['value']); ?>">
                <img src="<?php echo get_thumb($form_group['value']); ?>" width="100">
            </a>
            <i class="fa fa-times-circle remove-picture"></i>
        </div>
        <div class="clearfix"></div>
        <button class="btn btn-info js-jcrop-upload-btn" type="button">上传图片</button>
        <input type="hidden" class="js-jcrop-cut-info" value="">
        <input type="file" class="hidden js-jcrop-file" accept="image/jpg,image/jpeg,image/bmp,image/png,image/gif" value="">
        <input type="hidden" class="js-jcrop-input" id="<?php echo $form_group['name']; ?>" name="<?php echo $form_group['name']; ?>" value="<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?>">
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
    <!-- Pop In Modal -->
    <div class="modal modal-popin fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-popin">
            <div class="modal-content">
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title">图片裁剪</h3>
                    </div>
                    <div class="block-content push-20">
                        <div class="jcrop-preview-parent" <?php echo !empty($form_group['value'])?$form_group['value']: "style='display:none'"; ?>>
                            <img src="<?php echo get_file_path($form_group['value']); ?>" class="jcrop-preview" />
                        </div>
                        <div class="jcrop-img">
                            <img src="<?php echo get_file_path($form_group['value']); ?>" data-id="<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?>" data-options='<?php echo (isset($form_group['options']) && ($form_group['options'] !== '')?$form_group['options']:""); ?>' class="js-jcrop" style="display: none;" alt="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="pull-left">在图片上拖动鼠标，选择裁剪选区，然后点击“<strong>立即裁剪</strong>”按钮</span>
                    <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">关闭</button>
                    <button class="btn btn-sm btn-primary js-jcrop-cut-btn" type="button"><i class="fa fa-cut"></i> 立即裁剪</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Pop In Modal -->
</div>
                            <?php break; case "linkage": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo clear_js($form_group['title']); ?></label>
    <div class="col-sm-12">
        <select class="js-select2 form-control select-linkage" name="<?php echo $form_group['name']; ?>" id="<?php echo $form_group['name']; ?>" data-allow-clear="true" data-placeholder="请选择一项" data-url="<?php echo (isset($form_group['ajax_url']) && ($form_group['ajax_url'] !== '')?$form_group['ajax_url']:''); ?>" data-param="<?php echo (isset($form_group['param']) && ($form_group['param'] !== '')?$form_group['param']:$form_group['name']); ?>" data-next-items="<?php echo $form_group['next_items']; ?>">
            <option></option>
            <?php if(is_array($form_group['options']) || $form_group['options'] instanceof \think\Collection || $form_group['options'] instanceof \think\Paginator): $i = 0; $__LIST__ = $form_group['options'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $key; ?>" <?php if(($form_group['value'] == (string)$key)): ?>selected<?php endif; ?>><?php echo clear_js($option); ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "linkages": 
    // 获取一级联动数据
    $level_one  = get_level_data($form_group['table'], 0, $form_group['pid']);
    $level_key  = [];
    $level_data = [];

    // 有默认值
    if ($form_group['value'] != '') {
        $level_key_data = get_level_key_data($form_group['table'], $form_group['value'], $form_group['key'], $form_group['option'], $form_group['pid']);
        $level_key = $level_key_data['key'];
        $level_data = $level_key_data['data'];
        sort($level_key);
        $level_data = array_reverse($level_data);
    }
 ?>
<div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="select-box">
        <select class="js-select2 form-control select-linkages" id="linkages_<?php echo $form_group['name']; ?>_1" data-table="<?php echo $form_group['table']; ?>" data-key="<?php echo (isset($form_group['key']) && ($form_group['key'] !== '')?$form_group['key']:'id'); ?>" data-option="<?php echo (isset($form_group['option']) && ($form_group['option'] !== '')?$form_group['option']:'name'); ?>" data-pidkey="<?php echo (isset($form_group['pid']) && ($form_group['pid'] !== '')?$form_group['pid']:'pid'); ?>" data-next-level="2" data-next-level-id="linkages_<?php echo $form_group['name']; ?>_2">
            <option value="">请选择：</option>
            <?php if(is_array($level_one) || $level_one instanceof \think\Collection || $level_one instanceof \think\Paginator): $i = 0; $__LIST__ = $level_one;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $option[$form_group['key']]; ?>" <?php if((isset($level_key[1]) && $level_key[1] == (string)$option[$form_group['key']])): ?>selected<?php endif; ?>><?php echo clear_js($option[$form_group['option']]); ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
    </div>

    <?php if($form_group['level'] == '2'): ?>
    <div class="select-box">
        <select class="js-select2 form-control" name="<?php echo $form_group['name']; ?>" id="linkages_<?php echo $form_group['name']; ?>_2">
            <option value="">请选择：</option>
            <?php if(!(empty($level_data['1']) || (($level_data['1'] instanceof \think\Collection || $level_data['1'] instanceof \think\Paginator ) && $level_data['1']->isEmpty()))): if(is_array($level_data['1']) || $level_data['1'] instanceof \think\Collection || $level_data['1'] instanceof \think\Paginator): $i = 0; $__LIST__ = $level_data['1'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $option[$form_group['key']]; ?>" <?php if(($form_group['value'] == (string)$option[$form_group['key']])): ?>selected<?php endif; ?>><?php echo clear_js($option[$form_group['option']]); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </select>
    </div>
    <?php endif; if($form_group['level'] == '3'): ?>
    <div class="select-box">
        <select class="js-select2 form-control select-linkages" id="linkages_<?php echo $form_group['name']; ?>_2" data-table="<?php echo $form_group['table']; ?>" data-key="<?php echo (isset($form_group['key']) && ($form_group['key'] !== '')?$form_group['key']:'id'); ?>" data-option="<?php echo (isset($form_group['option']) && ($form_group['option'] !== '')?$form_group['option']:'name'); ?>" data-pidkey="<?php echo (isset($form_group['pid']) && ($form_group['pid'] !== '')?$form_group['pid']:'pid'); ?>" data-next-level="3" data-next-level-id="linkages_<?php echo $form_group['name']; ?>_3">
            <option value="">请选择：</option>
            <?php if(!(empty($level_data['1']) || (($level_data['1'] instanceof \think\Collection || $level_data['1'] instanceof \think\Paginator ) && $level_data['1']->isEmpty()))): if(is_array($level_data['1']) || $level_data['1'] instanceof \think\Collection || $level_data['1'] instanceof \think\Paginator): $i = 0; $__LIST__ = $level_data['1'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $option[$form_group['key']]; ?>" <?php if(($level_key[2] == (string)$option[$form_group['key']])): ?>selected<?php endif; ?>><?php echo clear_js($option[$form_group['option']]); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </select>
    </div>
    <div class="select-box">
        <select class="js-select2 form-control" name="<?php echo $form_group['name']; ?>" id="linkages_<?php echo $form_group['name']; ?>_3">
            <option value="">请选择：</option>
            <?php if(!(empty($level_data['2']) || (($level_data['2'] instanceof \think\Collection || $level_data['2'] instanceof \think\Paginator ) && $level_data['2']->isEmpty()))): if(is_array($level_data['2']) || $level_data['2'] instanceof \think\Collection || $level_data['2'] instanceof \think\Paginator): $i = 0; $__LIST__ = $level_data['2'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $option[$form_group['key']]; ?>" <?php if(($form_group['value'] == (string)$option[$form_group['key']])): ?>selected<?php endif; ?>><?php echo clear_js($option[$form_group['option']]); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </select>
    </div>
    <?php endif; if($form_group['level'] == '4'): ?>
    <div class="select-box">
        <select class="js-select2 form-control select-linkages" id="linkages_<?php echo $form_group['name']; ?>_2" data-table="<?php echo $form_group['table']; ?>" data-key="<?php echo (isset($form_group['key']) && ($form_group['key'] !== '')?$form_group['key']:'id'); ?>" data-option="<?php echo (isset($form_group['option']) && ($form_group['option'] !== '')?$form_group['option']:'name'); ?>" data-pidkey="<?php echo (isset($form_group['pid']) && ($form_group['pid'] !== '')?$form_group['pid']:'pid'); ?>" data-next-level="3" data-next-level-id="linkages_<?php echo $form_group['name']; ?>_3">
            <option value="">请选择：</option>
            <?php if(!(empty($level_data['1']) || (($level_data['1'] instanceof \think\Collection || $level_data['1'] instanceof \think\Paginator ) && $level_data['1']->isEmpty()))): if(is_array($level_data['1']) || $level_data['1'] instanceof \think\Collection || $level_data['1'] instanceof \think\Paginator): $i = 0; $__LIST__ = $level_data['1'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $option[$form_group['key']]; ?>" <?php if(($level_key[2] == (string)$option[$form_group['key']])): ?>selected<?php endif; ?>><?php echo clear_js($option[$form_group['option']]); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </select>
    </div>
    <div class="select-box">
        <select class="js-select2 form-control select-linkages" id="linkages_<?php echo $form_group['name']; ?>_3" data-table="<?php echo $form_group['table']; ?>" data-key="<?php echo (isset($form_group['key']) && ($form_group['key'] !== '')?$form_group['key']:'id'); ?>" data-option="<?php echo (isset($form_group['option']) && ($form_group['option'] !== '')?$form_group['option']:'name'); ?>" data-pidkey="<?php echo (isset($form_group['pid']) && ($form_group['pid'] !== '')?$form_group['pid']:'pid'); ?>" data-next-level="4" data-next-level-id="linkages_<?php echo $form_group['name']; ?>_4">
            <option value="">请选择：</option>
            <?php if(!(empty($level_data['2']) || (($level_data['2'] instanceof \think\Collection || $level_data['2'] instanceof \think\Paginator ) && $level_data['2']->isEmpty()))): if(is_array($level_data['2']) || $level_data['2'] instanceof \think\Collection || $level_data['2'] instanceof \think\Paginator): $i = 0; $__LIST__ = $level_data['2'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $option[$form_group['key']]; ?>" <?php if(($level_key[3] == (string)$option[$form_group['key']])): ?>selected<?php endif; ?>><?php echo clear_js($option[$form_group['option']]); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </select>
    </div>
    <div class="select-box">
        <select class="js-select2 form-control" name="<?php echo $form_group['name']; ?>" id="linkages_<?php echo $form_group['name']; ?>_4">
            <option value="">请选择：</option>
            <?php if(!(empty($level_data['3']) || (($level_data['3'] instanceof \think\Collection || $level_data['3'] instanceof \think\Paginator ) && $level_data['3']->isEmpty()))): if(is_array($level_data['3']) || $level_data['3'] instanceof \think\Collection || $level_data['3'] instanceof \think\Paginator): $i = 0; $__LIST__ = $level_data['3'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $option[$form_group['key']]; ?>" <?php if(($form_group['value'] == (string)$option[$form_group['key']])): ?>selected<?php endif; ?>><?php echo clear_js($option[$form_group['option']]); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </select>
    </div>
    <?php endif; ?>

    <div class="col-xs-12">
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "masked": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-sm-12">
        <input class="js-masked form-control" type="text" id="<?php echo $form_group['name']; ?>" data-format="<?php echo (isset($form_group['format']) && ($form_group['format'] !== '')?$form_group['format']:''); ?>" name="<?php echo $form_group['name']; ?>" value="<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?>" placeholder="<?php echo (isset($form_group['format']) && ($form_group['format'] !== '')?$form_group['format']:''); ?>" <?php echo (isset($form_group['extra_attr']) && ($form_group['extra_attr'] !== '')?$form_group['extra_attr']:''); ?>>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "number": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-sm-12">
        <input class="form-control" type="number" id="<?php echo $form_group['name']; ?>" name="<?php echo $form_group['name']; ?>" value="<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?>" placeholder="请输入<?php echo $form_group['title']; ?>" <?php if(isset($form_group['min']) && $form_group['min'] !== ''): ?>min="<?php echo $form_group['min']; ?>"<?php endif; if(isset($form_group['max']) && $form_group['max'] !== ''): ?>max="<?php echo $form_group['max']; ?>"<?php endif; if(isset($form_group['step']) && $form_group['step'] !== ''): ?>step="<?php echo $form_group['step']; ?>"<?php endif; ?> <?php echo (isset($form_group['extra_attr']) && ($form_group['extra_attr'] !== '')?$form_group['extra_attr']:''); ?>>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "password": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-sm-12">
        <input class="form-control" type="password" id="<?php echo $form_group['name']; ?>" name="<?php echo $form_group['name']; ?>" value="<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?>" placeholder="请输入<?php echo $form_group['title']; ?>" <?php echo (isset($form_group['extra_attr']) && ($form_group['extra_attr'] !== '')?$form_group['extra_attr']:''); ?>>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "radio": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-xs-12">
        <?php if(is_array($form_group['options']) || $form_group['options'] instanceof \think\Collection || $form_group['options'] instanceof \think\Paginator): $i = 0; $__LIST__ = $form_group['options'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
        <label class="css-input css-radio css-radio-<?php echo (isset($form_group['attr']['color']) && ($form_group['attr']['color'] !== '')?$form_group['attr']['color']:'primary'); ?> css-radio-<?php echo (isset($form_group['attr']['size']) && ($form_group['attr']['size'] !== '')?$form_group['attr']['size']:'sm'); ?> push-10-r  <?php echo (isset($form_group['extra_label_class']) && ($form_group['extra_label_class'] !== '')?$form_group['extra_label_class']:''); ?>">
            <input type="radio" name="<?php echo $form_group['name']; ?>" id="<?php echo $form_group['name']; ?><?php echo $i; ?>" value="<?php echo $key; ?>" <?php $key = (string)$key; if($key == (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:'')): ?>checked<?php endif; ?> <?php echo (isset($form_group['extra_attr']) && ($form_group['extra_attr'] !== '')?$form_group['extra_attr']:''); ?>>
            <span></span> <?php echo htmlspecialchars($option); ?>
        </label>
        <?php endforeach; endif; else: echo "" ;endif; if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "range": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-sm-12">
        <input class="js-rangeslider form-control" type="text" id="<?php echo $form_group['name']; ?>" name="<?php echo $form_group['name']; ?>" value="<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?>" data-input-values-separator="<?php echo (isset($form_group['input_values_separator']) && ($form_group['input_values_separator'] !== '')?$form_group['input_values_separator']:';'); ?>" data-min="<?php echo (isset($form_group['min']) && ($form_group['min'] !== '')?$form_group['min']:''); ?>" data-max="<?php echo (isset($form_group['max']) && ($form_group['max'] !== '')?$form_group['max']:''); ?>" data-grid="<?php echo (isset($form_group['grid']) && ($form_group['grid'] !== '')?$form_group['grid']:''); ?>" data-grid-num="<?php echo (isset($form_group['grid_num']) && ($form_group['grid_num'] !== '')?$form_group['grid_num']:''); ?>" data-grid-snap="<?php echo (isset($form_group['grid_snap']) && ($form_group['grid_snap'] !== '')?$form_group['grid_snap']:''); ?>" data-from="<?php echo (isset($form_group['from']) && ($form_group['from'] !== '')?$form_group['from']:''); ?>" data-from-fixed="<?php echo (isset($form_group['from_fixed']) && ($form_group['from_fixed'] !== '')?$form_group['from_fixed']:''); ?>" data-type="<?php echo (isset($form_group['double']) && ($form_group['double'] !== '')?$form_group['double']:''); ?>" data-to="<?php echo (isset($form_group['to']) && ($form_group['to'] !== '')?$form_group['to']:''); ?>" data-to-fixed="<?php echo (isset($form_group['to_fixed']) && ($form_group['to_fixed'] !== '')?$form_group['to_fixed']:''); ?>" data-step="<?php echo (isset($form_group['step']) && ($form_group['step'] !== '')?$form_group['step']:''); ?>" data-from-min="<?php echo (isset($form_group['from_min']) && ($form_group['from_min'] !== '')?$form_group['from_min']:''); ?>" data-from-max="<?php echo (isset($form_group['from_max']) && ($form_group['from_max'] !== '')?$form_group['from_max']:''); ?>" data-to-min="<?php echo (isset($form_group['to_min']) && ($form_group['to_min'] !== '')?$form_group['to_min']:''); ?>" data-to-max="<?php echo (isset($form_group['to_max']) && ($form_group['to_max'] !== '')?$form_group['to_max']:''); ?>" data-from-shadow="<?php echo (isset($form_group['from_shadow']) && ($form_group['from_shadow'] !== '')?$form_group['from_shadow']:''); ?>" data-to-shadow="<?php echo (isset($form_group['to_shadow']) && ($form_group['to_shadow'] !== '')?$form_group['to_shadow']:''); ?>" data-keyboard="<?php echo (isset($form_group['keyboard']) && ($form_group['keyboard'] !== '')?$form_group['keyboard']:''); ?>" data-keyboard-step="<?php echo (isset($form_group['keyboard_step']) && ($form_group['keyboard_step'] !== '')?$form_group['keyboard_step']:''); ?>" data-values="<?php echo (isset($form_group['values']) && ($form_group['values'] !== '')?$form_group['values']:''); ?>" data-prefix="<?php echo (isset($form_group['prefix']) && ($form_group['prefix'] !== '')?$form_group['prefix']:''); ?>" data-disable="<?php echo (isset($form_group['disable']) && ($form_group['disable'] !== '')?$form_group['disable']:''); ?>" data-postfix="<?php echo (isset($form_group['postfix']) && ($form_group['postfix'] !== '')?$form_group['postfix']:''); ?>" data-min-interval="<?php echo (isset($form_group['min_interval']) && ($form_group['min_interval'] !== '')?$form_group['min_interval']:''); ?>" data-max-interval="<?php echo (isset($form_group['max_interval']) && ($form_group['max_interval'] !== '')?$form_group['max_interval']:''); ?>" data-drag-interval="<?php echo (isset($form_group['drag_interval']) && ($form_group['drag_interval'] !== '')?$form_group['drag_interval']:''); ?>" data-prettify-enabled="<?php echo (isset($form_group['prettify_enabled']) && ($form_group['prettify_enabled'] !== '')?$form_group['prettify_enabled']:''); ?>" data-prettify-separator="<?php echo (isset($form_group['prettify_separator']) && ($form_group['prettify_separator'] !== '')?$form_group['prettify_separator']:''); ?>" data-max-postfix="<?php echo (isset($form_group['max_postfix']) && ($form_group['max_postfix'] !== '')?$form_group['max_postfix']:''); ?>" data-decorate-both="<?php echo (isset($form_group['decorate_both']) && ($form_group['decorate_both'] !== '')?$form_group['decorate_both']:''); ?>" data-values-separator="<?php echo (isset($form_group['values_separator']) && ($form_group['values_separator'] !== '')?$form_group['values_separator']:''); ?>" data-hide-min-max="<?php echo (isset($form_group['hide_min_max']) && ($form_group['hide_min_max'] !== '')?$form_group['hide_min_max']:''); ?>" data-hide-from-to="<?php echo (isset($form_group['hide_from_to']) && ($form_group['hide_from_to'] !== '')?$form_group['hide_from_to']:''); ?>" <?php echo (isset($form_group['extra_attr']) && ($form_group['extra_attr'] !== '')?$form_group['extra_attr']:''); ?>>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "select": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-sm-12">
        <select class="js-select2 form-control" id="<?php echo $form_group['name']; ?>" name="<?php echo $form_group['name']; ?>" data-allow-clear="true" data-placeholder="请选择一项" <?php echo (isset($form_group['extra_attr']) && ($form_group['extra_attr'] !== '')?$form_group['extra_attr']:''); ?>>
            <option></option>
            <?php if(is_array($form_group['options']) || $form_group['options'] instanceof \think\Collection || $form_group['options'] instanceof \think\Paginator): $i = 0; $__LIST__ = $form_group['options'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $key; ?>" <?php if(($form_group['value'] == (string)$key)): ?>selected<?php endif; ?>><?php echo clear_js($option); ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "select2": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-sm-12">
        <select class="js-select2 form-control" id="<?php echo $form_group['name']; ?>" name="<?php echo $form_group['name']; ?>[]" data-allow-clear="true" data-placeholder="请选择一项或多项" multiple="multiple" <?php echo (isset($form_group['extra_attr']) && ($form_group['extra_attr'] !== '')?$form_group['extra_attr']:''); ?>>
            <?php if(is_array($form_group['options']) || $form_group['options'] instanceof \think\Collection || $form_group['options'] instanceof \think\Paginator): $i = 0; $__LIST__ = $form_group['options'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;$key = (string)$key; ?>
            <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($form_group['value'])?$form_group['value']:explode(',',$form_group['value']))): ?>selected<?php endif; ?>><?php echo clear_js($option); ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "sort": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <input type="hidden" name="<?php echo $form_group['name']; ?>" value="<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?>">
    <div class="col-sm-12">
        <?php if(empty($form_group['value']) || (($form_group['value'] instanceof \think\Collection || $form_group['value'] instanceof \think\Paginator ) && $form_group['value']->isEmpty())): ?>
            <div class="form-control-static">暂无数据，无法排序</div>
        <?php else: ?>
            <div class="dd nestable" data-name="<?php echo $form_group['name']; ?>">
                <ol class="dd-list">
                    <?php if(is_array($form_group['content']) || $form_group['content'] instanceof \think\Collection || $form_group['content'] instanceof \think\Paginator): $i = 0; $__LIST__ = $form_group['content'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                    <li class="dd-item" data-id="<?php echo $key; ?>">
                        <div class="dd-handle dd3-handle">拖拽</div><div class="dd3-content"><?php echo htmlspecialchars($item); ?></div>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ol>
            </div>
        <?php endif; if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "static": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-sm-12">
        <div class="form-control-static"><?php echo htmlspecialchars((isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:'')); ?></div>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "summernote": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-sm-12">
        <textarea class="js-summernote form-control" id="<?php echo $form_group['name']; ?>" data-width="<?php echo (isset($form_group['width']) && ($form_group['width'] !== '')?$form_group['width']:'100%'); ?>" data-height="<?php echo (isset($form_group['height']) && ($form_group['height'] !== '')?$form_group['height']:400); ?>" name="<?php echo $form_group['name']; ?>" placeholder="请输入<?php echo $form_group['title']; ?>"><?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?></textarea>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "switch": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-sm-12">
        <label class="css-input switch switch-<?php echo (isset($form_group['attr']['size']) && ($form_group['attr']['size'] !== '')?$form_group['attr']['size']:'sm'); ?> switch-<?php echo (isset($form_group['attr']['color']) && ($form_group['attr']['color'] !== '')?$form_group['attr']['color']:'primary'); ?> switch-<?php echo (isset($form_group['attr']['shape']) && ($form_group['attr']['shape'] !== '')?$form_group['attr']['shape']:'rounded'); ?> <?php echo (isset($form_group['extra_label_class']) && ($form_group['extra_label_class'] !== '')?$form_group['extra_label_class']:''); ?>" title="开启/关闭">
            <input type="checkbox" name="<?php echo $form_group['name']; ?>" id="<?php echo $form_group['name']; ?>" <?php if(!(empty($form_group['value']) || (($form_group['value'] instanceof \think\Collection || $form_group['value'] instanceof \think\Paginator ) && $form_group['value']->isEmpty()))): ?>checked<?php endif; ?> <?php echo (isset($form_group['extra_attr']) && ($form_group['extra_attr'] !== '')?$form_group['extra_attr']:''); ?>><span></span>
        </label>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "tags": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-xs-12">
        <input class="js-tags-input form-control" type="text" id="<?php echo $form_group['name']; ?>" name="<?php echo $form_group['name']; ?>" value="<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?>" <?php echo (isset($form_group['extra_attr']) && ($form_group['extra_attr'] !== '')?$form_group['extra_attr']:''); ?>>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "text": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-sm-12">
        <?php if(!(empty($form_group['group']) || (($form_group['group'] instanceof \think\Collection || $form_group['group'] instanceof \think\Paginator ) && $form_group['group']->isEmpty()))): ?>
        <div class="input-group">
        <?php endif; if(!(empty($form_group['group']['0']) || (($form_group['group']['0'] instanceof \think\Collection || $form_group['group']['0'] instanceof \think\Paginator ) && $form_group['group']['0']->isEmpty()))): ?>
        <span class="input-group-addon"><?php echo clear_js($form_group['group']['0']); ?></span>
        <?php endif; ?>

        <input class="form-control" type="text" id="<?php echo $form_group['name']; ?>" name="<?php echo $form_group['name']; ?>" value="<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?>" placeholder="请输入<?php echo $form_group['title']; ?>" <?php echo (isset($form_group['extra_attr']) && ($form_group['extra_attr'] !== '')?$form_group['extra_attr']:''); ?>>

        <?php if(!(empty($form_group['group']['1']) || (($form_group['group']['1'] instanceof \think\Collection || $form_group['group']['1'] instanceof \think\Paginator ) && $form_group['group']['1']->isEmpty()))): ?>
        <span class="input-group-addon"><?php echo clear_js($form_group['group']['1']); ?></span>
        <?php endif; if(!(empty($form_group['group']) || (($form_group['group'] instanceof \think\Collection || $form_group['group'] instanceof \think\Paginator ) && $form_group['group']->isEmpty()))): ?>
        </div>
        <?php endif; if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "time": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-md-12">
        <input class="js-datetimepicker form-control" type="text" id="<?php echo $form_group['name']; ?>" name="<?php echo $form_group['name']; ?>" value="<?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?>" placeholder="<?php echo $form_group['format']; ?>" data-locale="zh-cn" data-format="<?php echo !empty($form_group['format'])?$form_group['format'] : 'HH:mm:ss'; ?>" <?php echo (isset($form_group['extra_attr']) && ($form_group['extra_attr'] !== '')?$form_group['extra_attr']:''); ?>>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "textarea":case "array": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-xs-12">
        <textarea class="form-control" id="<?php echo $form_group['name']; ?>" rows="7" name="<?php echo $form_group['name']; ?>" placeholder="请输入<?php echo $form_group['title']; ?>" <?php echo (isset($form_group['extra_attr']) && ($form_group['extra_attr'] !== '')?$form_group['extra_attr']:''); ?>><?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?></textarea>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "ueditor": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-xs-12">
        <script id="<?php echo $form_group['name']; ?>" class="js-ueditor" name="<?php echo $form_group['name']; ?>" type="text/plain"><?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?></script>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; case "wangeditor": ?>
                                
                                <div class="form-group col-md-<?php echo (isset($_layout[$form_group['name']]) && ($_layout[$form_group['name']] !== '')?$_layout[$form_group['name']]:'12'); ?> <?php echo (isset($form_group['extra_class']) && ($form_group['extra_class'] !== '')?$form_group['extra_class']:''); ?>" id="form_group_<?php echo $form_group['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form_group['name']; ?>"><?php echo htmlspecialchars($form_group['title']); ?></label>
    <div class="col-xs-12">
        <textarea class="form-control js-wangeditor" name="<?php echo $form_group['name']; ?>" data-img-ext="<?php echo config('upload_image_ext'); ?>" id="<?php echo $form_group['name']; ?>" rows="15" placeholder="请输入<?php echo $form_group['title']; ?>"><?php echo (isset($form_group['value']) && ($form_group['value'] !== '')?$form_group['value']:''); ?></textarea>
        <?php if(!(empty($form_group['tips']) || (($form_group['tips'] instanceof \think\Collection || $form_group['tips'] instanceof \think\Paginator ) && $form_group['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form_group['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                            <?php break; endswitch; endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
    </div>
</div>
                                            <?php break; case "hidden": ?>
                                                
                                                <div class="form-group hidden <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <input type="hidden" name="<?php echo $form['name']; ?>" value='<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:""); ?>' class="form-control" id="<?php echo $form['name']; ?>">
</div>
                                            <?php break; case "icon": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-sm-12">
        <div class="input-group js-icon-picker">
            <span class="input-group-addon icon" data-toggle="tooltip" data-placement="bottom" data-original-title="点击选择图标"><i class="<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:'fa fa-plus-circle'); ?>"></i></span>
            <input class="form-control icon_input" type="text" id="<?php echo $form['name']; ?>" name="<?php echo $form['name']; ?>" value="<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?>" placeholder="请选择图标" <?php echo (isset($form['extra_attr']) && ($form['extra_attr'] !== '')?$form['extra_attr']:''); ?>>
            <span class="input-group-addon delete-icon" data-toggle="tooltip" data-placement="bottom" data-original-title="删除图标"><i class="fa fa-times"></i></span>
        </div>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "image": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-xs-12 js-upload-image">
        <div id="file_list_<?php echo $form['name']; ?>" class="uploader-list">
            <?php if(!(empty($form['value']) || (($form['value'] instanceof \think\Collection || $form['value'] instanceof \think\Paginator ) && $form['value']->isEmpty()))): ?>
            <div class="file-item thumbnail">
                <a class="img-link" href="<?php echo get_file_path($form['value']); ?>">
                    <img src="<?php echo get_thumb($form['value']); ?>" width="100">
                </a>
                <i class="fa fa-times-circle remove-picture"></i>
            </div>
            <?php endif; ?>
        </div>
        <div class="clearfix"></div>
        <input type="hidden" name="<?php echo $form['name']; ?>" data-multiple="false" data-size="<?php echo (isset($form['size']) && ($form['size'] !== '')?$form['size']:0); ?>" data-ext='<?php echo (isset($form["ext"]) && ($form["ext"] !== '')?$form["ext"]:""); ?>' id="<?php echo $form['name']; ?>" value="<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?>">
        <div id="picker_<?php echo $form['name']; ?>">上传单张图片</div>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "images": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-xs-12 js-upload-images">
        <div id="file_list_<?php echo $form['name']; ?>" class="uploader-list">
            <?php if(!(empty($form['value']) || (($form['value'] instanceof \think\Collection || $form['value'] instanceof \think\Paginator ) && $form['value']->isEmpty()))): if(is_array(explode(',',$form['value'])) || explode(',',$form['value']) instanceof \think\Collection || explode(',',$form['value']) instanceof \think\Paginator): $i = 0; $__LIST__ = explode(',',$form['value']);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <div class="file-item thumbnail">
                    <a class="img-link" href="<?php echo get_file_path($vo); ?>">
                        <img src="<?php echo get_thumb($vo); ?>" width="100">
                    </a>
                    <i class="fa fa-times-circle remove-picture" data-id="<?php echo $vo; ?>"></i>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </div>
        <div class="clearfix"></div>
        <input type="hidden" name="<?php echo $form['name']; ?>" data-multiple="true" data-size="<?php echo (isset($form['size']) && ($form['size'] !== '')?$form['size']:0); ?>" data-ext='<?php echo (isset($form["ext"]) && ($form["ext"] !== '')?$form["ext"]:""); ?>' id="<?php echo $form['name']; ?>" value="<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?>">
        <div id="picker_<?php echo $form['name']; ?>">上传多张图片</div>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "jcrop": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> js-jcrop-interface <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-sm-12">
        <div class="file-item thumbnail" <?php echo !empty($form['value'])?$form['value']: "style='display:none'"; ?>>
            <a class="img-link" href="<?php echo get_file_path($form['value']); ?>">
                <img src="<?php echo get_thumb($form['value']); ?>" width="100">
            </a>
            <i class="fa fa-times-circle remove-picture"></i>
        </div>
        <div class="clearfix"></div>
        <button class="btn btn-info js-jcrop-upload-btn" type="button">上传图片</button>
        <input type="hidden" class="js-jcrop-cut-info" value="">
        <input type="file" class="hidden js-jcrop-file" accept="image/jpg,image/jpeg,image/bmp,image/png,image/gif" value="">
        <input type="hidden" class="js-jcrop-input" id="<?php echo $form['name']; ?>" name="<?php echo $form['name']; ?>" value="<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?>">
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
    <!-- Pop In Modal -->
    <div class="modal modal-popin fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-popin">
            <div class="modal-content">
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title">图片裁剪</h3>
                    </div>
                    <div class="block-content push-20">
                        <div class="jcrop-preview-parent" <?php echo !empty($form['value'])?$form['value']: "style='display:none'"; ?>>
                            <img src="<?php echo get_file_path($form['value']); ?>" class="jcrop-preview" />
                        </div>
                        <div class="jcrop-img">
                            <img src="<?php echo get_file_path($form['value']); ?>" data-id="<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?>" data-options='<?php echo (isset($form['options']) && ($form['options'] !== '')?$form['options']:""); ?>' class="js-jcrop" style="display: none;" alt="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="pull-left">在图片上拖动鼠标，选择裁剪选区，然后点击“<strong>立即裁剪</strong>”按钮</span>
                    <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">关闭</button>
                    <button class="btn btn-sm btn-primary js-jcrop-cut-btn" type="button"><i class="fa fa-cut"></i> 立即裁剪</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Pop In Modal -->
</div>
                                            <?php break; case "linkage": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo clear_js($form['title']); ?></label>
    <div class="col-sm-12">
        <select class="js-select2 form-control select-linkage" name="<?php echo $form['name']; ?>" id="<?php echo $form['name']; ?>" data-allow-clear="true" data-placeholder="请选择一项" data-url="<?php echo (isset($form['ajax_url']) && ($form['ajax_url'] !== '')?$form['ajax_url']:''); ?>" data-param="<?php echo (isset($form['param']) && ($form['param'] !== '')?$form['param']:$form['name']); ?>" data-next-items="<?php echo $form['next_items']; ?>">
            <option></option>
            <?php if(is_array($form['options']) || $form['options'] instanceof \think\Collection || $form['options'] instanceof \think\Paginator): $i = 0; $__LIST__ = $form['options'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $key; ?>" <?php if(($form['value'] == (string)$key)): ?>selected<?php endif; ?>><?php echo clear_js($option); ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "linkages": 
    // 获取一级联动数据
    $level_one  = get_level_data($form['table'], 0, $form['pid']);
    $level_key  = [];
    $level_data = [];

    // 有默认值
    if ($form['value'] != '') {
        $level_key_data = get_level_key_data($form['table'], $form['value'], $form['key'], $form['option'], $form['pid']);
        $level_key = $level_key_data['key'];
        $level_data = $level_key_data['data'];
        sort($level_key);
        $level_data = array_reverse($level_data);
    }
 ?>
<div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="select-box">
        <select class="js-select2 form-control select-linkages" id="linkages_<?php echo $form['name']; ?>_1" data-table="<?php echo $form['table']; ?>" data-key="<?php echo (isset($form['key']) && ($form['key'] !== '')?$form['key']:'id'); ?>" data-option="<?php echo (isset($form['option']) && ($form['option'] !== '')?$form['option']:'name'); ?>" data-pidkey="<?php echo (isset($form['pid']) && ($form['pid'] !== '')?$form['pid']:'pid'); ?>" data-next-level="2" data-next-level-id="linkages_<?php echo $form['name']; ?>_2">
            <option value="">请选择：</option>
            <?php if(is_array($level_one) || $level_one instanceof \think\Collection || $level_one instanceof \think\Paginator): $i = 0; $__LIST__ = $level_one;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $option[$form['key']]; ?>" <?php if((isset($level_key[1]) && $level_key[1] == (string)$option[$form['key']])): ?>selected<?php endif; ?>><?php echo clear_js($option[$form['option']]); ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
    </div>

    <?php if($form['level'] == '2'): ?>
    <div class="select-box">
        <select class="js-select2 form-control" name="<?php echo $form['name']; ?>" id="linkages_<?php echo $form['name']; ?>_2">
            <option value="">请选择：</option>
            <?php if(!(empty($level_data['1']) || (($level_data['1'] instanceof \think\Collection || $level_data['1'] instanceof \think\Paginator ) && $level_data['1']->isEmpty()))): if(is_array($level_data['1']) || $level_data['1'] instanceof \think\Collection || $level_data['1'] instanceof \think\Paginator): $i = 0; $__LIST__ = $level_data['1'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $option[$form['key']]; ?>" <?php if(($form['value'] == (string)$option[$form['key']])): ?>selected<?php endif; ?>><?php echo clear_js($option[$form['option']]); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </select>
    </div>
    <?php endif; if($form['level'] == '3'): ?>
    <div class="select-box">
        <select class="js-select2 form-control select-linkages" id="linkages_<?php echo $form['name']; ?>_2" data-table="<?php echo $form['table']; ?>" data-key="<?php echo (isset($form['key']) && ($form['key'] !== '')?$form['key']:'id'); ?>" data-option="<?php echo (isset($form['option']) && ($form['option'] !== '')?$form['option']:'name'); ?>" data-pidkey="<?php echo (isset($form['pid']) && ($form['pid'] !== '')?$form['pid']:'pid'); ?>" data-next-level="3" data-next-level-id="linkages_<?php echo $form['name']; ?>_3">
            <option value="">请选择：</option>
            <?php if(!(empty($level_data['1']) || (($level_data['1'] instanceof \think\Collection || $level_data['1'] instanceof \think\Paginator ) && $level_data['1']->isEmpty()))): if(is_array($level_data['1']) || $level_data['1'] instanceof \think\Collection || $level_data['1'] instanceof \think\Paginator): $i = 0; $__LIST__ = $level_data['1'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $option[$form['key']]; ?>" <?php if(($level_key[2] == (string)$option[$form['key']])): ?>selected<?php endif; ?>><?php echo clear_js($option[$form['option']]); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </select>
    </div>
    <div class="select-box">
        <select class="js-select2 form-control" name="<?php echo $form['name']; ?>" id="linkages_<?php echo $form['name']; ?>_3">
            <option value="">请选择：</option>
            <?php if(!(empty($level_data['2']) || (($level_data['2'] instanceof \think\Collection || $level_data['2'] instanceof \think\Paginator ) && $level_data['2']->isEmpty()))): if(is_array($level_data['2']) || $level_data['2'] instanceof \think\Collection || $level_data['2'] instanceof \think\Paginator): $i = 0; $__LIST__ = $level_data['2'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $option[$form['key']]; ?>" <?php if(($form['value'] == (string)$option[$form['key']])): ?>selected<?php endif; ?>><?php echo clear_js($option[$form['option']]); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </select>
    </div>
    <?php endif; if($form['level'] == '4'): ?>
    <div class="select-box">
        <select class="js-select2 form-control select-linkages" id="linkages_<?php echo $form['name']; ?>_2" data-table="<?php echo $form['table']; ?>" data-key="<?php echo (isset($form['key']) && ($form['key'] !== '')?$form['key']:'id'); ?>" data-option="<?php echo (isset($form['option']) && ($form['option'] !== '')?$form['option']:'name'); ?>" data-pidkey="<?php echo (isset($form['pid']) && ($form['pid'] !== '')?$form['pid']:'pid'); ?>" data-next-level="3" data-next-level-id="linkages_<?php echo $form['name']; ?>_3">
            <option value="">请选择：</option>
            <?php if(!(empty($level_data['1']) || (($level_data['1'] instanceof \think\Collection || $level_data['1'] instanceof \think\Paginator ) && $level_data['1']->isEmpty()))): if(is_array($level_data['1']) || $level_data['1'] instanceof \think\Collection || $level_data['1'] instanceof \think\Paginator): $i = 0; $__LIST__ = $level_data['1'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $option[$form['key']]; ?>" <?php if(($level_key[2] == (string)$option[$form['key']])): ?>selected<?php endif; ?>><?php echo clear_js($option[$form['option']]); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </select>
    </div>
    <div class="select-box">
        <select class="js-select2 form-control select-linkages" id="linkages_<?php echo $form['name']; ?>_3" data-table="<?php echo $form['table']; ?>" data-key="<?php echo (isset($form['key']) && ($form['key'] !== '')?$form['key']:'id'); ?>" data-option="<?php echo (isset($form['option']) && ($form['option'] !== '')?$form['option']:'name'); ?>" data-pidkey="<?php echo (isset($form['pid']) && ($form['pid'] !== '')?$form['pid']:'pid'); ?>" data-next-level="4" data-next-level-id="linkages_<?php echo $form['name']; ?>_4">
            <option value="">请选择：</option>
            <?php if(!(empty($level_data['2']) || (($level_data['2'] instanceof \think\Collection || $level_data['2'] instanceof \think\Paginator ) && $level_data['2']->isEmpty()))): if(is_array($level_data['2']) || $level_data['2'] instanceof \think\Collection || $level_data['2'] instanceof \think\Paginator): $i = 0; $__LIST__ = $level_data['2'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $option[$form['key']]; ?>" <?php if(($level_key[3] == (string)$option[$form['key']])): ?>selected<?php endif; ?>><?php echo clear_js($option[$form['option']]); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </select>
    </div>
    <div class="select-box">
        <select class="js-select2 form-control" name="<?php echo $form['name']; ?>" id="linkages_<?php echo $form['name']; ?>_4">
            <option value="">请选择：</option>
            <?php if(!(empty($level_data['3']) || (($level_data['3'] instanceof \think\Collection || $level_data['3'] instanceof \think\Paginator ) && $level_data['3']->isEmpty()))): if(is_array($level_data['3']) || $level_data['3'] instanceof \think\Collection || $level_data['3'] instanceof \think\Paginator): $i = 0; $__LIST__ = $level_data['3'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $option[$form['key']]; ?>" <?php if(($form['value'] == (string)$option[$form['key']])): ?>selected<?php endif; ?>><?php echo clear_js($option[$form['option']]); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </select>
    </div>
    <?php endif; ?>

    <div class="col-xs-12">
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "masked": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-sm-12">
        <input class="js-masked form-control" type="text" id="<?php echo $form['name']; ?>" data-format="<?php echo (isset($form['format']) && ($form['format'] !== '')?$form['format']:''); ?>" name="<?php echo $form['name']; ?>" value="<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?>" placeholder="<?php echo (isset($form['format']) && ($form['format'] !== '')?$form['format']:''); ?>" <?php echo (isset($form['extra_attr']) && ($form['extra_attr'] !== '')?$form['extra_attr']:''); ?>>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "number": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-sm-12">
        <input class="form-control" type="number" id="<?php echo $form['name']; ?>" name="<?php echo $form['name']; ?>" value="<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?>" placeholder="请输入<?php echo $form['title']; ?>" <?php if(isset($form['min']) && $form['min'] !== ''): ?>min="<?php echo $form['min']; ?>"<?php endif; if(isset($form['max']) && $form['max'] !== ''): ?>max="<?php echo $form['max']; ?>"<?php endif; if(isset($form['step']) && $form['step'] !== ''): ?>step="<?php echo $form['step']; ?>"<?php endif; ?> <?php echo (isset($form['extra_attr']) && ($form['extra_attr'] !== '')?$form['extra_attr']:''); ?>>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "password": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-sm-12">
        <input class="form-control" type="password" id="<?php echo $form['name']; ?>" name="<?php echo $form['name']; ?>" value="<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?>" placeholder="请输入<?php echo $form['title']; ?>" <?php echo (isset($form['extra_attr']) && ($form['extra_attr'] !== '')?$form['extra_attr']:''); ?>>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "radio": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-xs-12">
        <?php if(is_array($form['options']) || $form['options'] instanceof \think\Collection || $form['options'] instanceof \think\Paginator): $i = 0; $__LIST__ = $form['options'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
        <label class="css-input css-radio css-radio-<?php echo (isset($form['attr']['color']) && ($form['attr']['color'] !== '')?$form['attr']['color']:'primary'); ?> css-radio-<?php echo (isset($form['attr']['size']) && ($form['attr']['size'] !== '')?$form['attr']['size']:'sm'); ?> push-10-r  <?php echo (isset($form['extra_label_class']) && ($form['extra_label_class'] !== '')?$form['extra_label_class']:''); ?>">
            <input type="radio" name="<?php echo $form['name']; ?>" id="<?php echo $form['name']; ?><?php echo $i; ?>" value="<?php echo $key; ?>" <?php $key = (string)$key; if($key == (isset($form['value']) && ($form['value'] !== '')?$form['value']:'')): ?>checked<?php endif; ?> <?php echo (isset($form['extra_attr']) && ($form['extra_attr'] !== '')?$form['extra_attr']:''); ?>>
            <span></span> <?php echo htmlspecialchars($option); ?>
        </label>
        <?php endforeach; endif; else: echo "" ;endif; if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "range": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-sm-12">
        <input class="js-rangeslider form-control" type="text" id="<?php echo $form['name']; ?>" name="<?php echo $form['name']; ?>" value="<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?>" data-input-values-separator="<?php echo (isset($form['input_values_separator']) && ($form['input_values_separator'] !== '')?$form['input_values_separator']:';'); ?>" data-min="<?php echo (isset($form['min']) && ($form['min'] !== '')?$form['min']:''); ?>" data-max="<?php echo (isset($form['max']) && ($form['max'] !== '')?$form['max']:''); ?>" data-grid="<?php echo (isset($form['grid']) && ($form['grid'] !== '')?$form['grid']:''); ?>" data-grid-num="<?php echo (isset($form['grid_num']) && ($form['grid_num'] !== '')?$form['grid_num']:''); ?>" data-grid-snap="<?php echo (isset($form['grid_snap']) && ($form['grid_snap'] !== '')?$form['grid_snap']:''); ?>" data-from="<?php echo (isset($form['from']) && ($form['from'] !== '')?$form['from']:''); ?>" data-from-fixed="<?php echo (isset($form['from_fixed']) && ($form['from_fixed'] !== '')?$form['from_fixed']:''); ?>" data-type="<?php echo (isset($form['double']) && ($form['double'] !== '')?$form['double']:''); ?>" data-to="<?php echo (isset($form['to']) && ($form['to'] !== '')?$form['to']:''); ?>" data-to-fixed="<?php echo (isset($form['to_fixed']) && ($form['to_fixed'] !== '')?$form['to_fixed']:''); ?>" data-step="<?php echo (isset($form['step']) && ($form['step'] !== '')?$form['step']:''); ?>" data-from-min="<?php echo (isset($form['from_min']) && ($form['from_min'] !== '')?$form['from_min']:''); ?>" data-from-max="<?php echo (isset($form['from_max']) && ($form['from_max'] !== '')?$form['from_max']:''); ?>" data-to-min="<?php echo (isset($form['to_min']) && ($form['to_min'] !== '')?$form['to_min']:''); ?>" data-to-max="<?php echo (isset($form['to_max']) && ($form['to_max'] !== '')?$form['to_max']:''); ?>" data-from-shadow="<?php echo (isset($form['from_shadow']) && ($form['from_shadow'] !== '')?$form['from_shadow']:''); ?>" data-to-shadow="<?php echo (isset($form['to_shadow']) && ($form['to_shadow'] !== '')?$form['to_shadow']:''); ?>" data-keyboard="<?php echo (isset($form['keyboard']) && ($form['keyboard'] !== '')?$form['keyboard']:''); ?>" data-keyboard-step="<?php echo (isset($form['keyboard_step']) && ($form['keyboard_step'] !== '')?$form['keyboard_step']:''); ?>" data-values="<?php echo (isset($form['values']) && ($form['values'] !== '')?$form['values']:''); ?>" data-prefix="<?php echo (isset($form['prefix']) && ($form['prefix'] !== '')?$form['prefix']:''); ?>" data-disable="<?php echo (isset($form['disable']) && ($form['disable'] !== '')?$form['disable']:''); ?>" data-postfix="<?php echo (isset($form['postfix']) && ($form['postfix'] !== '')?$form['postfix']:''); ?>" data-min-interval="<?php echo (isset($form['min_interval']) && ($form['min_interval'] !== '')?$form['min_interval']:''); ?>" data-max-interval="<?php echo (isset($form['max_interval']) && ($form['max_interval'] !== '')?$form['max_interval']:''); ?>" data-drag-interval="<?php echo (isset($form['drag_interval']) && ($form['drag_interval'] !== '')?$form['drag_interval']:''); ?>" data-prettify-enabled="<?php echo (isset($form['prettify_enabled']) && ($form['prettify_enabled'] !== '')?$form['prettify_enabled']:''); ?>" data-prettify-separator="<?php echo (isset($form['prettify_separator']) && ($form['prettify_separator'] !== '')?$form['prettify_separator']:''); ?>" data-max-postfix="<?php echo (isset($form['max_postfix']) && ($form['max_postfix'] !== '')?$form['max_postfix']:''); ?>" data-decorate-both="<?php echo (isset($form['decorate_both']) && ($form['decorate_both'] !== '')?$form['decorate_both']:''); ?>" data-values-separator="<?php echo (isset($form['values_separator']) && ($form['values_separator'] !== '')?$form['values_separator']:''); ?>" data-hide-min-max="<?php echo (isset($form['hide_min_max']) && ($form['hide_min_max'] !== '')?$form['hide_min_max']:''); ?>" data-hide-from-to="<?php echo (isset($form['hide_from_to']) && ($form['hide_from_to'] !== '')?$form['hide_from_to']:''); ?>" <?php echo (isset($form['extra_attr']) && ($form['extra_attr'] !== '')?$form['extra_attr']:''); ?>>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "select": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-sm-12">
        <select class="js-select2 form-control" id="<?php echo $form['name']; ?>" name="<?php echo $form['name']; ?>" data-allow-clear="true" data-placeholder="请选择一项" <?php echo (isset($form['extra_attr']) && ($form['extra_attr'] !== '')?$form['extra_attr']:''); ?>>
            <option></option>
            <?php if(is_array($form['options']) || $form['options'] instanceof \think\Collection || $form['options'] instanceof \think\Paginator): $i = 0; $__LIST__ = $form['options'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $key; ?>" <?php if(($form['value'] == (string)$key)): ?>selected<?php endif; ?>><?php echo clear_js($option); ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "select2": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-sm-12">
        <select class="js-select2 form-control" id="<?php echo $form['name']; ?>" name="<?php echo $form['name']; ?>[]" data-allow-clear="true" data-placeholder="请选择一项或多项" multiple="multiple" <?php echo (isset($form['extra_attr']) && ($form['extra_attr'] !== '')?$form['extra_attr']:''); ?>>
            <?php if(is_array($form['options']) || $form['options'] instanceof \think\Collection || $form['options'] instanceof \think\Paginator): $i = 0; $__LIST__ = $form['options'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;$key = (string)$key; ?>
            <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($form['value'])?$form['value']:explode(',',$form['value']))): ?>selected<?php endif; ?>><?php echo clear_js($option); ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "sort": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <input type="hidden" name="<?php echo $form['name']; ?>" value="<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?>">
    <div class="col-sm-12">
        <?php if(empty($form['value']) || (($form['value'] instanceof \think\Collection || $form['value'] instanceof \think\Paginator ) && $form['value']->isEmpty())): ?>
            <div class="form-control-static">暂无数据，无法排序</div>
        <?php else: ?>
            <div class="dd nestable" data-name="<?php echo $form['name']; ?>">
                <ol class="dd-list">
                    <?php if(is_array($form['content']) || $form['content'] instanceof \think\Collection || $form['content'] instanceof \think\Paginator): $i = 0; $__LIST__ = $form['content'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                    <li class="dd-item" data-id="<?php echo $key; ?>">
                        <div class="dd-handle dd3-handle">拖拽</div><div class="dd3-content"><?php echo htmlspecialchars($item); ?></div>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ol>
            </div>
        <?php endif; if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "static": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-sm-12">
        <div class="form-control-static"><?php echo htmlspecialchars((isset($form['value']) && ($form['value'] !== '')?$form['value']:'')); ?></div>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "summernote": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-sm-12">
        <textarea class="js-summernote form-control" id="<?php echo $form['name']; ?>" data-width="<?php echo (isset($form['width']) && ($form['width'] !== '')?$form['width']:'100%'); ?>" data-height="<?php echo (isset($form['height']) && ($form['height'] !== '')?$form['height']:400); ?>" name="<?php echo $form['name']; ?>" placeholder="请输入<?php echo $form['title']; ?>"><?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?></textarea>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "switch": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-sm-12">
        <label class="css-input switch switch-<?php echo (isset($form['attr']['size']) && ($form['attr']['size'] !== '')?$form['attr']['size']:'sm'); ?> switch-<?php echo (isset($form['attr']['color']) && ($form['attr']['color'] !== '')?$form['attr']['color']:'primary'); ?> switch-<?php echo (isset($form['attr']['shape']) && ($form['attr']['shape'] !== '')?$form['attr']['shape']:'rounded'); ?> <?php echo (isset($form['extra_label_class']) && ($form['extra_label_class'] !== '')?$form['extra_label_class']:''); ?>" title="开启/关闭">
            <input type="checkbox" name="<?php echo $form['name']; ?>" id="<?php echo $form['name']; ?>" <?php if(!(empty($form['value']) || (($form['value'] instanceof \think\Collection || $form['value'] instanceof \think\Paginator ) && $form['value']->isEmpty()))): ?>checked<?php endif; ?> <?php echo (isset($form['extra_attr']) && ($form['extra_attr'] !== '')?$form['extra_attr']:''); ?>><span></span>
        </label>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "tags": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-xs-12">
        <input class="js-tags-input form-control" type="text" id="<?php echo $form['name']; ?>" name="<?php echo $form['name']; ?>" value="<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?>" <?php echo (isset($form['extra_attr']) && ($form['extra_attr'] !== '')?$form['extra_attr']:''); ?>>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "text": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-sm-12">
        <?php if(!(empty($form['group']) || (($form['group'] instanceof \think\Collection || $form['group'] instanceof \think\Paginator ) && $form['group']->isEmpty()))): ?>
        <div class="input-group">
        <?php endif; if(!(empty($form['group']['0']) || (($form['group']['0'] instanceof \think\Collection || $form['group']['0'] instanceof \think\Paginator ) && $form['group']['0']->isEmpty()))): ?>
        <span class="input-group-addon"><?php echo clear_js($form['group']['0']); ?></span>
        <?php endif; ?>

        <input class="form-control" type="text" id="<?php echo $form['name']; ?>" name="<?php echo $form['name']; ?>" value="<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?>" placeholder="请输入<?php echo $form['title']; ?>" <?php echo (isset($form['extra_attr']) && ($form['extra_attr'] !== '')?$form['extra_attr']:''); ?>>

        <?php if(!(empty($form['group']['1']) || (($form['group']['1'] instanceof \think\Collection || $form['group']['1'] instanceof \think\Paginator ) && $form['group']['1']->isEmpty()))): ?>
        <span class="input-group-addon"><?php echo clear_js($form['group']['1']); ?></span>
        <?php endif; if(!(empty($form['group']) || (($form['group'] instanceof \think\Collection || $form['group'] instanceof \think\Paginator ) && $form['group']->isEmpty()))): ?>
        </div>
        <?php endif; if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "time": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-md-12">
        <input class="js-datetimepicker form-control" type="text" id="<?php echo $form['name']; ?>" name="<?php echo $form['name']; ?>" value="<?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?>" placeholder="<?php echo $form['format']; ?>" data-locale="zh-cn" data-format="<?php echo !empty($form['format'])?$form['format'] : 'HH:mm:ss'; ?>" <?php echo (isset($form['extra_attr']) && ($form['extra_attr'] !== '')?$form['extra_attr']:''); ?>>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "textarea":case "array": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-xs-12">
        <textarea class="form-control" id="<?php echo $form['name']; ?>" rows="7" name="<?php echo $form['name']; ?>" placeholder="请输入<?php echo $form['title']; ?>" <?php echo (isset($form['extra_attr']) && ($form['extra_attr'] !== '')?$form['extra_attr']:''); ?>><?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?></textarea>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "ueditor": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-xs-12">
        <script id="<?php echo $form['name']; ?>" class="js-ueditor" name="<?php echo $form['name']; ?>" type="text/plain"><?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?></script>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; case "wangeditor": ?>
                                                
                                                <div class="form-group col-md-<?php echo (isset($_layout[$form['name']]) && ($_layout[$form['name']] !== '')?$_layout[$form['name']]:'12'); ?> <?php echo (isset($form['extra_class']) && ($form['extra_class'] !== '')?$form['extra_class']:''); ?>" id="form_group_<?php echo $form['name']; ?>">
    <label class="col-xs-12" for="<?php echo $form['name']; ?>"><?php echo htmlspecialchars($form['title']); ?></label>
    <div class="col-xs-12">
        <textarea class="form-control js-wangeditor" name="<?php echo $form['name']; ?>" data-img-ext="<?php echo config('upload_image_ext'); ?>" id="<?php echo $form['name']; ?>" rows="15" placeholder="请输入<?php echo $form['title']; ?>"><?php echo (isset($form['value']) && ($form['value'] !== '')?$form['value']:''); ?></textarea>
        <?php if(!(empty($form['tips']) || (($form['tips'] instanceof \think\Collection || $form['tips'] instanceof \think\Paginator ) && $form['tips']->isEmpty()))): ?>
        <div class="help-block"><?php echo clear_js($form['tips']); ?></div>
        <?php endif; ?>
    </div>
</div>
                                            <?php break; endswitch; endforeach; endif; else: echo "" ;endif; endif; ?>
                                <div class="form-group col-md-12">
                                    <div class="col-xs-12">
                                        <?php if(isset($btn_hide) && !in_array('submit', $btn_hide)): ?>
                                        <button class="btn btn-minw btn-primary <?php if(!empty($submit_confirm)) echo  'confirm '; if(!empty($ajax_submit)) echo  'ajax-post'; ?>" target-form="form-builder" type="submit">
                                            <?php echo (isset($btn_title['submit']) && ($btn_title['submit'] !== '')?$btn_title['submit']:'提交'); ?>
                                        </button>
                                        <?php endif; if(empty($_pop) || (($_pop instanceof \think\Collection || $_pop instanceof \think\Paginator ) && $_pop->isEmpty())): if(isset($btn_hide) && !in_array('back', $btn_hide)): ?>
                                        <button class="btn btn-default" type="button" onclick="javascript:history.back(-1);return false;">
                                            <?php echo (isset($btn_title['back']) && ($btn_title['back'] !== '')?$btn_title['back']:'返回'); ?>
                                        </button>
                                        <?php endif; else: ?>
                                        <button class="btn btn-default" type="button" id="close-pop">关闭</button>
                                        <?php endif; ?>

                                        
                                        <?php echo (isset($btn_extra) && ($btn_extra !== '')?$btn_extra:''); ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php if(!(empty($_icon) || (($_icon instanceof \think\Collection || $_icon instanceof \think\Paginator ) && $_icon->isEmpty()))): ?>
    <div id="icon_tab" style="display:none">
        <div id="icon_search">
            <form onsubmit="return false;">
                <div class="input-group input-group-lg">
                    <div class="input-group-addon">搜索图标</div>
                    <input class="js-icon-search form-control" type="text" placeholder="例如: 输入 home 或 user">
                </div>
            </form>
        </div>
        <ul  class="nav nav-tabs nav-simple">
            <li class="active">
                <a href="#fa" data-toggle="tab">Font Awesome</a>
            </li>
            <li class="">
                <a href="#gl" data-toggle="tab">Glyphicons</a>
            </li>
            <li class="">
                <a href="#sl" data-toggle="tab">SIMPLE LINE</a>
            </li>
        </ul>
        <div class="tab-content js-icon-content" style="padding: 10px">
            <div class="tab-pane fade active in" id="fa">
                <ul class="js-icon-list items-push-2x text-center"><li title="fa-glass"><i class="fa fa-fw fa-glass"></i> <code>fa-glass</code></li><li title="fa-music"><i class="fa fa-fw fa-music"></i> <code>fa-music</code></li><li title="fa-search"><i class="fa fa-fw fa-search"></i> <code>fa-search</code></li><li title="fa-envelope-o"><i class="fa fa-fw fa-envelope-o"></i> <code>fa-envelope-o</code></li><li title="fa-heart"><i class="fa fa-fw fa-heart"></i> <code>fa-heart</code></li><li title="fa-star"><i class="fa fa-fw fa-star"></i> <code>fa-star</code></li><li title="fa-star-o"><i class="fa fa-fw fa-star-o"></i> <code>fa-star-o</code></li><li title="fa-user"><i class="fa fa-fw fa-user"></i> <code>fa-user</code></li><li title="fa-film"><i class="fa fa-fw fa-film"></i> <code>fa-film</code></li><li title="fa-th-large"><i class="fa fa-fw fa-th-large"></i> <code>fa-th-large</code></li><li title="fa-th"><i class="fa fa-fw fa-th"></i> <code>fa-th</code></li><li title="fa-th-list"><i class="fa fa-fw fa-th-list"></i> <code>fa-th-list</code></li><li title="fa-check"><i class="fa fa-fw fa-check"></i> <code>fa-check</code></li><li title="fa-remove"><i class="fa fa-fw fa-remove"></i> <code>fa-remove</code></li><li title="fa-close"><i class="fa fa-fw fa-close"></i> <code>fa-close</code></li><li title="fa-times"><i class="fa fa-fw fa-times"></i> <code>fa-times</code></li><li title="fa-search-plus"><i class="fa fa-fw fa-search-plus"></i> <code>fa-search-plus</code></li><li title="fa-search-minus"><i class="fa fa-fw fa-search-minus"></i> <code>fa-search-minus</code></li><li title="fa-power-off"><i class="fa fa-fw fa-power-off"></i> <code>fa-power-off</code></li><li title="fa-signal"><i class="fa fa-fw fa-signal"></i> <code>fa-signal</code></li><li title="fa-gear"><i class="fa fa-fw fa-gear"></i> <code>fa-gear</code></li><li title="fa-cog"><i class="fa fa-fw fa-cog"></i> <code>fa-cog</code></li><li title="fa-trash-o"><i class="fa fa-fw fa-trash-o"></i> <code>fa-trash-o</code></li><li title="fa-home"><i class="fa fa-fw fa-home"></i> <code>fa-home</code></li><li title="fa-file-o"><i class="fa fa-fw fa-file-o"></i> <code>fa-file-o</code></li><li title="fa-clock-o"><i class="fa fa-fw fa-clock-o"></i> <code>fa-clock-o</code></li><li title="fa-road"><i class="fa fa-fw fa-road"></i> <code>fa-road</code></li><li title="fa-download"><i class="fa fa-fw fa-download"></i> <code>fa-download</code></li><li title="fa-arrow-circle-o-down"><i class="fa fa-fw fa-arrow-circle-o-down"></i> <code>fa-arrow-circle-o-down</code></li><li title="fa-arrow-circle-o-up"><i class="fa fa-fw fa-arrow-circle-o-up"></i> <code>fa-arrow-circle-o-up</code></li><li title="fa-inbox"><i class="fa fa-fw fa-inbox"></i> <code>fa-inbox</code></li><li title="fa-play-circle-o"><i class="fa fa-fw fa-play-circle-o"></i> <code>fa-play-circle-o</code></li><li title="fa-rotate-right"><i class="fa fa-fw fa-rotate-right"></i> <code>fa-rotate-right</code></li><li title="fa-repeat"><i class="fa fa-fw fa-repeat"></i> <code>fa-repeat</code></li><li title="fa-refresh"><i class="fa fa-fw fa-refresh"></i> <code>fa-refresh</code></li><li title="fa-list-alt"><i class="fa fa-fw fa-list-alt"></i> <code>fa-list-alt</code></li><li title="fa-lock"><i class="fa fa-fw fa-lock"></i> <code>fa-lock</code></li><li title="fa-flag"><i class="fa fa-fw fa-flag"></i> <code>fa-flag</code></li><li title="fa-headphones"><i class="fa fa-fw fa-headphones"></i> <code>fa-headphones</code></li><li title="fa-volume-off"><i class="fa fa-fw fa-volume-off"></i> <code>fa-volume-off</code></li><li title="fa-volume-down"><i class="fa fa-fw fa-volume-down"></i> <code>fa-volume-down</code></li><li title="fa-volume-up"><i class="fa fa-fw fa-volume-up"></i> <code>fa-volume-up</code></li><li title="fa-qrcode"><i class="fa fa-fw fa-qrcode"></i> <code>fa-qrcode</code></li><li title="fa-barcode"><i class="fa fa-fw fa-barcode"></i> <code>fa-barcode</code></li><li title="fa-tag"><i class="fa fa-fw fa-tag"></i> <code>fa-tag</code></li><li title="fa-tags"><i class="fa fa-fw fa-tags"></i> <code>fa-tags</code></li><li title="fa-book"><i class="fa fa-fw fa-book"></i> <code>fa-book</code></li><li title="fa-bookmark"><i class="fa fa-fw fa-bookmark"></i> <code>fa-bookmark</code></li><li title="fa-print"><i class="fa fa-fw fa-print"></i> <code>fa-print</code></li><li title="fa-camera"><i class="fa fa-fw fa-camera"></i> <code>fa-camera</code></li><li title="fa-font"><i class="fa fa-fw fa-font"></i> <code>fa-font</code></li><li title="fa-bold"><i class="fa fa-fw fa-bold"></i> <code>fa-bold</code></li><li title="fa-italic"><i class="fa fa-fw fa-italic"></i> <code>fa-italic</code></li><li title="fa-text-height"><i class="fa fa-fw fa-text-height"></i> <code>fa-text-height</code></li><li title="fa-text-width"><i class="fa fa-fw fa-text-width"></i> <code>fa-text-width</code></li><li title="fa-align-left"><i class="fa fa-fw fa-align-left"></i> <code>fa-align-left</code></li><li title="fa-align-center"><i class="fa fa-fw fa-align-center"></i> <code>fa-align-center</code></li><li title="fa-align-right"><i class="fa fa-fw fa-align-right"></i> <code>fa-align-right</code></li><li title="fa-align-justify"><i class="fa fa-fw fa-align-justify"></i> <code>fa-align-justify</code></li><li title="fa-list"><i class="fa fa-fw fa-list"></i> <code>fa-list</code></li><li title="fa-dedent"><i class="fa fa-fw fa-dedent"></i> <code>fa-dedent</code></li><li title="fa-outdent"><i class="fa fa-fw fa-outdent"></i> <code>fa-outdent</code></li><li title="fa-indent"><i class="fa fa-fw fa-indent"></i> <code>fa-indent</code></li><li title="fa-video-camera"><i class="fa fa-fw fa-video-camera"></i> <code>fa-video-camera</code></li><li title="fa-photo"><i class="fa fa-fw fa-photo"></i> <code>fa-photo</code></li><li title="fa-image"><i class="fa fa-fw fa-image"></i> <code>fa-image</code></li><li title="fa-picture-o"><i class="fa fa-fw fa-picture-o"></i> <code>fa-picture-o</code></li><li title="fa-pencil"><i class="fa fa-fw fa-pencil"></i> <code>fa-pencil</code></li><li title="fa-map-marker"><i class="fa fa-fw fa-map-marker"></i> <code>fa-map-marker</code></li><li title="fa-adjust"><i class="fa fa-fw fa-adjust"></i> <code>fa-adjust</code></li><li title="fa-tint"><i class="fa fa-fw fa-tint"></i> <code>fa-tint</code></li><li title="fa-edit"><i class="fa fa-fw fa-edit"></i> <code>fa-edit</code></li><li title="fa-pencil-square-o"><i class="fa fa-fw fa-pencil-square-o"></i> <code>fa-pencil-square-o</code></li><li title="fa-share-square-o"><i class="fa fa-fw fa-share-square-o"></i> <code>fa-share-square-o</code></li><li title="fa-check-square-o"><i class="fa fa-fw fa-check-square-o"></i> <code>fa-check-square-o</code></li><li title="fa-arrows"><i class="fa fa-fw fa-arrows"></i> <code>fa-arrows</code></li><li title="fa-step-backward"><i class="fa fa-fw fa-step-backward"></i> <code>fa-step-backward</code></li><li title="fa-fast-backward"><i class="fa fa-fw fa-fast-backward"></i> <code>fa-fast-backward</code></li><li title="fa-backward"><i class="fa fa-fw fa-backward"></i> <code>fa-backward</code></li><li title="fa-play"><i class="fa fa-fw fa-play"></i> <code>fa-play</code></li><li title="fa-pause"><i class="fa fa-fw fa-pause"></i> <code>fa-pause</code></li><li title="fa-stop"><i class="fa fa-fw fa-stop"></i> <code>fa-stop</code></li><li title="fa-forward"><i class="fa fa-fw fa-forward"></i> <code>fa-forward</code></li><li title="fa-fast-forward"><i class="fa fa-fw fa-fast-forward"></i> <code>fa-fast-forward</code></li><li title="fa-step-forward"><i class="fa fa-fw fa-step-forward"></i> <code>fa-step-forward</code></li><li title="fa-eject"><i class="fa fa-fw fa-eject"></i> <code>fa-eject</code></li><li title="fa-chevron-left"><i class="fa fa-fw fa-chevron-left"></i> <code>fa-chevron-left</code></li><li title="fa-chevron-right"><i class="fa fa-fw fa-chevron-right"></i> <code>fa-chevron-right</code></li><li title="fa-plus-circle"><i class="fa fa-fw fa-plus-circle"></i> <code>fa-plus-circle</code></li><li title="fa-minus-circle"><i class="fa fa-fw fa-minus-circle"></i> <code>fa-minus-circle</code></li><li title="fa-times-circle"><i class="fa fa-fw fa-times-circle"></i> <code>fa-times-circle</code></li><li title="fa-check-circle"><i class="fa fa-fw fa-check-circle"></i> <code>fa-check-circle</code></li><li title="fa-question-circle"><i class="fa fa-fw fa-question-circle"></i> <code>fa-question-circle</code></li><li title="fa-info-circle"><i class="fa fa-fw fa-info-circle"></i> <code>fa-info-circle</code></li><li title="fa-crosshairs"><i class="fa fa-fw fa-crosshairs"></i> <code>fa-crosshairs</code></li><li title="fa-times-circle-o"><i class="fa fa-fw fa-times-circle-o"></i> <code>fa-times-circle-o</code></li><li title="fa-check-circle-o"><i class="fa fa-fw fa-check-circle-o"></i> <code>fa-check-circle-o</code></li><li title="fa-ban"><i class="fa fa-fw fa-ban"></i> <code>fa-ban</code></li><li title="fa-arrow-left"><i class="fa fa-fw fa-arrow-left"></i> <code>fa-arrow-left</code></li><li title="fa-arrow-right"><i class="fa fa-fw fa-arrow-right"></i> <code>fa-arrow-right</code></li><li title="fa-arrow-up"><i class="fa fa-fw fa-arrow-up"></i> <code>fa-arrow-up</code></li><li title="fa-arrow-down"><i class="fa fa-fw fa-arrow-down"></i> <code>fa-arrow-down</code></li><li title="fa-mail-forward"><i class="fa fa-fw fa-mail-forward"></i> <code>fa-mail-forward</code></li><li title="fa-share"><i class="fa fa-fw fa-share"></i> <code>fa-share</code></li><li title="fa-expand"><i class="fa fa-fw fa-expand"></i> <code>fa-expand</code></li><li title="fa-compress"><i class="fa fa-fw fa-compress"></i> <code>fa-compress</code></li><li title="fa-plus"><i class="fa fa-fw fa-plus"></i> <code>fa-plus</code></li><li title="fa-minus"><i class="fa fa-fw fa-minus"></i> <code>fa-minus</code></li><li title="fa-asterisk"><i class="fa fa-fw fa-asterisk"></i> <code>fa-asterisk</code></li><li title="fa-exclamation-circle"><i class="fa fa-fw fa-exclamation-circle"></i> <code>fa-exclamation-circle</code></li><li title="fa-gift"><i class="fa fa-fw fa-gift"></i> <code>fa-gift</code></li><li title="fa-leaf"><i class="fa fa-fw fa-leaf"></i> <code>fa-leaf</code></li><li title="fa-fire"><i class="fa fa-fw fa-fire"></i> <code>fa-fire</code></li><li title="fa-eye"><i class="fa fa-fw fa-eye"></i> <code>fa-eye</code></li><li title="fa-eye-slash"><i class="fa fa-fw fa-eye-slash"></i> <code>fa-eye-slash</code></li><li title="fa-warning"><i class="fa fa-fw fa-warning"></i> <code>fa-warning</code></li><li title="fa-exclamation-triangle"><i class="fa fa-fw fa-exclamation-triangle"></i> <code>fa-exclamation-triangle</code></li><li title="fa-plane"><i class="fa fa-fw fa-plane"></i> <code>fa-plane</code></li><li title="fa-calendar"><i class="fa fa-fw fa-calendar"></i> <code>fa-calendar</code></li><li title="fa-random"><i class="fa fa-fw fa-random"></i> <code>fa-random</code></li><li title="fa-comment"><i class="fa fa-fw fa-comment"></i> <code>fa-comment</code></li><li title="fa-magnet"><i class="fa fa-fw fa-magnet"></i> <code>fa-magnet</code></li><li title="fa-chevron-up"><i class="fa fa-fw fa-chevron-up"></i> <code>fa-chevron-up</code></li><li title="fa-chevron-down"><i class="fa fa-fw fa-chevron-down"></i> <code>fa-chevron-down</code></li><li title="fa-retweet"><i class="fa fa-fw fa-retweet"></i> <code>fa-retweet</code></li><li title="fa-shopping-cart"><i class="fa fa-fw fa-shopping-cart"></i> <code>fa-shopping-cart</code></li><li title="fa-folder"><i class="fa fa-fw fa-folder"></i> <code>fa-folder</code></li><li title="fa-folder-open"><i class="fa fa-fw fa-folder-open"></i> <code>fa-folder-open</code></li><li title="fa-arrows-v"><i class="fa fa-fw fa-arrows-v"></i> <code>fa-arrows-v</code></li><li title="fa-arrows-h"><i class="fa fa-fw fa-arrows-h"></i> <code>fa-arrows-h</code></li><li title="fa-bar-chart-o"><i class="fa fa-fw fa-bar-chart-o"></i> <code>fa-bar-chart-o</code></li><li title="fa-bar-chart"><i class="fa fa-fw fa-bar-chart"></i> <code>fa-bar-chart</code></li><li title="fa-twitter-square"><i class="fa fa-fw fa-twitter-square"></i> <code>fa-twitter-square</code></li><li title="fa-facebook-square"><i class="fa fa-fw fa-facebook-square"></i> <code>fa-facebook-square</code></li><li title="fa-camera-retro"><i class="fa fa-fw fa-camera-retro"></i> <code>fa-camera-retro</code></li><li title="fa-key"><i class="fa fa-fw fa-key"></i> <code>fa-key</code></li><li title="fa-gears"><i class="fa fa-fw fa-gears"></i> <code>fa-gears</code></li><li title="fa-cogs"><i class="fa fa-fw fa-cogs"></i> <code>fa-cogs</code></li><li title="fa-comments"><i class="fa fa-fw fa-comments"></i> <code>fa-comments</code></li><li title="fa-thumbs-o-up"><i class="fa fa-fw fa-thumbs-o-up"></i> <code>fa-thumbs-o-up</code></li><li title="fa-thumbs-o-down"><i class="fa fa-fw fa-thumbs-o-down"></i> <code>fa-thumbs-o-down</code></li><li title="fa-star-half"><i class="fa fa-fw fa-star-half"></i> <code>fa-star-half</code></li><li title="fa-heart-o"><i class="fa fa-fw fa-heart-o"></i> <code>fa-heart-o</code></li><li title="fa-sign-out"><i class="fa fa-fw fa-sign-out"></i> <code>fa-sign-out</code></li><li title="fa-linkedin-square"><i class="fa fa-fw fa-linkedin-square"></i> <code>fa-linkedin-square</code></li><li title="fa-thumb-tack"><i class="fa fa-fw fa-thumb-tack"></i> <code>fa-thumb-tack</code></li><li title="fa-external-link"><i class="fa fa-fw fa-external-link"></i> <code>fa-external-link</code></li><li title="fa-sign-in"><i class="fa fa-fw fa-sign-in"></i> <code>fa-sign-in</code></li><li title="fa-trophy"><i class="fa fa-fw fa-trophy"></i> <code>fa-trophy</code></li><li title="fa-github-square"><i class="fa fa-fw fa-github-square"></i> <code>fa-github-square</code></li><li title="fa-upload"><i class="fa fa-fw fa-upload"></i> <code>fa-upload</code></li><li title="fa-lemon-o"><i class="fa fa-fw fa-lemon-o"></i> <code>fa-lemon-o</code></li><li title="fa-phone"><i class="fa fa-fw fa-phone"></i> <code>fa-phone</code></li><li title="fa-square-o"><i class="fa fa-fw fa-square-o"></i> <code>fa-square-o</code></li><li title="fa-bookmark-o"><i class="fa fa-fw fa-bookmark-o"></i> <code>fa-bookmark-o</code></li><li title="fa-phone-square"><i class="fa fa-fw fa-phone-square"></i> <code>fa-phone-square</code></li><li title="fa-twitter"><i class="fa fa-fw fa-twitter"></i> <code>fa-twitter</code></li><li title="fa-facebook-f"><i class="fa fa-fw fa-facebook-f"></i> <code>fa-facebook-f</code></li><li title="fa-facebook"><i class="fa fa-fw fa-facebook"></i> <code>fa-facebook</code></li><li title="fa-github"><i class="fa fa-fw fa-github"></i> <code>fa-github</code></li><li title="fa-unlock"><i class="fa fa-fw fa-unlock"></i> <code>fa-unlock</code></li><li title="fa-credit-card"><i class="fa fa-fw fa-credit-card"></i> <code>fa-credit-card</code></li><li title="fa-feed"><i class="fa fa-fw fa-feed"></i> <code>fa-feed</code></li><li title="fa-rss"><i class="fa fa-fw fa-rss"></i> <code>fa-rss</code></li><li title="fa-hdd-o"><i class="fa fa-fw fa-hdd-o"></i> <code>fa-hdd-o</code></li><li title="fa-bullhorn"><i class="fa fa-fw fa-bullhorn"></i> <code>fa-bullhorn</code></li><li title="fa-bell"><i class="fa fa-fw fa-bell"></i> <code>fa-bell</code></li><li title="fa-certificate"><i class="fa fa-fw fa-certificate"></i> <code>fa-certificate</code></li><li title="fa-hand-o-right"><i class="fa fa-fw fa-hand-o-right"></i> <code>fa-hand-o-right</code></li><li title="fa-hand-o-left"><i class="fa fa-fw fa-hand-o-left"></i> <code>fa-hand-o-left</code></li><li title="fa-hand-o-up"><i class="fa fa-fw fa-hand-o-up"></i> <code>fa-hand-o-up</code></li><li title="fa-hand-o-down"><i class="fa fa-fw fa-hand-o-down"></i> <code>fa-hand-o-down</code></li><li title="fa-arrow-circle-left"><i class="fa fa-fw fa-arrow-circle-left"></i> <code>fa-arrow-circle-left</code></li><li title="fa-arrow-circle-right"><i class="fa fa-fw fa-arrow-circle-right"></i> <code>fa-arrow-circle-right</code></li><li title="fa-arrow-circle-up"><i class="fa fa-fw fa-arrow-circle-up"></i> <code>fa-arrow-circle-up</code></li><li title="fa-arrow-circle-down"><i class="fa fa-fw fa-arrow-circle-down"></i> <code>fa-arrow-circle-down</code></li><li title="fa-globe"><i class="fa fa-fw fa-globe"></i> <code>fa-globe</code></li><li title="fa-wrench"><i class="fa fa-fw fa-wrench"></i> <code>fa-wrench</code></li><li title="fa-tasks"><i class="fa fa-fw fa-tasks"></i> <code>fa-tasks</code></li><li title="fa-filter"><i class="fa fa-fw fa-filter"></i> <code>fa-filter</code></li><li title="fa-briefcase"><i class="fa fa-fw fa-briefcase"></i> <code>fa-briefcase</code></li><li title="fa-arrows-alt"><i class="fa fa-fw fa-arrows-alt"></i> <code>fa-arrows-alt</code></li><li title="fa-group"><i class="fa fa-fw fa-group"></i> <code>fa-group</code></li><li title="fa-users"><i class="fa fa-fw fa-users"></i> <code>fa-users</code></li><li title="fa-chain"><i class="fa fa-fw fa-chain"></i> <code>fa-chain</code></li><li title="fa-link"><i class="fa fa-fw fa-link"></i> <code>fa-link</code></li><li title="fa-cloud"><i class="fa fa-fw fa-cloud"></i> <code>fa-cloud</code></li><li title="fa-flask"><i class="fa fa-fw fa-flask"></i> <code>fa-flask</code></li><li title="fa-cut"><i class="fa fa-fw fa-cut"></i> <code>fa-cut</code></li><li title="fa-scissors"><i class="fa fa-fw fa-scissors"></i> <code>fa-scissors</code></li><li title="fa-copy"><i class="fa fa-fw fa-copy"></i> <code>fa-copy</code></li><li title="fa-files-o"><i class="fa fa-fw fa-files-o"></i> <code>fa-files-o</code></li><li title="fa-paperclip"><i class="fa fa-fw fa-paperclip"></i> <code>fa-paperclip</code></li><li title="fa-save"><i class="fa fa-fw fa-save"></i> <code>fa-save</code></li><li title="fa-floppy-o"><i class="fa fa-fw fa-floppy-o"></i> <code>fa-floppy-o</code></li><li title="fa-square"><i class="fa fa-fw fa-square"></i> <code>fa-square</code></li><li title="fa-navicon"><i class="fa fa-fw fa-navicon"></i> <code>fa-navicon</code></li><li title="fa-reorder"><i class="fa fa-fw fa-reorder"></i> <code>fa-reorder</code></li><li title="fa-bars"><i class="fa fa-fw fa-bars"></i> <code>fa-bars</code></li><li title="fa-list-ul"><i class="fa fa-fw fa-list-ul"></i> <code>fa-list-ul</code></li><li title="fa-list-ol"><i class="fa fa-fw fa-list-ol"></i> <code>fa-list-ol</code></li><li title="fa-strikethrough"><i class="fa fa-fw fa-strikethrough"></i> <code>fa-strikethrough</code></li><li title="fa-underline"><i class="fa fa-fw fa-underline"></i> <code>fa-underline</code></li><li title="fa-table"><i class="fa fa-fw fa-table"></i> <code>fa-table</code></li><li title="fa-magic"><i class="fa fa-fw fa-magic"></i> <code>fa-magic</code></li><li title="fa-truck"><i class="fa fa-fw fa-truck"></i> <code>fa-truck</code></li><li title="fa-pinterest"><i class="fa fa-fw fa-pinterest"></i> <code>fa-pinterest</code></li><li title="fa-pinterest-square"><i class="fa fa-fw fa-pinterest-square"></i> <code>fa-pinterest-square</code></li><li title="fa-google-plus-square"><i class="fa fa-fw fa-google-plus-square"></i> <code>fa-google-plus-square</code></li><li title="fa-google-plus"><i class="fa fa-fw fa-google-plus"></i> <code>fa-google-plus</code></li><li title="fa-money"><i class="fa fa-fw fa-money"></i> <code>fa-money</code></li><li title="fa-caret-down"><i class="fa fa-fw fa-caret-down"></i> <code>fa-caret-down</code></li><li title="fa-caret-up"><i class="fa fa-fw fa-caret-up"></i> <code>fa-caret-up</code></li><li title="fa-caret-left"><i class="fa fa-fw fa-caret-left"></i> <code>fa-caret-left</code></li><li title="fa-caret-right"><i class="fa fa-fw fa-caret-right"></i> <code>fa-caret-right</code></li><li title="fa-columns"><i class="fa fa-fw fa-columns"></i> <code>fa-columns</code></li><li title="fa-unsorted"><i class="fa fa-fw fa-unsorted"></i> <code>fa-unsorted</code></li><li title="fa-sort"><i class="fa fa-fw fa-sort"></i> <code>fa-sort</code></li><li title="fa-sort-down"><i class="fa fa-fw fa-sort-down"></i> <code>fa-sort-down</code></li><li title="fa-sort-desc"><i class="fa fa-fw fa-sort-desc"></i> <code>fa-sort-desc</code></li><li title="fa-sort-up"><i class="fa fa-fw fa-sort-up"></i> <code>fa-sort-up</code></li><li title="fa-sort-asc"><i class="fa fa-fw fa-sort-asc"></i> <code>fa-sort-asc</code></li><li title="fa-envelope"><i class="fa fa-fw fa-envelope"></i> <code>fa-envelope</code></li><li title="fa-linkedin"><i class="fa fa-fw fa-linkedin"></i> <code>fa-linkedin</code></li><li title="fa-rotate-left"><i class="fa fa-fw fa-rotate-left"></i> <code>fa-rotate-left</code></li><li title="fa-undo"><i class="fa fa-fw fa-undo"></i> <code>fa-undo</code></li><li title="fa-legal"><i class="fa fa-fw fa-legal"></i> <code>fa-legal</code></li><li title="fa-gavel"><i class="fa fa-fw fa-gavel"></i> <code>fa-gavel</code></li><li title="fa-dashboard"><i class="fa fa-fw fa-dashboard"></i> <code>fa-dashboard</code></li><li title="fa-tachometer"><i class="fa fa-fw fa-tachometer"></i> <code>fa-tachometer</code></li><li title="fa-comment-o"><i class="fa fa-fw fa-comment-o"></i> <code>fa-comment-o</code></li><li title="fa-comments-o"><i class="fa fa-fw fa-comments-o"></i> <code>fa-comments-o</code></li><li title="fa-flash"><i class="fa fa-fw fa-flash"></i> <code>fa-flash</code></li><li title="fa-bolt"><i class="fa fa-fw fa-bolt"></i> <code>fa-bolt</code></li><li title="fa-sitemap"><i class="fa fa-fw fa-sitemap"></i> <code>fa-sitemap</code></li><li title="fa-umbrella"><i class="fa fa-fw fa-umbrella"></i> <code>fa-umbrella</code></li><li title="fa-paste"><i class="fa fa-fw fa-paste"></i> <code>fa-paste</code></li><li title="fa-clipboard"><i class="fa fa-fw fa-clipboard"></i> <code>fa-clipboard</code></li><li title="fa-lightbulb-o"><i class="fa fa-fw fa-lightbulb-o"></i> <code>fa-lightbulb-o</code></li><li title="fa-exchange"><i class="fa fa-fw fa-exchange"></i> <code>fa-exchange</code></li><li title="fa-cloud-download"><i class="fa fa-fw fa-cloud-download"></i> <code>fa-cloud-download</code></li><li title="fa-cloud-upload"><i class="fa fa-fw fa-cloud-upload"></i> <code>fa-cloud-upload</code></li><li title="fa-user-md"><i class="fa fa-fw fa-user-md"></i> <code>fa-user-md</code></li><li title="fa-stethoscope"><i class="fa fa-fw fa-stethoscope"></i> <code>fa-stethoscope</code></li><li title="fa-suitcase"><i class="fa fa-fw fa-suitcase"></i> <code>fa-suitcase</code></li><li title="fa-bell-o"><i class="fa fa-fw fa-bell-o"></i> <code>fa-bell-o</code></li><li title="fa-coffee"><i class="fa fa-fw fa-coffee"></i> <code>fa-coffee</code></li><li title="fa-cutlery"><i class="fa fa-fw fa-cutlery"></i> <code>fa-cutlery</code></li><li title="fa-file-text-o"><i class="fa fa-fw fa-file-text-o"></i> <code>fa-file-text-o</code></li><li title="fa-building-o"><i class="fa fa-fw fa-building-o"></i> <code>fa-building-o</code></li><li title="fa-hospital-o"><i class="fa fa-fw fa-hospital-o"></i> <code>fa-hospital-o</code></li><li title="fa-ambulance"><i class="fa fa-fw fa-ambulance"></i> <code>fa-ambulance</code></li><li title="fa-medkit"><i class="fa fa-fw fa-medkit"></i> <code>fa-medkit</code></li><li title="fa-fighter-jet"><i class="fa fa-fw fa-fighter-jet"></i> <code>fa-fighter-jet</code></li><li title="fa-beer"><i class="fa fa-fw fa-beer"></i> <code>fa-beer</code></li><li title="fa-h-square"><i class="fa fa-fw fa-h-square"></i> <code>fa-h-square</code></li><li title="fa-plus-square"><i class="fa fa-fw fa-plus-square"></i> <code>fa-plus-square</code></li><li title="fa-angle-double-left"><i class="fa fa-fw fa-angle-double-left"></i> <code>fa-angle-double-left</code></li><li title="fa-angle-double-right"><i class="fa fa-fw fa-angle-double-right"></i> <code>fa-angle-double-right</code></li><li title="fa-angle-double-up"><i class="fa fa-fw fa-angle-double-up"></i> <code>fa-angle-double-up</code></li><li title="fa-angle-double-down"><i class="fa fa-fw fa-angle-double-down"></i> <code>fa-angle-double-down</code></li><li title="fa-angle-left"><i class="fa fa-fw fa-angle-left"></i> <code>fa-angle-left</code></li><li title="fa-angle-right"><i class="fa fa-fw fa-angle-right"></i> <code>fa-angle-right</code></li><li title="fa-angle-up"><i class="fa fa-fw fa-angle-up"></i> <code>fa-angle-up</code></li><li title="fa-angle-down"><i class="fa fa-fw fa-angle-down"></i> <code>fa-angle-down</code></li><li title="fa-desktop"><i class="fa fa-fw fa-desktop"></i> <code>fa-desktop</code></li><li title="fa-laptop"><i class="fa fa-fw fa-laptop"></i> <code>fa-laptop</code></li><li title="fa-tablet"><i class="fa fa-fw fa-tablet"></i> <code>fa-tablet</code></li><li title="fa-mobile-phone"><i class="fa fa-fw fa-mobile-phone"></i> <code>fa-mobile-phone</code></li><li title="fa-mobile"><i class="fa fa-fw fa-mobile"></i> <code>fa-mobile</code></li><li title="fa-circle-o"><i class="fa fa-fw fa-circle-o"></i> <code>fa-circle-o</code></li><li title="fa-quote-left"><i class="fa fa-fw fa-quote-left"></i> <code>fa-quote-left</code></li><li title="fa-quote-right"><i class="fa fa-fw fa-quote-right"></i> <code>fa-quote-right</code></li><li title="fa-spinner"><i class="fa fa-fw fa-spinner"></i> <code>fa-spinner</code></li><li title="fa-circle"><i class="fa fa-fw fa-circle"></i> <code>fa-circle</code></li><li title="fa-mail-reply"><i class="fa fa-fw fa-mail-reply"></i> <code>fa-mail-reply</code></li><li title="fa-reply"><i class="fa fa-fw fa-reply"></i> <code>fa-reply</code></li><li title="fa-github-alt"><i class="fa fa-fw fa-github-alt"></i> <code>fa-github-alt</code></li><li title="fa-folder-o"><i class="fa fa-fw fa-folder-o"></i> <code>fa-folder-o</code></li><li title="fa-folder-open-o"><i class="fa fa-fw fa-folder-open-o"></i> <code>fa-folder-open-o</code></li><li title="fa-smile-o"><i class="fa fa-fw fa-smile-o"></i> <code>fa-smile-o</code></li><li title="fa-frown-o"><i class="fa fa-fw fa-frown-o"></i> <code>fa-frown-o</code></li><li title="fa-meh-o"><i class="fa fa-fw fa-meh-o"></i> <code>fa-meh-o</code></li><li title="fa-gamepad"><i class="fa fa-fw fa-gamepad"></i> <code>fa-gamepad</code></li><li title="fa-keyboard-o"><i class="fa fa-fw fa-keyboard-o"></i> <code>fa-keyboard-o</code></li><li title="fa-flag-o"><i class="fa fa-fw fa-flag-o"></i> <code>fa-flag-o</code></li><li title="fa-flag-checkered"><i class="fa fa-fw fa-flag-checkered"></i> <code>fa-flag-checkered</code></li><li title="fa-terminal"><i class="fa fa-fw fa-terminal"></i> <code>fa-terminal</code></li><li title="fa-code"><i class="fa fa-fw fa-code"></i> <code>fa-code</code></li><li title="fa-mail-reply-all"><i class="fa fa-fw fa-mail-reply-all"></i> <code>fa-mail-reply-all</code></li><li title="fa-reply-all"><i class="fa fa-fw fa-reply-all"></i> <code>fa-reply-all</code></li><li title="fa-star-half-empty"><i class="fa fa-fw fa-star-half-empty"></i> <code>fa-star-half-empty</code></li><li title="fa-star-half-full"><i class="fa fa-fw fa-star-half-full"></i> <code>fa-star-half-full</code></li><li title="fa-star-half-o"><i class="fa fa-fw fa-star-half-o"></i> <code>fa-star-half-o</code></li><li title="fa-location-arrow"><i class="fa fa-fw fa-location-arrow"></i> <code>fa-location-arrow</code></li><li title="fa-crop"><i class="fa fa-fw fa-crop"></i> <code>fa-crop</code></li><li title="fa-code-fork"><i class="fa fa-fw fa-code-fork"></i> <code>fa-code-fork</code></li><li title="fa-unlink"><i class="fa fa-fw fa-unlink"></i> <code>fa-unlink</code></li><li title="fa-chain-broken"><i class="fa fa-fw fa-chain-broken"></i> <code>fa-chain-broken</code></li><li title="fa-question"><i class="fa fa-fw fa-question"></i> <code>fa-question</code></li><li title="fa-info"><i class="fa fa-fw fa-info"></i> <code>fa-info</code></li><li title="fa-exclamation"><i class="fa fa-fw fa-exclamation"></i> <code>fa-exclamation</code></li><li title="fa-superscript"><i class="fa fa-fw fa-superscript"></i> <code>fa-superscript</code></li><li title="fa-subscript"><i class="fa fa-fw fa-subscript"></i> <code>fa-subscript</code></li><li title="fa-eraser"><i class="fa fa-fw fa-eraser"></i> <code>fa-eraser</code></li><li title="fa-puzzle-piece"><i class="fa fa-fw fa-puzzle-piece"></i> <code>fa-puzzle-piece</code></li><li title="fa-microphone"><i class="fa fa-fw fa-microphone"></i> <code>fa-microphone</code></li><li title="fa-microphone-slash"><i class="fa fa-fw fa-microphone-slash"></i> <code>fa-microphone-slash</code></li><li title="fa-shield"><i class="fa fa-fw fa-shield"></i> <code>fa-shield</code></li><li title="fa-calendar-o"><i class="fa fa-fw fa-calendar-o"></i> <code>fa-calendar-o</code></li><li title="fa-fire-extinguisher"><i class="fa fa-fw fa-fire-extinguisher"></i> <code>fa-fire-extinguisher</code></li><li title="fa-rocket"><i class="fa fa-fw fa-rocket"></i> <code>fa-rocket</code></li><li title="fa-maxcdn"><i class="fa fa-fw fa-maxcdn"></i> <code>fa-maxcdn</code></li><li title="fa-chevron-circle-left"><i class="fa fa-fw fa-chevron-circle-left"></i> <code>fa-chevron-circle-left</code></li><li title="fa-chevron-circle-right"><i class="fa fa-fw fa-chevron-circle-right"></i> <code>fa-chevron-circle-right</code></li><li title="fa-chevron-circle-up"><i class="fa fa-fw fa-chevron-circle-up"></i> <code>fa-chevron-circle-up</code></li><li title="fa-chevron-circle-down"><i class="fa fa-fw fa-chevron-circle-down"></i> <code>fa-chevron-circle-down</code></li><li title="fa-html5"><i class="fa fa-fw fa-html5"></i> <code>fa-html5</code></li><li title="fa-css3"><i class="fa fa-fw fa-css3"></i> <code>fa-css3</code></li><li title="fa-anchor"><i class="fa fa-fw fa-anchor"></i> <code>fa-anchor</code></li><li title="fa-unlock-alt"><i class="fa fa-fw fa-unlock-alt"></i> <code>fa-unlock-alt</code></li><li title="fa-bullseye"><i class="fa fa-fw fa-bullseye"></i> <code>fa-bullseye</code></li><li title="fa-ellipsis-h"><i class="fa fa-fw fa-ellipsis-h"></i> <code>fa-ellipsis-h</code></li><li title="fa-ellipsis-v"><i class="fa fa-fw fa-ellipsis-v"></i> <code>fa-ellipsis-v</code></li><li title="fa-rss-square"><i class="fa fa-fw fa-rss-square"></i> <code>fa-rss-square</code></li><li title="fa-play-circle"><i class="fa fa-fw fa-play-circle"></i> <code>fa-play-circle</code></li><li title="fa-ticket"><i class="fa fa-fw fa-ticket"></i> <code>fa-ticket</code></li><li title="fa-minus-square"><i class="fa fa-fw fa-minus-square"></i> <code>fa-minus-square</code></li><li title="fa-minus-square-o"><i class="fa fa-fw fa-minus-square-o"></i> <code>fa-minus-square-o</code></li><li title="fa-level-up"><i class="fa fa-fw fa-level-up"></i> <code>fa-level-up</code></li><li title="fa-level-down"><i class="fa fa-fw fa-level-down"></i> <code>fa-level-down</code></li><li title="fa-check-square"><i class="fa fa-fw fa-check-square"></i> <code>fa-check-square</code></li><li title="fa-pencil-square"><i class="fa fa-fw fa-pencil-square"></i> <code>fa-pencil-square</code></li><li title="fa-external-link-square"><i class="fa fa-fw fa-external-link-square"></i> <code>fa-external-link-square</code></li><li title="fa-share-square"><i class="fa fa-fw fa-share-square"></i> <code>fa-share-square</code></li><li title="fa-compass"><i class="fa fa-fw fa-compass"></i> <code>fa-compass</code></li><li title="fa-toggle-down"><i class="fa fa-fw fa-toggle-down"></i> <code>fa-toggle-down</code></li><li title="fa-caret-square-o-down"><i class="fa fa-fw fa-caret-square-o-down"></i> <code>fa-caret-square-o-down</code></li><li title="fa-toggle-up"><i class="fa fa-fw fa-toggle-up"></i> <code>fa-toggle-up</code></li><li title="fa-caret-square-o-up"><i class="fa fa-fw fa-caret-square-o-up"></i> <code>fa-caret-square-o-up</code></li><li title="fa-toggle-right"><i class="fa fa-fw fa-toggle-right"></i> <code>fa-toggle-right</code></li><li title="fa-caret-square-o-right"><i class="fa fa-fw fa-caret-square-o-right"></i> <code>fa-caret-square-o-right</code></li><li title="fa-euro"><i class="fa fa-fw fa-euro"></i> <code>fa-euro</code></li><li title="fa-eur"><i class="fa fa-fw fa-eur"></i> <code>fa-eur</code></li><li title="fa-gbp"><i class="fa fa-fw fa-gbp"></i> <code>fa-gbp</code></li><li title="fa-dollar"><i class="fa fa-fw fa-dollar"></i> <code>fa-dollar</code></li><li title="fa-usd"><i class="fa fa-fw fa-usd"></i> <code>fa-usd</code></li><li title="fa-rupee"><i class="fa fa-fw fa-rupee"></i> <code>fa-rupee</code></li><li title="fa-inr"><i class="fa fa-fw fa-inr"></i> <code>fa-inr</code></li><li title="fa-cny"><i class="fa fa-fw fa-cny"></i> <code>fa-cny</code></li><li title="fa-rmb"><i class="fa fa-fw fa-rmb"></i> <code>fa-rmb</code></li><li title="fa-yen"><i class="fa fa-fw fa-yen"></i> <code>fa-yen</code></li><li title="fa-jpy"><i class="fa fa-fw fa-jpy"></i> <code>fa-jpy</code></li><li title="fa-ruble"><i class="fa fa-fw fa-ruble"></i> <code>fa-ruble</code></li><li title="fa-rouble"><i class="fa fa-fw fa-rouble"></i> <code>fa-rouble</code></li><li title="fa-rub"><i class="fa fa-fw fa-rub"></i> <code>fa-rub</code></li><li title="fa-won"><i class="fa fa-fw fa-won"></i> <code>fa-won</code></li><li title="fa-krw"><i class="fa fa-fw fa-krw"></i> <code>fa-krw</code></li><li title="fa-bitcoin"><i class="fa fa-fw fa-bitcoin"></i> <code>fa-bitcoin</code></li><li title="fa-btc"><i class="fa fa-fw fa-btc"></i> <code>fa-btc</code></li><li title="fa-file"><i class="fa fa-fw fa-file"></i> <code>fa-file</code></li><li title="fa-file-text"><i class="fa fa-fw fa-file-text"></i> <code>fa-file-text</code></li><li title="fa-sort-alpha-asc"><i class="fa fa-fw fa-sort-alpha-asc"></i> <code>fa-sort-alpha-asc</code></li><li title="fa-sort-alpha-desc"><i class="fa fa-fw fa-sort-alpha-desc"></i> <code>fa-sort-alpha-desc</code></li><li title="fa-sort-amount-asc"><i class="fa fa-fw fa-sort-amount-asc"></i> <code>fa-sort-amount-asc</code></li><li title="fa-sort-amount-desc"><i class="fa fa-fw fa-sort-amount-desc"></i> <code>fa-sort-amount-desc</code></li><li title="fa-sort-numeric-asc"><i class="fa fa-fw fa-sort-numeric-asc"></i> <code>fa-sort-numeric-asc</code></li><li title="fa-sort-numeric-desc"><i class="fa fa-fw fa-sort-numeric-desc"></i> <code>fa-sort-numeric-desc</code></li><li title="fa-thumbs-up"><i class="fa fa-fw fa-thumbs-up"></i> <code>fa-thumbs-up</code></li><li title="fa-thumbs-down"><i class="fa fa-fw fa-thumbs-down"></i> <code>fa-thumbs-down</code></li><li title="fa-youtube-square"><i class="fa fa-fw fa-youtube-square"></i> <code>fa-youtube-square</code></li><li title="fa-youtube"><i class="fa fa-fw fa-youtube"></i> <code>fa-youtube</code></li><li title="fa-xing"><i class="fa fa-fw fa-xing"></i> <code>fa-xing</code></li><li title="fa-xing-square"><i class="fa fa-fw fa-xing-square"></i> <code>fa-xing-square</code></li><li title="fa-youtube-play"><i class="fa fa-fw fa-youtube-play"></i> <code>fa-youtube-play</code></li><li title="fa-dropbox"><i class="fa fa-fw fa-dropbox"></i> <code>fa-dropbox</code></li><li title="fa-stack-overflow"><i class="fa fa-fw fa-stack-overflow"></i> <code>fa-stack-overflow</code></li><li title="fa-instagram"><i class="fa fa-fw fa-instagram"></i> <code>fa-instagram</code></li><li title="fa-flickr"><i class="fa fa-fw fa-flickr"></i> <code>fa-flickr</code></li><li title="fa-adn"><i class="fa fa-fw fa-adn"></i> <code>fa-adn</code></li><li title="fa-bitbucket"><i class="fa fa-fw fa-bitbucket"></i> <code>fa-bitbucket</code></li><li title="fa-bitbucket-square"><i class="fa fa-fw fa-bitbucket-square"></i> <code>fa-bitbucket-square</code></li><li title="fa-tumblr"><i class="fa fa-fw fa-tumblr"></i> <code>fa-tumblr</code></li><li title="fa-tumblr-square"><i class="fa fa-fw fa-tumblr-square"></i> <code>fa-tumblr-square</code></li><li title="fa-long-arrow-down"><i class="fa fa-fw fa-long-arrow-down"></i> <code>fa-long-arrow-down</code></li><li title="fa-long-arrow-up"><i class="fa fa-fw fa-long-arrow-up"></i> <code>fa-long-arrow-up</code></li><li title="fa-long-arrow-left"><i class="fa fa-fw fa-long-arrow-left"></i> <code>fa-long-arrow-left</code></li><li title="fa-long-arrow-right"><i class="fa fa-fw fa-long-arrow-right"></i> <code>fa-long-arrow-right</code></li><li title="fa-apple"><i class="fa fa-fw fa-apple"></i> <code>fa-apple</code></li><li title="fa-windows"><i class="fa fa-fw fa-windows"></i> <code>fa-windows</code></li><li title="fa-android"><i class="fa fa-fw fa-android"></i> <code>fa-android</code></li><li title="fa-linux"><i class="fa fa-fw fa-linux"></i> <code>fa-linux</code></li><li title="fa-dribbble"><i class="fa fa-fw fa-dribbble"></i> <code>fa-dribbble</code></li><li title="fa-skype"><i class="fa fa-fw fa-skype"></i> <code>fa-skype</code></li><li title="fa-foursquare"><i class="fa fa-fw fa-foursquare"></i> <code>fa-foursquare</code></li><li title="fa-trello"><i class="fa fa-fw fa-trello"></i> <code>fa-trello</code></li><li title="fa-female"><i class="fa fa-fw fa-female"></i> <code>fa-female</code></li><li title="fa-male"><i class="fa fa-fw fa-male"></i> <code>fa-male</code></li><li title="fa-gittip"><i class="fa fa-fw fa-gittip"></i> <code>fa-gittip</code></li><li title="fa-gratipay"><i class="fa fa-fw fa-gratipay"></i> <code>fa-gratipay</code></li><li title="fa-sun-o"><i class="fa fa-fw fa-sun-o"></i> <code>fa-sun-o</code></li><li title="fa-moon-o"><i class="fa fa-fw fa-moon-o"></i> <code>fa-moon-o</code></li><li title="fa-archive"><i class="fa fa-fw fa-archive"></i> <code>fa-archive</code></li><li title="fa-bug"><i class="fa fa-fw fa-bug"></i> <code>fa-bug</code></li><li title="fa-vk"><i class="fa fa-fw fa-vk"></i> <code>fa-vk</code></li><li title="fa-weibo"><i class="fa fa-fw fa-weibo"></i> <code>fa-weibo</code></li><li title="fa-renren"><i class="fa fa-fw fa-renren"></i> <code>fa-renren</code></li><li title="fa-pagelines"><i class="fa fa-fw fa-pagelines"></i> <code>fa-pagelines</code></li><li title="fa-stack-exchange"><i class="fa fa-fw fa-stack-exchange"></i> <code>fa-stack-exchange</code></li><li title="fa-arrow-circle-o-right"><i class="fa fa-fw fa-arrow-circle-o-right"></i> <code>fa-arrow-circle-o-right</code></li><li title="fa-arrow-circle-o-left"><i class="fa fa-fw fa-arrow-circle-o-left"></i> <code>fa-arrow-circle-o-left</code></li><li title="fa-toggle-left"><i class="fa fa-fw fa-toggle-left"></i> <code>fa-toggle-left</code></li><li title="fa-caret-square-o-left"><i class="fa fa-fw fa-caret-square-o-left"></i> <code>fa-caret-square-o-left</code></li><li title="fa-dot-circle-o"><i class="fa fa-fw fa-dot-circle-o"></i> <code>fa-dot-circle-o</code></li><li title="fa-wheelchair"><i class="fa fa-fw fa-wheelchair"></i> <code>fa-wheelchair</code></li><li title="fa-vimeo-square"><i class="fa fa-fw fa-vimeo-square"></i> <code>fa-vimeo-square</code></li><li title="fa-turkish-lira"><i class="fa fa-fw fa-turkish-lira"></i> <code>fa-turkish-lira</code></li><li title="fa-try"><i class="fa fa-fw fa-try"></i> <code>fa-try</code></li><li title="fa-plus-square-o"><i class="fa fa-fw fa-plus-square-o"></i> <code>fa-plus-square-o</code></li><li title="fa-space-shuttle"><i class="fa fa-fw fa-space-shuttle"></i> <code>fa-space-shuttle</code></li><li title="fa-slack"><i class="fa fa-fw fa-slack"></i> <code>fa-slack</code></li><li title="fa-envelope-square"><i class="fa fa-fw fa-envelope-square"></i> <code>fa-envelope-square</code></li><li title="fa-wordpress"><i class="fa fa-fw fa-wordpress"></i> <code>fa-wordpress</code></li><li title="fa-openid"><i class="fa fa-fw fa-openid"></i> <code>fa-openid</code></li><li title="fa-institution"><i class="fa fa-fw fa-institution"></i> <code>fa-institution</code></li><li title="fa-bank"><i class="fa fa-fw fa-bank"></i> <code>fa-bank</code></li><li title="fa-university"><i class="fa fa-fw fa-university"></i> <code>fa-university</code></li><li title="fa-mortar-board"><i class="fa fa-fw fa-mortar-board"></i> <code>fa-mortar-board</code></li><li title="fa-graduation-cap"><i class="fa fa-fw fa-graduation-cap"></i> <code>fa-graduation-cap</code></li><li title="fa-yahoo"><i class="fa fa-fw fa-yahoo"></i> <code>fa-yahoo</code></li><li title="fa-google"><i class="fa fa-fw fa-google"></i> <code>fa-google</code></li><li title="fa-reddit"><i class="fa fa-fw fa-reddit"></i> <code>fa-reddit</code></li><li title="fa-reddit-square"><i class="fa fa-fw fa-reddit-square"></i> <code>fa-reddit-square</code></li><li title="fa-stumbleupon-circle"><i class="fa fa-fw fa-stumbleupon-circle"></i> <code>fa-stumbleupon-circle</code></li><li title="fa-stumbleupon"><i class="fa fa-fw fa-stumbleupon"></i> <code>fa-stumbleupon</code></li><li title="fa-delicious"><i class="fa fa-fw fa-delicious"></i> <code>fa-delicious</code></li><li title="fa-digg"><i class="fa fa-fw fa-digg"></i> <code>fa-digg</code></li><li title="fa-pied-piper-pp"><i class="fa fa-fw fa-pied-piper-pp"></i> <code>fa-pied-piper-pp</code></li><li title="fa-pied-piper-alt"><i class="fa fa-fw fa-pied-piper-alt"></i> <code>fa-pied-piper-alt</code></li><li title="fa-drupal"><i class="fa fa-fw fa-drupal"></i> <code>fa-drupal</code></li><li title="fa-joomla"><i class="fa fa-fw fa-joomla"></i> <code>fa-joomla</code></li><li title="fa-language"><i class="fa fa-fw fa-language"></i> <code>fa-language</code></li><li title="fa-fax"><i class="fa fa-fw fa-fax"></i> <code>fa-fax</code></li><li title="fa-building"><i class="fa fa-fw fa-building"></i> <code>fa-building</code></li><li title="fa-child"><i class="fa fa-fw fa-child"></i> <code>fa-child</code></li><li title="fa-paw"><i class="fa fa-fw fa-paw"></i> <code>fa-paw</code></li><li title="fa-spoon"><i class="fa fa-fw fa-spoon"></i> <code>fa-spoon</code></li><li title="fa-cube"><i class="fa fa-fw fa-cube"></i> <code>fa-cube</code></li><li title="fa-cubes"><i class="fa fa-fw fa-cubes"></i> <code>fa-cubes</code></li><li title="fa-behance"><i class="fa fa-fw fa-behance"></i> <code>fa-behance</code></li><li title="fa-behance-square"><i class="fa fa-fw fa-behance-square"></i> <code>fa-behance-square</code></li><li title="fa-steam"><i class="fa fa-fw fa-steam"></i> <code>fa-steam</code></li><li title="fa-steam-square"><i class="fa fa-fw fa-steam-square"></i> <code>fa-steam-square</code></li><li title="fa-recycle"><i class="fa fa-fw fa-recycle"></i> <code>fa-recycle</code></li><li title="fa-automobile"><i class="fa fa-fw fa-automobile"></i> <code>fa-automobile</code></li><li title="fa-car"><i class="fa fa-fw fa-car"></i> <code>fa-car</code></li><li title="fa-cab"><i class="fa fa-fw fa-cab"></i> <code>fa-cab</code></li><li title="fa-taxi"><i class="fa fa-fw fa-taxi"></i> <code>fa-taxi</code></li><li title="fa-tree"><i class="fa fa-fw fa-tree"></i> <code>fa-tree</code></li><li title="fa-spotify"><i class="fa fa-fw fa-spotify"></i> <code>fa-spotify</code></li><li title="fa-deviantart"><i class="fa fa-fw fa-deviantart"></i> <code>fa-deviantart</code></li><li title="fa-soundcloud"><i class="fa fa-fw fa-soundcloud"></i> <code>fa-soundcloud</code></li><li title="fa-database"><i class="fa fa-fw fa-database"></i> <code>fa-database</code></li><li title="fa-file-pdf-o"><i class="fa fa-fw fa-file-pdf-o"></i> <code>fa-file-pdf-o</code></li><li title="fa-file-word-o"><i class="fa fa-fw fa-file-word-o"></i> <code>fa-file-word-o</code></li><li title="fa-file-excel-o"><i class="fa fa-fw fa-file-excel-o"></i> <code>fa-file-excel-o</code></li><li title="fa-file-powerpoint-o"><i class="fa fa-fw fa-file-powerpoint-o"></i> <code>fa-file-powerpoint-o</code></li><li title="fa-file-photo-o"><i class="fa fa-fw fa-file-photo-o"></i> <code>fa-file-photo-o</code></li><li title="fa-file-picture-o"><i class="fa fa-fw fa-file-picture-o"></i> <code>fa-file-picture-o</code></li><li title="fa-file-image-o"><i class="fa fa-fw fa-file-image-o"></i> <code>fa-file-image-o</code></li><li title="fa-file-zip-o"><i class="fa fa-fw fa-file-zip-o"></i> <code>fa-file-zip-o</code></li><li title="fa-file-archive-o"><i class="fa fa-fw fa-file-archive-o"></i> <code>fa-file-archive-o</code></li><li title="fa-file-sound-o"><i class="fa fa-fw fa-file-sound-o"></i> <code>fa-file-sound-o</code></li><li title="fa-file-audio-o"><i class="fa fa-fw fa-file-audio-o"></i> <code>fa-file-audio-o</code></li><li title="fa-file-movie-o"><i class="fa fa-fw fa-file-movie-o"></i> <code>fa-file-movie-o</code></li><li title="fa-file-video-o"><i class="fa fa-fw fa-file-video-o"></i> <code>fa-file-video-o</code></li><li title="fa-file-code-o"><i class="fa fa-fw fa-file-code-o"></i> <code>fa-file-code-o</code></li><li title="fa-vine"><i class="fa fa-fw fa-vine"></i> <code>fa-vine</code></li><li title="fa-codepen"><i class="fa fa-fw fa-codepen"></i> <code>fa-codepen</code></li><li title="fa-jsfiddle"><i class="fa fa-fw fa-jsfiddle"></i> <code>fa-jsfiddle</code></li><li title="fa-life-bouy"><i class="fa fa-fw fa-life-bouy"></i> <code>fa-life-bouy</code></li><li title="fa-life-buoy"><i class="fa fa-fw fa-life-buoy"></i> <code>fa-life-buoy</code></li><li title="fa-life-saver"><i class="fa fa-fw fa-life-saver"></i> <code>fa-life-saver</code></li><li title="fa-support"><i class="fa fa-fw fa-support"></i> <code>fa-support</code></li><li title="fa-life-ring"><i class="fa fa-fw fa-life-ring"></i> <code>fa-life-ring</code></li><li title="fa-circle-o-notch"><i class="fa fa-fw fa-circle-o-notch"></i> <code>fa-circle-o-notch</code></li><li title="fa-ra"><i class="fa fa-fw fa-ra"></i> <code>fa-ra</code></li><li title="fa-resistance"><i class="fa fa-fw fa-resistance"></i> <code>fa-resistance</code></li><li title="fa-rebel"><i class="fa fa-fw fa-rebel"></i> <code>fa-rebel</code></li><li title="fa-ge"><i class="fa fa-fw fa-ge"></i> <code>fa-ge</code></li><li title="fa-empire"><i class="fa fa-fw fa-empire"></i> <code>fa-empire</code></li><li title="fa-git-square"><i class="fa fa-fw fa-git-square"></i> <code>fa-git-square</code></li><li title="fa-git"><i class="fa fa-fw fa-git"></i> <code>fa-git</code></li><li title="fa-y-combinator-square"><i class="fa fa-fw fa-y-combinator-square"></i> <code>fa-y-combinator-square</code></li><li title="fa-yc-square"><i class="fa fa-fw fa-yc-square"></i> <code>fa-yc-square</code></li><li title="fa-hacker-news"><i class="fa fa-fw fa-hacker-news"></i> <code>fa-hacker-news</code></li><li title="fa-tencent-weibo"><i class="fa fa-fw fa-tencent-weibo"></i> <code>fa-tencent-weibo</code></li><li title="fa-qq"><i class="fa fa-fw fa-qq"></i> <code>fa-qq</code></li><li title="fa-wechat"><i class="fa fa-fw fa-wechat"></i> <code>fa-wechat</code></li><li title="fa-weixin"><i class="fa fa-fw fa-weixin"></i> <code>fa-weixin</code></li><li title="fa-send"><i class="fa fa-fw fa-send"></i> <code>fa-send</code></li><li title="fa-paper-plane"><i class="fa fa-fw fa-paper-plane"></i> <code>fa-paper-plane</code></li><li title="fa-send-o"><i class="fa fa-fw fa-send-o"></i> <code>fa-send-o</code></li><li title="fa-paper-plane-o"><i class="fa fa-fw fa-paper-plane-o"></i> <code>fa-paper-plane-o</code></li><li title="fa-history"><i class="fa fa-fw fa-history"></i> <code>fa-history</code></li><li title="fa-circle-thin"><i class="fa fa-fw fa-circle-thin"></i> <code>fa-circle-thin</code></li><li title="fa-header"><i class="fa fa-fw fa-header"></i> <code>fa-header</code></li><li title="fa-paragraph"><i class="fa fa-fw fa-paragraph"></i> <code>fa-paragraph</code></li><li title="fa-sliders"><i class="fa fa-fw fa-sliders"></i> <code>fa-sliders</code></li><li title="fa-share-alt"><i class="fa fa-fw fa-share-alt"></i> <code>fa-share-alt</code></li><li title="fa-share-alt-square"><i class="fa fa-fw fa-share-alt-square"></i> <code>fa-share-alt-square</code></li><li title="fa-bomb"><i class="fa fa-fw fa-bomb"></i> <code>fa-bomb</code></li><li title="fa-soccer-ball-o"><i class="fa fa-fw fa-soccer-ball-o"></i> <code>fa-soccer-ball-o</code></li><li title="fa-futbol-o"><i class="fa fa-fw fa-futbol-o"></i> <code>fa-futbol-o</code></li><li title="fa-tty"><i class="fa fa-fw fa-tty"></i> <code>fa-tty</code></li><li title="fa-binoculars"><i class="fa fa-fw fa-binoculars"></i> <code>fa-binoculars</code></li><li title="fa-plug"><i class="fa fa-fw fa-plug"></i> <code>fa-plug</code></li><li title="fa-slideshare"><i class="fa fa-fw fa-slideshare"></i> <code>fa-slideshare</code></li><li title="fa-twitch"><i class="fa fa-fw fa-twitch"></i> <code>fa-twitch</code></li><li title="fa-yelp"><i class="fa fa-fw fa-yelp"></i> <code>fa-yelp</code></li><li title="fa-newspaper-o"><i class="fa fa-fw fa-newspaper-o"></i> <code>fa-newspaper-o</code></li><li title="fa-wifi"><i class="fa fa-fw fa-wifi"></i> <code>fa-wifi</code></li><li title="fa-calculator"><i class="fa fa-fw fa-calculator"></i> <code>fa-calculator</code></li><li title="fa-paypal"><i class="fa fa-fw fa-paypal"></i> <code>fa-paypal</code></li><li title="fa-google-wallet"><i class="fa fa-fw fa-google-wallet"></i> <code>fa-google-wallet</code></li><li title="fa-cc-visa"><i class="fa fa-fw fa-cc-visa"></i> <code>fa-cc-visa</code></li><li title="fa-cc-mastercard"><i class="fa fa-fw fa-cc-mastercard"></i> <code>fa-cc-mastercard</code></li><li title="fa-cc-discover"><i class="fa fa-fw fa-cc-discover"></i> <code>fa-cc-discover</code></li><li title="fa-cc-amex"><i class="fa fa-fw fa-cc-amex"></i> <code>fa-cc-amex</code></li><li title="fa-cc-paypal"><i class="fa fa-fw fa-cc-paypal"></i> <code>fa-cc-paypal</code></li><li title="fa-cc-stripe"><i class="fa fa-fw fa-cc-stripe"></i> <code>fa-cc-stripe</code></li><li title="fa-bell-slash"><i class="fa fa-fw fa-bell-slash"></i> <code>fa-bell-slash</code></li><li title="fa-bell-slash-o"><i class="fa fa-fw fa-bell-slash-o"></i> <code>fa-bell-slash-o</code></li><li title="fa-trash"><i class="fa fa-fw fa-trash"></i> <code>fa-trash</code></li><li title="fa-copyright"><i class="fa fa-fw fa-copyright"></i> <code>fa-copyright</code></li><li title="fa-at"><i class="fa fa-fw fa-at"></i> <code>fa-at</code></li><li title="fa-eyedropper"><i class="fa fa-fw fa-eyedropper"></i> <code>fa-eyedropper</code></li><li title="fa-paint-brush"><i class="fa fa-fw fa-paint-brush"></i> <code>fa-paint-brush</code></li><li title="fa-birthday-cake"><i class="fa fa-fw fa-birthday-cake"></i> <code>fa-birthday-cake</code></li><li title="fa-area-chart"><i class="fa fa-fw fa-area-chart"></i> <code>fa-area-chart</code></li><li title="fa-pie-chart"><i class="fa fa-fw fa-pie-chart"></i> <code>fa-pie-chart</code></li><li title="fa-line-chart"><i class="fa fa-fw fa-line-chart"></i> <code>fa-line-chart</code></li><li title="fa-lastfm"><i class="fa fa-fw fa-lastfm"></i> <code>fa-lastfm</code></li><li title="fa-lastfm-square"><i class="fa fa-fw fa-lastfm-square"></i> <code>fa-lastfm-square</code></li><li title="fa-toggle-off"><i class="fa fa-fw fa-toggle-off"></i> <code>fa-toggle-off</code></li><li title="fa-toggle-on"><i class="fa fa-fw fa-toggle-on"></i> <code>fa-toggle-on</code></li><li title="fa-bicycle"><i class="fa fa-fw fa-bicycle"></i> <code>fa-bicycle</code></li><li title="fa-bus"><i class="fa fa-fw fa-bus"></i> <code>fa-bus</code></li><li title="fa-ioxhost"><i class="fa fa-fw fa-ioxhost"></i> <code>fa-ioxhost</code></li><li title="fa-angellist"><i class="fa fa-fw fa-angellist"></i> <code>fa-angellist</code></li><li title="fa-cc"><i class="fa fa-fw fa-cc"></i> <code>fa-cc</code></li><li title="fa-shekel"><i class="fa fa-fw fa-shekel"></i> <code>fa-shekel</code></li><li title="fa-sheqel"><i class="fa fa-fw fa-sheqel"></i> <code>fa-sheqel</code></li><li title="fa-ils"><i class="fa fa-fw fa-ils"></i> <code>fa-ils</code></li><li title="fa-meanpath"><i class="fa fa-fw fa-meanpath"></i> <code>fa-meanpath</code></li><li title="fa-buysellads"><i class="fa fa-fw fa-buysellads"></i> <code>fa-buysellads</code></li><li title="fa-connectdevelop"><i class="fa fa-fw fa-connectdevelop"></i> <code>fa-connectdevelop</code></li><li title="fa-dashcube"><i class="fa fa-fw fa-dashcube"></i> <code>fa-dashcube</code></li><li title="fa-forumbee"><i class="fa fa-fw fa-forumbee"></i> <code>fa-forumbee</code></li><li title="fa-leanpub"><i class="fa fa-fw fa-leanpub"></i> <code>fa-leanpub</code></li><li title="fa-sellsy"><i class="fa fa-fw fa-sellsy"></i> <code>fa-sellsy</code></li><li title="fa-shirtsinbulk"><i class="fa fa-fw fa-shirtsinbulk"></i> <code>fa-shirtsinbulk</code></li><li title="fa-simplybuilt"><i class="fa fa-fw fa-simplybuilt"></i> <code>fa-simplybuilt</code></li><li title="fa-skyatlas"><i class="fa fa-fw fa-skyatlas"></i> <code>fa-skyatlas</code></li><li title="fa-cart-plus"><i class="fa fa-fw fa-cart-plus"></i> <code>fa-cart-plus</code></li><li title="fa-cart-arrow-down"><i class="fa fa-fw fa-cart-arrow-down"></i> <code>fa-cart-arrow-down</code></li><li title="fa-diamond"><i class="fa fa-fw fa-diamond"></i> <code>fa-diamond</code></li><li title="fa-ship"><i class="fa fa-fw fa-ship"></i> <code>fa-ship</code></li><li title="fa-user-secret"><i class="fa fa-fw fa-user-secret"></i> <code>fa-user-secret</code></li><li title="fa-motorcycle"><i class="fa fa-fw fa-motorcycle"></i> <code>fa-motorcycle</code></li><li title="fa-street-view"><i class="fa fa-fw fa-street-view"></i> <code>fa-street-view</code></li><li title="fa-heartbeat"><i class="fa fa-fw fa-heartbeat"></i> <code>fa-heartbeat</code></li><li title="fa-venus"><i class="fa fa-fw fa-venus"></i> <code>fa-venus</code></li><li title="fa-mars"><i class="fa fa-fw fa-mars"></i> <code>fa-mars</code></li><li title="fa-mercury"><i class="fa fa-fw fa-mercury"></i> <code>fa-mercury</code></li><li title="fa-intersex"><i class="fa fa-fw fa-intersex"></i> <code>fa-intersex</code></li><li title="fa-transgender"><i class="fa fa-fw fa-transgender"></i> <code>fa-transgender</code></li><li title="fa-transgender-alt"><i class="fa fa-fw fa-transgender-alt"></i> <code>fa-transgender-alt</code></li><li title="fa-venus-double"><i class="fa fa-fw fa-venus-double"></i> <code>fa-venus-double</code></li><li title="fa-mars-double"><i class="fa fa-fw fa-mars-double"></i> <code>fa-mars-double</code></li><li title="fa-venus-mars"><i class="fa fa-fw fa-venus-mars"></i> <code>fa-venus-mars</code></li><li title="fa-mars-stroke"><i class="fa fa-fw fa-mars-stroke"></i> <code>fa-mars-stroke</code></li><li title="fa-mars-stroke-v"><i class="fa fa-fw fa-mars-stroke-v"></i> <code>fa-mars-stroke-v</code></li><li title="fa-mars-stroke-h"><i class="fa fa-fw fa-mars-stroke-h"></i> <code>fa-mars-stroke-h</code></li><li title="fa-neuter"><i class="fa fa-fw fa-neuter"></i> <code>fa-neuter</code></li><li title="fa-genderless"><i class="fa fa-fw fa-genderless"></i> <code>fa-genderless</code></li><li title="fa-facebook-official"><i class="fa fa-fw fa-facebook-official"></i> <code>fa-facebook-official</code></li><li title="fa-pinterest-p"><i class="fa fa-fw fa-pinterest-p"></i> <code>fa-pinterest-p</code></li><li title="fa-whatsapp"><i class="fa fa-fw fa-whatsapp"></i> <code>fa-whatsapp</code></li><li title="fa-server"><i class="fa fa-fw fa-server"></i> <code>fa-server</code></li><li title="fa-user-plus"><i class="fa fa-fw fa-user-plus"></i> <code>fa-user-plus</code></li><li title="fa-user-times"><i class="fa fa-fw fa-user-times"></i> <code>fa-user-times</code></li><li title="fa-hotel"><i class="fa fa-fw fa-hotel"></i> <code>fa-hotel</code></li><li title="fa-bed"><i class="fa fa-fw fa-bed"></i> <code>fa-bed</code></li><li title="fa-viacoin"><i class="fa fa-fw fa-viacoin"></i> <code>fa-viacoin</code></li><li title="fa-train"><i class="fa fa-fw fa-train"></i> <code>fa-train</code></li><li title="fa-subway"><i class="fa fa-fw fa-subway"></i> <code>fa-subway</code></li><li title="fa-medium"><i class="fa fa-fw fa-medium"></i> <code>fa-medium</code></li><li title="fa-yc"><i class="fa fa-fw fa-yc"></i> <code>fa-yc</code></li><li title="fa-y-combinator"><i class="fa fa-fw fa-y-combinator"></i> <code>fa-y-combinator</code></li><li title="fa-optin-monster"><i class="fa fa-fw fa-optin-monster"></i> <code>fa-optin-monster</code></li><li title="fa-opencart"><i class="fa fa-fw fa-opencart"></i> <code>fa-opencart</code></li><li title="fa-expeditedssl"><i class="fa fa-fw fa-expeditedssl"></i> <code>fa-expeditedssl</code></li><li title="fa-battery-4"><i class="fa fa-fw fa-battery-4"></i> <code>fa-battery-4</code></li><li title="fa-battery"><i class="fa fa-fw fa-battery"></i> <code>fa-battery</code></li><li title="fa-battery-full"><i class="fa fa-fw fa-battery-full"></i> <code>fa-battery-full</code></li><li title="fa-battery-3"><i class="fa fa-fw fa-battery-3"></i> <code>fa-battery-3</code></li><li title="fa-battery-three-quarters"><i class="fa fa-fw fa-battery-three-quarters"></i> <code>fa-battery-three-quarters</code></li><li title="fa-battery-2"><i class="fa fa-fw fa-battery-2"></i> <code>fa-battery-2</code></li><li title="fa-battery-half"><i class="fa fa-fw fa-battery-half"></i> <code>fa-battery-half</code></li><li title="fa-battery-1"><i class="fa fa-fw fa-battery-1"></i> <code>fa-battery-1</code></li><li title="fa-battery-quarter"><i class="fa fa-fw fa-battery-quarter"></i> <code>fa-battery-quarter</code></li><li title="fa-battery-0"><i class="fa fa-fw fa-battery-0"></i> <code>fa-battery-0</code></li><li title="fa-battery-empty"><i class="fa fa-fw fa-battery-empty"></i> <code>fa-battery-empty</code></li><li title="fa-mouse-pointer"><i class="fa fa-fw fa-mouse-pointer"></i> <code>fa-mouse-pointer</code></li><li title="fa-i-cursor"><i class="fa fa-fw fa-i-cursor"></i> <code>fa-i-cursor</code></li><li title="fa-object-group"><i class="fa fa-fw fa-object-group"></i> <code>fa-object-group</code></li><li title="fa-object-ungroup"><i class="fa fa-fw fa-object-ungroup"></i> <code>fa-object-ungroup</code></li><li title="fa-sticky-note"><i class="fa fa-fw fa-sticky-note"></i> <code>fa-sticky-note</code></li><li title="fa-sticky-note-o"><i class="fa fa-fw fa-sticky-note-o"></i> <code>fa-sticky-note-o</code></li><li title="fa-cc-jcb"><i class="fa fa-fw fa-cc-jcb"></i> <code>fa-cc-jcb</code></li><li title="fa-cc-diners-club"><i class="fa fa-fw fa-cc-diners-club"></i> <code>fa-cc-diners-club</code></li><li title="fa-clone"><i class="fa fa-fw fa-clone"></i> <code>fa-clone</code></li><li title="fa-balance-scale"><i class="fa fa-fw fa-balance-scale"></i> <code>fa-balance-scale</code></li><li title="fa-hourglass-o"><i class="fa fa-fw fa-hourglass-o"></i> <code>fa-hourglass-o</code></li><li title="fa-hourglass-1"><i class="fa fa-fw fa-hourglass-1"></i> <code>fa-hourglass-1</code></li><li title="fa-hourglass-start"><i class="fa fa-fw fa-hourglass-start"></i> <code>fa-hourglass-start</code></li><li title="fa-hourglass-2"><i class="fa fa-fw fa-hourglass-2"></i> <code>fa-hourglass-2</code></li><li title="fa-hourglass-half"><i class="fa fa-fw fa-hourglass-half"></i> <code>fa-hourglass-half</code></li><li title="fa-hourglass-3"><i class="fa fa-fw fa-hourglass-3"></i> <code>fa-hourglass-3</code></li><li title="fa-hourglass-end"><i class="fa fa-fw fa-hourglass-end"></i> <code>fa-hourglass-end</code></li><li title="fa-hourglass"><i class="fa fa-fw fa-hourglass"></i> <code>fa-hourglass</code></li><li title="fa-hand-grab-o"><i class="fa fa-fw fa-hand-grab-o"></i> <code>fa-hand-grab-o</code></li><li title="fa-hand-rock-o"><i class="fa fa-fw fa-hand-rock-o"></i> <code>fa-hand-rock-o</code></li><li title="fa-hand-stop-o"><i class="fa fa-fw fa-hand-stop-o"></i> <code>fa-hand-stop-o</code></li><li title="fa-hand-paper-o"><i class="fa fa-fw fa-hand-paper-o"></i> <code>fa-hand-paper-o</code></li><li title="fa-hand-scissors-o"><i class="fa fa-fw fa-hand-scissors-o"></i> <code>fa-hand-scissors-o</code></li><li title="fa-hand-lizard-o"><i class="fa fa-fw fa-hand-lizard-o"></i> <code>fa-hand-lizard-o</code></li><li title="fa-hand-spock-o"><i class="fa fa-fw fa-hand-spock-o"></i> <code>fa-hand-spock-o</code></li><li title="fa-hand-pointer-o"><i class="fa fa-fw fa-hand-pointer-o"></i> <code>fa-hand-pointer-o</code></li><li title="fa-hand-peace-o"><i class="fa fa-fw fa-hand-peace-o"></i> <code>fa-hand-peace-o</code></li><li title="fa-trademark"><i class="fa fa-fw fa-trademark"></i> <code>fa-trademark</code></li><li title="fa-registered"><i class="fa fa-fw fa-registered"></i> <code>fa-registered</code></li><li title="fa-creative-commons"><i class="fa fa-fw fa-creative-commons"></i> <code>fa-creative-commons</code></li><li title="fa-gg"><i class="fa fa-fw fa-gg"></i> <code>fa-gg</code></li><li title="fa-gg-circle"><i class="fa fa-fw fa-gg-circle"></i> <code>fa-gg-circle</code></li><li title="fa-tripadvisor"><i class="fa fa-fw fa-tripadvisor"></i> <code>fa-tripadvisor</code></li><li title="fa-odnoklassniki"><i class="fa fa-fw fa-odnoklassniki"></i> <code>fa-odnoklassniki</code></li><li title="fa-odnoklassniki-square"><i class="fa fa-fw fa-odnoklassniki-square"></i> <code>fa-odnoklassniki-square</code></li><li title="fa-get-pocket"><i class="fa fa-fw fa-get-pocket"></i> <code>fa-get-pocket</code></li><li title="fa-wikipedia-w"><i class="fa fa-fw fa-wikipedia-w"></i> <code>fa-wikipedia-w</code></li><li title="fa-safari"><i class="fa fa-fw fa-safari"></i> <code>fa-safari</code></li><li title="fa-chrome"><i class="fa fa-fw fa-chrome"></i> <code>fa-chrome</code></li><li title="fa-firefox"><i class="fa fa-fw fa-firefox"></i> <code>fa-firefox</code></li><li title="fa-opera"><i class="fa fa-fw fa-opera"></i> <code>fa-opera</code></li><li title="fa-internet-explorer"><i class="fa fa-fw fa-internet-explorer"></i> <code>fa-internet-explorer</code></li><li title="fa-tv"><i class="fa fa-fw fa-tv"></i> <code>fa-tv</code></li><li title="fa-television"><i class="fa fa-fw fa-television"></i> <code>fa-television</code></li><li title="fa-contao"><i class="fa fa-fw fa-contao"></i> <code>fa-contao</code></li><li title="fa-500px"><i class="fa fa-fw fa-500px"></i> <code>fa-500px</code></li><li title="fa-amazon"><i class="fa fa-fw fa-amazon"></i> <code>fa-amazon</code></li><li title="fa-calendar-plus-o"><i class="fa fa-fw fa-calendar-plus-o"></i> <code>fa-calendar-plus-o</code></li><li title="fa-calendar-minus-o"><i class="fa fa-fw fa-calendar-minus-o"></i> <code>fa-calendar-minus-o</code></li><li title="fa-calendar-times-o"><i class="fa fa-fw fa-calendar-times-o"></i> <code>fa-calendar-times-o</code></li><li title="fa-calendar-check-o"><i class="fa fa-fw fa-calendar-check-o"></i> <code>fa-calendar-check-o</code></li><li title="fa-industry"><i class="fa fa-fw fa-industry"></i> <code>fa-industry</code></li><li title="fa-map-pin"><i class="fa fa-fw fa-map-pin"></i> <code>fa-map-pin</code></li><li title="fa-map-signs"><i class="fa fa-fw fa-map-signs"></i> <code>fa-map-signs</code></li><li title="fa-map-o"><i class="fa fa-fw fa-map-o"></i> <code>fa-map-o</code></li><li title="fa-map"><i class="fa fa-fw fa-map"></i> <code>fa-map</code></li><li title="fa-commenting"><i class="fa fa-fw fa-commenting"></i> <code>fa-commenting</code></li><li title="fa-commenting-o"><i class="fa fa-fw fa-commenting-o"></i> <code>fa-commenting-o</code></li><li title="fa-houzz"><i class="fa fa-fw fa-houzz"></i> <code>fa-houzz</code></li><li title="fa-vimeo"><i class="fa fa-fw fa-vimeo"></i> <code>fa-vimeo</code></li><li title="fa-black-tie"><i class="fa fa-fw fa-black-tie"></i> <code>fa-black-tie</code></li><li title="fa-fonticons"><i class="fa fa-fw fa-fonticons"></i> <code>fa-fonticons</code></li><li title="fa-reddit-alien"><i class="fa fa-fw fa-reddit-alien"></i> <code>fa-reddit-alien</code></li><li title="fa-edge"><i class="fa fa-fw fa-edge"></i> <code>fa-edge</code></li><li title="fa-credit-card-alt"><i class="fa fa-fw fa-credit-card-alt"></i> <code>fa-credit-card-alt</code></li><li title="fa-codiepie"><i class="fa fa-fw fa-codiepie"></i> <code>fa-codiepie</code></li><li title="fa-modx"><i class="fa fa-fw fa-modx"></i> <code>fa-modx</code></li><li title="fa-fort-awesome"><i class="fa fa-fw fa-fort-awesome"></i> <code>fa-fort-awesome</code></li><li title="fa-usb"><i class="fa fa-fw fa-usb"></i> <code>fa-usb</code></li><li title="fa-product-hunt"><i class="fa fa-fw fa-product-hunt"></i> <code>fa-product-hunt</code></li><li title="fa-mixcloud"><i class="fa fa-fw fa-mixcloud"></i> <code>fa-mixcloud</code></li><li title="fa-scribd"><i class="fa fa-fw fa-scribd"></i> <code>fa-scribd</code></li><li title="fa-pause-circle"><i class="fa fa-fw fa-pause-circle"></i> <code>fa-pause-circle</code></li><li title="fa-pause-circle-o"><i class="fa fa-fw fa-pause-circle-o"></i> <code>fa-pause-circle-o</code></li><li title="fa-stop-circle"><i class="fa fa-fw fa-stop-circle"></i> <code>fa-stop-circle</code></li><li title="fa-stop-circle-o"><i class="fa fa-fw fa-stop-circle-o"></i> <code>fa-stop-circle-o</code></li><li title="fa-shopping-bag"><i class="fa fa-fw fa-shopping-bag"></i> <code>fa-shopping-bag</code></li><li title="fa-shopping-basket"><i class="fa fa-fw fa-shopping-basket"></i> <code>fa-shopping-basket</code></li><li title="fa-hashtag"><i class="fa fa-fw fa-hashtag"></i> <code>fa-hashtag</code></li><li title="fa-bluetooth"><i class="fa fa-fw fa-bluetooth"></i> <code>fa-bluetooth</code></li><li title="fa-bluetooth-b"><i class="fa fa-fw fa-bluetooth-b"></i> <code>fa-bluetooth-b</code></li><li title="fa-percent"><i class="fa fa-fw fa-percent"></i> <code>fa-percent</code></li><li title="fa-gitlab"><i class="fa fa-fw fa-gitlab"></i> <code>fa-gitlab</code></li><li title="fa-wpbeginner"><i class="fa fa-fw fa-wpbeginner"></i> <code>fa-wpbeginner</code></li><li title="fa-wpforms"><i class="fa fa-fw fa-wpforms"></i> <code>fa-wpforms</code></li><li title="fa-envira"><i class="fa fa-fw fa-envira"></i> <code>fa-envira</code></li><li title="fa-universal-access"><i class="fa fa-fw fa-universal-access"></i> <code>fa-universal-access</code></li><li title="fa-wheelchair-alt"><i class="fa fa-fw fa-wheelchair-alt"></i> <code>fa-wheelchair-alt</code></li><li title="fa-question-circle-o"><i class="fa fa-fw fa-question-circle-o"></i> <code>fa-question-circle-o</code></li><li title="fa-blind"><i class="fa fa-fw fa-blind"></i> <code>fa-blind</code></li><li title="fa-audio-description"><i class="fa fa-fw fa-audio-description"></i> <code>fa-audio-description</code></li><li title="fa-volume-control-phone"><i class="fa fa-fw fa-volume-control-phone"></i> <code>fa-volume-control-phone</code></li><li title="fa-braille"><i class="fa fa-fw fa-braille"></i> <code>fa-braille</code></li><li title="fa-assistive-listening-systems"><i class="fa fa-fw fa-assistive-listening-systems"></i> <code>fa-assistive-listening-systems</code></li><li title="fa-asl-interpreting"><i class="fa fa-fw fa-asl-interpreting"></i> <code>fa-asl-interpreting</code></li><li title="fa-american-sign-language-interpreting"><i class="fa fa-fw fa-american-sign-language-interpreting"></i> <code>fa-american-sign-language-interpreting</code></li><li title="fa-deafness"><i class="fa fa-fw fa-deafness"></i> <code>fa-deafness</code></li><li title="fa-hard-of-hearing"><i class="fa fa-fw fa-hard-of-hearing"></i> <code>fa-hard-of-hearing</code></li><li title="fa-deaf"><i class="fa fa-fw fa-deaf"></i> <code>fa-deaf</code></li><li title="fa-glide"><i class="fa fa-fw fa-glide"></i> <code>fa-glide</code></li><li title="fa-glide-g"><i class="fa fa-fw fa-glide-g"></i> <code>fa-glide-g</code></li><li title="fa-signing"><i class="fa fa-fw fa-signing"></i> <code>fa-signing</code></li><li title="fa-sign-language"><i class="fa fa-fw fa-sign-language"></i> <code>fa-sign-language</code></li><li title="fa-low-vision"><i class="fa fa-fw fa-low-vision"></i> <code>fa-low-vision</code></li><li title="fa-viadeo"><i class="fa fa-fw fa-viadeo"></i> <code>fa-viadeo</code></li><li title="fa-viadeo-square"><i class="fa fa-fw fa-viadeo-square"></i> <code>fa-viadeo-square</code></li><li title="fa-snapchat"><i class="fa fa-fw fa-snapchat"></i> <code>fa-snapchat</code></li><li title="fa-snapchat-ghost"><i class="fa fa-fw fa-snapchat-ghost"></i> <code>fa-snapchat-ghost</code></li><li title="fa-snapchat-square"><i class="fa fa-fw fa-snapchat-square"></i> <code>fa-snapchat-square</code></li><li title="fa-pied-piper"><i class="fa fa-fw fa-pied-piper"></i> <code>fa-pied-piper</code></li><li title="fa-first-order"><i class="fa fa-fw fa-first-order"></i> <code>fa-first-order</code></li><li title="fa-yoast"><i class="fa fa-fw fa-yoast"></i> <code>fa-yoast</code></li><li title="fa-themeisle"><i class="fa fa-fw fa-themeisle"></i> <code>fa-themeisle</code></li><li title="fa-google-plus-circle"><i class="fa fa-fw fa-google-plus-circle"></i> <code>fa-google-plus-circle</code></li><li title="fa-google-plus-official"><i class="fa fa-fw fa-google-plus-official"></i> <code>fa-google-plus-official</code></li><li title="fa-fa"><i class="fa fa-fw fa-fa"></i> <code>fa-fa</code></li><li title="fa-font-awesome"><i class="fa fa-fw fa-font-awesome"></i> <code>fa-font-awesome</code></li><li title="fa-handshake-o"><i class="fa fa-fw fa-handshake-o"></i> <code>fa-handshake-o</code></li><li title="fa-envelope-open"><i class="fa fa-fw fa-envelope-open"></i> <code>fa-envelope-open</code></li><li title="fa-envelope-open-o"><i class="fa fa-fw fa-envelope-open-o"></i> <code>fa-envelope-open-o</code></li><li title="fa-linode"><i class="fa fa-fw fa-linode"></i> <code>fa-linode</code></li><li title="fa-address-book"><i class="fa fa-fw fa-address-book"></i> <code>fa-address-book</code></li><li title="fa-address-book-o"><i class="fa fa-fw fa-address-book-o"></i> <code>fa-address-book-o</code></li><li title="fa-vcard"><i class="fa fa-fw fa-vcard"></i> <code>fa-vcard</code></li><li title="fa-address-card"><i class="fa fa-fw fa-address-card"></i> <code>fa-address-card</code></li><li title="fa-vcard-o"><i class="fa fa-fw fa-vcard-o"></i> <code>fa-vcard-o</code></li><li title="fa-address-card-o"><i class="fa fa-fw fa-address-card-o"></i> <code>fa-address-card-o</code></li><li title="fa-user-circle"><i class="fa fa-fw fa-user-circle"></i> <code>fa-user-circle</code></li><li title="fa-user-circle-o"><i class="fa fa-fw fa-user-circle-o"></i> <code>fa-user-circle-o</code></li><li title="fa-user-o"><i class="fa fa-fw fa-user-o"></i> <code>fa-user-o</code></li><li title="fa-id-badge"><i class="fa fa-fw fa-id-badge"></i> <code>fa-id-badge</code></li><li title="fa-drivers-license"><i class="fa fa-fw fa-drivers-license"></i> <code>fa-drivers-license</code></li><li title="fa-id-card"><i class="fa fa-fw fa-id-card"></i> <code>fa-id-card</code></li><li title="fa-drivers-license-o"><i class="fa fa-fw fa-drivers-license-o"></i> <code>fa-drivers-license-o</code></li><li title="fa-id-card-o"><i class="fa fa-fw fa-id-card-o"></i> <code>fa-id-card-o</code></li><li title="fa-quora"><i class="fa fa-fw fa-quora"></i> <code>fa-quora</code></li><li title="fa-free-code-camp"><i class="fa fa-fw fa-free-code-camp"></i> <code>fa-free-code-camp</code></li><li title="fa-telegram"><i class="fa fa-fw fa-telegram"></i> <code>fa-telegram</code></li><li title="fa-thermometer-4"><i class="fa fa-fw fa-thermometer-4"></i> <code>fa-thermometer-4</code></li><li title="fa-thermometer"><i class="fa fa-fw fa-thermometer"></i> <code>fa-thermometer</code></li><li title="fa-thermometer-full"><i class="fa fa-fw fa-thermometer-full"></i> <code>fa-thermometer-full</code></li><li title="fa-thermometer-3"><i class="fa fa-fw fa-thermometer-3"></i> <code>fa-thermometer-3</code></li><li title="fa-thermometer-three-quarters"><i class="fa fa-fw fa-thermometer-three-quarters"></i> <code>fa-thermometer-three-quarters</code></li><li title="fa-thermometer-2"><i class="fa fa-fw fa-thermometer-2"></i> <code>fa-thermometer-2</code></li><li title="fa-thermometer-half"><i class="fa fa-fw fa-thermometer-half"></i> <code>fa-thermometer-half</code></li><li title="fa-thermometer-1"><i class="fa fa-fw fa-thermometer-1"></i> <code>fa-thermometer-1</code></li><li title="fa-thermometer-quarter"><i class="fa fa-fw fa-thermometer-quarter"></i> <code>fa-thermometer-quarter</code></li><li title="fa-thermometer-0"><i class="fa fa-fw fa-thermometer-0"></i> <code>fa-thermometer-0</code></li><li title="fa-thermometer-empty"><i class="fa fa-fw fa-thermometer-empty"></i> <code>fa-thermometer-empty</code></li><li title="fa-shower"><i class="fa fa-fw fa-shower"></i> <code>fa-shower</code></li><li title="fa-bathtub"><i class="fa fa-fw fa-bathtub"></i> <code>fa-bathtub</code></li><li title="fa-s15"><i class="fa fa-fw fa-s15"></i> <code>fa-s15</code></li><li title="fa-bath"><i class="fa fa-fw fa-bath"></i> <code>fa-bath</code></li><li title="fa-podcast"><i class="fa fa-fw fa-podcast"></i> <code>fa-podcast</code></li><li title="fa-window-maximize"><i class="fa fa-fw fa-window-maximize"></i> <code>fa-window-maximize</code></li><li title="fa-window-minimize"><i class="fa fa-fw fa-window-minimize"></i> <code>fa-window-minimize</code></li><li title="fa-window-restore"><i class="fa fa-fw fa-window-restore"></i> <code>fa-window-restore</code></li><li title="fa-times-rectangle"><i class="fa fa-fw fa-times-rectangle"></i> <code>fa-times-rectangle</code></li><li title="fa-window-close"><i class="fa fa-fw fa-window-close"></i> <code>fa-window-close</code></li><li title="fa-times-rectangle-o"><i class="fa fa-fw fa-times-rectangle-o"></i> <code>fa-times-rectangle-o</code></li><li title="fa-window-close-o"><i class="fa fa-fw fa-window-close-o"></i> <code>fa-window-close-o</code></li><li title="fa-bandcamp"><i class="fa fa-fw fa-bandcamp"></i> <code>fa-bandcamp</code></li><li title="fa-grav"><i class="fa fa-fw fa-grav"></i> <code>fa-grav</code></li><li title="fa-etsy"><i class="fa fa-fw fa-etsy"></i> <code>fa-etsy</code></li><li title="fa-imdb"><i class="fa fa-fw fa-imdb"></i> <code>fa-imdb</code></li><li title="fa-ravelry"><i class="fa fa-fw fa-ravelry"></i> <code>fa-ravelry</code></li><li title="fa-eercast"><i class="fa fa-fw fa-eercast"></i> <code>fa-eercast</code></li><li title="fa-microchip"><i class="fa fa-fw fa-microchip"></i> <code>fa-microchip</code></li><li title="fa-snowflake-o"><i class="fa fa-fw fa-snowflake-o"></i> <code>fa-snowflake-o</code></li><li title="fa-superpowers"><i class="fa fa-fw fa-superpowers"></i> <code>fa-superpowers</code></li><li title="fa-wpexplorer"><i class="fa fa-fw fa-wpexplorer"></i> <code>fa-wpexplorer</code></li><li title="fa-meetup"><i class="fa fa-fw fa-meetup"></i> <code>fa-meetup</code></li></ul>
            </div>
            <div class="tab-pane fade" id="gl">
                <ul class="js-icon-list items-push-2x text-center"><li><i class="glyphicon glyphicon-adjust"></i> <code>glyphicon-adjust</code></li><li><i class="glyphicon glyphicon-alert"></i> <code>glyphicon-alert</code></li><li><i class="glyphicon glyphicon-align-center"></i> <code>glyphicon-align-center</code></li><li><i class="glyphicon glyphicon-align-justify"></i> <code>glyphicon-align-justify</code></li><li><i class="glyphicon glyphicon-align-left"></i> <code>glyphicon-align-left</code></li><li><i class="glyphicon glyphicon-align-right"></i> <code>glyphicon-align-right</code></li><li><i class="glyphicon glyphicon-apple"></i> <code>glyphicon-apple</code></li><li><i class="glyphicon glyphicon-arrow-down"></i> <code>glyphicon-arrow-down</code></li><li><i class="glyphicon glyphicon-arrow-left"></i> <code>glyphicon-arrow-left</code></li><li><i class="glyphicon glyphicon-arrow-right"></i> <code>glyphicon-arrow-right</code></li><li><i class="glyphicon glyphicon-arrow-up"></i> <code>glyphicon-arrow-up</code></li><li><i class="glyphicon glyphicon-asterisk"></i> <code>glyphicon-asterisk</code></li><li><i class="glyphicon glyphicon-baby-formula"></i> <code>glyphicon-baby-formula</code></li><li><i class="glyphicon glyphicon-backward"></i> <code>glyphicon-backward</code></li><li><i class="glyphicon glyphicon-ban-circle"></i> <code>glyphicon-ban-circle</code></li><li><i class="glyphicon glyphicon-barcode"></i> <code>glyphicon-barcode</code></li><li><i class="glyphicon glyphicon-bed"></i> <code>glyphicon-bed</code></li><li><i class="glyphicon glyphicon-bell"></i> <code>glyphicon-bell</code></li><li><i class="glyphicon glyphicon-bishop"></i> <code>glyphicon-bishop</code></li><li><i class="glyphicon glyphicon-bitcoin"></i> <code>glyphicon-bitcoin</code></li><li><i class="glyphicon glyphicon-blackboard"></i> <code>glyphicon-blackboard</code></li><li><i class="glyphicon glyphicon-bold"></i> <code>glyphicon-bold</code></li><li><i class="glyphicon glyphicon-book"></i> <code>glyphicon-book</code></li><li><i class="glyphicon glyphicon-bookmark"></i> <code>glyphicon-bookmark</code></li><li><i class="glyphicon glyphicon-briefcase"></i> <code>glyphicon-briefcase</code></li><li><i class="glyphicon glyphicon-bullhorn"></i> <code>glyphicon-bullhorn</code></li><li><i class="glyphicon glyphicon-calendar"></i> <code>glyphicon-calendar</code></li><li><i class="glyphicon glyphicon-camera"></i> <code>glyphicon-camera</code></li><li><i class="glyphicon glyphicon-cd"></i> <code>glyphicon-cd</code></li><li><i class="glyphicon glyphicon-certificate"></i> <code>glyphicon-certificate</code></li><li><i class="glyphicon glyphicon-check"></i> <code>glyphicon-check</code></li><li><i class="glyphicon glyphicon-chevron-down"></i> <code>glyphicon-chevron-down</code></li><li><i class="glyphicon glyphicon-chevron-left"></i> <code>glyphicon-chevron-left</code></li><li><i class="glyphicon glyphicon-chevron-right"></i> <code>glyphicon-chevron-right</code></li><li><i class="glyphicon glyphicon-chevron-up"></i> <code>glyphicon-chevron-up</code></li><li><i class="glyphicon glyphicon-circle-arrow-down"></i> <code>glyphicon-circle-arrow-down</code></li><li><i class="glyphicon glyphicon-circle-arrow-left"></i> <code>glyphicon-circle-arrow-left</code></li><li><i class="glyphicon glyphicon-circle-arrow-right"></i> <code>glyphicon-circle-arrow-right</code></li><li><i class="glyphicon glyphicon-circle-arrow-up"></i> <code>glyphicon-circle-arrow-up</code></li><li><i class="glyphicon glyphicon-cloud"></i> <code>glyphicon-cloud</code></li><li><i class="glyphicon glyphicon-cloud-download"></i> <code>glyphicon-cloud-download</code></li><li><i class="glyphicon glyphicon-cloud-upload"></i> <code>glyphicon-cloud-upload</code></li><li><i class="glyphicon glyphicon-cog"></i> <code>glyphicon-cog</code></li><li><i class="glyphicon glyphicon-collapse-down"></i> <code>glyphicon-collapse-down</code></li><li><i class="glyphicon glyphicon-collapse-up"></i> <code>glyphicon-collapse-up</code></li><li><i class="glyphicon glyphicon-comment"></i> <code>glyphicon-comment</code></li><li><i class="glyphicon glyphicon-compressed"></i> <code>glyphicon-compressed</code></li><li><i class="glyphicon glyphicon-console"></i> <code>glyphicon-console</code></li><li><i class="glyphicon glyphicon-copy"></i> <code>glyphicon-copy</code></li><li><i class="glyphicon glyphicon-copyright-mark"></i> <code>glyphicon-copyright-mark</code></li><li><i class="glyphicon glyphicon-credit-card"></i> <code>glyphicon-credit-card</code></li><li><i class="glyphicon glyphicon-cutlery"></i> <code>glyphicon-cutlery</code></li><li><i class="glyphicon glyphicon-dashboard"></i> <code>glyphicon-dashboard</code></li><li><i class="glyphicon glyphicon-download"></i> <code>glyphicon-download</code></li><li><i class="glyphicon glyphicon-download-alt"></i> <code>glyphicon-download-alt</code></li><li><i class="glyphicon glyphicon-duplicate"></i> <code>glyphicon-duplicate</code></li><li><i class="glyphicon glyphicon-earphone"></i> <code>glyphicon-earphone</code></li><li><i class="glyphicon glyphicon-edit"></i> <code>glyphicon-edit</code></li><li><i class="glyphicon glyphicon-education"></i> <code>glyphicon-education</code></li><li><i class="glyphicon glyphicon-eject"></i> <code>glyphicon-eject</code></li><li><i class="glyphicon glyphicon-envelope"></i> <code>glyphicon-envelope</code></li><li><i class="glyphicon glyphicon-equalizer"></i> <code>glyphicon-equalizer</code></li><li><i class="glyphicon glyphicon-erase"></i> <code>glyphicon-erase</code></li><li><i class="glyphicon glyphicon-eur"></i> <code>glyphicon-eur</code></li><li><i class="glyphicon glyphicon-euro"></i> <code>glyphicon-euro</code></li><li><i class="glyphicon glyphicon-exclamation-sign"></i> <code>glyphicon-exclamation-sign</code></li><li><i class="glyphicon glyphicon-expand"></i> <code>glyphicon-expand</code></li><li><i class="glyphicon glyphicon-export"></i> <code>glyphicon-export</code></li><li><i class="glyphicon glyphicon-eye-close"></i> <code>glyphicon-eye-close</code></li><li><i class="glyphicon glyphicon-eye-open"></i> <code>glyphicon-eye-open</code></li><li><i class="glyphicon glyphicon-facetime-video"></i> <code>glyphicon-facetime-video</code></li><li><i class="glyphicon glyphicon-fast-backward"></i> <code>glyphicon-fast-backward</code></li><li><i class="glyphicon glyphicon-fast-forward"></i> <code>glyphicon-fast-forward</code></li><li><i class="glyphicon glyphicon-file"></i> <code>glyphicon-file</code></li><li><i class="glyphicon glyphicon-film"></i> <code>glyphicon-film</code></li><li><i class="glyphicon glyphicon-filter"></i> <code>glyphicon-filter</code></li><li><i class="glyphicon glyphicon-fire"></i> <code>glyphicon-fire</code></li><li><i class="glyphicon glyphicon-flag"></i> <code>glyphicon-flag</code></li><li><i class="glyphicon glyphicon-flash"></i> <code>glyphicon-flash</code></li><li><i class="glyphicon glyphicon-floppy-disk"></i> <code>glyphicon-floppy-disk</code></li><li><i class="glyphicon glyphicon-floppy-open"></i> <code>glyphicon-floppy-open</code></li><li><i class="glyphicon glyphicon-floppy-remove"></i> <code>glyphicon-floppy-remove</code></li><li><i class="glyphicon glyphicon-floppy-save"></i> <code>glyphicon-floppy-save</code></li><li><i class="glyphicon glyphicon-floppy-saved"></i> <code>glyphicon-floppy-saved</code></li><li><i class="glyphicon glyphicon-folder-close"></i> <code>glyphicon-folder-close</code></li><li><i class="glyphicon glyphicon-folder-open"></i> <code>glyphicon-folder-open</code></li><li><i class="glyphicon glyphicon-font"></i> <code>glyphicon-font</code></li><li><i class="glyphicon glyphicon-forward"></i> <code>glyphicon-forward</code></li><li><i class="glyphicon glyphicon-fullscreen"></i> <code>glyphicon-fullscreen</code></li><li><i class="glyphicon glyphicon-gbp"></i> <code>glyphicon-gbp</code></li><li><i class="glyphicon glyphicon-gift"></i> <code>glyphicon-gift</code></li><li><i class="glyphicon glyphicon-glass"></i> <code>glyphicon-glass</code></li><li><i class="glyphicon glyphicon-globe"></i> <code>glyphicon-globe</code></li><li><i class="glyphicon glyphicon-grain"></i> <code>glyphicon-grain</code></li><li><i class="glyphicon glyphicon-hand-down"></i> <code>glyphicon-hand-down</code></li><li><i class="glyphicon glyphicon-hand-left"></i> <code>glyphicon-hand-left</code></li><li><i class="glyphicon glyphicon-hand-right"></i> <code>glyphicon-hand-right</code></li><li><i class="glyphicon glyphicon-hand-up"></i> <code>glyphicon-hand-up</code></li><li><i class="glyphicon glyphicon-hd-video"></i> <code>glyphicon-hd-video</code></li><li><i class="glyphicon glyphicon-hdd"></i> <code>glyphicon-hdd</code></li><li><i class="glyphicon glyphicon-header"></i> <code>glyphicon-header</code></li><li><i class="glyphicon glyphicon-headphones"></i> <code>glyphicon-headphones</code></li><li><i class="glyphicon glyphicon-heart"></i> <code>glyphicon-heart</code></li><li><i class="glyphicon glyphicon-heart-empty"></i> <code>glyphicon-heart-empty</code></li><li><i class="glyphicon glyphicon-home"></i> <code>glyphicon-home</code></li><li><i class="glyphicon glyphicon-hourglass"></i> <code>glyphicon-hourglass</code></li><li><i class="glyphicon glyphicon-ice-lolly"></i> <code>glyphicon-ice-lolly</code></li><li><i class="glyphicon glyphicon-ice-lolly-tasted"></i> <code>glyphicon-ice-lolly-tasted</code></li><li><i class="glyphicon glyphicon-import"></i> <code>glyphicon-import</code></li><li><i class="glyphicon glyphicon-inbox"></i> <code>glyphicon-inbox</code></li><li><i class="glyphicon glyphicon-indent-left"></i> <code>glyphicon-indent-left</code></li><li><i class="glyphicon glyphicon-indent-right"></i> <code>glyphicon-indent-right</code></li><li><i class="glyphicon glyphicon-info-sign"></i> <code>glyphicon-info-sign</code></li><li><i class="glyphicon glyphicon-italic"></i> <code>glyphicon-italic</code></li><li><i class="glyphicon glyphicon-king"></i> <code>glyphicon-king</code></li><li><i class="glyphicon glyphicon-knight"></i> <code>glyphicon-knight</code></li><li><i class="glyphicon glyphicon-lamp"></i> <code>glyphicon-lamp</code></li><li><i class="glyphicon glyphicon-leaf"></i> <code>glyphicon-leaf</code></li><li><i class="glyphicon glyphicon-level-up"></i> <code>glyphicon-level-up</code></li><li><i class="glyphicon glyphicon-link"></i> <code>glyphicon-link</code></li><li><i class="glyphicon glyphicon-list"></i> <code>glyphicon-list</code></li><li><i class="glyphicon glyphicon-list-alt"></i> <code>glyphicon-list-alt</code></li><li><i class="glyphicon glyphicon-lock"></i> <code>glyphicon-lock</code></li><li><i class="glyphicon glyphicon-log-in"></i> <code>glyphicon-log-in</code></li><li><i class="glyphicon glyphicon-log-out"></i> <code>glyphicon-log-out</code></li><li><i class="glyphicon glyphicon-magnet"></i> <code>glyphicon-magnet</code></li><li><i class="glyphicon glyphicon-map-marker"></i> <code>glyphicon-map-marker</code></li><li><i class="glyphicon glyphicon-menu-down"></i> <code>glyphicon-menu-down</code></li><li><i class="glyphicon glyphicon-menu-hamburger"></i> <code>glyphicon-menu-hamburger</code></li><li><i class="glyphicon glyphicon-menu-left"></i> <code>glyphicon-menu-left</code></li><li><i class="glyphicon glyphicon-menu-right"></i> <code>glyphicon-menu-right</code></li><li><i class="glyphicon glyphicon-menu-up"></i> <code>glyphicon-menu-up</code></li><li><i class="glyphicon glyphicon-minus"></i> <code>glyphicon-minus</code></li><li><i class="glyphicon glyphicon-minus-sign"></i> <code>glyphicon-minus-sign</code></li><li><i class="glyphicon glyphicon-modal-window"></i> <code>glyphicon-modal-window</code></li><li><i class="glyphicon glyphicon-move"></i> <code>glyphicon-move</code></li><li><i class="glyphicon glyphicon-music"></i> <code>glyphicon-music</code></li><li><i class="glyphicon glyphicon-new-window"></i> <code>glyphicon-new-window</code></li><li><i class="glyphicon glyphicon-object-align-bottom"></i> <code>glyphicon-object-align-bottom</code></li><li><i class="glyphicon glyphicon-object-align-horizontal"></i> <code>glyphicon-object-align-horizontal</code></li><li><i class="glyphicon glyphicon-object-align-left"></i> <code>glyphicon-object-align-left</code></li><li><i class="glyphicon glyphicon-object-align-right"></i> <code>glyphicon-object-align-right</code></li><li><i class="glyphicon glyphicon-object-align-top"></i> <code>glyphicon-object-align-top</code></li><li><i class="glyphicon glyphicon-object-align-vertical"></i> <code>glyphicon-object-align-vertical</code></li><li><i class="glyphicon glyphicon-off"></i> <code>glyphicon-off</code></li><li><i class="glyphicon glyphicon-oil"></i> <code>glyphicon-oil</code></li><li><i class="glyphicon glyphicon-ok"></i> <code>glyphicon-ok</code></li><li><i class="glyphicon glyphicon-ok-circle"></i> <code>glyphicon-ok-circle</code></li><li><i class="glyphicon glyphicon-ok-sign"></i> <code>glyphicon-ok-sign</code></li><li><i class="glyphicon glyphicon-open"></i> <code>glyphicon-open</code></li><li><i class="glyphicon glyphicon-open-file"></i> <code>glyphicon-open-file</code></li><li><i class="glyphicon glyphicon-option-horizontal"></i> <code>glyphicon-option-horizontal</code></li><li><i class="glyphicon glyphicon-option-vertical"></i> <code>glyphicon-option-vertical</code></li><li><i class="glyphicon glyphicon-paperclip"></i> <code>glyphicon-paperclip</code></li><li><i class="glyphicon glyphicon-paste"></i> <code>glyphicon-paste</code></li><li><i class="glyphicon glyphicon-pause"></i> <code>glyphicon-pause</code></li><li><i class="glyphicon glyphicon-pawn"></i> <code>glyphicon-pawn</code></li><li><i class="glyphicon glyphicon-pencil"></i> <code>glyphicon-pencil</code></li><li><i class="glyphicon glyphicon-phone"></i> <code>glyphicon-phone</code></li><li><i class="glyphicon glyphicon-phone-alt"></i> <code>glyphicon-phone-alt</code></li><li><i class="glyphicon glyphicon-picture"></i> <code>glyphicon-picture</code></li><li><i class="glyphicon glyphicon-piggy-bank"></i> <code>glyphicon-piggy-bank</code></li><li><i class="glyphicon glyphicon-plane"></i> <code>glyphicon-plane</code></li><li><i class="glyphicon glyphicon-play"></i> <code>glyphicon-play</code></li><li><i class="glyphicon glyphicon-play-circle"></i> <code>glyphicon-play-circle</code></li><li><i class="glyphicon glyphicon-plus"></i> <code>glyphicon-plus</code></li><li><i class="glyphicon glyphicon-plus-sign"></i> <code>glyphicon-plus-sign</code></li><li><i class="glyphicon glyphicon-print"></i> <code>glyphicon-print</code></li><li><i class="glyphicon glyphicon-pushpin"></i> <code>glyphicon-pushpin</code></li><li><i class="glyphicon glyphicon-qrcode"></i> <code>glyphicon-qrcode</code></li><li><i class="glyphicon glyphicon-queen"></i> <code>glyphicon-queen</code></li><li><i class="glyphicon glyphicon-question-sign"></i> <code>glyphicon-question-sign</code></li><li><i class="glyphicon glyphicon-random"></i> <code>glyphicon-random</code></li><li><i class="glyphicon glyphicon-record"></i> <code>glyphicon-record</code></li><li><i class="glyphicon glyphicon-refresh"></i> <code>glyphicon-refresh</code></li><li><i class="glyphicon glyphicon-registration-mark"></i> <code>glyphicon-registration-mark</code></li><li><i class="glyphicon glyphicon-remove"></i> <code>glyphicon-remove</code></li><li><i class="glyphicon glyphicon-remove-circle"></i> <code>glyphicon-remove-circle</code></li><li><i class="glyphicon glyphicon-remove-sign"></i> <code>glyphicon-remove-sign</code></li><li><i class="glyphicon glyphicon-repeat"></i> <code>glyphicon-repeat</code></li><li><i class="glyphicon glyphicon-resize-full"></i> <code>glyphicon-resize-full</code></li><li><i class="glyphicon glyphicon-resize-horizontal"></i> <code>glyphicon-resize-horizontal</code></li><li><i class="glyphicon glyphicon-resize-small"></i> <code>glyphicon-resize-small</code></li><li><i class="glyphicon glyphicon-resize-vertical"></i> <code>glyphicon-resize-vertical</code></li><li><i class="glyphicon glyphicon-retweet"></i> <code>glyphicon-retweet</code></li><li><i class="glyphicon glyphicon-road"></i> <code>glyphicon-road</code></li><li><i class="glyphicon glyphicon-ruble"></i> <code>glyphicon-ruble</code></li><li><i class="glyphicon glyphicon-save"></i> <code>glyphicon-save</code></li><li><i class="glyphicon glyphicon-save-file"></i> <code>glyphicon-save-file</code></li><li><i class="glyphicon glyphicon-saved"></i> <code>glyphicon-saved</code></li><li><i class="glyphicon glyphicon-scale"></i> <code>glyphicon-scale</code></li><li><i class="glyphicon glyphicon-scissors"></i> <code>glyphicon-scissors</code></li><li><i class="glyphicon glyphicon-screenshot"></i> <code>glyphicon-screenshot</code></li><li><i class="glyphicon glyphicon-sd-video"></i> <code>glyphicon-sd-video</code></li><li><i class="glyphicon glyphicon-search"></i> <code>glyphicon-search</code></li><li><i class="glyphicon glyphicon-send"></i> <code>glyphicon-send</code></li><li><i class="glyphicon glyphicon-share"></i> <code>glyphicon-share</code></li><li><i class="glyphicon glyphicon-share-alt"></i> <code>glyphicon-share-alt</code></li><li><i class="glyphicon glyphicon-shopping-cart"></i> <code>glyphicon-shopping-cart</code></li><li><i class="glyphicon glyphicon-signal"></i> <code>glyphicon-signal</code></li><li><i class="glyphicon glyphicon-sort"></i> <code>glyphicon-sort</code></li><li><i class="glyphicon glyphicon-sort-by-alphabet"></i> <code>glyphicon-sort-by-alphabet</code></li><li><i class="glyphicon glyphicon-sort-by-alphabet-alt"></i> <code>glyphicon-sort-by-alphabet-alt</code></li><li><i class="glyphicon glyphicon-sort-by-attributes"></i> <code>glyphicon-sort-by-attributes</code></li><li><i class="glyphicon glyphicon-sort-by-attributes-alt"></i> <code>glyphicon-sort-by-attributes-alt</code></li><li><i class="glyphicon glyphicon-sort-by-order"></i> <code>glyphicon-sort-by-order</code></li><li><i class="glyphicon glyphicon-sort-by-order-alt"></i> <code>glyphicon-sort-by-order-alt</code></li><li><i class="glyphicon glyphicon-sound-5-1"></i> <code>glyphicon-sound-5-1</code></li><li><i class="glyphicon glyphicon-sound-6-1"></i> <code>glyphicon-sound-6-1</code></li><li><i class="glyphicon glyphicon-sound-7-1"></i> <code>glyphicon-sound-7-1</code></li><li><i class="glyphicon glyphicon-sound-dolby"></i> <code>glyphicon-sound-dolby</code></li><li><i class="glyphicon glyphicon-sound-stereo"></i> <code>glyphicon-sound-stereo</code></li><li><i class="glyphicon glyphicon-star"></i> <code>glyphicon-star</code></li><li><i class="glyphicon glyphicon-star-empty"></i> <code>glyphicon-star-empty</code></li><li><i class="glyphicon glyphicon-stats"></i> <code>glyphicon-stats</code></li><li><i class="glyphicon glyphicon-step-backward"></i> <code>glyphicon-step-backward</code></li><li><i class="glyphicon glyphicon-step-forward"></i> <code>glyphicon-step-forward</code></li><li><i class="glyphicon glyphicon-stop"></i> <code>glyphicon-stop</code></li><li><i class="glyphicon glyphicon-subscript"></i> <code>glyphicon-subscript</code></li><li><i class="glyphicon glyphicon-subtitles"></i> <code>glyphicon-subtitles</code></li><li><i class="glyphicon glyphicon-sunglasses"></i> <code>glyphicon-sunglasses</code></li><li><i class="glyphicon glyphicon-superscript"></i> <code>glyphicon-superscript</code></li><li><i class="glyphicon glyphicon-tag"></i> <code>glyphicon-tag</code></li><li><i class="glyphicon glyphicon-tags"></i> <code>glyphicon-tags</code></li><li><i class="glyphicon glyphicon-tasks"></i> <code>glyphicon-tasks</code></li><li><i class="glyphicon glyphicon-tent"></i> <code>glyphicon-tent</code></li><li><i class="glyphicon glyphicon-text-background"></i> <code>glyphicon-text-background</code></li><li><i class="glyphicon glyphicon-text-color"></i> <code>glyphicon-text-color</code></li><li><i class="glyphicon glyphicon-text-height"></i> <code>glyphicon-text-height</code></li><li><i class="glyphicon glyphicon-text-size"></i> <code>glyphicon-text-size</code></li><li><i class="glyphicon glyphicon-text-width"></i> <code>glyphicon-text-width</code></li><li><i class="glyphicon glyphicon-th"></i> <code>glyphicon-th</code></li><li><i class="glyphicon glyphicon-th-large"></i> <code>glyphicon-th-large</code></li><li><i class="glyphicon glyphicon-th-list"></i> <code>glyphicon-th-list</code></li><li><i class="glyphicon glyphicon-thumbs-down"></i> <code>glyphicon-thumbs-down</code></li><li><i class="glyphicon glyphicon-thumbs-up"></i> <code>glyphicon-thumbs-up</code></li><li><i class="glyphicon glyphicon-time"></i> <code>glyphicon-time</code></li><li><i class="glyphicon glyphicon-tint"></i> <code>glyphicon-tint</code></li><li><i class="glyphicon glyphicon-tower"></i> <code>glyphicon-tower</code></li><li><i class="glyphicon glyphicon-transfer"></i> <code>glyphicon-transfer</code></li><li><i class="glyphicon glyphicon-trash"></i> <code>glyphicon-trash</code></li><li><i class="glyphicon glyphicon-tree-conifer"></i> <code>glyphicon-tree-conifer</code></li><li><i class="glyphicon glyphicon-tree-deciduous"></i> <code>glyphicon-tree-deciduous</code></li><li><i class="glyphicon glyphicon-triangle-bottom"></i> <code>glyphicon-triangle-bottom</code></li><li><i class="glyphicon glyphicon-triangle-left"></i> <code>glyphicon-triangle-left</code></li><li><i class="glyphicon glyphicon-triangle-right"></i> <code>glyphicon-triangle-right</code></li><li><i class="glyphicon glyphicon-triangle-top"></i> <code>glyphicon-triangle-top</code></li><li><i class="glyphicon glyphicon-volume-down"></i> <code>glyphicon-volume-down</code></li><li><i class="glyphicon glyphicon-volume-off"></i> <code>glyphicon-volume-off</code></li><li><i class="glyphicon glyphicon-volume-up"></i> <code>glyphicon-volume-up</code></li><li><i class="glyphicon glyphicon-unchecked"></i> <code>glyphicon-unchecked</code></li><li><i class="glyphicon glyphicon-upload"></i> <code>glyphicon-upload</code></li><li><i class="glyphicon glyphicon-usd"></i> <code>glyphicon-usd</code></li><li><i class="glyphicon glyphicon-user"></i> <code>glyphicon-user</code></li><li><i class="glyphicon glyphicon-warning-sign"></i> <code>glyphicon-warning-sign</code></li><li><i class="glyphicon glyphicon-wrench"></i> <code>glyphicon-wrench</code></li><li><i class="glyphicon glyphicon-yen"></i> <code>glyphicon-yen</code></li><li><i class="glyphicon glyphicon-zoom-in"></i> <code>glyphicon-zoom-in</code></li><li><i class="glyphicon glyphicon-zoom-out"></i> <code>glyphicon-zoom-out</code></li></ul>
            </div>
            <div class="tab-pane fade" id="sl">
                <ul class="js-icon-list items-push-2x text-center"><li><i class="si si-action-redo"></i> <code>si-action-redo</code></li><li><i class="si si-action-undo"></i> <code>si-action-undo</code></li><li><i class="si si-anchor"></i> <code>si-anchor</code></li><li><i class="si si-arrow-down"></i> <code>si-arrow-down</code></li><li><i class="si si-arrow-left"></i> <code>si-arrow-left</code></li><li><i class="si si-arrow-right"></i> <code>si-arrow-right</code></li><li><i class="si si-arrow-up"></i> <code>si-arrow-up</code></li><li><i class="si si-badge"></i> <code>si-badge</code></li><li><i class="si si-bag"></i> <code>si-bag</code></li><li><i class="si si-ban"></i> <code>si-ban</code></li><li><i class="si si-bar-chart"></i> <code>si-bar-chart</code></li><li><i class="si si-basket"></i> <code>si-basket</code></li><li><i class="si si-basket-loaded"></i> <code>si-basket-loaded</code></li><li><i class="si si-bell"></i> <code>si-bell</code></li><li><i class="si si-book-open"></i> <code>si-book-open</code></li><li><i class="si si-briefcase"></i> <code>si-briefcase</code></li><li><i class="si si-bubble"></i> <code>si-bubble</code></li><li><i class="si si-bubbles"></i> <code>si-bubbles</code></li><li><i class="si si-bulb"></i> <code>si-bulb</code></li><li><i class="si si-calculator"></i> <code>si-calculator</code></li><li><i class="si si-calendar"></i> <code>si-calendar</code></li><li><i class="si si-call-end"></i> <code>si-call-end</code></li><li><i class="si si-call-in"></i> <code>si-call-in</code></li><li><i class="si si-call-out"></i> <code>si-call-out</code></li><li><i class="si si-camcorder"></i> <code>si-camcorder</code></li><li><i class="si si-camera"></i> <code>si-camera</code></li><li><i class="si si-check"></i> <code>si-check</code></li><li><i class="si si-chemistry"></i> <code>si-chemistry</code></li><li><i class="si si-clock"></i> <code>si-clock</code></li><li><i class="si si-close"></i> <code>si-close</code></li><li><i class="si si-cloud-download"></i> <code>si-cloud-download</code></li><li><i class="si si-cloud-upload"></i> <code>si-cloud-upload</code></li><li><i class="si si-compass"></i> <code>si-compass</code></li><li><i class="si si-control-end"></i> <code>si-control-end</code></li><li><i class="si si-control-forward"></i> <code>si-control-forward</code></li><li><i class="si si-control-pause"></i> <code>si-control-pause</code></li><li><i class="si si-control-play"></i> <code>si-control-play</code></li><li><i class="si si-control-rewind"></i> <code>si-control-rewind</code></li><li><i class="si si-control-start"></i> <code>si-control-start</code></li><li><i class="si si-credit-card"></i> <code>si-credit-card</code></li><li><i class="si si-crop"></i> <code>si-crop</code></li><li><i class="si si-cup"></i> <code>si-cup</code></li><li><i class="si si-cursor"></i> <code>si-cursor</code></li><li><i class="si si-cursor-move"></i> <code>si-cursor-move</code></li><li><i class="si si-diamond"></i> <code>si-diamond</code></li><li><i class="si si-direction"></i> <code>si-direction</code></li><li><i class="si si-directions"></i> <code>si-directions</code></li><li><i class="si si-disc"></i> <code>si-disc</code></li><li><i class="si si-dislike"></i> <code>si-dislike</code></li><li><i class="si si-doc"></i> <code>si-doc</code></li><li><i class="si si-docs"></i> <code>si-docs</code></li><li><i class="si si-drawer"></i> <code>si-drawer</code></li><li><i class="si si-drop"></i> <code>si-drop</code></li><li><i class="si si-earphones"></i> <code>si-earphones</code></li><li><i class="si si-earphones-alt"></i> <code>si-earphones-alt</code></li><li><i class="si si-emoticon-smile"></i> <code>si-emoticon-smile</code></li><li><i class="si si-energy"></i> <code>si-energy</code></li><li><i class="si si-envelope"></i> <code>si-envelope</code></li><li><i class="si si-envelope-letter"></i> <code>si-envelope-letter</code></li><li><i class="si si-envelope-open"></i> <code>si-envelope-open</code></li><li><i class="si si-equalizer"></i> <code>si-equalizer</code></li><li><i class="si si-eye"></i> <code>si-eye</code></li><li><i class="si si-eyeglasses"></i> <code>si-eyeglasses</code></li><li><i class="si si-feed"></i> <code>si-feed</code></li><li><i class="si si-film"></i> <code>si-film</code></li><li><i class="si si-fire"></i> <code>si-fire</code></li><li><i class="si si-flag"></i> <code>si-flag</code></li><li><i class="si si-folder"></i> <code>si-folder</code></li><li><i class="si si-folder-alt"></i> <code>si-folder-alt</code></li><li><i class="si si-frame"></i> <code>si-frame</code></li><li><i class="si si-game-controller"></i> <code>si-game-controller</code></li><li><i class="si si-ghost"></i> <code>si-ghost</code></li><li><i class="si si-globe"></i> <code>si-globe</code></li><li><i class="si si-globe-alt"></i> <code>si-globe-alt</code></li><li><i class="si si-graduation"></i> <code>si-graduation</code></li><li><i class="si si-graph"></i> <code>si-graph</code></li><li><i class="si si-grid"></i> <code>si-grid</code></li><li><i class="si si-handbag"></i> <code>si-handbag</code></li><li><i class="si si-heart"></i> <code>si-heart</code></li><li><i class="si si-home"></i> <code>si-home</code></li><li><i class="si si-hourglass"></i> <code>si-hourglass</code></li><li><i class="si si-info"></i> <code>si-info</code></li><li><i class="si si-key"></i> <code>si-key</code></li><li><i class="si si-layers"></i> <code>si-layers</code></li><li><i class="si si-like"></i> <code>si-like</code></li><li><i class="si si-link"></i> <code>si-link</code></li><li><i class="si si-list"></i> <code>si-list</code></li><li><i class="si si-lock"></i> <code>si-lock</code></li><li><i class="si si-lock-open"></i> <code>si-lock-open</code></li><li><i class="si si-login"></i> <code>si-login</code></li><li><i class="si si-logout"></i> <code>si-logout</code></li><li><i class="si si-loop"></i> <code>si-loop</code></li><li><i class="si si-magic-wand"></i> <code>si-magic-wand</code></li><li><i class="si si-magnet"></i> <code>si-magnet</code></li><li><i class="si si-magnifier"></i> <code>si-magnifier</code></li><li><i class="si si-magnifier-add"></i> <code>si-magnifier-add</code></li><li><i class="si si-magnifier-remove"></i> <code>si-magnifier-remove</code></li><li><i class="si si-map"></i> <code>si-map</code></li><li><i class="si si-microphone"></i> <code>si-microphone</code></li><li><i class="si si-mouse"></i> <code>si-mouse</code></li><li><i class="si si-moustache"></i> <code>si-moustache</code></li><li><i class="si si-music-tone"></i> <code>si-music-tone</code></li><li><i class="si si-music-tone-alt"></i> <code>si-music-tone-alt</code></li><li><i class="si si-note"></i> <code>si-note</code></li><li><i class="si si-notebook"></i> <code>si-notebook</code></li><li><i class="si si-paper-clip"></i> <code>si-paper-clip</code></li><li><i class="si si-paper-plane"></i> <code>si-paper-plane</code></li><li><i class="si si-pencil"></i> <code>si-pencil</code></li><li><i class="si si-picture"></i> <code>si-picture</code></li><li><i class="si si-pie-chart"></i> <code>si-pie-chart</code></li><li><i class="si si-pin"></i> <code>si-pin</code></li><li><i class="si si-plane"></i> <code>si-plane</code></li><li><i class="si si-playlist"></i> <code>si-playlist</code></li><li><i class="si si-plus"></i> <code>si-plus</code></li><li><i class="si si-pointer"></i> <code>si-pointer</code></li><li><i class="si si-power"></i> <code>si-power</code></li><li><i class="si si-present"></i> <code>si-present</code></li><li><i class="si si-printer"></i> <code>si-printer</code></li><li><i class="si si-puzzle"></i> <code>si-puzzle</code></li><li><i class="si si-question"></i> <code>si-question</code></li><li><i class="si si-refresh"></i> <code>si-refresh</code></li><li><i class="si si-reload"></i> <code>si-reload</code></li><li><i class="si si-rocket"></i> <code>si-rocket</code></li><li><i class="si si-screen-desktop"></i> <code>si-screen-desktop</code></li><li><i class="si si-screen-smartphone"></i> <code>si-screen-smartphone</code></li><li><i class="si si-screen-tablet"></i> <code>si-screen-tablet</code></li><li><i class="si si-settings"></i> <code>si-settings</code></li><li><i class="si si-share"></i> <code>si-share</code></li><li><i class="si si-share-alt"></i> <code>si-share-alt</code></li><li><i class="si si-shield"></i> <code>si-shield</code></li><li><i class="si si-shuffle"></i> <code>si-shuffle</code></li><li><i class="si si-size-actual"></i> <code>si-size-actual</code></li><li><i class="si si-size-fullscreen"></i> <code>si-size-fullscreen</code></li><li><i class="si si-social-dribbble"></i> <code>si-social-dribbble</code></li><li><i class="si si-social-dropbox"></i> <code>si-social-dropbox</code></li><li><i class="si si-social-facebook"></i> <code>si-social-facebook</code></li><li><i class="si si-social-tumblr"></i> <code>si-social-tumblr</code></li><li><i class="si si-social-twitter"></i> <code>si-social-twitter</code></li><li><i class="si si-social-youtube"></i> <code>si-social-youtube</code></li><li><i class="si si-speech"></i> <code>si-speech</code></li><li><i class="si si-speedometer"></i> <code>si-speedometer</code></li><li><i class="si si-star"></i> <code>si-star</code></li><li><i class="si si-support"></i> <code>si-support</code></li><li><i class="si si-symbol-female"></i> <code>si-symbol-female</code></li><li><i class="si si-symbol-male"></i> <code>si-symbol-male</code></li><li><i class="si si-tag"></i> <code>si-tag</code></li><li><i class="si si-target"></i> <code>si-target</code></li><li><i class="si si-trash"></i> <code>si-trash</code></li><li><i class="si si-trophy"></i> <code>si-trophy</code></li><li><i class="si si-umbrella"></i> <code>si-umbrella</code></li><li><i class="si si-user"></i> <code>si-user</code></li><li><i class="si si-user-female"></i> <code>si-user-female</code></li><li><i class="si si-user-follow"></i> <code>si-user-follow</code></li><li><i class="si si-user-following"></i> <code>si-user-following</code></li><li><i class="si si-user-unfollow"></i> <code>si-user-unfollow</code></li><li><i class="si si-users"></i> <code>si-users</code></li><li><i class="si si-vector"></i> <code>si-vector</code></li><li><i class="si si-volume-1"></i> <code>si-volume-1</code></li><li><i class="si si-volume-2"></i> <code>si-volume-2</code></li><li><i class="si si-volume-off"></i> <code>si-volume-off</code></li><li><i class="si si-wallet"></i> <code>si-wallet</code></li><li><i class="si si-wrench"></i> <code>si-wrench</code></li></ul>
            </div>
        </div>
    </div>
    <?php endif; ?>

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

    <?php if(!(empty($_ueditor) || (($_ueditor instanceof \think\Collection || $_ueditor instanceof \think\Paginator ) && $_ueditor->isEmpty()))): ?>
    <script src="__LIBS__/ueditor/ueditor.config.js"></script>
    <script src="__LIBS__/ueditor/ueditor.all.min.js"></script>
    <?php endif; if(!(empty($_ckeditor) || (($_ckeditor instanceof \think\Collection || $_ckeditor instanceof \think\Paginator ) && $_ckeditor->isEmpty()))): ?>
    <script src="__LIBS__/ckeditor/ckeditor.js"></script>
    <?php endif; if(is_array($js_list) || $js_list instanceof \think\Collection || $js_list instanceof \think\Paginator): $i = 0; $__LIST__ = $js_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <script src="__MODULE_JS__/<?php echo $vo; ?>.js"></script>
    <?php endforeach; endif; else: echo "" ;endif; ?>

    
    <?php echo (isset($extra_js) && ($extra_js !== '')?$extra_js:''); ?>



<?php echo (isset($extra_html) && ($extra_html !== '')?$extra_html:''); ?>
</body>
</html>