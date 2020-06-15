<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>注册好友邀请页-<?php echo TIT; ?>、官方网站</title>
        <meta name="keywords" content="/" />
        <meta name="description" content="/" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/frireg.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/frireg.js"></script>
        <script src="/scripts/frireg_1.js"></script>
        <script type="text/javascript" src="/scripts/inputmail.js"></script>
    </head>
    <!--加载大家都在玩滚动-->
    <script type="text/javascript">
        $(function() {
            $("#Memfri_email").changeTips({
                divTip: ".on_changes"
            });
        })

        $(document).ready(function() {
            $('.list_lh li:even').addClass('lieven');
        })
        $(function() {
            $("div.list_lh").myScroll({
                speed: 40, //数值越大，速度越慢
                rowHeight: 86 //li的高度
            });
        });

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
                    }
                    else {
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
    <body style="background:url(<?php echo IMG_URL ?>friregimg/body_bk.png) no-repeat top center #ec7a36;">
        <div class="z_mian">
            <a href="<?php echo SITE_URL;?>" target="_blank" class="z_logo"></a>
            <div class="z_big">
                <div class="z_cont clearfix">
                    <div class="tit">欢迎注册</div>
                    <?php $form = $this->beginWidget('CActiveForm', array("id" => "reg")); ?>
                    <input type="hidden" value="<?php echo $memid; ?>" id="memid" name="memid"/>
                    <!--左边-->
                    <div class="regis"> 
                        <ul class="ul_1">
                            <li class="text">
                                以下注册信息均为必填项，如有问题，请<a href="<?php echo SITE_URL; ?>index/guangyu">联系我们</a>
                            </li>
                            <li class="li_1">
                                <?php echo $form->textField($memfri_model, 'email', array('autocomplete' => 'off', 'placeholder' => '请输入正确的邮箱地址', 'class' => 'sframe')); ?>
                                <i class="mailbox"></i>
                                <?php
                                $email = $memfri_model->getError("email");
                                if (!empty($email)) {
                                    ?>
                                    <p class="prompt"><?php echo $email; ?></p>
                                <?php } ?>
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
                            </li>
                            <li class="li_1">
                                <?php echo $form->passwordField($memfri_model, 'pwd', array('autocomplete' => 'off', 'placeholder' => '请输入密码', 'class' => 'sframe', "onblur" => "safe(this.value)")); ?>
                                <i class="password"></i>
                                <?php
                                $pwd = $memfri_model->getError("pwd");
                                if (!empty($pwd)) {
                                    ?>
                                    <p class="prompt"><?php echo $pwd; ?></p>
                                <?php } ?>
                            </li>
                            <!--安全等级，grade_1：低、grade_2：中、grade_1：高-->
                            <li class="grade grade_1" id="grade1" style="display:none"></li>
                            <li class="grade grade_2" id="grade2" style="display:none"></li>
                            <li class="grade grade_3" id="grade3" style="display:none"></li>
                            <li class="li_1">
                                <?php echo $form->passwordField($memfri_model, 'pwd2', array('autocomplete' => 'off', 'placeholder' => '请再次输入密码', 'class' => 'sframe')); ?>
                                <i class="password"></i>
                                <?php
                                $pwd2 = $memfri_model->getError("pwd2");
                                if (!empty($pwd2)) {
                                    ?>
                                    <p class="prompt"><?php echo $pwd2; ?></p>
                                <?php } ?>
                            </li>
                            <li class="li_1">
                                <?php echo $form->textField($memfri_model, 'mem_name', array('autocomplete' => 'off', 'placeholder' => '请输入昵称', 'class' => 'sframe')); ?>
                                <i class="name"></i>

                                <?php
                                $mem_name = $memfri_model->getError("mem_name");
                                if (!empty($mem_name)) {
                                    ?>
                                    <p class="prompt"><?php echo $mem_name; ?></p>
                                <?php } ?>
                            </li>
                            <li class="li_1">
                                <?php echo $form->textField($memfri_model, 'verifyCode', array('autocomplete' => 'off', 'maxlength' => 4, 'placeholder' => '请输入验证码', 'class' => 'sframe sframe_1')); ?>   
                                <?php
                                $verifyCode = $memfri_model->getError("verifyCode");
                                if (!empty($verifyCode)) {
                                    ?>
                                    <p class="prompt"><?php echo $verifyCode; ?></p>
                                <?php } ?>
                                <!--验证码-->
                                <span class="code">
                                    <?php
                                    $this->widget('CCaptcha', array('showRefreshButton' => false,
                                        'clickableImage' => true, 'imageOptions' => array('alt' => '点击换图', 'title' => '点击换图',
                                            'style' => 'cursor:pointer;padding:px 0;padding:4px 0;background:#fff;display:inline-block;margin-bottom:3px')));
                                    ?>
                                </span>
                            </li>
                            <li class="agreement">
                                <input type="radio"  checked='true' />
                                <a href="javascript:" target="_blank">同意、会员注册协议</a>
                            </li>
                            <li class="button">
                                <a href="javascript:document.getElementById('reg').submit();"  class="ann">免费注册</a>
                                <span class="yes">有账号？<a href="javascript:" id="loginBtns">立即登录 <i>&nbsp;>></i></a></span>
                            </li>
                        </ul>
                    </div>
                    <?php $this->endWidget(); ?>
                    <!--右边-->
                    <div class="tuij">
                        <div class="direct clearfix">
                            <div class="tit_1">使用以下账号直接登录</div>
                            <a href="javascript:" class="weib"></a>
                            <a href="javascript:" class="qq"></a>
                        </div>
                        <!--大家都在玩-->
                        <div class="play">
                            <div class="tit_1">
                                大家都在玩
                            </div>
                            <div class="bcon">
                                <div class="list_lh">
                                    <ul>
                                        <?php
                                        $giftdata = Gamedata::model()->findAllBySql("select * from {{game_data}} order by id desc  limit 0,16 ");
                                        foreach ($giftdata as $info) {
                                            $game = Game::model()->findByPk($info['game_id']);
                                            $member = Mem::model()->findByPk($info['mem_id']);
                                            $memimg = Memimg::model()->findByPk($member['memimg_id']);
                                            ?>
                                            <?php if ($info["id"] % 2 != 0) { ?>
                                                <li class="clearfix">
                                                <?php } ?>
                                                <?php if ($info["id"] % 2 == 0) { ?>
                                                    <div class="di_1">
                                                        <span class="tou"><img src="<?php echo IMG_URL; ?>touxiang/<?php echo $memimg['img'] ?>" /></span>
                                                        <p class="name"><?php echo $member['mem_name']; ?></p>
                                                        <p class="wan">玩：
                                                            <a href="<?php echo SITE_URL ?>game/detail/id/<?php echo $game["id"]; ?>" target="_blank"><?php echo $game['name']; ?></a>
                                                        </p>
                                                        <p class="lin clearfix"><span>领取了：</span><em><?php echo number_format($info['level_jlhlb']); ?></em></p>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="di_1">
                                                        <span class="tou"><img src="<?php echo IMG_URL; ?>touxiang/<?php echo $memimg['img'] ?>" /></span>
                                                        <p class="name"><?php echo $member['mem_name']; ?></p>
                                                        <p class="wan">玩：
                                                            <a href="<?php echo SITE_URL ?>game/detail/id/<?php echo $game["id"]; ?>" target="_blank"> <?php echo $game['name']; ?> </a>
                                                        </p>
                                                        <p class="lin clearfix"><span>领取了：</span><em><?php echo number_format($info['level_jlhlb']); ?></em></p>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($info["id"] % 2 == 0) { ?>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
