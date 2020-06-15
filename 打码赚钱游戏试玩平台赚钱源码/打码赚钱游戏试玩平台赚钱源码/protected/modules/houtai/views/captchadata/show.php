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
            /** 模糊查询来电用户  **/
            function search(name) {
                $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/captchadata/show").submit();
            }

            //全选
            function CheckAll() {
                $("#dataTab :checkbox").attr({checked: $("#chkAll").attr("checked") == undefined ? false : true})
            }

            /** 导入**/
            function imports() {
                var batchFile = $("#batchFile").val();
                if (batchFile != "") {
                    $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/captchadata/import").submit();
                } else {
                    alert("请上传打码数据的excel文件");
                }
            }

            //删除选中
            function deleteSelected() {
                var arr = '';
                $("#dataTab").find("input[type='checkbox']:gt(0):checked").each(function() {
                    arr = arr + $(this).val() + ',';
                });
                if (arr.length > 0) {
                    if (confirm("确认删除选中吗？")) {
                        $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/captchadata/alldel/ids/" + arr.substr(0, arr.length - 1)).submit();
                    }
                } else {
                    alert("对不起，您没有选中要删除的信息");
                }
            }

           //更新昨日
            function rank() {
                if (confirm("您确定要更新昨日的打码排行么？")) {
                    $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/captchadata/rank").submit();
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
        <?php
        $form = $this->beginWidget('CActiveForm', array('id' => 'submitForm',
            'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
        ?>
        <div id="container">
            <div class="ui_content">
                <div class="ui_text_indent">
                    <div id="box_border">
                        <div id="box_top">搜索</div>
                        <div id="box_center">
                            打码名称&nbsp;&nbsp;
                            <select name="captcha_id" id="captcha_id" class="ui_select01" onchange="getFyDhListByFyXqCode();">
                                <option value="">--请选择--</option>
                                <?php
                                $captcha_info = Captcha::model()->findAllBySql("select id,name from {{captcha}}");
                                foreach ($captcha_info as $captchainfo) {
                                    if ($captchainfo['id'] == $pages->params['captcha_id']) {
                                        ?>
                                        <option value="<?php echo $captchainfo['id']; ?>"  selected="selected"><?php echo $captchainfo['name']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $captchainfo['id']; ?>"><?php echo $captchainfo['name']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            起始时间：
                            <input type="text"  id="start" name="start" class="ui_input_txt02" value="<?php echo $pages->params['start']; ?>"/>
                            至：
                            <input type="text"  id="end" name="end"  class="ui_input_txt02" value="<?php echo $pages->params['end']; ?>"/>
                        </div>
                        <div id="box_bottom">
                            <input type="button" value="查询" class="ui_input_btn01" onclick="search();" /> 
                            <input type="button" value="删除" class="ui_input_btn01" onclick="deleteSelected();" /> 
                            <input type="button" value="更新昨日排行" class="ui_input_btn01" onclick="rank();" /> 
                        </div>
                        <div>
                            <input name="batchFile" id="batchFile" type= "file"> 
                            <button type="button"  onclick="imports();"  >导入打码数据 </button>
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
                            <th>结算id</th>
                            <th>会员id</th>
                            <th>打码工号</th>
                            <th>打码名称</th>
                            <th>打码数量</th>
                            <th>码值</th>
                            <th>奖励元宝</th>
                            <th>第三方支付佣金</th>
                            <th>数据类型</th>
                            <th>更新类型</th>
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
                                <td><?php echo $model['js_id'] ?></td>
                                <td><?php echo $model['mem_id'] ?></td>
                                <td><?php echo $model['code']; ?></td>
                                <td><?php echo $model['name']; ?></td>
                                <td><?php echo $model['num']; ?></td>
                                <td><?php echo $model['code_val']; ?></td>
                                <td><?php echo $model['rewards_hlb']; ?></td>
                                <td><?php echo $model['dsf_money']; ?></td>
                                <td><?php
                                    if (empty($model['isjldata'])) {
                                        echo "打码数据";
                                    } else {
                                        echo "奖励数据";
                                    }
                                    ?>
                                </td>
                                <td><?php
                                    if ($model['type'] == 1) {
                                        echo "自动";
                                    } else if ($model['type'] == 2) {
                                        echo "手动";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="<?php echo SITE_URL ?>houtai/captchadata/updhlb/id/<?php echo $model['id']; ?>" class="hlb">操币</a> 
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
