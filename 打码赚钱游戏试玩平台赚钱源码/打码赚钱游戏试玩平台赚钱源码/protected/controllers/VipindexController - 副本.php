<?php

//个人中心
class VipindexController extends Controllervip {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('first', 'second', 'thirdly', 'fourthly', 'fifty', 'show', 'data', 'memimg', 'idcode', 'captcha', 'sendemail', 'note', 'idcheck', "idcodeinfo", "jypwd", "dlpwd", "jypwdcz", "phone"),
                'expression' => 'Yii::app()->user->isLogin()',
            ),
            array(
                'deny', //禁止
                'users' => array('*'), //*所有用户
            ),
        );
    }

    function actions() {
        return array(
            'captcha' => array(
                'class' => 'application.extensions.MyCaptchaAction',
                'width' => 82,
                'height' => 29,
                'padding' => 0, //文字周边填充大小
                'backColor' => 0xFFFFFF, //背景颜色
                'foreColor' => 0xBD3910, //字体颜色
                'minLength' => 4, //设置最短为6位
                'maxLength' => 4, //设置最长为7位,生成的code在6-7直接rand了
                'transparent' => FALSE, //显示为透明,默认中可以看到为false
                'offset' => 4, //设置字符偏移量
            )
        );
    }

    /*
     * 会员中心首页/兑换金豆
     */

    function actionShow() {
        $memid = $this->show_mem_id();
        $dhhld_model = new Dhhld();
        if (isset($_POST['Dhhld'])) {
            foreach ($_POST['Dhhld'] as $_k => $_v) {
                $dhhld_model->$_k = strip_tags(trim($_v));
            }
            $title = "成功兑换金豆";
            $hlb = $dhhld_model["hld"]; //兑换的金豆
            $reason = $title . "，扣除" . $hlb . "元宝";
            $dhhld_model->reason = $reason;
            $dhhld_model->source = 3; //来源元宝兑换
            $dhhld_model->type = 1;
            $dhhld_model->mem_id = $memid;
            if ($dhhld_model->save()) {
                $this->updhlb(-$hlb, 13, $reason, $memid, 0);
                $this->sendmessage($title, $reason, 1, $memid);
                Yii::app()->user->setFlash('dhhld', 'success');
            } else {
                Yii::app()->user->setFlash('dhhld', 'error');
            }
        }
        //玩宝转入
        $badyzr_model = new Badyzr();
        if (isset($_POST['Badyzr'])) {
            foreach ($_POST['Badyzr'] as $_k => $_v) {
                $badyzr_model->$_k = strip_tags(trim($_v));
            }
//            if ($badyzr_model->save()) {
//                $hlb = $badyzr_model["hlb"];
//                $title = "玩宝转入";
//                $reason = $title . $hlb . "元宝";
//                $this->updhlb(-$hlb, 25, $reason, $memid, 0);
//                $this->sendmessage($title, $reason, 1, $memid);
//                Yii::app()->user->setFlash('badyzr', 'success');
//            } else {
//                Yii::app()->user->setFlash('badyzr', 'error');
//            }
        }

        //玩宝转出
        $badyzc_model = new Badyzc();
        if (isset($_POST['Badyzc'])) {
            foreach ($_POST['Badyzc'] as $_k => $_v) {
                $badyzc_model->$_k = strip_tags(trim($_v));
            }
//            if ($badyzc_model->save()) {
//                $hlb = $badyzc_model["hlb"];
//                $title = "玩宝转出";
//                $reason = $title . $hlb . "元宝";
//                $this->updhlb($hlb, 25, $reason, $memid, 0);
//                $this->sendmessage($title, $reason, 1, $memid);
//                Yii::app()->user->setFlash('badyzc', 'success');
//            } else {
//                Yii::app()->user->setFlash('badyzc', 'error');
//            }
        }
        $this->renderPartial('show', array("dhhld_model" => $dhhld_model, "badyzc_model" => $badyzc_model, "badyzr_model" => $badyzr_model, 'hlb' => $hlb));
    }

    //推荐会员提成奖励
    function rewards($mem_info, $source, $reason) {
        $system_info = System::model()->findByPk(1);
        //上级会员奖励
        if (!empty($mem_info["pid"])) {
            $array = explode(",", $mem_info["pid"]);
            $n = count($array);
            $j = 1;
            for ($i = ($n - 2); $i >= 0; $i--) {
                if ($j == 1 || $j == 2 || $j == 3 || $j == 4) {
                    if ($j == 1) {
                        if (!empty($mem_info["role"])) {
                            $rewadsmemhlb = $system_info['zzfriend1'];
                            $title = " 站长1级好友(" . $mem_info["mem_name"] . ")完整所有资料";
                        } else {
                            $rewadsmemhlb = $system_info['friend1'];
                            $title = " 1级好友(" . $mem_info["mem_name"] . ")完整所有资料";
                        }
                    } else if ($j == 2) {
                        if (!empty($mem_info["role"])) {
                            $rewadsmemhlb = $system_info['zzfriend2'];
                            $title = " 站长2级好友(" . $mem_info["mem_name"] . ")完整所有资料";
                        } else {
                            $rewadsmemhlb = $system_info['friend2'];
                            $title = " 2级好友(" . $mem_info["mem_name"] . ")完整所有资料";
                        }
                    } else if ($j == 3) {
                        if (!empty($mem_info["role"])) {
                            $rewadsmemhlb = $system_info['zzfriend3'];
                            $title = " 站长3级好友(" . $mem_info["mem_name"] . ")完整所有资料";
                        } else {
                            $rewadsmemhlb = $system_info['friend3'];
                            $title = " 3级好友(" . $mem_info["mem_name"] . ")完整所有资料";
                        }
                    } else if ($j == 4) {
                        if (!empty($mem_info["role"])) {
                            $rewadsmemhlb = $system_info['zzfriend4'];
                            $title = " 站长4级好友(" . $mem_info["mem_name"] . ")完整所有资料";
                        } else {
                            $rewadsmemhlb = $system_info['friend4'];
                            $title = " 4级好友(" . $mem_info["mem_name"] . ")完整所有资料";
                        }
                    }
                    $content = $reason . "奖" . $rewadsmemhlb . "元宝";
                    $this->updhlb($rewadsmemhlb, $source, $content, $array[$i], $mem_info["id"]);
                    if (!empty($rewadsmemhlb)) {
                        $this->sendmessage($title, $content, 1, $array[$i]);
                    }
                }
                $j++;
            }
        }
    }

    /*
     * 第一步(完善个人资料奖励)
     */

    function actionFirst() {
        $memid = $this->show_mem_id();
        $memfirst_model = Memfirst::model();
        $memfirst_info = $memfirst_model->findByPk($memid);
        if (empty($memfirst_info["idcode"])) {
            if (isset($_POST['Memfirst'])) {
                foreach ($_POST['Memfirst'] as $_k => $_v) {
                    $memfirst_info->$_k = strip_tags(trim($_v));
                }
                if ($memfirst_info->save()) {
                    $system_info = System::model()->findByPk(1);
                    $reason = "完善个人资料奖励：" . $system_info["first"] . "元宝";
                    $this->updhlb($system_info["first"], 16, $reason, $memid, 0);
                    if (!empty($system_info["first"])) {
                        $this->sendmessage("完善个人资料奖励", $reason, 1, $memid); //1为系统消息
                    }
                    $this->redirect("second");
                }
            }
            $this->renderPartial('first', array("memfirst_info" => $memfirst_info));
        } else {
            $this->redirect("second");
        }
    }

 
    /*
     * 第二步(绑定邮箱)
     */

    function actionthirdly() {
        $memid = $this->show_mem_id();
        $memthirdly_model = Memthirdly::model();
        $memthirdly_info = $memthirdly_model->findByPk($memid);
        if (!empty($memthirdly_info["idcode"])) {//验证第一步有没有做
            if (!empty($memthirdly_info["phone"])) {//验证第二步有没有做
                if (empty($memthirdly_info["email_valid"])) {
                    if (isset($_POST['Memthirdly'])) {
                        foreach ($_POST['Memthirdly'] as $_k => $_v) {
                            $memthirdly_info->$_k = strip_tags(trim($_v));
                        }
                        $memthirdly_info->num = $_POST['Memthirdly']["num"];
                        if ($memthirdly_info->save()) {
                            $system_info = System::model()->findByPk(1);
                            $reason = "绑定邮箱：" . $system_info["thirdly"] . "元宝";
                            $this->updhlb($system_info["thirdly"], 18, $reason, $memid, 0);
                            if (!empty($system_info["thirdly"])) {
                                $this->sendmessage("绑定邮箱", $reason, 1, $memid); //1为系统消息
                            }
                            $this->redirect("fourthly");
                        }
                    }
                    $this->renderPartial('thirdly', array("memthirdly_info" => $memthirdly_info, "num" => $_POST['Memthirdly']["num"]));
                } else {
                    $this->redirect("fourthly");
                }
            } else {
                $this->redirect("second ");    //$this->redirect("second");
            }
        } else {
            $this->redirect("first");
        }
    }

    /*
     * 验证码-发送邮件
     */

    function actionSendemail() {
        $mem = $this->show_mem();
        if (!empty($mem)) {
            if (Yii::app()->request->isAjaxRequest) {//是否ajax请求
                $Num = $_POST['Num'];
                $message = '、：邮箱的验证码是：' . $Num;
                $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
                $mailer->Host = 'smtp.qq.com';  //smtp服务器的名称（这里以163邮箱为例）
                $mailer->IsSMTP();  // 启用SMTP
                $mailer->SMTPAuth = TRUE; //启用smtp认证
                $mailer->From = '416148489qq.com';   //发件人地址（也就是你的邮箱地址）
                $mailer->AddReplyTo('416148489qq.com'); //回复地址(可填可不填)
                $mailer->AddAddress($mem["email"]); //添加收件人
                $mailer->FromName = '、网络';  //发件人姓名
                $mailer->Username = '416148489qq.com';    //这里输入发件地址的用户名
                $mailer->Password = 'qqzidan520...';    //这里输入发件地址的密码
                $mailer->SMTPDebug = true;   //设置SMTPDebug为true，就可以打开Debug功能，根据提示去修改配置
                $mailer->CharSet = 'UTF-8'; //设置邮件编码
                $mailer->Subject = Yii::t('、网络绑定邮箱', '注册码!');  //邮件主题
                $mailer->Body = $message;  //邮件内容
                $mailer->Send();
            }
        }
    }

    /*
     * 第三步(设置交易密码)
     */

    function actionfourthly() {
        $memid = $this->show_mem_id();
        $memfourthly_model = Memfourthly::model();
        $memfourthly_info = $memfourthly_model->findByPk($memid);
        if (!empty($memfourthly_info["idcode"])) {//验证第一步有没有做
            if (!empty($memfourthly_info["phone"])) {//验证第二步有没有做
                if (!empty($memfourthly_info["email_valid"])) {//验证第三步有没有做
                    if (empty($memfourthly_info["jy_pwd"])) {
                        if (isset($_POST['Memfourthly'])) {
                            foreach ($_POST['Memfourthly'] as $_k => $_v) {
                                $memfourthly_info->$_k = strip_tags(trim($_v));
                            }
                            if ($memfourthly_info->save()) {
                                $system_info = System::model()->findByPk(1);
                                $reason = "设置交易密码：" . $system_info["fourthly"] . "元宝";
                                $this->updhlb($system_info["fourthly"], 19, $reason, $memid, 0);
                                if (!empty($system_info["fourthly"])) {
                                    $this->sendmessage("设置交易密码", $reason, 1, $memid); //1为系统消息
                                }
                                $this->redirect("fifty");
                            }
                        }
                        $this->renderPartial('fourthly', array("memfourthly_info" => $memfourthly_info), '', $processOutput = TRUE);
                    } else {
                        $this->redirect("fifty");
                    }
                } else {
                    $this->redirect("thirdly");
                }
            } else {
                $this->redirect("second");
            }
        } else {
            $this->redirect("first");
        }
    }

    /*
     * 第四步(绑定支付方式)
     */

    function actionfifty() {
        $memid = $this->show_mem_id();
        $mem_model = Mem::model();
        $mem_info = $mem_model->findByPk($memid);
        $type = 0;
        if (!empty($mem_info["idcode"])) {//验证第一步有没有做
            if (!empty($mem_info["phone"])) {//验证第二步有没有做
                if (!empty($mem_info["email_valid"])) {//验证第三步有没有做
                    if (!empty($mem_info["jy_pwd"])) {//验证第四步有没有做
                        if (empty($mem_info["bankid"]) && empty($mem_info["alipayid"]) && empty($mem_info["treasureid"])) {
                            $memalipay_model = new Memalipay();
                            if (isset($_POST['Memalipay'])) {
                                foreach ($_POST['Memalipay'] as $_k => $_v) {
                                    $memalipay_model->$_k = strip_tags(trim($_v));
                                }
                                $memalipay_model->mem_id = $memid;
                                if ($memalipay_model->save()) {
                                    $mem_info->alipayid = $memalipay_model["id"];
                                    $mem_info->update();
                                    $system_info = System::model()->findByPk(1);
                                    $reason = "绑定支付方式：" . $system_info["fifty"] . "元宝";
                                    $this->updhlb($system_info["fifty"], 20, $reason, $memid, 0);
                                    if (!empty($system_info["fifty"])) {
                                        $this->sendmessage("绑定支付方式", $reason, 1, $memid); //1为系统消息
                                    }

                                    $this->rewards($mem_info, 23, "您推荐的会员：" . $mem_info["mem_name"] . ",完成所有资料获得奖励"); //推荐会员提成奖励
                                    Yii::app()->user->setFlash('msg', '您的资料已全部设置成功，现在可以提现啦！');
                                    $this->redirect("show");
                                }
                            }

                            $memtreasure_model = new Memtreasure();
                            if (isset($_POST['Memtreasure'])) {
                                foreach ($_POST['Memtreasure'] as $_k => $_v) {
                                    $memtreasure_model->$_k = strip_tags(trim($_v));
                                }
                                $type = 2;
                                $memtreasure_model->mem_id = $memid;
                                if ($memtreasure_model->save()) {
                                    $mem_info->treasureid = $memtreasure_model["id"];
                                    $mem_info->update();
                                    $system_info = System::model()->findByPk(1);
                                    $reason = "绑定支付方式：" . $system_info["fifty"] . "元宝";
                                    $this->updhlb($system_info["fifty"], 20, $reason, $memid, 0);
                                    if (!empty($system_info["fifty"])) {
                                        $this->sendmessage("绑定支付方式", $reason, 1, $memid); //1为系统消息
                                    }
                                    $this->rewards($mem_info, 23, "您推荐的会员：" . $mem_info["mem_name"] . "完成所有资料获得奖励"); //推荐会员提成奖励
                                    Yii::app()->user->setFlash('msg', '您的资料已全部设置成功，现在可以提现啦！');
                                    $this->redirect("show");
                                }
                            }
                            $membank_model = new Membank();
                            if (isset($_POST['Membank'])) {
                                foreach ($_POST['Membank'] as $_k => $_v) {
                                    $membank_model->$_k = strip_tags(trim($_v));
                                }
                                $type = 3;
                                $membank_model->mem_id = $memid;
                                if ($membank_model->save()) {
                                    $mem_info->bankid = $membank_model["id"];
                                    $mem_info->update();
                                    $system_info = System::model()->findByPk(1);
                                    $reason = "绑定支付方式：" . $system_info["fifty"] . "元宝";
                                    $this->updhlb($system_info["fifty"], 20, $reason, $memid, 0);
                                    if (!empty($system_info["fifty"])) {
                                        $this->sendmessage("绑定支付方式", $reason, 1, $memid); //1为系统消息
                                    }

                                    $this->rewards($mem_info, 23, "您推荐的会员：" . $mem_info["mem_name"] . "完成所有资料获得奖励"); //推荐会员提成奖励
                                    Yii::app()->user->setFlash('msg', '您的资料已全部设置成功，现在可以提现啦！');
                                    $this->redirect("show");
                                }
                            }
                            $this->renderPartial('fifty', array("memalipay_model" => $memalipay_model, "membank_model" => $membank_model, "memtreasure_model" => $memtreasure_model, "type" => $type));
                        } else {
                            $id = $_GET["id"];
                            if ($id == 1) {
                                $this->redirect(SITE_URL . "vipadvance/alipay");
                            } else if ($id == 2) {
                                $this->redirect(SITE_URL . "vipadvance/treasure");
                            } else if ($id == 3) {
                                $this->redirect(SITE_URL . "vipadvance/bank");
                            } else {
                                $this->redirect(SITE_URL . "vipadvance/alipay");
                            }
                        }
                    } else {
                        $this->redirect("fourthly");
                    }
                } else {
                    $this->redirect("thirdly");
                }
            } else {
                $this->redirect("second");
            }
        } else {
            $this->redirect("first");
        }
    }

	   /*
     * 第五步(绑定手机号)
     */

    function actionSecond() {
        $memid = $this->show_mem_id();
        $memsecond_model = Memsecond::model();
        $memsecond_info = $memsecond_model->findByPk($memid);
        if (!empty($memsecond_info["idcode"])) {//验证第一步有没有做
            if (empty($memsecond_info["phone"])) {
                if (isset($_POST['Memsecond'])) {
                    foreach ($_POST['Memsecond'] as $_k => $_v) {
                        $memsecond_info->$_k = strip_tags(trim($_v));
                    }
                    if ($memsecond_info->save()) {
                        $system_info = System::model()->findByPk(1);
                        $reason = "绑定手机号：" . $system_info["second"] . "元宝";
                        $this->updhlb($system_info["second"], 17, $reason, $memid, 0);
                        if (!empty($system_info["second"])) {
                            $this->sendmessage("绑定手机号", $reason, 1, $memid); //1为系统消息
                        }
                        $this->redirect("thirdly");
                    }
                }
                $this->renderPartial('second', array("memsecond_info" => $memsecond_info));
            } else {
                $this->redirect("thirdly");
            }
        } else {
            $this->redirect("first");
        }
    }

    /*
     * ajax短信验证
     */

    function actionNote() {
        $mem = $this->show_mem();
        if (!empty($mem)) {
            if (Yii::app()->request->isAjaxRequest) {//是否ajax请求
                $phone = Yii::app()->request->getParam('phone');
                $authnum = null;
                for ($i = 0; $i < 6; $i++) {
                    $authnum.=rand(0, 9);
                }
                $postdata = array("action" => "code", "userid" => 133, "account" => "a416148489", "password" => "51youzhuan", "mobile" => $phone, "content" => "【、】尊敬的" . $mem['mem_name'] . "您的验证码是：" . $authnum . ",打死也不要告诉别人！", "sendTime" => "", "extno" => "");
                $url = "http://sms.jiangukj.com/SendSms.aspx?";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url); //设置链接
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //设置是否返回信息
                curl_setopt($ch, CURLOPT_POST, 1); //设置为POST方式
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata); //POST数据
                $response = curl_exec($ch); //接收返回信息
                if (curl_errno($ch)) {//出错则显示错误信息
                    print curl_error($ch);
                }
                curl_close($ch); //关闭curl链
                $data['result'] = $authnum;
                echo json_encode($data);
            }
        }
    }

    /*
     * 会员图片
     */

    function actionMemimg() {
        $mem_model = Mem::model();
        $mem_info = $mem_model->findByPk($this->show_mem_id());
        $memimgid = $_GET['id'];
        if (!empty($memimgid)) {
            $mem_info->memimg_id = $memimgid;
            $mem_info->update();
        }
        $this->renderPartial('memimg');
    }

    /*
     * 资料管理
     */

    function actionData() {
        $mem_model = Mem::model();
        $mem_info = $mem_model->findByPk($this->show_mem_id());
        if (isset($_POST['Mem'])) {
            foreach ($_POST['Mem'] as $_k => $_v) {
                $mem_info->$_k = strip_tags(trim($_v));
            }
            $mem_info->save();
        }
        $this->renderPartial('data', array("mem_info" => $mem_info));
    }

    /*
     * 交易密码修改
     */

    function actionJypwd() {
        $jypwd_model = Jypwd::model();
        $jypwd_info = $jypwd_model->findByPk($this->show_mem_id());
        if (isset($_POST['Jypwd'])) {
            foreach ($_POST['Jypwd'] as $_k => $_v) {
                $jypwd_info->$_k = strip_tags(trim($_v));
            }
            if ($jypwd_info->save()) {
                Yii::app()->user->setFlash('msg', '交易密码更新成功');
                $this->redirect("data");
            }
        }
        $this->renderPartial('jypwd', array('jypwd_info' => $jypwd_info, "num" => $_POST['Jypwd']["num"]), '', $processOutput = TRUE);
    }

    /*
     * 交易密码重置
     */

    function actionJypwdcz() {
        $jypwdcz_model = Jypwdcz::model();
        $jypwdcz_info = $jypwdcz_model->findByPk($this->show_mem_id());
        if (isset($_POST['Jypwdcz'])) {
            foreach ($_POST['Jypwdcz'] as $_k => $_v) {
                $jypwdcz_info->$_k = strip_tags(trim($_v));
            }
            if ($jypwdcz_info->save()) {
                Yii::app()->user->setFlash('msg', '交易密码重置成功');
                $this->redirect("data");
            }
        }
        $this->renderPartial('jypwdcz', array('jypwdcz_info' => $jypwdcz_info), '', $processOutput = TRUE);
    }

    /*
     * 登录密码修改
     */

    function actionDlpwd() {
        $logpwd_model = Logpwd::model();
        $logpwd_info = $logpwd_model->findByPk($this->show_mem_id());
        if (isset($_POST['Logpwd'])) {
            foreach ($_POST['Logpwd'] as $_k => $_v) {
                $logpwd_info->$_k = strip_tags(trim($_v));
            }

            $mem_info = Mem::model()->find("email=:email and pwd=:pwd", array(":email" => Yii::app()->user->name, ":pwd" => md5($logpwd_info->oldpwd . "wp")));
            if (!empty($mem_info)) {
                $logpwd_info->pwd = $_POST['Logpwd']["pwd"] . "wp"; //老平台密码加入wp
                $logpwd_info->newpwd = $_POST['Logpwd']["newpwd"] . "wp"; //老平台密码加入wp
                if ($logpwd_info->save()) {
                    Yii::app()->user->setFlash('msg', '修改成功');
                    $this->redirect("data");
                }
            } else {
                $logpwd_info->addError('oldpwd', '旧密码不对！');
            }
        }
        $this->renderPartial('dlpwd', array('logpwd_info' => $logpwd_info, "num" => $_POST['Logpwd']["num"]), '', $processOutput = TRUE);
    }

    /*
     * 更改手机号
     */

    function actionPhone() {
        $updphone_model = Updphone::model();
        $updphone_info = $updphone_model->findByPk($this->show_mem_id());
        if (isset($_POST['Updphone'])) {
            foreach ($_POST['Updphone'] as $_k => $_v) {
                $updphone_info->$_k = strip_tags(trim($_v));
            }
            if ($updphone_info->save()) {
                Yii::app()->user->setFlash('msg', '修改手机号成功');
                $this->redirect("data");
            }
        }
        $this->renderPartial('phone', array('updphone_info' => $updphone_info, "num" => $_POST['Updphone']["num"]), '', $processOutput = TRUE);
    }

    function actionIdcodeinfo() {
        $mem = $this->show_mem();
        $mem_info = Mem::model()->findByPk($mem['id']);
        if (!empty($mem_info['idcode'])) {
            $this->renderPartial('idcodeinfo', array("mem_info" => $mem_info));
        } else {
            $this->redirect("idcode");
        }
    }

    /*
     * 身份证验证
     */

    function actionIdcheck() {
        require_once('/protected/extensions/nowapi.class.php');
        $card = $_POST['card'];
        if ($result = nowapi::callapi('idcard.get', array('idcard' => $card), 'json')) {
            echo json_encode($result);
        } else {
            echo "";
        }
    }

}
