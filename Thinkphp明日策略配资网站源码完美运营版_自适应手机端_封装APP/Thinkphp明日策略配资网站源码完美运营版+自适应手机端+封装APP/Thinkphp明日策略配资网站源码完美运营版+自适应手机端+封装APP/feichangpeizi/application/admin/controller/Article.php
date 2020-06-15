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


class Article extends Admin
{
    public function imageslist(){

        // 数据列表
        $data_list = Db::table("xh_images")->where()->order("id desc")->paginate();

        // 分页数据
        $page = $data_list->render();

        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->hideCheckbox()
            ->setPageTitle('图片列表') // 设置页面标题
            ->addColumns([ // 批量添加列
                ['id', 'ID'],
                ['src', '图片地址'],
                ['href', '超链接'],
            ])
            ->addColumn('type', '类型', 'status', '', [1=>'PC', 2=>'手机']) //type为数据库字段名, status为列的属性
            ->addColumns([
                ['right_button', '操作', 'btn']
            ])
            ->addTopButton('add', ['href' => url('images_edit' )]) // 批量添加顶部按钮
            ->addRightButton('edit', ['href' => url('images_edit', ['id' => '__id__'])]) // 批量添加右侧按钮
            ->addRightButton('delete', ['href' => url('images_delete', ['id' => '__id__'])])
            ->setRowList($data_list) // 设置表格数据
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染页面
    }


    /**
     * 编辑
     * @param null $id
     * @return mixed|void
     */
    public function images_edit($id = null)
    {
        // 保存数据
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $data['src'] = get_file_path($data['image_id']);

            if($id > 0){
                $ret = Db::table("xh_images")->where("id=$id")->update($data);
            }else{
                $ret = Db::table("xh_images")->insertGetId($data);
            }


            if ($ret > 0) {
                // 记录行为
                action_log('images_edit', 'admin_role', $id, UID, $data['name']);
                return $this->success('编辑成功', url('imageslist'));
            } else {
                return $this->error('编辑失败');
            }
        }

        // 获取数据
        if( $id > 0){
            $info       = Db::table("xh_images")->where("id=$id")->find();
            $this->assign('info', $info);
        }

        $imagesTypeArray =  array('1'=>'PC轮播图片', '2'=>'手机轮播图片' );

        // 使用ZBuilder快速创建表单
        return ZBuilder::make('form')
            ->addImage('image_id', '图片')
            ->addSelect('type', '选择类型', '请选择类型',  $imagesTypeArray)
            ->addFormItems([
                ['text', 'href', '超链接'],
            ])
            ->setFormData($info)
            ->fetch();
    }

    public function images_delete($id = null){
        if($id <= 0){
            return $this->error("id不正确");
        }
        $ret = Db::table("xh_images")->where("id = $id")->delete();
        if($ret > 0){
            return $this->success("删除成功");
        }

        return $this->error("删除失败");
    }

    public function articlelist(){

        // 数据列表
        $data_list = Db::table("xh_article")->where()->order("id desc")->paginate();

        // 分页数据
        $page = $data_list->render();

        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->hideCheckbox()
            ->setPageTitle('文章列表') // 设置页面标题
            ->addColumns([ // 批量添加列
                ['id', 'ID'],
                ['title', '标题'],
                ['createTime', '添加时间'],
            ])
            ->addColumns([
                ['right_button', '操作', 'btn']
            ])
            ->addTopButton('add', ['href' => url('article_edit' )]) // 批量添加顶部按钮
            ->addRightButton('edit', ['href' => url('article_edit', ['id' => '__id__'])]) // 批量添加右侧按钮
            ->addRightButton('delete', ['href' => url('article_delete', ['id' => '__id__'])])
            ->setRowList($data_list) // 设置表格数据
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染页面
    }

    public function article_edit($id = null)
    {
        // 保存数据
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $data['createTime'] = date("Y-m-d H:i:s");

            if($id > 0){
                $ret = Db::table("xh_article")->where("id=$id")->update($data);
            }else{
                $ret = Db::table("xh_article")->insertGetId($data);
            }


            if ($ret > 0) {
                // 记录行为
                action_log('article_edit', 'admin_role', $id, UID, $data['name']);
                return $this->success('编辑成功', url('articlelist'));
            } else {
                return $this->error('编辑失败');
            }
        }

        // 获取数据
        if( $id > 0){
            $info       = Db::table("xh_article")->where("id=$id")->find();
            $this->assign('info', $info);
        }

        // 使用ZBuilder快速创建表单
        return ZBuilder::make('form')
            ->addFormItems([
                ['text', 'title', '文章标题'],
            ])
            ->addUeditor('content', '文章内容')
            ->setFormData($info)
            ->fetch();
    }

    public function article_delete($id = null){
        if($id <= 0){
            return $this->error("id不正确");
        }
        $ret = Db::table("xh_article")->where("id = $id")->delete();
        if($ret > 0){
            return $this->success("删除成功");
        }

        return $this->error("删除失败");
    }



}