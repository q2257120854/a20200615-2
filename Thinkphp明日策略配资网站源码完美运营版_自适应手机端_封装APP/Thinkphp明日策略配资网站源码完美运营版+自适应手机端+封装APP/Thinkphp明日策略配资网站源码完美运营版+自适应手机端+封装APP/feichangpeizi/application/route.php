<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
//前台路由定义
    'buy' => 'index/index/buy',				  	//A股购买
    'buy_entrust' => 'index/index/buy_entrust',	//购买委托
    'freetrial'=> 'index/index/freetrial',	    //1元模拟
    'freetrial1'=> 'index/index/freetrial1',
    'sell'=> 'index/ucenter/sell',       			//点卖区
    'history'=> 'index/ucenter/history',       	//结算区

    'freetrialSell'=> 'index/ucenter/freetrialSell',       			//点卖区 一元模拟
    'freetrialHistory'=> 'index/ucenter/freetrialHistory',       	//结算区 一元模拟
    'test001' => 'index/index/test001',	

    'detail'=> 'index/ucenter/detail',       		//结算区-单号详情
    'mobile'=> 'index/index/mobile',       		//手机版
    'gift'=> 'index/index/gift',       			//感恩回馈
    'help'=> 'index/index/help',       			//帮助中心-常见问题
    'guild'=> 'index/index/guild',       		//帮助中心-新手教学
    'reg'=> 'index/index/reg',       			//注册
    'login'=> 'index/index/login',       		//登录
    'reg_agree'=> 'index/index/reg_agree',      //服务协议
    'company'=> 'index/index/company',       	//关于我们
    'contact'=> 'index/index/contact',       	//联系我们
    'protocol_1'=> 'index/index/protocol_1',	    //协议1
    'protocol_2'=> 'index/index/protocol_2',	    //协议2
    'protocol_3'=> 'index/index/protocol_3',	    //协议3
    'download'=> 'index/index/download',	    //下载
   
    
    'forgot_pass'=> 'index/index/forgot_pass',  //忘记密码-01账户名
    'mobile_val'=> 'index/index/mobile_val',   	//忘记密码-02密码重置
    'pass_reset'=> 'index/index/pass_reset',   	//忘记密码-03密码找回
    'reset_result'=> 'index/index/reset_result',//忘记密码-04完成
    
    'ucenter/index'=> 'index/ucenter/member',   			//个人中心-首页
    'ucenter/payment'=> 'index/ucenter/payment',   			//个人中心-充值
    'ucenter/withdraw'=> 'index/ucenter/withdraw',   		//个人中心-充值
    'ucenter/bankcards'=> 'index/ucenter/bankcards',   		//个人中心-银行卡管理
    'ucenter/security'=> 'index/ucenter/security',   		//个人中心-账户安全
    'ucenter/agent'=> 'index/ucenter/agent',   				//个人中心-推广赚钱
//  手机
	'ucenter/home'=> 'index/ucenter/home',  				//个人中心-首页
    'ucenter/alipay'=> 'index/ucenter/alipay',   			//个人中心-充值-支付宝
    'ucenter/re_tip'=> 'index/ucenter/re_tip',   			//个人中心-充值-支付宝-2
    'ucenter/wechatpay'=> 'index/ucenter/wechatpay',   		//个人中心-充值-微信
    'ucenter/quick_pay'=> 'index/ucenter/quick_pay',   		//个人中心-充值-银联支付
    'ucenter/user_info'=> 'index/ucenter/user_info',   		//个人中心-实名认证
    'ucenter/real_name'=> 'index/ucenter/real_name',   		//个人中心-实名认证2
    'ucenter/add_bankcard'=> 'index/ucenter/add_bankcard',  //个人中心-添加银行卡
    
    
    
    
       
    
];
