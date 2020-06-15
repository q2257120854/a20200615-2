<?php
include_once '../includes/common.php';
$title = '发卡库存管理';
include_once './head.php';

if ($islogin != 1) {
    exit("<script>window.location.href='./login.php';</script>");
}

$act = $_GET['my'];

if ($act == 'move') {
    $selectList = $_POST['checkbox'];
    $type       = intval($_POST['cid']);
    if (empty($type))
        exit('<script>alert("操作类型异常");history.go(-1);</script>');
    if (empty($selectList) || !is_array($selectList))
        exit('<script>alert("请求信息不能为空");history.go(-1);</script>');

    foreach ($selectList as $content) {
        if ($type == -3) {
            $DB->delete('faka', ['tid' => $content]);
            $DB->delete('tools', ['tid' => $content]);
            //删除
        } else if ($type == -1 || $type == -2) {
            $active = $type == -2 ? 0 : 1;
            $DB->update('tools', ['active' => $active], ['tid' => $content]);
            //上下架商品
        } else {
            break;
        }
    }
    exit('<script>history.go(-1);</script>');
}

echo '<div class="col-md-12 center-block" style="float: none;">';

?>
<div class="block">
    <div class="block-title clearfix">
        <form action="fakalist.php" method="GET" class="form-inline">
            <div class="form-group">
                <select name="cid" class="form-control" default="">
                    <?php
                    $rs     = $DB->select('class', ['cid', 'name'], ['active' => 1, 'ORDER' => ['sort' => 'ASC']]);
                    $select = '<option value="0">请选择分类</option>';
                    foreach ($rs as $res) {
                        $select .= '<option value="' . $res['cid'] . '">' . $res['name'] . '</option>';
                    }
                    echo $select;
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">进入分类</button>&nbsp;
        </form>
    </div>

    <form name="form1" method="post" action="fakalist.php?my=move">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>商品名称</th>
                    <th>剩余卡密</th>
                    <th>已售出</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $limit      = 30;
                $page       = intval($_GET['page']);
                $categoryID = intval($_GET['cid']);
                if (empty($categoryID))
                    $categoryID = 0;
                if (empty($page))
                    $page = 1;

                $whereSql = ' ';
                if (!empty($categoryID))
                    $whereSql = ' AND `st`.`cid` = ' . $categoryID . ' ';
                $pages = ceil($DB->query('SELECT COUNT(`tid`) AS totalRow FROM `'.$dbconfig['dbqz'].'_tools` WHERE `is_curl` = 4' . $whereSql)->fetch(PDO::FETCH_ASSOC)['totalRow'] / $limit);

                $res1 = $DB->query('SELECT `st`.`tid`,`st`.`name`,`st`.`active`,COUNT( `sf`.`orderid`) AS totalCard,COUNT(`sf`.`orderid` <> 0 OR NULL) AS totalUseCard FROM `'.$dbconfig['dbqz'].'_tools` AS `st` LEFT JOIN `'.$dbconfig['dbqz'].'_faka` sf ON `st`.`tid` = sf.tid WHERE `st`.`is_curl` = 4' . $whereSql . 'GROUP BY `st`.`tid` ORDER BY `st`.`tid` DESC LIMIT ' . (($page - 1) * $limit) . ',' . $limit)->fetchAll();
                foreach ($res1 as $k => $v) {
                    ?>
                    <tr>
                        <td><input type="checkbox" name="checkbox[]" id="list1" value="<?php echo $v['tid']; ?>"
                                   onClick="unselectall1()"><b><?php echo $v['tid']; ?></b></td>
                        <td><?php echo $v['name']; ?></td>
                        <td><?php echo $v['totalCard'] - $v['totalUseCard']; ?></td>
                        <td><?php echo $v['totalUseCard']; ?></td>
                        <td>
                            <span class="btn btn-xs btn-<?php echo $v['active'] ? 'success' : 'danger'; ?>"
                                  onclick="setActive(<?php echo $v['tid']; ?>,<?php echo $v['active'] ? '0' : '1'; ?>)">
                              <?php echo $v['active'] ? '上架中' : '已下架'; ?>
                            </span>
                        </td>
                        <td><a href="./fakakms.php?tid=<?php echo $v['tid']; ?>" class="btn btn-info btn-xs">查看卡密</a>&nbsp;<a
                                    href="./fakakms.php?my=add&tid=<?php echo $v['tid']; ?>"
                                    class="btn btn-success btn-xs">加卡</a>&nbsp;<a
                                    href="./orderList.php?tid=<?php echo $v['tid']; ?>"
                                    class="btn btn-warning btn-xs">订单</a>&nbsp;<a
                                    href="./shopedit.php?my=delete&tid=<?php echo $v['tid']; ?>"
                                    class="btn btn-xs btn-danger"
                                    onclick="return confirm('你确实要删除此商品吗？');">删除</a></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <input name="chkAll1" type="checkbox" id="chkAll1" onClick="this.value=check1(this.form.list1)"
                   value="checkbox">&nbsp;全选&nbsp;
            <select class="form-control" style="width: auto;display: inline;" name="cid">
                <option selected>批量操作</option>
                <option value="-1">&gt;改为上架中</option>
                <option value="-2">&gt;改为已下架</option>
                <option value="-3">&gt;删除选中</option>
            </select>
            <input class="btn btn-sm btn-primary" style="margin-top: -5px;height: 30px;" type="submit" name="Submit"
                   value="确定">
        </div>
    </form>

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

        function setActive(tid, active) {
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=setTools&tid=' + tid + '&active=' + active,
                dataType: 'json',
                success: function (data) {
                    window.location.reload();
                },
                error: function (data) {
                    layer.msg('服务器错误');
                    return false;
                }
            });
        }

        function sort(cid, tid, sort) {
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=setToolSort&cid=' + cid + '&tid=' + tid + '&sort=' + sort,
                dataType: 'json',
                success: function (data) {
                    window.location.reload();
                },
                error: function (data) {
                    layer.msg('服务器错误');
                    return false;
                }
            });
        }

        var items = $("select[default]");
        for (i = 0; i < items.length; i++) {
            $(items[i]).val($(items[i]).attr("default") || 0);
        }
    </script>

    <?php
    echo '<ul class="pagination">';
    $first = 1;
    $prev  = $page - 1;
    $next  = $page + 1;
    $last  = $pages;
    $link  = '&cid=' . $_GET['cid'];
    if ($page > 1) {
        echo '<li><a href="./fakalist.php?page=' . $link . '">首页</a></li>';
        echo '<li><a href="./fakalist.php?page=' . $prev . $link . ')">&laquo;</a></li>';
    } else {
        echo '<li class="disabled"><a>首页</a></li>';
        echo '<li class="disabled"><a>&laquo;</a></li>';
    }
    $start = $page - 10 > 1 ? $page - 10 : 1;
    $end   = $page + 10 < $pages ? $page + 10 : $pages;
    for ($i = $start; $i < $page; $i++)
        echo '<li><a href="./fakalist.php?page=' . $i . $link . '">' . $i . '</a></li>';
    echo '<li class="disabled"><a>' . $page . '</a></li>';
    for ($i = $page + 1; $i <= $end; $i++)
        echo '<li><a href="./fakalist.php?page=' . $i . $link . '">' . $i . '</a></li>';
    if ($page < $pages) {
        echo '<li><a href="./fakalist.php?page=' . $next . $link . '">&raquo;</a></li>';
        echo '<li><a href="./fakalist.php?page=' . $last . $link . '">尾页</a></li>';
    } else {
        echo '<li class="disabled"><a>&raquo;</a></li>';
        echo '<li class="disabled"><a>尾页</a></li>';
    }
    echo '</ul>';
    ?>
</div>
<?php
include_once 'footer.php';
?>
