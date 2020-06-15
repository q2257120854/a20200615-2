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


class Notemsg extends Admin
{
    public function unread(){
        cookie('__forward__', $_SERVER['REQUEST_URI']);

		$map = $this->getMap();
        // 数据列表
        $data_list = Db::table("xh_note_msg")->where($map)->where("status=0")->order("id desc")->paginate();

        // 分页数据
        $page = $data_list->render();

        $btn_read=[
            'title' => '标记为已读',
            'icon'  => 'fa fa-fw fa-key',
            'href'  => "javascript:setStatus(__id__, this)"
        ];
        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->js('notemsg')
            ->hideCheckbox()
            ->setPageTitle('未读消息') // 设置页面标题
             ->addTimeFilter('createTime')//时间
            ->addColumns([ // 批量添加列
                ['id', 'ID'],
                ['message', '消息'],
                ['createTime', '时间' ],
                ['right_button', '操作', 'btn']
            ])
            ->addRightButton('custom', $btn_read)
            ->setRowList($data_list) // 设置表格数据
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染页面
    }

    public function read(){
        cookie('__forward__', $_SERVER['REQUEST_URI']);

		// 获取筛选
        $map = $this->getMap();
        // 数据列表
        $data_list = Db::table("xh_note_msg")->where($map)->where("status=1")->order("id desc")->paginate();

        // 分页数据
        $page = $data_list->render();

        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->js('notemsg')
            ->hideCheckbox()
            ->setPageTitle('已读消息') // 设置页面标题
            ->addTimeFilter('createTime')//时间
            ->addColumns([ // 批量添加列
                ['id', 'ID'],
                ['message', '消息'],
                ['createTime', '时间' ],
            ])
            ->setRowList($data_list) // 设置表格数据
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染页面
    }

    public function setStatus(){
        $id = (int)trim(input("id"));
        $ret = Db::table("xh_note_msg")->where("id=$id")->update(array('status'=>1));
        if($ret > 0){
            success("操作成功");
        }
        error("操作失败");
    }

}