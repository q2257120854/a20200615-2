<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:64:"/www/wwwroot/feichangpeizi/application/index/view/index/buy.html";i:1540900757;s:65:"/www/wwwroot/feichangpeizi/application/index/view/public/top.html";i:1539839495;s:68:"/www/wwwroot/feichangpeizi/application/index/view/public/footer.html";i:1540301736;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body class="buy_body">
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
<link rel="stylesheet" type="text/css" href="/public/static/home/css/buy.css"/>

<!--A股点买部分-->
<div class="br-content">
<div class="w1024">
<div class="stock-buy">
    <section class="play-area">
        <div class="nav-left">
            <a href="/freetrial.html" style="height: initial;">一元模拟盘体验</a>
            <a href="/buy.html" class="active">A股（T + 1）</a>
        </div>
        <nav>
            <ul class="clearfix">
                <li class="active"><a href="#"><em> 01 </em>| 点买区</a></li>
                <li class=""><a href="/sell.html"><em>02 </em>| 点卖区</a></li>
                <li class=""><a href="/history.html"><em>03 </em> | 结算区</a></li>
            </ul>
        </nav>
        <section class="clearfix">
            <div class="left-info">
                <header>
                	<div class="change-stock">
                        <input id="searchTxt1" class="search_txt" type="text" placeholder="请输入股票名称/代码/简拼">
                        <button id="searchCancel" class="cancel">取消</button>
                        <div id="search_history" class="hide">
                            <table border="0" cellspacing="0" cellpadding="0" class="c9">
                                <thead><tr><th class="nc">名称</th><th>代码</th><th>简拼</th></tr></thead>
                               <tbody><tr class="active"><td>平安银行</td><td>000001</td><td>payh</td></tr><tr><td>万科a</td><td>000002</td><td>wka</td></tr><tr><td>国农科技</td><td>000004</td><td>gnkj</td></tr><tr><td>世纪星源</td><td>000005</td><td>sjxy</td></tr><tr><td>深振业a</td><td>000006</td><td>szya</td></tr><tr><td>全新好<label style="background-color:red">[停牌股]</label></td><td>000007</td><td>qxh</td></tr><tr><td>神州高铁</td><td>000008</td><td>szgt</td></tr><tr><td>中国宝安</td><td>000009</td><td>zgba</td></tr><tr><td>美丽生态</td><td>000010</td><td>mlst</td></tr><tr><td>深物业a</td><td>000011</td><td>swya</td></tr></tbody>
                            </table>
                        </div>
                        <div id="search_cue" class="hide">
                            <table border="0" cellspacing="0" cellpadding="0" class="c9">
                                <thead><tr><th class="nc">名称</th><th>代码</th><th>简拼</th></tr></thead>
                                <tbody><tr class="active"><td>万科a</td><td>000002</td><td>wka</td></tr></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="stock-name">
                        <span id="stockName">招商银行(600036)</span>
                        <button id="changeStock" class="change_stock hide">选择股票</button>
                    </div>
                    
                </header>
                <section class="stock-detail clearfix" data-price="0">
                    <div class="stock-new row f-left">
                        <strong class="" id="nowPrice">00.00</strong><i class="icon stockicon"></i>
                        <span class="up-arrow-box" style="display: inline-block;">
                            <span class="top-part"></span>
                            <span class="bottom-part"></span>
                        </span>
                        <span class="down-arrow-box" style="display: none;">
                            <span class="top-part"></span>
                            <span class="bottom-part"></span>
                        </span>
                        
                        <i class="icon icon-refresh" id="refreshBtn"></i>
                        <span id="num1" class="color font14">--</span>
						<span id="num2" class="color font14">--</span>
                    </div>
                    <div class="stock-price f-right" id="stock-price">
                        <ul class="sell">
                            <li><em>卖⑤</em><b class="red">--</b><i>--</i></li>
                            <li><em>卖④</em><b class="red">--</b><i>--</i></li>
                            <li><em>卖③</em><b class="red">--</b><i>--</i></li>
                            <li><em>卖②</em><b class="red">--</b><i>--</i></li>
                            <li><em>卖①</em><b class="red">--</b><i>--</i></li>
                        </ul>
                        <ul class="buy">
                            <li><em>买①</em><b class="red">--</b><i>--</i></li>
                            <li><em>买②</em><b class="red">--</b><i>--</i></li>
                            <li><em>买③</em><b class="red">--</b><i>--</i></li>
                            <li><em>买④</em><b class="red">--</b><i>--</i></li>
                            <li><em>买⑤</em><b class="red">--</b><i>--</i></li>
                        </ul>
                    </div>
                </section>
                <section class="stock-figure">
                    <ul class="row">
                        <li class="active" id="chartContro">分时</li>
                        <li class="hide" id="chartKContro">k线</li>
                    </ul>
                    <!-- 为ECharts准备分时图 -->
   					<div class="figure active" id="chart" style="-webkit-tap-highlight-color:transparent;user-select:none;background:none;cursor:default;display:block;position:relative;overflow:hidden;width:520px;height:280px;"></div>
                    <!--<div class="figure " id="chart" _echarts_instance_="1498120573127" style="-webkit-tap-highlight-color: transparent; user-select: none; background: none; cursor: default; display: none;"><div style="position: relative; overflow: hidden; width: 520px; height: 240px;"><div data-zr-dom-id="bg" class="zr-element" style="position: absolute; left: 0px; top: 0px; width: 520px; height: 240px; user-select: none;"></div><canvas width="520" height="240" data-zr-dom-id="0" class="zr-element" style="position: absolute; left: 0px; top: 0px; width: 520px; height: 240px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></canvas><canvas width="520" height="240" data-zr-dom-id="1" class="zr-element" style="position: absolute; left: 0px; top: 0px; width: 520px; height: 240px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></canvas><canvas width="520" height="240" data-zr-dom-id="_zrender_hover_" class="zr-element" style="position: absolute; left: 0px; top: 0px; width: 520px; height: 240px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></canvas></div></div>-->
   					<div class="figure hide" id="chartK" style="-webkit-tap-highlight-color:transparent;user-select:none;background:none;cursor:default;display:none;position:relative;overflow:hidden;width:520px;height:280px;"></div>
                    <!--<div class="figure hide" id="chartk" _echarts_instance_="1498120573128" style="-webkit-tap-highlight-color: transparent; user-select: none; background: none; display: block; cursor: default;"><div style="position: relative; overflow: hidden; width: 520px; height: 240px;"><div data-zr-dom-id="bg" class="zr-element" style="position: absolute; left: 0px; top: 0px; width: 520px; height: 240px; user-select: none;"></div><canvas width="520" height="240" data-zr-dom-id="0" class="zr-element" style="position: absolute; left: 0px; top: 0px; width: 520px; height: 240px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></canvas><canvas width="520" height="240" data-zr-dom-id="1" class="zr-element" style="position: absolute; left: 0px; top: 0px; width: 520px; height: 240px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></canvas><canvas width="520" height="240" data-zr-dom-id="_zrender_hover_" class="zr-element" style="position: absolute; left: 0px; top: 0px; width: 520px; height: 240px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></canvas><div class="echarts-tooltip zr-element" style="position: absolute; display: block; border-style: solid; white-space: nowrap; transition: left 0.1s, top 0.1s; background-color: rgb(255, 255, 255); border-width: 1px; border-color: rgb(204, 204, 204); border-radius: 4px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 11px; line-height: 17px; padding: 10px; left: 143.5px; top: 37px;">2017年04月17日<br>最高：<span style="color:#DD2200;">18.9</span><br>最低：<span style="color:#00A800;">18.6</span><br>收盘：<span style="color:#F96900;">18.88</span></div></div></div>-->
                	<!--loading-->
                	<div class="loading"></div>
                </section>
                <section class="stock-info" id="stock-info">
                    <h3>股票信息</h3>
                    <ul class="row">
                        <li class="open"><span class="l">今开</span><span class="r">--</span></li>
                        <li class="amplitude"><span class="l">振幅</span><span class="r">--</span></li>
                        <li class="high"><span class="l">最高</span><span class="r">--</span></li>
                        <li class="low"><span class="l">最低</span><span class="r">--</span></li>
                        <li class="max"><span class="l">涨停价</span><span class="r">--</span></li>
                        <li class="min"><span class="l">跌停价</span><span class="r">--</span></li>
                        <li class="volume"><span class="l">成交量</span><span class="r">--手</span></li>
                        <li class="amount"><span class="l">成交额</span><span class="r">--万</span></li>
                    </ul>
                </section>
            </div>
            <div class="right-buy">
                <div class="buy_price">
                    <p class="top">推荐买入金额<em></em><span class="f-right">今天还可点买<b id="restChance"><?php if($left != ''): ?><?php echo $left; else: ?>-<?php endif; ?></b>次</span></p>
                    <ul id="buy_price_ul"><li class="active">1万</li><li> 2万</li><li> 3万</li><li> 5万</li><li> 10万</li><li> 20万</li><li> 30万</li><li> 50万</li></ul>
                </div>
                 <div class="open-time">
                    <span>谋&nbsp;略&nbsp;金&nbsp;额</span>
                    <div class="delay_tip" style="margin-right:0;"><i class="icon icon-help"></i><div class="showtip">最高策略金额50万元，除平台推荐金额之外，用户可自行设定点买金额。</div></div>
                    <input type="tel" style="width: 150px;height: 30px;border-radius: 5px;color: rgb(51, 51, 51);margin: 10px 15px;border: 1px solid #DBDBDB;text-align: center;" id="buy_number" maxlength="2" onkeypress="if(event.keyCode==13||event.which==13){return false;}" onkeyup="this.value=this.value.replace(/[^\.\d]/g,'');this.value=this.value.replace('.','');" placeholder="请输入金额">万元
                </div>
                <p class="efficiency">资金使用率 可买入<span id="gu">-</span>股，资金利用率<span id="lyl">-</span></p>
                <div class="open-time">
                    <span>持&nbsp;仓&nbsp;时&nbsp;间</span>
                    <div class="delay_tip"><i class="icon icon-help"></i><div class="showtip">最短2天，最长20天，交易综合费按天支付，默认每天自动延期，自动从账户余额扣除交易综合费(余额不足时自动终止)</div></div>
                    <ul class="work-interval">
                        <li class="active">T+1|D</li>
                    </ul>
                </div>
                <div class="check-surplus">
                    <span>触&nbsp;发&nbsp;止&nbsp;盈</span>
                    <div class="delay_tip">
                        <i class="icon icon-help"></i><div class="showtip">当合作交易品种的浮动盈亏率达到特定数值时，投资人有权即时卖出交易品种全部持有数量进行止盈。</div>
                    </div>
                    <ul id="check-surplus_ul"><li class="active" data-val="50">2500</li></ul>
                </div>
                <div class="stop-loss choose-loss" id="stop-loss" style="margin-bottom: 15px;">
                    <span>触&nbsp;发&nbsp;止&nbsp;损</span>
                    <div class="delay_tip"><i class="icon icon-help"></i><div class="showtip">当合作交易品种的浮动盈亏率达到特定数值时，投资人有权即时卖出交易品种全部持有数量进行止损。</div></div>
                    <ul id="stop-loss_ul"><li class="active" data-val="8">-1000</li><li data-val="6">-1333</li><li data-val="5">-1700</li></ul>
                </div>
                <div class="open-time" style="display:none">
                     <span>盈&nbsp;利&nbsp;分&nbsp;配</span>
                    <div class="delay_tip"><i class="icon icon-help"></i><div class="showtip">当策略盈利时，</br>策略人将获得大部分盈利</div></div>
                    <ul class="work-interval">
                        <li class="active">90%</li>
                    </ul>
                </div>
                <div class="com_fee">
                    <span>交易综合费</span>
                    <div class="delay_tip"><i class="icon icon-help"></i><div class="showtip">交易综合费包含第一天的交易费，第二天的递延费，每万元点买金的交易综合费为50元，每万元点买金的递延费<?php echo $delayFee; ?>元/天。</div></div>
                    <span class="delete_price"><strong id="publicFee"><?php echo $delayFee * 2; ?></strong>元（包括前两日）</span>
                    
                </div>
                <div class="perf_bond">
                    <span>履约保证金</span>
                    <div class="delay_tip"><i class="icon icon-help"></i><div class="showtip">履约保证金为点买人委托平台冻结用于履行交易亏损赔付义务的保证金，结束时根据策略盈亏结算。保证金越低风险也越大，保证金越高抗风险也越高。</div></div>
                    <strong class="br-bz" id="guaranteeFee">1250</strong>元
                </div>
                <div class="delay_condition">
                    <p>
                    	<span>递 延 费</span>
                    	<em id="delay_fee"><?php echo $delayFee; ?></em>元/天 <span class="fkxy">(浮亏小于<em id="delay_line">650</em>时允许递延)</span>
                    </p>
                </div>
                <div class="protocol_row">
                    <p><input type="checkbox" name="agree_pro" id="agree_pro" checked="true">我已阅并签署以下协议</p>
                    <a href="/protocol_1.html" target="_blank">《金龙策略策略人参与沪深A股交易合作涉及费用及资费标准》</a>
                    <a href="/protocol_2.html" target="_blank">《金龙策略投资人与点买人参与沪深A股交易合作协议》</a>
                    <a href="/protocol_3.html" target="_blank">《金龙策略服务协议》</a>
                </div>
                <button id="btn_buy" >点买</button>
                <p id="su_sm_p" class="total hide">当前可点买总额：210万；单股点买金额不超过：50万。</p>
            </div>
        </section>
    </section>
</div>

</div>
</div>

<!--弹出层-->
<!--点买确认-->
<div class="popup popup-big" id="popup-buy" style="display: none; top: 0px;">
    <div class="popup-header group">
        <h2>点买确认</h2>
        <a href="javascript:;" class="js-close-popup"><i class="icon icon-close"></i></a>
    </div>
    <div class="popup-body group">
        <table border="0" cellspacing="0" cellpadding="0" class="popup-sell-tb">
            <tbody><tr>
                <td width="15%">交易品种：</td>
                <td width="35%" id="t_stock_name">-</td>
                <td width="15%">交易本金：</td>
                <td width="35%" class="c-red" id="t_principal">-</td>
            </tr>
            <tr>
                <td>持仓时间：</td>
                <td name="work-interval">截止至下个交易日 15:00:00</td>
                <td>交易数量：</td>
                <td id="t_shou">1手</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;市价：</td>
                <td>五档最优成交</td>
                <td colspan="2"><a id="hmdA" href="javascript:void(window.open(&#39;/policy/restricted&#39;))" style="display:none;font-size:18px;color:red">该股票已被列入黑名单，点我查看全部</a></td>
            </tr>
        </tbody></table>
        <div class="btn-div">
            <button class="btn btn-pri" id="popup-confirm-btn" >确定</button>
            <a href="javascript:;" class="js-close-popup btn btn-grey">取消</a>
            <div class="f-right timer" style="display:none;"><b class="red">5秒</b>后自动返回</div>
        </div>
    </div>
</div>

<!--温馨提示（协议）-->
<div class="popup popup-small popup-agree-tip" id="popup-agree-tip" style="display: none; top: 0px;">
    <div class="popup-header group">
        <h2>温馨提示</h2>
        <a href="javascript:;" class="js-close-popup"><i class="icon icon-close"></i></a>
    </div>
    <div class="popup-body group">
        <i class="icon icon-warning"></i>
        <div class="protocol-row">
            <a href="http://feichangcl.com/Policy/protocol_1" target="_blank">&gt;《金龙策略点买人参与沪深A股交易合作涉及费用及资费标准》</a>
            <a href="http://feichangcl.com/Policy/protocol_2" target="_blank">《金龙策略投资人与策略人参与沪深A股交易合作协议》</a>
            <a href="http://feichangcl.com/Policy/protocol_3" target="_blank">《金龙策略服务协议》</a>
        </div>
        <button class="js-close-popup">确定</button>
    </div>
</div>
<!--  遮罩  -->
<div id="popBg" style="width:100%;height:100%;z-index: 0;background: #eee; opacity: 0.5;position: fixed;left: 0; top: 0;display: none"></div>

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
<script>
    var dealPoundage = parseInt("<?php echo $dealPoundage; ?>");
    var delayFee = parseInt("<?php echo $delayFee; ?>");
    var dealFee = parseInt("<?php echo $dealFee; ?>");
    var publicFee = parseInt("<?php echo $delayFee * 2 + $dealFee; ?>");
    var delayLineRate = parseFloat("<?php echo $delayLineRate; ?>");
    var stopLossRate = parseFloat("<?php echo $stopLossRate; ?>");
</script>
<script src="/public/static/home/js/echarts.min.js"></script>
<script src="/public/static/home/js/buy1.js"></script>

<script type="text/javascript">     
      /**
 * 判断当前时间是否在9:30-11:30, 13:00-15:00（交易时间）
 */
function isTradingTime(){
	var date = new Date();
	//判断是不是周末
	var dt=date.getDay();
	if(dt=='6'||dt=='7'){
		return false;
	}
	//判断当前时间是否在9:30-11:30, 13:00-15:00
    var h = date.getHours();
    var mi = date.getMinutes();
    var s = date.getSeconds();
    if(h < 10){
        h = "0" + h;
    }
    if(mi < 10){
        mi = "0"+ mi;
    }
    if(s < 10){
        s = "0" + s;
    }
    var curTime = h + ":" + mi + ":" + s;
//  console.log(curTime);
    if( curTime >= "09:30:00" && curTime <= "11:30:00" || curTime >= "13:00:00" && curTime <= "15:00:00" ){
        return true;
    }
    return false;
}
   
   // 如果不在交易时间，不能点买
   if(!isTradingTime() ){
     $('#btn_buy').attr('disabled',true).css({'background':'#767679'}).html('点买时间9:30-11:30, 13:00-14:58');
   }
   </script>
</body>
</html>