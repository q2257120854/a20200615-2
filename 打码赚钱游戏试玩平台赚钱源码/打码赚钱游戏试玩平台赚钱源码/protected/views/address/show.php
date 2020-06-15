<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>兑奖管理—收货信息—<?php echo TIT; ?>、官方网站</title>
        <meta name="keywords" content="手机充值卡,Q币,手机,笔记本,相机,数码产品,生活用品,免费奖品" />
        <meta name="description" content="<?php echo TIT; ?>兑奖商场是柿子赚到元宝后兑换奖品的地方，柿子通过玩网页试玩、棋牌试玩体验广告、网购等赚取元宝，通过积累一定的元宝，可以兑换虚拟奖品，如Q币，手机充值卡等，也可以兑换实物大奖，如数码产品、手机、笔记本以及生活用品、吃喝玩乐用品等等。" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/vip/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/vip/inside.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/vip/jQuery.v1.8.3.js"></script>
        <script src="/scripts/vip/public.js"></script>
        <style type="text/css">
            .hover6{border-top:4px solid #70a0f1; height:36px; line-height:36px; background:#4b6289;}
            .hover6 a { color:#fff !important;}
            .hover21{background: url("<?php echo IMG_URL ?>vip/img/public_db _menu_left _j.png") no-repeat scroll right center #fff; color: #cc3d12;width: 171px;}
            div .errorMessage{color:red;}
        </style>
        <script type="text/javascript">
            function del(id) {
                if (confirm('确定要删除吗？')) {
                    $.ajax({
                        type: "POST",
                        data: {"id": id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken ?>'},
                        dataType: "json",
                        url: "<?php echo SITE_URL ?>address/del/id",
                        success: function(data) {
                            alert(data['start']);
                            history.go(0);
                        }
                    });
                }
            }

            $(document).ready(function() {
                var result = '<?php echo $result; ?>';
                if (result == "error") {
                    $(".write_address_bk").show();
                    $(".write_address").show();
                } else if (result == "success") {
                    alert("新增成功");
                    location.href = "<?php echo SITE_URL ?>address/show";
                }
            });
        </script>
    </head>
    <body>
        <!--头部-->
        <?php include_once("./protected/views/vipdesign/header.php") ?>
        <!--主体-->
        <div class="main clearfix">
            <!--导航-->
            <?php include_once("./protected/views/vipdesign/navicat.php") ?>
            <div class="public_db clearfix">
                <!--左菜单-->
                <?php include_once("./protected/views/vipexpiry/left.php") ?>
                <?php
                $num2 = Address::model()->countBySql("select count(*) from {{address}} where  mem_id =" . $mem['id']);
                ?>
                <!--右内容-->
                <div class="cont prizes">
                    <div class="tit">
                        <p class="p_1">
                            <span>您当前拥有金豆：</span>
                            <em>
                                <?php
                                echo number_format(intval($hldnum));
                                ?>
                            </em>
                            <span>可兑换礼品：</span>
                            <i>
                                <?php
                                $num = Gift::model()->countBySql("select count(*) from {{gift}} where  hld_num<=" . intval($hldnum));
                                echo number_format(intval($num));
                                ?>个</i>
                            <?php if (!empty($num)) { ?>
                                <a href="<?php echo SITE_URL; ?>gift/bylist/hld/<?php echo number_format(intval($hldnum)); ?>">前去兑换 <span>>></span></a>
                            <?php } ?>
                        </p>
                        <p class="p_2">提示：为避免无法准确的收到奖品，请认真填写相关信息，以免造成不必要的损失！</p>
                        <p class="p_3 clearfix">
                            <?php if ($num2 < 5) {
                                ?>
                                <a class="button_3 ann_1" href="javascript:" >新增收货地址</a>
                            <?php } ?>
                            <span>您已创建<i>
                                    <?php echo $num2; ?></i>个收货地址!
                                <?php if ((5 - $num2) != 0) { ?>
                                    您还可以创建<i>
                                        <?php echo 5 - $num2; ?></i>个
                                <?php } ?>
                            </span>
                        </p>
                    </div>
                    <?php foreach ($address_info as $info) { ?>
                        <div class="d_1">
                            <p class="p_1 clearfix">
                                <span class="span_1">收货地址</span>
                                <span class="span_2">
                                    <a href="<?php echo SITE_URL ?>address/edit/id/<?php echo $info['id']; ?>"><i class="ico_1" title="编辑"></i></a>
                                    <a  onclick="del(<?php echo $info['id']; ?>)" href="javascript:" ><i class="ico_2" title="删除"></i></a>
                                </span>
                            </p>
                            <p class="p_2 clearfix">
                                <span>收货人：</span><em><?php echo $info['name'] ?></em>
                            </p>
                            <p class="p_2 clearfix">
                                <span>所在地区：</span><em><?php
                                    $address_model = Address::model();
                                    echo $address_model->getCityName($info['province']) . $address_model->getCityName($info['city']) . $address_model->getCityName($info['district'])
                                    ?></em>
                            </p>
                            <p class="p_2 clearfix">
                                <span>地址：</span><em><?php echo $info['address'] ?></em>
                            </p>
                            <p class="p_2 clearfix">
                                <span>手机：</span><em><?php echo $info['phone'] ?></em>
                            </p>
                            <p class="p_2 clearfix">
                                <span>固定电话：</span><em><?php echo $info['tel'] ?></em>
                            </p>
                            <p class="p_2 clearfix">
                                <span>QQ：</span><em><?php echo $info['memqq'] ?></em>
                            </p>
                            <?php if (!empty($num)) { ?>
                                <p class="p_3 clearfix">
                                    <a href="<?php echo SITE_URL ?>gift/show">我要去兑奖 <i>>></i></a>
                                </p>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php
            if (!empty($ad_info)) {
                foreach ($ad_info as $ad) {
                    echo $i++;
                    ?>
                    <!--广告图-->
                    <a class="advertising_1" href="<?php echo $ad['url']; ?>">
                        <img src="/uploads/img/ad/<?php echo $ad['img']; ?>">
                    </a>
                    <?php
                }
            }
            ?>
        </div>
        <!--添加收货地址弹出框-->
        <div class="write_address_bk"></div>
        <div class="write_address">
            <div class="tit clearfix">
                <span>添加收货地址</span>
                <a href="javascript:"></a>
            </div>
            <?php
            $form = $this->beginWidget('CActiveForm', array('id' => 'dhform'))
            ?>
            <div class="cont">
                <input type="hidden" value="<?php echo $mem['id']; ?>" id="Address_mem_id" name="Address[mem_id]"/>
                <ul class="ul_1">
                    <li>
                        <span><i>*</i>收货人：</span>
                        <p class="clearfix">
                            <?php echo $form->textField($address_model, 'name', array('class' => 'sframe sframe_1')); ?>
                            <?php echo $form->error($address_model, 'name'); ?>

                        </p>
                    </li>
                    <li>
                        <span><i>*</i>所在地区：</span>
                        <p class="clearfix">
                            <?php
                            echo $form->dropDownList($address_model, 'province', $address_model->provinceList, array(
                                'empty' => '-请选择省-',
                                'class' => 'sframe xuanz_1',
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
                                'class' => 'sframe xuanz_1',
                                'style' => 'margin-left:10px;',
                                'ajax' => array(
                                    'url' => SITE_URL . "address/dynamicCity",
                                    'update' => '#Address_district',
                                    'data' => array('pid' => 'js:this.value', 'typeid' => 2, Yii::app()->request->csrfTokenName => Yii::app()->request->getCsrfToken()),
                                ),
                            ));
                            ?>
                            <?php echo $form->dropDownList($address_model, 'district', $address_model->getCityList($address_model->city, 2), array('empty' => '-请选择区-', 'class' => 'sframe xuanz_1', 'style' => 'margin-left:10px;')); ?>
                            <br/>
                            <?php echo $form->error($address_model, 'province'); ?>

                        </p>
                    </li>
                    <li>
                        <span><i>*</i>详细地址：</span>
                        <p class="clearfix">
                            <?php echo $form->textField($address_model, 'address', array('class' => 'sframe sframe_2')); ?>
                            <?php echo $form->error($address_model, 'address'); ?>
                        </p>
                    </li>
                    <li class="clearfix">
                        <div class="lf">
                            <span><i>*</i>手机号码：</span>
                            <p class="clearfix">
                                <?php echo $form->textField($address_model, 'phone', array('class' => 'sframe sframe_3')); ?>
                                <em class="h">或</em></p>
                            <?php echo $form->error($address_model, 'phone'); ?>

                        </div>
                        <div class="ri">
                            <span>固定电话：</span>
                            <p class="clearfix">
                                <?php echo $form->textField($address_model, 'tel', array('class' => 'sframe sframe_3')); ?>
                                <?php echo $form->error($address_model, 'tel'); ?>
                            </p>
                        </div>
                    </li>
                    <li>
                        <span><i>*</i>联系QQ：</span>
                        <p class="clearfix">
                            <?php echo $form->textField($address_model, 'memqq', array('class' => 'sframe sframe_3')); ?>
                            <?php echo $form->error($address_model, 'memqq'); ?>
                        </p>
                    </li>
                    <li>
                        <span>备注：</span>
                        <p class="clearfix">
                            <?php echo $form->textField($address_model, 'remark', array('class' => 'sframe sframe_3')); ?>
                            <?php echo $form->error($address_model, 'remark'); ?>
                            <em class="z">设置一个易记的名称，如：“送到家里”、“送到公司”</em></p>
                    </li>
                </ul>
            </div>
            <div class="ok_button"><a class="button_2"  href="javascript:document.getElementById('dhform').submit();" >确认</a></div
            ><?php $this->endWidget(); ?>
        </div>
        <!--底部1-->
        <?php include_once("./protected/views/vipdesign/footer.php"); ?>
        <?php include_once("./protected/views/vipdesign/kefu.php") ?>
    </body>
</html>
