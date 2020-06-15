<?php
return [
    'title' => [
        'title' => '<span style="color: red;font-weight: initial;">温馨提示</span><span style="font-weight: initial;">：在首页弹出抢购红包窗体，供所有访问站点用户抢购，红包可在所有商品下单时抵扣使用，领取红包后弹出分享链接，可生成仿红链接，遇到链接失效(变成原网站链接)，请检查防红设置，新安装的插件需要设置规则后才能使用，每次设置会重新发新的红包</span><br><a href="javascript:;" style="color: green;" id="p_get_red_pack_info">红包抢购及使用记录查询</a>
<link href="/assets/layui/css/layui.css" rel="stylesheet">
<script src="/assets/layui/layui.js"></script>
<script>
$(\'#p_get_red_pack_info\').click(function() {
  layer.load(2);
  $.get(\'ajax.php?act=call_plugin_ajax&p_name=sendRedPack&type=info\', function(res) {
    layer.closeAll(\'loading\');
    if (!res.data) return layer.msg(\'返回数据异常\', {icon: 7});
    layer.open({
        type: 1
        , offset: \'200px\'
        , content: res.data
        , area: \'80%\'
    });
  }, \'json\').error(function() {
    layer.closeAll(\'loading\');
    layer.msg(\'系统异常，请联系相关人员\', {icon: 7})
  });
});
</script>',
    ],
    'total_money' => [
        'title' => '红包金额',
        'type' => 'text',
        'value' => '1.00',
        'tips'=>'<span style="color: red;">（红包总的金额，精确到小数后两位，请输入正数）</span>',
    ],
    'type' => [
        'title' => '红包类型<span style="color: red;">（拼手气：以红包总金额及个数作为条件随机取得金额；普通：以总金额及红包个数平均取得金额）</span>',
        'type' => 'select',
        'options' => [
            '1' => '拼手气',
            '2' => '普通',
        ],
        'value' => '1',
    ],
    'num' => [
        'title' => '红包个数',
        'type' => 'text',
        'value' => '100',
        'tips'=>'<span style="color: red;">（红包总个数，请输入正整数）</span>',
    ],
    'expire_in' => [
        'title' => '红包过期时间',
        'type' => 'text',
        'value' => '1',
        'tips'=>'<span style="color: red;">（红包过期时间，请输入正整数）</span>',
    ],
    'expire_unit' => [
        'title' => '红包过期时间单位<span style="color: red;">（以上的值 + 以下选择的单位）</span>',
        'type' => 'select',
        'options' => [
            '1' => '分钟',
            '2' => '小时',
            '3' => '天',
        ],
        'value' => '3',
    ],
//    'copy_text' => [
//        'title' => '分享内容',
//        'type' => 'text',
//        'tips' => '<span style="color: red;">（复制链接时带上的文本，会自动在该文本后加上站点链接，填空只有站点链接，200字以内生效）</span>',
//    ],
];