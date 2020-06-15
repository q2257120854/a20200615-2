$(function(){
    /*可以使用下面的两个语句来实现loading动画的显示和隐藏*/
    $("#sk-three-bounce").show();
    $(document).ready(function () {
        setTimeout(function () {
            $("#sk-three-bounce").hide();
        }, 200);
        // $("#sk-three-bounce").hide();
    });
});