$(function(){
	//微信二维码鼠标悬浮
	$(".top .big .ul_2 .weix").mouseover(function(){
		$(".top .big .ul_2 .weix .erw").show();
		});
	$(".top .big .ul_2 .weix").mouseout(function(){
		$(".top .big .ul_2 .weix .erw").hide();
		});
	//头部信息鼠标悬浮
	$(".top .big .ul_3 li").mouseover(function(){
		$(this).find(".bck").show();
		$(this).find(".neir").show();
		$(this).find(".bck_2").show();
		$(this).find(".neir_2").show();
		});
	$(".top .big .ul_3 li").mouseout(function(){
		$(this).find(".bck").hide();
		$(this).find(".neir").hide();
		$(this).find(".bck_2").hide();
		$(this).find(".neir_2").hide();
		});
	//二维码弹出框
	$(".bottom_1 .cont .ul_1 .jies .ul_2 li .weix").click(function(){
		$(".qR_code_bk").show();
		$(".qR_code").show();
		})
	$(".qR_code .p_1 i").click(function(){
		$(".qR_code_bk").hide();
		$(".qR_code").hide();
		})
})

//tab切换
function setTab(name,cursel,n){
	for(i=1;i<=n;i++){
	var menu=document.getElementById(name+i);
	var con=document.getElementById("con_"+name+"_"+i);
	menu.className=i==cursel?"hover":"";
	con.style.display=i==cursel?"block":"none";
	}
}

//侧边
function b(){
	h = $(window).height();
	t = $(document).scrollTop();
	if(t > h - 400){
		$('.gotop').show();
	}else{
		$('.gotop').hide();
	}
}
$(document).ready(function(e) {
	b();
	$('.gotop').click(function(){
		$(document).scrollTop(0);	
	})

	
});

$(window).scroll(function(e){
	b();		
})

$(function(){
	$(".return_top .kuan_1 .cont_1 .qq").mouseover(function(){
		$(this).addClass("hover").siblings().removeClass("hover");
		});
	$(".return_top .kuan_1 .cont_1 .qq").mouseout(function(){
		$(this).removeClass("hover");
		});
		
	$(".return_top").mouseover(function(){
		$(this).find(".kuan").show();
		});
	$(".return_top").mouseout(function(){
		$(this).find(".kuan").hide();
		});
	})
