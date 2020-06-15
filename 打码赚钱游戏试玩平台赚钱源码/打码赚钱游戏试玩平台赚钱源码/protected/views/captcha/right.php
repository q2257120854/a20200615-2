<div class="main_right clearfix">
    <!--今日打码排名、昨日打码排名-->
    <div class="ranking">
        <div class="tit clearfix">
            <span class="hover" id="data1">
                <a   href="javascript:data(1);" >今日打码排名</a>
            </span>
            <span id="data2">
                <a href="javascript:data(2);"  >昨日打码排名</a>
            </span>
        </div>
        <div class="cont"   id="divData1" ></div>
        <div class="sx clearfix" id="divPage1"> </div>

        <div class="cont" id="divData2"  style="display: none"></div>
        <div class="sx clearfix" id="divPage2" style="display: none"> </div>
        <script type="text/javascript">
            var data1 = <?php echo $data1; ?>;
            var data2 = <?php echo $data2; ?>;
            var count = <?php echo $count; ?>;
            /** 获取排行数据 **/
            function data(id) {
                if (id == 1) {
                    $("#data1").addClass("hover");
                    $("#data2").removeClass("hover");
                    $("#divData1").show();
                    $("#divPage1").show();
                    $("#divData2").hide();
                    $("#divPage2").hide();
                } else {
                    $("#data1").removeClass("hover");
                    $("#data2").addClass("hover");
                    $("#divData1").hide();
                    $("#divPage1").hide();
                    $("#divData2").show();
                    $("#divPage2").show();
                }
            }

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

            function goPage1(pageIndex) {
                var arrTh = ['排行', '会员昵称', '打码收入', '每日奖励'];
                var arrTr = [];
                if ((10 * pageIndex) <= count) {
                    for (var i = (pageIndex - 1) * 10; i < (10 * pageIndex); i++)
                    {
                        arrTr.push([
                            data1[i][0],
                            data1[i][1],
                            data1[i][2],
                            data1[i][3]
                        ]);
                    }
                } else {
                    for (var i = (pageIndex - 1) * 10; i < count; i++)
                    {
                        arrTr.push([
                            data1[i][0],
                            data1[i][1],
                            data1[i][2],
                            data1[i][3]
                        ]);
                    }
                }
                document.getElementById('divData1').innerHTML = getTable(arrTh, arrTr);
                jsPage('divPage1', count, 10, pageIndex, 'goPage1');
            }
            
            function goPage2(pageIndex) {
                var arrTh = ['排行', '会员昵称', '打码收入', '每日奖励'];
                var arrTr = [];
                if ((10 * pageIndex) <= count) {
                    for (var i = (pageIndex - 1) * 10; i < (10 * pageIndex); i++)
                    {
                        arrTr.push([
                            data2[i][0],
                            data2[i][1],
                            data2[i][2],
                            data2[i][3]
                        ]);
                    }
                } else {
                    for (var i = (pageIndex - 1) * 10; i < count; i++)
                    {
                        arrTr.push([
                            data2[i][0],
                            data2[i][1],
                            data2[i][2],
                            data2[i][3]
                        ]);
                    }
                }
                document.getElementById('divData2').innerHTML = getTable(arrTh, arrTr);
                jsPage('divPage2', count, 10, pageIndex, 'goPage2');
            }
            goPage1(1);
            goPage2(1);
        </script>
    </div>
    <!--打码资讯-->
    <div class="recommend">
        <div class="public_tit clearfix">
            <i class="ico recommend_ico"></i>
            <span class="sp_1">打码资讯</span>
            <a class="public_more" href="http://009.90xqb.com/message/list/pid/4" target="_blank">MORE<em>&nbsp;>></em></a>
        </div>
        <div class="cont">
            <ul class="ul_1">
                <?php
                $message_info = Message::model()->findAllBySql("select id,title from {{message}} where message_type_id =4 order by id desc limit 0,8; ");
                foreach ($message_info as $message) {
                    ?>
                    <li><a href="http://009.90xqb.com/message/detail/id/<?php echo $message['id']; ?>/pid/4" target="_blank"><?php echo $message['title']; ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <?php
    $ad_infos = Ad::model()->findAllBySql("select img,url from {{ad}} where  open=0 and id=17 ; ");
    if (!empty($ad_infos)) {
        foreach ($ad_infos as $ad) {
            ?>
            <!--广告图-->
            <a class="advertisement_1" href="<?php echo $ad['url']; ?>" target="_blank">
                <img src="/uploads/img/ad/<?php echo $ad['img']; ?>" />
            </a>
            <?php
        }
    }
    ?>
    <!--新手打码相关问题-->
    <div class="customer">
        <div class="public_tit clearfix">
            <i class="ico customer_ico"></i>
            <span class="sp_1">新手打码相关问题</span>
            <a class="public_more" href="http://009.90xqb.com/help/show/id/9" target="_blank">MORE<em>&nbsp;>></em></a>
        </div>
        <div class="cont">
            <ul class="ul_1">
                <?php
                $help_infos = Help::model()->findAllBySql("select quiz from {{help}} where help_type_id =9 order by id desc limit 0,8; ");
                foreach ($help_infos as $help) {
                    ?>
                    <li><a href="http://009.90xqb.com/help/show/id/<?php echo $help['id']; ?>" target="_blank"><?php echo $help['quiz']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
