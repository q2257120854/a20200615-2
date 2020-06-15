<?php
/* *
 * 支付宝当面付异步通知页面
 */

require_once './inc.php';
//require_once SYSTEM_ROOT.'f2fpay/config.php';
require_once SYSTEM_ROOT.'f2fpay/AlipayTradeService.php';

//计算得出通知验证结果
$alipaySevice = new AlipayTradeService($config); 
//$alipaySevice->writeLog(var_export($_POST,true));
$verify_result = $alipaySevice->check($_POST);

if($verify_result && $conf['alipay_api']==3) {//验证成功
	//商户订单号

	$out_trade_no = daddslashes($_POST['out_trade_no']);

	//支付宝交易号

	$trade_no = $_POST['trade_no'];
	//交易状态
	$trade_status = $_POST['trade_status'];

	//买家支付宝
	$buyer_id = daddslashes($_POST['buyer_id']);

    $srow = $DB->query('SELECT * FROM `'.$dbconfig['dbqz'].'_pay` WHERE `trade_no` = :outTradeNo limit 1 for update', [':outTradeNo' => $out_trade_no])->fetch(PDO::FETCH_ASSOC);
    if(empty($srow['type']))
        exit('fail');
    if ($_POST['trade_status'] == 'TRADE_SUCCESS' && $srow['status']==0) {
		//付款完成后，支付宝系统发送该交易状态通知
        $updateResult = $DB->update('pay', ['status' => 1], ['trade_no' => $out_trade_no, 'LIMIT' => 1]);
        if ($updateResult->rowCount() > 0) {
            $DB->update('pay', ['endtime' => $date], ['trade_no' => $out_trade_no, 'LIMIT' => 1]);
            processOrder($srow);
        }
    }

	echo "success";
}
else {
    //验证失败
    echo "fail";
}
?>