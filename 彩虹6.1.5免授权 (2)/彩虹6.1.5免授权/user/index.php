<?php
require '../includes/common.php';
if ($islogin2 != 1) {
    exit("<script type='application/javascript'>window.location.href='./login.php';</script>");
}
if (isset($_GET['mod']) && $_GET['mod'] == 'faka') {
    $_GET['id'] = isset($_GET['id']) ? $_GET['id'] : 0;
    $_GET['skey'] = isset($_GET['skey']) ? $_GET['skey'] : '';
    exit("<script type='application/javascript'>window.location.href='../?mod=faka&&id={$_GET['id']}&skey={$_GET['skey']}';</script>");
}
$title = '平台首页';
include 'head.php';
?>
<link rel="stylesheet" href="<?php echo $cdnpublic ?>toastr.js/latest/css/toastr.min.css">
<style>
    img.logo {
        width: 14px;
        height: 14px;
        margin: 0 5px 0 3px;
    }

    .span_position {
        display: inline;
        background: red;
        border-radius: 50%;
        width: 10px;
        height: 10px;
        position: absolute
    }
    .msg-head {
        text-align: center;
        min-width: 360px;
        padding: 7px;
        background-color: #f9f9f9 !important;
    }

    .msg-body {
        padding: 15px;
        margin-bottom: 20px;
    }

    .layui-layer-btn0 {
        border-color: #1E9FFF!important;
        background-color: #1E9FFF!important;
        color: #fff!important;
    }
</style>
<div class="wrapper">
    <div class="modal fade" style="text-align: left;" id="userjs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                                class="sr-only">关闭</span>
                    </button>
                    <h4 class="modal-title">在线充值余额</h4>
                </div>
                <div class="modal-body text-center">
                    <b>我当前的账户余额：<span style="font-size:16px; color:#FF6133;"><?php echo $userrow['rmb'] ?></span> 元</b>
                    <hr>
                    <input type="text" class="form-control" name="value" autocomplete="off" placeholder="输入要充值的余额"><br>
                    <?php
                    if ($conf['alipay_api']) echo '<button type="submit" class="btn btn-default" id="buy_alipay"><img src="../assets/icon/alipay.ico" class="logo">支付宝</button>&nbsp;';
                    if ($conf['qqpay_api']) echo '<button type="submit" class="btn btn-default" id="buy_qqpay"><img src="../assets/icon/qqpay.ico" class="logo">QQ钱包</button>&nbsp;';
                    if ($conf['wxpay_api']) echo '<button type="submit" class="btn btn-default" id="buy_wxpay"><img src="../assets/icon/wechat.ico" class="logo">微信支付</button>&nbsp;';
                    ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModa4" id="alink"
                            style="visibility: hidden;"></button>
                    <hr>
                    <div style="border: 1px solid red;padding: 5px;">
                    <small style="color:red;font-weight: bold;">系统提示：<br>
                        本充值仅限于网站消费下单使用，谨防上当受骗！！！</small>
                    </div>
                    <hr>
                    <small style="color:#999;">付款后自动充值，刷新此页面即可查看余额。</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <?php
        if ($userrow['rmb'] > 4) {
            if (strlen($userrow['pwd']) < 6 || is_numeric($userrow['pwd']) && strlen($userrow['pwd']) <= 10 || $userrow['pwd'] === $userrow['qq']) {
                echo '<div class="alert alert-danger"><span class="btn-sm btn-danger">重要</span>&nbsp;你的密码过于简单，请不要使用较短的纯数字或自己的QQ号当做密码，以免造成资金损失！ <a href="uset.php?mod=user">点此修改密码</a></div>';
            } elseif ($userrow['user'] === $userrow['pwd']) {
                echo '<div class="alert alert-danger"><span class="btn-sm btn-danger">重要</span>&nbsp;你的用户名与密码相同，极易被黑客破解，请及时修改密码 <a href="uset.php?mod=user">点此修改密码</a></div>';
            }
        }
        ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading font-bold"
                 style="background: linear-gradient(to right,#14b7ff,#b221ff);padding: 15px;color: white;">
                <div class="widget-content text-right clearfix">
                    <img src="<?php echo $userrow['qq'] ? '//q4.qlogo.cn/headimg_dl?dst_uin=' . $userrow['qq'] . '&spec=100' : '../assets/img/user.png'; ?>"
                         alt="Avatar"
                         width="66" class="img-circle img-thumbnail img-thumbnail-avatar pull-left">
                    <h4><b>余额：<?php echo $userrow['rmb'] ?>元</b></h4>
                    <span class="text-muted">
						<a href="#userjs" data-toggle="modal" class="btn btn-xs btn-success"><b>充值余额</b></a>&nbsp;<a
                                href="tixian.php" class="btn btn-xs btn-info">申请提现</a>
					</span>
                </div>
            </div>
            <table class="table">
                <tbody>
                <tr>
                    <th class="text-center">
                        <span style="color: #a9a9a9;">用户名</span><br><span style="font-size: 18px;"><?php echo $userrow['user'] ?></span>
                    </th>
                    <th class="text-center">
                        <span style="color: #a9a9a9;">UID</span><br><span style="font-size: 18px;"><?php echo $userrow['zid'] ?></span>
                    </th>
                    <th class="text-center">
                        <span style="color: #a9a9a9;">今日收益</span><br><span style="font-size: 18px;" id="income_today">0元</span>
                    </th>
                </tr>
                <tr>
                    <td><a href="<?php echo $userrow['power'] > 0 ? './shop.php' : '../'; ?>"
                           class="btn btn-primary btn-block"><i
                                    class="fa fa-shopping-cart"></i><br/><b><?php echo $userrow['power'] > 0 ? '低价下单' : '自助下单'; ?></b></a>
                    </td>
                    <?php if ($conf['qiandao_reward']) { ?>
                        <td><a href="./qiandao.php" class="btn btn-success btn-block"><i class="fa fa-check-square"></i><br/><b>每日签到</b></a>
                        </td>
                    <?php } else { ?>
                        <td><a href="#userjs" data-toggle="modal" class="btn btn-success btn-block"><i
                                        class="fa fa-money"></i><br/><b>充值余额</b></a></td>
                    <?php } ?>
                    <td><a href="message.php" class="btn btn-primary btn-block"><i class="fa fa-bullhorn"></i><br/><b>站内通知</b><span
                                    id="message_count"></span></a></td>
                </tr>
                <tr>
                    <td><a href="<?php echo $userrow['power'] > 0 ? './shop.php?chadan=1' : '../?chadan=1'; ?>"
                           class="btn btn-info btn-block"><i class="fa fa-search"></i><br/><b>自助查单</b></a></td>
                    <td><a href="./workorder.php" class="btn btn-warning btn-block"><i class="fa fa-check-square-o"></i><br/><b>我的工单</b><span
                                    id="work_count"></span></a></td>
                    <td><a href="record.php" class="btn btn-info btn-block"><i
                                    class="fa fa-hashtag"></i><br/><b>收支明细</b></a></td>
                </tr>
                <?php if ($userrow['power'] > 0) { ?>
                    <tr>
                        <td><a href="shoplist.php" class="btn btn-primary btn-block"><i class="fa fa-list-alt"></i><br/><b>商品管理</b></a>
                        </td>
                        <td><a href="list.php" class="btn btn-info btn-block"><i class="fa fa-list"></i><br/><b>订单记录</b></a>
                        </td>
                        <?php if ($userrow['power'] == 2) { ?>
                            <td><a href="sitelist.php" class="btn btn-primary btn-block"><i
                                            class="fa fa-sitemap"></i><br/><b>分站管理</b></a></td>
                        <?php } else { ?>
                            <td><a href="login.php?logout" class="btn btn-danger btn-block"><i
                                            class="fa fa-sign-out"></i><br/><b>安全退出</b></a></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading font-bold text-center"
                 style="background: linear-gradient(to right,#14b7ff,#b221ff);"><h3 class="panel-title"><span
                            style="color: #fff;"><i class="fa fa-globe"></i>&nbsp;&nbsp;<b>我的站点信息</b></span></h3></div>
            <ul class="list-group no-radius">
                <?php if ($userrow['power'] > 0) { ?>
                    <li class="list-group-item"><b>通知提醒：</b>你当前有<font color="orange"><b id="tiaosu">0</b></font>条信息未阅读<a
                                href="./message.php" class="btn btn-primary btn-xs pull-right">立即查看</a></li>
                    <li style="font-weight:bold" class="list-group-item">我的域名：<a
                                href="http://<?php echo $userrow['domain'] ?>/" target="_blank"
                                rel="noreferrer"><?php echo $userrow['domain'] ?></a><a href="uset.php?mod=site"
                                                                                        class="btn btn-info btn-xs pull-right">编辑信息</a>
                    </li>
                    <?php if ($conf['fanghong_api']) { ?>
                        <li style="font-weight:bold" class="list-group-item">防红链接：<a href="javascript:;" id="copy-btn"
                                                                                     data-clipboard-text="">Loading...</a>&nbsp;&nbsp;&nbsp;<span
                                    class="pull-right"><button class="btn btn-default btn-xs"
                                                               id="recreate_url">重新生成</button>&nbsp;&nbsp;<a
                                        href="javascript:void(0);"
                                        onclick="layer.alert('防红链接：该链接可以在QQ直接打开的您的网站，方便推广！<br />Tips：点击短网址即可复制哦~',{icon: 3,title: '小提示',skin: 'layui-layer-molv layui-layer-wxd'});"
                                        class="btn btn-info btn-xs">说明</a></span></li>
                    <?php } ?>
                    <li style="font-weight:bold" class="list-group-item">网站名称：<font
                                color="blue"><?php echo $userrow['sitename'] ?></font></li>
                    <li style="font-weight:bold" class="list-group-item">
                        站点类型：<?php echo($userrow['power'] == 2 ? '<font color=red>专业版</font>' : '<font color=red>普及版</font>') ?>
                        &nbsp;<?php if ($conf['fenzhan_upgrade'] > 0 && $userrow['power'] == 1) {
                            echo '<a href="upsite.php" class="btn btn-danger btn-xs pull-right">升级站点</a>';
                        } else {
                            echo '<a href="./sitelist.php" class="btn btn-danger btn-xs pull-right">下级管理</a>';
                        } ?></li>
                    <?php if ($conf['fenzhan_expiry'] > 0) { ?>
                        <li style="font-weight:bold" class="list-group-item">到期时间：<font
                                    color="orange"><?php echo $userrow['endtime'] ?></font> <a href="renew.php"
                                                                                               class="btn btn-primary btn-xs pull-right">立即续期</a>
                        </li>
                    <?php } ?>
                    <li style="font-weight:bold" class="list-group-item">
                        当前状态：<?php echo($conf['fenzhan_expiry'] > 0 && $userrow['endtime'] < $date ? '<font color="red">已到期</font>' : '<font color="green">正常运行</font>'); ?></li>
                <?php } else { ?>
                    <li style="font-weight:bold" class="list-group-item">你还未开通分站<br/><a href="regsite.php"
                                                                                        class="btn btn-primary btn-sm btn-block">点此开通分站</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <?php if ($userrow['power'] > 0) { ?>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading font-bold" style="background: linear-gradient(to right,#14b7ff,#b221ff);">
                    <h3 class="panel-title"><font color="#fff"><i
                                    class="fa fa-volume-up"></i>&nbsp;&nbsp;<b>站点公告</b></font></h3>
                </div>
                <?php echo $conf['gg_panel'] ?>
            </div>
        </div>
    <?php } ?>
</div>
</div>
</div>
<script src="<?php echo $cdnpublic ?>layer/2.3/layer.js"></script>
<script src="<?php echo $cdnpublic ?>clipboard.js/1.7.1/clipboard.min.js"></script>
<script src="<?php echo $cdnpublic ?>toastr.js/latest/toastr.min.js"></script>
<script>
    function dopay(type) {
        var value = $("input[name='value']").val();
        if (value == '' || value == 0) {
            layer.alert('充值金额不能为空');
            return false;
        }
        $.get("ajax.php?act=recharge&type=" + type + "&value=" + value, function (data) {
            if (data.code == 0) {
                window.location.href = '../other/submit.php?type=' + type + '&orderid=' + data.trade_no;
            } else {
                layer.alert(data.msg);
            }
        }, 'json');
    }

    function msg_notify_show() {
        $.ajax({
            type: 'GET',
            url: 'ajax.php?act=msg_notify',
            dataType: 'json',
            success: function (data) {
                if (data.code === 1) return false;
                if (data.code === 0) {
                    layer.open({
                        type: 1,
                        skin: 'layui-layer-lan',
                        anim: 2,
                        btn: ['我知道了', '查看更多通知'],
                        btnAlign: 'c',
                        shadeClose: true,
                        title: '系统通知',
                        yes: function (index, layero) {
                            msg_notify_confirm(data.mid);
                            layer.close(index);
                        },
                        btn2: function (index, layero) {
                            location.href = 'message.php';
                            return false;
                        },
                        content: '<div class="msg-head"><h4><b>' + data.title + '</b></h4><small><span style="color: grey">管理员  ' + data.date + '</span></small></div><div class="msg-body">' + data.content + '</div>',
                    });
                }
            }
        });
    }

    function msg_notify_confirm(mid) {
        $.ajax({
            type: 'POST'
            , url: 'ajax.php?act=msg_notify_confirm'
            , data: {'mid': mid}
            , dataType: 'json'
        });
    }

    $(document).ready(function () {
        var clipboard = new Clipboard('#copy-btn');
        clipboard.on('success', function (e) {
            layer.msg('复制成功！', {icon: 1});
        });
        clipboard.on('error', function (e) {
            layer.msg('复制失败，请长按链接后手动复制', {icon: 2});
        });

        $("#buy_alipay").click(function () {
            dopay('alipay')
        });
        $("#buy_qqpay").click(function () {
            dopay('qqpay')
        });
        $("#buy_wxpay").click(function () {
            dopay('wxpay')
        });
        $("#recreate_url").click(function () {
            var self = $(this);
            if (self.attr("data-lock") === "true") return;
            else self.attr("data-lock", "true");
            var ii = layer.load(1, {shade: [0.1, '#fff']});
            $.get("ajax.php?act=create_url&force=1", function (data) {
                layer.close(ii);
                if (data.code == 0) {
                    layer.msg('生成链接成功');
                    $("#copy-btn").html(data.url);
                    $("#copy-btn").attr('data-clipboard-text', data.url);
                } else {
                    layer.alert(data.msg);
                }
                self.attr("data-lock", "false");
            }, 'json');
        });
        if (window.location.hash == '#chongzhi') {
            $("#userjs").modal('show');
        }
        $.ajax({
            type: "GET",
            url: "ajax.php?act=msg",
            dataType: 'json',
            async: true,
            success: function (data) {
                if (data.code == 0) {
                    if (data.count > 0) {
                        $("#tiaosu").text(data.count);
                        $("#message_count").addClass('span_position');
                        toastr.info('<a href="message.php">您有<b>' + data.count + '</b>条新消息，请注意查收！</a>', '消息提醒');
                    }
                    if (data.count2 > 0) {
                        $("#work_count").addClass('span_position');
                        toastr.warning('<a href="workorder.php">您有<b>' + data.count2 + '</b>个工单已被管理员回复！</a>', '工单提醒');
                    }
                    $("#income_today").html(data.income_today + '元');
                }
            }
        });
        $.ajax({
            type: "GET",
            url: "ajax.php?act=create_url",
            dataType: 'json',
            async: true,
            success: function (data) {
                if (data.code == 0) {
                    $("#copy-btn").html(data.url);
                    $("#copy-btn").attr('data-clipboard-text', data.url);
                } else {
                    $("#copy-btn").html(data.msg);
                }
            }
        });
        setTimeout(function () {
            msg_notify_show()
        }, 500);
    });
</script>