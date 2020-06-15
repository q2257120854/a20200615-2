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
    <?php $this->layout = false; ?>
    <body>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
        ?>
        <div id="container">
            <div id="nav_links">
                当前位置：体验管理&nbsp;>&nbsp;<span style="color: #1A5CC6;">编辑</span>
                <div id="page_close">
                    <a href="javascript:parent.$.fancybox.close();">
                        <img src="<?php echo IMG_URL ?>common/page_close.png" width="20" height="20" style="vertical-align: text-top;"/>
                    </a>
                </div>
            </div>
            <div class="ui_content">
                <table class="tab_1"  cellspacing="0" cellpadding="0" width="100%"  align="left" border="0" >
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'bustype'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->dropDownList($expad_model, 'bustype', $expadbusarray); ?>
                            <?php echo $form->error($expad_model, 'bustype'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'open'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($expad_model, 'open', array('0' => '开启', '1' => '关闭'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($expad_model, 'open'); ?>
                        </td>
                    </tr>  
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'recruit_num'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($expad_model, 'recruit_num'); ?>
                            <?php echo $form->error($expad_model, 'recruit_num'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'recruit_num_bs'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($expad_model, 'recruit_num_bs'); ?>
                            <?php echo $form->error($expad_model, 'recruit_num_bs'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'name'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($expad_model, 'name'); ?>
                            <?php echo $form->error($expad_model, 'name'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'content'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($expad_model, 'content'); ?>
                            <?php echo $form->error($expad_model, 'content'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'explain'); ?></td>
                        <td class="ui_text_lt ipn_2">
                            <?php echo $form->textField($expad_model, 'explain'); ?>
                            <?php echo $form->error($expad_model, 'explain'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'rewards_hlb'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($expad_model, 'rewards_hlb'); ?>
                            <?php echo $form->error($expad_model, 'rewards_hlb'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'hlz_uid'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($expad_model, 'hlz_uid'); ?>
                            <?php echo $form->error($expad_model, 'hlz_uid'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'hlz_expid'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($expad_model, 'hlz_expid'); ?>
                            <?php echo $form->error($expad_model, 'hlz_expid'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'expad_uid'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($expad_model, 'expad_uid'); ?>
                            <?php echo $form->error($expad_model, 'expad_uid'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'key'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($expad_model, 'key'); ?>
                            <?php echo $form->error($expad_model, 'key'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'begin_time'); ?></td>
                        <td class="ui_text_lt">
                            <input type="text"  id="Expad_begin_time" name="Expad[begin_time]" class="ui_input_txt02"  value="<?php echo $expad_model["begin_time"]; ?>" />
                            <?php echo $form->error($expad_model, 'begin_time'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'end_time'); ?></td>
                        <td class="ui_text_lt">
                            <input type="text"  id="Expad_end_time" name="Expad[end_time]" class="ui_input_txt02" value="<?php echo $expad_model["end_time"]; ?>"/>
                            <?php echo $form->error($expad_model, 'end_time'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'zc_end_time'); ?></td>
                        <td class="ui_text_lt">
                            <input type="text"  id="Expad_zc_end_time" name="Expad[zc_end_time]" class="ui_input_txt02" value="<?php echo $expad_model["zc_end_time"]; ?>" />
                            <?php echo $form->error($expad_model, 'end_time'); ?>
                        </td>
                    </tr>
                     <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'selgrade_type'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($expad_model, 'selgrade_type', array('0' => '通过账号id', '1' => '通过账号'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($expad_model, 'selgrade_type'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'selgrade_result'); ?></td>
                        <td class="ui_text_lt">
                            <input type="text"  id="Expad_zc_end_time" name="Expad[selgrade_result]" class="ui_input_txt02" />
                            <?php echo $form->error($expad_model, 'selgrade_result'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'selgrade_succ'); ?></td>
                        <td class="ui_text_lt">
                            <input type="text"  id="Expad_zc_end_time" name="Expad[selgrade_succ]" class="ui_input_txt02" />
                            <?php echo $form->error($expad_model, 'selgrade_succ'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'is_timely'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->radioButtonList($expad_model, 'is_timely', array('0' => '即', '1' => '手'), array('separator' => '&nbsp;')); ?>
                            <?php echo $form->error($expad_model, 'is_timely'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'updtime'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($expad_model, 'updtime'); ?>
                            <?php echo $form->error($expad_model, 'updtime'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'describe'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textField($expad_model, 'describe'); ?>
                            <?php echo $form->error($expad_model, 'describe'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'login_url'); ?></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->textField($expad_model, 'login_url'); ?>
                            <?php echo $form->error($expad_model, 'login_url'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'register_url'); ?></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->textField($expad_model, 'register_url'); ?>
                            <?php echo $form->error($expad_model, 'register_url'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'return_url'); ?></td>
                        <td class="ui_text_lt ipn_1">
                            <?php echo $form->textField($expad_model, 'return_url'); ?>
                            <?php echo $form->error($expad_model, 'return_url'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'course'); ?></td>
                        <td class="ui_text_lt  ipn_1">
                            <?php echo $form->textField($expad_model, 'course'); ?>
                            <?php echo $form->error($expad_model, 'course'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'img'); ?></td>
                        <td class="ui_text_lt">
                            <input type="hidden"  name="hideimg" value="<?php echo $expad_model->img; ?>"/>
                            <?php if (!empty($expad_model->img)) { ?>
                                <?php echo "<img src=/uploads/img/expad/" . $expad_model->img . " style='width: 80px;height: 30px;'/>"; ?>
                            <?php } ?>
                            <?php echo CHtml::activeFileField($expad_model, 'img'); ?>
                            <?php echo $form->error($expad_model, 'img'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'image'); ?></td>
                        <td class="ui_text_lt">
                            <input type="hidden"  name="hideimage" value="<?php echo $expad_model->image; ?>"/>
                            <?php if (!empty($expad_model->image)) { ?>
                                <?php echo "<img src=/uploads/img/expad/" . $expad_model->image . " style='width: 80px;height: 30px;'/>"; ?>
                            <?php } ?>
                            <?php echo CHtml::activeFileField($expad_model, 'image'); ?>
                            <?php echo $form->error($expad_model, 'image'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ui_text_rt"><?php echo $form->labelEx($expad_model, 'ask'); ?></td>
                        <td class="ui_text_lt">
                            <?php echo $form->textArea($expad_model, 'ask', array('cols' => 10, 'rows' => 2, 'style' => 'width: 557px; z-index: 999;')); ?>
                            <?php echo $form->error($expad_model, 'ask'); ?>
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
                elem: '#Expad_begin_time',
                format: 'YYYY-MM-DD hh:mm',
                max: '2099-06-16', //最大日期
                istime: true,
                istoday: false,
                choose: function(datas) {
                    end.min = datas; //开始日选好后，重置结束日的最小日期
                    end.start = datas //将结束日的初始值设定为开始日
                }
            };
            var end = {elem: '#Expad_end_time',
                format: 'YYYY-MM-DD hh:mm',
                min: laydate.now(),
                max: '2099-06-16',
                istime: true,
                istoday: false,
                choose: function(datas) {
                    start.max = datas; //结束日选好后，充值开始日的最大日期
                }
            };
            //日期范围限制
            var zctime = {
                elem: '#Expad_zc_end_time',
                format: 'YYYY-MM-DD hh:mm',
                max: '2099-06-16', //最大日期
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








