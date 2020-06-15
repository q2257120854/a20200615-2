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
            .hover4{ background: url(<?php echo IMG_URL; ?>img/nav_b.png) no-repeat center; font-weight: bold;color:#fff;}
            .hover4 a{ color:#fff !important;}
        </style>
    </head>

    <body >
        <?php include_once("./protected/views/design/header.php") ?>
        <!--主体-->
        <div class="main clearfix">
            <div class="main_left clearfix">
                <!--奖品分类-->
                <div class="prize_class">
                    <div class="tit"><span>奖品分类</span></div>
                    <div class="cont">
                        <ul class="ul_1">
                            <li>
                                <p class="p_1 virtual">虚拟奖品</p>
                                <p class="p_2">
                                    <a href="javascript:">手机充值</a>
                                    <a href="javascript:">QQ业务</a>
                                    <a href="javascript:">QQ充值</a>
                                    <a href="javascript:">游戏充值</a>
                                    <a href="javascript:">手机充值</a>
                                </p>
                            </li>
                            <li>
                                <p class="p_1 digital">数码产品</p>
                                <p class="p_2">
                                    <a href="javascript:">手机充值</a>
                                    <a href="javascript:">QQ业务</a>
                                    <a href="javascript:">QQ充值</a>
                                    <a href="javascript:">游戏充值</a>
                                    <a href="javascript:">手机充值</a>
                                </p>
                            </li>
                            <li>
                                <p class="p_1 literary">文体用品</p>
                                <p class="p_2">
                                    <a href="javascript:">手机充值</a>
                                    <a href="javascript:">QQ业务</a>
                                    <a href="javascript:">QQ充值</a>
                                    <a href="javascript:">游戏充值</a>
                                    <a href="javascript:">手机充值</a>
                                </p>
                            </li>
                            <li>
                                <p class="p_1 home">居家生活</p>
                                <p class="p_2">
                                    <a href="javascript:">手机充值</a>
                                    <a href="javascript:">QQ业务</a>
                                    <a href="javascript:">QQ充值</a>
                                    <a href="javascript:">游戏充值</a>
                                    <a href="javascript:">手机充值</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--最新兑换-->
                <div class="play">
                    <div class="public_tit clearfix">
                        <i class="ico new_ico"></i>
                        <span class="sp_1">最新兑换</span>
                    </div>
                    <div class="cont">
                        <div class="list_lh">
                            <ul>
                                <li class="clearfix">
                                    <span class="tou"><img src="<?php echo IMG_URL; ?>dynamic/tou_1.jpg" /></span>
                                    <span class="neir">
                                        <p class="name">炎小小</p>
                                        <p class="wan">兑换了:
                                            <a href="javascript:" target="_blank">50元话费充值卡</a>
                                        </p>
                                        <p class="lin clearfix"><span>60秒之前</span></p>
                                    </span>
                                </li>
                                <li class="clearfix">
                                    <span class="tou"><img src="<?php echo IMG_URL; ?>dynamic/tou_2.jpg" /></span>
                                    <span class="neir">
                                        <p class="name">炎小小</p>
                                        <p class="wan">兑换了:
                                            <a href="javascript:" target="_blank">50元话费充值卡</a>
                                        </p>
                                        <p class="lin clearfix"><span>60秒之前</span></p>
                                    </span>
                                </li>
                                <li class="clearfix">
                                    <span class="tou"><img src="<?php echo IMG_URL; ?>dynamic/tou_3.jpg" /></span>
                                    <span class="neir">
                                        <p class="name">炎小小</p>
                                        <p class="wan">兑换了:
                                            <a href="javascript:" target="_blank">50元话费</a>
                                        </p>
                                        <p class="lin clearfix"><span>60秒之前</span></p>
                                    </span>
                                </li>
                                <li class="clearfix">
                                    <span class="tou"><img src="<?php echo IMG_URL; ?>dynamic/tou_1.jpg" /></span>
                                    <span class="neir">
                                        <p class="name">炎小小</p>
                                        <p class="wan">兑换了:
                                            <a href="javascript:" target="_blank">50元话费充值卡</a>
                                        </p>
                                        <p class="lin clearfix"><span>60秒之前</span></p>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--体验问题-->
                <div class="customer">
                    <div class="public_tit clearfix">
                        <i class="ico customer_ico"></i>
                        <span class="sp_1">体验问题</span>
                        <a class="public_more" href="<?php echo SITE_URL ?>help/show/id/7" target="_blank">MORE<em>&nbsp;>></em></a>
                    </div>
                    <div class="cont">
                        <ul class="ul_1">
                            <li><a href="javascript:" target="_blank">如何试玩页游？</a></li>
                            <li><a href="javascript:" target="_blank">我参加同一款页游第一期报名，第寂寞啊啊啊啊啊啊</a></li>
                            <li><a href="javascript:" target="_blank">试玩奖励什么时候发</a>放？</li>
                            <li><a href="javascript:" target="_blank">为什么我试玩了没有得到奖励？</a></li>
                            <li><a href="javascript:" target="_blank">我已经成功注册了，为什么页面上显示失...</a></li>
                            <li><a href="javascript:" target="_blank">体验广告多久能得到审核？</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="main_right clearfix">
                <!--奖品-->
                <div class="goods clearfix">
                    <span class="img"><img src="<?php echo IMG_URL; ?>dynamic/details_1.png" /></span>
                    <span class="name">
                        <p class="p_1">iPhone 4S 8G版</p>
                        <p class="p_2">您兑换该奖品仅需：<em>28,500,000</em></p>
                        <p class="p_2">您当前金豆：<em>28,500,000</em><i>（还需要88,467金豆，<a href="javascript:">继续赚金豆</a>）</i></p>
                        <p class="p_2" style="display:none">您还未登录，请先<a href="javascript:">立即登录</a> ,还未注册? <a href="javascript:">免费注册</a></p>
                        <a class="ann_1" href="javascript:">立即兑换</a>
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
                            <div class="tit">填写并核对订单信息</div>
                            <p class="p_1">
                                <span>收货人信息</span>
                                <a>[编辑]</a>
                            </p>
                            <p class="p_2">
                                徐道道&nbsp;&nbsp;&nbsp;139023345735
                                <br />
                                北京市五环45区15巷2号9520号
                            </p>
                            <div class="list">
                                <ul>
                                    <li class="xuan">
                                        <label class="xuan_1">
                                            <input name="123" type="radio" value="" checked="checked" />
                                            <b>徐道道</b>&nbsp;&nbsp;&nbsp;京海淀区三环到四环之间&nbsp;&nbsp;&nbsp;13954887594
                                        </label>
                                        <span class="xs"><i class="bj">编辑</i><i class="sc">删除</i></span>
                                    </li>
                                    <li>
                                        <label class="xuan_1">
                                            <input name="123" type="radio" value="" />
                                            <b>徐道道</b>&nbsp;&nbsp;&nbsp;京海淀区三环到四环之间&nbsp;&nbsp;&nbsp;13954887594
                                        </label>
                                        <span class="xs"><i class="bj">编辑</i><i class="sc">删除</i></span>
                                    </li>
                                    <li>
                                        <label class="xuan_1">
                                            <input name="123" type="radio" value="" />
                                            <b>徐道道</b>&nbsp;&nbsp;&nbsp;京海淀区三环到四环之间&nbsp;&nbsp;&nbsp;13954887594
                                        </label>
                                        <span class="xs"><i class="bj">编辑</i><i class="sc">删除</i></span>
                                    </li>
                                    <li>
                                        <label class="xuan_1 new">
                                            <input name="123" type="radio" value="" />
                                            使用新地址
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="fill">
                                <ul>
                                    <li>
                                        <span class="text"><i class="bi">*&nbsp;</i>收货人：</span>
                                        <input class="sframe sframe_1" type="text" />
                                    </li>
                                    <li>
                                        <span class="text"><i class="bi">*&nbsp;</i>所在地：</span>
                                        <select class="choice choice_1" name="">
                                            <option>湖南</option>
                                            <option>湖北</option>
                                            <option>四川</option>
                                            <option>新疆</option>
                                            <option>新疆</option>
                                        </select>
                                        <select class="choice choice_1" name="">
                                            <option>湖南</option>
                                            <option>湖北</option>
                                            <option>四川</option>
                                            <option>新疆</option>
                                            <option>新疆</option>
                                        </select>
                                        <select class="choice choice_1" name="">
                                            <option>湖南</option>
                                            <option>湖北</option>
                                            <option>四川</option>
                                            <option>新疆</option>
                                            <option>新疆</option>
                                        </select>
                                    </li>
                                    <li>
                                        <span class="text"><i class="bi">*&nbsp;</i>详细地址：</span>
                                        <input class="sframe sframe_2" type="text" />
                                    </li>
                                    <li>
                                        <span class="text"><i class="bi">*&nbsp;</i>手机号码：</span>
                                        <input class="sframe sframe_3" type="text" />
                                        <span class="huo">或</span>
                                        <span class="text">固定号码：</span>
                                        <input class="sframe sframe_3" type="text" />

                                    </li>
                                    <li>
                                        <span class="text"><i class="bi">*&nbsp;</i>联系QQ：</span>
                                        <input class="sframe sframe_3" type="text" />
                                    </li>
                                    <li>
                                        <span class="text"><i class="bi">*&nbsp;</i>地域别名：</span>
                                        <input class="sframe sframe_3" type="text" />
                                        <span class="shez">设置一个易记的名称，如：“送到家里”、“送到公司”</span>
                                    </li>
                                </ul>
                            </div>
                            <a class="button_2" href="javascript:">确认兑奖</a>
                        </div>
                        <!--奖品介绍-->
                        <div class="js" id="con_tow_2" style="display:none">
                            <p>详细规格：</p>
                            <p>主体</p>
                            <p>品牌：苹果（Apple）</p>
                            <p>型号：iPhone 4S</p>
                            <p>颜色：黑色</p>
                            <p>上市时间：2012年</p>
                            <p>外观设计：直板</p>
                            <p>3G视频通话  ：  不支持</p>
                            <p>操作系统 ：   iOS7</p>
                            <p>智能机：    是</p>
                            <p>CPU型号 ：   苹果 A5</p>
                            <p>CPU核数 ：   双核</p>
                            <p>CPU频率  ：  800MHz</p>
                            <p>键盘类型：    虚拟QWERTY键盘</p>
                            <p>输入方式：    触控</p>
                            <p>运营商标志或内容：    无</p>
                            <p>网络</p>
                            <p>网络制式：    联通3G（WCDMA）-移动2G/联通2G（GSM）</p>
                            <p>网络频率：    UMTS/HSDPA/HSUPA (850, 900, 1900, 2100 MHz) GSM/EDGE (850, 900, 1800, 1900 MHz)</p>
                            <p>数据业务：    802.11b/g/n WLAN 网络(仅适用于 802.11n 2.4GHz)</p>
                            <p>Bluetooth 4.0 无线技术</p>
                            <p>浏览器：    safari</p>
                            <p>存储</p>
                            <p>机身内：存    8GB ROM</p>
                        </div>
                        <!--兑奖流程-->
                        <div class="lc" id="con_tow_3" style="display:none">
                            <p class="p_1"><em>说明：节假日例外。例：周一提交申请，一般周二回审核完成；周五提交申请，要等到下周一审核完成。</em></p>
                            <p class="p_2" style="background:url(<?php echo IMG_URL; ?>img/mall_lc_0.png) no-repeat center"></p>
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
                                    蹦友兑换含有有效期的奖品，请尽快充值使用，如过有效期未充值导致卡密失效，蹦蹦网概不负责。</em>
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
