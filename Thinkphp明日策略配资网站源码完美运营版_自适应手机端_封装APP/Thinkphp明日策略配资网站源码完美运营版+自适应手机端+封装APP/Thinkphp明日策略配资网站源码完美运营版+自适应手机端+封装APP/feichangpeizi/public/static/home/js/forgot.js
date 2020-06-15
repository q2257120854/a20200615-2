(function ($) {
		    if (!$.setCookie) {
		        $.extend({
		            setCookie: function (c_name, value, exdays) {
		                try {
		                    if (!c_name) return false;
		                    var exdate = new Date();
		                    exdate.setDate(exdate.getDate() + exdays);
		                    var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
		                    document.cookie = c_name + "=" + c_value;
		                }
		                catch (err) {
		                    return '';
		                };
		                return '';
		            }
		        });
		    };
		    if (!$.getCookie) {
		        $.extend({
		            getCookie: function (c_name) {
		                try {
		                    var i, x, y,
		                        ARRcookies = document.cookie.split(";");
		                    for (i = 0; i < ARRcookies.length; i++) {
		                        x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
		                        y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
		                        x = x.replace(/^\s+|\s+$/g, "");
		                        if (x == c_name) return (y);
		                    };
		                }
		                catch (err) {
		                    return '';
		                };
		                return '';
		            }
		        });
		    };
})(jQuery);
var forgot={
	init:function(){
		this.eventsBind()
	},
	eventsBind:function(){
		var base=this;
		//step1页面
		$('#phone').on('keyup afterpaste change',function(){
			 $("#auth_reg_timerD").hide();
                var w = $("#auth_reg_smsA").parent();
                w.addClass("capcha-count-down");
                $("#auth_reg_smsA").removeClass("active");
                $('#phone_err1').hide();
                if ($("#phone").val().length == 11) {
                    w.removeClass("capcha-count-down");
                    $(".btn-get-capcha", w).addClass("active");
                    $("#auth_reg_timerD").hide();
            	}else{
            		$('#phone_err1').show();
            	}
			
		})
		$('#mobile_code').on('keyup afterpaste change',function(){
			$('#mobile_code_err1').hide()
			if($(this).val().length==0){
				$('#mobile_code_err1').show()
			}
		})
			//点击获取校验码
            $("#auth_reg_smsA").click(function () {
				$("#valid_code").hide();
            	var code=$('#mobileno_code');
               	var _base = $(this);
				var w = _base.parent();
				if (!_base.hasClass("active")) {
			        return false;
			    }
				//弹出img框
                tool.popup.hidePopup();
                tool.popup.showPopup($("#popup-valid-img"));
                //输入img验证码
                $("#txt_valid_code").unbind("keyup").bind("keyup", function () {
					$("#valid_code").hide();
                    var trigger = $(this);
                    var _val = $(this).val();
                    //如果长度=4
                    if (_val.length == 4) {
						$.ajax({
							url:'/index/index/sendMobileCode',
							data:{
								mobile: $("#phone").val() ,
								imgCode:_val,
							},
                            dataType:'json',
							type:'post',
							success:function(data) {
                                $("#txt_valid_code").val("");
                                $('#forgot_passImg').attr('src', '/index.php/captcha.html');
								if(data.code == '0'){
									//隐藏img弹窗
									tool.popup.hidePopup($("#popup-valid-img"));
									w.addClass("capcha-count-down");
									//禁用btn
                                    _base.removeClass("active");
                                    $(".time-counter span", w).text("60");
                                    $("#auth_reg_timerD").show();
                                    var getCodeCounter = window.setInterval(function () {
                                        var w = $(".capcha-count-down:visible").eq(0);
                                        var s = parseInt($(".time-counter span", w).text(), 10) - 1;
                                        if (s > 0) {
                                            $(".time-counter span", w).text(s);
                                        } else {
                                            window.clearInterval(getCodeCounter)
                                            w.removeClass("capcha-count-down");
                                            //启用btn
                                            $(".btn-get-capcha", w).addClass("active");
                                            $("#auth_reg_timerD").hide();
                                        }
                                    }, 1000);
								}
								else{
									$("#valid_code").show();
                                    $("#valid_code span").html("短信发送失败:"+data.msg);
                                }
							}
						})
                    }else {//如果长度不等于4
                        $(this).val(_val.substr(0, 4));
                    }
                });
        
            });
		//下一步1
        $('#step2-btn').click(function() {
        	$('#phone,#mobile_code').trigger('keyup');
        	if($('#mobile_code').val().length!=0){
        		$.post("/index/index/checkForgotMobileCode", {mobile: $("#phone").val(), code:$('#mobile_code').val()}, function(data){
						$("#mobile_code").val('');
                      if(data.code != '0'){
                         tool.popup_err_msg(data.msg);
                      } else {
						  	window.location.href='/pass_reset.html';
                      }
                }, 'json');    
        	}
        });

 
        //step2页面
		$('#pwd').on('keyup afterpaste change',function(){
			$('#pwd_err1').hide()
			if($(this).val().length<6){
				$('#pwd_err1').show()
			}
		})
		$('#cpwd').on('keyup afterpaste change',function(){
			$('#cpwd_err1').hide()
			if($(this).val()!=$('#pwd').val()){
				$('#cpwd_err1').show()
			}
		})
		//下一步2
		$('#step3-btn').click(function(){
        	$('#pwd,#cpwd').trigger('keyup');
        	if($('#pwd').val().length!=0&&$('#cpwd').val()==$('#pwd').val()){
        		$.ajax({
           				type:"post",
           				url:"/index/index/updateNewPwd",
           				data:{
           					mobile:$("#phone").val(),
           					login_newPwd:$('#pwd').val(),
           				},
           				dataType:'json',
           				success:function(data){
	                        if(data.code != '0'){
	                            tool.popup_err_msg(data.msg);
	                        }else{
	                            window.location.href='/reset_result.html';
	                        }
           				}
           			});  
        	}
        });
		
		
		
        
		
	},
	
}
