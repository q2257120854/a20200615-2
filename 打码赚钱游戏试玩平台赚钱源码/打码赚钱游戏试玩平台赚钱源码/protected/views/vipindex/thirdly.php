<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>验证邮箱-<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="" />
        <meta name="description"  content="" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/vip/info.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/vip/jQuery.v1.8.3.js"></script>
        <script src="/scripts/vip/info.js"></script>
        <style type="text/css">
            div .errorMessage{color:red;}
        </style>
        <script type="text/javascript">
            var InterValObj; //timer变量，控制时间
            var count = 600; //间隔函数，1秒执行
            var curCount;//当前剩余秒数
            function sendMessage() {
                curCount = count;
                //设置button效果，开始计时
                $("#btnSendCode").attr("class", "ann_2");
                InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
                var Num = "";
                for (var i = 0; i < 6; i++)
                {
                    Num += Math.floor(Math.random() * 10);
                }
                $("#Memthirdly_num").val(Num);
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
                    $("#btnSendCode").attr("class", "ann_2");
                    $("#btnSendCode").val("重新发送验证码");
                } else {
                    curCount--;
                    $("#btnSendCode").val("请在" + curCount + "秒内输入邮箱验证码!");
                }
            }
        </script>
    </head>
    <body>
        <!--头部-->
        <?php include_once("./protected/views/vipdesign/header.php") ?>
        <div class="main clearfix">
            <!--导航-->
            <?php include_once("./protected/views/vipdesign/navicat.php") ?>
            <?php $system_info = System::model()->findByPk(1); ?>
            <div class="db">
                <!--步骤-->
                <div class="list_1">
                    <div class="step step_2"></div>
                    <ul class="step_text clearfix">
                        <li>
                            <p class="p_1">完善个人资料</p>
                            <p class="p_2"><?php echo $system_info["first"]; ?>元宝</p>
                        </li>

                        <li>
                            <p class="p_1">验证邮箱</p>
                            <p class="p_2"><?php echo $system_info["thirdly"]; ?>元宝</p>
                        </li>
                        <li>
                            <p class="p_1">设置交易密码</p>
                            <p class="p_2"><?php echo $system_info["fourthly"]; ?>元宝</p>
                        </li>
                        <li>
                            <p class="p_1">绑定支付方式</p>
                            <p class="p_2"><?php echo $system_info["fifty"]; ?>元宝</p>
                        </li>
                        <li>
                            <p class="p_1">绑定手机号</p>
                            <p class="p_2"><?php echo $system_info["second"]; ?>元宝</p>
                        </li>						
						
                    </ul>
                </div>
                <!--内容-->
                <div class="content">
                    <div class="tit">
                        <span class="s">02&nbsp;</span>
                        <span class="t">验证邮箱奖励</span>
                        <span class="h"><?php echo $system_info["thirdly"]; ?>元宝</span>
                    </div>
                    <?php $form = $this->beginWidget('CActiveForm', array("id" => "memfrom")); ?>
                    <input type="hidden"  id="Memthirdly_email_valid" name="Memthirdly[email_valid]" value="1"/> 
                    <input type="hidden" id="Memthirdly_num" name="Memthirdly[num]" value="<?php echo $num; ?>"/>   
                    <div class="cont">

                        <ul class="prompt">
                            <li>邮箱认证：为了保证账号的安全性，<i class="red">找回密码</i>、<i class="red">申请提现</i>、<i class="red">兑换奖品</i>需要进行邮箱认证。</li>
                            <li>为了保证账号的<i class="red">唯一性</i>，请注意一个邮箱地址只能<i class="red">绑定一个账号</i>。</li>
                            <li>验证了邮箱地址后，可以使用邮箱来进行登录网站。</li>
                        </ul>
                        <ul class="input_k clearfix">
                            <li class="li_1 clearfix">
                                <span class="name">邮箱账号：</span>
                                <span class="sr">
                                    <?php echo $form->textField($memthirdly_info, 'email', array("class" => "sframe sframe_1", 'value' => $mem["email"], "disabled" => "disabled")); ?>
                                </span>
                                <?php $email = $memthirdly_info->getError("email"); ?>
                                <span class="zs <?php
                                if (!empty($email)) {
                                    echo "red";
                                }
                                ?>"><i>*&nbsp;</i>
                                          <?php
                                          if (!empty($email)) {
                                              echo $email;
                                          } else {
                                              echo "请填写正确的邮箱账号";
                                          }
                                          ?>
                                </span>
                            </li>
                            <li class="li_1 clearfix">
                                <span class="name">验证码：</span>
                                <span class="sr">
                                    <?php echo $form->textField($memthirdly_info, 'code', array('class' => 'sframe sframe_2', 'size' => 6)); ?>
                                    <input id="btnSendCode" type="button" class="ann_2" value="点击获取邮箱验证码" onclick="sendMessage()"  />
                                </span>
                                <?php $code = $memthirdly_info->getError("code"); ?>
                                <span class="zs <?php
                                if (!empty($code)) {
                                    echo "red";
                                }
                                ?>">
                                    <i>*&nbsp;</i>
                                    <?php
                                    if (!empty($code)) {
                                        echo $code;
                                    } else {
                                        echo "请输入邮箱验证码";
                                    }
                                    ?>
                                </span>
                            </li>
                            <li style="display:none" id="tishi">
                                <span>发送成功!。</span>
                            </li>
                            <li class="li_2">
                                <a class="ann_1" href="javascript:document.getElementById('memfrom').submit();">下一步</a>
                            </li>
                        </ul>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
        <?php include_once("./protected/views/vipdesign/footer.php"); ?>
        <?php include_once("./protected/views/vipdesign/kefu.php") ?>
    </body>
</html>
