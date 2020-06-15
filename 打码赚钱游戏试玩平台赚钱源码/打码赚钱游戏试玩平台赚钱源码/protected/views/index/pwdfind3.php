<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>找回密码_3-<?php echo TIT; ?></title>
            <meta name="keywords" content="、,、官网,51玩,试玩平台,网页游戏,游戏试玩,网上赚钱,打码网赚,打码平台,免费赚钱,免费换奖,网赚提现" />
            <meta name="description" content="、是一个玩游戏、体验产品赚积分，兑换各种奖品的体验营销娱乐平台。这里有最新最好玩的网页游戏，让您轻松实现网上赚钱的愿望。我们打造专业的网络兼职平台，用户在游戏试玩、参与互动体验、购物返利中获得免费积分--元宝，元宝可以换取Q币、话费、笔记本等丰富的奖品，是用户网赚和网络兼职的好去处" />
            <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
            <link href="/style/public.css" rel="stylesheet" type="text/css" />
            <link href="/style/password_find.css" rel="stylesheet" type="text/css" />
            <script src="/scripts/jQuery.v1.8.3.js"></script>
            <script src="/scripts/public_js.js"></script>
            <script type="text/javascript">
                function safe(password) {
                    var securityLevelFlag = 0;
                    if (password.length < 6) {
                        return;
                    } else {
                        var securityLevelFlagArray = new Array(0, 0, 0, 0);
                        for (var i = 0; i < password.length; i++) {
                            var asciiNumber = password.substr(i, 1).charCodeAt();
                            if (asciiNumber >= 48 && asciiNumber <= 57) {
                                securityLevelFlagArray[0] = 1;  //数字
                            }
                            else if (asciiNumber >= 97 && asciiNumber <= 122) {
                                securityLevelFlagArray[1] = 1;  //小写字母
                            }
                            else if (asciiNumber >= 65 && asciiNumber <= 90) {
                                securityLevelFlagArray[2] = 1;  //大写字母
                            } else {
                                securityLevelFlagArray[3] = 1;  //特殊符号
                            }
                        }
                        for (var i = 0; i < securityLevelFlagArray.length; i++) {
                            if (securityLevelFlagArray[i] == 1) {
                                securityLevelFlag++;
                            }
                        }
                        if (securityLevelFlag == 1) {
                            $("#grade1").show();
                            $("#grade2").hide();
                            $("#grade3").hide();
                        } else if (securityLevelFlag == 2 || securityLevelFlag == 3) {
                            $("#grade1").hide();
                            $("#grade2").show();
                            $("#grade3").hide();
                        } else if (securityLevelFlag == 4) {
                            $("#grade1").hide();
                            $("#grade2").hide();
                            $("#grade3").show();
                        }
                    }
                }
            </script>
    </head>
    <body>
        <?php include_once("./protected/views/design/header.php") ?>
        <?php $form = $this->beginWidget('CActiveForm', array("id" => "pwdfrom")); ?>
        <!--主体-->
        <div class="main">

            <!--找回密码第三步-->
            <div class="password_find clearfix">
                <div class="tit">
                    <span>找回密码</span>
                    <i>Password</i>
                </div>
                <div class="cont_1">
                    <div class="step_3"></div>
                    <div class="shur_1">
                        <ul class="ul_1">
                            <li>
                                <span class="text">新密码：</span>
                                <?php echo $form->passwordField($changepwd_model, 'pwd', array('placeholder' => "请输入6~16新密码", 'autocomplete' => 'off', 'size' => 16, 'class' => 'sframe sframe_1', "style" => "display:block;", "onblur" => "safe(this.value)")); ?>
                                <i class="bi">*</i>
                            </li>
                            <li class="tis_3" style="display:none;background:url(<?php echo IMG_URL; ?>img/safety_1.gif) no-repeat" id="grade1"></li>
                            <li class="tis_3" style="display:none;background:url(<?php echo IMG_URL; ?>img/safety_2.gif) no-repeat" id="grade2"></li>
                            <li class="tis_3" style="display:none;background:url(<?php echo IMG_URL; ?>img/safety_3.gif) no-repeat" id="grade3"></li>
                            <li class="tis" style="display: block;">
                                <?php echo $form->error($changepwd_model, 'pwd'); ?>
                            </li>
                            <li>
                                <span class="text">确认密码：</span>
                                <?php echo $form->passwordField($changepwd_model, 'pwd2', array('placeholder' => "请再次输入密码", "class" => "sframe sframe_1", 'size' => 16, 'autocomplete' => 'off')); ?>
                                <i class="bi">*</i>
                            </li>
                            <li class="tis" style="display: block;">
                                <?php echo $form->error($changepwd_model, 'pwd2'); ?>
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
