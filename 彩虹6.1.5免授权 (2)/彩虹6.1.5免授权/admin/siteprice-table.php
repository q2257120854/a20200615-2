<?php
/**
 * 商品管理
 **/
include("../includes/common.php");
if ($islogin != 1)
    exit("<script>window.location.href='./login.php';</script>");

$zid = intval($_GET['zid']);

$price_obj = new Price($zid);


$where = [];

if (isset($_GET['kw'])) {
    $kw = trim(daddslashes($_GET['kw']));

    $where = ['name[~]' => $kw];

    $numrows = $DB->count('tools', $where);
    $con     = '包含 <b>' . $kw . '</b> 的共有 <b>' . $numrows . '</b> 个商品';
    $link    = '&kw=' . urlencode($kw);
} elseif (isset($_GET['cid'])) {
    $rs            = $DB->select('class', ['cid', 'name'], ['active' => 1, 'ORDER' => ['sort' => 'ASC']]);
    $select        = '<option value="0">未分类</option>';
    $shua_class[0] = '未分类';
    foreach ($rs as $res) {
        $shua_class[$res['cid']] = $res['name'];
        $select                  .= '<option value="' . $res['cid'] . '">' . $res['name'] . '</option>';
    }
    $cid     = intval($_GET['cid']);
    $numrows = $DB->count('tools', ['cid' => $cid]);

    $where = ['cid' => $cid];

    $con  = '分类 <a href="../?cid=' . $cid . '" target="_blank">' . $shua_class[$cid] . '</a> 共有 <b>' . $numrows . '</b> 个商品';
    $link = '&cid=' . $cid;
} else {
    $numrows = $DB->count('tools', []);

    $where = ['zid' => 1];

    $con  = '系统共有 <b>' . $numrows . '</b> 个商品';
    $link = '&zid=' . $zid;
}
?>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>商品名称</th>
            <th>当前分站成本价</th>
            <th>自定义密价</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $pagesize = isset($_GET['num']) ? intval($_GET['num']) : 30;
        $pages    = ceil($numrows / $pagesize);
        $page     = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset   = $pagesize * ($page - 1);

        $where['ORDER'] = ['sort' => 'ASC'];
        $where['LIMIT'] = [$offset, $pagesize];
        $rs             = $DB->select('tools', '*', $where);

        foreach ($rs as $res) {
            $price_obj->setToolInfo($res['tid'], $res);

            if ($price_obj->getPower() == 2)
                $price = $price_obj->getToolCost2($res['tid']);
            else
                $price = $price_obj->getToolCost($res['tid']);

            $iprice = $price_obj->getTooliPrice($res['tid']);
            echo '<tr><td>' . $res['name'] . '</td><td>' . $price . ' 元</td><td><a title="设置密价" href="javascript:setPrice(' . $res['tid'] . ',\'' . $iprice . '\')">' . ($iprice > 0 ? '<font color="blue">' . $iprice . ' 元</font>' : '<font color="green">点击设置</font>') . '</a></td></tr>';
        }
        ?>
        </tbody>
    </table>
</div>
<?php
echo '<ul class="pagination">';
$first = 1;
$prev  = $page - 1;
$next  = $page + 1;
$last  = $pages;
if ($page > 1) {
    echo '<li><a href="javascript:void(0)" onclick="listTable(\'page=' . $first . $link . '\')">首页</a></li>';
    echo '<li><a href="javascript:void(0)" onclick="listTable(\'page=' . $prev . $link . '\')">&laquo;</a></li>';
} else {
    echo '<li class="disabled"><a>首页</a></li>';
    echo '<li class="disabled"><a>&laquo;</a></li>';
}
$start = $page - 10 > 1 ? $page - 10 : 1;
$end   = $page + 10 < $pages ? $page + 10 : $pages;
for ($i = $start; $i < $page; $i++)
    echo '<li><a href="javascript:void(0)" onclick="listTable(\'page=' . $i . $link . '\')">' . $i . '</a></li>';
echo '<li class="disabled"><a>' . $page . '</a></li>';
for ($i = $page + 1; $i <= $end; $i++)
    echo '<li><a href="javascript:void(0)" onclick="listTable(\'page=' . $i . $link . '\')">' . $i . '</a></li>';
if ($page < $pages) {
    echo '<li><a href="javascript:void(0)" onclick="listTable(\'page=' . $next . $link . '\')">&raquo;</a></li>';
    echo '<li><a href="javascript:void(0)" onclick="listTable(\'page=' . $last . $link . '\')">尾页</a></li>';
} else {
    echo '<li class="disabled"><a>&raquo;</a></li>';
    echo '<li class="disabled"><a>尾页</a></li>';
}
echo '</ul>';
?>
<script>
    $("#blocktitle").html('<?php echo $con?>');
</script>