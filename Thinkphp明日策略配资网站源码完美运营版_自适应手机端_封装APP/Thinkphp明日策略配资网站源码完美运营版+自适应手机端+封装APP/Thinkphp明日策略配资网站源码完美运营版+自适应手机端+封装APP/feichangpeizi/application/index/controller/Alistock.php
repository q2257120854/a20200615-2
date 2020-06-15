<?php
/**
 * Created by PhpStorm.
 * User: wo
 * Date: 2017/6/22
 * Time: 15:07
 */
namespace app\index\controller;
use think\Model;
use think\Db;

const ALI_HOST = "http://route.showapi.com"; //阿里云查询股票的地址
const APPCODE = "f8a500fec8cb492c8d6cb0383bf5e3e0"; //阿里云股票数据接口 申请的appcode


class Alistock extends Home{


    //根据关键字获取股票列表, 需要传入参数keywords
    public function getSharesByKeywords(){
        $keywords = trim(input("keywords"));
        if(!isset($keywords) || $keywords == "") {
            error("参数不能为空");
        }
		
		$keyword = strtolower($keywords);
		
		if(strpos($keyword,'select')){
			error("error");
		}
		
	    if(strpos($keyword,'update')){
			error("error");
		}
		
	   if(strpos($keyword,'delete')){
			error("error");
		}
	   
	   if(strpos($keyword,'drop')){
			error("error");
		}
	   
	   if(strlen($keyword) > 12 ){
	   	
		   error("error");
	   	
	   }
				
        $condition = " `name` like '%{$keywords}%' or `pinyin` like '%{$keywords}%' or `code` like '%{$keywords}%' ";

        $res = Db::table("xh_shares")->field("id, name, code, pinyin")->where($condition)->select();
        success($res);
    }


    //查询K线图数据（阿里云 ），需传入参数code(股票代码)
    public function getKLine(){
        $code = trim(input("code"));
        if(!$code || $code == ""){
            error("参数(code)不能为空");
        }

        $host = ALI_HOST;
        $path = "/131-50";
        $method = "GET";
        $appcode = APPCODE;
        $headers = array();
        #array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "showapi_appid=87356&showapi_sign=f8a500fec8cb492c8d6cb0383bf5e3e0&beginDay=20180101&code=$code&time=day&type=bfq";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $res_str = curl_exec($curl);
        echo $res_str;

    }

    //查询股票实时分时线数据（阿里云 ），需传入参数code(股票代码)
 public function getTimeLine(){
        $code = trim(input("code"));
        if(!$code || $code == ""){
            error("参数(code)不能为空");
        }

        $host = ALI_HOST;
        $path = "/131-49";
        $method = "GET";
        $appcode = APPCODE;
        $headers = array();
        #array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "showapi_appid=87356&showapi_sign=f8a500fec8cb492c8d6cb0383bf5e3e0&code=".$code."&day=1";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        echo (curl_exec($curl));
    }


    public function getStockInfoData($code){
        $host = ALI_HOST;
        $path = "/131-44";
        $method = "GET";
        $appcode = APPCODE;
        $headers = array();
        #array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "showapi_appid=87356&showapi_sign=f8a500fec8cb492c8d6cb0383bf5e3e0&code={$code}&needIndex=0&need_k_pic=0";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }

        $res_str =  (curl_exec($curl));

        return $res_str;
    }

 
 //新加的，主要为查询上市日期
 public function getStockData($code){
        $host = ALI_HOST;
        $path = "/131-43";
        $method = "GET";
        $appcode = APPCODE;
        $headers = array();
        #array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "showapi_appid=87356&showapi_sign=f8a500fec8cb492c8d6cb0383bf5e3e0&code={$code}";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }

        $res_str =  (curl_exec($curl));

        return $res_str;
    }

	
    // 查询股票实时数据(阿里云) ，需传入参数code(股票代码)
    public function getStockInfo(){
        $code = trim(input("code"));
        if(!$code || $code == ""){
            error("参数(code)不能为空");
        }

        $stockInfo = $this->getStockInfoFromDb($code);
        if($stockInfo){
            success($stockInfo);
        }

        //如果数据库里没有查询到，则调用接口获取
        $res_str = $this->getStockInfoData($code);
        $res = json_decode($res_str);

        if(!$res || $res == '' || $res->showapi_res_code != '0' || $res->showapi_res_body->ret_code != '0'){
            error("获取服务数据失败.");
        }

        success( $res->showapi_res_body->stockMarket );

    }

    //从数据库中读取股票实时数据
    public function getStockInfoFromDb($stockCode){
        Db::table("xh_stock_visit_record")->insertGetId(array('code'=>$stockCode, 'createTime'=>date("Y-m-d H:i:s"), 'createTimeStamp'=>time() ));
        $tm = time() - 15;//获取15秒以内的数据
        $detail = Db::table("xh_online_stock_detail")->where("code='{$stockCode}' and createTimeStamp >= $tm ")->order("id desc ")->find();
        return $detail;
    }


    //批量查询股票实时数据, 返回[600036] => 25.110 数组
    public function batch_real_stockinfo($stocks){
        $path = "/131-46";
        $host = ALI_HOST;
        $method = "GET";
        $appcode = APPCODE;
        $headers = array();
        #array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "showapi_appid=87356&showapi_sign=f8a500fec8cb492c8d6cb0383bf5e3e0&needIndex=0&stocks=$stocks";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $res_str = curl_exec($curl); //die($res_str);
        $res = json_decode($res_str);

        if(!$res || $res == '' || $res->showapi_res_code != '0' || $res->showapi_res_body->ret_code != '0'){
            return false;
        }

        $arr = array();
        $list = $res->showapi_res_body->list;
        foreach($list as $i=>$v){
            $arr[$v->code] = $v->nowPrice;
        }
        return $arr;
    }


     public function batch_real_stockinfo_full($stocks){
        $path = "/131-46";
        $host = ALI_HOST;
        $method = "GET";
        $appcode = APPCODE;
        $headers = array();
        #array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "showapi_appid=87356&showapi_sign=f8a500fec8cb492c8d6cb0383bf5e3e0&needIndex=0&stocks=$stocks";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $res_str = curl_exec($curl); //die($res_str);
        $res = json_decode($res_str);

        if(!$res || $res == '' || $res->showapi_res_code != '0' || $res->showapi_res_body->ret_code != '0'){
            return false;
        }

        $arr = array();
        $list = $res->showapi_res_body->list;
        foreach($list as $i=>$v){
            $arr[$v->code] = $v;
        }
        return $arr;
    }


/*
    public function batch_real_stockinfo_full($stocks){
        $path = "/batch-real-stockinfo";
        $host = ALI_HOST;
        $method = "GET";
        $appcode = APPCODE;
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "needIndex=0&stocks=$stocks";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $res_str = curl_exec($curl);
        $res = json_decode($res_str);

        if(!$res || $res == '' || $res->showapi_res_code != '0' || $res->showapi_res_body->ret_code != '0'){
            return false;
        }

        $arr = array();
        $list = $res->showapi_res_body->list;
        foreach($list as $i=>$v){
            $arr[$v->code] = $v;
        }
        return $arr;
    }
 
 */

    //大盘股指行情_批量  上证指数 深证成指 创业板指
    public function stockIndex(){
        $host = ALI_HOST;
        $path = "/131-45";
        $method = "GET";
        $appcode = APPCODE;
        $headers = array();
        #array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "showapi_appid=87356&showapi_sign=f8a500fec8cb492c8d6cb0383bf5e3e0&stocks=sh000001,sz399001,sz399006";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        return (curl_exec($curl));
    }

    //获取所有的股票列表，分页显示（总共27页）
    public function al_all(){
        set_time_limit(0);
        $host = ALI_HOST;
        $path = "/131-53";
        $method = "GET";
        $appcode = APPCODE;
		

        for($i = 1; $i <= 40; $i++) {

            $headers = array();
            #array_push($headers, "Authorization:APPCODE " . $appcode);
            $querys = "showapi_appid=87356&showapi_sign=f8a500fec8cb492c8d6cb0383bf5e3e0&market=sh&page=$i";  //market 市场简写。支持 sh、sz、hk
            $bodys = "";
            $url = $host . $path . "?" . $querys;

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_FAILONERROR, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            if (1 == strpos("$" . $host, "https://")) {
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            }

            $res_str = curl_exec($curl);
            $res_arr = json_decode($res_str);

            if (!$res_arr || !$res_arr->showapi_res_body || !$res_arr->showapi_res_body->contentlist) {
                //die("error:$res_str");
            }
			
            $arr = $res_arr->showapi_res_body->contentlist;
            //print_r($arr);
            foreach ($arr as $k => $v) {
                $data = $this->object2array($v);
                if (Db::table('xh_shares')->where("code", $data['code'])->find()) {
                    echo Db::table('xh_shares')->where("code", $data['code'])->update($data);
                } else {
                    echo Db::table('xh_shares')->insertGetId($data);
                }
                echo " -<br>";

            }

        }
    }


    //把stdClass Object 转成数组array
    function object2array($array) {
        if(is_object($array)) {
            $array = (array)$array;
        } if(is_array($array)) {
            foreach($array as $key=>$value) {
                $array[$key] = $this->object2array($value);
            }
        }
        return $array;
    }
	
	
	
	
    function getStockXdrData($date){
 	
		$host = ALI_HOST;
		$path = "/131-57";
		$method = "GET";
		$appcode = APPCODE;
		$headers = array();
		#array_push($headers, "Authorization:APPCODE " . $appcode);
		$querys = "showapi_appid=87356&showapi_sign={$appcode}&date={$date}";
		$bodys = "";
		$url = $host . $path . "?" . $querys;
	
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_FAILONERROR, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		if (1 == strpos("$".$host, "https://"))
		{
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		}
	
		$res_str =  (curl_exec($curl));
	
		return $res_str;
	}
		

}