<?php
if (!defined('IN_CRONLITE')) exit();
if ($_GET['buyok'] == 1) {
    include_once TEMPLATE_ROOT . 'table/query.php';
    exit;
}
if (isset($_GET['tid'])) {
    include_once TEMPLATE_ROOT . 'table/buy.php';
    exit;
}
$tcount = $DB->count('tools', ['active' => 1]);
$num    = 0;
$flag   = 0;
if ($islogin2 == 1) {
    $price_obj = new Price($userrow['zid'], $userrow);
} elseif ($is_fenzhan == true) {
    $price_obj = new Price($siterow['zid'], $siterow);
} else {
    $price_obj = new Price(1);
}
$classhide = explode(',', $siterow['class']);

$rs         = $DB->select('class', '*', ['active' => 1, 'ORDER' => ['sort' => 'ASC']]);
$shua_class = array();
foreach ($rs as $res) {
    if ($is_fenzhan && in_array($res['cid'], $classhide))
        continue;
    $shua_class[$res['cid']] = $res['name'];
}
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
    <title><?php echo $conf['sitename'] ?> - <?php echo $conf['title'] ?></title>
    <meta name="keywords" content="<?php echo $conf['keywords'] ?>">
    <meta name="description" content="<?php echo $conf['description'] ?>">
    <link href="<?php echo $cdnpublic ?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo $cdnpublic ?>font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link type="text/css" href="/assets/user/css/load.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo $cdnserver ?>assets/css/common.css?ver=<?php echo VERSION ?>">
    <!--[if lt IE 9]>
    <script src="<?php echo $cdnpublic ?>html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="<?php echo $cdnpublic ?>respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body {
            background: #ecedf0 url("<?php echo $background_image?>") fixed;
        <?php echo $repeat?>
        }
    </style>
</head>
<body>
<div class="loading-back" id="sk-three-bounce">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<div class="modal fade" align="left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $conf['sitename'] ?></h4>
            </div>
            <div class="modal-body">
                <?php echo $conf['modal'] ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">知道了</button>
            </div>
        </div>
    </div>
</div>

<div class="navbar navbar-default navbar-fixed-top affix" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only"><?php echo $conf['sitename'] ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./"><?php echo $conf['sitename'] ?></a>
            <p class="navbar-text pull-left text-muted hidden-xs hidden-sm">
                <small class="text-muted text-sm"><em><?php echo $_SERVER['HTTP_HOST'] ?></em></small>
            </p>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="active">
                    <a href="./">
                        <span class="glyphicon glyphicon-home"></span>&nbsp;下单首页
                    </a>
                </li>
                <li class="">
                    <a href="./?mod=query">
                        <span class="glyphicon glyphicon-search"></span>&nbsp;查询订单
                    </a>
                </li>
                <?php if ($conf['fenzhan_buy'] == 1) { ?>
                    <li class="">
                        <a href="./user/">
                            <span class="glyphicon glyphicon-cog"></span>&nbsp;分站后台
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<div class="container" style="margin-top: 60px">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    <h3 class="panel-title"><a data-toggle="collapse" href="#collapseA">公告</a></h3>
                </div>
                <div id="collapseA" class="panel-collapse collapse in">
                    <?php echo $conf['anounce'] ?> </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?php foreach ($shua_class as $cid => $classname) { ?>
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        <h3 class="panel-title">
                            <a data-toggle="collapse"
                               href="#collapse<?php echo $cid ?>"><?php echo $classname ?>
                            </a>
                        </h3>
                    </div>
                    <div id="collapse<?php echo $cid ?>" class="panel-collapse collapse in">
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <?php
                            $rs = $DB->select('tools', '*', ['AND' => ['cid' => $cid, 'active' => 1], 'ORDER' => ['sort' => 'ASC']]);
                            foreach ($rs as $res) {
                                $num++;
                                if (isset($price_obj)) {
                                    $price_obj->setToolInfo($res['tid'], $res);
                                    if ($price_obj->getToolDel($res['tid']) == 1) continue;
                                    $price = $price_obj->getToolPrice($res['tid']);
                                } else {
                                    $price = $res['price'];
                                }
                                ?>
                                <tr>
                                    <td><?php echo $res['name']; ?></td>
                                    <td class="text-center"><b style="color: #ff3333;"><?php echo $price; ?></b>元<span
                                                style="color: #ff3333;"><?php echo $res['value'] ? $res['value'] : 1; ?></span>个
                                    </td>
                                    <td class="text-center"><?php echo $res['is_curl'] == 4 ? '<a href="./?cid=' . $cid . '&tid=' . $res['tid'] . '" class="btn btn-success btn-xs" style="background:#4faf1b">自动发卡</a>' : '<a href="./?cid=' . $cid . '&tid=' . $res['tid'] . '" class="btn btn-danger btn-xs" style="background:#ff803a">自动充值</a>'; ?></td>

                                </tr>
                                <?php
                                if ($num == intval($tcount / 3) || $num == intval($tcount / 3 * 2))
                                    $flag = 1;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                if ($flag == 1) {
                    echo '</div><div class="col-md-4">
';
                    $flag = 0;
                }
            } ?>
        </div>
    </div>

    <p style="text-align:center"><span style="font-weight:bold">CopyRight <i
                    class="fa fa-heart text-danger"></i> 2019 <a href="/"><?php echo $conf['sitename'] ?></a></span></p>

    <ul class="layui-fixbar" id="alert_cart" style="display:none;">
        <li class="layui-icon" style="background-color:#3e4425db" onclick="window.location.href='./?mod=cart'"><i
                    class="fa fa-shopping-cart"></i>
            <div class="nav-counter" id="cart_count"></div>
        </li>
    </ul>

    <!--音乐代码-->
    <div id="audio-play" <?php if (empty($conf['musicurl'])){ ?>style="display:none;"<?php } ?>>
        <div id="audio-btn" class="on" onclick="audio_init.changeClass(this,'media')">
            <audio loop="loop" src="<?php echo $conf['musicurl'] ?>" id="media" preload="preload"></audio>
        </div>
    </div>
    <!--音乐代码-->

    <script src="<?php echo $cdnpublic ?>jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo $cdnpublic ?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo $cdnpublic ?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="<?php echo $cdnpublic ?>layer/2.3/layer.js"></script>

    <script type="text/javascript">
        var isModal =<?php echo empty($conf['modal']) ? 'false' : 'true';?>;
        var homepage = true;
        var hashsalt =<?php echo $addsalt_js?>;
    </script>
    <script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
    <script src="/assets/user/js/load.js"></script>
</body>
</html>