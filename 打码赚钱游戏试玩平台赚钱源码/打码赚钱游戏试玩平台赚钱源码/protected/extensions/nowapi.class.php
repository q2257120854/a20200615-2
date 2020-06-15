<?php
/*
 * nowapi php语言sdk主类
 * 2014/11/12 Last Review by jason
 * --------------------------------------------------------------------------------------
 * 官网: http://www.k780.com
 * 文档: http://www.k780.com/api
 * 技术/反馈/讨论/支持: http://www.k780.com/intro/about.html
 * --------------------------------------------------------------------------------------
 * 使用方法:
 * 修改配置部分,相关值获取请登录官网 http://www.k780.com 用户中心查看，建议注册私有appkey。
 * --------------------------------------------------------------------------------------
 * 错误处理:
 * 当nowapi::callapi返回值为 false 时，可调用 nowapi::error() 查看。
 * --------------------------------------------------------------------------------------
 */

class nowapi{
    //Config 配置部分
    const API_URL='http://api.k780.com:88';
    const API_APPKEY='13915';
    const API_SECRET='eaec4e871ea1e740f7f2d7514af2aeaf';

	
	
    //错误容器
    private static $nowapi_error='';

    /*
     * API请求主函数
     * @param $reqno varchar 接口 如:phone.get
     * @param $parm array 请求参数 如:phone=13800138000
     * @param $format varchar 定义返回数据类型,支持二种 json/base64
     * @param $timeout number 超时时间
     * @return 错误:false 成功:结果集数组
     */
    public static function callapi($reqno,$param='',$format='json',$timeout=20){
        if(empty($reqno)){
            self::$nowapi_error='Parameter reqno nust be present';
            return false;
        }
        //组合数组
        $a_post['appkey']=self::API_APPKEY;
        $a_post['sign']=md5(md5(self::API_APPKEY).self::API_SECRET);
        $a_post['format']=$format;
        if(is_array($param)){
            $a_post=array_merge($a_post,$param);
        }
        //CURL
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,self::API_URL."/?app=".$reqno);
        curl_setopt($curl,CURLOPT_POST,1);
        curl_setopt($curl,CURLOPT_POSTFIELDS,$a_post);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl,CURLOPT_HEADER,0);
        curl_setopt($curl,CURLOPT_TIMEOUT,$timeout);
        if(!$result=curl_exec($curl)){
            self::$nowapi_error=curl_error($curl);
            curl_close($curl);
            return false;
        }
        curl_close($curl);
        //结果集处理
        if($format=='base64'){
            $a_api=unserialize(base64_decode($result));
        }else{
            if(!$a_api=json_decode($result,true)){
                self::$nowapi_error='remote api not json decode';
                return false;
            }
        }
        if($a_api['success']!='1'){
            self::$nowapi_error=$a_api['msg'];
            return false;
        }
        return $a_api['result'];
    }

    /*捕捉错误*/
    public static function error(){
        if(empty(self::$nowapi_error)){
            return true;
        }
        return self::$nowapi_error;
    }
}
?>
