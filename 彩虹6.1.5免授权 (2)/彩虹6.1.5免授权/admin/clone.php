<?php
include '../includes/common.php';
$title = '克隆站点';
include './head.php';
if ($islogin != 1) exit('<script>window.location.href="./login.php";</script>');

$act = filterParam($_POST['submit'], '');
if ($act == '确定克隆') {
    $url  = filterParam($_POST['url']);
    $key  = filterParam($_POST['key']);
    $type = intval(filterParam($_POST['type'], '0'));

    if (empty($url) || empty($key))
        showmsgAuto('请求参数不能为空', 3);
    $search = '~^(([^:/?#]+):)?(//([^/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?~i';
    preg_match_all($search, $url, $rr);
    if ($rr[4][0] == $_SERVER['HTTP_HOST']) {
        showmsgAuto('无法自己克隆自己', 3);
    }
    $url    = $url . '/api.php?act=clone&key=' . $key;
    $result = curl($url);
    if ($result === false)
        showmsgAuto('异常接口出现异常，克隆失败', 3);
    $result = json_decode($result, true);
    if (empty($result))
        showmsgAuto('返回数据异常,克隆失败', 3);
    if ($result['code'] != 1)
        showmsgAuto('[失败] ' . htmlspecialchars($result['msg']), 3);

    unset($result['code']);

    $tidArr = [];
    if (isset($_POST['tid'])) {
        foreach ($_POST['tid'] as $tid) {
            $tidArr[] = filterParam($tid);
        }
    } else {
        $tidArr = false;
    }
    if ($type == 0) {
        $DB->query('TRUNCATE TABLE `'.$dbconfig['dbqz'].'_class`');
        $DB->query('TRUNCATE TABLE `'.$dbconfig['dbqz'].'_tools`');
        $DB->query('TRUNCATE TABLE `'.$dbconfig['dbqz'].'_shequ`');
        $DB->query('TRUNCATE TABLE `'.$dbconfig['dbqz'].'_price`');
        foreach ($result as $tableName => $tableContent) {
            foreach ($tableContent as $key => $content) {
                $DB->insert($tableName, $content);
            }
        }
        showmsgAuto('[克隆成功] 全量克隆成功', 1);
    } elseif (!empty($tidArr)) {
        $tidArr = [];
        //增量克隆 需要克隆的商品ID
        if (isset($_POST['tid'])) {
            foreach ($_POST['tid'] as $tid) {
                $tidArr[] = filterParam($tid);
            }
        } else {
            $tidArr = false;
        }

        if (empty($tidArr))
            showmsgAuto('[克隆失败] 尚未选择克隆商品', 3);


        $tempDataCategory = [];
        $tempDataShequ    = [];
        $tempDataPrice    = [];

        // 查找现有的数据
        $userToolsData = $DB->select('tools', 'name', []);
        $userClassData = $DB->select('class', 'name', []);
        $userPriceData = $DB->select('price', 'name', []);
        $userShequData = $DB->select('shequ', 'url', []);
        //获取当前用户数据库数据

        $needInsertProductList = [];
        $needInsertClassList   = [];
        $needInsertPriceList   = [];
        $needInsertShequList   = [];
        //需要插入数据库的数据

        foreach ($result['tools'] as $content) {
            if (in_array($content['tid'], $tidArr)) {
                $needInsertClassList[] = $content['cid'];
                $needInsertPriceList[] = $content['prid'];
                if (!empty($content['shequ']))
                    $needInsertShequList[] = $content['shequ'];
            }
        }
        //缓存数据

        foreach ($result['price'] as $content) {
            if (!in_array($content['id'], $needInsertPriceList))
                continue;
            //过滤不需要加价模板

            $isExistName = in_array($content['name'], $userPriceData);
            //判断是否存在这个加价模板名称
            if ($isExistName) {
                $priceID                                  = $DB->get('price', 'id', ['name' => $content['name']]);
                $tempDataPrice['price_' . $content['id']] = $priceID;
                //已经存在加价模板名称则直接使用
            } else {
                $insertResult = $DB->insert('price', $content);
                if ($insertResult->rowCount()) {
                    $tempDataPrice['price_' . $content['id']] = $DB->id();
                }
            }
        }
        //构建加价模板数据

        foreach ($result['shequ'] as $content) {
            if (!in_array($content['id'], $needInsertShequList))
                continue;
            $isExistName = in_array($content['url'], $userShequData);
            //判断是否存在这个地址
            if ($isExistName) {
                $shequID                                  = $DB->get('shequ', 'id', ['url' => $content['url']]);
                $tempDataShequ['shequ_' . $content['id']] = $shequID;
            } else {
                $insertResult = $DB->insert('shequ', $content);
                if ($insertResult->rowCount())
                    $tempDataShequ['shequ_' . $content['id']] = $DB->id();
            }
        }
        //构建社区模板数据

        foreach ($result['class'] as $content) {
            if (!in_array($content['cid'], $needInsertClassList))
                continue;

            $isExistName = in_array($content['name'], $userClassData);
            //判断是否才能在这个分类名称
            if ($isExistName) {
                $categoryID                                   = $DB->get('class', 'cid', ['name' => $content['name']]);
                $tempDataCategory['class_' . $content['cid']] = $categoryID;
            } else {
                $insertResult = $DB->insert('class', $content);
                if ($insertResult->rowCount())
                    $tempDataCategory['class_' . $id] = $DB->id();
            }
        }
        //构建分类模板数据

        $cloneCount = 0;

        foreach ($result['tools'] as $content) {
            if (!in_array($content['tid'], $tidArr))
                continue;
            //判断是否需要塞进去
//            if (in_array($content['name'], $userToolsData))
//                continue;
            //判断是否已经有相同名称的商品 是的话跳过

            $tid = $content['tid'];
            unset($content['tid']);


            if (!empty($tempDataCategory['class_' . $content['cid']]))
                $content['cid'] = $tempDataCategory['class_' . $content['cid']];
            if (!empty($tempDataPrice['price_' . $content['prid']]))
                $content['prid'] = $tempDataPrice['price_' . $content['prid']];
            if (!empty($tempDataShequ['shequ_' . $content['shequ']]))
                $content['shequ'] = $tempDataShequ['shequ_' . $content['shequ']];

            $insertResult = $DB->insert('tools', $content);
            $cloneCount   += $insertResult->rowCount();
        }
        showmsgAuto('[克隆成功] 增量克隆 ' . $cloneCount . ' 个商品。', 1);
    }
}

if ($act == '确定克隆' && empty($tidArr) && $type == 1) {
    $items = [];
    foreach ($result['class'] as $v) {
        $items[$v['cid']]['class'] = $v;
    }
    foreach ($result['tools'] as $v) {
        if (isset($items[$v['cid']]['class'])) {
            $items[$v['cid']]['tools'][] = $v;
        }
    }
    ?>
    <div class="col-sm-12 col-md-10 col-lg-8 center-block" style="float: none;">
        <div class="block">
            <div class="block-title"><h3 class="panel-title">请选择要克隆的商品</h3></div>
            <div>
                <form action="?" method="POST" role="form">
                    <input type="hidden" name="url" value="<?php echo htmlspecialchars(filterParam($_POST['url'])); ?>">
                    <input type="hidden" name="key" value="<?php echo htmlspecialchars($key); ?>">
                    <input type="hidden" name="type" value="<?php echo htmlspecialchars($type); ?>">
                    <?php if(is_array($items)): if( count($items)==0 ) : echo '' ;else: foreach ($items as $v): ?>
                        <a class="panel-title collapsed" data-toggle="collapse" data-parent="#class"
                           href="#class<?= $v['class']['cid']; ?>"
                           aria-expanded="false">
                            <div class="list-group-item list-group-item-success">
                                <span class="pull-right"><i class="fa fa-chevron-down"></i></span>
                                <?php echo $v['class']['name']; ?>
                            </div>
                        </a>
                        <div id="class<?php echo $v['class']['cid']; ?>" class="panel-collapse collapse" aria-expanded="false"
                             style="height: 0;">
                            <table class="table table-bordered" style="table-layout: fixed;">
                                <thead>
                                <tr>
                                    <td>
                                        <label class="csscheckbox csscheckbox-primary">全选
                                            <input type="checkbox" onclick="SelectAll(<?php echo $v['class']['cid']; ?>,this)">
                                            <span></span>
                                        </label>&nbsp;ID
                                    </td>
                                    <td>商品名称</td>
                                    <td>状态</td>
                                </tr>
                                </thead>
                                <tbody>
                                <!--内容-->
                                <?php if(is_array($v['tools'])): if( count($v['tools'])==0 ) : echo '' ;else: foreach ($v['tools'] as $v2): ?>
                                    <tr>
                                        <td>
                                            <label class="csscheckbox csscheckbox-primary">
                                                <input name="tid[]" type="checkbox"
                                                       class="class<?php echo $v['class']['cid']; ?>" id="tid"
                                                       value="<?php echo $v2['tid']; ?>">
                                                <span></span>&nbsp;<?php echo $v2['tid']; ?>
                                                <label></label>
                                            </label>
                                        </td>
                                        <td><?php echo $v2['name']; ?></td>
                                        <td>
                                            <?php if (1 == $v2['close']): ?>
                                                <span class="btn btn-xs btn-warning">已下架</span>
                                            <?php else: ?>
                                                <span class="btn btn-xs btn-success">上架中</span>
                                            <?php endif; ?>
                                            &nbsp;
                                            <?php if (1 == $v2['active']): ?>
                                                <span class="btn btn-xs btn-success">显示</span>
                                            <?php else: ?>
                                                <span class="btn btn-xs btn-warning">隐藏</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; endif; else: echo '' ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach; endif; else: echo '' ;endif; ?>
                    <br>
                    <p><input type="submit" name="submit" value="确定克隆" class="btn btn-primary form-control"></p>
                </form>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="col-sm-12 col-md-10 col-lg-8 center-block" style="float: none;">

        <div class="block">
            <div class="block-title"><h3 class="panel-title">克隆站点</h3></div>
            <div class="">
                <div class="alert alert-info">
                    使用此功能可一键克隆目标站点的分类、商品及社区对接数据（除社区账号密码外），方便站长快速丰富网站内容。
                </div>
                <div class="alert alert-danger">
                    使用全量克隆将会清空本站所有商品和分类数据，请谨慎操作！
                </div>
                <form action="?" method="POST" role="form">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">站点URL</div>
                            <input type="text" name="url" value="" class="form-control" placeholder="http://www.qq.com/"
                                   required/>
                            <div class="input-group-addon" onclick="checkurl()"><small>检测连通性</small></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">克隆密钥</div>
                            <input type="text" name="key" value="" class="form-control" placeholder="联系目标站点取得"
                                   required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">克隆方式</div>
                            <select class="form-control" name="type">
                                <option value="1">增量克隆（不会改变原有数据）</option>
                                <option value="0">全量克隆（会清空本站原有的商品数据）</option>
                            </select>
                        </div>
                    </div>
                    <p><input type="submit" name="submit" value="确定克隆" class="btn btn-primary form-control"/></p>
                </form>
            </div>
            <div class="panel-footer">
                <span class="glyphicon glyphicon-info-sign"></span> 本站克隆密钥<a href="./set.php?mod=cloneset">点此获取</a>
            </div>
        </div>
    </div>
    </div>
<?php } ?>
<script>
    function SelectAll(cid, chkAll) {
        var items = $('.class' + cid);
        for (i = 0; i < items.length; i++) {
            if (items[i].id.indexOf("tid") != -1 && items[i].type == "checkbox") {
                items[i].checked = chkAll.checked;
            }
        }
    }

    function checkurl() {
        var url = $("input[name='url']").val();
        if (url.indexOf('http') >= 0 && url.substr(-1) == '/') {
            var ii = layer.load(2, {shade: [0.1, '#fff']});
            $.ajax({
                type: "POST",
                url: "ajax.php?act=checkclone",
                data: {url: url},
                dataType: 'json',
                success: function (data) {
                    layer.close(ii);
                    if (data.code == 1) {
                        layer.msg('连通性良好，可以克隆');
                    } else if (data.code == 2) {
                        layer.alert('无法自己克隆自己');
                    } else if (data.code == 3) {
                        layer.alert('对方网站的源码被用记事本改过，请先在对方网站清理BOM头部');
                    } else {
                        layer.alert('对方网站无法连接或存在金盾或云锁等防火墙');
                    }
                },
                error: function (data) {
                    layer.close(ii);
                    layer.msg('目标URL连接超时');
                    return false;
                }
            });
        } else {
            layer.alert('URL必须以 http:// 开头，以 / 结尾');
        }
    }
</script>


