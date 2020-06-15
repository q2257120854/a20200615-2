<?php

use ds\BasePluginModel AS Base;

class sendRedPackModel extends Base
{
    // 插件需要用到的钩子
    protected $hooks = ['homeLoaded', 'beforeOrderSubmit', 'beforeBuyCommodityHome', 'beforeOrderCancel'];

    // 插件需要用到的表，无需前缀
    const TABLE_NAME = 'plugin_send_red_pack';

    const TABLE_NAME2 = 'plugin_send_red_pack_rule';

    // 防红接口使用
    private function encodeUrl($url)
    {
        global $conf;
        if (2 == $conf['fanghong_api'] || 1 == $conf['fanghong_api']) {
            $url = fanghongvip($url);
            if ($url['code'] != 0) {
                $url = $url['msg'];
            } else {
                foreach ($url['data'] as $value) {
                    if (!empty($value['url'])) {
                        $url = $value['url'];
                        break;
                    }
                }
            }
        } else if ($conf['fanghong_api'] > 0) {
            $url = fanghongdwz($url);
        }
        return $url;
    }

    // 安装插件
    public function install()
    {
        return $this->handle->action(function () {
            try {
                installSql('sendRedPack');
                return $this->bindHoods('sendRedPack', $this->hooks);
            } catch (Exception $e) {
                log_result('插件管理', '插件[sendRedPack]安装异常', $e->getMessage(), 1);
                return false;
            }
        });
    }

    // 卸载插件
    public function uninstall()
    {
        return $this->handle->action(function () {
            try {
                uninstallSql('sendRedPack');
                return $this->unbindHoods('sendRedPack', $this->hooks);
            } catch (Exception $e) {
                log_result('插件管理', '插件[sendRedPack]卸载异常', $e->getMessage(), 1);
                return false;
            }
        });
    }

    // 检查是否已经抢购过
    public function isRedPack()
    {
        $rule_row = $this->handle->get(self::TABLE_NAME2, ['id', 'type'], ['ORDER' => ['id' => 'DESC']]);
        if (empty($rule_row)) {
            return false;
        }
        $row = $this->handle->has(self::TABLE_NAME, ['rule_id' => $rule_row['id'], 'ip' => real_ip(), 'type' => $rule_row['type']]);
        return $row ? true : false;
    }

    // 记录抢购的红包
    public function saveRedPack()
    {
        $rule_row = $this->handle->get(self::TABLE_NAME2, ['id', 'type', 'rules'], ['ORDER' => ['id' => 'DESC']]);
        if (empty($rule_row)) {
            return ['msg' => 'error', 'status' => 1];
        }
        // 获取生成红包的规则
        $rules = json_decode($rule_row['rules'], true);
        // 获取当前规则红包的领取个数
        $num = $this->handle->count(self::TABLE_NAME, ['rule_id' => $rule_row['id']]);
        if ($num == count($rules)) {
            return ['msg' => 'error', 'status' => 2]; // 红包已发完
        }
        $money     = $rules[intval($num)]; // 取出下个人能够领取的红包金额
        $client_ip = real_ip();
        if ($this->handle->has(self::TABLE_NAME, [
            'rule_id' => $rule_row['id'],
            'ip'      => $client_ip,
            'userid'  => isset($cookiesid) ? $cookiesid : ''
        ])) {
            return ['msg' => 'success', 'status' => 2]; // 防止客户端ip重复抢红包
        }
        $flag = $this->handle->insert(self::TABLE_NAME, [
            'rule_id'     => $rule_row['id'],
            'ip'          => $client_ip,
            'userid'      => isset($cookiesid) ? $cookiesid : '',
            'type'        => $rule_row['type'],
            'money'       => $money,
            'create_time' => time()
        ]);
        if ($flag->rowCount() > 0) {
            if ($money <= 0) {
                return ['msg' => 'success', 'status' => 2];
            }
//            $share_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $share_url = $this->encodeUrl($_SERVER['HTTP_REFERER']);
            if (!preg_match('/^(http:\/\/|https:\/\/)/', $share_url)) {
                $share_url = $_SERVER['HTTP_REFERER'];
            }
            return ['msg' => 'success', 'status' => 0, 'data' => ['money' => $money, 'type' => $money > 0 ? 1 : 0,'share_url' => $share_url]];
        }
        return ['msg' => '非法操作', 'status' => -1];
    }

    // 从配置数据中计算出红包规则
    public function saveRedRule($data)
    {
        $avg_money = bcdiv($data['total_money'], $data['num'], 2);
        if ($avg_money < 0.01) {
            showmsgAuto('生成红包规则失败，红包总金额与红包个数不合法，请确保每个红包大于等于￥0.01');
        }
        if ($data['type'] == 1) {
            if ($avg_money > 1) { // 人均超过 1 元
                $min = 1; // 随机最小分 1 元
            } else {
                $min = 0.01; // 随机最小分 0.01 元
            }
            $result = red_packet_compute(round($data['total_money'], 2), intval($data['num']), $min);
        } else {
            $result = [];
            for ($i = 0; $i < intval($data['num']); $i++) {
                $result[] = $avg_money;
            }
        }
        $flag = $this->handle->insert(self::TABLE_NAME2, [
            'type'        => intval($data['type']),
            'rules'       => json_encode($result),
            'create_time' => time(),
        ]);
        return $flag->rowCount() > 0 ? true : false;
    }

    // 检查是否有设置规则
    public function checkRedRule()
    {
        $result = $this->handle->count(self::TABLE_NAME2);
        return $result > 0 ? true : false;
    }

    // 获取当前用户抢购的红包金额
    public function getRedMoney()
    {
        $rule_row = $this->handle->get(self::TABLE_NAME2, ['id', 'type'], ['ORDER' => ['id' => 'DESC']]);
        if (empty($rule_row)) {
            return -1;
        }
        $config = $this->getConf('sendRedPack');
        $row    = $this->handle->get(self::TABLE_NAME, ['money', 'create_time'], [
            'rule_id' => $rule_row['id'],
            'ip'      => real_ip(),
            'type'    => $rule_row['type'],
            'is_use'  => 0,
        ]);
        if (empty($row)) return -3;
        switch (intval($config['expire_unit'])) {
            case 1: // 分钟
                $config['expire_in'] = $config['expire_in'] * 60;
                break;
            case 2: // 小时
                $config['expire_in'] = $config['expire_in'] * 3600;
                break;
            case 3: // 天
                $config['expire_in'] = $config['expire_in'] * 3600 * 24;
                break;
        }
        if ($row['create_time'] + $config['expire_in'] < time()) {
            return -2;
        }
        $row['expire_time'] = $row['create_time'] + $config['expire_in'];
        return $row;
    }

    // 更新红包使用状态 0 该操作已在事务中
    public function removeRedPackStatus($pay_row)
    {
        global $dbconfig;
        $table2 = $dbconfig['dbqz'] . '_' . self::TABLE_NAME2;
        $rule_row = $this->handle->query("SELECT `id` FROM `{$table2}` ORDER BY `id` DESC LIMIT 1 FOR UPDATE")->fetch(2);
        if (empty($rule_row)) return false;
        $table = $dbconfig['dbqz'] . '_' . self::TABLE_NAME;
        $sql = "SELECT `id` FROM `{$table}` WHERE `rule_id` = '{$rule_row['id']}' AND `ip` = '{$pay_row['ip']}' ";
        $sql .= "AND `trade_no` = '{$pay_row['trade_no']}' AND `userid` = '{$pay_row['userid']}' AND `is_use` = 1 FOR UPDATE";
        $red_row = $this->handle->query($sql)->fetch(2);
        if (empty($red_row)) return false;
        $flag = $this->handle->update(self::TABLE_NAME, ['is_use' => 0, 'userid' => '', 'trade_no' => ''], ['id' => $red_row['id']]);
        if ($flag->rowCount()) return true;
        return false;
    }

    // 更新红包使用状态 1
    public function updateRedPackStatus($ip, $user_id, $trade_no, $status)
    {
        $rule_row = $this->handle->get(self::TABLE_NAME2, ['id', 'type'], ['ORDER' => ['id' => 'DESC']]);
        if (empty($rule_row)) {
            return -1;
        }
        $this->handle->pdo->beginTransaction();
        if ($status != 1) return false;
        $flag = $this->handle->update(self::TABLE_NAME, [
            'is_use'      => 1,
            'userid'      => $user_id,
            'trade_no'    => $trade_no,
            'update_time' => time(),
        ], [
            'rule_id' => $rule_row['id'],
            'ip'      => $ip,
            'type'    => $rule_row['type'],
        ]);
        if ($flag->rowCount()) {
            $this->handle->pdo->commit();
            return true;
        }
        $this->handle->pdo->rollBack();
        return false;
    }

    // 获取红包使用列表
    public function getList()
    {
        $page  = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
        if ($page <= 0) $page = 1;
        $offset = ($page - 1) * $limit;
        $total  = $this->handle->count(self::TABLE_NAME);
        $list   = $this->handle->select(self::TABLE_NAME, ['ip', 'rule_id', 'type', 'money', 'is_use', 'trade_no', 'create_time', 'update_time'], [
            'LIMIT' => [$offset, $limit],
            'ORDER' => ['rule_id' => 'DESC', 'id' => 'DESC'],
        ]);
        foreach ($list as &$v) {
            $v['create_time'] = date('Y-m-d H:i:s', $v['create_time']);
            $v['update_time'] = empty($v['update_time']) ? '' : date('Y-m-d H:i:s', $v['update_time']);
            $v['type']        = intval($v['type']);
            $v['is_use']      = intval($v['is_use']);
        }
        return ['total' => $total, 'item' => $list];
    }
}