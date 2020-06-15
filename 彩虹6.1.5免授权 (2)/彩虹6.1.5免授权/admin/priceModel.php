<?php

include_once '../includes/common.php';
$title = '加价模板';
include_once './head.php';
if ($islogin != 1)
    exit("<script language='javascript'>window.location.href='./login.php';</script>");

$act = $_GET['mod'];

echo '<div class="col-sm-12 col-md-10 center-block" style="float: none;margin-top: 15px;">';
?>
<style>
    .block {
        /*margin: 0 0 10px;*/
        padding: 20px;
        background-color: #ffffff;
        border-top-left-radius: 2px;
        border-top-right-radius: 2px;
        -webkit-box-shadow: 0 2px 0 rgba(218, 224, 232, .5);
        box-shadow: 0 2px 0 rgba(218, 224, 232, .5);
    }
</style>
<div class="modal" id="modal-store" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInX">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" id="modal-title">加价模板修改/添加</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-store">
                    <input type="hidden" id="action"/>
                    <input type="hidden" name="prid" id="prid"/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right"></label>
                        <div class="col-sm-10">
                            <div class="alert alert-warning">
                                注意：设置的加价规则应满足：用户加价&gt;=普及版加价&gt;=专业版加价
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right">模板名称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" placeholder="输入模板名称">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">加价方式</label>
                        <div class="col-sm-10">
                            <select name="kind" id="kind" class="form-control" onchange="changeKind()">
                                <option value="0">倍数加价</option>
                                <option value="1">固定金额加价</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">假设商品成本价</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="100" id="test_price" onkeyup="changeTest()">
                            <pre>此价格作为下面加价后价格显示预览，无实际意义！</pre>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right">专业版加价</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="p_2" id="p_2" onkeyup="changeTest('p_2')">
                            <div class="form-control" style="color: red">加价后价格:<span id="test_p_2"></span></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right">普及版加价</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="p_1" id="p_1" onkeyup="changeTest('p_1')">
                            <div class="form-control" style="color: red">加价后价格:<span id="test_p_1"></span></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right">普通用户加价</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="p_0" id="p_0" onkeyup="changeTest('p_0')">
                            <div class="form-control" style="color: red">加价后价格:<span id="test_p_0"></span></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="store" onclick="save()">保存</button>
            </div>
        </div>
    </div>
</div>

<div class="block">
    <div class="block-title clearfix">
        <h2>加价模板&nbsp
            <a class="btn btn-primary" href="javascript:addframe()"><i class="fa fa-plus"></i> 新增</a>
        </h2>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>名称</th>
                <th>类型</th>
                <th>加价规则</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

            $totalRow = $DB->count('price');
            $limit    = 20;

            $rs = $DB->select('price', ['id', 'name', 'p_0', 'p_1', 'p_2', 'kind'], ['ORDER' => ['id' => 'DESC'], 'LIMIT' => [$page - 1, $limit]]);
            foreach ($rs as $res) { ?>
                <tr>
                    <td><b><?php echo $res['id']; ?></b></td>
                    <td><?php echo htmlspecialchars($res['name']); ?></td>
                    <td><?php echo $res['kind'] ? '<span class="btn-info btn-xs">固定金额加价</span>' : '<span class="btn-primary btn-xs">倍数加价</span>'; ?></td>
                    <td><?php echo $res['p_2'] . '|' . $res['p_1'] . '|' . $res['p_0']; ?></td>
                    <td><a href="./shoplist.php?prid=<?php echo $res['id']; ?>" target="_blank"
                           class="btn btn-success btn-xs">商品</a>&nbsp;<a
                                href="javascript:editframe(<?php echo $res['id']; ?>)"
                                class="btn btn-info btn-xs">编辑</a>&nbsp;<a
                                href="javascript:delItem(<?php echo $res['id']; ?>)"
                                class="btn btn-xs btn-danger">删除</a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?php echo DSPage($totalRow, $limit, $page); ?>
    </div>
</div>
<script>
    $('.pagination li>a').click(function () {
        var clickPage = $(this).attr('data-page');
        if (clickPage === undefined)
            return;
        window.location.href = './priceModel.php?page=' + clickPage;
    });

    function getFloat(number, n) {
        n = n ? parseInt(n) : 0;
        if (n <= 0) return Math.round(number);
        number = Math.round(number * Math.pow(10, n)) / Math.pow(10, n);
        return number;
    }

    function changeKind() {
        var kind = $("#kind").val();
        if (kind == 1) {
            $("#p_0").attr("placeholder", "输入加价价格");
            $("#p_1").attr("placeholder", "输入加价价格");
            $("#p_2").attr("placeholder", "输入加价价格");
        } else {
            $("#p_0").attr("placeholder", "输入加价倍数(大于1的小数)");
            $("#p_1").attr("placeholder", "输入加价倍数(大于1的小数)");
            $("#p_2").attr("placeholder", "输入加价倍数(大于1的小数)");
        }
        changeTest();
    }

    function changeTest(obj) {
        obj = obj | '';
        var kind = $("#kind").val();
        var price = $("#test_price").val();
        if (price == '' || isNaN(price)) return false;
        price = parseFloat(price);
        var p_2 = $("#p_2").val();
        var p_1 = $("#p_1").val();
        var p_0 = $("#p_0").val();
        p_2 = parseFloat(p_2);
        $("#test_p_2").html(getFloat(kind == 1 ? price + p_2 : price * p_2, 2));
        p_1 = parseFloat(p_1);
        $("#test_p_1").html(getFloat(kind == 1 ? price + p_1 : price * p_1, 2));
        p_0 = parseFloat(p_0);
        $("#test_p_0").html(getFloat(kind == 1 ? price + p_0 : price * p_0, 2));
    }

    function addframe() {
        $("#modal-store").modal('show');
        $("#modal-title").html("新增加价模板");
        $("#action").val("add");
        $("#prid").val('');
        $("#name").val('');
        $("#kind").val(0);
        $("#p_2").val('');
        $("#p_1").val('');
        $("#p_0").val('');
        changeKind()
    }

    function editframe(id) {
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            type: 'GET',
            url: 'ajax.php?act=getPriceRule&id=' + id,
            dataType: 'json',
            success: function (data) {
                layer.close(ii);
                if (data.code == 0) {
                    $("#modal-store").modal('show');
                    $("#modal-title").html("修改加价模板");
                    $("#action").val("edit");
                    $("#prid").val(data.id);
                    $("#name").val(data.name);
                    $("#kind").val(data.kind);
                    $("#p_2").val(data.p_2);
                    $("#p_1").val(data.p_1);
                    $("#p_0").val(data.p_0);
                    changeKind()
                } else {
                    layer.alert(data.msg)
                }
            },
            error: function (data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    function save() {
        var action = $("#action").val();
        if (action == 'add') {
            var queryurl = 'ajax.php?act=addPriceRule';
        } else {
            var queryurl = 'ajax.php?act=editPriceRule';
        }
        if ($("#name").val() == '' || $("#p_2").val() == '' || $("#p_1").val() == '' || $("#p_0").val() == '') {
            layer.alert('请确保各项不能为空！');
            return false;
        }
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            type: 'POST',
            url: queryurl,
            data: $("#form-store").serialize(),
            dataType: 'json',
            success: function (data) {
                layer.close(ii);
                if (data.code == 0) {
                    layer.alert(data.msg, {
                        icon: 1,
                        closeBtn: false
                    }, function () {
                        window.location.reload()
                    });
                } else {
                    layer.alert(data.msg)
                }
            },
            error: function (data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    function delItem(id) {
        var confirmobj = layer.confirm('你确实要删除此模板吗？', {
            btn: ['确定', '取消']
        }, function () {
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=delPriceRule&id=' + id,
                dataType: 'json',
                success: function (data) {
                    if (data.code == 0) {
                        window.location.reload()
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
</script>