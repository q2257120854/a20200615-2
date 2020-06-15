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
            //全选
            function CheckAll() {
                $("#dataTab :checkbox").attr({checked: $("#chkAll").attr("checked") == undefined ? false : true})
            }

            //选中
            function deleteSelected() {
                var arr = '';
                $("#dataTab").find("input[type='checkbox']:gt(0):checked").each(function() {
                    arr = arr + $(this).val() + ',';
                });
                if (arr.length > 0) {
                    if (confirm("确认重新设置权限吗？")) {
                        $("#submitForm").attr("action", "<?php echo SITE_URL ?>houtai/role/permission/id/" + <?php echo $role_info['id']; ?> + "/ids/" + arr.substr(0, arr.length - 1)).submit();
                    }
                } else {
                    alert("对不起，您没有选中要保存的信息");
                }
            }

            $(document).ready(function() {
                $("#cancelbutton").click(function() {
                    window.parent.$.fancybox.close();
                });
                var result = '<?php
if (empty($result)) {
    echo null;
} else {
    echo $result;
}
?>';
                if (result == 'success') {
                    window.parent.$.fancybox.close();
                }
            });
        </script>
        <style>
            .alt td{ background:black !important;}
        </style>
    </head>
    <?php $this->layout = false; ?>
    <body>
        <?php $form = $this->beginWidget('CActiveForm', array('id' => 'submitForm')); ?>
        <div id="container">
            <div id="page_close">
                <a href="javascript:parent.$.fancybox.close();">
                    <img src="<?php echo IMG_URL?>common/page_close.png" width="20" height="20" style="vertical-align: text-top;"/>
                </a>
            </div>
            <?php echo $role_info['name']; ?>
            <div class="ui_content">
                <div class="ui_tb">
                    <table class="table" cellspacing="0" cellpadding="0" width="100%" align="center" border="0" id="dataTab">
                        <tr>
                            <th width="30">
                                <input type="checkbox" name='chkAll' id='chkAll' onclick='CheckAll()'/>
                            </th>
                            <th>菜单</th>
                        </tr>
                        <?php
                        foreach ($menu_info as $menu) {
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status = 0;
                                    foreach ($rolemenu_info as $rolemenu) {
                                        if ($menu['id'] == $rolemenu['menu_id']) {
                                            if ($rolemenu['role_id'] == $role_info['id']) {
                                                $status = 1;
                                                ?>
                                                <input type="checkbox" checked="checked" class="acb" value="<?php echo $menu['id']; ?>"  name="check"/>
                                                <?php
                                                break;
                                            }
                                        }
                                    }
                                    if ($status == 0) {
                                        ?>
                                        <input type="checkbox"  class="acb" value="<?php echo $menu['id']; ?>"  name="check"/>
                                    <?php } ?>
                                </td>
                                <td><?php echo $menu['name']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
            <div class="ui_content">
                <div class="ui_text_indent">
                    <div id="box_border">
                        <div id="box_bottom1">
                            <input type="button" value="保存" class="ui_input_btn01" onclick="deleteSelected();" /> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
        
    </body>
</html>
