<?php
/**
 * Created by PhpStorm.
 * User: wo
 * Date: 2017/6/22
 * Time: 16:24
 */

namespace app\index\controller;
use think\Model;
use think\Db;

use think\Log;

require_once (dirname(__FILE__)."/../../llpay/llpay.config.php");
require_once (dirname(__FILE__)."/../../llpay/lib/llpay_submit.class.php");
require_once (dirname(__FILE__)."/../../llpay/lib/llpay_notify.class.php");

//http://open.lianlianpay.com/#cat=35 连连支付文档

class Lianlianpay extends Home
{
    public function _initialize()
    {
        parent::_initialize();
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH.'logs/',
            'apart_level'   =>  ['error','log'],
        ]);
    }

    public function test(){
        Log::error("test...");
        Log::record("hello...");
        Log::log("word...");

    }

    //no_order 支付时传入的订单号；status: 1成功  2失败
    private function updatePayStatus($no_order, $status){

        if(strlen($no_order) <= 0 || ( $status != 1 && $status != 2) ){
            Log::log("updatePayStatus|参数错误, no_order=$no_order, status=$status");
            error("更新失败");
        }

        $ret = Db::table("xh_member_recharge")->where("no_order='{$no_order}'")->update(array('status'=>$status));
        if($ret != 1){//如果已更新过则返回
            return;
        }
        $rech = Db::table("xh_member_recharge")->where("no_order='{$no_order}'")->find();
        if(!$rech){
            error("订单号不存在");
            Log::log("订单号不存在");
        }

        $memberId = $rech['memberId'];
        $amount = $rech['amount'];


        $member = Db::table("xh_member")->where("id=$memberId")->find();
        if(!$member){
            error("用户不存在");
            Log::log("用户不存在");
        }

        if($status == 1){
            Db::table("xh_member")->where("id=$memberId")->setInc("usableSum", $amount);

            $data=array();
            $data['memberId'] = $memberId;
            $data['flow'] = 1;
            $data['amount'] = $amount;
            $data['usableSum'] = $amount + $member['usableSum'];
            $data['remarks'] = '连连支付充值成功';
            $data['createTime'] = date("Y-m-d H:i:s");
            Db::table("xh_member_fundrecord")->insertGetId($data);
        }

        Db::commit();

    }

    public function notify_url(){

        global $llpay_config;
        //计算得出通知验证结果
        Log::log("notify_url, start....");
        $llpayNotify = new \LLpayNotify($llpay_config);
        $verify_result = $llpayNotify->verifyNotify();
        Log::log("verify_result = $verify_result");

        if ($verify_result) { //验证成功

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代
            Log::log("验证成功");
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取连连支付的通知返回参数，可参考技术文档中服务器异步通知参数列表
            $is_notify = true;
            include_once (dirname(__FILE__).'/../../llpay/lib/llpay_cls_json.php');
            $str = file_get_contents("php://input");
            Log::log("file_get_contents | str=<br/> $str ");
            $json = json_decode($str);

            $oid_partner = $json->oid_partner;
            $dt_order = $json->dt_order;
            $no_order = $json->no_order;
            $oid_paybill = $json->oid_paybill;
            $money_order = $json->money_order;
            $result_pay = $json->result_pay;
            $settle_date = $json->settle_date;
            $pay_type = $json->pay_type;
            $sign_type = $json->sign_type;
            $sign = $json->sign;


            file_put_contents("log.txt", "异步通知 验证成功\n", FILE_APPEND);

            $this->updatePayStatus($no_order, 1);

            die("{'ret_code':'0000','ret_msg':'交易成功'}"); //请不要修改或删除
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        } else {
            Log::log("验证失败");
            file_put_contents("log.txt", "异步通知 验证失败\n", FILE_APPEND);
            //验证失败

            //$this->updatePayStatus($no_order, 2);

            die("{'ret_code':'9999','ret_msg':'验签失败'}");
            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }
    }

    public function return_url(){
        global $llpay_config;
        $llpayNotify = new \LLpayNotify($llpay_config);
        $verify_result = $llpayNotify->verifyReturn();
        if($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码

            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取连连支付的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
            //商户编号
            $oid_partner = $_POST['oid_partner' ];
            //签名方式
            $sign_type = $_POST['sign_type' ];
            //签名
            $sign= $_POST['sign' ];
            //商户订单时间
            $dt_order= $_POST['dt_order' ];
            //商户订单号
            $no_order = $_POST['no_order' ];
            //支付单号
            $oid_paybill = $_POST['oid_paybill' ];
            //交易金额
            $money_order = $_POST['money_order' ];
            //支付结果
            $result_pay =  $_POST['result_pay'];
            //清算日期
            $settle_date =  $_POST['settle_date'];
            //订单描述
            $info_order =  $_POST['info_order'];
            //支付方式
            $pay_type =  $_POST['pay_type'];
            //银行编号
            $bank_code =  $_POST['bank_code'];

            if($result_pay == 'SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（no_order）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //如果有做过处理，不执行商户的业务程序
            }else {
                echo "result_pay=".$result_pay;
            }
            file_put_contents("log.txt","同步通知:成功\n", FILE_APPEND);
            echo "验证成功<br />";
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            //如要调试，请看llpay_notify.php页面的verifyReturn函数
            file_put_contents("log.txt","同步通知 验证失败\n", FILE_APPEND);
            echo "验证失败";
        }
    }

    private function addMemberRecharge($memberId, $payAmount, $orderNO){
        if(!is_int($memberId) || $memberId <= 0 || !is_numeric($payAmount) || $payAmount <= 0 || strlen($orderNO) < 5){
            error("rechare 参数错误");
        }
        $data = array();
        $data['memberId'] = $memberId;
        $data['amount'] = $payAmount;
        $data['status'] = 0;
        $data['no_order'] = $orderNO;
        $data['createTime'] = date("Y-m-d H:i:s");
        Db::table("xh_member_recharge")->insertGetId($data);
    }

    public function doPay(){

        $payAmount = (float)trim(input("b-pay-amount"));
        if($payAmount <= 0){
            error("充值金额不正确");
        }

        if(!isset($_SESSION['member']) || $_SESSION['member']['id'] <= 0){
            error("请先登录");
        }

        //商户用户唯一编号
        $user_id = $_SESSION['member']['id'];
//商户订单号
        $no_order = $user_id.get_total_millisecond().rand(100,999);

        //添加数据库记录
        $this->addMemberRecharge($user_id, $payAmount, $no_order);

//支付类型
        $busi_partner = "101001"; //必填 虚拟商品：101001 实物商品：109001 账户充

//商户网站订单系统中唯一订单号，必填

//付款金额
        $money_order = $payAmount;
//必填

//商品名称
        $name_goods = "点买股票";

//订单地址
        $url_order = $_POST['url_order'];

//订单描述
        $info_order = "";

//银行网银编码
        $bank_code = "";

//支付方式
        $pay_type = "";

//卡号
        $card_no = "";

//协议号
        $no_agree = "";

//修改标记
        $flag_modify = 1;
  	    $user_id = $_SESSION['member']['id'];
        $member = Db::table("xh_member")->where("id=$user_id")->find();
        if(!$member){
            error("用户不存在");
            Log::log("用户不存在");
        }
        $acct_name=$member['realName'];
        $id_no=$member['IDNumber'];
        $mobile = $_SESSION['member']['mobile'];
        $createTime = $_SESSION['member']['createTime'];
        $createTime = date("YmdHis", strtotime($createTime));
//风险控制参数
        //$risk_item = '{"user_info_bind_phone":"'.$mobile.'","user_info_dt_register":"'.$createTime.'","risk_state":"1","frms_ware_category":"1009"}';
        $riskMap = array("frms_ware_category"=>"2026", "user_info_mercht_userno"=>"$user_id",
            "user_info_dt_register"=>$createTime,"user_info_bind_phone"=>$mobile,
            "user_info_full_name"=>$acct_name,
            "user_info_id_no"=>$id_no, "user_info_identify_state"=>"1", "user_info_identify_type"=>"1" );

        //{"frms_ware_category":"2009","user_info_mercht_userno":"123456","user_info_dt_register":"20141015165530","user_info_full_name":"张三","user_info_id_no":"3306821990012121221",
        //"user_info_identify_type":"1","user_info_identify_state":"1"}
//风险控制参数
        $risk_item = json_encode($riskMap, JSON_UNESCAPED_UNICODE);//'{\"user_info_bind_phone\":\"13958069593\",\"user_info_dt_register\":\"20131030122130\",\"risk_state\":\"1\",\"frms_ware_category\":\"1009\"}';
        //$risk_item = mysql_escape_string($risk_item);
//分账信息数据
        $shareing_data = "";

        //返回修改信息地址
        $back_url = "";

//订单有效期
        $valid_order = "";

//服务器异步通知页面路径
        $host = "http://www.dsqqapp.com";
        //$notify_url = "$host/webllpay/notify_url.php";
        $notify_url = "$host/index/lianlianpay/notify_url";

//需http://格式的完整路径，不能加?id=123这类自定义参数

//页面跳转同步通知页面路径
        //$return_url = "$host/index/lianlianpay/return_url";
        $return_url = "$host/ucenter/index.html";
//需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

        /************************************************************/
        date_default_timezone_set('PRC');
        global  $llpay_config;

//构造要请求的参数数组，无需改动
        $parameter = array (
            "version" => trim($llpay_config['version']),
            "oid_partner" => trim($llpay_config['oid_partner']),
            "sign_type" => trim($llpay_config['sign_type']),
            "userreq_ip" => trim($llpay_config['userreq_ip']),
            "id_type" => trim($llpay_config['id_type']),
            "valid_order" => trim($llpay_config['valid_order']),
            "user_id" => $user_id,
            "timestamp" => local_date('YmdHis', time()),
            "busi_partner" => $busi_partner,
            "no_order" => $no_order,
            "dt_order" => local_date('YmdHis', time()),
            "name_goods" => $name_goods,
            "info_order" => $info_order,
            "money_order" => $money_order,
            "notify_url" => $notify_url,
            "url_return" => $return_url,
            "url_order" => $url_order,
            "bank_code" => $bank_code,
            "pay_type" => $pay_type,
            "no_agree" => $no_agree,
            "shareing_data" => $shareing_data,
            "risk_item" => $risk_item,
            "id_no" => $id_no,
            "acct_name" => $acct_name,
            "flag_modify" => $flag_modify,
            "card_no" => $card_no,
            "back_url" => $back_url
        );
//建立请求
        $llpaySubmit = new \LLpaySubmit($llpay_config);
        $html_text = $llpaySubmit->buildRequestForm($parameter, "post");
        echo $html_text;
    }


}