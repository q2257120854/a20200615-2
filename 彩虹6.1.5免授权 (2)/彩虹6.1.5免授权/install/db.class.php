<?php
if (extension_loaded('mysqli')) {
    class DB
    {
        private static $link;

        public static function connect($db_host, $db_user, $db_pass, $db_name, $db_port)
        {
            try {
                self::$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);
                return self::$link;
            } catch (Exception $e) {
                return false;
            }
        }

        public static function connect_errno()
        {
            return mysqli_connect_errno();
        }

        public static function connect_error()
        {
            return mysqli_connect_error();
        }

        public static function fetch($q)
        {
            return mysqli_fetch_assoc($q);
        }

        function fetch_all($q)
        {
            return mysqli_fetch_all($q, 1);
        }

        public static function get_row($q)
        {
            $result = mysqli_query(self::$link, $q);
            return $result ? mysqli_fetch_assoc($result) : false;
        }

        public static function count($q)
        {
            $result = mysqli_query(self::$link, $q);
            $count = $result ? mysqli_fetch_array($result) : false;
            return $count[0];
        }

        public static function query($q)
        {
            return mysqli_query(self::$link, $q);
        }

        public static function escape($str)
        {
            return mysqli_real_escape_string(self::$link, $str);
        }

        public static function affected()
        {
            return mysqli_affected_rows(self::$link);
        }

        public static function errno()
        {
            return mysqli_errno(self::$link);
        }

        public static function error()
        {
            return mysqli_error(self::$link);
        }

        public static function close()
        {
            return mysqli_close(self::$link);
        }

        public static function executeSql($sql, $db_prefix = '')
        {
            if (!isset($sql) || empty($sql)) return false;
            $sql = str_replace("\r", "\n", str_replace(' `shua_', ' `' . $db_prefix, $sql));
            $ret = array();
            $num = 0;
            foreach (explode(";\n", trim($sql)) as $query) {
                $ret[$num] = '';
                $queries = explode("\n", trim($query));
                foreach ($queries as $q) {
                    $ret[$num] .= (isset($q[0]) && $q[0] == '#') || (isset($q[1]) && isset($q[1]) && $q[0] . $q[1] == '--') ? '' : $q;
                }
                $num++;
            }
            unset($sql);
            foreach ($ret as $query) {
                $query = trim($query);
                if ($query) {
                    if (strtoupper(substr($query, 0, 12)) == 'CREATE TABLE') {
                        $type = strtoupper(preg_replace("/^\s*CREATE TABLE\s+.+\s+\(.+?\).*(ENGINE|TYPE)\s*=\s*([a-z]+?).*$/isU", "\\2", $query));
                        $query = preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU", "\\1", $query) . " ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
                    }
                    mysqli_query(self::$link, $query);
                }
            }
            return true;
        }
    }
} else {
    class DB
    {
        private static $link;

        public static function connect($db_host, $db_user, $db_pass, $db_name, $db_port)
        {
            self::$link = mysql_connect($db_host . ':' . $db_port, $db_user, $db_pass);
            if (!self::$link) return false;
            return mysql_select_db($db_name, self::$link);
        }

        public static function connect_errno()
        {
            return mysql_errno();
        }

        public static function connect_error()
        {
            return mysql_error();
        }

        public static function fetch($q)
        {
            return mysql_fetch_assoc($q);
        }

        public static function get_row($q)
        {
            $result = mysql_query($q, self::$link);
            return mysql_fetch_assoc($result);
        }

        public static function count($q)
        {
            $result = mysql_query($q, self::$link);
            $count = mysql_fetch_array($result);
            return $count[0];
        }

        public static function query($q)
        {
            return mysql_query($q, self::$link);
        }

        public static function escape($str)
        {
            return mysql_real_escape_string($str, self::$link);
        }

        public static function affected()
        {
            return mysql_affected_rows(self::$link);
        }

        public static function errno()
        {
            return mysql_errno(self::$link);
        }

        public static function error()
        {
            return mysql_error(self::$link);
        }

        public static function close()
        {
            return mysql_close(self::$link);
        }

        public static function executeSql($sql, $db_prefix = '')
        {
            if (!isset($sql) || empty($sql)) return false;
            $sql = str_replace("\r", "\n", str_replace(' `shua_', ' `' . $db_prefix, $sql));
            $ret = array();
            $num = 0;
            foreach (explode(";\n", trim($sql)) as $query) {
                $ret[$num] = '';
                $queries = explode("\n", trim($query));
                foreach ($queries as $q) {
                    $ret[$num] .= (isset($q[0]) && $q[0] == '#') || (isset($q[1]) && isset($q[1]) && $q[0] . $q[1] == '--') ? '' : $q;
                }
                $num++;
            }
            unset($sql);
            foreach ($ret as $query) {
                $query = trim($query);
                if ($query) {
                    if (strtoupper(substr($query, 0, 12)) == 'CREATE TABLE') {
                        $type = strtoupper(preg_replace("/^\s*CREATE TABLE\s+.+\s+\(.+?\).*(ENGINE|TYPE)\s*=\s*([a-z]+?).*$/isU", "\\2", $query));
                        $query = preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU", "\\1", $query) . " ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
                    }
                    mysql_query($query, self::$link);
                }
            }
            return true;
        }
    }
}