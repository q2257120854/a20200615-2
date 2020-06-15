<?php
/**
 * 自助升级站点
**/
include '../includes/common.php';
$title = '自助升级站点';
include './head.php';
if ($islogin2 != 1) {
    exit("<script>window.location.href='./login.php';</script>");
}
?>
<div class="wrapper">
<?php
if (!$conf['fenzhan_upgrade']) showmsg('当前站点未开启此功能');
if ($userrow['power'] == 0) {
    showmsg('你没有权限使用此功能！', 3);
}
$price = $conf['fenzhan_upgrade'];
if ($userrow['upzid'] > 1) {
    $upsite = $DB->get('site', ['zid', 'power','ktfz_price2'], ['zid' => $userrow['upzid']]);
    if ($upsite && $upsite['power'] == 2) {
        if ($upsite['ktfz_price2'] && $upsite['ktfz_price2'] > 0) {
            $price = $upsite['ktfz_price2'];
        }
        $tc_point = round($price - $conf['fenzhan_cost2'], 2);
    }
}
if ($_GET['act'] == 'submit') {
    if ($price > $userrow['rmb']) exit("<script>alert('你的余额不足，请充值！');window.location.href='./';</script>");
    $DB->update('site', ['power' => 2, 'rmb[-]' => $price], ['zid' => $userrow['zid']]);
    addPointRecord($userrow['zid'], $price, '消费', '升级到专业版分站');
    if (isset($tc_point) && $tc_point > 0) {
        $DB->update('site', ['rmb[+]' => $tc_point], ['zid' => $upsite['zid']]);
        addPointRecord($upsite['zid'], $tc_point, '提成', '你网站的用户升级分站获得' . $tc_point . '元提成');
    }
    exit("<script>alert('恭喜你成功升级站点版本！');window.location.href='index.php';</script>");
}
?>
<div class="col-sm-6">
	<div class="panel panel-default">
    <div class="panel-heading font-bold" style="background-color: #9999CC;color: white;">专业版介绍</div>	  
			<ul class="list-group no-radius">
              <li class="list-group-item">
                旗下分站管理功能,赚取下级分站提成
              </li>
              <li class="list-group-item">
                可自定义分站开通价格,下级商品成本价格
              </li>
              <li class="list-group-item">
                赠送专属APP客户端
              </li>
              <li class="list-group-item">
                更多特权开发中...
              </li>
            </ul>
	</div>
</div>
<div class="col-sm-6">
  <div class="panel panel-default">
	<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;">自助升级站点<span class="pull-right">余额：0.02元</span></div>
		<div class="panel-body">
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">
						升级版本
					</div>
					<select name="kind" class="form-control"><option value="2">专业版</option></select>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">
						升级所需
					</div>
					<input name="need" class="form-control" value="<?php echo $price?>" disabled="">
					<div class="input-group-addon">
						元
					</div>
				</div>
			</div>
			<a class="btn btn-primary btn-block" href="?act=submit">立即升级</a>
		</div>
	</div>
   </div>
  </div>