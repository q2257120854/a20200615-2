<script>
    function setRegion(cid) {
        layer.load(2);
        layer.open({
            content: `<div id="setRegion">
                            <div class="form-group">
                                <label>不可售地区列表&nbsp;</label><br><small style="color: #c2c2c2;">多个用回车分割，系统自动关键字匹配</small>
                                <textarea class="form-control" name="p_region" style="height: 200px;" placeholder="示例：
广州市番禺区
广州市天河区"></textarea>
                            </div>
                        </div>`
            , title: '设置不可售地区'
            , area: '50%'
            , success: function () {
                $.get('ajax.php?act=call_plugin_ajax&p_name=ClassDisplay&type=get', {
                    'cid': cid
                }).done(function (res) {
                    layer.closeAll('loading');
                    if (res['status'] === 0) {
                        $('#setRegion textarea[name=p_region]').val(res['data']['region']);
                    } else {
                        layer.msg(res['msg'], {icon: 8}); // 异常
                    }
                }).error(function () {
                    layer.closeAll('loading');
                });
            }
            , yes: function (index) {
                layer.load(2);
                $.post('ajax.php?act=call_plugin_ajax&p_name=ClassDisplay&type=save', {
                    'cid': cid,
                    'region': $('#setRegion textarea[name=p_region]').val()
                }).done(function (res) {
                    layer.closeAll('loading');
                    if (res['status'] === 0) {
                        layer.msg(res['msg'], {icon: 1});
                    } else {
                        layer.msg(res['msg'], {icon: 2});
                    }
                    layer.close(index);
                }).error(function () {
                    layer.closeAll('loading');
                });
            }
        });
    }
</script>