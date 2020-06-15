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
var reg_moblie={
/**
 * 初始化
 */
	init:function(){
		this.eventsBind();
	},
/**
 * 事件
 */
	eventsBind:function(){
		var base=this;
		//改变img
		$(".reg_img").on('tap',function(){
			if($('#mobileno').val().length==0){
				mui.toast('手机号不能为空');
				return;
			}
			else{
				base.changeImg();
			}
			
		})
		//发送验证码
            $("#mobileno_code_a").on('tap',function () {
               	var _base = $(this);
            	//手机号不为空
            	if($('#mobileno').val().length==0){
					mui.toast('手机号不能为空');
				}
            	//图片验证码
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
            	
            	
				         
            });
		
		//提交注册
		$('#reg_btn').on('tap',function(){
			base.register()
		})
		
	},
/**
 * 更改图片
 */
	changeImg:function(){
        //$('#forgot_passImg').attr('src', '{:captcha_src()}'); 此方法可用于行内click
 		var ts = Date.parse(new Date())/1000;
        $('#forgot_passImg').attr("src", "/captcha?id="+ts);
	},
	
	
	
	register:function(){
		if($('#mobileno').val().length<11){
			mui.toast('请输入正确手机号');
			return;
		}
		if($('#txt_valid_code').val().length==0){
			mui.toast('请输入图片验证码');
			return;
		}
		if($('#mobilenoCode').val().length==0){
			mui.toast('请输入验证码');
			return;
		}
		if($('#pwd').val().length==0){
			mui.toast('请输入密码');
			return;
		}
		if($('#mobile').val().gblen()<6){
			mui.toast('用户名不能小于6位');
			return;
		}
      if ($("#recommend_code").val() == "") {
			mui.toast('请输入机构推荐码');
			return;
		}
      if ($("#recommend_code").val().length <3) {
 			mui.toast('请输入正确机构推荐码');
			return;
		} 
      
		//发送请求
		 $.ajax({
            	url:'/index/index/doReg',
                type:"post",
                dataType:"json",
            	data:{
            		nick_name: $('#mobile').val(),
                    login_pwd: $('#pwd').val(),
                    mobile: $('#mobileno').val(),
                    code: $('#mobilenoCode').val(),
                    recommendCode:$('#recommend_code').val(),
            	},
            	success:function(data){
            		if (data.code != '0') {
                        mui.toast(data.msg);
                        return;
                   	}
                     else {
                        mui.toast("注册成功");
                        window.location.href="/login.html";
                    }
            	}
            })

		
	}


}


