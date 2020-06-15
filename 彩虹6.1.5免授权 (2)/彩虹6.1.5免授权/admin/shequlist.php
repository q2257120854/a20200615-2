<?php
include("../includes/common.php");
$title = "网站对接配置";
include("head.php");
if ($islogin == 1) {
} else exit("<script>window.location.href='./login.php';</script>");

$act = $_GET['my'];

echo '<div class="col-sm-12 col-md-10 center-block" style="float: none;">';

if ($act == 'add_submit' || $act == 'edit_submit') {
    if ($act == 'edit_submit' && empty($_GET['id']))
        showmsg('请求信息有误', 3);
    $type     = intval($_POST['type']);
    $url      = strip_tags(filterParam($_POST['url']));
    $username = strip_tags(filterParam($_POST['username']));
    $password = filterParam($_POST['password']);

    $payPassword = filterParam($_POST['paypwd']);
    $payType     = intval($_POST['paytype']);

    if (strlen($url) == 0)
        showmsg('接口地址不能为空', 3);
    if (strlen($username) == 0)
        showmsg('接口账户不能为空', 3);

    if ($act == 'add_submit') {
        $result = $DB->has('shequ', [
            'AND' => [
                'url'      => $url,
                'username' => $username,
                'type'     => $type
            ]
        ]);
        if (!empty($result))
            showmsg('你所添加的记录已存在！', 3);

        $result = $DB->insert('shequ', [
            'url'      => $url,
            'username' => $username,
            'password' => $password,
            'paypwd'   => $payPassword,
            'type'     => $type,
            'status'   => 1,
            'payType'  => $payType
        ]);

        if ($result->rowCount()) {
            showmsg('新增接口成功', 1);
        } else {
            showmsg('新增接口失败<br> ' . $DB->error(), 3);
        }
    }

    $updateID = intval($_GET['id']);

    $result = $DB->update('shequ', [
        'type'     => $type,
        'username' => $username,
        'password' => $password,
        'paypwd'   => $payPassword,
        'paytype'  => $payType,
        'url'      => $url
    ], [
        'id'    => $updateID,
        'LIMIT' => 1
    ]);
    if ($result->rowCount() > 0)
        showmsg('更新信息成功', 1);
    showmsg('更新信息失败<br>' . $DB->error(), 3);

} else if ($act == 'delete') {
    $id = intval($_GET['id']);
    if (empty($id))
        showmsg('请求参数不能为空', 3);
    $result = $DB->delete('shequ', ['id' => $id, 'LIMIT' => 1]);
    if ($result)
        showmsg('删除成功！', 1);

    showmsg('删除失败 <br> ' . $DB->error(), 3);
}

if ($act == 'add' || $act == 'edit') {
    $id = intval(filterParam($_GET['id']));

    $type        = 0;
    $url         = '';
    $username    = '';
    $password    = '';
    $payPassword = '';
    $payType     = '';

    if ($act == 'edit') {
        if (empty($id))
            showmsg('请求ID不能为空', 3);
        $result = $DB->get('shequ', ['id', 'url', 'username', 'password', 'paypwd(payPassword)', 'type', 'paytype(payType)'], ['id' => $id]);
        if (empty($result))
            showmsg('数据不存在，请刷新页面重试', 3);

        foreach ($result as $key => $value) {
            $$key = $value;
        }
    }

    ?>
    <div class="block">
        <div class="block-title">
            <h3 class="panel-title"><?php echo $act == 'edit' ? '修改对接网站信息' : '添加一个社区/卡盟网站对接' ?></h3>
        </div>
        <div class="">
            <form action="./shequlist.php?my=<?php echo $act == 'edit' ? ('edit_submit&id=' . $id) : 'add_submit'; ?>"
                  method="POST">
                <div class="form-group">
                    <label>网站类型:</label><br>
                    <select class="form-control" name="type" default="<?php echo $type; ?>">
                        <option value="0" paytype="1">玖伍系统</option>
                        <option value="1">亿乐系统</option>
                        <option value="3" paytype="1">星墨系统</option>
                        <option value="11" paytype="1">聚梦系统</option>
                        <option value="4">九流社区</option>
                        <option value="6" paypwd="1">卡易信</option>
                        <option value="7" paypwd="1">卡乐购</option>
                        <option value="8">卡慧卡</option>
                        <option value="9">卡商网</option>
                        <option value="10">QQbug社区</option>
                        <option value="12">同系统对接</option>
                    </select>
                </div>
                <div class="form-group">
                    <label id="shequ_url">网站域名:</label><br>
                    <input type="text" class="form-control" name="url" value="<?php echo $url; ?>" required>
                </div>
                <div class="form-group">
                    <label id="username">登录账号:</label><br>
                    <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" required>
                </div>
                <div class="form-group">
                    <label id="password">登录密码:</label><br>
                    <input type="text" class="form-control" name="password" value="<?php echo $password; ?>" required>
                </div>
                <div class="form-group" id="paypwd" style="display:none;">
                    <label>支付密码:</label><br>
                    <input type="text" class="form-control" name="paypwd" value="<?php echo $payPassword ?>"
                           placeholder="没有请留空">
                </div>
                <div class="form-group" id="paytype" style="display:none;">
                    <label>支付方式:</label><br>
                    <select class="form-control" name="paytype" default="<?php echo $payType ?>">
                        <option value="0">点数</option>
                        <option value="1" selected>余额</option>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary btn-block" value="确定添加"></form>
            <br/><a href="./shequlist.php">>>返回对接列表</a></div>
        <div class="panel-footer">
            <span class="glyphicon glyphicon-info-sign"></span>
            社区类型是指该社区使用的网站程序，并不代表具体的社区网站！
        </div>
    </div>
    <script>
        function checkurl() {
            var url = $("input[name='url']").val();
            if (url == '') {
                layer.alert('请先填写网站域名！');
                return false;
            }
            if (url.indexOf('http') < 0 && url.substr(-1) != '/') {
                var ii = layer.load(2, {shade: [0.1, '#fff']});
                $.ajax({
                    type: "POST",
                    url: "ajax.php?act=checkshequ",
                    data: {url: url},
                    dataType: 'json',
                    success: function (data) {
                        layer.close(ii);
                        if (data.code == 1) {
                            layer.msg('连通性良好');
                        } else {
                            layer.alert('该网站由于防火墙原因国外主机无法连接，请使用国内主机');
                        }
                    },
                    error: function (data) {
                        layer.close(ii);
                        layer.msg('目标社区连接超时');
                        return false;
                    }
                });
            } else {
                layer.alert('网站域名不能带http和/符号，只填写域名');
            }
        }

        $("select[name='type']").change(function () {
            var paytype = $("select[name='type'] option:selected").attr('paytype');
            var paypwd = $("select[name='type'] option:selected").attr('paypwd');
            if ($(this).val() == 1) {
                $("#username").html("TokenID：");
                $("#password").html("密匙：");
                $.ajax({
                    type: "GET",
                    url: "ajax.php?act=getServerIp",
                    dataType: 'json',
                    success: function (data) {
                        $(".panel-footer").append('<br/><font color=red>请设置当前服务器IP为白名单：' + data.ip + '</font>');
                    }
                });
            } else if ($(this).val() == 4) {
                $("#shequ_url").html("业务名称(仅用于标记)：");
                $("#username").html("卡号：");
                $("#password").html("密码：");
            } else if ($(this).val() == 9) {
                $("#shequ_url").html("网站域名：");
                $("#username").html("商家编号：");
                $("#password").html("接口密钥：");
            } else if ($(this).val() == 10) {
                $("#shequ_url").html("业务名称(仅用于标记)：");
                $("#username").html("联系方式(随便填写)：");
                $("#password").html("卡密：");
            } else {
                $("#shequ_url").html("网站域名：");
                $("#username").html("登录账号：");
                $("#password").html("登录密码：");
            }
            if (paytype != undefined) {
                $("#paytype").show();
            } else {
                $("#paytype").hide();
            }
            if (paypwd != undefined) {
                $("#paypwd").show();
            } else {
                $("#paypwd").hide();
            }
        });
        var items = $("select[default]");
        for (i = 0; i < items.length; i++) {
            $(items[i]).val($(items[i]).attr("default") || 0);
        }
        window.onload = $("select[name='type']").change();
    </script>
    <?php
} else {
    ?>
    <div class="block">
        <div class="block-title clearfix">
            <h2>系统共有 <b><?php echo $DB->count('shequ', []); ?></b> 个对接网站
            </h2>
        </div>
        <a href="./shequlist.php?my=add" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;添加一个对接站点</a>&nbsp;<a
                href="./set.php?mod=shequ" class="btn btn-info"><i class="fa fa-cog"></i>&nbsp;其他设置</a>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>网站域名</th>
                    <th>类型</th>
                    <th>用户名</th>
                    <th>密码</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $result = $DB->select('shequ', ['id', 'url', 'username', 'type'], ['ORDER' => ['id' => 'DESC']]);
                foreach ($result as $res) {
                    ?>
                    <tr>
                        <td><b><?php echo $res['id']; ?></b></td>
                        <td>
                            <a href="http://<?php echo $res['url']; ?>" target="_blank"
                               rel="noreferrer"><?php echo $res['url']; ?></a>
                        </td>
                        <td>
                            <?php
                            switch ($res['type']) {
                                case 0:
                                    echo '<span class="text-primary">玖伍系统</span>';
                                    break;
                                case 1:
                                    echo '<span class="text-primary">亿乐系统</span>';
                                    break;
                                case 3:
                                    echo '<span class="text-primary">星墨系统</span>';
                                    break;
                                case 4:
                                    echo '<span class="text-primary">九流社区</span>';
                                    break;
                                case 6:
                                    echo '<span class="text-danger">卡易信</span>';
                                    break;
                                case 7:
                                    echo '<span class="text-danger">卡乐购</span>';
                                    break;
                                case 8:
                                    echo '<span class="text-danger">卡慧卡</span>';
                                    break;
                                case 9:
                                    echo '<span class="text-danger">卡商网</span>';
                                    break;
                                case 10:
                                    echo '<span class="text-primary">QQbug社区</span>';
                                    break;
                                case 11:
                                    echo '<span class="text-primary">聚梦社区</span>';
                                    break;
                                case 12:
                                    echo '<span class="text-warning">同系统对接</span>';
                                    break;
                                default:
                                    echo '<span class="text-muted">未知系统</span>';
                                    break;
                            }
                            ?>
                        </td>
                        <td><?php echo $res['username']; ?></td>
                        <td>******</td>
                        <td>
                            <a href="./shequlist.php?my=edit&id=<?php echo $res['id']; ?>" class="btn btn-info btn-xs">
                                编辑
                            </a>
                            &nbsp;
                            <a href="./shequlist.php?my=delete&id=<?php echo $res['id']; ?>"
                               class="btn btn-xs btn-danger" onclick="return confirm('你确实要删除此记录吗？');">
                                删除
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } ?>
