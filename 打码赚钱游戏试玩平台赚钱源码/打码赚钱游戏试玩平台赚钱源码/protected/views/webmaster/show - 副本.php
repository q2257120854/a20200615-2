<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>站长联盟-<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="、，推荐好友，网赚，免费Q币，免费网赚"/>
        <meta name="description" content="、推荐好友版块，这里为玩家提供免费网赚的项目，广交朋友的用户可以通过邀请好友一起网赚，获得U币，兑换免费Q币、话费、手机、笔记本等礼品。"/>
        <meta name="keywords" content="/" />
        <meta name="description" content="/" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/webmaster.css" rel="stylesheet" type="text/css" />
        <link href="/style/public.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/public_js.js"></script>
        <script src="/scripts/webmaster.js"></script>
        <script src="/scripts/webmaster1.js"></script>
        <script src="/scripts/page.js"></script>
    </head>
    <!--加载大家都在玩滚动-->
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
    <body style="background:url(<?php echo IMG_URL ?>webmasterimg/zzlm_body_bk.png) no-repeat #fed201 !important;">
        <!--头部-->
        <?php include_once("./protected/views/design/header.php") ?>
        <?php $system_info = System::model()->findByPk(1); ?>
        <!--主体-->
        <div class="main clearfix">
            <!--推广奖励、推广方法、好友详情-->  
            <div class="reward_left">
                <!--标题-->
                <div class="tit clearfix">
                    <div class="tab clearfix">
                        <span class="hover"  id="nic1" onclick="setTab('nic', 1, 2)"><a href="javascript:">联盟奖励</a></span>
                        <span><a href="<?php echo SITE_URL; ?>webmaster/matter" target="_blank">推广素材</a></span>
                        <span><a href="<?php echo SITE_URL; ?>webmaster/join" target="_blank">加入联盟</a></span>
                        <span id="nic2" onclick="setTab('nic', 2, 2)">好友详解</span>
                    </div>
                </div>

                <!--推广奖励-->
                <div class="cont" id="con_nic_1">
                    <div class="ti ti_1">提成奖励</div>
                    <table class="table" border="1">
                        <tr>
                            <th>提成类型</th>
                            <th>一级好友</th>
                            <th>二级好友</th>
                            <th>三级好友</th>
                            <th>四级好友</th>
                        </tr>
                        <tr>
                            <td align="center">试玩平台</td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zzgame1"]; ?>%</span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zzgame2"]; ?>%</span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zzgame3"]; ?>%</span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zzgame4"]; ?>%</span></td>
                        </tr>
                        <tr>
                            <td align="center">广告体验</td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zzexpad1"]; ?>%</span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zzexpad2"]; ?>%</span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zzexpad3"]; ?>%</span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zzexpad4"]; ?>%</span></td>
                        </tr>
                        <tr> 
                            <td align="center">打码任务</td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zzcaptcha1"]; ?>%</span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zzcaptcha2"]; ?>%</span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zzcaptcha3"]; ?>%</span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zzcaptcha4"]; ?>%</span></td>
                        </tr>
                    </table>
                    <div class="ti ti_2">提现奖励</div>
                    <table class="table" border="1">
                        <tr>
                            <th>累计提现奖励</th>
                            <th>一级好友</th>
                            <th>二级好友</th>
                            <th>三级好友</th>
                            <th>四级好友</th>
                        </tr>
                        <tr> 
                            <td align="center">首次提现</td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zztx1"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zztx2"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zztx3"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zztx4"]; ?></span></td>
                        </tr>
                        <tr> 
                            <td align="center">满10元</td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zz10tx1"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zz10tx2"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zz10tx3"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zz10tx4"]; ?></span></td>
                        </tr>
                        <tr> 
                            <td align="center">满30元</td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zz30tx1"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zz30tx2"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zz30tx3"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zz30tx4"]; ?></span></td>
                        </tr>
                        <tr> 
                            <td align="center">满50元</td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zz50tx1"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zz50tx2"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zz50tx3"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zz50tx4"]; ?></span></td>
                        </tr>
                        <tr> 
                            <td align="center">满100元</td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zz100tx1"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zz100tx2"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zz100tx3"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zz100tx4"]; ?></span></td>
                        </tr>
                    </table>
                    <div class="ti ti_3">邀请奖励</div>
                    <table class="table" border="1">
                        <tr>
                            <th>奖励类型</th>
                            <th>一级好友</th>
                            <th>二级好友</th>
                            <th>三级好友</th>
                            <th>四级好友</th>
                        </tr>
                        <tr>
                            <td align="center">完善所有资料</td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zzfriend1"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zzfriend2"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zzfriend3"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["zzfriend4"]; ?></span></td>
                        </tr>
                    </table>
                    <div class="ti ti_2">推广工资<span class="zs">例如：站长小柿,3月推广收入为5000万米币，那么4月初他将可领取2500万米币的工资。</span></div>
                    <div class="tg_jl"></div>

                    <div class="zy_sm">
                        <p class="zy_p_1">重要说明</p>
                        <p class="zy_p_2">1、每个站长仅有3次提交审核机会，3次未通过请联系本网站客服处理！</p>
                        <p class="zy_p_2">2、连续一周日均注册量少于20的站长将被取消站长资格，取消前会与站长协商处理。取消站长资格后恢复为普通、用户，享受正常用户的奖励制度</p>
                        <p class="zy_p_2">3、下线作弊产生的佣金不计费，处理前会提前通知站长。作弊严重者将被取消站长资格。</p>
                        <p class="zy_p_2">4、推广工资中的当月收入，仅限一级好友的游戏、打码、体验提成（提现及其他提成均不统计在内）</p> 
                    </div>
                </div>
                <!--好友详解-->
                <div class="cont_2" id="con_nic_2" style="display:none">
                    <div class="db"></div>
                </div>
            </div>
            <!--个人信息、宣传图、邀请排行榜、推广收益动态-->
            <div class="dynamic_right">
                <!--合作咨询-->
                <div class="cooperation">
                    <div class="tit">合作咨询</div>
                    <div class="cont">
                        <p>、站长联盟诚邀广大站长加盟合作！佣金丰富，提现日结，成长性好。</p>
                        <p>联系人:张先生</p>
                        <p>联系QQ：416148489</p>
                        <p>QQ群：21666657</p>
                        <a href="<?php echo SITE_URL ?>vipexpand/friend" class="ann">进入个人中心查看我的好友<i>&nbsp;>></i></a>
                    </div>
                </div>
                <!--宣传图-->
                <div class="propaganda"  id="nic2" onclick="setTab('nic', 2, 2)"></div>
                <!--邀请排行榜-->
                <div class="ranking">
                    <div class="tit">邀请排行榜<span style="font-size:14px;">&nbsp;&nbsp;(暂不开放)</span></div>
                    <script>
                        //js表格 生成表格代码
                        //arrTh 表头信息
                        //arrTr 数据
                        var getTable = function(arrTh, arrTr) {
                            var s = ' <table class="table_2" >';
                            s += '<tr>';
                            for (var i = 0; i < arrTh.length; i++) {
                                s += '<th align="center">' + arrTh[i] + '</th>';
                            }
                            s += '</tr>';
                            for (var i = 0; i < arrTr.length; i++) {
                                s += '<tr>';
                                for (var j = 0; j < arrTr[i].length; j++) {
                                    if (j == 0) {
                                        s += '<td align="center">' + arrTr[i][j] + '</td>';
                                    } else if (j == 1) {
                                        s += '<td align="center">' + arrTr[i][j] + '</td>';
                                    } else if (j == 2) {
                                        s += '<td align="center"><span class="coin">' + arrTr[i][j] + '</span></td>';
                                    } else {
                                        s += '  <td align="center" class="money">￥' + arrTr[i][j] + '</td>';
                                    }
                                }
                                s += '</tr>';
                            }
                            s += '</table>';
                            return s;
                        }
                    </script>
                    <div id="divData"> </div>
                    <div class="sx clearfix" id="divPage"> </div>
                    <script type="text/javascript">
                        function goPage(pageIndex) {
                            var arrTh = ['排行', '会员昵称', '本期推广收入', '奖励'];
                            var arrTr = [];
                            var data = <?php echo $data; ?>;
                            var count = <?php echo $count; ?>;
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
                            } else {
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
                <!--推广收益动态-->
                <div class="profit">
                    <div class="tit">推广收益动态</div>
                    <div class="bcon">
                        <div class="list_lh">
                            <ul>
                                <?php
                                $hlbinfo = Hlb::model()->findAllBySql("select hlb,create_time,mem_id from {{hlb}} where pmem_id !=0  order by create_time DESC  Limit 0, 10  ");
                                foreach ($hlbinfo as $info) {
                                    $member = Mem::model()->findByPk($info['mem_id']);
                                    $memimg = Memimg::model()->findByPk($member['memimg_id']);
                                    ?>
                                    <li class="clearfix">
                                        <span class="tou"><img src="<?php echo IMG_URL; ?>touxiang/<?php echo $memimg['img'] ?>" /></span>
                                        <p class="name"><?php echo $member['mem_name'] ?></p>
                                        <p class="wan">推广获得：
                                            <a href="javascript:"><?php echo number_format(intval($info['hlb'])); ?></a>
                                        </p>
                                        <p class="lin clearfix"><?php echo $info['create_time'] ?></p>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--推广素材-->
                <a href="<?php echo SITE_URL ?>webmaster/matter" class="sica" target="_blank"></a>
            </div>
        </div>
        <!--底部1-->
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
    </body>
</html>
