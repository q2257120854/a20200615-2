<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="text/javascript" src="/scripts/jquery/jquery-1.7.1.js"></script>
        <link href="/style/authority/basic_layout.css" rel="stylesheet" type="text/css">
        <link href="/style/authority/common_style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="/scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <link rel="stylesheet" type="text/css" href="/style/authority/jquery.fancybox-1.3.4.css"  media="screen"></link>
        <title><?php echo TITLE; ?></title>
        <script type="text/javascript">
            /** 模糊查询来电用户**/
            function search(email) {
                $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/mem/dethlb/id/"+<?php echo $id;?>).submit();
            }
        </script>
        <style>
            .alt td{ background:black !important;}
            .modal2{
                width:150px;
                left:45%;
                margin-left:0;
                background: #F74D4D;
                color:#fff;
                text-align: center;
                top:35%;
            }
            #modal-add-event2 .modal-header{
                background: #F74D4D;
                border: none;
            }
            #modal-add-event2 .close{
                color:#fff;
                opacity:0.8;
            }
            #modal-add-event2 .close:hover,#modal-add-event2 .close:focus{
                opacity:1;
            }
        </style>
    </head>
    <?php $this->layout = false; ?>
    <body>
        <?php
        if (Yii::app()->user->hasFlash('msg')) {
            ?>
            <input type="hidden" value="<?php echo Yii::app()->user->getFlash('msg') ?>" id="msg" />
        <?php } ?>
        <?php $form = $this->beginWidget('CActiveForm', array('id' => 'submitForm')); ?>
        <div id="container">
            <div class="ui_content">
                <div class="ui_text_indent">
                    <div id="box_border">
                        <div id="box_top">搜索</div>
                        <div id="box_center">
                            开始时间
                            <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name' => 'start',
                                'language' => 'zh_cn',
                                'value' => $pages->params['start'] ? $pages->params['start'] : "",
                                'options' => array(
                                    'showAnim' => 'fold',
                                    'showOn' => 'both',
                                    'dateFormat' => 'yy-mm-dd',
                                ),
                                'htmlOptions' => array(
                                    'class' => 'ui_input_txt02',
                                    'maxlength' => 1,
                                ),
                            ));
                            ?>
                            结束时间
                            <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name' => 'end',
                                'language' => 'zh_cn',
                                'value' => $pages->params['end'] ? $pages->params['end'] : "",
                                'options' => array(
                                    'showAnim' => 'fold',
                                    'showOn' => 'both',
                                    'dateFormat' => 'yy-mm-dd',
                                ),
                                'htmlOptions' => array(
                                    'class' => 'ui_input_txt02',
                                    'maxlength' => 1,
                                ),
                            ));
                            ?>
                        </div>
                        <div id="box_bottom">
                            <input type="button" value="查询" class="ui_input_btn01" onclick="search();" /> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal hide modal2" id="modal-add-event2">
                <div class="modal-body">
                    <p id="msgres"></p>
                </div>
            </div>
            <div class="ui_content">
                <div class="ui_tb">
                    <table class="table" cellspacing="0" cellpadding="0" width="100%" align="center" border="0" id="dataTab">
                        <tr>
                            <th>创建时间</th>
                            <th>会员ID</th>
                            <th>元宝</th>
                            <th>原因</th>
                            <th>来源</th>
                            <th>类型</th>
                            <th>来自推广会员</th>
                        </tr>
                        <?php
                        foreach ($posts as $model) {
                            ?>
                            <tr>
                                <td><?php echo $model['create_time']; ?></td>
                                <td><?php echo $model['mem_id']; ?></td>
                                <td><?php echo $model['hlb']; ?></td>
                                <td><?php echo $model['reason']; ?></td>
                                <td><?php 
                              echo  Hlbsource::model()->findByPk($model['source'])->source;
                                ?></td>
                                <td><?php
                                    if ($model['type'] == 1) {
                                        echo "增加";
                                    } else {
                                        echo "扣除";
                                    };
                                    ?>
                                </td>
                                <td><?php echo $model['pmem_id']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
                <div style="text-align: center;height: 30px;">
                    <?php
                    if ($pages->itemCount == 0) {
                        echo "当前内容为空！";
                    } else {
                        $this->widget('CLinkPager', array('pages' => $pages));
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
       </body>
</html>






