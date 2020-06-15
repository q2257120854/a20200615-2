<!DOCTYPE html>
<html>
    <head>
        <title><?php echo TITLE; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <script type="text/javascript" src="/scripts/jquery/jquery-1.7.1.js"></script>
        <link href="/style/authority/basic_layout.css" rel="stylesheet" type="text/css">
        <link href="/style/authority/common_style.css" rel="stylesheet" type="text/css">
        <script src="/scripts/vip/laydate.js"></script>
        <link href="/style/vip/inside.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" charset="utf-8" src="/scripts/ueditor/ueditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="/scripts/ueditor/ueditor.all.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="/scripts/ueditor/lang/zh-cn/zh-cn.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#cancelbutton").click(function() {
                    window.parent.$.fancybox.close();
                });
                var result = '<?php
if (empty($result)) {
    echo null;
} else {
    echo $result;
}
?>';
                if (result == 'success') {
                    window.parent.$.fancybox.close();
                }
            });
            var editor = new baidu.editor.ui.Editor();
            editor.render("Game_impactcont");
        </script>
        <style type="text/css">
            div .errorMessage{color:red;}
            label .required{color:red;}
        </style>
    </head>
    <?php $this->layout = false; ?>
    <body>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
        ?>
        <div id="container">
            <div id="nav_links">
                当前位置：游戏管理&nbsp;>&nbsp;<span style="color: #1A5CC6;">编辑</span>
                <div id="page_close">
                    <a href="javascript:parent.$.fancybox.close();">
                        <img src="<?php echo IMG_URL ?>common/page_close.png" width="20" height="20" style="vertical-align: text-top;"/>
                    </a>
                </div>
            </div>
            <div class="ui_content">
                <table  cellspacing="0" cellpadding="0" width="100%"  align="left" border="0" class="tab_1" >
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'bustype'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->dropDownList($game_model, 'bustype', $gamebusarray); ?>
                            <?php echo $form->error($game_model, 'bustype'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'business'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($game_model, 'business'); ?>
                            <?php echo $form->error($game_model, 'business'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'name'); ?></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->textField($game_model, 'name'); ?>
                            <?php echo $form->error($game_model, 'name'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'game_id'); ?></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->textField($game_model, 'game_id'); ?>
                            <?php echo $form->error($game_model, 'game_id'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'recruit_num'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($game_model, 'recruit_num'); ?>
                            <?php echo $form->error($game_model, 'recruit_num'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'color'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($game_model, 'color'); ?>
                            <?php echo $form->error($game_model, 'color'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'gamerange'); ?></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->textField($game_model, 'gamerange'); ?>
                            <?php echo $form->error($game_model, 'gamerange'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'gamezmbs'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($game_model, 'gamezmbs'); ?>
                            <?php echo $form->error($game_model, 'gamezmbs'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'login_url'); ?></td>
                        <td class="ui_text_lt ipn_2">
                            <?php echo $form->textField($game_model, 'login_url'); ?>
                            <?php echo $form->error($game_model, 'login_url'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'register_url'); ?></td>
                        <td class="ui_text_lt ipn_2">
                            <?php echo $form->textField($game_model, 'register_url'); ?>
                            <?php echo $form->error($game_model, 'register_url'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'return_url'); ?></td>
                        <td class="ui_text_lt ipn_2">
                            <?php echo $form->textField($game_model, 'return_url'); ?>
                            <?php echo $form->error($game_model, 'return_url'); ?>
                        </td>
                    </tr>
					 <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'networkurl'); ?></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->textField($game_model, 'networkurl'); ?>
                            <?php echo $form->error($game_model, 'networkurl'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'json_layout'); ?></td>
                        <td class="ui_text_lt ">
                            <?php echo $form->textField($game_model, 'json_layout'); ?>
                            <?php echo $form->error($game_model, 'json_layout'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'json_servername'); ?></td>
                        <td class="ui_text_lt ">
                            <?php echo $form->textField($game_model, 'json_servername'); ?>
                            <?php echo $form->error($game_model, 'json_servername'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'json_role'); ?></td>
                        <td class="ui_text_lt ">
                            <?php echo $form->textField($game_model, 'json_role'); ?>
                            <?php echo $form->error($game_model, 'json_role'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'json_level'); ?></td>
                        <td class="ui_text_lt ">
                            <?php echo $form->textField($game_model, 'json_level'); ?>
                            <?php echo $form->error($game_model, 'json_level'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'json_payment'); ?></td>
                        <td class="ui_text_lt ">
                            <?php echo $form->textField($game_model, 'json_payment'); ?>
                            <?php echo $form->error($game_model, 'json_payment'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'hlz_uid'); ?></td>
                        <td class="ui_text_lt ">
                            <?php echo $form->textField($game_model, 'hlz_uid'); ?>
                            <?php echo $form->error($game_model, 'hlz_uid'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'game_uid'); ?></td>
                        <td class="ui_text_lt ">
                            <?php echo $form->textField($game_model, 'game_uid'); ?>
                            <?php echo $form->error($game_model, 'game_uid'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'impactmax'); ?></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->textField($game_model, 'impactmax'); ?>
                            <?php echo $form->error($game_model, 'impactmax'); ?>
                        </td>
                    </tr>
                   
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'networklevel'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($game_model, 'networklevel'); ?>
                            <?php echo $form->error($game_model, 'networklevel'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'networknickname'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($game_model, 'networknickname'); ?>
                            <?php echo $form->error($game_model, 'networknickname'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'networkuptime'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($game_model, 'networkuptime'); ?>
                            <?php echo $form->error($game_model, 'networkuptime'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'game_type_id'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->dropDownList($game_model, 'game_type_id', $gamearray, array('empty' => '请选择')); ?>
                            <?php echo $form->error($game_model, 'game_type_id'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'hlz_gid_valid'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($game_model, 'hlz_gid_valid', array('0' => '是', '1' => '否'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($game_model, 'hlz_gid_valid'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'is_prefecture'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($game_model, 'is_prefecture', array('0' => '专区', '1' => '多服', '2' => '单服'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($game_model, 'is_prefecture'); ?>
                        </td>
                    </tr>  
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'is_timely'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($game_model, 'is_timely', array('0' => '即', '1' => '续'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($game_model, 'is_timely'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'is_hpage'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($game_model, 'is_hpage', array('0' => '否', '1' => '是'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($game_model, 'is_hpage'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'is_new'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($game_model, 'is_new', array('0' => '否', '1' => '是'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($game_model, 'is_new'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'is_sign'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($game_model, 'is_sign', array('0' => '否', '1' => '是'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($game_model, 'is_sign'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'is_display'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($game_model, 'is_display', array('0' => '否', '1' => '是'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($game_model, 'is_display'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'cz_rewards_num'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($game_model, 'cz_rewards_num'); ?>
                            <?php echo $form->error($game_model, 'cz_rewards_num'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'rewardsend_time'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($game_model, 'rewardsend_time'); ?>天后
                            <?php echo $form->error($game_model, 'rewardsend_time'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'cz_hint'); ?></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->textField($game_model, 'cz_hint'); ?>
                            <?php echo $form->error($game_model, 'cz_hint'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'czhref'); ?></td>
                        <td class="ui_text_lt ipn_2">
                            <?php echo $form->textField($game_model, 'czhref'); ?>
                            <?php echo $form->error($game_model, 'czhref'); ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'begin_time'); ?></td>
                        <td class="ui_text_lt">
                            <input type="text"  id="Game_begin_time" name="Game[begin_time]" class="ui_input_txt02" value="<?php echo $game_model["begin_time"]; ?>"/>
                            <?php echo $form->error($game_model, 'begin_time'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'end_time'); ?></td>
                        <td class="ui_text_lt">
                            <input type="text"  id="Game_end_time" name="Game[end_time]"  class="ui_input_txt02" value="<?php echo $game_model["end_time"]; ?>" />
                            <?php echo $form->error($game_model, 'end_time'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'zc_end_time'); ?></td>
                        <td class="ui_text_lt">
                            <input type="text"  id="Game_zc_end_time" name="Game[zc_end_time]"  class="ui_input_txt02" value="<?php echo $game_model["zc_end_time"]; ?>" />
                            <?php echo $form->error($game_model, 'zc_end_time'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'articleid'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($game_model, 'articleid'); ?>
                            <?php echo $form->error($game_model, 'articleid'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'img'); ?></td>
                        <td class="ui_text_lt">
                            <input type="hidden"  name="hideimg" value="<?php echo $game_model->img; ?>"/>
                            <?php if (!empty($game_model->img)) { ?>
                                <?php echo "<img src=/uploads/img/game/" . $game_model->img . " style='width: 80px;height: 50px;'/>"; ?>
                            <?php } ?>
                            <?php echo CHtml::activeFileField($game_model, 'img'); ?>
                            <?php echo $form->error($game_model, 'img'); ?>
                            <input type="text"  name="textimg" />
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'logoimg'); ?></td>
                        <td class="ui_text_lt">
                            <input type="hidden"  name="hidelogoimg" value="<?php echo $game_model->logoimg; ?>"/>
                            <?php if (!empty($game_model->logoimg)) { ?>
                                <?php echo "<img src=/uploads/img/game/" . $game_model->logoimg . " style='width: 80px;height: 50px;'/>"; ?>
                            <?php } ?>
                            <?php echo CHtml::activeFileField($game_model, 'logoimg'); ?>
                            <?php echo $form->error($game_model, 'logoimg'); ?>
                            <input type="text"  name="textlogoimg" />
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'bg_img'); ?></td>
                        <td class="ui_text_lt">
                            <input type="hidden"  name="hidebgimg" value="<?php echo $game_model->bg_img; ?>"/>
                            <?php if (!empty($game_model->bg_img)) { ?>
                                <?php echo "<img src=/uploads/img/game/" . $game_model->bg_img . " style='width: 80px;height: 50px;'/>"; ?>
                            <?php } ?>
                            <?php echo CHtml::activeFileField($game_model, 'bg_img'); ?>
                            <?php echo $form->error($game_model, 'bg_img'); ?>
                            <input type="text"  name="textbg_img" />
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'photos1'); ?></td>
                        <td class="ui_text_lt">
                            <input type="hidden"  name="hidephotos1" value="<?php echo $game_model->photos1; ?>"/>
                            <?php if (!empty($game_model->photos1)) { ?>
                                <?php echo "<img src=/uploads/img/game/" . $game_model->photos1 . " style='width: 80px;height: 50px;'/>"; ?>
                            <?php } ?>
                            <?php echo CHtml::activeFileField($game_model, 'photos1'); ?>
                            <?php echo $form->error($game_model, 'photos1'); ?>
                            <input type="text"  name="textphotos1" />
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'photos2'); ?></td>
                        <td class="ui_text_lt">
                            <input type="hidden"  name="hidephotos2" value="<?php echo $game_model->photos2; ?>"/>
                            <?php if (!empty($game_model->photos2)) { ?>
                                <?php echo "<img src=/uploads/img/game/" . $game_model->photos2 . " style='width: 80px;height: 50px;'/>"; ?>
                            <?php } ?>
                            <?php echo CHtml::activeFileField($game_model, 'photos2'); ?>
                            <?php echo $form->error($game_model, 'photos2'); ?>
                            <input type="text"  name="textphotos2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'photos3'); ?></td>
                        <td class="ui_text_lt">
                            <input type="hidden"  name="hidephotos3" value="<?php echo $game_model->photos3; ?>"/>
                            <?php if (!empty($game_model->photos3)) { ?>
                                <?php echo "<img src=/uploads/img/game/" . $game_model->photos3 . " style='width: 80px;height: 50px;'/>"; ?>
                            <?php } ?>
                            <?php echo CHtml::activeFileField($game_model, 'photos3'); ?>
                            <?php echo $form->error($game_model, 'photos3'); ?>
                            <input type="text"  name="textphotos3" />
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'photos4'); ?></td>
                        <td class="ui_text_lt">
                            <input type="hidden"  name="hidephotos4" value="<?php echo $game_model->photos4; ?>"/>
                            <?php if (!empty($game_model->photos4)) { ?>
                                <?php echo "<img src=/uploads/img/game/" . $game_model->photos4 . " style='width: 80px;height: 50px;'/>"; ?>
                            <?php } ?>
                            <?php echo CHtml::activeFileField($game_model, 'photos4'); ?>
                            <?php echo $form->error($game_model, 'photos4'); ?>
                            <input type="text"  name="textphotos4" />
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'photos5'); ?></td>
                        <td class="ui_text_lt">
                            <input type="hidden"  name="hidephotos5" value="<?php echo $game_model->photos5; ?>"/>
                            <?php if (!empty($game_model->photos5)) { ?>
                                <?php echo "<img src=/uploads/img/game/" . $game_model->photos5 . " style='width: 80px;height: 50px;'/>"; ?>
                            <?php } ?>
                            <?php echo CHtml::activeFileField($game_model, 'photos5'); ?>
                            <?php echo $form->error($game_model, 'photos5'); ?>
                            <input type="text"  name="textphotos5" />
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'photos6'); ?></td>
                        <td class="ui_text_lt">
                            <input type="hidden"  name="hidephotos6" value="<?php echo $game_model->photos6; ?>"/>
                            <?php if (!empty($game_model->photos6)) { ?>
                                <?php echo "<img src=/uploads/img/game/" . $game_model->photos6 . " style='width: 80px;height: 50px;'/>"; ?>
                            <?php } ?>
                            <?php echo CHtml::activeFileField($game_model, 'photos6'); ?>
                            <?php echo $form->error($game_model, 'photos6'); ?>
                            <input type="text"  name="textphotos6" />
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'photos7'); ?></td>
                        <td class="ui_text_lt">
                            <input type="hidden"  name="hidephotos7" value="<?php echo $game_model->photos7; ?>"/>
                            <?php if (!empty($game_model->photos7)) { ?>
                                <?php echo "<img src=/uploads/img/game/" . $game_model->photos7 . " style='width: 80px;height: 50px;'/>"; ?>
                            <?php } ?>
                            <?php echo CHtml::activeFileField($game_model, 'photos7'); ?>
                            <?php echo $form->error($game_model, 'photos7'); ?>
                            <input type="text"  name="textphotos7" />
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'photos8'); ?></td>
                        <td class="ui_text_lt">
                            <input type="hidden"  name="hidephotos8" value="<?php echo $game_model->photos8; ?>"/>
                            <?php if (!empty($game_model->photos8)) { ?>
                                <?php echo "<img src=/uploads/img/game/" . $game_model->photos8 . " style='width: 80px;height: 50px;'/>"; ?>
                            <?php } ?>
                            <?php echo CHtml::activeFileField($game_model, 'photos8'); ?>
                            <?php echo $form->error($game_model, 'photos8'); ?>
                            <input type="text"  name="textphotos8" />
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'businessimg'); ?></td>
                        <td class="ui_text_lt">
                            <input type="hidden"  name="hidebusinessimg" value="<?php echo $game_model->businessimg; ?>"/>
                            <?php if (!empty($game_model->businessimg)) { ?>
                                <?php echo "<img src=/uploads/img/game/" . $game_model->businessimg . " style='width: 80px;height: 50px;'/>"; ?>
                            <?php } ?>
                            <?php echo CHtml::activeFileField($game_model, 'businessimg'); ?>
                            <?php echo $form->error($game_model, 'businessimg'); ?>
                            <input type="text"  name="textbusinessimg" />
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'introduce'); ?></td>
                        <td class="ui_text_lt ipn_3">
                            <?php echo $form->textArea($game_model, 'introduce', array('cols' => 10, 'rows' => 2, 'style' => 'width: 557px; z-index: 999;')); ?>
                            <?php echo $form->error($game_model, 'introduce'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($game_model, 'impactcont'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textArea($game_model, 'impactcont', array('cols' => 60, 'rows' => 2, 'style' => 'width: 557px; z-index: 999;')); ?>
                            <?php echo $form->error($game_model, 'impactcont'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td class="ui_text_lt">
                            &nbsp;
                            <button type="submit" class="ui_input_btn01">提交</button>
                            &nbsp;<input id="cancelbutton" type="button" value="取消" class="ui_input_btn01"/>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <?php $this->endWidget(); ?>

        <!--加载时间日期选择-->
        <script type="text/javascript">
            !function() {
                laydate({elem: '#demo3'});//绑定元素
            }();
            //日期范围限制
            var start = {
                elem: '#Game_begin_time',
                format: 'YYYY-MM-DD hh:mm', max: '2099-06-16', //最大日期
                istime: true,
                istoday: false,
                choose: function(datas) {
                    end.min = datas; //开始日选好后，重置结束日的最小日期
                    end.start = datas //将结束日的初始值设定为开始日
                }
            };
            var end = {
                elem: '#Game_end_time',
                format: 'YYYY-MM-DD hh:mm', min: laydate.now(), max: '2099-06-16',
                istime: true,
                istoday: false,
                choose: function(datas) {
                    start.max = datas; //结束日选好后，充值开始日的最大日期
                }
            };

            //日期范围限制
            var zctime = {
                elem: '#Game_zc_end_time',
                format: 'YYYY-MM-DD hh:mm', max: '2099-06-16', //最大日期
                istime: true,
                istoday: false,
                choose: function(datas) {
                    end.min = datas; //开始日选好后，重置结束日的最小日期
                    end.start = datas //将结束日的初始值设定为开始日
                }
            };

            laydate(start);
            laydate(end);
            laydate(zctime);
        </script>
       </body>
</html>








