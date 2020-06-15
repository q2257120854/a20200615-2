<?php
/**
 * 文章管理
 **/
include("../includes/common.php");
if ($islogin != 1)
    exit("<script>window.location.href='./login.php';</script>");

function getParam($data, $default = '')
{
    if (!empty($data))
        return daddslashes($data);
    return $default;
}

$act = isset($_GET['act']) ? $_GET['act'] : '';
if ($act == 'save') {
    $type           = getParam($_POST['type']);
    $id             = getParam($_POST['id']);
    $title          = getParam($_POST['title']);
    $content        = getParam($_POST['content']);
    $author         = getParam($_POST['author']);
    $status         = getParam($_POST['status'], 0);
    $createTime     = date('Y-m-d H:i:s', time());
    $seoTitle       = getParam($_POST['seoTitle']);
    $seoKeywords    = getParam($_POST['seoKeywords']);
    $seoDescription = getParam($_POST['seoDescription']);
    $articleImg     = getParam($_POST['articleImg']);
    if ($type != 'update' && $type != 'add')
        exit(json_encode(['status' => 0, 'msg' => '请求类型有误']));

    $updateData = [
        'title'          => $title,
        'content'        => $content,
        'author'         => $author,
        'status'         => $status,
        'imageUrl'       => $articleImg,
        'seoTitle'       => $seoTitle,
        'seoKeywords'    => $seoKeywords,
        'seoDescription' => $seoDescription,
        'createTime'     => $createTime
    ];

    if ($type == 'add')
        $sql = $DB->insert('article_list', $updateData);
    else
        $sql = $DB->update('article_list', $updateData, ['id' => $id, 'LIMIT' => 1]);

    if ($sql->rowCount() > 0)
        exit(json_encode(['status' => 1, 'msg' => '更新成功']));
    else {
        exit(json_encode(['status' => 0, 'msg' => '更新失败 => ' . $DB->error()]));
    }
}

$title = '未知页面';
switch ($_GET['mod']) {
    case 'ArticleList':
        $title = '文章列表';
        break;
    case 'ArticleAdd':
        $title = '添加文章';
        break;
    case 'ArticleUpdate':
        $title = '更新文章';
        break;
}

include './head.php';
//没登录


if ($_GET['mod'] == 'ArticleList') {
    $searchTitle = getParam(urldecode($_GET['title']), '');
    $page        = getParam($_GET['page'], 1);
    $limit       = 25;

    $where = [];

    if (!empty($searchTitle)) {
        $where['title[~]'] = $searchTitle;
    }
    $pages = $DB->count('article_list', $where);

    $where['ORDER'] = ['id' => 'DESC'];
    $where['LIMIT'] = [($page - 1) * $limit, $limit];

    $contents = $DB->select('article_list', ['id', 'title', 'status', 'createTime'], $where);
    ?>
    <div class="col-md-12 center-block" style="float: none;">
        <div class="block">
            <div class="block-title clearfix">
                <h2>
                    <?php echo $title; ?>
                </h2>
            </div>
            <form action="Article.php" method="get">
                <input type="text" name="mod" value="ArticleList" style="display: none;">
                <input type="hidden" name="my" value="search">
                <div class="input-group xs-mb-15">
                    <input type="text" placeholder="支持模糊查询 仅限文章标题" name="title"
                           class="form-control text-center"
                           value="<?php echo $searchTitle ?>">
                    <span class="input-group-btn">
			            <button type="submit" id="search" class="btn btn-primary">立即搜索</button>
			        </span>
                </div>
            </form>
            <div id="listTable">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>标题</th>
                            <th>状态</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($contents as $content) { ?>
                            <tr>
                                <td><?php echo $content['id']; ?></td>
                                <td><?php echo strip_tags($content['title']); ?></td>
                                <td><?php echo $content['status'] ? '<a class="btn btn-default btn-xs" onclick="setArticleStatus('.$content['id'].', 0)">显示</a>' : '<a class="btn btn-primary btn-xs" onclick="setArticleStatus('.$content['id'].', 1)">隐藏</a>'; ?></td>
                                <td><?php echo $content['createTime']; ?></td>
                                <td><a href="./Article.php?mod=ArticleUpdate&id=<?php echo $content['id']; ?>"
                                       class="btn btn-info btn-xs">编辑</a>&nbsp;<a
                                            href="./Article.php?mod=ArticleDelete&id=<?php echo $content['id']; ?>"
                                            class="btn btn-xs btn-danger"
                                            onclick="return confirm('你确实要删除此记录吗？');">删除</a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php
                    $link = '&mod=ArticleList';
                    if (!empty($searchTitle))
                        $link .= '&title=' . urlencode($searchTitle);
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
                </div>
            </div>
        </div>
    </div>
    <script>
        function setArticleStatus(id, st) {
            layer.load(2);
            $.post('ajax.php?act=change_article_st', {'id': id,'st': st}).success(function (res) {
                layer.closeAll('loading');
                if (res['status'] === 0) {
                    layer.msg(res['msg'], {icon: 1, time: 1000}, function () {
                        location.reload();
                    });
                } else {
                    layer.msg(res['msg'], {icon: 2, time: 1000}, function () {
                        location.reload();
                    });
                }
            }).error(function () {
                layer.closeAll('loading');
            });
        }

    </script>
<?php
} else if ($_GET['mod'] == 'ArticleAdd' || $_GET['mod'] == 'ArticleUpdate') {
    $id             = 0;
    $title          = '';
    $content        = '';
    $author         = '';
    $status         = 1;
    $createTime     = '';
    $seoTitle       = '';
    $seoKeywords    = '';
    $seoDescription = '';
    $articleImg     = '';

    if ($_GET['mod'] == 'ArticleUpdate') {
        $id = intval($_GET['id']);
        if (!empty($id)) {
            $contents = $DB->get('article_list', '*', ['id' => $id]);
            if (empty($contents))
                $contents = [];
            foreach ($contents as $key => $value) {
                if ($key == 'imageUrl')
                    $key = 'articleImg';
                $$key = $value;
            }
            if (!empty($createTime))
                $createTime = substr($createTime, 0, 10);
        }
    }
    ?>
    <div class="col-md-12 center-block" id="article" data-article-id="<?php echo $id; ?>" style="float: none;">
        <div class="block">
            <div class="block-title clearfix">
                <h2>
                    <?php echo $title; ?>
                </h2>
            </div>
            <form method="post" class="clearfix" style="margin-bottom: 1rem;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">是否发布</div>
                                <select id="status" name="status" class="form-control">
                                    <option value="1" <?php echo $status ? 'selected="selected"' : ''; ?>>是</option>
                                    <option value="0" <?php echo !$status ? 'selected="selected"' : ''; ?>>否</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">发布时间</div>
                                <input type="date" class="form-control" id="createTime" name="createTime"
                                       value="<?php echo $createTime; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">标题</div>
                        <input type="text" class="form-control" id="title" name="title" placeholder="文章标题 最长128个字符"
                               value="<?php echo $title; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">作者</div>
                        <input type="text" class="form-control" id="author" name="author" placeholder="作者名称 最长128个字符"
                               value="<?php echo $author; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">T</div>
                        <input type="text" class="form-control" id="seoTitle" name="seoTitle"
                               placeholder="seo 标题 最长255个字符" value="<?php echo $seoTitle; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">K</div>
                        <input type="text" class="form-control" id="seoKeywords" name="seoKeywords"
                               placeholder="seo 关键词 最长255个字符 分号隔开," value="<?php echo $seoKeywords ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">D</div>
                        <textarea class="form-control" id="seoDescription" name="seoDescription"
                                  style="min-width: 100%;" placeholder="seo 描述"><?php echo $seoDescription ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="file" id="file" onchange="fileUpload()" style="display:none;"/>
                        <div class="input-group-addon">缩略图</div>
                        <input type="text" class="form-control" id="shopimg" name="shopimg"
                               value="<?php echo $articleImg; ?>"
                               placeholder="填写图片URL，没有请留空"><span class="input-group-btn"><a
                                    href="javascript:fileSelect()" class="btn btn-success" title="上传图片"><i
                                        class="glyphicon glyphicon-upload"></i></a><a href="javascript:fileView()"
                                                                                      class="btn btn-warning"
                                                                                      title="查看图片"><i
                                        class="glyphicon glyphicon-picture"></i></a></span>
                    </div>
                </div>
                <div class="form-group">
                    <label>文章内容</label><br>
                    <script id="content" name="content" type="text/plain"><?php echo $content; ?></script>
                </div>
                <button type="button" class="btn btn-primary pull-right" id="addArticle"><?php echo $_GET['mod'] == 'ArticleAdd' ? '新增' : '修改'; ?>文章</button>
            </form>
        </div>
    </div>
    <script src="./assets/ueditor.config.js"></script>
    <script src="./assets/ueditor.all.min.js"></script>
    <script src="./assets/lang/zh-cn/zh-cn.js"></script>
    <script>
        $(function ($) {
            var contentDom = UE.getEditor('content');

            $('#addArticle').click(function () {
                var content = contentDom.getContent();
                var status = $('#status').val();
                var createTime = $('#createTime').val();
                var title = $('#title').val();
                var author = $('#author').val();
                var seoTitle = $('#seoTitle').val();
                var seoKeywords = $('#seoKeywords').val();
                var seoDescription = $('#seoDescription').val();
                var articleImg = $('#shopimg').val();

                var id = $('#article').attr('data-article-id');

                if (title.length > 128 || author.length > 128 || seoTitle.length > 255 || seoKeywords.length > 255) {
                    layer.msg('文字长度不能超过限制');
                    return;
                }

                var requestData = {
                    content: content,
                    status: status,
                    createTime: createTime,
                    title: title,
                    author: author,
                    seoTitle: seoTitle,
                    seoKeywords: seoKeywords,
                    seoDescription: seoDescription,
                    articleImg: articleImg
                };
                if (id !== '0') {
                    requestData['type'] = 'update';
                    requestData['id'] = id;
                } else {
                    requestData['type'] = 'add';
                }
                var loadFlag = layer.msg('正在读取数据，请稍候……', {icon: 16, shade: [0.01, '#fff'], shadeClose: false}, 60000);
                $.post('./Article.php?act=save', requestData, function (data) {
                    layer.close(loadFlag);
                    layer.alert(data['msg']);
                    setTimeout(function () {
                        window.location.href = './Article.php?mod=ArticleList';
                    }, 1500);
                }, 'json');

            });
        });

        function fileSelect() {
            $("#file").trigger("click");
        }

        function fileView() {
            var shopimg = $("#shopimg").val();
            if (shopimg == '') {
                layer.alert("请先上传图片，才能预览");
                return;
            }
            if (shopimg.indexOf('http') == -1) shopimg = '../' + shopimg;
            layer.open({
                type: 1,
                area: ['360px', '400px'],
                title: '商品图片查看',
                shade: 0.3,
                anim: 1,
                shadeClose: true,
                content: '<center><img width="300px" src="' + shopimg + '"></center>'
            });
        }

        function fileUpload() {
            var fileObj = $("#file")[0].files[0];
            if (typeof (fileObj) == "undefined" || fileObj.size <= 0) {
                return;
            }
            var formData = new FormData();
            formData.append("do", "upload");
            formData.append("type", "shop");
            formData.append("file", fileObj);
            var ii = layer.load(2, {shade: [0.1, '#fff']});
            $.ajax({
                url: "ajax.php?act=uploadimg",
                data: formData,
                type: "POST",
                dataType: "json",
                cache: false,
                processData: false,
                contentType: false,
                success: function (data) {
                    layer.close(ii);
                    if (data.code == 0) {
                        layer.msg('上传图片成功');
                        $("#shopimg").val(data.url);
                    } else {
                        layer.alert(data.msg);
                    }
                },
                error: function (data) {
                    layer.alert('服务器错误');
                    return false;
                }
            })
        }
    </script>
<?php
} else if ($_GET['mod'] == 'ArticleDelete') {
    $id = intval($_GET['id']);
    if ($id <= 0)
        exit('<script>alert("文章ID无效");window.location.href = \'./Article.php?mod=ArticleList\'</script>');
    if ($DB->delete('article_list', ['id' => $id])->rowCount()) {
        exit('<script>alert("删除文章成功");window.location.href = \'./Article.php?mod=ArticleList\'</script>');
    } else {
        exit('<script>alert("删除文章失败");window.location.href = \'./Article.php?mod=ArticleList\'</script>');
    }

}
?>
<script src="//cdn.staticfile.org/layer/2.3/layer.js"></script>