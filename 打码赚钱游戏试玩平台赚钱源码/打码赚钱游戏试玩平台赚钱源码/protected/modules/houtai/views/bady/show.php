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
                $("a.edit").fancybox({
                    'width': 433,
                    'height': 230,
                    'type': 'iframe',
                    'hideOnOverlayClick': false,
                    'showCloseButton': false,
                    'onClosed': function() {
                        window.location.href = '<?php echo SITE_URL ?>houtai/bady/show';
                    }
                });
            });
            /** 模糊查询来电用户  **/
            function search() {
                $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/bady/show").submit();
            }
            
            /** 同意 **/
            function agree(fyID) {
                if (fyID == '')
                    return;
                if (confirm("您确定同意存入玩宝吗？")) {
                    $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/bady/agree/id/" + fyID).submit();
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
                            会员id&nbsp;&nbsp;<input type="text" id="memid" name="memid" class="ui_input_txt02" value="<?php echo $pages->params['memid']; ?>"/>
                            类型&nbsp;&nbsp;
                            <select name="tradetype" id="tradetype" class="ui_select01">
                                <option value="转入" <?php
                                if ($pages->params['tradetype'] == "转入") {
                                    echo "selected='selected'";
                                }
                                ?>>转入</option>
                                <option value="转出" <?php
                                if ($pages->params['tradetype'] == "转出") {
                                    echo "selected='selected'";
                                }
                                ?>>转出</option>
                            </select>
                            状态&nbsp;&nbsp;
                            <select name="status" id="status" class="ui_select01">
                                <option value="">--请选择--</option>
                                <option value="待审核" <?php
                                if ($pages->params['status'] == "待审核") {
                                    echo "selected='selected'";
                                }
                                ?>>待审核</option>
                                <option value="已通过" <?php
                                if ($pages->params['status'] == "已通过") {
                                    echo "selected='selected'";
                                }
                                ?>>已通过</option>
                                <option value="已拒绝" <?php
                                if ($pages->params['status'] == "已拒绝") {
                                    echo "selected='selected'";
                                }
                                ?>>已拒绝</option>
                            </select>
                            起始时间：
                            <input type="text"  id="start" name="start" class="ui_input_txt02" value="<?php echo $pages->params['start']; ?>"/>
                            至：
                            <input type="text"  id="end" name="end"  class="ui_input_txt02" value="<?php echo $pages->params['end']; ?>"/>
                        </div>
                        <div id="box_bottom">
                            <input type="button" value="查询" class="ui_input_btn01" onclick="search();" /> 
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
                            <th>创建时间</th>
                            <th>处理时间</th>
                            <th>会员id</th>
                            <th>元宝总数</th>
                            <th>类型</th>
                            <th>状态</th>
                            <th>备注</th>
                            <th>操作</th>
                        </tr>
                        <?php
                        foreach ($posts as $model) {
                            ?>
                            <tr>
                                <td><?php echo $model['create_time']; ?></td>
                                <td><?php echo $model['cl_time']; ?></td>
                                <td><a href ="<?php echo SITE_URL . 'houtai/bady/detail/memid/' . $model['mem_id']; ?>"><?php echo "<span style='color:red'>" . $model['mem_id'] . "<span>"; ?></a></td>
                                <td><?php echo $model['hlb']; ?></td>
                                <td> <?php echo $model['trade_type']; ?>  </td>
                                <td>
                                    <?php
                                    if ($model['status'] == "已通过") {
                                        echo "<span style='color:green'>已通过</span>";
                                    } else if ($model['status'] == "已拒绝") {
                                        echo "<span style='color:red'>已拒绝</span>";
                                    } else {
                                        echo $model['status'];
                                    }
                                    ?>
                                </td>
                                <td><?php echo $model['remark']; ?></td>
                                <td>
                                    <?php if ($model['status'] == "待审核") { ?>
                                        <a href="javascript:agree('<?php echo $model['id']; ?>');" >同意存入</a> 
                                        <a href="<?php echo SITE_URL ?>houtai/bady/refuse/id/<?php echo $model['id']; ?>" class="edit" >拒绝存入</a> 
                                        <?php
                                    } else {
                                        echo "--";
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
                <div>
                    <?php
                    $badyzc_model = Badyzc::model();
                    $badyprob_model = Badyprob::model();
                    
                    $sumhlb = $badyzc_model->countBySql("select SUM(hlb) from {{bady}} where  TO_DAYS(create_time) = (TO_DAYS(NOW()))");
                    echo "  今日存入元宝：<span style='color:red;'>" . number_format(intval($sumhlb)) . "</span><br/>";

                    $totalhlb = $badyzc_model->countBySql("select SUM(hlb) from {{bady}}");
                    echo "  元宝总存入量：<span style='color:red;'>" . number_format(intval($totalhlb)) . "</span><br/>";

                    $badyprob_info= $badyprob_model->findBySql("select prob from {{bady_prob}} where  TO_DAYS(create_time) = (TO_DAYS(NOW())) limit 1");
                    echo "  今天收益率：<span style='color:red;'>" . $badyprob_info["prob"] . "</span><br/>";
                    ?>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
       </body>
</html>

