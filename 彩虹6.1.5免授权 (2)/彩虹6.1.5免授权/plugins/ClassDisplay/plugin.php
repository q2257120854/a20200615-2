<?php
// 必须继承插件接口类
use plugin\PluginInterface;

class ClassDisplayPlugin extends PluginInterface
{
    // 插件的基础信息
    public $info = [
        'name' => 'ClassDisplay', // 插件标识
        'title' => '动态商品分类', // 插件名称
        'description' => '商品分类动态不可售地区，控制不同地区分别显示', // 插件简介
        'status' => 0,  // 默认安装状态
        'author' => '尐 〃呆瓜',
        'version' => '1.1.0',
    ];

    /**
     * @var ClassDisplayModel
     */
    private static $model;

    public function _initialize()
    {
        if (!$this::$model instanceof ClassDisplayModel) {
            if (class_exists('ClassDisplayModel')) {
                $this::$model = new \ClassDisplayModel();
            }
        }
    }

    // 添加商品分类操作
    public function addClassHandle($param)
    {
        echo '<span class="btn btn-sm btn-warning" onclick="setRegion('.$param['cid'].')">不可售地区设置</span>';
    }

    // 商品分类页面加载完成后
    public function adminClassPageReady()
    {
        $path = dirname(__FILE__) . DS . 'template/script.php';
        if (is_file($path)) {
            echo file_get_contents($path);
        }
    }

    // 后台异步处理钩子
    public function adminAjaxFunction()
    {
        $type = filterParam($_GET['type']);
        if (empty($type)) {
            return ['msg' => '缺少参数', 'status' => -1];
        }
        if ($type == 'save') {
            $cid = (int)filterParam($_POST['cid'], 0);
            $region = (string)filterParam($_POST['region'], 0);
            if (empty($cid)) {
                return ['msg' => '缺少参数', 'status' => -1];
            }
            return $this::$model->save_for_cid($cid, $region);
        } elseif ($type == 'get') {
            $cid = (int)filterParam($_GET['cid'], 0);
            if (empty($cid)) {
                return ['msg' => '缺少参数', 'status' => -1];
            }
            return $this::$model->get_for_cid($cid);
        } else {
            return ['msg' => '非法参数', 'status' => -1];
        }
    }

    public function homeLoaded()
    {
        $list = $this::$model->getData();
        $conf = $this::$model->getConf(trim($this->info['name']));
        if (empty($conf)) {
            $conf = ['type' => 1];
        }
        $path = dirname(__FILE__) . DS . 'template/hide_class.php';
        if (is_file($path)) {
            $html = file_get_contents($path);
            $html = str_replace('\'{$conf}\'', json_encode($conf, JSON_UNESCAPED_UNICODE), $html);
            echo str_replace('\'{$list}\'', json_encode($list, JSON_UNESCAPED_UNICODE), $html);
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
        global $CACHE;
        return $CACHE->save('PLUGINS_' . $this->info['name'], $data);
    }
}