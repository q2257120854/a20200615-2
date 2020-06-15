<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>身份认证-<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="\" />
              <meta name="description" content="\" />
              <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
            <link href="/style/vip/public.css" rel="stylesheet" type="text/css" />
            <link href="/style/vip/password_find.css" rel="stylesheet" type="text/css" />
            <script src="/scripts/vip/jQuery.v1.8.3.js"></script>
            <script src="/scripts/vip/public.js"></script>

            <script type="text/javascript">
                function idcheck() {
                    var card = $("#Idcode_idcode").val();
                    var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
                    var content = $("#content").html();
                    if (reg.test(card) == true && content == "")
                    {
                        $.ajax({
                            type: "POST",
                            data: {'card': card, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken ?>'},
                            dataType: "json",
                            url: "  <?php echo SITE_URL ?>vipindex/idcheck",
                            success: function(data) {
                                if (data != null) {
                                    $("#tishi").show();
                                    $("#Idcode_sex").val(data['sex']);
                                    $("#content").html(data['born'] + "\t\t\t" + data['sex'] + "\t\t\t" + data['att']);
                                } else {
                                    alert("对不起,没有查询到该身份证信息,请查看是否输入正确!");
                                }
                            }
                        });
                    }
                }

                function sub() {
                    if (confirm("您确定填写信息都正确吗？")) {
                        document.getElementById("pwdfrom").submit();
                    }
                }
            </script>
    </head>
    <body>
        <!--头部-->
        <?php include_once("./protected/views/vipdesign/header.php") ?>
        <?php $form = $this->beginWidget('CActiveForm', array("id" => "pwdfrom")); ?>
        <!--主体-->
        <div class="main">
            <!--头部logo-->
            <div class="top_logo clearfix">
                <a href="<?php echo SITE_URL ?>" class="logo"></a>
            </div>
            <!--找回密码第一步-->
            <div class="binding_find clearfix">
                <div class="tit">
                    <span>身份认证</span>
                    <i>Identity</i>
                </div>
                <div class="cont_1">
                    <div class="shur_1">
                        <input type="hidden" name="Idcode[sex]" id="Idcode_sex"/>
                        <ul class="ul_1">
                            <li>
                                <span class="text">真实姓名：</span>
                                <?php echo $form->textField($idcode_model, 'name', array("class" => "sframe sframe_1", 'placeholder' => '请输入真实姓名，一旦认证无法修改')); ?>
                            </li>
                            <li class="tis" style="display: block;">
                                <?php echo $form->error($idcode_model, 'name'); ?>
                            </li>
                            <li>
                                <span class="text">身份证号：</span>
                                <?php echo $form->textField($idcode_model, 'idcode', array("class" => "sframe sframe_1", 'maxlength' => 18, 'placeholder' => '请输入18位有效身份证号', "onBlur" => "idcheck();")); ?>
                            </li>
                            <li class="tis_1" id="tishi">
                                <div id="content"></div>
                            </li>
                            <li class="tis" style="display: block;">
                                <?php echo $form->error($idcode_model, 'idcode'); ?>
                            </li>
                            <li>
                                <span class="text">验证码：</span>
                                <?php echo $form->textField($idcode_model, 'verifyCode', array("class" => "sframe sframe_2", 'placeholder' => '请输入验证码')); ?>
                                <span class="yan">
                                    <?php
                                    $this->widget('CCaptcha', array('showRefreshButton' => false,
                                        'clickableImage' => true, 'imageOptions' => array('alt' => '点击换图', 'title' => '点击换图',
                                            'style' => 'cursor:pointer;padding:px 0;padding:4px 0;background:#fff;display:inline-block;margin-bottom:3px')));
                                    ?>
                                </span>
                            </li>
                            <li class="tis" style="display: block;">
                                <?php echo $form->error($idcode_model, 'verifyCode'); ?>
                            </li>
                            <li>
                                <a class="button_5" href="javascript:" onclick="sub()">认证</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="cont_2">
                    <div class="tit_2">手机认证目的：</div>
                    <p>
                        1. 为了保证账号的安全性。修改提现账户和收货
                        息也会发验证码，确保账户安全。（后续会增加更多
                        手机验证安全服务！）
                        <br />
                        2. 为了保证账号的唯一性。、是一个实名制网
                        站，一个用户只可注册和使用一个账号。
                        注意： 一个手机只能绑定且认证一个账号。</p>
                    <div class="tit_2">温馨提示：</div>
                    <p>
                        1. 接收手机验证码短信免费；手机验证不会产生任何
                        其他费用。
                        <br />
                        2. 验证码一天最多发送3次，如果3次都收不到，可能
                        是因为短信通道堵塞，要改天再验证。
                        <br />
                        3. 为保证验证码安全，验证码的有效期为10分钟；输
                        入错误10次后自动失效。
                        <br />
                        4. 一个手机号码只能验证一个账号。
                    </p>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
        <?php include_once("./protected/views/vipdesign/footer.php"); ?>
        <?php include_once("./protected/views/vipdesign/kefu.php") ?>
    </body>
</html>
