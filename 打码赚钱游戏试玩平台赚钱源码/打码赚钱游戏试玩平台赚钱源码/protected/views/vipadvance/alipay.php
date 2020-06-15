<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>个人中心—提现管理—提现方式—<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="/" />
        <meta name="description" content="/" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/vip/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/vip/inside.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/vip/jQuery.v1.8.3.js"></script>
        <script src="/scripts/vip/public.js"></script>
        <style type="text/css">
            .hover3{border-top:4px solid #70a0f1; height:36px; line-height:36px; background:#4b6289;}
            .hover21{background: url("<?php echo IMG_URL ?>vip/img/public_db _menu_left _j.png") no-repeat scroll right center #fff; color: #cc3d12;width: 171px;}
            div .errorMessage{color:red;}
        </style>
        <script type="text/javascript">
            var InterValObj; //timer变量，控制时间
            var count = 600; //间隔函数，1秒执行
            var curCount;//当前剩余秒数
            function sendMessage() {
                var email = "<?php
$mem = $this->show_mem();
echo $mem['email_valid'];
?>";
                if (email == 1) {
                    curCount = count;
                    //设置button效果，开始计时
                    $("#btnSendCode").attr("class", "button_1 ann_2");
                    InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
                    var Num = "";
                    for (var i = 0; i < 6; i++)
                    {
                        Num += Math.floor(Math.random() * 10);
                    }
                    $("#Alipay_num").val(Num);
                    //向后台发送处理数据
                    $.ajax({
                        type: "POST",
                        data: {'Num': Num, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken ?>'},
                        dataType: "json",
                        url: "<?php echo SITE_URL ?>vipindex/sendemail",
                        success: function() {

                        }
                    });
                } else {
                    $("#tishi").show();
                }
            }
            //timer处理函数
            function SetRemainTime() {
                if (curCount == 0) {
                    window.clearInterval(InterValObj);//停止计时器
                    $("#btnSendCode").attr("class", "button_1 ann_1");
                    $("#btnSendCode").val("重新发送邮箱验证码");
                } else {
                    curCount--;
                    $("#btnSendCode").val("请在" + curCount + "秒内输入邮箱验证码!");
                }
            }

            window.onload = function() {
                var msg = $('#msg').val();
                if (msg != null) {
                    alert(msg);
                    location.href = "<?php echo SITE_URL ?>vipadvance/alipay";
                }
            }
        </script>
    </head>
    <body>
        <!--头部-->
        <?php include_once("./protected/views/vipdesign/header.php") ?>
        <!--主体-->
        <div class="main clearfix">
            <!--导航-->
            <?php include_once("./protected/views/vipdesign/navicat.php") ?>
            <div class="public_db clearfix">
                <!--左菜单-->
                <?php include_once("left.php") ?>
                <!--右内容-->
                <div class="cont prizes">
                    <!--切换-->
                    <div class="switch clearfix" style=" margin-top:20px;">
                        <ul class="ul_2 clearfix">
                            <li class="hover" style="border-left:1px solid #bdbcbd;"><a href="<?php echo SITE_URL; ?>vipadvance/alipay"><?php if (empty($mem['alipayid'])) { ?>绑定<?php } else { ?>修改<?php } ?>我的支付宝</a></li>
                            <li><!--<a href="<?php echo SITE_URL; ?>vipadvance/treasure"><?php if (empty($mem['treasureid'])) { ?>绑定<?php } else { ?>修改<?php } ?>-->我的财付通<!--</a>--></li>
                            <li><!--<a href="<?php echo SITE_URL; ?>vipadvance/bank"><?php if (empty($mem['bankid'])) { ?>绑定<?php } else { ?>修改<?php } ?>-->我的银行卡<!--</a>--></li>
                        </ul>
                    </div>
                    <?php
                    //判断是否有提示信息
                    if (Yii::app()->user->hasFlash('msg')) {
                        ?>
                        <input type="hidden" value="<?php echo Yii::app()->user->getFlash('msg') ?>" id="msg" />
                    <?php } ?>
                    <?php
                    if (empty($mem['alipayid']) || !empty($alipay_model['id'])) {
                        $form = $this->beginWidget('CActiveForm', array('id' => 'dhform'))
                        ?>
                        <input type="hidden" id="Alipay_num" name="Alipay[num]" value="<?php echo $num; ?>"/>   
                        <input type="hidden" value="<?php echo $mem['id']; ?>" id="Alipay_mem_id" name="Alipay[mem_id]"/>
                        <div class="alipay">
                            <ul class="ul_1">
                                <li class="clearfix">
                                    <span class="name">真实姓名：</span>
                                    <span class="text_1">
                                        <?php echo $form->textField($alipay_model, 'name', array('class' => 'sframe inp_1')); ?>
                                    </span>
                                    <span class="zs"><i>*</i>请务必填写您的真实姓名</span>
                                </li>
                                <li class="tishi" style="display:block;"><?php echo $form->error($alipay_model, 'name'); ?></li>
                                <li class="clearfix">
                                    <span class="name">账号：</span>
                                    <span class="text_1">
                                        <?php echo $form->textField($alipay_model, 'account', array('class' => 'sframe inp_2')); ?>  
                                    </span>
                                    <span class="zs"><i>*</i>请输入支付宝登陆账号</span> 
                                </li>
                                <li class="tishi" style="display:block;"><?php echo $form->error($alipay_model, 'account'); ?></li>
                                <li class="clearfix">
                                    <span class="name">确认账号：</span>
                                    <span class="text_1">
                                        <?php echo $form->textField($alipay_model, 'account2', array('class' => 'sframe inp_2')); ?>
                                    </span>
                                    <span class="zs"><i>*</i>请再次输入支付宝登陆账号</span> 
                                </li>
                                <li class="tishi" style="display:block;">  <?php echo $form->error($alipay_model, 'account2'); ?></li>
                                <li class="clearfix">
                                    <span class="name">验证码：</span>
                                    <span class="text_1 clearfix" style=" width: auto;">
                                        <?php echo $form->textField($alipay_model, 'code', array('class' => 'sframe inp_1', 'size' => 6)); ?>
                                        <input id="btnSendCode" type="button" class="button_1 ann_1" value="发送邮箱验证码" onclick="sendMessage()"  />
                                    </span> 
                                </li>
                                <li  id="tishi" style="display:none">
                                    <span>您还未绑定邮箱,</span><a href="  <?php echo SITE_URL ?>vipindex/thirdly" target="_blank"><span style="color:red">立即绑定邮箱</span></a>
                                </li>
                                <li class="tishi" style="display:block;"><?php echo $form->error($alipay_model, 'code'); ?></li>
                                <li>
                                    <a class="button_2 ann_3"  href="javascript:document.getElementById('dhform').submit();" >确定</a>
                                </li>
                            </ul>
                        </div>
                        <?php
                        $this->endWidget();
                    }
                    ?>
                    <?php if (!empty($mem['alipayid'])) { ?>
                        <!--表格-->
                        <div class="already">
                            <div class="tit_1">已绑定的支付宝</div>
                            <table class="table_2" width="100%" border="1">
                                <tr class="tit">
                                    <th>姓名</th>
                                    <th>银行</th>
                                    <th>开户行</th>
                                    <th>卡号</th>
                                    <th>操作</th>
                                </tr>
                                <?php
                                if (!empty($mem['alipayid'])) {
                                    $alipayinfo = Alipay::model()->findByPk($mem['alipayid']);
                                    ?>
                                    <tr>
                                        <td align="center" valign="middle"><?php echo $alipayinfo['name']; ?></td>
                                        <td align="center" valign="middle">支付宝</td>
                                        <td align="center" valign="middle">支付宝</td>
                                        <td align="center" valign="middle"><?php echo $alipayinfo['account'] ?></td>
                                        <td align="center" valign="middle"><a class="xiu" href="<?php echo SITE_URL ?>vipadvance/editalipay/id/<?php echo $alipayinfo['id'] ?>">修改</a></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php
            if (!empty($ad_info)) {
                foreach ($ad_info as $ad) {
                    ?>
                    <a class="advertising_1" href="<?php echo $ad['url']; ?>">
                        <img src="/uploads/img/ad/<?php echo $ad['img']; ?>">
                    </a>
                    <?php
                }
            }
            ?> 
        </div>
        <!--底部1-->
        <?php include_once("./protected/views/vipdesign/footer.php"); ?>
        <?php include_once("./protected/views/vipdesign/kefu.php") ?>
    </body>
</html>
