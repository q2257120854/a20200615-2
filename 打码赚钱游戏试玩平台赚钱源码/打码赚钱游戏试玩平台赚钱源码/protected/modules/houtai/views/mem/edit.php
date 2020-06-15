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
                当前位置：会员管理&nbsp;>&nbsp;<span style="color: #1A5CC6;">编辑</span>
                <div id="page_close">
                    <a href="javascript:parent.$.fancybox.close();">
                        <img src="<?php echo IMG_URL ?>common/page_close.png" width="20" height="20" style="vertical-align: text-top;"/>
                    </a>
                </div>
            </div>
            <div class="ui_content">
                <table  cellspacing="0" cellpadding="0" width="100%"  align="left" border="0" class="tab_1" >
                    <tr>
                        <td class="ui_text_rt">累计金额:</td>
                        <td class="ui_text_lt">
                            <?php
                            $txapply_sum = Tx::model()->countBySql("select sum(applymoney) from {{tx}} where starts='已支付' and mem_id=" . $mem_model["id"]);
                            echo intval($txapply_sum);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt">支付中金额: </td>
                        <td class="ui_text_lt">
                            <?php
                            $txmoney_sum = Tx::model()->countBySql("select sum(applymoney) from {{tx}} where starts='未支付' and mem_id=" . $mem_model["id"]);
                            echo intval($txmoney_sum);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt">  当前元宝: </td>
                        <td class="ui_text_lt">
                            <?php
                            $hlb_sum = Hlb::model()->countBySql("select sum(hlb) from {{hlb}} where mem_id=" . $mem_model["id"]);
                            echo intval($hlb_sum);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"> 当前金豆 :</td>
                        <td class="ui_text_lt">
                            <?php
                            $hld_sum = Hld::model()->countBySql("select sum(hld) from {{hld}} where  mem_id=" . $mem_model["id"]);
                            echo intval($hld_sum);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($mem_model, 'email'); ?></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->textField($mem_model, 'email', array('autocomplete' => 'off')); ?>
                            <?php echo $form->error($mem_model, 'email'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($mem_model, 'pwd'); ?></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->textField($mem_model, 'pwd', array('autocomplete' => 'off')); ?>
                            <?php echo $form->error($mem_model, 'pwd'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($mem_model, 'pid'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($mem_model, 'pid', array('autocomplete' => 'off')); ?>
                            <?php echo $form->error($mem_model, 'pid'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($mem_model, 'pid'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($mem_model, 'pid', array('autocomplete' => 'off')); ?>
                            <?php echo $form->error($mem_model, 'pid'); ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($mem_model, 'sina'); ?></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->textField($mem_model, 'sina', array('autocomplete' => 'off')); ?>
                            <?php echo $form->error($mem_model, 'sina'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($mem_model, 'mem_name'); ?></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->textField($mem_model, 'mem_name', array('autocomplete' => 'off')); ?>
                            <?php echo $form->error($mem_model, 'mem_name'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($mem_model, 'name'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($mem_model, 'name', array('autocomplete' => 'off')); ?>
                            <?php echo $form->error($mem_model, 'name'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($mem_model, 'idcode'); ?></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->textField($mem_model, 'idcode', array('autocomplete' => 'off')); ?>
                            <?php echo $form->error($mem_model, 'idcode'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($mem_model, 'phone'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($mem_model, 'phone', array('autocomplete' => 'off')); ?>
                            <?php echo $form->error($mem_model, 'phone'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($mem_model, 'sign'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($mem_model, 'sign', array('autocomplete' => 'off')); ?>
                            <?php echo $form->error($mem_model, 'sign'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($mem_model, 'sex'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($mem_model, 'sex', array('男' => '男', '女' => '女'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($mem_model, 'sex'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($mem_model, 'role'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($mem_model, 'role', array('0' => '普通会员', '1' => '站长'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($mem_model, 'role'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt">支付宝账户名称</td>
                        <td class="ui_text_lt">
                            <input type="text" size="30" name="alipay_name" value="<?php echo $alipay_info["name"];?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt">支付宝账户</td>
                        <td class="ui_text_lt ipn_1">
                             <input type="text" size="30" name="alipay_account" value="<?php echo $alipay_info["account"];?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt">财付通账户名称</td>
                        <td class="ui_text_lt">
                             <input type="text" size="30" name="treasure_name" value="<?php echo $treasure_info["name"];?>"/>
                           
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt">财付通账户</td>
                        <td class="ui_text_lt ipn_1">
                             <input type="text" size="30" name="treasure_account" value="<?php echo $treasure_info["account"];?>"/>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="ui_text_rt">银行名称</td>
                        <td class="ui_text_lt">
                             <input type="text" size="30" name="bank_bank" value="<?php echo $bank_info["bank"];?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt">支行名称</td>
                        <td class="ui_text_lt ipn_1">
                             <input type="text" size="30" name="bank_banksub" value="<?php echo $bank_info["banksub"];?>"/>
                           
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt">银行用户名称</td>
                        <td class="ui_text_lt">
                             <input type="text" size="30" name="bank_name" value="<?php echo $bank_info["name"];?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt">银行用户账号</td>
                        <td class="ui_text_lt ipn_1">
                             <input type="text" size="30" name="bank_account" value="<?php echo $bank_info["account"];?>"/>
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