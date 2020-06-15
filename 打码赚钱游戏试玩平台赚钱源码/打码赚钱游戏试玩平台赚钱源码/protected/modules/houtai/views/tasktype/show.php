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
                    'href': '<?php echo SITE_URL ?>houtai/tasktype/add',
                    'width': 333,
                    'height': 230,
                    'type': 'iframe',
                    'hideOnOverlayClick': false,
                    'showCloseButton': false,
                    'onClosed': function() {
                        window.location.href = '<?php echo SITE_URL ?>houtai/tasktype/show';
                    }
                });
                /**编辑   **/
                $("a.edit").fancybox({
                    'width': 333,
                    'height': 230,
                    'type': 'iframe',
                    'hideOnOverlayClick': false,
                    'showCloseButton': false,
                    'onClosed': function() {
                        window.location.href = '<?php echo SITE_URL ?>houtai/tasktype/show';
                    }
                });
            });

            /** 模糊查询来电用户  **/
            function search(name) {
                $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/tasktype/show").submit();
            }

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
                        <div id="box_top">搜索</div>
                        <div id="box_center">
                            任务名称&nbsp;&nbsp;<input type="text" id="name" name="name" class="ui_input_txt02" value="<?php echo $pages->params['name']; ?>"/>
                        </div>
                        <div id="box_bottom">
                            <input type="button" value="查询" class="ui_input_btn01" onclick="search();" /> 
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
                    <table class="table" cellspacing="0" cellpadding="0" width="100%" align="center" border="0" id="dataTab">
                        <tr>
                            <th>创建时间</th>
                            <th>任务名称</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        <?php
                        foreach ($posts as $model) {
                            ?>
                            <tr>
                                <td><?php echo $model['create_time']; ?></td>
                                <td><?php echo $model['name']; ?></td>
                                <td>
                                    <?php
                                    if (empty($model['valid'])) {
                                        echo "<span style='color:green;'>开启</span>";
                                    } else {
                                        echo "<span style='color:red;'>关闭</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="<?php echo SITE_URL ?>houtai/tasktype/edit/id/<?php echo $model['id']; ?>" class="edit">编辑</a> 
                                    <a href="<?php echo SITE_URL ?>houtai/task/show/typeid/<?php echo $model['id']; ?>" >任务管理</a> 
                                    <a href="<?php echo SITE_URL ?>houtai/tasktype/close/id/<?php echo $model['id']; ?>"  onclick="return confirm('确定要启用或者关闭吗？')">
                                        <?php
                                        if (empty($model['valid'])) {
                                            echo "<span style='color:red;'>关闭</span>";
                                        } else {
                                            echo "<span style='color:green;'>开启</span>";
                                        }
                                        ?>
                                    </a> 
                                </td>
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
