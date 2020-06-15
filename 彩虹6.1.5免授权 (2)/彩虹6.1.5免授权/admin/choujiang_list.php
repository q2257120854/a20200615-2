<?php
include('../includes/common.php');
$title = "中奖记录";
include('head.php');
if ($islogin != 1)
    exit("<script>window.location.href='./login.php';</script>");
?>
<div class="container">
    <div class="col-xs-12 col-sm-10 col-lg-10 center-block" style="float: none;">
        <div class="block">
            <div class="block-title"><h3 class="panel-title">中奖记录</h3></div>
            <div class="alert alert-info">
                目前仅显示30条中奖记录
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>站点ID</th>
                        <th>中奖商品ID</th>
                        <th>奖品名称</th>
                        <th>订单号</th>
                        <th>中奖时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $list = $DB->query('SELECT `a`.*, (select `b`.`name` from `'.$dbconfig['dbqz'].'_gift` as `b` where `a`.`gid` = `b`.`id`) as `name` FROM `'.$dbconfig['dbqz'].'_giftlog` as `a` WHERE `status` = 1 ORDER BY `id` DESC LIMIT 30')->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($list as $cjlist) {
                        ?>
                        <tr>
                            <td><b><?php echo $cjlist['zid'] ?></b></td>
                            <td><b><?php echo $cjlist['tid'] ?></b></td>
                            <td><?php echo $cjlist['name'] ?></td>
                            <td><a href="./orderList.php?kw=<?php echo $cjlist['tradeno'] ?>&type=0"
                                   target="_blank"><?php echo $cjlist['tradeno'] ?></a></td>
                            <td><?php echo $cjlist['addtime'] ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>