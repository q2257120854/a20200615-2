<?php
use plugin\PluginInterface;

class PaySwitchPlugin extends PluginInterface
{
    // 插件的基础信息
    public $info = [
        'name' => 'PaySwitch', // 插件标识
        'title' => '支付切换', // 插件名称
        'description' => '设置某个商品的可支付类型', // 插件简介
        'status' => 0,  // 默认安装状态
        'author' => '尐 〃呆萌',
        'version' => '1.1.0'
    ];

    /**
     * @var PaySwitchModel
     */
    private static $model;

    public function _initialize()
    {
        if (!$this::$model instanceof PaySwitchModel) {
            if (class_exists('PaySwitchModel')) {
                $this::$model = new \PaySwitchModel();
            }
        }
    }

    public function productEditDetail($param)
    {
        $path = dirname(__FILE__) . DS . 'template/set_tools.php';
        if (is_file($path)) {
            $tid = (int)filterParam($_GET['tid']);
            if (!empty($tid)) {
                $m = new PaySwitchModel();
                $data = $m->getData($tid);
                $data = count($data) > 0 ? $data[0]['data'] : [];
            }
            $html = file_get_contents($path);
            $search = ['%ali_pay%', '%wx_pay%', '%qq_pay%', '{$p_ali_hidden}', '{$p_wx_hidden}', '{$p_qq_hidden}'];
            if (empty($data)) {
                $data = [
                    'ali_pay' => 'checked',
                    'wx_pay' => 'checked',
                    'qq_pay' => 'checked',
                ];
            } else {
                $data = [
                    'ali_pay' => isset($data['ali_pay']) && $data['ali_pay'] ? 'checked' : '',
                    'wx_pay' => isset($data['wx_pay']) && $data['wx_pay'] ? 'checked' : '',
                    'qq_pay' => isset($data['qq_pay']) && $data['qq_pay'] ? 'checked' : '',
                ];
            }
            global $conf;
            $data = array_merge($data, ['p_ali_hidden' => 'hidden', 'p_wx_hidden' => 'hidden', 'p_qq_hidden' => 'hidden']);
            if ($conf['alipay_api']) { // 全局开启才触发
                $data['p_ali_hidden'] = '';
            }
            if ($conf['wxpay_api']) { // 全局开启才触发
                $data['p_wx_hidden']  = '';
            }
            if ($conf['qqpay_api']) { // 全局开启才触发
                $data['p_qq_hidden']  = '';
            }
            $replace = [
                $data['ali_pay'],
                $data['wx_pay'],
                $data['qq_pay'],
                $data['p_ali_hidden'],
                $data['p_wx_hidden'],
                $data['p_qq_hidden'],
            ];
            echo str_replace($search, $replace, $html);
        }
    }

    public function beforeOrderSubmit($param)
    {
        // 如果用户没有开启只能使用余额下单
        if (1 != $param['only_balance']) {
            $data = $this::$model->getData($param['order_data']['tid']);
            $data = count($data) > 0 ? $data[0] : [];
            if (empty($data)) return false;
            global $conf;
            if ($conf['alipay_api']) { // 全局开启才触发
                $conf['alipay_api'] = isset($data['data']['ali_pay']) ? $data['data']['ali_pay'] : $conf['alipay_api'];
            }
            if ($conf['wxpay_api']) { // 全局开启才触发
                $conf['wxpay_api']  = isset($data['data']['wx_pay']) ? $data['data']['wx_pay'] : $conf['wxpay_api'];
            }
            if ($conf['qqpay_api']) { // 全局开启才触发
                $conf['qqpay_api']  = isset($data['data']['qq_pay']) ? $data['data']['qq_pay'] : $conf['qqpay_api'];
            }
        }
    }

    public function beforeCartOrderSubmit($param)
    {
        // 如果用户没有开启只能使用余额下单
        if (1 != $param['only_balance']) {
            $t_ids = $param['t_ids']; // 购物车下单的id集合
            $data = $this::$model->getData($t_ids);
            $is_set = ['ali_pay' => false, 'wx_pay' => false, 'qq_pay' => false];
            foreach ($data as $v) {
                if ($is_set['ali_pay'] && $is_set['wx_pay'] && $is_set['qq_pay']) {
                    continue;
                }
                if (!$is_set['ali_pay'] && isset($v['data']['ali_pay']) && 0 == $v['data']['ali_pay']) {
                    $conf['alipay_api'] = 0;
                    $is_set['ali_pay'] = true;
                }
                if (!$is_set['wx_pay'] && isset($v['data']['wx_pay']) && 0 == $v['data']['wx_pay']) {
                    $conf['wxpay_api'] = 0;
                    $is_set['ali_pay'] = true;
                }
                if (!$is_set['qq_pay'] && isset($v['data']['qq_pay']) && 0 == $v['data']['qq_pay']) {
                    $conf['qqpay_api'] = 0;
                    $is_set['ali_pay'] = true;
                }
            }
        }
    }

    public function afterProductEdit($param)
    {
        $data = [
            'ali_pay' => isset($param['data']['p_ali_pay']) ? $param['data']['p_ali_pay'] : 0,
            'wx_pay' => isset($param['data']['p_wx_pay']) ? $param['data']['p_wx_pay'] : 0,
            'qq_pay' => isset($param['data']['p_qq_pay']) ? $param['data']['p_qq_pay'] : 0,
        ];
        if (!empty($param['tid'])) {
            $this::$model->save($param['tid'], $data);
        }
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
        return true;
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
        // TODO: Implement saveConfig() method.
    }
}