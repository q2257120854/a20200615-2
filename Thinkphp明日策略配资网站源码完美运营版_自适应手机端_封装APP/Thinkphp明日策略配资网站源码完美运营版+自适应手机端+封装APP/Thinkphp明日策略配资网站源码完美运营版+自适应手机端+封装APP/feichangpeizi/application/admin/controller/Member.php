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


class Member extends Admin
{
    public function index(){
    	// 获取筛选
		$map = $this->getMap();
 		
        $auth = session('user_auth');
        if($auth['role'] == 2){
            $uid = $auth['uid'];
            $condition = "recommendCode='{$uid}'";
        }
        
		$admin_name = session('user_auth.username');
	
		if($admin_name == 'admin'){
	        // 数据列表
	        $data_list = Db::table("xh_member")->where($map)
	        ->where($condition)->order("id desc")->paginate();
	    }
		
		elseif($auth['role'] == 1){
				        // 数据列表
	        $data_list = Db::table("xh_member")->where($map)->where("recommendCode in (select id from xh_admin_user where huiyuan = '{$admin_name}')")
	        ->where($condition)->order("id desc")->paginate();
			
		}
		
		else {
			
		    //$data_list = Db::table("xh_member")->where($map)
	        //->where($condition)->order("id desc")->paginate();
          //2018-10-29
          $data_list = Db::table("xh_member")->where($map)->where("recommendCode in (select id from xh_admin_user where huiyuan = '{$admin_name}') or " . $condition)->order("id desc")->paginate();
			
		}
		
		
		
 
        // 分页数据
        $page = $data_list->render();
 

        // 按钮
        $btn_recharge = [
            'title' => '充值/扣费',
            'icon'  => 'fa fa-fw fa-key',
            'href'  => url('recharge', ['uid' => '__id__'])
        ];

        //查看资金按钮
        $btn_fundrecord = [
            'title' => '资金明细',
            'icon'  => 'fa fa-fw fa-rmb',
            'href'  => url('fundrecord', ['uid' => '__id__'])
        ];
		
		//打印语句
		//dump(  Db::table("xh_member")->getLastSql());
      
/*
		var_dump($btn_recharge);
		var_dump($btn_fundrecord);
		die;
		*/

       	if($admin_name == 'admin'){
		
		        // 使用ZBuilder快速创建数据表格
		        return ZBuilder::make('table')
		            ->setPageTitle('用户列表') // 设置页面标题
		            ->addTimeFilter('createTime')//时间
		            ->setTableName('admin_user') // 设置数据表名
		           	->setSearch([ 'username' => '用户', 'mobile' => '手机','recommendCode'=>'机构推荐码']) // 设置搜索参数
		            ->addColumns([ // 批量添加列
		                ['username', '用户名'],
		                ['id', '客户编号'],
		                ['mobile', '手机号'],
		                ['usableSum', '可用余额(元)'],
		                ['recommendCode', '机构推荐码'],
		                ['createTime', '创建时间' ],
		                ['realName', '真实姓名' ],
		                ['IDNumber', '身份证号' ],
		                ['right_button', '操作', 'btn']
		            ])
		            ->addRightButtons('edit') // 批量添加右侧按钮
		            ->addRightButton('custom', $btn_recharge)
		            ->addRightButton('custom', $btn_fundrecord)
		            ->setRowList($data_list) // 设置表格数据
		            ->setPages($page) // 设置分页数据
		            ->fetch(); // 渲染页面
            
            }else{
            	
				  		        // 使用ZBuilder快速创建数据表格
		        return ZBuilder::make('table')
		            ->setPageTitle('用户列表') // 设置页面标题
		            ->addTimeFilter('createTime')//时间
		            ->setTableName('admin_user') // 设置数据表名
		           	->setSearch([ 'username' => '用户', 'mobile' => '手机','recommendCode'=>'机构推荐码']) // 设置搜索参数
		            ->addColumns([ // 批量添加列
		                ['username', '用户名'],
		                ['id', '客户编号'],
		                ['mobile', '手机号'],
		                ['usableSum', '可用余额(元)'],
		                ['recommendCode', '机构推荐码'],
		                ['createTime', '创建时间' ],
		                ['realName', '真实姓名' ],
		                ['IDNumber', '身份证号' ],
		                ['right_button', '操作', 'btn']
		            ])
		            ->addRightButton('custom', $btn_fundrecord)
		            ->setRowList($data_list) // 设置表格数据
		            ->setPages($page) // 设置分页数据
		            ->fetch(); // 渲染页面
				
            }
            
            
            
            
    }


    /**
     * 编辑
     * @param null $id
     * @return mixed|void
     */
    public function edit($id = null)
    {
        if ($id === null) return $this->error('缺少参数');

        // 保存数据
        if ($this->request->isPost()) {
            $data = $this->request->post();

            if (Db::table("xh_member")->where("id=$id")->update($data)) {
                // 记录行为
                action_log('member_edit', 'admin_role', $id, UID, $data['name']);
                return $this->success('编辑成功', url('index'));
            } else {
                return $this->error('编辑失败');
            }
        }

        // 获取数据
        $info       = Db::table("xh_member")->where("id=$id")->find();

        $this->assign('info', $info);


        // 使用ZBuilder快速创建表单
        return ZBuilder::make('form')
            ->addFormItems([
                ['static', 'username', '用户名'],
                ['text', 'mobile', '手机号'],
                ['static', 'usableSum', '可用余额'],
                ['text', 'recommendCode', '机构推荐码'],
                ['static', 'createTime', '注册时间'],
                ['text', 'realName', '真实姓名'],
                ['text', 'IDNumber', '身份证号'],
            ])
            ->setFormData($info)
            ->fetch();
    }


    public function recharge()
    {
        // 保存数据
        if ($this->request->isPost()) {
						
              Db::transaction(function(){
                $uid = (int)trim(input("uid"));
                $amount = trim(input("amount"));
				
                if($uid <= 0){
                    return $this->error('参数错误');
                }
                if(!is_numeric($amount)){
                    return $this->error('金额格式不对');
                }

                if ( Db::table("xh_member")->where("id=$uid")->setInc("usableSum", $amount) ) {
                    $member =  Db::table("xh_member")->field("usableSum")->where("id=$uid")->find();
                    $usableSum = $member['usableSum'];
                    $flow = 1;
                    $remarks = "后台手动充值";
                    if($amount < 0){
                        $flow = 2;
                        $remarks = "后台手动扣费";
                        $amount = -$amount;
                    }

                    //增加资金记录
                    $data = array();
                    $data['memberId'] = $uid;
                    $data['flow'] = $flow;
                    $data['amount'] = $amount;
                    $data['usableSum'] = $usableSum;
                    $data['remarks'] = $remarks;
                    $data['createTime'] = date("Y-m-d H:i:s");
                    Db::table("xh_member_fundrecord")->insertGetId($data);

                    //如果是充值，则增加充值记录
                    if($amount > 0){
                        $data = array();
                        $data['amount'] = $amount;
                        $data['memberId'] = $uid;
                        $data['status'] = 3;
                        $data['no_order'] = "admin_{$uid}_".date("YmdHis").rand(10,99);
                        $data['createTime'] = date("Y-m-d H:i:s");
                        Db::table("xh_member_recharge")->insertGetId($data);
                    }

                    Db::commit();

                    // 记录行为
                    action_log('recharge', 'admin_member', $uid , UID);
                    return $this->success('新增成功', url('index'));
                } else {
                    return $this->error('新增失败');
                }
            });

        }

        // 使用ZBuilder快速创建表单
        return ZBuilder::make('form')
            ->setPageTitle('充值/扣费') // 设置页面标题
            ->addFormItems([ // 批量添加表单项
                ['text', 'uid', '客户编号', '请填写客户编号'],
                ['text', 'amount', '金额', '必填，金额大于0为充值，金额小于0为扣费'],

            ])
            ->fetch();
    }

    //提现申请
    public function withdraw_apply(){
    	// 获取查询条件
        $map = $this->getMap();
        
        // 数据列表
        $data_list = Db::table(["xh_member_withdraw"=>'a', "xh_member"=>'b'])
            ->field("a.*,  b.username, b.mobile")
            ->where($map)
            ->where("a.memberId = b.id and a.status=0")
            ->order("id desc")
            ->paginate();

        // 分页数据
        $page = $data_list->render();


        $btn_yes = [
            'title' => '审核通过',
            'icon'  => 'fa fa-fw fa-check-square-o',
            'href'  => "javascript:doWithdraw(__id__, 1)"
        ];


        $btn_no = [
            'title' => '审核不通过',
            'icon'  => 'fa fa-fw fa-power-off',
            'href'  => "javascript:doWithdraw(__id__, 2)"
        ];

        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->hideCheckbox()
            ->js('member')
            ->setPageTitle('用户列表') // 设置页面标题
             ->addTimeFilter('a.createTime')//日期
            ->setTableName('admin_user') // 设置数据表名
            ->setSearch(['username','mobile']) // 设置搜索参数
            ->addColumns([ // 批量添加列
                ['username', '用户名'],
                ['mobile', '手机号'],
                ['amount', '提现金额'],
                ['bankName', '提现银行卡名称'],
                ['cardNumber', '提现银行卡号'],
                ['realName', '银行卡姓名' ],
                ['createTime', '创建时间' ],
                ['right_button', '操作', 'btn']
            ])
            ->addRightButton('custom', $btn_yes)
            ->addRightButton('custom', $btn_no)
            ->setRowList($data_list) // 设置表格数据
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染页面
    }


    //提现记录
    public function withdraw_finished(){
    	// 获取查询条件
        $map = $this->getMap();
		
		$auth = session('user_auth');
        if($auth['role'] == 2){
            $uid = $auth['uid'];
            $condition = " and (recommendCode in (select id from xh_admin_user where huiyuan = '{$auth['username']}') or recommendCode='{$uid}')";
          
        }
       
		$admin_name = $auth['username'];
	   
        if($admin_name == 'admin' || $auth['role'] == 2){
			// 数据列表
			$data_list = Db::table(["xh_member_withdraw"=>'a', "xh_member"=>'b'])
				->field("a.*,  b.username, b.mobile")
				->where($map)
				->where("a.memberId = b.id and a.status>0 $condition")
				->order("a.id desc")
				->paginate();
		}else {
			// 数据列表
			$data_list = Db::table(["xh_member_withdraw"=>'a', "xh_member"=>'b'])
				->field("a.*,  b.username, b.mobile")
				->where($map)
				->where("a.memberId = b.id and a.status>0")
				->where("b.recommendCode in (select id from xh_admin_user where huiyuan = '{$admin_name}')")
				->order("a.id desc")
				->paginate();
		}

        // 分页数据
        $page = $data_list->render();

        $list = array();
        foreach($data_list as $i=>$v){
            if($v['status'] == 1){
                $v['status'] = '通过';
            }else if($v['status'] == 2){
                $v['status'] = '未通过';
            }
            $list[$i] = $v;
        }

        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->hideCheckbox()
            ->js('member')
            ->setPageTitle('用户列表') // 设置页面标题
            ->setTableName('admin_user') // 设置数据表名
            ->setSearch(['username', 'mobile']) // 设置搜索参数
            ->addColumns([ // 批量添加列
                ['username', '用户名'],
                ['mobile', '手机号'],
                ['amount', '提现金额'],
                ['bankName', '提现银行卡名称'],
                ['cardNumber', '提现银行卡号'],
                ['realName', '银行卡姓名' ],
                ['createTime', '创建时间' ],
                ['status', '状态' ],
            ])
             ->addTimeFilter('a.createTime')//日期
            ->setRowList($list) // 设置表格数据
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染页面
    }


    public function do_withdraw(){
        $id = (int)trim(input("id"));
        if($id <= 0){
            error("数据错误");
        }
        $status = (int)trim(input("status"));//1 审核通过；2审核失败
        if($status != 1 && $status != 2){
            error("状态值不对");
        }

        $withdraw = Db::table("xh_member_withdraw")->where("id=$id")->find();
        if(!$withdraw){
            error("数据不存在");
        }
        $memberId = $withdraw['memberId'];
        $amount = $withdraw['amount'];
        Db::table("xh_member_withdraw")->where("id=$id")->update( array("status"=>$status) );
        if($status == 2){
            //余额\增加
            $ret = Db::table("xh_member")->where("id = $memberId ")->setInc('usableSum', $amount);
            $member = Db::table("xh_member")->field("usableSum")->where("id = $memberId")->find();

            //增加资金记录
            $data=array();
            $data['memberId'] = $memberId;
            $data['flow'] = 1;
            $data['amount'] = $amount;
            $data['usableSum'] = $member['usableSum'];
            $data['remarks'] = "提现申请审核未通过，退还{$amount}元";
            $data['createTime'] = date("Y-m-d H:i:s");
            $ret = Db::table("xh_member_fundrecord")->insertGetId($data);
        }else if($status == 1){//审核成功

        }

        /*
        $memberId = $withdraw['memberId'];
        $amount = $withdraw['amount'];
        $bankName = $withdraw['bankName'];
        $cardNumber = $withdraw['cardNumber'];
        $realName = $withdraw['realName'];

        //余额减少
        $ret = Db::table("xh_member")->where("id = $memberId and usableSum >= $amount")->setInc('usableSum', -$amount);
        if($ret <= 0) {
            error("余额不足");
        }
        $member = Db::table("xh_member")->field("usableSum")->where("id = $memberId")->find();
        $usableSum = $member['usableSum'];

        //增加资金记录
        $data=array();
        $data['memberId'] = $memberId;
        $data['flow'] = 2;
        $data['amount'] = $amount;
        $data['usableSum'] = $usableSum;
        $data['remarks'] = "申请提现{$amount}元";
        $data['createTime'] = date("Y-m-d H:i:s");
        $ret = Db::table("xh_member_fundrecord")->insertGetId($data);
        if($ret <= 0){
            error("添加资金记录失败");
        }
        */

        success("操作成功");

    }


    //用户资金明细
    public function fundrecord(){

        $uid1 = (int)trim(input("uid"));
		
        $auth = session('user_auth');
        if($auth['role'] == 2){
            $uid = $auth['uid'];
            $condition = "recommendCode='{$uid}'";
        }
        
		$admin_name = session('user_auth.username');
	
		if($admin_name == 'admin'){
	        // 数据列表
	        $data_list = Db::table("xh_member")->field("id")
	        ->where($condition)->order("id desc")->select();
	    }
		
		elseif($auth['role'] == 1){
				        // 数据列表
	        $data_list = Db::table("xh_member")->field("id")->where("recommendCode in (select id from xh_admin_user where huiyuan = '{$admin_name}')")
	        ->where($condition)->order("id desc")->select();
			
		}
		
		else {
			
		    $data_list = Db::table("xh_member")->field("id")
	        ->where($condition)->order("id desc")->select();
			
		}
		
		$arr_id = array();
		foreach($data_list as $d){
			$arr_id[]=$d['id'];
		}
		
		if(!in_array($uid1, $arr_id)){
			
			return $this->error('缺少参数');
		}
		

	 
	 
        // 数据列表
        $data_list = Db::table(["xh_member_fundrecord"=>'a', "xh_member"=>'b'])
            ->field("a.*,  b.username, b.mobile")
            ->where("a.memberId = b.id and a.memberId=$uid1 ")
            ->order("id desc")
            ->paginate();
         
        // 分页数据
        $page = $data_list->render();

        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->hideCheckbox()
            ->js('member')
            ->setPageTitle('用户列表') // 设置页面标题
            ->setTableName('admin_user') // 设置数据表名
            ->setSearch(['id' => 'ID', 'username' => '用户名', 'email' => '邮箱']) // 设置搜索参数
            ->addColumns([ // 批量添加列
                ['username', '用户名'],
                ['mobile', '手机号'],
                ['flow', '资金流向'],
                ['amount', '操作金额'],
                ['usableSum', '余额' ],
                ['createTime', '时间' ],
                ['remarks', '说明' ]
            ])
            ->setRowList($data_list) // 设置表格数据
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染页面
    }

}