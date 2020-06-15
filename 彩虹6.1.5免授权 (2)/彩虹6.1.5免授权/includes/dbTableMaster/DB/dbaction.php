<?php
namespace DB;

use \mysqli;
use \DB\db;
use \DB\dbschema as dbstr;
use \DB\generSql;

class dbaction
{

    protected $master;

    protected $slave;
    protected $slaveConf;
    protected $masterConf;
    protected $sql = [];
    private $gener;

    public function init()
    {
        $this->gener = new generSql();
        $db = new db();
        $this->master = $db->connection($this->masterConf);
        $this->slave = $db->connection($this->slaveConf);
    }

    public function run()
    {
        $this->createTable();
        $this->updateTableSchema();
        // 防止超时
        if (function_exists('set_time_limit') && function_exists('ignore_user_abort')) {
            set_time_limit(0);
            ignore_user_abort(true);
        }
        return $this->exce();
    }

    /**
     * 执行SQL语句
     * @return bool|array 全部执行完毕返回true，错误返回错误SQL数组
     */
    public function exce()
    {
        $this->proSqls();
        $sqlArr = $this->sql;
        $err_msg = [];
        if ($sqlArr) {
            foreach ($sqlArr as $sql) {
                $rs = $this->getDBStrObj($this->slave)->execute($sql);
                if (!$rs) {
                    $err_msg[] = $sql;
                }
            }
        }
        return empty($err_msg) ? true : $err_msg;
    }

    public function proSqls()
    {
        $sqls = $this->sql;
        $this->sql = [];
        foreach ($sqls as $key => $sql) {
            if ($sql) {
                $this->sql[] = $sql;
            }
        }
        return true;
    }

    // 比较表
    public function compareTable()
    {
        $masterTables = $this->getMasterTables(); // 获取用于对比的所有数据表
        $slaveTables = $this->getSlaveTables(); // 获取需要变更的数据表
        $diff = array_diff($masterTables, $slaveTables); // 取差异
        $intersect = array_intersect($masterTables, $slaveTables); // 取交集
        return ['diff' => $diff, 'inter' => $intersect];
    }

    // 如果没有表，就创建表，生成SQL语句
    public function createTable()
    {
        extract($this->compareTable());
        $diff = str_replace($this->slaveConf['prefix'], $this->masterConf['prefix'], $diff);
        if (!$diff) {
            return false;
        }
        try {
            foreach ($diff as $name) {
                $schema = $this->getTableSchema($name, $this->master);
                $this->sql[] = str_replace('TABLE `'.$this->masterConf['prefix'], 'TABLE `'.$this->slaveConf['prefix'], $this->gener->createTable($name, $schema));
            }
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    // 比较表结构
    public function updateTableSchema()
    {
        extract($this->compareTable());
        if (!$inter) {
            return false;
        }
        foreach ($inter as $name) {
            $masterSchema = $this->getTableSchema(str_replace($this->slaveConf['prefix'], $this->masterConf['prefix'], $name), $this->master);
            $slaveSchema = $this->getTableSchema($name, $this->slave);
            if (!$slaveSchema && $masterSchema) {
                $this->sql[] = $this->gener->createTable($name, $masterSchema);
            }
            if (!$masterSchema && $slaveSchema) {
                $this->sql[] = $this->$this->gener->dropTable($name);
            }
            $this->sql = array_merge($this->sql, $this->gener->updateTableSchema($masterSchema, $slaveSchema, $name));
        }
        return true;
    }


    public function getDBStrObj($connect)
    {
        return new dbstr($connect);
    }

    public function getSlaveTables()
    {
        return $this->getDBStrObj($this->slave)->getTables($this->slaveConf['prefix']);
    }

    public function getMasterTables()
    {
        $list = $this->getDBStrObj($this->master)->getTables($this->masterConf['prefix']);
        return str_replace($this->masterConf['prefix'], $this->slaveConf['prefix'], $list);
    }

    public function getTableSchema($tableName, mysqli $db)
    {
        return $this->getDBStrObj($db)->dbSchme($tableName);
    }

    public function setMasterConf($config)
    {
        $this->masterConf = $config;
    }

    public function setSlaveConf($config)
    {
        $this->slaveConf = $config;
    }
}
