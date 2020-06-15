//active高亮
$("#selectByDate,#recent7,#recent30,#status-0,#status-7,#status-6,#status-5,#status-4,#status-3,#status-1,#status-r").click(function() {
	$(this).siblings("a").removeClass("active").end().addClass("active");
});

//7&30&日历月份高亮
$('.select a').each(function() {
	var hrefDay = String(window.location.search).replace(/\D/g, '');
	var a_day = String($(this).attr('href')).replace(/\D/g, '');
	if(a_day == hrefDay && hrefDay != null && hrefDay != '') {
		$(this).addClass('active');
	}
});
//点击按时间选择按钮
$("#selectByDate").click(function() {
	var x = $(this).position();
	var mon = String(window.location.search).replace(/\D/g, '').slice(5);
	$('.JchooseMonth').eq(mon-1).addClass('hover');
	$("#JchooseDate").css({
		left: x.left,
		top: x.top + 35
	}).show();
	timer = setTimeout(function() {
		$("#JchooseDate").hide();
	}, 2000);
});
//日历初始化显示(默认当前月份高亮)
$(function(){
	var date=new Date();
	var nowY=date.getFullYear(),
	    nowM=date.getMonth()+1; 
	$("#yearSpan").html(nowY);
	var lis= '<li><a href="javascript:void(0);" data-m="1" class="JchooseMonth ">1月</a></li><li><a href="javascript:void(0);" data-m="2" class="JchooseMonth ">2月</a></li><li><a href="javascript:void(0);" data-m="3" class="JchooseMonth ">3月</a></li><li><a href="javascript:void(0);" data-m="4" class="JchooseMonth ">4月</a></li><li><a href="javascript:void(0);" data-m="5" class="JchooseMonth ">5月</a></li><li><a href="javascript:void(0);" data-m="6" class="JchooseMonth ">6月</a></li><li><a href="javascript:void(0);" data-m="7" class="JchooseMonth ">7月</a></li><li><a href="javascript:void(0);" data-m="8" class="JchooseMonth ">8月</a></li><li><a href="javascript:void(0);" data-m="9" class="JchooseMonth ">9月</a></li><li><a href="javascript:void(0);" data-m="10" class="JchooseMonth ">10月</a></li><li><a href="javascript:void(0);" data-m="11" class="JchooseMonth ">11月</a></li><li><a href="javascript:void(0);" data-m="12" class="JchooseMonth ">12月</a></li>'
		$('ul.jiesuan-dea2').html(lis);
		nowM=nowM-1;
		var mon = String(window.location.search).replace(/\D/g, '').slice(5);
		$('.JchooseMonth').eq(mon-1).addClass('hover');
		var liw=$('.JchooseMonth').eq(nowM).parent();
		var liAfter=''
		var NumberM=nowM+1;
		for(var i=0;i<(12-nowM)-1;i++){
			liAfter+='<li><span>'+(NumberM+1)+'月</span></li>';
			NumberM+=1;
		}
		liw.nextAll().remove().end().after(liAfter);
	
})
//鼠标进入显示日历，离开消失
$("#JchooseDate").mouseenter(function() {
	window.clearTimeout(timer)
}).mouseleave(function() {
	timer = setTimeout(function() {
		$("#JchooseDate").hide();
	}, 300);
});
//年份加减
$("#JchooseDate").find(".left_gray,.right_gray").click(function() {
	var y = parseInt($("#yearSpan").html()) + ($(this).hasClass("left_gray") ? -1 : 1);
	$("#yearSpan").html(y);
	var m = parseInt($(this).find("a").html());
	var date=new Date();
	var nowY=parseInt(date.getFullYear()),
		nowM=date.getMonth()+1;
	if(y<nowY){//小于当前
		var lis= '<li><a href="javascript:void(0);" data-m="1" class="JchooseMonth ">1月</a></li><li><a href="javascript:void(0);" data-m="2" class="JchooseMonth ">2月</a></li><li><a href="javascript:void(0);" data-m="3" class="JchooseMonth ">3月</a></li><li><a href="javascript:void(0);" data-m="4" class="JchooseMonth ">4月</a></li><li><a href="javascript:void(0);" data-m="5" class="JchooseMonth ">5月</a></li><li><a href="javascript:void(0);" data-m="6" class="JchooseMonth ">6月</a></li><li><a href="javascript:void(0);" data-m="7" class="JchooseMonth ">7月</a></li><li><a href="javascript:void(0);" data-m="8" class="JchooseMonth ">8月</a></li><li><a href="javascript:void(0);" data-m="9" class="JchooseMonth ">9月</a></li><li><a href="javascript:void(0);" data-m="10" class="JchooseMonth ">10月</a></li><li><a href="javascript:void(0);" data-m="11" class="JchooseMonth ">11月</a></li><li><a href="javascript:void(0);" data-m="12" class="JchooseMonth ">12月</a></li>'
		$('ul.jiesuan-dea2').html(lis);
	}else if(y>nowY){//大于当前
		var lis= '<li><span>1月</span></li>'
				+'<li><span>2月</span></li>'
				+'<li><span>3月</span></li>'
				+'<li><span>4月</span></li>'
				+'<li><span>5月</span></li>'
				+'<li><span>6月</span></li>'
				+'<li><span>7月</span></li>'
				+'<li><span>8月</span></li>'
				+'<li><span>9月</span></li>'
				+'<li><span>10月</span></li>'
				+'<li><span>11月</span></li>'
				+'<li><span>12月</span></li>'
		$('ul.jiesuan-dea2').html(lis);
	}else{		//等于
		var lis= '<li><a href="javascript:void(0);" data-m="1" class="JchooseMonth ">1月</a></li><li><a href="javascript:void(0);" data-m="2" class="JchooseMonth ">2月</a></li><li><a href="javascript:void(0);" data-m="3" class="JchooseMonth ">3月</a></li><li><a href="javascript:void(0);" data-m="4" class="JchooseMonth ">4月</a></li><li><a href="javascript:void(0);" data-m="5" class="JchooseMonth ">5月</a></li><li><a href="javascript:void(0);" data-m="6" class="JchooseMonth ">6月</a></li><li><a href="javascript:void(0);" data-m="7" class="JchooseMonth ">7月</a></li><li><a href="javascript:void(0);" data-m="8" class="JchooseMonth ">8月</a></li><li><a href="javascript:void(0);" data-m="9" class="JchooseMonth ">9月</a></li><li><a href="javascript:void(0);" data-m="10" class="JchooseMonth ">10月</a></li><li><a href="javascript:void(0);" data-m="11" class="JchooseMonth ">11月</a></li><li><a href="javascript:void(0);" data-m="12" class="JchooseMonth ">12月</a></li>'
		$('ul.jiesuan-dea2').html(lis);
		//让选择的月份高亮
		var mon = String(window.location.search).replace(/\D/g, '').slice(5);
		nowM=nowM-1;
		$('.JchooseMonth').eq(mon-1).addClass('hover');
		var liw=$('.JchooseMonth').eq(nowM).parent();
		var liAfter=''
		var NumberM=nowM+1;
		for(var i=0;i<(12-nowM)-1;i++){
			liAfter+='<li><span>'+(NumberM+1)+'月</span></li>';
			NumberM+=1;
		}
		liw.nextAll().remove().end().after(liAfter);
	}
	$("#JchooseDate li").on('click',function(e) {
		var y = parseInt($("#yearSpan").html());
		var m = parseInt($(this).find("a").html());
		if(!m) {
			return;
		}
		if(m < 10) {
			m = "0" + m;
		}
		location.href = "/history.html?recent=" + y + "-" + m;
	});
});


//点击月份渲染页面数据
$(function(){
	$("#JchooseDate li").on('click',function(e) {
		var y = parseInt($("#yearSpan").html());
		var m = parseInt($(this).find("a").html());
		if(!m) {
			return;
		}
		if(m < 10) {
			m = "0" + m;
		}
		location.href = "/history.html?recent=" + y + "-" + m;
	});
})

