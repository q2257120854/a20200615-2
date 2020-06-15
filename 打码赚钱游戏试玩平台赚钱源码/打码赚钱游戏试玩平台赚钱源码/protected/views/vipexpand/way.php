<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>个人中心—推广管理—邀请方式—<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="/" />
        <meta name="description" content="/" />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/vip/public.css" rel="stylesheet" type="text/css" />
        <link href="/style/vip/inside.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/vip/jQuery.v1.8.3.js"></script>
        <script src="/scripts/vip/public.js"></script>

        <style type="text/css">
            .hover5{border-top:4px solid #70a0f1; height:36px; line-height:36px; background:#4b6289;}
            .hover21{background: url("<?php echo IMG_URL ?>vip/img/public_db _menu_left _j.png") no-repeat scroll right center #fff; color: #cc3d12;width: 171px;}
        </style>
        <script type="text/javascript">
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
    <body>
        <!--头部-->
        <?php include_once("./protected/views/vipdesign/header.php") ?>
        <!--主体-->
        <div class="main clearfix">
            <!--导航-->
            <?php include_once("./protected/views/vipdesign/navicat.php") ?>

            <div class="public_db clearfix">
                <!--左菜单-->
                <?php include_once("left.php") ?>
                <!--右内容-->
                <div class="cont methods">
                    <!--邀请宣传图-->
                    <div class="picture" style="background:url(<?php echo IMG_URL ?>vip/img/methods_img.png) no-repeat">
                        <a class="ann_1" href="javascript:"><span>推荐攻略</span></a>
                    </div>
                    <div class="number">我已邀请
                        <span> 
                            <?php
                            $memid = $mem["id"];
                            $frinum = Mem::model()->countBySql("SELECT count(*) from xm_mem where INSTR(pid,'$memid,') !=0 and  (length(substring(pid,INSTR(pid,'$memid,')))-length(replace(substring(pid,INSTR(pid,'$memid,')),',','')))<5 ");
                            echo $frinum;
                            ?>
                        </span>位好友， 获得收益
                        <span>
                            <?php
                            $rewardshlb = Hlb::model()->countBySql("SELECT SUM(hlb) from xm_hlb where pmem_id !=0   and mem_id= " . $mem['id']);
                            echo number_format($rewardshlb);
                            ?>
                        </span>
                        <span>元宝</span>
                    </div>
                    <!--邀请方式-->
                    <div class="inv_fs">
                        <div class="tit">邀请方法</div>
                        <div class="list clearfix">
                            <p class="tit_1">邀请链接</p>
                            <div class="lj">
                                <p class="p_1 clearfix">
                                    <input type="text" class="sframe sframe_1" id="con1"  value="<?php echo SITE_URL . $mem["id"]; ?>"  disabled="disabled"/><a class="ann_2" href="javascript:copyText('<?php echo $mem["id"]; ?>',1);">复制</a>
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
                                        <textarea class="sframe sframe_2"  id="con2"   disabled="disabled">、免费玩游戏赚钱，我刚才玩游戏赚
了2元，马上到账了！老牌站不错的。另外
邀请好友最高还有50%提成奖励。游戏赚钱
、打码、广告体验的奖励都很高。
                                            <?php echo SITE_URL . $mem["id"]; ?></textarea>

                                        <a href="javascript:copyText('<?php echo $mem["id"]; ?>',2);" class="ann_2 ann_3">复制</a>
                                    </p>
                                    <p style="margin-left:20px; *margin-left:5px;">
                                        <textarea class="sframe sframe_2"  id="con3"   disabled="disabled">大家都在、打码，那里的打码资源很
优质，关键是上码速度快，我打了码之后
去提现，立刻到账，2元就能提现。现在月
末最高还能额外奖励本月打码的50%，每月
打码排行最高奖励1200元现金！
                                            <?php echo SITE_URL . $mem["id"]; ?></textarea>
                                        <a href="javascript:copyText('<?php echo $mem["id"]; ?>',3);" class="ann_2 ann_3">复制</a>
                                    </p>
                                    <p style="margin-left:20px; *margin-left:5px;">
                                        <textarea class="sframe sframe_2" id="con4"   disabled="disabled">朋友都喜欢去、体验广告，那里广告
来源优质，体验任务简单，现金到账快速
，不费时不费力就能享受诸多好处。
                                            <?php echo SITE_URL . $mem["id"]; ?></textarea>
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
                        <div class="tit">推荐规则</div>
                        <ul class="ul_1">
                            <li>通过微信、QQ、新浪微博、腾讯微博、论坛、交友网站等多种方式邀请您的好友来注册；</li>
                            <li>提醒您的好友注册、时填写你的务必填写真实资料；</li>
                            <li>指导您的好友完成新手任务、完善个人资料等指定操作；</li>
                            <li>邀请的好友越多，获得的奖励就越多。快来邀请你的好友一起参加吧！</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--广告图-->
            <?php
            if (!empty($ad_info)) {
                foreach ($ad_info as $ad) {
                    ?>
                    <!--广告图-->
                    <a class="advertising_1" href="<?php echo $ad['url']; ?>">
                        <img src="/uploads/img/ad/<?php echo $ad['img']; ?>">
                    </a>
                    <?php
                }
            }
            ?>
        </div>
        <!--底部1-->
        <?php include_once("./protected/views/vipdesign/footer.php"); ?>
        <?php include_once("./protected/views/vipdesign/kefu.php") ?>
    </body>
</html>
