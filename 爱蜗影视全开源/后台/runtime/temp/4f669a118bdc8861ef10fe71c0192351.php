<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"/www/wwwroot/awys.com/application/app/view/index/m.html";i:1573644434;}*/ ?>
﻿
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>爱蜗影视_APP下载在线免费观看全网影视</title>
    <link rel="stylesheet" href="../../../../css/langshan.css">
    <script>
      adaptation(750);
      function adaptation(size) {
        if (document.documentElement.clientWidth > size) {
          document.documentElement.style.fontSize = size / 7.5 + "px"
        } else {
          document.documentElement.style.fontSize = document.documentElement.clientWidth / 7.5 + "px"
        }
      }
    </script>
 
    </head>
<body>
<div class="warp">
    <div class="header">
        <div class="soft-logo">
            <img src="../../../../images/logo.png" alt="打飞机影视">	
        </div>
        <div class="soft-name">
            <p>爱蜗影视</p>
            <p><b>48万人已下载此应用</b></p>
        </div>
        <div class="soft-down">
            <div class="soft-btn" onClick="down()"><img src="../../../../images/down-txt.gif" alt="立即下载"></a></div>
        </div>
    </div>
    <div class="soft-cont">
        <img src="../../../../images/img1.jpg" alt="">
        <img src="../../../../images/img2.jpg" alt="">
        <img src="../../../../images/img3.jpg" alt="" class="softDown" onClick="down()">
        <img src="../../../../images/img4.jpg" alt="">
        <img src="../../../../images/img5.jpg" alt="">
        <img src="../../../../images/img6.jpg" alt="" class="softDown" onClick="down()">
        <img src="../../../../images/Artboard 2 Copy.jpg" alt="">
    </div>
</div>
</body>
</html>
<div class="step" style="display:none;">
    <div class="step-header">
        苹果手机如何通过信任教程
    </div>
    <img src="../../../../images/step/step-0.png" alt="">
    <img src="../../../../images/step/step-1.png" alt="">
    <img src="../../../../images/step/step-2.png" alt="">
    <img src="../../../../images/step/step-3.png" alt="">
    <img src="../../../../images/step/step-4.png" alt="">
    <img src="../../../../images/step/step-5.png" alt="">
    <img src="../../../../images/step/step-6.png" alt="">
    <img src="../../../../images/step/step-7.png" alt="">
</div>
<div class="weixin" style="display:none;">
    <img src="../../../../images/step/weixinTip.png" alt="">
</div>
<script src="js/langshan.js"></script>
<script>
    $(function () {
        $('.softDown').on('click',function () {
            if( typeof WeixinJSBridge !== "undefined" ) {
                $('.weixin').show();
            }else{
                down();
            }
        });
    });
    function down() {
        if (/(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent)) {
            //苹果下载地址
            window.location.href ="<?php echo advert('30'); ?>";  //这里替换你的下载地址
            $('.warp').hide();
            $('.step').show();
        } else if (/(Android)/i.test(navigator.userAgent)) {
            //安卓下载地址
            window.location.href ="<?php echo advert('30'); ?>";  //这里替换你的下载地址
        } else {
            //pc下载地址，默认可以为安卓版本
            window.location.href ="<?php echo advert('30'); ?>";  //这里替换你的下载地址
        }
    }
</script>
