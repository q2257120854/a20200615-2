<?php
include("../includes/common.php");
if ($islogin != 1)
    exit("<script>window.location.href='./login.php';</script>");

$where = [];
if (isset($_GET['zid'])) {
    $power = $DB->get('site', ['power'], ['zid' => $_GET['zid'], 'LIMIT' => 1]);
    if ($power && $power['power'] == 0)
        exit("<script>top.location.href='./userlist.php?zid={$_GET['zid']}';</script>");
    $where = [
        'AND' => [
            'zid'      => $_GET['zid'],
            'power[>]' => 0
        ]
    ];
} elseif (isset($_GET['power'])) {
    $where = [
        'AND' => [
            'power' => $_GET['power']
        ]
    ];
    $link  = '&power=' . $_GET['power'];
} elseif (isset($_GET['kw'])) {
    $where = [
        'AND' => [
            'power[>]' => 0,
            'OR'       => [
                'user'   => $_GET['kw'],
                'domain' => $_GET['kw'],
                'qq'     => $_GET['kw']
            ]
        ]
    ];
    $link  = '&kw=' . $_GET['kw'];
} else {
    $where = [
        'power[>]' => 0
    ];
}
$numrows = $DB->count('site', $where);
?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ZID</th>
                <th>类型</th>
                <th>用户名</th>
                <th>站点名称/站长QQ</th>
                <th>余额</th>
                <th>开通/到期时间</th>
                <th>绑定域名</th>
                <th>状态</th>
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
            if (isset($_GET['sort'])) {
                if ($_GET['sort'] == 1) {
                    $where['ORDER']['rmb'] = 'DESC';
                    $link .= '&sort=' . $_GET['sort'];
                } else if ($_GET['sort'] == 0) {
                    $where['ORDER']['rmb'] = 'ASC';
                    $link .= '&sort=' . $_GET['sort'];
                }
            }
            $where['ORDER']['zid'] = 'DESC';

            $rs = $DB->select('site', '*', $where);

            foreach ($rs as $res) {
                $res['sitename'] = htmlspecialchars($res['sitename']);

                echo '<tr><td><b>' . $res['zid'] . '</b></td><td><span onclick="setSuper(' . $res['zid'] . ')" title="修改站点类型" class="btn btn-default btn-xs">' . ($res['power'] == 2 ? '<font color=red>专业版</font>' : '<font color=blue>普及版</font>') . '</span></td><td>' . $res['user'] . '</td><td>' . $res['sitename'] . '<br/>' . $res['qq'] . '</td><td><a href="javascript:showRecharge(' . $res['zid'] . ')" title="点击充值">' . $res['rmb'] . '</a></td><td>' . $res['addtime'] . '<br/><a href="javascript:setEndtime(' . $res['zid'] . ')" title="点击续期">' . $res['endtime'] . '</a></td><td>' . $res['domain'] . '<br/>' . $res['domain2'] . '</td><td>' . ($res['status'] == 1 ? '<span class="btn btn-xs btn-success" onclick="setActive(' . $res['zid'] . ',0)">开启</span>' : '<span class="btn btn-xs btn-warning" onclick="setActive(' . $res['zid'] . ',1)">关闭</span>') . '</td><td><a href="./sitelist.php?my=edit&zid=' . $res['zid'] . '" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="./orderList.php?zid=' . $res['zid'] . '" class="btn btn-warning btn-xs">订单</a>&nbsp;<a href="./record.php?zid=' . $res['zid'] . '" class="btn btn-success btn-xs">明细</a>&nbsp;<a href="./sitelist.php?my=delete&zid=' . $res['zid'] . '" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除此站点吗？\');">删除</a></td></tr>';
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