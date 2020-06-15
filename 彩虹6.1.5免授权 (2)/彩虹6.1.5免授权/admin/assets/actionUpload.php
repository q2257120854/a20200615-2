<?php
/**
 * 上传附件和上传视频
 * User: Jinqn
 * Date: 14-04-09
 * Time: 上午10:17
 */
include "Uploader.class.php";

/* 上传配置 */
$base64 = "upload";
switch (htmlspecialchars($_GET['action'])) {
    case 'uploadimage':
        $config    = array(
            "pathFormat" => $CONFIG['imagePathFormat'],
            "maxSize"    => $CONFIG['imageMaxSize'],
            "allowFiles" => $CONFIG['imageAllowFiles']
        );
        $fieldName = $CONFIG['imageFieldName'];
        break;
}
if(empty($fieldName))
    return json_encode(['state'=> '请求参数不合法']);

$up = new Uploader($fieldName, $config, $base64);

return json_encode($up->getFileInfo());
