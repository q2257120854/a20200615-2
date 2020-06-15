<?php
include '../includes/common.php';
$act = isset($_GET['act']) ? daddslashes($_GET['act']) : null;
@header('Content-Type: application/json; charset=UTF-8');
switch ($act) {
    case 'checkdomain':
        $qz     = daddslashes($_GET['qz']);
        $domain = $qz . '.' . daddslashes($_GET['domain']);
        $srow   = $DB->get('site', '*', ['OR' => ['domain' => $domain, 'domain2' => $domain]]);
        if ($srow) exit('1');
        else exit('0');
        break;
    case 'checkuser':
        $user = daddslashes($_GET['user']);
        $srow = $DB->get('site', '*' . ['user' => $user]);
        if ($srow) exit('1');
        else exit('0');
        break;
    case 'reguser':
        if ($islogin2 == 1) exit('{"code":-1,"msg":"您已登陆！"}');
        elseif ($conf['user_open'] == 0) exit('{"code":-1,"msg":"当前站点未开启用户注册功能！"}');
        $user              = trim(htmlspecialchars(strip_tags(daddslashes($_POST['user']))));
        $pwd               = trim(htmlspecialchars(strip_tags(daddslashes($_POST['pwd']))));
        $qq                = trim(daddslashes($_POST['qq']));
        $hashsalt          = isset($_POST['hashsalt']) ? $_POST['hashsalt'] : null;
        $code              = isset($_POST['code']) ? $_POST['code'] : null;
        $geetest_challenge = isset($_POST['geetest_challenge']) ? $_POST['geetest_challenge'] : null;
        $geetest_validate  = isset($_POST['geetest_validate']) ? $_POST['geetest_validate'] : null;
        $geetest_seccode   = isset($_POST['geetest_seccode']) ? $_POST['geetest_seccode'] : null;
        if ($conf['verify_open'] == 1 && (empty($_SESSION['addsalt']) || $hashsalt != $_SESSION['addsalt'])) {
            exit('{"code":-1,"msg":"验证失败，请刷新页面重试"}');
        }
        if (!preg_match('/^[a-zA-Z0-9]+$/', $user)) {
            exit('{"code":-1,"msg":"用户名只能为英文或数字！"}');
        } elseif ($DB->count('site', ['user' => $user]) > 0) {
            exit('{"code":-1,"msg":"用户名已存在！"}');
        } elseif (strlen($pwd) < 6) {
            exit('{"code":-1,"msg":"密码不能低于6位"}');
        } elseif (strlen($qq) < 5 || !preg_match('/^[0-9]+$/', $qq)) {
            exit('{"code":-1,"msg":"QQ格式不正确！"}');
        } elseif ($pwd == $user) {
            exit('{"code":-1,"msg":"用户名和密码不能相同！"}');
        }
        $conf['captcha_open']     = isset($conf['captcha_open']) ? intval($conf['captcha_open']) : 0;
        $conf['captcha_open_reg'] = isset($conf['captcha_open_reg']) ? intval($conf['captcha_open_reg']) : 0;
        if ($conf['captcha_open'] == 1 && $conf['captcha_open_reg'] == 1) {
            if (isset($_POST['geetest_challenge']) && isset($_POST['geetest_validate']) && isset($_POST['geetest_seccode'])) {
                require_once SYSTEM_ROOT . 'class.geetestlib.php';
                $GtSdk = new GeetestLib($conf['captcha_id'], $conf['captcha_key']);

                $data = array(
                    'user_id'     => $cookiesid,
                    'client_type' => "web",
                    'ip_address'  => $clientip
                );

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
                exit('{"code":2,"type":1,"msg":"请先完成验证"}');
            }
        } elseif ($conf['captcha_open'] == 2 && $conf['captcha_open_reg'] == 1) {
            if (isset($_POST['token'])) {
                require_once SYSTEM_ROOT . 'class.dingxiang.php';
                $client = new CaptchaClient($conf['captcha_id'], $conf['captcha_key']);
                $client->setTimeOut(2);
                $response = $client->verifyToken($_POST['token']);
                if ($response->result) {
                    /**token验证通过，继续其他流程**/
                } else {
                    /**token验证失败**/
                    exit('{"code":-1,"msg":"验证失败，请重新验证"}');
                }
            } else {
                exit('{"code":2,"type":2,"appid":"' . $conf['captcha_id'] . '","msg":"请先完成验证"}');
            }
        } elseif (!$code || strtolower($code) != $_SESSION['vc_code']) {
            unset($_SESSION['vc_code']);
            exit('{"code":2,"msg":"验证码错误！"}');
        }
        $insertData = [
            'upzid'       => isset($siterow['zid']) ? $siterow['zid'] : 0,
            'power'       => 0,
            'domain'      => null,
            'domain2'     => null,
            'user'        => $user,
            'pwd'         => $pwd,
            'rmb'         => 0,
            'qq'          => $qq,
            'sitename'    => null,
            'keywords'    => $conf['keywords'],
            'template'    => $conf['template'],
            'addtime'     => $date,
            'lasttime'    => $date,
            'status'      => 1,
        ];
        // 分站自动复制主站公告代码
        if (!empty($conf['fenzhan_html']) && $conf['fenzhan_html'] == 1) {
            $insertData['description'] = $conf['description'];
            $insertData['anounce'] = $conf['anounce'];
            $insertData['bottom'] = $conf['bottom'];
            $insertData['modal'] = $conf['modal'];
        } else {
            $insertData['description'] = '';
            $insertData['anounce'] = '';
            $insertData['bottom'] = '';
            $insertData['modal'] = '';
        }
        $zid = $DB->insert('site', $insertData);
        if ($zid->rowCount()) {
            $zid = $DB->id();
            unset($_SESSION['addsalt']);
            $DB->update('orders', ['userid' => $zid], ['userid' => $cookiesid]);
            $session = md5($user . $pwd . $password_hash);
            $token   = authcode("{$zid}\t{$session}", 'ENCODE', SYS_KEY);
            setcookie("user_token", $token, time() + 604800, '/');
            log_result('分站登录', 'User:' . $user . ' IP:' . $clientip, null, 1);
            exit('{"code":1,"msg":"注册用户成功","zid":"' . $zid . '"}');
        } else {
            exit('{"code":-1,"msg":"注册用户失败！' . $DB->error() . '"}');
        }
        break;
    case 'paysite':
        if ($islogin2 == 1 && $userrow['power'] > 0) exit('{"code":-1,"msg":"您已开通过分站！"}');
        elseif ($conf['fenzhan_buy'] == 0) exit('{"code":-1,"msg":"当前站点未开启自助开通分站功能！"}');
        if ($is_fenzhan == true && $siterow['power'] == 2) {
            if ($siterow['ktfz_price'] > 0) $conf['fenzhan_price'] = $siterow['ktfz_price'];
            if ($conf['fenzhan_cost2'] <= 0) $conf['fenzhan_cost2'] = $conf['fenzhan_price2'];
            if ($siterow['ktfz_price2'] > 0 && $siterow['ktfz_price2'] >= $conf['fenzhan_cost2']) $conf['fenzhan_price2'] = $siterow['ktfz_price2'];
        }
        $kind     = intval($_POST['kind']);
        $qz       = trim(strtolower(daddslashes($_POST['qz'])));
        $domain   = trim(strtolower(htmlspecialchars(strip_tags(daddslashes($_POST['domain'])))));
        $user     = trim(htmlspecialchars(strip_tags(daddslashes($_POST['user']))));
        $pwd      = trim(htmlspecialchars(strip_tags(daddslashes($_POST['pwd']))));
        $name     = trim(htmlspecialchars(strip_tags(daddslashes($_POST['name']))));
        $qq       = trim(daddslashes($_POST['qq']));
        $hashsalt = isset($_POST['hashsalt']) ? $_POST['hashsalt'] : null;
        $domain   = $qz . '.' . $domain;
        if ($conf['verify_open'] == 1 && (empty($_SESSION['addsalt']) || $hashsalt != $_SESSION['addsalt'])) {
            exit('{"code":-1,"msg":"验证失败，请刷新页面重试"}');
        }
        // 查找前缀是否存在
        $prefix_use = $DB->count('site', ['OR' => ['domain' => $domain, 'domain2' => $domain]]);
        if ($kind != 0 && $kind != 1 && $kind != 2) {
            exit('{"code":-1,"msg":"分站类型错误！"}');
        } elseif (strlen($qz) < 2 || strlen($qz) > 16 || !preg_match('/^[a-z0-9\-]+$/', $qz)) {
            exit('{"code":-1,"msg":"域名前缀不合格！"}');
        } elseif (!preg_match('/^[a-zA-Z0-9\_\-\.]+$/', $domain)) {
            exit('{"code":-1,"msg":"域名格式不正确！"}');
        } elseif ($prefix_use > 0 || $qz == 'www' || $domain == $_SERVER['HTTP_HOST'] || in_array($domain, explode(',', $conf['fenzhan_remain']))) {
            exit('{"code":-1,"msg":"此前缀已被使用！"}');
        }
        if (!$islogin2) {
            if (!preg_match('/^[a-zA-Z0-9]+$/', $user)) {
                exit('{"code":-1,"msg":"用户名只能为英文或数字！"}');
            } elseif ($DB->count('site', ['user' => $user]) > 0) {
                exit('{"code":-1,"msg":"用户名已存在！"}');
            } elseif (strlen($pwd) < 6) {
                exit('{"code":-1,"msg":"密码不能低于6位"}');
            } elseif (strlen($name) < 2) {
                exit('{"code":-1,"msg":"网站名称太短！"}');
            } elseif (strlen($qq) < 5 || !preg_match('/^[0-9]+$/', $qq)) {
                exit('{"code":-1,"msg":"QQ格式不正确！"}');
            } elseif ($pwd == $user) {
                exit('{"code":-1,"msg":"用户名和密码不能相同！"}');
            }
        }
        $fenzhan_expiry = $conf['fenzhan_expiry'] > 0 ? $conf['fenzhan_expiry'] : 12;
        $endtime        = date("Y-m-d H:i:s", strtotime("+ {$fenzhan_expiry} months", time()));
        $trade_no       = date("YmdHis") . rand(111, 999);
        if ($kind == 2) {
            $need = $conf['fenzhan_price2'];
        } else {
            $need = $conf['fenzhan_price'];
        }
        if ($need == 0) {
            if ($conf['captcha_open_free'] == 1 && $conf['captcha_open'] == 1) {
                if (isset($_POST['geetest_challenge']) && isset($_POST['geetest_validate']) && isset($_POST['geetest_seccode'])) {
                    require_once SYSTEM_ROOT . 'class.geetestlib.php';
                    $GtSdk = new GeetestLib($conf['captcha_id'], $conf['captcha_key']);

                    $data = array(
                        'user_id'     => $cookiesid,
                        'client_type' => "web",
                        'ip_address'  => $clientip
                    );

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
                    exit('{"code":2,"type":1,"msg":"请先完成验证"}');
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
                        exit('{"code":-1,"msg":"验证失败，请重新验证"}');
                    }
                } else {
                    exit('{"code":2,"type":2,"appid":"' . $conf['captcha_id'] . '","msg":"请先完成验证"}');
                }
            }
            $keywords    = $conf['keywords'];
            $description = '';
            $anounce = '';
            $alert = '';
            if (!empty($conf['fenzhan_html']) && $conf['fenzhan_html'] == 1) {
                $anounce = $conf['anounce'];
                $alert   = $conf['alert'];
                $description = $conf['description'];
            }
            if ($islogin2 == 1) {
                $DB->update('site', [
                    'power'       => $kind,
                    'domain'      => $domain,
                    'sitename'    => $name,
                    'keywords'    => $keywords,
                    'description' => $description,
                    'anounce'     => $anounce,
                    'alert'       => $alert,
                    'endtime'     => $endtime,
                ], ['zid' => $userrow['zid']]);
                $zid = $userrow['zid'];
            } else {
                $zid = $DB->insert('site', [
                    'upzid'       => filterParam($siterow['zid'], 0),
                    'power'       => $kind,
                    'domain'      => $domain,
                    'domain2'     => null,
                    'user'        => $user,
                    'pwd'         => $pwd,
                    'rmb'         => 0,
                    'qq'          => $qq,
                    'sitename'    => $name,
                    'keywords'    => $keywords,
                    'description' => $description,
                    'anounce'     => $anounce,
                    'alert'       => $alert,
                    'addtime'     => $date,
                    'endtime'     => $endtime,
                    'status'      => 1,
                    'template'    => $conf['template']
                ]);
            }
            if ($zid->rowCount()) {
                $zid                = $DB->id();
                $_SESSION['newzid'] = $zid;
                unset($_SESSION['addsalt']);
                if (!$islogin2) {
                    $DB->update('orders', ['userid' => $zid], ['userid' => $cookiesid]);
                }
                $DB->update('orders', ['zid' => $zid], ['userid' => $zid]);
                exit('{"code":1,"msg":"开通分站成功","zid":"' . $zid . '"}');
            } else {
                exit('{"code":-1,"msg":"开通分站失败！' . $DB->error() . '"}');
//                exit(json_encode(['code' => -1, 'msg' => '开通分站失败！', 'error' => $DB->error()]));
            }
        } else {
            if ($islogin2 == 1) {
                $input = 'update|' . $userrow['zid'] . '|' . $kind . '|' . $domain . '|' . $name . '|' . $endtime;
            } else {
                $input = 'add|' . $kind . '|' . $domain . '|' . $user . '|' . $pwd . '|' . $name . '|' . $qq . '|' . $endtime;
            }
            $flag = $DB->insert('pay', [
                'trade_no' => $trade_no,
                'tid'      => -2,
                'zid'      => $siterow['zid'] ? $siterow['zid'] : 1,
                'input'    => $input,
                'num'      => 1,
                'name'     => '自助开通分站',
                'money'    => $need,
                'ip'       => $clientip,
                'userid'   => $cookiesid,
                'addtime'  => $date,
                'status'   => 0,
            ]);
            if ($flag->rowCount()) {
                unset($_SESSION['addsalt']);
                exit('{"code":0,"msg":"提交订单成功！","trade_no":"' . $trade_no . '","need":"' . $need . '","pay_alipay":"' . $conf['alipay_api'] . '","pay_wxpay":"' . $conf['wxpay_api'] . '","pay_qqpay":"' . $conf['qqpay_api'] . '","pay_rmb":"' . $islogin2 . '","user_rmb":"' . $userrow['rmb'] . '"}');
            } else {
                exit('{"code":-1,"msg":"提交订单失败！' . $DB->error() . '"}');
            }
        }
        break;
    case 'up_price':
        if (!$islogin2) exit('{"code":-1,"msg":"未登录"}');
        unset($islogin2);
        $price_obj = new Price($userrow['zid'], $userrow);
        $up        = intval($_POST['up']);
        if ($up <= 0) exit('{"code":-1,"msg":"输入值不正确"}');
        $list = $DB->select('tools', '*', ['active' => 1]);
        $data = array();
        foreach ($list as $row) {
            if ($row['price'] == 0) {
                continue;
            }
            if (strpos($row['name'], '免费') !== false) {
                continue;
            }
            $price_obj->setToolInfo($row['tid'], $row);
            $price                      = $price_obj->getToolPrice($tid);
            $a                          = (float)$up / 100;
            $data[$row['tid']]['price'] = round($price * ($a + 1), 2);
        }
        $array_data = serialize($data);
        $DB->update('site', ['price' => $array_data], ['zid' => $userrow['zid']]);
        exit(json_encode(['code' => 0]));
        break;
    case 'create_url':
        if (!$islogin2) exit('{"code":-1,"msg":"未登录"}');
        $force = trim(daddslashes($_GET['force']));
        if (!$userrow['domain']) exit('{"code":-1,"msg":"当前分站还未绑定域名"}');
        $url = 'http://' . $userrow['domain'] . '/';

        if ($conf['fanghong_api'] == 2 || $conf['fanghong_api'] == 1) {
            $turl = fanghongvip($url);
            if ($turl['code'] == -2) {
                $turl = $turl['msg'];
            } else {
                foreach ($turl['data'] as $value) {
                    if (!empty($value['url'])) {
                        $turl = $value['url'];
                        break;
                    }
                }
            }
        } else if ($conf['fanghong_api'] > 0) {
            $turl = fanghongdwz($url);
        }

        if ($turl == $url) {
            $result = array('code' => -1, 'msg' => '生成失败，请联系站长更换接口');
        } elseif (strpos($turl, '/')) {
            $result = array('code' => 0, 'msg' => 'succ', 'url' => $turl);
        } else {
            $result = array('code' => -1, 'msg' => '生成失败：' . $turl);
        }
        exit(json_encode($result));
        break;
    case 'qiandao':
        if (!$islogin2) exitJson('未登录');
        if (!$conf['qiandao_reward']) exitJson('当前站点未开启签到功能');
        if (!isset($_SESSION['isqiandao']) || $_SESSION['isqiandao'] != $userrow['zid'])
            exitJson('校验失败，请刷新页面重试');
        $day     = date("Y-m-d");
        $lastday = date("Y-m-d", strtotime("-1 day"));
        if ($DB->has('qiandao', ['AND' => ['zid' => $userrow['zid'], 'date' => $day], 'ORDER' => ['id' => 'DESC']])) {
            exitJson('今天已经签到过了, 明天在来吧！');
        }
        $row = $DB->get('qiandao', '*', ['AND' => ['zid' => $userrow['zid'], 'date' => $lastday], 'ORDER' => ['id' => 'DESC']]);
        if (!empty($row)) {
            $continue = $row['continue'] + 1;
        } else {
            $continue = 1;
        }
//        if ($continue > $conf['qiandao_day']) $continue = $conf['qiandao_day']; // 因改版注释
        $reward = $conf['qiandao_reward'];
        if (strpos($reward, '|')) {
            $reward = explode('|', $reward);
            $reward = $reward[$userrow['power']];
            if (!$reward) exitJson('未配置好签到奖励余额初始值');
        }
        // 改版：每天递增的金额 = 奖励余额初始值 * 每日递增倍数 * 连续签到数(第一天不算)，再加上[奖励余额初始值]
        // 改版：当达到连续签到天数等于[最多递增天数]时，连续签到金额等于[奖励余额初始值]
        if ($conf['qiandao_day'] > 0 && $continue <= $conf['qiandao_day']) {
            $reward = $reward + ($reward * $conf['qiandao_mult'] * ($continue - 1));
        }
//        for ($i = 1; $i < $continue; $i++) { // 因改版注释
//            $reward *= $conf['qiandao_mult'];
//        }
        // 记录日志信息
//        log_result('前台用户签到', $reward, round($reward, 2), 1);
        // 四舍五入计算结果，保留两位小数
        $reward = round($reward, 2);
        $flag   = $DB->insert('qiandao', [
            'zid'      => $userrow['zid'],
            'qq'       => $userrow['qq'],
            'reward'   => $reward,
            'date'     => $day,
            'time'     => $date,
            'continue' => $continue,
        ]);
        if ($flag->rowCount()) {
            unset($_SESSION['isqiandao']);
            $DB->update('site', ['rmb[+]' => $reward], ['zid' => $userrow['zid']]);
            addPointRecord($userrow['zid'], $reward, '赠送', '您今天签到获得了' . $reward . '元奖励');
            $result = array('code' => 0, 'msg' => '签到成功，获得' . $reward . '元现金奖励！');
        } else {
            $result = array('code' => -1, 'msg' => '签到失败' . $DB->error());
        }
        exit(json($result));
        break;
    case 'qdcount':
        if (!$islogin2) exit('{"code":-1,"msg":"未登录"}');
        $day         = date("Y-m-d");
        $lastday     = date("Y-m-d", strtotime("-1 day"));
        $count1      = $DB->count('qiandao', ['date' => $day]);
        $count2      = $DB->count('qiandao', ['date' => $lastday]);
        $count3      = $DB->count('qiandao');
        $rewardcount = $DB->sum('qiandao', 'reward', ['zid' => $userrow['zid']]);
        $result = [
            'count1' => $count1,
            'count2' => $count2,
            'count3' => $count3,
            'rewardcount' => round($rewardcount, 2),
        ];
        exit(json($result));
        break;
    case 'msg':
        if (!$islogin2) exitJson('未登录');
        if ($userrow['power'] == 2) {
            $type = '0,2,4';
        } elseif ($userrow['power'] == 1) {
            $type = '0,2,3';
        } else {
            $type = '0,1';
        }
        $msgread = trim($userrow['msgread'], ',');
        if (empty($msgread)) $msgread = '0';
        $count        = $DB->count('message', [
            'AND' => [
                'id[!]'   => $msgread,
                'type[!]' => $type,
            ],
        ]);
        $count2       = $DB->count('workorder', [
            'AND' => [
                'zid'    => $userrow['zid'],
                'status' => 1,
            ],
        ]);
        $thtime       = date("Y-m-d") . ' 00:00:00';
        $income_today = $DB->sum('points', 'point', [
            'AND' => [
                'zid'        => $userrow['zid'],
                'action'     => '提成',
                'addtime[>]' => $thtime,
            ],
        ]);
        exit(json(['code' => 0, 'count' => $count, 'count2' => $count2, 'income_today' => round($income_today, 2)]));
        break;
    case 'msginfo':
        if (!$islogin2) exitJson('未登录');
        if ($userrow['power'] == 2) {
            $type = array(0, 2, 4);
        } elseif ($userrow['power'] == 1) {
            $type = array(0, 2, 3);
        } else {
            $type = array(0, 1);
        }
        $id  = intval($_GET['id']);
        $row = $DB->get('message', '*', ['AND' => ['id' => $id, 'active' => 1]]);
        if (!$row) {
            exitJson('当前消息不存在！');
        }
        if (!in_array($row['type'], $type))
            exitJson('你没有权限查看此消息内容');
        if (!in_array($id, explode(',', $userrow['msgread']))) {
            $msgread_n = $userrow['msgread'] . $id . ',';
            $DB->update('message', ['count[+]' => 1], ['id' => $id]);
            $DB->update('site', ['msgread' => $msgread_n], ['zid' => $userrow['zid']]);
        }
        $result = [
            'code' => 0,
            'msg' => 'succ',
            'title' => $row['title'],
            'type' => $row['type'],
            'content' => htmlspecialchars_decode($row['content']),
            'date' => $row['addtime']
        ];
        exit(json($result));
        break;
    case 'msg_notify':
        if (!$islogin2) exitJson('未登录');
        if ($userrow['power'] == 2) {
            $type = array(0, 2, 4);
        } elseif ($userrow['power'] == 1) {
            $type = array(0, 2, 3);
        } else {
            $type = array(0, 1);
        }
        $row = $DB->get('message', '*', ['active' => 1, 'ORDER' => ['id' => 'DESC']]);
        if (!$row) {
            exitJson('当前消息不存在！');
        }
        if (!in_array($row['type'], $type))
            exitJson('你没有权限查看此消息内容');
        if (in_array($row['id'], explode(',', $userrow['msgread']))) {
            exitJson('ok', 1);
        }
        $result = [
            'code' => 0,
            'msg' => 'success',
            'mid' => $row['id'],
            'title' => $row['title'],
            'type' => $row['type'],
            'content' => htmlspecialchars_decode($row['content']),
            'date' => $row['addtime']
        ];
        exit(json($result));
        break;
    case 'msg_notify_confirm':
        if (!$islogin2) exitJson('请登录后操作');
        if ($userrow['power'] == 2) {
            $type = array(0, 2, 4);
        } elseif ($userrow['power'] == 1) {
            $type = array(0, 2, 3);
        } else {
            $type = array(0, 1);
        }
        $id  = intval($_POST['mid']);
        $mid = $DB->get('message', 'id', ['active' => 1, 'id' => $id]);
        if (empty($mid)) exitJson('暂无该数据');
        if (!in_array($row['type'], $type))
            exitJson('你没有权限操作');
        if (!in_array($mid, explode(',', $userrow['msgread']))) {
            $msg_read_n = $userrow['msgread'] . $mid . ',';
            $f1 = $DB->update('message', ['count[+]' => 1], ['id' => $mid])->rowCount();
            $f2 = $DB->update('site', ['msgread' => $msg_read_n], ['zid' => $userrow['zid']])->rowCount();
            if ($f1 && $f2) exitJson('success', 0);
            exitJson('操作异常', -2);
        }
        exitJson('操作失败');
        break;
    case 'recharge':
        if (!$islogin2) exit('{"code":-1,"msg":"未登录"}');
        $value    = daddslashes($_GET['value']);
        $trade_no = date("YmdHis") . rand(111, 999);
        if (!is_numeric($value) || !preg_match('/^[0-9.]+$/', $value)) exit('{"code":-1,"msg":"提交参数错误！"}');
        $flag = $DB->insert('pay', [
            'trade_no' => $trade_no,
            'tid'      => -1,
            'input'    => $userrow['zid'],
            'name'     => '在线充值余额',
            'money'    => $value,
            'ip'       => $clientip,
            'addtime'  => $date,
            'status'   => 0,
        ]);
        if ($flag->rowCount()) {
            $result = [
                'code'     => 0,
                'msg'      => '提交订单成功！',
                'trade_no' => $trade_no,
                'money'    => $value,
                'name'     => '在线充值余额',
            ];
        } else {
            $result = [
                'code' => -1,
                'msg'  => '提交订单失败！',
            ];
        }
        exit(json_encode($result));
        break;
    case 'setClass':
        if (!$islogin2) exit('{"code":-1,"msg":"未登录"}');
        $cid       = intval($_GET['cid']);
        $active    = intval($_GET['active']);
        $classhide = explode(',', $userrow['class']);
        if ($active == 1 && in_array($cid, $classhide)) {
            $classhide = array_diff($classhide, array($cid));
        } elseif ($active == 0 && !in_array($cid, $classhide)) {
            $classhide[] = $cid;
        }
        $class = implode(',', $classhide);
        $DB->update('site', ['class' => $class], ['zid' => $userrow['zid']]);
        exit(json_encode(['code' => 0]));
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
        $res           = $PM->trigger($class, 'userAjaxFunction');
        $res['msg']    = isset($res['msg']) ? $res['msg'] : '';
        $res['status'] = isset($res['status']) ? $res['status'] : 0;
        $res['data']   = isset($res['data']) ? $res['data'] : [];
        echo DSReturn($res['msg'], $res['status'], $res['data']);
        break;
    default:
        exit(json_encode(['code' => -4, 'msg' => '非法操作']));
        break;
}