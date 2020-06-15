<?php
/**
 * 短信邮会员营销短信接口
 */
require_once("include/config.php");
require_once("include/httpUtil.php");

/**
 * url中{function}/{operation}?部分
 */
$funAndOperate = "affMarkEmailSMS/sendEmailSMS";

// 参数详述请参考http://miaodiyun.com/https-duanxinhuizhi.html
// 生成body
$body = createBasicAuthData();
// 在基本认证参数的基础上添加短信内容和发送目标号码的参数
$body['smsContent'] = "【秒嘀科技】您的优惠券就快过期啦！不想白白浪费，就快来使用吧！戳： m.miaodiyun.com 使用！回TD退订。";
$body['to'] = '150xxxxxxxx';

// 提交请求
$result = post($funAndOperate, $body);
echo("<br/>result:<br/><br/>");
var_dump($result);