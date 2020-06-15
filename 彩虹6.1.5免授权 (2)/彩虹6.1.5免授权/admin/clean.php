<?php
/**
 * 系统数据清理
 **/
include("../includes/common.php");
$title = '系统数据清理';
include './head.php';
if ($islogin != 1)
    exit("<script>window.location.href='./login.php';</script>");
?>
<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
    <?php
    $mod = isset($_GET['mod']) ? $_GET['mod'] : null;
    if ($mod == 'cleancache') {
        $CACHE->clear();
        if (function_exists('opcache_reset'))
            @opcache_reset();
        showmsg('清理系统设置缓存成功！', 1);
    } elseif ($mod == 'cleanlog') {
        $DB->query('TRUNCATE TABLE `'.$dbconfig['dbqz'].'_logs`');
        showmsg('清空社区对接日志成功！', 1);
    } elseif ($mod == 'cleanpay') {
        $DB->delete('pay', ['addtime[<]' => date('Y-m-d H:i:s', strtotime('-30 days'))]);
//        $DB->delete('pay', [
//            'AND' => [
//                'addtime[<]' => date('Y-m-d H:i:s', strtotime('-3 hours')),
//                'status'     => 0
//            ]
//        ]);

        $DB->delete('cart', ['addtime[<]' => date('Y-m-d H:i:s', strtotime('-30 days'))]);
        $DB->delete('cart', [
            'AND' => [
                'addtime[<]' => date('Y-m-d H:i:s', strtotime('-12 hours')),
                'status[<]'  => 2
            ]
        ]);
        $DB->query('OPTIMIZE TABLE `'.$dbconfig['dbqz'].'_pay`');
        showmsg('删除30天前支付记录成功！', 1);
    } elseif ($mod == 'cleanorders') {
        $DB->delete('orders', ['addtime[<]' => date('Y-m-d H:i:s', strtotime('-30 days'))]);
        $DB->query('OPTIMIZE TABLE `'.$dbconfig['dbqz'].'_orders`');
        showmsg('删除30天前订单记录成功！', 1);
    } elseif ($mod == 'cleanqiandao') {
        $DB->delete('qiandao', ['time[<]' => date('Y-m-d H:i:s', strtotime('-30 days'))]);
        $DB->query('OPTIMIZE TABLE `'.$dbconfig['dbqz'].'_qiandao`');
        showmsg('删除30天前签到记录成功！', 1);
    } elseif ($mod == 'cleanwork') {
        $DB->delete('workorder', ['addtime[<]' => date('Y-m-d H:i:s', strtotime('-30 days'))]);
        $DB->query('OPTIMIZE TABLE `'.$dbconfig['dbqz'].'_workorder`');
        showmsg('删除30天前工单记录成功！', 1);
    } elseif ($mod == 'cleanpoints') {
        $DB->delete('points', ['addtime[<]' => date('Y-m-d H:i:s', strtotime('-7 days'))]);
        $DB->query('OPTIMIZE TABLE `'.$dbconfig['dbqz'].'_points`');
        showmsg('删除7天前收支明细成功！', 1);
    } elseif ($mod == 'cleangift') {
        $DB->delete('giftlog', ['addtime[<]' => date('Y-m-d H:i:s', strtotime('-1 days'))]);
        $DB->query('OPTIMIZE TABLE `'.$dbconfig['dbqz'].'_giftlog`');
        showmsg('删除1天前中奖记录成功！', 1);
    } elseif ($mod == 'cleaninvite') {
        $DB->delete('invitelog', ['date[<]' => date('Y-m-d H:i:s', strtotime('-1 days'))]);
        $DB->query('OPTIMIZE TABLE `'.$dbconfig['dbqz'].'_invitelog`');
        showmsg('删除1天前推广记录成功！', 1);
    } elseif ($mod == 'cleanpayi' && $_POST['do'] == 'submit') {
        $days  = intval($_POST['days']);
        $money = daddslashes($_POST['money']);
        if ($days <= 0 || $money == null)
            showmsg('请确保每项不能为空', 3);
        $DB->delete('pay', [
            'AND' => [
                'money[<]'   => $money,
                'addtime[<]' => date('Y-m-d H:i:s', strtotime("-{$days} days"))
            ]
        ]);
        $DB->query('OPTIMIZE TABLE `'.$dbconfig['dbqz'].'_pay`');
        showmsg('删除支付记录成功！', 1);
    } elseif ($mod == 'cleanordersi' && $_POST['do'] == 'submit') {
        $days  = intval($_POST['days']);
        $money = daddslashes($_POST['money']);
        if ($days <= 0 || $money == null)
            showmsg('请确保每项不能为空', 3);
        $DB->delete('orders', [
            'AND' => [
                'money[<]' => $money,
                'addtime[<]'  => date('Y-m-d H:i:s', strtotime("-{$days} days"))
            ]
        ]);
        $DB->query('OPTIMIZE TABLE `'.$dbconfig['dbqz'].'_orders`');
        showmsg('删除订单记录成功！', 1);
    } elseif ($mod == 'cleansite' && $_POST['do'] == 'submit') {
        $days  = intval($_POST['days']);
        $money = daddslashes($_POST['money']);
        if ($days <= 0 || $money == null)
            showmsg('请确保每项不能为空', 3);
        $DB->delete('site', [
            'AND' => [
                'rmb[<]'     => $money,
                'addtime[<]' => date('Y-m-d H:i:s', strtotime("-{$days} days")),
                'OR'         => [
                    'lasttime[<]' => date('Y-m-d H:i:s', strtotime("-{$days} days")),
                    'lasttime'    => null
                ]
            ]
        ]);
        $DB->query('OPTIMIZE TABLE `'.$dbconfig['dbqz'].'_pay`');
        showmsg('删除分站记录成功！', 1);
    } elseif ($mod == 'resSetConfig') {
        $res = $DB->select('config', '*', []);
        if (!empty($res) && is_array($res)) {
            $arr  = [];
            $arr2 = [];
            foreach ($res as $k => $v) {
                if (!in_array($v['k'], $arr)) {
                    $arr[]  = $v['k'];
                    $arr2[] = $v;
                }
            }
            $DB->pdo->beginTransaction();
            // 开启事务
            $DB->query("DELETE FROM `{$dbconfig['dbqz']}_config`");
            foreach ($arr2 as $v) {
                $DB->insert('config', [
                    'k' => $v['k'],
                    'v' => $v['v']
                ]);
            }
            $CACHE->clear('config');
            $DB->pdo->commit();
            // 提交事务
            showmsg('重新整理配置数据成功！', 1);
        }
    } else {
        ?>
        <div class="block">
            <div class="block-title"><h3 class="panel-title">系统数据清理</h3></div>
            <div class="">
                <a href="./clean.php?mod=cleancache" class="btn btn-block btn-default">清理设置缓存</a><br/>
                <a href="./clean.php?mod=cleanlog" onclick="return confirm('你确实要清空所有社区对接日志吗？');"
                   class="btn btn-block btn-default">清空社区对接日志</a><br/>
                <a href="./clean.php?mod=cleanpay" onclick="return confirm('你确实要删除30天前的支付记录吗？');"
                   class="btn btn-block btn-default">删除30天前支付记录</a><br/>
                <a href="./clean.php?mod=cleanorders" onclick="return confirm('你确实要删除30天前的订单记录吗？');"
                   class="btn btn-block btn-default">删除30天前订单记录</a><br/>
                <a href="./clean.php?mod=cleanpoints" onclick="return confirm('你确实要删除7天前收支明细吗？');"
                   class="btn btn-block btn-default">删除7天前收支明细</a><br/>
                <a href="./clean.php?mod=cleangift" onclick="return confirm('你确实要删除1天前的中奖记录吗？');"
                   class="btn btn-block btn-default">删除1天前中奖记录</a><br/>
                <a href="./clean.php?mod=cleaninvite" onclick="return confirm('你确实要删除1天前的推广记录吗？');"
                   class="btn btn-block btn-default">删除1天前推广记录</a><br/>
                <a href="./clean.php?mod=cleanqiandao" onclick="return confirm('你确实要删除30天前的签到记录吗？');"
                   class="btn btn-block btn-default">删除30天前签到记录</a><br/>
                <a href="./clean.php?mod=cleanwork" onclick="return confirm('你确实要删除30天前的工单记录吗？');"
                   class="btn btn-block btn-default">删除30天前工单记录</a><br/>
                <a href="./clean.php?mod=resSetConfig" onclick="return confirm('你确实要重新整理配置数据吗？');"
                   class="btn btn-block btn-default">重新整理配置数据</a><br/>
                <h4>自定义清理：</h4>
                <form action="./clean.php?mod=cleanpayi" method="post" role="form">
                    <input type="hidden" name="do" value="submit"/>
                    <b>支付记录</b>：
                    <input type="text" name="days" value="" placeholder="天数"/>天前，小于等于
                    <input type="text" name="money" value="" placeholder="金额"/>元的支付记录&nbsp;
                    <input type="submit" name="submit" value="立即删除" class="btn btn-sm btn-danger"
                           onclick="return confirm('删除后无法恢复，确定继续吗？');"/>
                </form>
                <br/>
                <form action="./clean.php?mod=cleanordersi" method="post" role="form">
                    <input type="hidden" name="do" value="submit"/>
                    <b>订单记录</b>：
                    <input type="text" name="days" value="" placeholder="天数"/>天前，小于等于
                    <input type="text" name="money" value="" placeholder="金额"/>元的订单记录&nbsp;
                    <input type="submit" name="submit" value="立即删除" class="btn btn-sm btn-danger"
                           onclick="return confirm('删除后无法恢复，确定继续吗？');"/>
                </form>
                <br/>
                <form action="./clean.php?mod=cleansite" method="post" role="form">
                    <input type="hidden" name="do" value="submit"/>
                    <b>分站记录</b>：最后登录时间
                    <input type="text" name="days" value="30" placeholder="天数"/>天前，站点余额小于等于
                    <input type="text" name="money" value="0" placeholder="金额"/>元的分站&nbsp;
                    <input type="submit" name="submit" value="立即删除" class="btn btn-sm btn-danger"
                           onclick="return confirm('删除后无法恢复，确定继续吗？');"/>
                </form>
                <br/>
            </div>
            <div class="panel-footer">
                <span class="glyphicon glyphicon-info-sign"></span>
                定期清理数据有助于提升网站访问速度
            </div>
        </div>
    <?php } ?>
</div>
</div>
