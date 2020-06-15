/**
 * Created by wo on 2017/7/18.
 */
function doLiquidation(orderId){
    if( orderId <= 0){
        return;
    }
    if(!window.confirm("确定平仓吗？")){
        return;
    }
    $.post( "/admin.php/admin/order/liquidation", {orderId : orderId}, function(data){
        if(data.code == '0'){
            alert("已平仓");
            location.reload();
        }else{
            alert(data.msg);
        }
    }, 'json' );
}
function exportby(orderId){
    if( orderId <= 0){
        return;
    }
    if(!window.confirm("确定导出吗？")){
        return;
    }
  window.location.href="/admin.php/admin/order/daochu";
}
$(function(){
    $("td").each(function(i, o){
        if(isFloat($(o).html())){
            var f = parseFloat( $(o).html() );
            $(o).html(f.toFixed(2));
        }
    });
});

function isFloat(c)
{
    if(!isNaN(c) && c.indexOf('.') > 0){
        return true;
    }

    return false;
}