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
            editor.render("Captcha_introduce");
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
                当前位置：打码管理&nbsp;>&nbsp;<span style="color: #1A5CC6;">编辑</span>
                <div id="page_close">
                    <a href="javascript:parent.$.fancybox.close();">
                        <img src="<?php echo IMG_URL ?>common/page_close.png" width="20" height="20" style="vertical-align: text-top;"/>
                    </a>
                </div>
            </div>
            <div class="ui_content">
                <table  cellspacing="0" cellpadding="0" width="100%"  align="left" border="0" class="tab_1">
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($captcha_model, 'name'); ?><span style="color:red;">(必须与第三方平台保持一致)</span></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->textField($captcha_model, 'name'); ?>
                            <?php echo $form->error($captcha_model, 'name'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($captcha_model, 'title2'); ?></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->textField($captcha_model, 'title2'); ?>
                            <?php echo $form->error($captcha_model, 'title2'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($captcha_model, 'qz'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($captcha_model, 'qz'); ?>
                            <?php echo $form->error($captcha_model, 'qz'); ?>
                        </td>
                    </tr
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($captcha_model, 'code_val'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($captcha_model, 'code_val'); ?>
                            <?php echo $form->error($captcha_model, 'code_val'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($captcha_model, 'ad_id'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($captcha_model, 'ad_id'); ?>
                            <?php echo $form->error($captcha_model, 'ad_id'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($captcha_model, 'jiesuan'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($captcha_model, 'jiesuan'); ?>
                            <?php echo $form->error($captcha_model, 'jiesuan'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($captcha_model, 'is_display'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($captcha_model, 'is_display', array('0' => '否', '1' => '是'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($captcha_model, 'is_display'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($captcha_model, 'open'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($captcha_model, 'open', array('0' => '开启', '1' => '关闭'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($captcha_model, 'open'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($captcha_model, 'ip'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($captcha_model, 'ip', array('0' => '不换ip', '1' => '换ip', '2' => '长期打码'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($captcha_model, 'ip'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($captcha_model, 'resource'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($captcha_model, 'resource', array('0' => '充足', '1' => '不充足'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($captcha_model, 'resource'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($captcha_model, 'type'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($captcha_model, 'type', array('0' => '自动', '1' => '手动'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($captcha_model, 'type'); ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($captcha_model, 'down_url'); ?></td>
                        <td class="ui_text_lt ipn_2">
                            <?php echo $form->textField($captcha_model, 'down_url'); ?>
                            <?php echo $form->error($captcha_model, 'down_url'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($captcha_model, 'return_url'); ?></td>
                        <td class="ui_text_lt ipn_2">
                            <?php echo $form->textField($captcha_model, 'return_url'); ?>
                            <?php echo $form->error($captcha_model, 'return_url'); ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($captcha_model, 'orderby'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($captcha_model, 'orderby'); ?>
                            <?php echo $form->error($captcha_model, 'orderby'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($captcha_model, 'introduce'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textArea($captcha_model, 'introduce', array('cols' => 10, 'rows' => 2, 'style' => 'width: 557px; z-index: 999;')); ?>
                            <?php echo $form->error($captcha_model, 'introduce'); ?>
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








