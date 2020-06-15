<?php

return [
    [
        'menuName'       => '后台管理',
        'url'            => './',
        'activeKey'      => 'index',
        'icon'           => 'fa fa-home',
        'parentMenuName' => [],
    ], [
        'menuName'       => '后台管理',
        'url'            => './',
        'activeKey'      => 'index',
        'icon'           => 'fa fa-home',
        'parentMenuName' => [
            [
                'menuName'       => '订单管理',
                'url'            => './orderList.php',
                'activeKey'      => 'orderList',
                'icon'           => 'fa fa-list',
            ], [
                'menuName'       => '',
                'url'            => '',
                'activeKey'      => '',
                'icon'           => '',
            ]
        ],
    ], [
        'menuName'       => '商品管理',
        'url'            => '',
        'activeKey'      => '',
        'icon'           => 'fa fa-shopping-cart',
        'parentMenuName' => [
            [
                'menuName'       => '分类列表',
                'url'            => './classlist.php',
                'activeKey'      => 'classlist',
                'icon'           => '',
            ], [
                'menuName'       => '商品列表',
                'url'            => './shoplist.php',
                'activeKey'      => 'shoplist,shopedit',
                'icon'           => '',
            ], [
                'menuName'       => '加价模板',
                'url'            => './priceModel.php',
                'activeKey'      => 'priceModel',
                'icon'           => '',
            ], [
                'menuName'       => '卡密列表',
                'url'            => './kmlist.php',
                'activeKey'      => 'kmlist',
                'icon'           => '',
            ]
        ],
    ], [
        'menuName'       => '发卡管理',
        'url'            => '',
        'activeKey'      => '',
        'icon'           => 'fa fa-th',
        'parentMenuName' => [
            [
                'menuName'       => '库存管理',
                'url'            => './fakalist.php',
                'activeKey'      => 'fakalist',
                'icon'           => '',
            ], [
                'menuName'       => '添加卡密',
                'url'            => './shoplist.php',
                'activeKey'      => 'shoplist,shopedit',
                'icon'           => '',
            ], [
                'menuName'       => '发信模板',
                'url'            => './priceModel.php',
                'activeKey'      => 'priceModel',
                'icon'           => '',
            ], [
                'menuName'       => '卡密列表',
                'url'            => './kmlist.php',
                'activeKey'      => 'kmlist',
                'icon'           => '',
            ]
        ],
    ]
];