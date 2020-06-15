<?php
if (!defined('IN_CRONLITE'))
    exit();
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
    <title><?php echo $conf['sitename'] ?> - 文章列表</title>
    <link href="<?php echo $cdnpublic ?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo $cdnpublic ?>font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/simple/css/plugins.css">
    <link rel="stylesheet" href="assets/simple/css/main.css">
    <script src="<?php echo $cdnpublic ?>modernizr/2.8.3/modernizr.min.js"></script>
    <!--[if lt IE 9]>
      <script src="<?php echo $cdnpublic ?>html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="<?php echo $cdnpublic ?>respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .onclick {
            cursor: pointer;
            touch-action: manipulation;
        }

        #msglist a:hover, a:active, a {
            text-decoration: none;
            display: block;
        }
    </style>
</head>
<body>
<br/>
<img src="<?php echo $background_image; ?>" alt="Full Background" class="full-bg full-bg-bottom animated pulse "
     ondragstart="return false;" oncontextmenu="return false;">
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-8 center-block" style="float: none;">
    <div class="block">
        <div class="block-title">
            <h2><i class="fa fa-list"></i>&nbsp;&nbsp;<b>文章列表</b></h2>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">搜索</div>
                <input type="text" name="kw" value="<?php echo isset($_GET['kw']) ? addslashes($_GET['kw']) : ''; ?>"
                       class="form-control" placeholder="输入关键词"
                       onkeydown="if(event.keyCode==13){doSearch.click()}" required/>
                <span class="input-group-addon btn" id="doSearch">
                    <span class="glyphicon glyphicon-search" title="搜索"></span>
                </span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <tbody id="msglist">
                <?php
                $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
                if ($page <= 0)
                    $page = 0;

                $limit = 6;

                $where = [];

                if (!empty($_GET['kw'])) {
                    $where['title[~]'] = $_GET['kw'];
                    $where['title[~]'] = $_GET['kw'];
                }

                $where['status'] = 1;

                $articleCount = $DB->count('article_list', $where);

                $where['LIMIT'] = [$page * $limit, $limit];
                $where['ORDER'] = ['id' => 'DESC'];

                $articleList = $DB->select('article_list', ['id', 'title', 'content', 'createTime'], $where);
                foreach ($articleList as $row) {
                    $info = strip_tags($row['content']);
                    if (mb_strlen($info) > 256)
                        $info = mb_substr($info, 0, 120) . '......';
                    ?>
                    <tr>
                        <td>
                            <a href="./route.php?s=index/<?php echo $row['id']; ?>.html" target="_blank">
                                <div>
                                    <b class="pull-left"><?php echo strip_tags($row['title']); ?></b>
                                    <small class="pull-right">
                                        <span class="text-muted"><?php echo $row['createTime']; ?></span>
                                    </small>
                                </div>
                                <br>
                                <p style="margin-bottom: 0;color: #6b6b6b;white-space: normal;word-break: break-all;word-wrap: break-word;">
                                    <?php echo $info; ?>
                                </p>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                if (count($articleList) == 0) {
                    echo '<tr><td class="text-center"><span class="text-muted">消息列表空空如也</span></td></tr>';
                }
                ?>
                </tbody>
            </table>
            <?php if ((($page + 1) * $limit) < $articleCount) { ?>
                <center>
                    <a href="./route.php?s=index/zy/&page=<?php echo $page + 1; ?><?php echo isset($_GET['kw']) ? ('&kw=' . urlencode($_GET['kw'])) : ''; ?>"
                       id="btnload">加载更多</a>
                </center>
            <?php } ?>
        </div>
        <hr>
        <div class="form-group">
            <a href="./" class="btn btn-primary btn-rounded"><i class="fa fa-home"></i>&nbsp;返回首页</a>
            <a href="./user/" class="btn btn-info btn-rounded" style="float:right;"><i class="fa fa-user"></i>&nbsp;用户中心</a>
        </div>
    </div>
</div>
<script src="<?php echo $cdnpublic ?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic ?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic ?>layer/2.3/layer.js"></script>
<script>
    var $_GET = (function () {
        var url = window.document.location.href.toString();
        var u = url.split("?");
        if (typeof (u[1]) == "string") {
            u = u[1].split("&");
            var get = {};
            for (var i in u) {
                var j = u[i].split("=");
                get[j[0]] = j[1];
            }
            return get;
        } else {
            return {};
        }
    })();
    $(document).ready(function () {
        if ($_GET['kw']) {
            $("input[name='kw']").val(decodeURIComponent($_GET['kw']))
        }
        $("#doSearch").click(function () {
            var kw = $("input[name='kw']").val();
            window.location.href = "/route.php?s=index/zy/&kw=" + encodeURIComponent(kw);
        });
    });
</script>
</body>
</html>