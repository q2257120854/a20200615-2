<?php
if (!defined('IN_CRONLITE')) exit;
$invite_row = $DB->get('invite_rules', [
    '[><]tools' => ['tid' => 'tid']
], ['tools.tid', 'tools.cid', 'tools.name', 'tools.shopimg', 'invite_rules.type', 'invite_rules.status',
    'invite_rules.is_default', 'invite_rules.rule_value'], [
    'invite_rules.status' => 1,
    'tools.active'        => 1,
    'invite_rules.is_default' => 1,
    'ORDER'               => ['is_default' => 'DESC', 'id' => 'ASC']
]);
if (!$invite_row) exit('<script>alert("当前站点未开启推广链接功能或赠送商品未设置默认推广");location.href="./";</script>');
?>
<!DOCTYPE html>
<html lang="cn-Zh">
<head>
    <meta charset="utf-8" />
    <title><?php echo $conf['sitename'] . (empty($conf['title']) ? '' : ' - ' . $conf['title']); ?></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
    <meta name="keywords" content="<?php echo $conf['keywords']; ?>">
    <meta name="description" content="<?php echo $conf['description']; ?>">
    <link rel="shortcut icon" href="/favicon.ico">
    <link href="/assets/wxds/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/wxds/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/common/fancybox/jquery.fancybox.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/common/css/style.css" rel="stylesheet" type="text/css" />
    <script src="//lib.baomitu.com/jquery/3.4.1/jquery.min.js"></script>
    <style type="text/css">
        ul.side-nav>li.active{
            background: #ffffff38;
        }
        ul.collapse>li.active{
            background: #7f79e888;
        }
        select.form-control {
            -webkit-appearance: none;
            outline: none;
        }
    </style>
    <script type="text/javascript">
        document.addEventListener( "plusready", function(){
            var is_app = true;
            $('#AppDown').hide();
            $('footer').hide();
        }, false );
    </script>
</head>
<body class="boxed-layout sidebar-enable" data-keep-enlarged="true">
<div class="loading">
    <div id="loader"></div>
</div>
<div class="modal fade" id="kfModel">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <!--首页聊天代码-->
                <?php echo $conf['chatframe']; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="hzModel">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <!--首页公告-->
                <?php echo $conf['anounce']; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body p-0">
                <!--首页弹出公告-->
                <?php echo $conf['modal']; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<div id="appDown" class="modal fade" data-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content modal-filled bg-success">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="fas fa-cloud-download-alt h1"></i>
                    <h4 class="mt-1">下载APP，下单更便捷！</h4>
                    <p class="mt-1"><img
                            src="http://qr.liantu.com/api.php?text=<?php echo $conf['appurl']; ?>"
                            width="100%" alt="扫码下载APP"></p>
                    <p class="text-reset">注：不建议使用微信扫码，微信扫码请选择在浏览器打开！</p>
                    <div class="mt-1">
                        <a href="<?php echo $conf['appurl']; ?>" target="_blank" class="btn btn-warning text-white">直接下载</a>
                        <button type="button" class="btn btn-light" data-dismiss="modal">关闭</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wrapper shadow-none bg-white" >
    <div class="content-page">
        <div class="content position-relative">
            <div class="navbar-custom">
                <div class="fc-button-group topbar-right-menu float-right mb-0" style="padding: calc(32px / 2) 0;">
                    <a href="/user/login.php" pjax="no" class="btn btn-primary btn-sm mr-1">登录</a>
                    <a href="/user/reg.php" pjax="no" class="btn btn-light btn-sm" >注册</a>
                </div>
                <a href="../" class="logo d-inline-block ml-2" style="line-height: 70px;">
                    <img src="/assets/img/logo.png" style="height: 30px;" alt="LOGO">
                </a>
            </div>
            <section id="pjax-container">    <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-none d-md-block">
                                <h4 class="page-title">邀请有礼</h4>
                            </div>
                            <ul class="nav nav-pills nav-justified form-wizard-header mb-2" id="mobileNav">
                                <li class="nav-item">
                                    <a href="../" _action="index" class="nav-link rounded-0 pt-2 pb-2">
                                        <i class="fas fa-home mr-1"></i>
                                        <span>首页</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?mod=query" _action="query" class="nav-link rounded-0 pt-2 pb-2">
                                        <i class="fas fa-search mr-1"></i>
                                        <span>查单</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?mod=more" _action="more" class="nav-link rounded-0 pt-2 pb-2">
                                        <span>更多</span>
                                        <i class="fas fa-angle-double-right mr-1"></i>
                                    </a>
                                </li>
                            </ul>
                            <script type="text/javascript">
                                $(function(){
                                    $("a[_action=more]").addClass("active");
                                })
                            </script>                            </div>
                        <div class="col-12 col-lg-8">
                            <div class="card">
                                <img class="card-img-top" src="/assets/wxds/img/invite.jpg" style="max-height: 300px;">
                                <div class="card-body bg-white mt-n1">
                                    <div class="card text-white bg-primary overflow-hidden" id="gift" style="display: none;">
                                        <div class="card-body">
                                            <div class="toll-free-box text-center">
                                                <h4> <i class="mdi mdi-gift"></i> <span id="roll"></span></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">ＱＱ号码</span>
                                        </div>
                                        <input type="text" name="userqq" id="userqq" class="form-control" placeholder="请输入您正确的QQ" required="required" onkeydown="if(event.keyCode==13){submit_sub.click()}">
                                    </div>
                                    <input type="submit" name="submit" id="submit_sub" value="立即生成推广链接" class="btn btn-primary btn-block mb-2"/>
                                    <div id="inviteRes" style="display:none;">
                                        <ul class="nav nav-tabs nav-justified nav-bordered mb-3">
                                            <li class="nav-item">
                                                <a href="#invitewz" data-toggle="tab" class="nav-link active">
                                                    <span>文字邀请</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#inviteimg" data-toggle="tab" class="nav-link">
                                                    <span>二维码</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="invitewz">
                                                <p id="resulturl"></p>
                                            </div>
                                            <div class="tab-pane text-center" id="inviteimg">
                                                <img alt="QRCode" id="resultimg" src="" />
                                                <p class="text-reset">长按二维码即可保存！</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card text-white bg-primary text-xs-center">
                                <div class="card-body text-center">
                                    <h3 class="mt-n1 mb-3">邀请说明</h3>
                                    <ol class="ml-n3 text-left">
                                        <li>首先输入自己的QQ号码，生成一个邀请链接！</li>
                                        <li>将生成的邀请链接通过QQ、微信、贴吧等社交平台传递给其他人或朋友！</li>
                                        <?php
                                        if ($invite_row['type'] == 0):
                                        ?>
                                        <li>用户访问并购买商品金额达到 <span style="color: #FFB800;">￥<?php echo $invite_row['rule_value']; ?></span> 后，你将会获得【<span style="color: #FFB800;"><?php echo $invite_row['name']; ?></span>】</li>
                                        <?php else: ?>
                                        <li>当他们通过访问你的邀请链接达到 <span style="color: #FFB800;"><?php echo intval($invite_row['rule_value']); ?></span> 人，你将会获得【<span style="color: #FFB800;"><?php echo $invite_row['name']; ?></span>】</li>
                                        <?php endif; ?>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        var hashsalt = <?php echo $addsalt_js; ?>;
                        $(document).on('click','#submit_sub',function(){
                            var userqq = $('#userqq').val();
                            if (userqq === '') {
                                layer.alert('请确保每项不能为空！',{title: '小提示',skin: 'layui-layer-molv layui-layer-wxd'});
                                return false;
                            }
                            var ii = layer.load(1, {shade: [0.1, '#fff']});
                            $.ajax({
                                type : 'POST',
                                url : 'ajax.php?act=inviteurl',
                                data : {userqq : userqq, hashsalt:hashsalt},
                                timeout : 5000,
                                dataType : 'json',
                                async : true,
                                success : function (json)
                                {
                                    layer.close(ii);
                                    if (json.code === 1) {
                                        var value = '代唰商城'+
                                            json.url+''+
                                            '【自动处理】【下单秒唰】'+
                                            '【钻类业务】【红书业务】'+
                                            '【唰名片赞】【空间业务】'+
                                            '【快手业务】【游戏代充】'+
                                            '【抖音业务】【代挂业务】'+
                                            '【Ｋ歌业务】【新浪微博】'+
                                            '每天免费抽奖，赢好礼'+
                                            '开通分站每天签到送现金！'+
                                            '建议收藏网站方便下次访问，不迷路';
                                        $('#resultimg').attr('src','http://qr.liantu.com/api.php?text='+json.url);
                                        $('#resulturl').html('<p class="text-center">'+
                                            '代唰商城<br />'+
                                            json.url+'<br />'+
                                            '【自动处理】【下单秒唰】<br />'+
                                            '【钻类业务】【红书业务】<br />'+
                                            '【唰名片赞】【空间业务】<br />'+
                                            '【快手业务】【游戏代充】<br />'+
                                            '【嘟音业务】【代挂业务】<br />'+
                                            '【Ｋ歌业务】【新浪微博】<br />'+
                                            '每天免费抽奖，赢好礼<br />'+
                                            '开通分站每天签到送现金！<br />'+
                                            '建议收藏网站方便下次访问，不迷路'+
                                            '</p><center><button class="btn btn-warning btn-sm" data-clipboard-text="'+json.url+'" id="copy-btn" data-text="复制成功，快去邀请拿好礼吧！">一键复制链接</button>&nbsp;<button class="btn btn-success btn-sm" data-clipboard-text="'+value+'" id="copy-btn" data-text="复制成功，快去邀请拿好礼吧！">一键复制广告语</button></center>');
                                    } else if (json.code === 2) {
                                        var value = '代唰商城\n'+
                                            json.url+'\n'+
                                            '【自动处理】【下单秒唰】\n'+
                                            '【钻类业务】【红书业务】\n'+
                                            '【唰名片赞】【空间业务】\n'+
                                            '【快手业务】【游戏代充】\n'+
                                            '【抖音业务】【代挂业务】\n'+
                                            '【Ｋ歌业务】【新浪微博】\n'+
                                            '每天免费抽奖，赢好礼\n'+
                                            '开通分站每天签到送现金！\n'+
                                            '建议收藏网站方便下次访问，不迷路';
                                        $('#resultimg').attr('src','http://qr.liantu.com/api.php?text='+json.url);
                                        $('#resulturl').html('<p class="text-center">'+
                                            '代唰商城<br />'+
                                            json.url+'<br />'+
                                            '【自动处理】【下单秒唰】<br />'+
                                            '【钻类业务】【红书业务】<br />'+
                                            '【唰名片赞】【空间业务】<br />'+
                                            '【快手业务】【游戏代充】<br />'+
                                            '【抖音业务】【代挂业务】<br />'+
                                            '【Ｋ歌业务】【新浪微博】<br />'+
                                            '每天免费抽奖，赢好礼<br />'+
                                            '开通分站每天签到送现金！<br />'+
                                            '建议收藏网站方便下次访问，不迷路'+
                                            '</p><center><button class="btn btn-warning btn-sm" data-clipboard-text="'+json.url+'" id="copy-btn" data-text="复制成功，快去邀请拿好礼吧！">一键复制链接</button>&nbsp;<button class="btn btn-success btn-sm" data-clipboard-text="'+value+'" id="copy-btn" data-text="复制成功，快去邀请拿好礼吧！">一键复制广告语</button></center>');
                                    } else {
                                        layer.alert('失败：' + json['msg'],{title: '小提示',skin: 'layui-layer-molv layui-layer-wxd'});
                                    }
                                    $('#inviteRes').slideDown();
                                },
                                error : function(){
                                    layer.close(ii);
                                    layer.alert('服务器错误，请稍后再试！');
                                }

                            })
                        })
                    </script>
                </div>
            </section>
        </div>
        <footer class="footer border-top border-light">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12  text-center ">
                        <?php echo date('Y'); ?> © <a href="../"><?php echo $conf['sitename']; ?></a> •
                        <?php echo $conf['bottom']; ?>
                    </div>
                    <!--<div class="col-md-6">
                        <div class="text-md-right footer-links d-none d-md-block">
                            <a href="javascript: void(0);">About</a>
                            <a href="javascript: void(0);">Support</a>
                            <a href="javascript: void(0);">Contact Us</a>
                        </div>
                    </div>-->
                </div>
            </div>
        </footer>
    </div>
</div>
<!-- END wrapper -->
<script src="/assets/wxds/js/app.min.js"></script>
<script src="/assets/wxds/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/assets/wxds/js/vendor/jquery-jvectormap-world-mill-en.js"></script>
<script src="//lib.baomitu.com/layer/3.1.1/layer.js"></script>
<script src="//lib.baomitu.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//lib.baomitu.com/clipboard.js/1.7.1/clipboard.min.js"></script>
<script src="/assets/common/js/jquery.pjax.js"></script>
<script src="/assets/common/js/index.js"></script>
<script src="/assets/common/js/highlight.pack.js"></script>
<script src="/assets/common/fancybox/jquery.fancybox.min.js"></script>
<script src="/assets/wxds/js/main.js?v=<?php echo VERSION; ?>"></script>
<script type="text/javascript">
    if(isModal === undefined) var isModal=false;
    if(homepage === undefined) var homepage=false;
    if(is_app === undefined) var is_app=false;
    $(document).ready(function(){
        $(document).pjax('a:not(a[target=_blank],a[pjax=no])', '#pjax-container', {
            fragment:('#pjax-container'),
            timeout:5000,
            maxCacheLength:0,
            dataType:null,
        });
        $(document).on('submit', 'form', function(event) {
            $.pjax.submit(event, '#pjax-container',{
                fragment:'#pjax-container', timeout:5000
            });
        });
        $(document).on('pjax:send', function() {
            $(".loading").css("display", "block");
            //NProgress.start();
        });
        $(document).on('pjax:complete', function() {
            if(homepage === true){
                getcount();
            }
            document.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightBlock(block);
            });
            $(".loading").css("display", "none");
            //NProgress.done();
        });
        $("a[_action=invite]").parents('li').addClass("active");
        $("a[_action=invite]").addClass("active");
        if($("a[_action=invite]").parents('ul.collapse').length)$("a[_action=invite]").parents('ul.collapse').addClass('in');
        $(document).on("click","a[_action]",function(){
            $("a[_action]").parents('li').removeClass('active');
            $("a[_action]").removeClass('active');
            $(this).parents('li').addClass('active');
            $(this).addClass('active');
            if(!$(this).parents('ul.collapse').length)$('ul.collapse').removeClass('in');
        });
    });
</script>
</body>
</html>