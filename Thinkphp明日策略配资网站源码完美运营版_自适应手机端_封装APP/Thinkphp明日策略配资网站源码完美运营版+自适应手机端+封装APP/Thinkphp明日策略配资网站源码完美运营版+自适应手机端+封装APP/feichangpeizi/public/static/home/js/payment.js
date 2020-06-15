$(function(){
	if($('#branch').html()==null||$('#branch').html()==''){
		$('.bankcard').html("<span style='color:red;font-size: 16px;'>请先绑定一张银行卡</span>")
	}
	
	$('#mem_wdA').click(function(){
		$('#txje_err1').hide()
		if($('#提现金额i').val().length==0){
			$('#txje_err1').show();
			return;
		}
		if(bankId == ''){
			tool.popup_err_msg("您还未绑定银行卡");
			return;
		}
		//按钮不可点击
		$(this).attr('disabled',true).css({'background':'#ccc'})
		//验证手机号
		$('#popup-edit-phone .time-counter').hide()
        tool.popup.showPopup($('#popup-edit-phone'));
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
            $('#edit-phone-submit-next').on('click',function(){
            	$('#bdsjjym_err1').hide();
            	if($('#绑定手机校验码i').val().length==0){
            		$('#bdsjjym_err1').show();
            		return;
            	};
            	//弹出框还原
            	 $('#sms_SendAuthAA').addClass('active');
            	 $('#bdsjjym_err1').hide();
            	 //校队验证码
            	 $.post("/index/ucenter/checkMobileCode", {mobile: mobileTrue, code:$('#绑定手机校验码i').val()}, function(data){
						$("#绑定手机校验码i").val('');
                      if(data.code != '0'){
                         $('#bdsjjym_err1').show()
                      }else{
						  $("#valid_code").hide();
						  //提交提现申请 
						  $.ajax({
							type:"post",
							url:"/index/ucenter/doWithdraw",
							data:{
								amount:$('#提现金额i').val(),//提现金额
								bankId: bankId,
							},
							dataType:'json',
							success:function(data){
								//按钮可以点击
								$('#mem_wdA').attr('disabled',false).css({'background':'#d42b2e'})
								if(data.code != '0'){
									tool.popup_err_msg(data.msg);
								}else{
									tool.popup_err_msg("已提交提现申请到后台，请等待审核");
									location.reload();
								}
							}
						});
                      }
                }, 'json');    
            	
            })
		

	});
	//关闭弹窗可以点击按钮
	$('.js-close-popup').click(function(){
		$('#mem_wdA').attr('disabled',false).css({'background':'#d42b2e'});
	})

});
