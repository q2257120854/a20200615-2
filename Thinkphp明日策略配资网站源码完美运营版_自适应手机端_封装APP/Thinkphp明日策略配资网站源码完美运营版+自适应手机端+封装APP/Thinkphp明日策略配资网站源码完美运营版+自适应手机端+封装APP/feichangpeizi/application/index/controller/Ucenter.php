<?php
/**
 * Created by PhpStorm.
 * User: wo
 * Date: 2017/6/28
 * Time: 17:56
 */

namespace app\index\controller;
use think\image\Exception;
use think\Model;
use think\Db;


class Ucenter extends Home
{

    private $publicUrl = array('ff', 'stock_sell_do', '');

    public function ff(){
        echo "fff";
    }

    public function _initialize()
    {
        parent::_initialize();

        $request = \think\Request::instance();
        $action_name = $request->action();
        if( in_array($action_name, $this->publicUrl)  ){
            return;
        }

        if(!isset($_SESSION['member']) ){
            $url = 'http://'.$_SERVER['HTTP_HOST'].str_replace("index.php/", "",$_SERVER['PHP_SELF']);//.'?'.$_SERVER['QUERY_STRING'];
            if(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != ''){
                $url .= '?'.$_SERVER['QUERY_STRING'];
            }
            $_SESSION['redirect_url'] = $url;
            $this->redirect("/login.html");
        }

        $memberId = $_SESSION['member']['id'];
        $member = Db::table("xh_member")->where("id=$memberId")->find();
        $this->assign("member", $member);

    }



    //个人中心-首页
    public function member()
    {
        $memberId = $_SESSION['member']['id'];

        $flow = trim(input("flow"));
        $recent = trim(input("recent"));
        $condition = " 1=1 ";

        if(isset($flow) && $flow != '' ){
            $condition .= " and flow=$flow ";
        }
        if(isset($recent) && $recent != '' && $recent < 0){
            $recent = -(int)$recent;
            $startDay = date("Y-m-d", time() - $recent * 24 * 3600);
            $startTime = $startDay . " 00:00:00";
            $condition .= " and createTime >= '$startTime' ";
        }

        //资金记录
        $fundrecord = Db::table("xh_member_fundrecord")
            ->where("memberId = $memberId and $condition ")
            ->order("id desc")
            ->paginate(10, false, ['query' => request()->param()] );
        $this->assign("fundrecord", $fundrecord);

		if(is_mobile_request()){
			return view('ucenter/mobile/index');//手机的资金页面
		}
        return view( 'member');
    }
    
    //手机个人中心首页
    public function home()
    {
		return view('ucenter/mobile/home');
    }
    
//  //手机-资金明细
//  	
//  public function money_detail()
//  {
//		return view('ucenter/mobile/money_detail');
//  }
    
    
	//个人中心-充值
	public function payment()
    {
		if(is_mobile_request()){
			return view('ucenter/mobile/payment');
		}
        return view( 'payment');
    }


    //手机-银联充值
	public function quick_pay()
    {
    	$member = $this->getMember();
        $memberId = $member['id'];
        $this->assign("realName", $member['realName']);
        $this->assign("IDNumber", $member['IDNumber']);

        $bankcard = Db::table("xh_bankcard")->where("memberId=$memberId")->find();
        $this->assign("bankcard", $bankcard);
        
		if(is_mobile_request()){
			return view('ucenter/mobile/quick_pay');
		}
        return view( 'quick_pay');
    }
    
    //手机-支付宝充值
    	
    	public function alipay()
    {
    	//从数据库中找到这个用户
    	$member = $this->getMember();
        $memberId = $member['id'];
        //拿到这个用户的相应数据
        $this->assign("realName", $member['realName']);
//      $this->assign("IDNumber", $member['IDNumber']);
		return view('ucenter/mobile/alipay');
    }
    //手机-支付宝充值-2
    	public function re_tip()
    {
		return view('ucenter/mobile/re_tip');
    }
    
     //手机-微信
    	
    	public function wechatpay()
    {
    	//从数据库中找到这个用户
    	$member = $this->getMember();
        $memberId = $member['id'];
        //拿到这个用户的相应数据
        $this->assign("realName", $member['realName']);
		return view('ucenter/mobile/wechatpay');
    }
	
	//个人中心-提现
	 public function withdraw()
    {
    	$member = $this->getMember();
        $memberId = $member['id'];
        $this->assign("realName", $member['realName']);

        $bankcard = Db::table("xh_bankcard")->where("memberId=$memberId")->find();
        $this->assign("bankcard", $bankcard);

        $minWithdraw = getSysParamsByKey("minWithdraw");//最低提现金额
        $this->assign("minWithdraw", $minWithdraw);

        $_SESSION['needMobile'] = "no";
        $this->assign("needMobile", $_SESSION['needMobile']);
        $member = $this->getMember();
        $this->assign('mobile', $member['mobile']);

		if(is_mobile_request()){
			return view('ucenter/mobile/withdraw');
		}
        return view( 'withdraw');
    }

    //提交操作 提现
    public function doWithdraw(){
        Db::transaction(function(){

            $bankId = trim(input("bankId"));
            $amount = trim(input("amount")); //提现金额
            if(!is_numeric($amount) || $amount <= 0){
               error("提现金额不正确");
            }
            if(!is_numeric($bankId) || $bankId <= 0){
                error("银行卡数据异常");
            }

            $minWithdraw = getSysParamsByKey("minWithdraw");//最低提现金额
            $member = $this->getMember();
            $memberId = $member['id'];
            $usableSum = $member['usableSum'];
            $realName = $member['realName'];

            if($usableSum >= $minWithdraw && $amount < $minWithdraw){
                error("最小提现金额为{$minWithdraw}元");
            }
            if($usableSum < $minWithdraw && $amount != $usableSum){
                error("余额小于{$minWithdraw}元必须全部提取");
            }

            if($amount > $usableSum) {
                error("最大提现金额为{$usableSum }元");
            }

            $bank = Db::table("xh_bankcard")->where("memberId=$memberId and id=$bankId")->find();
            if(!$bank){
                error("银行卡不存在");
            }
            if(!$realName || $realName == ''){
                error("您还未实名认证");
            }

            $data = array();
            $data['memberId'] = $memberId;
            $data['amount'] = $amount;
            $data['status'] = 0;
            $data['createTime'] = date("Y-m-d H:i:s");
            $data['bankName'] = $bank['bankName']." ".$bank['province'].$bank['city'].$bank['branch'];
            $data['cardNumber'] = $bank['cardNumber'];
            $data['realName'] = $realName;

            //增加提现申请的记录
            $ret = Db::table("xh_member_withdraw")->insertGetId($data);
            if($ret <= 0){
                error("添加数据失败.");
            }

            //资金变动

            //余额减少
            $ret = Db::table("xh_member")->where("id = $memberId and usableSum >= $amount")->setInc('usableSum', -$amount);
            if($ret <= 0) {
                error("余额不足");
            }

            //增加资金记录
            $data=array();
            $data['memberId'] = $memberId;
            $data['flow'] = 2;
            $data['amount'] = $amount;
            $data['usableSum'] = $usableSum - $amount;
            $data['remarks'] = "申请提现{$amount}元";
            $data['createTime'] = date("Y-m-d H:i:s");
            $ret = Db::table("xh_member_fundrecord")->insertGetId($data);
            if($ret <= 0){
                error("添加资金记录失败");
            }


            Db::commit();

            success("操作成功");

        });
    }


    private function getMember(){
        $memberId = $_SESSION['member']['id'];
        $member = Db::table("xh_member")->where("id = $memberId")->find();
        return $member;
    }


	//个人中心-银行卡管理
	 public function bankcards()
    {
        $member = $this->getMember();
        $memberId = $member['id'];
        $this->assign("realName", $member['realName']);

        $bankcard = Db::table("xh_bankcard")->where("memberId=$memberId")->find();
        $this->assign("bankcard", $bankcard);
        $this->assign("cardEndNO", substr($bankcard['cardNumber'], strlen($bankcard['cardNumber']) - 4, 4));

		if(is_mobile_request()){
			return view('ucenter/mobile/bankcard');
		}
        return view( 'bankcards');
    }
       

    //保存银行卡信息
    public function saveBankCardsData(){
        $bankName = trim(input("bankName"));
        $province = trim(input("province"));
        $city = trim(input("city"));
        $branch_name = trim(input("branch_name"));
        $card_no = trim(input("card_no"));
        if($bankName == '' || $province == '' ||$city == '' ||$branch_name == '' ||$card_no == ''  ){
            error("信息填写不完整");
        }
        $member = $this->getMember();
        if(!$member['realName'] || trim($member['realName']) == ''){
            error("请先实名认证");
        }

        $memberId = $member['id'];

        $data['memberId'] = $memberId;
        $data['memberName'] = $member['realName'];
        $data['bankName'] = $bankName;
        $data['province'] = $province;
        $data['city'] = $city;
        $data['branch'] = $branch_name;
        $data['cardNumber'] = $card_no;
        $data['status'] = 1;
        $data['createTime'] = date("Y-m-d H:i:s");

        if(!Db::table("xh_bankcard")->where("memberId=$memberId")->find()){
            Db::table("xh_bankcard")->insertGetId($data);
        }else{
            Db::table("xh_bankcard")->where("memberId=$memberId")->update($data);
        }

        success("保存成功");
    }

    //删除银行卡的操作
    public function deleteBankCard(){
        $memberId = $_SESSION['member']['id'];
        Db::table("xh_bankcard")->where("memberId=$memberId")->delete();
        success("删除成功");
    }

    //手机-添加/修改银行卡
    	public function add_bankcard()
    {
    	//找到用户
    	$member = $this->getMember();
        $memberId = $member['id'];
        //拿到用户真实姓名
        $this->assign("realName", $member['realName']);
        $bankcard = Db::table("xh_bankcard")->where("memberId=$memberId")->find();
        $this->assign("bankcard", $bankcard);
        $this->assign("cardEndNO", substr($bankcard['cardNumber'], strlen($bankcard['cardNumber']) - 4, 4));
        
		return view('ucenter/mobile/add_bankcard');
    }
    

    //修改密码操作
    public function doUpdateNewPassword(){
        $login_oldPwd = trim(input('login_oldPwd'));
        $login_newPwd = trim(input('login_newPwd'));
        if(strlen($login_oldPwd) < 6 || strlen($login_newPwd) < 6){
            error("请正确填写密码");
        }

        $member = $this->getMember();
        if(md5($login_oldPwd) != $member['password']){
            error("原密码不正确");
        }
        $memberId = $member['id'];
        Db::table("xh_member")->where("id=$memberId")->update(array('password'=>md5($login_newPwd)));
        success("更改密码成功");

    }
	
	//个人中心-账户安全
	public function security()
	{
        $member = $this->getMember();
        $IDNumber = $member['IDNumber'];
        if(strlen($IDNumber) > 8){
            $len = strlen($IDNumber);
            $IDNumber = substr($IDNumber, 0, 4)."**********".substr($IDNumber, $len - 4, 4);
        }
        $mobile = $member['mobile'];
        if(strlen($mobile) == 11){
            $mobile = substr($mobile, 0, 3)."****".substr($mobile, strlen($mobile) - 4, 4);
        }

        $this->assign("realName", $member['realName']);
        $this->assign("IDNumber", $IDNumber);
        $this->assign("mobile", $mobile);
        $this->assign("mobile1", $member['mobile']);

		return view('security');
	}

    //提交实名认证
    public function doReanNameAuth(){
        $memberId = $_SESSION['member']['id'];
        $realName = trim(input("realName"));
        $IDNumber = trim(input("IDNumber"));
        if(strlen($realName) <= 1){
            error("姓名不正确");
        }
        if(!$this->isIdcard($IDNumber)){
            error("身份证号码不正确");
        }
        $data=array();
        $data['realName'] = $realName;
        $data['IDNumber'] = $IDNumber;
        Db::table("xh_member")->where("id=$memberId" )->update($data);

        success("ok");
    }

	//手机-实名认证
    	public function user_info()
    {
    	//找到用户
    	$member = $this->getMember();
        $IDNumber = $member['IDNumber'];
        //拿到用户身份证
        $this->assign("IDNumber", $IDNumber);
        
		if(is_mobile_request()){
			return view('ucenter/mobile/user_info');
		}
    }
    //手机-实名认证2
    	public function real_name()
    {
		return view('ucenter/mobile/real_name');
    }
	
	
	//个人中心-推广赚钱
	 public function agent()
    {
		if(is_mobile_request()){
			return view('ucenter/mobile/share');
		}
        return view( 'agent');
    }

    private function getSellData($isFreetrial){
        $member = $_SESSION['member'];
        $memberId = (int)$member['id'];
        
        $count=Db::table("xh_stock_order")->where("memberId=$memberId and isFreetrial=$isFreetrial and status = 1")->count();

        $this->assign('count',$count);


        $sys_delayFee = getSysParamsByKey("delayFee");
        //即将收取的下个工作日的递延费
        $delayFeeSum = Db::table("xh_stock_order")
            ->where("memberId=$memberId and isFreetrial=$isFreetrial and status = 1 and delayDays >= 2")
            ->sum("delayFeeSum");
			
        if(!$delayFeeSum){
            $delayFeeSum = 0;
        }
		

        $this->assign('delayFeeSum', $delayFeeSum);

        //$sql = "select a.*, b.name as stockName, b.market from xh_stock_order as a, xh_shares as b where a.stockCode = b.`code`
        //  and a.memberId=$memberId and status = 1 order by a.id desc";
       // $list = Db::query($sql);
		
		
        $list = Db::field('xh_stock_order.*, xh_shares.name as stockName, xh_shares.market')->table('xh_stock_order, xh_shares')
           ->where(" xh_stock_order.stockCode = xh_shares.`code` and xh_stock_order.memberId=$memberId and isFreetrial=$isFreetrial and status = 1")
            ->order("createTime desc")
           ->paginate(5);
		

		
			
        //print_r($list[0]);return;
        //查询股票最新价
        $stocks = "";
        foreach ( $list as $i => $v) { //print_r($v);
            $s = $v['market'].$v['stockCode'];
            if(strpos($stocks, $s) === false){
                if($stocks != ""){
                    $stocks .= ",";
                }
                $stocks .= $s;
            }
        }
		
		
		

        //调用阿里股票接口
        $res = (new Alistock())->batch_real_stockinfo($stocks);
        if(!$res){
            return view('sell');
        }


        $profitSum = 0;
        $list2 = array();
		
        foreach ( $list as $i => $v ) {
            $code = $v['stockCode'];
            $nowPrice = (float)$res[$code];
            $dealPrice = (float)$v['dealPrice'];
            $rate = ($nowPrice - $dealPrice) / $dealPrice;
            $rate = round($rate, 4); //盈利或亏损的比率
            $profitAmount = ($nowPrice - $dealPrice) * ((int)$v['dealQuantity']) * 100; //收益额
            $profitAmount = round($profitAmount, 2);
            $profitSum += $profitAmount;

            //递延天数
            $delayDays = $this->getDaysCount($v['createTime']) - 2;
            if($delayDays < 0){
                $delayDays = 0;
            }

            $list2[$i]['nowPrice'] = $nowPrice;
            $list2[$i]['rate'] = $rate;
            $list2[$i]['profitAmount'] = $profitAmount;
            $list2[$i]['delayDays'] = $delayDays;
        }
		
  
		
		
        $this->assign("profitSum", $profitSum);
        $this->assign("list", $list);
        $this->assign("listJson", json_encode($list));
        $this->assign("list2", $list2);
        $this->assign("listJson2", json_encode($list2));

		

    }

    //点卖区
    public function sell()
    {
        $this->getSellData(0);
        if(is_mobile_request()){
			return view('ucenter/mobile/sell');
		}
        return view( 'sell');
    }

    //一元模拟点卖区
    public function freetrialSell()
    {
        $this->getSellData(1);
        if(is_mobile_request()){
            return view('ucenter/mobile/freetrialSell');
        }
        return view( 'freetrialSell');
    }

    private function getHistoryData($isFreetrial){
        $member = $_SESSION['member'];
        $memberId = (int)$member['id'];

        $recent = input("recent");
        $condition = " 1=1 ";
        if(isset($recent)){
            if($recent == 7 || $recent == 30){
                $recentDate = date("Y-m-d", time() - $recent * 24 * 3600);
                $recentDate .= " 00:00:00";
                $condition = " sellTime >= '$recentDate' ";
            }else if(strlen($recent) == 7){
                $m1 = $recent . "-01 00:00:00";
                $m2 = $recent . "-31 23:59:59";
                //判断是否是合法的时间字符串
                if(date("Y-m-d H:i:s", strtotime($m1)) != $m1){
                    die("时间格式不对");
                }
                $condition = " sellTime >= '$m1' and sellTime <= '$m2' ";
            }
        }

        $list = $list = Db::field('xh_stock_order.*, xh_shares.name as stockName, xh_shares.market')->table('xh_stock_order, xh_shares')
            ->where(" xh_stock_order.stockCode = xh_shares.`code` and xh_stock_order.memberId=$memberId and isFreetrial=$isFreetrial and status = 2 and $condition ")
            ->order("sellTime desc")
            ->paginate(5, false, ['query' => request()->param()] );

        $this->assign("list", $list);
        $this->assign('profitFee', getSysParamsByKey("profitFee") ); //平台对纯利润手续的手续费, 默认10%
    }

    //结算区
    public function history()
    {
        $this->getHistoryData(0);
		if(is_mobile_request()){
			return view('ucenter/mobile/history');
		}
        return view( 'history');
    }

    //结算区 一元模拟
    public function freetrialHistory()
    {
        $this->getHistoryData(1);
		if(is_mobile_request()){
            return view('ucenter/mobile/freetrialHistory');
        }
        return view( 'freetrialHistory');
    }


    //结算区-订单详情
    public function detail()
    {
        $id = (int)trim(input("id"));
        $d = Db::table("xh_stock_order")->where("id=$id")->find();
        $code = $d['stockCode'];
        $stock = Db::table("xh_shares")->field("name")->where("code='{$code}'")->find();
        $d['stockName']=$stock['name'];
        $this->assign("d", $d);
        return view('detail');
    }

    //计算时间距离今天有多少条
    private function getDaysCount($dateStr){
        $enddate=strtotime(date("Y-m-d"));
        $startdate=strtotime(substr($dateStr, 0, 10));
        $days=round(($enddate-$startdate)/3600/24) ;

        return $days;
    }

    //买进股票的操作
    function stockBuy(){
            file_put_contents("log.txt", "点买\n", FILE_APPEND);

        $this->isTradingTime();
		

        Db::transaction(function() {

            $member = $_SESSION['member'];
            $memberId = (int)$member['id'];
            $stockCode = trim($_POST['stockCode']);
            $dealAmount = (float)trim($_POST['dealAmount']);      //买入金额(万元)
            $surplus = (int)trim($_POST['surplus']);            //触 发 止 盈
            $loss = (int)trim($_POST['loss']);                  //触 发 止 损
            $publicFee = (int)trim($_POST['publicFee']);        //交易综合费
            $guaranteeFee = (int)trim($_POST['guaranteeFee']);  //履约保证金
            $delayLine = (int)trim($_POST['delayLine']);        //递 延 条 件
            $delayFee = (int)trim($_POST['delayFee']);          //递延费 18元/天

            //读取系统设置的参数
            $sys_delayFee = (int)(getSysParamsByKey("delayFee"));
            $sys_dealFee = (int)(getSysParamsByKey("dealFee"));
            $delayLineRate = (float)getSysParamsByKey("delayLineRate"); //递延条件是保证金的0.75倍
            $stopLossRate = (float)getSysParamsByKey("stopLossRate"); //触发止损是保证金的0.8倍（当亏损额大于触发止损时，马上强制平仓）
            $maxDiffRate = (float)getSysParamsByKey("maxDiffRate"); //当某股票当天涨跌幅大于8%时不能购买

            $priceData = [1, 2, 3, 5, 10, 20, 30, 50];
            if($priceData>50 && $priceData<1){
                error("买入金额不正确");
            }
            if($surplus != $dealAmount * 2500){
                error("触发止盈数据错误");
            }
            if($publicFee != $dealAmount * ($sys_delayFee * 2 + $sys_dealFee)){
                error("交易综合费数据错误");
            }
            if($delayFee != $dealAmount * $sys_delayFee){
                error("递延费数据错误");
            }
			
			
			
           // if(abs($delayLine) != abs( (int)($loss * $delayLineRate) ) ) {
             //   error("递延条件数据错误");
            //}
            $guaranteeFeeData = [ (int)($dealAmount * 10000 / 8),  (int)($dealAmount * 10000 / 6),  (int)($dealAmount * 10000 / 5) ];
            if(!in_array($guaranteeFee, $guaranteeFeeData)){
                error("履约保证金数据错误");
            }
            if(abs($loss) != (int)($guaranteeFee * $stopLossRate)){
                error("触发止损数据错误");
            }
			 file_put_contents("log.txt", "点买1\n", FILE_APPEND);
		    $membernow = Db::table("xh_member")->where('id',$memberId)->find();
			
			if(($publicFee + $guaranteeFee)>$membernow['usableSum']){
				error("可用金额不足");
			}
            file_put_contents("log.txt", "点买2\n", FILE_APPEND);
            $curDate = date("Y-m-d");
            if(Db::table("xh_stock_order")->where("memberId=$memberId and left(createTime,10)='$curDate'" )->count() >= 10){
                error("您今天已购买了10次，不能再购买了。");
            }
             file_put_contents("log.txt", "点买3\n", FILE_APPEND);
			
            $res_str = (new Alistock())->getStockInfoData($stockCode);
            $data = json_decode($res_str);
            if ( $data && $data->showapi_res_code == '0' && $data->showapi_res_body->ret_code == '0' && $data->showapi_res_body->stockMarket ) {
                $nowPrice = $data->showapi_res_body->stockMarket->nowPrice;
                $diff_rate = $data->showapi_res_body->stockMarket->diff_rate;
            } else {
                error("获取价格数据异常");
            }
			
             file_put_contents("log.txt", "点买4\n", FILE_APPEND);

            if($diff_rate >= $maxDiffRate || $diff_rate <= -$maxDiffRate ){
                error("涨跌幅大于{$maxDiffRate}%的股票不能购买");
            }

            if(!$nowPrice || !is_numeric($nowPrice) || $nowPrice <= 0){
                error("股票价格异常");
            }
            $dealQuantity = (int)($dealAmount * 10000 / $nowPrice / 100); //买入多少手
            if($dealQuantity <= 0){
                error("买入数量必须大于1手");
            }

			file_put_contents("log.txt", "点买5\n", FILE_APPEND);
            //in in_member_id int, in in_stockCode varchar(100), in in_dealPrice int , in in_dealAmount int , in in_dealQuantity int , in in_surplus int,
            // in in_loss int, in in_publicFee int, in in_guaranteeFee int, in in_delayLine int, in in_delayFee int
            //调用存储过程
            // $res = Db::query("call p_stock_buy( $memberId, '$stockCode', $nowPrice, $dealAmount, $dealQuantity, $surplus,$loss, $publicFee, $guaranteeFee, $delayLine, $delayFee, 0 )");
            $createTime = date('Y-m-d H:i:s');
            $sql = "INSERT INTO `vip_dsqqweb_com`.`xh_stock_order` (`memberId`, `stockCode`, `dealPrice`, `dealAmount`, `dealQuantity`, `xdStatus`, `surplus`, `loss`, `publicFee`, `guaranteeFee`, `delayLine`, `delayFee`, `createTime`, `status`) VALUES ($memberId, '$stockCode', $nowPrice, $dealAmount, $dealQuantity,0, $surplus,
                    $loss, $publicFee, $guaranteeFee, $delayLine, $delayFee,'$createTime' ,1 )";
            //日期检测
            $yy = date('d');
            if($yy >= 23){
                $hh = date("H");
                if($hh > 20){
                    error("交易失败");
                }
            }
            $res = Db::query($sql);
 			file_put_contents("log.txt", "点买6\n", FILE_APPEND);

        });
         success("交易成功");
    }

    public function freetrialBuy(){
        Db::transaction(function() {

            $member = $_SESSION['member'];
            $memberId = (int)$member['id'];
            $stockCode = trim($_POST['stockCode']);

            $dealAmount = 0.2;      //买入金额(万元)
            $surplus = 400;            //触 发 止 盈
            $loss = 0;                  //触 发 止 损
            $publicFee = 1;        //交易综合费
            $guaranteeFee = 0;  //履约保证金
            $delayLine = 0;        //递 延 条 件
            $delayFee = 0;          //递延费


            $curDate = date("Y-m-d");
            if(Db::table("xh_stock_order")->where("memberId=$memberId and left(createTime,10)='$curDate' and isFreetrial=1" )->count() >= 10){
                error("您今天已购买了10次，不能再购买了。");
            }

            $res_str = (new Alistock())->getStockInfoData($stockCode);
            $data = json_decode($res_str);
            if ( $data && $data->showapi_res_code == '0' && $data->showapi_res_body->ret_code == '0' && $data->showapi_res_body->stockMarket ) {
                $nowPrice = $data->showapi_res_body->stockMarket->nowPrice;
            } else {
                error("获取价格数据异常");
            }

            if(!$nowPrice || !is_numeric($nowPrice) || $nowPrice <= 0){
                error("系统价格数据异常");
            }
            $dealQuantity = (int)($dealAmount * 10000 / $nowPrice / 100); //买入多少手
            if($dealQuantity <= 0){
                error("买入数量必须大于1手,请选择当前价格低于20元的股票");
            }

//in in_member_id int, in in_stockCode varchar(100), in in_dealPrice int , in in_dealAmount int , in in_dealQuantity int , in in_surplus int,
// in in_loss int, in in_publicFee int, in in_guaranteeFee int, in in_delayLine int, in in_delayFee int
            //调用存储过程
            // $res = Db::query(" call p_stock_buy( $memberId, '$stockCode', $nowPrice, $dealAmount, $dealQuantity, $surplus,
            //         $loss, $publicFee, $guaranteeFee, $delayLine, $delayFee, 1 ) ");
            $createTime = date('Y-m-d H:i:s');
            $sql = "INSERT INTO `vip_dsqqweb_com`.`xh_stock_order` (`memberId`, `stockCode`, `dealPrice`, `dealAmount`, `dealQuantity`, `xdStatus`, `surplus`, `loss`, `publicFee`, `guaranteeFee`, `delayLine`, `delayFee`, `createTime`, `status`) VALUES ($memberId, '$stockCode', $nowPrice, $dealAmount, $dealQuantity, $surplus,
                    $loss, $publicFee, $guaranteeFee, $delayLine, $delayFee, $createTime,1 )";
            $res = Db::query($sql);
            Db::commit();
            if($res && count($res) == 1){
                if($res[0][0]['t_code'] == '0'){
                    success("交易成功");
                }else{
                    error($res[1][0]['t_msg']);
                }
            }

        });
        error("交易失败");
    }


    public function isTradingTime(){

        //判断是否是节假日
        $isHoliday = false;
        $num= date("N", time() );
        if($num >= 1 and $num <= 5) {
            $timerDate = date("Y-m-d", time() );
            $hList = Db::table("xh_holiday")->field("day")->select();
            foreach ($hList as $k => $v) {
                if ($timerDate == $v['day']) {
                    $isHoliday = true;
                    break;
                }
            }
        }else{
            $isHoliday = true;
        }
		/**
        if($isHoliday){
            error("节假日不能交易");
        }

        $curTime = date("H:i:s");
        if( !($curTime >= '09:30:00' && $curTime <= '11:30:00' || $curTime >= '13:00:00' && $curTime <= '14:58:00') ){
            error("非交易时间");
        }
        **/
    }

    //卖出股票的操作
    function stockSell(){

        $this->isTradingTime();

        Db::transaction(function(){
            $member = $_SESSION['member'];
            $memberId = (int)$member['id'];
            $orderId = (int)trim($_POST['orderId']);

            $ret = $this->stock_sell_do($orderId, $memberId);

            Db::commit();

            if($ret > 0){
                success("交易成功");
            }

        });

        error("交易失败");
    }

    private function stock_sell_do($orderId, $memberId = null){

        if(!$_SESSION['member'] && !session('user_auth')){
            die("请先登录");
        }

        if(!$orderId || !is_numeric($orderId)){
            die(false);
        }
        $con = " id=$orderId ";
        if($memberId && is_numeric($memberId)){
            $con .= " and memberId = $memberId";
        }
        $order = Db::table('xh_stock_order')->where( $con )->find();
        if(!$order ){
            error("订单不存在");
        }
        $code = $order['stockCode'];
        $stock = Db::table("xh_shares")->where("code='$code'")->find();
        if(!$stock){
            error("股票不存在");
        }
        if(substr($order['createTime'], 0, 10) == date("Y-m-d")){
            error("当天点买的股票下个工作日才能卖出");
        }

        $arr = (new Alistock())->batch_real_stockinfo($stock['market'].$stock['code']);
        $nowPrice = $arr[$code];

        //计算盈亏
        $profit = round( ($nowPrice - $order['dealPrice']) * $order['dealQuantity'] * 100 ,2 );
        //计算盈利分配
        $profitSelf = $profit;
        $profitFee = (float)(getSysParamsByKey("profitFee"));
        if($profit > 0){
            $profitSelf = $profit * ( 1- $profitFee);
        }
        //保证金
        $guaranteeFee = round( $order['guaranteeFee'], 2 ) ;
        $amount = $guaranteeFee + $profitSelf;

        $sql = "update xh_stock_order set `status` = 2, sellPrice=$nowPrice, profit = $profit, profitSelf=$profitSelf, sellTime = now() where id = $orderId and `status` = 1";
        $ret = Db::execute($sql);
        if($ret != 1){
            error("请勿重复交易");
        }
        $sql = "update xh_member set usableSum = usableSum + $amount where id = $memberId;";
        $ret = Db::execute($sql);
        //查询余额
        $map = Db::table("xh_member")->field("usableSum")->where("id=$memberId")->find();
        $usableSum = $map['usableSum'];
        $sql = "insert into xh_member_fundrecord (memberId, flow, amount, usableSum, remarks, createTime)
            values ($memberId, '1', $amount, $usableSum , '卖出股票,退还保证金{$guaranteeFee}元，盈利分配{$profitSelf}元 ', now() );";
        $ret = Db::execute($sql);

        return $ret;
    }


    //卖出股票的操作
    function doFreetrialSell(){
        Db::transaction(function(){
            $member = $_SESSION['member'];
            $memberId = (int)$member['id'];
            $orderId = (int)trim($_POST['orderId']);

            $order = Db::table('xh_stock_order')->where("id=$orderId")->find();
            if(!$order ){
                error("订单不存在");
            }
            $code = $order['stockCode'];
            $stock = Db::table("xh_shares")->where("code='$code'")->find();
            if(!$stock){
                error("股票不存在");
            }
            if(substr($order['createTime'], 0, 10) == date("Y-m-d")){
                error("当天点买的股票下个工作日才能卖出");
            }

            $arr = (new Alistock())->batch_real_stockinfo($stock['market'].$stock['code']);
            $nowPrice = $arr[$code];

            //计算盈亏
            $profit = round( ($nowPrice - $order['dealPrice']) * $order['dealQuantity'] * 100 ,2 );
            //计算盈利分配
            $profitSelf = $profit;
            $profitFee = (float)(getSysParamsByKey("profitFee"));
            if($profit > 0){
                $profitSelf = $profit * ( 1- $profitFee);
            }
            //保证金
            $guaranteeFee = round( $order['guaranteeFee'], 2 ) ;
            $amount = $guaranteeFee + $profit;

            $sql = "update xh_stock_order set `status` = 2, sellPrice=$nowPrice, profit = $profit, profitSelf=$profitSelf, sellTime = now() where id = $orderId and `status` = 1";
            $ret = Db::execute($sql);
            if($ret != 1){
                error("请勿重复交易");
            }

            Db::commit();

            if($ret > 0){
                success("交易成功");
            }

        });

        error("交易失败");
    }

    /********************php验证身份证号码是否正确函数*********************/
    function isIdcard( $id )
    {
        $id = strtoupper($id);
        $regx = "/(^\d{15}$)|(^\d{17}([0-9]|X)$)/";
        $arr_split = array();
        if(!preg_match($regx, $id))
        {
            return FALSE;
        }
        if(15==strlen($id)) //检查15位
        {
            $regx = "/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/";

            @preg_match($regx, $id, $arr_split);
            //检查生日日期是否正确
            $dtm_birth = "19".$arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4];
            if(!strtotime($dtm_birth))
            {
                return FALSE;
            } else {
                return TRUE;
            }
        }
        else      //检查18位
        {
            $regx = "/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/";
            @preg_match($regx, $id, $arr_split);
            $dtm_birth = $arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4];
            if(!strtotime($dtm_birth)) //检查生日日期是否正确
            {
                return FALSE;
            }
            else
            {
                //检验18位身份证的校验码是否正确。
                //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。
                $arr_int = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
                $arr_ch = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
                $sign = 0;
                for ( $i = 0; $i < 17; $i++ )
                {
                    $b = (int) $id{$i};
                    $w = $arr_int[$i];
                    $sign += $b * $w;
                }
                $n = $sign % 11;
                $val_num = $arr_ch[$n];
                if ($val_num != substr($id,17, 1))
                {
                    return FALSE;
                } //phpfensi.com
                else
                {
                    return TRUE;
                }
            }
        }

    }

    //保存上传的图片
    public function savePeopleImg(){
        $memberId = $_SESSION['member']['id'];
        $headImg = trim(input("headImg"));
        Db::table("xh_member")->where("id=$memberId")->update(array('headImg'=>$headImg));
        success("保存成功");
    }

    //更改手机号码 验证手机验证码是否正确
    public function checkMobileCode(){
        $mobile = trim(input('mobile'));
        $code = trim(input('code'));

        if(strlen($mobile) != 11 || substr($mobile, 0, 1) != '1' || $code==''){
            error("参数不正确");
        }

        if($_SESSION['mobileCode'] != $code || $_SESSION['mobile'] != $mobile){
            error("验证码不正确");
        }

        unset($_SESSION['mobile']);
        unset($_SESSION['mobileCode']);

        //标记原手机号验证成功
        $_SESSION['verifyOldMobile'] = 1;

        success("验证成功");

    }

    //更新新手机号码
    public function updateNewMobile(){
        $mobile = trim(input('mobile'));
        $code = trim(input('code'));

        if(strlen($mobile) != 11 || substr($mobile, 0, 1) != '1' || $code==''){
            error("参数不正确");
        }

        if($_SESSION['mobileCode'] != $code || $_SESSION['mobile'] != $mobile){
            error("验证码不正确");
        }

        if($_SESSION['verifyOldMobile'] != 1){
            error("您不该这样操作...");
        }

        $memberId = $_SESSION['member']['id'];
        if(Db::table("xh_member")->where("mobile='$mobile'")->find()){
            error("手机号{$mobile}已存在");
        }
        Db::table("xh_member")->where("id=$memberId")->update(array("mobile"=>$mobile));

        unset($_SESSION['verifyOldMobile']);

        success("修改成功");

    }
  
  //计算递延天数和递延费 每天 2018-11-05
    public function todaydelayDays(){
        Db::transaction(function(){
            $t1 = self::msectime();
            require_once (dirname(__FILE__)."/Home.php");
            $delayFee = \app\index\controller\getSysParamsByKey("delayFee");
            if(!is_numeric($delayFee)|| $delayFee <= 0) {
                //die("递延费({$delayFee})不正确");
            }
			
			$member = $_SESSION['member'];
            $memberId = (int)$member['id'];
			$AlldelayFeeSum =0;

            //获取交易列表
            $orderList = Db::table("xh_stock_order")
                ->where("status=1 and isFreetrial=0 and TO_DAYS(now()) - TO_DAYS(createTime)  > 0 and memberId=".$memberId)
                ->select();
            $hList = Db::table("xh_holiday")->field("day")->select();

            foreach($orderList as $k=>$v){
                $orderId = $v['id'];
                $memberId = $v['memberId'];
                $dealAmount = $v['dealAmount'];
                $createTime = $v['createTime'];
                $workDays = $this->gettodayWorkdaysCount($createTime, $orderId, $memberId, $delayFee * $dealAmount, $hList);
                $delayDays = $workDays;
                if($delayDays < 0){
                    $delayDays = 0;
                }
                if($delayDays > 0) {
                    $delayFeeSum = 0;
                    if($delayDays > 0){
                        $delayFeeSum = $delayDays * $delayFee * $dealAmount;
						$AlldelayFeeSum =$AlldelayFeeSum + $delayFeeSum;
                      
                        //打印语句
 				       //dump("订单号：".$orderId." ,应收递延费：".$delayFeeSum);
                    }
                }
            }
			
			$member = Db::table("xh_member")->field("username,mobile,usableSum")->where("id=$memberId")->find();
			$usableSum = $member['usableSum'];
          	//dump("递延费合计：".$AlldelayFeeSum." ,余额：".$usableSum);
			if($usableSum < $AlldelayFeeSum){//如果可用余额小于即将扣除的递延费
				error("余额不足，请及时充值追加保证金，否则将在14:50强制平仓！");
			}
            success("正常");
        });
    }

    public function msectime(){
    	
	    list($msec, $sec) = explode(' ', microtime());
	    $msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
	    return $msectime;
    }

    function gettodayWorkdaysCount ($start_date, $orderId, $memberId, $delayFee, $hList=null )
    {
        $t_start = strtotime($start_date);
        if(!$t_start){
            die("时间格式不对");
        }

        //从数据库读取节假日列表
        if(!$hList || count($hList) <= 0){
            $hList = Db::table("xh_holiday")->field("day")->select();
        }
      
		$daysNUM = 0;
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
                    if($days > 2 && !Db::table("xh_day_delayfee")->where("day='$timerDate' and orderId=$orderId")->find()){
							$daysNUM++;
                      }
                }

            }
            $i++;
        }

        //return $days;
      	return $daysNUM;
    }
  

}