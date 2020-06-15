<?php
// 推广链接设置
include '../includes/common.php';
$title = '推广链接设置';
include './head.php';
if ($islogin != 1) exit('<script>window.location.href="./login.php";</script>');
?>
<div class="col-md-12 center-block" style="float: none;">
    <div class="block">
        <div class="block-title clearfix">
            <form onsubmit="return false" class="form-inline" id="formSearch">
                <div class="form-group">
                    <label class="control-label" style="margin: 10px 15px 9px;" for="kw">搜索商品</label>
                    <input type="text" id="kw" class="form-control" name="kw" placeholder="商品名称">
                </div>
                <button type="submit" class="btn btn-primary">搜索</button>
            </form>
        </div>
        <div id="listTable">
            <div class="alert alert-info" style="font-size: 10px;">请先设置再开启，否则将按照默认获利条件推广，如果没有设置【默认推广】的商品，默认为添加到推广的第一个商品。<a href="shoplist.php">点击添加商品</a></div>
            <form name="form1" id="form1">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-vcenter">
                        <thead>
                        <tr>
                            <th>序号</th>
                            <th>商品名称</th>
                            <th>分享类型</th>
                            <th>获利条件</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody id="pluginsTable"></tbody>
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
        loadList();
    });

    // 加载列表数据
    function loadList(p = 1) {
        layer.load(2);
        const kw = $('#kw').val();
        $.ajax({
            url: 'ajax.php?act=invite_page_query'
            ,method: 'GET'
            ,data: {
                'key_words': kw,
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
                                <td>${list[i]['name']}</td>
                                <td>${list[i]['type'] === '0' ? '下单金额' : '累计访问'}</td>
                                <td>${list[i]['type'] === '0' ? '下单金额满' : '累计访问人数达到'}【<span style="color: red;">${list[i]['type'] === '0' ? list[i]['rule_value'] : parseInt(list[i]['rule_value'])}</span>】</td>
                                <td>${list[i]['create_time']}</td>
                                <td><a class="btn btn-info btn-xs invite-edit" data-tid="${list[i]['tid']}" href="javascript:"><i class="fa fa-gear"></i> 编辑</a>
                                <a title="${list[i]['is_default'] === '0' ? '点击设置默认推广' : '点击取消默认推广'}" class="btn ${list[i]['is_default'] === '0' ? 'btn-default' : 'btn-success'} btn-xs invite-def" data-tid="${list[i]['tid']}" data-def="${list[i]['is_default']}" href="javascript:">${list[i]['is_default'] === '1' ? '默认推广' : '设置默认'}</a>
                                <a title="点击切换状态" class="btn ${list[i]['status'] === '0' ? 'btn-warning' : 'btn-success'} btn-xs invite-status" data-tid="${list[i]['tid']}" data-status="${list[i]['status']}" href="javascript:"><i class="fa ${list[i]['status'] === '0' ? 'fa-ban' : 'fa-check'}"></i> ${list[i]['status'] === '0' ? '当前关闭' : '当前开启'}</a>
                                <a title="删除该分享商品" class="btn btn-danger btn-xs invite-del" data-tid="${list[i]['tid']}" href="javascript:"><i class="fa fa-trash-o"></i> 删除</a>
                                </td>`;
                        html += `</tr>`;
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
                $('.invite-edit').click(function () {
                    editInvite($(this).data('tid'));
                });
                $('.invite-status').click(function () {
                    updateInviteStatus($(this).data('tid'), $(this).data('status'));
                });
                $('.invite-del').click(function () {
                    delInvite($(this).data('tid'));
                });
                $('.invite-def').click(function () {
                    setInviteDefault($(this).data('tid'), $(this).data('def'));
                });
            }
            ,error: function () {
                layer.closeAll('loading');
                layer.msg('加载数据异常', {icon: 7});
            }
        });
    }

    function updateInviteStatus(tid, status) {
        layer.load(2);
        if (!tid) return false;
        $.post('ajax.php?act=invite_edit_status', {tid: tid, status: status === 1 ? 0 : 1}, function (res) {
            layer.closeAll('loading');
            if (0 !== res['code']) {
                return layer.msg(res['msg'], {icon: 2});
            }
            layer.msg(res['msg'], {icon: 1});
            loadList();
        }, 'json').error(function () {
            layer.msg('操作异常', {icon: 8});
        });
    }
    
    function delInvite(tid) {
        if (!tid) return layer.msg('操作异常', {icon: 8});
        layer.confirm('确定删除么？', {icon: 3, title: '温馨提示'}, function (index) {
            layer.close(index);
            layer.load(2);
            $.post('ajax.php?act=invite_del', {tid: tid}, function (res) {
                layer.closeAll('loading');
                if (0 !== res['code']) {
                    return layer.msg(res['msg'], {icon: 2});
                }
                layer.msg(res['msg'], {icon: 1});
                loadList();
            }, 'json').error(function () {
                layer.msg('操作异常', {icon: 8});
            });
        });
    }

    function setInviteDefault(tid, def) {
        if (!tid) return layer.msg('操作异常', {icon: 8});
        if (def === 1) return false;
        layer.load(2);
        $.post('ajax.php?act=invite_def', {tid: tid, def: 0}, function (res) {
            layer.closeAll('loading');
            if (-3 === res['code']) {
                return layer.alert(res['msg'] + '，且只能设置一个商品；若需要设置该商品为默认，请先取消之前默认商品的默认状态');
            }
            if (0 !== res['code']) {
                return layer.msg(res['msg'], {icon: 2});
            }
            layer.msg(res['msg'], {icon: 1});
            loadList();
        }, 'json').error(function () {
            layer.msg('操作异常', {icon: 8});
        });
    }

    // 编辑分享
    function editInvite(tid) {
        layer.load(2);
        $.get('ajax.php?act=invite_get_query', {tid: tid}, function (res) {
            layer.closeAll('loading');
            if (res['code'] !== 0) {
                return layer.msg(res['msg'], {icon: 2});
            }
            const html =   `<div style="margin: 10px;">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">商品名称</div>
                                        <input type="text" class="form-control" value="${res['data']['name']}" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">分享类型</div>
                                        <select class="form-control" name="type">
                                            <option value="0" ${res['data']['type'] === '0' ? 'selected' : ''}>下单金额</option>
                                            <option value="1" ${res['data']['type'] === '1' ? 'selected' : ''}>累计访问</option>
                                        <select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">获利条件</div>
                                        <input type="number" class="form-control"
                                                name="value"
                                                placeholder="例：金额填 88.88，数量填 8"
                                                value="${res['data']['type'] === '0' ? res['data']['rule_value'] : parseInt(res['data']['rule_value'])}">
                                    </div><br>
                                    <pre>提示：当分享类型是：<br>【下单金额】：让用户打开链接下单达到该金额值，精确到两位小数，生成链接用户奖励该商品<br>【累计访问】：打开链接该链接的QQ用户达到该数值，生成链接用户奖励该商品</pre>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-block invite-save" value="保存">
                                </div>
                            </div>`;
            const open = layer.open({
                type: 1,
                title: '编辑商品[' + res['data']['name'] + ']',
                skin: 'layui-layer-rim',
                content: html
            });
            $('.invite-save').click(function () {
                layer.load(2);
                $.post('ajax.php?act=invite_save', {
                    tid: tid,
                    type: $('select[name="type"]').val(),
                    value: $('input[name="value"]').val(),
                }).done(function (res) {
                    layer.closeAll('loading');
                    if (0 !== res['code']) {
                        return layer.msg(res['msg'], {icon: 2});
                    }
                    layer.close(open);
                    layer.msg(res['msg'], {icon: 1});
                    loadList();
                });
            });
        }, 'json').error(function () {
            layer.closeAll('loading');
            layer.msg('数据加载异常', {icon: 8});
        });
    }

    $(document).ready(function () {
        loadList();
    });
</script>
