<?php

use plugin\PluginInterface;

class sendRedPackPlugin extends PluginInterface
{
    // 插件的基础信息
    public $info = [
        'name'        => 'sendRedPack', // 插件标识
        'title'       => '发红包', // 插件名称
        // 插件简介
        'description' => '在首页弹出抢购红包按钮，供所有访问站点用户抢购，红包可在所有商品下单时抵扣使用，领取红包后弹出分享链接，可生成仿红链接，遇到链接失效(变成原网站链接)，请检查防红设置',
        'status'      => 0,  // 默认安装状态
        'author'      => '尐 〃呆萌&尐 〃呆瓜',
        'version'     => '1.3.0'
    ];

    /**
     * @var Smarty
     */
    private static $smarty;

    /**
     * @var sendRedPackModel
     */
    private static $model;

    public function _initialize()
    {
        if (!$this::$smarty instanceof Smarty) {
            $this::$smarty = new \Smarty();
            $this::$smarty->force_compile = true;
        }
        if (!$this::$model instanceof sendRedPackModel) {
            if (class_exists('sendRedPackModel')) {
                $this::$model = new \sendRedPackModel();
            }
        }
    }

    public function homeLoaded()
    {
        if (!$this::$model->checkRedRule()) { // 检查是否设置了红包规则
            return;
        }
        if ($this::$model->isRedPack()) { // 用户已经抢购过，插件钩子不执行，不再弹窗
            $this::$smarty->assign('money', 0);
            $this::$smarty->display($this->plugin_path . 'template/shop_script.html');
            return;
        }
        $this::$smarty->assign('static', '/assets/plugins/sendRedPack');
        $this::$smarty->assign('copy_text', 'loading...');
        global $cdnpublic;
        $this::$smarty->assign('cdnpublic', $cdnpublic);
        $this::$smarty->assign('content', $this::$smarty->fetch($this->plugin_path . 'template/index.html'));
        $this::$smarty->display($this->plugin_path . 'template/script.html');
    }

    // 调用公共异步函数
    public function publicAjaxFunction()
    {
        $type = isset($_GET['type']) ? $_GET['type'] : 0;
        switch ($type) {
            case 'loot': // 抢红包
                return $this::$model->saveRedPack();
                break;
            case 'check_deduction':
                $money = $this::$model->getRedMoney(); // 获取当前IP抢购的金额
                if ($money === -1 || $money === -2 || $money === -3) {
                    return ['msg' => 'error', 'status' => $money];
                }
                $this::$smarty->assign('money', $money['money']);
                $this::$smarty->assign('expire_time', date('Y-m-d H:i', $money['expire_time']));
                $price = isset($_POST['price']) ? str_replace(['￥', '元'], '', trim($_POST['price'])) : 0;
                $price = round($price, 2);
                $view = $this::$smarty->fetch($this->plugin_path . 'template/shop_red_pack.html');
                if ($price < $money['money']) {
                    return [
                        'msg' => 'success',
                        'status' => -3,
                        'data' => $view,
                    ];
                }
                return [
                    'msg' => 'success',
                    'status' => 0,
                    'data' => $view,
                ];
                break;
            default:
                return ['msg' => '非法操作', 'status' => -2];
                break;
        }
    }

    public function adminAjaxFunction()
    {
        $type = isset($_GET['type']) ? $_GET['type'] : 0;
        switch ($type) {
            case 'info_data':
                $result = $this::$model->getList();
                return ['msg' => 'success', 'status' => 0, 'data' => $result];
                break;
            case 'info':
                return ['msg' => 'success', 'status' => 0, 'data' => $this::$smarty->fetch($this->plugin_path . 'template/red_pack_info.html')];
                break;
            default:
                return ['msg' => '非法操作', 'status' => -2];
                break;
        }
    }

    // 订单提交之前，对支付订单增加抵扣状态
    public function beforeOrderSubmit($param)
    {
        $money = $this::$model->getRedMoney();
        if ($money === -1 || $money === -2 || $money === -3) { // 红包已使用，不做订单修改
            return $param;
        }
        $money = $money['money'];
        $this::$model->updateRedPackStatus($param['order_data']['ip'], $param['order_data']['userid'], $param['order_data']['trade_no'], 1);
        $param['order_data']['is_red_pack']    = 1;
        $param['order_data']['discount_money'] = $money;
        return $param;
    }

    // 首页购买商品之前，当前版本 v8.5.2 只能返回修改后下单所需的总金额
    public function beforeBuyCommodityHome($param)
    {
        $money = $this::$model->getRedMoney();
        if ($money === -1 || $money === -2 || $money === -3) { // 红包已使用，不做订单金额修改
            return $param;
        }
        $money         = $money['money'];
        $param['need'] = $money >= $param['need'] ? 0.00 : round($param['need'] - $money, 2);
        return $param;
    }

    public function beforeOrderCancel($param)
    {
        return $this::$model->removeRedPackStatus($param);
    }

    /**
     * @inheritDoc
     */
    public function install()
    {
        $flag = $this::$model->install();
        if ($flag) { // 安装成功后务必更新缓存
            global $CACHE;
            $CACHE->clear('plugins');
        }
        $old_path = str_replace(['/', '\\'], DS, $this->plugin_path . 'template/assets');
        $new_path = str_replace(['/', '\\'], DS, ROOT . 'assets/plugins/' . $this->getName());
        return xCopy($old_path, $new_path); // 复制静态资源文件
    }

    /**
     * @inheritDoc
     */
    public function uninstall()
    {
        $flag = $this::$model->uninstall();
        if ($flag) { // 卸载成功后务必更新缓存
            global $CACHE;
            $CACHE->clear('plugins');
        }
        $path = str_replace(['/', '\\'], DS, ROOT . 'assets/plugins/' . $this->getName());
        recursiveDelete($path); // 删除静态资源文件
        return true;
    }

    /**
     * @inheritDoc
     */
    public function enable()
    {
        global $CACHE;
        $CACHE->clear('plugins');
        return true;
    }

    /**
     * @inheritDoc
     */
    public function disable()
    {
        global $CACHE;
        $CACHE->clear('plugins');
        return true;
    }

    /**
     * @inheritDoc
     */
    public function saveConfig($data = [])
    {
        global $CACHE;
        if (!$this::$model->saveRedRule($data)) {
            showmsgAuto('生成红包规则异常，请稍后再试');
        }
        return $CACHE->save('PLUGINS_' . $this->info['name'], $data);
    }
}