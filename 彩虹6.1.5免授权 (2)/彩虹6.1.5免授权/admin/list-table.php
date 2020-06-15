<?php
/**
 * 订单列表
 **/
include '../includes/common.php';
if ($islogin != 1) {
    exit('<script>window.location.href=\'./login.php\';</script>');
}
function display_zt($zt, $id = 0)
{
    if ($zt == 1)
        return '<a onclick="setResult(' . $id . ',\'订单结果\')" title="点此填写结果"><span class="text-success">已完成</span></a>';
    elseif ($zt == 2)
        return '<span class="text-warning">正在处理</span>';
    elseif ($zt == 3)
        return '<a onclick="setResult(' . $id . ')" title="点此填写异常原因"><span class="text-danger">异常</span></a>';
    elseif ($zt == 4)
        return '<span class="text-muted">已退单</span>';
    else
        return '<span class="text-primary">待处理</span>';
}

/**
 * @param $zt // 1 成功 2 失败 3 已发卡 4 未发卡 其他未对接
 * @param int $id
 * @return string
 */
function display_djzt($zt, $id = 0)
{
    if ($zt == 1)
        return '<span onclick="showStatus(' . $id . ')" title="查看订单进度" class="btn btn-success btn-xs">成功</span>';
    elseif ($zt == 2)
        return '<span onclick="djOrder(' . $id . ')" title="点击重试" class="btn btn-danger btn-xs">失败</span>';
    elseif ($zt == 3)
        return '<a onclick="window.open(\'fakakms.php?orderid=' . $id . '\')" title="查看卡密信息"><span class="text-success">已发卡</font></a>';
    elseif ($zt == 4)
        return '<span onclick="djOrder(' . $id . ')" title="点击重试" class="btn btn-danger btn-xs">未发卡</span>';
    elseif ($zt == 5)
        return '<span class="btn btn-danger btn-xs">自带业务</span>';
    else
        return '<span class="text-muted">未对接</span>';
}

$rs = $DB->select('tools', ['tid', 'name'], ['ORDER' => ['sort' => 'ASC']]);

$select = '';

foreach ($rs as $res) {
    $shua_func[$res['tid']] = $res['name'];
    $select                 .= '<option value="' . $res['tid'] . '">' . $res['name'] . '</option>';
}

$where = [];

if (isset($_GET['kw']) && !empty($_GET['kw'])) {
    $where   = [
        'OR' => [
            'input'   => $_GET['kw'],
            'id'      => $_GET['kw'],
            'tradeno' => $_GET['kw']
        ]
    ];
    $numrows = $DB->count('orders', $where);
    $con     = '包含 ' . $_GET['kw'] . ' 的共有 <b>' . $numrows . '</b> 个订单';
    $link    = '&kw=' . $_GET['kw'];
} elseif (isset($_GET['id'])) {
    $where   = [
        'id' => $_GET['id']
    ];
    $numrows = $DB->count('orders', $where);
    $con     = '';
    $link    = '&id=' . $_GET['id'];
} elseif (isset($_GET['tid'])) {
    $where   = [
        'tid' => $_GET['tid']
    ];
    $numrows = $DB->count('orders', $where);
    $con     = $shua_func[$_GET['tid']] . ' 共有 <b>' . $numrows . '</b> 个订单';
    $link    = '&tid=' . $_GET['tid'];
} elseif (isset($_GET['zid'])) {
    $where   = [
        'zid' => $_GET['zid']
    ];
    $numrows = $DB->count('orders', $where);
    $con     = '站点ID ' . $_GET['zid'] . ' 共有 <b>' . $numrows . '</b> 个订单';
    $link    = '&zid=' . $_GET['zid'];
} elseif (isset($_GET['uid'])) {
    $where   = [
        'userid' => $_GET['uid']
    ];
    $numrows = $DB->count('orders', $where);
    $con     = '用户ID ' . $_GET['uid'] . ' 共有 <b>' . $numrows . '</b> 个订单';
    $link    = '&uid=' . $_GET['uid'];
} elseif (isset($_GET['type'])) {
    $where   = [
        'status' => $_GET['type']
    ];
    $numrows = $DB->count('orders', $where);
    $con     = '' . display_zt($_GET['type']) . ' 状态的共有 <b>' . $numrows . '</b> 个订单';
    if ($_GET['type'] == 3) $con .= '&nbsp;[<a href="list.php?my=fillall" onclick="return confirm(\'你确定要将所有异常订单改为待处理状态吗？\');">将所有异常订单改为待处理状态</a>]';
    $link = '&type=' . $_GET['type'];
} else {
    $numrows = $DB->count('orders', []);
    $ondate  = $DB->count('orders', ['status' => 1]);
    $ondate2 = $DB->count('orders', ['status' => 2]);
    $con     = '系统共有 <b>' . $numrows . '</b> 个订单，其中已完成的有 <b>' . $ondate . '</b> 个，正在处理的有 <b>' . $ondate2 . '</b> 个。';
}
?>
    <form name="form1" id="form1">
        <div class="table-responsive">
            <?php echo $con ?>
            <table class="table table-striped table-bordered table-vcenter orderList">
                <thead>
                <tr>
                    <th>订单ID</th>
                    <th>商品名称</th>
                    <th>下单数据</th>
                    <th>份数</th>
                    <th>站点ID</th>
                    <th>添加时间</th>
                    <th>对接状态</th>
                    <th>订单状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $pagesize = 30;
                $pages    = ceil($numrows / $pagesize);
                $page     = isset($_GET['page']) ? intval($_GET['page']) : 1;
                $offset   = $pagesize * ($page - 1);

                $where['LIMIT'] = [$offset, $pagesize];
                $where['ORDER'] = [
                    'id' => 'DESC'
                ];

                $rs = $DB->select('orders', '*', $where);

                foreach ($rs as $res): ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="checkbox[]" value="<?php echo $res['id']; ?>">
                            <b><?php echo $res['id']; ?></b>
                        </td>
                        <td>
                            <span onclick="showOrder(<?php echo $res['id']; ?>)" title="点击查看详情">
                                <?php echo $shua_func[$res['tid']]; ?>
                            </span>
                        </td>
                        <td class="wbreak">
                            <span onclick="inputOrder(<?php echo $res['id']; ?>)" title="点击修改数据">
                                <?php echo htmlspecialchars($res['input']); ?>
                                <?php echo $res['input2'] ? '<br/>' . htmlspecialchars($res['input2']) : null; ?>
                                <?php echo $res['input3'] ? '<br/>' . htmlspecialchars($res['input3']) : null; ?>
                                <?php echo $res['input4'] ? '<br/>' . htmlspecialchars($res['input4']) : null; ?>
                                <?php echo $res['input5'] ? '<br/>' . htmlspecialchars($res['input5']) : null; ?>
                            </span>
                        </td>
                        <td><span onclick="inputNum(<?php echo $res['id']; ?>)"
                                  title="点击修改份数"><?php echo $res['value']; ?></span>
                        </td>
                        <td><a href="sitelist.php?zid=<?php echo $res['zid']; ?>"
                               target="_blank"><?php echo $res['zid']; ?></a></span></td>
                        <td><?php echo $res['addtime']; ?></td>
                        <td><?php echo display_djzt($res['djzt'], $res['id']); ?></td>
                        <td><?php echo display_zt($res['status'], $res['id']); ?></td>
                        <td>
                            <select onChange="setStatus(<?php echo $res['id']; ?>,this.value)" class="form-control">
                                <option selected>操作订单</option>
                                <option value="0">待处理</option>
                                <option value="2">正在处理</option>
                                <option value="1">已完成</option>
                                <option value="4">已退单</option>
                                <option value="3">异常</option>
                                <?php if ($res['zid'] > 1 || is_numeric($res['userid'])): ?>
                                    <option value="6">退款</option>
                                <?php endif; ?>
                                <option value="5">删除订单</option>
                            </select></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <label for="chkAll1">&nbsp;</label>
            <input name="chkAll1" type="checkbox" id="chkAll1" onclick="selectAll(this);" value="checkbox">&nbsp;全选&nbsp;
            <label>操作：
                <select class="form-control" style="display: inline;width: auto;" name="status">
                    <option selected>操作订单</option>
                    <option value="0">待处理</option>
                    <option value="2">正在处理</option>
                    <option value="1">已完成</option>
                    <option value="3">异常</option>
                    <option value="5">重新下单</option>
                    <option value="6">订单退款</option>
                    <option value="4">删除订单</option>
                </select>
            </label>
            <button class="btn btn-sm btn-primary" type="button" onclick="operation()">确定</button>
        </div>
    </form>
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
