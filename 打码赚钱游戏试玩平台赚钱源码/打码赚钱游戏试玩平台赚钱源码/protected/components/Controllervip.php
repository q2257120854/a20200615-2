<?php

//

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controllervip extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/index';
    //public $layout='//layouts/shop';//自定义布局文件
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    /*
     * 动态缓存回调函数，因此前边没有action 关键字
     */

    //当前访问的地址
    function show_url() {
        return Yii::app()->request->getUrl();
    }

    //username
    function show_name() {
        return Yii::app()->user->name;
    }

    //管理员登陆
    function admin_name() {
        return Yii::app()->admin->name;
    }

    //显示会员名称
    function show_mem_name() {
        $mem_info = Mem::model()->find("email=:email", array(":email" => Yii::app()->user->name));
        return $mem_info['mem_name'];
    }

    //获得登录会员
    function show_mem() {
        $mem_info = Mem::model()->find("email=:email", array(":email" => Yii::app()->user->name));
        return $mem_info;
    }

    //获得登录会员id
    function show_mem_id() {
        $mem_info = Mem::model()->find("email=:email", array(":email" => Yii::app()->user->name));
        return $mem_info['id'];
    }



    function show_menu($id) {
        $menu_model = Menu::model();
        $menu_info = $menu_model->findByPk($id);
        return $menu_info;
    }
    
    
    //操作元宝
    function updhlb($hlb, $source, $content, $memid, $pmemid) {
        if (!empty($hlb)) {
            $hlb_model = new Hlb();
            $hlb_model->hlb = $hlb;
            $hlb_model->source = $source; //消耗元宝来源--提现
            $hlb_model->reason = $content; //元宝更改原因
            if ($hlb >= 0) {
                $hlb_model->type = 1; //增加元宝
            } else {
                $hlb_model->type = 2; //扣除元宝
            }
            $hlb_model->mem_id = $memid;
            $hlb_model->pmem_id = $pmemid;
            $hlb_model->save();
            return $hlb_model;
        } else {
            return 0;
        }
    }

    //操作金豆
    function updhld($hld, $source, $content, $memid) {
        if (!empty($hld)) {
            $hld_model = new Hld();
            $hld_model->hld = $hld;
            $hld_model->source = $source; //消耗元宝来源--提现
            $hld_model->reason = $content; //元宝更改原因
            if ($hld >= 0) {
                $hld_model->type = 1; //增加金豆
            } else {
                $hld_model->type = 2; //扣除金豆
            }
            $hld_model->mem_id = $memid;
            $hld_model->save();
            return $hld_model;
        } else {
            return 0;
        }
    }


    //发送消息
    function sendmessage($title, $content, $vipmessagetype, $memid) {
        $vipmessage_model = new Vipmessage();
        $vipmessage_model->title = $title; //标题
        $vipmessage_model->content = $content; //内容
        $vipmessage_model->vipmessage_type = $vipmessagetype; //消息类型 系统消息1  官方消息2
        $vipmessage_model->mem_id = $memid; //会员id
        $vipmessage_model->is_read = 0; //是否阅读 0未阅读，1阅读
        $vipmessage_model->save();
    }

}
