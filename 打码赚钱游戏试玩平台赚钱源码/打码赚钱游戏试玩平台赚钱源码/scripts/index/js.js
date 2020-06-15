
$(function() {
    //微信二维码鼠标悬浮
    $(".top .big .ul_2 .weix").mouseover(function() {
        $(".top .big .ul_2 .weix .erw").show();
    });
    $(".top .big .ul_2 .weix").mouseout(function() {
        $(".top .big .ul_2 .weix .erw").hide();
    });
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
    //登录、注册文本输入框
    $(".shu").focus(function() {
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
    $(".shu").blur(function() {
        var txt_value = $(this).val();
        if (txt_value == "") {
            $(this).val(this.defaultValue);
        }
        $(this).css({
            "color": "808080",
            "box-shadow": "none"
        })
    })
    $(".shu_1").focus(function() {
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
    $(".shu_1").blur(function() {
        var txt_value = $(this).val();
        if (txt_value == "") {
            $(this).val(this.defaultValue);
        }
        $(this).css({
            "color": "808080",
            "box-shadow": "none"
        })
    })
    //登录密码
    $(".registration .input_k li").click(function() {
        $(this).addClass("hover");
        $(this).addClass("hover_2").siblings().removeClass("hover_2");
        $(this).find(".shu_1").focus();
    });
    //登录、注册切换
    $(".registration .tit .t_3 .a_xx2").click(function() {
        $(".registration_2").hide();
        $(".registration_1").show();
    });
    $(".registration .tit .t_3 .a_xx1").click(function() {
        $(".registration_2").show();
        $(".registration_1").hide();
    });
    $(".registration .tit .t_4").click(function() {
        $(".registration").hide();
        $(".registration_bk").hide();
    });



    $(".top .big .ul_1 .li_1").click(function() {
        $(".registration_2").show();
        $(".registration_bk").show();
    });
    $(".top .big .ul_1 .li_2").click(function() {
        $(".registration_1").show();
        $(".registration_bk").show();
    });
})

	