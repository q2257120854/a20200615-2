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
                    'href': '<?php echo SITE_URL ?>houtai/gameimpact/add/gameid/<?php echo $pages->params['gameid']; ?>',
                    'width': 733,
                    'height': 430,
                    'type': 'iframe',
                    'hideOnOverlayClick': false,
                    'showCloseButton': false,
                    'onClosed': function() {
                        window.location.href = '<?php echo SITE_URL ?>houtai/gameimpact/show/gameid/<?php echo $pages->params['gameid']; ?>';
                    }
                });
                /**编辑   **/
                $("a.edit").fancybox({
                    'width': 733,
                    'height': 430,
                    'type': 'iframe',
                    'hideOnOverlayClick': false,
                    'showCloseButton': false,
                    'onClosed': function() {
                        window.location.href = '<?php echo SITE_URL ?>houtai/gameimpact/show/gameid/<?php echo $pages->params['gameid']; ?>';
                    }
                });
            });
            
            /** 删除 **/
            function del(fyID) {
                if (fyID == '')
                    return;
                if (confirm("您确定要删除吗？")) {
                    $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/gameimpact/del/gameid/<?php echo $pages->params['gameid']; ?>/id/" + fyID).submit();
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
                        $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/gameimpact/alldel/gameid/<?php echo $pages->params['gameid']; ?>/ids/" + arr.substr(0, arr.length - 1)).submit();
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
            <input type="hidden" value="<?php  echo Yii::app()->user->getFlash('msg') ?>" id="msg" />
        <?php } ?>
        <?php $form = $this->beginWidget('CActiveForm', array('id' => 'submitForm')); ?>
        <div id="container">
            <div class="ui_content">
                <div class="ui_text_indent">
                    <div id="box_border">
                          <div id="box_top">冲级比赛</div>
                        <div id="box_bottom">
                            <input type="button" value="新增" class="ui_input_btn01" id="addBtn" /> 
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
                            <th>游戏</th>
                            <th>排名</th>
                            <th>等级</th>
                            <th>奖励元宝</th>
                            <th>是否领取</th>
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
                                    <?php
                                    $game_info = Game::model()->findByPk($model['game_id']);
                                    echo $game_info['name'];
                                    ?>
                                </td>
                                <td><?php echo $model['rank']; ?></td>
                                <td><?php echo $model['level']; ?></td>
                                <td><?php echo $model['hlb']; ?></td>
                                <td><?php if(!empty($model['valid'])){echo "<span style='color:green'>已领取</span>";}else{echo "未领取";} ; ?></td>
                                <td>
                                    <a href="<?php echo SITE_URL ?>houtai/gameimpact/edit/id/<?php echo $model['id']; ?>" class="edit">编辑</a> 
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
