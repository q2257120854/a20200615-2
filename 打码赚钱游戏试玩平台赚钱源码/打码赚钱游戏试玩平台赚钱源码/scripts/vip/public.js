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
    //登录密码
    $(".registration .input_k li,.registration_3 .input_k li").click(function() {
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

//	$(".registration_3 .tit .t_3 .a_xx1").click(function() {
//		$(".registration_3").hide();
//		$(".registration_4").show();
//		});
//	$(".registration_3 .tit .t_3 .a_xx2").click(function() {
//		$(".registration_3").show();
//		$(".registration_4").hide();
//		});
    //个人中心转入转出弹出框
    $(".main_index .wth .ul_1 li .cyu .p_1 .zr").click(function() {
        $(".turn_bk ").show();
        $(".turn_1").show();
    });
    $(".main_index .wth .ul_1 li .cyu .p_1 .zc").click(function() {
        $(".turn_bk ").show();
        $(".turn_2").show();
    });
    $(".turn .tit i").click(function() {
        $(".turn_bk ").hide();
        $(".turn").hide();
    });
    //个人中心-资料管理安全等级问号
    $(".main_index .data .infor .xx .dj .went").mouseover(function() {
        $(".main_index .data .infor .xx .dj .ts").show();
    });
    $(".main_index .data .infor .xx .dj .went").mouseout(function() {
        $(".main_index .data .infor .xx .dj .ts").hide();
    });
    //个人中心-资料管理：用户信息编辑
    $(".main_index .user_xx .tit .edit").click(function() {
        $(".main_index .user_xx .tit .edit").hide();
        $(".main_index .user_xx .tit .ann").show();
        $(".main_index .user_xx .cont_2").hide();
        $(".main_index .user_xx .cont_1").show();
    });
    $(".main_index .user_xx .tit .ann .qux, .main_index .user_xx .tit .ann .qued").click(function() {
        $(".main_index .user_xx .tit .ann").hide();
        $(".main_index .user_xx .tit .edit").show();
        $(".main_index .user_xx .cont_1").hide();
        $(".main_index .user_xx .cont_2").show();
    });
    //个人中心左菜单跟右边相等
    if ($(".public_db").height() > $(".public_db .menu_left").height()) {
        $(".public_db .menu_left").css("height", $(".public_db").height()+280);
    } else {
        //$(".public_db .menu_left").css("height", $(".public_db .cont").height());
    };
    //个人中心—兑奖管理—收货信息：添加地址弹出框
    $(".prizes .tit .p_3 .ann_1").click(function() {
        $(".write_address_bk").show();
        $(".write_address").show();
    });
    $(".write_address .tit a").click(function() {
        $(".write_address_bk").hide();
        $(".write_address").hide();
    });
    //欢乐宝管理—宝宝管理
    $(".profit ul li .list .tit_1 .dian").click(function() {
        $(".profit ul .li_1").hide();
        $(".profit ul .li_2").show();
    });
    $(".profit ul li .list .tit_1 .dian_1").click(function() {
        $(".profit ul .li_1").show();
        $(".profit ul .li_2").hide();
    });
    //欢乐宝管理—宝宝管理转入转出
    $(".profit ul li .list .ann .zr").click(function() {
        $(".turn_bk").show();
        $(".turn_1").show();
    });
    $(".profit ul li .list .ann .zc").click(function() {
        $(".turn_bk").show();
        $(".turn_2").show();
    });
    //消息中心
    $(".news .operation .mark").click(function(event) {
        event.stopPropagation();
        if ($(this).find(".la").css("display") == "none") {
            $(this).find(".la").fadeIn(300);
        } else {
            $(this).find(".la").fadeOut(300);
        }
    });
    $(".news .operation .choose .xiala").click(function(event) {
        event.stopPropagation();
        if ($(this).siblings(".la").css("display") == "none") {
            $(this).siblings(".la").fadeIn(300);
        } else {
            $(this).siblings(".la").fadeOut(300);
        }
    });
    $(".news .operation .choose .la").click(function() {
        $(this).fadeOut(300);
    });

    $(document).click(function() {
        $(".la").fadeOut(300);
    });
    //消息中心表格
    $(".table_3 tr ").mouseover(function() {
        $(this).addClass("yid");
    });
    $(".table_3 tr ").mouseout(function() {
        $(this).removeClass("yid");
    });

    //修改头像
    $(".modify_tx .ul_2 li .db").mouseover(function() {
        $(this).find(".bak").show();
        $(this).find(".ann_1").show();
    });
    $(".modify_tx .ul_2 li .db").mouseout(function() {
        $(this).find(".bak").hide();
        $(this).find(".ann_1").hide();
    });
    //修改头像首页
	$(".main_index .personal .head_img").mouseover(function(){
		$(".main_index .personal .head_img .change_toux").show();
		});
	$(".main_index .personal .head_img").mouseout(function(){
		$(".main_index .personal .head_img .change_toux").hide();
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


