<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"/www/wwwroot/feichangpeizi/application/index/view/index/mobile/index.html";i:1540755940;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>金龙策略</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<link href="/public/static/home/css/mui.min.css" rel="stylesheet" />
	<link href="/public/static/home/css/moblie/index.css" rel="stylesheet" />
</head>
<body>
	<header id="header" class="mui-bar mui-bar-nav">
		<a class="free" data-href="/freetrial.html">免费体验</a>
		<h1 class="mui-title" style="right: 75px;left: 75px;">金龙策略</h1>
		<!--<a data-href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $QQ; ?>&site=qq&menu=yes" class="mui-icon mui-icon-bars mui-pull-right" style="display: inline-block;z-index: 999"></a>-->
	</header>
	<nav class="ml_tab mui-bar mui-bar-tab">
	    <a class="mui-tab-item mui-active" href="/index.html">
	        <span class="mui-icon mui-icon-home"></span>
	        <span class="mui-tab-label">首页</span>
	    </a>
	    <a class="mui-tab-item" href="/buy.html">
	        <span class="mui-icon mui-icon-phone"></span>
	        <span class="mui-tab-label">A股点买</span>
	    </a>
	    <a class="mui-tab-item" href="/ucenter/home.html">
	        <span class="mui-icon mui-icon-email"></span>
	        <span class="mui-tab-label">我的</span>
	    </a>
	</nav>

	<div class="mui-content">
		<!--轮播图-->
	    <div class="banner_img">
	    	<!--<img src="/public/static/home/img/moblie/banner.png"/>-->
	    	<div id="slider" class="mui-slider" >
	    	  <div class="mui-slider-group mui-slider-loop">
	    	    <!-- 额外增加的一个节点(循环轮播：第一个节点是最后一张轮播) -->
	    	    <div class="mui-slider-item mui-slider-item-duplicate">
	    	      <a href="#">
	    	        <img src="/public/static/home/img/moblie/banner.png">
	    	      </a>
	    	    </div>
	    	    <!-- 第一张 -->
	    	    <div class="mui-slider-item">
	    	      <a href="#">
	    	        <img src="/public/static/home/img/moblie/banner.png">
	    	      </a>
	    	    </div>
	    	    <!-- 第二张 -->
	    	    <div class="mui-slider-item">
	    	      <a href="#">
	    	        <img src="/public/static/home/img/moblie/banner.png">
	    	      </a>
	    	    </div>
	    	    <!-- 第三张 -->
	    	    <div class="mui-slider-item">
	    	      <a href="#">
	    	        <img src="/public/static/home/img/moblie/banner.png">
	    	      </a>
	    	    </div>
	    	    <!-- 额外增加的一个节点(循环轮播：最后一个节点是第一张轮播) -->
	    	    <div class="mui-slider-item mui-slider-item-duplicate">
	    	      <a href="#">
	    	        <img src="/public/static/home/img/moblie/banner.png">
	    	      </a>
	    	    </div>
	    	  </div>
	    	  <div class="mui-slider-indicator">
	    	    <div class="mui-indicator mui-active"></div>
	    	    <div class="mui-indicator"></div>
	    	    <div class="mui-indicator"></div>
	    	    <div class="mui-indicator"></div>
	    	  </div>
	    	</div>
	    </div>

		<!--A股指数-->
		<section class="Ashare">
			<div class="section_title">A股指数</div>
			<div class="Ashare_top">
				<ul class="mui-clearfix" id="A-ul" style="margin-bottom: 0;padding-bottom: 17px;">
					<li class="mui-pull-left mui-text-center">
						<p class="Ashare_t"><?php echo $dp[0]->name; ?></p>
						<p class="Ashare_num  color"><?php echo round($dp[0]->nowPrice,2); ?></p>
						<div class="per mui-clearfix">
							<span class="mui-pull-left color"><?php echo round($dp[0]->diff_money,2); ?></span>
							<span class="mui-pull-right color"><?php echo round($dp[0]->diff_rate,2); ?>%</span>
						</div>
					</li>
					<li class="mui-pull-left mui-text-center">
						<p class="Ashare_t"><?php echo $dp[1]->name; ?></p>
						<p class="Ashare_num color"><?php echo round($dp[1]->nowPrice,2); ?></p>
						<div class="per mui-clearfix">
							<span class="mui-pull-left color"><?php echo round($dp[1]->diff_money,2); ?></span>
							<span class="mui-pull-right color"><?php echo round($dp[1]->diff_rate,2); ?>%</span>
						</div>
					</li>
					<li class="mui-pull-left mui-text-center">
						<p class="Ashare_t"><?php echo $dp[2]->name; ?></p>
						<p class="Ashare_num color"><?php echo round($dp[2]->nowPrice,2); ?></p>
						<div class="per mui-clearfix">
							<span class="mui-pull-left color"><?php echo round($dp[2]->diff_money,2); ?></span>
							<span class="mui-pull-right color"><?php echo round($dp[2]->diff_rate,2); ?>%</span>
						</div>
					</li>
				</ul>
			</div>
			<ul class="gift_box mui-row">
				<li class="leiji_item mui-col-xs-4 mui-col-sm-4"><a href="/gift.html"  style="display: block;">
					<img src="/public/static/home/img/moblie/g1.png"/>
					<p>资金合作</p>
				</a></li>
				<li class="leiji_item mui-col-xs-4 mui-col-sm-4"><a href="/freetrial.html" style="display: block;">
					<img src="/public/static/home/img/moblie/g2.png"/>
					<p>免费体验</p>
				</a></li>
				<li class="leiji_item mui-col-xs-4 mui-col-sm-4"><a href="/guild.html"  style="display: block;">
					<img src="/public/static/home/img/moblie/g3.png"/>
					<p>新手引导</p>
				</a></li>
			</ul>
		</section>
		<section class="activity">
			<div class="section_title">操盘达人</div>
			<li class="dr_p" style="color: #8f8f94;">
				<i class="icon-dr"></i>当前账户余额（元）：<span style="color: #000;"><?php echo (isset($usableSum) && ($usableSum !== '')?$usableSum:0); ?></span>
			</li>
			<ul class="mui-text-center">
				<?php if(is_array($buyList) || $buyList instanceof \think\Collection || $buyList instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($buyList) ? array_slice($buyList,0,7, true) : $buyList->slice(0,7, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<li class="mui-row">
					<span class="user_name mui-col-xs-3 mui-col-sm-3">
						<?php echo $vo['mobile']; ?></br>
						<?php echo $vo['time']; ?>
					</span>
					<span class="user_ProfitOrLoss mui-col-xs-6 mui-col-sm-6">
						<?php echo $vo['stockName']; ?></br>
						[<?php echo $vo['stockCode']; ?>]
					</span>
					<span class="mui-col-xs-3 mui-col-sm-3" style="line-height: 40px;"><a id="buy_a" href="/buy.html" >我要点买</a></span>
				</li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</section>
	
	
	
	</div>
	
	
	
	<script src="/public/static/libs/jquery-2.2.0/jquery-2.2.0.min.js"></script>
	<script src="/public/static/home/js/moblie/mui.min.js"></script>
	<!--<script src="/public/static/home/js/moblie/login.js"></script>-->
	<script type="text/javascript">
		mui.init({
			swipeBack: true //启用右滑关闭功能
		})
		//选项卡
		 mui('body').on('tap', 'a', function() {
                    var data_href = this.getAttribute("data-href");
                    var href = this.getAttribute("href");
                    var url=data_href;
                    if(!url||url==''){
                        url=href;
                    }
                   if(url != null){
             	      window.location.href = url;
                   }
                   else{
                     var browser = api.require('webBrowser');
                            browser.historyBack(
                              function(ret, err) {
                                  if (!ret.status) {
                                      api.closeWin();
                                  }
                              }
                            );
                   }
         });


		var slider = mui("#slider");		
		slider.slider({
			interval: 5000
		});

		//改变A股大盘数据的颜色
		$("#A-ul>li").each(function(i, o){
			var p = parseFloat($(o).find(".mui-pull-left.color").html());
			if(p > 0){
				$(o).find(".color").addClass("color_red");
			}else if(p < 0){
				$(o).find(".color").addClass("color_green");
			}
		});

	</script>
</body>
</html>