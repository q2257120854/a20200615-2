$(function(){		
	//游戏立即体验按钮
	$(".play_game .cont .list_1 .a_1").mouseover(function(){
		$(this).find(".bk").show();
		$(this).find(".ann").show();
		});
	$(".play_game .cont .list_1 .a_1").mouseout(function(){
		$(this).find(".bk").hide();
		$(this).find(".ann").hide();
		});
        //宝箱鼠标悬浮
        $(".chest .cont .ul_1 li .baox").mouseover(function(){
            $(this).find(".explain").show();
        })
        $(".chest .cont .ul_1 li .baox").mouseout(function(){
            $(this).find(".explain").hide();
        })
})

