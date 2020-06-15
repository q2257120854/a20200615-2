<?php
include '../includes/common.php';
if ($islogin != 1) {
    exit("<script>window.location.href='./login.php';</script>");
}
$act = isset($_GET['act']) ? daddslashes($_GET['act']) : null;

@header('Content-Type: application/json; charset=UTF-8');

switch ($act) {
    case 'getcount':
        $result   = $CACHE->read('adminDashboardData');
        $isUpdate = false;
        if (!empty($result)) {
            $result = unserialize($result);
            if ((time() - $result['createTime']) > 60)
                $isUpdate = true;
            else
                $result = $result['data'];
        } else {
            $isUpdate = true;
        }

        if ($isUpdate) {
            $thtime = date('Y-m-d') . ' 00:00:00';
            $count1 = $DB->count('orders');
            $count2 = $DB->count('orders', ['status' => 1]);
            $count3 = $DB->count('orders', ['status' => 0]);
            $count4 = $DB->count('orders', ['addtime[>=]' => $thtime]);
            $count5 = $DB->sum('pay', 'money', [
                'AND' => [
                    'tid[!]'      => -1,
                    'addtime[>=]' => $thtime,
                    'status'      => 1
                ]
            ]);

            $strtotime = strtotime($conf['build']);//获取开始统计的日期的时间戳
            $now       = time();//当前的时间戳
            $yxts      = ceil(($now - $strtotime) / 86400);//取相差值然后除于24小时(86400秒)

            $count6 = $DB->count('site');
            $count7 = $DB->count('site', ['addtime[>=]' => $thtime]);

            $count8 = $DB->sum('points', 'point', [
                'action'      => '提成',
                'addtime[>=]' => $thtime
            ]);

            $count11 = $DB->sum('tixian', 'realmoney', ['status' => 0]);

            $count12 = $DB->sum('pay', 'money', [
                'AND' => [
                    'type'        => 'qqpay',
                    'addtime[>=]' => $thtime,
                    'status'      => 1
                ]
            ]);

            $count13 = $DB->sum('pay', 'money', [
                'AND' => [
                    'type'        => 'wxpay',
                    'addtime[>=]' => $thtime,
                    'status'      => 1
                ]
            ]);

            $count14 = $DB->sum('pay', 'money', [
                'AND' => [
                    'type'        => 'alipay',
                    'addtime[>=]' => $thtime,
                    'status'      => 1
                ]
            ]);

            // 统计今天、昨天的分站总余额
            $today_total     = $CACHE->read('today_total');
            $today_total     = empty($today_total) ? '' : unserialize($today_total);
            $yesterday_total = $CACHE->read('yesterday_total');
            $yesterday_total = empty($yesterday_total) ? '' : unserialize($yesterday_total);
            if (empty($today_total)) { // 今天的未统计
                $total_money = $DB->sum('site', 'rmb');
                $today_total = ['value' => $total_money, 'create_time' => time(), 'update_time' => 0];
                $CACHE->save('today_total', $today_total);
            } else {
                // 更新数据
                $total_money = $DB->sum('site', 'rmb');
                $today_total = ['value' => $total_money, 'create_time' => $today_total['create_time'], 'update_time' => time()];
                $CACHE->save('today_total', $today_total);
            }
            // 统计数据不是当天，将数据移动到昨天统计
            if (date('Ymd', $today_total['create_time']) < date('Ymd')) {
                $CACHE->clear('today_total'); // 清除昨天统计
                $CACHE->save('yesterday_total', $today_total);
            }
            $result = [
                "code"            => 0, "yxts" => $yxts, "count1" => $count1, "count2" => $count2, "count3" => $count3,
                "count4"          => $count4, "count5" => round($count5, 2), "count6" => $count6, "count7" => $count7,
                "count8"          => round($count8, 2), "count11" => round($count11, 2),
                "count12"         => round($count12, 2), "count13" => round($count13, 2),
                "count14"         => round($count14, 2), "chart" => getDatePoint(),
                'today_total'     => isset($today_total['value']) ? round($today_total['value'], 2) : 0.00,
                'yesterday_total' => isset($yesterday_total['value']) ? round($yesterday_total['value'], 2) : 0.00,
            ];

            $CACHE->save('adminDashboardData', serialize(['createTime' => time(), 'data' => $result]));
        }
        exit(json_encode($result));
        break;
    case 'qdcount':
        $day     = date("Y-m-d");
        $lastday = date("Y-m-d", strtotime("-1 day"));

        $count1 = $DB->count('qiandao', ['date' => $day]);
        $count2 = $DB->count('qiandao', ['date' => $lastday]);
        $count3 = $DB->count('qiandao');
        $count4 = $DB->sum('qiandao', 'reward', ['date' => $day]);
        $count5 = $DB->sum('qiandao', 'reward', ['date' => $lastday]);
        $count6 = $DB->sum('qiandao', 'reward');

        $result = array("count1" => $count1, "count2" => $count2, "count3" => $count3, "count4" => round($count4, 2), "count5" => round($count5, 2), "count6" => round($count6, 2));
        exit(json_encode($result));
        break;
    case 'tool':
        $tid_list = empty($_POST['tid']) ? 0 : explode(',', $_POST['tid']);
        $list     = $DB->select('tools', ['tid', 'name'], ['tid' => $tid_list]);
        $result   = ['code' => -1, 'msg' => '商品ID不存在'];
        if (empty($list))
            exitJson('商品ID不存在');
        exitJson('success', 0, $list);
        break;
    case 'addClass':
        $name = $_POST['name'];
        if ($name == null)
            exit('{"code":-1,"msg":"分类名不能为空"}');
        $rows = $DB->has('class', ['name' => $name]);
        if ($rows)
            exit('{"code":-1,"msg":"当前分类名称已存在"}');
        $insertResult = $DB->insert('class', ['name' => $name, 'active' => 1]);
        if ($insertResult->rowCount()) {
            $cid = $DB->id();
            $DB->update('class', ['sort' => $cid], ['cid' => $cid]);
            exit('{"code":0,"msg":"添加分类成功！"}');
        } else {
            exit('{"code":-1,"msg":"添加分类失败！' . $DB->error() . '"}');
        }
        break;
    case 'editClass':
        $cid  = intval($_GET['cid']);
        $rows = $DB->has('class', ['cid' => $cid]);
        if (!$rows) exitJson('分类不存在');
        $name = $_POST['name'];
        if ($name == null) exitJson('分类名不能为空');
        if ($DB->update('class', ['name' => $name], ['cid' => $cid])->rowCount() > 0) {
            exitJson('修改分类成功', 0);
        } else {
            exitJson('无任何变更', -1);
        }
        break;
    case 'delClass':
        $cid = intval($_GET['cid']);
        $DB->delete('tools', ['cid' => $cid]);
        if ($DB->delete('class', ['cid' => $cid])->rowCount())
            exit('{"code":0,"msg":"删除分类成功！"}');
        else
            exit('{"code":-1,"msg":"删除分类失败！' . $DB->error() . '"}');
        break;
    case 'editClassAll':
        $ok = 0;
        foreach ($_POST as $k => $v) {
            if (substr($k, 0, 4) == 'name') {
                $cid = intval(substr($k, 4));
                if ($cid == 0) continue;
                if ($DB->update('class', ['name' => $v], ['cid' => $cid])->rowCount() > 0)
                    $ok++;
            }
        }
        exit(json_encode(['code' => 0, 'msg' => '保存成功', 'ok_num' => $ok]));
        break;
    case 'editClassImages':
        foreach ($_POST as $k => $v) {
            if (substr($k, 0, 3) == 'img') {
                $cid = intval(substr($k, 3));
                $DB->update('class', ['shopimg' => $v], ['cid' => $cid]);
            }
        }
        exit('{"code":0,"msg":"修改分类成功！"}');
        break;
    case 'getClassImage':
        $cid  = intval($_GET['cid']);
        $rows = $DB->get('tools', ['shopimg'], [
            'AND' => [
                'cid'        => $cid,
                'shopimg[!]' => null
            ]
        ]);
        if (!$rows)
            exit('{"code":-1,"msg":"分类不存在"}');
        exit('{"code":0,"msg":"succ","url":"' . $rows['shopimg'] . '"}');
        break;
    case 'uploadimg':
        if ($_POST['do'] == 'upload') {
            $type     = $_POST['type'];
            $filename = $type . '_' . md5_file($_FILES['file']['tmp_name']);
            $path     = 'assets/img/Product/';
            $file_url = $path . $filename . '.png';
            $res      = imageUpload('file', $path, $filename, 'png');
            if (0 == $res['code']) {
                exit(json(['code' => 0, 'msg' => 'success', 'url' => $file_url]));
            } else {
                exitJson('上传失败，请确保有本地写入权限');
            }
        }
        exit(json(['code' => -1, 'msg' => null]));
        break;
    case 'getTool':
        $tid  = intval($_GET['tid']);
        $rows = $DB->get('tools', '*', ['tid' => $tid]);
        if (!$rows)
            exit('{"code":-1,"msg":"商品不存在"}');
        $rows['link'] = 'http://' . $_SERVER['HTTP_HOST'] . '/?cid=' . $rows['cid'] . '&tid=' . $rows['tid'];
        $result       = array("code" => 0, "msg" => "succ", "data" => $rows);
        exit(json_encode($result));
        break;
    case 'getPrice':
        $tid  = intval($_GET['tid']);
        $rows = $DB->get('tools', '*', ['tid' => $tid]);
        if (!$rows)
            exit('{"code":-1,"msg":"商品不存在"}');
        if (!empty($_SESSION['priceselect'])) {
            $priceselect = $_SESSION['priceselect'];
        } else {
            $rs          = $DB->select('price', '*', [
                'ORDER' => [
                    'id' => 'ASC'
                ]
            ]);
            $priceselect = '<option value="0">不使用加价模板</option>';
            foreach ($rs as $res) {
                $kind        = $res['kind'] == 1 ? '元' : '倍';
                $priceselect .= '<option value="' . $res['id'] . '" kind="' . $res['kind'] . '" p_2="' . $res['p_2'] . '" p_1="' . $res['p_1'] . '" p_0="' . $res['p_0'] . '" >' . $res['name'] . '(' . $res['p_0'] . $kind . '|' . $res['p_1'] . $kind . '|' . $res['p_2'] . $kind . ')</option>';
            }
        }
        $data   = '<div class="form-group"><div class="input-group"><div class="input-group-addon">成本价格</div><input type="text" id="price" value="' . $rows['price'] . '" class="form-control" required onkeyup="changePrice()" disabled/></div></div>
	<div class="form-group"><div class="input-group"><div class="input-group-addon">加价模板</div><select class="form-control" id="prid" onchange="changePrice()">' . $priceselect . '</select></div></div>
<table class="table table-striped table-bordered table-condensed">
<tbody>
<tr align="center"><td>销售价格</td><td>普及版价格</td><td>专业版价格</td></tr>
<tr>
<td><input type="text" id="price_s" value="' . $rows['price'] . '" class="form-control input-sm" disabled/></td>
<td><input type="text" id="cost_s" value="' . $rows['cost'] . '" class="form-control input-sm" disabled/></td>
<td><input type="text" id="cost2_s" value="' . $rows['cost2'] . '" class="form-control input-sm" disabled/></td>
</tr>
</table>
	<input type="submit" id="save" onclick="editPrice(' . $tid . ')" class="btn btn-primary btn-block" value="保存">
	<script>$("#prid").val(' . $rows['prid'] . ');</script>';
        $result = array("code" => 0, "msg" => "succ", "data" => $data);
        exit(json_encode($result));
        break;
    case
    'editPrice':
        $tid  = intval($_POST['tid']);
        $rows = $DB->has('tools', ['tid' => $tid]);
        if (!$rows)
            exit('{"code":-1,"msg":"商品不存在"}');
        $prid = intval($_POST['prid']);
        if ($prid == 0) {
            $price = $_POST['price_s'];
            $cost  = $_POST['cost_s'];
            $cost2 = $_POST['cost2_s'];
        } else {
            $price = $_POST['price'];
            $cost  = 0;
            $cost2 = 0;
        }
        $updateResult = $DB->update('tools', ['price' => $price, 'cost' => $cost, 'cost2' => $cost2, 'prid' => $prid], ['tid' => $tid, 'LIMIT' => 1]);
        if ($updateResult->errorCode() === '00000')
            exit('{"code":0,"msg":"succ"}');
        else
            exit('{"code":-1,"msg":"修改商品失败！' . $DB->error() . '"}');
        break;
    case 'getAllPrice':
        if ($_SESSION['priceselect']) {
            $priceselect = $_SESSION['priceselect'];
        } else {
            $priceList   = $DB->select('price', '*', [
                'ORDER' => [
                    'id' => 'ASC'
                ]
            ]);
            $priceselect = '<option value="0">不使用加价模板</option>';
            foreach ($priceList as $res) {
                $kind        = $res['kind'] == 1 ? '元' : '倍';
                $priceselect .= '<option value="' . $res['id'] . '" kind="' . $res['kind'] . '" p_2="' . $res['p_2'] . '" p_1="' . $res['p_1'] . '" p_0="' . $res['p_0'] . '" >' . $res['name'] . '(' . $res['p_2'] . $kind . '|' . $res['p_1'] . $kind . '|' . $res['p_0'] . $kind . ')</option>';
            }
        }
        $data   = '<div class="form-group"><div class="input-group"><select class="form-control" name="prid_n">' . $priceselect . '</select></div></div>
	<input type="submit" id="save" onclick="editAllPrice()" class="btn btn-primary btn-block" value="保存">';
        $result = array("code" => 0, "msg" => "succ", "data" => $data);
        exit(json_encode($result));
        break;
    case 'editAllPrice':
        $prid     = intval($_POST['prid']);
        $checkbox = $_POST['checkbox'];
        $i        = 0;
        foreach ($checkbox as $tid) {
            $DB->update('tools', [
                'prid'  => $prid,
                'cost'  => 0,
                'cost2' => 0
            ], [
                'tid' => $tid
            ]);
            $i++;
        }
        exit('{"code":0,"msg":"成功改变' . $i . '个商品"}');
        break;
    case 'shop_move':
        $cid = intval($_POST['cid']);
        if (!$cid) exit('{"code":-1,"msg":"请选择分类"}');
        $checkbox = $_POST['checkbox'];
        $i        = 0;
        foreach ($checkbox as $tid) {
            if ($DB->update('tools', ['cid' => $cid], ['tid' => $tid])->rowCount() > 0)
                $i++;
        }
        exit('{"code":0,"msg":"成功移动' . $i . '个商品"}');
        break;
    case 'shop_change':
        $aid      = $_POST['aid'];
        $checkbox = $_POST['checkbox'];
        $i        = 0;
        foreach ($checkbox as $tid) {
            $tid = intval($tid);
            if ($aid == 1) {
                $flag = $DB->update('tools', ['active' => 1], ['tid' => $tid, 'LIMIT' => 1]);
            } elseif ($aid == 2) {
                $flag = $DB->update('tools', ['active' => 0], ['tid' => $tid, 'LIMIT' => 1]);
            } elseif ($aid == 3) {
                $flag = $DB->update('tools', ['close' => 0], ['tid' => $tid, 'LIMIT' => 1]);
            } elseif ($aid == 4) {
                $flag = $DB->update('tools', ['close' => 1], ['tid' => $tid, 'LIMIT' => 1]);
            } elseif ($aid == 5) {
                $flag = $DB->delete('tools', ['tid' => $tid, 'LIMIT' => 1]);
            } elseif ($aid == 6) {
                $flag = $DB->query("insert into `{$dbconfig['dbqz']}_tools` (`cid`,`name`,`price`,`prid`,`cost`,`cost2`,`input`,`inputs`,`alert`,`desc`,`value`,`is_curl`,`curl`,`shequ`,`goods_id`,`goods_type`,`goods_param`,`repeat`,`multi`,`sort`,`active`) select `cid`,`name`,`price`,`prid`,`cost`,`cost2`,`input`,`inputs`,`alert`,`desc`,`value`,`is_curl`,`curl`,`shequ`,`goods_id`,`goods_type`,`goods_param`,`repeat`,`multi`,`sort`,`active` from `{$dbconfig['dbqz']}_tools` where `tid` = '$tid'");
            }
            if ($flag->rowCount() > 0)
                $i++;
        }
        exit('{"code":0,"msg":"成功改变' . $i . '个商品"}');
        break;
    case 'delTool':
        $tid = intval($_GET['tid']);
        if ($DB->delete('tools', ['tid' => $tid, 'LIMIT' => 1])->rowCount()) {
            log_result('商品管理', 'IP => ' . real_ip() . '<br>UA => ' . $_SERVER['HTTP_USER_AGENT'] . '<br>Url => ' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'], '删除商品[成功]', '1');
            exit('{"code":0,"msg":"删除商品成功！"}');
        } else {
            log_result('商品管理', 'IP => ' . real_ip() . '<br>UA => ' . $_SERVER['HTTP_USER_AGENT'] . '<br>Url => ' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'], '删除商品[失败]', '1');
            exit('{"code":-1,"msg":"删除商品失败！' . $DB->error() . '"}');
        }
        break;
    case 'setiprice':
        $zid   = intval($_POST['zid']);
        $tid   = intval($_POST['tid']);
        $price = round(trim($_POST['iprice']), 2);
        if (!is_numeric($price) || !preg_match('/^[0-9.]+$/', $price)) exit('{"code":-1,"msg":"价格输入不规范"}');

        $price_obj = new Price($zid);
        if ($price_obj->setiPriceInfo($tid, $price))
            exit('{"code":0,"msg":"succ"}');
        else
            exit('{"code":-1,"msg":"修改失败！' . $DB->error() . '"}');
        break;
    case 'cleariprice':
        $zid = intval($_POST['zid']);
        if ($DB->update('site', ['iprice' => null], ['zid' => $zid, 'LIMIT' => 1])->rowCount() > 0)
            exit('{"code":0,"msg":"succ"}');
        else
            exit('{"code":-1,"msg":"清空失败！' . $DB->error() . '"}');
        break;
    case 'setStatus':
        $id     = intval($_GET['name']);
        $status = intval($_GET['status']);
        if ($status == 5) {
            if ($DB->delete('orders', ['id' => $id, 'LIMIT' => 1])->rowCount())
                exit('{"code":200}');
            else
                exit('{"code":400,"msg":"删除订单失败！' . $DB->error() . '"}');
        } else {
            if ($DB->update('orders', ['status' => $status, 'result' => null], ['id' => $id, 'LIMIT' => 1])->rowCount() > 0)
                exit('{"code":200}');
            else
                exit('{"code":400,"msg":"修改订单失败！' . $DB->error() . '"}');
        }
        break;
    case 'order':
        $id   = intval($_GET['id']);
        $rows = $DB->get('orders', '*', ['id' => $id]);
        if (!$rows)
            exit('{"code":-1,"msg":"当前订单不存在！"}');
        $tool = $DB->get('tools', '*', ['tid' => $rows['tid'], 'LIMIT' => 1]);
        if (strpos($rows['tradeno'], 'kid') !== false) {
            $kid           = explode(':', $rows['tradeno']);
            $kid           = $kid[1];
            $trade         = $DB->get('kms', '*', ['kid' => $kid, 'LIMIT' => 1]);
            $trade['type'] = '卡密';
            $addstr        = '<li class="list-group-item"><b>使用卡密：</b>' . $trade['km'] . '</li>';
        } elseif (strpos($rows['tradeno'], 'invite') !== false) {
            $trade['type'] = '推广赠送';
        } elseif (!empty($rows['tradeno'])) {
            $trade  = $DB->get('pay', '*', ['trade_no' => $rows['tradeno'], 'LIMIT' => 1]);
            $addstr = '<li class="list-group-item"><b>支付订单号：</b>' . $trade['trade_no'] . '</li><li class="list-group-item"><b>支付金额：</b>' . $trade['money'] . ($trade['tid'] == -3 ? '（' . $trade['num'] . '件商品）' : null) . '</li><li class="list-group-item"><b>支付IP：</b><a href="http://m.ip138.com/ip.asp?ip=' . $trade['ip'] . '" target="_blank">' . $trade['ip'] . '</a></li>';
            if ($trade['type'] == 'rmb')
                $addstr .= '<li class="list-group-item"><b>支付用户ID：</b>' . (is_numeric($rows['userid']) && $rows['userid'] != $rows['zid'] ? '<a href ="userlist.php?zid=' . $rows['userid'] . '" target="_blank">' . $rows['userid'] . '</a>' : '<a href ="sitelist.php?zid=' . $rows['zid'] . '" target="_blank">' . $rows['zid'] . '</a>') . '</li>';
        } else {
            $trade['type'] = '默认';
        }
        $rows['input'] = htmlspecialchars($rows['input']);
        $rows['input2'] = htmlspecialchars($rows['input2']);
        $rows['input3'] = htmlspecialchars($rows['input3']);
        $rows['input4'] = htmlspecialchars($rows['input4']);
        $rows['input5'] = htmlspecialchars($rows['input5']);

        $input  = $tool['input'] ? $tool['input'] : '下单QQ';
        $inputs = explode('|', $tool['inputs']);
        $value  = $tool['value'] > 0 ? $tool['value'] : 1;
        $data   = '<li class="list-group-item"><b>商品名称：</b>' . $tool['name'] . '</li><li class="list-group-item" style="word-break:break-all;"><b>下单数据：</b><br/>' . $input . '：' . $rows['input'] . ($rows['input2'] ? '<br/>' . $inputs[0] . '：' . $rows['input2'] : null) . ($rows['input3'] ? '<br/>' . $inputs[1] . '：' . $rows['input3'] : null) . ($rows['input4'] ? '<br/>' . $inputs[2] . '：' . $rows['input4'] : null) . ($rows['input5'] ? '<br/>' . $inputs[3] . '：' . $rows['input5'] : null) . '</li><li class="list-group-item"><b>下单数量：</b>' . ($rows['value'] * $value) . '</li><li class="list-group-item"><b>站点ID：</b>' . $rows['zid'] . '</li><li class="list-group-item"><b>下单时间：</b>' . $rows['addtime'] . '</li><li class="list-group-item"><b>购买方式：</b>' . $trade['type'] . '</li>' . $addstr;
        $result = array("code" => 0, "msg" => "succ", "data" => $data);
        exit(json_encode($result));
        break;
    case 'order2':
        $id   = intval($_GET['id']);
        $rows = $DB->get('orders', '*', ['id' => $id, 'LIMIT' => 1]);
        if (!$rows)
            exit('{"code":-1,"msg":"当前订单不存在！"}');
        $tool   = $DB->get('tools', '*', ['tid' => $rows['tid'], 'LIMIT' => 1]);
        $input  = $tool['input'] ? $tool['input'] : '下单ＱＱ';
        $inputs = explode('|', $tool['inputs']);


        $rows['input'] = htmlspecialchars($rows['input']);
        $rows['input2'] = htmlspecialchars($rows['input2']);
        $rows['input3'] = htmlspecialchars($rows['input3']);
        $rows['input4'] = htmlspecialchars($rows['input4']);
        $rows['input5'] = htmlspecialchars($rows['input5']);

        $data   = '<div class="form-group"><div class="input-group"><div class="input-group-addon" id="inputname">' . $input . '</div><input type="text" id="inputvalue" value="' . $rows['input'] . '" class="form-control" required/></div></div>';

        if (!empty($inputs)) {
            foreach ($inputs as $key => $content) {
                $content = explode('{', $content);
                if (count($content) == 2)
                    $inputs[$key] = $content[0];
            }
        }

        //这里负责处理可能存在的输入框显示问题

        if ($inputs[0]) $data .= '<div class="form-group"><div class="input-group"><div class="input-group-addon" id="inputname2">' . $inputs[0] . '</div><input type="text" id="inputvalue2" value="' . $rows['input2'] . '" class="form-control" required/></div></div>';
        if ($inputs[1]) $data .= '<div class="form-group"><div class="input-group"><div class="input-group-addon" id="inputname3">' . $inputs[1] . '</div><input type="text" id="inputvalue3" value="' . $rows['input3'] . '" class="form-control" required/></div></div>';
        if ($inputs[2]) $data .= '<div class="form-group"><div class="input-group"><div class="input-group-addon" id="inputname4">' . $inputs[2] . '</div><input type="text" id="inputvalue4" value="' . $rows['input4'] . '" class="form-control" required/></div></div>';
        if ($inputs[3]) $data .= '<div class="form-group"><div class="input-group"><div class="input-group-addon" id="inputname5">' . $inputs[3] . '</div><input type="text" id="inputvalue5" value="' . $rows['input5'] . '" class="form-control" required/></div></div>';
        $data   .= '<input type="submit" id="save" onclick="saveOrder(' . $id . ')" class="btn btn-primary btn-block" value="保存">';
        $result = array("code" => 0, "msg" => "succ", "data" => $data);
        exit(json_encode($result));
        break;
    case 'order3':
        $id   = intval($_GET['id']);
        $rows = $DB->get('orders', ['value'], ['id' => $id, 'LIMIT' => 1]);
        if (!$rows)
            exit('{"code":-1,"msg":"当前订单不存在！"}');
        $data   = '<div class="form-group"><div class="input-group"><div class="input-group-addon">份数</div><input type="text" id="num" value="' . $rows['value'] . '" class="form-control" required/></div></div>';
        $data   .= '<input type="submit" id="save" onclick="saveOrderNum(' . $id . ')" class="btn btn-primary btn-block" value="保存">';
        $result = array("code" => 0, "msg" => "succ", "data" => $data);
        exit(json_encode($result));
        break;
    case 'editOrder':
        $id          = intval($_POST['id']);
        $inputvalue  = trim(daddslashes(isset($_POST['inputvalue']) ? $_POST['inputvalue'] : ''));
        $inputvalue2 = trim(daddslashes(isset($_POST['inputvalue2']) ? $_POST['inputvalue2'] : ''));
        $inputvalue3 = trim(daddslashes(isset($_POST['inputvalue3']) ? $_POST['inputvalue3'] : ''));
        $inputvalue4 = trim(daddslashes(isset($_POST['inputvalue4']) ? $_POST['inputvalue4'] : ''));
        $inputvalue5 = trim(daddslashes(isset($_POST['inputvalue5']) ? $_POST['inputvalue5'] : ''));
        $sds         = $DB->update('orders', [
            'input'  => $inputvalue,
            'input2' => $inputvalue2,
            'input3' => $inputvalue3,
            'input4' => $inputvalue4,
            'input5' => $inputvalue5
        ], [
            'id'    => $id,
            'LIMIT' => 1
        ]);
        if ($sds->rowCount() > 0)
            exit('{"code":0,"msg":"修改订单成功！"}');
        else
            exit('{"code":-1,"msg":"修改订单失败！' . $DB->error() . '"}');
        break;
    case 'editOrderNum':
        $id  = intval($_POST['id']);
        $num = intval($_POST['num']);
        $sds = $DB->update('orders', ['value' => $num], ['id' => $id]);
        if ($sds->rowCount() > 0)
            exit('{"code":0,"msg":"修改订单成功！"}');
        else
            exit('{"code":-1,"msg":"修改订单失败！' . $DB->error() . '"}');
        break;
    case 'operation':
        $status   = $_POST['status'];
        $checkbox = $_POST['checkbox'];
        $i        = 0;
        $statuss  = $conf['shequ_status'] ? $conf['shequ_status'] : 1;
        foreach ($checkbox as $id) {
            if ($status == 4) {
                $DB->delete('orders', ['id' => $id, 'LIMIT' => 1]);
            } else if ($status == 5) {
                $result = do_goods($id);
                if (strpos($result, '成功') !== false) {
                    $DB->update('orders', ['status' => $statuss, 'djzt' => 1, 'result' => null], ['id' => $id, 'LIMIT' => 1]);
                }
            } else if ($status == 6) {
                $row = $DB->get('orders', '*', ['id' => $id, 'LIMIT' => 1]);
                if ($row && $row['zid'] > 1 && $row['status'] == 3) {
                    $tc_point = $DB->get('points', 'point', [
                        'AND'   => [
                            'zid'     => $row['zid'],
                            'action'  => '提成',
                            'orderid' => $id
                        ],
                        'LIMIT' => 1
                    ]);
                    $money    = $row['money'];
                    if ($tc_point > 0)
                        $money -= $tc_point;
                    $DB->update('site', ['rmb[+]' => $money], ['zid' => $row['zid']]);
                    addPointRecord($row['zid'], $money, '退款', '订单(ID' . $id . ')已退款到分站余额');
                    $DB->update('orders', ['status' => 4, 'result' => null], ['id' => $id, 'LIMIT' => 1]);
                }
            } else {
                $DB->update('orders', ['status' => $status], ['id' => $id, 'LIMIT' => 1]);
            }
            $i++;
        }
        exit('{"code":0,"msg":"成功改变' . $i . '条订单状态"}');
        break;
    case 'result':
        $id   = intval($_POST['id']);
        $rows = $DB->get('orders', ['result'], ['id' => $id]);
        if (!$rows) {
            exit(json_encode(['code' => -1, 'msg' => '当前订单不存在！']));
        }
        exit(json_encode(['code' => 0, 'result' => $rows['result']]));
        break;
    case 'setresult':
        $id   = intval($_POST['id']);
        $rows = $DB->has('orders', ['id' => $id, 'LIMIT' => 1]);
        if (!$rows)
            exit('{"code":-1,"msg":"当前订单不存在！"}');
        $result = $_POST['result'];
        if ($DB->update('orders', ['result' => $result], ['id' => $id, 'LIMIT' => 1])->rowCount() > 0)
            exit('{"code":0,"msg":"修改订单成功！"}');
        else
            exit('{"code":-1,"msg":"修改订单失败！' . $DB->error() . '"}');
        break;
    case 'kms':
        $id   = intval($_GET['id']);
        $rows = $DB->get('faka', '*', ['kid' => $id]);
        if (!$rows)
            exit('{"code":-1,"msg":"当前卡密不存在！"}');
        $data   = '<li class="list-group-item" style="word-break:break-all;"><b>卡号：</b>' . $rows['km'] . '</li><li class="list-group-item" style="word-break:break-all;"><b>密码：</b>' . $rows['pw'] . '</li>';
        $result = array("code" => 0, "msg" => "succ", "data" => $data);
        exit(json_encode($result));
        break;
    case 'checkshequ':
        $url = $_POST['url'];
        if (gethostbyname($url) == '127.0.0.1') {
            exit('{"code":0}');
        } else {
            exit('{"code":1}');
        }
        break;
    case 'checkclone':
        $url     = $_POST['url'];
        $url_arr = parse_url($url);
        if ($url_arr['host'] == $_SERVER['HTTP_HOST']) exit('{"code":2}');
        $data = curl($url . 'api.php?act=clone');
        $arr  = json_decode($data, true);
        if (array_key_exists('code', $arr) && array_key_exists('msg', $arr)) {
            exit('{"code":1}');
        } elseif (substr(bin2hex($data), 0, 6) == 'efbbbf') {
            exit('{"code":3}');
        } else {
            exit('{"code":0}');
        }
        break;
    case 'checkdwz':
        $url  = $_POST['url'];
        $data = get_curl($url);
        if (json_decode($data, true)) {
            exit('{"code":1}');
        } elseif ($data) {
            exit('{"code":2}');
        } else {
            exit('{"code":0}');
        }
        break;
    case 'getTixian': //查看提现信息
        $id   = intval($_GET['id']);
        $rows = $DB->get('tixian', '*', ['id' => $id]);
        if (!$rows)
            exit('{"code":-1,"msg":"当前提现记录不存在！"}');
        $data   = '<div class="form-group"><div class="input-group"><div class="input-group-addon">提现方式</div><select class="form-control" id="pay_type" default="' . $userrow['pay_type'] . '"><option value="0">支付宝</option><option value="1">微信</option><option value="2">QQ钱包</option></select></div></div>';
        $data   .= '<div class="form-group"><div class="input-group"><div class="input-group-addon">提现账号</div><input type="text" id="pay_account" value="' . $rows['pay_account'] . '" class="form-control" required/></div></div>';
        $data   .= '<div class="form-group"><div class="input-group"><div class="input-group-addon">提现姓名</div><input type="text" id="pay_name" value="' . $rows['pay_name'] . '" class="form-control" required/></div></div>';
        $data   .= '<input type="submit" id="save" onclick="saveInfo(' . $id . ')" class="btn btn-primary btn-block" value="保存">';
        $result = array("code" => 0, "msg" => "succ", "data" => $data);
        exit(json_encode($result));
        break;
    case 'editTixian': //修改提现信息
        $id          = intval($_POST['id']);
        $pay_type    = trim(daddslashes($_POST['pay_type']));
        $pay_account = trim(daddslashes($_POST['pay_account']));
        $pay_name    = trim(daddslashes($_POST['pay_name']));
        $sds         = $DB->update('tixian', [
            'pay_type'    => $pay_type,
            'pay_account' => $pay_account,
            'pay_name'    => $pay_name
        ], ['id' => $id, 'LIMIT' => 1]);
        if ($sds->rowCount() > 0)
            exit('{"code":0,"msg":"修改记录成功！"}');
        else
            exit('{"code":-1,"msg":"修改记录失败！' . $DB->error() . '"}');
        break;
    case 'opTixian': //操作提现
        $id = intval($_POST['id']);
        $op = $_POST['op'];
        if ($op == 'delete') {
            if ($DB->delete('tixian', ['id' => $id, 'LIMIT' => 1])->rowCount()) {
                log_result('余额提现', 'IP => ' . real_ip() . '<br>UA => ' . $_SERVER['HTTP_USER_AGENT'] . '<br>Url => ' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'], '删除余额提现记录[成功]', '1');
                exit('{"code":0,"msg":"删除成功！"}');
            } else {
                log_result('余额提现', 'IP => ' . real_ip() . '<br>UA => ' . $_SERVER['HTTP_USER_AGENT'] . '<br>Url => ' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'], '删除余额提现记录[失败]', '1');
                exit('{"code":-1,"msg":"删除失败！' . $DB->error() . '"}');
            }
        } elseif ($op == 'complete') {
            if ($DB->update('tixian', ['status' => 1, 'endtime' => getDateTime()], ['id' => $id, 'LIMIT' => 1])->rowCount() > 0)
                exit('{"code":0,"msg":"已变更为已提现状态"}');
            else
                exit('{"code":-1,"msg":"变更失败！' . $DB->error() . '"}');
        } elseif ($op == 'reset') {
            if ($DB->update('tixian', ['status' => 0], ['id' => $id, 'LIMIT' => 1])->rowCount() > 0)
                exit('{"code":0,"msg":"已变更为未提现状态"}');
            else
                exit('{"code":-1,"msg":"变更失败！' . $DB->error() . '"}');
        } elseif ($op == 'back') {
            $rows = $DB->get('tixian', ['money', 'zid'], ['id' => $id]);
            if (empty($rows))
                exit(json_encode(['code' => -1, 'msg' => '提现记录不存在']));
            $DB->update('site', ['rmb[+]' => $rows['money']], ['zid' => $rows['zid'], 'LIMIT' => 1]);
            addPointRecord($rows['zid'], $rows['money'], '退回', '提现被退回到分站余额' . $rows['money'] . '元，请检查提现方式是否正确');
            if ($DB->delete('tixian', ['id' => $id, 'LIMIT' => 1])->rowCount())
                exit('{"code":0,"msg":"已成功退回到分站余额"}');
            else
                exit('{"code":-1,"msg":"退回失败！' . $DB->error() . '"}');
        }
        break;
    case 'getmoney': //退款查询
        $id  = intval($_POST['id']);
        $row = $DB->get('orders', '*', ['id' => $id]);
        if (!$row)
            exit('{"code":-1,"msg":"当前订单不存在！"}');
        if ($row['zid'] < 1 && !is_numeric($row['userid']))
            exit('{"code":-1,"msg":"退款失败，该订单属于主站"}');
        if ($row['status'] == 4) exit('{"code":-1,"msg":"该订单已退款请勿重复提交"}');
        //if($row['status']!=0&&$row['status']!=3)exit('{"code":-1,"msg":"只有未处理和异常的订单才支持退款"}');
        if ($row['money'] == 0) {
            $tool  = $DB->get('tools', 'price', ['tid' => $row['tid']]);
            $money = $tool['price'];
            $money = $row['value'] * $money;
        } else {
            $money = $row['money'];
        }
        //$tc_point=$DB->get_column("select point from shua_points where zid='{$row['zid']}' and action='提成' and orderid='$id' limit 1");
        //if($tc_point>0)$money-=$tc_point;
        if ($money == 0)
            exit('{"code":-1,"msg":"该订单为0元"}');
        exit('{"code":0,"money":"' . $money . '"}');
        break;
    case 'refund': //退款操作
        $id    = intval($_POST['id']);
        $money = trim(daddslashes($_POST['money']));
        $row   = $DB->get('orders', '*', ['id' => $id]);
        if (!$row)
            exit('{"code":-1,"msg":"当前订单不存在！"}');
        if ($row['zid'] < 1 && !is_numeric($row['userid']))
            exit('{"code":-1,"msg":"退款失败，该订单属于主站"}');
        if ($row['status'] == 4)
            exit('{"code":-1,"msg":"该订单已退款请勿重复提交"}');
        if ($row['status'] != 0 && $row['status'] != 3)
            exit('{"code":-1,"msg":"只有未处理和异常的订单才支持退款"}');
        if ($money <= 0)
            $money = $row['money'];
        if (is_numeric($row['userid']))
            $zid = intval($row['userid']);
        else
            $zid = $row['zid'];
        $DB->update('site', ['rmb[+]' => $money], ['zid' => $zid, 'LIMIT' => 1]);
        rollbackPoint($id);
        addPointRecord($zid, $money, '退款', '订单(ID' . $id . ')已退款到分站余额');
        $DB->update('orders', ['status' => 4, 'result' => null], ['id' => $id, 'LIMIT' => 1]);
        exit('{"code":0,"msg":"该订单已成功退款给分站 ID => ' . $row['zid'] . '"}');
        break;
    case 'djOrder': //重新下单
        $id     = intval($_GET['id']);
        $url    = isset($_POST['url']) ? $_POST['url'] : '';
        $post   = isset($_POST['post']) ? $_POST['post'] : '';
        $result = do_goods($id, $url, $post);
        if (strpos($result, '成功') !== false) {
            exitJson('下单成功！', 0);
        } else {
            exitJson($result);
        }
        break;
    case 'showStatus': //订单进度查询
        $id  = intval($_GET['id']);
        $row = $DB->get('orders', '*', ['id' => $id]);
        if (!$row)
            exit('{"code":-1,"msg":"当前订单不存在！"}');
        $tool = $DB->get('tools', '*', ['tid' => $row['tid']]);
        if (empty($tool))
            exit(json_encode(['code' => -1, 'msg' => '商品不存在或已经丢失']));
        $shequ = $DB->get('shequ', '*', ['id' => $tool['shequ']]);
        if ($shequ['type'] == 1) {
            $list = yile_chadan($shequ['url'], $row['djorder'], $shequ['username'], $shequ['password']);
        } elseif ($shequ['type'] == 0 || $shequ['type'] == 2) {
            $list = jiuwu_chadan($shequ['url'], $shequ['username'], $shequ['password'], $row['djorder']);
        } elseif ($shequ['type'] == 3 || $shequ['type'] == 5) {
            $list = xmsq_chadan($shequ['url'], $tool['goods_id'], $row['input'], $row['djorder']);
        } elseif ($shequ['type'] == 11) {
            $list = jumeng_chadan($shequ['url'], $shequ['username'], $shequ['password'], $row['djorder']);
        } elseif ($shequ['type'] == 12) {
            $list = this_chadan($shequ['url'], $row['djorder']);
        } elseif ($shequ['type'] == 20) {
            if (class_exists("ExtendAPI") && method_exists('ExtendAPI', 'chadan')) {
                $list = ExtendAPI::chadan($shequ['url'], $shequ['username'], $shequ['password'], $row['djorder'], $tool['goods_id'], $row['input']);
            } else {
                exit('{"code":-1,"msg":"该对接类型暂不支持查询订单进度"}');
            }
        } else {
            exit('{"code":-1,"msg":"该对接类型暂不支持查询订单进度"}');
        }
        if (is_array($list)) {
            $list['orderid'] = $row['djorder'];
            $result          = array('code' => 0, 'msg' => 'succ', 'domain' => $shequ['url'], 'data' => $list);

            if (($list['order_state'] == '已完成' || $list['order_state'] == '订单已完成') && $row['status'] == 2) {
                $DB->update('orders', ['status' => 1], ['id' => $id, 'LIMIT' => 1]);
            }
        } elseif ($list) {
            $result = array('code' => -1, 'msg' => $list);
        } else {
            $result = array('code' => -1, 'msg' => '获取数据失败');
        }
        exit(json_encode($result));
        break;
    case 'setTools': //商品上下架
        $tid = intval($_GET['tid']);
        if (isset($_GET['active'])) {
            $active = intval($_GET['active']);
            $DB->update('tools', ['active' => $active], ['tid' => $tid, 'LIMIT' => 1]);
        } else {
            $close = intval($_GET['close']);
            $DB->update('tools', ['close' => $close], ['tid' => $tid, 'LIMIT' => 1]);
        }
        exit('{"code":0,"msg":"succ"}');
        break;
    case 'setClass': //分类上下架
        $cid    = intval($_GET['cid']);
        $active = intval($_GET['active']);
        $DB->update('class', ['active' => $active], ['cid' => $cid, 'LIMIT' => 1]);
        exit('{"code":0,"msg":"succ"}');
        break;
    case 'setToolSort': //排序操作
        $cid  = intval($_GET['cid']);
        $tid  = intval($_GET['tid']);
        $sort = intval($_GET['sort']);
        if (setToolSort($cid, $tid, $sort)) {
            exit('{"code":0,"msg":"succ"}');
        } else {
            exit('{"code":-1,"msg":"失败"}');
        }
        break;
    case 'reset_sort':
        $type = intval($_POST['type']);
        $type = $type == 1 || $type == 2 ? $type : false;
        if (false === $type) exit('{"code":-1,"msg":"非法操作"}');
        $cid = 0;
        if ($type == 1) {
            $cid = intval(isset($_POST['cid']) ? $_POST['cid'] : 0);
        }
        if (resetSort($type, $cid)) {
            exit('{"code":0,"msg":"重置成功"}');
        } else {
            exit('{"code":-1,"msg":"重置失败，可能你已经重置过"}');
        }
        break;
    case 'setClassSort': //排序操作
        $cid  = intval($_GET['cid']);
        $sort = intval($_GET['sort']);
        if (setClassSort($cid, $sort)) {
            exit('{"code":0,"msg":"succ"}');
        } else {
            exit('{"code":-1,"msg":"失败"}');
        }
        break;
    case 'getGoodsList': //获取对接商品列表
        $shequ = intval($_POST['shequ']);
        $row   = $DB->get('shequ', ['type', 'url', 'username', 'password'], ['id' => $shequ]);
        if ($row['type'] == 1) {
            $type = 'yile';
            $list = yile_goodslist($row['url'], $row['username'], $row['password']);
        } elseif ($row['type'] == 0 || $row['type'] == 2) {
            $type = 'jiuwu';
            $list = jiuwu_goodslist_details($row['url'], $row['username'], $row['password']);
        } elseif ($row['type'] == 3 || $row['type'] == 5) {
            $type = 'xingmo';
            $list = xmsq_goodslist($row['url']);
        } elseif ($row['type'] == 11) {
            $type = 'jumeng';
            $list = jumeng_goodslist($row['url'], $row['username'], $row['password']);
        } elseif ($row['type'] == 12) {
            $type = 'this';
            $list = this_goodslist($row['url'], $row['username'], $row['password']);
        } elseif ($row['type'] == 20) {
            $type = 'extend';
            if (class_exists("ExtendAPI") && method_exists('ExtendAPI', 'goodslist')) {
                $list = ExtendAPI::goodslist($row['url'], $row['username'], $row['password']);
            }
        } else {
            exit('{"code":-1,"msg":"请直接在参数名处填写下单页面地址"}');
        }
        if (!is_array($list)) $result = array('code' => -1, 'msg' => $list);
        else $result = array('code' => 0, 'msg' => 'succ', 'type' => $type, 'data' => $list);
        exit(json_encode($result));
        break;
    case 'getGoodsParam':
        //获取对接参数名
        $shequ   = intval($_POST['shequ']);
        $goodsid = intval($_POST['goodsid']);
        $row     = $DB->get('shequ', ['type', 'url', 'username', 'password'], ['id' => $shequ]);
        if ($row['type'] == 1) {
            $result    = yile_goods_details($row['url'], $goodsid, $row['username'], $row['password']);
            $paramname = '';
            foreach ($result['inputs'] as $v) {
                $paramname .= $v[0] . '|';
            }
            $result['paramname'] = trim($paramname, '|');
        } elseif ($row['type'] == 9) {
            $result = kashangwl_goods_details($row['url'], $goodsid, $row['username'], $row['password']);
        } elseif ($row['type'] == 11) {
            $result = jumeng_goods_details($row['url'], $goodsid, $row['username'], $row['password']);
        } elseif ($row['type'] == 20) {
            if (class_exists("ExtendAPI") && method_exists('ExtendAPI', 'goods_details')) {
                $result = ExtendAPI::goods_details($row['url'], $goodsid, $row['username'], $row['password']);
            }
        } else {
            $result = jiuwu_goodsparam($row['url'], $goodsid, $row['username'], $row['password']);
        }
        if (!is_array($result)) {
            $error          = $result;
            $result         = [];
            $result['code'] = -1;
            $result['msg']  = $error;
        } else {
            $result['code'] = 0;
        }

        if (isset($result['desc']))
            $result['desc'] = stringRemoveXss($result['desc']);
        if (isset($result['name']))
            $result['name'] = stringRemoveXss($result['name']);;
        if (isset($result['price']))
            $result['price'] = stringRemoveXss(htmlspecialchars_decode($result['price']));

        exit(json_encode($result));
        break;
    case 'getfakatool': //获取发卡商品
        $cid  = intval($_GET['cid']);
        $rs   = $DB->select('tools', ['tid', 'name'], [
            'AND'   => [
                'cid'     => $cid,
                'is_curl' => 4,
                'active'  => 1
            ],
            'ORDER' => [
                'sort' => 'ASC'
            ]
        ]);
        $data = [];
        foreach ($rs as $res) {
            $data[] = ['tid' => $res['tid'], 'name' => $res['name']];
        }
        $result = ['code' => 0, 'msg' => 'succ', 'data' => $data];
        exit(json_encode($result));
        break;
    case 'setSite': //开启关闭站点
        $zid    = intval($_GET['zid']);
        $active = intval($_GET['active']);
        $DB->update('site', ['status' => $active], ['zid' => $zid, 'LIMIT' => 1]);
        exit('{"code":0,"msg":"succ"}');
        break;
    case 'setSuper': //切换站点版本
        $zid   = intval($_GET['zid']);
        $row   = $DB->get('site', ['power'], ['zid' => $zid]);
        $power = $row['power'] == 2 ? 1 : 2;
        $DB->update('site', ['power' => $power], ['zid' => $zid, 'LIMIT' => 1]);
        exit('{"code":0,"msg":"succ"}');
        break;
    case 'setEndtime': //分站延时
        $zid   = intval($_POST['zid']);
        $month = intval($_POST['month']);
        $row   = $DB->get('site', ['endtime'], ['zid' => $zid]);
        if ($row['endtime'] > date('Y-m-d'))
            $endtime = date('Y-m-d', strtotime("+ {$month} months", strtotime($row['endtime'])));
        else
            $endtime = date('Y-m-d', strtotime("+ {$month} months"));
        $DB->query("update `{$dbconfig['dbqz']}_site` set `endtime` = '{$endtime}' where `zid` = '{$zid}'");
        exit('{"code":0,"msg":"succ"}');
        break;
    case 'siteRecharge': //分站充值
        $zid = intval($_POST['zid']);
        $do  = intval($_POST['actdo']);
        $rmb = floatval($_POST['rmb']);
        $row = $DB->get('site', ['rmb'], ['zid' => $zid]);
        if (!$row)
            exit('{"code":-1,"msg":"当前分站不存在！"}');
        if ($do == 1 && $rmb > $row['rmb']) $rmb = $row['rmb'];
        if ($do == 0) {
            $DB->update('site', ['rmb[+]' => $rmb], ['zid' => $zid, 'LIMIT' => 1]);
            addPointRecord($zid, $rmb, '加款', '后台加款' . $rmb . '元');
        } else {
            $DB->update('site', ['rmb[-]' => $rmb], ['zid' => $zid]);
            addPointRecord($zid, $rmb, '扣除', '后台扣款' . $rmb . '元');
        }
        exit('{"code":0,"msg":"succ"}');
        break;
    case 'setMessage': //站内通知状态
        $id     = intval($_GET['id']);
        $active = intval($_GET['active']);
        $DB->update('message', ['active' => $active], ['id' => $id, 'LIMIT' => 1]);
        exit('{"code":0,"msg":"succ"}');
        break;
    case 'getMessage': //查看站内通知
        $id  = intval($_GET['id']);
        $row = $DB->get('message', ['title', 'type', 'content', 'addtime'], ['id' => $id]);
        if (!$row)
            exit('{"code":-1,"msg":"当前通知不存在！"}');
        $result = array("code" => 0, "msg" => "succ", "title" => $row['title'], "type" => $row['type'], "content" => htmlspecialchars_decode($row['content']), "date" => $row['addtime']);
        exit(json_encode($result));
        break;
    case 'addPriceRule': //添加加价模板
        $name = trim(daddslashes($_POST['name']));
        $kind = intval($_POST['kind']);
        $p_2  = trim(daddslashes($_POST['p_2']));
        $p_1  = trim(daddslashes($_POST['p_1']));
        $p_0  = trim(daddslashes($_POST['p_0']));
        if ($name == null || $p_2 == null || $p_1 == null || $p_0 == null) {
            exit('{"code":-1,"msg":"请确保各项不能为空！"}');
        } elseif ($p_2 > $p_1) {
            exit('{"code":-1,"msg":"专业版加价不能高于普及版加价"}');
        } elseif ($p_2 > $p_0) {
            exit('{"code":-1,"msg":"专业版加价不能高于普通用户加价"}');
        } elseif ($p_1 > $p_0) {
            exit('{"code":-1,"msg":"普及版加价不能高于普通用户加价"}');
        } elseif ($DB->has('price', ['name' => $name, 'LIMIT' => 1])) {
            exit('{"code":-1,"msg":"模板名称已存在"}');
        }
        if ($DB->insert('price', ['kind' => $kind, 'name' => $name, 'p_0' => $p_0, 'p_1' => $p_1, 'p_2' => $p_2])->rowCount()) {
            $CACHE->clear('pricerules');
            exit('{"code":0,"msg":"添加加价模板成功！"}');
        } else {
            exit('{"code":-1,"msg":"添加加价模板失败！' . $DB->error() . '"}');
        }
        break;
    case 'editPriceRule': //修改加价模板
        $id   = intval($_POST['prid']);
        $name = trim(daddslashes($_POST['name']));
        $kind = intval($_POST['kind']);
        $p_2  = trim(daddslashes($_POST['p_2']));
        $p_1  = trim(daddslashes($_POST['p_1']));
        $p_0  = trim(daddslashes($_POST['p_0']));
        if ($name == null || $p_2 == null || $p_1 == null || $p_0 == null) {
            exit('{"code":-1,"msg":"请确保各项不能为空！"}');
        } elseif ($p_2 > $p_1) {
            exit('{"code":-1,"msg":"专业版加价不能高于普及版加价"}');
        } elseif ($p_2 > $p_0) {
            exit('{"code":-1,"msg":"专业版加价不能高于普通用户加价"}');
        } elseif ($p_1 > $p_0) {
            exit('{"code":-1,"msg":"普及版加价不能高于普通用户加价"}');
        } elseif ($DB->has('price', ['id[!]' => $id, 'name' => $name, 'LIMIT' => 1])) {
            exit('{"code":-1,"msg":"模板名称已存在"}');
        }

        if ($DB->update('price', ['kind' => $kind, 'name' => $name, 'p_2' => $p_2, 'p_1' => $p_1, 'p_0' => $p_0], ['id' => $id, 'LIMIT' => 1])->rowCount() > 0) {
            $CACHE->clear('pricerules');
            exit('{"code":0,"msg":"修改加价模板成功！"}');
        } else {
            exit('{"code":-1,"msg":"修改加价模板失败！' . $DB->error() . '"}');
        }
        break;
    case 'getPriceRule':
        $id          = intval($_GET['id']);
        $row         = $DB->get('price', '*', ['id' => $id]);
        $row['code'] = 0;
        exit(json_encode($row));
        break;
    case 'delPriceRule':
        $id = intval($_GET['id']);
        if ($DB->delete('price', ['id' => $id, 'LIMIT' => 1])->rowCount()) {
            $CACHE->clear('pricerules');
            exit('{"code":0,"msg":"删除成功！"}');
        } else {
            exit('{"code":-1,"msg":"删除失败！' . $DB->error() . '"}');
        }
        break;
    case 'workorder_change':
        $aid      = $_POST['aid'];
        $checkbox = $_POST['checkbox'];
        $i        = 0;
        foreach ($checkbox as $id) {
            if ($aid == 1) {
                $flag = $DB->update('workorder', ['status' => 0], ['id' => $id, 'LIMIT' => 1]);
                if ($flag->rowCount() > 0)
                    $i++;
            } elseif ($aid == 2) {
                $flag = $DB->update('workorder', ['status' => 2], ['id' => $id, 'LIMIT' => 1]);
                if ($flag->rowCount() > 0)
                    $i++;
            } elseif ($aid == 3) {
                $rows    = $DB->get('workorder', ['status', 'content'], ['id' => $id, 'LIMIT' => 1]);
                $content = str_replace(array('*', '^', '|'), '', trim(strip_tags(daddslashes($_POST['content']))));
                if ($rows && $rows['status'] < 2 && !empty($content)) {
                    $content = addslashes($rows['content']) . '*1^' . $date . '^' . $content;
                    $flag    = $DB->update('workorder', [
                        'content' => $content,
                        'status'  => 1
                    ], ['id' => $id, 'LIMIT' => 1]);
                    if ($flag->rowCount() > 0)
                        $i++;
                }
            } elseif ($aid == 4) {
                $flag = $DB->delete('workorder', ['id' => $id, 'LIMIT' => 1]);
                if ($flag->rowCount() > 0)
                    $i++;
            }
        }
        exit('{"code":0,"msg":"成功改变' . $i . '个工单"}');
        break;
    case 'delworkorder':
        $id = intval($_GET['id']);
        if ($DB->delete('workorder', ['id' => $id, 'LIMIT' => 1])->rowCount()) {
            exit('{"code":0,"msg":"删除成功！"}');
        } else {
            exit('{"code":-1,"msg":"删除失败！' . $DB->error() . '"}');
        }
        break;
    case 'add_member':
        $name = $_POST['name'];
        $tid  = $_POST['tid'];
        $rate = str_replace('%', '', $_POST['rate']);
        if (!$name || !$tid || !$rate) {
            exit('{"code":-1,"msg":"请输入完整！"}');
        }
        if ($DB->insert('gift', ['name' => $name, 'tid' => $tid, 'rate' => $rate, 'ok' => 0])->rowCount()) {
            exit('{"code":0,"msg":"添加成功"}');
        } else {
            exit('{"code":1,"msg":"添加失败，' . $DB->error() . '"}');
        }
        break;
    case 'edit_cj':
        $id = $_POST['id'];
        if (!$id) {
            exit('{"code":-1,"msg":"请输入完整！"}');
        }
        $sql = $DB->get('gift', ['name', 'tid', 'rate'], ['id' => $id, 'LIMIT' => 1]);
        if ($sql) {
            $cid = $DB->get('tools', 'cid', ['tid' => $sql['tid'], 'LIMIT' => 1]);
            exit('{"code":0,"msg":"查询成功","id":"' . $id . '","name":"' . $sql['name'] . '","cid":"' . $cid . '","tid":"' . $sql['tid'] . '","rate":"' . $sql['rate'] . '"}');
        } else {
            exit('{"code":1,"msg":"查询失败，' . $DB->error() . '"}');
        }
        break;
    case 'edit_cj_ok':
        $id   = $_POST['id'];
        $name = $_POST['name'];
        $tid  = $_POST['tid'];
        $rate = $_POST['rate'];
        if (!$id) {
            exit('{"code":-1,"msg":"请输入完整！"}');
        }
        $sql = $DB->update('gift', ['name' => $name, 'tid' => $tid, 'rate' => $rate], ['id' => $id, 'LIMIT' => 1]);
        if ($sql->rowCount() > 0) {
            exit('{"code":0,"msg":"修改成功"}');
        } else {
            exit('{"code":1,"msg":"修改失败，' . $DB->error() . '"}');
        }
        break;
    case 'del_member':
        $id = $_POST['id'];
        if (!$id) {
            exit('{"code":-1,"msg":"请输入完整！"}');
        }
        $sql = $DB->delete('gift', ['id' => $id, 'LIMIT' => 1]);
        if ($sql) {
            exit('{"code":0,"msg":"删除成功"}');
        } else {
            exit('{"code":1,"msg":"删除失败，' . $DB->error() . '"}');
        }
        break;
    case 'cishu': // 抽奖设置保存
        $cishu     = filterParam($_GET['cishu']);
        $gift_open = filterParam($_GET['gift_open']);
        $cjmsg     = filterParam($_GET['cjmsg']);
        $cjmoney   = filterParam($_GET['cjmoney']);
        $gift_log  = filterParam($_GET['gift_log']);
        if ($cishu == '' || $cishu == 0 || $gift_open == '' || $cjmsg == '') {
            $result = ['code' => -1, 'msg' => '请输入完整！'];
        }
        if ($cjmoney == '') {
            $cjmoney = 0;
        }
        saveSetting('cjcishu', $cishu);
        saveSetting('gift_open', $gift_open);
        saveSetting('cjmsg', $cjmsg);
        saveSetting('cjmoney', $cjmoney);
        saveSetting('gift_log', $gift_log);
        if ($CACHE->clear()) {
            $result = ['code' => 0, 'msg' => '修改成功'];
        } else {
            $result = ['code' => 1, 'msg' => '修改失败' . $DB->error()];
        }
        exit(json_encode($result));
        break;
    case 'create_url':
        $force = trim(daddslashes($_GET['force']));
        $url   = trim(daddslashes($_GET['longurl']));
        if ($force == 1) {
            $turl = fanghongdwz($url, true);
        } else {
            $turl = fanghongdwz($url);
        }
        if ($turl == $url) {
            $result = array('code' => -1, 'msg' => '生成失败，请更换接口');
        } elseif (strpos($turl, '/')) {
            $result = array('code' => 0, 'msg' => 'succ', 'url' => $turl);
        } else {
            $result = array('code' => -1, 'msg' => '生成失败：' . $turl);
        }
        exit(json_encode($result));
        break;
    case 'create_dwz':
        $url    = trim(daddslashes($_GET['longurl']));
        $result = fanghongvip($url);
        if (!$result) $result = array('code' => -1, 'msg' => '生成失败，请更换接口');
        exit(json_encode($result));
        break;
    case 'getServerIp':
        $ip = getServerIp();
        exit('{"code":0,"ip":"' . $ip . '"}');
        break;
    case 'epayurl':
        $id             = intval($_GET['id']);
        $conf['payapi'] = $id;
        if ($url = pay_api()) {
            exit('{"code":0,"url":"' . $url . '"}');
        } else {
            exit('{"code":-1}');
        }
        break;

    case 'transfer_config':
        if (!$conf['fenzhan_daifu'])
            exit(json_encode(array('code' => 0, 'msg' => '请先在分站设置开启代付接口')));
        if (!$_POST['id'] || !$_POST['key'] || !$_POST['pass'])
            exit(json_encode(['code' => 0, 'msg' => '请填写完整']));
        if ($_POST['check'] !== 'NO_CHECK' && $_POST['check'] !== 'FORCE_CHECK')
            exit(json_encode(['code' => 0, 'msg' => '验证选项错误']));
        saveSetting('transfer_id', $_POST['id']);
        saveSetting('transfer_key', $_POST['key']);
        saveSetting('transfer_check', $_POST['check']);
        $CACHE->clear();
        $_SESSION["transfer_pass"] = md5($_POST['pass']);
        $_SESSION["transfer"]      = true;
        exit(json_encode(['code' => 1, 'msg' => '修改成功']));
        break;
    // 查询插件列表
    case 'plugin_page_query':
        $p = new plugin\model\PluginModel();
        echo $p->pageQuery();
        break;
    case 'plugin_install':
        $p      = new plugin\model\PluginModel();
        $plugin = $p->getById();
        $class  = $plugin['name'] . 'Plugin';
        if (!class_exists($class)) {
            echo DSReturn('插件不存在', -1);
            return;
        }
        $plugins = new $class;
        $flag    = $plugins->install();
        if (!$flag) {
            echo DSReturn('插件不存在', -1);
            return;
        } else {
            echo $p->editStatus(1);
            return;
        }
        break;
    case 'plugin_uninstall':
        $p      = new plugin\model\PluginModel();
        $plugin = $p->getById();
        $class  = $plugin['name'] . 'Plugin';
        if (!class_exists($class)) {
            echo DSReturn('插件不存在', -1);
            return;
        }
        $plugins = new $class;
        $flag    = $plugins->uninstall();
        if (!$flag) {
            echo DSReturn("卸载失败", -1);
            return;
        } else {
            echo $p->del();
            return;
        }
        break;
    case 'plugin_enable':
        $p      = new plugin\model\PluginModel();
        $plugin = $p->getById();
        $class  = $plugin['name'] . 'Plugin';
        if (!class_exists($class)) {
            echo DSReturn('插件不存在', -1);
            return;
        }
        $plugins = new $class;
        $flag    = $plugins->enable();
        if (!$flag) {
            echo DSReturn("启用失败", -1);
            return;
        } else {
            echo $p->editStatus(1);
            return;
        }
        break;
    case 'plugin_disable':
        $p      = new plugin\model\PluginModel();
        $plugin = $p->getById();
        $class  = $plugin['name'] . 'Plugin';
        if (!class_exists($class)) {
            echo DSReturn('插件不存在', -1);
            return;
        }
        $plugins = new $class;
        $flag    = $plugins->disable();
        if (!$flag) {
            echo DSReturn("禁用失败", -1);
            return;
        } else {
            echo $p->editStatus(2);
            return;
        }
        break;
    case 'hook_page_query':
        $h = new plugin\model\HookModel();
        echo $h->pageQuery();
        break;
    case 'change_article_st':
        $id   = filterParam($_POST['id'], 0);
        $st   = filterParam($_POST['st'], 0);
        $flag = $DB->update('article_list', ['status' => $st], ['id' => $id])->rowCount();
        if ($flag) {
            echo DSReturn("修改成功", 0);
            return;
        }
        echo DSReturn("修改失败", -1);
        break;
    case 'call_plugin_ajax':
        $plugin_name = filterParam($_GET['p_name']);
        if (empty($plugin_name)) {
            echo DSReturn('非法访问');
            return;
        }
        $class = $plugin_name . 'Plugin';
        if (!class_exists($class)) {
            echo DSReturn('插件不存在！');
            return;
        }
        global $PM;
        $res           = $PM->trigger($class, 'adminAjaxFunction');
        $res['msg']    = isset($res['msg']) ? $res['msg'] : '';
        $res['status'] = isset($res['status']) ? $res['status'] : 0;
        $res['data']   = isset($res['data']) ? $res['data'] : [];
        echo DSReturn($res['msg'], $res['status'], $res['data']);
        break;
    case 'sys_restore':
//        header('Content-Type: text/html; charset=UTF-8');
        // 数据库表结构修复
        $result = ['code' => 0, 'msg' => 'success'];
        require ROOT . 'install/db.class.php';
        $sql  = file_get_contents(ROOT . 'install/install.sql');
        $sql  = explode(';', trim($sql));
        $conn = DB::connect($dbconfig['host'], $dbconfig['user'], $dbconfig['pwd'], $dbconfig['dbname'], $dbconfig['port']);
        if (!$conn) {
            $result['code'] = -1;
            $result['msg']  = '<br><div class="alert alert-danger">无法修复, 错误：' . DB::connect_error() . '<br>请检查数据库配置文件是否正确</div>';
            exit(json($result));
        }
        DB::query('set sql_mode = \'\'');
        DB::query('set names utf8');
        while (true) {
            $prefix = my_str_shuffle(4, 2); // 生成随机表前缀
            if ($prefix != $dbconfig['dbqz']) {
                break;
            }
        }
        $t     = 0;
        $e     = 0;
        $error = '';
        for ($i = 0; $i < count($sql); $i++) {
            if (empty($sql[$i]))
                continue;
            if (DB::executeSql($sql[$i], $prefix . '_')) {
                ++$t;
            } else {
                ++$e;
                $error .= DB::error() . '<br/>';
            }
        }
        if (!empty($error)) {
            $result['code'] = -2;
            $result['msg']  = '<br><div class="alert alert-danger">暂时无法修复, 错误：' . $error . '</div>';
            exit(json($result));
        }
        // 载入数据表结构同步类
        include_once ROOT . 'includes/dbTableMaster/autoload.php';
        ClassLoader::register();

        $config = [];
        global $dbconfig;
        // 重构数据库连接信息
        $config['master'] = [
            'host'   => $dbconfig['host'],
            'user'   => $dbconfig['user'],
            'pwd'    => $dbconfig['pwd'],
            'dbname' => $dbconfig['dbname'],
            'port'   => $dbconfig['port'],
            'prefix' => $prefix . '_',
        ];
        $config['slave']  = [
            'host'   => $dbconfig['host'],
            'user'   => $dbconfig['user'],
            'pwd'    => $dbconfig['pwd'],
            'dbname' => $dbconfig['dbname'],
            'port'   => $dbconfig['port'],
            'prefix' => $dbconfig['dbqz'] . '_',
        ];
        $action           = new \DB\dbaction();
        $action->setMasterConf($config['master']);
        $action->setSlaveConf($config['slave']);
        $action->init();
        $flag = $action->run();
        $list = $DB->query('SHOW TABLES')->fetchAll(2);
        $k    = 'Tables_in_' . $dbconfig['dbname'];
        foreach ($list as $v) {
            if (!preg_match('/^' . $dbconfig['dbqz'] . '_/', $v[$k])) {
                $DB->query('DROP TABLE IF EXISTS `' . $v[$k] . '`');
            }
        }
        saveSetting('is_sys_restore', 1);
        $CACHE->update();
        exit(json($result));
        break;
    case 'invite_page_query':
        $m = new model\InviteRules();
        echo $m->pageQuery();
        break;
    case 'invite_get_query':
        $m = new model\InviteRules();
        echo $m->get();
        break;
    case 'invite_add':
        $m      = new model\InviteRules();
        $result = $m->add();
        echo json($result);
        break;
    case 'invite_edit_status':
        $m      = new model\InviteRules();
        $result = $m->editStatus();
        echo json($result);
        break;
    case 'invite_del':
        $m      = new model\InviteRules();
        $result = $m->del();
        echo json($result);
        break;
    case 'getPriceModelList':
        $priceModelList = $DB->select('price', '*');
        exitJson('success', 0, $priceModelList);
        break;
    case 'invite_def':
        $m      = new model\InviteRules();
        $result = $m->editDef();
        echo json($result);
        break;
    case 'invite_save':
        $m      = new model\InviteRules();
        $result = $m->save();
        echo json($result);
        break;
    case 'statistic':
        $m      = new model\Orders();
        $result = $m->count();
        echo json($result);
        break;
    case 'getKyxCategory':
        $communityID = intval($_GET['communityID']);
        if (empty($communityID))
            exitJson('社区ID不能为空');
        $result = $DB->get('shequ', ['id', 'url'], ['id' => $communityID]);
        if (empty($result))
            exitJson('社区ID不存在，请重试');
        $result = kayixinGetCategoryList($result['url']);
        if (!$result[0])
            exitJson($result[1]);
        exitJson('succ', 0, $result[1]);
        break;
    case 'getKyxProductList':
        $requestDomain = isset($_POST['requestDomain']) ? $_POST['requestDomain'] : '';
        $storeID       = isset($_POST['storeID']) ? intval($_POST['storeID']) : 0;

        $result = kayixinGetProductList($requestDomain, $storeID);
        if (!$result[0])
            exitJson($result[1]);
        exitJson('succ', 0, $result[1]);
        break;
    case 'init_plugin': // 初始化插件功能
        if ($_POST['k'] != 'AFme9qhWkaGz0mF3qPoO4jQO5ukYXybN') {
            exitJson('非法操作');
        }
        $sql = file_get_contents(ROOT . 'install/install_plugin.sql');
        if (empty($sql)) exitJson('数据异常，请检查系统文件');
        $sql = explode(';', trim($sql));
        array_pop($sql);
        foreach ($sql as $q) {
            executeSql($q, $dbconfig['dbqz'] . '_');
        }
        saveSetting('is_init_plugin', 1);
        $CACHE->update();
        exitJson('初始化成功', 0);
        break;
    default:
        exit(json(['code' => -4, 'msg' => 'No Act']));
        break;
}
