<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:66:"/www/wwwroot/feichangpeizi/application/index/view/index/index.html";i:1541154264;s:65:"/www/wwwroot/feichangpeizi/application/index/view/public/top.html";i:1539839495;s:68:"/www/wwwroot/feichangpeizi/application/index/view/public/footer.html";i:1540301736;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body class="index_body">

<title><?php echo config('web_site_title'); ?></title>

<meta name="keywords" content="<?php echo config('web_site_keywords'); ?>">
<meta name="description" content="<?php echo config('web_site_description'); ?>">
<link rel="stylesheet" type="text/css" href="/public/static/home/css/common.css"/>
<!--头部-->
<header class="ml_header br-w100">
    <div class="h_top br-w100">
        <div class="w1024 br-clearfix">
            <!--<div class="h_topL br-fl">
                服务热线：<?php echo $phone; ?>
                <a id="qqicon" target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $QQ; ?>&amp;site=qq&amp;menu=yes"></a>
            </div>-->


            <div id="page_shared_layout_login" class="h_topR br-fr" <?php if($_SESSION['member'] != ''): ?> style="display: none;" <?php endif; ?> >
                <a class="login" href="javascript:;">登录</a>
                <a class="register" href="/reg.html">注册</a>
            </div>

            <ul id="page_shared_layout_unlogin" class="top-links f-right" <?php if($_SESSION['member'] == ''): ?> style="display: none;" <?php endif; ?>>
                <!--<li class="show-logout" style="display: list-item;"><a href="javascript:_hmt.push(['_trackEvent', 'login', 'click', 'head-login',1]);" name="popup-user-login-click">登录</a></li>-->
                <!--<li class="show-logout sep" style="display: list-item;">|</li>-->
                <!--<li class="show-logout" style="display: list-item;"><a href="/user/reg">注册</a></li>-->
                <li class="show-login" style="display: block;">您好，&nbsp;</li>
                <li class="show-login top-user-wrapper" style="display: block;">
                    <span class="top-username">
                    	<a id="page_shared_layout_login_name" href="/ucenter/index"><?php echo $_SESSION['member']['username']; ?></a>
                    	<i class="icon icon-arrow-drop-down"></i>
                    </span>
                    <div class="overlay-account">
                        <div class="group account-group">
                            <span class="f-left">可用<b class="account-val" id="shared_header_mb"><?php echo $usableSum; ?></b></span>
                            <a name="realnameAuth" class="f-right" href="/ucenter/payment.html">充值</a>
                        </div>
                        <div class="account-links group">
                            <a class="f-left" href="/ucenter/index.html">个人中心</a>
                            <span class="f-left sep">|</span>


                            <a class="f-right js-logout" href="/index/index/logout.html">安全退出</a>
                        </div>
                    </div>
                    <!--/.overlay-account-->
                </li>

            </ul>

        </div>
    </div>
    <div class="h_bot br-w100">
        <div class="w1024 br-clearfix">
            <div class="h_botL br-fl">
                <a href="/"><img src="/public/static/home/img/logo.png" style="height:60px; " /></a>
            </div>
            <div class="h_botR br-fr">
                <ul class="br-clearfix" id="menu-ul">
                    <li class="br-fl"><a href="/index.html" class="active">首页</a></li>
                    <li class="br-fl"><a href="/buy.html">A股点买</a></li>
                    <li class="br-fl"><a href="/freetrial.html">免费体验</a></li>
                    <li class="br-fl"><a href="/mobile.html">手机版</a></li>
                    <li class="br-fl help_box">
                    	<a href="/guild.html">帮助中心</a>
                    	<ul class="new-sub-nav hide">
                            <li class=""><a href="/guild.html">新手教学</a></li>
                            <li class=""><a href="/help.html">常见问题</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>


<script src="/public/static/libs/jquery-2.2.0/jquery-2.2.0.min.js"></script>
<script src="/public/static/home/js/general.js"></script>

<script>
    //自动选中active
    $(function(){
        var menuArr = [];
        menuArr[0] = ["index.html"  ];
        menuArr[1] = ["buy.html", "sell.html", "history.html" ];
        menuArr[2] = ["freetrial.html", "freetrialSell.html", "freetrialHistory.html"  ];
        menuArr[3] = ["mobile.html",  ];
        menuArr[4] = [ "guild.html" ,"help.html" ];
        for(var i = 0 ; i < menuArr.length; i++ ){
            for(var j = 0 ; j < menuArr[i].length; j++){
                if(location.href.indexOf(menuArr[i][j]) > 0){
                    $("#menu-ul > li a").removeClass("active");
                    $("#menu-ul > li").eq(i).find("a").eq(0).addClass("active");
                    $("#menu-ul > li").eq(i).find("a").eq(j+1).addClass("active");
					//console.log(i+'------'+j);
                    return;
                }
            }
        }
       

    });


</script>
<link href="/public/static/libs/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/public/static/home/css/index.css"/>
<link rel="stylesheet" type="text/css" href="/public/static/home/css/buy.css"/>
<!--banner-->
	<div class="banner_login br-w100">
		<div class="bBanner br-w100">
			<div class="w1024">
					<div class="login_main" <?php if($_SESSION['member'] != ''): ?> style="display: none;" <?php endif; ?>>
					<p>用户登录</p>
					<from>
						<input type="text" name="" id="username" placeholder="用户名"/>
						<div id="err1" class="err">请输入正确用户名</div>
						<input type="password" name="" id="password" placeholder="密码"/>
						<div id="err2" class="err">请输入正确密码</div>
						<div class="login_box">
							<a href="javascript:;" class="btn_login">登录</a>
							<a href="/reg.html" class="btn_reg">注册</a>
						</div>
					</from>
				</div>
			</div>
			<!--轮播图-->
			<div class="home_banner">
				<div id="myCarousel" class="carousel slide">
				   <!-- 轮播（Carousel）指标 -->
				   <ol class="carousel-indicators">
				      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				      <li data-target="#myCarousel" data-slide-to="1"></li>
				      <li data-target="#myCarousel" data-slide-to="2"></li>
				   </ol>  
				   <!-- 轮播（Carousel）项目 -->
				   <div class="carousel-inner">
				      <div class="item active">
				      	<div class="carImg"></div>
				      </div>
				      <div class="item">
				         <div class="carImg2"></div>
				      </div>
				      <div class="item">
				         <div class="carImg"></div>
				      </div>
				   </div>
				   <!-- 轮播（Carousel）按钮导航 -->
				   <a class="carousel-control left" href="#myCarousel"
				      data-slide="prev">&lsaquo;</a>
				   <a class="carousel-control right" href="#myCarousel"
				      data-slide="next">&rsaquo;</a>
				</div>
			</div>
			
		</div>
	</div>
	<!--点买A股-->
	<div class="AS_box br-w100">
		<!--3个盒子-->
		<div class="three_box w1024 br-clearfix">
			<div class="three_item br-fl"><a href="/company.html" style="display: block;"><img src="/public/static/home/img/p (3).png"/></a>
				<p class="tit">一分钟了解金龙策略</p>
				<p class="tib">全新的投资人策略匹配平台</p>
			</div>
			<div class="three_item br-fl"><a href="javascript:;" style="display: block;"><img src="/public/static/home/img/p (2).png"/></a>
				<p class="tit">用心服务</p>
				<p class="tib">一对一专业客服（电话 微信 QQ）</br>全程指导</p>
			</div>
			<div class="three_item br-fl"><a href="javascript:;" style="display: block;"><img src="/public/static/home/img/p (1).png"/></a>
				<p class="P_block" style="float: left;">累计匹配策略 </br><span><?php echo $count + 256; ?></span>条</p>
				<p class="P_block" style="float: right;">累计盈利</br><span><?php echo round($earnSum + 5758000, 2 ); ?></span>元</p>
			</div>
		</div>
		<div class="AS_box_cont w1024 br-text-center">
			<h1 class="br-ml-title">POINT TO BUY A SHARES</h1>
			<div class="br-ml-line"></div>
			<p class="br-ml-bt">点买A股</p>
			<div class="AS_contImg br-clearfix">
				<div class="three_item br-fl">
					<div class="ASitem_top"><img src="/public/static/home/img/01.png"/></div>
					<div class="ASitem_bot br-clearfix">
						<span class="ASbot_l br-fl"><img src="/public/static/home/img/num (1).png"/></span>
						<p class="ASbot_r br-fl">点买人只需最低1250元履<br>约保证金支付50元交易综合费</p>
					</div>
				</div>
				<div class="three_item br-fl">
					<div class="ASitem_top"><img src="/public/static/home/img/02.png"/></div>
					<div class="ASitem_bot br-clearfix">
						<span class="ASbot_l br-fl"><img src="/public/static/home/img/num (2).png"/></span>
						<p class="ASbot_r br-fl">即刻提交策略系统智能匹<br>配投资人，投资人实施买入</p>
					</div>
				</div>
				<div class="three_item br-fl">
					<div class="ASitem_top"><img src="/public/static/home/img/03.png"/></div>
					<div class="ASitem_bot br-clearfix">
						<span class="ASbot_l br-fl"><img src="/public/static/home/img/num (3).png"/></span>
						<p class="ASbot_r br-fl">点买人获得的交易盈利<br>系统自动划入点买人账户</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--获得更高收益-->
	<div class="highYields br-w100">
		<div class="w1024 br-clearfix">
			<div class="high_l br-fl ">
				<h1>获得更高收益</h1>
				<p>提供投资策略金和投资人分享高额回报</p>
				<a href="/buy.html" class="">进入点买A股</a>
			</div>
			<div class="high_r br-fr ">
				<table>
					<?php if(is_array($buyList) || $buyList instanceof \think\Collection || $buyList instanceof \think\Paginator): $i = 0; $__LIST__ = $buyList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<tr>
						<td class="nickname"><?php echo $vo['mobile']; ?></td>
						<td class="time"><?php echo $vo['time']; ?></td>
						<td class="celue">策略</td>
						<td class="stockNumber"><?php echo $vo['stockName']; ?>[<?php echo $vo['stockCode']; ?>]</td>
					</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</table>
			</div>
		</div>
	</div>
	<!--5重保障-->
	<div class="guarantee br-w100">
		<div class="w1024 br-text-center">
			<h1 class="br-ml-title">WE WILL ENSURE YOUR BEST INTEREST</h1>
			<div class="br-ml-line"></div>
			<p class="br-ml-bt">5重保障最大力度保障您的利益</p>
			<div class="guarantee_botBox br-clearfix">
				<div class="guarantee_item bg1">网站安全</div>
				<div class="guarantee_item bg1">风控<br>保险体质</div>
				<div class="guarantee_item bg1">客服<br>秒回复</div>
				<div class="guarantee_item bg1">资金<br>安全保障</div>
				<div class="guarantee_item bg1">费率低<br>客户盈利<br>不分成</div>
				
			</div>
		</div>
	</div>
	<!--点买人盈利亏损-->
	<div class="PAL br-w100 br-text-center">
		<div class="w1024 br-clearfix">
			<div class="PAL_item br-fl">
				<div class="item_img"></div>
				<p>点买人获得的交易盈利，系统自动<br>划入点买人的金龙策略账户</p>
			</div>
			<div class="PAL_item br-fr">
				<div class="item_img"></div>
				<p>点买人承担履约保证金以内的亏损<br>超出部分由投资人承担</p>
			</div>
		</div>
	</div>
	 <!--service-->
	 <div class="service br-text-center br-w100">
	 	<div class="w1024">
		 	<h1 class="br-ml-title">OUR SERVICE</h1>
			<div class="br-ml-line"></div>
			<p class="br-ml-bt">我们的服务</p>
			<div class="service_box br-clearfix">
				<h1>A股点买去<span>金龙策略</span></h1>
				<p class="sp1">“股票点买最安全平台”</p>
				<p class="sp2">急速撮合<br>仅需填写简单资料<br>提交策略<br>就能马上提交投资人赚钱</p>
				<a href="/reg.html">立即注册</a>
			</div>
	 	</div>
	 </div>
	 <!--微信交易-->
	 <div class="weChatDeal br-w100">
	 	<div class="w1024">
	 		<div class="weChatDeal_box">
	 			<h1>微信端交易更加方便</span></h1>
	 			<p class="sp1">“下单 持仓 结算 一目了然”</p>
	 			<p class="sp2">更多优惠活动等着您</p>
	 		</div>
	 	</div>
	 </div>
	 <!--合作伙伴-->
	 <div class="companion br-w100 br-text-center">
	 	<div class="w1024">
	 		<h1 class="br-ml-title">PARTNERS</h1>
			<div class="br-ml-line"></div>
			<p class="br-ml-bt">合作伙伴</p>
			<div class="companion_box br-clearfix">
				<div class="cp_item"></div>
				<div class="cp_item"></div>
				<div class="cp_item"></div>
				<div class="cp_item"></div>
				<div class="cp_item"></div>
				<div class="cp_item"></div>
				<div class="cp_item"></div>
				<div class="cp_item"></div>
			</div>
	 	</div>
	 </div>

<!--底部-->
<footer class="br-w100">
    <div class="footer_top">
        <a href="/company.html">关于我们</a>
        <a href="/contact.html">联系我们</a>
    </div>
    <div class="footer_bot">
        <div class="w1024 br-clearfix">
            <div class="bot_l br-fl">
                <p>宁波鑫钰网络科技有限公司<br>客服QQ ：806247358<br>客服服务时间工作日：9:00-18:00</p></div>
            <div class="bot_r br-fr br-text-center">
                <div class="bot_r_img br-clearfix ">
                    <span class="br-fl"><img src="/public/static/home/img/f1.png"/></span>
                    <span class="br-fr"><img src="/public/static/home/img/f2.png"/></span>
                </div>
                <p>版权所有 © 宁波鑫钰网络科技有限公司  </p>
                <p>浙ICP备17030011号  投资有风险 入市需谨慎</p>
            </div>
        </div>
    </div>
</footer>
<!--Start Pop-ups-->
<!--遮罩层-->
<div class="mask"></div>
<!--确认，取消提示框-->
<div class="popup" id="popup-p-confirm">
    <div class="popup-header group">
        <h2>提示</h2>
    </div>
    <div class="popup-body group">
        <div class="btn-row group">
            <a class="btn btn-pri js-close-popup" href="javascript:popup_confirm_go()">确定</a>
            <a class="btn btn-pri js-close-popup" href="javascript:;">取消</a>
        </div>
    </div>
</div>
<!--开设账户提示-->
<div class="popup" id="popup-yeepay">
    <div id="yeepayPopupContent" class="popup-header group">
        <h2>提示</h2>
    </div>
    <div class="popup-body group">
        <div class="btn-row group">
            <a id="yeepayNextLink" target="_blank" class="btn btn-pri" href="javascript:;">开设账户</a>
            <a class="btn btn-pri js-close-popup" href="javascript:;">暂不充值</a>
        </div>
    </div>
</div>
<!--是，否提示框-->
<div class="popup" id="popup-yeepay-confirm" >
    <div id="yeepayConfirmContent" class="popup-header group">
        <h2>提示</h2>
    </div>
    <div class="popup-body group">
        <div class="btn-row group">
            <a class="btn btn-pri js-close-popup" href="javascript:;">是</a>
            <a class="btn btn-pri js-close-popup" href="javascript:;">否</a>
        </div>
    </div>
</div>
<!--提示信息提示框-->
<div id="popup-p-error" class="popup">
    <div class="popup-header group">
        <h2>提示</h2>
        <a href="javascript:;" class="js-close-popup"><i class="icon icon-close"></i></a>
    </div>
    <div class="popup-body group">
        <p id="popup-p-error-msg">提示信息</p>
    </div>
</div>
<!--意见反馈提示框-->
<div class="popup" id="popup-feedback">
    <div class="popup-header group">
        <h2>意见反馈</h2>
        <a href="javascript:;" class="js-close-popup"><i class="icon icon-close"></i></a>
    </div>
    <div class="popup-body group">
        <form action="#">
            <div class="field-row group">
                <label>留言类型：</label>
                <div class="field-val">
                    <select id="留言类型s">
                        <option value="">请选择留言类型</option>
                        <option value="1">交易问题</option>
                        <option value="2">充值/提款问题</option>
                        <option value="3">交易问题</option>
                        <option value="4">我要投诉</option>
                        <option value="5">意见反馈</option>
                        <option value="6">其它</option>
                    </select>
                </div>
            </div>
            <div class="field-row group show-logout">
                <label>手机/邮箱：</label>
                <div class="field-val"><input type="text" class="text" placeholder="请输入手机号或邮箱"></div>
            </div>
            <div class="field-row group">
                <label>&nbsp;</label>
                <div class="field-val">
                    <textarea id="留言内容i" placeholder="请填写留言内容" class="textarea"></textarea>
                </div>
            </div>
            <div class="btn-row group">
                <a class="btn btn-pri" href="javascript:feedback_Insert()">提交</a>
            </div>
        </form>
    </div>
</div>
<!--账户登录提示框-->
<div class="popup popup-small" id="popup-user-login">
    <div class="popup-header group">
        <h2>账户登录</h2>
        <a href="javascript:;" class="js-close-popup"><i class="icon icon-close"></i></a>
    </div>
    <div class="popup-body group" style="padding-bottom:10px">
        <div class="group section-form" style="margin: 0px;" id="popup-login-section">
            <div class="form">
                <div class="field-wrapper">
                    <input type="text" class="text" placeholder="用户名/手机号" name="phone" id="popup_user_login_name">
                </div>
                <div id="error_name" class="error-wrapper" style="display:none; margin-top:5px;"><div>用户名不能为空！</div></div>
                <div class="field-wrapper">
                    <input type="password" class="text" placeholder="请输入密码" name="pwd" id="popup_user_login_pwd">
                </div>
                <div id="error_psw" class="error-wrapper" style="display:none; margin-top:5px;"><div>密码不能为空！</div></div>
                <div class="field-wrapper" id="popup-user-login-valid-img" style="display:none;">
                    <input type="text" class="text" style="width:100px; margin-right:5px; float: left;" placeholder="4位验证码" name="txt_valid_code">
                    <img name="img-block" class="captcha-img" alt="">
                    <a name="btn-change-img" style="font-size:13px; line-height:45px;" href="javascript:void(0)">看不清楚？</a>
                </div>
                <div class="error-wrapper" style="display:none; margin-top:5px;"><div>验证码错误！</div></div>
               
                <!--<div class="error-wrapper" style="display:none;  margin-top:5px;"><div></div></div>-->
               
                <div class="btn-wrapper">
                    <a href="javascript:void(0);" id="popup_user_login_submit" class="btn btn-pri">登录</a>
                </div>
                <div class="link-wrapper group clearfix" style="margin-top:10px;">
                    <a href="/forgot_pass.html" class="f-left">忘记密码</a><a href="/reg.html" class="f-right">马上注册</a>
                </div>
            </div>
           
            
        </div>
    </div>
</div>
<!-- 浮窗
<ul class="side-pannel">
				<li class="wechat">
					<i class="icon-kf"></i>
					<span>微信客服</span>
					<div class="wechat" style="top: 0px; height: 30px; line-height: 30px; color: rgb(249, 89, 86); display: none;">
						客服微信号：y1572440627
						<img src="/public/static/home/img/kfwx.jpg" style="width:100%">
					</div>
				</li>
				<li>
					<a href="javascript:void(0);" onclick="window.open('tencent://message/?uin=<?php echo $QQ; ?>&amp;Site=qq&amp;Menu=yes');">						
						<i class="icon-qq"></i>
						<span>QQ客服</span>
					</a>
				</li> -->
			
				
</ul>
			<script>
				$(".side-pannel>li.wechat").hover(function(){
					$(this).children("div.wechat").show();
				},function(){
					$(this).children("div.wechat").hide();
				});
			</script>

<!--认证银行卡-提示绑定-->
<div class="popup" id="popup-id-verify">
    <div class="popup-header group">
        <h2>认证银行卡</h2>
        <a href="javascript:;" class="js-close-popup"><i class="icon icon-close"></i></a>
    </div>
    <div class="popup-body group">
        <div class="field-row group" style="text-align:center">
            <ol class="popup-note">
                <li style="text-align:left;">提现和免费体验前必须先绑定一张银行卡</li>
                <li style="text-align:left;">请务必认真填写真实资料</li>
                <li style="text-align:left;">银行卡采用实名认证，一个身份证只能绑定一个账号</li>
                <li style="text-align:left;">如遇到问题，请联系客服 <label id="m_basic_mobile">021-80321818</label></li>
            </ol>
            <p>为了保障您的账户安全，请先绑定银行卡</p>
        </div>
        <div class="btn-row group">
            <a class="btn btn-pri" href="/ucenter/bankCards.html">去绑定</a>
            <a class="btn btn-pri js-close-popup" href="javascript:;">暂不绑定</a>
        </div>
    </div>
</div>
<!--实名认证-->
<div class="popup" id="popup-realname-auth">
    <div class="popup-header group">
        <h2>实名认证</h2>
        <a href="javascript:;" class="js-close-popup"><i class="icon icon-close"></i></a>
    </div>
    <div class="popup-body group">
        <div class="field-row group" style="text-align:center">
            <ol class="popup-note">
                <li style="text-align:left;">一个身份证对应一个账号</li>
                
                <li style="text-align:left;">如遇到问题，请联系客服 <label id="m_basic_mobile">021-80321818</label></li>
            </ol>
            <p>为了保障您的账户安全，请先进行实名认证</p>
        </div>
        <div class="field-row group">
            <label>真实姓名：</label>
            <div class="field-val"><input id="姓名i" type="text" class="text"></div>
        </div>
        <div id="zsxm_err1" class="error-wrapper" style="margin-left:100px; display:none"><div><i class="icon icon-x-altx-alt"></i>未填写姓名</div></div>
        <div class="field-row group">
            <label>身份证号：</label>
            <div class="field-val">
                <div class="field-val">
                    <input id="身份证i" type="text" class="text">
                </div>
            </div>
        </div>
        <div id="sfzh_err1" class="error-wrapper" style="margin-left:100px; display:none"><div><i class="icon icon-x-altx-alt"></i>请填写准确的身份证</div></div>
        <div class="btn-row group">
            <a id="user_UpdateSelfIdA" class="btn btn-pri" href="javascript:void(0)">确认</a>
            <a class="btn btn-sec js-close-popup" href="javascript:;">取消</a>
        </div>
    </div>
</div>
<script src="/public/static/libs/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="/public/static/home/js/index.js"></script>

</body>
</html>