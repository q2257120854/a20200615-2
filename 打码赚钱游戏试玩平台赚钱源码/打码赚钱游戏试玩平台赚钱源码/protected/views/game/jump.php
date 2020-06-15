<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>正在前往
            <?php
            if ($type == 5) {
                echo $expad_info["name"];
            } else {
                echo $game_info["name"];
            }
            ?>
        </title>
        <link href="/style/jump.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script>
            window.onload = function() {
                setTimeout(function() {
                    location.href = '<?php echo $url; ?>';
                }, 3000);
            }
        </script>
    </head>
    <body>
        <div class="jump">
            <div class="ju_top clearfix">
                <div class="ju_logo"></div>
                <div class="ju_d"><p>试玩跳转中...</p></div>
                <?php if ($type == 5) { ?>
                    <div class="ju_tu"><img src="/uploads/img/expad/<?php echo $expad_info->img; ?>" /></div>
                <?php } else { ?>
                    <div class="ju_tu"><img src="/uploads/img/game/<?php echo $game_info->img; ?>" /></div>
                <?php } ?>
            </div>
            <p class="ju_text">如果浏览器没有自动跳转，请&nbsp;<a href="<?php echo $url; ?>">点击这里<i>&nbsp;>></i></a></p>
            <p class="ju_text_1">温馨提示：</p>
            <p class="ju_text_1">1.同一平台试玩，<i>请先退出已登录的平台账号再注册！</i></p>
            <p class="ju_text_1">2.<i>注册试玩</i>完成后清先返回到试玩广告页，刷新<i>查看您的试玩信息</i>。</p>
            <p class="ju_text_1">3.若<i>无绑定信息</i>，请<i>更换浏览器</i>或<i>清除cookies重新注册！</i></p>
        </div>
    </body>
</html>
