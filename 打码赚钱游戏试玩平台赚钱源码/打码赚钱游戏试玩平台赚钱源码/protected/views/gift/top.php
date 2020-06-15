<div class="h_x clearfix">
    <!--幻灯片-->
    <div class="wrapper clearfix">
        <div id="focus">
            <ul>
                <?php
                $ad_info = Ad::model()->findAllBySql("select img,url from {{ad}} where ad_type_id =5 and open=0 order by orderby asc ");
                foreach ($ad_info as $ad) {
                    ?>
                    <li>
                        <a href="<?php echo $ad['url']; ?>" target="_blank">
                            <img src="/uploads/img/ad/<?php echo $ad['img']; ?>"/>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <!--个人信息-->
    <div class="information clearfix">
        <?php
        if (!Yii::app()->user->getIsGuest()) {
            $memimg = Memimg::model()->findByPk($mem['memimg_id']);
            ?>
            <div class="di_1 clearfix">
                <p class="p_1">
                    <a href="<?php echo SITE_URL ?>vipindex/memimg/id/<?php echo $mem["id"]; ?>" class="tou" target="_blank"><img src="<?php echo IMG_URL; ?>touxiang/<?php echo $memimg['img'] ?>" /></a>
                </p>
                <p class="account">
                    <a href="<?php echo SITE_URL ?>vipindex/show" target="_blank"><?php echo $this->show_mem_name(); ?></a>
                </p>
                <p class="id_1">
                    <a href="<?php echo SITE_URL ?>vipindex/show" target="_blank"><?php
                        if (empty($hldnum)) {
                            echo 0;
                        } else {
                            echo number_format($hldnum);
                        }
                        ?><i>[获取]</i></a>
                </p>
            </div>
            <ul class="ul_1">
                <li class="query"><a href="<?php echo SITE_URL . "vipexpiry/show"; ?>">查询兑换记录</a></li>
                <li class="address"><a href="<?php echo SITE_URL . "address/show"; ?>">修改收货地址</a></li>
            </ul>
        <?php } else { ?>
            <div class="no_landing">
                <p class="toux"></p>
                <p>登录后兑换奖品！</p>
                <p>
                    没账号？
                    <a href="<?php echo SITE_URL ?>index/regester" class="li_2"> 简单注册 快捷方便！ </a>
                </p>
                <a class="dengl"  id="loginBtns">立即登录</a>
            </div>
        <?php } ?>
    </div>

</div>