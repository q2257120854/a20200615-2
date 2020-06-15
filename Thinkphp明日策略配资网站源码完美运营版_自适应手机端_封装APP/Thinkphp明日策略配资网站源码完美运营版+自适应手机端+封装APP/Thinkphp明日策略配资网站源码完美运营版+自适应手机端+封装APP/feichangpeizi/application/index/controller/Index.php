<?php
// +----------------------------------------------------------------------
// | 海豚PHP框架 [ DolphinPHP ]
// +----------------------------------------------------------------------
// | 版权所有 2016~2017 河源市卓锐科技有限公司 [ http://www.zrthink.com ]
// +----------------------------------------------------------------------
// | 官方网站: http://dolphinphp.com
// +----------------------------------------------------------------------
// | 开源协议 ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------

namespace app\index\controller;
use think\Model;
use think\Db;
use app\index\controller\Alistock;

use app\user\model\User;
class Index extends Home
{
    public function index()
    {
	
		$sql = "select a.stockCode, c.`name` as stockName,  a.createTime, b.username,b.mobile
			from xh_stock_order as a, xh_member as b, xh_shares as c
			 WHERE isFreetrial=0 and a.memberId = b.id and a.stockCode=c.`code`
			order by a.id desc limit 7 ";
		$buyList = Db::query($sql);
		foreach($buyList as $k=>$v){
			$tmStr = "一年以前";
			$tm = time() - strtotime($v['createTime']) ;//秒数
			if($tm < 60){
				$tmStr = "{$tm}秒前";
			}else if ($tm < 3600){
				$tmStr = ((int)($tm/60))."分钟前";
			} else if ($tm < 3600 * 24){
				$tmStr = ((int)($tm/3600))."小时前";
			}else {
				$tmStr = ((int)($tm/(3600*24)))."天前";
			}
			$buyList[$k]['time'] = $tmStr;

			//用户名加**
			$mobile = $v['mobile'];
			$mobile = substr($mobile, 0, 3)."****".substr($mobile, strlen($mobile) - 4, 4);
			$buyList[$k]['mobile']=$mobile;
		}

		//累计
		$count = Db::table("xh_stock_order")->where("isFreetrial=0")->count();
		//累计盈利
		$earnSum = Db::table("xh_stock_order")->where("isFreetrial=0 and status=2 and sellPrice - dealPrice > 0")
			->sum("(sellPrice - dealPrice) * dealQuantity * 100");
		$this->assign('count', $count);
		$this->assign('earnSum', $earnSum);

		$this->assign("buyList", $buyList);


		if(is_mobile_request()) {
			//获取 上证指数 深证成指 创业板指
			$res_str = (new Alistock())->stockIndex();
			$res = json_decode($res_str);
			if($res->showapi_res_code == '0' && $res->showapi_res_body->ret_code == '0'){
				$indexList = $res->showapi_res_body->indexList;
				$this->assign("dp", $indexList);
			}
			return view('index/mobile/index');
		}
        return view( 'index');
    }
    //A股点买
    public function buy()
    {
		$member = $_SESSION['member'];
		if(isset($member)){
			$curDate = date("Y-m-d");
			$count = Db::table("xh_stock_order")->where("memberId={$member['id']} and isFreetrial=0 and left(createTime,10)='$curDate'" )->count();
			$this->assign('left', 10 - (int)$count);
		}
		$this->assign('dealPoundage', getSysParamsByKey("dealPoundage") ); //交易手续费(买入股票时，每万元收9元)
		$this->assign('delayFee', getSysParamsByKey("delayFee") ); //递延费，默认18元每天
		$this->assign('dealFee', getSysParamsByKey("dealFee") ); //第一天的交易费
		$this->assign('delayLineRate', getSysParamsByKey("delayLineRate") ); //递延条件是保证金的0.75倍
		$this->assign('stopLossRate', getSysParamsByKey("stopLossRate") ); //触发止损是保证金的0.8倍（当亏损额大于触发止损时，马上强制平仓）
		
		if(is_mobile_request()){
			return view('index/mobile/buy');
		}
        return view( 'buy');
    }
	
	//买入委托
	public function buy_entrust()
    {
        return view( 'index/mobile/buy_entrust');
    }
    
	//1元模拟
	public function freetrial()
	{
		if(is_mobile_request()){
			return view('index/mobile/freetrial');
		}
		return view('freetrial');
	}
	
	//协议-1
	public function protocol_1()
	{
		return view('protocol_1');
	}
	//协议2
	public function protocol_2()
	{
		return view('protocol_2');
	}
	//协议-3
	public function protocol_3()
	{
		return view('protocol_3');
	}
	

	public function freetrial1()
	{
		return view('freetrial1');
	}

	//手机版
	public function mobile()
	{
		return view('mobile');
	}
	//帮助中心-常见问题
	public function help()
	{
		return view('help');
	}
	//帮助中心-新手教学
	public function guild()
	{
		if(is_mobile_request()){
			return view('index/mobile/guild_moile');
		}
		return view('guild');
	}
	//感恩回馈
	public function gift()
	{
		$article = Db::table("xh_article")->where("id = 3")->find();
		$this->assign("d", $article);
		return view('index/mobile/gift');
	}
	//下载
	public function download()
	{
		return view('index/mobile/download');
	}
	
	//注册
	public function reg()
    {
		if(is_mobile_request()){
			return view('index/mobile/reg');
		}
        return view( 'reg');
    }
	//登录
	public function login()
    {
		if(is_mobile_request()){
			return view('index/mobile/login');
		}
        return view( 'login');
    }
	public function logout(){
		unset($_SESSION['member'] );
		$this->redirect("/");
	}

	public function doLogin(){
		$nick_name = trim($_POST['nick_name']);
		$login_pwd = trim($_POST['login_pwd']);
		if(!isset($nick_name) || $nick_name == '' || !isset($login_pwd) || $login_pwd == ''){
			error("参数填写不正确");
		}
		$login_pwd = md5($login_pwd);
		$member = Db::table("xh_member")->where("username='$nick_name' or mobile = '$nick_name'")->find();
		if(!$member || $member['password'] != $login_pwd){
			error("用户名或密码不正确");
		}
		$_SESSION['member'] = $member;

		$redirect_url = $_SESSION['redirect_url'];
		if(!isset($redirect_url) || $redirect_url == ''){
			$redirect_url = "/";
		}
		$data=array();
		$data['redirect_url'] = $redirect_url;
		$data['usableSum'] = $member['usableSum'];
		$data['username'] = $member['username'];

		unset($member['password']);
		unset($member['usableSum']);

		success($data);
	}

	public function doReg()
	{
		$nick_name = trim($_POST['nick_name']);
		$login_pwd = trim($_POST['login_pwd']);
		$mobile = trim($_POST['mobile']);
		$code = trim($_POST['code']);
		$recommendCode = trim($_POST['recommendCode']);
		if( !isset($nick_name) || !isset($login_pwd) || !isset($mobile) || !isset($code) || !isset($recommendCode) ) {
			error("参数填写不正确");
		}
		if(strlen($nick_name) < 6){
			error("用户名应不少于6个字符");
		}
		if($mobile != $_SESSION['mobile'] || $code != $_SESSION['mobileCode']){
			error("验证码不正确");
		}
		if( Db::table("xh_member")->where("username", $nick_name)->find() ) {
			error("用户名已存在");
		}
		if( Db::table("xh_member")->where("mobile", $mobile)->find() ) {
			error("手机号已存在");
		}
		if( !Db::table("xh_admin_user")->where("id", $recommendCode)->find() ) {
			error("机构推荐码不存在，请核对后再试");
		}
		$data = array();
		$data['username'] = $nick_name;
		$data['mobile'] = $mobile;
		$data['password'] = md5($login_pwd);
		$data['recommendCode'] = $recommendCode;
      	$member = Db::table("xh_member")->where("id='$recommendCode' ")->find();
		if(!$member){
			$data['recommendUserName'] = $member['username'];
			$data['recommendMobile'] = $member['mobile'];
		}
		$adminuser = Db::table("xh_admin_user")->where("id='$recommendCode' ")->find();
		if(!$adminuser){
			$data['recommendUserName'] = $adminuser['username'];
			$data['recommendMobile'] = $adminuser['mobile'];
		}
		$data['createTime'] = date("Y-m-d H:i:s");
		$id = Db::table("xh_member")->insertGetId($data);
		if($id > 0){
			success("注册成功");
		}

		error("注册失败");
	}

	//判断是否已登录
	public function isLogin(){
		$ret = 0;
		if(isset($_SESSION['member'] )){
			$ret = 1;
		}
		echo $ret;
	}


	//服务协议
	public function reg_agree()
	{
		return view('reg_agree');
	}
	//关于我们
	public function company()
	{
		return view('company');
	}
	//联系我们
	public function contact()
	{
		return view('contact');
	}
	//忘记密码-01账户名
	 public function forgot_pass()
    {
		if(is_mobile_request()){
			return view('index/mobile/forgot_pass');
		}
        return view( 'forgot_pass');
    }
	//忘记密码-02密码重置
	public function mobile_val()
	{
		return view('mobile_val');
	}
	//忘记密码-03密码找回
	public function pass_reset()
	{
		if($_SESSION['verifyForgotPass'] != 1){
			die("请先验证手机号");
		}
		return view('pass_reset');
	}

	//忘记密码- 更新密码
	public function updateNewPwd(){
		$mobile = $_SESSION['mobileForForgot'];
		$login_newPwd = trim(input("login_newPwd"));
		if(!$login_newPwd || $login_newPwd == ''){
			error("密码不能为空");
		}
		if($_SESSION['verifyForgotPass'] != 1){
			die("请先验证手机号");
		}
		if(!$mobile || strlen($mobile) != 11){
			error("手机号码不正确，请重新验证");
		}

		$login_newPwd = md5($login_newPwd);
		Db::table("xh_member")->where("mobile='{$mobile}'")->update(array('password'=>$login_newPwd));

		unset($_SESSION['mobileForForgot']);
		unset($_SESSION['verifyForgotPass']);

		success("更新成功");
	}

	//忘记密码-04完成
	public function reset_result()
	{
		return view('reset_result');
	}

	//检查图片验证码是否正确
	public function checkImageCode($code){

		$data = array('captcha' => $code); new \think\captcha\Captcha();
		$res = $this->validate($data,[
			'captcha|验证码'=>'require|captcha'
		]);
		//返回true，或者错误信息

		return $res;
	}



	public function cPost($curlPost,$url){
	        $curl = curl_init();
	        curl_setopt($curl, CURLOPT_URL, $url);
	        curl_setopt($curl, CURLOPT_HEADER, true);
	        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($curl, CURLOPT_NOBODY, true);
	        curl_setopt($curl, CURLOPT_POST, true);
	        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
	        $return_str = curl_exec($curl);
	        curl_close($curl);
	        return $return_str;
	}
	
	
	public function xml_to_array($xml){
	    $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
	    if(preg_match_all($reg, $xml, $matches)){
	        $count = count($matches[0]);
	        for($i = 0; $i < $count; $i++){
	        $subxml= $matches[2][$i];
	        $key = $matches[1][$i];
	            if(preg_match( $reg, $subxml )){
	                $arr[$key] = $this->xml_to_array( $subxml );
	            }else{
	                $arr[$key] = $subxml;
	            }
	        }
	    }
	    return $arr;
	}





	public function sendMobileCode(){
		
		//判断图片验证码
		$imgCode = trim(input("imgCode"));
		$img_msg = $this->checkImageCode($imgCode);
		if($img_msg !== true){
			error($img_msg);
		}
		//接受验证码的手机号码
		$mobile = trim(input("mobile"));
		if(strlen($mobile) != 11 || substr($mobile, 0, 1) != '1') {
			error("手机号码不正确");
		}  
       
		//特服号 54125
		//http://web.cr6868.com/asmx/smsservice.aspx?name=18256956513&pwd=BB24FF4EECB2992B36E56AE15B3A&mobile=18609658355&content=%E3%80%90%E5%8A%9F%E5%BE%B7%E8%9E%8D%E3%80%91%E5%B0%8A%E6%95%AC%E7%9A%84%E5%B9%B3%E5%8F%B0%E7%94%A8%E6%88%B7%2C%E6%82%A8%E6%AD%A4%E6%AC%A1%E7%9A%84%E7%9F%AD%E4%BF%A1%E9%9A%8F%E6%9C%BA%E9%AA%8C%E8%AF%81%E7%A0%81%E4%B8%BA%EF%BC%9A665201%2C%E8%AF%B7%E6%B3%A8%E6%84%8F%E6%9F%A5%E6%94%B6%E4%BF%9D%E7%AE%A1%EF%BC%8C%E7%9F%AD%E4%BF%A1%E9%AA%8C%E8%AF%81%E7%A0%81%E6%9C%89%E6%95%88%E6%97%B6%E9%97%B4%E4%B8%BA3%E5%88%86%E9%92%9F%EF%BC%8C%E8%AF%B7%E5%9C%A8%E6%9C%89%E6%95%88%E6%9C%9F%E5%86%85%E5%8A%9E%E7%90%86%E3%80%82%E6%84%9F%E8%B0%A2%E6%82%A8%E7%9A%84%E6%94%AF%E6%8C%81%EF%BC%81%E5%A6%82%E9%9D%9E%E6%9C%AC%E4%BA%BA%E6%93%8D%E4%BD%9C%EF%BC%8C%E8%AF%B7%E5%BF%BD%E7%95%A5%E6%AD%A4%E6%9D%A1%E7%9F%AD%E4%BF%A1&stime=&type=pt&extno=
		$mobileCode = rand(100000, 999999);
		$content_test = "尊敬的用户，您本次验证码为{$mobileCode}，9分钟内可用【金龙策略】";
		//$content = urlencode($content);

		$target = "http://39.105.89.201:8868/sms.aspx";
        $post_data="action=send&userid=1087&account=aa123&password=aa123456&mobile=".$mobile."&content=".$content_test."&sendTime=&extno=";
        $gets = $this->cPost($post_data, $target);//向手机发送一份
        
        /*
        file_put_contents( dirname( __FILE__ ).'/log888.txt',$gets, FILE_APPEND );		
		$res = $this->xml_to_array($gets);
		file_put_contents( dirname( __FILE__ ).'/log888.txt', "++++++++++++++++++++++++++++++++++++++++++\n", FILE_APPEND );
		file_put_contents( dirname( __FILE__ ).'/log888.txt', var_export($res,true), FILE_APPEND );
		*/
		
		
		if(strpos($gets,'<message>ok</message>')!==false){

				$_SESSION['mobileCode'] = $mobileCode;
				$_SESSION['mobile'] = $mobile;
				success("发送成功,$mobileCode");

		}else{
			error("短信发送失败");
		}

    }

	//忘记密码 输入手机号和验证码之后  验证
	//更改手机号码 验证手机验证码是否正确
	public function checkForgotMobileCode(){
		$mobile = trim(input('mobile'));
		$code = trim(input('code'));

		if(strlen($mobile) != 11 || substr($mobile, 0, 1) != '1' || $code==''){
			error("参数不正确");
		}

		if($_SESSION['mobileCode'] != $code || $_SESSION['mobile'] != $mobile){
			error("验证码不正确");
		}

		if(!Db::table("xh_member")->where("mobile='{$mobile}'")->find()){
			error("手机号码不存在");
		}

		unset($_SESSION['mobile']);
		unset($_SESSION['mobileCode']);

		//标记原手机号验证成功
		$_SESSION['verifyForgotPass'] = 1;
		$_SESSION['mobileForForgot'] = $mobile;

		success("验证成功");

	}

	//上传图片
	public function doImgUpload(){
		$serverPath = "/public/uploads/".date("Y/m/d")."/";
		$filepath = dirname(__FILE__).'/../../..'.$serverPath;
		if(!is_dir($filepath)){
			if(!mkdir($filepath, 0777, true) ){
				error("目录创建失败");
			}
		}

		foreach($_FILES as $key=>$val){
			$imgname =   $val['name'] ;
			$imgname = preg_replace('/([\x80-\xff]*)/i','',$imgname); //去掉中文
			$tmp = $val['tmp_name'];
			$filename = get_total_millisecond().rand(1000,9999).$imgname;
			if(move_uploaded_file($tmp, $filepath.$filename )) {
				$serverImgPath = $serverPath.$filename;
				success($serverImgPath);
			}else{
				error( "上传失败" );
			}
		}

		error( "未选择要上传的图片" );
	}

	public function test() {
		echo "This is a test!";
		$this->fetch();
	}

    public function test001(){
	  	   
	    #$lin = (new User())->setPasswordAttr('admin');
		#$this->assign('lin', $lin);
		#return view('test001');
		
		$sql="call mypro2(1500,'603586',28.66)";
        $res = Db::query($sql);
        
        echo count($res);	
		
	
		
	}
	
	
	  public function test002(){
	  	   
	   $way= new Alistock();
	   $info = $way->getStockInfoData('600038');
	   var_dump($info);
	   die;
	   
		
	
		
	}
	
	
	
}
