<?php
namespace plugin;

class AdminMenu
{
    /**
     * 静态储存菜单数据
    */
    private static $adminMenu = [];

    /**
     * 往菜单添加一项子菜单
     * @param string $menuName 菜单名称
     * @param string $url 菜单URL
     * @param string $activeKey 当前URL菜单选中的样式类名称
     * @param string $icon 菜单左侧图标
     * @param string $parentMenuName 菜单父类名，顶级菜单无需传入
    */
    public static function addMenu($menuName, $url = '', $activeKey = '', $icon = '', $parentMenuName = '')
    {
        $menuName = strip_tags($menuName);
        $url      = daddslashes($url);
        $icon     = daddslashes($icon);

        if (empty($menuName))
            return;

        $menuNameKey = md5($menuName);
        //生成键名

        $insertData = [
            'name'      => $menuName,
            'url'       => $url,
            'icon'      => $icon,
            'activeKey' => $activeKey
        ];
        //初始化插入数据

        if (!empty($parentMenuName)) {
            if (isset(self::$adminMenu[md5($parentMenuName)]))
                self::$adminMenu[md5($parentMenuName)]['children'][$menuNameKey] = $insertData;
            else
                self::$adminMenu[md5($parentMenuName)] = [
                    'name'     => $parentMenuName,
                    'icon'     => '',
                    'children' => [
                        $menuNameKey => $insertData
                    ]
                ];

            return;
        }

        if (isset(self::$adminMenu[$menuNameKey]['children']))
            $insertData['children'] = self::$adminMenu[$menuNameKey]['children'];

        self::$adminMenu[$menuNameKey] = $insertData;
    }

    /**
     * 渲染后台菜单
     * @return string 菜单html代码
    */
    public static function fetch()
    {
        $menuHtmlStr = '';
        foreach (self::$adminMenu as $v) {
            $v['children'] = isset($v['children']) ? $v['children'] : [];
            $menuHtmlStr .= '<li class="'.checkIfActive(implode(',', key_array('activeKey', $v['children']))) . '">';
            if (!empty($v['children'])) {
                $menuHtmlStr .= '<a href="javascript:void(0);" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="'.$v['icon'].' sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">'.$v['name'].'</span></a>';
            } else {
                $menuHtmlStr .= '<a class="';
                $menuHtmlStr .= checkIfActive($v['activeKey']).'"';
                $menuHtmlStr .= ' href="'.$v['url'].'"><i class="'.$v['icon'].' sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">'.$v['name'].'</span></a>';
            }
            $menuHtmlStr .= '<ul>';
            if (is_array($v['children'])) {
                if (count($v['children']) > 0) {
                    foreach ($v['children'] as $childValue) {
                        $menuHtmlStr .= '<li><a class="' . checkIfActive($childValue['activeKey']) . '"';
                        $menuHtmlStr .= ' href="' . $childValue['url'] . '">' . $childValue['name'] . '</a></li>';
                    }
                }
            }
            $menuHtmlStr .= '</ul></li>';
        }
        return $menuHtmlStr;
    }
}