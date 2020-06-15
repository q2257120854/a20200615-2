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
        <?php $form = $this->beginWidget('CActiveForm') ?>
        <div id="container">
            <div id="nav_links">
                当前位置：奖品分类&nbsp;>&nbsp;<span style="color: #1A5CC6;">新增</span>
                <div id="page_close">
                    <a href="javascript:parent.$.fancybox.close();">
                        <img src="<?php echo IMG_URL ?>common/page_close.png" width="20" height="20" style="vertical-align: text-top;"/>
                    </a>
                </div>
            </div>
            <div class="ui_content">
                <table class="tab_1" cellspacing="0" cellpadding="0" width="100%"  align="left" border="0" >
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($gifttype_model, 'pid'); ?></td>
                        <td class="ui_text_lt">
                            <?php
                            $this->widget('application.extensions.TreeWidget', array(
                                'dataProvider' => $data, // 传递数据
                                'pid' => 'pid', // 设置父ID
                                'formatParam' => 'name', // 设置格式化字段
                                'treeType' => false, // 输出树格式
                                //'selectClass'  => 'class="span11"', // 设置下拉框样式
                                'defaultSelectValue' => array(// 设置下拉框的默认值和选项
                                    '', ''
                                ),
                            ));
                            ?><span style="color:red;">选空表示顶级分类</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($gifttype_model, 'name'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($gifttype_model, 'name'); ?>
                            <?php echo $form->error($gifttype_model, 'name'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td class="ui_text_lt">
                            &nbsp;
                            <button type="submit" class="ui_input_btn01">提交</button>
                            &nbsp;
                            <input id="cancelbutton" type="button" value="取消" class="ui_input_btn01"/>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <?php $this->endWidget(); ?>
       </body>
</html>