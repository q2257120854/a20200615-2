<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport"
          content="width=device-width,user-scalable=0,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>关于 <?php echo strip_tags($_GET['kw']) ?> 信息列表</title>
    <link href="/article/resource/mcss.css" rel="stylesheet" type="text/css">
    <style>
        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 20px 0;
            border-radius: 4px;
        }
        .pagination>li {
            display: inline;
        }
        .pagination > li > a, .pagination > li > span {
            font-weight: 500;
            color: #5ccdde;
            margin-left: 5px;
            margin-right: 5px;
            border: none !important;
            border-radius: 3px !important;
            background: transparent;
        }
        .pagination>li>a, .pagination>li>span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #337ab7;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        .pagination>li>a{
            color: #7c62ad;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <div id="header">
        <a href="javascript:history.go(-1)" class="back"></a><span>关于“<?php echo strip_tags($_GET['kw']) ?>”信息列表</span>
        <a href="/" class="homes"></a>
    </div>
    <div class="kuang1">
        <div class="productList">
            <?php if (empty($contents)) { ?>
                <div class="H-clear-both H-width-100-percent H-display-table H-box-sizing-border-box H-padding-horizontal-left-10">
                    <p style="text-align:center;color:#41a39f;font-size:16px;padding:50px 0;">
                        抱歉，没有找到“<?php echo strip_tags($_GET['kw']) ?>”相关的信息</p>
                </div>
            <?php } else { ?>
                <div class="panel panel-info article" style="max-height: initial;">
                    <style>
                        .article{padding:16px 10px;overflow:hidden;max-height:450px;min-height:160px;}.item-1{width:100%;border-bottom:1px solid #999;margin-bottom:10px;}.item-1>a{display:block;}.item-1 h4{font-family:'Microsoft YaHei',serif;font-size:16px;margin-bottom:6px;color:#3d3d3d;display:inline-block;overflow:hidden;text-overflow:ellipsis;word-wrap:break-word;white-space:nowrap !important;}.item-1:last-child{border-bottom:none;}.info-box{display:inline-block;float:right;font-size:13px;}.item-1 .info-content{white-space:normal;word-break:break-all;word-wrap:break-word;color:#6b6b6b;}.info-box .createTime{display:none;}.info-box:hover .readCount{display:none;}.info-box:hover .createTime{display:inline-block;}.hide-article-box{position:relative;z-index:1998;padding-top:155px;bottom:15px;margin-top:-207px;width:100%;background-image:-webkit-gradient(linear,left top,left bottom,from(rgba(255,255,255,0)),color-stop(70%,#fff));background-image:linear-gradient(-180deg,rgba(255,255,255,0) 0%,#fff 70%);padding-bottom:26px;}
                        @media screen and (max-width: 767px){
                            .item-1 h4{max-width: 240px; }
                            .item-1 .info-content {color: #6b6b6b;overflow: hidden;text-overflow: ellipsis;word-wrap: break-word;white-space: nowrap !important;}
                        }
                    </style>
                    <?php foreach ($contents as $content){
                        $info = strip_tags($content['content']);
                        if (mb_strlen($info) > 256)
                            $info = mb_substr($info, 0, 250) . '......';
                        ?>
                        <div class="item-1">
                            <a target="_blank" href="./route.php?s=index/<?php echo $content['id'] . '.html'; ?>">
                                <h4><?php echo strip_tags($content['title']); ?></h4>
                                <div class="info-box text-muted">
                                    <span class="createTime"><?php echo substr($content['createTime'], 0, 10); ?></span>
                                    <span class="readCount">阅读数 1万+</span>
                                </div>
                                <p class="info-content"><?php echo $info; ?></p>
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <?php
                $link = '&mod=ArticleList';
                if(!empty($searchTitle))
                    $link.='&title='.urlencode($searchTitle);
                echo '<ul class="pagination">';
                $first = 1;
                $prev  = $page - 1;
                $next  = $page + 1;
                $last  = $pages;
                if ($page > 1) {
                    echo '<li><a href="Article.php?page=' . $first . $link . '">首页</a></li>';
                    echo '<li><a href="Article.php?page=' . $prev . $link . '">&laquo;</a></li>';
                } else {
                    echo '<li class="disabled"><a>首页</a></li>';
                    echo '<li class="disabled"><a>&laquo;</a></li>';
                }
                $start = $page - 10 > 1 ? $page - 10 : 1;
                $end   = $page + 10 < $pages ? $page + 10 : $pages;
                for ($i = $start; $i < $page; $i++)
                    echo '<li><a href="Article.php?page=' . $i . $link . '">' . $i . '</a></li>';
                echo '<li class="disabled"><a>' . $page . '</a></li>';
                for ($i = $page + 1; $i <= $end; $i++)
                    echo '<li><a href="Article.php?page=' . $i . $link . '">' . $i . '</a></li>';
                if ($page < $pages) {
                    echo '<li><a href="Article.php?page=' . $next . $link . '">&raquo;</a></li>';
                    echo '<li><a href="Article.php?page=' . $last . $link . '">尾页</a></li>';
                } else {
                    echo '<li class="disabled"><a>&raquo;</a></li>';
                    echo '<li class="disabled"><a>尾页</a></li>';
                }
                echo '</ul>';
                ?>
            <?php } ?>
        </div>
    </div>
</div>
<div class="footer">
<!--    信息举报邮箱：jb@--><?php //echo $_SERVER['SERVER_NAME']; ?><!-- <BR>-->
    Copyright &copy;2008-<?php echo date('Y') . '  ' . $_SERVER['SERVER_NAME']; ?> All Rights Reserved.
</div>

</body>
</html>