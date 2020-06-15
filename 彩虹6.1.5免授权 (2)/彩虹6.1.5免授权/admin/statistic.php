<?php
require '../includes/common.php';
$title = '数据统计';
require 'head.php';
if ($islogin != 1) exit('<script>window.location.href="./login.php";</script>');
?>
<style>
    td {
        text-align: center;
    }
</style>
<div class="col-xs-12 col-md-10 center-block" style="float: none;">
    <div class="block">
        <div class="block-title"><h2>商品销售排行</h2></div>
        <ul class="nav nav-tabs">
            <li class="active" style="width:50%">
                <a class="tab-switch" data-type="0" href="javascript:" style="text-align: center;cursor: pointer;background-color: #7c62ad;">今日销售排行</a>
            </li>
            <li class="active" style="width:50%">
                <a class="tab-switch" data-type="1" href="javascript:" style="text-align: center;cursor: pointer">昨日销售排行</a>
            </li>
        </ul>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="text-center">排名</th>
                    <th class="text-center">商品名称</th>
                    <th class="text-center">订单数</th>
                </tr>
                </thead>
                <tbody id="data_list">
                    <tr><td colspan="3" style="text-align: center;"><span style="color: #c9302c;">努力加载中...</span></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    // 页面加载后
    $(document).ready(function () {
        setTimeout(function () {
            loadList(0);
        }, 100);
    });

    let tab_switch_selected = 0;

    $('.tab-switch').click(function () {
        const type = parseInt($(this).data('type'));
        if (type !== 0 && type !== 1) return false;
        if (type === tab_switch_selected) return false;
        tab_switch_selected = type;
        if (type === 1) {
            $('.tab-switch[data-type="0"]').css({'background-color': '', 'color': '#353a4d'});
            $('.tab-switch[data-type="1"]').css({'background-color': '#7c62ad', 'color': '#fff'});
        } else {
            $('.tab-switch[data-type="1"]').css({'background-color': '', 'color': '#353a4d'});
            $('.tab-switch[data-type="0"]').css({'background-color': '#7c62ad', 'color': '#fff'});
        }
        loadList(type);
    });

    // 加载表格
    function loadList(type, page = 1, loadType = 0, num = 1) {
        layer.load();
        $.ajax({
            url: 'ajax.php'
            , data: {act: 'statistic', type: type, page: page}
            , dataType: 'json'
            , success: function (res) {
                layer.closeAll('loading');
                if (!res['code'] && !res['data']) {
                    return layer.msg('返回数据格式有误', {icon: 2});
                }
                if (res['code'] !== 0) {
                    return layer.msg(res['msg'], {icon: 5});
                }
                if (res['data'].length === 0) {
                    $('#data_list').html(`<tr><td colspan="3"><span style="color: #c9302c;">暂无数据</span></td></tr>`);
                    return false;
                }
                let html = '';
                for (let v of res['data']) {
                    html += `<tr>
                                <td><span>${num++}</span></td>
                                <td class="text-center">${v['goods_name'].length > 20 ? v['goods_name'].substr(0, 20)+'...' : v['goods_name']}</td>
                                <td><span>${v['count']}</span></td>
                            </tr>`;
                }
                if (res['total'] > 10 * parseInt(page) && page < 8) {
                    html += `<tr><td colspan="3"><button class="btn btn-sm btn-info" id="next_load">点击加载</button></td></tr>`;
                }
                if (loadType === 0) {
                    $('#data_list').html(html);
                } else {
                    $('#data_list').append(html);
                }
                $('#next_load').click(function () {
                    $(this).parent().parent().remove();
                    loadList(type, parseInt(page) + 1, loadType = 1, num);
                });
            }
            , error: function () {
                layer.closeAll('loading');
                layer.msg('数据加载异常，请稍后再试', {icon: 7});
            }
        });
    }
</script>
