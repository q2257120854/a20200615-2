<?php

include("../includes/common.php");
$title = '用户管理';
include './head.php';
if ($islogin != 1) {
    exit("<script>window.location.href='./login.php';</script>");
}

$act = $_GET['my'];
if ($act == 'edit_submit') {
    echo '<div class="col-md-12 center-block" style="float: none;">';
    $zid = $_GET['zid'];
    $pwd = filterParam($_POST['pwd']);
    $rmb = floatval(filterParam($_POST['rmb'], 0));
    $qq  = filterParam($_POST['qq']);

    if (empty($zid) || empty($qq))
        showmsg('请求信息不能为空', 3);
    if (!empty($pwd))
        if (strlen($pwd) > 32)
            showmsg('密码长度不能超过32位字符', 3);
    if (strlen($qq) > 12)
        showmsg('qq号长度不能超过12位', 3);
//    $result = $DB->get_row('select `zid` from shua_site where `qq` = "' . $qq . '" limit 1');
//    if (!empty($result))
//        if ($result['zid'] != $zid)
//            showmsg('qq号已经存在，请使用别的QQ号', 3);

    $updateData = [
        'qq'  => $qq,
        'rmb' => $rmb
    ];
    if (!empty($pwd))
        $updateData['pwd'] = $pwd;

    $result = $DB->update('site', $updateData, ['zid' => $zid]);

    if ($result->rowCount() > 0)
        showmsg('更新账户信息成功！<br><br><a href="./userlist.php">&gt;&gt;返回用户列表</a>', 1);
    showmsg('更新账户失败<br>' . $DB->error(), 3);
} else if ($act == 'edit') {
    $zid = intval($_GET['zid']);
    echo '<div class="col-md-12 center-block" style="float: none;">';
    if (empty($zid))
        showmsg('请求信息不能为空', 3);
    $result = $DB->get('site', ['upzid', 'rmb', 'qq'], ['zid' => $zid]);
    if (empty($result))
        showmsg('分站账户不存在，请刷新重试', 3);
    ?>
    <div class="block">
        <div class="block-title"><h3 class="panel-title">修改分站信息</h3></div>
        <div class="">
            <form action="./userlist.php?my=edit_submit&zid=<?php echo $zid; ?>" method="POST">
                <div class="form-group">
                    <label>上级站点ID:</label><br>
                    <input type="text" class="form-control" name="upzid" value="<?php echo $result['upzid']; ?>"
                           disabled="">
                </div>
                <div class="form-group">
                    <label>余额:</label><br>
                    <input type="text" class="form-control" name="rmb" value="<?php echo $result['rmb']; ?>"
                           required="">
                </div>
                <div class="form-group">
                    <label>QQ:</label><br>
                    <input type="text" class="form-control" name="qq" value="<?php echo $result['qq']; ?>">
                </div>
                <div class="form-group">
                    <label>重置密码:</label><br>
                    <input type="text" class="form-control" name="pwd" value="" placeholder="不重置请留空">
                </div>
                <input type="submit" class="btn btn-primary btn-block" value="确定修改"></form>
            <br><a href="./userlist.php">&gt;&gt;返回用户列表</a>
        </div>
    </div>
    <?php
} else if ($act == 'add_submit') {
    echo '<div class="col-md-12 center-block" style="float: none;">';
    $user = filterParam($_POST['user']);
    $pwd  = filterParam($_POST['pwd']);
    $rmb  = floatval(filterParam($_POST['rmb'], 0));
    $qq   = filterParam($_POST['qq']);
    if (empty($user) || empty($pwd) || empty($qq))
        showmsg('请求信息不能为空', 3);
    if (strlen($qq) > 12)
        showmsg('qq号长度不能超过12位', 3);
    if (strlen($user) > 20)
        showmsg('用户名长度不能超过20位字符', 3);
    if (strlen($pwd) > 32)
        showmsg('密码长度不能超过32位字符', 3);
    $result = $DB->get('site', ['user', 'qq'], ['OR' => ['user' => $user, 'qq' => $qq]]);
    if (!empty($result)) {
        if ($result['user'] == $user)
            showmsg('新增账户失败，用户名已经存在', 3);
        if ($result['qq'] == $qq)
            showmsg('新政账户失败，qq号已经存在', 3);
    }
    $insertResult = $DB->insert('site', [
        'addtime'     => $date,
        'qq'          => $qq,
        'upzid'       => 0,
        'power'       => 0,
        'user'        => $user,
        'pwd'         => $pwd,
        'rmb'         => $rmb,
        'point'       => 0,
        'pay_type'    => 0,
        'status'      => 1,
        'ktfz_price'  => 0,
        'ktfz_price2' => 0,
        'utype'       => 0
    ]);
    if ($insertResult->rowCount()) {
        showmsg('添加用户成功！<br><br><a href="./userlist.php">&gt;&gt;返回用户列表</a>', 1);
    } else {
        showmsg('添加用户失败<br>' . $DB->error(), 3);
    }
} else if ($act == 'delete') {
    echo '<div class="col-md-12 center-block" style="float: none;">';
    $zid = intval($_GET['zid']);
    if (empty($zid))
        showmsg('请求信息不能为空', 3);
    $result = $DB->delete('site', ['zid' => $zid, 'LIMIT' => 1]);
    if ($result) {
        log_result('用户管理', 'IP => ' . real_ip() . '<br>UA => ' . $_SERVER['HTTP_USER_AGENT'] . '<br>Url => ' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'], '删除用户[成功]', '1');
        showmsg('删除成功！<br><br><a href="./userlist.php">&gt;&gt;返回用户列表</a>', 1);
    }
    log_result('用户管理', 'IP => ' . real_ip() . '<br>UA => ' . $_SERVER['HTTP_USER_AGENT'] . '<br>Url => ' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'], '删除用户[失败]', '1');
    showmsg('删除失败<br>' . $DB->error(), 3);
} else if ($act == 'add') {
    echo '<div class="col-md-12 center-block" style="float: none;">';
    ?>
    <div class="block">
        <div class="block-title"><h3 class="panel-title">添加一个用户</h3></div>
        <div class="">
            <form action="./userlist.php?my=add_submit" method="POST">
                <div class="form-group">
                    <label>用户名:</label><br>
                    <input type="text" class="form-control" name="user" value="" required="">
                </div>
                <div class="form-group">
                    <label>密码:</label><br>
                    <input type="text" class="form-control" name="pwd" value="123456" required="">
                </div>
                <div class="form-group">
                    <label>余额:</label><br>
                    <input type="text" class="form-control" name="rmb" value="0" required="">
                </div>
                <div class="form-group">
                    <label>QQ:</label><br>
                    <input type="text" class="form-control" name="qq" value="">
                </div>
                <input type="submit" class="btn btn-primary btn-block" value="确定添加"></form>
            <br><a href="./userlist.php">&gt;&gt;返回用户列表</a></div>
    </div>
    <?php
} else {
    ?>

    <div class="col-md-12 center-block" style="float: none;">
        <div class="modal" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span
                                    aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">搜索用户</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" name="kw" placeholder="请输入用户名"><br/>
                        <button type="button" class="btn btn-primary btn-block" id="search_submit">搜索</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="modal-rmb">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">余额充值</h4>
                    </div>
                    <div class="modal-body">
                        <form id="form-rmb">
                            <input type="hidden" name="zid" value="">
                            <div class="form-group">
                                <div class="input-group">
							<span class="input-group-addon p-0">
								<select name="do"
                                        style="-webkit-border-radius: 0;height:20px;border: 0;outline: none !important;border-radius: 5px 0 0 5px;padding: 0 5px 0 5px;">
									<option value="0">充值</option>
									<option value="1">扣除</option>
								</select>
							</span>
                                    <input type="number" class="form-control" name="rmb" placeholder="输入金额">
                                    <span class="input-group-addon">元</span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-info" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" id="recharge">确定</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="block">
            <div class="block-title clearfix">
                <?php
                $result = $DB->count('site', ['power' => 0]);
                ?>
                <h2>系统共有 <b><?php echo $result; ?></b> 个用户</h2>
            </div>
            <a href="./userlist.php?my=add" class="btn btn-primary">
                添加用户
            </a>
            &nbsp;
            <a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">
                搜索
            </a>
            &nbsp;<label class="form-inline" for="tabSort" style="font-weight: normal;">
                按余额&nbsp;
                <select class="form-control" id="tabSort" style="font-weight: normal;">
                    <option value="">请选择</option>
                    <option value="0">正序</option>
                    <option value="1">倒序</option>
                </select>
            </label>&nbsp;
            <a href="javascript:listTable('start')" class="btn btn-default" title="刷新用户列表">
                <i class="fa fa-refresh"></i>
            </a>
            <div id="listTable"></div>
        </div>
    </div>
    <script>
        function listTable(query) {
            var queryString = window.location.search.substring(1);
            query = query || queryString;
            if (query === 'start' || query === undefined) {
                query = '';
                history.replaceState({}, null, './userlist.php');
            } else if (query !== '') {
                history.replaceState({}, null, './userlist.php?' + query);
            }
            layer.closeAll();
            var ii = layer.load(2, {shade: [0.1, '#fff']});
            $.ajax({
                type: 'GET',
                url: 'userlist-table.php?' + query,
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

        function showRecharge(zid) {
            $("input[name='zid']").val(zid);
            $('#modal-rmb').modal('show');
        }

        function setActive(zid, active) {
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=setSite&zid=' + zid + '&active=' + active,
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

        $(document).ready(function () {
            $('#tabSort').change(function () {
                let v = parseInt($(this).val());
                if (v === 1 || v === 0) {
                    listTable('sort=' + v);
                    return;
                }
                listTable('start');
            });
            $("#recharge").click(function () {
                var zid = $("input[name='zid']").val();
                var actdo = $("select[name='do']").val();
                var rmb = $("input[name='rmb']").val();
                if (rmb == '') {
                    layer.alert('请输入金额');
                    return false;
                }
                var ii = layer.load(2, {shade: [0.1, '#fff']});
                $.ajax({
                    type: "POST",
                    url: "ajax.php?act=siteRecharge",
                    data: {zid: zid, actdo: actdo, rmb: rmb},
                    dataType: 'json',
                    success: function (data) {
                        layer.close(ii);
                        if (data.code == 0) {
                            layer.msg('修改余额成功');
                            $('#modal-rmb').modal('hide');
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
            $("#search_submit").click(function () {
                var kw = $("input[name='kw']").val();
                $("#search").modal('hide');
                if (kw == '') {
                    listTable('start');
                } else {
                    listTable('kw=' + kw);
                }
            });
        });
        $(document).ready(function () {
            listTable();
        })
    </script>
<?php } ?>