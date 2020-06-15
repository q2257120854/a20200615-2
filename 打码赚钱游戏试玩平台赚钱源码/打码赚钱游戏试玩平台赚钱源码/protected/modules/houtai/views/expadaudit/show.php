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

            /** 模糊查询来电用户  **/
            function search(name) {
                $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/expadaudit/show").submit();
            }

            /** 删除 **/
            function del(fyID) {
                if (fyID == '')
                    return;
                if (confirm("您确定要删除吗？")) {
                    $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/expadaudit/del/id/" + fyID).submit();
                }
            }

            //全选
            function CheckAll() {
                $("#dataTab :checkbox").attr({checked: $("#chkAll").attr("checked") == undefined ? false : true})
            }

            //删除选中
            function deleteSelected() {
                var arr = '';
                $("#dataTab").find("input[type='checkbox']:gt(0):checked").each(function() {
                    arr = arr + $(this).val() + ',';
                });
                if (arr.length > 0) {
                    if (confirm("确认删除选中吗？")) {
                        $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/expadaudit/alldel/ids/" + arr.substr(0, arr.length - 1)).submit();
                    }
                } else {
                    alert("对不起，您没有选中要删除的信息");
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
                            订单号&nbsp;&nbsp;<input type="text" id="code" name="code" class="ui_input_txt02" value="<?php echo $pages->params['code']; ?>"/>
                        </div>
                        <div id="box_bottom">
                            <input type="button" value="查询" class="ui_input_btn01" onclick="search();" /> 
                            <input type="button" value="删除" class="ui_input_btn01" onclick="deleteSelected();" /> 
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
                            <th width="30">
                                <input type="checkbox" name='chkAll' id='chkAll' onclick='CheckAll()'/>
                            </th>
                            <th>体验时间</th>
                            <th>会员id</th>
                            <th>订单号</th>
                            <th>体验广告</th>
                            <th>体验帐号</th>
                            <th>奖励元宝</th>
                            <th>处理时间</th>
                            <th>审核状态</th>
                            <th>操作</th>
                        </tr>
                        <?php
                        foreach ($posts as $model) {
                            ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="acb" value="<?php echo $model['id']; ?>"  name="check"/>
                                </td>
                                <td><?php echo $model['create_time']; ?></td>
                                <td>
                                    <?php echo $model['mem_id']; ?>
                                </td>
                                <td><?php echo $model['code']; ?></td>
                                <td><?php
                                    $expad_info = Expad::model()->findByPk($model['exp_ad_id']);
                                    echo $expad_info['name'];
                                    ?>
                                </td>
                                <td><?php echo $model['username']; ?></td>
                                <td><?php echo $model['hlb_num']; ?></td>
                                <td><?php echo $model['audit_time']; ?></td>
                                <td>
                                    <?php
                                    if ($model['start'] == "审核中") {
                                        echo "<p style='color:blue'>" . $model['start'] . "</p>";
                                    } else if ($model['start'] == "通过") {
                                        echo "<p style='color:green'>" . $model['start'] . "</p>";
                                    } else if ($model['start'] == "未通过") {
                                        echo "<p style='color:black'>" . $model['start'] . "</p>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if ($model['start'] == "审核中") { ?>
                                        <a class="edit" onclick="return confirm('您确定通过吗？')" href="<?php echo SITE_URL ?>houtai/expadaudit/pass/id/<?php echo $model['id']; ?>">通过</a>
                                        <a class="edit" onclick="return confirm('您确定未通过吗？')" href="<?php echo SITE_URL ?>houtai/expadaudit/nopass/id/<?php echo $model['id']; ?>">未通过</a>
                                        <a href="javascript:del('<?php echo $model['id']; ?>');">删除</a>
                                    <?php } else { ?>
                                        <a href="javascript:">--</a>
                                    <?php } ?>
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
