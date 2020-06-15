<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="text/javascript" src="/scripts/jquery/jquery-1.7.1.js"></script>
        <link href="/style/authority/basic_layout.css" rel="stylesheet" type="text/css">
        <link href="/style/authority/common_style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="/scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <link rel="stylesheet" type="text/css" href="/style/authority/jquery.fancybox-1.3.4.css"  media="screen"></link>
         <script src="/scripts/vip/laydate.js"></script>
        <link href="/style/vip/inside.css" rel="stylesheet" type="text/css" />
        <title><?php echo TITLE; ?></title>
        <script type="text/javascript">
            $(document).ready(function() {
                /**编辑   **/
                $("a.add").fancybox({
                    'width': 733,
                    'height': 230,
                    'type': 'iframe',
                    'hideOnOverlayClick': false,
                    'showCloseButton': false,
                    'onClosed': function() {
                        window.location.href = '<?php echo SITE_URL ?>houtai/giftdh/show';
                    }
                });
            });

            /** 模糊查询来电用户  **/
            function search(name) {
                $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/giftdh/show").submit();
            }

            /** 同意拨款 **/
            function agree(fyID) {
                if (fyID == '')
                    return;
                if (confirm("您确定同意兑换吗？")) {
                    $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/giftdh/agree/id/" + fyID).submit();
                }
            }

            /** 拒绝拨款 **/
            function refuse(fyID) {
                if (fyID == '')
                    return;
                if (confirm("您确定拒绝兑换吗？")) {
                    $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/giftdh/refuse/id/" + fyID).submit();
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
                        $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/giftdh/alldel/ids/" + arr.substr(0, arr.length - 1)).submit();
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
                            会员昵称&nbsp;&nbsp;<input type="text" id="mem_name" name="mem_name" class="ui_input_txt02" value="<?php echo $pages->params['mem_name']; ?>"/>
                             起始时间：
                            <input type="text"  id="start" name="start" class="ui_input_txt02" value="<?php echo $pages->params['start']; ?>"/>
                            至：
                            <input type="text"  id="end" name="end"  class="ui_input_txt02" value="<?php echo $pages->params['end']; ?>"/>
                        </div>
                        
                        <div id="box_bottom">
                            <input type="button" value="查询" class="ui_input_btn01" onclick="search();" /> 
                            <input type="button" value="删除" class="ui_input_btn01" onclick="deleteSelected();" /> 
                        </div>
                    </div>
                </div>
            </div>
            
            <!--加载时间日期选择-->
            <script>
                !function() {
                    laydate({elem: '#demo3'});//绑定元素
                }();
                //日期范围限制
                var start = {
                    elem: '#start',
                    format: 'YYYY-MM-DD',
                    max: '2099-06-16', //最大日期
                    istime: true,
                    istoday: false,
                    choose: function(datas) {
                        end.min = datas; //开始日选好后，重置结束日的最小日期
                        end.start = datas //将结束日的初始值设定为开始日
                    }
                };
                var end = {
                    elem: '#end',
                    format: 'YYYY-MM-DD',
                    min: laydate.now(),
                    max: '2099-06-16',
                    istime: true,
                    istoday: false,
                    choose: function(datas) {
                        start.max = datas; //结束日选好后，充值开始日的最大日期
                    }
                };
                laydate(start);
                laydate(end);
            </script>
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
                            <th>兑换时间</th>
                            <th>同意时间</th>
                            <th>会员昵称</th>
                            <th>礼品名称</th>
                            <th>所用金豆</th>
                            <th>手机号码</th>
                            <th>省份</th>
                            <th>城市</th>
                            <th>县</th>
                            <th>发货地址</th>
                            <th>兑换状态</th>
                            <th>备注</th>
                            <th>操作</th>
                        </tr>
                        <?php
                        $address_model = Address::model();
                        foreach ($posts as $model) {
                            ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="acb" value="<?php echo $model['id']; ?>"  name="check"/>
                                </td>
                                <td><?php echo $model['create_time']; ?></td>
                                <td>
                                    <?php
                                    if (empty($model['dh_time'])) {
                                        echo "--";
                                    } else {
                                        echo $model['dh_time'];
                                    }
                                    ?>
                                </td>
                                <td><?php echo $model['mem_name']; ?></td>
                                <td><?php echo $model['name']; ?></td>
                                <td><?php echo $model['hld']; ?></td>
                                <td><?php echo $model['phone']; ?></td>
                                <td><?php echo $address_model->getCityName($model['province']); ?></td>
                                <td><?php echo $address_model->getCityName($model['city']); ?></td>
                                <td><?php echo $address_model->getCityName($model['district']); ?></td>
                                <td><?php echo $model['address']; ?></td>
                                <td><?php
                                    if ($model['starts'] == "已兑换") {
                                        echo "<span style='color:green'>已兑换</span>";
                                    } else if ($model['starts'] == "已拒绝") {
                                        echo "<span style='color:red'>已拒绝</span>";
                                    } else {
                                        echo $model['starts'];
                                    }
                                    ?>
                                </td>
                                <td><?php echo $model['remark']; ?></td>
                                <td>
                                    <a href="<?php echo SITE_URL ?>houtai/giftdh/remark/id/<?php echo $model['id']; ?>" class="add">添加备注</a> 
                                    <?php if ($model['starts'] == "兑换中") { ?>
                                        <a href="javascript:agree('<?php echo $model['id']; ?>');" >同意兑换</a> 
                                        <a href="javascript:refuse('<?php echo $model['id']; ?>');" >拒绝兑换</a> 
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






