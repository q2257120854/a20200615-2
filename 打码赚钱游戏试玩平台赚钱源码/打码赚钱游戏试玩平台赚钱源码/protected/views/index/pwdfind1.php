<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>找回密码_1-<?php echo TIT; ?></title>
        <meta name="keywords" content="、,、官网,51玩,试玩平台,网页游戏,游戏试玩,网上赚钱,打码网赚,打码平台,免费赚钱,免费换奖,网赚提现" />
        <meta name="description" content="、是一个玩游戏、体验产品赚积分，兑换各种奖品的体验营销娱乐平台。这里有最新最好玩的网页游戏，让您轻松实现网上赚钱的愿望。我们打造专业的网络兼职平台，用户在游戏试玩、参与互动体验、购物返利中获得免费积分--元宝，元宝可以换取Q币、话费、笔记本等丰富的奖品，是用户网赚和网络兼职的好去处" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/password_find.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/public_js.js"></script>
    </head>
    <body>
        <!--头部-->
        <?php include_once("./protected/views/design/header.php") ?>
        <?php $form = $this->beginWidget('CActiveForm', array("id" => "pwdfrom")); ?>
        <!--主体-->
        <div class="main">

            <!--找回密码第一步-->
            <div class="password_find clearfix">
                <div class="tit">
                    <span>找回密码</span>
                    <i>Password</i>
                </div>
                <div class="cont_1">
                    <div class="step_1"></div>
                    <div class="shur_1">
                        <ul class="ul_1">
                            <li>
                                <span class="text">注册邮箱：</span>
                                <?php echo $form->textField($email_model, 'email', array('placeholder' => "请输入您注册时所用的邮箱", "class" => "sframe sframe_1")); ?>
                                <i class="bi">*</i>
                            </li>
                            <li class="tis" style="display: block;">
                                <?php echo $form->error($email_model, 'email'); ?>
                            </li>
                            <li>
                                <span class="text" >验证码：</span>
                                <?php echo $form->textField($email_model, 'verifyCode', array('autocomplete' => 'off', 'maxlength' => 4, 'placeholder' => '请输入验证码', 'class' => 'sframe sframe_2')); ?>   
                                <span class="yan">
                                    <?php
                                    $this->widget('CCaptcha', array('showRefreshButton' => false,
                                        'clickableImage' => true, 'imageOptions' => array('alt' => '点击换图', 'title' => '点击换图',
                                            'style' => 'cursor:pointer;padding:px 0;padding:4px 0;background:#fff;display:inline-block;margin-bottom:3px')));
                                    ?>
                                </span>
                            </li>
                            <li class="tis" style="display: block;">
                                <?php echo $form->error($email_model, 'verifyCode'); ?>
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
