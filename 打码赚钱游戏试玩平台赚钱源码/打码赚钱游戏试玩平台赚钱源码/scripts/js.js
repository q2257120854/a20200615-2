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
    //输入框
    $(".sframe").focus(function() {
        var txt_value = $(this).val();
        if (txt_value == this.defaultValue) {
            $(this).val("")
        }
        $(this).css({
            "color": "#808080",
            "border": "1px solid #e6e6e6",
            "box-shadow": "0 0 3px #1583FB"
        })
    });
    $(".sframe").blur(function() {
        var txt_value = $(this).val();
        if (txt_value == "") {
            $(this).val(this.defaultValue);
        }
        $(this).css({
            "color": "808080",
            "box-shadow": "none"
        })
    })
    //登录显示
    $(".top .big .ul_1 .li_1").click(function() {
        $(".regis").show();
    });
    $("#ljlogin").click(function() {
        $(".regis").show();
    });
    
    
    //奖励、动态鼠标悬浮
    var tan_x = 5;
    var tan_y = 15;
    $(".reward_dynamic .dynamic_text").mousemove(function(e) {
        $(".reward_dynamic .tan").css({"top": (e.pageY + tan_y) + "px", "left": (e.pageX + tan_x) + "px"}).show(200);
    })
    $(".reward_dynamic .dynamic_text").mouseout(function() {
        $(".reward_dynamic .tan").stop().hide();
    });

})
