<?php

include('../includes/common.php');
$title = '自定义分站商品密价';
include './head.php';
if ($islogin != 1)
    exit("<script>window.location.href='./login.php';</script>");

?>
<div class="col-md-12 center-block" style="float: none;">
    <div class="block">
        <div class="block-title clearfix">
            <h2 id="blocktitle">系统共有 <b>849</b> 个商品</h2>
            <span class="pull-right"><select id="pagesize" class="form-control"><option value="30">30</option><option
                            value="50">50</option><option value="60">60</option><option value="80">80</option><option
                            value="100">100</option></select><span>
</span></span>
        </div>
        <form onsubmit="return searchItem()" method="GET" class="form-inline">
            <div class="form-group">
                <input type="text" class="form-control" name="kw" placeholder="请输入商品名称">
            </div>
            <button type="submit" class="btn btn-info">搜索</button>&nbsp;
            <a href="javascript:clearPrice()" class="btn btn-warning">恢复价格</a>&nbsp;
            <a href="javascript:listTable('start')" class="btn btn-default" title="刷新商品列表"><i class="fa fa-refresh"></i></a>
        </form>

        <div id="listTable"></div>
    </div>
</div>
<script>
    var $_GET = (function () {
        var url = window.document.location.href.toString();
        var u = url.split("?");
        if (typeof (u[1]) == "string") {
            u = u[1].split("&");
            var get = {};
            for (var i in u) {
                var j = u[i].split("=");
                get[j[0]] = j[1];
            }
            return get;
        } else {
            return {};
        }
    })();

    var pagesize = 30;
    var zid = $_GET['zid'];

    function listTable(query) {
        var url = window.document.location.href.toString();
        var queryString = url.split("?")[1];
        query = query || queryString;
        if (query == 'start' || query == undefined) {
            query = 'zid=' + zid;
            history.replaceState({}, null, './siteprice.php?' + query);
        } else if (query != undefined) {
            history.replaceState({}, null, './siteprice.php?' + query);
        }
        layer.closeAll();
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            type: 'GET',
            url: 'siteprice-table.php?num=' + pagesize + '&' + query,
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

    function searchItem() {
        var kw = $("input[name='kw']").val();
        if (kw == '') {
            listTable('start');
        } else {
            listTable('zid=' + zid + '&kw=' + kw);
        }
        return false;
    }

    function setPrice(tid, iprice) {
        layer.prompt({title: '设置商品密价（填写0取消密价）', value: iprice, formType: 0}, function (text, index) {
            $.ajax({
                type: 'POST',
                url: 'ajax.php?act=setiprice',
                data: {zid: zid, tid: tid, iprice: text},
                dataType: 'json',
                success: function (data) {
                    if (data.code == 0) {
                        layer.msg(data.msg);
                        listTable();
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
    }

    function clearPrice() {
        var confirmobj = layer.confirm('是否要重置该站点所有商品密价？', {
            btn: ['确定', '取消']
        }, function () {
            $.ajax({
                type: 'POST',
                url: 'ajax.php?act=cleariprice',
                data: {zid: zid},
                dataType: 'json',
                success: function (data) {
                    if (data.code == 0) {
                        layer.msg('重置密价成功');
                        listTable();
                    } else {
                        layer.alert(data.msg);
                    }
                },
                error: function (data) {
                    layer.msg('服务器错误');
                    return false;
                }
            });
        }, function () {
            layer.close(confirmobj);
        });
    }

    $(document).ready(function () {
        listTable();

    });
    $("#pagesize").change(function () {
        var size = $(this).val();
        pagesize = size;
        listTable();
    });
</script>
