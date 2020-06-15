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
        <?php $form = $this->beginWidget('CActiveForm'); ?>
        <div id="container">
            <div id="nav_links">
                当前位置：会员管理&nbsp;>&nbsp;<span style="color: #1A5CC6;">操作元宝</span>
                <div id="page_close">
                    <a href="javascript:parent.$.fancybox.close();">
                        <img src="<?php echo IMG_URL ?>common/page_close.png" width="20" height="20" style="vertical-align: text-top;"/>
                    </a>
                </div>
            </div>
            <div class="ui_content">
                <table  cellspacing="0" cellpadding="0" width="100%"  align="left" border="0" class="tab_1">
                    <tr>
                        <td class="ui_text_rt">当前元宝</td>
                        <td class="ui_text_lt">
                            <input type="text" value="<?php echo intval($hlbnum); ?>" disabled="disabled"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($hlb_model, 'type'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($hlb_model, 'type', array('1' => '增加', '2' => '扣除'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($hlb_model, 'type'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($hlb_model, 'hlb'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($hlb_model, 'hlb', array('autocomplete' => 'off')); ?>
                            <?php echo $form->error($hlb_model, 'hlb'); ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="ui_text_rt">备注</td>
                        <td class="ui_text_lt">
                            <input type="text"   id="remark" name="remark" size="80"/>
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