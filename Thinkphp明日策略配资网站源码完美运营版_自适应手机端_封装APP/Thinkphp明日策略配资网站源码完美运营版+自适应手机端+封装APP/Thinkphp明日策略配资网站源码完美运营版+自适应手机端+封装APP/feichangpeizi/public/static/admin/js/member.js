/**
 * Created by wo on 2017/7/21.
 */

function doWithdraw(id, status){
    if(id <= 0){
        alert("id错误");
    }
    $.post("/admin.php/admin/member/do_withdraw.html", {id : id, status:status}, function(data){
        if(data.code == '0'){
            alert("操作成功");
            location.reload();
        }else{
            alert(data.msg);
        }
    }, 'json');
}
