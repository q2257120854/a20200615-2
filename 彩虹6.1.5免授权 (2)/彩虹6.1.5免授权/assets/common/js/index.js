var PmWidth = window.screen.width;
$(function () {
    var gotop = $("#top");
    var mobileNav = $("#mobileNav").parent();
    $(window).scroll(function () {
        if ($(window).scrollTop() > 288) {
            gotop.fadeIn(888);
        } else {
            gotop.fadeOut(588);
        }
        //导航
        function mobileNavs(){
            if ($(window).scrollTop() > 70) {
                mobileNav.css('position','fixed');
            } else {
                mobileNav.css({
                    'position':'relative',
                    'top':'0',
                    'z-index':'888'
                });
            }
        }
    });
    gotop.click(function () {
        $('body,html').animate({
             scrollTop: 0 
         }, 688);
    18});

    function TuTips(){
        if(PmWidth <= 520){
            var AreaWidth = ['90%', '80%']
        }else{
            var AreaWidth = ['500px', '600px']
        }
        layer.open({
            type: 2,
            title:'<i class="fas fa-upload"></i> 图片上传',
            area: AreaWidth,
            //skin: 'layui-layer-rim', 
            content: ['../aliossup'],
            success: function (layero, index){
                var body = layer.getChildFrame('body', index);
                body.find(".navbar").hide();
            }
        });
    }

    var clipboard = new Clipboard('#copy-btn');
    clipboard.on('success', function(e) {
        var copyBtn = $('#copy-btn:hover').data('text');
        if(copyBtn != undefined){
            var copyTips = copyBtn;
        }else{
            var copyTips = '复制成功！';
        }
        layer.msg(copyTips,{time: 2000, icon: 6});
    });
    clipboard.on('error', function(e) {
        layer.msg('复制失败，请长按选中后进行复制！',{time: 2000, icon: 5});
    });
});