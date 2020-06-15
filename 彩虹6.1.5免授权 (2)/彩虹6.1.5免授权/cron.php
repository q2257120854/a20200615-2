<?php
/* 支付接口订单监控文件
 * 说明：用于请求支付接口订单列表，同步未通知到本站的订单，防止漏单。
 * 监控频率建议5分钟一次
 * 监控地址：/cron.php?key=监控密钥
 * 注意：千万不要监控太快或使用多节点监控！！！否则会被支付接口自动屏蔽IP地址
 */
ini_set('error_reporting', 'E_ALL & ~E_NOTICE');
//disable error
if (preg_match('/Baiduspider/', isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : ''))
    exit;
include __DIR__ . '/includes/common.php';

if (function_exists('set_time_limit'))
    @set_time_limit(0);
if (function_exists('ignore_user_abort'))
    @ignore_user_abort(true);

@header('Content-Type: text/html; charset=UTF-8');

if (empty($conf['cronkey']))
    exit("请先设置好监控密钥");
if ($conf['cronkey'] != $_GET['key'])
    exit("监控密钥不正确");

if ($_GET['do'] == 'pricejk') {
    $cron_lasttime = $DB->get('config', 'v', ['k' => 'pricejk_lasttime']);
    $pricejk_time = $conf['pricejk_time'] ? $conf['pricejk_time'] - 50 : 50;
    if (!isset($_GET['test']) && time() - strtotime($cron_lasttime) < $pricejk_time)
        exit('上次更新时间:' . $cron_lasttime);
    saveSetting('pricejk_lasttime', $date);
    $success = 0;
    $is_need = 0;
    $rs = $DB->select('shequ', '*', ['type' => [0, 1, 2, 6, 9, 11, 12], 'ORDER' => ['id' => 'ASC']]);

    foreach ($rs as $res) {
        $tcount = $DB->query("SELECT count(*) as `tcount` FROM `{$dbconfig['dbqz']}_tools` WHERE `is_curl` = 2 AND `shequ` = :shequID AND `cid` IN ({$conf['pricejk_cid']})", [
            ':shequID' => $res['id']
        ])->fetch(PDO::FETCH_ASSOC);
        $tcount = $tcount['tcount'];
        if ($tcount > 0 && $res['username'] && $res['password']) {
            $is_need++;
            if ($res['type'] == 0 || $res['type'] == 2) {
                $results = pricejk_jiuwu($res['id'], $success);
                if ($results === true) {
                    saveSetting('pricejk_status', 'ok');
                } else {
                    saveSetting('pricejk_status', $results);
                    echo '对接站点ID' . $res['id'] . '：' . $results . '<br/>';
                }
            } elseif ($res['type'] == 1) {
                $results = pricejk_yile($res['id'], $success);
                if ($results === true) {
                    saveSetting('pricejk_status', 'ok');
                } else {
                    saveSetting('pricejk_status', $results);
                    echo '对接站点ID' . $res['id'] . '：' . $results . '<br/>';
                }
            } elseif ($res['type'] == 9) {
                $results = pricejk_kashangwl($res['id'], $success);
                if ($results === true) {
                    saveSetting('pricejk_status', 'ok');
                } else {
                    saveSetting('pricejk_status', $results);
                    echo '对接站点ID' . $res['id'] . '：' . $results . '<br/>';
                }
            } elseif ($res['type'] == 11) {
                $results = pricejk_jumeng($res['id'], $success);
                if ($results === true) {
                    saveSetting('pricejk_status', 'ok');
                } else {
                    saveSetting('pricejk_status', $results);
                    echo '对接站点ID' . $res['id'] . '：' . $results . '<br/>';
                }
            } elseif ($res['type'] == 12) {
                $results = pricejk_this($res['id'], $success);
                if ($results === true) {
                    saveSetting('pricejk_status', 'ok');
                } else {
                    saveSetting('pricejk_status', $results);
                    echo '对接站点ID' . $res['id'] . '：' . $results . '<br/>';
                }
            } else if ($res['type'] == 6) {
                $results = pricejk_kyx($res['id'], $success);
                if ($results === true) {
                    saveSetting('pricejk_status', 'ok');
                } else {
                    saveSetting('pricejk_status', $results);
                    echo '对接站点ID' . $res['id'] . '：' . $results . '<br/>';
                }
            }
        }
    }
    $CACHE->update();
    if ($is_need == 0) {
        exit('没有需要监控价格的商品');
    } else {
        exit('成功更新' . $success . '个商品的价格');
    }
} elseif ($_GET['do'] == 'rank') {
    if (!$conf['rank_reward'])
        exit('当前站点未开启分站排行榜奖励');
    $limit = intval($conf['rank_reward']);
    $cron_lasttime = $DB->get('config', 'v', ['k' => 'cron_rank_time']);
    if (strtotime($cron_lasttime) >= strtotime(date("Y-m-d") . ' 00:00:00'))
        exit('今日发放任务已完成');

    saveSetting('cron_rank_time', $date);
    //调整优先级
    $re = $DB->query("SELECT `a`.`zid`, SUM(`money`) AS `money` FROM `{$dbconfig['dbqz']}_orders` AS `a` WHERE (TO_DAYS(NOW()) - TO_DAYS(`addtime`) = 1) AND `zid` > 1 GROUP BY `zid` HAVING `money` > 0 ORDER BY `money` DESC LIMIT {$limit}")->fetchAll(PDO::FETCH_ASSOC);
    $allmoney = 0;
    $count = 0;
    foreach ($re as $site) {
        $reward = round($site['money'] * $conf['rank_percentage'] / 100, 2);
        if ($reward > 0) {
            $allmoney += $reward;
            $count++;
            $DB->update('site', ['rmb[+]' => $reward], ['zid' => $site['zid']]);
            addPointRecord($site['zid'], $reward, '赠送', '网站昨日销量排行前' . $limit . '名奖励' . $reward . '元');
        }
    }
    saveSetting('cron_rank_money', $allmoney);
    $CACHE->update();
    exit('奖励发放完成，发放站点数量：' . $count . '&nbsp;总金额：' . $allmoney . '元');
} elseif ($_GET['do'] == 'daily') {
    $cron_lasttime = $DB->get('config', 'v', ['k' => 'daily_lasttime']);
    if (time() - strtotime($cron_lasttime) < 3600 * 12)
        exit('日常维护任务今天已执行过');
    saveSetting('daily_lasttime', $date);
    $sql1 = $DB->delete('pay', ['addtime[<]' => date('Y-m-d H:i:s', strtotime("-30 days"))]);
    $sq1 = $sql1->rowCount();
//    $sql2 = $DB->delete('pay', ['AND' => ['addtime[<]' => date("Y-m-d H:i:s", strtotime("-3 hours")), 'OR' => ['status' => 0, 'money' => 0]]]);
//    $sq2  = $sql2->rowCount()0;
    $sql2 = 0;
    $sql3 = $DB->delete('cart', ['addtime[<]' => date("Y-m-d H:i:s", strtotime("-30 days"))]);
    $sq3 = $sql3->rowCount();
    $sql4 = $DB->delete('cart', ['AND' => ['addtime[<]' => date("Y-m-d H:i:s", strtotime("-24 hours")), 'status[<]' => 2]]);
    $sq4 = $sql4->rowCount();
    $DB->query("OPTIMIZE TABLE `{$dbconfig['dbqz']}_pay`");
    $sql5 = $DB->delete('giftlog', ['addtime[<]' => date("Y-m-d H:i:s", strtotime("-7 days"))]);
    $sq5 = $sql5->rowCount();
    $DB->query("OPTIMIZE TABLE `{$dbconfig['dbqz']}_giftlog`");
    $sql6 = $DB->delete('invitelog', ['date[<]' => date("Y-m-d H:i:s", strtotime("-7 days"))]);
    $sq6 = $sql6->rowCount();
    $DB->query("OPTIMIZE TABLE `{$dbconfig['dbqz']}_invitelog`");
    $count = $sq1 + $sq2 + $sq3 + $sq4 + $sq5 + $sq6;
    $CACHE->update();
    exit('日常维护任务已成功执行，本次共清理' . $count . '条数据');
} elseif ($conf['epay_pid'] && $conf['epay_key']) {
    $cron_lasttime = $DB->get('config', 'v', ['k' => 'cron_lasttime']);
    if (time() - strtotime($cron_lasttime) < 30)
        exit('ok');
    $trade_no = date("YmdHis", strtotime($cron_lasttime)) . '000';
    $limit = $DB->count('pay', ['trade_no[>]' => $trade_no]);
    if ($limit < 1)
        exit('ok');
    if ($limit > 50)
        $limit = 50;
    saveSetting('cron_lasttime', $date);
    $CACHE->update();
    $payapi = pay_api();
    $data = get_curl($payapi . 'api.php?act=orders&limit=' . $limit . '&pid=' . $conf['epay_pid'] . '&key=' . $conf['epay_key']);
    $arr = json_decode($data, true);
    if ($arr['code'] == 1) {
        foreach ($arr['data'] as $row) {
            if ($row['status'] == 1) {
                $out_trade_no = $row['out_trade_no'];
                $srow = $DB->query("SELECT * FROM `{$dbconfig['dbqz']}_pay` WHERE `trade_no` = '{$out_trade_no}' FOR UPDATE")->fetch(PDO::FETCH_ASSOC);
                if ($srow && $srow['status'] == 0 && !empty($srow['type'])) { // 疑似
                    $DB->update('pay', ['status' => 1, 'endtime' => $date], ['trade_no' => $out_trade_no, 'LIMIT' => 1]);
                    processOrder($srow);
                    echo '已成功补单:' . $out_trade_no . '<br/>';
                }
            }
        }
        exit('ok');
    } else {
        exit($arr['msg']);
    }
} else {
    exit('未配置易支付信息');
}
