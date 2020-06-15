$(function(){  
	$(".shu,.shu_1,.shu_2").focus(function() {
        var txt_value = $(this).val();
        if (txt_value == this.defaultValue) {
            $(this).val("")
        }
		$(this).css({
			 "color":"#333",
			"border":"1px solid #e6e6e6",
			 "box-shadow":"0 0 3px #1583FB"
			 })
       });
	$(".shu,.shu_1,.shu_2").blur(function() {
        var txt_value = $(this).val();
        if (txt_value == "") {
            $(this).val(this.defaultValue);
        }
		 $(this).css({
			 "color":"#808080",
			 "box-shadow":"none"
			 });
    });
	//登录图标
	$(".registration .input_k li,.registration_3 .input_k li").click(function() {
		$(this).addClass("hover_2").siblings().removeClass("hover_2");
		});		
       //注册页面切换
       $(".registration_3 .tit .t_3 .a_xx1").click(function() {
        $(".registration_3").hide();
        $(".registration_4").show();
    });
    $(".registration_3 .tit .t_3 .a_xx2").click(function() {
        $(".registration_3").show();
        $(".registration_4").hide();
    });
    
    $(".registration .tit .t_4").click(function() {
		parent.$(".regis").hide();
		});
})