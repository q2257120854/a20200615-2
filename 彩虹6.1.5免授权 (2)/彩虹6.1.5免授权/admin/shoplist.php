<?php
/**
 * 商品管理
 **/
include '../includes/common.php';
$title = '商品管理';
include './head.php';
if ($islogin != 1) {
    exit("<script type=\"text/javascript\">window.location.href='./login.php';</script>");
}

$act = filterParam($_GET['act']);
if ($act == 'replaceProductParam' && !empty($_POST)) {
    $originalProductParam = filterParam($_POST['originalProductParam']);
    $targetProductParam   = filterParam($_POST['targetProductParam']);
    if (empty($originalProductParam) || empty($targetProductParam))
        showmsg('请求参数不能为空', 3);
    $where = [];

    if (!empty($_GET['cid']))
        $where['cid'] = intval($_GET['cid']);

    $result = $DB->replace('tools', [
        'input'  => [
            $originalProductParam => $targetProductParam
        ],
        'inputs' => [
            $originalProductParam => $targetProductParam
        ],
    ], $where);
    if ($result === false)
        showmsg('修改失败 => ' . $DB->error(), 3);
    showmsg('成功更替 ' . $result->rowCount() . ' 条数据', 1);
} else if ($act == 'replaceProductName' && !empty($_POST)) {
    $originalProductName = filterParam($_POST['originalProductName']);
    $targetProductName   = filterParam($_POST['targetProductName']);
    if (empty($originalProductName) || empty($targetProductName))
        showmsg('请求参数不能为空', 3);
    $where = [];

    if (!empty($_GET['cid']))
        $where['cid'] = intval($_GET['cid']);

    $result = $DB->replace('tools', [
        'name' => [
            $originalProductName => $targetProductName
        ]
    ], $where);

    if ($result === false)
        showmsg('修改失败 => ' . $DB->error(), 3);
    showmsg('成功更替 ' . $result->rowCount() . ' 条数据', 1);
} else if ($act == 'replaceProductName') {
    ?>
    <div class="col-md-12 center-block" style="float: none;">
        <div class="block">
            <div class="block-title"><h3 class="panel-title">批量修改商品名称</h3></div>
            <div class="">
                <div class="alert alert-info">
                    当含有原商品名称字符时，他会更替成目标商品名称字符
                </div>
                <form action="./shoplist.php?act=replaceProductName&cid=<?php echo filterParam($_GET['cid']); ?>"
                      method="POST">
                    <div class="form-group">
                        <label>原商品名:</label><br>
                        <input type="text" class="form-control" name="originalProductName" placeholder="请输入原商品名称  例如 KS"
                               required="">
                    </div>
                    <div class="form-group">
                        <label>更替后商品名称:</label><br>
                        <input type="text" class="form-control" name="targetProductName" placeholder="请输入目标商品名称 例如 巨屎"
                               required="">
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="确定修改">
                </form>
                <br>
                <a href="./shoplist.php">&gt;&gt;返回商品列表</a>
            </div>
        </div>
    </div>
    <?php
} else if ($act == 'replaceProductParam') {
    ?>
    <div class="col-md-12 center-block" style="float: none;">
        <div class="block">
            <div class="block-title"><h3 class="panel-title">批量修改商品参数名称</h3></div>
            <div class="">
                <div class="alert alert-info">
                    当含有原商品参数字符时，他会更替成目标商品参数字符
                </div>
                <form action="./shoplist.php?act=replaceProductParam&cid=<?php echo filterParam($_GET['cid']); ?>"
                      method="POST">
                    <div class="form-group">
                        <label>原商品名:</label><br>
                        <input type="text" class="form-control" name="originalProductParam"
                               placeholder="请输入原商品名称  例如 QQ密码"
                               required="">
                    </div>
                    <div class="form-group">
                        <label>更替后商品名称:</label><br>
                        <input type="text" class="form-control" name="targetProductParam"
                               placeholder="请输入目标商品名称 例如 QQ密钥"
                               required="">
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="确定修改">
                </form>
                <br>
                <a href="./shoplist.php">&gt;&gt;返回商品列表</a>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>

    <div class="col-md-12 center-block" style="float: none;">
        <div class="block">
            <div class="block-title clearfix">
                <h2 id="blocktitle"></h2>
                <span class="pull-right">
                <select id="pagesize" class="form-control">
                    <option value="30">30</option>
                    <option value="50">50</option>
                    <option value="60">60</option>
                    <option value="80">80</option>
                    <option value="100">100</option>
                </select>
            </span>
            </div>
            <form onsubmit="return searchItem()" method="GET" class="form-inline">
                <div class="form-group">
                    <a href="./shoplist.php?act=replaceProductName&cid=<?php echo filterParam($_GET['cid']); ?>"
                       class="btn btn-primary"><i
                                class="glyphicon glyphicon-link"></i>&nbsp;批量修改商品名称</a>&nbsp;
                    <a href="./shoplist.php?act=replaceProductParam&cid=<?php echo filterParam($_GET['cid']); ?>"
                       class="btn btn-primary"><i
                                class="glyphicon glyphicon-link"></i>&nbsp;批量修改商品参数名称</a>&nbsp;
                    <a href="./shopedit.php?my=add&cid=<?php echo filterParam($_GET['cid']); ?>"
                       class="btn btn-primary"><i
                                class="fa fa-plus"></i>&nbsp;添加商品</a>&nbsp;
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="kw" placeholder="请输入商品名称">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">搜索</button>&nbsp;
                    <button type="button" id="reset_sort" class="btn btn-warning">重置排序</button>
                    <a href="javascript:listTable('start')" class="btn btn-default" title="刷新商品列表"><i
                                class="fa fa-refresh"></i></a></div>

            </form>

            <div id="listTable"></div>
        </div>
        <font color="grey">提示：查看单个分类的商品列表可进行商品排序操作</div>
    <script>
        // 表格全选/取消全选
        function selectAll(checkbox) {
            $('input[type=checkbox]').prop('checked', $(checkbox).prop('checked'));
        }

        var pagesize = 30;

        function listTable(query) {
            var url = window.document.location.href.toString();
            var queryString = url.split("?")[1];
            query = query || queryString;
            if (query == 'start' || query == undefined) {
                let cid = '<?php echo isset($_GET['cid']) ? $_GET['cid'] : 0;?>';
                if (cid != 0) {
                    query = 'cid=' + cid;
                } else {
                    query = '';
                }
                history.replaceState({}, null, './shoplist.php');
            } else if (query != undefined) {
                history.replaceState({}, null, './shoplist.php?' + query);
            }
            layer.closeAll();
            var ii = layer.load(2, {shade: [0.1, '#fff']});
            $.ajax({
                type: 'GET',
                url: 'shoplist-table.php?num=' + pagesize + '&' + query,
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

        function show(tid) {
            var ii = layer.load(2, {shade: [0.1, '#fff']});
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=getTool&tid=' + tid,
                dataType: 'json',
                success: function (data) {
                    layer.close(ii);
                    if (data.code == 0) {
                        var item = '<table class="table table-condensed table-hover">';
                        item += '<tr><td colspan="6" style="text-align:center"><b>商品详情</b></td></tr><tr><td class="info">商品ID</td><td colspan="5">' + data.data.tid + '</td></tr><tr><td class="info">商品名称</td><td colspan="5">' + data.data.name + '</td></tr><tr><td class="info">商品链接</td><td colspan="5"><a href="' + data.data.link + '" target="_blank">' + data.data.link + '</a></td></tr>';
                        item += '</table>';
                        layer.open({
                            type: 1,
                            title: '商品详情',
                            skin: 'layui-layer-rim',
                            content: item
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

        function editAllPrice() {
            var prid = $("select[name='prid_n']").val();
            $("input[name='prid']").val(prid);
            var ii = layer.load(2, {shade: [0.1, '#fff']});
            $.ajax({
                type: 'POST',
                url: 'ajax.php?act=editAllPrice',
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
        }

        function change() {
            if ($("select[name='aid']").val() == 10) {
                var ii = layer.load(2, {shade: [0.1, '#fff']});
                $.ajax({
                    type: 'GET',
                    url: 'ajax.php?act=getAllPrice',
                    dataType: 'json',
                    success: function (data) {
                        layer.close(ii);
                        if (data.code == 0) {
                            layer.open({
                                type: 1,
                                title: '修改加价模板',
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
                return false;
            }
            var ii = layer.load(2, {shade: [0.1, '#fff']});
            $.ajax({
                type: 'POST',
                url: 'ajax.php?act=shop_change',
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

        function move() {
            var ii = layer.load(2, {shade: [0.1, '#fff']});
            $.ajax({
                type: 'POST',
                url: 'ajax.php?act=shop_move',
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

        function searchItem() {
            var kw = $("input[name='kw']").val();
            if (kw == '') {
                listTable('start');
            } else {
                listTable('kw=' + kw);
            }
            return false;
        }

        $('#reset_sort').click(function () {
            layer.confirm('当你无法自定义排序时，可重置排序解决，重置排序后，该分类下的商品将以你创建商品时间倒序排序，确定继续？', function () {
                layer.load(2);
                $.post('ajax.php?act=reset_sort', {
                    type: 1,
                    cid: '<?php echo filterParam($_GET['cid']);?>'
                }, function (res) {
                    layer.closeAll('loading');
                    if (res.code === 0) {
                        layer.msg(res.msg, {icon: 1}, function () {
                            searchItem();
                        });
                    } else {
                        layer.msg(res.msg, {icon: 5});
                    }
                }, 'json').error(function () {
                    layer.closeAll('loading');
                    layer.msg('操作异常', {icon: 7});
                });
            });
        });

        function setActive(tid, active) {
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=setTools&tid=' + tid + '&active=' + active,
                dataType: 'json',
                success: function (data) {
                    listTable();
                },
                error: function (data) {
                    layer.msg('服务器错误');
                    return false;
                }
            });
        }

        function setClose(tid, close) {
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=setTools&tid=' + tid + '&close=' + close,
                dataType: 'json',
                success: function (data) {
                    listTable();
                },
                error: function (data) {
                    layer.msg('服务器错误');
                    return false;
                }
            });
        }

        function delTool(tid) {
            var confirmobj = layer.confirm('你确实要删除此商品吗？', {
                btn: ['确定', '取消']
            }, function () {
                $.ajax({
                    type: 'GET',
                    url: 'ajax.php?act=delTool&tid=' + tid,
                    dataType: 'json',
                    success: function (data) {
                        if (data.code == 0) {
                            layer.msg('删除成功');
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

        function sort(cid, tid, sort) {
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=setToolSort&cid=' + cid + '&tid=' + tid + '&sort=' + sort,
                dataType: 'json',
                success: function (data) {
                    listTable();
                },
                error: function (data) {
                    layer.msg('服务器错误');
                    return false;
                }
            });
        }

        function getPrice(tid) {
            var ii = layer.load(2, {shade: [0.1, '#fff']});
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=getPrice&tid=' + tid,
                dataType: 'json',
                success: function (data) {
                    layer.close(ii);
                    if (data.code == 0) {
                        layer.open({
                            type: 1,
                            title: '修改商品价格',
                            skin: 'layui-layer-rim',
                            content: data.data
                        });
                        changePrice();
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

        // 添加到推广
        function addInvite(tid) {
            layer.load(2);
            if (!tid) return false;
            $.ajax({
                url: 'ajax.php?act=invite_add'
                , type: 'POST'
                , dataType: 'json'
                , data: {tid: tid}
                , success: function (res) {
                    layer.closeAll('loading');
                    if (0 !== res['code']) {
                        return layer.msg(res['msg'], {icon: 7});
                    }
                    layer.msg(res['msg'], {icon: 1});
                }
                , error: function () {
                    layer.closeAll('loading');
                    layer.msg('操作异常', {icon: 8});
                }
            });
        }

        function editPrice(tid) {
            var price = $("#price").val();
            var prid = $("#prid").val();
            var price_s = $("#price_s").val();
            var cost_s = $("#cost_s").val();
            var cost2_s = $("#cost2_s").val();
            if (parseInt(prid) > 0 && price == '' || parseInt(prid) == 0 && price_s == '') {
                layer.alert('商品售价不能为空！');
                return false;
            }
            var ii = layer.load(2, {shade: [0.1, '#fff']});
            $.ajax({
                type: "POST",
                url: "ajax.php?act=editPrice",
                data: {tid: tid, price: price, prid: prid, price_s: price_s, cost_s: cost_s, cost2_s: cost2_s},
                dataType: 'json',
                success: function (data) {
                    layer.close(ii);
                    if (data.code == 0) {
                        layer.msg('保存成功！');
                        listTable();
                    } else {
                        layer.alert(data.msg);
                    }
                }
            });
        }

        function getFloat(number, n) {
            n = n ? parseInt(n) : 0;
            if (n <= 0) return Math.round(number);
            number = Math.round(number * Math.pow(10, n)) / Math.pow(10, n);
            return number;
        }

        function changePrice() {
            var price = $("#price").val();
            var prid = $("#prid").val();
            if (prid == '0') {
                $("#price_s").attr("disabled", false);
                $("#cost_s").attr("disabled", false);
                $("#cost2_s").attr("disabled", false);
                $("#price").attr("disabled", true);
            } else {
                $("#price_s").attr("disabled", true);
                $("#cost_s").attr("disabled", true);
                $("#cost2_s").attr("disabled", true);
                $("#price").attr("disabled", false);
                if (price == '') return false;
                price = parseFloat(price);
                var kind = parseInt($("#prid option:selected").attr('kind'));
                var p_2 = parseFloat($("#prid option:selected").attr('p_2'));
                var p_1 = parseFloat($("#prid option:selected").attr('p_1'));
                var p_0 = parseFloat($("#prid option:selected").attr('p_0'));
                $("#price_s").val(getFloat(kind == 1 ? price + p_0 : price * p_0, 2));
                $("#cost_s").val(getFloat(kind == 1 ? price + p_1 : price * p_1, 2));
                $("#cost2_s").val(getFloat(kind == 1 ? price + p_2 : price * p_2, 2));
            }
        }

        $(document).ready(function () {
            listTable();
            $("#pagesize").change(function () {
                var size = $(this).val();
                pagesize = size;
                listTable();
            });
        })
    </script>
<?php } ?>