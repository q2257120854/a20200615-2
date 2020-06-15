//login
var user_Login={
/**
 * 初始化
 */
		init:function () {
			this.eventsBind();
		},
	
/**
 * 事件绑定
 */
		eventsBind: function () {
            var base = this;
            
            //点击登录按钮
            $("#login-btn").on("tap", function () {
		        base.user_Login();
		    });
		    
       	},

/**
 * 登录
 */
        user_Login :function () {
        	var base = this;
        	if($("#username").val().length == 0){
        		mui.alert('用户名不能为空')
        		return;
        	}
        	if($("#psw").val().length == 0){
        		mui.alert('密码不能为空')
        		return;
        	}
	        $.ajax({
	        	url:'/index/index/doLogin',
	        	data:{
	        		nick_name: $("#username").val(),
	        		login_pwd: $("#psw").val()
	        	},
	        	dataType:'json',
	        	type:'post',
	        	success:function(data){
	        		if (data.code != '0') {
                        mui.toast(data.msg);
                        return;
                   	}else {
                        mui.toast("登录成功");
                        location.href = '/ucenter/home.html';
                    }
	        	}
	        })
        
    },

        
}
//初始化
user_Login.init()