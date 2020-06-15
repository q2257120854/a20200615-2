<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>找回密码_2-<?php echo TIT; ?></title>
            <meta name="keywords" content="、,、官网,51玩,试玩平台,网页游戏,游戏试玩,网上赚钱,打码网赚,打码平台,免费赚钱,免费换奖,网赚提现" />
            <meta name="description" content="、是一个玩游戏、体验产品赚积分，兑换各种奖品的体验营销娱乐平台。这里有最新最好玩的网页游戏，让您轻松实现网上赚钱的愿望。我们打造专业的网络兼职平台，用户在游戏试玩、参与互动体验、购物返利中获得免费积分--元宝，元宝可以换取Q币、话费、笔记本等丰富的奖品，是用户网赚和网络兼职的好去处" />
            <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
            <link href="/style/public.css" rel="stylesheet" type="text/css" />
            <link href="/style/password_find.css" rel="stylesheet" type="text/css" />
            <script src="/scripts/jQuery.v1.8.3.js"></script>
            <script src="/scripts/public_js.js"></script>
            <script type="text/javascript">
                var InterValObj; //timer变量，控制时间
                var count = 600; //间隔函数，1秒执行
                var curCount;//当前剩余秒数
                function sendMessage(email) {
                    if (email != "") {
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
                        $("#Code_num").val(Num);

                        //向后台发送处理数据
                        $.ajax({
                            type: "POST",
                            data: {'email': email, 'Num': Num, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken ?>'},
                            url: "<?php echo SITE_URL ?>index/sendemail",
                            success: function() {
                                $("#tishi").show();
                            }
                        });
                    } else {
                        location.href = "<?php echo SITE_URL ?>index/pwdfind1";
                    }
                }
                //timer处理函数
                function SetRemainTime() {
                    if (curCount == 0) {
                        window.clearInterval(InterValObj);//停止计时器
                        $("#btnSendCode").removeAttr("disabled");//启用按钮
                        $("#btnSendCode").val("重新发送验证码");
                    } else {
                        curCount--;
                        $("#btnSendCode").val("请在" + curCount + "秒内输入验证码");
                    }
                }
            </script>
    </head>
    <body>
        <!--头部-->
        <?php include_once("./protected/views/design/header.php") ?>
        <?php $form = $this->beginWidget('CActiveForm', array("id" => "pwdfrom")); ?>
        <!--主体-->
        <div class="main">

            <!--找回密码第二步-->
            <div class="password_find clearfix">
                <div class="tit">
                    <span>找回密码</span>
                    <i>Password</i>
                </div>
                <div class="cont_1">
                    <div class="step_2"></div>
                    <div class="shur_1">
                        <input type="hidden" id="Code_num" name="Code[num]" value="<?php echo $num; ?>"/>   
                        <ul class="ul_1">
                            <li>
                                <span class="text">注册邮箱：</span>
                                <span>
                                    <?php
                                    echo $_GET['email'];
                                    ?>
                                </span>
                            </li>
                            <li>
                                <span class="text">验证码：</span>
                                <?php echo $form->textField($code_model, 'code', array('placeholder' => "请输入验证码", "class" => "sframe sframe_2")); ?>
                                <input id="btnSendCode" type="button" class="send send_1" value="发送验证码" onclick="sendMessage('<?php echo $_GET['email']; ?>')" />
                            </li>
                            <li class="tis" style="display: block;">
                                <?php echo $form->error($code_model, 'code'); ?>
                            </li>
                            <li class="tis_1" id="tishi">
                                <span>发送成功!。</span><a href="https://mail.qq.com/cgi-bin/loginpage" target="_blank">进入邮箱</a>
                            </li>
                            <li>
                                <a class="button_1" href="javascript:document.getElementById('pwdfrom').submit();">下一步</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
    </body>
</html>
