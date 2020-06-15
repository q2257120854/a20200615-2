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
                当前位置：账号管理&nbsp;>&nbsp;<span style="color: #1A5CC6;">编辑</span>
                <div id="page_close">
                    <a href="javascript:parent.$.fancybox.close();">
                        <img src="<?php echo IMG_URL?>common/page_close.png" width="20" height="20" style="vertical-align: text-top;"/>
                    </a>
                </div>
            </div>
            <div class="ui_content">
                <table  cellspacing="0" cellpadding="0" width="100%"  align="left" border="0" class="tab_1">
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($account_model, 'username'); ?></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->textField($account_model, 'username', array('autocomplete' => 'off')); ?>
                            <?php echo $form->error($account_model, 'username'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($account_model, 'password'); ?></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->passwordField($account_model, 'password', array('autocomplete' => 'off',"value"=>"")); ?>
                            <?php echo $form->error($account_model, 'password'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($account_model, 'password2'); ?></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->passwordField($account_model, 'password2', array('autocomplete' => 'off','value'=>'')); ?>
                            <?php echo $form->error($account_model, 'password2'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($account_model, 'role'); ?></td>
                        <td class="ui_text_lt">
                            <?php
                            $role=array();
                            $role_model = Role::model();
                            $role_infos = $role_model->findAll();
                            $role[0] = "管理员";
                            foreach ($role_infos as $value) {
                                $role[$value->id] = $value->name;
                            }
                            echo $form->dropDownList($account_model, 'role', $role);
                            ?>
                            <?php echo $form->error($account_model, 'role'); ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($account_model, 'name'); ?></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->textField($account_model, 'name', array('autocomplete' => 'off')); ?>
                            <?php echo $form->error($account_model, 'name'); ?>
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