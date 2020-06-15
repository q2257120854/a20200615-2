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
                        window.location.href = '<?php echo SITE_URL ?>houtai/tx/show';
                    }
                });
            });

            /** 模糊查询来电用户  **/
            function search(name) {
                $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/tx/show").submit();
            }


            function exports() {
                var row =<?php echo intval($pages->itemCount); ?>;
                if (row != 0) {
                    document.getElementById('submitForm').action = '<?php echo SITE_URL ?>houtai/tx/export';
                    document.getElementById("submitForm").submit();
                } else {
                    alert("没有数据,不能导出！");
                }
            }


            /** 同意拨款 **/
            function agree(fyID) {
                if (fyID == '')
                    return;
                if (confirm("您确定同意打款吗？")) {
                    $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/tx/agree/id/" + fyID).submit();
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
                        $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/tx/alldel/ids/" + arr.substr(0, arr.length - 1)).submit();
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
                            收款人&nbsp;&nbsp;<input type="text" id="name" name="name" class="ui_input_txt02" value="<?php echo $pages->params['name']; ?>"/>
                            状态&nbsp;&nbsp;
                            <select name="starts" id="starts" class="ui_select01">
                                <option value="">--请选择--</option>
                                <option value="未处理" <?php
                                if ($pages->params['starts'] == "未处理") {
                                    echo "selected='selected'}";
                                }
                                ?>>未处理</option>
                                <option value="已处理" <?php
                                if ($pages->params['starts'] == "已处理") {
                                    echo "selected='selected'}";
                                }
                                ?>>已处理</option>
                                <option value="已拒绝" <?php
                                if ($pages->params['starts'] == "已拒绝") {
                                    echo "selected='selected'}";
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
                            <input type="button" value="导出" class="ui_input_btn01" onclick="exports();" /> 
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
                            <th>创建时间</th>
                            <th>处理时间</th>
                            <th>会员id</th>
                            <th>收款人</th>
                            <th>收款方式</th>
                            <th>收款账号</th>
                            <th>提现金额</th>
                            <th>手续费</th>
                            <th>提现次数</th>
                            <th>奖励</th>
                            <th>实付金额</th>
                            <th>状态</th>
                            <th>备注</th>
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
                                <td><?php echo $model['cl_time']; ?></td>
                                <td><?php echo $model['mem_id']; ?></td>
                                <td><?php echo $model['name']; ?></td>
                                <td>
                                    <?php echo $model['way']; ?>
                                </td>
                                <td><a href ="<?php echo SITE_URL . 'houtai/tx/detail/memid/' . $model['mem_id']; ?>"><?php echo "<span style='color:red'>" . $model['account'] . "<span>"; ?></a></td>
                                <td><?php echo $model['applymoney']; ?></td>
                                <td><?php echo $model['fee']; ?></td>
                                <td><?php
                                    if ($model['txnum'] == 1) {
                                        echo "<span style='color:green'>首次提现<span>";
                                    } else {
                                        echo "<span style='color:red'>" . $model['txnum'] . "次提现<span>";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $model['rewards']; ?></td>
                                <td><?php echo $model['money']; ?></td>
                                <td><?php
                                    if ($model['starts'] == "已支付") {
                                        echo "<span style='color:green'>已支付</span>";
                                    } else if ($model['starts'] == "已拒绝") {
                                        echo "<span style='color:red'>已拒绝</span>";
                                    } else {
                                        echo $model['starts'];
                                    }
                                    ?></td>
                                <td><?php echo $model['remark']; ?></td>
                                <td>
                                    <?php if ($model['starts'] == "待支付") { ?>
                                        <a href="javascript:agree('<?php echo $model['id']; ?>');" >同意打款</a> 
                                        <a href="<?php echo SITE_URL ?>houtai/tx/refuse/id/<?php echo $model['id']; ?>" class="edit" >拒绝打款</a> 
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
                    $tx_model = Tx::model();
                    $hlb_model = Hlb::model();
                    $hld_model = Hld::model();
                    $summoney = $tx_model->countBySql("select sum(money) from {{tx}}");
                    echo "  新平台支付总金额：<span style='color:red;'>" . number_format(intval($summoney)) . "&nbsp;元</span>&nbsp;&nbsp;&nbsp;&nbsp;老平台支付：<span style='color:red;'>0&nbsp;元</span>,&nbsp;&nbsp;&nbsp;总计支付：<span style='color:red;'>" . number_format(intval($summoney + 0)) . "&nbsp;元</span><br/>";

                    $sumapply = $tx_model->countBySql("select count(*) from {{tx}} where starts='待支付'");
                    echo "  未处理的申请：<span style='color:red;'>" . number_format(intval($sumapply)) . "</span>&nbsp;笔<br/>";

                    $paymoney = $tx_model->countBySql("select sum(money) from {{tx}} where starts='待支付'");
                    echo "  还需支付金额：<span style='color:red;'>" . number_format(intval($paymoney)) . "</span> &nbsp;元<br/>";

                    $txhlb = $hlb_model->countBySql("select sum(hlb) from {{hlb}} ");
                    echo "  未提现的元宝：<span style='color:red;'>" . number_format(intval($txhlb)) . "</span>&nbsp;&nbsp;折合人民币：". number_format(intval($txhlb/10000))."元<br/>";

                    $txhld = $hld_model->countBySql("select sum(hld) from {{hld}} ");
                    echo "  未提现的金豆：<span style='color:red;'>" . number_format(intval($txhld)) . "</span>&nbsp;&nbsp;折合人民币：". number_format(intval($txhld/10000))."元<br/>";
                    ?>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
        
    </body>
</html>

