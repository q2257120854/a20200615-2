<?php
include('../includes/common.php');
$title = '社区价格监控';
include("head.php");
if ($islogin != 1)
    exit("<script>window.location.href='./login.php';</script>");
echo '<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">';
$do = filterParam($_POST['do']);
if ($do == 'submit') {
    $monitoringPriceCategoryList = $_POST['pricejk_cid'];
    $pricejk_edit                = intval($_POST['pricejk_edit']);
    $pricejk_time                = intval($_POST['pricejk_time']);
    $pricejk_yile                = intval($_POST['pricejk_yile']);

    $pricejk_cid = '';

    foreach ($monitoringPriceCategoryList as $content) {
        $pricejk_cid .= $content . ',';
    }

    saveSetting('pricejk_cid', substr($pricejk_cid, 0, -1));
    saveSetting('pricejk_edit', $pricejk_edit);
    saveSetting('pricejk_time', $pricejk_time);
    saveSetting('pricejk_yile', $pricejk_yile);

    $CACHE->update();
    showmsg('修改成功！', 1);
}

?>
<div class="modal fade" align="left" id="showresult" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">手动同步价格</h4>
            </div>
            <div class="modal-body" id="result_content">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="block">
    <div class="block-title">
        <h3 class="panel-title">社区价格监控设置</h3>
    </div>
    <div class="alert alert-info">
        价格监控支持玖伍、亿乐、卡易信、同系统社区类型，可以实现自动修改商品成本价格和商品上下架。<b>仅支持使用加价模板的商品！</b>
    </div>
    <div class="alert alert-success">
        监控地址：<br/>
        <a style="color:white" target="_blank"
           href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/cron.php?do=pricejk&key=<?php echo $conf['cronkey']; ?>">
            http://<?php echo $_SERVER['HTTP_HOST']; ?>/cron.php?do=pricejk&key=<?php echo $conf['cronkey']; ?>
        </a>
    </div>
    <div class="alert alert-warning">
        监控说明：频率10到60分钟一次即可，只能在一个地方监控，千万不要多节点监控或在多处监控，否则会导致数据错乱。
    </div>
    <table class="table table-condensed table-bordered">
        <tr>
            <td class="info" style="text-align:center"><b>上次运行</b></td>
            <td><?php echo empty($conf['pricejk_lasttime']) ? '尚未运行任何一次' : $conf['pricejk_lasttime']; ?></td>
            <td class="info" style="text-align:center"><b>运行状态</b></td>
            <td class="text-success">正常</td>
        </tr>
    </table>
    <div class="">
        <form action="./pricejk.php" method="post" role="form"><input type="hidden" name="do" value="submit"/>
            <div class="form-group">
                <label>选择要监控的商品类别</label><br/>
                <select name="pricejk_cid[]" multiple="multiple" class="form-control" style="height:100px;">
                    <?php
                    $monitoringPrice = empty($conf['pricejk_cid']) ? '' : $conf['pricejk_cid'];
                    $monitoringPrice = explode(',', $monitoringPrice);
                    $rs              = $DB->select('class', ['cid', 'name'], ['active' => 1, 'ORDER' => ['sort' => 'ASC']]);
                    $select          = '<option value="0">未分类商品</option>';
                    foreach ($rs as $res) {
                        $select .= '<option value="' . $res['cid'] . '" ' . (in_array($res['cid'], $monitoringPrice) ? 'selected' : '') . '>' . $res['name'] . '</option>';
                    }
                    echo $select;
                    ?>
                </select>
                <font color="green">按住Ctrl键可多选</font>
            </div>
            <div class="form-group">
                <label>在以下情况修改价格</label><br/>
                <select class="form-control" name="pricejk_edit" default="<?php echo $conf['pricejk_edit']; ?>">
                    <option value="0">成本价格与社区价格不符时</option>
                    <option value="1">成本价格低于社区价格时</option>
                </select>
            </div>
            <div class="form-group">
                <label>价格同步频率</label><br/>
                <select class="form-control" name="pricejk_time" default="<?php echo $conf['pricejk_time']; ?>">
                    <option value="600">10分钟</option>
                    <option value="1200">20分钟</option>
                    <option value="1800">30分钟</option>
                    <option value="3600">60分钟</option>
                    <option value="7200">120分钟</option>
                </select>
            </div>
            <div class="form-group">
                <label>亿乐同步价格方式</label>(未对接亿乐的可以无视此选项)<br/>
                <select class="form-control" name="pricejk_yile" default="<?php echo $conf['pricejk_yile']; ?>">
                    <option value="0">下单同时同步价格（无需监控）</option>
                    <option value="1">监控批量同步价格（可能会超时）</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/><br/>
                <a href="javascript:showresult()" class="btn btn-default form-control">立即同步一次价格</a><br/>
            </div>
    </div>
    </form>
</div>
<script>
    var items = $("select[default]");
    for (i = 0; i < items.length; i++) {
        $(items[i]).val($(items[i]).attr("default") || 0);
    }

    function showresult() {
        var url = '/cron.php?do=pricejk&key=<?php echo $conf['cronkey']; ?>&test=1';
        var content = '<div id="loadiframe" style="text-align:center;"><i class="fa fa-spinner fa-spin"></i>正在加载...</div><iframe src="' + url + '" frameborder="0" scrolling="auto" seamless="seamless" width="100%"  onload="$(\'#loadiframe\').hide();"></iframe>';
        $("#showresult").modal('show');
        $("#result_content").html(content);
    }

</script>
