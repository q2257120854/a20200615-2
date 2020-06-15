<?php

/* *
 * 配置文件
 * 版本：1.0
 * 日期：2014-06-16
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 */
global $llpay_config;
//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
//商户编号是商户在连连钱包支付平台上开设的商户号码，为18位数字，如：201306081000001016
/*
$llpay_config['oid_partner'] = '201408071000001539';

//秘钥格式注意不能修改（左对齐，右边有回车符）
$llpay_config['RSA_PRIVATE_KEY'] ='-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQCmRl6Zn4MmtoBoelHRT6j6ounts/x1+GiJTB9/eBTl01cBK50h
mOUtGBcOVrJCa0C1NkR8BYgOT/WLfFT8cICw6XSJtf2uzZco71jbwXfFe8MiEx/L
XiQNQHuclpkUa1hXFUUo6Qat8X8L++pVZfjav40dPKf7oFWCYLWBCDOdyQIDAQAB
AoGANe0mqz4/o+OWu8vIE1F5pWgG5G/2VjBtfvHwWUARzwP++MMzX/0dfsWMXLsj
b0UnpF3oUizdFn86TLXTPlgidDg6h0RbGwMZou/OIcwWRzgMaCVePT/D1cuhyD7Y
V8YkjVHGnErfxyia1COswAqcpiS4lcTG/RqkAMsdwSZe640CQQDRvkQ7M2WJdydc
9QLQ9FoIMnKx9mDge7+aN6ijs9gEOgh1gKUjenLr6hcGlLRyvYDKQ4b1kes22FUT
/n+AMaEPAkEAyvH05KRzax3NNdRPI45N1KuT1kydIwL3KpOK6mWuHlffed2EiWLS
dhZNiZy9wWuwFPqkrZ8g+jL0iKcCD0mjpwJBAKbWxWmeCZ+eY3ZjAtl59X/duTRs
ekU2yoN+0KtfLG64RvBI45NkHLQiIiy+7wbyTNcXfewrJUIcNRjRcVRkpesCQEM8
BbX6BYLnTKUYwV82NfLPJRtKJoUC5n/kgZFGPnkvA4qMKOybIL6ehPGiS/tYge1x
XD1pCrPZTco4CiambuECQDNtlC31iqzSKmgSWmA5kErqVJB0f1i+a0CbQLlaPGYN
/qwa7TE13yByaUdDDaTIEUrDyuqWd5+IvlbwuVsSlMw=
-----END RSA PRIVATE KEY-----';

//安全检验码，以数字和字母组成的字符
$llpay_config['key'] ='201408071000001539_sahdisa_20141205';

*/

$llpay_config['oid_partner'] = '201810190002237014';

//秘钥格式注意不能修改（左对齐，右边有回车符）
$llpay_config['RSA_PRIVATE_KEY'] ='-----BEGIN RSA PRIVATE KEY-----
MIIEogIBAAKCAQEAmL9X68mOrvytQBKPwFIN1ZEU1nUNV1LoqY2U2yZimYXUYmN+
RGG2kEE0+RLV3VRxHT7aWYHQoa83wsvcvx4vUwmK8ew+ef6uic40Je+MtGOhMtxa
IMkarUYHC0HLmj+AWBaYPrl3aeV18fc9V5wTSNvNRtaPf2EhRqY78PNI/cBxtbc6
czXEUX0bdoBmghUHIdvtVgQLvOrXnsmTjZpxL8bGIP2IuUekzi03VzlW6eCJo6ny
c7KK2eu9zt3eMiw/EruHOIoJsrHE53z5ZHY5GOun2gvNRl8iFrm/o/CCdTN4jQx6
7X8PRbupuFgmLgrYR5wtoZhw2Jd18Ei5hOJh3wIDAQABAoIBABbWFIj121UiBazc
mY1BNzxEsn7VhScXCB3BQw34kSkuru/+u/PxP+AVP5w1SrAKXdbnfLGBDPX/QjDn
VZtlIeIiPRmqHjUS9Hk50OYTCFA3zPPTqc3ZAxoArDDsp0nqUH/a8Ov/wnCck6OX
OR6OAPwVkH0UuuNqXBU56SA+3xzAm56VfnObnBAh2MFlxwfHpyL4+VyBwGlNZUhB
gWALESOhnx+YuiH/aiKcgx0UtDVUR5YZSsSzXeIVVvaRNfeMknqZxMCz4akShVKx
oYsDuHq1FjIM5NypWHlLPh4QUlR6LCYnTZF2rDoOnvjOlA06sW67wrLSLaY49Ass
1YyezQECgYEAxlBViP4b0uqHnO5lTzU+IW/4LRNjHWJ+rwQubeH0h/fsOj0hQgNI
aWEf2tEn+MtT9MivqlFLGjUFem5U9p2O8LAGLeIu0pjZVF84cxq9JvskQUfaS16O
mI7d3DPgPDRpHsHly9kYIfciEtib9SPNDAt44ICRZOmKixmYATyUCh8CgYEAxS3b
a+3CAWYtb9C6JVDzJMBBzWPVh0cXzYgWRVli43Oqm75zCmOaD9gbX4NNlaqHb755
td8LCXQqUykjq+/kDzrveVuQtyeIHMmCi7SoNJgEGRk+3Gx8balqF1h8Hp9cIJ4R
odbJVRFIM1eRohLld/YwU+gz6/7DfcclwN3aMEECgYB9hVFuYTApQqrNaJMVHGUT
8vQJS9EbQ0Fd826TvEXzXbfWcOTBDKTjlkb8UBBVyBR+xhtx2PyJPPAXuwfqBHX5
3+A5YIU0ZOyCG7b2HAGHT8R10U3ZEKN+6kaA3xDZ6m5yulWBvgopTWvys8ma0qsx
KX2704Szc6JuQqfUeIxXDwKBgArWVGMANFODXCfzHugCJPr2Hie9vvSqcaJ4QlEZ
cpfxuYTJ2OTPSJ5qUEbVnqQFNWBs5Z+bXK3uVo0vi6hdjPlRUewnnjKS16ZNZQFs
snoBiOggPRY8WDJmx0/1Kw070QJx7aIpffNQ+djojTaNN1N6knlqH8BuxivZkDej
eeSBAoGARUmYwPRFWn+sfmAEkdjuvGahDfa6qpMAp+kkNRLP97PPBx8jBDq0jtML
/4N2d2/02PEfSlAYVxeo/SlrbWFlU2lwpBC0+xXYr1wp043sdq7Sqxt9JNuq/Any
+rLNykD2Pki6WZ+WehCVYSU+gSxvh8eLA+al5ZXAyFp0QEE0Cm8=
-----END RSA PRIVATE KEY-----';

//安全检验码，以数字和字母组成的字符
$llpay_config['key'] ='201810190002237014_sahdisa_20170724';


//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑

//版本号
$llpay_config['version'] = '1.0';

//防钓鱼ip 可不传或者传下滑线格式 
//$llpay_config['userreq_ip'] = '10_10_246_110';

//证件类型
$llpay_config['id_type'] = '0';

//签名方式 不需修改
$llpay_config['sign_type'] = strtoupper('RSA');

//订单有效时间  分钟为单位，默认为10080分钟（7天） 
$llpay_config['valid_order'] ="10080";

//字符编码格式 目前支持 gbk 或 utf-8
$llpay_config['input_charset'] = strtolower('utf-8');

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$llpay_config['transport'] = 'http';
?>