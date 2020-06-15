<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>兑换商城-物品详情—<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="手机充值卡,Q币,手机,笔记本,相机,数码产品,生活用品,免费奖品" />
        <meta name="description" content="<?php echo TIT; ?>兑奖商场是柿子赚到元宝后兑换奖品的地方，柿子通过玩网页试玩、棋牌试玩体验广告、网购等赚取元宝，通过积累一定的元宝，可以兑换虚拟奖品，如Q币，手机充值卡等，也可以兑换实物大奖，如数码产品、手机、笔记本以及生活用品、吃喝玩乐用品等等。" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/mall.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/public_js.js"></script>
        <script src="/scripts/mall.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.list_lh li:even').addClass('lieven');
            })
            $(function() {
                $("div.list_lh").myScroll({
                    speed: 40, //数值越大，速度越慢
                    rowHeight: 86 //li的高度
                });
            });
        </script>
        <style type="text/css">
            .hover1{ background: url(<?php echo IMG_URL; ?>img/nav_b.png) no-repeat center; font-weight: bold;}
            .hover1 a { color:#fff !important;}
        </style>
    </head>

    <body >
        <?php include_once("./protected/views/design/header.php") ?>
        <!--主体-->
        <div class="main clearfix">
            <?php include_once("left.php") ?>
            <div class="main_right clearfix">
                <!--奖品-->
                <div class="goods clearfix">
                    <span class="img"><img src="/uploads/img/gift/<?php echo $gift_info['img'] ?>" /></span>
                    <span class="name">
                        <p class="p_1"><?php echo $gift_info['name'] ?></p>
                        <p class="p_2">您兑换该奖品仅需：<em><?php echo number_format(intval($gift_info['hld_num'])); ?></em></p>
                        <?php
                        if ('Guest' == Yii::app()->user->name) {
                            ?>
                            <p class="p_2" >您还未登录，请先<a href="javascript:" id="loginBtns">立即登录</a> ,还未注册? <a href="<?php echo SITE_URL ?>index/regester" >免费注册</a></p>
                        <?php } else { ?>
                            <p class="p_2">您当前金豆：
                                <em>
                                    <?php
                                    $mem_model = Mem::model();
                                    $mem_info = $mem_model->findBySql("select id from {{mem}} where email='" . Yii::app()->user->name . "'");
                                    $hld = Hld::model()->countBySql("select sum(hld) from {{hld}} where  mem_id=" . $mem_info['id']);
                                    echo number_format(intval($hld));
                                    $num = 0;
                                    if ($gift_info['hld_num'] > $hld) {
                                        $num = $gift_info['hld_num'] - $hld;
                                    }
                                    ?></em><i>（
                                    <?php
                                    if ($num > 0) {
                                        echo "还需要" . number_format(intval($num)) . "金豆，";
                                    }
                                    ?>
                                    <a href="<?php echo SITE_URL ?>game/show">继续赚金豆</a>）</i></p>
                            <a class="ann_1" href="<?php echo SITE_URL; ?>gift/exchange/id/<?php echo $gift_info['id']; ?>">立即兑换</a>
                        <?php } ?>
                    </span>
                </div>
                <!--奖品介绍、兑奖流程、免责声明、兑奖须知-->
                <div class="introduction">
                    <div class="tit clearfix">
                        <ul class="ul_1 clearfix">
                            <li class="hover" id="tow1" onclick="setTab('tow', 1, 4)">奖品介绍</li>
                            <li id="tow2" onclick="setTab('tow', 2, 4)">兑奖流程</li>
                            <li id="tow3" onclick="setTab('tow', 3, 4)">免责声明</li>
                            <li id="tow4" onclick="setTab('tow', 4, 4)">兑奖须知</li>
                        </ul>
                    </div>
                    <div class="cont">
                        <!--奖品介绍-->
                        <div class="js" id="con_tow_1">
                            <?php echo $gift_info['introduce']; ?>
                        </div>
                        <!--兑奖流程-->
                        <div class="lc" id="con_tow_2" style="display:none">
                            <p class="p_1"><em>说明：节假日例外。例：周一提交申请，一般周二回审核完成；周五提交申请，要等到下周一审核完成。</em></p>
                            <p class="p_2" style="background:url(<?php echo IMG_URL ?>img/mall_lc_0.png) no-repeat center"></p>
                            <div class="fs">
                                <p class="fs_tit">奖品寄送方式</p>
                                <p class="text">Q币、手机话费直充奖品兑奖审核通过后直接充入您的QQ号码/手机号码中（QQ号码/手机号码兑奖审核通过后自主填写），其余虚拟奖
                                    品采用在线发送卡密的方式；实体奖品全部采用快递方式。</p>
                            </div>
                            <div class="fs">
                                <p class="fs_tit">奖品兑换流程</p>
                                <p class="text_2 clearfix">
                                    <i>1</i>
                                    <em>奖品价格已经包含邮寄费用在内，您无须另行支付。兑换前请确认您的帐户中有足够数量的U币！</em>
                                </p>
                                <p class="text_2 clearfix">
                                    <i>2</i>
                                    <em>在您要兑换的奖品页面点击“立即兑换”按钮，提交您的兑奖申请！</em>
                                </p>
                                <p class="text_2 clearfix">
                                    <i>3</i>
                                    <em>确认您的奖品邮寄地址、联系电话正确无误后提交兑奖申请！</em>
                                </p>
                                <p class="text_2 clearfix">
                                    <i>4</i>
                                    <em>实物奖品将在您的兑奖确认后的2-5工作日内发出（奖品状态您可通过“我的兑奖”查询）！
                                    </em>
                                </p>
                                <p class="text_2 clearfix">
                                    <i>5</i>
                                    <em>兑奖中心所有实物奖品颜色均为随机发送，敬请谅解！</em>
                                </p>
                                <p class="text_2 clearfix">
                                    <i>6</i>
                                    <em>奖品受供货商库存影响，会有缺货情况，如有缺货，客服会取消兑奖，退还兑奖U币。</em>
                                </p>
                                <p class="text_2 clearfix">
                                    <i>7</i>
                                    <em>在您要兑换的奖品页面点击“立即兑换”按钮，提交您的兑奖申请！</em>
                                </p>
                            </div>
                        </div>
                        <!--免责声明-->
                        <div class="mz" id="con_tow_3" style="display:none">
                            <p class="text">免责声明：因厂家会在没有任何提前通知的情况下更改产品包装、产地或者一些附件，本司不能确保会员收到的货物与奖品的图片、产地
                                、附件说明完全一致。只能确保为原厂正货！并且保证与当时市场上同样主流新品一致。若本网站没有及时更新，请大家谅解！图片仅供
                                参考，请以实物为准。<a href="javascript:" target="_blank">更多常见问题请点此查看<i>&nbsp;>></i></a></p>
                        </div>
                        <!--兑换须知-->
                        <div class="xz" id="con_tow_4"  style="display:none">
                            <p class="text_2 clearfix">
                                <i>1</i>
                                <em>奖品价格已经包含邮寄费用在内，您无须另行支付。兑奖前请确认您的帐户中有足够数量的金豆！</em>
                            </p>
                            <p class="text_2 clearfix">
                                <i>2</i>
                                <em>奖品寄送方式：QQ直充类奖品兑奖审核通过后会直接充入您的QQ号码中，其余虚拟奖品采用在线发送卡密的方式；实体奖品全部采
                                    用快递方式。</em>
                            </p>
                            <p class="text_2 clearfix">
                                <i>3</i>
                                <em>虚拟奖品有效期：虚拟卡密类奖品除手机充值卡10/20/30元卡密，因为充值卡金额少，有效期比较短，大约一周左右。其余卡密类
                                    奖品有效期为1个月；虚拟卡直冲类为即时发货即时到账，无有效期限制！
                                    柿子兑换含有有效期的奖品，请尽快充值使用，如过有效期未充值导致卡密失效，、网概不负责。</em>
                            </p>
                            <p class="text_2 clearfix">
                                <i>4</i>
                                <em>确认您的奖品邮寄地址、联系电话正确无误后提交兑奖申请！如因您未提供详细信息或信息错误，导致奖品错投或无法寄送，网站
                                    不负任何责任，并不再补发奖品。
                                </em>
                            </p>
                            <p class="text_2 clearfix">
                                <i>5</i>
                                <em>实物奖品将在兑奖提交后的2-5工作日内发出(奖品状态您可通过“<a href="javascript:" target="_blank">我的兑奖</a>”查询)！</em>
                            </p>
                            <p class="text_2 clearfix">
                                <i>6</i>
                                <em>实物奖品按照会员申请的要求发出去之后，无破损、短缺等质量问题或因个人喜好（色泽、外观）要求退换货将无法受理。</em>
                            </p>
                            <p class="text_2 clearfix">
                                <i>7</i>
                                <em>兑奖中心所有实物奖品颜色均为随机发送, 敬请谅解！</em>
                            </p>
                            <p class="zy">注意：</p>
                            <p class="text_3">1、签收奖品前，务必仔细检查货物是否完好！如果发现有破损、短缺情况，请直接让快递公司退回，无需承担任何费用，并及时与我们
                                联系。签收后提出货物破损等问题，一律责任自负！无法受理退换货要求！他人代签与本人签收一样。</p>
                            <p class="text_3">2、收到奖品7天内，若发现质量问题，请及时与我们联系并提供图片说明。如因个人使用不当导致的奖品问题无法更换。</p>
                            <p class="text_3">3、如提交兑奖后，由于商家缺货导致无法发货的情况，会员会收到站内信息通知并取消兑奖，请重新选择其他奖品兑换。</p>
                            <p class="text_4">兑奖过程中如有问题请通过“<a href="javascript:">客服中心</a>”联系咨询。</p>
                            <p class="text_5">以上奖品图片仅供参考,请您以收取的实物为准！如有异议请联系客服人员确认奖品情况。</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
    </body>
</html>
