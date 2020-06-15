// JavaScript Document
$(function(){
	$("#menu ul li").hover(
		function(){ $(this).addClass("cur") },
		function(){ $(this).removeClass("cur") }
	);
	
	$("body").on("hover",".menu",function(){
		$(this).find(".dropdown").toggle()
	});
	
})