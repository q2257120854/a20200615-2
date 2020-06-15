<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>登录密码修改-<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="\" />
              <meta name="description" content="\" />
              <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
            <link href="/style/vip/public.css" rel="stylesheet" type="text/css" />
            <link href="/style/vip/password_find.css" rel="stylesheet" type="text/css" />
            <script src="/scripts/vip/jQuery.v1.8.3.js"></script>
            <script src="/scripts/vip/public.js"></script>
            <script type="text/javascript">

                var InterValObj; //timer变量，控制时间  
                var count = 600; //间隔函数，1秒执行  
                var curCount;//当前剩余秒数  
                function sendMessage() {
                    curCount = count;
                    //设置button效果，开始计时  
                    $("#btnSendCode").attr("disabled", "true");
                    $("#btnSendCode").val("请在" + curCount + "秒内输入验证码");
                    InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次  

                    var Num = "";
                    for (var i = 0; i < 6; i++)
                    {
                        Num += Math.floor(Math.random() * 10);
                    }
                    $("#Logpwd_num").val(Num);
                    //向后台发送处理数据
                    $.ajax({
                        type: "POST",
                        data: {'Num': Num, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken ?>'},
                        dataType: "json",
                        url: "<?php echo SITE_URL ?>vipindex/sendemail",
                        success: function() {
                        }
                    });
                }
                //timer处理函数  
                function SetRemainTime() {
                    if (curCount == 0) {
                        window.clearInterval(InterValObj);//停止计时器  
                        $("#btnSendCode").removeAttr("disabled");//启用按钮  
                        $("#btnSendCode").val("重新发送验证码");
                    }
                    else {
                        curCount--;
                        $("#btnSendCode").val("请在" + curCount + "秒内输入验证码");
                    }
                }
            </script>
    </head>
    <body>
        <!--头部-->
        <?php include_once("./protected/views/vipdesign/header.php") ?>
        <!--主体-->
        <div class="main">
            <!--头部logo-->
            <div class="top_logo clearfix">
                <a href="javascript:" class="logo"></a>
            </div>
            <!--找回密码第一步-->
            <div class="binding_find clearfix">
                <div class="tit">
                    <span>登录密码修改</span>
                    <i>Password</i>
                </div>
                <?php $form = $this->beginWidget('CActiveForm', array('id' => 'dlpwdform')); ?>
                <input type="hidden" id="Logpwd_num" name="Logpwd[num]" value="<?php echo $num; ?>"/>   
                <div class="cont_1"> 
                    <div class="shur_1 shur_2">
                        <ul class="ul_1">
                            <li>
                                <span class="text">登录邮箱：</span>
                                <span><?php echo substr_replace($mem['email'], '*****', 3, 5); ?></span>
                            </li>
                            <li>
                                <span class="text">当前密码：</span>
                                <?php echo $form->passwordField($logpwd_info, 'oldpwd', array('class' => 'sframe sframe_3', "placeholder" => "请输入当前密码")); ?>
                                <span class="zhu ">
                                    <?php
                                    $oldpwd = $logpwd_info->getError("oldpwd");
                                    if (!empty($oldpwd)) {
                                        echo "<span style='color:red;'>" . $oldpwd . "</span>";
                                    } else {
                                        echo "正在使用的密码";
                                    }
                                    ?>
                                </span>
                            </li>
                            <li>
                                <span class="text">新密码：</span>
                                <?php echo $form->passwordField($logpwd_info, 'pwd', array('class' => 'sframe sframe_3', "placeholder" => "请输入新密码", "value" => "")); ?>
                                <span class="zhu ">
                                    <?php
                                    $pwd = $logpwd_info->getError("pwd");
                                    if (!empty($pwd)) {
                                        echo "<span style='color:red;'>" . $pwd . "</span>";
                                    } else {
                                        echo "请输入6-20位字符密码";
                                    }
                                    ?>
                                </span>
                            </li>
                            <li>
                                <span class="text">确认密码：</span>
                                <?php echo $form->passwordField($logpwd_info, 'newpwd', array('class' => 'sframe sframe_3', "placeholder" => "请再次输入新交易密码")); ?>
                                <span class="zhu ">
                                    <?php
                                    $newpwd = $logpwd_info->getError("newpwd");
                                    if (!empty($newpwd)) {
                                        echo "<span style='color:red;'>" . $newpwd . "</span>";
                                    } else {
                                        echo "请再次输入新密码";
                                    }
                                    ?>
                                </span>
                            </li>
                            <li>
                                <span class="text">验证码：</span>
                                <?php echo $form->textField($logpwd_info, 'code', array('class' => 'sframe sframe_2', 'size' => 6)); ?>
                                <input id="btnSendCode" type="button" class="cz" value="点击获取邮箱验证码" onclick="sendMessage()"  />
                                <?php
                                $code = $logpwd_info->getError("code");
                                echo "<span style='color:red;'>" . $code . "</span>";
                                ?>
                            </li>
                            <li>
                                <a class="button_5" href="javascript:document.getElementById('dlpwdform').submit();">确定修改</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
                <div class="cont_2">
                    <div class="tit_2">交易密码设置目的：</div>
                    <p>
                        1、设置交易密码后，您就能顺利使用以下网站功能：<i class="red">兑换奖品、元宝存取、玩宝、彩票购买、申请提现</i>等功能
                        <br />
                        2、为了保证您的账号安全及顺畅体验，请尽快完成交易密码设置。</p>
                    <div class="tit_2">温馨提示：</div>
                    <p>
                        1、请不要将交易密码告知身边朋友或者网友与第三方。
                        <br />
                        2、如因自身原因造成交易密码泄露，导致平台虚拟货币被盗等问题，官方不承担任何责任。
                        <br />
                        3、为保证交易密码的安全性，官方再次建议大家每隔一段时间将交易密码重新设置，来提升账户安全性。
                    </p>
                </div>
            </div>
        </div>
        <!--底部1-->
        <?php include_once("./protected/views/vipdesign/footer.php"); ?>
        <?php include_once("./protected/views/vipdesign/kefu.php") ?>
    </body>
</html>
