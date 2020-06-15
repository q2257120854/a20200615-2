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
                /** 拒绝  **/
                $("a.refuse").fancybox({
                    'width': 633,
                    'height': 230,
                    'type': 'iframe',
                    'hideOnOverlayClick': false,
                    'showCloseButton': false,
                    'onClosed': function() {
                        window.location.href = '<?php echo SITE_URL ?>houtai/web/show';
                    }
                });

                /**编辑   **/
                $("a.edit").fancybox({
                    'width': 633,
                    'height': 530,
                    'type': 'iframe',
                    'hideOnOverlayClick': false,
                    'showCloseButton': false,
                    'onClosed': function() {
                        window.location.href = '<?php echo SITE_URL ?>houtai/web/show';
                    }
                });
            });

            /** 模糊查询来电用户  **/
            function search(name) {
                $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/web/show").submit();
            }


            //更新前两个月的邀请排行
            function rank() {
                if (confirm("您确定要更新前两个月的邀请排行么？")) {
                    $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/web/rank").submit();
                }
            }

            //更新一个月的推广工资
            function wage() {
                if (confirm("您确定要更新上月的推广工资么？")) {
                    $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/web/wage").submit();
                }
            }

            /** 同意拨款 **/
            function agree(fyID) {
                if (fyID == '')
                    return;
                if (confirm("您确定同意申请吗？")) {
                    $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/web/agree/id/" + fyID).submit();
                }
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
                            真实姓名&nbsp;&nbsp;<input type="text" id="name" name="name" class="ui_input_txt02" value="<?php echo $pages->params['name']; ?>"/>
                        </div>
                        <div id="box_bottom">
                            <input type="button" value="查询" class="ui_input_btn01" onclick="search();" /> 
                            <input type="button" value="更新邀请排行" class="ui_input_btn01" onclick="rank();" /> 
                            <input type="button" value="更新推广工资" class="ui_input_btn01" onclick="wage();" /> 
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
                            <th>申请时间</th>
                            <th>审批时间</th>
                            <th>网站名称</th>
                            <th>网站地址</th>
                            <th>qq</th>
                            <th>手机</th>
                            <th>邮箱</th>
                            <th>真实姓名</th>
                            <th>身份证</th>
                            <th>状态</th>
                            <th>会员id</th>
                            <th>备注</th>
                            <th>操作</th>
                        </tr>
                        <?php
                        foreach ($posts as $model) {
                            ?>
                            <tr>
                                <td><?php echo $model['create_time']; ?></td>
                                <td><?php echo $model['cl_time']; ?></td>
                                <td><?php echo $model['webname']; ?></td>
                                <td><?php echo $model['weburl']; ?></td>
                                <td><?php echo $model['qq']; ?></td>
                                <td><?php echo $model['phone']; ?></td>
                                <td><?php echo $model['email']; ?></td>
                                <td><?php echo $model['name']; ?></td>
                                <td><?php echo $model['code']; ?></td>
                                <td>
                                    <?php
                                    if ($model['status'] == "已通过") {
                                        echo "<span style='color:green'>已通过</span>";
                                    } else if ($model['status'] == "未通过") {
                                        echo "<span style='color:red'>未通过</span>";
                                    } else {
                                        echo $model['status'];
                                    }
                                    ?>
                                </td>
                                <td><?php echo $model['mem_id']; ?></td>
                                <td><?php echo $model['remark']; ?></td>
                                <td>
                                    <a href="<?php echo SITE_URL ?>houtai/web/edit/id/<?php echo $model['id']; ?>" class="edit">编辑</a> 
                                    <?php if ($model['status'] == "审核中") { ?>
                                        <a href="javascript:agree('<?php echo $model['id']; ?>');" >同意</a> 
                                        <a href="<?php echo SITE_URL ?>houtai/web/refuse/id/<?php echo $model['id']; ?>" class="refuse" >拒绝</a> 
                                        <?php
                                    }
                                    ?>
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
