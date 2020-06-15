<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>设置交易密码-<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="\" />
              <meta name="description" content="\" />
              <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
            <link href="/style/vip/info.css" rel="stylesheet" type="text/css" />
            <script src="/scripts/vip/jQuery.v1.8.3.js"></script>
            <script src="/scripts/vip/info.js"></script>
            <style type="text/css">
                div .errorMessage{color:red;}
            </style>
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
                    <div class="step step_3"></div>
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
                        <span class="s">03&nbsp;</span>
                        <span class="t">设置交易密码奖励</span>
                        <span class="h"><?php echo $system_info["fourthly"]; ?>元宝</span>
                    </div>
                    <?php $form = $this->beginWidget('CActiveForm', array("id" => "memfrom")); ?>
                    <div class="cont">
                        <ul class="prompt">
                            <li>设置交易密码后，您就能顺利使用以下网站功能：<i class="red">兑换奖品</i>、<i class="red">元宝</i>、<i class="red">豆存取</i>、<i class="red">玩宝</i>、<i class="red">申请提现</i>等功能。 </li>
                            <li>为了保证您的账号安全及顺畅体验，请尽快完成<i class="red">交易密码设置</i>。</li>
                        </ul>
                        <ul class="input_k clearfix">
                            <li class="li_1 clearfix">
                                <span class="name">交易密码：</span>
                                <span class="sr">
                                    <?php echo $form->passwordField($memfourthly_info, 'jy_pwd', array('class' => 'sframe sframe_1', "placeholder" => "输入交易密码")); ?>
                                </span>
                                <?php $jy_pwd = $memfourthly_info->getError("jy_pwd"); ?>
                                <span class="zs <?php
                                if (!empty($jy_pwd)) {
                                    echo "red";
                                }
                                ?>"><i>*&nbsp;</i>
                                          <?php
                                          if (!empty($jy_pwd)) {
                                              echo $jy_pwd;
                                          } else {
                                              echo "请输入6—16位英文加数字密码";
                                          }
                                          ?>
                                </span>
                            </li>
                            <li class="li_1 clearfix">
                                <span class="name">确定密码：</span>
                                <span class="sr">
                                <?php echo $form->passwordField($memfourthly_info, 'jy_pwd2', array('class' => 'sframe sframe_1', "placeholder" => "请再次输入交易密码")); ?>
                                </span>
                                <?php $jy_pwd2 = $memfourthly_info->getError("jy_pwd2"); ?>
                                <span class="zs <?php
                                          if (!empty($jy_pwd2)) {
                                              echo "red";
                                          }
                                          ?>"><i>*&nbsp;</i>
                                          <?php
                                          if (!empty($jy_pwd2)) {
                                              echo $jy_pwd2;
                                          } else {
                                              echo "请再次输入密码";
                                          }
                                          ?>
                                </span>
                            </li>
                            <li class="li_1 clearfix">
                                <span class="name">验证码：</span>
                                <span class="sr">
                                        <?php echo $form->textField($memfourthly_info, 'verifyCode', array("class" => "sframe sframe_2", 'placeholder' => '请输入验证码')); ?>
                                    <span class="img">
                                        <?php
                                        $this->widget('CCaptcha', array('showRefreshButton' => false,
                                            'clickableImage' => true, 'imageOptions' => array('alt' => '点击换图', 'title' => '点击换图',
                                                'style' => 'cursor:pointer;padding:px 0;padding:4px 0;background:#fff;display:inline-block;margin-bottom:3px')));
                                        ?>
                                    </span>
                                </span>
                                          <?php $verifyCode = $memfourthly_info->getError("verifyCode"); ?>
                                <span class="zs <?php
                                          if (!empty($verifyCode)) {
                                              echo "red";
                                          }
                                          ?>"><i>*&nbsp;</i>
                                          <?php
                                          if (!empty($verifyCode)) {
                                              echo $verifyCode;
                                          } else {
                                              echo "请输入验证码";
                                          }
                                          ?>
                                </span>
                            </li>
                            <li class="li_2">
                                <a class="ann_1" href="javascript:document.getElementById('memfrom').submit();">确认</a>
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
