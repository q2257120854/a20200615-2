<?php
/**
 * 登录
 **/
$is_defend = true;
include('../includes/common.php');
if (isset($_GET['act']) && $_GET['act'] == 'login') {
    $user = daddslashes($_POST['user']);
    $pass = daddslashes($_POST['pass']);
    if (!$user || !$pass) {
        exit('{"code":-1,"msg":"用户名或密码不能为空"}');
    }
    if ($conf['captcha_open_login'] == 1 && $conf['captcha_open'] == 1) {
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
    } elseif ($conf['captcha_open_login'] == 1 && $conf['captcha_open'] == 2) {
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
    if (empty($_SESSION['loginToken']))
        exit(json_encode(['code' => -1, 'msg' => '用户名或密码不正确！']));
    $row = $DB->get('site', '*', ['user' => $user]);
    if ($row && $user === $row['user'] && $pass === $row['pwd']) {
        if ($row['status'] == 0) {
            exit(json([
                'code' => -1,
                'msg'  => '当前账号已被封禁！'
            ]));
        }
        unset($_SESSION['loginToken']);
        $userToken = hash('sha256', md5($user . $pass . SYS_KEY));
        //进行不可逆加密用户密码
        $userTokenEncode = aesEncrypt($row['zid'] . PHP_EOL . $userToken, SYS_KEY);
        //加密userToken
        setcookie('userToken', $userTokenEncode, time() + 604800, '/');
        //存储Token
        $result = siteAttr($row['zid'], 'loginToken', $userToken);

        log_result('分站登录', 'User:' . $user . ' IP:' . $clientip, null, 1);
        $DB->update('site', ['lasttime' => $date], ['zid' => $row['zid']]);
        exit('{"code":0,"msg":"登陆用户中心成功！"}');
    } else {
        exit('{"code":-1,"msg":"用户名或密码不正确！"}');
    }
} elseif (isset($_GET['logout'])) {
    setcookie('userToken', '', time() - 604800, '/');
    if(!empty($userrow)){
        siteAttr($userrow['zid'],'loginToken',null);
    }
    @header('Content-Type: text/html; charset=UTF-8');
    exit("<script>alert('您已成功注销本次登陆！');window.location.href='./login.php';</script>");
} elseif ($islogin2 == 1) {
    @header('Content-Type: text/html; charset=UTF-8');
    unset($_SESSION['loginToken']);
    exit("<script>alert('您已登陆！');window.location.href='./';</script>");
}
$title = '用户登录';
include './head2.php';
$_SESSION['loginToken'] = my_str_shuffle(9);
?>
<img src="<?php echo $background_image; ?>" alt="Full Background" class="full-bg full-bg-bottom animation-pulseSlow"
     ondragstart="return false;" oncontextmenu="return false;">
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-4 center-block " style="float: none;">
    <br/><br/><br/>
    <div class="widget">
        <div class="widget-content themed-background-flat text-center"
             style="background-image: url(<?php echo $cdnserver ?>assets/simple/img/userbg.jpg);background-size: 100% 100%;">
            <img class="img-circle" src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']; ?>&spec=100"
                 alt="Avatar" height="60" width="60"/>
            <p></p>
        </div>

        <div class="block">
            <div class="block-title">
                <div class="block-options pull-right">
                    <a href="../" class="btn btn-effect-ripple btn-default toggle-bordered enable-tooltip">返回首页</a>
                </div>
                <h2><i class="fa fa-user"></i>&nbsp;&nbsp;<b>用户登录</b></h2>
            </div>
            <form>
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                    <input type="text" name="user" value="" class="form-control" required="required" placeholder="用户名"/>
                </div>
                <br/>
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                    <input type="password" name="pass" class="form-control" required="required" placeholder="密码"/>
                </div>
                <br/>
                <?php if ($conf['captcha_open_login'] == 1 && $conf['captcha_open'] >= 1) { ?>
                    <input type="hidden" name="captcha_type" value="<?php echo $conf['captcha_open'] ?>"/>
                    <?php if ($conf['captcha_open'] == 2) { ?><input type="hidden" name="appid"
                                                                     value="<?php echo $conf['captcha_id'] ?>"/><?php } ?>
                    <div id="captcha" style="margin: auto;">
                        <div id="captcha_text">
                            正在加载验证码
                        </div>
                        <div id="captcha_wait">
                            <div class="loading">
                                <div class="loading-dot"></div>
                                <div class="loading-dot"></div>
                                <div class="loading-dot"></div>
                                <div class="loading-dot"></div>
                            </div>
                        </div>
                    </div>
                    <div id="captchaform"></div>
                    <br/>
                <?php } ?>
                <div class="form-group">
                    <input type="button" value="立即登陆" id="submit_login" class="btn btn-primary btn-block"/>
                </div>
                <hr>
                <div class="form-group">
                    <a href="findpwd.php" class="btn btn-info btn-rounded"><i class="fa fa-unlock"></i>&nbsp;找回密码</a>
                    <?php if ($conf['user_open'] == 1) { ?>
                        <a href="reg.php" class="btn btn-danger btn-rounded" style="float:right;"><i
                                    class="fa fa-user-plus"></i>&nbsp;注册账号</a>
                    <?php } else { ?>
                        <a href="regsite.php" class="btn btn-danger btn-rounded" style="float:right;"><i
                                    class="fa fa-user-plus"></i>&nbsp;开通分站</a>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
    <script src="<?php echo $cdnpublic ?>jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo $cdnpublic ?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo $cdnpublic ?>layer/2.3/layer.js"></script>
    <script src="../assets/js/login.js"></script>
</div>