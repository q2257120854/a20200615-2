<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>《<?php echo $expad_info['name']; ?>》-广告体验-<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="网上兼职,网赚,体验营销,互动营销,免费礼品" />
        <meta name="description" content="、选择感兴趣的广告，按照规则完成广告体验、商家问答，赚取元宝，兑换手机充值卡、Q币、笔记本、手机、ipad以及其他实物奖品，同时也为商家提供真实有效的广告受众。" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/advert.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/public_js.js"></script>
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
            /** 刷新数据 **/
            function grade(expuid, expid) {
                $("#ref").show();
                $.ajax({
                    type: "POST",
                    data: {"expuid": expuid, "expid": expid, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken ?>'},
                    url: "<?php echo SITE_URL ?>expad/selgrade",
                    success: function(json) {
                        if (json != "") {
                            alert(json);
                        }
                        $("#ref").hide();
                        location.reload();
                    }
                });
            }
        </script>
        <style type="text/css">
            .hover6{ background: url(<?php echo IMG_URL; ?>img/nav_b.png) no-repeat center; font-weight: bold;color:#fff;}
            .hover6 a { color:#fff !important;}
        </style>
    </head>
    <body>
        <?php include_once("./protected/views/design/header.php"); ?>
        <!--主体-->
        <div class="main clearfix">
            <div class="main_left clearfix">
                <!--广告体验详情...-->
                <div class="adv_details clearfix">
                    <!--广告标题图-->
                    <div class="adv_img">
                        <img src="/uploads/img/expad/<?php echo $expad_info["image"]; ?>" />
                    </div>
                    <!--体验规则-->
                    <div class="gz">
                        <div class="tit">体验规则</div>
                        <div class="cont">
                            <p>体验奖励：<em><?php echo number_format($expad_info['rewards_hlb']); ?></em></p>
                            <p>体验时间：<span><?php echo $expad_info['begin_time']; ?>至<?php echo $expad_info['end_time']; ?></span></p>
                            <p>审核周期：<span><?php echo $expad_info['updtime']; ?></span></p>
                            <p>体验要求：<span><?php echo $expad_info['ask']; ?></span></p>
                            <p>领取方式：<span><?php echo $expad_info['describe']; ?></span></p>
                            <p>体验教程：<a target="_blank" href="<?php
                                $course = $expad_info['course'];
                                if (empty($course)) {
                                    echo "#";
                                } else {
                                    echo $course;
                                }
                                ?>">点此查看 <i>>></i></a></p>
                            <p class="zy">注意:为防止丢单,体验广告前请先清除cookies,体验过程中不要更换浏览器与IP地址,且不要使用IE，
                                火狐之外的浏览器体验，因此导致的丢单不补。
                            </p>
                        </div>
                    </div>
                    <?php
                    $expadgrade_model = Expadgrade::model();
                    $expadgradedata_model = Expadgradedata::model();
                    $expadzm_model = Expadzm::model();
                    $expadgrade_num = $expadgrade_model->countBySql("select count(*) from {{exp_ad_grade}} where exp_ad_id=" . $expad_info['id']);
                 //   $expadgradedata_num = $expadgradedata_model->countBySql("select count(*) from {{exp_ad_gradedata}} where mem_id = " . $mem['id'] . " and exp_ad_id=" . $expad_info['id']);
                    ?>
                    <!--体验信息-->
                    <div class="xx">
                        <div class="tit">体验信息</div>
                        <div class="cont">
                            <?php
                            if (Yii::app()->user->getIsGuest()) {
                                ?>
                                <!--未登陆显示、登陆不显示-->
                                <p class="wd">对不起，你尚未登陆，如果你已注册、，请点此<a class="a_dl" href="javascript:" id="dlck">立即登陆</a>。  还没有帐号？<a class="a_zc" href="<?php echo SITE_URL ?>index/regester">免费注册</a></p>
                            <?php } else { ?>
                                <p class="button_1 clearfix">
                                    <?php
                                    if (strtotime($expad_info["zc_end_time"]) > time()) {
                                        $num1 = $expadzm_model->countBySql("select count(*) from {{exp_ad_zm}} where mem_id = " . $mem['id'] . " and exp_ad_id=" . $expad_info['id']);
                                        $expadzm = Expadzm::model()->findBySql("select * from {{exp_ad_zm}} where exp_ad_id=" . $expad_info['id'] . " and mem_id=" . $mem['id']);
                                        if (strtotime($expad_info["end_time"]) > time()) {
                                            if ($expadgrade_num == $expadgradedata_num && !empty($expadgrade_num)) {
                                                ?>
                                                <a class="ann_2" href="javascript:">体验成功</a>
                                                <?php
                                            } else {
                                                if (empty($num1)) {
                                                    ?>
                                                    <a class="ann" target="_blank" href="<?php echo SITE_URL . "game/jump/type/5/id/" . $expad_info["id"]; ?> ">立即注册</a>
                                                <?php } else { ?>
                                                    <?php if (!empty($expadgrade_num) && $expadgrade_num != 1) { ?>
                                                        <a class="ann_1" href="<?php echo $expad_info['login_url']; ?>" target="_blank">继续体验</a>
                                                    <?php } ?>
                                                    <a class="ann"  href="javascript:grade(<?php echo $expadzm['userid']; ?>,<?php echo $expad_info['id']; ?>)" >刷新体验信息</a>
                                                    <img src="<?php echo IMG_URL ?>img/loading.gif" id="ref"  style="display:none"/>
                                                    <?php
                                                }
                                            }
                                        } else {
                                            ?>
                                            <a class="ann_2" href="javascript:">体验结束</a>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <a class="ann_2" href="javascript:">招募已满</a>
                                    <?php } ?>
                                </p>
                                <p class="ps">(PS：<?php echo "ID<span style='color:green'>" . $expadzm['userid'] . "</span>"; ?>&nbsp;&nbsp;&nbsp;&nbsp;绑定信息只用做核实信息，请牢记自己的注册账号哦！)</p>
                            <?php } ?>
                            <div class="table_1">
                                <table border="1">
                                    <tr>
                                        <?php if ($expadgrade_num == 1) { ?>
                                            <th>步骤</th>
                                            <th><?php echo $expad_info['content']; ?></th>
                                            <th>奖励元宝</th>
                                            <th>领奖</th>
                                        <?php } else { ?>
                                            <th>步骤</th>
                                            <th><?php echo $expad_info['content']; ?></th>
                                            <th>奖励元宝</th>
                                            <th>领奖</th>

                                            <th>步骤</th>
                                            <th><?php echo $expad_info['content']; ?></th>
                                            <th>奖励元宝</th>
                                            <th>领奖</th>
                                        <?php } ?>
                                    </tr>
                                    <?php
                                    $expadgradeinfo = $expadgrade_model->findAllBySql("select * from {{exp_ad_grade}} where exp_ad_id=" . $expad_info["id"] . " order by grade");
                                    foreach ($expadgradeinfo as $index => $info) {
                                        if ($index % 2 == 0) {
                                            ?>
                                            <tr>
                                                <th><?php echo $index + 1; ?></th>
                                                <td align="center"><?php echo $info['content']; ?></td>
                                                <td align="center"><em><?php echo $info['hlb']; ?></em></td>
                                                <td align="center">
                                                    <?php
                                                    if (empty($mem)) {
                                                        echo "未达到";
                                                    } else {
                                                        $num = $expadgradedata_model->countBySql("select count(*) from {{exp_ad_gradedata}} where mem_id = " . $mem['id'] . " and exp_ad_id=" . $expad_info['id'] . " and level='" . $info['param'] . "'");
                                                        if (empty($num)) {
                                                            echo "未达到";
                                                        } else {
                                                            echo "<span style='color:green'>已达到</span>";
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                            <?php } else { ?>
                                                <th><?php echo $index + 1; ?></th>
                                                <td align="center"><?php echo $info['content']; ?></td>
                                                <td align="center"><em><?php echo $info['hlb']; ?></em></td>
                                                <td align="center">
                                                    <?php
                                                    if (empty($mem)) {
                                                        echo "未达到";
                                                    } else {
                                                        $num = $expadgradedata_model->countBySql("select count(*) from {{exp_ad_gradedata}} where mem_id = " . $mem['id'] . " and exp_ad_id=" . $expad_info['id'] . " and level='" . $info['param'] . "'");
                                                        if (empty($num)) {
                                                            echo "未达到";
                                                        } else {
                                                            echo "<span style='color:green'>已达到</span>";
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--体验条例-->
                    <div class="tl">
                        <div class="tit">体验条例</div>
                        <div class="cont">
                            <p>*在体验过程中如有以下违规行为，将得不到元宝奖励，严重者直接冻结帐号：</p>
                            <p>1.在商家平台发布有损、形象或诋毁商家产品的言论，如“一切为了元宝、垃圾网站、做任务不给钱”等；</p>
                            <p>2.通过、在同一活动中进行反复注册的；</p>
                            <p>3.注册小号进行重复体验的；</p>
                            <p>4.注册体验账号时填写虚假资料信息，如“姓名：abc、123”或在注册信息中包含网赚信息的。</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once("right.php"); ?>
        </div>
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
    </body>
</html>
