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
            editor.render("Gift_introduce");
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
                当前位置：奖品管理&nbsp;>&nbsp;<span style="color: #1A5CC6;">新增</span>
                <div id="page_close">
                    <a href="javascript:parent.$.fancybox.close();">
                        <img src="<?php echo IMG_URL ?>common/page_close.png" width="20" height="20" style="vertical-align: text-top;"/>
                    </a>
                </div>
            </div>
            <div class="ui_content">
                <table class="tab_1" cellspacing="0" cellpadding="0" width="100%"  align="left" border="0" >
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($gift_model, 'name'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($gift_model, 'name'); ?>
                            <?php echo $form->error($gift_model, 'name'); ?>
                        </td>
                    </tr>
                    <td class="ui_text_rt"><?php echo $form->labelEx($gift_model, 'hld_num'); ?></td>
                    <td class="ui_text_lt">
                        <?php echo $form->textField($gift_model, 'hld_num'); ?>
                        <?php echo $form->error($gift_model, 'hld_num'); ?>
                    </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($gift_model, 'gift_type_id'); ?></td>
                        <td class="ui_text_lt">
                            <?php
                            $this->widget('application.extensions.TreeWidget', array(
                                'dataProvider' => $data, // 传递数据
                                'pid' => 'pid', // 设置父ID
                                'formatParam' => 'name', // 设置格式化字段
                                'treeType' => false, // 输出树格式
                                'defaultSelectValue' => array(// 设置下拉框的默认值和选项
                                ),
                            ));
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($gift_model, 'is_hpage'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($gift_model, 'is_hpage', array('1' => '是', '0' => '否'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($gift_model, 'is_hpage'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($gift_model, 'is_recommend'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($gift_model, 'is_recommend', array('1' => '是', '0' => '否'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($gift_model, 'is_recommend'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($gift_model, 'img'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo CHtml::activeFileField($gift_model, 'img'); ?>
                            <?php echo $form->error($gift_model, 'img'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($gift_model, 'introduce'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textArea($gift_model, 'introduce', array('cols' => 10, 'rows' => 2,'style'=>'width: 557px; z-index: 999;')); ?>
                            <?php echo $form->error($gift_model, 'introduce'); ?>
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








