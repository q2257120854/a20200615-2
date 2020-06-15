<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>全部消息-个人中心-<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="/" />
        <meta name="description" content="/" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon" />
        <link href="/style/vip/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/vip/inside.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/vip/jQuery.v1.8.3.js"></script>
        <script src="/scripts/vip/public.js"></script>
        <script type="text/javascript">
            window.onload = function() {
                var msg = $('#msg').val();
                if (msg != null) {
                    alert(msg);
                }
            }
            //全选
            function CheckAll() {
                $("#dataTab :checkbox").attr({checked: $("#chkAll").attr("checked") == undefined ? false : true})
            }

            //删除选中
            function deleteSelected() {
                var arr = '';
                $("#dataTab").find("input[type='checkbox']:checked").each(function() {
                    arr = arr + $(this).val() + ',';
                });

                if (arr.length > 0) {
                    if (confirm("确认删除选中吗？")) {
                        $("#submitForm").attr("action", "<?php echo SITE_URL ?>vipmessage/alldel/ids/" + arr.substr(0, arr.length - 1) + "/type/<?php
if (empty($type)) {
    echo "0";
} else {
    echo $type;
}
?>").submit();
                    }
                } else {
                    alert("对不起，您没有选中要删除的信息");
                }
            }

            //选中标记以读
            function readSelected() {
                var arr = '';
                $("#dataTab").find("input[type='checkbox']:checked").each(function() {
                    arr = arr + $(this).val() + ',';
                });

                if (arr.length > 0) {
                    if (confirm("确认选中标记已读吗？")) {
                        $("#submitForm").attr("action", "<?php echo SITE_URL ?>vipmessage/allread/ids/" + arr.substr(0, arr.length - 1) + "/type/<?php
if (empty($type)) {
    echo "0";
} else {
    echo $type;
}
?>").submit();
                    }
                } else {
                    alert("对不起，您没有选中要标记已读的信息");
                }
            }


            //选中标记未读
            function noreadSelected() {
                var arr = '';
                $("#dataTab").find("input[type='checkbox']:checked").each(function() {
                    arr = arr + $(this).val() + ',';
                });
                if (arr.length > 0) {
                    if (confirm("确认选中标记未读吗？")) {
                        $("#submitForm").attr("action", "<?php echo SITE_URL ?>vipmessage/allnoread/ids/" + arr.substr(0, arr.length - 1) + "/type/<?php
if (empty($type)) {
    echo "0";
} else {
    echo $type;
}
?>").submit();
                    }
                } else {
                    alert("对不起，您没有选中要标记未读的信息");
                }
            }


            /** 删除 **/
            function del(fyID) {
                if (fyID == '')
                    return;
                if (confirm("您确定要删除吗？")) {
                    $("#submitForm").attr("action", "<?php echo SITE_URL ?>vipmessage/del/id/" + fyID + "/type/<?php
if (empty($type)) {
    echo "0";
} else {
    echo $type;
}
?>").submit();
                }
            }
        </script>
    </head>
    <body>
        <?php $type = $pages->params['type']; ?>
        <?php
        if (Yii::app()->user->hasFlash('msg')) {
            ?>
            <input type="hidden" value="<?php echo Yii::app()->user->getFlash('msg') ?>" id="msg" />
        <?php } ?>
        <?php $form = $this->beginWidget('CActiveForm', array('id' => 'submitForm')); ?>
        <!--头部-->
        <?php include_once("./protected/views/vipdesign/header.php"); ?>
        <!--主体-->
        <div class="main clearfix">
            <!--导航-->
            <?php include_once("./protected/views/vipdesign/navicat.php"); ?>
            <div class="public_db clearfix">
                <!--左菜单-->
                <div class="menu_left">
                    <ul class="ul_1">
                        <li class="<?php
                        if ($type == 0) {
                            echo "hover";
                        }
                        ?>"><a href="<?php echo SITE_URL ?>vipmessage/show/type/0">系统消息</a></li>
                        <li class="<?php
                        if ($type == 1) {
                            echo "hover";
                        }
                        ?>"><a href="<?php echo SITE_URL ?>vipmessage/show/type/1">官方消息</a></li>
                    </ul>
                </div>
                <!--右内容-->
                <div class="cont prizes">
                    <!--消息-->
                    <div class="news" id="dataTab">
                        <?php if ($type != 1) { ?>
                            <div class="operation clearfix">
                                <div class="xuan choose">
                                    <label>
                                        <input class="quan"  type="checkbox" value="1"  name='chkAll' id='chkAll' onclick='CheckAll()' >
                                            <i>全选</i>
                                    </label>
                                </div>
                                <a href="javascript:" class="xuan delete" onclick="deleteSelected();">删除</a>
                                <div class="xuan mark">
                                    <span class="tex">标记为</span>
                                    <i class="xiala"></i>
                                    <div class="la">
                                        <a href="javascript:readSelected('<?php echo $model['id']; ?>');">已读</a>
                                        <a href="javascript:noreadSelected('<?php echo $model['id']; ?>');">未读</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!--表格-->
                        <div class="severa">
                            <span class="nur">有&nbsp;<i><?php echo $pages->itemCount; ?></i>&nbsp;封未读</span>
                        </div>
                        <table class="table_3" width="100%" border="1" > 
                            <?php
                            foreach ($posts as $model) {
                                ?>
                                <?php if ($type != 1) { ?>
                                    <tr class="<?php
                                    if (empty($model["is_read"])) {
                                        echo "weidu";
                                    } else {
                                        echo "yidu";
                                    }
                                    ?>">
                                        <td width="5%" align="center"><input  type="checkbox"  value="<?php echo $model['id']; ?>"  name="check"/></td>
                                    <?php } else { ?>
                                        <tr>
                                        <?php } ?>
                                        <td class="ico_1" width="3%" align="center"><i class="ico_yd"></i></td>
                                        <?php if ($type != 1) { ?>
                                            <td class="text" width="67%"><a href="<?php echo SITE_URL ?>vipmessage/detail/id/<?php echo $model["id"]; ?>/pid/<?php echo $model["vipmessage_type"]; ?>"><?php echo $model["title"]; ?></a></td>
                                        <?php } else { ?>
                                            <td class="text" width="67%"><a href="<?php echo SITE_URL ?>vipmessage/gfdetail/id/<?php echo $model["id"]; ?>/pid/<?php echo $model["message_type_id"]; ?>"><?php echo $model["title"]; ?></a></td>
                                        <?php } ?>
                                        <td width="9%" align="center">
                                            <?php if ($model["vipmessage_type"] == 1) { ?>
                                                系统消息
                                            <?php } else { ?>
                                                官方消息
                                            <?php } ?>
                                        </td>
                                        <?php if ($type != 1) { ?>
                                            <td width="7%" align="center"><a href="javascript:del('<?php echo $model['id']; ?>');"><em class="ico_sc"></em></a></td>
                                        <?php } ?>
                                        <td class="time" width="9%"><?php echo date("Y-m-d", strtotime($model['create_time'])); ?></td>
                                    </tr>
                                <?php } ?>
                        </table>
                    </div>
                    <br/>
                    <div  style="text-align: center;height: 30px;">
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
            <?php
            if (!empty($ad_info)) {
                foreach ($ad_info as $ad) {
                    ?>
                    <a class="advertising_1" href="<?php echo $ad['url']; ?>">
                        <img src="/uploads/img/ad/<?php echo $ad['img']; ?>">
                    </a>
                    <?php
                }
            }
            ?>
        </div>
        <?php $this->endWidget(); ?>
        <!--底部1-->
        <?php include_once("./protected/views/vipdesign/footer.php"); ?>
        <?php include_once("./protected/views/vipdesign/kefu.php") ?>
    </body>
</html>
