String.prototype.gblen = function() { 
    var numlen = 0,strnum=0,len=0;   
    for (var i=0; i<this.length; i++) {    
        if (this.charCodeAt(i)>127 || this.charCodeAt(i)==94) {    
             strnum += 2;    
         } else {    
             numlen ++;    
         }    
     }  
    len=parseInt(strnum/2)+numlen;
    return len;    
} 
//reg
var reg={
/**
 * 初始化
 */
		init:function () {
			this.eventsBind();
		},
/**
 * 值
 */
		valid: {
            name: false,
            pwd: false,
            mobile_code: false,
        },
/**
 * 弹出层
 */
	popup: {
            hidePopup: function () {
                // Hide all popups
                $(".mask, .popup").removeClass("mask-trans").hide().css({
                    "top": 0
                });
            },
            showPopup: function (obj) {
            	//当前的显示
                obj.show();
                //遮罩层出来
                $(".mask").show();
                //下掉
                this.positionPopup(obj);
                //关闭
                $(".js-close-popup", obj).click(this.hidePopup);
            },
            positionPopup: function (obj) {
                // Position popup（下掉）
                obj.css({
                    "top": Math.max(0, ($(window).height() - obj.outerHeight()) / 5)
                });
            }
        },
/**
 * popup-error-msg
 */
        popup_err_msg: function (msg) {
            this.popup.hidePopup();
            $("#popup-p-error-msg").html(msg);
            this.popup.showPopup($("#popup-p-error"));
            setTimeout(function () {
                $(".mask, .popup").removeClass("mask-trans").hide().css({
                    "top": 0
                });
            }, 2000)
        },        
/**
 * 事件绑定
 */
		eventsBind: function () {
            var base = this;

			//用户名----按下、粘贴、change事件
			$("#mobile").on("keyup afterpaste change", function () {
				//如果通过就返回true
                base.valid.name = base.unameValid();
            });
			//密码
            $("#pwd").on("keyup afterpaste change", function () {
                base.valid.pwd = base.pwdValid();
            });
			//第二次密码
            $("#mobile_code").on("keyup afterpaste change", function () {
                base.valid.mobile_code = base.mobilecodeValid();
            });
           
            //手机号
            $("#mobileno").on("keyup afterpaste change", function () {
                $("#auth_reg_timerD").hide();
                var w = $("#auth_reg_smsA").parent();
                w.addClass("capcha-count-down");
                $("#auth_reg_smsA").removeClass("active");
                if ($("#mobileno").val().length == 11) {
                    w.removeClass("capcha-count-down");
                    $(".btn-get-capcha", w).addClass("active");
                    $("#auth_reg_timerD").hide();
                }
            });
            //注册（下一步）
            $("#auth_regA").click(function (e) {
                if ($("#recommend_code").val() == "") {
                    $("#mobile_code_err11").show();
                    return false;
                } else if ($("#recommend_code").val().length != '4') {
                    $("#mobile_code_err11").hide();
                    $("#mobile_code_err12").show();
                    return false;
                } else {
                  $("#mobile, #pwd, #mobile_code").trigger("keyup");
                  e.preventDefault();
                  if (base.valid.name && base.valid.pwd && base.valid.mobile_code) {
                    if (!$(this).hasClass("disabled")) {
                      base.register();
                    }
                  }
                }
            });
            
			//$("#auth_reg_timerD").hide();

			//服务协议
			 $("#reg_agree").click(function () {
			    javascript: window.open('/reg_agree', '服务协议', 'height=800,width=1000,top=0,left=200,toolbar=no,menubar=no,scrollbars=yes, resizable=no,location=no, status=no');
			});
			
			//点击获取校验码
            $("#auth_reg_smsA").click(function () {
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
                    var trigger = $(this);
                    var _val = $(this).val();
                    //如果长度=4
                    if (_val.length == 4) {
						$.ajax({
							url:'/index/index/sendMobileCode',
							data:{
								mobile: $("#mobileno").val(), 
								imgCode:_val,
							},
                            dataType:'json',
							type:'get',
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
                                    tool.popup_err_msg("短信发送失败:"+data.msg);
                                }
							}
						})
                    }else {//如果长度不等于4
                        $(this).val(_val.substr(0, 4));
                    }
                });
        
            });
            
		},
/**
 * 检查用户名
 */
		unameValid: function () {
			$('#pwd_errName').hide();
			 //长度小于6
            if ($('#mobile').val().gblen()<6) {
                $("#pwd_errName").show();
                return false;
            }
            else {
                return true;
            }
       	},
/**
 * 检查密码
 */
        pwdValid: function () {
            $("#pwd_err1").hide();
            //长度小于6
            if ($("#pwd").val().length < 6) {
                $("#pwd_err1").show();
                return false;
            }
            else {
                return true;
            }
        },
/**
 * 检查第二次密码
 */
        mobilecodeValid: function () {
            $("#mobile_code_err1").hide();
            //如果不相同
            if ($("#mobile_code").val() != $("#pwd").val()) {
                $("#mobile_code_err1").show();
                return false;
            }
            else {
                // TODO: 判断短信校验码是否正确
                return true;
            }
        },

/**
 * 注册
 */
        register: function () {
        	var base = this;
            if ($('#mobile').val().length == 0) return;
            if ($('#pwd').val().length == 0) return;
            if ($('#mobile_code').val().length == 0) return;
            if ($("#recommend_code").val().length == 0) return;
            var agree_val=$('input[name="agree"]:checked').val()
			if(!agree_val){
				tool.popup_err_msg("请阅读并签署服务协议");
				return;
			}
            if ($("#mobileno1").is(":hidden")) {
                $("#mobileno1").show();
                $("#mobileno2").show();
                $("#mobileno3").hide();
                $("#mobileno4").hide();
                $("#mobileno5").hide();
                $("#mobileno6").hide();
                $("#mobileno11").hide();
                return;
            }
            if ($('#mobileno').val().length != 11) {
                tool.popup_err_msg("请填写正确的手机号码");
                return;
            }
            if ($('#mobileno_code').val().length < 4) {
                tool.popup_err_msg("请填写正确的验证码");
                return ;
            }
           // if ($("#recommend_code").val().length < 5) {
             // tool.popup_err_msg("请填写正确的邀请码");
              //return;
            //}
            if(!agree_val){
				tool.popup_err_msg("请阅读并签署服务协议");
				return;
			}

//          var refId = store.getCookie("refId", 1);
            $.ajax({
            	url:'/index/index/doReg',
                type:"post",
                dataType:"json",
            	data:{
            		nick_name: $('#mobile').val(),
                    login_pwd: $('#pwd').val(),
                    mobile: $('#mobileno').val(),
                    code: $('#mobileno_code').val(),
                    recommendCode:$('#recommend_code').val(),
            	},
            	success:function(data){
            		if (data.code != '0') {
                        base.popup_err_msg(data.msg);
                        return;
                   	}
                     else {
                        base.popup_err_msg("注册成功");
                        window.location.href="/login.html";
                    }
            	}
            })

        },
        
};

$(function(){reg.init();})





