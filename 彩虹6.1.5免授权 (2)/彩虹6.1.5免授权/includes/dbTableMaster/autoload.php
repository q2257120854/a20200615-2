<?php

class ClassLoader
{
    protected static $_registed = false;

    public static function register()
    {
        if (!self::$_registed) {
            self::$_registed = spl_autoload_register(['\ClassLoader', 'loadClass']);
        }
    }


    public static function loadClass($className)
    {
        $fileName = str_replace('\\', '/', $className);
        $filePath = $fileName . '.php';
        $baseDir = __DIR__;
        $path = $baseDir . '/' . $filePath;
        $path = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
        if (is_file($path)) {
            require $path;
        }
    }

}