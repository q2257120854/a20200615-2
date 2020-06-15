<?php
include './includes/common.php';
$act = isset($_GET['act']) ? daddslashes($_GET['act']) : null;
header('Content-Type: application/json; charset=UTF-8');
if ($islogin2 == 1) {
    $price_obj = new Price($userrow['zid'], $userrow);
    $cookiesid = $userrow['zid'];
    if ($userrow['power'] > 0) $siterow = $userrow;
    $invite_id = 0;
    //这个是为了防止别人刷邀请礼物
    //用户登陆
} elseif ($is_fenzhan == true) {
    $price_obj = new Price($siterow['zid'], $siterow);
} else {
    $price_obj = new Price(1);
}
if ($conf['cjmsg'] != '') {
    $cjmsg = $conf['cjmsg'];
} else {
    $cjmsg = '您今天的抽奖次数已经达到上限！';
}
switch ($act) {
    case 'payrmb':
        if (!$islogin2)
            exit('{"code":-4,"msg":"你还未登录"}');
        $order_id = isset($_POST['orderid']) ? daddslashes($_POST['orderid']) : exit('{"code":-1,"msg":"订单号未知"}');
        $s_row    = $DB->query('SELECT * FROM `' . $dbconfig['dbqz'] . '_pay` WHERE `trade_no` = :tradeNo LIMIT 1 FOR UPDATE', [':tradeNo' => $order_id])->fetch(2);
        if (empty($s_row))
            exit('{"code":-1,"msg":"订单号不存在！"}');
        if ($s_row['tid'] == -1)
            exit('{"code":-1,"msg":"订单号不存在！"}');
        if ($s_row['money'] == '0')
            exit('{"code":-1,"msg":"当前商品为免费商品，不需要支付"}');
        if (!preg_match('/^[0-9.]+$/', $s_row['money']))
            exit('{"code":-1,"msg":"订单金额不合法"}');
        if ($s_row['status'] == 0) {
            if ($s_row['money'] > $userrow['rmb'])
                exit('{"code":-3,"msg":"你的余额不足，请充值！"}');
            $s_flag = $DB->update('site', ['rmb[-]' => $s_row['money']], ['zid' => $userrow['zid']]);
            $p_flag = $DB->update('pay', ['type' => 'rmb', 'status' => 1, 'endtime' => $date], ['trade_no' => $order_id]);
            if ($s_flag->rowCount() > 0 && $p_flag->rowCount() > 0) {
                if ($order_id = processOrder($s_row)) {
                    addPointRecord($userrow['zid'], $s_row['money'], '消费', '购买 ' . $s_row['name'] . ' (' . $order_id . ')');
                    exit('{"code":1,"msg":"您所购买的商品已付款成功，感谢购买！","orderid":"' . $order_id . '"}');
                } else {
                    addPointRecord($userrow['zid'], $s_row['money'], '消费', '购买 ' . $s_row['name']);
                    exit('{"code":-1,"msg":"下单失败！' . $DB->error() . '"}');
                }
            } else {
                exit('{"code":-1,"msg":"下单失败！' . $DB->error() . '"}');
            }
        } else {
            exit('{"code":-2,"msg":"当前订单已付款过，请勿重复提交"}');
        }
        break;
    case 'captcha':
        require_once SYSTEM_ROOT . 'class.geetestlib.php';
        $GtSdk                = new GeetestLib($conf['captcha_id'], $conf['captcha_key']);
        $data                 = array(
            'user_id'     => $cookiesid, # 网站用户id
            'client_type' => "web", # web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
            'ip_address'  => $clientip # 请在此处传输用户请求验证时所携带的IP
        );
        $status               = $GtSdk->pre_process($data, 1);
        $_SESSION['gtserver'] = $status;
        $_SESSION['user_id']  = $cookiesid;
        echo $GtSdk->get_response_str();
        break;
    case 'getcount':
        $strtotime = strtotime($conf['build']);//获取开始统计的日期的时间戳
        $now       = time();//当前的时间戳
        $yxts      = ceil(($now - $strtotime) / 86400);//取相差值然后除于24小时(86400秒)
        if ($conf['hide_tongji'] == 1) {
            $result = array("code" => 0, "yxts" => $yxts, "orders" => 0, "orders1" => 0, "orders2" => 0, "money" => 0, "money1" => 0, "gift" => isset($gift) ? $gift : null);
            exit(json_encode($result));
        }
        if ($conf['tongji_time'] > 0) {
            $tongji_cachetime = $DB->get('config', 'v', ['k' => 'tongji_cachetime']);
            $tongji_cache     = $CACHE->read('tongji');
            if ($tongji_cachetime + intval($conf['tongji_time']) >= time() && $tongji_cache) {
                if ($conf['shoppingcart'] == 1) {
                    $cart_count = $DB->count('cart', ['AND' => ['userid' => $cookiesid, 'status[<]' => 1]]);
                }
                $array  = unserialize($tongji_cache);
                $result = array("code" => 0, "yxts" => $yxts, "orders" => $array['orders'], "orders1" => $array['orders1'], "orders2" => $array['orders2'], "money" => $array['money'], "money1" => $array['money1'], "site" => $array['site'], "gift" => $array['gift'], "cart_count" => $cart_count);
                exit(json_encode($result));
            }
        }
        if ($conf['gift_log'] == 1 && $conf['gift_open'] == 1) {
            $gift = array();
            // Medoo 写法，太长
//            $list = $DB->select('giftlog', [
//                '[><]gift' => ['gid' => 'id']
//            ], ['giftlog.id','giftlog.zid','giftlog.tid','giftlog.gid','giftlog.userid','giftlog.ip','giftlog.addtime','giftlog.tradeno','giftlog.input','giftlog.status','gift.name'], [
//                'giftlog.status' => 1,
//                'ORDER' => ['gift.id' => 'DESC'],
//            ]);
            $list = $DB->query('SELECT a.*,b.name FROM ' . $dbconfig['dbqz'] . '_giftlog as a INNER join ' . $dbconfig['dbqz'] . '_gift as b on a.gid=b.id  WHERE status=1 ORDER BY id DESC')->fetchAll(2);
            foreach ($list as $value) {
                if (!$value['input']) continue;
                $value['input']        = (string)$value['input'];
                $value['input']        = substr($value['input'], 0, 2) . '***' . substr($value['input'], -2);
                $gift[$value['input']] = $value['name'];
            }
        }
        $time   = date("Y-m-d") . ' 00:00:01';
        $count1 = $DB->count('orders');
        $count2 = $DB->count('orders', ['status[>]' => 1]);
        $count3 = $DB->sum('pay', 'money', ['status' => 1]);
        $count4 = round($count3, 2);
        $count5 = $DB->count('orders', ['addtime[>]' => $time]);
        $count6 = $DB->sum('pay', 'money', ['AND' => ['addtime[>]' => $time, 'status' => 1]]);
        $count7 = round($count6, 2);
        $count8 = $DB->count('site');
        if ($conf['tongji_time'] > 0) {
            saveSetting('tongji_cachetime', time());
            $CACHE->save('tongji', serialize(array("orders" => $count1, "orders1" => $count2, "orders2" => $count5, "money" => $count4, "money1" => $count7, "site" => $count8, "gift" => $gift)));
        }
        if ($conf['shoppingcart'] == 1) {
            $cart_count = $DB->count('cart', ['AND' => ['userid' => $cookiesid, 'status[<]' => 1]]);
        }
        $result = array("code" => 0, "yxts" => $yxts, "orders" => $count1, "orders1" => $count2, "orders2" => $count5, "money" => $count4, "money1" => $count7, "site" => $count8, "gift" => $gift, "cart_count" => $cart_count);
        exit(json_encode($result));
        break;
    case 'getclass':
        $classhide = explode(',', $siterow['class']);
        $rs        = $DB->select('class', '*', ['active' => 1, 'ORDER' => ['sort' => 'ASC']]);
        $data      = array();
        foreach ($rs as $res) {
            if ($is_fenzhan && in_array($res['cid'], $classhide)) continue;
            $data[] = $res;
        }
        $result = array("code" => 0, "msg" => "succ", "data" => $data);
        exit(json_encode($result));
        break;
    case 'gettool':
        if (isset($_POST['kw'])) {
            $kw = trim(daddslashes($_POST['kw']));
            $rs = $DB->select('tools', '*', ['name[~]' => $kw, 'active' => 1, 'ORDER' => ['sort' => 'ASC']]);
        } else {
            $cid   = intval($_GET['cid']);
            $tid   = intval($_GET['tid']);
            $where = ['cid' => $cid, 'active' => 1, 'ORDER' => ['sort' => 'ASC']];
            if (!empty($tid)) {
                $where['tid'] = $tid;
            }
            $rs = $DB->select('tools', '*', $where);
            if (isset($_GET['info']) && $_GET['info'] == 1) {
                $info = $DB->get('class', '*', ['cid' => $cid]);
            }
        }
        $data = [];
        foreach ($rs as $res) {
            if (isset($_SESSION['gift_id']) && isset($_SESSION['gift_tid']) && $_SESSION['gift_tid'] == $res['tid']) {
                $price = $conf["cjmoney"] ? $conf["cjmoney"] : 0;
            } elseif (isset($price_obj)) {
                $price_obj->setToolInfo($res['tid'], $res);
                if ($price_obj->getToolDel($res['tid']) == 1) continue;
                $price = $price_obj->getToolPrice($res['tid']);
            } else $price = $res['price'];
            if ($res['is_curl'] == 4) {
                $isfaka       = 1;
                $res['input'] = getFakaInput($res['tid']);
            } else {
                $isfaka = 0;
            }
            $data[] = ['tid' => $res['tid'], 'sort' => $res['sort'], 'name' => $res['name'], 'value' => $res['value'], 'price' => $price, 'input' => $res['input'], 'inputs' => $res['inputs'], 'desc' => stripslashes($res['desc']), 'alert' => $res['alert'], 'shopimg' => $res['shopimg'], 'repeat' => $res['repeat'], 'multi' => $res['multi'], 'close' => $res['close'], 'prices' => $res['prices'], 'min' => $res['min'], 'max' => $res['max'], 'isfaka' => $isfaka];
        }
        $result = ['code' => 0, 'msg' => 'succ', 'data' => $data, 'info' => $info];
        exit(json_encode($result));
        break;
    case 'getleftcount':
        $tid    = intval($_POST['tid']);
        $count  = $DB->count('faka', ['AND' => ['tid' => $tid, 'orderid' => 0]]);
        $result = array("code" => 0, "count" => $count);
        exit(json_encode($result));
        break;
    case 'pay':
        $method      = $_GET['method'];
        $inputvalue  = htmlspecialchars(trim(strip_tags(daddslashes($_POST['inputvalue']))));
        $inputvalue2 = htmlspecialchars(trim(strip_tags(daddslashes($_POST['inputvalue2']))));
        $inputvalue3 = htmlspecialchars(trim(strip_tags(daddslashes($_POST['inputvalue3']))));
        $inputvalue4 = htmlspecialchars(trim(strip_tags(daddslashes($_POST['inputvalue4']))));
        $inputvalue5 = htmlspecialchars(trim(strip_tags(daddslashes($_POST['inputvalue5']))));
        $num         = isset($_POST['num']) ? intval($_POST['num']) : 1;
        $hashsalt    = isset($_POST['hashsalt']) ? $_POST['hashsalt'] : null;
        if ($method == 'cart_edit') {
            $shop_id   = intval($_POST['shop_id']);
            $cart_item = $DB->get('cart', '*', ['id' => $shop_id]);
            if (!$cart_item) exitJson('商品不存在！');
            if ($cart_item['userid'] != $cookiesid || $cart_item['status'] > 1)
                exitJson('商品权限校验失败');
            $tool = $DB->get('tools', '*', ['tid' => $cart_item['tid']]);
        } else {
            $tid  = intval($_POST['tid']);
            $tool = $DB->get('tools', '*', ['tid' => $tid]);
        }
        if ($tool && $tool['active'] == 1) {
            if ($tool['close'] == 1) exitJson('当前商品维护中，停止下单！');
            if (in_array($inputvalue, explode('|', $conf['blacklist'])))
                exitJson('你的下单账号已被拉黑，无法下单！');
            if ($conf['forcermb'] == 1 && !$islogin2)
                exitJson('你还未登录', 4);
            if ($conf['verify_open'] == 1 && (empty($_SESSION['addsalt']) || $hashsalt != $_SESSION['addsalt'])) {
                exitJson('验证失败，请刷新页面重试');
            }
            $inputs = explode('|', $tool['inputs']);
            if ($inputs[0] && empty($inputvalue2) || $inputs[1] && empty($inputvalue3) || $inputs[2] && empty($inputvalue4) || $inputs[3] && empty($inputvalue5)) {
                exitJson('请确保各项不能为空');
            }
            if (!$inputs[0] && !empty($inputvalue2) || !$inputs[1] && !empty($inputvalue3) || !$inputs[2] && !empty($inputvalue4) || !$inputs[3] && !empty($inputvalue5)) {
                exitJson('验证失败');
            }
            if ($tool['is_curl'] == 4) {
                if (!$islogin2 && $conf['faka_input'] == 0 && !checkEmail($inputvalue)) {
                    exitJson('邮箱格式不正确');
                }
                $count = $DB->count('faka', ['AND' => ['tid' => $tid, 'orderid' => 0]]);
                $nums  = ($tool['value'] > 1 ? $tool['value'] : 1) * $num;
                if ($count == 0)
                    exitJson('该商品库存卡密不足，请联系站长加卡！');
                if ($nums > $count)
                    exitJson('你所购买的数量超过库存数量！');
            } elseif ($tool['repeat'] == 0) {
                $thtime = date('Y-m-d 00:00:00');
                $row    = $DB->get('orders', '*', ['AND' => ['tid' => $tid, 'input' => $inputvalue], 'ORDER' => ['id' => 'DESC']]);
                if ($row['input'] && $row['status'] == 0)
                    exitJson('您今天添加的' . $tool['name'] . '正在排队中，请勿重复提交！');
                elseif ($row['addtime'] > $thtime)
                    exitJson('您今天已添加过' . $tool['name'] . '，请勿重复提交！');
            }
            if ($tool['validate'] == 1 && is_numeric($inputvalue)) {
                if (validate_qzone($inputvalue) == false)
                    exitJson('你的QQ空间设置了访问权限，无法下单！');
            }
            if ($tool['multi'] == 0 || $num < 1)
                $num = 1;
            if ($tool['multi'] == 1 && $tool['min'] > 0 && $num < $tool['min'])
                exitJson('当前商品最小下单数量为' . $tool['min']);
            if ($tool['multi'] == 1 && $tool['max'] > 0 && $num > $tool['max'])
                exitJson('当前商品最大下单数量为' . $tool['max']);
            if (isset($_SESSION['gift_id']) && isset($_SESSION['gift_tid']) && $_SESSION['gift_tid'] == $tid) {
                $gift_id = intval($_SESSION['gift_id']);
                $giftlog = $DB->get('giftlog', 'status', ['id' => $gift_id]);
                if ($giftlog == 1) {
                    unset($_SESSION['gift_id']);
                    unset($_SESSION['gift_tid']);
                    exitJson('当前奖品已经领取过了！');
                }
                $price = $conf['cjmoney'] ? $conf['cjmoney'] : 0;
                $num   = 1;
            } elseif ($tool['price'] == 0) {
                $price = 0;
            } elseif (isset($price_obj)) {
                $price_obj->setToolInfo($tid, $tool);
                $price = $price_obj->getToolPrice($tid);
                $price = $price_obj->getFinalPrice($price, $num);
                if (!$price)
                    exitJson('当前商品批发价格优惠设置不正确');
            } else $price = $tool['price'];

            $need = $price * $num;
            if ($need == 0 && $tid != $_SESSION['gift_tid']) {
                if ($method == 'cart_add' || $method == 'cart_edit')
                    exitJson('免费商品请直接点击领取');
                $thtime    = date('Y-m-d 00:00:00');
                $pay_count = $DB->count('pay', [
                    'AND' => [
                        'tid'        => $tid,
                        'money'      => 0,
                        'ip'         => $clientip,
                        'status'     => 1,
                        'addtime[>]' => $thtime,
                    ],
                ]);
                if ($_SESSION['blockfree'] == true || $pay_count >= 1) {
                    exitJson('您今天已领取过，请明天再来！');
                }
                if ($conf['captcha_open_free'] == 1 && $conf['captcha_open'] == 1) {
                    if (isset($_POST['geetest_challenge']) && isset($_POST['geetest_validate']) && isset($_POST['geetest_seccode'])) {
                        require_once SYSTEM_ROOT . 'class.geetestlib.php';
                        $GtSdk = new GeetestLib($conf['captcha_id'], $conf['captcha_key']);

                        $data = [
                            'user_id'     => $cookiesid,
                            'client_type' => "web",
                            'ip_address'  => $clientip
                        ];

                        if ($_SESSION['gtserver'] == 1) {   //服务器正常
                            $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $data);
                            if ($result) {
                                //echo '{"status":"success"}';
                            } else {
                                exit('{"code":-1,"msg":"验证失败，请重新验证"}');
                            }
                        } else {  //服务器宕机,走failback模式
                            if ($GtSdk->fail_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'])) {
                                //echo '{"status":"success"}';
                            } else {
                                exit('{"code":-1,"msg":"验证失败，请重新验证"}');
                            }
                        }
                    } else {
                        exit(json(['code' => 2, 'type' => 1, 'msg' => '请先完成验证']));
                    }
                } elseif ($conf['captcha_open_free'] == 1 && $conf['captcha_open'] == 2) {
                    if (isset($_POST['token'])) {
                        require_once SYSTEM_ROOT . 'class.dingxiang.php';
                        $client = new CaptchaClient($conf['captcha_id'], $conf['captcha_key']);
                        $client->setTimeOut(2);
                        $response = $client->verifyToken($_POST['token']);
                        if ($response->result) {
                            /**token验证通过，继续其他流程**/
                        } else {
                            /**token验证失败**/
                            exitJson('验证失败，请重新验证');
                        }
                    } else {
                        exit(json(['code' => 2, 'type' => 2, 'appid' => $conf['captcha_id'], 'msg' => '请先完成验证']));
                    }
                }
            }
            //同步亿乐社区价格
//            if ($need > 0 && $tool['prid'] > 0 && $tool['shequ'] > 0 && $tool['is_curl'] == 2 && in_array($tool['cid'], explode(",", $conf['pricejk_cid'])) && time() - $tool['uptime'] >= $conf['pricejk_time']) {
//                $num_change = pricejk_yile_one($tool);
//                if ($num_change > 0) {
//                    exit('{"code":3,"msg":"当前商品价格发生变化，请刷新页面重试","change":"' . $num_change . '"}');
//                }
//            }

            // 首页购买商品之前，当前版本 v8.5.2 只能返回修改后下单所需的总金额
            $hook_result2 = hook('beforeBuyCommodityHome', ['need' => $need]);
            foreach ($hook_result2 as $v) {
                if (!empty($v)) {
                    $need = isset($v['need']) ? $v['need'] : $need;
                    break;
                }
            }

            $trade_no = date('YmdHis') . rand(111, 999);
            $input    = $inputvalue . ($inputvalue2 ? '|' . $inputvalue2 : null) . ($inputvalue3 ? '|' . $inputvalue3 : null) . ($inputvalue4 ? '|' . $inputvalue4 : null) . ($inputvalue5 ? '|' . $inputvalue5 : null);
            if ($method == 'cart_add') {
                $flag = $DB->insert('cart', [
                    'userid'  => $cookiesid,
                    'zid'     => $siterow['zid'] ? $siterow['zid'] : 1,
                    'tid'     => $tid,
                    'input'   => $input,
                    'num'     => $num,
                    'money'   => $need,
                    'addtime' => $date,
                    'status'  => 0,
                ]);
                if ($flag->rowCount()) {
                    $cart_count = $DB->count('cart', ['AND' => ['userid' => $cookiesid, 'status[<=]' => 1]]);
                    exit(json(['code' => 0, 'msg' => '加入购物车成功！', 'need' => $need, 'cart_count' => $cart_count]));
                } else {
                    exitJson('加入购物车失败！' . $DB->error());
                }
            } elseif ($method == 'cart_edit') {
                $flag = $DB->update('cart', [
                    'input'  => $input,
                    'num'    => $num,
                    'money'  => $need,
                    'status' => 0,
                ], ['id' => $shop_id]);
                if ($flag->rowCount() > 0) {
                    exit(json(['code' => 0, 'msg' => '编辑订单成功！', 'need' => $need]));
                } else {
                    exit(json(['code' => -1, 'msg' => '编辑订单失败！' . $DB->error()]));
                }
            } elseif ($need == 0) {
                $trade_no  = 'free' . $trade_no;
                $num       = 1;
                $orderData = [
                    'trade_no' => $trade_no,
                    'tid'      => $tid,
                    'zid'      => $siterow['zid'] ? $siterow['zid'] : 1,
                    'type'     => 'free',
                    'input'    => $input,
                    'num'      => $num,
                    'name'     => $tool['name'],
                    'money'    => $need,
                    'ip'       => $clientip,
                    'userid'   => $cookiesid,
                    'addtime'  => $date,
                    'status'   => 1,
                ];
                // 钩子处理
                $hook_result = hook('beforeOrderSubmit', ['only_balance' => $conf['forcermb'], 'order_data' => $orderData]);
                // 数据返回覆盖
                foreach ($hook_result as $v) {
                    if (is_array($v)) $orderData = $v['order_data'];
                }
                $flag = $DB->insert('pay', $orderData);
                if ($flag->rowCount()) {
                    unset($_SESSION['addsalt']);
                    if (isset($_SESSION['gift_id'])) {
                        $DB->update('giftlog', [
                            'status'  => 1,
                            'tradeno' => $trade_no,
                            'input'   => $inputvalue,
                        ], ['id' => $gift_id]);
                        unset($_SESSION['gift_id']);
                        unset($_SESSION['gift_tid']);
                    }
                    $_SESSION['blockfree'] = true;
                    $srow['tid']           = $tid;
                    $srow['input']         = $input;
                    $srow['num']           = $num;
                    $srow['zid']           = isset($siterow['zid']) ? $siterow['zid'] : 0;
                    $srow['userid']        = $cookiesid;
                    $srow['trade_no']      = $trade_no;
                    $srow['money']         = '0.00';
                    if ($orderid = processOrder($srow)) {
                        log_result(
                            '免费订单',
                            'IP => ' . $clientip . '<br>UA => ' . $_SERVER['HTTP_USER_AGENT'],
                            '订单号 => ' . $trade_no,
                            '1');
                        exit(json(['code' => 1, 'msg' => '下单成功！你可以在进度查询中查看代刷进度', 'orderid' => $orderid]));
                    } else {
                        exitJson('下单失败！' . $DB->error());
                    }
                }
            } else {
                // 如果是分享推广商品
                $invite_row = $DB->get('invite', [
                    '[><]invite_rules' => 'tid'
                ], ['invite.id', 'invite.tid', 'invite.date'], [
                    'invite.id'           => $invite_id,
                    'invite_rules.status' => 1
                ]);
                // 如果不存在推广数据及过期的链接
                if (empty($invite_row) || strtotime($invite_row['date']) + $invite_expire_in <= time()) {
                    $invite_id = 0;
                }
                $orderData = [
                    'trade_no' => $trade_no,
                    'tid'      => $tid,
                    'zid'      => $siterow['zid'] ? $siterow['zid'] : 1,
                    'input'    => $input,
                    'num'      => $num,
                    'name'     => $tool['name'],
                    'money'    => $need,
                    'ip'       => $clientip,
                    'userid'   => $cookiesid,
                    'inviteid' => $invite_id,
                    'addtime'  => $date,
                    'status'   => 0,
                ];
                // 钩子处理
                $hook_result = hook('beforeOrderSubmit', ['only_balance' => $conf['forcermb'], 'order_data' => $orderData]);
                // 数据返回覆盖
                foreach ($hook_result as $v) {
                    if (is_array($v)) $orderData = $v['order_data'];
                }
                $flag = $DB->insert('pay', $orderData);
                if ($flag->rowCount()) {
                    unset($_SESSION['addsalt']);
                    if (isset($_SESSION['gift_id'])) {
                        $DB->update('giftlog', [
                            'status'  => 1,
                            'tradeno' => $trade_no,
                        ], ['id' => $gift_id]);
                        unset($_SESSION['gift_id']);
                        unset($_SESSION['gift_tid']);
                    }
                    if ($conf['forcermb'] == 1) {
                        $conf['alipay_api'] = 0;
                        $conf['wxpay_api']  = 0;
                        $conf['qqpay_api']  = 0;
                    }
                    exit(json([
                        'code'       => 0,
                        'msg'        => '提交订单成功！',
                        'trade_no'   => $trade_no,
                        'need'       => $orderData['money'],
                        'pay_alipay' => $conf['alipay_api'],
                        'pay_wxpay'  => $conf['wxpay_api'],
                        'pay_qqpay'  => $conf['qqpay_api'],
                        'pay_rmb'    => $islogin2,
                        'user_rmb'   => $userrow['rmb'],
                    ]));
                } else {
                    exitJson('提交订单失败！' . $DB->error());
                }
            }
        } else {
            exitJson('该商品不存在', -2);
        }
        break;
    case 'cancel':
        $orderid  = isset($_POST['orderid']) ? daddslashes($_POST['orderid']) : exit(json(['code' => -1, 'msg' => '订单号未知']));
        $hashsalt = isset($_POST['hashsalt']) ? $_POST['hashsalt'] : null;
//        $DB->pdo->beginTransaction();
        $srow = $DB->query(
            "SELECT * FROM `{$dbconfig['dbqz']}_pay` WHERE `trade_no` = :tradeNo FOR UPDATE", [
            ':tradeNo' => $orderid
        ])->fetch(2);
        if (!$srow['trade_no'] || $srow['userid'] != $cookiesid) exit(json(['code' => -1, 'msg' => '订单号不存在！']));
        if ($srow['status'] == 0) {
//            $flag = $DB->delete('pay', ['trade_no' => $orderid]);
            if ($conf['verify_open'] == 1) {
                $_SESSION['addsalt'] = $hashsalt;
            }
            exitJson('ok', 0);
//            if ($flag->rowCount()) {
//                hook('beforeOrderCancel', $srow); // 该钩子会在事务中执行，系统版本 8.6.14 以上
//                $DB->pdo->commit();
//                exitJson('ok', 0);
//            } else {
//                $DB->pdo->rollBack();
//                exitJson('error', -1);
//            }
        }
        exitJson('error', -1);
        break;
    case 'checkkm':
        $km    = trim(daddslashes($_POST['km']));
        $myrow = $DB->get('kms', '*', ['km' => $km]);
        if (!$myrow) {
            exit('{"code":-1,"msg":"此卡密不存在！"}');
        } elseif ($myrow['usetime'] != null) {
            exit('{"code":-1,"msg":"此卡密已被使用！"}');
        }
        $tool   = $DB->get('tools', '*', ['tid' => $myrow['tid']]);
        $result = array("code" => 0, "tid" => $tool['tid'], "cid" => $tool['cid'], "name" => $tool['name'], "alert" => $tool['alert'], "desc" => $tool['desc'], "inputname" => $tool['input'], "inputsname" => $tool['inputs'], "value" => $tool['value'], "close" => $tool['close']);
        exit(json_encode($result));
        break;
    case 'card':
        if ($conf['iskami'] == 0) exit('{"code":-1,"msg":"当前站点未开启卡密下单"}');
        $km          = trim(daddslashes($_POST['km']));
        $inputvalue  = htmlspecialchars(trim(strip_tags(daddslashes($_POST['inputvalue']))));
        $inputvalue2 = htmlspecialchars(trim(strip_tags(daddslashes($_POST['inputvalue2']))));
        $inputvalue3 = htmlspecialchars(trim(strip_tags(daddslashes($_POST['inputvalue3']))));
        $inputvalue4 = htmlspecialchars(trim(strip_tags(daddslashes($_POST['inputvalue4']))));
        $inputvalue5 = htmlspecialchars(trim(strip_tags(daddslashes($_POST['inputvalue5']))));
        $myrow       = $DB->get('kms', '*', ['km' => $km]);
        if (!$myrow) {
            exit('{"code":-1,"msg":"此卡密不存在！"}');
        } elseif ($myrow['usetime'] != null) {
            exit('{"code":-1,"msg":"此卡密已被使用！"}');
        } else {
            $tid  = $myrow['tid'];
            $tool = $DB->get('tools', '*', ['tid' => $tid]);
            if ($tool && $tool['active'] == 1) {
                if (in_array($inputvalue, explode("|", $conf['blacklist']))) exit('{"code":-1,"msg":"你的下单账号已被拉黑，无法下单！"}');
                if ($tool['repeat'] == 0) {
                    $row    = $DB->get('tools', '*', [
                        'AND'   => ['tid' => $tid, 'input' => $inputvalue],
                        'ORDER' => ['id' => 'DESC'],
                    ]);
                    $thtime = date("Y-m-d") . ' 00:00:00';
                    if ($row['input'] && $row['status'] == 0)
                        exit('{"code":-1,"msg":"您今天添加的' . $tool['name'] . '正在排队中，请勿重复提交！"}');
                    elseif ($row['addtime'] > $thtime)
                        exit('{"code":-1,"msg":"您今天已添加过' . $tool['name'] . '，请勿重复提交！"}');
                }
                if ($tool['validate'] == 1 && is_numeric($inputvalue)) {
                    if (validate_qzone($inputvalue) == false)
                        exit('{"code":-1,"msg":"你的QQ空间设置了访问权限，无法下单！"}');
                }
                $srow['tid']      = $tid;
                $srow['input']    = $inputvalue . ($inputvalue2 ? '|' . $inputvalue2 : null) . ($inputvalue3 ? '|' . $inputvalue3 : null) . ($inputvalue4 ? '|' . $inputvalue4 : null) . ($inputvalue5 ? '|' . $inputvalue5 : null);
                $srow['num']      = 1;
                $srow['zid']      = $siterow['zid'];
                $srow['userid']   = $cookiesid;
                $srow['trade_no'] = 'kid:' . $myrow['kid'];
                if ($orderid = processOrder($srow)) {
                    $DB->update('kms', ['user' => $inputvalue, 'usetime' => $date], ['kid' => $myrow['kid']]);
                    exit('{"code":0,"msg":"' . $tool['name'] . ' 下单成功！你可以在进度查询中查看代刷进度","orderid":"' . $orderid . '"}');
                } else {
                    exit('{"code":-1,"msg":"' . $tool['name'] . ' 下单失败！' . $DB->error() . '"}');
                }
            } else {
                exit('{"code":-2,"msg":"该商品不存在"}');
            }
        }
        break;
    case 'query':
        $type = intval($_POST['type']);
        $qq   = trim(daddslashes($_POST['qq']));
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rs   = $DB->select('tools', ['tid', 'name'], ['ORDER' => ['sort' => 'ASC']]);
        foreach ($rs as $res) {
            $shua_func[$res['tid']] = $res['name'];
        }
        $where = []; // 动态条件查询集合
        if ($type == 1 && !empty($qq)) {
            if (strlen($qq) == 17 && is_numeric($qq)) {
                $where['tradeno'] = $qq;
            } elseif (is_numeric($qq)) {
                $where['id'] = $qq;
                if (strlen($cookiesid) == 32) {
                    $where['userid'] = $cookiesid;
                } else {
                    $where['zid'] = $cookiesid;
                }
            } elseif (preg_match('/^free/', $qq) && strlen($qq) == 21) { // 免费订单查询
                $where['tradeno'] = $qq;
            } else {
                exitJson('请输入正确的订单号');
            }
        } elseif (empty($qq)) {
            $where['userid'] = $cookiesid;
        } else {
            $where['input'] = $qq;
        }
        $limit = 10;
        $start = $limit * ($page - 1);
        $rs    = $DB->select('orders', '*', [
            'AND'   => $where,
            'ORDER' => ['id' => 'DESC'],
            'LIMIT' => [$start, $limit],
        ]);
        $data  = [];
        $count = 0;
        foreach ($rs as $res) {
            $count++;
            $data[] = ['id'      => $res['id'], 'tid' => $res['tid'], 'input' => $res['input'],
                       'name'    => $shua_func[$res['tid']], 'value' => $res['value'], 'addtime' => $res['addtime'],
                       'endtime' => $res['endtime'], 'result' => $res['result'], 'status' => $res['status'],
                       'skey'    => md5($res['id'] . SYS_KEY . $res['id'])
            ];
        }
        if ($page > 1 && $count == 0) exit('{"code":-1,"msg":"没有更多订单了"}');
        $result = ['code'   => 0, 'msg' => 'succ', 'content' => $qq, 'page' => $page,
                   'isnext' => ($count == $limit ? true : false),
                   'islast' => ($page > 1 ? true : false), 'data' => $data
        ];
        exit(json($result));
        break;
    case 'order': //订单进度查询
        $id = intval($_POST['id']);
        if (md5($id . SYS_KEY . $id) !== $_POST['skey'])
            exit('{"code":-1,"msg":"验证失败"}');
        $row = $DB->get('orders', '*', ['id' => $id]);
        if (!$row)
            exit('{"code":-1,"msg":"当前订单不存在！"}');
        $tool = $DB->get('tools', '*', ['tid' => $row['tid']]);
        if ($tool['is_curl'] == 4 || $row['djzt'] == 3) {
            //自动发卡模式 或  djzt 对接状态
            $count = ($tool['value'] > 1 ? $tool['value'] : 1) * $row['value'];
            if ($count > 6) {
                $kmdata = '<a style="text-align: center;" href="./?mod=faka&id=' . $id . '&skey=' . $_POST['skey'] . '" target="_blank" class="btn btn-sm btn-primary">点此查看卡密</a>';
            } else {
                $rs     = $DB->select('faka', '*', [
                    'AND'   => ['tid' => $row['tid'], 'orderid' => $id],
                    'ORDER' => ['kid' => 'ASC'],
                    'LIMIT' => $count,
                ]);
                $kmdata = '';
                foreach ($rs as $res) {
                    if (!empty($res['pw'])) {
                        $kmdata .= '卡号：' . $res['km'] . ' 密码：' . $res['pw'] . '<br/>';
                    } else {
                        $kmdata .= $res['km'] . '<br/>';
                    }
                    if (strlen($res['km'] . $res['pw']) > 80) {
                        $kmdata = '<a style="text-align: center;" href="./?mod=faka&id=' . $id . '&skey=' . $_POST['skey'] . '" target="_blank" class="btn btn-sm btn-primary">点此查看卡密</a>';
                        break;
                    }
                }
            }
        } elseif ($tool['is_curl'] == 2) {
            $shequ = $DB->get('shequ', '*', ['id' => $tool['shequ']]);
            if ($shequ['type'] == 1) {
                $list = yile_chadan($shequ['url'], $row['djorder'], $shequ['username'], $shequ['password']);
            } elseif ($shequ['type'] == 0 || $shequ['type'] == 2) {
                $list = jiuwu_chadan($shequ['url'], $shequ['username'], $shequ['password'], $row['djorder']);
            } elseif ($shequ['type'] == 3 || $shequ['type'] == 5) {
                $list = xmsq_chadan($shequ['url'], $tool['goods_id'], $row['input'], $row['djorder']);
            } elseif ($shequ['type'] == 11) {
                $list = jumeng_chadan($shequ['url'], $shequ['username'], $shequ['password'], $row['djorder']);
            } elseif ($shequ['type'] == 9) {
                $list = kashangwl_chadan($shequ['url'], $shequ['username'], $shequ['password'], $row['djorder']);
            } elseif ($shequ['type'] == 12) {
                $list = this_chadan($shequ['url'], $row['djorder']);
            } elseif ($shequ['type'] == 13) {
                $list = yole_chadan($shequ['url'], $row['djorder'], $shequ['username'], $shequ['password']);
            } elseif ($shequ['type'] == 20) {
                if (class_exists("ExtendAPI") && method_exists('ExtendAPI', 'chadan')) {
                    $list = ExtendAPI::chadan($shequ['url'], $shequ['username'], $shequ['password'], $row['djorder'], $tool['goods_id'], $row['input']);
                }
            }
            if (is_string($list)) {
                if (IS_DEBUG)
                    exit(json_encode(['code' => -1, 'msg' => $list]));
                else
                    $list = [];
            }
//            if (is_string($list))
//                exit(json_encode(['code' => -1, 'msg' => '此订单暂不支持查询']));
//            exit(json_encode(['code' => -1, 'msg' => $list]));
            if (($list['order_state'] == '已完成' || $list['order_state'] == '订单已完成') && $row['status'] == 2) {
                $DB->update('orders', ['status' => 1], ['id' => $id]);
            }
        }
        $input = $tool['input'] ? $tool['input'] : '下单QQ';
        if ($tool['is_curl'] == 4) $input = '联系方式';
        $inputs = explode('|', $tool['inputs']);
        $result = [
            'code'     => 0, 'msg' => 'succ', 'name' => $tool['name'], 'money' => $row['money'],
            'date'     => $row['addtime'], 'inputs' => showInputs($row, $input, $inputs),
            'list'     => $list, 'kminfo' => $kmdata, 'alert' => $tool['alert'], 'desc' => $tool['desc'],
            'status'   => $row['status'], 'result' => $row['result'],
            'complain' => intval($conf['show_complain']), 'islogin' => $islogin2,
            'kf_info'  => [ // 客服按钮信息
                'show_order_kf'      => empty($conf['show_order_kf']) ? 0 : intval($conf['show_order_kf']), // 0 关闭，1 开启
                'show_order_kf_type' => $conf['show_order_kf_type'], // 类型：0：kf_qq，1：href
                'show_order_kf_href' => $conf['show_order_kf_href'], // href
                'show_order_kf_qq'   => $conf['show_order_kf_qq'], // kf_qq
            ],
        ];
        exit(json_encode($result));
        break;
    case 'changepwd':
        $orderid = daddslashes($_POST['id']);
        if (md5($orderid . SYS_KEY . $orderid) !== $_POST['skey']) exit('{"code":-1,"msg":"验证失败"}');
        $pwd = htmlspecialchars(trim(strip_tags(daddslashes($_POST['pwd']))));
        if (strlen($pwd) < 5) exit('{"code":-1,"msg":"请输入正确的密码"}');
        $row = $DB->get('orders', '*', ['id' => $orderid]);
        if ($row) {
            $flag = $DB->update('orders', ['input2' => $pwd], ['id' => $orderid]);
            if ($flag->rowCount() > 0) {
                $result = array("code" => 0, "msg" => "已成功修改密码");
            } else {
                $result = array("code" => 0, "msg" => "修改密码失败");
            }
        } else {
            $result = array("code" => -1, "msg" => "订单不存在");
        }
        exit(json_encode($result));
        break;
    case 'fill':
        $orderid = daddslashes($_POST['orderid']);
        if (md5($orderid . SYS_KEY . $orderid) !== $_POST['skey']) exit('{"code":-1,"msg":"验证失败"}');
        $row = $DB->get('orders', '*', ['id' => $orderid]);
        if ($row) {
            if ($row['status'] == 3) {
                $DB->update('orders', ['status' => 0, 'result' => null], ['id' => $orderid]);
                $result = array("code" => 0, "msg" => "已成功补交订单");
            } else {
                $result = array("code" => 0, "msg" => "该订单不符合补交条件");
            }
        } else {
            $result = array("code" => -1, "msg" => "订单不存在");
        }
        exit(json_encode($result));
        break;
    case 'checklogin':
        if ($islogin2 == 1) exit('{"code":1}');
        else exit('{"code":0}');
        break;
    case 'lqq':
        $qq = trim(daddslashes($_POST['qq']));
        if (empty($qq) || empty($_SESSION['addsalt']) || $_POST['salt'] != $_SESSION['addsalt']) exit('{"code":-5,"msg":"非法请求"}');
        get_curl($conf['lqqapi'] . $qq);
        $result = array("code" => 0, "msg" => "succ");
        exit(json_encode($result));
        break;
    case 'getCommentKS':
        $id       = trim(daddslashes($_GET['id']));
        $page     = intval($_GET['page']);
        $hashsalt = isset($_GET['hashsalt']) ? $_GET['hashsalt'] : null;
        if ($conf['verify_open'] == 1 && (empty($_SESSION['addsalt']) || $hashsalt != $_SESSION['addsalt'])) {
            exit('{"code":-1,"msg":"验证失败，请刷新页面重试"}');
        }
        $result = getKuaiShouCommentList($id, $page);
        if ($result[0] == false)
            exit(json_encode(['code' => -1, 'msg' => $result[1]]));
        exit($result[1]);
        break;
    case 'getshuoshuo':
        $uin      = trim(daddslashes($_GET['uin']));
        $page     = intval($_GET['page']);
        $hashsalt = isset($_GET['hashsalt']) ? $_GET['hashsalt'] : null;
        if ($conf['verify_open'] == 1 && (empty($_SESSION['addsalt']) || $hashsalt != $_SESSION['addsalt'])) {
            exit('{"code":-1,"msg":"验证失败，请刷新页面重试"}');
        }
        if (empty($uin)) exit('{"code":-5,"msg":"QQ号不能为空"}');
        $result = getshuoshuo($uin, $page);
        exit(json_encode($result));
        break;
    case 'getrizhi':
        $uin      = trim(daddslashes($_GET['uin']));
        $page     = intval($_GET['page']);
        $hashsalt = isset($_GET['hashsalt']) ? $_GET['hashsalt'] : null;
        if ($conf['verify_open'] == 1 && (empty($_SESSION['addsalt']) || $hashsalt != $_SESSION['addsalt'])) {
            exit('{"code":-1,"msg":"验证失败，请刷新页面重试"}');
        }
        if (empty($uin)) exit('{"code":-5,"msg":"QQ号不能为空"}');
        $result = getrizhi($uin, $page);
        exit(json_encode($result));
        break;
    case 'getkuaishou':
        $url = trim($_POST['url']);
        if (empty($url)) exit('{"code":-5,"msg":"url不能为空"}');
        $result = getkuaishou($url);
        exit(json_encode($result));
        break;
    case 'getdouyin':
        $url = trim($_POST['url']);
        if (empty($url)) exit('{"code":-5,"msg":"url不能为空"}');
        $result = getdouyin($url);
        exit(json_encode($result));
        break;
    case 'gethuoshan':
        $url = trim($_POST['url']);
        if (empty($url)) exit('{"code":-5,"msg":"url不能为空"}');
        $result = gethuoshan($url);
        exit(json_encode($result));
        break;
    case 'getxiaohongshu':
        $url = trim($_POST['url']);
        if (empty($url)) exit('{"code":-5,"msg":"url不能为空"}');
        $result = getxiaohongshu($url);
        exit(json_encode($result));
        break;
    case 'gift_start':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        if ($action == '') {
            if (!$conf['gift_open']) exit('{"code":-2,"msg":"网站未开启抽奖功能"}');
            if (!$conf['cjcishu']) exit('{"code":-2,"msg":"站长未设置每日抽奖次数！"}');
            $thtime  = date("Y-m-d") . ' 00:00:00';
            $cjcount = $DB->count('giftlog', [
                'AND' => [
                    'OR'         => [
                        'userid' => $cookiesid,
                        'ip'     => $clientip
                    ],
                    'addtime[>]' => $thtime,
                ],
            ]);
            if ($cjcount >= $conf['cjcishu']) {
                exit('{"code":-1,"msg":"' . $cjmsg . '"}');
            }
            $query = $DB->select('gift', '*', ['ok' => 0]);
            foreach ($query as $row) {
                $arr[] = array("id" => $row["id"], "tid" => $row["tid"], "name" => $row["name"]);
            }
            $rateall = $DB->sum('gift', 'rate', ['ok' => 0]);
            if ($rateall < 100) $arr[] = array("id" => 0, "tid" => 0, "name" => '未中奖');
            if (!$arr) {
                exit('{"code":-2,"msg":"站长未设置奖品"}');
            }
            $result = array("code" => 0, "data" => $arr);
            exit(json_encode($result));
        } else {
            $token = md5($_GET['r'] . SYS_KEY . $_GET['r']);
            exit('{"code":0,"token":"' . $token . '"}');
        }
        break;
    case 'gift_stop':
        if (!$conf['gift_open']) exit('{"code":-2,"msg":"网站未开启抽奖功能"}');
        if (!$conf['cjcishu']) exit('{"code":-2,"msg":"站长未设置每日抽奖次数！"}');
        $hashsalt = isset($_POST['hashsalt']) ? $_POST['hashsalt'] : null;
        $token    = isset($_POST['token']) ? $_POST['token'] : null;
        if ($conf['verify_open'] == 1 && (empty($_SESSION['addsalt']) || $hashsalt != $_SESSION['addsalt'])) {
            exit('{"code":-1,"msg":"验证失败，请刷新页面重试"}');
        }
        if (md5($_GET['r'] . SYS_KEY . $_GET['r']) !== $token) exit('{"code":-1,"msg":"请勿重复提交请求"}');
        $thtime  = date("Y-m-d") . ' 00:00:00';
        $cjcount = $DB->count('giftlog', [
            'AND' => [
                'OR'         => [
                    'userid' => $cookiesid,
                    'ip'     => $clientip
                ],
                'addtime[>]' => $thtime,
            ],
        ]);
        if ($cjcount >= $conf['cjcishu']) {
            exit('{"code":-1,"msg":"' . $cjmsg . '"}');
        }
        $prize_arr = array();
        $query     = $DB->select('gift', '*', ['ok' => 0]);
        $i         = 1;
        $bre       = $DB->count('gift', ['ok' => 0]);
        while ($i <= $bre) {
            foreach ($query as $row) {
                $prize_arr[] = array("id" => ($i = $i + 1) - 1, "gid" => $row["id"], "tid" => $row["tid"], "name" => $row["name"], "rate" => $row["rate"], "not" => 0);
            }
        }
        if (!$prize_arr) {
            exit('{"code":-2,"msg":"站长未设置奖品"}');
        }
        $rateall = $DB->sum('gift', 'rate', ['ok' => 0]);
        if ($rateall < 100) $prize_arr[] = array("id" => ($i = $i + 1) - 1, "gid" => 0, "tid" => 0, "name" => '未中奖', "rate" => 100 - $rateall, "not" => 1);
        foreach ($prize_arr as $key => $val) {
            $arr[$val["id"]] = $val["rate"];
        }
        $prize_id     = get_rand($arr);
        $data['rate'] = $prize_arr[$prize_id - 1]['rate'];
        $data['id']   = $prize_arr[$prize_id - 1]['id'];
        $data['gid']  = $prize_arr[$prize_id - 1]['gid'];
        $data['name'] = $prize_arr[$prize_id - 1]['name'];
        $data['tid']  = $prize_arr[$prize_id - 1]['tid'];
        $data['not']  = $prize_arr[$prize_id - 1]['not'];

        $gift_id = $DB->insert('giftlog', [
            'zid'     => $siterow['zid'] ? $siterow['zid'] : 1,
            'tid'     => $data['tid'],
            'gid'     => $data['gid'],
            'userid'  => $cookiesid,
            'ip'      => $clientip,
            'addtime' => $date,
            'status'  => 0,
        ]);
        if ($gift_id->rowCount()) {
            if ($data['not'] == 1) {
                exit('{"code":-1,"msg":"未中奖，谢谢参与！"}');
            }
            $gift_id              = $DB->id();
            $tool                 = $DB->get('tools', '*', ['tid' => $data['tid']]);
            $_SESSION['gift_tid'] = $data['tid'];
            $_SESSION['gift_id']  = $gift_id;
            unset($_SESSION['addsalt']);

            $result = array("code" => 0, "msg" => "succ", "cid" => $tool['cid'], "tid" => $data['tid'], "name" => $data['name']);
            exit(json_encode($result));
        } else {
            exit('{"code":-3,"msg":"' . $DB->error() . '"}');
        }
        break;
    case 'inviteurl':
        // $qq       = daddslashes($_POST['userqq']);
        $hashsalt = isset($_POST['hashsalt']) ? $_POST['hashsalt'] : null;
        // 改版新加，增加用户设定的商品自定义表单
        $inputvalue  = htmlspecialchars(trim(strip_tags(daddslashes($_POST['inputvalue']))));
        $inputvalue2 = htmlspecialchars(trim(strip_tags(daddslashes($_POST['inputvalue2']))));
        $inputvalue3 = htmlspecialchars(trim(strip_tags(daddslashes($_POST['inputvalue3']))));
        $inputvalue4 = htmlspecialchars(trim(strip_tags(daddslashes($_POST['inputvalue4']))));
        $inputvalue5 = htmlspecialchars(trim(strip_tags(daddslashes($_POST['inputvalue5']))));

//        if (!preg_match('/^[1-9][0-9]{4,9}$/i', $qq)) {
//            exitJson('QQ号码格式不正确', 0);
//        }
        $tid = isset($_POST['tid']) ? intval($_POST['tid']) : 0;
        if (empty($tid)) {
            $tid = $DB->get('invite_rules', 'tid', ['is_default' => 1]);
        }
        $tool = $DB->get('tools', '*', ['tid' => $tid, 'active' => 1]);
        if (empty($tool)) {
            exitJson('该商品已下架', 0);
        }
        $inputs = explode('|', $tool['inputs']);
        if ($inputs[0] && empty($inputvalue2) || $inputs[1] && empty($inputvalue3) || $inputs[2] && empty($inputvalue4) || $inputs[3] && empty($inputvalue5)) {
            exitJson('请确保各项不能为空');
        }
        if (!$inputs[0] && !empty($inputvalue2) || !$inputs[1] && !empty($inputvalue3) || !$inputs[2] && !empty($inputvalue4) || !$inputs[3] && !empty($inputvalue5)) {
            exitJson('验证失败');
        }
        $key   = random(6);
        $iprow = $DB->get('invite', '*', ['ip' => $clientip, 'tid' => $tid]);
        if ($iprow) {
            $code = 2;
            $url  = $siteurl . '?i=' . $iprow['key'];
        } else {
            if ($conf['verify_open'] == 1 && (empty($_SESSION['addsalt']) || $hashsalt != $_SESSION['addsalt'])) {
                exitJson('验证失败，请刷新页面重试');
            }
            $input = $inputvalue . ($inputvalue2 ? '|' . $inputvalue2 : null) . ($inputvalue3 ? '|' . $inputvalue3 : null) . ($inputvalue4 ? '|' . $inputvalue4 : null) . ($inputvalue5 ? '|' . $inputvalue5 : null);
            $flag  = $DB->insert('invite', [
                'tid'   => $tid,
                'input' => $input,
                'key'   => $key,
                'ip'    => $clientip,
                'date'  => $date,
            ]);
            if ($flag->rowCount()) {
                unset($_SESSION['addsalt']);
                $code = 1;
                $url  = $siteurl . '?i=' . $key;
            } else {
                exitJson('错误信息：' . $DB->error());
            }
        }
        if ($conf['fanghong_api'] == 2 || $conf['fanghong_api'] == 1) {
            $url = fanghongvip($url);
            if ($url['code'] == -2)
                $url = $url['msg'];
            else {
                foreach ($url['data'] as $value) {
                    if (!empty($value['url'])) {
                        $url = $value['url'];
                        break;
                    }
                }
            }
        } else if ($conf['fanghong_api'] > 0) {
            $url = fanghongdwz($url);
        }
        //防红接口使用
        echo json(['code' => $code, 'msg' => 'success', 'url' => $url]);
        break;
    case 'cart_info':
        if ($conf['shoppingcart'] == 1) {
            $cart_count = $DB->count('cart', ['AND' => ['userid' => $cookiesid, 'status[<]' => 1]]);
        }
        $result = array('code' => 0, 'msg' => 'succ', 'count' => $cart_count);
        exit(json($result));
        break;
    case 'cart_buy':
        $shop_ids = $_POST['shop_id'];
        $hashsalt = isset($_POST['hashsalt']) ? $_POST['hashsalt'] : null;
        if ($conf['verify_open'] == 1 && (empty($_SESSION['addsalt']) || $hashsalt != $_SESSION['addsalt'])) {
            exit('{"code":-1,"msg":"验证失败，请刷新页面重试"}');
        }
        $allmoney = 0;
        $ids      = array();
        foreach ($shop_ids as $shop_id) {
            $cart_item = $DB->get('cart', '*', ['id' => intval($shop_id)]);
            if (!$cart_item) exit('{"code":-1,"msg":"商品不存在！"}');
            if ($cart_item['userid'] != $cookiesid || $cart_item['status'] > 1) exit('{"code":-1,"msg":"商品权限校验失败"}');
            if ($cart_item['money'] == '0' || !preg_match('/^[0-9.]+$/', $cart_item['money'])) exit('{"code":-1,"msg":"商品金额不合法"}');
            $ids[]    = intval($shop_id);
            $allmoney += floatval($cart_item['money']);
            $DB->update('cart', ['status' => 1], ['id' => $cart_item['id']]);
        }
        if (count($ids) == 0) exit('{"code":-1,"msg":"您未在购物车添加任何商品"}');
        $toolname = $DB->get('tools', 'name', ['tid' => $cart_item['tid']]);
        $toolname = $toolname . '等多件';
        $input    = implode('|', $ids);
        $trade_no = date("YmdHis") . rand(111, 999);
        // 如果是分享推广商品
        $invite_row = $DB->get('invite', ['[><]invite_rules' => 'tid'], ['invite.id', 'invite.tid', 'invite.date'], ['invite.id' => $invite_id, 'invite_rules.status' => 1]);
        // 如果不存在推广数据及过期的链接
        if (empty($invite_row) || strtotime($invite_row['date']) + $invite_expire_in <= time()) {
            $invite_id = 0;
        }
        $orderData = [
            'trade_no' => $trade_no,
            'tid'      => -3,
            'zid'      => $siterow['zid'] ? $siterow['zid'] : 1,
            'input'    => $input,
            'num'      => count($ids),
            'name'     => $toolname,
            'money'    => $allmoney,
            'ip'       => $clientip,
            'userid'   => $cookiesid,
            'inviteid' => $invite_id,
            'addtime'  => $date,
            'status'   => 0,
        ];
        hook('beforeCartOrderSubmit', ['only_balance' => $conf['forcermb'], 'order_data' => $orderData, 't_ids' => $ids]);
        $flag = $DB->insert('pay', $orderData);
        if ($flag->rowCount()) {
            unset($_SESSION['addsalt']);
            if ($conf['forcermb'] == 1) {
                $conf['alipay_api'] = 0;
                $conf['wxpay_api']  = 0;
                $conf['qqpay_api']  = 0;
            }
            exit('{"code":0,"msg":"提交订单成功！","trade_no":"' . $trade_no . '","need":"' . $allmoney . '","pay_alipay":"' . $conf['alipay_api'] . '","pay_wxpay":"' . $conf['wxpay_api'] . '","pay_qqpay":"' . $conf['qqpay_api'] . '","pay_rmb":"' . $islogin2 . '","user_rmb":"' . $userrow['rmb'] . '"}');
        } else {
            exit('{"code":-1,"msg":"提交订单失败！' . $DB->error() . '"}');
        }
        break;
    case 'cart_cancel':
        $orderid  = isset($_POST['orderid']) ? daddslashes($_POST['orderid']) : exit('{"code":-1,"msg":"订单号未知"}');
        $hashsalt = isset($_POST['hashsalt']) ? $_POST['hashsalt'] : null;
        $srow     = $DB->query("SELECT * FROM `{$dbconfig['dbqz']}_pay` WHERE `trade_no` = '{$orderid}' FOR UPDATE")->fetch(2);
        if (!$srow['trade_no'] || $srow['userid'] != $cookiesid) exit('{"code":-1,"msg":"订单号不存在！"}');
        if ($srow['status'] == 0) {
//            $DB->delete('pay', ['trade_no' => $orderid]);
            $input = explode('|', $srow['input']);
            $ids   = implode(',', $input);
            $DB->update('cart', ['status' => 0], [
                'AND' => ['id' => $ids, 'status' => 1],
            ]);
            if ($conf['verify_open'] == 1) {
                $_SESSION['addsalt'] = $hashsalt;
            }
        }
        exit('{"code":0,"msg":"ok"}');
        break;
    case 'cart_empty':
        $flag = $DB->delete('cart', ['AND' => ['userid' => $cookiesid, 'status' => 0]]);
        if ($flag) {
            exit('{"code":0,"msg":"清空购物车成功！"}');
        } else {
            exit('{"code":-1,"msg":"清空购物车失败！' . $DB->error() . '"}');
        }
        break;
    case 'cart_shop_del':
        $id        = intval($_POST['id']);
        $cart_item = $DB->get('cart', '*', ['id' => $id]);
        if (!$cart_item) exit('{"code":-1,"msg":"商品不存在！"}');
        if ($cart_item['userid'] != $cookiesid || $cart_item['status'] > 1) exit('{"code":-1,"msg":"商品权限校验失败"}');
        if ($DB->delete('cart', ['id' => $id])) {
            exit('{"code":0,"msg":"商品删除成功！"}');
        } else {
            exit('{"code":-1,"msg":"商品删除失败！' . $DB->error() . '"}');
        }
        break;
    case 'cart_shop_item':
        $id        = intval($_POST['id']);
        $cart_item = $DB->get('cart', '*', ['id' => $id]);
        if (!$cart_item) exit('{"code":-1,"msg":"商品不存在！"}');
        if ($cart_item['userid'] != $cookiesid || $cart_item['status'] > 1) exit('{"code":-1,"msg":"商品权限校验失败"}');
        $tool       = $DB->get('tools', '*', ['tid' => $cart_item['tid']]);
        $input      = $tool['input'] ? $tool['input'] : '下单ＱＱ';
        $inputs     = explode('|', $tool['inputs']);
        $inputvalue = explode('|', $cart_item['input']);
        $data       = '<div class="panel-body">';
        if ($tool['value'] > 1) $data .= '<div class="form-group"><div class="input-group"><div class="input-group-addon">下单数量</div><input type="text" id="shop_count" value="" class="form-control" disabled/></div></div>';
        $data .= '<input type="hidden" id="value" value="' . ($tool['value'] ? $tool['value'] : 1) . '"/><div class="form-group"><div class="input-group"><div class="input-group-addon" id="inputname">下单份数</div><input type="text" id="num" value="' . $cart_item['num'] . '" class="form-control" required/></div>';
        if ($tool['max'] > 1) $data .= '<small class="help-block"><i class="fa fa-info-circle"></i>&nbsp;该商品下单份数不能超过<b>' . $tool['max'] . '</b>份</small></div>';
        else $data .= '</div>';
        $data .= '<div class="form-group"><div class="input-group"><div class="input-group-addon" id="inputname">' . $input . '</div><input type="text" id="inputvalue" value="' . $inputvalue[0] . '" class="form-control" required/></div></div>';
        if ($inputs[0]) $data .= '<div class="form-group"><div class="input-group"><div class="input-group-addon" id="inputname2">' . $inputs[0] . '</div><input type="text" id="inputvalue2" value="' . $inputvalue[1] . '" class="form-control" required/></div></div>';
        if ($inputs[1]) $data .= '<div class="form-group"><div class="input-group"><div class="input-group-addon" id="inputname3">' . $inputs[1] . '</div><input type="text" id="inputvalue3" value="' . $inputvalue[2] . '" class="form-control" required/></div></div>';
        if ($inputs[2]) $data .= '<div class="form-group"><div class="input-group"><div class="input-group-addon" id="inputname4">' . $inputs[2] . '</div><input type="text" id="inputvalue4" value="' . $inputvalue[3] . '" class="form-control" required/></div></div>';
        if ($inputs[3]) $data .= '<div class="form-group"><div class="input-group"><div class="input-group-addon" id="inputname5">' . $inputs[3] . '</div><input type="text" id="inputvalue5" value="' . $inputvalue[4] . '" class="form-control" required/></div></div>';
        $data   .= '<input type="submit" id="save" onclick="cart_shop_save(' . $id . ')" class="btn btn-primary btn-block" value="保存修改"></div>';
        $data   .= '<script>$("#num").keyup(function () {	var i = parseInt($("#num").val()); if(isNaN(i))return false; if(i<1) $("#num").val(1); var count = parseInt($("#value").val()); count = count * i; $("#shop_count").val(count+"个");});	$("#num").keyup();</script>';
        $result = array("code" => 0, "msg" => "succ", "data" => $data);
        exit(json_encode($result));
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
        $res           = $PM->trigger($class, 'publicAjaxFunction');
        $res['msg']    = isset($res['msg']) ? $res['msg'] : '';
        $res['status'] = isset($res['status']) ? $res['status'] : 0;
        $res['data']   = isset($res['data']) ? $res['data'] : [];
        echo DSReturn($res['msg'], $res['status'], $res['data']);
        break;
    case 'getVerifyCodeImg':
        $typeList = ['viewVerifyCode', 'login', 'register'];

        $type = $_GET['type'];
        if (!in_array($type, $typeList))
            exit();
        define('ROOT_PATH', dirname(__FILE__) . '/user/');
        require './includes/ValidateCode.php';
        $_vc = new ValidateCode(4, 130, 40);
        $_vc->doimg();
        $_SESSION[$type] = $_vc->getCode();
        break;
    case 'verifyCode':
        $typeList = ['viewVerifyCode', 'login', 'register'];

        $type = $_GET['type'];
        if (!in_array($type, $typeList))
            exitJson('无效验证方式', -1);
        $code = strtolower($_POST['code']);
        if (empty($code) || empty($_SESSION[$type]))
            exitJson('验证码错误', -1);
        if (strtolower($_SESSION[$type]) != $code) {
            unset($_SESSION[$type]);
            exitJson('验证码错误', -1);
        }
        if ($type == 'viewVerifyCode')
            $_SESSION['inviteViewVerify'] = 'ok';
        exitJson('验证码正确', 0);
        break;
    case 'epayOrderReturnCheck':
        $verifyData = $_POST['verifyData'];
        if (empty($verifyData))
            exitJson('请求数据不能为空', -1);
        $verifyData = json_decode($verifyData, true);
        if ($verifyData === false)
            exitJson('分析数据异常，请刷新页面重试', -1);
        //检查数据

        $_GET['type'] = $verifyData['type'];
        $clientip = real_ip();
        $payapi   = pay_api();
        require_once ROOT . '/other/epay/epay.config.php';
        //载入配置文件

        if (function_exists('set_time_limit') && function_exists('ignore_user_abort')) {
            set_time_limit(0);
            ignore_user_abort(true);
        }
        //设置超时时间

        {
            $model         = new EpayV1Model($alipay_config['apiurl'], $alipay_config['partner'], $alipay_config['key']);
            $verify_result = $model->signParam($verifyData) == $verifyData['sign'];
            if ($verify_result && ($conf['alipay_api'] == 2 || $conf['qqpay_api'] == 2 || $conf['wxpay_api'] == 2 || $conf['tenpay_api'] == 2)) {
                //商户订单号
                $out_trade_no = daddslashes($verifyData['out_trade_no']);
                //支付宝交易号
                $trade_no = $verifyData['trade_no'];
                //交易状态
                $trade_status = $verifyData['trade_status'];
                //金额
                $money = $verifyData['money'];
                $DB->pdo->beginTransaction();
                if ($verifyData['trade_status'] == 'TRADE_FINISHED' || $verifyData['trade_status'] == 'TRADE_SUCCESS') {
                    $srow = $DB->query('SELECT * FROM `' . $dbconfig['dbqz'] . '_pay` WHERE `trade_no` = :outTradeNo LIMIT 1 FOR UPDATE', [':outTradeNo' => $out_trade_no])->fetch(PDO::FETCH_ASSOC);

                    if($srow === false){
                        $DB->pdo->rollBack();
                        exitJson('订单不存在，刷新页面重试',-4);
                    }

                    if ($srow['status'] == 1) {
                        $DB->pdo->rollBack();
                        exitJson('您所购买的商品已付款成功，感谢购买！', 0, [
                            'outTradeNo' => $out_trade_no,
                            'tid'        => $srow['tid']
                        ]);
                    }
                    while (!empty($conf['epay_notify_verify']) && $conf['epay_notify_verify'] == 1) {
                        $orderInfo = $model->getOrderInfo($out_trade_no, 'out_trade_no');
                        if ($orderInfo[0] === false) {
                            usleep(200000); // 降低频繁，等待一下 200ms
                            if ($orderInfo[2] === -1) {
                                $orderInfo = $model->getOrderInfo($out_trade_no, 'out_trade_no');
                                if ($orderInfo[0] === false) {
                                    $orderInfo = [
                                        true,
                                        [
                                            'status' => 1,
                                            'money' => $srow['money']
                                        ]
                                    ];
                                }
                            }
                        }
                        $orderInfo = $orderInfo[1];

                        if ($orderInfo['status'] != 1 || $orderInfo['money'] != $srow['money']) {
                            $DB->pdo->rollBack();
                            exitJson('订单真实性校验失败，请刷新页面重试', -3);
                            exit;
                        }
                        break;
                    }

                    if ($srow['status'] == 0 && $srow['money'] == $money) {
                        $updateResult = $DB->update('pay', ['status' => 1], ['trade_no' => $out_trade_no, 'LIMIT' => 1]);
                        if ($updateResult->rowCount() > 0) {
                            $DB->update('pay', ['endtime' => $date], ['trade_no' => $out_trade_no, 'LIMIT' => 1]);
                            $DB->pdo->commit();
                            processOrder($srow);
                        } else {
                            $DB->pdo->rollBack();
                        }
                    }

                    exitJson('您所购买的商品已付款成功，感谢购买！', 0, [
                        'outTradeNo' => $out_trade_no,
                        'tid'        => $srow['tid']
                    ]);
                } else {
                    exitJson('订单回调状态尚未支付，请返回来支付页面重试。', -1);
                }
            } else {
                //验证失败
                exitJson('订单签名校验失败，请刷新页面重试。', -1);
            }
        }
        exitJson('未知错误，请刷新页面重试。', -1);
        break;
    default:
        echo json(['code' => -4, 'msg' => '非法操作']);
        break;
}
