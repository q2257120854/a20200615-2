 var data = {
        ashare: [
        { id: 0, type: "ashare", question: "点买人", answer: "作为投资人的交易合作方，负责向投资人提供交易谋略的自然人。" },
        { id: 1, type: "ashare", question: "投资人", answer: "作为点买人的交易合作方，负责按点买人交易谋略并利用自有资金和账户进行交易的自然人或法人。" },
        { id: 2, type: "ashare", question: "点买", answer: "指点买人向投资人发出买入指令，平台为点买人撮合投资人。成功后，投资人接受点买人指令并买入点买股。但是如果点买人所点买股票风险过大，投资人有权拒绝指令。" },
        { id: 3, type: "ashare", question: "点卖", answer: "点买人向投资人发出卖出指令，投资人接受点买人指令卖出点买股。" },
        { id: 4, type: "ashare", question: "点买点卖时间", answer: "交易日点买点卖时间为：9:00-11:30 13:00-14:55。" },
        { id: 5, type: "ashare", question: "持仓时间", answer: "2～20个交易日，默认每天自动递延，递延费从账户余额扣除，若余额不足或者不符合递延条件，谋略将由投资人卖出清算，T+20当日必须结算。" },
        { id: 6, type: "ashare", question: "触发止盈", answer: "当合作交易品种的浮动盈亏达到特定数值时，由投资人即时卖出交易品种全部持有数量进行止盈。" },
        { id: 7, type: "ashare", question: "触发止损", answer: "当合作交易品种的浮动盈亏达到特定数值时，由投资人即时卖出交易品种全部持有数量进行止损。" },
        { id: 8, type: "ashare", question: "交易综合费", answer: "每万元点买金额45元，费用包含第一天交易费，管理费以及第二天的递延费。" },
        { id: 9, type: "ashare", question: "履约保证金", answer: "履约保证金为点买人委托平台冻结用于履行交易亏损赔付义务的保证金，结束时根据谋略盈亏清算。保证金越低风险也越大，保证金越高抗风险也越高。" },
        { id: 10, type: "ashare", question: "递延费", answer: "包含平台信息服务费和平台收取用于补偿投资人资金占用费，每万元点买金额18元/天。周末和节假日不收取。" },
        { id: 11, type: "ashare", question: "递延条件", answer: "满足以下2个条件，自动递延：<br/>1、不在黑名单股票<br/>2、当谋略满足公式：（浮动盈亏＋保证金）/交易本金>8％ ，并且余额够缴纳递延费。" },
        { id: 12, type: "ashare", question: "停牌股票", answer: "当发生停牌，点买人必须缴纳停牌期间的递延费(现优惠价每万元点买金额8元/天)，直至复盘卖出结算；若停牌期间不缴纳递延费，一旦累计递延费超过该谋略的履约保证金，视用户放弃该谋略，投资人自动接管，该谋略的盈亏不在跟点买人有关，所有权归投资人。" },
        { id: 13, type: "ashare", question: "盈亏结算", answer: "根据点买人发出指令已卖出，按照实际价格结算；策略到期后，点买人获得%100的交易盈利。<br/>" },
        ],
        astockbuy: [
       {
           id: 0, type: "astockbuy", question: "为什么我点买失败？",
           answer: "1、点买人发起点买后，若60秒内匹配投资人失败，则点买失败，相关资金会退还到点买人账户中。<br/>"
             + "2、盘中涨幅≥8％或跌幅≤-8％时，投资人有权不执行点买人的点买指令，直至股票涨跌幅回落到（-8％,+8%）区间，投资人方接受并执行点买人的点买指令。<br/>"
             + "3、当股票进入《点买风险股名单》时，投资人也有权不执行点买人的点买指令。<br/>"
             + "4、当日点买人选择的股票触及过跌停，投资人也有权不接受点买指令。<br/>"
             + "5、单股最大持仓点买金额为50万，超出就无法在点买该股。<br/>"
             + "6、超过当天可点买次数，无法点买。"
       },
       {
           id: 1, type: "astockbuy", question: "为什么点卖时会部分成交，怎么结算？",
           answer: "由于行情波动过大，点卖时会造成部分成交，只有全部成交后，才会结算该谋略。"
       }, ],
        billing: [
       {
           id: 0, type: "billing", question: "点卖清算后资金何时返还账户余额？",
           answer: "一般清算完后马上会到账户余额里，但是难免出现异常数据时，为了保证成交数据的正确性，我们会人工核实一遍数据，会造成清算时间一定的延迟。"
       },
       {
           id: 1, type: "billing", question: "若清算时出现明显差错怎么办？",
           answer: "若由于系统、接口等问题造成清算出错，我们会在核实数据后对用户该笔交易做资金修正。"
       }, ],
        recharge: [
      {
          id: 0, type: "recharge", question: "怎么充值？",
          answer: "您可以通过网银充值、支付宝转账、银行转账三种方式进行充值。"
      },
      {
          id: 1, type: "recharge", question: "充值到账速度快吗？",
          answer: "网银充值，立马到账。支付宝汇款和银行汇款一般半小时内到账。"
      },
      {
          id: 2, type: "recharge", question: "为什么我用支付宝充值了，账户余额还是0？",
          answer: "支付宝汇款和银行汇款一般半小时内到账。"
      },
      {
          id: 3, type: "recharge", question: "提款到账速度快吗？",
          answer: "正常情况下，提款在1个工作日内处理。当提款数量多，一般处理时间需要1-2个工作日左右，节假日可能会出现延迟。"
      }, ]
    }


    function init() {
        listInit(data.ashare);
        listInit(data.astockbuy);
        listInit(data.billing);
        listInit(data.recharge);

        $(".area li").off("click").on("click", function () {
            var index = $(this).index();
            var type = dataType($(this).parent());
            $(".answer").show();
            $(".main-area").find(".q-row").html(type[index].question);
            $(".main-area").find(".a-row").html(type[index].answer);
            $(this).addClass('hover').siblings().removeClass('hover')
        });
		
		$('.area p').off('click').on('click',function(){
			var ul_boxs=$('.area').find('ul');
			var ul_box=$(this).siblings('ul');
			if(ul_box.hasClass('hide')){
				ul_boxs.hide().addClass('hide');
				$(this).siblings('ul').show().removeClass('hide');
			}else{
				$(this).siblings('ul').hide().addClass('hide')
			}
		})

    }

    function getURLParameter(name) {
        return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [, ""])[1].replace(/\+/g, '%20')) || null;
    }
    function dataType(tar) {
        if (tar.attr("data-type") == "ashare") return data.ashare;
        else if (tar.attr("data-type") == "astockbuy") return data.astockbuy;
        else if (tar.attr("data-type") == "billing") return data.billing;
        else if (tar.attr("data-type") == "recharge") return data.recharge;
    }

    function listInit(obj) {
        $.each(obj, function (i, n) {
            var item = '<li><a>' + n.question + '</a></li>';
            $("." + n.type).find("ul").append(item).attr("data-type", n.type);
        })

    }

	init();
