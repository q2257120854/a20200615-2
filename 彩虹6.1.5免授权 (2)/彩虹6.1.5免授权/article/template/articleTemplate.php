<?php
if (!defined('IN_CRONLITE'))
    exit();
if (empty($result)) {
    header('HTTP/1.1 404 Not Found');
    exit('404');
}
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width,user-scalable=0,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>

    <title><?php echo $result['seoTitle'] . ' - ' . $conf['sitename']; ?></title>

    <meta name="description" content="<?php echo $result['seoDescription']; ?>"/>
    <meta name="keywords" content="<?php echo $result['seoKeywords']; ?>"/>

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
        .article-content img {
            max-width: 100% !important;
        }
    </style>
</head>
<body>
<br/>
<img src="<?php echo $background_image; ?>" alt="Full Background" class="full-bg full-bg-bottom animated pulse "
     ondragstart="return false;" oncontextmenu="return false;">
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-5 center-block" style="float: none;">
    <div class="block">
        <div class="block-title">
            <h2><i class="fa fa-list"></i>&nbsp;&nbsp;<b>文章内容</b></h2>
        </div>
        <ol class="breadcrumb">
            <li>
                <a href="./">首页</a>
            </li>
            <li>
                <a href="./route.php?s=index/zy/">文章列表</a>
            </li>
            <li class="active"><?php echo $result['title'] ?></li>
        </ol>
        <div class="text-center">
            <h3><strong><?php echo $result['title'] ?></strong></h3>
            <span class="text-muted"><?php echo $result['createTime'] ?></span>
        </div>
        <hr/>
        <div class="article-content">
            <?php echo $result['content']; ?>
        </div>
        <div style="margin-bottom: 10px;margin-top: 10px;">
            <p style="margin: 0;">
                上一篇：<?php echo empty($downResult) ? '没有了~' : ('<a href="./route.php?s=index/' . $downResult['id'] . '.html">' . $downResult['title'] . '</a>'); ?>
            </p>
            <p style="margin: 0;">
                下一篇：<?php echo empty($upResult) ? '没有了~' : ('<a href="./route.php?s=index/' . $upResult['id'] . '.html">' . $upResult['title'] . '</a>'); ?>
            </p>
        </div>
        <hr/>
        <div class="form-group">
            <a href="./" class="btn btn-primary btn-rounded"><i class="fa fa-home"></i>&nbsp;返回首页</a>
            <a href="./route.php?s=index/zy/" class="btn btn-info btn-rounded" style="float:right;"><i
                        class="fa fa-list"></i>&nbsp;返回列表</a>
        </div>
    </div>
</div>
<script src="<?php echo $cdnpublic ?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic ?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic ?>layer/2.3/layer.js"></script>
</body>
</html>

<!---->
<!--<!DOCTYPE HTML>-->
<!--<html>-->
<!--<head>-->
<!--    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>-->
<!--    <meta name="viewport"-->
<!--          content="width=device-width,user-scalable=0,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>-->
<!--    <meta name="apple-mobile-web-app-capable" content="yes"/>-->
<!--    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>-->
<!--    <meta name="format-detection" content="telephone=no"/>-->
<!--    <title>--><?php //echo $result['seoTitle']; ?><!--</title>-->
<!--    <meta name="description" content="--><?php //echo $result['seoDescription']; ?><!--"/>-->
<!--    <meta name="keywords" content="--><?php //echo $result['seoKeywords']; ?><!--"/>-->
<!--    <link href="/article/resource/style.css" rel="stylesheet" type="text/css"/>-->
<!--    <link href="/article/resource/mcss.css" rel="stylesheet" type="text/css"/>-->
<!---->
<!--    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css"-->
<!--          type="text/css"/>-->
<!--    <link rel="stylesheet" href="/article/resource/two.css" type="text/css"/>-->
<!---->
<!--    <script src="https://cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>-->
<!--    <style type="text/css">-->
<!--        #fan .img a img {-->
<!--            width: 370px;-->
<!--        }-->
<!---->
<!--        .lastone {-->
<!--            width: 100%;-->
<!--            height: 100%;-->
<!--            position: fixed;-->
<!--            left: 0;-->
<!--            top: 0;-->
<!--            z-index: 188888;-->
<!--            background: black;-->
<!--            display: none;-->
<!--        }-->
<!---->
<!--        p img {-->
<!--            width: 320px;-->
<!--            height: 180px;-->
<!--        }-->
<!---->
<!--        body {-->
<!--            height: auto;-->
<!--        }-->
<!--    </style>-->
<!--</head>-->
<!--<body>-->
<!--<header>-->
<!--    <div class="headtt">-->
<!--        <form method="Get" action="search" style="height: 50px;">-->
<!--            <input name="kw" type="text" class="keyword" autocomplete="off" value=""-->
<!--                   style=" width: 77%; height: 29px; margin-left: 20px;  margin-top: 11px; ">-->
<!--            <input type="submit" class="aaa" value="搜索"-->
<!--                   style="    margin-top: 12px;background: rgba(153, 153, 153, 0.71);width: 50px; height: 30px;">-->
<!---->
<!--        </form>-->
<!--        <a href="/" style="padding-left: 20px;"><img-->
<!--                    src="data:image/gif;base64,R0lGODlhVAEoAPf/AJ1ilgKc5gGi6wMiMLzG5MLM6cK3AgJVfQKe6AGk7S+SzmkRCgKZ5AJ8uK6uYLWrAgJpmyyRNAaN1P7jAAKT3gJdimtra/Hw8AJzqdzZ2ufl5QKY4wMEBaq12C51i7W2yre1tc20tAGZ5EuUyWtlAgGi6gJAX8bF2CFkJYOLsgKg6jSqPAGW4gKY5LnB3oyDAgKR3PPfAKesyZmUAu/K0QKBvAKKy////7W71SopKk9kbykmA1CLegM/XfTo7IZTcwGU4Kq75WNnioyKinx1AgGY49zXXtnU3tTN2aKjuJyPAsbQ7DFreKqoptrNzBqMyFOHsVlSAgGY5FaajNTMNlhZWMS5wpKcJf7u9MjT8pe51RZ6rCuTr8HJ5tzKAQNKbQKS2AKa5R+U1gMXH5igxCRCUnOp17+cnAKExVeCVwyEwnWKNgJDYQuMzz+LjBiGuG2XzAKi6wKW4AGb5gKP1hWTzA2T2gGg6QGW4P/z+P/1AP74+VY6UAIsQP/x946Zv+jf5QuP1gGV2puZp8rS3AWU3gJNcT84PwJwqENDQ0ZPZ3lIc4ik0gKT35+u2rGuvSlXdMPCwgJhjqemFVhHVwJtnw99tpaUjwM2TweR2Xp4FsPG4b+0Cv76MgKg6OW9xGdzfBZtmxGO0rx6tuLOAAKHyAGc6Le4HMzExyFymsWBv3JqZgGY3QSS3P/8/B5XeZ674R9CKRpiiQJ3rQ9zqASV4BlZaBYiMA+KyQGe6AGd5wGc5gGf6QGh6wGg6gGh6gGc583GAs/OzgGf6JuamtG/AQKd5+/nAQGe5wGe6eTcAejVANnRAQKe50M/A6qcAaehAgKV4gGf6n18fQKf6QGd5gKb5gGV4QGg6wGb5d3f5cLO7fbx729zFfLhGqav0tPAvsrK3zm9R11vNaauIcKrrLSsEhY5TmqJs/b19WFlaGyfbweHy1ufz+Pn9FFbT0ZqT6vF3LHA7LnH8LzZ7QKV4fz7+wKW4gKV4AKX4gGj7P7pAAKW4frxAQKU4P///yH/C05FVFNDQVBFMi4wAwEAAAAh/wtYTVAgRGF0YVhNUDw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NzlFRTQyMzFFMEZGMTFFOUIxQzFCMzA5QTVGNUE4NEIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NzlFRTQyMzJFMEZGMTFFOUIxQzFCMzA5QTVGNUE4NEIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo3OUVFNDIyRkUwRkYxMUU5QjFDMUIzMDlBNUY1QTg0QiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo3OUVFNDIzMEUwRkYxMUU5QjFDMUIzMDlBNUY1QTg0QiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PgH//v38+/r5+Pf29fTz8vHw7+7t7Ovq6ejn5uXk4+Lh4N/e3dzb2tnY19bV1NPS0dDPzs3My8rJyMfGxcTDwsHAv769vLu6ubi3trW0s7KxsK+urayrqqmop6alpKOioaCfnp2cm5qZmJeWlZSTkpGQj46NjIuKiYiHhoWEg4KBgH9+fXx7enl4d3Z1dHNycXBvbm1sa2ppaGdmZWRjYmFgX15dXFtaWVhXVlVUU1JRUE9OTUxLSklIR0ZFRENCQUA/Pj08Ozo5ODc2NTQz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"-->
<!--                    alt=""></a>-->
<!--    </div>-->
<!--</header>-->
<!--<div id="wrapper">-->
<!---->
<!--    <div class="xxtop">-->
<!--        <h1>--><?php //echo $result['title']; ?><!--</h1>-->
<!--        <p class="info">作者：--><?php //echo $result['author'] ?><!--&nbsp;发布于：--><?php //echo $result['createTime']; ?><!--</p>-->
<!--        <div class="nr">-->
<!---->
<!--            --><?php //echo $result['content']; ?>
<!---->
<!--            <P style="font-size: 16px;margin-bottom: 15px;">-->
<!--                上一篇：--><?php //echo empty($downResult) ? '没有了~' : ('<a href="./route.php?s=index/' . $downResult['id'] . '.html">' . $downResult['title'] . '</a>'); ?><!-- </P>-->
<!--            <P style="font-size: 16px;margin-bottom: -20px;">-->
<!--                下一篇：--><?php //echo empty($upResult) ? '没有了~' : ('<a href="./route.php?s=index/' . $upResult['id'] . '.html">' . $upResult['title'] . '</a>'); ?><!-- </P>-->
<!--        </div>-->
<!--        <div class="lastone">-->
<!--            <img src="" style="width: 100%;">-->
<!--        </div>-->
<!---->
<!--        <div class="zzs1"></div>-->
<!--    </div>-->
<!---->
<!--    <div class="xxtop">-->
<!--        <style>-->
<!--            .article {-->
<!--                padding: 16px 10px;-->
<!--                overflow: hidden;-->
<!--                max-height: 450px;-->
<!--                min-height: 160px;-->
<!--            }-->
<!---->
<!--            .item-1 {-->
<!--                width: 100%;-->
<!--                border-bottom: 1px solid #999;-->
<!--                margin-bottom: 10px;-->
<!--            }-->
<!---->
<!--            .item-1 > a {-->
<!--                display: block;-->
<!--            }-->
<!---->
<!--            .item-1 h4 {-->
<!--                font-family: 'Microsoft YaHei', serif;-->
<!--                font-size: 16px;-->
<!--                margin-bottom: 6px;-->
<!--                color: #3d3d3d;-->
<!--                display: inline-block;-->
<!--                overflow: hidden;-->
<!--                text-overflow: ellipsis;-->
<!--                word-wrap: break-word;-->
<!--                white-space: nowrap !important;-->
<!--            }-->
<!---->
<!--            .item-1:last-child {-->
<!--                border-bottom: none;-->
<!--            }-->
<!---->
<!--            .info-box {-->
<!--                display: inline-block;-->
<!--                float: right;-->
<!--                font-size: 13px;-->
<!--            }-->
<!---->
<!--            .item-1 .info-content {-->
<!--                white-space: normal;-->
<!--                word-break: break-all;-->
<!--                word-wrap: break-word;-->
<!--                color: #6b6b6b;-->
<!--            }-->
<!---->
<!--            .info-box .createTime {-->
<!--                display: none;-->
<!--            }-->
<!---->
<!--            .info-box:hover .readCount {-->
<!--                display: none;-->
<!--            }-->
<!---->
<!--            .info-box:hover .createTime {-->
<!--                display: inline-block;-->
<!--            }-->
<!---->
<!--            .hide-article-box {-->
<!--                position: relative;-->
<!--                z-index: 1998;-->
<!--                padding-top: 155px;-->
<!--                bottom: 15px;-->
<!--                margin-top: -207px;-->
<!--                width: 100%;-->
<!--                background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(255, 255, 255, 0)), color-stop(70%, #fff));-->
<!--                background-image: linear-gradient(-180deg, rgba(255, 255, 255, 0) 0%, #fff 70%);-->
<!--                padding-bottom: 26px;-->
<!--            }-->
<!---->
<!--            @media screen and (max-width: 767px) {-->
<!--                .item-1 h4 {-->
<!--                    max-width: 240px;-->
<!--                }-->
<!---->
<!--                .item-1 .info-content {-->
<!--                    color: #6b6b6b;-->
<!--                    overflow: hidden;-->
<!--                    text-overflow: ellipsis;-->
<!--                    word-wrap: break-word;-->
<!--                    white-space: nowrap !important;-->
<!--                }-->
<!--            }-->
<!--        </style>-->
<!--        --><?php
//        $contents = $DB->select('article_list', ['title', 'content', 'id', 'createTime'], ['status' => 1, 'ORDER' => ['id' => 'DESC'], 'LIMIT' => 10]);
//        foreach ($contents as $content):
//            $info = strip_tags($content['content']);
//            if (mb_strlen($info) > 256)
//                $info = mb_substr($info, 0, 90) . '......';
//            ?>
<!--            <div class="item-1">-->
<!--                <a target="_blank" href="./route.php?s=index/--><?php //echo $content['id'] . '.html'; ?><!--">-->
<!--                    <h4>--><?php //echo strip_tags($content['title']); ?><!--</h4>-->
<!--                    <div class="info-box text-muted">-->
<!--                        <span class="createTime">--><?php //echo substr($content['createTime'], 0, 10); ?><!--</span>-->
<!--                        <span class="readCount">阅读数 1万+</span>-->
<!--                    </div>-->
<!--                    <p class="info-content" style="font-size: 12px;">--><?php //echo $info; ?><!--</p>-->
<!--                </a>-->
<!--            </div>-->
<!--        --><?php //endforeach; ?>
<!--    </div>-->
<!---->
<!--    <div class="fanhui"><a href="/">查看更多信息></a></div>-->
<!--</div>-->
<!--<script type="text/javascript">-->
<!--    $(function () {-->
<!--        $('.img a').find('img').removeAttr('style');-->
<!--        $('.img a').find('img').addAttr('style', 'max-width:375px');-->
<!--    });-->
<!--</script>-->
<!--<script type="text/javascript">-->
<!--    $("p img").click(function () {-->
<!--        $(".lastone").show();-->
<!--        var href = $(this).attr("src");-->
<!--        $(".lastone img").attr("src", href);-->
<!--        var one = $("body").height();-->
<!--        var two = $(".lastone img").height();-->
<!--        var top = (one - two) / 10 + "px";-->
<!--        console.log($("body").height());-->
<!--        $(".lastone img").css("marginTop", top)-->
<!---->
<!--    });-->
<!---->
<!--    $(".lastone").click(function (a) {-->
<!--        var three = $(a.target).is(".lastone img");-->
<!--        if (three) {-->
<!--            $(".lastone").hide()-->
<!--        } else {-->
<!--            $(".lastone").show()-->
<!--        }-->
<!--    });-->
<!--</script>-->
<!--<div class="footer">-->
<!--    <!--    信息举报邮箱：jb@-->--><?php ////echo $_SERVER['SERVER_NAME']; ?><!--<!-- <BR>-->-->
<!--    Copyright &copy;2008---><?php //echo date('Y') . '  ' . $_SERVER['SERVER_NAME']; ?><!-- All Rights Reserved.-->
<!--</div>-->
<!--</body>-->
<!--</html>-->