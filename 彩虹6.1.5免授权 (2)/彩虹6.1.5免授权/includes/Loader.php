<?php

namespace ds;

class Loader
{
    // 注册自动加载机制
    public static function register($autoload = '')
    {
        // 注册系统自动加载
        spl_autoload_register($autoload ?: 'ds\\Loader::autoload', true, true);
    }

    // 自动加载
    public static function autoload($class)
    {
        if ($file = self::findFile($class)) {
            // Win环境严格区分大小写
            if (strpos(PHP_OS, 'WIN') !== false && pathinfo($file, PATHINFO_FILENAME) != pathinfo(realpath($file), PATHINFO_FILENAME)) {
                return false;
            }

            __include_file($file);
            return true;
        }
        return false;
    }

    public static function findFile($class)
    {
        $logicalPathPsr4 = strtr($class, '\\', DIRECTORY_SEPARATOR) . '.php';
        $filePath = ROOT . 'includes' . DIRECTORY_SEPARATOR . $logicalPathPsr4;
        return is_file($filePath) ? $filePath : false;
    }
}

/**
 * 作用范围隔离
 *
 * @param $file
 * @return mixed
 */
function __include_file($file)
{
    return include $file;
}

function __require_file($file)
{
    return require $file;
}
