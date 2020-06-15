<?php

include("../includes/common.php");
$title = '站内通知';
include './head.php';
if ($islogin == 1) {
} else exit("<script>window.location.href='./login.php';</script>");

$act = $_GET['my'];
echo ' <div class="col-sm-12 col-md-10 center-block" style="float: none;">';
if ($act == 'delete') {
    $id = intval($_GET['id']);
    if (empty($id))
        showmsg('请求信息不能为空', 3);

    $result = $DB->delete('message', ['id' => $id, 'LIMIT' => 1]);
    if ($result) {
        showmsg('删除信息成功<br><br><a href="./message.php">&gt;&gt;返回通知列表</a>', 1);
    } else {
        showmsg('删除信息失败<br>' . $DB->error(), 3);
    }
} else if ($act == 'add_submit') {
    $title   = filterParam($_POST['title']);
    $type    = intval($_POST['type']);
    $content = filterParam($_POST['content']);

    if (empty($title) || empty($content))
        showmsg('文章信息不能为空', 3);

    $insertResult = $DB->insert('message', [
        'zid'     => 1,
        'type'    => $type,
        'title'   => $title,
        'content' => $content,
        'addtime' => $date,
        'count'   => 0,
        'active'  => 1
    ]);

    if ($insertResult->rowCount()) {
        showmsg('新增文章成功<br><br><a href="./message.php">&gt;&gt;返回通知列表</a>', 1);
    } else {
        showmsg('新增文章失败<br>' . $DB->error(), 3);
    }

} else if ($act == 'edit_submit') {
    $id      = intval($_GET['id']);
    $type    = intval($_POST['type']);
    $content = filterParam($_POST['content']);
    $title   = filterParam($_POST['title']);
    if (empty($id) || empty($title) || empty($content))
        showmsg('请求信息不能为空', 3);

    $result = $DB->update('message', [
        'type'    => $type,
        'content' => $content,
        'title'   => $title
    ], [
        'id'    => $id,
        'LIMIT' => 1
    ]);
    if ($result->rowCount() > 0)
        showmsg('修改站内通知成功！<br><br><a href="./message.php">&gt;&gt;返回通知列表</a>', 1);
    showmsg('修改站内通知失败 <br>' . $DB->error(), 3);
} else if ($act == 'add' || $act == 'edit') {
    $title   = '';
    $type    = '0';
    $content = '';
    $id      = filterParam($_GET['id'], 0);

    if (!empty($id)) {
        $data = $DB->get('message', ['title', 'content', 'type'], ['id' => $id]);
        if (!empty($data)) {
            $title   = $data['title'];
            $type    = $data['type'];
            $content = $data['content'];
        }
    }
    ?>
    <div class="block">
        <div class="block-title"><h3 class="panel-title"><?php echo $act == 'edit' ? '修改通知' : '发布新通知'; ?></h3></div>
        <div class="">
            <form action="./message.php?my=<?php echo $act; ?>_submit<?php echo $act == 'edit' ? ('&id=' . $id) : ''; ?>"
                  method="post" class="form-horizontal"
                  role="form">
                <div class="form-group">
                    <label class="col-sm-2 control-label">通知标题</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" value="<?php echo filterParam($title); ?>"
                               class="form-control"/>
                    </div>
                </div>
                <br/>
                <div class="form-group">
                    <label class="col-sm-2 control-label">接收用户类别</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="type" default="<?php echo filterParam($type); ?>">
                            <option value="0">全部用户</option>
                            <option value="1">普通用户</option>
                            <option value="2">所有分站站长</option>
                            <option value="3">普及版站长</option>
                            <option value="4">专业版站长</option>
                        </select>
                    </div>
                </div>
                <br/>
                <div class="form-group">
                    <label class="col-sm-2 control-label">通知内容</label>
                    <div class="col-sm-10">
                        <script id="content" name="content" type="text/plain">
                        <?php echo $content; ?>




                        </script>
                    </div>
                </div>
                <br/>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" name="submit" value="发布" class="btn btn-primary form-control"/><br/>
                    </div>
                </div>
            </form>
            <br/><a href="./message.php">>>返回通知列表</a>
        </div>
    </div>
    <script src="./assets/ueditor.config.js"></script>
    <script src="./assets/ueditor.all.min.js"></script>
    <script src="./assets/lang/zh-cn/zh-cn.js"></script>
    <script>
        $(function ($) {
            var contentDom = UE.getEditor('content');
        });
    </script>
    <?php
} else {
    ?>
    <div class="modal" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">文章列表说明</h4>
                </div>
                <div class="modal-body">
                    访问 <a href="/?mod=articlelist" target="_blank">/?mod=articlelist</a>
                    即可进入文章列表，部分首页模板没有访问入口的可以自行加入该链接。文章列表只显示接收用户为全部用户类型的消息。
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="block">
        <div class="block-title clearfix">
            <?php
            $total = $DB->count('message', []);
            ?>
            <h2>系统共有 <b><?php echo $total; ?></b> 个站内通知</h2>
        </div>
        <a href="./message.php?my=add" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;发布新通知</a>&nbsp;<a
                href="#"
                data-toggle="modal"
                data-target="#search"
                id="search"
                class="btn btn-default"><i
                    class="fa fa-exclamation-circle"></i></a>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>通知标题</th>
                    <th>发布时间</th>
                    <th>已查阅人数</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $list = $DB->select('message', ['id', 'title', 'addtime', 'count', 'active'], ['ORDER' => ['id' => 'DESC']]);
                foreach ($list as $content) {
                    ?>
                    <tr>
                        <td><b><?php echo $content['id']; ?></b></td>
                        <td><?php echo $content['title']; ?></td>
                        <td><?php echo $content['addtime']; ?></td>
                        <td><?php echo $content['count']; ?></td>
                        <td><span class="btn btn-xs btn-<?php echo $content['active'] ? 'success' : 'warning'; ?>"
                                  onclick="setActive(<?php echo $content['id']; ?>,<?php echo $content['active'] ? '0' : '1'; ?>)"><?php echo $content['active'] ? '显示' : '隐藏'; ?></span>
                        </td>
                        <td><span class="btn btn-xs btn-success"
                                  onclick="show(<?php echo $content['id']; ?>)">查看</span>&nbsp;<a
                                    href="./message.php?my=edit&id=<?php echo $content['id']; ?>"
                                    class="btn btn-info btn-xs">编辑</a>&nbsp;<a
                                    href="./message.php?my=delete&id=<?php echo $content['id']; ?>"
                                    class="btn btn-xs btn-danger"
                                    onclick="return confirm('你确实要删除此记录吗？');">删除</a></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function setActive(id, active) {
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=setMessage&id=' + id + '&active=' + active,
                dataType: 'json',
                success: function (data) {
                    window.location.reload()
                },
                error: function (data) {
                    layer.msg('服务器错误');
                    return false;
                }
            });
        }

        function show(id) {
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=getMessage&id=' + id,
                dataType: 'json',
                success: function (data) {
                    if (data.code == 0) {
                        layer.open({
                            type: 1,
                            skin: 'layui-layer-lan',
                            anim: 2,
                            shadeClose: true,
                            title: '查看站内通知',
                            content: '<div class="widget"><div class="widget-content widget-content-mini themed-background-muted text-center"><b>' + data.title + '</b><br/><small><font color="grey">管理员  ' + data.date + '</font></small></div><div class="widget-content">' + data.content + '</div></div>'
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
    </script>
<?php } ?>
<script>
    var items = $("select[default]");
    for (i = 0; i < items.length; i++) {
        $(items[i]).val($(items[i]).attr("default") || 0);
    }
</script>
