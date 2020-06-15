<?php
if (!defined('IN_CRONLITE')) exit();

class Cache
{
    /**
     * 获取缓存参数
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        global $_CACHE;
        return $_CACHE[$key];
    }

    /**
     * 事实读取缓存值
     * @param string $key
     * @return mixed
     */
    public function read($key = 'config')
    {
        global $DB;
        return $DB->get('cache', 'v', ['k' => $key]);
    }

    /**
     * 保存缓存配置
     * @param $key
     * @param $value
     * @return bool
     */
    public function save($key, $value)
    {
        if (is_array($value))
            $value = serialize($value);
        global $DB;
        global $dbconfig;
        $table_name = $dbconfig['dbqz'] . '_cache';
        return $DB->query('REPLACE INTO ' . $table_name .' VALUES (:k,:v)', [
            ':k' => $key,
            ':v' => $value
        ])->execute();
    }

    /**
     * 根据配置表进行序列化缓存
     * @return array
     */
    public function update()
    {
        global $DB;
        $cache = [];

        $result = $DB->select('config', '*');

        foreach ($result as $content) {
            if ($content['k'] == 'cache')
                continue;
            $cache[$content['k']] = $content['v'];
        }
        if ($this->save('config', $cache)) {
            log_result('配置修改', 'IP => ' . real_ip() . '<br>UA => ' . $_SERVER['HTTP_USER_AGENT'] . '<br>Url => ' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'], '修改配置信息', '1');
        } else {
            log_result('配置修改', 'IP => ' . real_ip() . '<br>UA => ' . $_SERVER['HTTP_USER_AGENT'] . '<br>Url => ' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'], $DB->error(), '1');
        }
        return $cache;
    }

    /**
     * 删除缓存
     * @param string $key
     * @return int
     */
    public function clear($key = 'config')
    {
        global $DB;

        $result = $DB->update('cache', [
            'v' => ''
        ], [
            'k' => $key
        ]);

        return $result->rowCount() > 0 ? true : false;
    }
}
