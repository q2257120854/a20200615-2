<!DOCTYPE html>
<html>
    <head>
        <title><?php echo TITLE; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <script type="text/javascript" src="/scripts/jquery/jquery-1.7.1.js"></script>
        <link href="/style/authority/basic_layout.css" rel="stylesheet" type="text/css">
        <link href="/style/authority/common_style.css" rel="stylesheet" type="text/css">
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
        </script>
        <style type="text/css">
            div .errorMessage{color:red;}
            label .required{color:red;}
        </style>
    </head>
    <body>
         <?php
        $form = $this->beginWidget('CActiveForm', array(
            'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
        ?>
        <div id="container">
            <div id="nav_links">
                当前位置：广告管理&nbsp;>&nbsp;<span style="color: #1A5CC6;">编辑</span>
                <div id="page_close">
                    <a href="javascript:parent.$.fancybox.close();">
                        <img src="<?php echo IMG_URL ?>common/page_close.png" width="20" height="20" style="vertical-align: text-top;"/>
                    </a>
                </div>
            </div>
            <div class="ui_content">
                <table  cellspacing="0" cellpadding="0" width="100%"  align="left" border="0" class="tab_1">
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($ad_model, 'open'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($ad_model, 'open', array('0' => '开启', '1' => '关闭'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($ad_model, 'open'); ?>
                        </td>
                    </tr> 
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($ad_model, 'img'); ?></td>
                        <td class="ui_text_lt">
                            <input type="hidden"  name="hideimg" value="<?php echo $ad_model->img; ?>"/>
                            <?php if (!empty($ad_model->img)) { ?>
                                <?php echo "<img src=/uploads/img/ad/" . $ad_model->img . " style='width: 80px;height: 50px;'/>"; ?>
                            <?php } ?>
                            <?php echo CHtml::activeFileField($ad_model, 'img'); ?>
                            <?php echo $form->error($ad_model, 'img'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($ad_model, 'name'); ?></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->textField($ad_model, 'name'); ?>
                            <?php echo $form->error($ad_model, 'name'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($ad_model, 'url'); ?></td>
                        <td class="ui_text_lt ipn_2">
                            <?php echo $form->textField($ad_model, 'url'); ?>
                            <?php echo $form->error($ad_model, 'url'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($ad_model, 'ad_type_id'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->dropDownList($ad_model, 'ad_type_id', $adarray, array('empty' => '请选择')); ?>
                            <?php echo $form->error($ad_model, 'ad_type_id'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($ad_model, 'hlb_num'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($ad_model, 'hlb_num'); ?>
                            <?php echo $form->error($ad_model, 'hlb_num'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($ad_model, 'orderby'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($ad_model, 'orderby'); ?>
                            <?php echo $form->error($ad_model, 'orderby'); ?>
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
       </body>
</html>