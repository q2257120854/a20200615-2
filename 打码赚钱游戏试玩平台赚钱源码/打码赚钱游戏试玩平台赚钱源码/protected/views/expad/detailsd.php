<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>《<?php echo $expad_info['name']; ?>》-广告体验-<?php echo TIT; ?>、官方网站</title>
        <meta name="keywords" content="网上兼职,网赚,体验营销,互动营销,免费礼品" />
        <meta name="description" content="、网络用户通过选择感兴趣的广告，按照规则完成广告体验、商家问答，赚取元宝 ，兑换手机充值卡、Q币、笔记本、手机、ipad以及其他实物奖品，同时也为商家提供真实有效的广告受众。" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/advert.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/public_js.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.list_lh li:even').addClass('lieven');
                var result = '<?php echo $result; ?>';
                if (result == "error") {
                    alert("提交失败");
                } else if (result == "success") {
                    alert("提交成功");
                    location.href = "<?php echo SITE_URL ?>expad/detailsd/id/<?php echo $expad_info['id'] ?>";
                            }
                        })
                        $(function() {
                            $("div.list_lh").myScroll({
                                speed: 40, //数值越大，速度越慢
                                rowHeight: 86 //li的高度
                            });
                        });
        </script>
        <style type="text/css">
            .hover6{ background: url(<?php echo IMG_URL; ?>img/nav_b.png) no-repeat center; font-weight: bold;color:#fff;}
            .hover6 a { color:#fff !important;}
        </style>
    </head>
    <body >
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
                            <p>领取方式：<span><?php echo $expad_info['describe']; ?></span></p>
                            <p>体验要求：<span><?php echo $expad_info['ask']; ?></span></p>
                            <p>体验教程：<a target="_blank"  href="<?php
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
                    $expadzm_model = Expadzm::model();
                    $expadaudit_model = Expadaudit::model();
                    ?>
                    <!--体验信息-->
                    <div class="xx">
                        <div class="tit">体验信息</div>
                        <div class="cont">
                            <?php
                            if (Yii::app()->user->getIsGuest()) {
                                ?>
                                <!--未登陆显示、登陆不显示-->
                                <p class="wd">对不起，你尚未登陆，如果你已注册、，请点此<a class="a_dl" id="dlck" href="javascript:">立即登陆</a>。  还没有帐号？<a class="a_zc" href="<?php echo SITE_URL ?>index/regester">免费注册</a></p>
                            <?php } else { ?>
                                <div class="button_2 clearfix">
                                    <?php
                                    $num1 = $expadzm_model->countBySql("select count(*) from {{exp_ad_zm}} where mem_id = " . $mem['id'] . " and exp_ad_id=" . $expad_info['id']);
                                    $num2 = $expadaudit_model->countBySql("select count(*) from {{exp_ad_audit}} where mem_id = " . $mem['id'] . " and exp_ad_id=" . $expad_info['id']);
                                    if (empty($expad_info["zm_start"])) {
                                        if (strtotime($expad_info["end_time"]) > time()) {
                                            
                                              /*  ?>
                                                <a class="ann " href="<?php echo $expad_info["register_url"]; ?>">立即注册</a>
                                                <?php
                                            */
                                                if (empty($num2)) {
                                                    ?>
                                                    <a class="ann " href="<?php echo $expad_info["register_url"]; ?>">立即注册</a>
                                                
													<a class="ann tij"  href="javascript:">提交信息</a>
                                                    <span class="tangc">
                                                        <form action="<?php echo SITE_URL ?>expad/dataaudit" id="audit" name="audit" method="post" >
                                                            <input type="hidden" name="memid" id="memid" value="<?php echo $mem['id']; ?>" />
                                                            <input type="hidden" name="expadid" id="expadid" value="<?php echo $expad_info['id']; ?>" />
                                                            <i class="jiao"></i>
                                                            <span class="jiao_tit">广告体验审核数据提交</span>
                                                            <p class="shurk clearfix">
                                                                <span>输入注册账号：</span>
                                                                <input name="username" id="username" type="text" />
                                                            </p>
                                                            <p class="butt">
                                                                <a class="a_1" href="javascript:document.getElementById('audit').submit();">提交</a>
                                                                <span class="qux">取消</span>
                                                            </p>
                                                        </form>
                                                    </span>
                                                <?php } else { ?>
                                                    <a class="ann_2"  href="javascript:">信息已提交</a>
                                                    <?php
                                                }
                                            
                                        } else {
                                            ?>
                                            <a class="ann_2" href="javascript:">体验结束</a>
                                            <?php
                                        }
                                    } else {
                                        if (empty($num1)) {
                                            ?>
                                            <a class="ann_2" href="javascript:">招募已满</a>
                                            <?php
                                        } else {
                                            if (empty($num2)) {
                                                ?>
                                                <a class="ann tij"  href="javascript:">提交信息</a>
                                                <span class="tangc">
                                                    <form action="<?php echo SITE_URL ?>expad/dataaudit" id="audit" name="audit" method="post" >
                                                        <input type="hidden" name="memid" id="memid" value="<?php echo $mem['id']; ?>" />
                                                        <input type="hidden" name="expadid" id="expadid" value="<?php echo $expad_info['id']; ?>" />
                                                        <i class="jiao"></i>
                                                        <span class="jiao_tit">广告体验审核数据提交</span>
                                                        <p class="shurk clearfix">
                                                            <span>输入注册账号：</span>
                                                            <input name="username" id="username" type="text" />
                                                        </p>
                                                        <p class="butt">
                                                            <a class="a_1" href="javascript:document.getElementById('audit').submit();">提交</a>
                                                            <span class="qux">取消</span>
                                                        </p>
                                                    </form>
                                                </span>
                                            <?php } else { ?>
                                                <a class="ann_2"  href="javascript:">信息已提交</a>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                                <p class="ps">(PS：绑定信息只用做核实信息，请牢记自己的注册账号哦！)</p>
                                <?php if (!empty($num2)) { ?>
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
                                        <?php } ?>h>
                                            </tr>
                                            <?php
                                            $expadinfo = Expadaudit::model()->findAllBySql("select * from {{exp_ad_audit}} where mem_id = " . $mem['id'] . " and exp_ad_id=" . $expad_info['id']);
                                            foreach ($expadinfo as $info) {
                                                ?>
                                                <tr>
                                                    <th nowrap="nowrap"><?php echo $info['code'] ?></th>
                                                    <td align="center" nowrap="nowrap"><?php echo $info['username'] ?></td>
                                                    <td align="center" nowrap="nowrap"><em><?php
													if (!empty($info['hlb_id'])) {
                                                                $hlb = Hlb::model()->findByPk($info['hlb_id']);
                                                                echo $hlb['hlb'];
                                                            } else {
                                                                echo "--";
                                                            }
                                                            ?>
                                                        </em>
                                                    </td>
                                                    <td nowrap="nowrap"><?php echo $info['create_time'] ?></td>
                                                    <td align="center" nowrap="nowrap">
                                                        <?php
                                                        if (!empty($info['audit_time'])) {
                                                            echo $info['audit_time'];
                                                        } else {
                                                            echo "--";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td align="center" nowrap="nowrap">
                                                        <?php if ($info['start'] == "审核中") { ?>
                                                            <a href="javascript:" class="an an_1"><?php echo $info['start'] ?></a>
                                                        <?php } else if ($info['start'] == "通过") { ?>
                                                            <a href="javascript:" class="an an_3"><?php echo $info['start'] ?></a>
                                                        <?php } else if ($info['start'] == "未通过") { ?>
                                                            <a href="javascript:" class="an an_2"><?php echo $info['start'] ?></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <!--体验条例-->
                    <div class="tl">
                        <div class="tit">体验条例</div>
                        <div class="cont">
                            <p>*在体验过程中如有以下违规行为，将得不到元宝奖励，严重者直接冻结帐号：</p>
                            <p>1.在商家平台发布有损51形象或诋毁商家产品的言论，如“一切为了元宝、垃圾网站、做任务不给钱”等；</p>
                            <p>2.通过、在同一活动中进行反复注册的；</p>
                            <p>3.注册小号进行重复体验的；</p>
                            <p>4.注册体验账号时填写虚假资料信息，如“姓名：abc、123”或在注册信息中包含网赚信息的。</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once("right.php") ?>
        </div>
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
    </body>
</html>
