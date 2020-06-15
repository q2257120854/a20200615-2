$(function(){
	//登录、注册文本输入框
	$(".sframe").focus(function() {
        var txt_value = $(this).val();
        if (txt_value == this.defaultValue) {
            $(this).val("")
        }
		$(this).css({
			 "color":"#333",
			"border":"1px solid #e6e6e6",
			 "box-shadow":"0 0 3px #1583FB"
			 })
       });
	$(".sframe").blur(function() {
        var txt_value = $(this).val();
        if (txt_value == "") {
            $(this).val(this.defaultValue);
        }
		 $(this).css({
			 "color":"808080",
			 "box-shadow":"none"
			 })
    })
})
	
	
