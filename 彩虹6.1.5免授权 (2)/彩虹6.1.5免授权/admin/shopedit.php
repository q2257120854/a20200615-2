<?php

include '../includes/common.php';
$title = '后台管理';
include './head.php';
if ($islogin != 1) {
    exit("<script>window.location.href='./login.php';</script>");
}

$act = $_GET['my'];

if ($act == 'delete') {
    $tid = intval($_GET['tid']);
    if (empty($tid))
        showmsg('请求数据不能为空', 3);
    $deleteResult = $DB->delete('tools', ['tid' => $tid, 'LIMIT' => 1]);
    if ($deleteResult->rowCount()) {
        showmsg('删除商品成功', 1);
    } else {
        showmsg('删除商品失败！' . $DB->error(), 3);
    }
} else if ($act == 'add_submit' || $act == 'edit_submit') {
    $tid         = intval($_GET['tid']);
    $sqlKeyStr   = '';
    $sqlValueStr = '';

    if (!isset($_POST['price']) && !isset($_POST['price1']))
        showmsg('商品基础价格不能为空', 3);

    if ($_POST['is_curl'] == 1) {
        $_POST['goods_param'] = $_POST['curl_post'];
        unset($_POST['curl_post']);
    }

    if ($_POST['prid'] != 0) {
        $_POST['price'] = $_POST['price1'];
        //加价模板价格
    } else {
        if ($_POST['price'] < $_POST['cost'])
            showmsg('商品普及版价格不能高于销售价格', 3);
        if ($_POST['cost'] < $_POST['cost2'])
            showmsg('商品普及版价格不能高于专业版价格', 3);
        //自定义价格
    }
    unset($_POST['price1']);


    if (empty($_POST['input']))
        $_POST['input'] = '下单ＱＱ';

    if ($act == 'add_submit') {
        $_POST['active'] = 1;
    }

    $dataArr = [];

    foreach ($_POST as $key => $value) {
        $key   = filterParam($key);
        $value = filterParam($value);
        if ($key == 'backurl' || $key == 'curl_post')
            continue;

        $dataArr[$key] = $value;
    }
    // 钩子数据拷贝
    $hookDataArr = $dataArr;
    // 移除tools表无关数据
    if (isset($dataArr['p_ali_pay'])) unset($dataArr['p_ali_pay']);
    if (isset($dataArr['p_wx_pay'])) unset($dataArr['p_wx_pay']);
    if (isset($dataArr['p_qq_pay'])) unset($dataArr['p_qq_pay']);

    if (!empty($dataArr['desc'])) {
        $dataArr['desc'] = trim($dataArr['desc']);
    }

    $result = false;
    if ($act == 'add_submit') {
        $result = $DB->insert('tools', $dataArr);
    } else {
        $dataArr['uptime'] = time();
        $result            = $DB->update('tools', $dataArr, ['tid' => $tid]);
    }
    if ($result->rowCount() > 0) {
        if ($act == 'add_submit') {
            $tid = $DB->id();
            $DB->update('tools', ['sort' => $tid], ['tid' => $tid]);
            log_result('商品操作', 'IP => ' . $clientip . '<br>UA => ' . $_SERVER['HTTP_USER_AGENT'], '新增商品 商品名称 => ' . htmlspecialchars(daddslashes($_POST['name'])), '1');
        } else {
            $tid = $_GET['tid'];
            log_result('商品操作', 'IP => ' . $clientip . '<br>UA => ' . $_SERVER['HTTP_USER_AGENT'], '更新商品 商品ID => ' . htmlspecialchars(daddslashes($_POST['name'])), '1');
        }
        $backParam = 'cid=' . $_POST['cid'];
        if (!empty($_SERVER['HTTP_REFERER'])) {
            $refererUrl = parse_url($_SERVER['HTTP_REFERER']);
            if (!empty($refererUrl['query']))
                $backParam = $refererUrl['query'];
        }
        hook('afterProductEdit', ['tid' => $tid, 'data' => $hookDataArr]);
        showmsg('更新信息成功！<br><br><a href="./shopedit.php?my=edit&tid=' . $tid . '">&gt;&gt;编辑当前商品</a><br><a href="./shoplist.php?' . $backParam . '">&gt;&gt;返回商品列表</a><hr>', 1);
    } elseif ($DB->error() == '[]') {
        showmsg('您未做任何修改', 3);
    } else {
        showmsg('更新信息失败，错误信息：' . $DB->error(), 3);
    }
} else if ($act == 'edit' || $act == 'add') {
    if ($act == 'edit') {
        $productID = intval($_GET['tid']);
        if (empty($productID))
            showmsg('商品不存在，无法进行编辑', 3);

        $productInfo = $DB->get('tools', '*', ['tid' => $productID]);
    } else {
        $productInfo = [
            'tid'         => 0,
            'zid'         => 0,
            'cid'         => 0,
            'sort'        => 0,
            'name'        => '',
            'price'       => '',
            'cost'        => '',
            'cost2'       => '',
            'prices'      => '',
            'input'       => '',
            'inputs'      => '',
            'desc'        => '',
            'validate'    => 0,
            'repeat'      => 0,
            'multi'       => 1,
            'shequ'       => 0,
            'goods_id'    => '',
            'goods_type'  => '',
            'goods_param' => '',
            'value'       => 0,
            'is_curl'     => 0,
            'curl'        => '',
            'shopimg'     => '',
            'prid'        => 0,
            'alert'       => '',
            'max'         => '',
            'min'         => ''
        ];
    }
    ?>
    <link rel="stylesheet" href="//cdn.staticfile.org/select2/4.0.10/css/select2.min.css">
    <script src="//cdn.staticfile.org/select2/4.0.10/js/select2.min.js"></script>
    <style>
        .select2-selection.select2-selection--single {
            height: 32px;
        }

        .select2-container--default.select2-selection--single {
            padding: 5px;
        }
    </style>
    <div class="modal" align="left" id="inputabout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">输入框标题说明</h4>
                </div>
                <div class="modal-body">
                    使用以下输入框标题可实现特殊的转换功能<br/>
                    <p class="text-warning">如果输入标题含有 <span class="text-danger">“链接”</span> 二字 就会触发过滤链接功能</p>
                    KF链接自动转换：<a href="javascript:changeinput('KFID')">KFID</a>、<a
                            href="javascript:changeinput('KF用户ID')">KF用户ID</a><br/>
                    全民K歌链接自动转换：<a href="javascript:changeinput('歌曲ID')">歌曲ID</a><br/>
                    火山链接自动转换：<a href="javascript:changeinput('火山ID')">火山ID</a>、<a
                            href="javascript:changeinput('火山作品ID')">火山作品ID</a>、<a
                            href="javascript:changeinput('火山视频ID')">火山视频ID</a><br/>
                    音乐链接自动转换：<a href="javascript:changeinput('音乐ID')">音乐ID</a>、<a
                            href="javascript:changeinput('音乐作品ID')">音乐作品ID</a>、<a
                            href="javascript:changeinput('音乐视频ID')">音乐视频ID</a><br/>
                    微视链接自动转换：<a href="javascript:changeinput('微视ID')">微视ID</a>、<a
                            href="javascript:changeinput('微视作品ID')">微视作品ID</a><br/>
                    小红书链接自动转换：<a href="javascript:changeinput('小红书ID')">小红书ID</a>、<a
                            href="javascript:changeinput('小红书作品ID')">小红书作品ID</a><br/>
                    皮皮虾链接自动转换：<a href="javascript:changeinput('皮皮虾ID')">皮皮虾ID</a>、<a
                            href="javascript:changeinput('皮皮虾作品ID')">皮皮虾作品ID</a><br/>
                    微视主页链接自动转换：<a href="javascript:changeinput('微视主页ID')">微视主页ID</a><br/>
                    头条链接自动转换：<a href="javascript:changeinput('头条ID')">头条ID</a><br/>
                    美拍链接自动转换：<a href="javascript:changeinput('美拍ID')">美拍ID</a>、<a
                            href="javascript:changeinput('美拍作品ID')">美拍作品ID</a>、<a
                            href="javascript:changeinput('美拍视频ID')">美拍视频ID</a><br/>
                    哔哩哔哩链接自动转换：<a href="javascript:changeinput('哔哩哔哩ID')">哔哩哔哩ID</a>、<a
                            href="javascript:changeinput('哔哩哔哩视频ID')">哔哩哔哩视频ID</a>、<a
                            href="javascript:changeinput('哔哩视频ID')">哔哩视频ID</a><br/>
                    最右帖子链接自动转换：<a href="javascript:changeinput('最右帖子ID')">最右帖子ID</a><br/>
                    全民视频链接自动转换：<a href="javascript:changeinput('全民视频ID')">全民视频ID</a><br/>
                    美图视频链接自动转换：<a href="javascript:changeinput('美图视频ID')">美图视频ID</a>、<a
                            href="javascript:changeinput('美图作品ID')">美图作品ID</a><br/>
                    绿洲链接自动转换：<a href="javascript:changeinput('绿洲用户ID')">绿洲用户ID（用于个人页获取用户UID）</a><br>
                    <a href="javascript:changeinput('绿洲作品ID')">绿洲视频ID | 绿洲作品ID（用于视频链接获取SID）</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" align="left" id="inputsabout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">更多输入框标题说明</h4>
                </div>
                <div class="modal-body">
                    使用以下输入框标题可实现特殊的转换功能<br/>
                    <p class="text-warning">如果输入标题含有 <span class="text-danger">“链接”</span> 二字 就会触发过滤链接功能</p>
                    获取空间说说列表：<a href="javascript:changeinputs('说说ID')">说说ID</a>、<a
                            href="javascript:changeinputs('说说ＩＤ')">说说ＩＤ</a><br/>
                    获取空间日志列表：<a href="javascript:changeinputs('日志ID')">日志ID</a>、<a
                            href="javascript:changeinputs('日志ＩＤ')">日志ＩＤ</a><br/>
                    KF链接自动转换：<a href="javascript:changeinputs('作品ID')">作品ID</a>、<a
                            href="javascript:changeinputs('KF作品ID')">KF作品ID</a><br/>
                    音乐评论ID获取：<a href="javascript:changeinputs('音乐评论ID')">音乐评论ID</a><br/>
                    <hr/>
                    显示选择框，在名称后面加{选择1,选择2}，例如：<a href="javascript:changeinputs('分类名{普通,音乐,宠物}')">分类名{普通,音乐,宠物}</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <form style="margin-top: 15px;"
                  action="./shopedit.php?my=<?php echo $_GET['my']; ?>_submit&tid=<?php echo filterParam($_GET['tid']); ?>"
                  method="POST">
                <div class="col-sm-12 col-md-6">
                    <div class="block">
                        <div class="block-title">
                            <h3 class="panel-title">商品类型与对接设置</h3>
                        </div>
                        <div class="">
                            <input type="hidden" name="backurl" value="./shoplist.php"/>
                            <div class="form-group">
                                <label>购买成功后的动作:</label><br>
                                <select class="form-control" name="is_curl"
                                        default="<?php echo $productInfo['is_curl']; ?>">
                                    <option value="0">0_无</option>
                                    <option value="2">自动提交到社区/卡盟</option>
                                    <option value="1">自定义访问URL/POST</option>
                                    <option value="4">自动发卡密（第一个输入框为邮件格式才能发送）</option>
                                    <option value="3">自动发送提醒邮件</option>
                                </select>
                            </div>
                            <div id="curl_display1" style="display:none;">
                                <div class="form-group">
                                    <label>URL:</label><br>
                                    <input type="text" class="form-control" name="curl" id="curl"
                                           data-name="curl">
                                </div>
                                <div class="form-group">
                                    <label>POST:</label><br>
                                    <input type="text" class="form-control" name="curl_post" id="curl_post"
                                           data-name="goods_param"
                                           placeholder="无POST内容请留空">
                                </div>
                                <span style="color: green">无POST内容请留空，POST格式：a=123&b=456<br/>变量代码：<br/>
                                    <a href="#" onclick="Addstr('curl','[input]');return false">[input]</a>&nbsp;第一个输入框内容<br/>
                                    <a href="#" onclick="Addstr('curl','[input2]');return false">[input2]</a>&nbsp;第二个输入框内容<br/>
                                    <a href="#" onclick="Addstr('curl','[input3]');return false">[input3]</a>&nbsp;第三个输入框内容<br/>
                                    <a href="#" onclick="Addstr('curl','[input4]');return false">[input4]</a>&nbsp;第四个输入框内容<br/>
                                    <a href="#" onclick="Addstr('curl','[name]');return false">[name]</a>&nbsp;商品名称<br/>
                                    <a href="#"
                                       onclick="Addstr('curl','[price]');return false">[price]</a>&nbsp;商品价格<br/>
                                    <a href="#" onclick="Addstr('curl','[num]');return false">[num]</a>&nbsp;下单数量<br/>
                                    <a href="#"
                                       onclick="Addstr('curl','[time]');return false">[time]</a>&nbsp;当前时间戳<br/></span>
                                <br/>
                            </div>
                            <div id="curl_display2" style="display: none;">
                                <div class="form-group">
                                    <label>选择对接网站:</label><br>
                                    <select class="form-control" name="shequ" data-name="shequ">
                                        <?php
                                        $content = '';
                                        $rs      = $DB->select('shequ', ['id', 'type', 'url'], ['ORDER' => ['id' => 'DESC']]);
                                        foreach ($rs as $res) {
                                            $content .= '<option value="' . $res['id'] . '" type="' . $res['type'] . '" data-community-domain="' . $res['url'] . '">[' . communityTypeToCommunityName($res['type']) . '] ' . $res['url'] . '</option>';
                                        }
                                        echo $content;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group" id="show_goodslist">
                                    <label>选择对接商品:</label><br>
                                    <div class="input-group">
                                        <select class="form-control" id="goodslist" data-name="goods_id"
                                                style=""></select>
                                        <span class="input-group-addon btn btn-success" id="getGoods">获取</span>
                                    </div>
                                </div>
                                <div class="form-group" id="goods_id">
                                    <label>商品ID（goods_id）:</label><br>
                                    <input type="text" class="form-control" name="goods_id" data-name="goods_id">
                                </div>
                                <div class="form-group" id="goods_type">
                                    <label>类型ID（goods_type）:</label><br>
                                    <input type="text" class="form-control" name="goods_type" data-name="goods_type">
                                </div>
                                <div data-class="kyxCommunity">
                                    <div class="form-group">
                                        <label>请选择分类:</label><br>
                                        <div class="input-group">
                                            <select class="form-control" id="kyxCategory">
                                                <option value="null">请选择分类</option>
                                            </select>
                                            <span class="input-group-addon btn btn-success"
                                                  id="kyxGetCategory">获取</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>请选择对接商品:</label><br>
                                        <select class="form-control" id="kyxProductList">
                                            <option value="null">请选择二级分类</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="goods_param">
                                    <label id="goods_param_name">参数名:</label><br>
                                    <input type="text" class="form-control" name="goods_param" data-name="goods_param">
                                    <pre><span style="color: green">对应输入框标题，多个参数请用|隔开；如果是对接卡盟，请直接填写下单页面地址</span></pre>
                                </div>
                            </div>
                            <div class="form-group" id="show_value">
                                <label>默认数量信息:</label><br>
                                <input type="number" class="form-control" name="value" id="value" data-name="value"
                                       placeholder="用于对接社区使用或导出时显示" onkeyup="changeNum()">
                                <input type="hidden" id="price" value="">
                            </div>
                            <div id="GoodsInfo" class="alert alert-info" style="display:none;"></div>
                        </div>
                    </div>
                    <div class="block" id="shield_order_dom" style="display: none;">
                        <div class="block-title">
                            <h3 class="panel-title">对接商品屏蔽功能（高级功能）</h3>
                        </div>
                        <div class="form-group">
                            <label for="attr_shield_type">屏蔽类型:</label><br>
                            <select class="form-control" id="attr_shield_type" name="attr_shield_type">
                                <?php
                                $keyList = ['不使用', 'QQ会员', '超级会员', '红钻贵族', '黄钻贵族', '腾讯视频VIP', '绿钻贵族', '绿钻豪华版', '豪华黄钻'];
                                foreach ($keyList as $key => $content): ?>
                                    <option value="<?php echo $key; ?>" <?php echo $productInfo['attr_shield_type'] == $key ? 'selected' : ''; ?>><?php echo $content; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <code>
                            本功能用于符合状态的订单不对接社区（吞单）<br>
                            例：用户下单 “超级黄砖” 当用户已开通则不进行对接社区且返回已对接状态
                        </code>
                    </div>
                    <?php hook('productEditDetail'); ?>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="block">
                        <div class="block-title">
                            <h3 class="panel-title">商品基本信息设置</h3>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <label>商品分类:</label><br>
                                <select name="cid" class="form-control"
                                        default="<?php echo !empty($_GET['cid']) ? $_GET['cid'] : $productInfo['cid']; ?>">
                                    <?php
                                    $content = '';
                                    $rs      = $DB->select('class', ['name', 'cid'], ['active' => 1, 'ORDER' => ['sort' => 'ASC']]);
                                    foreach ($rs as $res) {
                                        $content .= '<option value="' . $res['cid'] . '">' . $res['name'] . '</option>';
                                    }
                                    echo $content;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>商品名称:</label><br>
                                <input type="text" class="form-control" name="name" data-name="name" required>
                            </div>
                            <div class="form-group">
                                <label>加价模板:</label>&nbsp;(<a href="./priceModel.php" target="_blank">管理</a>)<br>
                                <select name="prid" class="form-control" data-name="prid">
                                    <option value="0">不使用加价模板</option>
                                </select>
                            </div>
                            <div class="form-group" id="prid1" style="display:none;">
                                <label>*成本价格:</label><br>
                                <input type="text" class="form-control" name="price1"
                                       value="<?php echo $productInfo['prid'] != 0 ? $productInfo['price'] : ''; ?>">
                            </div>
                            <table class="table table-striped table-bordered table-condensed" id="prid0"
                                   style="display:none;">
                                <tbody>
                                <tr align="center">
                                    <td>*销售价格</td>
                                    <td>普及版价格</td>
                                    <td>专业版价格</td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="price" value="<?php echo $productInfo['price']; ?>"
                                               class="form-control input-sm"/></td>
                                    <td><input type="text" name="cost" value="<?php echo $productInfo['cost']; ?>"
                                               class="form-control input-sm"
                                               placeholder="不填写则同步销售价格"/></td>
                                    <td><input type="text" name="cost2" value="<?php echo $productInfo['cost2']; ?>"
                                               class="form-control input-sm"
                                               placeholder="不填写则同步普及版价格"/></td>
                                </tr>
                            </table>
                            <div class="form-group">
                                <label>批发价格优惠设置:</label><br>
                                <input type="text" class="form-control" name="prices" data-name="prices">
                                <pre><span style="color: green">填写格式：购满x个|减少x元单价,购满x个|减少x元单价  例如10|0.1,20|0.3,30|0.5</span></pre>
                            </div>
                            <div class="form-group">
                                <label>第一个输入框标题:</label><br>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="input" data-name="input"
                                           placeholder="留空默认为“下单ＱＱ”">
                                    <span class="input-group-btn">
                            <a href="#inputabout" data-toggle="modal" class="btn btn-info" title="说明">
                                <i class="glyphicon glyphicon-exclamation-sign"></i>
                            </a>
                        </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>更多输入框标题:</label><br>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="inputs" data-name="inputs"
                                           placeholder="留空则不显示更多输入框">
                                    <span class="input-group-btn">
                            <a href="#inputsabout" data-toggle="modal" class="btn btn-info" title="说明">
                                <i class="glyphicon glyphicon-exclamation-sign"></i>
                            </a>
                        </span>
                                </div>
                                <pre><span style="color:green">多个输入框请用|隔开(不能超过4个)</span></pre>
                            </div>
                            <div class="form-group">
                                <label>商品简介:</label>(没有请留空)<br>
                                <textarea class="form-control" name="desc" rows="3" placeholder="当选择该商品时自动显示，支持HTML代码"
                                          data-name="desc"></textarea>
                            </div>
                            <div class="form-group">
                                <label>提示内容:</label>(没有请留空)<br>
                                <input type="text" class="form-control" name="alert"
                                       data-name="alert"
                                       placeholder="当选择该商品时自动弹出提示，不支持HTML代码">
                            </div>
                            <div class="form-group">
                                <label>商品图片:</label><br>
                                <input type="file" id="file" onchange="fileUpload()" style="display:none;"/>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="shopimg" name="shopimg"
                                           data-name="shopimg"
                                           placeholder="填写图片URL，没有请留空">
                                    <span class="input-group-btn">
                            <a href="javascript:fileSelect()" class="btn btn-success" title="上传图片">
                                <i class="glyphicon glyphicon-upload"></i>
                            </a>
                            <a href="javascript:fileView()" class="btn btn-warning" title="查看图片">
                                <i class="glyphicon glyphicon-picture"></i>
                            </a>
                        </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>显示数量选择框:</label><br>
                                <select class="form-control" name="multi"
                                        data-name="multi">
                                    <option value="1">1_是</option>
                                    <option value="0">0_否</option>
                                </select>
                            </div>
                            <table class="table table-striped table-bordered table-condensed" id="multi0"
                                   style="display:none;">
                                <tbody>
                                <tr align="center">
                                    <td>最小下单数量</td>
                                    <td>最大下单数量</td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="min" class="form-control input-sm"
                                               data-name="min"
                                               placeholder="留空则默认为1"/>
                                    </td>
                                    <td><input type="text" name="max" class="form-control input-sm"
                                               data-name="max"
                                               placeholder="留空则不限数量"/></td>
                                </tr>
                            </table>
                            <div class="form-group">
                                <label>允许重复下单:</label><br>
                                <select class="form-control" name="repeat"
                                        data-name="repeat">
                                    <option value="0">0_否</option>
                                    <option value="1">1_是</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>验证操作:</label><br>
                                <select class="form-control" name="validate"
                                       data-name="validate">
                                    <option value="0">不开启验证</option>
                                    <option value="1">验证QQ空间是否有访问权限</option>
                                </select>
                            </div>
                            <input type="submit" class="btn btn-primary btn-block" value="确定修改">
                        </div>
                        <a href="./shoplist.php" style="padding: 10px 0;display: block;">>>返回商品列表</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br/>
    <script>
        var productInfo = JSON.parse(window.atob("<?php echo base64_encode(json_encode($productInfo)); ?>"));
    </script>
    <script src="../assets/js/adminShopEdit.js?ver=<?php echo $conf['version']; ?>"></script>
<?php } ?>
