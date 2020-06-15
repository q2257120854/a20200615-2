//幻灯片
$(function() {
	var sWidth = $("#focus").width(); 
	var len = $("#focus ul li").length; 
	var index = 0;
	var picTimer;
	
	var btn = "<div class='btn'>";
	for(var i=0; i < len; i++) {
		btn += "<span>" + "</span>";
	}
	btn += "</div>"
	$("#focus").append(btn);


	$("#focus .btn span").mouseenter(function() {
		index = $("#focus .btn span").index(this);
		showPics(index);
	}).eq(0).trigger("mouseenter");

	$("#focus ul").css("width",sWidth * (len + 1));
	$("#focus").hover(function() {
		clearInterval(picTimer);
	},function() {
		picTimer = setInterval(function() {
			if(index == len) { 
				showFirPic();
				index = 0;
			} else {
				showPics(index);
			}
			index++;
		},4000); 
	}).trigger("mouseleave");
	
	function showPics(index) { 
		var nowLeft = -index*sWidth; 
		$("#focus ul").stop(true,false).animate({"left":nowLeft},500); 
		$("#focus .btn span").removeClass("on").eq(index).addClass("on")
	}
	
	function showFirPic() { 
		$("#focus ul").append($("#focus ul li:first").clone());
		var nowLeft = -len*sWidth;
		$("#focus ul").stop(true,false).animate({"left":nowLeft},500,function() {
			$("#focus ul").css("left","0");
			$("#focus ul li:last").remove();
		}); 
		$("#focus .btn span").removeClass("on").eq(0).addClass("on");
	}
	
	//查看详情、立即兑换
	$(".exchange .cont .ul_1 li").mouseover(function() {
		$(this).find(".l_c").show();  
		});
	$(".exchange .cont .ul_1 li").mouseout(function() {
		$(this).find(".l_c").hide();
		});
                
                
	//收货信息
	$(".introduction .cont .collect .list label").click(function() {
		$(this).parent().addClass("xuan").siblings().removeClass("xuan");
		});
                
                $(".introduction .cont .collect .list ul .new").click(function() {
		$(".introduction .cont .collect .fill").show();
		});
	$(".introduction .cont .collect .list label:not(:last)").click(function() {
		$(".introduction .cont .collect .fill").hide();
		});
});

