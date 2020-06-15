<?php
date_default_timezone_set("Asia/chongqing");
error_reporting(0);
header("Content-Type: text/html; charset=utf-8");

$CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", '', file_get_contents('config.json')), true);
$action = $_GET['action'];

switch ($action) {
    case 'config':
        $result =  json_encode($CONFIG);
        break;
    /* 上传图片 */
    case 'uploadimage':
        /* 上传涂鸦 */
    case 'uploadscrawl':
        /* 上传视频 */
    case 'uploadvideo':
        /* 上传文件 */
    case 'uploadfile':
        $result = include("actionUpload.php");
        break;
    default:
        $result = json_encode(array(
            'state'=> '请求地址出错'
        ));
        break;
}

/* 输出结果 */
if (isset($_GET["callback"])) {
    if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
        echo htmlspecialchars($_GET["callback"]) . '(' . $result . ')';
    } else {
        echo json_encode(array(
            'state'=> 'callback参数不合法'
        ));
    }
} else {
    echo $result;
}