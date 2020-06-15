<?php
use ds\BasePluginModel AS Base;

class ClassDisplayModel extends Base
{
    // 插件需要用到的钩子
    protected $hooks = ['addClassHandle', 'adminClassPageReady', 'homeLoaded'];

    public function install()
    {
        return $this->handle->action(function () {
            try {
                installSql('ClassDisplay');
                return $this->bindHoods('ClassDisplay', $this->hooks);
            } catch (Exception $e) {
                log_result('插件管理', '插件安装异常', $e->getMessage(), 1);
                return false;
            }
        });
    }

    public function uninstall()
    {
        return $this->handle->action(function () {
            try {
                uninstallSql('ClassDisplay');
                return $this->unbindHoods('ClassDisplay', $this->hooks);
            } catch (Exception $e) {
                log_result('插件管理', '插件卸载异常', $e->getMessage(), 1);
                return false;
            }
        });
    }

    // 按分类保存区域显示数据
    public function save_for_cid($cid, $data)
    {
        $region = empty(implode(',', explode("\n", trim($data)))) ? '' : implode(',', explode("\n", trim($data)));
        if ($this->handle->has('class_region', ['cid' => $cid])) {
            $flag = $this->handle->update('class_region', [
                'region' => $region,
                'update_time' => time(),
            ], ['cid' => $cid]);
        } else {
            $flag = $this->handle->insert('class_region', [
                'cid' => $cid,
                'region' => $region,
            ]);
        }
        if ($flag->rowCount() > 0) {
            return ['msg' => '设置成功', 'status' => 0];
        }
        return ['msg' => '设置失败', 'status' => -1];
    }

    public function get_for_cid($cid)
    {
        $region = $this->handle->get('class_region', 'region', ['cid' => $cid]);
        $region = explode(',', $region);
        $region = implode("\n", $region);
        return ['msg' => 'ok', 'status' => 0, 'data' => ['region' => $region]];
    }

    public function getData()
    {
        $regions = $this->handle->select('class_region', ['cid', 'region'], [
            'OR' => [
                'region[!]' => '',
            ]
        ]);
        foreach ($regions as &$region) {
            $region['cid'] = intval($region['cid']);
            $region['region'] = explode(',', $region['region']);
        }
        return key_value_column('cid', 'region', $regions);
    }
}