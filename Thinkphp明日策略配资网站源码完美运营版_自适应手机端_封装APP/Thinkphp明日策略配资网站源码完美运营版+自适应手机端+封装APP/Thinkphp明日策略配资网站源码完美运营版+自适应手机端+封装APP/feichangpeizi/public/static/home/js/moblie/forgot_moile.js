var forgot_moile={
	init:function(){
		this.eventsBind();
	},
	eventsBind:function(){
		var base=this;
		//更改图片
		$('#forgot_passImg').on('tap',function(){
			if($('#mobileno').val().length<11){
				mui.toast('请输入正确手机号');
				return;
			}
			var ts=Date.parse(new Date())/1000;
			$(this).attr('src','/captcha.html?id='+ts)
		})
		//点击获取图片验证码
		$('#mobileno_code_a').on('tap',function(){
			var _base=$(this);
			//手机号不为空
			if($('#mobileno').val().length<11){
				mui.toast('请输入正确手机号');
				return;
			}
			//图片验证码不为空
			else if($('#txt_valid_code').val().length==0){
					mui.toast('请输入图片验证码');
				}else{
					var mobile=$("#mobileno").val()
					var imgCode=$('#txt_valid_code').val()
					//获取验证码和验证图片验证码
	            	$.ajax({
	            		url:'/index/index/sendMobileCode',
						data:{
							mobile: mobile, 
							imgCode:imgCode,
						},
	            		type:'get',
	            		dataType:'json',
	            		success:function(data){
							$('#forgot_passImg').attr('src', '/index.php/captcha.html');
	            			if(data.code=='0'){
	            				//禁止点击
								_base.attr('disabled','true')
								//设置样式
								_base.css({
									    'font-size': '20px',
				    					'color':'#ccc',
								})	
								_base.text("60s");
							        var getCodeCounter = window.setInterval(function () {
							        var s = parseInt(_base.text(), 10) - 1;
							        if (s > 0) {
							           	_base.text(s+'s');
							        } else {
							            window.clearInterval(getCodeCounter)
							            //可以点击
							            //还原样式
										_base.css({
											    'font-size': '12px',
						    					'text-align': 'right',
						    					'color':'var(--color_red)',
										});
										_base.text('获取验证码')
							            _base.attr('disabled','false')
							            mui.toast('请注意查收验证码')
							        }
							    }, 1000); 
	            			}else{
	            				 mui.toast("短信发送失败:"+data.msg);
	            				 
	            			}
	            		}
	            	})
				}
		})
		
		//提交
		$('#forgotPass_btn').on('tap',function(){
			if($('#mobileno').val().length==0){
			mui.toast('手机号不能为空');
			return;
		}
			else if($('#txt_valid_code').val().length==0){
				mui.toast('请输入图片验证码');
				return;
			}
			else if($('#mobilenoCode').val().length==0){
				mui.toast('请输入验证码');
				return;
			}
			else if($('#pwd').val().length==0){
				mui.toast('请输入密码');
				return;
			}
			//发送请求验证验证码
			$.post("/index/index/checkForgotMobileCode", {mobile: $("#mobileno").val(), code:$('#mobilenoCode').val()}, function(data){
						$("#mobilenoCode").val('');
                      if(data.code != '0'){
                         mui.alert(data.msg);
                      } else {
                      	//如果验证码对了，发送请求更改密码
						  	$.ajax({
					           	type:"post",
					           	url:"/index/index/updateNewPwd",
					           	data:{
					           	mobile:$("#mobileno").val(),
					           	login_newPwd:$('#pwd').val(),
					           },
					           	dataType:'json',
					           	success:function(data){
							        if(data.code != '0'){
							             tool.popup_err_msg(data.msg);
							        }else{
							        	mui.alert('密码修改成功',function(){
							        		window.location.href='/login.html';
							        	})
							        }
					           	}			
					        });  	
                      }
            }, 'json'); 
            
				
		 
		})
		
		
	},
}
