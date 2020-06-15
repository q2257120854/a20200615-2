<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>注册好友邀请页-<?php echo TIT; ?>、官方网站</title>
        <meta name="keywords" content="/" />
        <meta name="description" content="/" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
    </head>
    <body>
        <form  name="myfrom" id="myform" method="post" action="<?php echo SITE_URL; ?>friend/reg">
            <input type="hidden" name="memid" id="memid" value="<?php echo $memid; ?>" />
        </form>
        <!--加载大家都在玩滚动-->
        <script type="text/javascript">
            window.onload = function() {
                document.getElementById("myform").submit();
            }
        </script>
    </body>

</html>
