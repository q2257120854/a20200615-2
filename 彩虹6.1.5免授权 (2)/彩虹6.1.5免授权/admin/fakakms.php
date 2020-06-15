<?php
include("../includes/common.php");
$title = '卡密列表';
include './head.php';

if ($islogin != 1)
    exit("<script>window.location.href='./login.php';</script>");

$act = $_GET['my'];
//echo '<div class="row">';
echo '<div class="col-sm-12 col-md-8 col-md-offset-2" style="margin-top: 2rem;">';

function getCardData($requestData, $delimit)
{
    $data = explode($delimit, $requestData);
    if (count($data) == 0)
        return [$data[0], ''];
    $temp = [];
    foreach ($data as $content) {
        if (!empty($content))
            $temp[] = trim($content);
        if (count($temp) == 2)
            break;
    }
    if (count($temp) != 2)
        $temp[] = '';
    return $temp;
}

if ($act == 'add') {
    $productID   = intval($_GET['tid']);
    $categoryID  = 0;
    $productName = '';
    if (!empty($productID)) {
        $productData = $DB->get('tools', ['cid', 'name'], [
            'AND'   => [
                'tid'     => $productID,
                'is_curl' => 4
            ],
            'LIMIT' => 1
        ]);
        if (!empty($productData)) {
            $categoryID  = $productData['cid'];
            $productName = $productData['name'];
        }
    }
    ?>
    <div class="block">
        <div class="block-title"><h3 class="panel-title">添加卡密</h3></div>
        <div class="">
            <form action="./fakakms.php?my=add_submit" method="POST" onsubmit="return checkAdd()">
                <input type="hidden" name="backurl" value="http://m8g.cn/admin/fakakms.php?my=add">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">选择商品</span>
                        <select id="cid" class="form-control" default="<?php echo $categoryID; ?>">
                            <option value="0">请选择商品分类</option>
                            <?php
                            $rs = $DB->select('class', ['cid', 'name'], ['active' => 1, 'ORDER' => ['sort' => 'ASC']]);
                            foreach ($rs as $res) {
                                $select .= '<option value="' . $res['cid'] . '">' . $res['name'] . '</option>';
                            }
                            echo $select;
                            ?>
                        </select>
                        <select id="tid" name="tid" class="form-control" default="<?php echo $productID; ?>">
                            <?php
                            if (!empty($productName))
                                echo '<option value="' . $productID . '">' . $productName . '</option>';
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">卡密列表</span>
                        <textarea class="form-control" id="kms" name="kms" rows="8" placeholder="一行一张卡"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">分隔符</span>
                        <input type="text" name="split" value="" class="form-control"
                               placeholder="可自定义卡号和密码之间的分隔符，默认留空为空格">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <label>
                                <input id="is_check_repeat" name="is_check_repeat" type="checkbox" value="1">
                                检查重复的卡密
                            </label>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">确认提交</button>
                    <button type="reset" class="btn btn-default btn-block">重新填写</button>
                </div>
            </form>
        </div>
        <div class="panel-footer">
            <span class="glyphicon glyphicon-info-sign"></span>
            注意：卡密格式：卡号+空格+密码，一行一张卡，如：ABCDEFG 123456789<br>
            只有商品设置里面购买成功后的动作选择自动发卡，该商品才会显示在当前列表
        </div>
    </div>
    <a href="./fakalist.php" class="btn btn-default btn-block">&gt;&gt;返回发卡库存列表</a>
    <?php
} else if ($act == 'del') {
    $cardID = intval($_GET['id']);
    if (empty($cardID))
        exit('<script language=\'javascript\'>alert("卡号不能为空");history.go(-1);</script>');
    $DB->query("delete from `{$dbconfig['dbqz']}_faka` where `kid` = '$cardID'");
    exit('<script language=\'javascript\'>history.go(-1);</script>');
} else if ($act == 'qkuse') {
    $productID = intval($_GET['tid']);
    if (empty($productID))
        exit('<script language=\'javascript\'>alert("商品ID不能为空");history.go(-1);</script>');
    $DB->query('delete from `'.$dbconfig['dbqz'].'_faka` where `tid` = ' . $productID . ' and `orderid` <> "0"');
    exit('<script language=\'javascript\'>history.go(-1);</script>');
} else if ($act == 'qk') {
    $productID = intval($_GET['tid']);
    if (empty($productID))
        exit('<script language=\'javascript\'>alert("商品ID不能为空");history.go(-1);</script>');
    $DB->query('delete from `'.$dbconfig['dbqz'].'_faka` where `tid` = ' . $productID);
    exit('<script language=\'javascript\'>history.go(-1);</script>');
} else if ($act == 'add_submit') {
    $isCheckReplace = $_POST['is_check_repeat'] ? true : false;
    $productID      = intval($_POST['tid']);
    $kmList         = trim(daddslashes($_POST['kms']));
    $split          = strval($_POST['split']);

    if (empty($split))
        $split = ' ';

    if (empty($productID))
        showmsg('必须选择商品ID', 3);
    if (empty($kmList))
        showmsg('卡密列表不能为空', 3);

    $createTime  = date('Y-m-d H:i:s', time());
    $insertData  = explode("\n", trim($kmList));
    $insertCount = 0;

    foreach ($insertData as $content) {
        if (empty($content))
            continue;
        $cardData = getCardData($content, $split);
        if ($isCheckReplace) {
            $checkResult = $DB->get('faka', 'kid', ['km' => $cardData[0], 'LIMIT' => 1]);
            if (!empty($checkResult))
                continue;
        }
        $insertResult = $DB->insert('faka', [
            'tid'     => $productID,
            'km'      => $cardData[0],
            'pw'      => $cardData[1],
            'addtime' => $createTime,
            'usetime' => null,
            'orderid' => 0
        ]);
        if ($insertResult->rowCount())
            $insertCount++;
    }

    showmsg('成功添加<b>' . $insertCount . '</b>张卡密<br><br><a href="./fakalist.php">&gt;&gt;返回发卡库存列表</a>', 1);
} else if (!empty($_GET['tid']) || !empty($_GET['orderid'])) {
    $productID = intval($_GET['tid']);
    $orderID   = intval($_GET['orderid']);


    $page = intval($_GET['page']);

    if (empty($productID) && empty($orderID))
        showmsg('商品不存在，请返回上一页重试', 3);
    if (!empty($orderID))
        $sql = 'SELECT `'.$dbconfig['dbqz'].'_tools`.`name`, `'.$dbconfig['dbqz'].'_tools`.`tid` FROM `'.$dbconfig['dbqz'].'_faka` INNER JOIN `'.$dbconfig['dbqz'].'_tools` ON `'.$dbconfig['dbqz'].'_faka`.`tid` = `'.$dbconfig['dbqz'].'_tools`.`tid` WHERE `'.$dbconfig['dbqz'].'_faka`.`orderid` = ' . $orderID . ' LIMIT 1';
    else
        $sql = 'select `name`,`tid` from `'.$dbconfig['dbqz'].'_tools` where `tid` = ' . $productID . ' and `is_curl` = 4 limit 1;';

    $productName = $DB->query($sql)->fetch(PDO::FETCH_ASSOC);
    if (empty($productName))
        showmsg('商品不存在或非发卡商品，请返回上一页重试', 3);

    if (empty($productID))
        $productID = $productName['tid'];
    $productName = $productName['name'];
    if (empty($page) || $page <= 0)
        $page = 1;
    ?>

    <div class="block">
        <div class="block-title">
            <h2><?php echo daddslashes($productName); ?> - 卡密库存列表</h2>
        </div>
        <div class="">
            <a href="?my=add&tid=<?php echo $productID; ?>" class="btn btn-success">加卡</a>
            <a onclick="confirm('确定要清空所有卡密吗？一旦清除将无法恢复')?window.location.href='?my=qk&tid=<?php echo $productID; ?>':''"
               class="btn btn-danger">清空</a>
            <a onclick="confirm('确定要清空所有已使用卡密吗？一旦清除将无法恢复')?window.location.href='?my=qkuse&tid=<?php echo $productID; ?>':''"
               class="btn btn-danger">清空已使用</a>
            <div class="btn-group">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    导出 <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="download.php?act=kms&tid=<?php echo $productID; ?>&use=0">未使用</a></li>
                    <li><a href="download.php?act=kms&tid=<?php echo $productID; ?>&use=1">已使用</a></li>
                    <li><a href="download.php?act=kms&tid=<?php echo $productID; ?>">全部</a></li>
                </ul>
            </div>
            <a href="#" data-toggle="modal" data-target="#search" class="btn btn-primary">搜索</a>
        </div>
        <form name="form1" method="post" action="?my=del2">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>卡号</th>
                        <th>密码</th>
                        <th>状态</th>
                        <th>添加时间</th>
                        <th>使用时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $limit = 30;

                    $searchKeyword = trim(daddslashes($_GET['kw']));
                    $whereSql      = '';
                    if (!empty($searchKeyword))
                        $whereSql .= ' and (`km` = "' . $searchKeyword . '" or `pw` = "' . $searchKeyword . '") ';
                    if (!empty($orderID))
                        $whereSql .= ' and `orderid` = ' . $orderID;
                    $pages  = ceil($DB->query('select count(`kid`) as `totalRow` from `'.$dbconfig['dbqz'].'_faka` where `tid` = ' . $productID . $whereSql)->fetch(PDO::FETCH_ASSOC)['totalRow'] / $limit);
                    $sql    = 'select `kid`,`km`,`pw`,`addtime`,`orderid`,`usetime` from `'.$dbconfig['dbqz'].'_faka` where `tid` = ' . $productID . $whereSql . ' order by `kid` desc ' . ' limit ' . (($page - 1) * $limit) . ',' . $limit;
                    $result = $DB->query($sql)->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $res) {
                        ?>
                        <tr>
                            <td onclick="showkms(this)">
                                <input type="checkbox" name="checkbox[]" id="list1" value="<?php echo $res['kid']; ?>"
                                       onClick="unselectall1()">
                                <b><?php echo $res['km']; ?></b>
                            </td>
                            <td><?php echo $res['pw']; ?></td>
                            <td><?php echo empty($res['orderid']) ? '<span class="text-success">未使用</span>' : ('<span class="text-danger">已使用</span>(' . $res['orderid'] . ')'); ?></td>
                            <td><?php echo $res['addtime']; ?></td>
                            <td><?php echo $res['usetime']; ?></td>
                            <td>
                                <a href="./fakakms.php?my=del&id=<?php echo $res['kid']; ?>"
                                   class="btn btn-xs btn-danger" onclick="return confirm('你确实要删除此卡密吗？');">删除</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <input name="chkAll1" type="checkbox" id="chkAll1" onClick="this.value=check1(this.form.list1)"
                       value="checkbox">&nbsp;全选&nbsp;
                <input type="submit" name="Submit" value="删除选中">
            </div>
        </form>
        <?php
        $link  = '&tid=' . $productID;
        $first = 1;
        $prev  = $page - 1;
        $next  = $page + 1;
        $last  = $pages;

        echo '<ul class="pagination">';
        if ($page > 1) {
            echo '<li><a href="?page=' . $first . $link . '">首页</a></li>';
            echo '<li><a href="?page=' . $prev . $link . '">&laquo;</a></li>';
        } else {
            echo '<li class="disabled"><a>首页</a></li>';
            echo '<li class="disabled"><a>&laquo;</a></li>';
        }
        $start = $page - 10 > 1 ? $page - 10 : 1;
        $end   = $page + 10 < $pages ? $page + 10 : $pages;
        for ($i = $start; $i < $page; $i++)
            echo '<li><a href="?page=' . $i . $link . '">' . $i . '</a></li>';
        echo '<li class="disabled"><a>' . $page . '</a></li>';
        for ($i = $page + 1; $i <= $end; $i++)
            echo '<li><a href="?page=' . $i . $link . '">' . $i . '</a></li>';
        if ($page < $pages) {
            echo '<li><a href="?page=' . $next . $link . '">&raquo;</a></li>';
            echo '<li><a href="?page=' . $last . $link . '">尾页</a></li>';
        } else {
            echo '<li class="disabled"><a>&raquo;</a></li>';
            echo '<li class="disabled"><a>尾页</a></li>';
        }
        echo '</ul>';
        ?>
    </div>
    <div class="modal fade" align="left" id="search" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">搜索卡密</h4>
                </div>
                <div class="modal-body">
                    <form action="fakakms.php" method="GET">
                        <input type="hidden" name="tid" value="<?php echo $productID; ?>"><br>
                        <input type="text" class="form-control" name="kw" placeholder="请输入卡号或密码"><br>
                        <input type="submit" class="btn btn-primary btn-block" value="搜索"></form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php
} else if ($act == 'del2') {
    $kmIdList = $_POST['checkbox'];
    if (empty($kmIdList))
        showmsg('删除ID不能为空', 3);
    $totalDelete = 0;
    foreach ($kmIdList as $value) {
        $value = intval($value);
        if (empty($value))
            continue;
        //check data
        $deleteResult = $DB->delete('faka', ['kid' => $value]);
        $totalDelete  += $deleteResult->rowCount();
    }
    showmsg("已经成功删除 $totalDelete 个卡密", 1);
} else {
    showmsg('未知请求状态', 3);
}
echo '</div>';
?>
<script>
    var checkflag1 = "false";

    function check1(field) {
        if (checkflag1 == "false") {
            for (i = 0; i < field.length; i++) {
                field[i].checked = true;
            }
            checkflag1 = "true";
            return "false";
        } else {
            for (i = 0; i < field.length; i++) {
                field[i].checked = false;
            }
            checkflag1 = "false";
            return "true";
        }
    }

    function unselectall1() {
        if (document.form1.chkAll1.checked) {
            document.form1.chkAll1.checked = document.form1.chkAll1.checked & 0;
            checkflag1 = "false";
        }
    }

    function showkms(obj) {
        $(obj).css("white-space", "normal");
        $(obj).css("word-break", "break-all");
    }

    function checkAdd() {
        if ($("#tid").val() == 0 || $("#tid").val() == null) {
            layer.alert('请先选择商品');
            return false;
        }
        if ($("#kms").val() == '') {
            layer.alert('卡密列表不能为空');
            return false;
        }
    }

    $(document).ready(function () {
        $("#cid").change(function () {
            var cid = $(this).val();
            var ii = layer.load(2, {shade: [0.1, '#fff']});
            $("#tid").empty();
            $("#tid").append('<option value="0">请选择商品</option>');
            $.ajax({
                type: "GET",
                url: "./ajax.php?act=getfakatool&cid=" + cid,
                dataType: 'json',
                success: function (data) {
                    layer.close(ii);
                    if (data.code == 0) {
                        var num = 0;
                        $.each(data.data, function (i, res) {
                            $("#tid").append('<option value="' + res.tid + '">' + res.name + '</option>');
                            num++;
                        });
                        $("#tid").val(0);
                        if (num == 0 && cid != 0) $("#tid").html('<option value="0">该分类下没有发卡类商品</option>');
                    } else {
                        layer.alert(data.msg);
                    }
                },
                error: function (data) {
                    layer.msg('服务器错误');
                    return false;
                }
            });
        });
        var items = $("select[default]");
        for (i = 0; i < items.length; i++) {
            $(items[i]).val($(items[i]).attr("default") || 0);
        }
    });
</script>