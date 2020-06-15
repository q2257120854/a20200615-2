// JavaScript Document
// End
function doreply(id){
	obj = document.getElementById('reply_'+id);
	if(obj.style.display=='block'){
		document.getElementById('reply_'+id).style.display='none';
	}else{
		document.getElementById('reply_'+id).style.display='block';
		}
}
	function showqqface(){
		obj = document.getElementById('qqface');
		if(obj.style.display=='block'){
			document.getElementById('qqface').style.display='none';
		}else{
			document.getElementById('qqface').style.display='block';
			showali();
			}
	}
	function apdface(num){
		obj = document.getElementById('content');
		f = '';
		switch (num){
			case 0:f='{:0:}';break;
			case 1:f='{:1:}';break;
			case 2:f='{:2:}';break;
			case 3:f='{:3:}';break;
			case 4:f='{:4:}';break;
			case 5:f='{:5:}';break;
			case 6:f='{:6:}';break;
			case 7:f='{:7:}';break;
			case 8:f='{:8:}';break;
			case 9:f='{:9:}';break;
			case 10:f='{:10:}';break;
			case 11:f='{:11:}';break;
			case 12:f='{:12:}';break;
			case 13:f='{:13:}';break;
			case 14:f='{:14:}';break;
			case 15:f='{:15:}';break;
			case 16:f='{:16:}';break;
			case 17:f='{:17:}';break;
			case 18:f='{:18:}';break;
			case 19:f='{:19:}';break;
			case 20:f='{:20:}';break;
			case 21:f='{:21:}';break;
			case 22:f='{:22:}';break;
			case 23:f='{:23:}';break;
			case 24:f='{:24:}';break;
			case 25:f='{:25:}';break;
			case 26:f='{:26:}';break;
			case 27:f='{:27:}';break;
			case 28:f='{:28:}';break;
			case 29:f='{:29:}';break;
			case 30:f='{:30:}';break;
			case 31:f='{:31:}';break;
case 32:f='{:32:}';break;
case 33:f='{:33:}';break;
case 34:f='{:34:}';break;
case 35:f='{:35:}';break;
case 36:f='{:36:}';break;
case 37:f='{:37:}';break;
case 38:f='{:38:}';break;
case 39:f='{:39:}';break;
case 40:f='{:40:}';break;
case 41:f='{:41:}';break;
case 42:f='{:42:}';break;
case 43:f='{:43:}';break;
case 44:f='{:44:}';break;
case 45:f='{:45:}';break;
case 46:f='{:46:}';break;
case 47:f='{:47:}';break;
case 48:f='{:48:}';break;
case 49:f='{:49:}';break;
case 50:f='{:50:}';break;
			}
			obj.value+=f;
			document.getElementById('qqface').style.display='none';
		}
//提交评论
function plsubmit(){
	if ($("#content").val().length==0) {
		$('#itip').html('请输入评论内容!');
		$('#itip').focus();
		return;
	}
	var nomember = ($('#nomember').attr('checked'))?'1':'0';
	
	var str ='nomember='+nomember+'&enews=' + $('#enews').val() + '&content=' +escape($('#content').val() )+ '&id=' + $('#id').val() + '&classid=' + $('#classid').val() + '&repid=' + $('#repid').val();
	$.ajax({
		type: 'post',
		url: '/e/extend/pl/hf.php',
		data: str,
		error: function() {
			alert('error');
		},
		success: function(data) {
		
			switch (data) {
			case 'login':
                               alert(':）亲，您还没有登录!');
				break;
			case 'kong':
                                alert(':）亲，赶紧输入评论内容!');
				break;
			case 'PlSizeTobig':
                                alert(':）亲，你的评论内容过多了!');
				break;

			case 'Splclosewords':
                $('#itip').html('亲,恭喜发表成功!');
				$('#content').val('');
				CommentToPage(0);
				break;
			case 'Success':
				$('#itip').html('亲,恭喜发表成功!');
				$('#content').val('');
				CommentToPage(0);
				break;
                        case 'CloseInfoPl':
	                      alert('-_-#亲，评论都关闭了还在评论啊！');
								break;
                        case 'CloseInfoPl1':
	                      alert(':-)亲，赶紧升级你的会员级别吧！');
	                      break;
                        case 'mg':
	                 alert('~~o(>_<)o ~~亲，您想干嘛！不要攻击我嘛！');
	                     break;
                        case "PlOutTime":
                        alert("-_-#亲，先喝杯茶吧！系统限制的评论间隔是 20 秒,请稍后再发");
                             break;
			default:
				alert('( ⊙o⊙?)亲，你可能匿名评论或IP非法哦！');
				break;
			}
		}
	});
}


function CheckPl() {
    var username, password, key, nomember, saytext, id, classid, enews, repid, ecmsfrom, str;
    username = $("#username").val();
    password = $("#password").val();
    key = $("#key").val();
    if ($("#nomember").attr("checked")) {
        nomember = 1
    } else {
        nomember = 0
		if(username==''){
			alert('请输入用户名');
			$('#username').focus();
			return false;
		}
		if(password==''){
			alert('请输入用户名密码');
			$('#password').focus();
			return false;
		}
		
		
    };
	
    saytext = $("#noteCon").val();
    id = $("#id").val();
    classid = $("#plclassid").val();
    enews = 'AjaxPl';
    repid = $("#repid").val();
    ecmsfrom = $("#ecmsfrom").val();
    if (key == '') {
        alert('请输入验证码');
        return false
    };
    if (saytext == '') {
        alert('至少说点什么吧!');
        return false
    };
    str = "username=" + escape(username) + "&password=" + escape(password) + "&key=" + key + "&nomember=" + nomember + "&saytext=" + escape(saytext) + "&id=" + id + "&classid=" + classid + "&enews=" + enews + "&repid=" + repid + "&ecmsfrom=" + ecmsfrom;
    $.ajax({
        type: 'post',
        url: '/e/extend/ajaxcomment/ajaxpl.php',
        data: str,
        error: function() {
            alert('dberror')
        },
        success: function(data) {
            switch (data) {
            case "AddPlSuccess":
                alert("增加评论成功!");
                document.getElementById("key").value = "";
                document.getElementById("noteCon").value = "";
                document.getElementById("wyzm").src = "/e/ShowKey/?v=pl&rm=" + Math.random();
                CommentToPage(0);
                break;
            case "FailPassword":
                alert("您的用户名或密码有误!");
                break;
            case "ErrorUrl":
                alert("您来自的链接不存在!");
                break;
            case "EmptyPl":
                alert("请输入评论内容!");
                break;
            case "NotLevelToPl":
                alert("您所在的会员组不能发表评论!");
                break;
            case "GuestNotToPl":
                alert("游客不能发表留言!");
                break;
            case "FailKey":
                alert("验证码错误!");
                break;
            case "OutKeytime":
                alert("验证码过期!");
                break;
            case "NotCheckedUser":
                alert("您的帐号还未通过审核");
                break;
            case "PlSizeTobig":
                alert("您的评论内容过长");
                break;
            case "PlOutTime":
                alert("系统限制的发表签收间隔是 20 秒,请稍后再发");
                break;
            case "CloseInfoPl":
                alert("此信息已关闭评论");
                break;
            case "DbError":
                alert("dberror");
                break;
            default:
                alert("其他未知提示,请在case中添加此提示: " + data)
            }
        }
    });
}











//提交回复
function replsubmit(n){
    
        if ($('#re'+n).val() == '' || $('#retxt'+n).val() == '') {
            $('#itip').html('请输入评论内容!');
            $('#itip').focus();
            return;
        }
        var str ='enews=ajaxpl&content=' + escape($('#retxt'+n).val()) + '&id=' + $('#id').val() + '&classid=' + $('#classid').val()+'&pid='+$('#re'+n).val();
        $.ajax({
            type: 'post',
            url: '/e/extend/pl/hf.php',
            data: str,
            error: function() {
                alert('error');
            },
            success: function(data) {
                switch (data) {
                case 'login':
                    alert('亲，赶紧登录系统吧!');
                    break;
                case 'kong':
                    alert('亲，赶紧输入评论内容吧!');
                    break;
                case 'PlSizeTobig':
                    alert('亲，你的评论内容也太多哇!');
                    break;
                 case 'mg':
	            alert('亲，您想干嘛！敏感字符啊！');
	            break;
                case 'Success':
					CommentToPage(0);
                    break;		
                default:
                   case 'login':
                    alert('亲，赶紧登录系统吧!');
                }
            }
        });
}
