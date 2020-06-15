<?php
/**
 * 文章管理
 **/
include("../includes/common.php");
if ($islogin != 1)
    exit("<script language='javascript'>window.location.href='./login.php';</script>");

function getParam($data, $default = '')
{
    if (!empty($data))
        return daddslashes($data);
    return $default;
}

$act = isset($_GET['act']) ? $_GET['act'] : '';
if ($act == 'updateAccount') {
    $type = getParam($_POST['type']);
    $id   = getParam($_POST['id']);

    $username = getParam($_POST['username']);
    $password = getParam($_POST['password']);

    $whiteUrl = getParam($_POST['whiteUrl']);

    if ($type != 'update' && $type != 'add')
        exit('<script>alert("请求类型有误");window.history.back(-1);</script>');

    if ($type == 'update' && empty($id))
        exit('<script>alert("更新账户ID不能为空");window.history.back(-1);</script>');
    if (empty($username))
        exit('<script>alert("用户名不能为空");window.history.back(-1);</script>');
    if (mb_strlen($username) > 128)
        exit('<script>alert("用户名长度不能超过128个字符");window.history.back(-1);</script>');

    if (empty($whiteUrl))
        $whiteUrl = json_encode([]);
    else {
        $whiteUrl = explode(PHP_EOL, $whiteUrl);
        $tempData = [];
        foreach ($whiteUrl as $value) {
            if (!empty($value))
                $tempData[] = trim($value);
        }
        $whiteUrl = json_encode($tempData);
    }

    $createTime = date('Y-m-d H:i:s', time());
    if ($type == 'add') {
        if (strlen($password) < 6)
            exit('<script>alert("密码不能少于6位数");window.history.back(-1);</script>');

        $result = $DB->has('admin_member', [
            'username' => $username,
            'LIMIT'    => 1
        ]);
        if (!empty($result))
            exit('<script>alert("账户名已经存在，请重试");window.history.back(-1);</script>');

        $salt     = substr(md5(time()), 0, 5);
        $password = hash('sha256', hash('sha256', $password) . $salt);

        $sql = $DB->insert('admin_member', [
            'username'   => $username,
            'password'   => $password,
            'salt'       => $salt,
            'whiteUrl'   => $whiteUrl,
            'createTime' => $createTime
        ]);
    } else {
        if (!empty($password) && strlen($password) < 6)
            exit('<script>alert("密码不能少于6位数");window.history.back(-1);</script>');

        if (!empty($password)) {
            $salt     = substr(md5(time()), 0, 5);
            $password = hash('sha256', hash('sha256', $password) . $salt);

            $sql = $DB->update('admin_member', [
                'username' => $username,
                'password' => $password,
                'salt'     => $salt,
                'whiteUrl' => $whiteUrl,
            ], [
                'id' => $id
            ]);
        } else {
            $sql = $DB->update('admin_member', [
                'username' => $username,
                'whiteUrl' => $whiteUrl
            ], [
                'id' => $id
            ]);
        }
    }
    if ($sql->rowCount() > 0)
        exit('<script>alert("更新账户成功");window.location.href = \'./AdminGroup.php?mod=listAdminAccount\';</script>');
    else
        exit('<script>alert("更新账户失败,' . daddslashes($DB->error()) . '");window.history.back(-1);</script>');
}

$title = '未知页面';
switch ($_GET['mod']) {
    case 'addAdminAccount':
        $title = '新增账户';
        break;
    case 'editAdminAccount':
        $title = '编辑账户';
        break;
    case 'listAdminAccount':
        $title = '账户列表';
        break;
}

include './head.php';
//没登录


if ($_GET['mod'] == 'addAdminAccount' || ($_GET['mod'] == 'editAdminAccount' && !empty($_GET['id']))) {
    $id       = getParam($_GET['id'], 0);
    $username = '';
    $whiteUrl = '';
    if ($_GET['mod'] == 'editAdminAccount' && !empty($_GET['id'])) {
        $result = $DB->get('admin_member', ['username', 'whiteUrl'], ['id' => $id]);
        if (!empty($result)) {
            $username = $result['username'];
            $tempData = json_decode($result['whiteUrl'], true);
            foreach ($tempData as $content) {
                $whiteUrl .= $content . PHP_EOL;
            }
        }
    }
    ?>
    <div class="col-md-12 center-block" style="float: none;">
        <div class="block">
            <div class="block-title"><h3 class="panel-title">添加一个用户</h3></div>
            <div class="">
                <form action="./AdminGroup.php?act=updateAccount" method="POST">
                    <input type="text" name="type"
                           value="<?php echo $_GET['mod'] == 'addAdminAccount' ? 'add' : 'update'; ?>"
                           style="display: none;">
                    <input type="text" name="id" value="<?php echo $id; ?>" style="display: none;">
                    <div class="form-group">
                        <label>用户名:</label><br>
                        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>"
                               required="">
                    </div>
                    <div class="form-group">
                        <label>密码:</label><br>
                        <input type="text" class="form-control" name="password" value="">
                    </div>
                    <div class="form-group">
                        <label>黑名单页面地址（回车换行）</label>
                        <textarea name="whiteUrl" class="form-control" style="min-width: 100%;min-height: 100px;"
                                  placeholder="例如 http://www.gznns.cn/admin/AdminGroup.php 你只需要输入 AdminGroup.php 即可"><?php echo $whiteUrl; ?></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="保存修改"><br>
                </form>
            </div>
        </div>
    </div>
<?php } else if ($_GET['mod'] == 'listAdminAccount') {

    $searchTitle = getParam(urldecode($_GET['title']), '');
    $page        = getParam($_GET['page'], 1);
    $limit       = 25;

    $whereData = [];

    if (!empty($searchTitle)) {
        $whereData = [
            'title[~]' => $searchTitle
        ];
    }
    $totalCount = $DB->count('admin_member', 'id', $whereData);

    $whereData['ORDER'] = [
        'id' => 'DESC'
    ];

    $whereData['LIMIT'] = [
        ($page - 1) * $limit,
        $limit
    ];
    $contents           = $DB->select('admin_member', ['id', 'username', 'createTime'], $whereData);

    ?>
    <div class="col-md-12 center-block" style="float: none;">
        <div class="block">
            <div class="block-title clearfix">
                <h2>
                    <?php echo $title; ?>
                </h2>
            </div>
            <form action="Article.php" method="get">
                <input type="text" name="mod" value="ArticleList" style="display: none;">
                <input type="hidden" name="my" value="search">
                <div class="input-group xs-mb-15">
                    <input type="text" placeholder="支持模糊查询 仅限用户名" name="title"
                           class="form-control text-center"
                           required value="<?php echo $searchTitle ?>">
                    <span class="input-group-btn">
			            <button type="submit" id="search" class="btn btn-primary">立即搜索</button>
			        </span>
                </div>
            </form>
            <div id="listTable">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>用户名</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($contents as $content) { ?>
                            <tr>
                                <td><?php echo $content['id']; ?></td>
                                <td><?php echo strip_tags($content['username']); ?></td>
                                <td><?php echo $content['createTime']; ?></td>
                                <td><a href="./AdminGroup.php?mod=editAdminAccount&id=<?php echo $content['id']; ?>"
                                       class="btn btn-info btn-xs">编辑</a>&nbsp;<a
                                            href="./AdminGroup.php?mod=deleteAccount&id=<?php echo $content['id']; ?>"
                                            class="btn btn-xs btn-danger"
                                            onclick="return confirm('你确实要删除此记录吗？');">删除</a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php
                    $link = '&mod=listAdminAccount';
                    if (!empty($searchTitle))
                        $link .= '&title=' . urlencode($searchTitle);
                    echo '<ul class="pagination">';
                    $first = 1;
                    $prev  = $page - 1;
                    $next  = $page + 1;
                    $last  = $pages;
                    if ($page > 1) {
                        echo '<li><a href="AdminGroup.php?page=' . $first . $link . '">首页</a></li>';
                        echo '<li><a href="AdminGroup.php?page=' . $prev . $link . '">&laquo;</a></li>';
                    } else {
                        echo '<li class="disabled"><a>首页</a></li>';
                        echo '<li class="disabled"><a>&laquo;</a></li>';
                    }
                    $start = $page - 10 > 1 ? $page - 10 : 1;
                    $end   = $page + 10 < $pages ? $page + 10 : $pages;
                    for ($i = $start; $i < $page; $i++)
                        echo '<li><a href="AdminGroup.php?page=' . $i . $link . '">' . $i . '</a></li>';
                    echo '<li class="disabled"><a>' . $page . '</a></li>';
                    for ($i = $page + 1; $i <= $end; $i++)
                        echo '<li><a href="AdminGroup.php?page=' . $i . $link . '">' . $i . '</a></li>';
                    if ($page < $pages) {
                        echo '<li><a href="AdminGroup.php?page=' . $next . $link . '">&raquo;</a></li>';
                        echo '<li><a href="AdminGroup.php?page=' . $last . $link . '">尾页</a></li>';
                    } else {
                        echo '<li class="disabled"><a>&raquo;</a></li>';
                        echo '<li class="disabled"><a>尾页</a></li>';
                    }
                    echo '</ul>';
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php } else if ($_GET['mod'] == 'deleteAccount') {
    $id = intval($_GET['id']);
    if ($id <= 0)
        exit('<script>alert("账户ID无效");window.location.href = \'./AdminGroup.php?mod=listAdminAccount\'</script>');
    if ($DB->delete('admin_member', ['id' => $id])->rowCount()) {
        exit('<script>alert("删除账户成功");window.location.href = \'./AdminGroup.php?mod=listAdminAccount\'</script>');
    } else {
        exit('<script>alert("删除账户失败");window.location.href = \'./AdminGroup.php?mod=listAdminAccount\'</script>');
    }

} ?>
    <script src="//cdn.staticfile.org/layer/2.3/layer.js"></script>
<?php
include_once 'footer.php';
?>