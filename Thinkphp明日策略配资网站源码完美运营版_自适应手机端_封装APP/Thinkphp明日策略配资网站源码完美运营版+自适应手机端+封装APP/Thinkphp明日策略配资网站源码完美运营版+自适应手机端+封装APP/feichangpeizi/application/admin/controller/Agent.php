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


class Agent extends Admin
{
    public function index(){
        cookie('__forward__', $_SERVER['REQUEST_URI']);

        // 获取查询条件
        $map = $this->getMap();
        $map['role'] = 2;

        $admin_name = session('user_auth.username');
		
        if($admin_name == 'admin'){
        	 //数据列表
        	$data_list = UserModel::where($map)
                               ->order('sort,id desc')->paginate();
		} else{ 				   
            // 数据列表
            $data_list = UserModel::where($map)
		                       ->where('huiyuan',$admin_name)
                               ->order('sort,id desc')->paginate();
		}
        // 分页数据
        $page = $data_list->render();
	   //echo session('user_auth.username');
		
		
		if($admin_name == 'admin'){
	        // 使用ZBuilder快速创建数据表格
	        return ZBuilder::make('table')
	            ->setPageTitle('代理商管理') // 设置页面标题
	                ->hideCheckbox()
	            ->setTableName('admin_user') // 设置数据表名
	            ->setSearch(['id' => 'ID', 'username' => '用户名', 'mobile' => '手机号']) // 设置搜索参数
	            ->addColumns([ // 批量添加列
	                ['id', 'ID'],
	                ['username', '用户名'],
	                ['nickname', '昵称'],
	                ['role', '角色','select', RoleModel::getTree(null, false)],
	                ['email', '邮箱'],
	                ['mobile', '手机号'],
	                ['create_time', '创建时间', 'datetime'],
	                ['status', '状态', 'switch'],
	                ['right_button', '操作', 'btn']
	            ])
	            ->addTopButtons('add') // 批量添加顶部按钮
	            ->addRightButton('edit', ['href' => url('user/index/edit', ['id' => '__id__'])])
	            ->addRightButton('delete', ['href' => url('user/index/delete', ['id' => '__ids_'])])
	            ->setRowList($data_list) // 设置表格数据
	            ->setPages($page) // 设置分页数据
	            ->fetch(); // 渲染页面
            }  else {
            	
					        // 使用ZBuilder快速创建数据表格
	        return ZBuilder::make('table')
	            ->setPageTitle('代理商管理') // 设置页面标题
	                ->hideCheckbox()
	            ->setTableName('admin_user') // 设置数据表名
	            ->setSearch(['id' => 'ID', 'username' => '用户名', 'mobile' => '手机号']) // 设置搜索参数
	            ->addColumns([ // 批量添加列
	                ['id', 'ID'],
	                ['username', '用户名'],
	                ['nickname', '昵称'],
	                ['email', '邮箱'],
	                ['mobile', '手机号'],
	                ['create_time', '创建时间', 'datetime'],
	                ['status', '状态', 'switch']
	            ])
	            ->addTopButtons('add') // 批量添加顶部按钮
	            ->setRowList($data_list) // 设置表格数据s
	            ->setPages($page) // 设置分页数据
	            ->fetch(); // 渲染页面
				
            }
            
    }

    public function add()
    {
    	$admin_name = session('user_auth.username');   
        // 保存数据
        if ($this->request->isPost()) {
            $data = $this->request->post();
			//$data['huiyuan'] = $admin_name;
            // 验证
            //$result = $this->validate($data, 'User');
            // 验证失败 输出错误信息
            //if(true !== $result) return $this->error($result);

            if ($user = UserModel::create($data)) {
                // 记录行为
                action_log('user_add', 'admin_user', $user['id'], UID);
                return $this->success('新增成功', url('index'));
            } else {
                return $this->error('新增失败');
            }
        }

        $roleList = Db::table("xh_admin_role")->field("id, name")->where("id=2")->select();
        $roleResult=array();
        foreach ($roleList as $role) {
            $roleResult[$role['id']] = $role['name'];
        }
        $userList = Db::table("xh_admin_user")->field("id, username")->where("role=2")->select();
        $userResult=array();
        foreach ($userList as $user) {
            $userResult[$user['username']] = $user['username'];
        }
        // 使用ZBuilder快速创建表单
        return ZBuilder::make('form')
            ->setPageTitle('新增') // 设置页面标题
            ->addFormItems([ // 批量添加表单项
                ['text', 'username', '用户名', '必填，可由英文字母、数字组成'],
                ['text', 'nickname', '昵称', '可以是中文'],
                ['select', 'role', '角色', '', $roleResult],
                ['select', 'huiyuan', '所属会员', '', $userResult],
                ['text', 'email', '邮箱', ''],
                ['password', 'password', '密码', '必填，6-20位'],
                ['text', 'mobile', '手机号'],
                ['image', 'avatar', '头像'],
                ['radio', 'status', '状态', '', ['禁用', '启用'], 1],
            ])
            ->fetch();
    }

}