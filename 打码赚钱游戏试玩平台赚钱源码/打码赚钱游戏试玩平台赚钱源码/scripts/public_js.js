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
    //登录显示
    $("#dlck").click(function() {
        $(".regis").show();
    });
    //登录显示
    $("#loginBtns").click(function() {
        $(".regis").show();
    });

//    $(".top .big .ul_1 .li_1").click(function() {
//        $(".registration_2").show();
//        $(".registration_bk").show();
//    });




    //兑换商城详细页登录
    $("#dhsc_detail").click(function() {
        $(".registration_2").show();
        $(".registration_bk").show();
    });



    $(".main_visual .flicking_con .user_xx1 .text .deng").click(function() {
        $(".registration_2").show();
        $(".registration_bk").show();
    });


    //帮助中心左右等高
   if ($(".help .help_left .ul_1").height() < $(".help .help_right").height()) {
        $(".help .help_left .ul_1").css("height", $(".help .help_right").height())
    } else {
        $(".help .help_left .ul_1").css("height", $(".help .help_left .ul_1").height())
    }
    //打码详情页登陆
    $(".code_details .cont .di_2 .a_1").click(function() {
        $(".registration_2").show();
        $(".registration_bk").show();
    });
    $(".code_details .cont .di_2 .a_2").click(function() {
        $(".registration_1").show();
        $(".registration_bk").show();
    });
    //广告体验详情页面提交信息按钮
    $(".adv_details .xx .cont .button_2 .tij").click(function() {
        $(".adv_details .xx .cont .button_2 .tangc").show();
    });
    $(".adv_details .xx .cont .button_2 .tangc .butt .qux").click(function() {
        $(".adv_details .xx .cont .button_2 .tangc").hide();
    });
    //广告体验详情页面登录注册
    $(".adv_details .xx .cont .a_dl").click(function() {
        $(".registration_2").show();
        $(".registration_bk").show();
    });
    $(".adv_details .xx .cont .a_zc").click(function() {
        $(".registration_2").show();
        $(".registration_bk").show();
    });

})
//tab切换
function setTab(name, cursel, n) {
    for (i = 1; i <= n; i++) {
        var menu = document.getElementById(name + i);
        var con = document.getElementById("con_" + name + "_" + i);
        menu.className = i == cursel ? "hover" : "";
        con.style.display = i == cursel ? "block" : "none";
    }
}

// 动态滚动图
(function($) {
    $.fn.myScroll = function(options) {
        //默认配置
        var defaults = {
            speed: 40, //滚动速度,值越大速度越慢
            rowHeight: 24 //每行的高度
        };

        var opts = $.extend({}, defaults, options), intId = [];

        function marquee(obj, step) {

            obj.find("ul").animate({
                marginTop: '-=1'
            }, 0, function() {
                var s = Math.abs(parseInt($(this).css("margin-top")));
                if (s >= step) {
                    $(this).find("li").slice(0, 1).appendTo($(this));
                    $(this).css("margin-top", 0);
                }
            });
        }

        this.each(function(i) {
            var sh = opts["rowHeight"], speed = opts["speed"], _this = $(this);
            intId[i] = setInterval(function() {
                if (_this.find("ul").height() <= _this.height()) {
                    clearInterval(intId[i]);
                } else {
                    marquee(_this, sh);
                }
            }, speed);

            _this.hover(function() {
                clearInterval(intId[i]);
            }, function() {
                intId[i] = setInterval(function() {
                    if (_this.find("ul").height() <= _this.height()) {
                        clearInterval(intId[i]);
                    } else {
                        marquee(_this, sh);
                    }
                }, speed);
            });
        });
    }
})(jQuery);

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
    })


});

$(window).scroll(function(e) {
    b();
})

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
    var h_height = $(document).height();
    $(".regis").height(h_height);
})


	