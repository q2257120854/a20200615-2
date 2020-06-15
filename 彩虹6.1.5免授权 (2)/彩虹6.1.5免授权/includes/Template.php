<?php
if (!defined('IN_CRONLITE')) exit;

class Template
{
    public static function getList()
    {
        $dir        = TEMPLATE_ROOT;
        $dirArray[] = NULL;
        if (false != ($handle = opendir($dir))) {
            $i = 0;
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && !strpos($file, ".")) {
                    $dirArray[$i] = $file;
                    $i++;
                }
            }
            closedir($handle);
        }
        return $dirArray;
    }

    public static function load($name = 'index')
    {
        global $conf;

        if ($conf['qqjump'] && self::isQQ())
            $name = 'jump';
        //如果开启了就显示跳转提示

        $template = $conf['template'] ? $conf['template'] : 'default';
        if (!preg_match('/^[a-zA-Z0-9]+$/', $name)) exit('error');
        $filename         = TEMPLATE_ROOT . $template . '/' . $name . '.php';
        if (self::isMobile()) {
            $filename_mobile = TEMPLATE_ROOT . $template . '/' . $name . '_mobile.php';
            if (is_file($filename_mobile)) {
                $filename = $filename_mobile;
            }
        }
        $filename_default = TEMPLATE_ROOT . 'default/' . $name . '.php';
        if (file_exists($filename)) {
            return $filename;
        } elseif (file_exists($filename_default)) {
            return $filename_default;
        } else {
            exit('Template file not found');
        }
    }

    /**
     * 检测是否使用手机访问
     * @access public
     * @return bool
     */
    private static function isMobile()
    {
        if (isset($_SERVER['HTTP_VIA']) && stristr($_SERVER['HTTP_VIA'], 'wap')) {
            return true;
        } elseif (isset($_SERVER['HTTP_ACCEPT']) && strpos(strtoupper($_SERVER['HTTP_ACCEPT']), 'VND.WAP.WML')) {
            return true;
        } elseif (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])) {
            return true;
        } elseif (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |Googlebot-Mobile|YahooSeeker\/M1A1-R2D2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i', $_SERVER['HTTP_USER_AGENT'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function exists($template)
    {
        $filename = TEMPLATE_ROOT . $template . '/index.php';
        if (file_exists($filename)) {
            return true;
        } else {
            return false;
        }
    }

    public static function isQQ()
    {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($ua, 'QQ/') !== false)
            return true;
        //qq 浏览器判断
        return false;
    }

    public static function isWx()
    {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($ua, 'MicroMessenger') !== false)
            return true;
        //微信判断
        return false;
    }

}
