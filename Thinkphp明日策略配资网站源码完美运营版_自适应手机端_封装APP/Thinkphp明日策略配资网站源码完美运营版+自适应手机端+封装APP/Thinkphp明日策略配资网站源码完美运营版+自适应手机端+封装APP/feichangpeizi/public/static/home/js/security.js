var security={
    init:function(){
        this.eventsBind();
    },
    eventsBind:function(){
        var base=this;
        
        //点击修改真实姓名，弹出框
        $("a[name='realnameAuth']").click(function () {
            tool.popup.showPopup($('#popup-realname-auth'))
            //弹窗 确认按钮
            $("#user_UpdateSelfIdA").click(function(e){
                var realName = $("#姓名i").val();
                var IDnumber = $("#身份证i").val();
                //判断并发送
                $('#zsxm_err1').hide();
                $('#sfzh_err1').hide();
                if(realName.length=='0'){
                    $('#zsxm_err1').show()
                    return;
                }
                if(IDnumber.length=='0'){
                    $('#sfzh_err1').show()
                    return;
                }
                $.post("/index/ucenter/doReanNameAuth", {realName:realName, IDNumber:IDnumber}, function(data){
                        $("#姓名i").val('');
                        $("#身份证i").val('');
                        if(data.code != '0'){
                            tool.popup_err_msg(data.msg);
                        }else{
                            tool.popup_err_msg("保存成功");
                            location.reload();
                        }
                }, 'json');    
                
            });
        });
        
        //点击修改手机号，弹出框
         $("a#umA").click(function () {
         	$('#popup-edit-phone .time-counter').hide()
            tool.popup.showPopup($('#popup-edit-phone'))
            //点击获取验证码
            $('#sms_SendAuthAA').click(function(){
            	var _base = $(this);
				var w = _base.parent();
				if (!_base.hasClass("active")) {
			        return false;
			    }
				//弹出img框
                tool.popup.showPopup($("#popup-valid-img"));
                //输入img验证码
                $("#txt_valid_code").unbind("keyup").bind("keyup", function () {
                    var trigger = $(this);
                    var _val = $(this).val();
                    //如果长度=4
                    if (_val.length == 4) {
						$.ajax({
							url:'/index/index/sendMobileCode',
							data:{
								mobile: mobileTrue, 
								imgCode:_val,
							},
                            dataType:'json',
							type:'get',
							success:function(data) {
                                $("#txt_valid_code").val("");
                                $('#forgot_passImg').attr('src', '/index.php/captcha.html');
								if(data.code == '0'){
									$("#valid_code").hide();
									//隐藏img弹窗
									tool.popup.hidePopup($("#popup-valid-img"));
									tool.popup.showPopup($('#popup-edit-phone'))
									w.addClass("capcha-count-down");
									//禁用btn
                                    _base.removeClass("active");
                                    $(".time-counter span", w).text("60");
                                    $('#popup-edit-phone .time-counter').show();
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
                                           $('#popup-edit-phone .time-counter').hide();
                                        }
                                    }, 1000);
								}
								else{
									$("#valid_code").show();
									$("#valid_code span").html("短信发送失败:"+data.msg);
                                }
							}
						})
                    }
                    
                });
            });

			 //修改手机号(提交数据)
			 function saveNewMobile(){
				 //弹出新手机弹窗
				 $("#sms_SendAuthAA2").removeClass("active");
				 tool.popup.hidePopup();
				 tool.popup.showPopup($("#popup-edit-phone-2"));
				 $("#bdsjjym_err1").hide();
				 //判断11位
				 $("#新手机号i").on("keyup afterpaste change", function () {
					 if ($("#新手机号i").val().length == 11) {
						 $("#sms_SendAuthAA2").addClass("active");
					 }
				 });
				 //点击获取验证码(新手机号码)
				 $('#sms_SendAuthAA2').click(function(){
					 var _base = $(this);
					 var w = _base.parent();

					 if (!_base.hasClass("active")) {
						 return false;
					 }
					 //弹出img框
					 tool.popup.showPopup($("#popup-valid-img"));
					 //输入img验证码
					 $("#txt_valid_code").unbind("keyup").bind("keyup", function () {
						 var trigger = $(this);
						 var _val = $(this).val();
						 //如果长度=4
						 if (_val.length == 4) {
							 $.ajax({
								 url:'/index/index/sendMobileCode',
								 data:{
									 mobile: $("#新手机号i").val(),
									 imgCode:_val,
								 },
								 dataType:'json',
								 type:'get',
								 success:function(data) {
									 $("#txt_valid_code").val("");
									 $('#forgot_passImg').attr('src', '/index.php/captcha.html');
									 if(data.code == '0'){
										 $("#valid_code").hide();
										 //隐藏img弹窗
										 tool.popup.hidePopup($("#popup-valid-img"));
										 tool.popup.showPopup($("#popup-edit-phone-2"));
										 w.addClass("capcha-count-down");
										 //禁用btn
										 _base.removeClass("active");
										 $(".time-counter span", w).text("60");
										 $('.time-counter').show();
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
												 $('.time-counter').hide();
											 }
										 }, 1000);
									 }
									 else{
										 $("#valid_code").show();
										 $("#valid_code span").html("短信发送失败:"+data.msg);
									 }
								 }
							 })
						 }

					 });
				 })
				 //提交新手机按钮
				 $("#update_mobileA").click(function () {
					 if ($("#新手机号i").val() == '') {
						 $("#bdsjjym_err2").show()
					 }
					 if ($("#新手机号校验码i").val() == '') {
						 $("#bdsjjym_err3").show();
					 } else {
						 base.changeMobile();
					 }

				 });
			 }

            //确认按钮（验证原手机号码）
            $("#edit-phone-submit-next").click(function(e){
                var code = $("#绑定手机校验码i").val();
                //判断并发送
                $('#bdsjjym_err1').hide();
                if(code.length=='0'){
                    $('#bdsjjym_err1').show();
                    return;
                }

                $.post("/index/ucenter/checkMobileCode", {mobile: mobileTrue, code:code}, function(data){
						$("#绑定手机校验码i").val('');
                      if(data.code != '0'){
                         $('#bdsjjym_err1').show()
                      }else{
						  $("#valid_code").hide();
						  saveNewMobile();
                      }
                }, 'json');    
                
            });
        });
        
        //修改登录密码
        $('a[data-popup="popup-edit-login-pwd"]').click(function () {
            tool.popup.hidePopup();
            tool.popup.showPopup($("#" + $(this).attr("data-popup")));
            //提交新密码按钮
           	$('#登录密码修改A').click(function(){
           		$("#当前登录密码i, #确认密码i, #新密码i").trigger("keyup");
           		if($('#当前登录密码i').val().length!=0 && $('#新密码i').val().length!=0 && $('#确认密码i').val()==$('#新密码i').val()){
           			$.ajax({
           				type:"post",
           				url:"/index/ucenter/doUpdateNewPassword",
           				data:{
							login_oldPwd:$('#当前登录密码i').val(),
           					login_newPwd:$('#新密码i').val(),
           				},
           				dataType:'json',
           				success:function(data){
           					//$("#当前登录密码i").val('');
           					//$("#新密码i").val('');
	                        //$("#确认密码i").val('');
	                        if(data.code != '0'){
								$("#bdsjjym_err7").html(data.msg).show();
	                        }else{
								$("#bdsjjym_err7").hide();
	                            tool.popup_err_msg("修改成功，请重新登录");
	                            location.href = "/index/index/logout.html";
	                        }
           				}
           			});
           		}
           	})
           
        })
        $('#当前登录密码i').on('keyup afterpaste change',function(e){
        	$('#bdsjjym_err4').hide()
        	if($(this).val().length<6){
        		$('#bdsjjym_err4').show()
        	}
        })
        $('#新密码i').on('keyup afterpaste change',function(e){
        	$('#bdsjjym_err5').hide()
        	if($(this).val().length<6){
        		$('#bdsjjym_err5').show()
        	}
        })
        $('#确认密码i').on('keyup afterpaste change',function(e){
        	$('#bdsjjym_err6').hide()
        	if($('#新密码i').val()!=$(this).val()){
        		$('#bdsjjym_err6').show()
        	}
        })
        
        
    },
/**
 * 提交新手机
 */
	changeMobile:function(){
		$.ajax({
            	url:'/index/ucenter/updateNewMobile',
                type:"post",
                dataType:"json",
            	data:{
            		mobile: $('#新手机号i').val(),//新手机号
                    code: $('#新手机号校验码i').val(),//验证码
            	},
            	success:function(data){
            		if (data.code != '0') {
						$("#bdsjjym_err3").show();
						$("#bdsjjym_err3 span").html(data.msg);
                        return;
                   	}
                     else {
                        tool.popup_err_msg("修改成功");
                        location.reload();
                    }
            	}
        });
	},
    
        

    
}
