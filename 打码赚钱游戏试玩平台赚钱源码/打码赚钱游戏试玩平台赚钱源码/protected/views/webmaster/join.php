<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>申请加入站长联盟-、官方网站</title>
        <meta name="keywords" content="、，推荐好友，网赚，免费Q币，免费网赚"/>
        <meta name="description" content="、推荐好友版块，这里为玩家提供免费网赚的项目，广交朋友的用户可以通过邀请好友一起网赚，获得U币，兑换免费Q币、话费、手机、笔记本等礼品。"/>
        <link href="/style/web.css" rel="stylesheet" type="text/css" />
        <link href="/style/public.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/public_js.js"></script>
        <script src="/scripts/js_1.js"></script>
        <style type="text/css">
            div .errorMessage{color:red;}
        </style>
    </head>
    <!--加载大家都在玩滚动-->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.list_lh li:even').addClass('lieven');
        })
        $(function() {
            $("div.list_lh").myScroll({
                speed: 40, //数值越大，速度越慢
                rowHeight: 86 //li的高度
            });
        });
        window.onload = function() {
            var msg = $('#msg').val();
            if (msg == "success") {
                $("#tsinfo").show();
            }
        }

        function urlfrom() {
            var memid = $("#mem_id").val();
            if (memid != "") {
                document.getElementById('webfrom').action = '<?php echo SITE_URL; ?>webmaster/join';
                document.getElementById("webfrom").submit();
            } else {
                alert(" 请先登录！");
            }
        }

        function close() {
            $("#tsinfo").hide();
        }
    </script>
    <body style="background:url(<?php echo IMG_URL ?>webmasterimg/body_bk.png) repeat;">
        <?php include_once("./protected/views/design/header.php") ?>
        <?php
        if (Yii::app()->user->hasFlash('msg')) {
            ?>
            <input type="hidden" value="<?php echo Yii::app()->user->getFlash('msg') ?>" id="msg" />
        <?php } ?>
        <!--主体-->
        <div class="main">
            <div class="z_mian">
                <div class="z_big">
                    <div class="z_cont clearfix">
                        <div class="tit">欢迎加入、站长联盟</div>
                        <?php
                        $form = $this->beginWidget('CActiveForm', array("id" => "webfrom"));
                        if (!empty($mem["id"])) {
                            $web_info = Web::model()->findBySql("select * from {{web}} where mem_id=" . $mem["id"]);
                        }
                        ?>
                        <!--左边-->
                        <div class="regis_1">
                            <ul class="ul_1">
                                <li class="text">
                                    以下注册信息均为必填项，如有问题，请<a href="#">联系我们</a>
                                </li>
                                <li class="li_1">
                                    <span class="mz">网站名称：</span>
                                    <?php echo $form->textField($web_model, 'webname', array('autocomplete' => 'off', 'class' => 'sframe', "value" => $web_info["webname"])); ?>
                                    <?php $webname = $web_model->getError("webname"); ?>
                                </li>
                                <li class="<?php
                                if (empty($webname)) {
                                    echo "prompt";
                                }
                                ?>"> <?php echo $form->error($web_model, 'webname'); ?></li>
                                <li class="li_1">
                                    <span class="mz">网站地址：</span>
                                    <?php echo $form->textField($web_model, 'weburl', array('autocomplete' => 'off', 'class' => 'sframe', "value" => $web_info["weburl"])); ?>
                                    <?php $weburl = $web_model->getError("weburl"); ?>
                                </li>
                                <li class="<?php
                                if (empty($weburl)) {
                                    echo "prompt";
                                }
                                ?>"><?php echo $form->error($web_model, 'weburl'); ?></li>
                                <li class="li_1">
                                    <span class="mz">QQ号码：</span>
                                    <?php echo $form->textField($web_model, 'qq', array('autocomplete' => 'off', 'class' => 'sframe', "value" => $mem["qq"])); ?>
                                    <?php $qq = $web_model->getError("qq"); ?>

                                    <li class="<?php
                                    if (empty($qq)) {
                                        echo "prompt";
                                    }
                                    ?>">  <?php echo $form->error($web_model, 'qq'); ?></li>

                                </li>
                                <li class="li_1">
                                    <span class="mz">联系手机：</span>
                                    <?php echo $form->textField($web_model, 'phone', array('autocomplete' => 'off', 'class' => 'sframe', "value" => $mem["phone"])); ?>
                                    <?php $phone = $web_model->getError("phone"); ?>

                                </li>
                                <li class="<?php
                                if (empty($phone)) {
                                    echo "prompt";
                                }
                                ?>"> <?php echo $form->error($web_model, 'phone'); ?></li>

                                <li class="li_1">
                                    <span class="mz">联系邮箱：</span>
                                    <?php echo $form->textField($web_model, 'email', array('autocomplete' => 'off', 'class' => 'sframe', "value" => $mem["email"])); ?>
                                    <?php $email = $web_model->getError("email"); ?>
                                </li>
                                <li class="<?php
                                if (empty($email)) {
                                    echo "prompt";
                                }
                                ?>">  <?php echo $form->error($web_model, 'email'); ?></li>
                                <li class="li_1">
                                    <span class="mz">真实姓名：</span>
                                    <?php echo $form->textField($web_model, 'name', array('autocomplete' => 'off', 'class' => 'sframe', "value" => $mem["name"])); ?>
                                    <?php $name = $web_model->getError("name"); ?>
                                </li>
                                <li class="<?php
                                if (empty($name)) {
                                    echo "prompt";
                                }
                                ?>"> <?php echo $form->error($web_model, 'name'); ?></li>
                                <li class="li_1">
                                    <span class="mz">身份证号：</span>
                                    <?php echo $form->textField($web_model, 'code', array('autocomplete' => 'off', 'class' => 'sframe', "value" => $mem["idcode"])); ?>
                                    <?php $code = $web_model->getError("code"); ?>
                                </li>
                                <?php if (empty($web_info)) { ?>
                                    <li class="<?php
                                    if (empty($code)) {
                                        echo "prompt";
                                    }
                                    ?>">  <?php echo $form->error($web_model, 'code'); ?></li>
                                    <li class="li_1">
                                        <span class="mz">验证码：</span>
                                        <?php echo $form->textField($web_model, 'verifyCode', array('autocomplete' => 'off', 'maxlength' => 4, 'class' => 'sframe sframe_1')); ?>   
                                        <?php $verifyCode = $web_model->getError("verifyCode"); ?>
                                        <span class="code">
                                            <?php
                                            $this->widget('CCaptcha', array('showRefreshButton' => false,
                                                'clickableImage' => true, 'imageOptions' => array('alt' => '点击换图', 'title' => '点击换图',
                                                    'style' => 'cursor:pointer;padding:px 0;padding:4px 0;background:#fff;display:inline-block;margin-bottom:3px')));
                                            ?>
                                    </li>
                                    <li class="<?php
                                    if (empty($verifyCode)) {
                                        echo "prompt";
                                    }
                                    ?>"> <?php echo $form->error($web_model, 'verifyCode'); ?></li>
                                    <li class="button">
                                        <a class="ann" onclick="urlfrom()" href="javascript:">申请加入</a>
                                    </li>
                                <?php } else { ?>
                                    <li class="button">
                                        <a class="ann" href="javascript:"><?php echo $web_info["status"]; ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                            <input name="Web[mem_id]" id="mem_id" value="<?php echo $mem["id"]; ?>" type="hidden"/>
                            <input name="Web[status]" value="审核中" type="hidden"/>
                        </div>
                        <?php $this->endWidget(); ?>
                        <!--右边-->
                        <div class="tuij">
                            <div class="direct clearfix">
                                <div class="tit_1">入驻说明</div>
                                <p>1、每个站长仅有3次提交审核机会，3次未通过请联系张先生处理！</p>
                                <p>2、符合要求的站长一旦加入、，永不取消站长联盟成员资格，永久享受联盟奖励制度！</p>
                                <p>3、下线作弊产生的佣金不计费，处理前会提前通知站长。作弊严重者将被取消站长资格。(取消站长资格后恢复为普通、用户，享受正常用户的奖励制度)</p>
                            </div>
                            <?php
                            $hlbinfo = Hlb::model()->findAllBySql("select hlb,create_time,mem_id from {{hlb}} where pmem_id !=0 and create_time>'2015-04-10 00:00' order by create_time DESC  Limit 0, 10  ");
                            if (!empty($hlbinfo)) {
                                ?>
                                <!--推广收益动态-->
                                <div class="play">
                                    <div class="tit_1">
                                        推广收益动态
                                    </div>
                                    <div class="bcon">
                                        <div class="list_lh">
                                            <ul>
                                                <?php
                                                foreach ($hlbinfo as $info) {
                                                    $member = Mem::model()->findByPk($info['mem_id']);
                                                    $memimg = Memimg::model()->findByPk($member['memimg_id']);
                                                    ?>
                                                    <li class="clearfix">
                                                        <div class="di_1">
                                                            <span class="tou"><img src="<?php echo IMG_URL; ?>touxiang/<?php echo $memimg['img'] ?>" /></span>
                                                            <p class="name"><?php echo $member['mem_name'] ?></p>
                                                            <p class="lin clearfix"><span>推广获得：</span><em><?php echo number_format(intval($info['hlb'])); ?></em></p>
                                                            <p class="wan"><?php echo $info['create_time'] ?></p>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--站长联盟注册成功弹出框-->
        <div class="eject_db7" style="display: none;" id="tsinfo">
            <div class="eject_bk6">
            </div>
            <div class="eject6 clearfix">
                <div class="tx_5">
                </div>
                <div class="cont">
                    <p class="p_1" style=" margin-top:70px;">您已成功提交申请、站长联盟</p>
                    <p class="p_1">我们将尽快审核,届时请留意哦！</p>
                    <p class="p_2" id="returninfo">
                        <a class="fh" href="javascript:close()" >确定</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        <a class="fh" href="<?php echo SITE_URL; ?>webmaster/show">返回联盟首页</a>
                    </p>
                    <div></div>
                </div>
            </div>
        </div>
        <!--底部1-->
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
    </body>
</html>
