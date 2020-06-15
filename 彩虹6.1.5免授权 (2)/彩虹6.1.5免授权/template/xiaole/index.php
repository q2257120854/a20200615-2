<?php
if(!defined('IN_CRONLITE'))exit();
?>
<!DOCTYPE html>
<html lang="zh-cn">
    <head>
    	<link rel="shortcut icon" href=" /favicon.ico" />
        <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
        <link rel="stylesheet" href="//baomitu-1253374355.cos.ap-chengdu.myqcloud.com/uo_tougao/css/uid_1002_onle.css">
    	<title><?php echo $conf['sitename'] ?>_<?php echo $conf['title'] ?></title>
    	<meta name="keywords" content="<?php echo $conf['keywords'] ?>">
    	<meta name="description" content="<?php echo $conf['description'] ?>">
		<link href="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    	<link href="<?php echo $cdnpublic?>font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    	<link rel="stylesheet" href="<?php echo $cdnserver?>assets/simple/css/oneui.css">
<link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
		<link rel="stylesheet" href="<?php echo $cdnserver?>assets/css/common.css?ver=<?php echo VERSION ?>">
		<script src="<?php echo $cdnpublic?>modernizr/2.8.3/modernizr.min.js"></script>
		<!--[if lt IE 9]>
	     <script src="<?php echo $cdnpublic?>html5shiv/3.7.3/html5shiv.min.js"></script>
	    <script src="<?php echo $cdnpublic?>respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
  <style type="text/css">

	ul.ft-link{margin:0;padding:0}
	ul.ft-link li{border-right:1px solid #E6E7EC;display:inline-block;line-height:30px;margin:8px 0;text-align:center;width:24%}
	ul.ft-link li a{color:#74829c;text-transform:uppercase;font-size:12px}
	ul.ft-link li a:hover,ul.ft-link li.active a{color:#58c9f3}
	ul.ft-link li:last-child{border-right:none}
	ul.ft-link li a i{display:block}
	.btn-info{color:#ffffff;background-color:#4098f2;border-color:#ffffff}

	.btn-sm,.btn-group-sm > .btn{padding:5px 10px;font-size:12px;line-height:1.5;border-radius:3px}
	.btn-primary{color:#ffffff;background-color:rgb(64,152,242);border-color:rgb(64,152,242)}
</style>

<link rel="stylesheet" href="http://cdn.staticfile.org/layer/2.3/skin/layer.css" id="layui_layer_skinlayercss" style=""><script async="" src="https://pubres.aihecong.com/hecong.js"></script><link rel="stylesheet" type="text/css" href="https://pubres.aihecong.com/hecong.css?043001"></head><body class=""><img style="background: linear-gradient(to bottom,#49BDAD,#6a67c7);" class="full-bg full-bg-bottom" ondragstart="return false;" oncontextmenu="return false;">

<div class="col-xs-12 col-sm-10 col-md-8 col-lg-5 center-block" style="float: none;width:94%">
	<!--弹出公告-->
	<div class="modal fade" align="left" id="myModal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">
							×
						</span>
						<span class="sr-only">
							Close
						</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">
						<?php echo $conf['sitename']?>
					</h4>
				</div>
				<div class="modal-body">
					<?php echo $conf['modal']?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						知道啦
					</button>
				</div>
			</div>
		</div>
	</div>
	<!--弹出公告-->
	<!--公告-->
	<div class="modal fade" align="left" id="mustsee" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">
							×
						</span>
						<span class="sr-only">
							Close
						</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">
						公告
					</h4>
				</div>
				<div class="modal-body">
					<?php echo $conf['anounce']?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						关闭
					</button>
				</div>
			</div>
		</div>
	</div>
	<!--公告-->
	<div class="col-xs-12 col-sm-10 col-md-8 col-lg-4 center-block" style="float: none;">
		<br/>
		<!--顶部导航-->
		<div class="block block-link-hover3" href="javascript:void(0)">
			<div class="block-content block-content-full text-center bg-image" style="background-image: url('https://ae01.alicdn.com/kf/HTB1_KQGXAP2gK0jSZPx761cQpXaq.png');background-size: 100% 100%;">
				<div>
					<div>
						<img class="img-avatar img-avatar80 img-avatar-thumb animated zoomInDown"
						src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']?>&spec=100">
					</div>
				</div>
			</div>


<img width="100%" src="http://tva1.sinaimg.cn/large/0080xEK2ly1ga8xlpa9v8j30m801ma9x.jpg">

			<div class="panel-body text-center">
				<ul class="ft-link">
					<li>
						<a href="#mustsee" data-toggle="modal" class="">
							<h5>
								<i class="fa fa-envelope-open-o">
									公告
								</i>
							</h5>
					</li>
					</a>
					<li>
						<a href="/user" data-toggle="modal" class="">
							<h5>
								<i class="fa fa-cogs">
									后台
								</i>
							</h5>
					</li>
					<li>
						<a href="#about" data-toggle="modal" class="">
							<h5>
								<i class="fa fa-user-o">
									售后
								</i>
							</h5>
					</li>
					<li>
						<a href="/?mod=invite" data-toggle="modal" class="">
							<h5>
								<i class="fa fa-heartbeat">
									福利
								</i>
							</h5>
				</ul>
			</div>
			
			
			
			<a href="https://jq.qq.com/?_wv=1027&k=50RrfyH"><img src="http://qqdsw.eeeqq.cn/tp/sylogo/jqqq.png" width="100%"></a>
			
			
			
			
		</div>
		<aside id="php_text-8" class="widget php_text wow fadelnUp" data-wow-delay="3.0s">
			<div class="textwidget widget-text">
				</table>
				</a>
				<!--logo下面按钮结束-->
				<!--查单说明开始-->
				<div class="modal fade" align="left" id="cxsm" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">
									<span aria-hidden="true">
										&times;
									</span>
									<span class="sr-only">
										Close
									</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">
									查询内容是什么？该输入什么？
								</h4>
							</div>
							<li class="list-group-item">
								<font color="red">
									请在右侧的输入框内输入您下单时，在第一个输入框内填写的信息
								</font>
							</li>
							<li class="list-group-item">
								例如您购买的是QQ名片赞，输入下单的QQ账号即可查询订单
							</li>
							<li class="list-group-item">
								例如您购买的是邮箱类商品，需要输入您的邮箱号，输入QQ号是查询不到的
							</li>
							<li class="list-group-item">
								例如您购买的是快手商品，需要输入作品链接里“userid=”后面的数字，输入快手号是一般是查询不到的
							</li>
							<li class="list-group-item">
								例如您购买的是全民K歌商品，需要输入歌曲链接里“shareuid=”后面的，&amp;前面的一串英文数字，输入歌曲链接是查询不到的
							</li>
							<li class="list-group-item">
								<font color="red">
									如果不清楚下单账号是什么，可以不填写，直接点击查询，则会根据浏览器缓存查询
								</font>
							</li>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">
									关闭
								</button>
							</div>
						</div>
					</div>
				</div>
				<!--查单说明结束-->
<div class="block animated bounceInDown btn-rounded" style="margin-top:15px;font-size:15px;padding:1px;border-radius:15px;background-color: white;">
	<ul class="nav nav-tabs btn btn-block animated zoomInLeft btn-rounded"
					style="overflow: hidden;" data-toggle="tabs">
						<li class="active" style="width: 25%;" align="center">
							<a href="#shop" data-toggle="tab">
								<i class="fa fa-shopping-bag fa-fw">
								</i>
								下单
							</a>
						</li>
						<li style="width: 25%;" align="center">
							<a href="#search" data-toggle="tab" id="tab-query">
								<i class="fa fa-search">
								</i>
								查单
							</a>
						</li>
						<li style="width: 25%;" align="center">
							<a href="#ktfz" data-toggle="tab">
								<i class="fa fa-coffee fa-fw">
								</i>
								赚钱
							</a>
						</li>
						
						<li style="width: 25%;" align="center" class="hide">
							<a href="#cardbuy" data-toggle="tab">
								<i class="glyphicon glyphicon-th">
								</i>
								卡密
							</a>
						</li>
						<li style="width: 25%;" align="center">
							<a href="#more" data-toggle="tab">
								<i class="fa fa-folder-open">
								</i>
								更多
							</a>
						</li>
					</ul>
	
			

					<!--TAB-->
					<div class="block-content tab-content">
						<!--在线下单-->
						<div class="tab-pane fade fade-up in active" id="shop">
							<?php include TEMPLATE_ROOT.'default/shop.inc.php'; ?>
						</div>
						<!--在线下单-->
						<!--查询订单-->
						<div class="tab-pane fade fade-up" id="search">
							<table class="table table-striped table-borderless table-vcenter remove-margin-bottom">
								<tbody>
									<tr class="shuaibi-tip animation-fadeInQuick2">
										<td class="text-center" style="width: 100px;">
											<img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']?>&spec=100" alt="avatar"
											class="img-circle img-thumbnail img-thumbnail-avatar">
										</td>
										<td>
											<h5>
												<strong>
													订单售后客服
												</strong>
											</h5>
											<i class="fa fa-check-circle-o text-danger">
											</i>
											客服当前
											<br>
											<i class="fa fa-comment-o text-success">
											</i>
											在线中,有事直奔主题!
										</td>
										<td class="text-right" style="width: 20%;">
											<a styel="letter-spacing: 3px;" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes"
											target="_blank" class="btn btn-sm btn-info">
												<i class="fa fa-qq">
												</i>
												&nbsp;联系
											</a>
										</td>
									</tr>
								</tbody>
							</table>
							<div class="col-xs-12 well well-sm animation-pullUp">
								<p align="left">
									<font color="blue">
										<i class="fa fa-clock-o">
										</i>
									</font>
									<font color="blue">
										待处理
									</font>
									：订单已经提交后台！
									<br>
									<font color="red">
										<i class="fa fa-exclamation-circle">
										</i>
									</font>
									<font color="red">
										有异常
									</font>
									：请联系客服进行处理！
									<br>
									<font color="brown">
										<i class="fa fa-cog fa-spin">
										</i>
									</font>
									<span style="color:#FFB90F;">
										处理中
									</span>
									：订单已经提交服务器处理！
									<br>
									<font color="green">
										<i class="fa fa-check-circle">
										</i>
									</font>
									<font color="green">
										已完成
									</font>
									：订单已提交到服务器，不是说全开完！
								</p>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-btn">
										<select class="form-control" id="searchtype" style="padding: 6px 4px;width:90px">
											<option value="0">
												下单账号
											</option>
											<option value="1">
												订单号
											</option>
										</select>
									</div>
									<input type="text" name="qq" id="qq3" value="" class="form-control" placeholder="请输入要查询的内容（留空则显示最新订单）"
									required/>
									<span class="input-group-btn">
										<a href="#cxsm" target="_blank" data-toggle="modal" class="btn btn-warning">
											<i class="glyphicon glyphicon-exclamation-sign">
											</i>
										</a>
									</span>
								</div>
							</div>
							<input type="submit" id="submit_query" class="btn btn-primary btn-block"
							value="立即查询">
							<br/>
							<div id="result2" class="form-group" style="display:none;">
								<center>
									<small>
										<font color="#ff0000">
											手机用户可以左右滑动
										</font>
									</small>
								</center>
								<div class="table-responsive">
									<table class="table table-vcenter table-condensed table-striped">
										<thead>
											<tr>
												<th class="hidden-xs">
													下单账号
												</th>
												<th>
													商品名称
												</th>
												<th>
													数量
												</th>
												<th class="hidden-xs">
													购买时间
												</th>
												<th>
													状态
												</th>
												<th>
													操作
												</th>
											</tr>
										</thead>
										<tbody id="list">
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!--查询订单-->
						<!--开通分站-->
						<div class="tab-pane fade fade-up" id="ktfz">
							<div class="block block-link-hover2 text-center">
								<div class="block-content block-content-full bg-success">
									<div class="h4 font-w700 text-white push-10">
										<i class="fa fa-cny fa-fw">
										</i>
										<strong>
											<?php echo $conf['fenzhan_price'] ?>元
										</strong>
										/
										<i class="fa fa-cny fa-fw">
										</i>
										<strong>
											<?php echo $conf['fenzhan_price2'] ?>元
										</strong>
									</div>
									<div class="h5 font-w300 text-white-op">
										普及版 / 专业版两种分站供你选择
									</div>
								</div>
								<div class="block-content">
									<table class="table table-borderless table-condensed">
										<tbody>
											<tr>
												<td>
													无聊时可以赚点零花钱
												</td>
											</tr>
											<tr>
												<td>
													还可以锻炼自己销售口才
												</td>
											</tr>
											<tr>
												<td>
													宝妈、学生等网络兼职首选
												</td>
											</tr>
											<tr>
												<td>
													分站满<?php echo $conf['tixian_min']; ?>元即可申请提现
												</td>
											</tr>
											<tr>
												<td>
													<strong>
														轻轻松松推广日赚100+不是梦
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="block-content block-content-mini block-content-full bg-gray-lighter">
									<a href="#userjs" data-toggle="modal" class="btn btn-success">
										版本介绍
									</a>
									<button onclick="window.open('./user/regsite.php')" class="btn btn-danger">
										开通分站
									</button>
								</div>
							</div>
						</div>
						<!--开通分站-->
						<!--抽奖-->
						<div class="tab-pane fade fade-up" id="gift">
							<div class="panel-body text-center">
								<div id="roll">
									点击下方按钮开始抽奖
								</div>
								<hr>
								<p>
									<a class="btn btn-info" id="start" style="display:block;">
										开始抽奖
									</a>
									<a class="btn btn-danger" id="stop" style="display:none;">
										停止
									</a>
								</p>
								<div id="result">
								</div>
								<br/>
								<div class="giftlist" style="display:none;">
									<strong>
										最近中奖记录
									</strong>
									<ul id="pst_1">
									</ul>
								</div>
							</div>
						</div>
						<!--抽奖-->
						<!--卡密下单-->
						<div class="tab-pane fade fade-up" id="cardbuy">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										输入卡密
									</div>
									<input type="text" name="km" id="km" value="" class="form-control" onkeydown="if(event.keyCode==13){submit_checkkm.click()}"
									required/>
								</div>
							</div>
							<input type="submit" id="submit_checkkm" class="btn btn-primary btn-block"
							value="检查卡密">
							<div id="km_show_frame" style="display:none;">
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											商品名称
										</div>
										<input type="text" name="name" id="km_name" value="" class="form-control"
										disabled/>
									</div>
								</div>
								<div id="km_inputsname">
								</div>
								<div id="km_alert_frame" class="alert alert-success animation-pullUp"
								style="display:none;">
								</div>
								<input type="submit" id="submit_card" class="btn btn-primary btn-block"
								value="立即购买">
								<div id="result1" class="form-group text-center" style="display:none;">
								</div>
							</div>
							<br />
						</div>
						<!--卡密下单-->
						<!--更多-->
						<div class="tab-pane fade fade-right" id="more">
							<div class="col-xs-6 col-sm-4 col-lg-4">
								<a class="block block-link-hover2 text-center" href="<?php echo $conf['appurl'] ?>"
								target="_blank">
									<div class="block-content block-content-full bg-success">
										<i class="fa fa-cloud-download fa-3x text-white">
										</i>
										<div class="font-w600 text-white-op push-15-t">
											APP下载
										</div>
									</div>
								</a>
							</div>
							<div class="col-xs-6 col-sm-4 col-lg-4 hide">
								<a class="block block-link-hover2 text-center btn btn-block animated zoomInLeft btn-rounded"
								data-toggle="modal" href="#lqq">
									<div class="block-content block-content-full bg-primary">
										<i class="fa fa-circle-o fa-3x text-white">
										</i>
										<div class="font-w600 text-white-op push-15-t">
											免费拉圈
										</div>
									</div>
								</a>
							</div>
							<div class="col-xs-6 col-sm-4 col-lg-4">
								<a class="block block-link-hover2 text-center" href="./?mod=invite" target="_blank">
									<div class="block-content block-content-full bg-warning">
										<i class="fa fa-paper-plane-o fa-3x text-white">
										</i>
										<div class="font-w600 text-white-op push-15-t">
											免费领赞
										</div>
									</div>
								</a>
							</div>
							<div class="col-xs-6 col-sm-4 col-lg-4 hide">
								<a class="block block-link-hover2 text-center" href="#cardbuy" data-toggle="tab">
									<div class="block-content block-content-full bg-amethyst">
										<i class="fa fa-credit-card fa-3x text-white">
										</i>
										<div class="font-w600 text-white-op push-15-t">
											卡密下单
										</div>
									</div>
								</a>
							</div>
							<div class="col-xs-6 col-sm-4 col-lg-4 hide">
								<a class="block block-link-hover2 text-center" href="#chat" data-toggle="tab">
									<div class="block-content block-content-full bg-success">
										<i class="fa fa-comments fa-3x text-white">
										</i>
										<div class="font-w600 text-white-op push-15-t">
											在线聊天
										</div>
									</div>
								</a>
							</div>
							<div class="col-xs-6 col-sm-4 col-lg-4">
								<a class="block block-link-hover2 text-center" href="./user/" target="_blank">
									<div class="block-content block-content-full bg-city">
										<i class="fa fa-certificate fa-3x text-white">
										</i>
										<div class="font-w600 text-white-op push-15-t">
											分站后台
										</div>
									</div>
								</a>
							</div>
						</div>
						<!--更多-->
						<!--拉圈圈-->
						<div class="modal fade" id="lqq" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-dialog-popin">
								<div class="modal-content">
									<div class="block block-themed block-transparent remove-margin-b">
										<div class="block-header bg-primary-dark">
											<ul class="block-options">
												<li>
													<button data-dismiss="modal" type="button">
														<i class="si si-close">
														</i>
													</button>
												</li>
											</ul>
											<h4 class="block-title">
												免费拉圈圈99+
											</h4>
										</div>
										<div class="modal-body">
											<div id="alert_frame" class="alert alert-info">
												免费拉取圈圈标签赞 99+ ，不是100%成功哦！
											</div>
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon">
														请输入QQ
													</div>
													<input type="text" name="qq" id="qq4" value="" class="form-control" required/>
												</div>
											</div>
											<input type="submit" id="submit_lqq" class="btn btn-primary btn-block"
											value="立即提交">
											<div id="result3" class="form-group text-center" style="display:none;">
											</div>
											<br/>
										</div>
									</div>
									<div class="modal-footer">
										<button class="btn btn-sm btn-default" type="button" data-dismiss="modal">
											关闭
										</button>
									</div>
								</div>
							</div>
						</div>
						<!--拉圈圈-->
						<div class="tab-pane fade fade-right" id="chat">
						</div>
						<!--聊天-->
					</div>
				</div>





<div class="block animated bounceInDown btn-rounded" style="border:1px solid #FFF0F5;margin-top:15px;font-size:15px;padding:15px;border-radius:15px;background-color: white;"><div class="panel-heading"><h3 class="panel-title" types=""><font color="#000000"><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;<b>推广奖励统计</b></font><span class="pull-right"><a href="./?mod=invite" class="btn btn-danger btn-xs btn-rounded">点我免费领取 <i class="fa fa-mail-reply-all"></i></a></span></h3></div>


<div class="btn-group btn-group-justified">
		<a target="_blank" class="btn btn-effect-ripple btn-default collapsed" style="overflow: hidden; position: relative;"><b><font color="modal-title">领取QQ</font></b></a>
		<a target="_blank" class="btn btn-effect-ripple btn-default collapsed" style="overflow: hidden; position: relative;"><b><font color="modal-title">完成时间</font></b></a>
		<a target="_blank" class="btn btn-effect-ripple btn-default collapsed" style="overflow: hidden; position: relative;"><b><font color="modal-title">获得奖励</font></b></a>
		</div>  
		<marquee class="zmd" behavior="scroll" direction="UP" onmouseover="this.stop()" onmouseout="this.start()" scrollamount="5" style="height:16em">
			<table class="table table-hover table-striped" style="text-align:center">
				<thead>
				                    <?php
                    $c = 188;
                    for ($a = 0; $a < $c; $a++) {
                        $sim = rand(1, 5); #随机数
                        $a1 = 'https://ae01.alicdn.com/kf/Hdf40fd7a47504d1ebbfc8bcac04e6c800.png'; #超级会员
                        $a2 = 'https://ae01.alicdn.com/kf/H0744ba68e4274c44ab3765677ca15057F.png'; #视频会员
                        $a3 = 'https://ae01.alicdn.com/kf/H124dd225e7964a7f983f5a56735da02bK.png'; #豪华黄钻
                        $a4 = 'https://ae01.alicdn.com/kf/H8c71f2d773e04943ac748d395e541d1eY.png'; #豪华绿钻
                        $a5 = 'https://ae01.alicdn.com/kf/H62814210ab734f578208b4e0276dd392k.png'; #名片赞
                        $e = 'a' . $sim;
                        if ($sim == '1') {
                            $name = '超级会员';
                        } else if ($sim == '2') {
                            $name = '视频会员';
                        } else if ($sim == '3') {
                            $name = '豪华黄钻';
                        } else if ($sim == '4') {
                            $name = '豪华绿钻';
                        } else if ($sim == '5') {
                            $name = rand(1000, 100000) . '名片赞';
                        }
                        $date = date('Y-m-d'); #今日
                        $time = date("Y-m-d", strtotime("-1 day"));
                        if ($a > 70) {
                            $date = $time;
                        } else {
                            if (date('H') == 0 || date('H') == 1 || date('H') == 2) {
                                if ($a > 8) {
                                    $date = $time;
                                }
                            }
                        }
                        echo '<tr></tr><tr><td>恭喜QQ' . rand(10, 1000) . '**' . rand(100, 1000) . '**</td><td>于' . $date . '日推广成功</td><td><font color="salmon">奖励<img src="' . $$e . '" width="15">' . $name . '</font></td></tr>';
                    }
                    ?>
                    </thead>
                </table>
            </marquee>
</div>
<!--推广奖励-->



				<!--版本介绍-->
				<div class="modal fade" id="userjs" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-popin">
						<div class="modal-content">
							<div class="block block-themed block-transparent remove-margin-b">
								<div class="block-header bg-primary-dark">
									<ul class="block-options">
										<li>
											<button data-dismiss="modal" type="button">
												<i class="si si-close">
												</i>
											</button>
										</li>
									</ul>
									<h4 class="block-title">
										版本介绍
									</h4>
								</div>
								<div class="modal-body">
									<div class="table-responsive">
										<table class="table table-borderless table-vcenter">
											<thead>
												<tr>
													<th style="width: 100px;">
														功能
													</th>
													<th class="text-center" style="width: 20px;">
														普及版/专业版
													</th>
												</tr>
											</thead>
											<tbody>
												<tr class="active">
													<td>
														专属代刷平台
													</td>
													<td class="text-center">
														<span class="btn btn-effect-ripple btn-xs btn-success">
															<i class="fa fa-check">
															</i>
														</span>
														<span class="btn btn-effect-ripple btn-xs btn-success">
															<i class="fa fa-check">
															</i>
														</span>
													</td>
												</tr>
												<tr class="">
													<td>
														三种在线支付接口
													</td>
													<td class="text-center">
														<span class="btn btn-effect-ripple btn-xs btn-success">
															<i class="fa fa-check">
															</i>
														</span>
														<span class="btn btn-effect-ripple btn-xs btn-success">
															<i class="fa fa-check">
															</i>
														</span>
													</td>
												</tr>
												<tr class="success">
													<td>
														专属网站域名
													</td>
													<td class="text-center">
														<span class="btn btn-effect-ripple btn-xs btn-success">
															<i class="fa fa-check">
															</i>
														</span>
														<span class="btn btn-effect-ripple btn-xs btn-success">
															<i class="fa fa-check">
															</i>
														</span>
													</td>
												</tr>
												<tr class="">
													<td>
														赚取用户提成
													</td>
													<td class="text-center">
														<span class="btn btn-effect-ripple btn-xs btn-success">
															<i class="fa fa-check">
															</i>
														</span>
														<span class="btn btn-effect-ripple btn-xs btn-success">
															<i class="fa fa-check">
															</i>
														</span>
													</td>
												</tr>
												<tr class="info">
													<td>
														赚取下级分站提成
													</td>
													<td class="text-center">
														<span class="btn btn-effect-ripple btn-xs btn-danger">
															<i class="fa fa-close">
															</i>
														</span>
														<span class="btn btn-effect-ripple btn-xs btn-success">
															<i class="fa fa-check">
															</i>
														</span>
													</td>
												</tr>
												<tr class="">
													<td>
														设置商品价格
													</td>
													<td class="text-center">
														<span class="btn btn-effect-ripple btn-xs btn-success">
															<i class="fa fa-check">
															</i>
														</span>
														<span class="btn btn-effect-ripple btn-xs btn-success">
															<i class="fa fa-check">
															</i>
														</span>
													</td>
												</tr>
												<tr class="warning">
													<td>
														设置下级分站商品价格
													</td>
													<td class="text-center">
														<span class="btn btn-effect-ripple btn-xs btn-danger">
															<i class="fa fa-close">
															</i>
														</span>
														<span class="btn btn-effect-ripple btn-xs btn-success">
															<i class="fa fa-check">
															</i>
														</span>
													</td>
												</tr>
												<tr class="">
													<td>
														搭建下级分站
													</td>
													<td class="text-center">
														<span class="btn btn-effect-ripple btn-xs btn-danger">
															<i class="fa fa-close">
															</i>
														</span>
														<span class="btn btn-effect-ripple btn-xs btn-success">
															<i class="fa fa-check">
															</i>
														</span>
													</td>
												</tr>
												<tr class="danger">
													<td>
														赠送专属精致APP
													</td>
													<td class="text-center">
														<span class="btn btn-effect-ripple btn-xs btn-danger">
															<i class="fa fa-close">
															</i>
														</span>
														<span class="btn btn-effect-ripple btn-xs btn-success">
															<i class="fa fa-check">
															</i>
														</span>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<center style="color: #b2b2b2;">
										<small>
											<em>
												* 自己的能力决定着你的收入！
											</em>
										</small>
									</center>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">
									关闭
								</button>
							</div>
						</div>
					</div>
				</div>
				<!--版本介绍-->
				<!--关于我们弹窗-->
				<div class="modal fade" align="left" id="about" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">
									<span aria-hidden="true">
										&times;
									</span>
									<span class="sr-only">
										Close
									</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">
									新手下单帮助
								</h4>
							</div>
							<div class="modal-body">
								<a href="javascript:void(0)" class="widget">
									<center>
										<strong>
											<font size="3">
												站长ＱＱ：
												<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes"
												target="_blank">
													<?php echo $conf['kfqq']?>
												</a>
											</font>
										</strong>
										<br />
										<strong>
											<font size="2">
												本站域名：<?php echo $_SERVER['HTTP_HOST']; ?>
											</font>
										</strong>
									</center>
									<center>
										<div id="demo-acc-faq" class="panel-group accordion">
											<div class="panel panel-trans pad-top">
												<a href="#demo-acc-faq1" class="text-semibold text-lg text-main collapsed"
												data-toggle="collapse" data-parent="#demo-acc-faq" aria-expanded="false">
													下单很久了都没有开始刷呢？
												</a>
												<div id="demo-acc-faq1" class="mar-ver collapse" aria-expanded="false"
												style="height: 0px;">
													由于本站采用全自动订单处理，有几率出现漏单，部分单子处理时间可能会稍长一点，不过都会完成，最终解释权归本站所有。超过24小时没处理请联系客服！
												</div>
											</div>
											<div class="panel panel-trans pad-top">
												<a href="#demo-acc-faq2" class="text-semibold text-lg text-main collapsed"
												data-toggle="collapse" data-parent="#demo-acc-faq" aria-expanded="false">
													ＱＱ空间业务类下单方法讲解
												</a>
												<div id="demo-acc-faq2" class="mar-ver collapse" aria-expanded="false">
													1.下单前：空间必须是所有人可访问,必须自带1~4条原创说说!
													<br>
													2.代刷期间，禁止关闭访问权限，或者删除说说，删除说说的一律由自行负责，不给予补偿。
												</div>
											</div>
											<div class="panel panel-trans pad-top">
												<a href="#demo-acc-faq3" class="text-semibold text-lg text-main collapsed"
												data-toggle="collapse" data-parent="#demo-acc-faq" aria-expanded="false">
													空间说说赞相关下单方法讲解
												</a>
												<div id="demo-acc-faq3" class="mar-ver collapse" aria-expanded="false">
													1.下单前：空间必须是所有人可访问,必须自带1条原创说说!转发的说说不能刷！
													<br>
													2.在“QQ号码”栏目输入QQ号码，点击下面的获取说说ID并选择你需要刷的说说的ID，下单即可。
													<br>
													3.代刷期间，禁止关闭访问权限，或者删除说说，删除说说的一律由自行负责，不给予补偿。
												</div>
											</div>
											<div class="panel panel-trans pad-top">
												<a href="#demo-acc-faq4" class="text-semibold text-lg text-main collapsed"
												data-toggle="collapse" data-parent="#demo-acc-faq" aria-expanded="false">
													全民Ｋ歌业务类下单方法讲解
												</a>
												<div id="demo-acc-faq4" class="mar-ver collapse" aria-expanded="false">
													1.打开你的全名k歌
													<br>
													2.复制你全名k歌里面的需要刷的歌曲链接
													<br>
													3.例如：你歌曲链接是：
													<font color="#ff0000">
														https://kg.qq.com/node/play?s=
														<font color="green">
															881Zbk8aCfIwA8U3
														</font>
														&amp;g_f=personal
													</font>
													<br>
													4.然后把s=后面的
													<font color="green">
														881Zbk8aCfIwA8U3
													</font>
													链接填入到歌曲ID里面，然后提交购买。
												</div>
											</div>
											<div class="panel panel-trans pad-top">
												<a href="#demo-acc-faq5" class="text-semibold text-lg text-main collapsed"
												data-toggle="collapse" data-parent="#demo-acc-faq" aria-expanded="false">
													快手业务类代刷下单方法讲解
												</a>
												<div id="demo-acc-faq5" class="mar-ver collapse" aria-expanded="false">
													1.需要填写用户ID和作品ID，比如
													<font color="#ff0000">
														http://www.kuaishou.com/i/photo/lwx?userId=
														<font color="green">
															294200023
														</font>
														&amp;photoId=
														<font color="green">
															1071823418
														</font>
													</font>
													(分享作品就可以看到“复制链接”了)
													<br>
													2.用户ID就是
													<font color="green">
														294200023
													</font>
													作品ID就是
													<font color="green">
														1071823418
													</font>
													，然后在分别把用户ID和作品ID填上，请勿把两个选项填反了，不给予补单！
												</div>
											</div>
											<div class="panel panel-trans pad-top">
												<a href="#demo-acc-faq6" class="text-semibold text-lg text-main collapsed"
												data-toggle="collapse" data-parent="#demo-acc-faq" aria-expanded="false">
													永久ＱＱ会员/钻下单方法讲解
												</a>
												<div id="demo-acc-faq6" class="mar-ver collapse" aria-expanded="false">
													1.下单之前，先确认输的信息是不是正确的!
													<br>
													2.Q会员/钻因为需要人工处理，所以每天不定时开刷，24小时-48小时内到账！
												</div>
											</div>
										</div>
									</center>
								</a>
							</div>
						</div>
					</div>
				</div>

				<!--底部导航-->
				
<div class="block panel-body btn btn-block animated bounceInUp btn-rounded">
  <center>  <b>
<a href="javascript:void(0);" onclick="AddFavorite('QQ代刷网',location.href)"><font color="#C00000">本</font><font color="#B5000B">站</font><font color="#AA0016">地</font><font color="#9F0021">址</font><font color="#94002C">：</font>
<font color="red">
<script language="javascript">
host = window.location.host;
document.write(""+host)
</script>
</font>
<font color="#890037">（</font><font color="#7E0042">欢</font><font color="#73004D">迎</font><font color="#680058">收</font><font color="#5D0063"></font><font color="#52006E">藏</font><font color="#470079">）</font></a></b><br>

<span style="font-weight:bold"><font color="#C00000">C</font><font color="#B5000B">o</font><font color="#AA0016">p</font><font color="#9F0021">y</font><font color="#94002C">R</font><font color="#890037">i</font><font color="#7E0042">g</font><font color="#73004D">h</font><font color="#680058">t</font><font color="#5D0063"></font> <i class="fa fa-heart text-danger"></i> <font color="#52006E">2</font><font color="#470079">0</font><font color="#3C0084">1</font><font color="#31008F">9</font><font color="#26009A"> | </font><font color="#52006E"><?php echo $conf['sitename']?></font>




			<!--底部导航-->
	</div>
	<!--音乐代码-->
	<div id="audio-play" <?php if(empty($conf['musicurl'])){?>style="display:none;"<?php }?>>
	  <div id="audio-btn" class="on" onclick="audio_init.changeClass(this,'media')">
	    <audio loop="loop" src="<?php echo $conf['musicurl']?>" id="media" preload="preload"></audio>
	  </div>
	</div>
	<!--音乐代码-->
	<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js">
	</script>
	<script src="<?php echo $cdnpublic?>jquery.lazyload/1.9.1/jquery.lazyload.min.js">
	</script>
	<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js">
	</script>
	<script src="<?php echo $cdnpublic?>jquery-cookie/1.4.1/jquery.cookie.min.js">
	</script>
	<script src="<?php echo $cdnpublic?>layer/2.3/layer.js">
	</script>
	<script src="<?php echo $cdnserver ?>assets/appui/js/app.js">
	</script>
	<script type="text/javascript">
		var isModal = <?php echo empty($conf['modal']) ? 'false' : 'true'; ?> ;
		var homepage = true;
		var hashsalt = <?php echo $addsalt_js ?> ;
		$(function() {
   		 	$("img.lazy").lazyload({
        		effect: "fadeIn"
    		});
		});
		var ss = 0,
		    mm = 0,
		    hh = 0;
		
		function TimeGo() {
		    ss++;
		    if (ss >= 60) {
		        mm += 1;
		        ss = 0
		    }
		    if (mm >= 60) {
		        hh += 1;
		        mm = 0
		    }
		    ss_str = (ss < 10 ? "0" + ss : ss);
		    mm_str = (mm < 10 ? "0" + mm : mm);
		    tMsg = "" + hh + "小时" + mm_str + "分" + ss_str + "秒";
		    document.getElementById("stime").innerHTML = tMsg;
		    setTimeout("TimeGo()", 1000)
		}
		TimeGo();
		$("#submit_cart_shop").attr({'class':'btn btn-block animated zoomInLeft btn-rounded','style':'background-image: radial-gradient(circle 168px at center, #16d9e3 0%, #30c7ec 47%, #00CCFF 100%);color:#FFFFFF;'});
		$("#submit_buy").attr({'class':'btn btn-block animated zoomInRight btn-rounded','style':'background-image: radial-gradient(circle 168px at center, #6699FF 0%, #30c7ec 47%, #00CCFF 100%);color:#FFFFFF;'});
	</script>
	<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>