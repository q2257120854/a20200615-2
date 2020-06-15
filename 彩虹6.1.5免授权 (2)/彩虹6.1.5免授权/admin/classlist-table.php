<?php
/**
 * 分类管理
 **/
include '../includes/common.php';
if ($islogin != 1) exit('<script>window.location.href="./login.php";</script>');

$numrows = $DB->count('class');
$rs = $DB->select('class', '*', [
    'ORDER' => [
        'sort' => 'ASC'
    ]
]);
?>
<form name="classlist" id="classlist">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>排序操作</th>
                <th style="min-width:150px">名称（<?php echo $numrows ?>个）</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($rs as $res): ?>
                <tr>
                    <td>
                        <a class="btn btn-xs sort_btn" title="移到顶部" onclick="sort(<?php echo $res['cid']; ?>,0)">
                            <i class="fa fa-long-arrow-up"></i>
                        </a>
                        <a class="btn btn-xs sort_btn" title="移到上一行" onclick="sort(<?php echo $res['cid']; ?>,1)">
                            <i class="fa fa-chevron-circle-up"></i>
                        </a>
                        <a class="btn btn-xs sort_btn" title="移到下一行" onclick="sort(<?php echo $res['cid']; ?>,2)">
                            <i class="fa fa-chevron-circle-down"></i>
                        </a>
                        <a class="btn btn-xs sort_btn" title="移到底部" onclick="sort(<?php echo $res['cid']; ?>,3)">
                            <i class="fa fa-long-arrow-down"></i>
                        </a>
                    </td>
                    <td>
                        <label>
                            <input type="text" class="form-control input-sm" name="name<?php echo $res['cid']; ?>"
                                   value="<?php echo htmlspecialchars($res['name']); ?>" placeholder="分类名称" required>
                        </label>
                    </td>
                    <td><span class="btn btn-primary btn-sm" onclick="editClass('<?php echo $res['cid']; ?>')">修改</span>&nbsp;
                        <?php if ($res['active'] == 1): ?>
                        <span class="btn btn-sm btn-success" onclick="setActive('<?php echo $res['cid']; ?>',0)">显示</span>
                        <?php else: ?>
                        <span class="btn btn-sm btn-warning" onclick="setActive('<?php echo $res['cid']; ?>',1)">隐藏</span>
                        <?php endif; ?>
                        <a href="./shoplist.php?cid=<?php echo $res['cid']; ?>" class="btn btn-info btn-sm">商品</a>&nbsp;
                        <span class="btn btn-sm btn-danger" onclick="delClass('<?php echo $res['cid']; ?>')">删除</span>
                        <?php hook('addClassHandle', ['cid' => $res['cid']]); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td><span class="btn btn-primary btn-sm" onclick="saveAll()">保存全部</span></td>
                <td>
                    <label>
                        <input type="text" class="form-control input-sm" name="name" placeholder="分类名称" required>
                    </label>
                </td>
                <td colspan="3">
                    <span class="btn btn-success btn-sm" onclick="addClass()">
                    <span class="glyphicon glyphicon-plus"></span> 添加分类</span>&nbsp;&nbsp;
                    <a href="./classlist.php?my=classimg" class="btn btn-info btn-sm">修改分类图片</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</form>