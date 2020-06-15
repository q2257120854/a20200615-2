<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"/www/wwwroot/feichangpeizi/application/index/view/ucenter/mobile/freetrialHistory.html";i:1540755586;}*/ ?>
<!doctype html>
<html>
   
	<head>
		<meta charset="UTF-8">
		<title>金龙策略</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/public/static/home/css/mui.min.css" rel="stylesheet" />
		<link href="/public/static/home/css/moblie/tradeCommon.css" rel="stylesheet" />
	</head>
	<!--结算区域-->
	<body class="history_body sell_body">
		<!--标题-->
		<header class="ml_header mui-bar mui-bar-nav">
			<a class="color_red mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
			<h1 class="mui-title">
		    	<a class="Asharebuy" href="/buy.html">A股点买</a>
		    	<a class="freetrial  color_red" href="/freetrial.html">免费体验</a>
		    </h1>
		</header>
		<nav class="ml_tab mui-bar mui-bar-tab">
			    <a class="mui-tab-item" href="/index.html">
			        <span class="mui-icon mui-icon-home"></span>
			        <span class="mui-tab-label">首页</span>
			    </a>
			    <a class="mui-tab-item mui-active" href="/buy.html">
			        <span class="mui-icon mui-icon-phone"></span>
			        <span class="mui-tab-label">A股点买</span>
			    </a>
			    <a class="mui-tab-item " href="/ucenter/home.html">
			        <span class="mui-icon mui-icon-email"></span>
			        <span class="mui-tab-label">我的</span>
			    </a>
		</nav>
		<!--主体-->
		<div class="mui-content">
			<!--链接-->
			<div class="bg_fff mui-segmented-control mui-segmented-control-inverted">
				<a class="mui-control-item " href="/freetrial.html">点买</a>
				<a class="sell_a mui-control-item " href="/freetrialSell.html">点卖</a>
				<a class="mui-control-item mui-active" href="/freetrialHistory.html">结算</a>
			</div>
			<!--内容-->
			<div id="item1" class="mui-control-content mui-active">
				<?php if(count($list) == 0): ?>
				<p class="data_empty">暂无持仓</p>
				<?php else: ?>
				<ul class="mui-table-view">
					 <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				    <li class="mui-table-view-cell mui-collapse">
				        <a class="mui-navigate-right mui-row" href="#">
				        	<div class="share_l mui-col-xs-6 mui-col-sm-6">
				        		<h5 class="stockName">
				        			<?php echo $vo['stockName']; ?>
				        			<span class="stockNum font12">(<?php echo $vo['stockCode']; ?>)</span>
				        		</h5>
				        		<p>
				        			<span class="date moneyNum"><?php echo substr($vo['sellTime'],0,10); ?></span>
				        			<span class="usableNum">查看详情</span>
				        		</p>
				        	</div>
				        	<span class="title_r mui-text-center mui-col-xs-3 mui-col-sm-3">
				        		<p class="color_black">交易盈亏</p>
				        		<p>
				        		<span <?php if($vo['profit'] < 0): ?>class="color_green" <?php else: ?> class="color_red" <?php endif; ?>>
				            			<?php echo round($vo['profit'],2); ?>
				            	</span>元
				        		</p>
				        	</span>
				        	<span class="title_r mui-text-center mui-col-xs-3 mui-col-sm-3">
				        		<p class="color_black">交易分配</p>
				        		<p>
				        		<span <?php if($vo['profit'] < 0): ?>class="color_green" <?php else: ?> class="color_red" <?php endif; ?>>
				            			<?php if($vo['profit'] > 0): ?> <?php echo round($vo['profit']*(1-$profitFee),2); else: ?> <?php echo round($vo['profit'],2); endif; ?>
				            	</span>元
				            	</p>
				        	</span>
				        </a>
				       <!--隐藏部分-->
				        <div class="share_info mui-collapse-content">
				            <ul>
				            	<li class="mui-clearfix">
				            		<span class="li_l mui-pull-left font12">交易单号</span>
				            		<span class="li_r mui-pull-right font12"><?php echo $vo['id']; ?></span>
				            	</li>
				            	<li class="mui-clearfix">
				            		<span class="li_l mui-pull-left font12">交易本金</span>
				            		<span class="li_r mui-pull-right font12">2000元</span>
				            	</li>
				            	<li class="mui-clearfix">
				            		<span class="li_l mui-pull-left font12">买入时间</span>
				            		<span class="li_r mui-pull-right font12"><?php echo $vo['createTime']; ?></span>
				            	</li>
				            	<li class="mui-clearfix">
				            		<span class="li_l mui-pull-left font12">买入价格</span>
				            		<span class="li_r mui-pull-right font12"><?php echo round($vo['dealPrice'],2); ?></span>
				            	</li>
				            	<li class="mui-clearfix">
				            		<span class="li_l mui-pull-left font12">买入类型</span>
				            		<span class="li_r mui-pull-right font12">即时买入</span>
				            	</li>
				            	<li class="mui-clearfix">
				            		<span class="li_l mui-pull-left font12">卖出时间</span>
				            		<span class="li_r mui-pull-right font12"><?php echo $vo['sellTime']; ?></span>
				            	</li>
				            	<li class="mui-clearfix">
				            		<span class="li_l mui-pull-left font12">卖出价格</span>
				            		<span class="li_r mui-pull-right font12 color_red"><?php echo round($vo['sellPrice'],2); ?></span>
				            	</li>
				            	<li class="mui-clearfix">
				            		<span class="li_l mui-pull-left font12">交易综合费</span>
				            		<span class="li_r mui-pull-right font12 color_red"><?php echo $vo['publicFee']; ?></span>
				            	</li>
				            	<li class="mui-clearfix">
				            		<span class="li_l mui-pull-left font12">递延费</span>
				            		<span class="li_r mui-pull-right font12 color_red">
				            			<?php echo $vo['delayFeeSum']; ?>
										(递延天数：<?php if($vo['delayDays'] > 2): ?><?php echo $vo['delayDays'] - 2; else: ?>0<?php endif; ?>天)
				            		</span>
				            	</li>
				            	<p class="float_p bg_fff">
				            		交易盈亏
				            		<span <?php if($vo['profit'] < 0): ?>class="color_green" <?php else: ?> class="color_red" <?php endif; ?>>
				            			<?php echo round($vo['profit'],2); ?>
				            		</span>&nbsp;&nbsp;
				            		交易分配 
				            		<span <?php if($vo['profit'] < 0): ?>class="color_green" <?php else: ?> class="color_red" <?php endif; ?>>
				            			<?php if($vo['profit'] > 0): ?> <?php echo round($vo['profit'],2); else: ?> <?php echo round($vo['profit'],2); endif; ?>
				            		</span>
				            		
				            	</p>
				            </ul>
				        </div>
				    </li>
				     <?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<?php endif; ?>
				<div class="pagination_box">
				    <?php echo $list->render(); ?>
				</div>	
				
				
			</div>
		</div>
		<script src="/public/static/libs/jquery-2.2.0/jquery-2.2.0.min.js"></script>
		<script src="/public/static/home/js/moblie/mui.min.js"></script>
		<script type="text/javascript">
			mui.init({
				swipeBack: true //启用右滑关闭功能
			});
			//href
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
         
         //cont
         $('.cont').on('tap',function(e){
         	e.stopPropagation()
         })
         
         //分页高亮
          $('.pagination_box ul.pagination>li').on('tap',function(){
            	if($(this).hasClass('disabled')){return}
            	$(this).addClass('active').siblings().removeClass('active');
            	mui.toast('正在加载...')
           })
		</script>
	</body>

</html>