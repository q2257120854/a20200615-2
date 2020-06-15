//选中的股票代码
var selectedCode = "600036";
var stopShare=true;
var buy_moblie={
/**
 * 初始化
 */
	init:function(){
		this.eventsBind();
	},
/**
 * 事件
 */
	eventsBind:function(){
		var base=this;
		
		//date
        Date.prototype.format = function (format) {
	        var o = {
	            "M+": this.getMonth() + 1, //month 
	            "d+": this.getDate(), //day 
	            "h+": this.getHours(), //hour 
	            "m+": this.getMinutes(), //minute 
	            "s+": this.getSeconds(), //second 
	            "q+": Math.floor((this.getMonth() + 3) / 3), //quarter 
	            "S": this.getMilliseconds() //millisecond 
	        }
	
	        if (/(y+)/.test(format)) {
	            format = format.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
	        }
	
	        for (var k in o) {
	            if (new RegExp("(" + k + ")").test(format)) {
	                format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k] : ("00" + o[k]).substr(("" + o[k]).length));
	            }
	        }
	        return format;
	    };
		
		//点击input
		$('#searchTxt1').off('focus').on('focus',function(e){
			//让下面的消失，让ul出来
			$('.search_ul').show();
			$('.share_title,.chart_box,.stock-price').hide();
			$('#item2').hide();
			//在input中输入时
			$(this).off('keyup').on('keyup',function(){
				var keywords=$(this).val().toLowerCase();//关键词
				//向后台发送查询数据,并渲染列表
				base.searchCue(keywords);
			})
			
		}).on('blur',function(){
			$('.search_ul').hide();
			$('.search_ul').html('');
			$('#item1>.share_title,.chart_box,.stock-price').show()
		})
		
		//点击买入step1显示item2
		$('#buy_step1').on('tap',function(){
			if($(this).attr('tapEvent')=='true'){
				$('#item1 .share_title,#item1 .chart_box,#item1 .stock-price').hide();
				$('#item2,#item2 .share_title').show();
			}
		})
		
		
		$(function(){
			//获取股票实时数据和分时数据。每几秒钟就刷新一次
			base.stockInit();
			
			//获取股票K线图。只在页面打开时加载一次，不需要再刷新
	    	base.initKChart();
	    	
	    	//页面加载时金额默认点击第一个li
	    	$("#buy_price_ul > li:eq(0)").trigger('tap');
		});

		var freshTimeInterval = 10 * 1000;
		var freshTimes = 0;
		
		//定时器 获取实时数据（最新数据）, 每几秒钟就刷新一次
		setInterval(function(){
		    if(!buy_moblie.isTradingTime()||!stopShare){ // 如果不在交易时间就不必刷新数据
		        return ;
		    }
		    freshTimes ++ ;
		    if(freshTimes > 10){
		        freshTimeInterval = 60 * 1000;
		    }
		    
		    //获取股票实时数据
		    buy_moblie.getStockInfo();
		
		}, 2000 );
		
		//定时器 获取分时数据
		setInterval(function(){
		    if(!buy_moblie.isTradingTime()){ // 如果不在交易时间就不必刷新数据
		        return ;
		    }
		    //获取分时数据
		    buy_moblie.getTimeLine();
		}, 60 * 1000);
	
	
		//"点买"step2按钮
		$("#buy_step2").on('tap',function(e){
			var agree_val=$('input[name="agree_pro"]:checked').val()
			if(!agree_val){
				mui.alert("请阅读并签署谋略协议");
				return;
			}
			//5秒后才可以点击
			$(this).attr('disabled',true);
			//判断有没有登录
		    $.post("/index/index/isLogin", {}, function(data){
		    	 $("#buy_step2").attr("disabled", false);
		        if(data != 1){
		            //alert("请先登录")
		            mui.alert('请先登录');
		            location.href='/login.html'
		        }else{
					buy_moblie.updateStockNumber(2);
		        }
		    });
		
		    buy_moblie.updateStockNumber();
			
		});
	

	},
/**
 * 向后台发送查询数据,并渲染列表
 */
	searchCue:function(keywords){
		//发送请求
		$.ajax({
			type:"get",
			url:"/index/Alistock/getSharesByKeywords",
			data:{keywords:keywords},
			dataType:'json',
//			beforeSend:function(){
//	           $("#vvv").append('<img src="../../images/loading.gif"  />');
//	        },
			success:function(data){
					//1.清空ul
				 	$('.search_ul').html("");
				 	//2.渲染(if如果没数据，else如果有数据)
				   	var html='';
				   	if(data.data==null||data.data==''){
				   		html='<li class="search_li" style="text-align: center;color: #ccc;">暂无数据</li>';
				   	}else{
				   		for(var i=0;i<data.data.length&&i<10;i++){
				   			html+='<li class="search_li"><span class="result1">'+data.data[i].code+'</span><span class="result2">'+data.data[i].name+'</span>';
				   		}
				   	}
				   	$('.search_ul').html(html);
				   	
				 	//3.选中股票，改变标题，隐藏搜索ul，发送给后台查询股票行情
				 	buy_moblie.selectAShare($('.search_ul li'));
			}
		});
	},
/**
 * 选中股票，改变标题，隐藏搜索框
 */
	selectAShare:function (dom){
		dom.on('tap',function(e){
			$('#searchTxt1').trigger('blur');
			var ashareCode=$(this).find('span').eq(0).html();//股票编号
			var ashareName=$(this).find('span').eq(1).html();//股票名
			//渲染到页面标题上
			$('.title_l').find('#stockName').html(ashareName);
			$('.title_l').find('#stockNum').html(ashareCode);
			//搜索框的值清空
		    $("#searchTxt1").val("");
	
			selectedCode = ashareCode;
			
			
			 //loading
        	$('.loader').show();
        	
	        //更新股票实时数据和分时数据
	        buy_moblie.stockInit();
	
	        //更新股票K线图
	        buy_moblie.initKChart();
	});
},
/**
 * 初始化页面 获取股票实时数据、分时数据、K线图
 */

	stockInit:function (){
		//获取股票实时数据
		buy_moblie.getStockInfo();
	
		//获取分时数据
		buy_moblie.getTimeLine();
	},

/**
 * 获取股票实时数据
 */

	getStockInfo:function (){
		$('#buy_step1').html('买入').attr('tapEvent',true).css({'background':'var(--color_red)'});
	
		$.post("/index/Alistock/getStockInfo", {code:selectedCode}, function(data){
            if(data.code != '0'){
                return;
            }
            var map = data.data;
//			$('.title_l').find('#stockName').html(map.name);
//			$('.title_l').find('#stockNum').html(selectedCode);
			//渲染页面价格
        	map.nowPrice=(map.nowPrice-0).toFixed(2);
	        $("#nowPrice").html(map.nowPrice);
			$("#num1").html(map.diff_money);
			$("#num2").html(map.diff_rate + "%");
			
			 // 如果不在交易时间，不能点买
	        if(!buy_moblie.isTradingTime() ){
	            $('#buy_step1').attr('tapEvent',false).css({'background':'#767679'}).html('点买时间9:30-11:30, 13:00-14:58');
	        }
	        
			//改变价格颜色
			if(map.diff_money > 0){
				$(".color").removeClass('color_red').removeClass('color_green').addClass("color_red");
			}else if(map.diff_money < 0){
				$(".color").removeClass('color_red').removeClass('color_green').addClass("color_green");
			}
	
	
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
	
//	        //今开 最高 ...... 成交额
//	        bs = ['openPrice', 'turnover', 'todayMax', 'todayMin', 'highLimit', 'downLimit', 'tradeNum', 'tradeAmount' ];
//	        $("#stock-info li > span.r ").each(function(i, o){
//	            if(bs[i] == 'tradeNum'){
//	                $(o).html(map[bs[i]] / 100 + "手");
//	            }else if(bs[i] == 'tradeAmount'){
//	                $(o).html(map[bs[i]] / 10000 + "万");
//	            }else{
//	                $(o).html(map[bs[i]]);
//	            }
//	        });
	
	        buy_moblie.updateStockNumber();
	        
	         //停牌判断
	        stopShare=true;
	        if(Number(map.openPrice).toFixed(2)=='0'||Number(map.openPrice).toFixed(2)=='0.00'){
	        	$('#buy_step1').html(map.remark).attr('tapEvent',false).css({'background':'#767679'});
	        	stopShare=false;
				return;
			}
	        
	        //更新资金利用率
//	        if($('#gu').html()=='-'){
	        	//可买入-股，资金利用率-%
			    var nowPrice = parseFloat( $("#nowPrice").html() );
			    var price = parseInt($("#buy_price_ul > li>a.chose-active").html());
			    var gu=Math.floor((price/nowPrice)/100)*100;
			    var lyl=(nowPrice*gu/(price)*100).toFixed(2) + "%";
				$("#gu").html(gu);
				$("#lyl").html(lyl);
//	        }
	
		}, 'json')
	},
/**
 * 获取分时数据
 */

	getTimeLine:function (){
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
//              console.log(price)
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
			initTimeLine.chartLine.init('#chart',dataList );
			
			$('.loader').hide();
	
		}, 'json');
			
	},
	
/**
 * 根据股票实时价格 渲染购买股票标题和价格，更新弹出层的交易数量
 */
	updateStockNumber:function (num){
		//渲染购买股票标题和价格
	   	$("#t_stock_name").html($("#stockName").html());//标题
	   	//确认购买的金额
	    var t_principal = parseInt($("#buy_price_ul > li>a.chose-active").html()) ;
		//现在价格
	    var nowPrice = parseFloat( $("#nowPrice").html() );
	    //交易数量xx手
	    var amount = parseInt($("#buy_price_ul > li>a.chose-active").html());
	    amount=parseInt(amount / nowPrice / 100);
		var html='交易品种：'+$("#stockName").html()+'\n交易本金：'+t_principal+"\n交易数量："+amount+'手'
		if(num==2){
			mui.confirm(html,'提示',['确认','取消'],function(e){
				if(e.index==0){
					//点买弹出层的确定按钮
					    var params = {};
					    params['stockCode'] = parseInt($("#stockNum").html());
					    $.post("/index/ucenter/freetrialBuy", params, function(data){
//					    	console.dir(params);
					        if(data.code == '0'){
					            mui.alert("交易成功");
					            location.href = "/freetrialSell.html";
					        }else{
					            mui.alert(data.msg);
					        }
					    }, 'json');

				}
			});
		}
	},	


/**
 * 获取K线图的数据（更新股票K线图）
 */

initKChart:function (){
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
        //绘制K线图
        buy_moblie.setKChartData(data0);
    }, 'json');
},

/**
 * 为绘制k线图函数服务，分割数据
 * @param {Object} rawData
 */
splitData:function (rawData) {
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
},

/**
 * 绘制K线图函数
 * @param {Object} dataArray
 */
setKChartData:function (dataArray) {

//---K线图
    //初始化K线图
    var myChartK = echarts.init(document.getElementById('chartK'));
    // 数据意义：开盘(open)，收盘(close)，最低(lowest)，最高(highest)
    var data0 = buy_moblie.splitData(dataArray);

    option = {
        title: {
            text: '',
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

},

/**
 * 判断当前时间是否在9:30-11:30, 13:00-15:00（交易时间）
 */
isTradingTime:function (){
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
                            smooth: false,
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
                            symbolSize: 1,
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
                console.log(speed, b);
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
