<?php
if ($conf['cdnpublic'] == 1) {
    $cdnpublic = 'https://lib.baomitu.com/';
} elseif ($conf['cdnpublic'] == 2) {
    $cdnpublic = 'https://cdn.bootcss.com/';
} elseif ($conf['cdnpublic'] == 3) {
    $cdnpublic = 'https://tencent.beecdn.cn/libs/';
} elseif ($conf['cdnpublic'] == 4) {
    $cdnpublic = 'https://s1.pstatp.com/cdn/expire-1-M/';
} else {
    $cdnpublic = 'https://cdn.staticfile.org/';
}
if ($conf['cdnserver'] == 1) {
    $cdnserver = 'https://cdn.qqzzz.net/';
} else {
    $cdnserver = null;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>邀请访问验证页面</title>
    <link href="<?php echo $cdnpublic; ?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="<?php echo $cdnpublic; ?>jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo $cdnpublic; ?>layer/2.3/layer.js"></script>
</head>
<body>
<script>
    $(function ($) {
        loadMsg();
        function loadMsg(){
            layer.alert('<div><div class="form-group" style="margin-bottom: 0;">\n' +
                '    <label for="verifyCode">请输入验证码进行通过访问</label>\n' +
                '    <input type="text" class="form-control" id="verifyCode" placeholder="请输入验证码">\n' +
                '<img alt="" id="verifyImg" style="margin: 0 auto;display: flex;justify-content: center;align-items: center;margin-top: 15px;border: 1px solid #D0D0D0" src="./ajax.php?act=getVerifyCodeImg&type=viewVerifyCode&r=' + Math.random() + '"/>' +
                '  </div></div>', {
                closeBtn: false,
                title: '访问验证',
                yes: function (index, layero) {

                    var code = $('#verifyCode').val();
                    if (code.length === 0) {
                        layer.msg('验证码不能为空', {icon: 2});
                        setTimeout(function () {
                            loadMsg();
                        },1500);
                        return false;
                    }

                    var loadDom = layer.load();
                    $.post('./ajax.php?act=verifyCode&type=viewVerifyCode', {code: code}, function (data) {
                        layer.close(loadDom);
                        if (data['code'] !== 0) {
                            layer.msg(data['msg'], {icon: 2});
                            setTimeout(function () {
                                loadMsg();
                            },1500);
                        }else{
                            window.location.reload();
                        }
                    });
                    return  false;
                }
            });
        }
    });
</script>
</body>
</html>