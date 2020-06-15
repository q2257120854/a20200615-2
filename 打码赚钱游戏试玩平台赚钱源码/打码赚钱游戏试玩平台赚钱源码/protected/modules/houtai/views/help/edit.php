<!DOCTYPE html>
<html>
    <head>
        <title><?php echo TITLE; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <script type="text/javascript" src="/scripts/jquery/jquery-1.7.1.js"></script>
        <link href="/style/authority/basic_layout.css" rel="stylesheet" type="text/css">
        <link href="/style/authority/common_style.css" rel="stylesheet" type="text/css">
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
            editor.render("Help_answer");
          
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
                当前位置：帮助管理&nbsp;>&nbsp;<span style="color: #1A5CC6;">编辑</span>
                <div id="page_close">
                    <a href="javascript:parent.$.fancybox.close();">
                        <img src="<?php echo IMG_URL ?>common/page_close.png" width="20" height="20" style="vertical-align: text-top;"/>
                    </a>
                </div>
            </div>
            <div class="ui_content">
                <table  cellspacing="0" cellpadding="0" width="100%"  align="left" border="0" class="tab_1">
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($help_model, 'help_type_id'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->dropDownList($help_model, 'help_type_id', $helparray, array('empty' => '请选择')); ?>
                            <?php echo $form->error($help_model, 'help_type_id'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($help_model, 'quiz'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textArea($help_model, 'quiz', array('cols' => 10, 'rows' => 2,'style'=>'width: 557px; z-index: 999;')); ?>
                            <?php echo $form->error($help_model, 'quiz'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($help_model, 'answer'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textArea($help_model, 'answer', array('cols' => 10, 'rows' => 2, 'style' => 'width: 557px; z-index: 999;')); ?>
                            <?php echo $form->error($help_model, 'answer'); ?>
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