<?php
/**
 * 系统修复
 **/
include '../includes/common.php';
$title = '系统数据库修复';
include './head.php';
if ($islogin != 1)
    exit('<script>window.location.href="./login.php";</script>');
?>
<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
    <div class="block">
        <div class="block-title"><h3 class="panel-title">系统数据库修复</h3></div>
        <div>
            <?php if (!empty($conf['is_sys_restore'])): ?>
            <div class="alert alert-success" role="alert">
                您已经修复过，无需再次修复。
            </div>
            <?php else: ?>
            <div class="alert alert-info" role="alert">
                当你的系统数据库结构出现问题时，会导致某些业务逻辑无法正常执行，您可点击下方开始修复数据表结构。<br>
                如果你的数据库结构太旧（非新安装、未覆盖数据库安装、订单量较多用户），该操作可能会耗时较长，请您耐心等待。<br>
                期间可能会无法访问网站，建议使用电脑在站点访问量低阶段进行操作。<br>
                根据模拟测试，订单量达到500万的站点用户，大概需要时间10分钟，不同服务器可能会有偏差，数据仅供参考，以实际执行时间为准。
            </div>
            <div class="progress progress-striped active" style="display: none;">
                <div id="prog" class="progress-bar" role="progressbar" aria-valuenow=""
                     aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                    <span class="sr-only">0%</span>
                </div>
            </div>
            <div id="my_msg"></div>
            <hr/>
            <a href="javascript:" id="start" class="btn btn-primary btn-block">开始修复</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php if (empty($conf['is_sys_restore'])): ?>
<script>
    var flag = false;
    var int = false;
    const active = {
        start: function (time) {
            let value = 0;
            time = time / 100;
            int = setInterval(function () {
                if (value < 100) {
                    if (value < 88) {
                        value = parseInt(value) + 1;
                    }
                    if (flag) {
                        value = parseInt(value) + 1;
                    }
                    $('#prog').css('width', value + '%').text(value + '%');
                    if (value >= 0 && value <= 30) {
                        $('#prog').addClass('progress-bar-danger');
                    }
                    if (value >= 100) {
                        $('#prog').parent().removeClass('active');
                        $('#prog').removeClass('progress-bar-info').addClass('progress-bar-success');
                        $('#start').removeClass('btn-info').addClass('btn-success').text('修复完成').removeAttr('disabled');
                        setTimeout(function () {
                            $('#start').attr({
                                'href': 'javascript:'
                                ,'onclick': 'location.href=\'index.php\''
                            }).text('返回首页').removeAttr('id');
                        }, 800);
                    }
                }
            }, time);
        }
    };
    $('#start').click(function () {
        if (flag) return false;
        layer.confirm('您确认目前站点访问量较低吗？', {icon: 3, title: '系统提示'}, function (index) {
            $('#start').removeClass('btn-primary').addClass('btn-danger').text('正在修复...');
            $('#prog').parent().show();
            active.start(60000);
            $('#start').attr('disabled', 'disabled');
            $.post('ajax.php?act=sys_restore', function (res) {
                if (res['code'] !== 0 && res['msg']) {
                    $('#my_msg').html(`<div class="alert alert-danger" role="alert">` + res['msg'] + `</div>`);
                    clearInterval(int);
                    flag = true;
                    setTimeout(function () {
                        $('#start').attr({
                            'href': 'javascript:'
                            ,'onclick': 'location.reload()'
                        }).text('刷新页面').removeAttr('disabled');
                    }, 800);
                } else {
                    flag = true;
                }
            }).error(function () {
                flag = true;
            });
            layer.close(index);
        });
    });
</script>
<?php endif; ?>