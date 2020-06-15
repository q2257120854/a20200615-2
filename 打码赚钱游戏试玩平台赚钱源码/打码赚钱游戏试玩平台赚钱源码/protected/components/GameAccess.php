<?php
/**
 * open.55e5.com 游戏接入 SDK v1.0
 * @date 2015.1.24
 * @author woody 技术QQ: 405387525
 */
 
//承接商ID
define('CID', '514');

//承接商client_key
define('KEY', ' b5258934d34ec2917feb7d34b17cec6d');

//接口地址
define('API_HOST', 'http://open.55e5.com/open_api');

//编码， 可选  GBK,UTF-8
define('CHARSET', 'UTF-8');

//调试开关
define('DEBUG', 0);

class GameAccess {
    
	//接口地址
	public $api_host = API_HOST;
	
	//承接商ID
	private $cid = CID;
		
	//密钥
	private $key = KEY;
	
	//超时时间
	public $timeout = 10;
	
	//编码
	private $charset = CHARSET;
	
	/**
	 * Set the useragnet.
	 */
	public $useragent = '55e5 SDK v1.0';
	
	/**
	 * 是否调试
	 */
	public $debug = DEBUG;
	
	public function __construct(){
		if(!$this->cid || !$this->key){
		    $this->_exception('接口参数不完整!!');
		}
		$this->charset = strtoupper($this->charset);
	}
	
	/**
	 * 取游戏列表
	 */
	public function getGameList(){
	    $sign = md5($this->cid.$this->key);
		$ret_data = $this->get('get_game_list', array('sign'=>$sign));
		$game_list = $ret_data['game_list'];
		return $game_list;
	}
	
	/**
	 * 获取注册链接
	 * @param string	$uid	承接商用户ID
	 * @param array 	$attch	承接商附加参数，在注册成功回调时会一起返回
	 */
    public function getRegUrl($uid, $gid, $attch=array()){
        $gid = intval($gid);
        $api_url = $this->api_host . '/goto_game/';
    	if(!$uid || !$gid){
	        $this->_exception('uid 与 gid 不能为空!');
	    }
	    
	    $attch_param = count($attch) > 0 ? urlencode(http_build_query($attch)) : '';
	    
	    $param = array(
	        'cid' => $this->cid,
	        'uid' => $uid,
	        'gid' => $gid,
	        'attch' => $attch_param
	    );
	    
        $api_url .= http_build_query($param);
        return $api_url;
    }
    
    
	/**
	 * 查询玩家的游戏等级
	 * @param string	$uid	承接商用户ID
	 * @param string	$gid	承接商附加参数，在注册成功回调时会一起返回
	 */
	public function getUserGameInfo($uid, $gid){
	    $gid = intval($gid);
	    if(!$uid || !$gid){
	        $this->_exception('uid 与 gid 不能为空!');
	    }
	    
	    $param = array();
	    $param['uid'] = $uid;
	    $param['gid'] = $gid;
	    $param['sign'] = md5($this->cid . $gid . $uid . $this->key);
	    
		$ret_data = $this->get('user_game_info', $param);
		$user_game_info = $ret_data['user_info'];
		return $user_game_info;
	}
	
	/**
	 * 发起请求，内部调用
	 * @param url
	 * @param $params
	 */
	private function get($url, $params=array()){
		if(!isset($params['cid'])){ //补全 cid 参数
			$params['cid'] = $this->cid;
		}
		$result = $this->request('/'.$url, $params);
		$error_msg = '';
		if($result != ''){
			$result = json_decode($result, TRUE);
			$error_msg = $result['error_msg'];
			if($this->charset != 'UTF-8'){
			    $result = $this->convertArrayCharset($result, $this->charset);
			}
			if($result['error_code'] == 0){
			    return $result;
			}
		}
		//如果返回空串或返回值有误
		$this->_exception('接口请求失败 ! 失败原因：'.$error_msg);
	} 
	
	/**
	 * 请求核心函数
	 * @param string $url
	 * @param array $params
	 * @param array $headers
	 */
	private function request($url, $params = NULL, $headers = array()) {
		if(strpos($url, 'http://')===FALSE){
			$url = $this->api_host.$url;
		}	
			
		if(! function_exists('curl_init')){
		    $this->_exception('请开启 php_curl 模块！');
		}
		
		if($params){
			$url .= '?'.http_build_query($params);
		}
		
		$ci = curl_init();
		curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($ci, CURLOPT_USERAGENT, $this->useragent);
		curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, $this->timeout);
		curl_setopt($ci, CURLOPT_TIMEOUT, $this->timeout);
		curl_setopt($ci, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ci, CURLOPT_HEADER, 0);
		curl_setopt($ci, CURLOPT_URL, $url );
		curl_setopt($ci, CURLOPT_HTTPHEADER, $headers );
		curl_setopt($ci, CURLINFO_HEADER_OUT, TRUE );
		
		$response = curl_exec($ci);

		if ($this->debug) {
			echo '<br>===== REQUEST =====<br><pre>';
			print_r( curl_getinfo($ci) );
			echo '</pre><br>===== RESPONSE =====<br><pre>';
			print_r( $response );
			echo '</pre>';
		}
		
		//检查 http code
		$code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
		curl_close ($ci);

		if($code != 200){
			$this->_exception('接口请求失败，服务器响应有误！HTTP_CODE:', $code);
		}		
		return $response;
	}
	
    //转换数组编码
    private function convertArrayCharset( $arr , $to_charset, $from_charset='utf-8'){
    	if( is_array($arr) ){
    		foreach( $arr as $i => $v ){
    			$arr[$i] = $this->convertArrayCharset( $v, $to_charset, $from_charset);
    		}
    	}else{
    		$arr = mb_convert_encoding( $arr, $to_charset, $from_charset);
    	}
    	return $arr;
    }
    
    //返回异常消息
    private function _exception($error_msg){
        if($this->charset != 'UTF-8'){
            $error_msg = mb_convert_encoding( $error_msg, $this->charset, 'utf-8');   
        }
        echo $error_msg;
        exit;
    }
    
}


/*
// ****************************** 示例代码  *****************************
 
//测试用户UID
$test_uid = '25082';

//测试游戏ID
$test_gid = 230;

//附加参数
$attch = array(
    'myparam1' => 'abc',
    'myparam1' => 123
);
        
try {
    $ga = new GameAccess();
    //取游戏列表
    //$game_list = $ga->getGameList();
    
    //取玩家注册链接
    //$reg_url = $ga->getRegUrl($test_uid, $test_gid);
    
    //查询等级
    //$user_game_info = $ga->getUserGameInfo($test_uid, $test_gid);
    //print_r($game_list);
    //print_r($user_game_info);
} catch (Exception $ex){
    echo $ex->getMessage();
}


*/
