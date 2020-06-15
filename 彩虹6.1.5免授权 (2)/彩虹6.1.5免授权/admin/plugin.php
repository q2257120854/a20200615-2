<?php
include '../includes/common.php';
$title = '插件管理';
include './head.php';
if (1 != $islogin) {
    exit("<script>window.location.href='./login.php';</script>");
}
// 检查是否初始化插件功能
if (empty($conf['is_init_plugin'])) {
    $is_init = !checkPluginInit();
} else {
    $is_init = false;
}
// 未初始化，加载初始化视图
if ($is_init) { ?>
<div class="col-md-12 center-block" style="float: none;">
    <div class="block">
        <div class="alert alert-warning">监测到您的插件未初始化，点击下方按钮即可启动插件功能</div>
        <div style="text-align: center;">
            <button class="btn btn-primary" id="initPlugin">初始化插件功能</button>
        </div>
    </div>
</div>
<script>
    $('#initPlugin').click(function () {
        const that = $(this);
        that.attr('disabled', true).text('正在初始化...');
        layer.load(2);
        $.post('ajax.php?act=init_plugin', {'k': 'AFme9qhWkaGz0mF3qPoO4jQO5ukYXybN'}).done(function (res) {
            layer.closeAll('loading');
            that.removeAttr('disabled').text('初始化插件功能');
            if (res['code'] === 0) {
                return layer.msg(res['msg'], {icon: 1}, function () {
                    location.reload();
                });
            }
            layer.msg(res['msg'], {icon: 2});
        }).error(function () {
            layer.closeAll('loading');
            that.removeAttr('disabled').text('初始化插件功能');
            layer.msg('系统异常', {icon: 5});
        });
    });
</script>
<?php
    exit;
}

$mode = isset($_GET['mode']) ? filterParam($_GET['mode']) : false;
if (empty($mode)) {
    $p_id = isset($_POST['id']) ? filterParam($_POST['id'], 0) : 0;
    $p_config = isset($_POST['config']) ? $_POST['config'] : false;
    if (!empty($p_id) && !empty($p_config)) { // 保存配置操作
        foreach ($p_config as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if (is_array($v2)) continue; // 暂时不支持3级
                    $p_config[$k][$k2] = filterParam($v2);
                }
            } else {
                $p_config[$k] = filterParam($v);
            }
        }
        $p = new \plugin\model\PluginModel();
        $plugin = $p->getById($p_id);
        $class = $plugin['name'] . 'Plugin';
        if (!class_exists($class)) {
            showmsgAuto('插件不存在', 4);
        }
        $res = $p->savePlugins($p_config); // 数据操作
        if (0 == $res['status']) {
            showmsgAuto($res['msg'], 4);
        }
        $plugins = new $class;
        $result = $plugins->saveConfig($p_config); // 插件函数操作
        if ($result === true) {
            showmsgAuto('更新插件配置成功！<br><a href="plugin.php">&gt;&gt;返回插件列表</a>', 1);
        }
    }
?>
<style>
    .statu-wait{color: #BEC3C7;}
    .statu-yes{color: #1BBC9D;}
    .statu-no{color: #c9302c;}
    .tb-desc{width: 300px;overflow: hidden;white-space: nowrap;text-overflow:ellipsis;}
</style>
<div class="col-md-12 center-block" style="float: none;">
    <div class="block">
        <div class="block-title clearfix">
            <form onsubmit="return false" class="form-inline" id="formSearch">
                <div class="form-group">
                    <label class="control-label" style="margin: 10px 15px 9px;" for="kw">搜索插件</label>
                    <input type="text" id="kw" class="form-control" name="kw" placeholder="插件名称、标识">
                </div>
                <button type="submit" class="btn btn-primary">搜索</button>
            </form>
        </div>
        <div id="listTable">
            <form name="form1" id="form1">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-vcenter">
                        <thead>
                            <tr>
                                <th>序号</th>
                                <th>名称</th>
                                <th>标识</th>
                                <th>描述</th>
                                <th>状态</th>
                                <th>作者</th>
                                <th>版本</th>
                                <th style="text-align: center;">操作</th>
                            </tr>
                        </thead>
                        <tbody id="pluginsTable">

                        </tbody>
                    </table>
                </div>
            </form>
            <div id="tablePage"></div>
        </div>
    </div>
</div>
<script>
    // 监听表单提交
    $('#formSearch').submit(function () {
        const kw = $('#kw').val();
        loadList(kw);
    });

    //安装
    function install(id){
        const loading = layer.msg('正在安装，请稍后...', {icon: 16, time: 120 * 1000});
        $.post('ajax.php?act=plugin_install',{id:id},function(data){
            layer.close(loading);
            if(data.status===1){
                layer.msg("安装成功,请刷页面",{icon:1});
                loadList();
            }else{
                layer.msg(data.msg,{icon:2});
            }
        }, 'json');
    }

    //卸载
    function uninstall(id){
        const box = layer.confirm("您确定要卸载吗?", function(){
            const loading = layer.msg('正在卸载，请稍后...', {icon: 16, time: 120 * 1000});
            $.post('ajax.php?act=plugin_uninstall',{id:id},function(data){
                layer.close(loading);
                if(data.status===1){
                    layer.msg("卸载成功,请刷页面",{icon:1});
                    layer.close(box);
                    loadList();
                }else{
                    layer.msg(data.msg,{icon:2});
                }
            }, 'json');
        });
    }

    //禁用
    function enable(id){
        const loading = layer.msg('正在启用，请稍后...', {icon: 16, time: 120 * 1000});
        $.post('ajax.php?act=plugin_enable',{id:id},function(data){
            layer.close(loading);
            if(data.status===1){
                layer.msg("启用成功",{icon:1});
                layer.close(loading);
                loadList();
            }else{
                layer.msg(data.msg,{icon:2});
            }
        }, 'json');
    }

    //启用
    function disable(id){
        const loading = layer.msg('正在禁用，请稍后...', {icon: 16, time: 120 * 1000});
        $.post('ajax.php?act=plugin_disable',{id:id},function(data){
            layer.close(loading);
            if(data.status===1){
                layer.msg("禁用成功",{icon:1});
                layer.close(loading);
                loadList();
            }else{
                layer.msg(data.msg,{icon:2});
            }
        }, 'json');
    }

    // 加载列表数据
    function loadList(kw = '', p = 1) {
        layer.load(2);
        $.ajax({
            url: 'ajax.php?act=plugin_page_query'
            ,method: 'GET'
            ,data: {
                'keyWords': kw,
                'page': p,
                'limit': 20
            }
            , dataType: 'json'
            ,success: function (res) {
                if (res['status'] === 0) {
                    let html = '';
                    const list = res['items'];
                    for (let i in list) {
                        if (!list.hasOwnProperty(i)) {
                            continue;
                        }
                        html += `<tr>
                                <td>${parseInt(i) + 1}</td>
                                <td>${list[i]['title']}</td>
                                <td>${list[i]['name']}</td>
                                <td style="width: 300px;cursor: pointer;" title="点击查看更多"><div class="tb-desc" data-desc="${list[i]['description']}">${list[i]['description']}</div></td>
                                <td>`;
                        if (list[i]['status'] === '1') {
                            html += `<span class=""><span class="statu-yes">
                                    <i class="fa fa-check-circle"></i> ${list[i]['statusName']}</span>
                                </span>`;
                        } else if (list[i]['status'] === '2') {
                            html += `<span class=""><span class="statu-no">
                                    <i class="fa fa-ban"></i> ${list[i]['statusName']}</span>
                                </span>`;
                        } else if (list[i]['status'] === '0') {
                            html += `<span class=""><span class="statu-wait">
                                    <i class="fa fa-ban"></i> ${list[i]['statusName']}</span>
                                </span>`;
                        }
                        html +=    `</td>
                                <td>${list[i]['author']}</td>
                                <td>${list[i]['version']}</td>
                                <td style="text-align: center;">`;
                        if (list[i]['hasConf'] === 1 && parseInt(list[i]['status']) > 0) {
                            html +=`<a href="plugin.php?mode=set&id=${list[i]['addon_id']}" class="btn btn-default btn-sm"><i class="fa fa-gear"></i>设置</a>&nbsp;`;
                        }
                        if (list[i]['status'] !== '0') {
                            html +=    `<a href="javascript:uninstall(${list[i]['addon_id']})" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i>卸载</a>&nbsp;`;
                        }
                        if (list[i]['status'] === '2') {
                            html +=`<a href="javascript:enable(${list[i]['addon_id']})" class="btn btn-default btn-sm"><i class="fa fa-check"></i>启用</a>`;
                        } else if (list[i]['status'] === '1') {
                            html +=`<a href="javascript:disable(${list[i]['addon_id']})" class="btn btn-default btn-sm"><i class="fa fa-ban"></i>禁用</a>`;
                        } else if (list[i]['status'] === '0') {
                            html +=`<a class="btn btn-default btn-sm" href="javascript:install(${list[i]['addon_id']})"><i class="fa fa-gear"></i>安装</a>`;
                        }
                        html += `</td>
                            </tr>`;
                    }
                    if (list.length === 0) {
                        $('#pluginsTable').html(`<tr><td colspan="8" style="text-align: center;"><span style="color: #c9302c;">${res['msg'] ? res['msg'] : '即将上线...'}</span></td></tr>`);
                    } else {
                        $('#pluginsTable').html(html);
                    }
                    $('#tablePage').html(res['page']);
                    $('.table-page').click(function () {
                        let page = $(this).data('page');
                        let kw = $('#kw').val();
                        loadList(kw, page);
                    });
                } else {
                    layer.msg(res['msg'] ? res['msg'] : '加载数据异常', {icon: 2});
                }
                layer.closeAll('loading');
                $('.tb-desc').click(function () {
                    const desc = $(this).data('desc');
                    layer.open({title: '描述', content: desc});
                });
            }
            ,error: function () {
                layer.closeAll('loading');
                layer.msg('加载数据异常', {icon: 7});
            }
        });
    }

    $(document).ready(function () {
        setTimeout(function () {
            loadList();
        }, 100);
    });
</script>
<?php
} else {
    $p = new plugin\model\PluginModel();
    $plugin = $p->getById();
    if (!$plugin) {
        showmsgAuto('插件未安装', 4);
    }
    $plugin_class = $plugin['name'] . 'Plugin';
    if (!class_exists($plugin_class)) {
        log_result('插件管理', '', '插件[ ' . $plugin['name'] . ' ]无法实例化', 0);
    }
    $data = new $plugin_class;
    $plugin['plugin_path'] = $data->plugin_path;
    $db_config = $plugin['config'];
    if (!is_file($data->config_file)) {
        showmsgAuto('该插件没有设置控件', 4);
    }
    $plugin['config'] = include $data->config_file;

    if ($db_config) {
        $db_config = json_decode($db_config, true);
        foreach ($plugin['config'] as $key => $value) {
            if($value['type'] != 'group'){
                $plugin['config'][$key]['value'] = isset($db_config[$key])?$db_config[$key]:"";
            }else{
                foreach ($value['options'] as $gourp => $options) {
                    foreach ($options['options'] as $gkey => $value) {
                        $plugin['config'][$key]['options'][$gourp]['options'][$gkey]['value'] = $db_config[$gkey];
                    }
                }
            }
        }
    }
    $plugin_id = isset($_GET['id']) ? (int)filterParam($_GET['id'], 0) : 0;
?>
<link href="assets/css/common.css" rel="stylesheet" type="text/css" />
<div class="col-md-12 center-block" style="float: none;">
    <div class="block">
        <div>
            <form action="plugin.php" method="post" style="line-height: 30px;margin:10px;" autocomplete="off">
                <div class="main-title cf">
                    <div class="addoncfg-title">插件配置 [ <?php echo $plugin['title']; ?> ]</div>
                </div>
                <?php if(is_array($plugin['config'])): if( count($plugin['config'])==0 ) : echo "" ;else: foreach($plugin['config'] as $o_key=>$form): ?>
                    <div class="form-item cf">
                        <?php if(isset($form['title'])): ?>
                            <label class="item-label">
                                <span style="font-weight: bold;"><?php echo (isset($form['title']) && ($form['title'] !== '')?$form['title']:''); ?></span>

                            </label>
                        <?php endif; switch($form['type']): case "tips": ?>
                            <div>
                                <?php echo $form['value']; ?>
                            </div>
                            <?php break; case "text": ?>
                            <div>
                                <input type="text" name="config[<?php echo $o_key; ?>]" class="text input-large" value="<?php echo $form['value']; ?>"  style="width:400px;"><?php if(isset($form['tips'])){ ?><span><?php echo $form['tips']; ?></span><?php } ?>
                            </div>
                            <?php break; case "password": ?>
                            <div>
                                <input type="password" name="config[<?php echo $o_key; ?>]" class="text input-large" value="<?php echo $form['value']; ?>">
                            </div>
                            <?php break; case "hidden": ?>
                            <input type="hidden" name="config[<?php echo $o_key; ?>]" value="<?php echo $form['value']; ?>">
                            <?php break; case "radio": ?>
                            <div class="layui-form">
                                <?php if(is_array($form['options'])): if( count($form['options'])==0 ) : echo "" ;else: foreach($form['options'] as $opt_k=>$opt): ?>
                                    <label class="radio">
                                        <input type="radio" name="config[<?php echo $o_key; ?>]" value="<?php echo $opt_k; ?>" <?php if($form['value'] == $opt_k): ?> checked<?php endif; ?> title="<?php echo $opt; ?>">
                                    </label>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                            <?php break; case "checkbox": ?>
                            <div>
                                <?php if(is_array($form['options'])): if( count($form['options'])==0 ) : echo "" ;else: foreach($form['options'] as $opt_k=>$opt): ?>
                                    <label class="checkbox">
                                        <?php
                                        is_null($form["value"]) && $form["value"] = array();
                                        ?>
                                        <input type="checkbox" name="config[<?php echo $o_key; ?>][]" value="<?php echo $opt_k; ?>" <?php if(in_array(($opt_k), is_array($form['value'])?$form['value']:explode(',',$form['value']))): ?>checked<?php endif; ?>><?php echo $opt; ?>
                                    </label>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                            <?php break; case "select": ?>
                            <div>
                                <select name="config[<?php echo $o_key; ?>]">
                                    <?php if(is_array($form['options'])): if( count($form['options'])==0 ) : echo "" ;else: foreach($form['options'] as $opt_k=>$opt): ?>
                                        <option value="<?php echo $opt_k; ?>" <?php if($form['value'] == $opt_k): ?> selected<?php endif; ?>><?php echo $opt; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                            <?php break; case "textarea": ?>
                            <div>
                                <label class="textarea input-large">
                                    <textarea name="config[<?php echo $o_key; ?>]" style="width:500px;height:200px;"><?php echo $form['value']; ?></textarea>
                                </label>
                            </div>
                            <?php break; case "group": ?>
                            <ul class="tab-nav nav">
                                <?php if(is_array($form['options'])): $i = 0; $__LIST__ = $form['options'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?>
                                    <li data-tab="tab<?php echo $i; ?>" <?php if($i == '1'): ?>class="current" <?php endif; ?> ><a href="javascript:void(0);"><?php echo $li['title']; ?></a></li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                <div style="clear: both;"></div>
                            </ul>
                            <div class="tab-content">
                                <?php if(is_array($form['options'])): $i = 0; $__LIST__ = $form['options'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i;?>
                                    <div id="tab<?php echo $i; ?>" class="tab-pane <?php if($i == '1'): ?>in<?php endif; ?> tab<?php echo $i; ?>">
                                        <?php if(is_array($tab['options'])): if( count($tab['options'])==0 ) : echo "" ;else: foreach($tab['options'] as $o_tab_key=>$tab_form): ?>
                                            <label class="item-label">
                                                <span style="font-weight: bold;"><?php echo (isset($tab_form['title']) && ($tab_form['title'] !== '')?$tab_form['title']:''); ?></span>
                                                <?php if(isset($tab_form['tip'])): ?>
                                                    <span class="check-tips"><?php echo $tab_form['tip']; ?></span>
                                                <?php endif; ?>
                                            </label>
                                            <div>
                                                <?php switch($tab_form['type']): case "tips": ?>
                                                    <div>
                                                        <?php echo $form['value']; ?>
                                                    </div>
                                                    <?php break; case "text": ?>
                                                    <input type="text" name="config[<?php echo $o_tab_key; ?>]" class="text input-large" value="<?php echo $tab_form['value']; ?>" style="width:400px;">
                                                    <?php break; case "password": ?>
                                                    <input type="password" name="config[<?php echo $o_tab_key; ?>]" class="text input-large" value="<?php echo $tab_form['value']; ?>">
                                                    <?php break; case "hidden": ?>
                                                    <input type="hidden" name="config[<?php echo $o_tab_key; ?>]" value="<?php echo $tab_form['value']; ?>">
                                                    <?php break; case "radio": if(is_array($tab_form['options'])): if( count($tab_form['options'])==0 ) : echo "" ;else: foreach($tab_form['options'] as $opt_k=>$opt): ?>
                                                    <label class="layui-form radio">
                                                        <input type="radio" name="config[<?php echo $o_tab_key; ?>]" value="<?php echo $opt_k; ?>" <?php if($tab_form['value'] == $opt_k): ?> checked<?php endif; ?> title="<?php echo $opt; ?>">
                                                    </label>
                                                <?php endforeach; endif; else: echo "" ;endif; break; case "checkbox": if(is_array($tab_form['options'])): if( count($tab_form['options'])==0 ) : echo "" ;else: foreach($tab_form['options'] as $opt_k=>$opt): ?>
                                                    <label class="checkbox">
                                                        <?php
                                                        is_null($tab_form["value"]) && $tab_form["value"] = array();
                                                        ?>
                                                        <input type="checkbox" name="config[<?php echo $o_tab_key; ?>][]" value="<?php echo $opt_k; ?>" <?php if(in_array(($opt_k), is_array($tab_form['value'])?$tab_form['value']:explode(',',$tab_form['value']))): ?> checked<?php endif; ?>><?php echo $opt; ?>
                                                    </label>
                                                <?php endforeach; endif; else: echo "" ;endif; break; case "select": ?>
                                                    <select name="config[<?php echo $o_tab_key; ?>]">
                                                        <?php if(is_array($tab_form['options'])): if( count($tab_form['options'])==0 ) : echo "" ;else: foreach($tab_form['options'] as $opt_k=>$opt): ?>
                                                            <option value="<?php echo $opt_k; ?>" <?php if($tab_form['value'] == $opt_k): ?> selected<?php endif; ?>><?php echo $opt; ?></option>
                                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>
                                                    <?php break; case "textarea": ?>
                                                    <label>
                                                        <textarea name="config[<?php echo $o_tab_key; ?>]"><?php echo $tab_form['value']; ?></textarea>
                                                    </label>
                                                    <?php break; ?>

                                                <?php endswitch; ?>
                                            </div>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </div>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                            <?php break; ?>
                        <?php endswitch; ?>
                    </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="form-item cf wst-bottombar" style='padding-left:130px;padding-top:10px'>
                    <input type="hidden" name="id" value="<?php echo $plugin_id; ?>" readonly/>
                    <button type="submit" class="btn submit-btn ajax-post btn-primary btn-mright" ><i class="fa fa-check"></i> 确定</button>&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button"  class='btn btn-default' onclick="location.href='plugin.php';"><i class="fa fa-angle-double-left"></i> 返回</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(function(){
    $(".tab-nav li").click(function(){
        var self = $(this), target = self.data("tab");
        self.addClass("current").siblings(".current").removeClass("current");
        //window.location.hash = "#" + target.substr(3);
        $(".tab-pane.in").removeClass("in");
        $("." + target).addClass("in");
    }).filter("[data-tab=tab" + window.location.hash.substr(1) + "]").click();
});
</script>
<?php } ?>
