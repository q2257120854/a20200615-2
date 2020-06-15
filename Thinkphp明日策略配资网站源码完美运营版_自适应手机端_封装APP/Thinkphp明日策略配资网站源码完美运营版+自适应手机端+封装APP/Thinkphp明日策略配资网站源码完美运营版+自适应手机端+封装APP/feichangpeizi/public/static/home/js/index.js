//index_login
var index_login={
/**
 * 初始化
 */
	init:function(){
		this.eventsBind();
	},
/**
 * 事件绑定
 */
	eventsBind:function(){
		var base=this;
		//点击登录按钮
		$('.btn_login').on('click',function(){
			base.indexLogin()
		});
		//回车键
		$('.login_main').on('keyup',function(e){
			if(e.keyCode=='13'){
				base.indexLogin()
			}
		});
		
		//判断有无数据
        if($('#asset-details-tbl thead>tr').length==1){
        	$('section.moneydetails').append('<div class="data-empty"><div class="data-empty">暂无数据</div></div>')
        }
		
		//切换资金
		$("#money-flow > li > a").click(function () {
                $(this).addClass("active").parent().siblings().find("a").removeClass("active");
        });
        
        //切换时间
        $("#search-times").change(function () {
                var times = $(this).val();
        });
        
        
           
        
	},
/**
 * 首页登录
 */
	indexLogin:function(){
		var base = this;
		$('#err1').hide();
		$('#err2').hide();
		if($('#username').val().length==0){
			$('#err1').show();
			return;
		}
		
		if($('#password').val().length==0){
			$('#err2').show();
			return;
		}
		$.ajax({
			url:'/index/index/doLogin',
			data:{
				nick_name: $("#username").val(),
	        	login_pwd: $("#password").val()
			},
			type:'post',
			dataType:'json',
			success:function(data){
				if(data==null){return};
				if (data.code != '0') {
                    tool.popup_err_msg(data.msg);
                    return;
                }else {
                    tool.popup_err_msg("登录成功");
                    location.href = "/ucenter/index.html";
                }
			}
		})
	},


}
//初始化
$(function(){index_login.init();})

