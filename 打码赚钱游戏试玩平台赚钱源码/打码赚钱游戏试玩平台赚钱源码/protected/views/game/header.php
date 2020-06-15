


<!--登录-->
<iframe src="<?php echo SITE_URL ?>index/login" class="regis" id="regis" frameborder="0" ALLOWTRANSPARENCY="true" style="display: none"></iframe>
<?php
$mem = $this->show_mem();
$memimg = Memimg::model()->findByPk($mem['memimg_id']);
?>
<!--头部-->
<div class="top">
    <div class="big">
        <!--微博、微信关注   -->
        <ul class="ul_2">
            <li class="diy">&nbsp;</li>
            <li class="gz">
                <a href="/index/show">首页</a>
            </li>
            <li class="gz">
                <a href="/new/show">新手任务</a>
            </li>
            <li class="gz">
                <a href="/game/show"> 试玩平台 </a>
            </li>
			<li class="gz">
                <a href="/geme/wtask">任务墙</a>
			</li>
            <li class="gz">
                <a href="/captcha/show">打码平台</a>
            </li>
			<li class="gz">
                <a href="/gift/show"> 兑换商城 </a>
            </li>
            <li class="gz">
                <a href="/friend/show"> 邀请好友 </a>
            </li>
            <li class="gz">
                <a href="/message/show"> 网站资讯 </a>
            </li>
        </ul>
        <?php
        if (Yii::app()->user->getIsGuest()) {
            ?>
            <!--未登入前-->
            <span class="ul_1 clearfix">
                <a href="javascript:" class="li_1">
                    <i></i>立即登入</a>
                <a href="<?php echo SITE_URL ?>index/regester" class="li_2"> 免费注册 </a>
            </span>
            <!--登录后-->
        <?php } else { ?>
            <!--登录后-->
            <ul class="ul_3" >
                <li>
                    <a href="<?php echo SITE_URL; ?>vipindex/show" class="name a_1">您好，<span><?php echo $this->show_mem_name(); ?></span></a>
                    <!--弹出框-->
                    <div class="bck">
                        <i></i>
                    </div>
                    <div class="neir" >
                        <div class="d_1 clearfix">
                            <a href="<?php echo SITE_URL; ?>vipindex/show" class="tou" target="_blank"><img src="<?php echo IMG_URL; ?>touxiang/<?php echo $memimg['img'] ?>" /></a>
                            <p class="account">
                                <a href="<?php echo SITE_URL; ?>vipindex/show" target="_blank"><?php echo $this->show_mem_name(); ?></a>
                                <?php
                                if (empty($mem["role"])) {
                                    echo "<span style='color:red;'>会员</span>";
                                } else {
                                    echo "<span style='color:red;'>站长</span>";
                                }
                                ?>  <span>欢迎回来！</span>
                            </p>
                            <p class="id_1"><em>ID：
                                    <?php echo $mem['id']; ?>
                                    <?php
                                    $sql = "select count(*) from {{vipmessage}} where  is_read=0 and mem_id = " . $mem['id'];
                                    $messagenum = Vipmessage::model()->countBySql($sql);
                                    ?>
                                </em><span class="tis <?php
                                if (!empty($messagenum)) {
                                    echo " tis_s";
                                }
                                ?>">
                                    <a href="<?php echo SITE_URL ?>vipmessage/show" target="_blank">未读信息
                                        <i>
                                            <?php
                                            echo $messagenum;
                                            ?>条
                                        </i>
                                    </a>
                                </span>
                            </p>
                        </div>
                        <div class="d_2 clearfix">
                            <span>
                                <?php
                                $signnum = Sign::model()->countBySql("select count(*) from {{sign}} where TO_DAYS(create_time) = (TO_DAYS(NOW())) and mem_id=" . $mem["id"]);
                                if (empty($signnum)) {
                                    ?>
                                    <a href="<?php echo SITE_URL; ?>sign/show" target="_blank" class="ann ann_1">签到</a> 
                                <?php } else { ?>
                                    <a href="javascript:"  class="ann ann_1_n"><?php echo "已签" . $mem["sign"] . "天"; ?></a> 
                                <?php } ?>
                            </span>
                            <span>
                                <a href="<?php echo SITE_URL; ?>vipindex/show" target="_blank" class="ann ann_2">个人中心</a>
                            </span>
                        </div>
                        <div class="d_3">
                            <dl class="dl_1">
                                <dt>
                                <p><em>元宝余额：</em><i class="dou"><?php
                                        $hlbnum = Hlb::model()->countBySql("select sum(hlb) from {{hlb}} where mem_id=" . $mem['id']);
                                        echo number_format(intval($hlbnum));
                                        ?></i></p>
                                <a href="<?php echo SITE_URL ?>vipadvance/txalipay" target="_blank">提现</a>
                                </dt>
                                <dt>
                                <p><em>金豆余额：</em><i class="bi"><?php
                                        $hldnum = Hld::model()->countBySql("select sum(hld) from {{hld}} where mem_id=" . $mem['id']);
                                        echo number_format(intval($hldnum));
                                        ?></i></p>
                                <a href="<?php echo SITE_URL ?>gift/show" target="_blank">兑奖</a>
                                </dt>
                                <dt>
                                <p><em>今日预计上线试玩：</em><i>
                                        <?php
                                        $sql = "select count(*) from {{game}} where valid=0 and  to_days(begin_time) = to_days(now()) ";
                                        $gamenum = Game::model()->countBySql($sql);
                                        echo $gamenum;
                                        ?>
                                        个</i></p>
                                <a href="<?php echo SITE_URL; ?>game/show" target="_blank">立即试玩</a>
                                </dt>
                            </dl>
                        </div>
                    </div>
                </li>
                <li>
                    <a class="a_1" href="<?php echo SITE_URL ?>index/logout">退出</a>
                </li>
                <?php
                if (!empty($mem)) {
                    $expadzm_info = Expadzm::model()->findAllBySql("select * from {{exp_ad_zm}} where mem_id=" . $mem["id"] . "  limit 4");
                    if (!empty($expadzm_info)) {
                        ?>
                        <li class="li_1">
                            <a href="javascript:" class="tiy a_1">我的体验</a>
                            <!--弹出框-->
                            <div class="bck_2">
                                <i></i>
                            </div>
                            <div class="neir_2">
                                <dl class="dl_2">
                                    <?php
                                    foreach ($expadzm_info as $info) {
                                        $expad7 = Expad::model()->findByPk($info["exp_ad_id"])
                                        ?>
                                        <dt>
                                        <?php if (empty($expad7["is_timely"])) { ?>
                                            <a href="<?php echo SITE_URL ?>expad/detailzd/id/<?php echo $expad7["id"]; ?>" target="_blank"><?php echo $expad7->name; ?></a> 
                                        <?php } else { ?>
                                            <a href="<?php echo SITE_URL ?>expad/detailsd/id/<?php echo $expad7["id"]; ?>" target="_blank"><?php echo $expad7->name; ?></a> 
                                        <?php } ?>
                                        </dt>
                                    <?php } ?>
                                    <dt class="gend">
                                    <a href="<?php echo SITE_URL ?>viptask/expad" target="_blank">更多</a>
                                    </dt>
                                </dl>
                            </div>
                        </li>
                        <?php
                    }
                }
                ?>
                <li class="li_1">
                    <a href="<?php echo SITE_URL ?>help/show" class="ban a_1">帮助中心</a>
                </li>
            </ul>
        <?php } ?>
    </div>
</div>