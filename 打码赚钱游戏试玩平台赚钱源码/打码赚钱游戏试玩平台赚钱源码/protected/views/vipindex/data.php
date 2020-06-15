<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>个人中心—资料管理--<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="\" />
              <meta name="description" content="\" />
              <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
            <link href="/style/vip/public.css" rel="stylesheet" type="text/css" />
            <link href="/style/vip/index.css" rel="stylesheet" type="text/css" />
            <script src="/scripts/vip/jQuery.v1.8.3.js"></script>
            <script src="/scripts/vip/public.js"></script>
            <script type="text/javascript">
                window.onload = function() {
                    var msg = $('#msg').val();
                    if (msg != null) {
                        alert(msg);
                    }
                }

                function changephone() {
                    $("#phone").show();
                }

                //关闭提示框
                function close() {
                    $("#tishikuan").hide();
                }

            </script>
            <style type="text/css">
                .hover1{border-top:4px solid #70a0f1; height:36px; line-height:36px; background:#4b6289;}
            </style>
    </head>
    <body>
        <?php
        if (Yii::app()->user->hasFlash('msg')) {
            ?>
            <input type="hidden" value="<?php echo Yii::app()->user->getFlash('msg') ?>" id="msg" />
        <?php } ?>
        <!--头部-->
        <?php include_once("./protected/views/vipdesign/header.php") ?>
        <!--主体-->
        <div class="main main_index clearfix">
            <!--导航-->
            <?php include_once("./protected/views/vipdesign/navicat.php") ?>
            <div class="data">
                <!--当前位置-->
                <div class="position">
                    <span>您的位置：</span>
                    <a href="<?php echo SITE_URL ?>vipindex/show">个人中心</a>
                    <i>&nbsp;>&nbsp;</i>
                    <a href="javascript:">资料管理</a>  
                </div>
                <input type="hidden" value="<?php echo $mem["email"]; ?>" name="email" id="email"/>
                <!--个人信息-->
                <div class="infor clearfix">
                    <div class="head_img">
                        <img src="<?php echo IMG_URL; ?>touxiang/<?php echo $memimg['img'] ?>" />
                    </div>
                    <div class="xx">
                        <p class="name">
                            <span>账户名：</span>
                            <i><?php echo Yii::app()->user->name; ?></i>
                        </p>
                        <p class="dj clearfix">
                            <span>安全等级：</span>
                            <?php if (!empty($mem['phone']) && $mem['email_valid'] == 1 && !empty($mem['idcode'])) { ?>
                                <i class="i_3"></i>
                            <?php } else if ((!empty($mem['phone']) && $mem['email_valid'] == 1) || (!empty($mem['phone']) && !empty($mem['idcode'])) || ($mem['email_valid'] == 1 && !empty($mem['idcode']))) { ?>
                                <i class="i_2"></i>
                            <?php } else { ?>
                                <i class="i_1"></i>
                            <?php } ?>
                            <em class="went"></em>
                            <i class="ts">
                                <em>安全提示方式：</em>
                                <em>1、绑定手机</em>
                                <em>2、绑定邮箱</em>
                                <em>3、身份认证</em>
                            </i>
                        </p>
                        <p class="fs clearfix">
                            <span>提现方式：</span>
                            <a  <?php
                            if (!empty($mem['alipayid'])) {
                                echo "title='支付宝已绑定' class='a_1'";
                            } else {
                                echo "title='支付宝未绑定' class='a_1 a_1no'";
                            }
                            ?> href="<?php echo SITE_URL ?>vipadvance/alipay"></a> 
                            <a  <?php
                            if (!empty($mem['treasureid'])) {
                                echo "title='财付通已绑定' class='a_2'";
                            } else {
                                echo "title='财付通未绑定' class='a_2 a_2no'";
                            }
                            ?> href="<?php echo SITE_URL ?>vipadvance/treasure"></a>
                            <a  <?php
                            if (!empty($mem['bankid'])) {
                                echo " title='银行卡已绑定' class='a_3'";
                            } else {
                                echo "title='银行卡未绑定' class='a_3 a_3no'";
                            }
                            ?> href="<?php echo SITE_URL ?>vipadvance/bank"></a>
                        </p>
                    </div>
                </div>
                <?php $phone = substr_replace($mem["phone"], '****', 3, 4); ?>
                <!--手机、邮箱、身份验证-->
                <div class="binding">
                    <ul class="ul_1 clearfix">
                        <li>
                            <div class="ban <?php
                            if (!empty($mem["phone"])) {
                                echo "ban_yes";
                            }
                            ?> clearfix" >
                                <span class="ico_sj"></span>
                                <p class="tit clearfix">
                                    <i>手机</i>
                                </p>
                                <p class="judge clearfix">
                                    <?php
                                    if (!empty($mem["phone"])) {
                                        ?>
                                        <i class="w"><?php echo $phone; ?></i>
                                        <!--<a class="bianj" style="color:red;" href="javascript:changephone()" >更换手机</a>-->
                                    <?php } else { ?>
                                        <a class="lij" href="<?php echo SITE_URL ?>vipindex/second">立即绑定</a>
                                    <?php } ?>
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="ban <?php
                            if (!empty($mem["email_valid"])) {
                                echo "ban_yes";
                            }
                            ?>  clearfix"  >
                                <span class="ico_yx"></span>
                                <p class="tit">
                                    <i>邮箱</i>
                                </p>
                                <p class="judge clearfix">
                                    <?php
                                    if (!empty($mem["email_valid"])) {
                                        ?>
                                        <i class="w"><?php echo substr_replace($mem["email"], '****', 3, 4); ?> </i>
                                    <?php } ?>
                                    <a class="lij" href="<?php echo SITE_URL ?>vipindex/thirdly">立即验证</a>
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="ban <?php
                            if (!empty($mem["idcode"])) {
                                echo "ban_yes";
                            }
                            ?> clearfix" >
                                <span class="ico_wx"></span>
                                <p class="tit">
                                    <i>身份验证</i>
                                </p>
                                <p class="judge clearfix">
                                    <?php
                                    if (!empty($mem["idcode"])) {
                                        ?>
                                        <i class="w"><?php echo substr_replace($mem["idcode"], '***********', 3, 11); ?></i>
                                    <?php } ?>
                                    <a class="lij" href="<?php echo SITE_URL ?>vipindex/first">立即验证</a>
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <!--登录密码、交易密码-->
                <div class="cipher">
                    <div class="di_1 clearfix">
                        <span class="tit">登录密码</span>
                        <span class="state">已设置</span>
                        <span class="tis">登录、时需要输入的密码</span>
                        <a class="button_1 xiug" href="<?php echo SITE_URL ?>vipindex/dlpwd" >
                            <i></i>
                            <em>修改</em>
                        </a>
                    </div>
                    <?php if (empty($mem_info['jy_pwd'])) { ?>
                        <div class="di_1 clearfix">
                            <span class="tit">交易密码</span>
                            <span class="state_no">未设置</span>
                            <span class="tis">设置交易密码，确保资金安全</span>
                            <a class="button_1 shez" href="<?php echo SITE_URL ?>vipindex/fourthly">
                                <i></i>
                                <em>立即设置</em>
                            </a>
                        </div>
                    <?php } else { ?>
                        <div class="di_1 clearfix">
                            <span class="tit">交易密码</span>
                            <span class="state">已设置</span>
                            <span class="tis">设置交易密码，确保资金安全</span>
                            <a class="button_1 xiug" href="<?php echo SITE_URL ?>vipindex/jypwd" >
                                <i></i>
                                <em>修改</em>
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <?php $form = $this->beginWidget('CActiveForm', array('id' => 'memfrom')); ?>
                <!--用户信息-->
                <div class="user_xx">
                    <div class="tit clearfix">
                        <span class="text">用户信息</span>
                        <span class="ann" style="display:none;">
                            <a class="button_1 qux" href="javascript:">取消</a>
                            <a class="button_1 qued" href="javascript:document.getElementById('memfrom').submit();">确定</a>
                        </span>
                        <span class="edit"></span>
                    </div>
                    <div class="cont cont_1" style="display:none;">
                        <ul class="ul_1">
                            <li class="clearfix">
                                <p>
                                    <span class="text">真实姓名：</span>
                                    <?php echo $form->textField($mem_info, 'name', array("class" => "sframe sframe_1")); ?>
                                    <?php echo $form->error($mem_info, 'name'); ?>
                                </p>
                                <p>
                                    <span class="text">性别：</span>
                                    <?php echo $form->radioButtonList($mem_info, 'sex', array('男' => '男', '女' => '女'), array('separator' => '&nbsp;')); ?>
                                    <?php echo $form->error($mem_info, 'sex'); ?>
                                </p>
                            </li>
                            <li class="clearfix li_1">
                                <p>
                                    <span class="text">QQ：</span >
                                    <?php echo $form->textField($mem_info, 'qq', array("class" => "sframe sframe_1", "disabled" => "disabled")); ?>
                                    <?php echo $form->error($mem_info, 'name'); ?>
                                </p>
                                <p>
                                    <span class="text">电话号码：</span> 
                                    <?php echo $form->textField($mem_info, 'phone', array("class" => "sframe sframe_1", "disabled" => "disabled", "value" => $phone)); ?>
                                    <?php echo $form->error($mem_info, 'phone'); ?>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="cont cont_2">
                        <ul class="ul_1">
                            <li class="clearfix">
                                <p>
                                    <span class="text">真实姓名：</span>
                                    <span class="text_1"><?php echo $mem_info['name']; ?></span>
                                </p>
                                <p>
                                    <span class="text">性别：</span>
                                    <span class="text_1"><?php echo $mem_info['sex']; ?></span>
                                </p>
                            </li>
                            <li class="clearfix">
                                <p>
                                    <span class="text">QQ：</span>
                                    <span class="text_1"><?php echo $mem_info['qq']; ?></span>   
                                </p>
                                <p>
                                    <span class="text">电话号码：</span>
                                    <span class="text_1"><?php echo $phone; ?></span> 
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
            <?php
            if (!empty($ad_info)) {
                foreach ($ad_info as $ad) {
                    ?>
                    <!--广告图-->
                    <a class="advertising_1" href="<?php echo $ad['url']; ?>">
                        <img src="/uploads/img/ad/<?php echo $ad['img']; ?>">
                    </a>
                    <?php
                }
            }
            ?>
        </div>
        <!--兑换豆豆成功弹出框-->
        <div class="eject_db5" id="tishikuan" style=" display: none;">
            <!--兑换金豆成功弹出框背景-->
            <div class="eject_bk4" style="display:block"></div>
            <!--兑换金豆成功弹出框-->
            <div class="eject4" style="display:block">
                <div class="eject1_tit">更改手机号,需要您先绑定邮箱！</div>
                <div class="eject1_button clearfix">
                    <span><a href="javascript:close()" class="eject1_ann">暂不绑定</a></span>
                    <span><a href="<?php echo SITE_URL ?>vipindex/thirdly" class="eject1_ann">前去绑定</a></span>
                </div>
            </div>
        </div>
        <!--底部1-->
        <?php include_once("./protected/views/vipdesign/footer.php"); ?>
        <?php include_once("./protected/views/vipdesign/kefu.php"); ?>
        <iframe src="<?php echo SITE_URL ?>vipindex/phone" class="tran_password" frameborder="0" ALLOWTRANSPARENCY="true" style="display:none" id="phone"></iframe>

    </body>
</html>
