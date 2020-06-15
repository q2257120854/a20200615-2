
<!--
╔----------------------------------------------------------------------╗
┆Copyright (c) 2013-2015 Powered By 009.90xqb.com Version 11	┆
┆联系QQ：416148489  邮箱:416148489qq.com   手机:416148489  
  版权所有: chaoyouwan.com.、体验站程序源码 2014-12-20                                      
╚----------------------------------------------------------------------╝
-->





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
        <link href="/style/registration1.css" rel="stylesheet" type="text/css"/>
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/registration.js"></script>
        <script type="text/javascript" src="/scripts/inputmail.js"></script>
        <style type="text/css">
            div .errorMessage{display:block; position:absolute; left:-183px; top:-3px; width:186px; height:40px; line-height:40px; background:url(<?php echo IMG_URL; ?>img/sframe_tisbk.png) no-repeat; color:#fff; font-weight:bold; z-index:100; padding-left:10px;}
        </style>
        <script type="text/javascript">
            $(function() {
                var result = '<?php echo $result; ?>';
                if (result == "success") {
                    parent.document.getElementById("regis").style.display = 'none';
                    parent.location.reload();
                }
            })
            $(function() {
                $("#Mem_email").changeTips({
                    divTip: ".on_changes"
                });
            })
        </script>
    </head>
    <body style=" background-color:transparent;">
        <!--用户注册、登录-->
        <div class="registration_bk" style="display:block;"></div>
        <?php
        $form = $this->beginWidget('CActiveForm');
        ?>
        <!--用户登录-->
        <div class="registration registration_2" >
            <div class="tit clearfix">
                <span class="t_1">会员登录</span>
				 <!--
                <span class="t_2">Login</span>
                <span class="t_3">没有账号？
                    <a href="<?php echo SITE_URL ?>index/regester" class="a_1 a_xx2">立即免费注册&nbsp;<i>>></i></a>
                </span>
				-->
                <a class="t_4" href="javascript:"></a>
            </div>
            <div class="cont">
                <ul class="input_k">
                    <li class="clearfix">
                        <?php echo $form->textField($mem_login, 'email', array('autocomplete' => 'off', 'class' => 'shu', 'placeholder' => '请用邮箱登陆', "style" => "display:block;", "id" => "Mem_email")); ?>
                        <?php echo $form->error($mem_login, 'email'); ?>
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
                        <span class="text_1">邮&nbsp;&nbsp;&nbsp;箱：</span>
                    </li>
                    <li class="clearfix">
                        <?php echo $form->passwordField($mem_login, 'pwd', array('autocomplete' => 'off', 'class' => 'shu', "style" => "display:block;")); ?>
                        <?php echo $form->error($mem_login, 'pwd'); ?>
                        <i class="ico_2"></i>
                        <span class="text_1">密&nbsp;&nbsp;&nbsp;码：</span>
                    </li>
                    <li class="clearfix">
                        <?php echo $form->textField($mem_login, 'verifyCode', array('autocomplete' => 'off', 'maxlength' => 4, 'class' => 'shu yan', "style" => "display:block;")); ?>   
                        <span class="code_1">
                            <?php
                            $this->widget('CCaptcha', array('showRefreshButton' => false,
                                'clickableImage' => true, 'imageOptions' => array('alt' => '点击换图', 'title' => '点击换图',
                                    'style' => 'cursor:pointer;padding:px 0;padding:4px 0;background:#fff;display:inline-block;margin-bottom:3px')));
                            ?>
                        </span>
                        <?php echo $form->error($mem_login, 'verifyCode'); ?>
                        <span class="text_1">验证码：</span>
                    </li>
                    <li class="clearfix">
                        <button class="ann_1" type="submit">登录</button>
                        <a href="<?php echo SITE_URL ?>index/pwdfind1" class="wj" target="_block">忘记密码？</a>
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
    </body>
</html>
