<?php

return [
    'title' => [
        'title' => '<div style="font-weight: initial;">
<span style="color: red;">说明</span>：选择 [仅电脑端] ：不可售地区，只有电脑端打开时，用户访问地区符合 [不可售地区] 列表上的地区不能看到。其它选项道理相同。<br>
插件开启后，请在（商品管理-><a style="cursor: pointer;text-decoration: underline;" href="classlist.php">分类列表</a>）页面中设置</div><br>
<p style="color: red;">您当前所在地区为：<span class="areaName" style="color: #0c80df;">加载中。。。</span></p><script src="http://ip.ws.126.net/ipquery" type="text/javascript"></script>
<script>$(".areaName").text(localAddress["city"]+localAddress["province"]);</script>',
    ],
    'type'  => [
        'title'   => '不可售地区设备范围',
        'type'    => 'select',
        'options' => [
            '1' => '电脑端及移动设备端',
            '2' => '仅移动设备端',
            '3' => '仅电脑端',
        ],
        'value'   => '1',
    ],
];
