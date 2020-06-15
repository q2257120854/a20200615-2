var stockChange = $(".play-area").find(".change-stock");
var historyBox=$(".play-area").find('.search_history');
var cue=$('#search_cue');
var html_default='<tr class="active"><td>万科A</td><td>000002</td><td>wka</td></tr>';
var stopShare=true;

//选中的股票代码
var selectedCode = "600036";

//点击标题显示输入框
////$(".stock-name").on("click", function (e) {
//	e.stopPropagation();
//  stockChange.show();
   
	//  输入框键盘按下事件
	
    $('#searchTxt1').focus().off('keyup').on('keyup',function(e){
    	e.stopPropagation();
    	var tbody = $("#search_history, #search_cue").find("tbody:visible");
    	var keywords=$(this).val().toLowerCase();//关键词
    	var keycode=e.keyCode;//键盘码
    	//默认
		if(keywords==""){
			   tbody.html(html_default);
		}
		
    	//上选
		if(keycode=='38'){
			goUp(tbody);
			return;
		}
		//下选
		if(keycode=='40'){
			goDown(tbody);
			return;
		}
		//enter
		if(keycode=='13'){
			tbody.find("tr.active").trigger("click")
			return;
		}
		//如果不是上面几个，即表示查询
		if(keycode!='38'&&keycode!='40'&&keycode!='13'){
			if(keywords.length){//如果值不为空
				searchCue(keywords)//非历史(cue)框的发送给后台查询
			}
		}
		//选中股票，改变标题，隐藏搜索框
		selectAShare($('#search_cue tr'));

    });

//});

	
//取消
$('#searchCancel').click(function(){
		$('#searchTxt1').val("");
		cue.hide();
});

$('#searchTxt1').click(function(e){
	e.stopPropagation();
});

$('body').click(function(e){
    //  输入框消失事件
    cue.hide();
    initInput();
})


//---封装的函数
//第一个亮
function selectInit(tbody) {
			var tbody = $("#search_history, #search_cue").find("tbody:visible");
            var tr = tbody.find("tr");
            if (!tr.eq(0).hasClass("empty") || !tr.hasClass("active")) {
                tr.eq(0).addClass("active");
            }

            tbody.mouseenter(function () {
                tr.eq(0).removeClass("active");
            });
}

/**
 * 非历史(cue)框的发送给后台查询函数
 */
	function searchCue(keywords){
		var tbody = cue.find("tbody");
//		console.log(tbody+'00')
		$("#search_history").hide();//历史框隐藏掉
		//发送请求
		$.ajax({
			type:"get",
			url:"/index/Alistock/getSharesByKeywords",
			data:{keywords:keywords},
			dataType:'json',
			success:function(data){
					//1.清空tbody
				 	cue.find("tbody").html("");
				 	//2.渲染(if如果没数据，else如果有数据)
				   	var html='';
				   	if(data.data==null||data.data==''){
				   		html='<tr class="empty"><td colspan="3">暂无数据</td></tr>';
				   	}else{
				   		for(var i=0;i<data.data.length&&i<10;i++){
				   		html+='<tr><td>'+data.data[i].name+'</td><td>'+data.data[i].code+'</td><td>'+data.data[i].pinyin+'</td></tr>';
				   		}
				   	}
				   	tbody.html(html);
				   	//3.cue框显示
				   	cue.show();
				   	//4.亮第一个
				   	selectInit();
				 	//5.选中股票，改变标题，隐藏搜索框
				 	selectAShare($('#search_cue tr'));
            		//6.发送给后台查询股票行情
			}
		});
	}

/**
 * 选中股票，改变标题，隐藏搜索框
 */
function selectAShare(dom){
	dom.on('click',function(e){
		var ashareName=$(this).find('td').eq(0).html();
		var ashareCode=$(this).find('td').eq(1).html();
		$('.stock-name').find('span').html(ashareName+'('+ashareCode+')');
		//隐藏搜索框，值清空
		cue.hide();
	    $("#searchTxt1").val("");

		selectedCode = ashareCode;

        //更新股票实时数据和分时数据
        stockInit();

        //更新股票K线图
        initKChart();
	});
}

/**
 * 向下
 */
function goDown(tbody) {
            var index = tbody.find("tr.active").index();
            if (index < tbody.find("tr").length - 1) {
                tbody.find("tr").removeClass("active").eq(index + 1).addClass("active");
            }
}

/**
 * 向上
 */
function goUp(tbody) {
            var index = tbody.find("tr.active").index();
            if (index > 0) {
                tbody.find("tr").removeClass("active").eq(index - 1).addClass("active");
            }
}


/**
 * 将输入框以及下方弹框恢复默认属性
 */
function initInput(){
	$('#searchTxt1').val("");
    cue.find('tbody').html(html_default); 
}

//echarts
$('#chartContro').on('click',function(){
	$(this).siblings().removeClass('active');
	$(this).addClass('active');
	$('#chart').show();
	$('#chartK').hide();
	
})
$('#chartKContro').on('click',function(){
	$(this).siblings().removeClass('active');
	$(this).addClass('active');
	$('#chartK').show();
	$('#chart').hide();
	
})

//初始化页面 获取股票实时数据、分时数据、K线图
function stockInit(){
	//获取股票实时数据
	getStockInfo();

	//获取分时数据
	getTimeLine();
}


//获取分时数据
function getTimeLine(){
	$.post("/index/Alistock/getTimeLine", {code:selectedCode}, function(data){

		if(data.showapi_res_code != '0' || data.showapi_res_body.ret_code != '0'){
			return;
		}
		var arr = data.showapi_res_body.dataList[0].minuteList;
			//二维数组里面有平均价，现在价格，时间（分钟），成交量等信息
			var chartVal = [];
            //遍历
             $.each(arr, function () {
                var inVal = [];
                var price=this.nowPrice;
            //avg_price:6.456,price:6.45,time:"09:30",totalAmount:7046840.3080199985,totalVolume:1094569.7899999998,volume:32666.5
                    if (price >= 0) {
                    	//现在日期2017-07-18
                        var dVal = new Date().format("yyyy-MM-dd");// dVal = "2017-07-18"
						//分割现在日期字符串
                        var s1arr1 = dVal.split("-");//s1arr1 = ["2017", "07", "18"]
                        var s1arr2=this.time.substring(0,2)+':'+this.time.substring(2,4);
                        s1arr2 = s1arr2.split(":");//s1arr2 = ["09", "36"]
                        if (s1arr2.length == 2) {
                            s1arr2.push("00");//s1arr2 = ["09", "36", "00"]
                        }
						//获取毫秒数
						//rVal = 1500341760000
                        var rVal = new Date(s1arr1[0], s1arr1[1] - 1, s1arr1[2], s1arr2[0], s1arr2[1], s1arr2[2]).getTime();
                        //毫秒加进数组
                        inVal.push(rVal);
                        //价格加进数组
                        inVal.push(price);
                        //数组加进chartVal数组
                        chartVal.push(inVal);
                        //现在有180多个价格>0的二维数组，数组【0】是毫秒数，【1】是价格
                    }
                    //console.log(inVal);
                    //console.log(chartVal);
           	});
			var yestclose = data.showapi_res_body.dataList[0].yestclose;
			//yestclose = "25.11"，昨天收盘价

			//dataList是几百个二维数组，name是时间，value是数组，包括【0】时间和【1】价格
			//绘制分时图
			var dataList = { "records": chartVal, "y_close": yestclose };
//			console.log(dataList);
//			console.log('0000');
			initTimeLine.chartLine.init('#chart',dataList );
			
			//loading
        	$('.loading').hide();

	}, 'json');
		
}

//获取股票实时数据
function getStockInfo(){
	$('#btn_buy').html('点买').attr('disabled',false).css({'background':'#E11923'})
	$.post("/index/Alistock/getStockInfo", {code:selectedCode}, function(data){
        if(data.code != '0'){
            return;
        }
        var map = data.data;
//		$("#stockName").html(map.name + "(" + selectedCode + ")");
        var nowPrice = parseFloat($("#nowPrice").html());
		if(nowPrice > map.nowPrice){//比较最新价与原来的价格
			$(".stock-detail .up-arrow-box").hide();
			$(".stock-detail .down-arrow-box").css("display", "inline-block");
		}else if(nowPrice < map.nowPrice){
			$(".stock-detail .up-arrow-box").css("display", "inline-block");
			$(".stock-detail .down-arrow-box").hide();
		}

        // 如果不在交易时间，判断当前价格和昨日收盘价格
        if(!isTradingTime() ){
            if(nowPrice < map.closePrice){
                $(".stock-detail .up-arrow-box").hide();
                $(".stock-detail .down-arrow-box").css("display", "inline-block");
            }else{
                $(".stock-detail .up-arrow-box").css("display", "inline-block");
                $(".stock-detail .down-arrow-box").hide();
            }
            $('#btn_buy').attr('disabled',true).css({'background':'#767679'}).html('点买时间9:30-11:30, 13:00-14:58');
        }
        if(nowPrice < map.closePrice){
            $("#nowPrice").removeClass('red').removeClass('green').addClass("green");
        }else if(nowPrice > map.closePrice){
            $("#nowPrice").removeClass('red').removeClass('green').addClass("red");
        }
        
        //渲染页面价格
       	map.nowPrice=(map.nowPrice-0).toFixed(2);
		$("#nowPrice").html(map.nowPrice);

		//改变价格颜色
		if(map.diff_money > 0){
				$(".color").removeClass('red').removeClass('green').addClass("red");
			}else if(map.diff_money < 0){
				$(".color").removeClass('red').removeClass('green').addClass("green");
			}
		$("#num1").html(map.diff_money);
		$("#num2").html(map.diff_rate + "%");
		
			//卖⑤...卖①...买①...买⑤
		var bs = ["sell5_m", "sell5_n", "sell4_m", "sell4_n", "sell3_m", "sell3_n", "sell2_m", "sell2_n", "sell1_m", "sell1_n",
			"buy1_m", "buy1_n", "buy2_m", "buy2_n", "buy3_m", "buy3_n", "buy4_m", "buy4_n", "buy5_m", "buy5_n"];
		$("#stock-price li > b, .stock-price li > i").each(function(i, o){
            var t = map[bs[i]];
            if(i % 2 == 1){
                t = parseInt(map[bs[i]] / 100);
            }else{
                t = Number(t).toFixed(2);
            }
			$(o).html(t);
		});

        //今开 最高 ...... 成交额
        bs = ['openPrice', 'swing', 'todayMax', 'todayMin', 'highLimit', 'downLimit', 'tradeNum', 'tradeAmount' ];
        $("#stock-info li > span.r ").each(function(i, o){
            if(bs[i] == 'swing'){
                $(o).html(map[bs[i]] + "%");
            }else if(bs[i] == 'tradeNum'){
                $(o).html(map[bs[i]] / 100 + "手");
            }else if(bs[i] == 'tradeAmount'){
                $(o).html(map[bs[i]] / 10000 + "万");
            }else{
                $(o).html(map[bs[i]]);
            }
        });

        updateStockNumber();
        
        //停牌判断
         stopShare=true;
	     if(Number(map.openPrice).toFixed(2)=='0'||Number(map.openPrice).toFixed(2)=='0.00'){
	        	$('#btn_buy').html(map.remark).attr('disabled',true).css({'background':'#767679'})
	        	stopShare=false;
	        	updateMoneyRate('empty');
				return;
			}
        
         //更新资金利用率数据
		updateMoneyRate();

	}, 'json')
}

function updateMoneyRate(empty){
	if(empty){
    	$("#gu").html('-');
    	$("#lyl").html('-');
    }else{
    	var price = parseInt($("#buy_price_ul > li.active").html());
	    //可买入-股，资金利用率-%
	    var nowPrice = parseFloat( $("#nowPrice").html() );
	    var gu=Math.floor((price/nowPrice)/100)*100;
	    var lyl=(nowPrice*gu/(price)*100).toFixed(2) + "%";
	    $("#gu").html(gu);
	    $("#lyl").html(lyl);
    }
    
    
    
}

$(function(){
    //获取股票实时数据和分时数据。每几秒钟就刷新一次
	stockInit();

    //获取股票K线图。只在页面打开时加载一次，不需要再刷新
    initKChart();


});


var freshTimeInterval = 10 * 1000;
var freshTimes = 0;
//定时器 获取实时数据（最新数据）, 每几秒钟就刷新一次
setInterval(function(){
    if(!isTradingTime()||!stopShare){ // 如果不在交易时间就不必刷新数据
        return ;
    }
    freshTimes ++ ;
    if(freshTimes > 10){
        freshTimeInterval = 60 * 1000;
    }
    //获取股票实时数据
    getStockInfo();

}, freshTimeInterval);


//定时器 获取分时数据
setInterval(function(){return;
    if(!isTradingTime()){ // 如果不在交易时间就不必刷新数据
        return ;
    }
    //获取分时数据
    getTimeLine();
}, 60 * 1000);


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

/*
setInterval(function () {return;

    for (var i = 0; i < 5; i++) {
        data.shift();
        data.push(randomData());
    }

    myChart.setOption({
        series: [{
            data: data
        }]
    });
}, 1000);
*/
    



function splitData(rawData) {
    var categoryData = [];
    var values = []
    for (var i = 0; i < rawData.length; i++) {
        categoryData.push(rawData[i].splice(0, 1)[0]);
        values.push(rawData[i])
    }
    return {
        categoryData: categoryData.reverse(),
       	values: values.reverse()
    };
}

function calculateMA(dayCount) {
    var result = [];
    for (var i = 0, len = data0.values.length; i < len; i++) {
        if (i < dayCount) {
            result.push('-');
            continue;
        }
        var sum = 0;
        for (var j = 0; j < dayCount; j++) {
            sum += data0.values[i - j][1];
        }
        result.push(sum / dayCount);
    }
    return result;
}



function initKChart(){
    $.post("/index/Alistock/getKLine", {code:selectedCode}, function(data){
        if(data.showapi_res_code != '0' || data.showapi_res_body.ret_code != '0'){
            return;
        }
        var dataList = data.showapi_res_body.dataList;
        var data0 = [];
        for(var i = 0; i < dataList.length; i++){
            var day = dataList[i]['time'];
            day = day.substring(0,4) + "/" + day.substring(4,6) + "/" + day.substring(6,8);
            data0[i] = [day, dataList[i]['open'], dataList[i]['close'], dataList[i]['min'], dataList[i]['max']];
        }
        setKChartData(data0);
    }, 'json');
}

function setKChartData(dataArray) {

//---K线图
    //初始化K线图
    var myChartK = echarts.init(document.getElementById('chartK'));
    // 数据意义：开盘(open)，收盘(close)，最低(lowest)，最高(highest)
    var data0 = splitData(dataArray);

    option = {
        title: {
            text: '股市K线图',
            left: 0
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross'
            },
            formatter:function(data){
            	var dom='开盘价'+data[0].value[1]+'</br>';
            	dom+='收盘价'+data[0].value[2]+'</br>';
            	dom+='最低价'+data[0].value[3]+'</br>';
            	dom+='最高价'+data[0].value[4];
            	return dom
        	}
        },
        legend: {
            data: ['日K', 'MA5', 'MA10', 'MA20', 'MA30']
        },
        grid: {
            left: '10%',
            right: '10%',
            bottom: '15%'
        },
        xAxis: {
            type: 'category',
            data: data0.categoryData,
            scale: true,
            boundaryGap: false,
            axisLine: {onZero: false},
            splitLine: {show: false},
            splitNumber: 20,
            min: 'dataMin',
            max: 'dataMax'
        },
        yAxis: {
            scale: true,
            splitArea: {
                show: true
            }
        },
        dataZoom: [
            {
                type: 'inside',
                start: 0,
                end: 100
            },
            {
                show: true,
                type: 'slider',
                y: '90%',
                start: 0,
                end: 100
            }
        ],
        series: [
            {
                name: '日K',
                type: 'candlestick',
                data: data0.values,
                markPoint: {
                    label: {
                        normal: {
                            formatter: function (param) {
                                return param != null ? Math.round(param.value) : '';
                            }
                        }
                    },
                    data: [
                        {
                            name: 'XX标点',
                            coord: ['2013/5/31', 2300],
                            value: 2300,
                            itemStyle: {
                                normal: {color: 'rgb(41,60,85)'}
                            }
                        },
                        {
                            name: 'highest value',
                            type: 'max',
                            valueDim: 'highest'
                        },
                        {
                            name: 'lowest value',
                            type: 'min',
                            valueDim: 'lowest'
                        },
                        {
                            name: 'average value on close',
                            type: 'average',
                            valueDim: 'close'
                        }
                    ],
                    tooltip: {
                        formatter: function (param) {
                            return param.name + '<br>' + (param.data.coord || '');
                        }
                    }
                },
                markLine: {
                    symbol: ['none', 'none'],
                    data: [
                        [
                            {
                                name: 'from lowest to highest',
                                type: 'min',
                                valueDim: 'lowest',
                                symbol: 'circle',
                                symbolSize: 10,
                                label: {
                                    normal: {show: false},
                                    emphasis: {show: false}
                                }
                            },
                            {
                                type: 'max',
                                valueDim: 'highest',
                                symbol: 'circle',
                                symbolSize: 10,
                                label: {
                                    normal: {show: false},
                                    emphasis: {show: false}
                                }
                            }
                        ],
                        {
                            name: 'min line on close',
                            type: 'min',
                            valueDim: 'close'
                        },
                        {
                            name: 'max line on close',
                            type: 'max',
                            valueDim: 'close'
                        }
                    ]
                }
            },

        ]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChartK.setOption(option);

}

//点击刷新按钮
var refreshBtnDisabled = false;
$("#refreshBtn").off().click(function(e){
    if(refreshBtnDisabled){
        return;
    }
    refreshBtnDisabled = true;
    stockInit();
    //最多2秒钟点击一次
    setTimeout(function(){
        refreshBtnDisabled = false;
    }, 2000);
});

//"点买"按钮
$("#btn_buy").click(function(e){
	var agree_val=$('input[name="agree_pro"]:checked').val()
	if(!agree_val){
		tool.popup_err_msg("请阅读并签署谋略协议");
		return;
	}
    $.post("/index/index/isLogin", {}, function(data){
        if(data != 1){
            //alert("请先登录")
            tool.popup.showPopup($("#popup-user-login"));
        }else{
            $("#popup-buy").show();
            $("#popBg").show();
        }
    });

    updateStockNumber();


});
$("#popup-buy .js-close-popup").click(function(e){
    $("#popup-buy").hide();
    $("#popBg").hide();
});

//点买弹出层的确定按钮
$("#popup-confirm-btn").click(function(e){
    var params = {};
    params['stockCode'] = selectedCode;

    $.post("/index/ucenter/freetrialBuy", params, function(data) {
        if(data.code == '0'){
            tool.popup_err_msg("交易成功");
            location.href = "/freetrialSell.html";
        }else{
            tool.popup_err_msg(data.msg);
            $('#popBg').hide();
        }
    }, 'json');
});

//根据股票实时价格 更新弹出层的交易数量
function updateStockNumber(){
    $("#t_stock_name").html($("#stockName").html());
    var t_principal = parseInt($("#buy_price_ul > li.active").html()) ;
    $("#t_principal").html(t_principal);

    var nowPrice = parseFloat( $("#nowPrice").html() );
    var amount = parseInt($("#buy_price_ul > li.active").html());
    $("#t_shou").html(parseInt(amount / nowPrice / 100) + "手");
}

var initTimeLine={
        chartLine: {
            chart: undefined,
            init: function (selector, json, full) {
                if (!json || !json.records)
                    return false;
                if (this.chart) {
                    this.chart.clear();
                    //释放非托管资源？
                    this.chart.dispose();
                    this.chart = undefined;
                }
                //找到html元素#chart
                var myChart = echarts.init($(selector).get(0));
                
                var xdata = [], ydata = [];
                var ymin, ymax;   
                //遍历数据，json.records是毫秒数+价格
                
                $.each(json.records, function (i, n) {//第一次   i = 0, n = [1500341400000, 6.45]
                    if (i == 0) {
                        ymin = ymax = n[1];  //ymin = ymax=6.45
                    }
                    xdata.push(n[0])//xdata=1500341400000，1500341400011
                    //比较找出最小价格和最大价格
                    ymin = ymin > n[1] ? n[1] : ymin;
                    ymax = ymax < n[1] ? n[1] : ymax;
                    ydata.push(n[1]);//ydata=6.45，6.46
                });
                //这时xdata是一个数组，里面是毫秒数；ydata是价格的数组
                var a = ymin, b = json.y_close, c = ymax;
                //a是最小价格，b是收盘价，c是最大价格
                var ab = Math.abs(b - a);//收盘价往上y最大绝对值
                var cb = Math.abs(c - b);//收盘价往下y最大绝对值

                var speed = ab > cb ? ab : cb;//离中心线最远的点
                //console.log(speed, b);
                var min = a > b ? (b > c ? c : b) : a;//找到a，b，c的最小值
                
                if (a >= b && c >= b)//？？
                    min = min - speed;
                //ymin = 0;
                //ymax = speed * 2;
                ymin = json.y_close - speed * 1.2;
                //最低价=收盘价-远点*1.2
                ymax = (+json.y_close) + speed * 1.2;
                //最高价=收盘价+远点*1.2
//              for (var i = 0; i < ydata.length; i++) {
//                  //ydata[i] = ydata[i] - min
//              }
                full = full || 242;//？
                for (var i = 0; i < full - xdata.length; i++) {
                    xdata.push("-");
                    ydata.push("-");
                }
                //标记线，昨天的收盘价
                var markLineData = [
                     [
                          { name: '', xAxis: 0, yAxis: json.y_close },
                          { name: '', xAxis: xdata.length - 1, yAxis: json.y_close }
                     ]
                ];
                var b_date=new Date(xdata[0]);
                var b_y= b_date.getFullYear();//year
                var b_m= (b_date.getMonth() + 1)<10?'0'+(b_date.getMonth()+1):(b_date.getMonth()+1);//month 
                var b_d= b_date.getDate()<10?'0'+b_date.getDate():b_date.getDate(); //day 
                //ymax = ymax * 1.01;
                //ymin = ymin * 0.99;
                //var markLineData = [
                //     [
                //          { name: '昨日收盘', xAxis: 0, yAxis: json.y_close },
                //          { name: json.y_close, xAxis: xdata.length - 1, yAxis: json.y_close }
                //     ]
                //];
                var config = {
                    animation: false,
                    title: {
                        show: false
                    },
                    grid: {
                        x: 40,
                        x2: 45,
                        y: 5,
                        y2: 5,
                        borderColor: "#eee"
                    },
                    tooltip: {
                        trigger: 'axis',
                        borderColor: "#ccc",
                        showDelay: 10,
                        hideDelay: 10,
                        transitionDuration: 0.1,
                        borderWidth: 1,
                        backgroundColor: "#ffffff",
                        textStyle: { color: "#666", fontSize: 11, fontFamily: "微软雅黑" },
                        padding: 10,
                        formatter: function (data) {
                        	//时间
                            var date = new Date(data[0].name-0);
                            var y= date.getFullYear();//year
                            var m= (date.getMonth() + 1)<10?'0'+(date.getMonth()+1):(date.getMonth()+1);//month 
                            var d= date.getDate()<10?'0'+date.getDate():date.getDate(); //day 
                            var h= date.getHours()<10?'0'+date.getHours():date.getHours(); //h
                            var mm= date.getMinutes()<10?'0'+date.getMinutes():date.getMinutes(); //m
                            var s= date.getSeconds()<10?'0'+date.getSeconds():date.getSeconds(); //s
                            var price = data[0].data;
                            if (price != "-") {
                            	var dom = y+'年'+m+'月'+d+'日';
                                price = parseFloat(price);
                                var p = (price - json.y_close).toFixed(2);
                                var pr = (p / json.y_close * 100).toFixed(2) + "%";
                                dom += "<br/>时间：" +h+':'+mm+':'+s;
                                dom += "<br/>价格：<span style='color:" + (p > 0 ? "red" : "green") + ";'>" + price.toFixed(2) + "</span>";
                                dom += "<br/>涨跌：<span style='color:" + (p > 0 ? "red" : "green") + ";'>" + p + "</span>";
                                dom += "<br/>涨跌幅：<span style='color:" + (p > 0 ? "red" : "green") + ";'>" + pr + "</span>";  	
                            }
                            else {
                            	var dom=b_y+'年'+b_m+'月'+b_d+'日';
                                dom += "<br/>时间：-";
                                dom += "<br/>价格：-";
                                dom += "<br/>涨跌：-";
                                dom += "<br/>涨跌幅：-";
                            }
                            return dom;
                        },
                        axisPointer: {
                            lineStyle: {
                                color: '#ccc',
                                width: 1,
                                type: 'solid'
                            }
                        }
                    },
                    legend: {
                        show: false,
                        data: ['-']
                    },
                    toolbox: {
                        show: false
                    },
                    calculable: false,
                    xAxis: [
                        {
                            type: 'category',
                            boundaryGap: false,
                            data: xdata,
                            axisLine: { show: false },
                            axisTick: { show: false },
                            splitNumber: 0,
                            splitLine: {
                                show: false,
                                lineStyle: {
                                    color: ['#ccc'],
                                    width: 1,
                                    type: 'dashed'
                                }
                            }
                        }
                    ],
                    yAxis: [
                        {
                            show: true,
                            type: 'value',
                            position: 'left',
                            min: ymin,
                            max: ymax,
                            boundaryGap: false,
                            splitNumber: 4,
                            axisLine: { show: false },
                            axisTick: { show: false },
                            axisLabel: {
                                formatter: function (data) {
                                    return data.toFixed(2);
                                },
                                textStyle: {
                                    color: function (data) {
                                        var d = 1 * (+data).toFixed(2);
                                        if (d > json.y_close) return '#dd2200';
                                        if (d < json.y_close) return '#33aa60';
                                        if (json.y_close == "--") return '#c8c8c8';
                                        return '#c8c8c8';
                                    }
                                }
                            },
                            splitLine: {
                                show: true,
                                lineStyle: {
                                    color: ['#ccc'],
                                    width: 1,
                                    type: 'dashed'
                                }
                            }
                        },
                        {
                            type: 'value',
                            position: 'right',
                            min: (ymin - json.y_close) / json.y_close * 100,
                            max: (ymax - json.y_close) / json.y_close * 100,
                            boundaryGap: false,
                            splitLine: { lineStyle: { color: '#f1f1f1', width: 1, type: 'solid' } },
                            axisLine: { lineStyle: { color: '#f1f1f1', width: 0, type: 'solid' } },
                            splitNumber: 4,
                            axisLabel: {
                                formatter: function (data) { return Math.abs(data).toFixed(2) + "%"; },
                                textStyle: {
                                    color: function (data) {
                                        if (json.y_close == "--") return '#c8c8c8';
                                        var d = 1 * parseFloat(data).toFixed(3);
                                        if (d >= 0.001) return '#dd2200';
                                        if (d < 0) return '#33aa60';
                                        return '#c8c8c8';
                                    }
                                }
                            }
                        }
                    ],
                    series: [
                        {
                            name: '-',
                            type: 'line',
                            itemStyle: {
                                normal: {
                                    areaStyle: { type: 'default' },
                                    color: "#d5e1f2",
                                    borderColor: "#3b98d3",
                                    lineStyle: { width: 1, color: ['#3b98d3'] },
                                }
                            },
                            data: ydata,
                            symbol: "circle",
                            symbolSize: 5,
                            markLine: {
                                symbol: "none",
                                clickable: false,
                                large: true,
                                itemStyle: {
                                    normal: {
                                        lineStyle: {
                                            color: ['#F96900'],
                                            width:1,
                                            type: 'dashed'
                                        }
                                    }
                                },
                                data: markLineData
                            }
                        }
                    ]
                };
                myChart.setOption(config);
                $(selector).css("background", "none");
                this.chart = myChart;
                //console.log(this.chart);
            },
            push: function (json, full) {
                //console.log(this.chart);
                if (!this.chart) return;
                if (!json || !json.records)
                    return false;
                var option = this.chart.getOption();
                var xdata = [], ydata = [];
                var ymin, ymax;
                $.each(json.records, function (i, n) {
                    if (i == 0) {
                        ymin = ymax = n[1];
                    }
                    xdata.push(n[0])
                    ymin = ymin > n[1] ? n[1] : ymin;
                    ymax = ymax < n[1] ? n[1] : ymax;
                    ydata.push(n[1]);
                });

                var a = ymin, b = json.y_close, c = ymax;
                var ab = Math.abs(b - a);
                var cb = Math.abs(c - b);

                var speed = ab > cb ? ab : cb;//中心线
//              console.log(speed, b);
                var min = a > b ? (b > c ? c : b) : a;

                if (a >= b && c >= b)
                    min = min - speed;
                ymin = 0;
                ymax = speed * 2;

                for (var i = 0; i < ydata.length; i++) {
                    ydata[i] = ydata[i] - min;
                }

                full = full || 270;
                for (var i = 0; i < full - xdata.length; i++) {
                    xdata.push("-");
                    ydata.push("-");
                }
                var markLineData = [
                   [
                        { name: '', xAxis: 0, yAxis: speed },
                        { name: '', xAxis: xdata.length - 1, yAxis: speed }
                   ]
                ];
                //ymax = ymax * 1.01;
                //ymin = ymin * 0.99;
                option.yAxis[0].min = ymin;
                option.yAxis[0].max = ymax;
                option.xAxis[0].data = xdata;
                option.series[0].data = ydata;
                option.series[0].markLine.data = markLineData;
                this.chart.setOption(option);
            }
        }
	
}