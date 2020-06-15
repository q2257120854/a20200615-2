<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>物品详情-兑换商城-<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="网上兼职,网赚,体验营销,互动营销,免费礼品" />
        <meta name="description" content="、用户通过选择感兴趣的广告，按照规则完成广告体验、商家问答，赚取元宝，兑换手机充值卡、Q币、笔记本、手机、ipad以及其他实物奖品，同时也为商家提供真实有效的广告受众。" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/mall.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/public_js.js"></script>
        <script src="/scripts/mall.js"></script>
        <script src="http://malsup.github.io/jquery.form.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.list_lh li:even').addClass('lieven');
            })

            window.onload = function() {
                var msg = $('#msg').val();
                if (msg == "success") {
                    $("#msgsuc").show();

                } else if (msg == "error") {
                    $("#msgerr").show();
                }
            }

            $(function() {
                $("div.list_lh").myScroll({
                    speed: 40, //数值越大，速度越慢
                    rowHeight: 86 //li的高度
                });
            });


            //兑换成功提示框
            function close() {
                $("#msgsuc").hide();
                location.href = "<?php echo SITE_URL ?>vipexpiry/show";
            }

            //兑换失败提示框
            function close2() {
                $("#msgerr").hide();
            }

            function del(id) {
                if (confirm('确定要删除吗？')) {
                    $.ajax({
                        type: "POST",
                        data: {"id": id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken ?>'},
                        dataType: "json",
                        url: "<?php echo SITE_URL ?>giftdh/del/id",
                        success: function(data) {
                            alert(data['start']);
                            history.go(0);
                        }
                    });
                }
            }
        </script>
        <style type="text/css">
            div .errorMessage{color:red;}
            .hover1{ background: url(<?php echo IMG_URL; ?>img/nav_b.png) no-repeat center; font-weight: bold;}
            .hover1 a { color:#fff !important;}
        </style>
    </head>
    <body >
        <?php include_once("./protected/views/design/header.php"); ?>
        <?php
        if (Yii::app()->user->hasFlash('msg')) {
            ?>
            <input type="hidden" value="<?php echo Yii::app()->user->getFlash('msg') ?>" id="msg" />
        <?php } ?>
        <?php
        $address_model = Address::model();
        $giftdh_model = Giftdh::model();
        ?>
        <!--主体-->
        <div class="main clearfix">
            <?php include_once("left.php") ?>
            <div class="main_right clearfix">
                <!--奖品-->
                <div class="goods clearfix">
                    <span class="img"><img src="/uploads/img/gift/<?php echo $gift_info['img'] ?>" /></span>
                    <span class="name">
                        <p class="p_1"><?php echo $gift_info['name'] ?></p>
                        <p class="p_2">您兑换该奖品仅需：<em><?php echo $gift_info['hld_num'] ?></em></p>
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
                                    echo intval($hld);
                                    $num = 0;
                                    if ($gift_info['hld_num'] > $hld) {
                                        $num = $gift_info['hld_num'] - $hld;
                                    }
                                    ?></em><i>（
                                    <?php
                                    if ($num > 0) {
                                        echo "还需要" . $num . "金豆，";
                                    }
                                    ?>
                                    <a href="<?php echo SITE_URL ?>game/show">继续赚金豆</a>）</i></p>
                        <?php } ?>
                    </span>
                </div>
                <!--奖品介绍、兑奖流程、免责声明、兑奖须知-->
                <div class="introduction">
                    <div class="tit clearfix">
                        <ul class="ul_1 clearfix">
                            <li class="hover" id="tow1" onclick="setTab('tow', 1, 5)">收货信息</li>
                            <li id="tow2" onclick="setTab('tow', 2, 5)">奖品介绍</li>
                            <li id="tow3" onclick="setTab('tow', 3, 5)">兑奖流程</li>
                            <li id="tow4" onclick="setTab('tow', 4, 5)">免责声明</li>
                            <li id="tow5" onclick="setTab('tow', 5, 5)">兑奖须知</li>
                        </ul>
                    </div>
                    <div class="cont">
                        <!--收货信息-->
                        <div class="collect" id="con_tow_1">
                            <?php if (!empty($mem['id'])) { ?>
                                <?php
                                $addressnum = Address::model()->countBySql("select count(*) from {{address}} where  mem_id =" . $mem['id']); //会员地址数量
                                ?>
                                <div class="tit">填写并核对订单信息</div>
                                <p class="p_1">
                                    <span>收货人信息</span>
                                    <a href="<?php echo SITE_URL ?>address/show"/>管理地址</a>
                                </p>
                                <?php
                                $form = $this->beginWidget('CActiveForm', array('id' => 'address'))
                                ?>
                                <div class="list">
                                    <ul>
                                        <?php
                                        $i = 1;
                                        $address = Address::model()->findAllBySql("select * from {{address}} where valid=0 and mem_id=" . $mem['id'] . " order by id desc");
                                        foreach ($address as $info) {
                                            ?>
                                            <li <?php
                                            if ($i == 1) {
                                                echo "class='xuan'";
                                            }
                                            ?>>
                                                <label class="xuan_1 edit">
                                                    <input name="addressid" type="radio" value="<?php echo $info['id']; ?>" <?php
                                                    if ($i == 1) {
                                                        ++$i;
                                                        echo "checked='checked'";
                                                    }
                                                    ?>  />
                                                    <b><?php echo $info['name']; ?></b>&nbsp;&nbsp;&nbsp; <?php echo $address_model->getCityName($info['province']) . $address_model->getCityName($info['city']) . $address_model->getCityName($info['district']) . $info['address']; ?> &nbsp;&nbsp;&nbsp;<?php echo $info['phone']; ?>
                                                </label>
                                                <span class="xs">
                                                    <a  onclick="del(<?php echo $info['id']; ?>)" href="javascript:" ><i class="sc">删除</i></a>
                                                </span>
                                            </li>
                                        <?php } ?>
                                        <?php if ($addressnum < 5) { ?>
                                            <li>
                                                <label class="xuan_1 new">
                                                    <input name="addressid" type="radio" id="radionew" value="0"  <?php
                                                    if (empty($address) || $addressid == 0) {
                                                        echo "checked='checked'";
                                                    }
                                                    ?> />
                                                    使用新地址
                                                </label>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <?php if ($addressnum < 5) { ?>
                                    <div class="fill" id="addressinfo" <?php
                                    if (empty($address) || $addressid == 0) {
                                        echo "style='display:block'";
                                    }
                                    ?>>
                                        <input type="hidden" value="<?php echo $mem['id']; ?>" id="Address_mem_id" name="Address[mem_id]"/>
                                        <ul>
                                            <li> 
                                                <span class="text"><i class="bi">*&nbsp;</i>收货人：</span>
                                                <?php echo $form->textField($address_model, 'name', array('class' => 'sframe sframe_1')); ?>
                                            </li>
                                            <li class="zs"><?php echo "<span style='color:red;dislpay:block;padding-left:125px;'>" . $name . "</span>"; ?></li>
                                            <li>
                                                <span class="text"><i class="bi">*&nbsp;</i>所在地：</span>
                                                <?php
                                                echo $form->dropDownList($address_model, 'province', $address_model->provinceList, array(
                                                    'empty' => '-请选择省-',
                                                    'class' => 'choice choice_1',
                                                    'ajax' => array(
                                                        'url' => SITE_URL . "address/dynamicCity",
                                                        'update' => '#Address_city',
                                                        'data' => array('pid' => 'js:this.value', 'typeid' => 1, Yii::app()->request->csrfTokenName => Yii::app()->request->getCsrfToken()),
                                                    ),
                                                ));
                                                ?>
                                                <?php
                                                echo $form->dropDownList($address_model, 'city', $address_model->getCityList($address_model->province, 1), array(
                                                    'empty' => '-请选择市-',
                                                    'class' => 'choice choice_1',
                                                    'ajax' => array(
                                                        'url' => SITE_URL . "address/dynamicCity",
                                                        'update' => '#Address_district',
                                                        'data' => array('pid' => 'js:this.value', 'typeid' => 2, Yii::app()->request->csrfTokenName => Yii::app()->request->getCsrfToken()),
                                                    ),
                                                ));
                                                ?>
                                                <?php echo $form->dropDownList($address_model, 'district', $address_model->getCityList($address_model->city, 2), array('empty' => '-请选择区-', 'class' => 'choice choice_1')); ?>
                                                <br/>
                                            </li>
                                            <li class="zs"><?php echo "<span style='color:red;dislpay:block;padding-left:125px;'>" . $province . "</span>"; ?></li>
                                            <li>
                                                <span class="text"><i class="bi">*&nbsp;</i>详细地址：</span>
                                                <?php echo $form->textField($address_model, 'address', array('class' => 'sframe sframe_2')); ?>
                                            </li>
                                            <li class="zs"></i>
                                                <li>
                                                    <span class="text"><i class="bi">*&nbsp;</i>手机号码：</span>
                                                    <?php echo $form->textField($address_model, 'phone', array('class' => 'sframe sframe_3')); ?>
                                                    <span class="huo">或</span>
                                                    <span class="text">固定号码：</span>
                                                    <?php echo $form->textField($address_model, 'tel', array('class' => 'sframe sframe_3')); ?>
                                                    <br/>
                                                </li>
                                                <li class="zs"><?php echo "<span style='color:red;dislpay:block;padding-left:125px;'>" . $phone . "</span>"; ?></li>
                                                <li>
                                                    <span class="text"><i class="bi">*&nbsp;</i>联系QQ：</span>
                                                    <?php echo $form->textField($address_model, 'memqq', array('class' => 'sframe sframe_3')); ?>
                                                </li>
                                                <li class="zs"><?php echo "<span style='color:red;dislpay:block;padding-left:125px;'>" . $memqq . "</span>"; ?></li>
                                                <li>
                                                    <span class="text">备注：</span>
                                                    <?php echo $form->textField($address_model, 'remark', array('class' => 'sframe sframe_3')); ?>
                                                    <span class="shez">设置一个易记的名称，如：“送到家里”、“送到公司”</span>
                                                </li>
                                        </ul>
                                    </div> 
                                <?php } ?>
                                <a class="ann"  onclick="return confirm('确定要兑奖吗？')"    href="javascript:document.getElementById('address').submit();" >确认兑奖</a>
                                <?php
                                $this->endWidget();
                            }
                            ?>
                        </div>
                        <!--奖品介绍-->
                        <div class="js" id="con_tow_2" style="display:none">
                            <?php echo $gift_info['introduce']; ?>
                        </div>
                        <!--兑奖流程-->
                        <div class="lc" id="con_tow_3" style="display:none">
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
                        <div class="mz" id="con_tow_4" style="display:none">
                            <p class="text">免责声明：因厂家会在没有任何提前通知的情况下更改产品包装、产地或者一些附件，本司不能确保会员收到的货物与奖品的图片、产地
                                、附件说明完全一致。只能确保为原厂正货！并且保证与当时市场上同样主流新品一致。若本网站没有及时更新，请大家谅解！图片仅供
                                参考，请以实物为准。<a href="javascript:" target="_blank">更多常见问题请点此查看<i>&nbsp;>></i></a></p>

                        </div>
                        <!--兑换须知-->
                        <div class="xz" id="con_tow_5"  style="display:none">
                            <p class="text_2 clearfix">
                                <i>1</i>
                                <em>奖品价格已经包含邮寄费用在内，您无须另行支付。兑奖前请确认您的帐户中有足够数量的元宝！豆库元宝不能用于兑换，请
                                    先将元宝从豆库取出。</em>
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
                                    蹦友兑换含有有效期的奖品，请尽快充值使用，如过有效期未充值导致卡密失效，、概不负责。</em>
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
        <div class="eject_db6" style=" display: none;" id="msgsuc">
            <!--兑换物品成功弹出框背景-->
            <div class="eject_bk5" style="display:block"></div>
            <!--兑换物品成功弹出框-->
            <div class="eject5" style="display:block">
                <div class="eject1_tit">兑换成功！</div>
                <div class="eject1_text clearfix">
                    <span class="bt">您当前兑换物品：</span>
                    <span class="sl"><?php echo $gift_info["name"]; ?></span>
                </div>
                <div class="eject1_text clearfix">
                    <span class="bt">您本次兑换花费：</span>
                    <span class="sl"><?php echo number_format($gift_info["hld_num"]); ?></span>
                    <span class="zs">金豆</span>
                </div>
                <div class="eject1_button clearfix">
                    <a href="javascript:close()" class="eject1_ann">确定</a>
                </div>
            </div>
        </div>
        <!--亲，您的元宝不足！弹出框-->
        <div class="eject_db7" id="msgerr" style=" display: none;" >
            <div class="eject_bk6">
            </div>
            <div class="eject6 clearfix">
                <div class="tx_1">
                </div>
                <div class="cont">
                    <p class="p_1">亲，您的金豆不足！</p>
                    <p class="p_2">

                    </p>
                    <p class="p_3">
                        <a href="<?php echo SITE_URL . "gift/show" ?>" class="an">立即返回</a>
                    </p>
                    <div></div>
                </div>
            </div>
        </div>
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
        <!--兑换物品成功弹出框-->
    </body>
</html>
