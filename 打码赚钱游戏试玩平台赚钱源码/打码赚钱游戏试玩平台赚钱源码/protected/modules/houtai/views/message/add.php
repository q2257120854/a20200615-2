
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
            editor.render("Message_content");
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
                当前位置：资讯分类&nbsp;>&nbsp;<span style="color: #1A5CC6;">新增</span>
                <div id="page_close">
                    <a href="javascript:parent.$.fancybox.close();">
                        <img src="<?php echo IMG_URL ?>common/page_close.png" width="20" height="20" style="vertical-align: text-top;"/>
                    </a>
                </div>
            </div>
            <div class="ui_content">
                <table class="tab_1" cellspacing="0" cellpadding="0" width="100%"  align="left" border="0" >
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($message_model, 'is_hpage'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($message_model, 'is_hpage', array('1' => '是', '0' => '否'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($message_model, 'is_hpage'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($message_model, 'is_official'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($message_model, 'is_official', array('1' => '是', '0' => '否'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($message_model, 'is_official'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($message_model, 'color'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($message_model, 'color', array('1' => '默认色', '2' => '红色', '3' => '蓝色'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($message_model, 'color'); ?>
                        </td>
                    </tr>
                     <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($message_model, 'is_recommend'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($message_model, 'is_recommend', array('1' => '是', '0' => '否'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($message_model, 'is_recommend'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($message_model, 'message_type_id'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->dropDownList($message_model, 'message_type_id', $megarray, array('empty' => '请选择')); ?>
                            <?php echo $form->error($message_model, 'message_type_id'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($message_model, 'title'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textArea($message_model, 'title', array('cols' => 60, 'rows' => 2)); ?>
                            <?php echo $form->error($message_model, 'title'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($message_model, 'author'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($message_model, 'author', array('value' => '、网络官方')); ?>
                            <?php echo $form->error($message_model, 'author'); ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($message_model, 'content'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textArea($message_model, 'content', array('cols' => 60, 'rows' => 2, 'style' => 'width: 557px; z-index: 999;')); ?>
                            <?php echo $form->error($message_model, 'content'); ?>
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








