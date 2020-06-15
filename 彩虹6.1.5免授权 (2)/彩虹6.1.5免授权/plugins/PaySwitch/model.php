<?php
use ds\BasePluginModel AS Base;

class PaySwitchModel extends Base
{
    // 插件需要用到的钩子
    protected $hooks = ['beforeOrderSubmit', 'beforeCartOrderSubmit', 'productEditDetail', 'afterProductEdit'];

    private $table_name = 'tools_pay_type';

    public function install()
    {
        return $this->handle->action(function () {
            try {
                installSql('PaySwitch');
                return $this->bindHoods('PaySwitch', $this->hooks);
            } catch (Exception $e) {
                log_result('插件管理', '插件[PaySwitch]安装异常', $e->getMessage(), 1);
                return false;
            }
        });
    }

    public function uninstall()
    {
        return $this->handle->action(function () {
            try {
                uninstallSql('PaySwitch');
                return $this->unbindHoods('PaySwitch', $this->hooks);
            } catch (Exception $e) {
                log_result('插件管理', '插件[PaySwitch]卸载异常', $e->getMessage(), 1);
                return false;
            }
        });
    }

    public function getData($t_ids)
    {
        $data = $this->handle->select($this->table_name, ['tid', 'data'], ['tid' => $t_ids]);
        if (empty($data)) return [];
        foreach ($data as &$value) {
            $value['tid'] = intval($value['tid']);
            $value['data'] = json_decode($value['data'], true);
        }
        return $data;
    }

    public function save($tid, $data)
    {
        if ($this->handle->has($this->table_name, ['tid' => $tid])) {
            $flag = $this->handle->update($this->table_name, [
                'data' => json_encode($data, JSON_UNESCAPED_UNICODE),
                'update_time' => time(),
            ], ['tid' => $tid]);
        } else {
            $flag = $this->handle->insert($this->table_name, [
                'tid' => $tid,
                'data' => json_encode($data, JSON_UNESCAPED_UNICODE),
            ]);
        }
        if ($flag->rowCount() > 0) {
            return true;
        }
        log_result('插件管理', '', '插件[PaySwitch]商品数据保存失败', 1);
        return false;
    }
}