    $(function() {
        var pattern = /^https:\/\/mmbiz/;
        var prefix = 'http://img01.store.sogou.com/net/a/04/link?appid=100520031&w=710&url=';
        $("img").each(function(){
            var src = $(this).attr('src');
            if(pattern.test(src)){
                var newsrc = prefix+src;
                $(this).attr('src',newsrc);
            }
			//$('#js_content').autoIMG();
        });
	});
$(function(){	
	$(window).scroll(function() {		
		if($(window).scrollTop() >= 50){
			$('#back-to-top').fadeIn(300); 
		}else{    
			$('#back-to-top').fadeOut(300);    
		}  
	});
	$('.stop').click(function(){
	$('html,body').animate({scrollTop: '0px'}, 300);});	
});
$(function(){
    var clientH = document.body.clientHeight-2048;
    var liW = document.body.clientWidth-70;
    var dot= $('#dot');
    var bar = $('#menu-bar');

    dot.on('click', function(){
      $('.full').css({'display':'block'}).show();
      bar.animate({'left':'0%'})
    });

    $('.ico_nav_info').bind('click',function(){
      $('.full').css({'display':'block'}).show();
      $('.side').css({'display':'block'}).show();
      $('.side').animate({'right':"70%"},function(){
        $('body').bind('touchmove',stopScroll);
      });
    });
    $('.full').bind('click',hideUser);
    function hideUser(){
      $('.side').animate({'right':"100%"},function(){
        $('body').unbind('touchmove',stopScroll);
        $('.full').hide();
      });
      bar.animate({'left':'-100%'},function(){
        $('body').unbind('touchmove',stopScroll);
        $('.full').hide();
      }); 
    }
    function stopScroll(e){
      e.preventDefault();
    }
  })