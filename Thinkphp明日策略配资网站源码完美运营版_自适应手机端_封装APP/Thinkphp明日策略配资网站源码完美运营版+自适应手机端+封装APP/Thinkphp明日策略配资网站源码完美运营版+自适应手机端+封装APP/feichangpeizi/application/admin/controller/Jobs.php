<?php
/**
 * Created by PhpStorm.
 * User: wo
 * Date: 2017/7/17
 * Time: 14:26
 */

namespace app\admin\controller;

use think\Db;
use app\index\controller\Alistock;
use app\index\controller\Home;
use app\admin\controller\Member;
use think\Cache;


set_time_limit(0);

class Jobs
{
    //批量获取在线股票的实时数据，存到数据库
    public function getStockDataToDb(){
        $t1 = time();
        $tm = time() - 10;
        $stockList = Db::table("xh_stock_visit_record")->field("distinct(code)")->where("createTimeStamp > $tm")->select();
        $stocks = "";
        foreach($stockList as $k => $v){
            if($stocks != ''){
                $stocks .= ",";
            }
            $stocks .= $v['code'];
        }

        $stockMap = (new Alistock())->batch_real_stockinfo($stocks);
        //print_r($stockMap);
        foreach($stockMap as $k => $v){
            //print_r($v);
            $data = $this->object2array($v);
            $data['createTime'] = date("Y-m-d H:i:s");
            $data['createTimeStamp'] = time();

            $ret = Db::table("xh_online_stock_detail")->insertGetId($data);
            echo ($ret."<br/>");
        }

        $t2 = time();
        echo "t2-t1=".($t2 - $t1);
        //print_r($this->object2array($stockMap));

    }

    private function object2array(&$object) {
        if (is_object($object)) {
            $arr = (array)($object);
        } else {
            $arr = &$object;
        }
        if (is_array($arr)) {
            foreach($arr as $varName => $varValue){
                $arr[$varName] = $this->object2array_($varValue);
            }
        }
        return $arr;
    }

    function object2array_(&$object) {
        $object =  json_decode( json_encode( $object),true);
        return  $object;
    }


    //获取股票实时价格，自动平仓 (每秒运行一次)
    public function pingCang(){
        $t1 = time();

        $res = Db::table("xh_stock_order")
            ->where("status=1 and isFreetrial=0")
            ->field("distinct(stockCode)")
            ->select();
        $stocks = ""; //上证指数 深证成指 创业板指
        foreach($res as $k=>$v){
            if($stocks != ""){
                $stocks .= ",";
            }
            $stocks .= $v['stockCode'];
        }
        $stockMap = (new Alistock())->batch_real_stockinfo_full($stocks);

        $orderList = Db::table("xh_stock_order")
            ->where("status=1 and isFreetrial=0")
            ->select();
        foreach($orderList as $k=>$v){
            global $orderId, $liquidation;
            $orderId = $v['id'];
            $surplus = $v['surplus']; //止盈线
            $loss = $v['loss'];//止损线
            $stockDetail = $stockMap[$v['stockCode']];

            $diff_rate = $stockDetail->diff_rate ;//涨跌幅
            if($diff_rate <= -9.95){//股票跌停则不允许卖出
                echo $v['stockCode']."跌停<br/>";
                continue;
            }
            $nowPrice = $stockDetail->nowPrice ;   //实时价格
            if($nowPrice <= 0){
                continue;
            }
            $profit = ((float)$nowPrice - (float)$v['dealPrice']) * $v['dealQuantity'] * 100; //交易盈亏
            $profit = round($profit, 2);
            //如果盈亏大于止盈线或小于止损线，则即时强制平仓
            $liquidation = -1; //0用户自己卖出; 1后台手动平仓；2超过止损线自动平仓；3超过止盈线自动平仓
            if($profit > $surplus){
                $liquidation = 3;
            }else if($profit < $loss){
                $liquidation = 2;
            }
            echo "diff_rate=$diff_rate % , orderId = $orderId, profit = $profit, surplus = $surplus, loss=$loss <br/>";

            //访问后台函数的权限
            define('UID', 1);
            session('user_auth.uid', 1);
            if($liquidation == 2 || $liquidation == 3){
                Db::transaction(function(){
                    global $orderId, $liquidation;
                    //echo "orderId=$orderId, liquidation=$liquidation";
                    (new Order())->stock_sell_do($orderId, $liquidation);
                    Db::commit();
                });
                //(new Order())->stock_sell_do($orderId, $liquidation);
            }
        }

        $t2 = time();
        echo "t2-t1=".($t2 - $t1)."<br/>";
    }

    //获取股票实时价格，判断亏损额大于递延条件则不允许递延（每天结束交易时运行一次）
    public function noDelay(){
        if(date("H:i:s") <= "15:00:00"){
            die("交易时间不能调用此接口");
        }
        $res = Db::table("xh_stock_order")
            ->where("status=1 and isFreetrial=0")
            ->field("distinct(stockCode)")
            ->select();
        $stocks = ""; //上证指数 深证成指 创业板指
        foreach($res as $k=>$v){
            if($stocks != ""){
                $stocks .= ",";
            }
            $stocks .= $v['stockCode'];
        }
        $stockMap = (new Alistock())->batch_real_stockinfo_full($stocks);

        $orderList = Db::table("xh_stock_order")
            ->where("status=1 and isFreetrial=0")
            ->select();

        foreach($orderList as $i=>$v){
            global $orderId ;
            $orderId = $v['id'];
            $delayLine = $v['delayLine'];//止损线
            $stockDetail = $stockMap[$v['stockCode']];

            $diff_rate = $stockDetail->diff_rate ;//涨跌幅
            if($diff_rate <= -9.95){//股票跌停则不允许卖出
                echo $v['stockCode']."跌停<br/>";
                continue;
            }
            $nowPrice = $stockDetail->nowPrice;
            if($nowPrice <= 0){
                continue;
            }
            //echo "diff_rate=$diff_rate, nowPrice=$nowPrice <br/>";
            $profit = ((float)$nowPrice - (float)$v['dealPrice']) * $v['dealQuantity'] * 100; //交易盈亏
            $profit = round($profit, 2);
            if( $profit < -abs($delayLine) ){
                echo "orderId=$orderId, profit=$profit, delayLine=$delayLine <br/>";
                Db::transaction(function(){
                    global $orderId;
                    (new Order())->stock_sell_do($orderId, 4); //4 收盘时亏损额大于递延条件而自动平仓
                    Db::commit();
                });
            }
        }
    }

    //计算递延天数和递延费 每天凌晨运行一次
    public function delayDays(){
        Db::transaction(function(){
            $t1 = self::msectime();
            require_once (dirname(__FILE__)."/../../index/controller/Home.php");
            $delayFee = \app\index\controller\getSysParamsByKey("delayFee");
            if(!is_numeric($delayFee)|| $delayFee <= 0) {
                die("递延费({$delayFee})不正确");
            }

            //获取交易列表
            $orderList = Db::table("xh_stock_order")
                ->where("status=1 and isFreetrial=0 and TO_DAYS(now()) - TO_DAYS(createTime)  > 0 ")
                ->select();
            $hList = Db::table("xh_holiday")->field("day")->select();

            foreach($orderList as $k=>$v){
                $orderId = $v['id'];
                $memberId = $v['memberId'];
                $dealAmount = $v['dealAmount'];
                $createTime = $v['createTime'];
                $workDays = $this->getWorkdaysCount($createTime, $orderId, $memberId, $delayFee * $dealAmount, $hList);
                $delayDays = $workDays;
                if($delayDays < 0){
                    $delayDays = 0;
                }
                if($delayDays > 0) {
                    $delayFeeSum = 0;
                    if($delayDays > 2){
                        $delayFeeSum = ($delayDays-2) * $delayFee * $dealAmount;
                    }
                    $sql = "update xh_stock_order set delayDays = $delayDays, delayFeeSum = $delayFeeSum where id=$orderId ";
                    Db::execute($sql);
                }
            }

            $t2=self::msectime();
            echo "time=".($t2 - $t1)."毫秒";
        });
    }

    public function msectime(){
    	
	    list($msec, $sec) = explode(' ', microtime());
	    $msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
	    return $msectime;
    }

    function getWorkdaysCount ($start_date, $orderId, $memberId, $delayFee, $hList=null )
    {
        $t_start = strtotime($start_date);
        if(!$t_start){
            die("时间格式不对");
        }

        //从数据库读取节假日列表
        if(!$hList || count($hList) <= 0){
            $hList = Db::table("xh_holiday")->field("day")->select();
        }

        $days = 0;
        $i = 0;
        $nowTime = strtotime(date("Y-m-d ")."23:59:59");
        while( $t_start + 3600*24*$i <  $nowTime)
        {
            $timer = $t_start + 3600*24*$i;
            $num= date("N", $timer);
            if($num >= 1 and $num <= 5)
            {
                $timerDate = date("Y-m-d", $timer);
                //判断是否是节假日
                $isHoliday = false;
                foreach($hList as $k=>$v){
                    if($timerDate == $v['day']){
                        $isHoliday = true;
                        break;
                    }
                }
                if(!$isHoliday){ //非周末以及非节假日，则天数加1
                    $days++;
                    //如果days大于2，则添加递延费记录
                    if($days > 2 && !Db::table("xh_day_delayfee")->where("day='$timerDate' and orderId=$orderId")->find()){

                        $member = Db::table("xh_member")->field("username,mobile,usableSum")->where("id=$memberId")->find();
                        $usableSum = $member['usableSum'];
                        if($usableSum >= $delayFee){//如果可用余额大于即将扣除的递延费
                            $data=array();
                            $data['day'] = $timerDate;
                            $data['memberId'] = $memberId;
                            $data['orderId'] = $orderId;
                            $data['delayFee'] = $delayFee;
                            Db::table("xh_day_delayfee")->insertGetId($data);//增加递延记录

                            //扣除余额
                            Db::table("xh_member")->where("id=$memberId")->setInc("usableSum", -$delayFee);
                            //添加资金记录
                            $data=array();
                            $data['memberId'] = $memberId;
                            $data['flow'] = 2;
                            $data['amount'] = $delayFee;
                            $data['usableSum'] = $usableSum - $delayFee;
                            $data['remarks'] = "扣除{$timerDate}递延费{$delayFee}元(订单号:$orderId)";
                            $data['createTime'] = date("Y-m-d H:i:s");
                            Db::table("xh_member_fundrecord")->insertGetId($data);

                        }else{//如果余额不足  添加系统消息
                            $msg = "用户".$member['username']."(手机号为".$member['mobile'].")余额{$usableSum}元，扣除{$timerDate}的递延费{$delayFee}元失败(订单号:$orderId)";
                            Db::table("xh_note_msg")->insertGetId(array('message'=>$msg, 'createTime'=>date("Y-m-d H:i:s")));
                        }

                    }
                }

            }
            $i++;
        }

        return $days;
    }

    public function setChuQuan(){
    	
      	$GetData =new Alistock();
		$nowtime = date("Ymd", time());
		
		$data_fan = $GetData->getStockXdrData($nowtime);
		$arr = json_decode($data_fan,true);
		$dr_arr = $arr['showapi_res_body']['shareDividendList'];
        
		//获取今日除权出息的股票组
		$xd_arr =array();
		foreach($dr_arr as $xd){
			
			if(stripos($xd['reason'], '转')){
				
		
				$str = $xd['reason'];
				$pattern = "/([\d]+)转增([\d|.]+)股派([\d|.]+)元/";
				
				preg_match($pattern, $str, $matches);
				
				$num1 = floatval($matches[1]);
				$num2 = floatval($matches[2]);
				$num3 = floatval($matches[3])/$num1;
				
				$num = ($num1+$num2)/$num1;
				$xd['bili'] = $num;
				$xd['hongli'] = $num3;	
				
				$arr_hq = json_decode($GetData->getStockInfoData($xd['code']),true);
				$spj = $arr_hq['showapi_res_body']['stockMarket']['nowPrice'];
				$xd['spj'] = $spj;
				
				$xd_arr[] = $xd;
				
			}
			
		}
		

		//获取所有留仓的单子
		$liu_list = Db::table("xh_stock_order")->field("id,memberId,xdStatus,stockCode,dealPrice,dealAmount,dealQuantity")
		                                       ->where("status = 1")
		                                       ->select();
											   
				   
		
			foreach ($liu_list as $liu) {
				
				  $stockcode = $liu['stockCode'];
				  $memberid = $liu['memberId'];
				  $id = $liu['id'];
				  $price01 = $liu['dealPrice'];
				  $num01 = $liu['dealQuantity'];
				  if($liu['xdStatus'] == 1) continue;
				  foreach ($xd_arr as $xd) {
				  	   if($xd['code'] == $stockcode){
				  	   	   $price = ($price01 -$xd['hongli'])/$xd['bili'];
						   $price = round($price,2);
						   $num = round($num01*$xd['bili']);						  						   
						   
						   //更新资金开始,因为最少为一手，不能有零股，所有必须作相应的资金更新
							Db::transaction(function() use ($id,$memberid,$liu,$num,$num01,$price,$price01,$xd){
								
									//股数变多，股价相应减少
						            Db::table("xh_stock_order")->where("id=$id")->update(['dealPrice'=>$price,'dealQuantity'=>$num,'xdStatus'=>1]);

					                $uid = $memberid;
									//计算资金变动
									$profit01 = ($xd['spj']-$price01)*$num01*100;
									$price_xd = ($xd['spj']-$xd['hongli'])/$xd['bili'];
									$profit = ($price_xd - $price)*$num*100;
									$amount = round((100*$num01*$xd['hongli']*0.8-($profit-$profit01)),2);
									
									/*
									echo $xd['hongli'];
									echo '()';
									echo (100*$num01*$xd['hongli']*0.8);
									echo '()';
									echo $profit;
									echo '()';
									echo $profit01;
									echo '()';
									die;
                                    */
									
					                if($uid <= 0){
					                    return ('参数错误');
					                }
					                if(!is_numeric($amount)){
					                    return ('金额格式不对');
					                }
					
					                if ( Db::table("xh_member")->where("id=$uid")->setInc("usableSum", $amount) ) {
					                    $member =  Db::table("xh_member")->field("usableSum")->where("id=$uid")->find();
					                    $usableSum = $member['usableSum'];
					                    $flow = 1;
					                    $remarks = "除权出息作相应权益调整";

					
					                    //增加资金记录
					                    $data = array();
					                    $data['memberId'] = $uid;
					                    $data['flow'] = $flow;
					                    $data['amount'] = $amount;
					                    $data['usableSum'] = $usableSum;
					                    $data['remarks'] = $remarks;
					                    $data['createTime'] = date("Y-m-d H:i:s");
					                    Db::table("xh_member_fundrecord")->insertGetId($data);
					
					
					                    Db::commit();
					
					                    // 记录行为
					                    action_log('recharge', 'admin_member', $uid , UID);
										echo ('新增成功+');
					                    return ('新增成功');
					                } else {
					                    return ('新增失败');
					                }
					            });
											   
						   						   
						   //更新结束
						   
						   break;
				  	   }
					   
					  
				  }
                  							
			}
			
		
      }








}
