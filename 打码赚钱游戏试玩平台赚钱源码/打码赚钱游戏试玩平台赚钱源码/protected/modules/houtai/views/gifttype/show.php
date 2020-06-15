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
            $(document).ready(function() {
                $("#addBtn").fancybox({
                    'href': '<?php echo SITE_URL ?>houtai/gifttype/add',
                    'width': 733,
                    'height': 300,
                    'type': 'iframe',
                    'hideOnOverlayClick': false,
                    'showCloseButton': false,
                    'onClosed': function() {
                        window.location.href = '<?php echo SITE_URL ?>houtai/gifttype/show';
                    }
                });
                var id = '<?php echo $_GET['start'] ?>';
                if (id != "") {
                    if (confirm("您确定要删除吗？")) {
                        window.location.href = '<?php echo SITE_URL ?>houtai/gifttype/del/id/' + id + '/start/' + id;
                    }

                }
            });

            window.onload = function() {
                var msg = $('#msg').val();
                if (msg != "") {
                    $("#modal-add-event2").show();
                    $("#msgres").html(msg);
                    setTimeout(function() {
                        $("#modal-add-event2").hide();
                    }, 2000);
                }
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
                        <div id="box_bottom">
                            <input type="button" value="新增" class="ui_input_btn01" id="addBtn" /> 
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
                    <?php
                    $this->widget('application.extensions.TreeWidget', array(
                        'dataProvider' => $data, // 传递数据
                        'pid' => 'pid', // 设置父ID
                        'tableClass' => 'table', // 表格样式
                        'formatParam' => 'name', // 设置格式化字段  
                        'action' => array(
                            array(
                                'label' => '编辑', // 链接名称
                                'url' => array(
                                    'edit' => 'Yii::app()->controller->createUrl("/houtai/gifttype/edit")', // 生成连接
                                ),
                                'urlParams' => array('id', 'name'), //设置url后面需要传递的参数字段
                            ),
                            array(
                                'label' => '删除', // 链接名称
                                'url' => array(
                                    'del' => 'Yii::app()->controller->createUrl("/houtai/gifttype/del")', // 生成连接
                                ),
                                'urlParams' => array('id', 'name'), // 设置url后面需要传递的参数字段
                            ),
                        ),
                        'tableHead' => array(// 设置表格列头信息
                            '创建时间',
                            'ID',
                            '类型名称',
                            '父ID',
                            '操',
                            '作',
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
       </body>
</html>


