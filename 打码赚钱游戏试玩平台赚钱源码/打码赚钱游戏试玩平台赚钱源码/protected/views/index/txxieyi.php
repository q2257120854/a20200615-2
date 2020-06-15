<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>协议-<?php echo TIT; ?></title>
            <meta name="keywords" content="、,、官网,51玩,试玩平台,网页游戏,游戏试玩,网上赚钱,打码网赚,打码平台,免费赚钱,免费换奖,网赚提现" />
            <meta name="description" content="、是一个玩游戏、体验产品赚积分，兑换各种奖品的体验营销娱乐平台。这里有最新最好玩的网页游戏，让您轻松实现网上赚钱的愿望。我们打造专业的网络兼职平台，用户在游戏试玩、参与互动体验、购物返利中获得免费积分--元宝，元宝可以换取Q币、话费、笔记本等丰富的奖品，是用户网赚和网络兼职的好去处" />
            <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
            <link href="/style/public.css" rel="stylesheet" type="text/css" />
            <link href="/style/xieyi.css" rel="stylesheet" type="text/css" />
            <script src="/scripts/jQuery.v1.8.3.js"></script>
            <script src="/scripts/public_js.js"></script>
    </head>
    <script>
        $(function() {
            //头部信息鼠标悬浮
            $(".top .big .ul_3 li").mouseover(function() {
                $(this).find(".bck").show();
                $(this).find(".neir").show();
                $(this).find(".bck_2").show();
                $(this).find(".neir_2").show();
            });
            $(".top .big .ul_3 li").mouseout(function() {
                $(this).find(".bck").hide();
                $(this).find(".neir").hide();
                $(this).find(".bck_2").hide();
                $(this).find(".neir_2").hide();
            });
            //二维码弹出框
            $(".bottom_1 .cont .ul_1 .jies .ul_2 li .weix").click(function() {
                $(".qR_code_bk").show();
                $(".qR_code").show();
            })
            $(".qR_code .p_1 i").click(function() {
                $(".qR_code_bk").hide();
                $(".qR_code").hide();
            })
        })
    </script>
    <body>
        <!--协议开始-->
        <div class="agreement">
            <p class="tit">、提现协议</p>
            <p class="xz">、提现协议</p>
            <p class="xz">一、提现规则</p>
            <div class="nr">
                <p>支付宝提现：</p>
                <p class="nr_1">1、支付宝地址必须是经实名制认证的，且与收款信息中的账户名一致；</p>
                <p class="nr_1">2、支付宝地址错误、支付宝账户名错误、支付宝未激活、支付宝未经实名制认证，将得不到支付；</p>
                <p class="nr_1">3、对于不符合条件的支付申请，我们将进行退回处理；</p>
                <p class="nr_1">4、三次被退回而未经改进继续提交的，将在不付款的情况下，直接修改支付状态，所申请之款项，请作为处理支付人员之工资；</p>
                <p class="nr_1">5、其它在此处未写明之不符合支付之条件者，以处理支付时发送的站内信为准。
                    银行提现：</p>
                <p>银行提现：</p>
                <p class="nr_1">1、银行账号必须正确；</p>
                <p class="nr_1">2、支行名称必须正确；</p>
                <p class="nr_1">3、如果提现失败，需要联系客服人员核对相关信息后申请，如果不经客服核对而再次申请的，我们将不再处理。</p>
            </div>
            <div class="nr">
            </div>
            <p class="xz">二、会员申明</p>
            <p class="nr">1、会员申明在、所填写的资料真实有效；</p>
            <p class="nr">2、所有会员只得操作自己的账号，如果非法盗取他人账号，、有权追究其责任并移动公安机关处理。</p>
            <p class="xz">三、免责条款</p>
            <p class="nr">因会员保管不善造成账户被他人盗取造成的损失本站不承担任何程度的责任。</p>
        </div>
        <!--底部1-->
        <?php include_once("./protected/views/design/footer.php"); ?>
        <?php include_once("./protected/views/design/kefu.php"); ?>
        <!--底部二维码弹出框结束-->
    </body>
</html>
