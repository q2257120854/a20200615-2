<?php
include '../includes/common.php';
$title = '分站管理';
include './head.php';
if ($islogin != 1) {
    exit('<script>window.location.href="./login.php";</script>');
}

$act = $_GET['my'];
if ($act == 'replaceDomain') {
    $originalDomain = filterParam($_POST['originalDomain'], '');
    $targetDomain   = filterParam($_POST['targetDomain'], '');
    if (empty($originalDomain) || empty($targetDomain))
        showmsg('请求参数不能为空', 3);

    $result = $DB->replace('site', [
        'domain'  => [
            $originalDomain => $targetDomain
        ],
        'domain2' => [
            $originalDomain => $targetDomain
        ]
    ], []);

    if (!$result)
        showmsg('修改失败 => ' . $DB->error(), 3);
    showmsg('成功更替 ' . $result->rowCount() . ' 条数据', 1);
} else if ($act == 'add_submit') {
    echo ' <div class="col-md-12 center-block" style="float: none;">';
    $power   = intval($_POST['power']);
    $user    = filterParam($_POST['user']);
    $pwd     = filterParam($_POST['pwd']);
    $domain  = filterParam($_POST['domain']);
    $rmb     = floatval($_POST['rmb']);
    $qq      = filterParam($_POST['qq']);
    $endtime = filterParam($_POST['endtime']);

    if (empty($user) || empty($pwd) || empty($qq) || empty($domain))
        showmsg('请求信息不能为空', 3);
    if (strlen($qq) > 12)
        showmsg('qq号长度不能超过12位', 3);
    if (strlen($user) > 20)
        showmsg('用户名长度不能超过20位字符', 3);
    if (strlen($pwd) > 32)
        showmsg('密码长度不能超过32位字符', 3);
    $result = $DB->get('site', ['user', 'qq'], [
        'OR'    => [
            'user' => $user,
            'qq'   => $qq
        ],
        'LIMIT' => 1
    ]);
    if (!empty($result)) {
        if ($result['user'] == $user)
            showmsg('新增账户失败，用户名已经存在', 3);
        if ($result['qq'] == $qq)
            showmsg('新增账户失败，qq号已经存在', 3);
    }
    $result = $DB->insert('site', [
        'domain'      => $domain,
        'addtime'     => $date,
        'qq'          => $qq,
        'upzid'       => 0,
        'power'       => $power,
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
    if ($result->rowCount()) {
        showmsg('添加分站成功！<br><br><a href="./sitelist.php">&gt;&gt;返回分站列表</a>', 1);
    } else {
        showmsg('添加分站失败<br>' . $DB->error(), 3);
    }

} else if ($act == 'add') { ?>
    <div class="col-md-12 center-block" style="float: none;">
        <div class="block">
            <div class="block-title"><h3 class="panel-title">添加一个分站</h3></div>
            <div class="">
                <form action="./sitelist.php?my=add_submit" method="POST">
                    <div class="form-group">
                        <label>分站类型:</label><br>
                        <select class="form-control" name="power">
                            <option value="1">普及版</option>
                            <option value="2">专业版</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>管理员用户名:</label><br>
                        <input type="text" class="form-control" name="user" value="" required>
                    </div>
                    <div class="form-group">
                        <label>管理员密码:</label><br>
                        <input type="text" class="form-control" name="pwd" value="123456" required>
                    </div>
                    <div class="form-group">
                        <label>绑定域名:</label><br>
                        <input type="text" class="form-control" name="domain" value="" placeholder="分站要用的域名" required>
                    </div>
                    <div class="form-group">
                        <label>站点余额:</label><br>
                        <input type="text" class="form-control" name="rmb" value="0" required>
                    </div>
                    <div class="form-group">
                        <label>站长QQ:</label><br>
                        <input type="text" class="form-control" name="qq" value="">
                    </div>
                    <div class="form-group">
                        <label>到期时间:</label><br>
                        <input type="date" class="form-control" name="endtime"
                               value="<?php echo date('Y-m-d', strtotime('+1 year')) ?>" required>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="确定添加"></form>
                <br/><a href="./sitelist.php">>>返回分站列表</a></div>
        </div>
    </div>
    <?php
} else if ($act == 'add2_submit') {
    echo '<div class="col-md-12 center-block" style="float: none;">';

    $zid     = intval($_GET['zid']);
    $power   = intval($_POST['power']);
    $domain  = filterParam($_POST['domain']);
    $endTime = filterParam($_POST['endtime']);

    if (empty($zid) || empty($power) || empty($domain) || empty($endTime))
        showmsg('请求信息不能为空');

    $result = $DB->get('site', 'zid', [
        'OR' => [
            'domain'  => $domain,
            'domain2' => $domain
        ]
    ]);
    if (!empty($result))
        showmsg('该域名已经有分站绑定，无法继续操作');

    $result = $DB->update('site', [
        'power'   => $power,
        'endtime' => $endTime,
        'domain'  => $domain,
    ], ['zid' => $zid]);

    if ($result->rowCount() > 0)
        showmsg('开通分站成功！<br><br><a href="./sitelist.php">&gt;&gt;返回分站列表</a>', 1);

    showmsg('开通分站失败<br>' . $DB->error(), 3);
} else if ($act == 'add2') {
    $zid = intval($_GET['zid']);
    if (empty($zid))
        showmsg('请求信息不能为空');

    ?>
    <div class="col-md-12 center-block" style="float: none;">
        <div class="block">
            <div class="block-title"><h3 class="panel-title">添加一个分站</h3></div>
            <div class="">
                <form action="./sitelist.php?my=add2_submit&zid=<?php echo $zid; ?>" method="POST">
                    <div class="form-group">
                        <label>分站类型:</label><br>
                        <select class="form-control" name="power">
                            <option value="1">普及版</option>
                            <option value="2">专业版</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>绑定域名:</label><br>
                        <input type="text" class="form-control" name="domain" value="" placeholder="分站要用的域名"
                               required="">
                    </div>
                    <!--div class="form-group">
                    <label>额外域名:</label><br>
                    <input type="text" class="form-control" name="domain2" placeholder="不需要填写" value="">
                    </div-->
                    <div class="form-group">
                        <label>到期时间:</label><br>
                        <input type="date" class="form-control" name="endtime"
                               value="<?php echo date('Y-m-d', strtotime('+1 year')); ?>" required="">
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="确定添加"></form>
                <br><a href="./sitelist.php">&gt;&gt;返回分站列表</a></div>
        </div>
    </div>
    <?php
} else if ($act == 'edit_submit') {
    echo '<div class="col-md-12 center-block" style="float: none;">';
    $zid = intval($_GET['zid']);
    if (empty($zid))
        showmsg('请求信息不能为空', 3);
    $power       = intval($_POST['power']);
    $domain      = filterParam($_POST['domain']);
    $domain2     = filterParam($_POST['domain2']);
    $rmb         = filterParam($_POST['rmb']);
    $qq          = filterParam($_POST['qq']);
    $sitename    = filterParam($_POST['sitename']);
    $pay_account = filterParam($_POST['pay_account']);
    $pay_name    = filterParam($_POST['pay_name']);
    $endtime     = filterParam($_POST['endtime']);
    $pwd         = filterParam($_POST['pwd']);
    $upzid       = intval($_POST['upzid']);

    $updateData = [
        'upzid'       => $upzid,
        'power'       => $power,
        'endtime'     => $endtime,
        'domain'      => $domain,
        'domain2'     => $domain2,
        'rmb'         => $rmb,
        'qq'          => $qq,
        'sitename'    => $sitename,
        'pay_account' => $pay_account,
        'pay_name'    => $pay_name
    ];

    if (!empty($pwd))
        $updateData['pwd'] = $pwd;

    $result = $DB->update('site', $updateData, ['zid' => $zid]);

    if ($result->rowCount() > 0)
        showmsg('修改分站成功！<br><br><a href="./sitelist.php">&gt;&gt;返回分站列表</a>', 1);
    showmsg('修改分站失败<br>' . empty($DB->error()) ?: $DB->error(), 3);
} else if ($act == 'delete') {
    echo '<div class="col-md-12 center-block" style="float: none;">';
    $zid = intval($_GET['zid']);
    if (empty($zid))
        showmsg('请求信息不能为空', 3);
    $result = $DB->delete('site', ['zid' => $zid, 'LIMIT' => 1]);
    if ($result) {
        log_result('分站管理', 'IP => ' . real_ip() . '<br>UA => ' . $_SERVER['HTTP_USER_AGENT'] . '<br>Url => ' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'], '删除分站[成功]', '1');
        showmsg('删除成功<br><br><a href="./sitelist.php">&gt;&gt;返回分站列表</a>', 1);
    }
    log_result('分站管理', 'IP => ' . real_ip() . '<br>UA => ' . $_SERVER['HTTP_USER_AGENT'] . '<br>Url => ' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'], '删除分站[失败]', '1');
    showmsg('删除失败<br>' . $DB->error(), 3);
} else if ($act == 'edit') {

    $zid = intval($_GET['zid']);
    if (empty($zid))
        showmsg('请求信息不能为空', 3);
    $result = $DB->get('site', ['upzid', 'endtime', 'power', 'domain', 'domain2', 'rmb', 'qq', 'sitename', 'pay_account', 'pay_name', 'endtime'], ['zid' => $zid, 'LIMIT' => 1]);
    if (empty($result))
        showmsg('分站不存在，请重试', 3);
    foreach ($result as $key => $value)
        $$key = $value;
    ?>
    <div class="col-md-12 center-block" style="float: none;">
        <div class="block">
            <div class="block-title">
                <h3 class="panel-title">修改分站信息</h3>
                <span class="pull-right"><a href="./siteprice.php?zid=<?= $zid; ?>"
                                            class="btn btn-default">自定义密价</a></span>
            </div>
            <div class="">
                <form action="./sitelist.php?my=edit_submit&zid=<?php echo $zid; ?>" method="POST">
                    <?php
                    if ($result['power'] != 2) {
                        ?>
                        <div class="form-group">
                            <label>上级分站ID:</label><br>
                            <input type="text" class="form-control" name="upzid" value="<?php echo $upzid; ?>" required>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label>分站类型:</label><br>
                        <select class="form-control" name="power" default="<?php echo $power; ?>">
                            <option value="1">普及版</option>
                            <option value="2">专业版</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>绑定域名:</label><br>
                        <input type="text" class="form-control" name="domain" value="<?php echo $domain; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>额外域名:</label><br>
                        <input type="text" class="form-control" name="domain2" value="<?php echo $domain2; ?>">
                    </div>
                    <div class="form-group">
                        <label>站点余额:</label><br>
                        <input type="text" class="form-control" name="rmb" value="<?php echo $rmb; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>站长QQ:</label><br>
                        <input type="text" class="form-control" name="qq" value="<?php echo htmlspecialchars($qq); ?>">
                    </div>
                    <div class="form-group">
                        <label>站点名称:</label><br>
                        <input type="text" class="form-control" name="sitename"
                               value="<?php echo htmlspecialchars($sitename); ?>">
                    </div>
                    <div class="form-group">
                        <label>结算账号:</label><br>
                        <input type="text" class="form-control" name="pay_account"
                               value="<?php echo htmlspecialchars($pay_account); ?>">
                    </div>
                    <div class="form-group">
                        <label>结算姓名:</label><br>
                        <input type="text" class="form-control" name="pay_name"
                               value="<?php echo htmlspecialchars($pay_name); ?>">
                    </div>
                    <div class="form-group">
                        <label>到期时间:</label><br>
                        <input type="date" class="form-control" name="endtime"
                               value="<?php echo substr($endtime, 0, -9); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>重置密码:</label><br>
                        <input type="text" class="form-control" name="pwd" value="" placeholder="不重置请留空">
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="确定修改"></form>
                <br/><a href="./sitelist.php">>>返回分站列表</a>
                <script>
                    var items = $("select[default]");
                    for (i = 0; i < items.length; i++) {
                        $(items[i]).val($(items[i]).attr("default") || 0);
                    }
                </script>
            </div>
        </div>
    </div>
    <?php
} else if ($act == 'replace') {
    ?>
    <div class="col-md-12 center-block" style="float: none;">
        <div class="block">
            <div class="block-title"><h3 class="panel-title">批量修改域名</h3></div>
            <div class="">
                <div class="alert alert-info">
                    本功能可以批量修改是 子站 的主域名或子域名，例如 原域名-> baidu.com 目标域名 -> taobao.com <br>
                    那么旗下的 <b>*.baidu.com</b> 都会变成 <b>*.taobao.com</b>
                </div>
                <form action="./sitelist.php?my=replaceDomain" method="POST">
                    <div class="form-group">
                        <label>原域名:</label><br>
                        <input type="text" class="form-control" name="originalDomain" placeholder="请输入原域名  例如 baidu.com"
                               required="">
                    </div>
                    <div class="form-group">
                        <label>更替后域名:</label><br>
                        <input type="text" class="form-control" name="targetDomain" placeholder="请输入目标域名 例如 taobao.com"
                               required="">
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="确定修改">
                </form>
                <br>
                <a href="./sitelist.php">&gt;&gt;返回分站列表</a>
            </div>
        </div>
    </div>
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
                    <h4 class="modal-title" id="myModalLabel">搜索分站</h4>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" name="kw" placeholder="请输入分站用户名或域名"><br/>
                    <button type="button" class="btn btn-primary btn-block" id="search_submit">搜索</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" align="left" id="search2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">分类查看</h4>
                </div>
                <div class="modal-body">
                    <select name="power" class="form-control">
                        <option value="1">普及版</option>
                        <option value="2">专业版</option>
                    </select><br/>
                    <button type="button" class="btn btn-primary btn-block" id="search2_submit">查看</button>
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
    <div class="col-md-12 center-block" style="float: none;">
        <div class="block">
            <div class="block-title clearfix">
                <?php
                $result = $DB->count('site', ['power[!]' => 0]);
                ?>
                <h2>系统共有 <b><?php echo $result; ?></b> 个分站</h2>
            </div>
            <a href="./sitelist.php?my=add" class="btn btn-primary">添加分站</a>
            &nbsp;
            <a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">搜索</a>
            &nbsp;
            <a href="#" data-toggle="modal" data-target="#search2" id="search2" class="btn btn-warning">分类查看</a>

            <label class="form-inline" for="tabSort" style="font-weight: normal;">
                按余额
                <select class="form-control" id="tabSort" style="font-weight: normal;">
                    <option value="">请选择</option>
                    <option value="0">正序</option>
                    <option value="1">倒序</option>
                </select>
            </label>
            &nbsp;
            <a href="javascript:listTable('start')" class="btn btn-default" title="刷新分站列表">
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
                history.replaceState({}, null, './sitelist.php');
            } else if (query !== '') {
                history.replaceState({}, null, './sitelist.php?' + query);
            }
            layer.closeAll();
            var ii = layer.load(2, {shade: [0.1, '#fff']});
            $.ajax({
                type: 'GET',
                url: 'sitelist-table.php?' + query,
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

        function setSuper(zid) {
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=setSuper&zid=' + zid,
                dataType: 'json',
                success: function (data) {
                    layer.msg('切换成功');
                    listTable();
                },
                error: function (data) {
                    layer.msg('服务器错误');
                    return false;
                }
            });
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

        function setEndtime(zid) {
            layer.prompt({title: '需要延时多少个月', value: '12', formType: 0}, function (text, index) {
                $.ajax({
                    type: 'POST',
                    url: 'ajax.php?act=setEndtime',
                    data: {zid: zid, month: text},
                    dataType: 'json',
                    success: function (data) {
                        if (data.code === 0) {
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
                if (rmb === '' || rmb === undefined) {
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
                        if (data.code === 0) {
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
                if (kw === '' || kw === undefined) {
                    listTable('start');
                } else {
                    listTable('kw=' + kw);
                }
            });
            $("#search2_submit").click(function () {
                var power = $("select[name='power']").val();
                $("#search2").modal('hide');
                if (parseInt(power) === 0 || power === undefined) {
                    listTable('start');
                } else {
                    listTable('power=' + power);
                }
            });
        });
        $(document).ready(function () {
            listTable();
        })
    </script>
<?php } ?>
