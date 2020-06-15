<div class="main_right">
    <!--推荐资讯-->
    <div class="recommend">
        <div class="public_tit clearfix">
            <i class="ico recommend_ico"></i>
            <span class="sp_1">推荐资讯</span>
        </div>
        <div class="cont">
            <ul class="ul_1">
                <?php
                $message_info = Message::model()->findAllBySql("select id,title,message_type_id from {{message}} where is_recommend=1 order by id desc limit 8");
                foreach ($message_info as $message) {
                    ?>
                    <li>
                        <a href="<?php echo SITE_URL . "message/detail/id/" . $message['id'] . "/pid/" . $_GET["pid"]; ?>" target="_blank"><?php echo $message['title'] ?> </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <!--广告图-->
    <?php
    $ad_info = Ad::model()->findAllBySql("select img,url from {{ad}} where ad_type_id =8  and open=0");
    if (!empty($ad_info)) {
        foreach ($ad_info as $ad) {
            ?>
            <a class="advertisement_1" href="<?php echo $ad['url']; ?>" target="_blank">
                <img src="/uploads/img/ad/<?php echo $ad['img']; ?>" />
            </a>
            <?php
        }
    }
    ?>
    <!--最近更新-->
    <div class="recommend" style=" margin-bottom: 20px;">
        <div class="public_tit clearfix">
            <i class="ico new_ico"></i>
            <span class="sp_1">最近更新</span>
        </div>
        <div class="cont">
            <ul class="ul_1">
                <?php
                $message_info2 = Message::model()->findAllBySql("select id,title,message_type_id from {{message}} order by id desc limit 8");
                foreach ($message_info2 as $message) {
                    ?>
                    <li>
                        <a href="<?php echo SITE_URL . "message/detail/id/" . $message['id'] . "/pid/" . $_GET["pid"]; ?>" target="_blank"><?php echo $message['title'] ?> </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>