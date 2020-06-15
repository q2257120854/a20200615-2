<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>完善个人资料-<?php echo TIT; ?>官方网站</title>
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
                function idcheck() {
                    var card = $("#Memfirst_idcode").val();
                    var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
                    if (reg.test(card) == true)
                    {
                        $.ajax({
                            type: "POST",
                            data: {'card': card, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken ?>'},
                            dataType: "json",
                            url: "  <?php echo SITE_URL ?>vipindex/idcheck",
                            success: function(data) {
                                if (data != null) {
                                    $("#tishi").show();
                                    $("#Memfirst_sex").val(data['sex']);
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
                        document.getElementById("memfrom").submit();
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
                    <div class="step step_1"></div>
                    <ul class="step_text clearfix">
                        <li>
                            <p class="p_1">完善个人资料</p>
                            <p class="p_2"><?php echo $system_info["first"]; ?>元宝</p>

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
                        <span class="s">01&nbsp;</span>
                        <span class="t">完善个人资料奖励</span>
                        <span class="h"><?php echo $system_info["first"]; ?>元宝</span>
                    </div>
                    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'memfrom')); ?>
                    <input type="hidden" name="Memfirst[sex]" id="Memfirst_sex"/>
                    <div class="cont">
                        <ul class="prompt">
                            <li>如果你需要<i class="red">申请提现</i>或<i class="red">兑换奖品服务</i>，以下内容作为兑换凭证信息，需要填写您的姓名和联络方式，以便客服确保您的奖品能够及时准确地送到您的手上。</li>
                            <li>该信息也作为<i class="red">找回密码</i>的个人凭证之一，请仔细填写。</li>
                            <li>所有项目都为必填项目，<i class="red">全部填写</i> 才能领取奖励。</li>
                        </ul>
                        <ul class="input_k clearfix">
                            <li class="li_1 clearfix">
                                <span class="name">真实姓名：</span>
                                <span class="sr">
                                    <?php echo $form->textField($memfirst_info, 'name', array("class" => "sframe sframe_1")); ?>
                                </span>
                                <?php $name = $memfirst_info->getError("name"); ?>
                                <span class="zs <?php
                                if (!empty($name)) {
                                    echo "red";
                                }
                                ?>"><i>*&nbsp;</i>
                                          <?php
                                          if (!empty($name)) {
                                              echo $name;
                                          } else {
                                              echo "请务必填写您的真实姓名";
                                          }
                                          ?>
                                </span>
                            </li>
                            <li class="li_1 clearfix">
                                <span class="name">身份证号码：</span>
                                <span class="sr">
                                <?php echo $form->textField($memfirst_info, 'idcode', array("class" => "sframe sframe_1", "onBlur" => "idcheck();")); ?>
                                </span>
                                <?php $idcode = $memfirst_info->getError("idcode"); ?>
                                <span class="zs <?php
                                          if (!empty($idcode)) {
                                              echo "red";
                                          }
                                          ?>"><i>*&nbsp;</i>
                                          <?php
                                          if (!empty($idcode)) {
                                              echo $idcode;
                                          } else {
                                              echo "请务必填写与您姓名符合的身份证号码";
                                          }
                                          ?>
                                </span>
                            </li>
                            <li class="tis_1" id="tishi">
                                <div id="content"></div>
                            </li>
                            <li class="li_1 clearfix">
                                <span class="name">QQ号码：</span>
                                <span class="sr">
                                <?php echo $form->textField($memfirst_info, 'qq', array("class" => "sframe sframe_1")); ?>
                                </span>
                                          <?php $qq = $memfirst_info->getError("qq"); ?>
                                <span class="zs <?php
                                          if (!empty($qq)) {
                                              echo "red";
                                          }
                                          ?>"><i>*&nbsp;</i>
                                          <?php
                                          if (!empty($qq)) {
                                              echo $qq;
                                          } else {
                                              echo " 请务必填写正确的QQ号码,能体验更好的客服服务";
                                          }
                                          ?>
                                </span>
                            </li>
                            <li class="li_2">
                                <a class="ann_1" href="javascript:document.getElementById('memfrom').submit();">确定</a>
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
