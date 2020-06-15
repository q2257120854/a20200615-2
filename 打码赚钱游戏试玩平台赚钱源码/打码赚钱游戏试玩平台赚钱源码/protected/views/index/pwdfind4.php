<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>找回密码_4-<?php echo TIT; ?></title>
            <meta name="keywords" content="、,、官网,51玩,试玩平台,网页游戏,游戏试玩,网上赚钱,打码网赚,打码平台,免费赚钱,免费换奖,网赚提现" />
            <meta name="description" content="、是一个玩游戏、体验产品赚积分，兑换各种奖品的体验营销娱乐平台。这里有最新最好玩的网页游戏，让您轻松实现网上赚钱的愿望。我们打造专业的网络兼职平台，用户在游戏试玩、参与互动体验、购物返利中获得免费积分--元宝，元宝可以换取Q币、话费、笔记本等丰富的奖品，是用户网赚和网络兼职的好去处" />
            <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
            <link href="/style/public.css" rel="stylesheet" type="text/css" />
            <link href="/style/password_find.css" rel="stylesheet" type="text/css" />
            <script src="/scripts/jQuery.v1.8.3.js"></script>
            <script src="/scripts/public_js.js"></script>
            <script type="text/javascript">
                var InterValObj; //timer变量，控制时间
                var count = 5; //间隔函数，1秒执行
                var curCount;//当前剩余秒数
                curCount = count;
                //设置button效果，开始计时
                $("#djs").html(curCount + "秒后自动跳转到首页<a href='<?php echo SITE_URL; ?>'>返回首页</a>");
                InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
                //timer处理函数
                function SetRemainTime() {
                    if (curCount == 0) {
                        window.clearInterval(InterValObj);//停止计时器
                        location.href = "<?php echo SITE_URL ?>";
                    } else {
                        curCount--;
                        $("#djs").html(curCount + "秒后自动跳转到首页<a href='<?php echo SITE_URL; ?>'>返回首页</a>");
                    }
                }
            </script>
    </head>
    <body >
        <!--头部-->
        <?php include_once("./protected/views/design/header.php") ?>
        <!--主体-->
        <div class="main">

            <!--找回密码第一步-->
            <div class="password_find clearfix">
                <div class="tit">
                    <span>找回密码</span>
                    <i>Password</i>
                </div>
                <div class="cont_1">
                    <div class="step_4"></div>
                    <div class="complete">
                        <p class="p_1">恭喜您，新密码设置成功</p>
                        <p class="p_2" id="djs">5秒后自动跳转到首页<a href="<?php echo SITE_URL ?>">返回首页</a></p>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
    </body>
</html>
