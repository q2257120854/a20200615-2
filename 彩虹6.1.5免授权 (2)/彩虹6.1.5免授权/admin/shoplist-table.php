<?php
/**
 * 商品管理
 **/
include '../includes/common.php';
if ($islogin != 1) {
    exit('<script>window.location.href="./login.php";</script>');
}
function display_shoptype($type)
{
    if ($type == 1 || $type == 2)
        return '<span class="btn-warning btn-xs">对接</span>';
    elseif ($type == 4)
        return '<span class="btn-success btn-xs">发卡</span>';
    else
        return '<span class="btn-info btn-xs">自营</span>';
}

$rs            = $DB->select('class', ['cid', 'name'], ['active' => 1, 'ORDER' => ['sort' => 'ASC']]);
$select        = '<option value="0">未分类</option>';
$shua_class[0] = '未分类';
foreach ($rs as $res) {
    $shua_class[$res['cid']] = $res['name'];
    $select                  .= '<option value="' . $res['cid'] . '">' . $res['name'] . '</option>';
}
if ($_SESSION['price_class']) {
    $price_class = $_SESSION['price_class'];
} else {
    $rs             = $DB->select('price', ['id', 'name'], ['ORDER' => ['id' => 'ASC']]);
    $price_class[0] = '不加价';
    foreach ($rs as $res) {
        $price_class[$res['id']] = $res['name'];
    }
}

$where = [];

if (isset($_GET['kw'])) {
    $kw      = trim(daddslashes($_GET['kw']));
    $where   = ['name[~]' => $kw];
    $numrows = $DB->count('tools', $where);
    $con     = '包含 <b>' . $kw . '</b> 的共有 <b>' . $numrows . '</b> 个商品';
    $link    = '&kw=' . urlencode($kw);
} elseif (isset($_GET['cid'])) {
    $cid     = intval($_GET['cid']);
    $where   = ['cid' => $cid];
    $numrows = $DB->count('tools', $where);
    $con     = '分类 <a href="../?cid=' . $cid . '" target="_blank">' . $shua_class[$cid] . '</a> 共有 <b>' . $numrows . '</b> 个商品';
    $link    = '&cid=' . $cid;
} elseif (isset($_GET['prid'])) {
    $prid    = intval($_GET['prid']);
    $where   = ['prid' => $prid];
    $numrows = $DB->count('tools', $where);
    $con     = '加价模板 ' . $price_class[$prid] . ' 共有 <b>' . $numrows . '</b> 个商品';
    $link    = '&prid=' . $prid;
} else {
    $numrows = $DB->count('tools', $where);
    $con     = '系统共有 <b>' . $numrows . '</b> 个商品';
}
?>
<form name="form1" id="form1">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>商品名称</th>
                <th>商品价格设置</th>
                <th>商品类型</th>
                <th class="<?php echo isset($_GET['cid']) ? '' : 'hide'; ?>">排序操作</th>
                <th>状态</th>
                <th>操作</th>
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

            $rs = $DB->select('tools', '*', $where);
            foreach ($rs as $res) {
                echo '<tr><td><input type="checkbox" name="checkbox[]" value="' . $res['tid'] . '">&nbsp;<a class="product-name" href="javascript:show(' . $res['tid'] . ')" style="color:#000">' . $res['name'] . '</a></td>' . ($res['prid'] > 0 ? '<td><span onclick="getPrice(' . $res['tid'] . ')"><font color="blue">' . $price_class[$res['prid']] . '</font>&nbsp;(成本:' . $res['price'] . ')</span></td>' : '<td><span onclick="getPrice(' . $res['tid'] . ')">' . $res['price'] . '｜' . $res['cost'] . '｜' . $res['cost2'] . '</span></td>') . '<td>' . display_shoptype($res['is_curl']) . '
</td><td class="' . (isset($_GET['cid']) ? '' : 'hide') . '"><a class="btn btn-xs sort_btn" title="移到顶部" onclick="sort(' . $res['cid'] . ',' . $res['tid'] . ',0)"><i class="fa fa-long-arrow-up"></i></a><a class="btn btn-xs sort_btn" title="移到上一行" onclick="sort(' . $res['cid'] . ',' . $res['tid'] . ',1)"><i class="fa fa-chevron-circle-up"></i></a><a class="btn btn-xs sort_btn" title="移到下一行" onclick="sort(' . $res['cid'] . ',' . $res['tid'] . ',2)"><i class="fa fa-chevron-circle-down"></i></a><a class="btn btn-xs sort_btn" title="移到底部" onclick="sort(' . $res['cid'] . ',' . $res['tid'] . ',3)"><i class="fa fa-long-arrow-down"></i></a></td>
<td>' . ($res['close'] == 1 ? '<span class="btn btn-xs btn-warning" onclick="setClose(' . $res['tid'] . ',0)">已下架</span>' : '<span class="btn btn-xs btn-success" onclick="setClose(' . $res['tid'] . ',1)">上架中</span>') . '&nbsp;' . ($res['active'] == 1 ? '<span class="btn btn-xs btn-success" onclick="setActive(' . $res['tid'] . ',0)">显示</span>' : '<span class="btn btn-xs btn-warning" onclick="setActive(' . $res['tid'] . ',1)">隐藏</span>') . '</td><td><a href="./shopedit.php?my=edit&cid=' . filterParam($_GET['cid'], '') . '&tid=' . $res['tid'] . '&page=' . filterParam($_GET['page'], 1) . '" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="./orderList.php?tid=' . $res['tid'] . '" class="btn btn-warning btn-xs">订单</a>&nbsp;<span href="./shopedit.php?my=delete&tid=' . $res['tid'] . '" class="btn btn-xs btn-danger" onclick="delTool(' . $res['tid'] . ')">删除</span>&nbsp;<span href="./shopedit.php?my=delete&tid=' . $res['tid'] . '" class="btn btn-xs btn-success" onclick="addInvite(' . $res['tid'] . ')">添加到推广</span></td></tr>
';
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="bottom-action form-group">
                <input type="hidden" name="prid"/>
                <input name="chkAll1" type="checkbox" id="chkAll1" onclick="selectAll(this);"
                       value="checkbox">&nbsp;全选&nbsp;
                <select class="form-control" style="display: inline;width: auto;" name="aid">
                    <option selected>批量操作</option>
                    <option value="10">&gt;改加价模板</option>
                    <option value="1">&gt;改为显示</option>
                    <option value="2">&gt;改为隐藏</option>
                    <option value="3">&gt;改为上架中</option>
                    <option value="4">&gt;改为已下架</option>
                    <option value="5">&gt;删除选中</option>
                    <option value="6">&gt;复制选中</option>
                </select>
                <button type="button" class="btn btn-sm btn-primary" onclick="change()">执行</button>&nbsp;&nbsp;
                <select class="form-control" style="display: inline;width: auto;" name="cid">
                    <option selected>将选定商品移动到分类</option><?php echo $select ?></select>
                <button type="button" class="btn btn-sm btn-primary" onclick="move()">确定移动</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="dataTables_paginate paging_simple_numbers" style="text-align: left;">
                <ul class="pagination">
                    <?php
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
                    ?>
                </ul>
            </div>
        </div>
    </div>
</form>
<script>
    $("#blocktitle").html('<?php echo $con?>');
</script>