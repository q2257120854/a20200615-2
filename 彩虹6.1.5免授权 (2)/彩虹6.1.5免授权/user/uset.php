<?php
require '../includes/common.php';
if ($islogin2 != 1) {
    exit("<script>window.location.href='./login.php';</script>");
}

$title = '网站设置';
include 'head.php';
if ($conf['fenzhan_cost2'] <= 0) $conf['fenzhan_cost2'] = $conf['fenzhan_price2'];
?>
<div class="wrapper">
    <div class="col-sm-12">
        <?php
        $mod = isset($_GET['mod']) ? $_GET['mod'] : null;
        if ($mod == 'user_n') {
            $qq          = daddslashes(htmlspecialchars(strip_tags($_POST['qq'])));
            $pay_type    = daddslashes(intval($_POST['pay_type']));
            $pay_account = daddslashes(htmlspecialchars(strip_tags($_POST['pay_account'])));
            $pay_name    = daddslashes(htmlspecialchars(strip_tags($_POST['pay_name'])));
            $pwd         = daddslashes(htmlspecialchars(strip_tags($_POST['pwd'])));
            if (!empty($pwd) && !preg_match('/^[a-zA-Z0-9\_\!\@\#\$~\%\^\&\*.,]+$/', $pwd)) {
                exit("<script>alert('密码只能为英文与数字！');history.go(-1);</script>");
            } elseif (!preg_match('/^[0-9]{5,11}+$/', $qq)) {
                exit("<script>alert('QQ格式不正确！');history.go(-1);</script>");
            } else {
                $insertData = [
                    'qq'          => $qq,
                    'pay_type'    => $pay_type,
                    'pay_account' => $pay_account,
                    'pay_name'    => $pay_name,
                ];
                if (!empty($pwd)) {
                    $insertData['pwd'] = $pwd;
                }
                $flag = $DB->update('site', $insertData, ['zid' => $userrow['zid']]);
                if ($flag->rowCount() == 0) {
                    $msg = "修改保存失败！{$DB->error()}";
                    exit("<script>alert('" . $msg . "');history.go(-1);</script>");
                }
                exit("<script>alert('修改保存成功！');history.go(-1);</script>");
            }
        }elseif ($mod == 'user') {
            $url      = 'https://api.fcypay.com/';
            $m        = md5(rand(1000000, 9999999) . date('YmdHis') . uniqid());
            $code_url = $url . 'get_openid_qrcode?mark=' . $m;
            $cron_url = $url . 'get_openid_status?mark=' . $m;
            ?>
            <div class="panel panel-default">
                <div class="panel-heading font-bold" style="background-color: #9999CC;color: white;">用户资料设置</div>
                <div class="panel-body">
                    <form action="./uset.php?mod=user_n" method="post" role="form">
                        <div class="form-group">
                            <label>绑定ＱＱ:</label><br/>
                            <input type="text" name="qq" value="<?php echo $userrow['qq']; ?>" class="form-control"
                                   placeholder="用于联系与找回密码"/>
                        </div>
                        <?php if ($userrow['power'] > 0) { ?>
                            <div class="form-group">
                                <label>提现方式:</label><br/>
                                <select class="form-control" name="pay_type"
                                        default="<?php echo $userrow['pay_type'] ?>">
                                    <option value="0">支付宝</option>
                                    <option value="1">微信</option>
                                    <option value="2">QQ钱包</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>提现账号:</label><br/>
                                <input type="text" name="pay_account" value="<?php echo $userrow['pay_account']; ?>"
                                       class="form-control"/>
                                <a href="javascript:getopenid()" class="btn btn-info" style="display:none"
                                   id="getopenid">自动获取</a>
                            </div>
                            <div class="form-group">
                                <label>提现姓名:</label><br/>
                                <input type="text" name="pay_name" value="<?php echo $userrow['pay_name']; ?>"
                                       class="form-control"/>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label>重置密码:</label><br/>
                            <input type="text" name="pwd" value="" class="form-control" placeholder="不修改请留空"/>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/>
                        </div>
                    </form>
                </div>
            </div>
            <script src="<?php echo $cdnpublic ?>layer/2.3/layer.js"></script>
            <script src="<?php echo $cdnpublic ?>jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
            <script>
                var items = $("select[default]");
                for (i = 0; i < items.length; i++) {
                    $(items[i]).val($(items[i]).attr("default") || 0);
                }
                <?php if($conf['fenzhan_daifu'] == 1){?>
                var getopenid = function () {
                    var open = layer.open({
                        type: 1,
                        title: '',
                        content: '<div class="layui-card-body"><h3 style="text-align:center">请使用微信扫一扫</h3><div><div id="qrcode" style="padding:15px;"></div></div></div>',
                        cancel: function (index, layero) {
                            layer.close(open);
                            window.clearInterval(cron);
                        }, success: function () {
                            var code_url = '<?php echo $code_url?>';
                            $('#qrcode').qrcode({
                                text: code_url,
                                width: 230,
                                height: 230,
                                foreground: "#000000",
                                background: "#ffffff",
                                typeNumber: -1
                            });
                        }
                    });
                    var cron = setInterval(function () {
                        $.ajax({
                            type: "GET",
                            url: '<?php echo $cron_url;?>' + '&r=' + Math.random(),
                            dataType: "json",
                            success: function (data) {
                                if (data.code) {
                                    $("input[name=pay_account]").val(data.data);
                                    layer.close(open);
                                    window.clearInterval(cron);
                                }
                            }
                        });
                    }, 3000);
                }
                $("select[name='pay_type']").change(function () {
                    if ($(this).val() == 1) {
                        $("#getopenid").show();
                        $("input[name=pay_account]").attr("readOnly", "readOnly");
                    } else {
                        $("#getopenid").hide();
                        $("input[name=pay_account]").removeAttr("readOnly");
                    }
                });
                $("select[name='pay_type']").change();
                <?php }?>
            </script>
        <?php
        } elseif ($mod == 'site_n' && $userrow['power'] > 0) {
            $sitename    = stringRemoveXss(trim(htmlspecialchars(strip_tags($_POST['sitename']))));
            $title       = stringRemoveXss(trim(htmlspecialchars(strip_tags($_POST['title']))));
            $keywords    = stringRemoveXss(trim(htmlspecialchars(strip_tags($_POST['keywords']))));
            $description = stringRemoveXss(trim(htmlspecialchars(strip_tags($_POST['description']))));
            $anounce     = trim($_POST['anounce']);
            $modal       = trim($_POST['modal']);
            $bottom      = trim($_POST['bottom']);
            $alert       = trim($_POST['alert']);
            $ktfz_price  = daddslashes($_POST['ktfz_price']);
            $ktfz_price2 = daddslashes($_POST['ktfz_price2']);
            $ktfz_domain = daddslashes($_POST['ktfz_domain']);
            $template    = isset($_POST['template']) ? daddslashes($_POST['template']) : null;
            if ($sitename == null) {
                exit("<script>alert('请确保各项不能为空');history.go(-1);</script>");
            } else {
                if (!empty($template) && (!preg_match('/^[a-zA-Z0-9]+$/', $template) || Template::exists($template) == false))
                    exit("<script>alert('该模板首页文件不存在！');history.go(-1);</script>");
                if ($userrow['power'] == 2) {
                    if (!is_numeric($ktfz_price) || !preg_match('/^[0-9.]+$/', $ktfz_price))
                        exit("<script>alert('普及分站价格输入不规范');history.go(-1);</script>");
                    if (!is_numeric($ktfz_price2) || !preg_match('/^[0-9.]+$/', $ktfz_price2))
                        exit("<script>alert('专业分站价格输入不规范');history.go(-1);</script>");
                    if ($ktfz_price2 < $conf['fenzhan_cost2'])
                        exit("<script>alert('专业分站价格不能低于成本价');history.go(-1);</script>");
                    if ($ktfz_price2 < $ktfz_price)
                        exit("<script>alert('专业分站价格不能低于普及分站价格');history.go(-1);</script>");
                    $sds = $DB->update('site', [
                        'sitename'    => $sitename,
                        'title'       => $title,
                        'keywords'    => $keywords,
                        'description' => $description,
                        'kaurl'       => isset($kaurl) ? $kaurl : '',
                        'anounce'     => $anounce,
                        'modal'       => $modal,
                        'bottom'      => $bottom,
                        'alert'       => $alert,
                        'ktfz_price'  => $ktfz_price,
                        'ktfz_price2' => $ktfz_price2,
                        'ktfz_domain' => $ktfz_domain,
                        'template'    => $template,
                    ], ['zid' => $userrow['zid']]);
                } else {
                    $sds = $DB->update('site', [
                        'sitename'    => $sitename,
                        'title'       => $title,
                        'keywords'    => $keywords,
                        'description' => $description,
                        'anounce'     => $anounce,
                        'modal'       => $modal,
                        'bottom'      => $bottom,
                        'alert'       => $alert,
                        'template'    => $template,
                    ], ['zid' => $userrow['zid']]);
                }
                if ($sds->rowCount() > 0) {
                    exit("<script>alert('修改保存成功');history.go(-1);</script>");
                } elseif ($DB->error() == '[]') {
                    exit('<script>alert("您未做任何修改");history.go(-1);</script>');
                } else {
                    exit('<script>alert("修改保存失败，错误信息：' . $DB->error() . '");history.go(-1);</script>');
                }
            }
        }
        elseif ($mod == 'site' && $userrow['power'] > 0){
        $mblist = Template::getList();
        ?>
            <div class="panel panel-default">
                <div class="panel-heading font-bold" style="background-color: #9999CC;color: white;">网站信息设置</div>
                <div class="panel-body">
                    <form action="./uset.php?mod=site_n" method="post" role="form">
                        <div class="form-group">
                            <label>网站名称:</label><br>
                            <input type="text" name="sitename" value="<?php echo $userrow['sitename']; ?>"
                                   class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label>标题栏后缀</label><br>
                            <input type="text" name="title" value="<?php echo $userrow['title']; ?>"
                                   class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>关键字</label><br>
                            <input type="text" name="keywords" value="<?php echo $userrow['keywords']; ?>"
                                   class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>网站描述</label><br>
                            <input type="text" name="description" value="<?php echo $userrow['description']; ?>"
                                   class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>首页公告</label><br>
                            <textarea class="form-control" name="anounce"
                                      rows="6"><?php echo htmlspecialchars($userrow['anounce']); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>首页弹出公告</label><br>
                            <textarea class="form-control" name="modal"
                                      rows="5"><?php echo htmlspecialchars($userrow['modal']); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>首页底部排版</label><br>
                            <textarea class="form-control" name="bottom"
                                      rows="5"><?php echo htmlspecialchars($userrow['bottom']); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>在线下单提示</label><br>
                            <textarea class="form-control" name="alert"
                                      rows="5"><?php echo htmlspecialchars($userrow['alert']); ?></textarea>
                        </div>
                        <?php if ($userrow['power'] == 2) { ?>
                            <div class="form-group">
                                <label>普通分站价格</label><br>
                                <input type="text" name="ktfz_price"
                                       value="<?php echo $userrow['ktfz_price'] > 0 ? $userrow['ktfz_price'] : $conf['fenzhan_price']; ?>"
                                       class="form-control"/>
                                <pre>前台自助开通分站的价格</pre>
                            </div>
                            <div class="form-group">
                                <label>专业分站价格</label><br>
                                <input type="text" name="ktfz_price2"
                                       value="<?php echo $userrow['ktfz_price2'] > $conf['fenzhan_cost2'] ? $userrow['ktfz_price2'] : $conf['fenzhan_price2']; ?>"
                                       class="form-control"/>
                                <pre>前台自助开通分站的价格，不能低于成本价<?php echo $conf['fenzhan_cost2'] ?>元</pre>
                            </div>
                            <div class="form-group">
                                <label>分站可选择域名</label><br>
                                <input type="text" name="ktfz_domain" value="<?php echo $userrow['ktfz_domain']; ?>"
                                       class="form-control"/>
                                <pre>默认使用主站域名，没有请留空，不要乱填写！多个域名用,隔开！</pre>
                            </div>
                        <?php } ?>
                        <?php if ($conf['fenzhan_template'] == 1) { ?>
                            <div class="form-group">
                                <label>首页模板设置</label><br>
                                <select class="form-control" name="template">
                                    <?php foreach ($mblist as $row) {
                                        echo '<option value="' . $row . '" ' . ($userrow['template'] == $row ? 'selected' : null) . '>' . $row . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        <?php } ?>
                        <?php if ($conf['fenzhan_editd'] > 0) { ?>
                            <div class="form-group">
                                <label>本站域名</label><br>
                                <div class="input-group">
                                    <input type="text" name="domain" value="<?php echo $userrow['domain']; ?>"
                                           class="form-control" disabled/>
                                    <div class="input-group-addon"><a href="cdomain.php">自助更换域名</a></div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/>
                        </div>
                    </form>
                </div>
                <!--                <div class="panel-footer">-->
                <!--                    <span class="glyphicon glyphicon-info-sign"></span>-->
                <!--                    实用工具：<a href="uset.php?mod=copygg">一键复制其他站点排版</a>｜<a-->
                <!--                            href="http://www.w3school.com.cn/tiy/t.asp?f=html_basic" target="_blank" rel="noreferrer">HTML在线测试</a>｜<a-->
                <!--                            href="http://pic.xiaojianjian.net/" target="_blank" rel="noreferrer">图床</a>｜<a-->
                <!--                            href="http://music.cccyun.cc/" target="_blank" rel="noreferrer">音乐外链</a>-->
                <!--                </div>-->
            </div>
        <?php
        } elseif ($mod == 'copygg_n' && $_POST['do'] == 'submit' && $userrow['power'] > 0) {
            $url     = $_POST['url'];
            $content = $_POST['content'];
            $url_arr = parse_url($url);
            if ($url_arr['host'] == $_SERVER['HTTP_HOST'])
                showmsg('无法自己复制自己', 3);
            $data = get_curl($url . 'api.php?act=siteinfo');
            $arr  = json_decode($data, true);
            if (array_key_exists('sitename', $arr)) {
                if (in_array('anounce', $content))
                    $anounce = addslashes(str_replace($arr['kfqq'], $userrow['qq'], $arr['anounce']));
                else
                    $anounce = addslashes($userrow['anounce']);
                if (in_array('modal', $content))
                    $modal = addslashes(str_replace($arr['kfqq'], $userrow['qq'], $arr['modal']));
                else
                    $modal = addslashes($userrow['modal']);
                if (in_array('bottom', $content))
                    $bottom = addslashes(str_replace($arr['kfqq'], $userrow['qq'], $arr['bottom']));
                else
                    $bottom = addslashes($userrow['bottom']);
                $sds = $DB->update('site', [
                    'anounce' => $anounce,
                    'modal'   => $modal,
                    'bottom'  => $bottom,
                ], ['zid' => $userrow['zid']]);
                if ($sds->rowCount() > 0) exit("<script>alert('修改保存成功！');history.go(-1);</script>");
                else exit("<script>alert('修改保存失败:" . $DB->error() . "');history.go(-1);</script>");
            } else {
                showmsg('获取数据失败，对方网站无法连接或非代刷网站。', 4);
            }
        }
        elseif ($mod == 'copygg'){
        ?>
            <div class="panel panel-default">
                <div class="panel-heading font-bold" style="background-color: #9999CC;color: white;">一键复制其他站点排版</div>
                <div class="panel-body">
                    <form action="./uset.php?mod=copygg_n" method="post" role="form"><input type="hidden" name="do"
                                                                                            value="submit"/>
                        <div class="form-group">
                            <label>站点URL</label>
                            <input type="text" name="url" value="" class="form-control" placeholder="http://www.qq.com/"
                                   required/>
                        </div>
                        <br/>
                        <div class="form-group">
                            <label>复制内容：</label><br>
                            <label><input name="content[]" type="checkbox" value="anounce" checked/>
                                首页公告</label><br/><label><input name="content[]" type="checkbox" value="modal" checked/>
                                弹出公告</label><br/><label><input name="content[]" type="checkbox" value="bottom" checked/>
                                底部排版</label>
                        </div>
                        <input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/>
                    </form>
                </div>
            </div>
            <?php
        } elseif ($mod == 'logo' && $userrow['power'] > 0) {
            echo '<div class="panel panel-default"><div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" >更改首页LOGO</div><div class="panel-body">提示：部分模板不显示logo图片，是正常现象！<br/>';
            if ($_POST['s'] == 1) {
                $uploadResult = imageUpload('file', 'assets/img/', 'logo_' . $userrow['zid'], 'png');
                if ($uploadResult['code'] != 0) {
                    echo '[上传失败]' . $uploadResult['msg'];
                } else {
                    echo '成功上传文件!<br>（可能需要清空浏览器缓存才能看到效果，按Ctrl+F5即可一键刷新缓存）';
                }
            }
            if (is_file(ROOT . 'assets/img/logo_' . $userrow['zid'] . '.png')) {
                $logo = '../assets/img/logo_' . $userrow['zid'] . '.png';
            } else {
                $logo = '../assets/img/logo.png';
            }
            echo '<form action="uset.php?mod=logo" method="POST" enctype="multipart/form-data"><label for="file"></label><input type="file" name="file" id="file" /><input type="hidden" name="s" value="1" /><br><input type="submit" class="btn btn-primary form-control" value="确认上传" /></form><br>现在的图片：<br><img src="' . $logo . '" style="max-width:30%">';
            echo '</div></div>';
        } elseif ($mod == 'skimg' && $userrow['power'] > 0) {

            echo '<div class="panel panel-default"><div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" >提现收款图设置</div><div class="panel-body">';
            if ($_POST['s'] == 1) {
                $uploadResult = imageUpload('shoukuan', 'assets/img/skimg/', 'sk_' . $userrow['zid'], 'png');
                if ($uploadResult['code'] != 0) {
                    echo '[上传失败]' . $uploadResult['msg'];
                } else {
                    echo '成功上传文件!<br>（可能需要清空浏览器缓存才能看到效果，按Ctrl+F5即可一键刷新缓存）';
                }
            }
            if (is_file(ROOT . 'assets/img/skimg/sk_' . $userrow['zid'] . '.png')) {
                $logo = '../assets/img/skimg/sk_' . $userrow['zid'] . '.png';
            } else {
                $logo = '../assets/img/skimg/sk.png';
            }
            echo '<form action="uset.php?mod=skimg" method="POST" enctype="multipart/form-data"><label for="file"></label><input type="file" name="shoukuan" id="shoukuan" /><input type="hidden" name="s" value="1" /><br><input type="submit" class="btn btn-primary form-control" value="确认上传" /></form><br>现在的收款图：<br><img src="' . $logo . '" style="max-width:30%">';
            echo '</div></div>';
        } ?>
    </div>
</div>
