var person={
	init:function(){
		this.eventsBind();
	},
	eventsBind:function(){
		var base=this;
		//显示图片
		$.ajax({
			url:'/index/index/doImg',
			type:'post',
			dataType:'json',
			success:function(data){
				if(data.memberImgPath){
					$('#headImg').attr('src', data.memberImgPath);
				}else{
					$('#headImg').attr('src', '/public/static/home/img/moblie/name.png');
				}
			}
		})
		//上传图片
		
		$('#img_upload').AjaxFileUpload({
			//处理文件上传操作的服务器端地址
			action: '/index/index/doImg',
			onComplete: function(filename, resp) { //服务器响应成功时的处理函数
				if(resp.code == 0) {
					$('#headImg').attr('src', resp.absPath);
					var params = {};
					params['imgpath'] = resp.absPath;
					$.post("${context}/mobile/ucenter/savePeopleImg.do", params, function(data) {
						if(data.code == '0') {
							mui.toast("修改成功");
						} else {
							mui.toast(data.message);
						}
					});
				} else {
					mui.toast(resp.message, 'error');
				}
			}
		});
	},
}
