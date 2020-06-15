<?php
/**
 * 订单管理
 **/
include '../includes/common.php';
$title = '订单管理';
include './head.php';
if ($islogin != 1) {
    exit('<script>window.location.href=\'./login.php\';</script>');
}
?>
<style>.layui-layer-content{padding: 10px;}.wbreak{text-overflow: ellipsis;white-space: nowrap;overflow: hidden;}</style>
<style>
    .orderList{
        table-layout:initial!important;
    }
    .orderList thead>tr>th{text-align: center;}
    .orderList tbody tr>td:nth-child(1){
        min-width: 100px;
        text-align: center;
    }
    .orderList tbody tr>td:nth-child(2),.orderList tbody tr>td:nth-child(3){
        max-width: 300px;
        min-width: 160px;
    }
    .orderList tbody tr>td:nth-child(4){
        max-width: 160px;
        min-width: 75px;
        text-align: center;
    }
    .orderList tbody tr>td:nth-child(6){
        min-width: 150px;
        text-align: center;
    }
    .orderList tbody tr>td:nth-child(7),.orderList tbody tr>td:nth-child(8),.orderList tbody tr>td:nth-child(5){
        min-width: 90px;
        text-align: center;
    }
    .orderList tbody tr>td:nth-child(9){
        min-width: 130px;
        text-align: center;
    }
</style>
<div class="col-md-12 center-block" style="float: none;">
    <div class="block">
        <div class="block-title clearfix" style="padding: 5px;">
            <form onsubmit="return searchOrder()" method="GET" class="form-inline">
                <div class="form-group">
                    <label>&nbsp;搜索订单&nbsp;</label>
                    <input type="text" class="form-control" name="kw" placeholder="请输入下单账号或订单号">
                    <select name="type" class="form-control">
                        <option value="0">待处理</option>
                        <option value="2">正在处理</option>
                        <option value="1">已完成</option>
                        <option value="3">异常</option>
                        <option value="4">删除订单</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">搜索</button>&nbsp;
                    <a href="./export.php" class="btn btn-success">导出订单</a>
                    <a href="./log.php" class="btn btn-warning" target="_blank">对接日志</a>
                    <a href="javascript:listTable('start')" class="btn btn-default" title="刷新订单列表">
                        <i class="fa fa-refresh"></i>
                    </a>
                </div>
            </form>
        </div>

        <div id="listTable"></div>
    </div>
</div>
</div>
<script>
    // 表格全选/取消全选
    function selectAll(checkbox) {
        $('input[type=checkbox]').prop('checked', $(checkbox).prop('checked'));
    }

    function listTable(query) {
        var url = window.document.location.href.toString();
        var queryString = url.split("?")[1];
        query = query || queryString;
        if (query == 'start' || query == undefined) {
            query = '';
            history.replaceState({}, null, './orderList.php');
        } else if (query != undefined) {
            history.replaceState({}, null, './orderList.php?' + query);
        }
        layer.closeAll();
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            type: 'GET',
            url: 'list-table.php?' + query,
            dataType: 'html',
            cache: false,
            success: function (data) {
                layer.close(ii);
                $("#listTable").html(data)
            },
            error: function (data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    function searchOrder() {
        var kw = $("input[name='kw']").val();
        var type = $("select[name='type']").val();
        if (kw == '') {
            listTable('type=' + type);
        } else {
            listTable('kw=' + kw);
        }
        return false;
    }

    function operation() {
        if ($('#form1').serializeArray().length <= 1) {
            return layer.msg('请选择需要操作的订单ID');
        }
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            type: 'POST',
            url: 'ajax.php?act=operation',
            data: $('#form1').serialize(),
            dataType: 'json',
            success: function (data) {
                layer.close(ii);
                if (data.code == 0) {
                    listTable();
                    layer.alert(data.msg);
                } else {
                    layer.alert(data.msg);
                }
            },
            error: function (data) {
                layer.msg('请求超时');
                listTable();
            }
        });
        return false;
    }

    function showStatus(id) {
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            type: 'GET',
            url: 'ajax.php?act=showStatus&id=' + id,
            dataType: 'json',
            success: function (data) {
                layer.close(ii);
                if (data.code == 0) {
                    var item = data.data;
                    layer.open({
                        type: 1,
                        title: '订单进度查询',
                        skin: 'layui-layer-rim',
                        content: '<div style="padding: 5px;text-align: center;">以下数据来自 ' + data.domain + ' </div><table class="table" style="margin: 0;"><tr><td class="warning">订单ID</td><td>' + item.orderid + '</td><td class="warning">订单状态</td><td><font color=blue>' + item.order_state + '</font></td></tr><tr><td class="warning">下单数量</td><td>' + item.num + '</td><td class="warning">下单时间</td><td>' + item.add_time + '</td></tr><tr><td class="warning">初始数量</td><td>' + item.start_num + '</td><td class="warning">当前数量</td><td>' + item.now_num + '</td></tr></table>'
                    });
                } else {
                    layer.alert(data.msg);
                }
            },
            error: function (data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    function djOrder(id) {
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            type: 'GET',
            url: 'ajax.php?act=djOrder&id=' + id,
            dataType: 'json',
            success: function (data) {
                layer.close(ii);
                if (data.code == 0) {
                    layer.msg(data.msg);
                    listTable();
                } else {
                    layer.alert(data.msg);
                }
            },
            error: function (data) {
                layer.close(ii);
                layer.msg('服务器繁忙，请稍后再试');
            }
        });
    }

    function showOrder(id) {
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            type: 'GET',
            url: 'ajax.php?act=order&id=' + id,
            dataType: 'json',
            success: function (data) {
                layer.close(ii);
                if (data.code == 0) {
                    layer.open({
                        type: 1,
                        title: '订单详情',
                        skin: 'layui-layer-rim',
                        content: data.data
                    });
                } else {
                    layer.alert(data.msg);
                }
            },
            error: function (data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    function inputOrder(id) {
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            type: 'GET',
            url: 'ajax.php?act=order2&id=' + id,
            dataType: 'json',
            success: function (data) {
                layer.close(ii);
                if (data.code == 0) {
                    layer.open({
                        type: 1,
                        title: '修改数据',
                        skin: 'layui-layer-rim',
                        content:data.data
                    });
                } else {
                    layer.alert(data.msg);
                }
            },
            error: function (data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    function inputNum(id) {
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            type: 'GET',
            url: 'ajax.php?act=order3&id=' + id,
            dataType: 'json',
            success: function (data) {
                layer.close(ii);
                if (data.code == 0) {
                    layer.open({
                        type: 1,
                        title: '修改份数',
                        skin: 'layui-layer-rim',
                        content: data.data
                    });
                } else {
                    layer.alert(data.msg);
                }
            },
            error: function (data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    function refund(id) {
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            type: 'POST',
            url: 'ajax.php?act=getmoney',
            data: {id: id},
            dataType: 'json',
            success: function (data) {
                layer.close(ii);
                if (data.code == 0) {
                    layer.prompt({title: '填写退款金额', value: data.money, formType: 0}, function (text, index) {
                        var ii = layer.load(2, {shade: [0.1, '#fff']});
                        $.ajax({
                            type: 'POST',
                            url: 'ajax.php?act=refund',
                            data: {id: id, money: text},
                            dataType: 'json',
                            success: function (data) {
                                layer.close(ii);
                                if (data.code === 0) {
                                    layer.alert(data.msg, {closeBtn: 0}, function () {
                                        listTable();
                                    });
                                } else {
                                    layer.alert(data.msg);
                                }
                            },
                            error: function (data) {
                                layer.msg('服务器错误');
                                return false;
                            }
                        });
                    });
                } else {
                    layer.alert(data.msg);
                }
            },
            error: function (data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    function setStatus(name, status) {
        if (status == 6) {
            refund(name);
            return false;
        }
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            type: 'get',
            url: 'ajax.php',
            data: 'act=setStatus&name=' + name + '&status=' + status,
            dataType: 'json',
            success: function (ret) {
                layer.close(ii);
                if (ret['code'] != 200) {
                    alert(ret['msg'] ? ret['msg'] : '操作失败');
                }
                listTable();
            },
            error: function (data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    function setResult(id, title) {
        var title = title || '异常原因';
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            type: 'POST',
            url: 'ajax.php?act=result',
            data: {id: id},
            dataType: 'json',
            success: function (data) {
                layer.close(ii);
                if (data.code == 0) {
                    layer.prompt({title: '填写' + title, value: data.result, formType: 2}, function (text, index) {
                        var ii = layer.load(2, {shade: [0.1, '#fff']});
                        $.ajax({
                            type: 'POST',
                            url: 'ajax.php?act=setresult',
                            data: {id: id, result: text},
                            dataType: 'json',
                            success: function (data) {
                                layer.close(ii);
                                if (data.code == 0) {
                                    layer.msg('填写' + title + '成功');
                                } else {
                                    layer.alert(data.msg);
                                }
                            },
                            error: function (data) {
                                layer.msg('服务器错误');
                                return false;
                            }
                        });
                    });
                } else {
                    layer.alert(data.msg);
                }
            },
            error: function (data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    function saveOrder(id) {
        var inputvalue = $("#inputvalue").val();
        if (inputvalue == '' || $("#inputvalue2").val() == '' || $("#inputvalue3").val() == '' || $("#inputvalue4").val() == '' || $("#inputvalue5").val() == '') {
            layer.alert('请确保每项不能为空！');
            return false;
        }
        if ($('#inputname').html() == '下单ＱＱ' && (inputvalue.length < 5 || inputvalue.length > 11)) {
            layer.alert('请输入正确的QQ号！');
            return false;
        }
        $('#save').val('Loading');
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            type: "POST",
            url: "ajax.php?act=editOrder",
            data: {
                id: id,
                inputvalue: inputvalue,
                inputvalue2: $("#inputvalue2").val(),
                inputvalue3: $("#inputvalue3").val(),
                inputvalue4: $("#inputvalue4").val(),
                inputvalue5: $("#inputvalue5").val()
            },
            dataType: 'json',
            success: function (data) {
                layer.close(ii);
                if (data.code == 0) {
                    layer.msg('保存成功！');
                    listTable();
                } else {
                    layer.alert(data.msg);
                }
                $('#save').val('保存');
            }
        });
    }

    function saveOrderNum(id) {
        var num = $("#num").val();
        if (num == '') {
            layer.alert('请确保每项不能为空！');
            return false;
        }
        $('#save').val('Loading');
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            type: "POST",
            url: "ajax.php?act=editOrderNum",
            data: {id: id, num: num},
            dataType: 'json',
            success: function (data) {
                layer.close(ii);
                if (data.code == 0) {
                    layer.msg('保存成功！');
                    listTable();
                } else {
                    layer.alert(data.msg);
                }
                $('#save').val('保存');
            }
        });
    }

    $(document).ready(function () {
        listTable();
    })
</script>