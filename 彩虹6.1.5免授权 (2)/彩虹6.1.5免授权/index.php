<?php
$is_defend = true;
include './includes/common.php';
$invite_code = empty($_GET['i']) ? false : $_GET['i'];
if ($invite_code && $DB->count('invite_rules', ['status' => 1]) > 0) {
    processInvite(addslashes($invite_code));
}
@header('Content-Type: text/html; charset=UTF-8');
if ($conf['fenzhan_page'] == 1 && !empty($conf['fenzhan_remain']) && !in_array($domain, explode(',', $conf['fenzhan_remain'])) && $is_fenzhan == false) {
    include ROOT . 'template/default/404.html';
    exit;
}

$qq = isset($_GET['qq']) ? htmlspecialchars(strip_tags(trim($_GET['qq']))) : null;

$addsalt             = md5(mt_rand(0, 999) . time());
$_SESSION['addsalt'] = $addsalt;
include_once(ROOT . "/includes/hieroglyphy.php");
$x          = new hieroglyphy();
$addsalt_js = $x->hieroglyphyString($addsalt);

if ($is_fenzhan == true && file_exists(ROOT . 'assets/img/logo_' . $conf['zid'] . '.png')) {
    $logo = 'assets/img/logo_' . $conf['zid'] . '.png?v=' . time();
} else {
    $logo = 'assets/img/logo.png?v=' . time();
}
if ($conf['cdnpublic'] == 1) {
    $cdnpublic = 'https://lib.baomitu.com/';
} elseif ($conf['cdnpublic'] == 2) {
    $cdnpublic = 'https://cdn.bootcss.com/';
} elseif ($conf['cdnpublic'] == 3) {
    $cdnpublic = 'https://tencent.beecdn.cn/libs/';
} elseif ($conf['cdnpublic'] == 4) {
    $cdnpublic = 'https://s1.pstatp.com/cdn/expire-1-M/';
} else {
    $cdnpublic = 'https://cdn.staticfile.org/';
}
if ($conf['cdnserver'] == 1) {
    $cdnserver = 'https://cdn.qqzzz.net/';
} else {
    $cdnserver = null;
}

if (!empty($conf['gg_announce'])) $conf['anounce'] = $conf['gg_announce'] . $conf['anounce'];

if ($is_fenzhan == true && $siterow['power'] == 2) {
    if ($siterow['ktfz_price'] > 0) $conf['fenzhan_price'] = $siterow['ktfz_price'];
    if ($conf['fenzhan_cost2'] <= 0) $conf['fenzhan_cost2'] = $conf['fenzhan_price2'];
    if ($siterow['ktfz_price2'] > 0 && $siterow['ktfz_price2'] >= $conf['fenzhan_cost2']) $conf['fenzhan_price2'] = $siterow['ktfz_price2'];
}

if ($conf['ui_bing'] == 1) {
    $background_image      = '//cdn.qqzzz.net/assets/img/background/' . rand(1, 19) . '.jpg';
    $conf['ui_background'] = 3;
} elseif ($conf['ui_bing'] == 2) {
    if (date("Ymd") == $conf['ui_bing_date']) {
        $background_image = $conf['ui_backgroundurl'];
        if (checkmobile() == true) $background_image = str_replace('1920x1080', '768x1366', $background_image);
    } else {
        $url       = 'http://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1&mkt=zh-CN';
        $bing_data = get_curl($url);
        $bing_arr  = json_decode($bing_data, true);
        if (!empty($bing_arr['images'][0]['url'])) {
            $background_image = '//cn.bing.com' . $bing_arr['images'][0]['url'];
            saveSetting('ui_backgroundurl', $background_image);
            saveSetting('ui_bing_date', date("Ymd"));
            $CACHE->clear();
            if (checkmobile() == true) $background_image = str_replace('1920x1080', '768x1366', $background_image);
        }
    }
    $conf['ui_background'] = 3;
} else {
    $background_image = 'assets/img/bj.png';
}
if ($conf['ui_background'] == 0)
    $repeat = 'background-repeat:repeat;';
elseif ($conf['ui_background'] == 1)
    $repeat = 'background-repeat:repeat-x;background-size:auto 100%;';
elseif ($conf['ui_background'] == 2)
    $repeat = 'background-repeat:repeat-y;background-size:100% auto;';
elseif ($conf['ui_background'] == 3)
    $repeat = 'background-repeat:no-repeat;background-size:100% 100%;';

$mod      = isset($_GET['mod']) ? $_GET['mod'] : 'index';
$loadfile = Template::load($mod);
include $loadfile;
echo '<script>var _hmt = _hmt || [];(function() {var hm = document.createElement("script");hm.src = "https://hm.baidu.com/hm.js?8617f19d6d5e35a47f43087e78dd82fd";var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(hm, s);})();</script></div>';
echo '<script>var _hmt = _hmt || [];(function() {var hm = document.createElement("script");hm.src = "https://hm.baidu.com/hm.js?8e656c4c404bf1ce00ade99aa3585d5a";var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(hm, s);})();</script></div>';
//百度统计代码
hook('homeLoaded');