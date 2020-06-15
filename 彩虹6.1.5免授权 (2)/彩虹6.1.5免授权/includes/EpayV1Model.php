<?php

class EpayV1Model
{
    private $gateway;
    //请求网关
    private $pid;
    //商户号
    private $key;

    //商户密匙

    /**
     * EpayV1Model constructor.
     * @param string $gateway
     * @param string $pid
     * @param string $key
     */
    public function __construct($gateway, $pid, $key)
    {
        $this->gateway = $gateway;
        $this->pid     = $pid;
        $this->key     = $key;
    }

    /**
     * 获取用户信息
     * @return array
     */
    public function getUserInfo()
    {
        $requestUrl = $this->gateway . 'api.php?act=query&pid=' . $this->pid . '&key=' . $this->key;
        $result     = $this->curl($requestUrl);

        if ($result[0] === false)
            return [false, '[Curl]网络请求异常，请检查网络与接口服务器连通情况。' . $result[1]];

        return [true, $this->jsonDecode($result[1], true)];
    }

    /**
     * 查询结算记录
     * @return array
     */
    public function getSettleList()
    {
        $requestUrl = $this->gateway . 'api.php?act=settle&pid=' . $this->pid . '&key=' . $this->key;
        $result     = $this->curl($requestUrl);

        if ($result[0] === false)
            return [false, '[Curl]网络请求异常，请检查网络与接口服务器连通情况。' . $result[1]];

        return [true, $this->jsonDecode($result[1], true)];
    }

    /**
     * 修改结算账号信息
     * @param string $account
     * @param string $username
     * @return array
     */
    public function editSettleInfo($account, $username)
    {
        if (empty($account) || empty($username))
            return [false, '修改失败，结算账户或结算名称不能为空'];

        $requestUrl = $this->gateway . 'api.php?act=change&pid=' . $this->pid . '&key=' . $this->key . '&account=' . $account . '&username=' . $username;
        $result     = $this->curl($requestUrl);

        if ($result[0] === false)
            return [false, '[Curl]网络请求异常，请检查网络与接口服务器连通情况。' . $result[1]];

        return [true, $this->jsonDecode($result[1], true)];
    }

    /**
     * 获取订单信息
     * @param string $tradeNo
     * @param string $type //tradeNo 支付平台单号，OutTradeNo 自有单号
     * @return array
     */
    public function getOrderInfo($tradeNo, $type = 'tradeNo')
    {
        $requestData = [
            'act' => 'order',
            'pid' => $this->pid,
            'key' => $this->key
        ];
        if ($type == 'tradeNo')
            $requestData['trade_no'] = $tradeNo;
        else
            $requestData['out_trade_no'] = $tradeNo;

        $requestUrl = $this->gateway . 'api.php';
        $result     = $this->curl($requestUrl, [], 'get', $requestData);

        if ($result[0] === false)
            return [false, '[Curl]网络请求异常，请检查网络与接口服务器连通情况。' . $result[1], -1];
        $decodeData = $this->jsonDecode($result[1], true);
        if ($decodeData === null)
            return [false, '分析数据失败 -> ' . htmlspecialchars($result[1])];
        return [true, $decodeData];
    }

    /**
     * 获取商品列表
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function getOrderList($page = 1, $limit = 20)
    {
        $requestData = [
            'act' => 'orders',
            'pid' => $this->pid,
            'key' => $this->key
        ];
        if (!empty($page))
            $requestData['page'] = $page;
        if (!empty($limit))
            $requestData['limit'] = $limit;

        $requestUrl = $this->gateway . 'api.php';
        $result     = $this->curl($requestUrl, [], 'get', $requestData);

        if ($result[0] === false)
            return [false, '[Curl]网络请求异常，请检查网络与接口服务器连通情况。' . $result[1]];

        return [true, $this->jsonDecode($result[1], true)];
    }

    /**
     * 构建拉起支付html
     * @param string $tradeNo
     * @param string $payType
     * @param string $productName
     * @param string $money
     * @param string $notifyUrl
     * @param string $returnUrl
     * @param string $siteName
     * @return string
     */
    public function getPayRequestHtml($tradeNo, $payType, $productName, $money, $notifyUrl, $returnUrl, $siteName = '')
    {
        $requestData = [
            'pid'          => $this->pid,
            'type'         => $payType,
            'out_trade_no' => $tradeNo,
            'notify_url'   => $notifyUrl,
            'return_url'   => $returnUrl,
            'name'         => $productName,
            'money'        => $money,
            'sign_type'    => 'MD5'
        ];
        if (!empty((string)$siteName))
            $requestData['sitename'] = $siteName;

        $requestData['sign'] = $this->signParam($requestData);

        $formHtml = $this->buildRequestForm($this->gateway . '/submit.php', $requestData, 'post', '正在拉起支付。。。');
        return $formHtml;
    }

    /**
     * 构建表单请求
     * @param string $requestUrl
     * @param array $param
     * @param string $requestType
     * @param string $tips
     * @return string
     */
    public function buildRequestForm($requestUrl, $param, $requestType, $tips)
    {
        $sign = $this->signParam($param);

        $param['sign']      = $sign;
        $param['sign_type'] = 'MD5';
        $html               = '<form id="epaysubmit" name="epaysubmit"  accept-charset=\'utf-8\' action="' . (string)$requestUrl . '" method="' . (string)$requestType . '">';
        foreach ($param as $key => $value) {
            $html .= '<input type="hidden" name="' . $key . '" value="' . $value . '"/>';
        }
        $html .= '<input type="submit" value="' . $tips . '"/></form>';
        $html .= '<script>document.forms["epaysubmit"].submit();</script>';

        return $html;
    }

    /**
     * 签名参数
     * @param array $param
     * @return string
     */
    public function signParam($param)
    {
        $param = $this->paraFilter($param);
        //param filter
        $param = $this->argSort($param);
        //param sort
        $sign = md5($this->createLinkString($param) . $this->key);

        return $sign;
    }

    /**
     * @param $para
     * @param bool $isUrlDecode
     * @return array
     */
    private function paraFilter($para, $isUrlDecode = false)
    {
        $para_filter = array();
        foreach ($para as $key => $val) {
            if ($key == 'sign' || $key == 'sign_type' || empty($val))
                continue;
            else
                if ($isUrlDecode)
                    $para_filter[$key] = urldecode($val);
                else
                    $para_filter[$key] = $val;
        }
        return $para_filter;
    }

    /**
     * @param $para
     * @return mixed
     */
    private function argSort($para)
    {
        ksort($para);
        reset($para);
        return $para;
    }

    private function createLinkString($para)
    {
        $arg = '';
        foreach ($para as $key => $val) {
            $arg .= $key . '=' . $val . '&';
        }
        //去掉最后一个&字符
        $arg = substr($arg, 0, strlen($arg) - 1);

        //如果存在转义字符，那么去掉转义
        if (get_magic_quotes_gpc()) {
            $arg = stripslashes($arg);
        }

        return $arg;
    }

    /**
     * 封装json解析函数 避免奇葩东西
     * @param $json
     * @param bool $assoc
     * @return mixed
     */
    private function jsonDecode($json, $assoc = false)
    {
        $json = trim($json, "\xEF\xBB\xBF");
        return json_decode($json, $assoc);
    }


    /**
     * curlV4 请求函数封装
     * @param string $url 请求地址
     * @param array $addHeaders 附加请求头
     * @param string $requestType 请求类型
     * @param string|array $requestData 请求数据
     * @param string $postType post类型
     * @param bool $urlEncode 是否url编码
     * @param array $proxyConfig 代理配置
     * @return array 返回信息
     */
    private function curl($url = '', $addHeaders = [], $requestType = 'get', $requestData = '', $postType = '', $urlEncode = true, $proxyConfig = [])
    {
        if (empty($url))
            return [false, '请求地址不能为空'];
        //容错处理
        $headers = [];

        $postType = strtolower($postType);
        if ($requestType == 'get' && is_array($requestData)) {
            $tempBuff = '';
            foreach ($requestData as $key => $value) {
                if ($urlEncode)
                    $tempBuff .= urlencode($key) . '=' . urlencode($value) . '&';
                else
                    $tempBuff .= $key . '=' . $value . '&';
            }
            $tempBuff = trim($tempBuff, '&');
            $url      .= '?' . $tempBuff;
        }
        //手动build get请求参数
        if (!empty($addHeaders))
            $headers = array_merge($headers, $addHeaders);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($ch, CURLOPT_TIMEOUT, 2);

        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        //设置允许302转跳

        if (!empty($proxyConfig)) {
            curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_PROXY, $proxyConfig[0]);
            //代理服务器地址
            curl_setopt($ch, CURLOPT_PROXYPORT, $proxyConfig[1]);
            //代理服务器端口
            //set proxy
        }

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
        //gzip
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        if ($requestType == 'get') {
            curl_setopt($ch, CURLOPT_HEADER, false);
        } else if ($requestType == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);
        } else {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($requestType));
        }
        //处理类型
        if ($requestType != 'get') {
            if ($postType == 'json') {
                $headers[]   = 'Content-Type: application/json; charset=utf-8';
                $requestData = is_array($requestData) ? json_encode($requestData) : $requestData;
            } else if ($postType != 'form-data') {
                if (is_array($requestData) && !empty($requestData)) {
                    $temp = '';
                    foreach ($requestData as $key => $value) {
                        if ($urlEncode) {
                            $temp .= urlencode($key) . '=' . urlencode($value) . '&';
                        } else {
                            $temp .= $key . '=' . $value . '&';
                        }
                    }
                    $requestData = substr($temp, 0, strlen($temp) - 1);
                }
                if ($urlEncode)
                    $headers[] = 'Content-Type:application/x-www-form-urlencoded; charset=utf-8';
                $headers[] = 'Content-Length: ' . strlen($requestData);
            }
            curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);
        }
        //只要不是get姿势都塞东西给他post
        $errorMsg = '';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if ($result === false)
            $errorMsg = curl_error($ch);
        curl_close($ch);
        if ($result === false)
            return [false, $errorMsg];
        return [true, $result];
    }
}
