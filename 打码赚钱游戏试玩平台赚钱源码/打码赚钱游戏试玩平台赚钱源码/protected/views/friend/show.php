<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>邀请好友-<?php echo TIT; ?>、官方网站</title>
        <meta name="keywords" content="邀请好友,赚元宝,玩游戏,玩游戏赚钱,免费礼品,网赚" />
        <meta name="description" content="好友们可以通过QQ、微博、sns社区、MSN、邮件等方式，发送推广邀请链接给你的朋友，或通过论坛发贴邀请更多朋友加入、得邀请奖励，邀请好友玩、热门游戏、网页游戏以及好友在、物，分享快乐的同时，还分享好友元宝无限奖励！" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/friendcss.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/public_js.js"></script>
        <script src="/scripts/friendjs.js"></script>
        <script src="/scripts/friendjs1.js"></script>
        <script src="/scripts/page.js"></script>
        <style type="text/css">
            .hover3{ background: url(<?php echo IMG_URL; ?>img/nav_b.png) no-repeat center; font-weight: bold;color:#FA0303;}
            .hover3 a { color:#fff !important;}
        </style>
        <script type="text/javascript">
            /** 好友详细 **/
            function friend(memid) {
                if (memid != "") {
                    location.href = "<?php echo SITE_URL ?>vipexpand/friend";
                } else {
                    alert("对不起,请先登录!");
                }
            }

            function copyText(memid, id) {
                if (memid != "") {
                    var cont = 0;
                    if (id == 1) {
                        cont = $("#con1").val();
                    } else if (id == 2) {
                        cont = $("#con2").val();
                    } else if (id == 3) {
                        cont = $("#con3").val();
                    } else if (id == 4) {
                        cont = $("#con4").val();
                    }
                    if (window.clipboardData) {
                        window.clipboardData.clearData();
                        window.clipboardData.setData("Text", cont);
                        alert("复制成功！")
                    } else if (navigator.userAgent.indexOf("Opera") != -1) {
                        window.location = cont;
                        alert("复制成功！");
                    } else if (window.netscape) {
                        try {
                            netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
                        } catch (e) {
                            alert("被浏览器拒绝！\n请在浏览器地址栏输入'about:config'并回车\n然后将 'signed.applets.codebase_principal_support'设置为'true'");
                        }
                        var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
                        if (!clip)
                            return;
                        var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
                        if (!trans)
                            return;
                        trans.addDataFlavor('text/unicode');
                        var str = new Object();
                        var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
                        var copytext = cont;
                        str.data = copytext;
                        trans.setTransferData("text/unicode", str, copytext.length * 2);
                        var clipid = Components.interfaces.nsIClipboard;
                        if (!clip)
                            return false;
                        clip.setData(trans, null, clipid.kGlobalClipboard);
                        alert("复制成功！")
                    }
                } else {
                    alert("对不起,请先登录!");
                }
            }
        </script>
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
    <body style="background:url(<?php echo IMG_URL ?>friendimg/body_bk.png) no-repeat #fed201 top;">
        <?php include_once("./protected/views/design/header.php") ?>
        <!--主体-->
        <div class="main clearfix">
            <!--推广奖励、推广方法、好友详情-->
            <div class="reward_left">
                <!--标题-->
                <div class="tit clearfix">
                    <div class="tab clearfix">
                        <span class="hover" id="two1" onclick="setTab('two', 1, 3)">推广奖励</span>
                        <span id="two2" onclick="setTab('two', 2, 3)">推广方法</span>
                        <span id="two3" onclick="setTab('two', 3, 3)">好友详解</span>
                    </div>
                    <!--分享开始-->
                    <div style=" float:right; padding-top:12px; width:150px; margin:0 auto;text-align:center;">
                        <div class="bdsharebuttonbox" >
                            <a href="javascript:" class="bds_more" data-cmd="more"></a>
                            <a href="javascript:" class="bds_qzone" data-cmd="qzone"></a>
                            <a href="javascript:" class="bds_tsina" data-cmd="tsina"></a>
                            <a href="javascript:" class="bds_tqq" data-cmd="tqq"></a>
                            <a href="javascript:" class="bds_renren" data-cmd="renren"></a>
                            <a href="javascript:" class="bds_weixin" data-cmd="weixin"></a>
                        </div>
                        <script>
                            window._bd_share_config = {"common": {"bdSnsKey": {}, "bdText": "", "bdMini": "2", "bdPic": "", "bdStyle": "0", "bdSize": "16"}, "share": {}, "image": {"viewList": ["qzone", "tsina", "tqq", "renren", "weixin"], "viewText": "分享到：", "viewSize": "16"}, "selectShare": {"bdContainerClass": null, "bdSelectMiniList": ["qzone", "tsina", "tqq", "renren", "weixin"]}};
                            with (document)
                                0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
                        </script>
                    </div>
                </div>
                <?php $system_info = System::model()->findByPk(1); ?>
                <!--推广奖励-->
                <div class="cont" id="con_two_1" style="display:block">
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
                            <td align="center"><span class="table_bi"><?php echo $system_info["game1"]; ?>%</span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["game2"]; ?>%</span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["game3"]; ?>%</span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["game4"]; ?>%</span></td>
                        </tr>
                        <tr> 
                            <td align="center">打码任务</td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["captcha1"]; ?>%</span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["captcha2"]; ?>%</span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["captcha3"]; ?>%</span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["captcha4"]; ?>%</span></td>
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
                            <td align="center"><span class="table_bi"><?php echo $system_info["tx1"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["tx2"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["tx3"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["tx4"]; ?></span></td>
                        </tr>
                        <tr> 
                            <td align="center">满10元</td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["10tx1"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["10tx2"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["10tx3"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["10tx4"]; ?></span></td>
                        </tr>
                        <tr> 
                            <td align="center">满30元</td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["30tx1"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["30tx2"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["30tx3"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["30tx4"]; ?></span></td>
                        </tr>
                        <tr> 
                            <td align="center">满50元</td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["50tx1"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["50tx2"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["50tx3"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["50tx4"]; ?></span></td>
                        </tr>
                        <tr> 
                            <td align="center">满100元</td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["100tx1"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["100tx2"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["100tx3"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["100tx4"]; ?></span></td>
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
                            <td align="center"><span class="table_bi"><?php echo $system_info["friend1"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["friend2"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["friend3"]; ?></span></td>
                            <td align="center"><span class="table_bi"><?php echo $system_info["friend4"]; ?></span></td>
                        </tr>
                    </table>
                </div>
                <!--推广方法-->
                <div class="cont_1" id="con_two_2" style="display:none">
                    <!--邀请宣传图-->
                    <div class="picture" style="background:url(<?php echo IMG_URL; ?>friendimg/methods_img.png) no-repeat">
                        <a class="ann_1" href="javascript:"><span>推荐攻略</span></a>
                    </div>
                    <?php if (!empty($mem['id'])) { ?>
                        <div class="number">我已邀请
                            <span> 
                                <?php
                                $frinum = Mem::model()->countBySql("SELECT count(*) from xm_mem where INSTR(pid,'" . $mem['id'] . ",') !=0 and  (length(substring(pid,INSTR(pid,'" . $mem['id'] . ",')))-length(replace(substring(pid,INSTR(pid,'" . $mem['id'] . ",')),',','')))<5 ");
                                echo $frinum;
                                ?>
                            </span>位好友， 获得收益
                            <span>
                                <?php
                                $rewardshlb = Hlb::model()->countBySql("SELECT SUM(hlb) from xm_hlb where pmem_id !=0 and mem_id= " . $mem['id']);
                                echo number_format($rewardshlb);
                                ?>
                            </span>
                            <span>元宝</span>
                        </div>
                    <?php } ?>
                    <!--邀请方式-->
                    <div class="inv_fs">
                        <div class="tit_d">邀请方法</div>
                        <div class="list clearfix">
                            <p class="tit_1">邀请链接</p>
                            <div class="lj">
                                <p class="p_1 clearfix">
                                    <input type="text" class="sframe sframe_1" id="con1" value="<?php echo SITE_URL . $mem["id"]; ?>"  disabled="disabled"/><a class="ann_2" href="javascript:copyText('<?php echo $mem["id"]; ?>',1);">复制</a>
                                </p>
                                <p class="p_2">你的好友在注册时，通过此链接进行注册，即可与你建立好友下线关系。</p>
                            </div>
                            <span class="di"><i>1</i></span>
                        </div>
                        <div class="list clearfix">
                            <p class="tit_1">邀请范文</p>
                            <div class="fw clearfix">
                                <p class="p_1">把专属于你的邀请链接发给好友，好友打开此链接即可进行正常注册。(无须担心你的好友刷新页面在注册)</p>
                                <div class="d_1 clearfix">
                                    <p>
                                        <textarea class="sframe sframe_2" id="con2" disabled="disabled">、免费试玩赚钱，我刚才玩游戏赚了2元，马上到账了！老牌站不错的。另外邀请好友最高还有50%提成奖励。试玩赚钱
、打码、广告体验的奖励都很高。<?php echo SITE_URL . $mem["id"]; ?></textarea>
                                        <a href="javascript:copyText('<?php echo $mem["id"]; ?>',2);" class="ann_2 ann_3">复制</a>
                                    </p>
                                    <p style="margin-left:20px; *margin-left:5px;">
                                        <textarea class="sframe sframe_2" id="con3" disabled="disabled">大家都在、打码，那里的打码资源很优质，关键是上码速度快，我打了码之后去提现，立刻到账，2元就能提现。现在月末最高还能额外奖励本月打码的50%，每月打码排行最高奖励1200元现金！       <?php echo SITE_URL . $mem["id"]; ?></textarea>
                                        <a href="javascript:copyText('<?php echo $mem["id"]; ?>',3);" class="ann_2 ann_3">复制</a>
                                    </p>
                                    <p style="margin-left:20px; *margin-left:5px;">
                                        <textarea class="sframe sframe_2" id="con4" disabled="disabled">朋友都喜欢去、体验广告，那里广告来源优质，体验任务简单，现金到账快速，不费时不费力就能享受诸多好处。           <?php echo SITE_URL . $mem["id"]; ?></textarea>
                                        <a href="javascript:copyText('<?php echo $mem["id"]; ?>',4);" class="ann_2 ann_3">复制</a>
                                    </p>
                                </div>
                            </div>
                            <span class="di"><i>2</i></span>
                        </div>
                        <div class="list clearfix" style=" padding-bottom:20px;">
                            <p class="tit_1">合作帐号邀请</p>
                            <div class="yq clearfix">
                                <a href="javascript:">
                                    <span class="ico_1"></span>
                                    <p>微信</p>
                                </a>
                                <a href="javascript:">
                                    <span class="ico_2"></span>
                                    <p>QQ</p>
                                </a>
                                <a href="javascript:">
                                    <span class="ico_3"></span>
                                    <p>新浪微博</p>
                                </a>
                                <a href="javascript:">
                                    <span class="ico_4"></span>
                                    <p>腾讯微博</p>
                                </a>

                            </div>
                            <span class="di"><i>3</i></span>
                        </div>
                    </div>
                    <!--推荐规则-->
                    <div class="rule">
                        <div class="tit_d">推荐规则</div>
                        <ul class="ul_1">
                            <li>通过微信、QQ、新浪微博、腾讯微博、论坛、交友网站等多种方式邀请您的好友来注册；</li>
                            <li>提醒您的好友注册、时填写你的务必填写真实资料；</li>
                            <li>指导您的好友完成新手任务、完善个人资料等指定操作；</li>
                            <li>邀请的好友越多，获得的奖励就越多。快来邀请你的好友一起参加吧！</li>
                        </ul>
                    </div>
                </div>
                <!--好友详情-->
                <div class="cont_2" id="con_two_3" style="display:none">
                    <div class="db"></div>
                </div>
            </div>
            <?php $memimg = Memimg::model()->findByPk($mem['memimg_id']); ?>
            <!--个人信息、宣传图、邀请排行榜、推广收益动态-->
            <div class="dynamic_right">
                <?php
                if (!Yii::app()->user->getIsGuest()) {
                    ?>
                    <!--个人信息-->
                    <div class="personal">
                        <div class="hed clearfix">
                            <span class="tou_img"><img src="<?php echo IMG_URL; ?>touxiang/<?php echo $memimg['img'] ?>"></span>
                            <p class="text">好友总数：
                                <?php echo $frinum; ?>位
                            </p>
                            <p class="text">今日好友总数：
                                <?php
                                $daynum = Mem::model()->countBySql("SELECT count(*) from xm_mem where INSTR(pid,'" . $mem['id'] . ",') !=0 and to_days(create_time)=to_days(now())  and  (length(substring(pid,INSTR(pid,'" . $mem['id'] . ",')))-length(replace(substring(pid,INSTR(pid,'" . $mem['id'] . ",')),',','')))<5 ");
                                echo $daynum;
                                ?>位
                            </p>
                            <p class="text">今日好友奖励：
                                <?php
                                $rewardshlb = Hlb::model()->countBySql("SELECT SUM(hlb) from xm_hlb where source=1 and to_days(create_time)=to_days(now())  and mem_id= " . $mem['id']);
                                echo intval($rewardshlb) . "元宝";
                                ?>
                            </p>
                        </div>
                        <a href="javascript:friend('<?php echo $mem["id"]; ?>');" class="ann">进入个人中心查看我的好友<i>&nbsp;>></i></a>      
                    </div>
                <?php } else { ?>
                    <!--个人信息-->
                    <div class="personal">
                        <div class="no_landing">
                            <p class="toux"></p>
                            <p>登录后获取专属链接！</p>
                            <p>
                                没账号？
                                <a href="<?php echo SITE_URL ?>index/regester" class="li_2"> 简单注册 快捷方便！ </a>
                            </p>
                            <a class="dengl"  id="loginBtns">立即登录</a>
                        </div>      
                    </div>
                <?php } ?>
                <!--宣传图-->
                <span  onclick="setTab('two', 3, 3)"><div class="propaganda"></div></span>

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

                <!--邀请排行榜-->
                <div class="ranking">
                    <div class="tit">邀请排行榜<span style="font-size:14px;">&nbsp;&nbsp;(10.1-10.31)</span></div>
                    <div id="divData"> </div>
                    <div class="shangxia clearfix" id="divPage"> </div>
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
            </div>
        </div>
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
    </body>
</html>
