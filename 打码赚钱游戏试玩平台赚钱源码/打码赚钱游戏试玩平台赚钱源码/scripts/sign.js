$(function() {
    //头部信息鼠标悬浮
    $(".top .big .ul_3 li").mouseover(function() {
        $(this).find(".bck").show();
        $(this).find(".neir").show();
        $(this).find(".bck_2").show();
        $(this).find(".neir_2").show();
    });
    $(".top .big .ul_3 li").mouseout(function() {
        $(this).find(".bck").hide();
        $(this).find(".neir").hide();
        $(this).find(".bck_2").hide();
        $(this).find(".neir_2").hide();
    });

    //二维码弹出框
    $(".bottom_1 .cont .ul_1 .jies .ul_2 li .weix").click(function() {
        $(".qR_code_bk").show();
        $(".qR_code").show();
    })
    $(".qR_code .p_1 i").click(function() {
        $(".qR_code_bk").hide();
        $(".qR_code").hide();
    })
    //登录显示
    $(".top .big .ul_1 .li_1").click(function() {
        $(".regis").show();
    });
})

$(function() {
    //奖励、动态鼠标悬浮
    var tan_x = 5;
    var tan_y = 15;
    $(".daily_send .bk .left").mousemove(function(e) {
        $(".bomb_1").css({"top": (e.pageY + tan_y) + "px", "left": (e.pageX + tan_x) + "px"}).show(200);
    })
    $(".daily_send .bk .left").mouseout(function() {
        $(".bomb_1").stop().hide(100);
    });

    $(".daily_send .bk .right").mousemove(function(e) {
        $(".bomb_2").css({"top": (e.pageY + tan_y) + "px", "left": (e.pageX + tan_x) + "px"}).show(200);
    })
    $(".daily_send .bk .right").mouseout(function() {
        $(".bomb_2").stop().hide(100);
    });
});
//侧边
function b() {
    h = $(window).height();
    t = $(document).scrollTop();
    if (t > h - 400) {
        $('.gotop').show();
    } else {
        $('.gotop').hide();
    }
}
$(document).ready(function(e) {
    b();
    $('.gotop').click(function() {
        $(document).scrollTop(0);
    });


});

$(window).scroll(function(e) {
    b();
});

$(function() {
    $(".return_top .kuan_1 .cont_1 .qq").mouseover(function() {
        $(this).addClass("hover").siblings().removeClass("hover");
    });
    $(".return_top .kuan_1 .cont_1 .qq").mouseout(function() {
        $(this).removeClass("hover");
    });

    $(".return_top").mouseover(function() {
        $(this).find(".kuan").show();
    });
    $(".return_top").mouseout(function() {
        $(this).find(".kuan").hide();
    });
    
    //试玩按钮
	$("#slide .cover .ul_1 li .img").mouseover(function(){
		$(this).find(".bk").css({"display":"block"});
		$(this).find(".ann").css({"display":"block"});
		});
	$("#slide .cover .ul_1 li .img").mouseout(function(){
		$(this).find(".bk").css({"display":"none"});
		$(this).find(".ann").css({"display":"none"});
		});
});