<?php
/**
 * 获取开发者账号信息接口调用示例
 */

require_once("include/config.php");
require_once("include/httpUtil.php");

/**
 * url中{function}/{operation}?部分
 */
$funAndOperate = "query/accountInfo";

// 参数详述请参考http://miaodiyun.com/xinxichaxun.html

// 生成body
$body = createBasicAuthData();

// 提交请求
$result = post($funAndOperate, $body);
echo("<br/>result:<br/><br/>");
var_dump($result);

