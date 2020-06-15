<!DOCTYPE html>
<html>
    <head>
        <title><?php echo TITLE; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <script type="text/javascript" src="/scripts/jquery/jquery-1.7.1.js"></script>
        <link href="/style/authority/basic_layout.css" rel="stylesheet" type="text/css">
        <link href="/style/authority/common_style.css" rel="stylesheet" type="text/css">
        <script>
            window.onload = function() {
                var msg = $('#msg').val();
                if (msg != "") {
                    $("#modal-add-event2").show();
                    $("#msgres").html(msg);
                    setTimeout(function() {
                        $("#modal-add-event2").hide();
                    }, 2000);
                }
            }
        </script>
        <style type="text/css">
            div .errorMessage{color:red;}
            label .required{color:red;}

            .alt td{ background:black !important;}
            .modal2{
                width:150px;
                left:45%;
                margin-left:0;
                background: #F74D4D;
                color:#fff;
                text-align: center;
                top:35%;
            }
            #modal-add-event2 .modal-header{
                background: #F74D4D;
                border: none;
            }
            #modal-add-event2 .close{
                color:#fff;
                opacity:0.8;
            }
            #modal-add-event2 .close:hover,#modal-add-event2 .close:focus{
                opacity:1;
            }
        </style>
    </head>
    <?php $this->layout = false; ?>
    <body>
        <?php
        if (Yii::app()->user->hasFlash('msg')) {
            ?>
            <input type="hidden" value="<?php echo Yii::app()->user->getFlash('msg') ?>" id="msg" />
        <?php } ?>
        <?php $form = $this->beginWidget('CActiveForm'); ?>
        <div id="container">
            <div id="nav_links">
                当前位置：系统设置&nbsp;>&nbsp;<span style="color: #1A5CC6;">设置</span>

            </div>
            <div class="modal hide modal2" id="modal-add-event2">
                <div class="modal-body">
                    <p id="msgres"></p>
                </div>
            </div>
            <div class="ui_content clearfix">
                <ul class="ul_1 clearfix">
                    <li class="red">
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'money'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'money'); ?>&nbsp;元人民币</span>
                        <span class="tis_1"> <?php echo $form->error($system_model, 'money'); ?></span>
                    </li>
                    <li class="red">
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'fee'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'fee'); ?>&nbsp;元人民币</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'fee'); ?></span>
                    </li>
                    <li class="red">
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'hlb_exchange_money'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'hlb_exchange_money'); ?>&nbsp;换1元人民币</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'hlb_exchange_money'); ?></span>
                    </li>
                    <li class="red">
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'cash_rewards1'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'cash_rewards1'); ?>&nbsp;元人民币</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'cash_rewards1'); ?></span>
                    </li>
                    <li class="red">
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'cash_rewards2'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'cash_rewards2'); ?>&nbsp;元人民币</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'cash_rewards2'); ?></span>
                    </li>
                    <li class="red">
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'cash_rewards3'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'cash_rewards3'); ?>&nbsp;元人民币</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'cash_rewards3'); ?></span>
                    </li>
                    <li class="red">
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'cash_rewards4'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'cash_rewards4'); ?>&nbsp;元人民币</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'cash_rewards4'); ?></span>
                    </li>
                    <li class="red">
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'cash_rewards5'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'cash_rewards5'); ?>&nbsp;元人民币</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'cash_rewards5'); ?></span>
                    </li>

                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'game1'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'game1'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'game1'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'game2'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'game2'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'game2'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'game3'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'game3'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'game3'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'game4'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'game4'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'game4'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'captcha1'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'captcha1'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'captcha1'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'captcha2'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'captcha2'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'captcha2'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'captcha3'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'captcha3'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'captcha3'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'captcha4'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'captcha4'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'captcha4'); ?></span>
                    </li>

                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'tx1'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'tx1'); ?>&nbsp;元宝</span> 
                        <span class="tis_1"><?php echo $form->error($system_model, 'tx1'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'tx2'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'tx2'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'tx2'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'tx3'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'tx3'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'tx3'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'tx4'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'tx4'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'tx4'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, '10tx1'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, '10tx1'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, '10tx1'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, '10tx2'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, '10tx2'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, '10tx2'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, '10tx3'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, '10tx3'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, '10tx3'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, '10tx4'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, '10tx4'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, '10tx4'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, '30tx1'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, '30tx1'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, '30tx1'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, '30tx2'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, '30tx2'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, '30tx2'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, '30tx3'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, '30tx3'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, '30tx3'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, '30tx4'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, '30tx4'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, '30tx4'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, '50tx1'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, '50tx1'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, '50tx1'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, '50tx2'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, '50tx2'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, '50tx2'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, '50tx3'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, '50tx3'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, '50tx3'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, '50tx4'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, '50tx4'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, '50tx4'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, '100tx1'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, '100tx1'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, '100tx1'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, '100tx2'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, '100tx2'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, '100tx2'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, '100tx3'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, '100tx3'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, '100tx3'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, '100tx4'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, '100tx4'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, '100tx4'); ?></span>
                    </li>

                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'friend1'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'friend1'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'friend1'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'friend2'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'friend2'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'friend2'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'friend3'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'friend3'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'friend3'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'friend4'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'friend4'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'friend4'); ?></span>
                    </li>
                    <li class="yellow">
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'first'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'first'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'first'); ?></span>
                    </li>
                    <li class="yellow">
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'second'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'second'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'second'); ?></span>
                    </li>
                    <li class="yellow">
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'thirdly'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'thirdly'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'thirdly'); ?></span>
                    </li>
                    <li class="yellow">
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'fourthly'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'fourthly'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'fourthly'); ?></span>
                    </li>
                    <li class="yellow">
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'fifty'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'fifty'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'fifty'); ?></span>
                    </li>
                    <li class="yellow">
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zc_rewards'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zc_rewards'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zc_rewards'); ?></span>
                    </li>
                    <li class="yellow">
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'sign_rand_hlb'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'sign_rand_hlb'); ?>&nbsp;签到随机发奖</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'sign_rand_hlb'); ?></span>
                    </li>

                    <li class="yellow">
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'sign_rand_hld'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'sign_rand_hld'); ?>&nbsp;签到随机发奖</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'sign_rand_hld'); ?></span>
                    </li>












                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zzfriend1'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zzfriend1'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zzfriend1'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zzfriend2'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zzfriend2'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zzfriend2'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zzfriend3'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zzfriend3'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zzfriend3'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zzfriend4'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zzfriend4'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zzfriend4'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zzgame1'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zzgame1'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zzgame1'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zzgame2'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zzgame2'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zzgame2'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zzgame3'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zzgame3'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zzgame3'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zzgame4'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zzgame4'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zzgame4'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zzcaptcha1'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zzcaptcha1'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zzcaptcha1'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zzcaptcha2'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zzcaptcha2'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zzcaptcha2'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zzcaptcha3'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zzcaptcha3'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zzcaptcha3'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zzcaptcha4'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zzcaptcha4'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zzcaptcha4'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zztx1'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zztx1'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zztx1'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zztx2'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zztx2'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zztx2'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zztx3'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zztx3'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zztx3'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zztx4'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zztx4'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zztx4'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zz10tx1'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zz10tx1'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zz10tx1'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zz10tx2'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zz10tx2'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zz10tx2'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zz10tx3'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zz10tx3'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zz10tx3'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zz10tx4'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zz10tx4'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zz10tx4'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zz30tx1'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zz30tx1'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zz30tx1'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zz30tx2'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zz30tx2'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zz30tx2'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zz30tx3'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zz30tx3'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zz30tx3'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zz30tx4'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zz30tx4'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zz30tx4'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zz50tx1'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zz50tx1'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zz50tx1'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zz50tx2'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zz50tx2'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zz50tx2'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zz50tx3'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zz50tx3'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zz50tx3'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zz50tx4'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zz50tx4'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zz50tx4'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zz100tx1'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zz100tx1'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zz100tx1'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zz100tx2'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zz100tx2'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zz100tx2'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zz100tx3'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zz100tx3'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zz100tx3'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'zz100tx4'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'zz100tx4'); ?>&nbsp;元宝</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'zz100tx4'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'wage1'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'wage1'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'wage1'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'wage2'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'wage2'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'wage2'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'wage3'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'wage3'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'wage3'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'wage4'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'wage4'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'wage4'); ?></span>
                    </li>
                    <li>
                        <span class="name_1"><?php echo $form->labelEx($system_model, 'wage5'); ?></span>
                        <span class="frame_1"><?php echo $form->textField($system_model, 'wage5'); ?>&nbsp;%</span>
                        <span class="tis_1"><?php echo $form->error($system_model, 'wage5'); ?></span>
                    </li>
                </ul>
                <div class="ann"><button type="submit" class="ui_input_btn01">提交</button></div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
        
    </body>
</html>