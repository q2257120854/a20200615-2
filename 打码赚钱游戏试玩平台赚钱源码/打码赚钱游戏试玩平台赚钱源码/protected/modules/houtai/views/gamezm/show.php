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
                $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/gamezm/show").submit();
            }
            /** 删除 **/
            function del(fyID) {
                if (fyID == '')
                    return;
                if (confirm("您确定要删除吗？")) {
                    $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/gamezm/del/id/" + fyID).submit();
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
                        $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/gamezm/alldel/ids/" + arr.substr(0, arr.length - 1)).submit();
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
                            游戏名称&nbsp;&nbsp;
                            <select name="game_id" id="game_id" class="ui_select01" onchange="getFyDhListByFyXqCode();">
                                <option value="">--请选择--</option>
                                <?php
                                $game_info = Game::model()->findAllBySql("select id,name from {{game}}");
                                foreach ($game_info as $gameinfo) {
                                    if ($gameinfo['id'] == $pages->params['game_id']) {
                                        ?>
                                        <option value="<?php echo $gameinfo['id']; ?>"  selected="selected"><?php echo $gameinfo['name']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $gameinfo['id']; ?>"><?php echo $gameinfo['name']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
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
                            <th>会员id</th>
                            <th>账号id</th>
                            <th>账户名</th>
                            <th>游戏id</th>
                            <th>（区、服）id</th>
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
                                <td><?php echo $model['mem_id']; ?></td>
                                <td><?php echo $model['userid']; ?></td>
                                <td><?php echo $model['username']; ?></td>
                                <td><?php echo $model['game_id']; ?></td>
                                <td><?php echo $model['sid']; ?></td>
                                <td>
                                    <a href="javascript:del('<?php echo $model['id']; ?>');">删除</a>
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
