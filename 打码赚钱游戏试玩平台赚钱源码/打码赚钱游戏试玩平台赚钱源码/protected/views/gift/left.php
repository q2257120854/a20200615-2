<div class="main_left clearfix">
    <!--奖品分类-->
    <div class="prize_class">
        <div class="tit"><span>奖品分类</span></div>
        <div class="cont">
            <ul class="ul_1">
                <?php
                $gifttype_info = Gifttype::model()->findAll();
                $num = 0;
                foreach ($gifttype_info as $infos) {
                    ++$num;
                    if ($infos['pid'] == 0) {
                        ?>
                        <li>
                            <p class="p_1 virtual_<?php echo $num; ?>"><a href="<?php echo SITE_URL; ?>gift/type/id/<?php echo $infos['id']; ?>"><?php echo $infos['name']; ?></a></p>
                            <p class="p_2">
                                <?php
                                foreach ($gifttype_info as $info) {
                                    if ($infos['id'] == $info['pid']) {
                                        ?>
                                        <a href="<?php echo SITE_URL; ?>gift/type/id/<?php echo $info['id']; ?>"><?php echo $info['name']; ?></a>
                                        <?php
                                    }
                                }
                                ?>
                            </p>
                        </li>
                        <?php
                    }
                }
                ?>
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
                    <?php
                    $giftdh = Giftdh::model()->findAllBySql("select * from {{gift_dh}} order by id desc  limit 0,8 ");
                    foreach ($giftdh as $info) {
                        ?>
                        <li class="clearfix">
                            <?php
                            $gift = Gift::model()->findByPk($info['gift_id']);
                            $member = Mem::model()->findByPk($info['mem_id']);
                            $memimg = Memimg::model()->findByPk($member['memimg_id']);
                            ?>
                            <span class="tou"><img src="<?php echo IMG_URL; ?>touxiang/<?php echo $memimg['img'] ?>" /></span>
                            <span class="neir">
                                <p class="name">
                                    <?php echo $member['mem_name'] ?>
                                </p>
                                <p class="wan">兑换了:
                                    <a href="javascript:" ><?php echo $gift['name'] ?></a>
                                </p>
                                <p class="lin clearfix"><span><?php echo $info['create_time'] ?></span></p>
                            </span>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <!--体验问题-->
    <div class="customer">
        <div class="public_tit clearfix">
            <i class="ico customer_ico"></i>
            <span class="sp_1">兑换问题</span>
        </div>
        <div class="cont">
            <ul class="ul_1">
                <?php
                $help = Help::model()->findAllBySql("select * from {{help}} where help_type_id=5 order by id desc  limit 0,8 ");
                foreach ($help as $info) {
                    ?>
                    <li><a href="<?php echo SITE_URL; ?>help/show/id/4" target="_blank"><?php echo $info['quiz']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>