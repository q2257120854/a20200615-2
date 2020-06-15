<?php
include_once './includes/common.php';

$requestUrl = $_GET['s'];

$requestUrl = substr($requestUrl, 1, strlen($requestUrl));

$tempData = explode('/', $requestUrl);


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


if (count($tempData) > 3) {
    http_response_code(404);
    exit();
} else if (count($tempData) == 3) {
    $columnName = $tempData[1];
    $dir        = './article/column/' . $columnName . '.php';
    if (!file_exists($dir)) {
        http_response_code(404);
        exit();
    }

    $page  = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $limit = 25;

    $totalCount = $DB->count('article_list');

    $contents = $DB->select('article_list', ['id', 'title', 'status', 'createTime', 'content'], ['ORDER' => ['id' => 'DESC'], 'LIMIT' => [($page - 1) * $limit, $limit]]);

    include_once $dir;
    //栏目模式
} else if ($tempData[1] == 'search') {
    $searchContent = $_GET['kw'];

    if (empty($searchContent)) {
        http_response_code(404);
        exit();
    }

    $searchTitle = urldecode($searchContent);
    $page        = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $limit       = 25;

    $where = [];

    if (!empty($searchTitle)) {
        $where['title[~]'] = $searchTitle;
    }

    $totalCount = $DB->count('article_list', $where);

    $where['ORDER'] = ['id' => 'DESC'];
    $where['LIMIT'] = [($page - 1) * $limit, $limit];

    $contents = $DB->select('article_list', ['id', 'title', 'status', 'createTime', 'content'], $where);

    include_once './article/template/searchTemplate.php';


} else {
    $articleID = intval($tempData[1]);
    if ($articleID <= 0) {
        http_response_code(404);
        exit();
    }
    $result = $DB->get('article_list', ['title', 'createTime', 'author', 'seoTitle', 'seoKeywords', 'seoDescription', 'content'], ['AND' => ['status' => 1, 'id' => $articleID]]);
    if (!$result) {
        http_response_code(404);
        exit();
    }

    $upResult   = $DB->get('article_list', ['title', 'id'], ['AND' => ['status' => 1, 'id[>]' => $articleID]]);
    $downResult = $DB->get('article_list', ['title', 'id'], ['AND' => ['status' => 1, 'id[<]' => $articleID]]);

    include_once './article/template/articleTemplate.php';
    //文章显示模式
}
