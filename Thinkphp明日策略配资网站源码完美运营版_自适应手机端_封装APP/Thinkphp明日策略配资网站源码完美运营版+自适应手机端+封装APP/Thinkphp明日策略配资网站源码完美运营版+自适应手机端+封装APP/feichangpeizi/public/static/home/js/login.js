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
            $("#login-btn").on("click", function () {
		        base.user_Login();
		    });
		    
		    //回车键
		    $("#page_auth_login").keyup(function () {
		        if (event.keyCode == 13) {
		            base.user_Login();
		        }
		    });
       	},

/**
 * 登录
 */
        user_Login :function () {
        	var base = this;
        	if($("#用户名i").val().length == 0){
        		$('.name-err1').show()
        		return;
        	}
        	if($("#登录密码i").val().length == 0){
        		$('.psw-err1').show()
        		return;
        	}
	        $.ajax({
	        	url:'/index/index/doLogin',
	        	data:{
	        		nick_name: $("#用户名i").val(),
	        		login_pwd: $("#登录密码i").val()
	        	},
	        	dataType:'json',
	        	type:'post',
	        	success:function(data){
	        		if(data==null){return};
	        		if (data.code != '0') {
                        tool.popup_err_msg(data.msg);
                        return;
                   	}else {
                        tool.popup_err_msg("登录成功");
                        location.href = data.data.redirect_url;
                    }
	        	}
	        })
        
    },

        
}
//初始化
user_Login.init()