<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>注册-<?php echo TIT; ?>、官方网站</title>
        <meta name="keywords" content="、,、官网,51玩,试玩平台,网页游戏,游戏试玩,网上赚钱,打码网赚,打码平台,免费赚钱,免费换奖,网赚提现" />
        <meta name="description" content="、是一个玩游戏、体验产品赚积分，兑换各种奖品的体验营销娱乐平台。这里有最新最好玩的网页游戏，让您轻松实现网上赚钱的愿望。我们打造专业的网络兼职平台，用户在游戏试玩、参与互动体验、购物返利中获得免费积分--元宝，元宝可以换取Q币、话费、笔记本等丰富的奖品，是用户网赚和网络兼职的好去处" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/public.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/public_js.js"></script>
        <link href="/style/registration.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/public_js.js"></script>
        <script src="/scripts/registration.js"></script>        
        <script type="text/javascript" src="/scripts/inputmail.js"></script>

        <style type="text/css">
            .hover9{ background: url(<?php echo IMG_URL; ?>img/nav_b.png) no-repeat center; font-weight: bold;}
            .hover9 a { color:#fff !important;}
            div .errorMessage{ display:block; position:absolute; left:-183px; top:-3px; width:186px; height:40px; line-height:40px; background:url(<?php echo IMG_URL; ?>img/sframe_tisbk.png) no-repeat; color:#fff; font-weight:bold; z-index:100; padding-left:10px; *background:#3b72ff; *left:-200px;}
        </style>
        <script type="text/javascript">
            $(function() {
                $("#Mem_email").changeTips({
                    divTip: ".on_changes"
                });
            })

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
    <body >
        <?php include_once("./protected/views/design/header.php"); ?>
        <!--主体-->
        <div class="mian" style="background:url(<?php echo IMG_URL; ?>dynamic/advertisement_3.jpg) no-repeat center;">
            <?php $form = $this->beginWidget('CActiveForm'); ?>
            <!--用户注册、登录-->
            <div class="zhu">
                <!--用户注册-->
                <div class="registration_3"   <?php
                if ($windows == 2) {
                    echo "style='display:none;'";
                }
                ?>>
                    <div class="tit clearfix">
                        <span class="t_1">会员注册</span>
                        <span class="t_2">Registration</span>
                        <span class="t_3">已有账号？
                            <a  href="javascript:" class="a_1 a_xx1">立即登录&nbsp;<i>>></i></a>
                        </span>
                    </div>
                    <div class="cont">
                        <ul class="input_k">
                            <li class="clearfix">
                                <?php echo $form->textField($men_model, 'email', array('autocomplete' => 'off', 'class' => 'shu_1', "id" => "Mem_email", "style" => "display:block;")); ?>
                                <?php echo $form->error($men_model, 'email'); ?>
                                <ul class="on_changes" >
                                    <li email="">请选择邮箱类型</li>
                                    <li email=""></li>
                                    <li email="@qq.com"></li>
                                    <li email="@163.com"></li>
                                    <li email="@126.com"></li>
                                    <li email="@139.com"></li>
                                    <li email="@189.cn"></li>
                                    <li email="@sina.com"></li>
                                    <li email="@sina.cn"></li>
                                    <li email="@souhu.com"></li>
                                    <li email="@sina.com.cn"></li>
                                    <li email="@hotmail.com"></li>
                                </ul>
                                <i class="ico_1"></i>
                                <span class="text_1">用户邮箱：</span>
                            </li>
                            <li class="clearfix">
                                <?php echo $form->passwordField($men_model, 'pwd', array('autocomplete' => 'off', 'class' => 'shu_1', "style" => "display:block;", "onblur" => "safe(this.value)")); ?>
                                <?php echo $form->error($men_model, 'pwd'); ?>
                                <span class="safety" style="display:none;background:url(<?php echo IMG_URL; ?>img/safety_1.gif) no-repeat;" id="grade1" ></span>
                                <span class="safety" style="display:none;background:url(<?php echo IMG_URL; ?>img/safety_2.gif) no-repeat;" id="grade2" ></span>
                                <span class="safety" style="display:none;background:url(<?php echo IMG_URL; ?>img/safety_3.gif) no-repeat;" id="grade3" ></span>
                                <i class="ico_2"></i>
                                <span class="text_1">登录密码：</span>
                            </li>
                            <li class="clearfix">
                                <?php echo $form->passwordField($men_model, 'pwd2', array('autocomplete' => 'off', 'class' => 'shu_1', "style" => "display:block;")); ?>
                                <?php echo $form->error($men_model, 'pwd2'); ?>
                                <i class="ico_2"></i>
                                <span class="text_1">确认密码：</span>
                            </li>
                            <li class="clearfix">
                                <?php echo $form->textField($men_model, 'mem_name', array('autocomplete' => 'off', 'class' => 'shu_1', "style" => "display:block;")); ?>
                                <?php echo $form->error($men_model, 'mem_name'); ?>
                                <i class="ico_3"></i>
                                <span class="text_1">用户昵称：</span>
                            </li>
                            <li class="clearfix">
                                <?php echo $form->textField($men_model, 'verifyCode', array('autocomplete' => 'off', 'maxlength' => 4, 'class' => 'shu_2 yan', "style" => "display:block;")); ?>   
                                <span class="code_1">
                                    <?php
                                    $this->widget('CCaptcha', array('showRefreshButton' => false,
                                        'clickableImage' => true, 'imageOptions' => array('alt' => '点击换图', 'title' => '点击换图',
                                            'style' => 'cursor:pointer;padding:px 0;padding:4px 0;background:#fff;display:inline-block;margin-bottom:3px')));
                                    ?>
                                    <?php echo $form->error($men_model, 'verifyCode'); ?>
                                    <input type="hidden" value="1" name="windows" />
                                </span>
                                <span class="text_1">验证码：</span>
                            </li>
                            <li class="clearfix">
                                <input type="checkbox"  checked="checked"   />
                                <a class="text" href="<?php echo SITE_URL ?>index/xieyi" target="_blank"> 同意、会员注册协议</a>
                            </li>
                            <li class="clearfix">
                                <button class="ann_1" type="submit">免费注册</button>
                            </li>
                        </ul>
                        <div class="shej clearfix">
                            <p>使用以下账号直接登录</p>
                            <a href="javascript:" class="xinl"></a>
                            <a href="javascript:" class="qq"></a>
                        </div>
                    </div>
                </div>
                <?php $this->endWidget(); ?>

                <?php $form1 = $this->beginWidget('CActiveForm'); ?>
                <!--用户登录-->
                <div class="registration_3 registration_4" <?php
                if ($windows == 1 || $windows == 0) {
                    echo "style='display:none;'";
                }
                ?>>
                    <div class="tit clearfix">
                        <span class="t_1">会员登录</span>
                        <span class="t_2">Login</span>
                        <span class="t_3">没有账号？
                            <a href="javascript:" class="a_1 a_xx2">立即免费注册&nbsp;<i>>></i></a>
                        </span>
                    </div>
                    <div class="cont">
                        <ul class="input_k">
                            <li class="clearfix">
                                <?php echo $form1->textField($mem_login, 'email', array('autocomplete' => 'off', 'class' => 'shu', "style" => "display:block;")); ?>
                                <?php echo $form1->error($mem_login, 'email'); ?>
                                <i class="ico_1"></i>
                                <span class="text_1">邮箱：</span>
                            </li>
                            <li class="clearfix">
                                <?php echo $form1->passwordField($mem_login, 'pwd', array('autocomplete' => 'off', 'class' => 'shu', "style" => "display:block;")); ?>
                                <?php echo $form1->error($mem_login, 'pwd'); ?>
                                <i class="ico_2"></i>
                                <span class="text_1">密码：</span>
                            </li>
                            <li class="clearfix">
                                <?php echo $form1->textField($mem_login, 'verifyCode', array('autocomplete' => 'off', 'maxlength' => 4, 'class' => 'shu_2 yan', "style" => "display:block;")); ?>   
                                <span class="code_1">
                                    <?php
                                    $this->widget('CCaptcha', array('showRefreshButton' => false,
                                        'clickableImage' => true, 'imageOptions' => array('alt' => '点击换图', 'title' => '点击换图',
                                            'style' => 'cursor:pointer;padding:px 0;padding:4px 0;background:#fff;display:inline-block;margin-bottom:3px')));
                                    ?>
                                </span>
                                <input type="hidden" value="2" name="windows" />
                                <?php echo $form1->error($mem_login, 'verifyCode'); ?>
                                <span class="text_1">验证码：</span>
                            </li>
                            <li class="clearfix">
                                <button class="ann_1" type="submit">登录</button>
                                <a href="<?php echo SITE_URL ?>index/pwdfind1" class="wj">忘记密码？</a>
                            </li>
                        </ul>
                        <div class="shej clearfix">
                            <p>使用以下账号直接登录</p>
                            <a href="javascript:" class="xinl"></a>
                            <a href="javascript:" class="qq"></a>
                        </div>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
    </body>
</html>