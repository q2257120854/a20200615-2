<?php
/**
 * Created by PhpStorm.
 * User: wo
 * Date: 2017/7/12
 * Time: 15:20
 */

namespace app\admin\controller;

use app\admin\controller\Admin;
use app\user\model\Role as RoleModel;
use app\common\builder\ZBuilder;
use app\admin\model\Module as ModuleModel;
use app\admin\model\Menu as MenuModel;
use app\admin\model\Access as AccessModel;
use app\user\model\User as UserModel;
use think\Cache;
use think\Db;
use app\user\validate\User;
use util\Tree;

use app\index\controller\Alistock;
use app\index\controller\Home;


class Order extends Admin
{

    //股票持仓列表（点买列表）
    public function buyList(){
		// 获取筛选
		$map = $this->getMap();
		
        $auth = session('user_auth');
        if($auth['role'] == 2){
            $uid = $auth['uid'];
            $condition = " and (recommendCode in (select id from xh_admin_user where huiyuan = '{$auth['username']}') or recommendCode='{$uid}')";
        }
       
	   $admin_name = $auth['username'];
       
	   if($admin_name == 'admin' || $auth['role'] == 2){
	        // 数据列表
	        $data_list = Db::table(["xh_stock_order"=>'a', "xh_member"=>'b' ])
	            ->field("a.*, b.username, b.mobile,b.recommendCode,b.recommendUserName,b.recommendMobile")
	            ->where($map)
	            ->where("a.memberId = b.id and a.isFreetrial = 0 and status = 1 $condition")
	            ->order("a.id desc")->paginate();
	   }else {
	   	    
				        // 数据列表
	        $data_list = Db::table(["xh_stock_order"=>'a', "xh_member"=>'b' ])
	            ->field("a.*, b.username, b.mobile,b.recommendCode,b.recommendUserName,b.recommendMobile")
	            ->where($map)
	            ->where("a.memberId = b.id and a.isFreetrial = 0 and status = 1")
				->where("b.recommendCode in (select id from xh_admin_user where huiyuan = '{$admin_name}')")
	            ->order("a.id desc")->paginate();
		
	   }
	   //打印语句
		//dump(  Db::table("xh_stock_order")->getLastSql());
	   
		
        $list = array();
        //数据处理(递延天数减2)
        foreach($data_list as $i=>$v){
            $v['delayDays'] -= 2;
            if( $v['delayDays'] < 0){
                $v['delayDays'] = 0;
            }
            $list[$i] = $v;
        }

        // 分页数据
        $page = $data_list->render();

        $btn = ['title' => '平仓',
            'icon'  => 'fa fa-fw fa-key',
            'href'  => 'javascript:doLiquidation(__id__)'//url('index', ['uid' => '__id__',  ])
        ];
        // 使用ZBuilder快速创建数据表格   liquidation
      
        return ZBuilder::make('table')
            ->hideCheckbox()
            ->js('order')
            ->setPageTitle('交易管理') // 设置页面标题
            ->setTableName('xh_stock_order') // 设置数据表名
            ->addTimeFilter('a.createTime')//日期
            ->setSearch(['username', 'mobile','stockCode','recommendCode','recommendUserName','recommendMobile']) // 设置搜索参数
            ->addColumns([ // 批量添加列
                ['username', '用户名'],
                ['mobile', '手机号'],
                ['stockCode', '股票' ],
                ['recommendCode', '机构推荐码' ],
                ['recommendUserName', '推荐用户名' ],
                ['recommendMobile', '推荐手机号' ],
                ['dealPrice', '买入价(元)'],
                ['dealAmount', '买入金额(万)'],
                ['dealQuantity', '数量(手)'],
                ['surplus', '止盈线(元)'],
                ['loss', '止损线(元)'],
                ['publicFee', '综合费(元)'],
                ['guaranteeFee', '保证金(元)'],
                ['delayLine', '递延线(元)'],
                ['delayDays', '递延天数'],
                ['delayFeeSum', '递延费(元)'],

                ['createTime', '买入时间' ],
                ['right_button', '操作', 'btn']
            ])
            ->addRightButton('custom', $btn ) // 批量添加右侧按钮
            ->setRowList($list) // 设置表格数据
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染页面
    }

    public function finished(){
    	// 获取筛选
		$map = $this->getMap();
		session('map', $map);
		
        $auth = session('user_auth');
        if($auth['role'] == 2){
            $uid = $auth['uid'];
            $condition = " and (recommendCode in (select id from xh_admin_user where huiyuan = '{$auth['username']}') or recommendCode='{$uid}')";
        }
		
		$admin_name = $auth['username'];

        if($admin_name == 'admin' || $auth['role'] == 2){
          
          
          
         $aa=$_GET['_filter_time_from'];
         $bb=$_GET['_filter_time_to'];
          
          session('aa', $aa);
          session('bb', $bb);
          
          
          
          
          
        
          
          if( $_GET['_filter_time_to'] ){
            
            $bb=$bb.' 23:59:59';
            
             $data_list = Db::table(["xh_stock_order"=>'a', "xh_member"=>'b' ])
                  
		            ->field("a.*, b.username, b.mobile,b.recommendCode,b.recommendUserName,b.recommendMobile")
                  
		            ->where($map)
                  
		          ->where("a.memberId = b.id and a.isFreetrial = 0 and status = 2 $condition  and   (a.sellTime>='{$aa} 'and a.sellTime<='{$bb}' )     ")
                  
                  
                  
                
                  
                  
		            ->order("a.sellTime desc, a.id desc")->paginate();
          }else{
            
             $data_list = Db::table(["xh_stock_order"=>'a', "xh_member"=>'b' ])
                  
		            ->field("a.*, b.username, b.mobile,b.recommendCode,b.recommendUserName,b.recommendMobile")
                  
		            ->where($map)
                  
		       
                  
                  
                  
                  ->where("a.memberId = b.id and a.isFreetrial = 0 and status = 2 $condition      ")
                  
                  
		            ->order("a.sellTime desc, a.id desc")->paginate();
          
          }
          
          
		        // 数据列表
		       
			
		} else {
			
					        // 数据列表
		        $data_list = Db::table(["xh_stock_order"=>'a', "xh_member"=>'b' ])
		            ->field("a.*, b.username, b.mobile,b.recommendCode,b.recommendUserName,b.recommendMobile")
		            ->where($map)
		            ->where("a.memberId = b.id and a.isFreetrial = 0 and status = 2")
					->where("b.recommendCode in (select id from xh_admin_user where huiyuan = '{$admin_name}')")
		            ->order("a.sellTime desc, a.id desc")->paginate();
			
			
		}
      
      //打印语句
		//dump(  Db::table(["xh_stock_order"=>'a', "xh_member"=>'b' ])->getLastSql());

        // 分页数据
        $page = $data_list->render();

        $list = array();
        foreach($data_list as $i=>$v){
            //0用户自己卖出; 1后台手动平仓；2超过止损线自动平仓；3超过止盈线自动平仓；4 收盘时亏损额大于递延条件而自动平仓
            $l_map = array('用户卖出', '后台手动平仓','超过止损线自动平仓', '超过止盈线自动平仓', '大于递延线自动平仓');
            $v['liquidation'] = $l_map[$v['liquidation']];
            $list[$i] = $v;
        }
		$btn = ['title' => '导出',
            'icon'  => 'fa fa-fw fa-key',
            'href'  => 'javascript:exportby(__id__)'//url('index', ['uid' => '__id__',  ])
        ];
      
      
      
        // 使用ZBuilder快速创建数据表格   liquidation
        return ZBuilder::make('table')
            ->hideCheckbox()
            ->js('order')
            ->setPageTitle('交易管理') // 设置页面标题
            ->addTimeFilter('a.createTime')//时间
            ->setTableName('xh_stock_order') // 设置数据表名
            ->setSearch(['username', 'mobile','stockCode','recommendCode','recommendUserName','recommendMobile']) // 设置搜索参数
            ->addColumns([ // 批量添加列
                ['username', '用户名'],
                ['mobile', '手机号'],
                ['stockCode', '股票' ],
                ['recommendCode', '机构推荐码' ],
                ['recommendUserName', '推荐用户名' ],
                ['recommendMobile', '推荐手机号' ],
                ['dealPrice', '买入价(元)'],
                ['sellPrice', '卖出价(元)'],
                ['dealAmount', '买入金额(万)'],
                ['dealQuantity', '数量(手)'],
                ['publicFee', '综合费(元)'],
                ['delayFeeSum', '递延费(元)'],
                ['profit', '盈亏(元)'],
                ['guaranteeFee', '保证金(元)'],
                ['createTime', '买入时间' ],
                ['sellTime', '卖出时间' ],
              
                ['right_button', '操作', 'btn']
            ])
            ->addRightButton('custom', $btn ) // 批量添加右侧按钮
            ->setRowList($list) // 设置表格数据
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染页面
    }
  
  
  
  
  public function daochu()
    {
     // 获取筛选
	//	$map = $this->getMap();
    $map = session('map');
    
    $_filter_time = "";
    if(session('bb')){
      	$aa = session('aa');
        $bb = session('bb');
        if($bb !=null && $bb !=""){
          $bb=$bb.' 23:59:59';
          $_filter_time = "and   (a.sellTime>='{$aa} 'and a.sellTime<='{$bb}' )"; 
        }
    }

        $auth = session('user_auth');
        if($auth['role'] == 2){
            $uid = $auth['uid'];
            $condition = " and recommendCode='{$uid}'";
        }
		
		$admin_name = $auth['username'];

        if($admin_name == 'admin' || $auth['role'] == 2){
		        // 数据列表
		        $data_list = Db::table(["xh_stock_order"=>'a', "xh_member"=>'b' ])
		            ->field("a.*, b.username, b.mobile,b.recommendCode,b.recommendUserName,b.recommendMobile")
		            ->where($map)
		            ->where("a.memberId = b.id and a.isFreetrial = 0 and status = 2 $condition $_filter_time")
		            ->order("a.sellTime desc, a.id desc")->paginate();
			
		} else {
			
					        // 数据列表
		        $data_list = Db::table(["xh_stock_order"=>'a', "xh_member"=>'b' ])
		            ->field("a.*, b.username, b.mobile,b.recommendCode,b.recommendUserName,b.recommendMobile")
		            ->where($map)
		            ->where("a.memberId = b.id and a.isFreetrial = 0 and status = 2")
					->where("b.recommendCode in (select id from xh_admin_user where huiyuan = '{$admin_name}')")
		            ->order("a.sellTime desc, a.id desc")->paginate();
               
        }
		//打印语句
		//dump(  Db::table(["xh_stock_order"=>'a', "xh_member"=>'b' ])->getLastSql());	
        $table = '';
        $table .= "<table>
            <thead>
                <tr>
                    <th class='name'>用户名</th>
                    <th class='name'>手机号</th>
                    <th class='name'>股票</th>
                    <th class='name'>机构推荐码</th>
                    <th class='name'>推荐手机号</th>
                      <th class='name'>推荐用户名</th>
                    <th class='name'>买入价(元)</th>
                    <th class='name'>卖出价(元)</th>
                     <th class='name'>买入金额(万)</th>
                    <th class='name'>数量(手)</th>
                    <th class='name'>综合费(元)</th>
                    <th class='name'>递延费(元)</th>
                    <th class='name'>盈亏(元)</th>
                    <th class='name'>保证金(元)</th>
                    <th class='name'>买入时间</th>
                     <th class='name'>卖出时间</th>
                    <th class='name'>类型</th>
                </tr>
            </thead>
            <tbody>";
        foreach ($data_list as $v) {
            $table .= "<tr>
                    <td class='name'>{$v['username']}</td>
                    <td class='name'>{$v['mobile']}</td>
                    <td class='name'>{$v['stockCode']}</td>
                    <td class='name'>{$v['recommendCode']}</td>
                    <td class='name'>{$v['recommendUserName']}</td>
                    <td class='name'>{$v['recommendMobile']}</td>
                    <td class='name'>{$v['dealPrice']}</td>
                      <td class='name'>{$v['sellPrice']}</td>
                    <td class='name'>{$v['dealAmount']}</td>
                     <td class='name'>{$v['dealQuantity']}</td>
                    <td class='name'>{$v['publicFee']}</td>
                    <td class='name'>{$v['delayFeeSum']}</td>
                    <td class='name'>{$v['profit']}</td>
                    <td class='name'>{$v['guaranteeFee']}</td>
                    <td class='name'>{$v['createTime']}</td>
                     <td class='name'>{$v['sellTime']}</td>
                    <td class='name'>{$v['liquidation']}</td>
                </tr>";
        }
        $table .= "</tbody>
        </table>";
//通过header头控制输出excel表格
            header("Pragma: public");  
        header("Expires: 0");  
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");  
        header("Content-Type:application/force-download");  
        header("Content-Type:application/vnd.ms-execl");  
        header("Content-Type:application/octet-stream");  
        header("Content-Type:application/download");;  
        header('Content-Disposition:attachment;filename="123.xls"');  
        header("Content-Transfer-Encoding:binary");  
        echo $table;
  }
 	

    //手动平仓
  	
    public function liquidation(){
        global $orderId ;
        $time = date('H:i');
        $orderId = trim(input("orderId"));
        if($orderId=='' || !is_numeric($orderId) || $orderId <= 0){
            error("订单号不对");
          
        }
      	if(($time<='9:30' && $time >='11:30') || ($time <='13:00' && $time >= '14:58')){   
            error('非交易时间,禁止卖出');
            return false;
        }
        Db::transaction(function(){
            global $orderId ;
            $this->stock_sell_do($orderId, 1);
            Db::commit();
            success("操作成功");
        });

        error("操作失败");
    }
  	

    //$liquidation: 0用户自己卖出; 1后台手动平仓；2超过止损线自动平仓；3超过止盈线自动平仓; 4 收盘时亏损额大于递延条件而自动平仓
    public function stock_sell_do($orderId , $liquidation = 1){

        if(!$orderId || !is_numeric($orderId)){
            die(false);
        }
        $con = " id=$orderId ";
        $order = Db::table('xh_stock_order')->where( $con )->find();
        if(!$order ){
            error("订单不存在");
        }
        $memberId = $order['memberId'];
        $code = $order['stockCode'];
        $stock = Db::table("xh_shares")->where("code='$code'")->find();
        if(!$stock){
            error("股票不存在");
        }
        if(substr($order['createTime'], 0, 10) == date("Y-m-d")){
            error("当天点买的股票下个工作日才能卖出");
        }

        $arr = (new Alistock())->batch_real_stockinfo($stock['market'].$stock['code']);
        if(!$arr || !is_array($arr)){
            error("获取股票数据失败");
        }
        $nowPrice = $arr[$code];
        if($nowPrice <= 0 || !is_numeric($nowPrice)){
            error("股票数据异常");
        }
      	

        //计算盈亏
        $profit = round( ($nowPrice - $order['dealPrice']) * $order['dealQuantity'] * 100 ,2 );
        //计算盈利分配
        $profitSelf = $profit;
        $profitFee = (float)(\app\index\controller\getSysParamsByKey("profitFee"));
        if($profit > 0){
            $profitSelf = $profit * ( 1- $profitFee);
        }
        //保证金
        $guaranteeFee = round( $order['guaranteeFee'], 2 ) ;
        $amount = $guaranteeFee + $profitSelf;

        $sql = "update xh_stock_order set `status` = 2, sellPrice=$nowPrice, profit = $profit, profitSelf=$profitSelf, sellTime = now(), liquidation = $liquidation
            where id = $orderId and `status` = 1";
        //echo $sql;return;
        $ret = Db::execute($sql);
        if($ret != 1){
            error("请勿重复交易");
        }
        $sql = "update xh_member set usableSum = usableSum + $amount where id = $memberId;";
        $ret = Db::execute($sql);
        //查询余额
        $map = Db::table("xh_member")->field("usableSum")->where("id=$memberId")->find();
        $usableSum = $map['usableSum'];
        $remarks = "手动";
        if($liquidation == 2){
            $remarks = "亏损超过止损线自动";
        }else if($liquidation == 3){
            $remarks = "盈利超过止盈线自动";
        }else if($liquidation == 4){
            $remarks = "收盘时亏损额超过递延线自动";
        }
        $remarks .= "平仓,退还保证金{$guaranteeFee}元,盈利分配{$profitSelf}元。";

        $sql = "insert into xh_member_fundrecord (memberId, flow, amount, usableSum, remarks, createTime)
            values ($memberId, '1', $amount, $usableSum , '{$remarks}', now() );";
        $ret = Db::execute($sql);

        return $ret;
    }
  
  
  //用户盈亏列表
    public function profitlist(){
		// 获取筛选
		$map = $this->getMap();
		
        $auth = session('user_auth');
        if($auth['role'] == 2){
            $uid = $auth['uid'];
            $condition = " and (recommendCode in (select id from xh_admin_user where huiyuan = '{$auth['username']}') or recommendCode='{$uid}')";
          
        }
       
	   $admin_name = $auth['username'];
       
	   if($admin_name == 'admin' || $auth['role'] == 2){
	        // 数据列表
	        $data_list = Db::table(["xh_stock_order"=>'a', "xh_member"=>'b' ])
	            ->field("a.*, b.username, b.mobile,b.recommendCode,b.recommendUserName,b.recommendMobile")
	            ->where($map)
	            ->where("a.memberId = b.id and a.isFreetrial = 0 and status = 1 $condition")
	            ->order("a.id desc")->paginate();
	   }else {
	   	    
				        // 数据列表
	        $data_list = Db::table(["xh_stock_order"=>'a', "xh_member"=>'b' ])
	            ->field("a.*, b.username, b.mobile,b.recommendCode,b.recommendUserName,b.recommendMobile")
	            ->where($map)
	            ->where("a.memberId = b.id and a.isFreetrial = 0 and status = 1")
				->where("b.recommendCode in (select id from xh_admin_user where huiyuan = '{$admin_name}')")
	            ->order("a.id desc")->paginate();
		
	   }
	   
	   
      //查询股票最新价
        $stocks = "";
        foreach ( $data_list as $i => $v) { //print_r($v);
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
             error("获取股票数据失败");
        }
      
		
        $list = array();
        //数据处理(递延天数减2)
        foreach($data_list as $i=>$v){
            $v['delayDays'] -= 2;
            if( $v['delayDays'] < 0){
                $v['delayDays'] = 0;
            }
          
          $arr = (new Alistock())->batch_real_stockinfo($v['stockCode']);
          if(!$arr || !is_array($arr)){
              error("获取股票数据失败");
          }
          
          
            $code = $v['stockCode'];
            $nowPrice = (float)$res[$code];
            $dealPrice = (float)$v['dealPrice'];
            $profitAmount = ($nowPrice - $dealPrice) * ((int)$v['dealQuantity']) * 100; //收益额
            $profitAmount = round($profitAmount, 2);
            $v['profitAmount'] = $profitAmount;//
            
          
            $list[$i] = $v;
        }

        // 分页数据
        $page = $data_list->render();

        $btn = ['title' => '平仓',
            'icon'  => 'fa fa-fw fa-key',
            'href'  => 'javascript:doLiquidation(__id__)'//url('index', ['uid' => '__id__',  ])
        ];
        // 使用ZBuilder快速创建数据表格   liquidation
        return ZBuilder::make('table')
            ->hideCheckbox()
            ->js('order')
            ->setPageTitle('盈亏列表') // 设置页面标题
            ->setTableName('xh_stock_order') // 设置数据表名
            ->addTimeFilter('a.createTime')//日期
            ->setSearch(['username', 'mobile','stockCode','recommendCode','recommendUserName','recommendMobile']) // 设置搜索参数
            ->addColumns([ // 批量添加列
                ['username', '用户名'],
                ['mobile', '手机号'],
                ['stockCode', '股票' ],
                ['recommendCode', '机构推荐码' ],
                ['recommendUserName', '推荐用户名' ],
                ['recommendMobile', '推荐手机号' ],
                ['dealPrice', '买入价(元)'],
                ['dealAmount', '买入金额(万)'],
                ['dealQuantity', '数量(手)'],
                ['surplus', '止盈线(元)'],
                ['loss', '止损线(元)'],
                ['publicFee', '综合费(元)'],
                ['guaranteeFee', '保证金(元)'],
                ['delayLine', '递延线(元)'],
                ['delayDays', '递延天数'],
                ['delayFeeSum', '递延费(元)'],

                ['createTime', '买入时间' ],
              	['profitAmount',' 盈亏'],
                ['right_button', '操作', 'btn']
            ])
            ->addRightButton('custom', $btn ) // 批量添加右侧按钮
            ->setRowList($list) // 设置表格数据
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染页面
    }


}