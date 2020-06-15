<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>无标题文档</title>
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <link href="/style/vip/tran_password.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
            div .errorMessage{color:red; display: block; padding-left: 130px;}
        </style>
        <script type="text/javascript">
            var InterValObj; //timer变量，控制时间
            var count = 600; //间隔函数，1秒执行
            var curCount;//当前剩余秒数
            function sendMessage() {
                var phone = $("#Updphone_phone").val();
                var reg = /^1\d{10}$/;
                if (reg.test(phone) == true)
                {
                    curCount = count;
                    //设置button效果，开始计时
                    $("#btnSendCode").attr("class", "button_1 ann_2");
                    InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
                    //向后台发送处理数据
                    $.ajax({
                        type: "POST",
                        data: {'phone': phone, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken ?>'},
                        dataType: "json",
                        url: "<?php echo SITE_URL ?>vipindex/note",
                        success: function(data) {
                            $("#Updphone_num").val(data['result']);
                        }
                    });
                } else {
                    alert("新手机号码格式不正确！");
                }
            }

            //timer处理函数
            function SetRemainTime() {
                if (curCount == 0) {
                    window.clearInterval(InterValObj);//停止计时器
                    $("#btnSendCode").attr("class", "send send_2");
                    $("#btnSendCode").val("重新发送验证码");
                } else {
                    curCount--;
                    $("#btnSendCode").val("请" + curCount + "秒内输短信验证码!");
                }
            }

            $(function() {
                //关闭窗口
                $("#closeupdphone").click(function() {
                    parent.$("#phone").hide();
                });
            })
        </script>
    </head>
    <body>
        <!--转入、转出弹出框-->
        <div class="turn_bk" style="display:block"></div>
        <?php $form = $this->beginWidget('CActiveForm', array('id' => 'phoneform')); ?>
        <input type="hidden" id="Updphone_num" name="Updphone[num]" value="<?php echo $num; ?>"/>  
        <!--转入-->
        <div class="turn turn_1" style="display:block">
            <div class="tit clearfix">
                <span>修改手机号</span>
                <i id="closeupdphone"></i>
            </div>
            <div class="cont">
                <ul class="ul_1">
                    <li>
                        <span class="text">旧手机号：</span>
                        <?php echo $form->textField($updphone_info, 'old_phone', array('class' => 'sframe sframe_2', "placeholder" => "请输入旧手机号", "maxlength" => 11)); ?>
                    </li>
                    <?php echo $form->error($updphone_info, 'old_phone'); ?>
                    <li>
                        <span class="text">新手机号：</span>
                        <?php echo $form->textField($updphone_info, 'phone', array('class' => 'sframe sframe_2', "placeholder" => "请再次输入新手机号", "value" => "", "maxlength" => 11)); ?>
                    </li>
                    <?php echo $form->error($updphone_info, 'phone'); ?>
                    <li>
                        <span class="text">短信验证码：</span>
                        <?php echo $form->textField($updphone_info, 'code', array('placeholder' => "请输入验证码", "class" => "sframe sframe_1", "maxlength" => 6)); ?>
                        <input id="btnSendCode" type="button" class="send send_1" value="发送短信验证码" onclick="sendMessage()" />
                    </li>
                    <?php echo $form->error($updphone_info, 'code'); ?>
                    <li>
                        <a class="button_2" href="javascript:document.getElementById('phoneform').submit();">修改</a>
                    </li>
                </ul>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </body>
</html>
