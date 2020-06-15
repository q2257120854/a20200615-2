<?php
if (!defined('IN_CRONLITE')) exit;
$get_tid = isset($_GET['tid']) ? $_GET['tid'] : 0;
if (empty($get_tid)) {
    $invite_list = $DB->select('invite_rules', [
        '[><]tools' => ['tid' => 'tid']
    ], ['tools.tid', 'tools.cid', 'tools.name', 'tools.shopimg', 'invite_rules.type', 'invite_rules.status',
        'invite_rules.is_default', 'invite_rules.rule_value'], [
        'invite_rules.status' => 1,
        'tools.active' => 1,
        'ORDER' => ['is_default' => 'DESC', 'id' => 'ASC']
    ]);
} else {
    $invite_list = $DB->get('invite_rules', [
        '[><]tools' => ['tid' => 'tid']
    ], ['tools.tid', 'tools.cid', 'tools.name', 'tools.shopimg', 'invite_rules.type', 'invite_rules.status',
        'invite_rules.is_default', 'invite_rules.rule_value'], [
        'tools.tid' => $get_tid,
        'invite_rules.status' => 1,
        'tools.active' => 1,
        'ORDER' => ['is_default' => 'DESC', 'id' => 'ASC']
    ]);
}
$invite_row = isset($invite_list[0]) ? $invite_list[0] : [];
if (!$invite_list) exit('<script>alert("当前站点未开启推广链接功能或赠送商品ID不存在，请重新配置");location.href="./";</script>');
?>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $conf['sitename'] ?> - 推广链接生成</title>
    <link rel="stylesheet" href="/assets/uiskin/css/slick.min.css">
    <link rel="stylesheet" href="/assets/uiskin/css/slick-theme.min.css">
    <link rel="stylesheet" href="<?php echo $cdnserver ?>assets/simple/css/oneui.css">
    <style>body {
            background: linear-gradient(to bottom, #49BDAD, #6a67c7) fixed;
        }</style>
    <link rel="stylesheet" href="/assets/layer/2.3/skin/layer.css" id="layui_layer_skinlayercss" style="">
</head>
<body style="background-color:#ffffff;">
<div style="padding-top:6px;">
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-4 center-block" style="float: none;">
        <div class="block" style="box-shadow:0 5px 10px 0 rgba(0, 0, 0, 0.25);">
            <a class="btn btn-block" href="javascript:" onclick="history.go(-1);"><i class="fa fa-mail-reply-all"></i> 返回网站首页</a>
        </div>
        <div class="block" style="box-shadow:0 5px 10px 0 rgba(0, 0, 0, 0.25);">
            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs">
                <li class="active" style="width:50%"><a href="#share" data-toggle="tab"
                                                        aria-expanded="true">
                        <center><i class="fa fa-share-alt"></i> 推广奖励</center>
                    </a></li>
                <li style="width:50%" class=""><a href="#query" data-toggle="tab"
                                                  aria-expanded="false">
                        <center><i class="fa fa-search"></i> 进度查询</center>
                    </a></li>
            </ul>

            <div class="block-content">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="share">
                        <div class="alert alert-warning shuaibi-tip" id="shuaibi_tips" style="font-size: 13px;display: none;">
                        </div>
                        <div class="form-group">
                            <?php include 'shop.invite.php'; ?>
                        </div>
                        <div class="row text-center">
                        <?php foreach ($invite_list as $k => $v): ?>
                            <?php if (($k + 1) % 3 == 0): ?>
                            <div class="row text-center">
                            <?php endif; ?>
                                <div class="col-xs-6 col-sm-4 col-md-4">
                                    <ul class="list-group">
                                        <li class="list-group-item" style="padding: 3px;text-align: left;">
                                            <label class="css-input css-radio css-radio-primary"
                                                   style="font-size: 14px;display: inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                                                <input type="radio" class="goods-select" name="type"
                                                       data-tid="<?php echo $v['tid']; ?>"
                                                       data-cid="<?php echo $v['cid']; ?>"
                                                       data-rule_value="<?php echo $v['rule_value']; ?>"
                                                       data-type="<?php echo $v['type']; ?>" value="<?php echo $v['tid']; ?>"><span></span>
                                                <img src="<?php echo !empty($v['shopimg']) ? $v['shopimg'] : '/assets/img/Product/default.png'; ?>"
                                                     alt="shopImg" width="18px">
                                                <?php echo $v['name']; ?>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            <?php if (($k + 1) % 3 == 0): ?>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit_sub" value="立即生成推广链接"
                                   class="btn btn-primary btn-block"
                                   style="background-color: #7266ba; border-color: #7266ba;">
                            <div id="resulturl" style="display:none;">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="query">
                        <div class="form-group">
                            <div class="alert alert-warning shuaibi-tip" style="font-size: 13px;">
                                提示：输入获取推广信息时填写的相关信息，即可查询进度<br><br>
                                注意：推广邀请人数每天都会进行刷新，当天推广只限当天邀请人数
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        推广相关信息
                                    </div>
                                    <input type="text" name="qq" id="qq" class="form-control"
                                           placeholder="输入获取的相关信息，查询推广进度" required="required"
                                           onkeydown="if(event.keyCode==13){submit_sub.click()}">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" id="submit_query2" value="立即查询"
                                       class="btn btn-primary btn-block"
                                       style="background-color: #7266ba; border-color: #7266ba;">
                            </div>
                            <div id="query_msg" style="display:none;margin: 6px auto"></div>
                            <div id="result" class="form-group" style="display:none;">
                                <div class="table-responsive">
                                    <table class="table table-vcenter table-condensed table-striped">
                                        <thead>
                                        <tr>
                                            <th>奖励名称</th>
                                            <th>获利条件</th>
                                            <th colspan="2">进度</th>
                                        </tr>
                                        </thead>
                                        <tbody id="list" style="font-size: 13px;">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block block-themed" style="box-shadow:0 5px 10px 0 rgba(0, 0, 0, 0.25);">
            <div class="block-header bg-amethyst"
                 style="background-color: #6a67c7; border-color: #6a67c7; padding: 10px 10px;">
                <h3 class="block-title">推广统计</h3>
            </div>
            <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                <div class="row text-center">
                    <div class="col-xs-4">
                        <div class="text-center text-muted">领取ＱＱ</div>
                    </div>
                    <div class="col-xs-4">
                        <div class="text-center text-muted">完成时间</div>
                    </div>
                    <div class="col-xs-4">
                        <div class="text-center text-muted">获得奖励</div>
                    </div>
                </div>
            </div>
            <marquee class="zmd" behavior="scroll" direction="UP" onmouseover="this.stop()" onmouseout="this.start()"
                     scrollamount="5" style="height:16em">
                <table class="table table-hover table-striped" style="text-align:center">
                    <thead style="font-size: 14px;"></thead>
                </table>
            </marquee>
        </div>
    </div>
</div>
<script src="<?php echo $cdnpublic ?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic ?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnserver ?>assets/appui/js/app.js"></script>
<script src="/assets/uiskin/js/slick.min.js"></script>
<script src="/assets/uiskin/js/Chart.min.js"></script>
<script src="/assets/layer/2.3/layer.js"></script>
<script src="<?php echo $cdnpublic ?>clipboard.js/1.7.1/clipboard.min.js"></script>

<script src="<?php echo $cdnpublic ?>jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<script src="<?php echo $cdnpublic ?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnserver ?>assets/js/pace.min.js"></script>

<script>
    var isModal = <?php echo empty($conf['modal']) ? 'false' : 'true'; ?>;
    var homepage = false;
    var hashsalt = <?php echo $addsalt_js; ?>;

    var tid = <?php echo empty($invite_row['tid']) ? 0 : intval($invite_row['tid']); ?>;
    var cid = <?php echo empty($invite_row['cid']) ? 0 : intval($invite_row['cid']); ?>;

    $(function () {
        $("img.lazy").lazyload({effect: "fadeIn"});
    });
</script>
<script src="assets/js/main.invite.js?ver=<?php echo VERSION ?>"></script>
<script type="text/javascript">
    function random(min, max) {
        return Math.floor(Math.random() * (max - min)) + min;
    }

    var dataList = [
        {
            url: 'http://img.eo1.cn/imgs/2019/08/53b8885728cc04c7.png',
            name: '超级会员'
        },
        {
            url: 'http://img.eo1.cn/imgs/2019/08/08e7dfb53be63d34.png',
            name: '视频会员'
        },
        {
            url: 'http://img.eo1.cn/imgs/2019/08/a9252c590b74eebe.jpg',
            name: '44449名片赞'
        },
        {
            url: 'http://img.eo1.cn/imgs/2019/08/33776160c2c42ef2.png',
            name: '豪华黄钻'
        },
        {
            url: 'http://img.eo1.cn/imgs/2019/08/aa1ca390fb31ed10.png',
            name: '豪华绿钻'
        }
    ];

    var LotteryListDom = $('.zmd>table>thead');
    for (var i = 0; i < 60; i++) {
        appendLotteryResult();
    }

    function appendLotteryResult() {
        var d = new Date();
        var nowTime = d.getFullYear() + "年" + (d.getMonth() + 1) + "月" + d.getDate() + "日";
        nowTime += ' 星期' + '日一二三四五六'.charAt(new Date().getDay());

        var tagData = dataList[random(0, dataList.length)];

        LotteryListDom.append(`<tr><td>QQ${random(100, 999)}***${random(100, 999)}**</td><td>于 ${nowTime} 推广成功</td><td><span style="color:salmon;">奖励  <img src="${tagData['url']}" width="15" /> ${tagData['name']}</span></td></tr>`);
    }

    setInterval(function () {
        appendLotteryResult();
    }, 1500);

    $('.product-img').on('error', function () {
        $(this).attr('src', '/assets/img/Product/default.png');
    });
    var clipboard = new Clipboard('#copyurl');
    clipboard.on('success', function (e) {
        layer.msg('复制成功！');
    });
    clipboard.on('error', function (e) {
        layer.msg('复制失败，请长按链接后手动复制');
    });
    var clipboard = new Clipboard('#copycontent');
    clipboard.on('success', function (e) {
        layer.msg('复制成功！');
    });
    clipboard.on('error', function (e) {
        layer.msg('复制失败，请长按选中后手动复制');
    });

    // 商品选中
    $(".goods-select").change(function () {
        tid = $(this).val();
        const attr_data = $(this).data();
        $('#cid').val(attr_data["cid"]);
        $('#tid').empty().val(tid.toString());
        if (parseInt(attr_data["type"]) === 0) {
            $("#shuaibi_tips").show().text(`用户访问并购买商品金额达到 ${attr_data["rule_value"]} 后，即可获得商品`);
        } else {
            $("#shuaibi_tips").show().text(`访问推广链接达到 ${parseInt(attr_data["rule_value"])} 人，即可获得商品`);
        }
        $("#cid").change();
    });

    function submit_invite(data) {

        let post_data = {hashsalt: hashsalt};
        if (tid !== '' && tid !== undefined) {
            post_data['tid'] = tid;
        }
        var type = $('.goods-select:checked').val();
        if (type == null) {
            layer.alert('请选择商品！');
            return false;
        }
        post_data['tid'] = type;
        Object.assign(post_data, data);
        var ii = layer.load(1, {shade: [0.1, '#fff']});
        $.ajax({
            type: 'POST',
            url: 'ajax.php?act=inviteurl',
            data: post_data,
            timeout: 5000,
            dataType: 'json',
            async: true,
            success: function (json) {
                layer.close(ii);
                if (json.code === 1) {
                    var value = '特价名片赞0.1元起刷，免费领名片赞，免费拉圈圈99+，空间人气、刷钻、名片赞、空间访问、KF双击、全民K歌、音乐视频，链接：' + json.url + ' (请复制链接到浏览器打开)';
                    $('#resulturl').html('<br><div class="list-group-item list-group-item-warning"><i class="fa fa-check-circle-o"></i>&nbsp;生成链接成功，请复制以下内容进行推广！</div><div class="well well-sm">老铁，我的网址现在送一万名片赞，超级会员，腾讯视频会员你还不赶快来领取。<br>真的免费，而且一次性送四个（窝窝头?），一毛钱都不需要，你还不点击下方链接看看，不然太不够意思了吧！<br><br>链接：' + json.msg + '<br>(☝☝点击它，生成你的专属链接你也可以领取☝☝)</div><center><button class="btn btn-warning btn-sm" data-clipboard-text="' + json.msg + '" id="copyurl">一键复制链接</button>&nbsp;<button class="btn btn-success btn-sm" data-clipboard-text="' + value + '" id="copycontent">一键复制广告语</button></center>');
                } else if (json.code === -1) {
                    layer.msg(json.msg);
                    return false;
                } else if (json.code === 2) {
                    var value = '特价名片赞0.1元起刷，免费领名片赞，免费拉圈圈99+，空间人气、刷钻、名片赞、空间访问、KF双击、全民K歌、音乐视频，链接：' + json.url + '(请复制链接到浏览器打开)';
                    $('#resulturl').html('<br><div class="list-group-item list-group-item-warning"><i class="fa fa-info-circle"></i>&nbsp;您已生成过链接，请复制以下内容进行推广！</div><div class="col-xs-12 well well-sm">特价名片赞0.1元起刷<br>免费领名片赞，免费拉圈圈99+<br>空间人气、刷钻、名片赞、空间访问、KF双击、全民K歌、音乐视频、等等..<br>' + json.url + '<br>(请复制链接到浏览器打开)</div><center><button class="btn btn-warning btn-sm" data-clipboard-text="' + json.url + '" id="copyurl">一键复制链接</button>&nbsp;<button class="btn btn-success btn-sm" data-clipboard-text="' + value + '" id="copycontent">一键复制广告语</button></center>');
                } else {
                    $('#resulturl').html('<br><div class="list-group-item list-group-item-warning"><i class="fa fa-close"></i>&nbsp;生成链接失败</div><div class="well well-sm">' + json.msg + '</div>');
                }
                $('#resulturl').slideDown();
            },
            error: function () {
                layer.close(ii);
                layer.alert('加载失败，请稍后再试！');
            }
        });
    }
</script>
<script>
    $('#submit_query2').click(function () {
        var input = $('#qq').val();
        if (input === '') {
            layer.alert('请输入数据！');
            return false;
        }
        $('#result').hide();
        $('#list').html('');
        var ii = layer.load(1, {shade: 0.2});
        $.ajax({
            url: './ajax.php?act=invite_query',
            data: {input: input},
            dataType: 'json',
            success: function (data) {
                layer.close(ii);
                if (data.code === 0) {
                    var html = '<div class="list-group-item list-group-item-success">';
                    html += '<i class="fa fa-check-circle-o"></i>&nbsp;';
                    html += '查询任务进度成功，手机用户可以左右滑动！';
                    html += '</div>';
                    html += '</center>';
                    $("#query_msg").html(html);
                    var status = "";
                    var item = data["data"];
                    if (item["info"] === "") {
                        status = '<font color=orange>正在推广中</font>';
                    } else {
                        if (parseInt(item["info"]["status"]) === 1)
                            status = '<font color=green>推广成功，请前往首页查询奖励信息</font>';
                        else
                            status = '<font color=orange>正在推广中</font>';
                    }
                    $("#list").append('<tr tid=' + item["tid"] + '><td>' + item["name"] + '</td><td>' + (parseInt(item["rules"]["type"]) === 1 ? '累计访问 ' : '下单满金额 ') + (parseInt(item["rules"]["type"]) === 1 ? (parseInt(item["rules"]["rule_value"]) + ' 人') : ('￥' + item["rules"]["rule_value"])) + '</td><td>已有' + item.count + '人</td><td>' + status + '</td></tr>');
                    $("#result").slideDown();
                } else {
                    $('#query_msg').html('<div class="list-group-item list-group-item-warning"><i class="fa fa-close"></i>&nbsp;查询进度失败</div><div class="well well-sm">' + data["msg"] + '<\/div>');
                }
                $('#query_msg').slideDown();
            },
            error: function () {
                layer.close(ii);
                layer.alert('加载失败，请稍后再试！');
            }
        });

    });
</script>
</body>
</html>