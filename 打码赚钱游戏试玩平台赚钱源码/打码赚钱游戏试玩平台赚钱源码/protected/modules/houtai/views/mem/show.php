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
                /**编辑   **/
                $("a.edit").fancybox({
                    'width': 733,
                    'height': 830,
                    'type': 'iframe',
                    'hideOnOverlayClick': false,
                    'showCloseButton': false,
                    'onClosed': function() {
                        window.location.href = '<?php echo SITE_URL ?>houtai/mem/show';
                    }
                });

                /**编辑   **/
                $("a.hlb").fancybox({
                    'width': 733,
                    'height': 230,
                    'type': 'iframe',
                    'hideOnOverlayClick': false,
                    'showCloseButton': false,
                    'onClosed': function() {
                        window.location.href = '<?php echo SITE_URL ?>houtai/mem/show';
                    }
                });
            });

            /** 模糊查询来电用户  **/
            function search(email) {
                $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/mem/show").submit();
            }



            /** 禁用 **/
            function off(fyID) {
                if (fyID == '')
                    return;
                if (confirm("您确定要禁用吗？")) {
                    $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/mem/off/id/" + fyID).submit();
                }
            }
            /** 启用 **/
            function on(fyID) {
                if (fyID == '')
                    return;
                if (confirm("您确定要启用吗？")) {
                    $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/mem/on/id/" + fyID).submit();
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
                    if (confirm("会员数据极为重要，您确认要删除选中吗？")) {
                        $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/mem/alldel/ids/" + arr.substr(0, arr.length - 1)).submit();
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
                            昵称/账号&nbsp;&nbsp;<input type="text" id="memname" name="memname" class="ui_input_txt02" value="<?php echo $pages->params['memname']; ?>"/>
                            会员ID&nbsp;&nbsp;<input type="text" id="memid" name="memid" class="ui_input_txt02" value="<?php echo $pages->params['memid']; ?>"/>
                            邮箱&nbsp;&nbsp;<input type="text" id="email" name="email" class="ui_input_txt02" value="<?php echo $pages->params['email']; ?>"/>
                            身份证&nbsp;&nbsp;<input type="text" id="idcode" name="idcode" class="ui_input_txt02" value="<?php echo $pages->params['idcode']; ?>"/>
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
                            <th>创建时间</th>
                            <th>会员ID</th>
                            <th>邮箱</th>
                            <th>昵称/账号</th>
                            <th>连续签到</th>
                            <th>QQ账号</th>
                            <th>新浪账号</th>
                            <th>好友数量</th>
                            <th>会员类型</th>
                            <th>使用状态</th>
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
                                <td><?php echo $model['id']; ?></td>
                                <td><a href ="<?php echo SITE_URL . 'houtai/mem/detail/memid/' . $model['id']; ?>"><?php echo "<span style='color:red'>" . $model['email'] . "<span>"; ?></a></td>
                                <td><?php echo $model['mem_name']; ?></td>
                                <td><?php echo intval($model['sign']); ?></td>
                                <td>
                                    <?php
                                    if (empty($model['qq'])) {
                                        echo "--";
                                    } else {
                                        echo $model['qq'];
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (empty($model['sina'])) {
                                        echo "--";
                                    } else {
                                        echo $model['sina'];
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php echo Mem::model()->countBySql("SELECT count(*) from xm_mem where INSTR(pid,'" . $model['id'] . ",') !=0 "); ?>
                                </td>
                                <td><?php
                                    if (empty($model['role'])) {
                                        echo "普通会员";
                                    } else {
                                        echo "站长";
                                    }
                                    ?></td>
                                <td><?php
                                    if (empty($model['valid'])) {
                                        echo "<span style='color:green'>正常使用</span>";
                                    } else {
                                        echo "<span style='color:red'>已禁用</span>";
                                    }
                                    ?></td>
                                <td>
                                    <a href="<?php echo SITE_URL ?>houtai/mem/updhlb/id/<?php echo $model['id']; ?>" class="hlb">操币</a> 
                                    <a href="<?php echo SITE_URL ?>houtai/mem/dethlb/id/<?php echo $model['id']; ?>" >币详</a> 
                                    <a href="<?php echo SITE_URL ?>houtai/mem/edit/id/<?php echo $model['id']; ?>" class="edit">编辑</a> 
                                    <?php if (empty($model['valid'])) { ?>
                                        <a href="javascript:off('<?php echo $model['id']; ?>');" >禁用</a> 
                                    <?php } else { ?>
                                        <a href="javascript:on('<?php echo $model['id']; ?>');" >启用</a> 
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






