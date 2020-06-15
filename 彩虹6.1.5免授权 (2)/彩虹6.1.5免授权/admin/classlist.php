<?php
include("../includes/common.php");
$title = '分类管理';
include './head.php';

if ($islogin != 1) exit('<script>window.location.href="./login.php";</script>');

$act = $_GET['my'];

if ($act == 'classimg') { ?>
    <div class="col-sm-12 col-md-10 center-block" style="float: none;">
        <div class="block">
            <div class="block-title">
                <h2>修改分类图片&nbsp;[<a href="./classlist.php">返回</a>]</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>分类名称</th>
                        <th style="min-width:220px">图片URL</th>
                    </tr>
                    </thead>
                    <tbody>
                    <form id="classlist">
                        <?php
                        $rs = $DB->select('class', ['cid', 'name', 'shopimg'], ['ORDER' => ['sort' => 'ASC']]);
                        foreach ($rs as $res) {
                            ?>
                            <tr>
                                <td><?php echo $res['name']; ?></td>
                                <td>
                                    <div class="input-group">
                                        <input type="file" id="file<?php echo $res['cid']; ?>"
                                               onchange="fileUpload(<?php echo $res['cid']; ?>)"
                                               style="display:none;">
                                        <input type="text" class="form-control input-sm"
                                               name="img<?php echo $res['cid']; ?>"
                                               value="<?php echo $res['shopimg']; ?>"
                                               placeholder="填写图片URL" required="">
                                        <span class="input-group-btn">
                                                <a href="javascript:fileSelect(<?php echo $res['cid']; ?>)"
                                                   class="btn btn-success btn-sm" title="上传图片">
                                                    <i class="fa fa-upload"></i>
                                                </a>
                                                <a href="javascript:getImage(<?php echo $res['cid']; ?>)"
                                                   class="btn btn-info btn-sm" title="自动获取图片">
                                                    <i class="fa fa-search"></i>
                                                </a>
                                                <a href="javascript:fileView(<?php echo $res['cid']; ?>)"
                                                   class="btn btn-warning btn-sm"
                                                   title="查看图片">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </span>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td></td>
                            <td><span class="btn btn-primary btn-sm btn-block" onclick="saveAllImages()">保存全部</span>
                            </td>
                        </tr>
                    </form>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <span class="glyphicon glyphicon-info-sign"></span>当前图片仅适用于部分首页模板
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="col-sm-12 col-md-10 center-block" style="float: none;">
        <div class="block">
            <div class="block-title">
                <div class="block-options pull-right">
                    <a href="javascript:resetSort()" class="btn btn-default" title="重置分类排序">
                        <i class="glyphicon glyphicon-sort-by-attributes-alt"></i>
                    </a>
                    <a href="javascript:listTable()" class="btn btn-default" title="刷新分类列表">
                        <i class="fa fa-refresh"></i>
                    </a>
                </div>
                <h2>商品分类</h2>
            </div>
            <div id="listTable"></div>
        </div>
    </div>
<?php } ?>
<script>
    function listTable(query) {
        var url = window.document.location.href.toString();
        var queryString = url.split("?")[1];
        query = query || queryString;
        layer.closeAll();
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            type: 'GET',
            url: 'classlist-table.php?' + query,
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

    function resetSort() {
        layer.confirm('当你无法自定义排序时，可重置排序解决，重置排序后，所有商品分类将以你创建分类时间倒序排序，确定继续？', function () {
            layer.load(2);
            $.post('ajax.php?act=reset_sort', {type: 2}).success(function (res) {
                layer.closeAll('loading');
                if (res.code === 0) {
                    layer.msg(res.msg, {icon: 1}, function () {
                        listTable();
                    });
                } else {
                    layer.msg(res.msg, {icon: 5});
                }
            }).error(function () {
                layer.closeAll('loading');
                layer.msg('操作异常', {icon: 7});
            });
        });
    }

    function setActive(cid, active) {
        $.ajax({
            type: 'GET',
            url: 'ajax.php?act=setClass&cid=' + cid + '&active=' + active,
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

    function sort(cid, sort) {
        $.ajax({
            type: 'GET',
            url: 'ajax.php?act=setClassSort&cid=' + cid + '&sort=' + sort,
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

    function getImage(cid) {
        layer.confirm('是否从该分类下的商品图片获取一张作为分类图片？', {
            btn: ['确定'] //按钮
        }, function () {
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=getClassImage&cid=' + cid,
                dataType: 'json',
                success: function (data) {
                    if (data.code == 0) {
                        layer.msg('获取图片成功');
                        $("input[name='img" + cid + "']").val(data.url);
                    } else {
                        layer.alert('该分类下商品都没有图片');
                    }
                },
                error: function (data) {
                    layer.msg('服务器错误');
                    return false;
                }
            });
        });
    }

    function addClass() {
        var name = $("input[name='name']").val();
        $.ajax({
            type: 'POST',
            url: 'ajax.php?act=addClass',
            data: {name: name},
            dataType: 'json',
            success: function (data) {
                if (data.code == 0) {
                    layer.msg('添加成功');
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
    }

    function editClass(cid) {
        var name = $("input[name='name" + cid + "']").val();
        $.ajax({
            type: 'POST',
            url: 'ajax.php?act=editClass&cid=' + cid,
            data: {name: name},
            dataType: 'json',
            success: function (data) {
                if (data.code == 0) {
                    layer.msg('修改成功');
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
    }

    function delClass(cid) {
        var confirmobj = layer.confirm('你确实要删除此分类和分类下全部商品吗？', {
            btn: ['确定', '取消']
        }, function () {
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=delClass&cid=' + cid,
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

    function saveAll() {
        layer.load(2);
        $.ajax({
            type: 'POST',
            url: 'ajax.php?act=editClassAll',
            data: $('#classlist').serialize(),
            dataType: 'json',
            success: function (data) {
                layer.closeAll('loading');
                alert(data['msg'] + '；更新 ' + data['ok_num'] + ' 个分类');
                listTable();
            },
            error: function (data) {
                layer.closeAll('loading');
                layer.msg('服务器错误！');
                return false;
            }
        });
    }

    function saveAllImages() {
        $.ajax({
            type: 'POST',
            url: 'ajax.php?act=editClassImages',
            data: $('#classlist').serialize(),
            dataType: 'json',
            success: function (data) {
                alert('保存成功！');
                window.location.reload();
            },
            error: function (data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    function fileSelect(cid) {
        $("#file" + cid).trigger("click");
    }

    function fileView(cid) {
        var shopimg = $("input[name='img" + cid + "']").val();
        if (shopimg == '') {
            layer.alert("请先上传图片，才能预览");
            return;
        }
        if (shopimg.indexOf('http') == -1) shopimg = '../' + shopimg;
        layer.open({
            type: 1,
            area: ['360px', '400px'],
            title: '分类图片查看',
            shade: 0.3,
            anim: 1,
            shadeClose: true,
            content: '<center><img width="300px" src="' + shopimg + '"></center>'
        });
    }

    function fileUpload(cid) {
        var fileObj = $("#file" + cid)[0].files[0];
        if (typeof (fileObj) == "undefined" || fileObj.size <= 0) {
            return;
        }
        var formData = new FormData();
        formData.append("do", "upload");
        formData.append("type", "class");
        formData.append("file", fileObj);
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            url: "ajax.php?act=uploadimg",
            data: formData,
            type: "POST",
            dataType: "json",
            cache: false,
            processData: false,
            contentType: false,
            success: function (data) {
                layer.close(ii);
                if (data.code == 0) {
                    layer.msg('上传图片成功');
                    $("input[name='img" + cid + "']").val(data.url);
                } else {
                    layer.alert(data.msg);
                }
            },
            error: function (data) {
                layer.msg('服务器错误');
                return false;
            }
        })
    }

    $(document).ready(function () {
        listTable();
    })
</script>
<?php hook('adminClassPageReady'); ?>
