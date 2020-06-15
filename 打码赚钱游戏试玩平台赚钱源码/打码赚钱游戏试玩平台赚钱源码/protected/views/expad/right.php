<div class="main_right clearfix">
    <!--试玩三步-->
    <div class="step">
        <div class="tit">
            <span>体验三步搞定</span>
        </div>
        <div class="cont">
            <ul class="ul_1 clearfix">
                <li>
                    <a class="a_1" href="javascript:" target="_blank"></a>
                    <p>选择广告</p>
                </li>
                <li>
                    <a class="a_2" href="javascript:" target="_blank"></a>
                    <p>完成体验</p>
                </li>
                <li class="none">
                    <a class="a_3" href="javascript:" target="_blank"></a>
                    <p>领取奖励</p>
                </li>
            </ul>
        </div>
    </div>
    <?php
    $ad_info3 = Ad::model()->findAllBySql("select img,url from {{ad}} where id=14 and open =0 ; ");
    if (!empty($ad_info3)) {
        foreach ($ad_info3 as $ad) {
            ?>
            <a class="query" href="<?php echo $ad['url']; ?>"   target="_blank">
                <img src="/uploads/img/ad/<?php echo $ad['img']; ?>">
            </a>
            <?php
        }
    }
    ?>
    <!--今日排行榜、昨日试玩排行榜-->
               
    <div class="ranking">
            <div class="tit clearfix">
                <span>广告体验<?php
    //  $arr = getdate(strtotime("-1 month"));
    //   echo $arr['year'] . "/" . $arr['mon'];
    ?>月排行榜</span>
            </div>
            <div class="cont" id="divData"></div>
            <div class="sx clearfix" id="divPage"></div>
            <script type="text/javascript">
                var data = <?php //echo $data;         ?>;
                var count = <?php //echo $count;         ?>;
                //arrTr 数据  js表格 生成表格代码  arrTh 表头信息
                var getTable = function(arrTh, arrTr) {
                    var s = ' <ul class="ul_1 clearfix">';
                    s += ' <li class="li_1 clearfix">';
                    for (var i = 0; i < arrTh.length; i++) {
                        if (i == 0) {
                            s += ' <p class="p_1">' + arrTh[i] + '</p>';
                        } else if (i == 1) {
                            s += ' <p class="p_2">' + arrTh[i] + '</p>';
                        } else if (i == 2) {
                            s += ' <p class="p_3">' + arrTh[i] + '</p>';
                        } else {
                            s += '<p class="p_4"><span class="no">' + arrTh[i] + '</span></p>';
                        }
                    }
                    s += '</li>';
                    for (var i = 0; i < arrTr.length; i++) {
                        s += '<li class="li_2 clearfix">';
                        for (var j = 0; j < arrTr[i].length; j++) {
                            if (j == 0) {
                                s += ' <p class="p_1"><span>' + arrTr[i][j] + '</span></p>';
                            } else if (j == 1) {
                                s += ' <p class="p_2"><span>' + arrTr[i][j] + '</span></p>';
                            } else if (j == 2) {
                                s += ' <p class="p_3"><span><i>' + arrTr[i][j] + '</i></span></p>';
                            } else {
                                s += '<p class="p_4"><span class="no">￥' + arrTr[i][j] + '</span></p>';
                            }
                        }
                        s += ' </li>';
                    }
                    s += '</ul>';
                    return s;
                }
    
                function goPage(pageIndex) {
                    var arrTh = ['排行', '会员昵称', '体验收入', '每日奖励'];
                    var arrTr = [];
                    if ((10 * pageIndex) <= count) {
                        for (var i = (pageIndex - 1) * 10; i < (10 * pageIndex); i++)
                        {
                            arrTr.push([
                                data[i][0],
                                data[i][1],
                                data[i][2],
                                data[i][3]
                            ]);
                        }
                    }else{
                        for (var i = (pageIndex - 1) * 10; i < count; i++)
                        {
                            arrTr.push([
                                data[i][0],
                                data[i][1],
                                data[i][2],
                                data[i][3]
                            ]);
                        }
                    }
                    document.getElementById('divData').innerHTML = getTable(arrTh, arrTr);
                    jsPage('divPage', count, 10, pageIndex, 'goPage');
                }
                goPage(1);
            </script>
        </div>
    <!--体验实况-->
    <div class="play">
        <div class="public_tit clearfix">
            <i class="ico play_ico"></i>
            <span class="sp_1">体验实况</span>
        </div>
        <div class="cont">
            <div class="list_lh">
                <ul>
                    <?php
                    $expadgradedata = Expadgradedata::model()->findAllBySql("select * from {{exp_ad_gradedata}} order by id desc  limit 0,8 ");
                    foreach ($expadgradedata as $info) {
                        ?>
                        <li class="clearfix">
                            <?php
                            $expad = Expad::model()->findByPk($info['exp_ad_id']);
                            $member = Mem::model()->findByPk($info['mem_id']);
                            $memimg = Memimg::model()->findByPk($member['memimg_id']);
                            ?>
                            <span class="tou"><img src="<?php echo IMG_URL; ?>touxiang/<?php echo $memimg['img'] ?>"/></span>
                            <p class="name"><?php echo $member['mem_name']; ?></p>
                            <p class="wan">体验：
                                <?php if ($expad['is_timely'] == 0) { ?>
                                    <a href="<?php echo SITE_URL."expad/detailzd/id/".$expad['id']; ?>"><?php echo $expad['name']; ?> </a>
                                <?php } else { ?>
                                    <a href="<?php echo SITE_URL."expad/detailzd/id/".$expad['id']; ?>" ><?php echo $expad['name']; ?> </a>
                                <?php } ?>

                            </p>
                            <p class="lin clearfix"><span>领取了：</span><em><?php echo number_format(intval($info['hlb'])); ?></em></p>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <!--官方交流群-->
    <div class="qq_group">
        <div class="public_tit clearfix">
            <i class="ico group_ico"></i>
            <span class="sp_1">官方交流群</span>
        </div>
        <div class="cont">
            <ul class="ul_1">
                <li><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=62f73e8d9ee8d535aa583944177f7937e33866cdd12a5b14f35fa4917f5d8935"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="、综合交流①群" title="、综合交流①群"></a>【、①群】48999940</li>
                <li><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=7038992e8fc7e91a53ee64514fd314f99f242758356c25b997bbdb9ea250e9e3"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="、综合交流②群" title="、综合交流②群"></a>【、②群】48999980</li>                
			</ul>
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
                <?php
                $help_infos = Help::model()->findAllBySql("select quiz from {{help}} where help_type_id =7 order by id limit 0,8; ");
                foreach ($help_infos as $help) {
                    ?>
                    <li><a href="<?php echo SITE_URL ?>help/show/id/<?php echo $help['id']; ?>" target="_blank"><?php echo $help['quiz']; ?></a></li>
                <?php } ?>

            </ul>
        </div>
    </div>
</div>