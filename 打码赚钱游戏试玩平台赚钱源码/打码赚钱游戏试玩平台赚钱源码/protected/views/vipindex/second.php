<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>绑定手机号--<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="\" />
              <meta name="description" content="\" />
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
                    var phone = $("#Memsecond_phone").val();//手机号码  
                    var reg = /^1\d{10}$/;
                    if (reg.test(phone) == true) {
                        //设置button效果，开始计时  
                        $("#btnSendCode").attr("disabled", "true");
                        $("#btnSendCode").val("请在" + curCount + "秒内输入验证码");
                        InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次  
                        //向后台发送处理数据  
                        $.ajax({
                            type: "POST",
                            data: {'phone': phone, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken ?>'},
                            dataType: "json",
                            url: "<?php echo SITE_URL ?>vipindex/note",
                            success: function(data) {
                                $("#Memsecond_code2").val(data['result']);
                            }
                        });
                    } else {
                        alert("手机号码格式不正确！");
                    }
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
        <div class="main clearfix">
            <!--导航-->
            <?php include_once("./protected/views/vipdesign/navicat.php") ?>
            <?php $system_info = System::model()->findByPk(1) ?>
            <div class="db">
                <!--步骤-->
                <div class="list_1">
                    <div class="step step_5"></div>
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
                        <span class="s">05&nbsp;</span>
                        <span class="t">绑定手机号奖励</span>
                        <span class="h"><?php echo $system_info["second"]; ?>元宝</span>
                    </div>
                    <?php $form = $this->beginWidget('CActiveForm', array("id" => "memfrom")); ?>
                    <input type="hidden"  id="Memsecond_code2" name="Memsecond[code2]"/> 
                    <div class="cont">
                        <ul class="prompt">
                            <li>为了保证账号的<i class="red">安全性</i>。修改支付渠道也会发<i class="red">验证码</i>，确保<i class="red">提现账户安全</i>。</li>
                            <li>为了保证账号的<i class="red">唯一性</i>，请注意一个手机号码只能<i class="red">绑定一个账号</i>。</li>
                            <li>接收手机验证码短信免费；手机验证不会产生任何其他费用。</li>
                        </ul>
                        <ul class="input_k clearfix">
                            <li class="li_1 clearfix">
                                <span class="name">手机号码：</span>
                                <span class="sr">
                                    <?php echo $form->textField($memsecond_info, 'phone', array("class" => "sframe sframe_1", 'placeholder' => '请输入手机号码')); ?>
                                </span>
                                <?php $phone = $memsecond_info->getError("phone"); ?>
                                <span class="zs <?php
                                if (!empty($phone)) {
                                    echo "red";
                                }
                                ?>"><i>*&nbsp;</i>
                                          <?php
                                          if (!empty($phone)) {
                                              echo $phone;
                                          } else {
                                              echo "请填写正确的手机号码";
                                          }
                                          ?>
                                </span>
                            </li>
                            <li class="li_1 clearfix">
                                <span class="name">验证码：</span>
                                <span class="sr">
                                    <?php echo $form->textField($memsecond_info, 'code', array('class' => 'sframe sframe_2', 'size' => 6)); ?>
                                    <input id="btnSendCode" type="button" class="send send_1" value="免费获取手机验证码" onclick="sendMessage()"  />
                                </span>
                                <?php $code = $memsecond_info->getError("code"); ?>
                                <span class="zs <?php
                                if (!empty($code)) {
                                    echo "red";
                                }
                                ?>"><i>*&nbsp;</i>
                                          <?php
                                          if (!empty($code)) {
                                              echo $code;
                                          } else {
                                              echo "请输入手机验证码";
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
        <!--底部1-->
        <?php include_once("./protected/views/vipdesign/footer.php"); ?>
        <?php include_once("./protected/views/vipdesign/kefu.php") ?>
    </body>
</html>
