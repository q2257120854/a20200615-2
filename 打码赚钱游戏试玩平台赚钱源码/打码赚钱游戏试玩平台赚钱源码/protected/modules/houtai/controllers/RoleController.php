<?php

/*
 * 权限设置
 */

class RoleController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户执行admin,delete动作
                'actions' => array('show', 'add', 'edit', 'permission', 'setpermission'),
                'expression' => 'Yii::app()->admin->isAdmin()',
          
            ),
            array(
                'deny', //禁止
                'users' => array('*'), //*所有用户都不能访问
            ),
        );
    }

    /*
     * 角色
     */

    function actionShow() {
        $role_models = Role::model();
        $sql = "SELECT * FROM {{role}} where 1=1";
        $sb = '';
        $name = null;
        if (isset($_GET['name']) || isset($_POST['name'])) {
            if (!empty($_POST['name'])) {
                $name = $_POST['name'];
            } else if (!empty($_GET['name'])) {
                $name = $_GET['name'];
            }
            $sb = $sb . " and name like '%" . $name . "%' ";
        }


        $sql = $sql . $sb . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        if (!empty($name)) {
            $pages->params = array('name' => $name);
        }
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->render('show', array('posts' => $posts, 'pages' => $pages));
    }

    /*
     * 添加角色
     */

    function actionAdd() {
        $role_model = new Role();
        if (isset($_POST['Role'])) {
            foreach ($_POST['Role'] as $_k => $_v) {
                $role_model->$_k = strip_tags($_v);
            }
            if ($role_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('role_model' => $role_model, 'result' => $result));
    }

    /*
     * 修改角色
     */

    function actionEdit($id) {
        $role_model = Role::model();
        $role_info = $role_model->findByPk($id);
        if (isset($_POST['Role'])) {
            foreach ($_POST['Role'] as $_k => $_v) {
                $role_info->$_k = strip_tags($_v);
            }
            if ($role_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('role_model' => $role_info, 'result' => $result));
    }

    /*
     * 权限
     */

    function actionPermission($id, $ids) {
        $menu_model = Menu::model();
        $sql = "select * from {{menu}} where resourcegrade !=2";
        $menu_info = $menu_model->findAllBySql($sql);
        $role_model = Role::model();
        $role_info = $role_model->findByPk($id);
        $rolemenu_model = Rolemenu::model();
        $sql1 = "select * from {{role_menu}} where role_id =" . $id;
        $rolemenu_info = $rolemenu_model->findAllBySql($sql1);
        if (!empty($ids)) {
            foreach ($rolemenu_info as $model) {
                if ($model['role_id'] == $id) {
                    $model->delete();
                }
            }
            $arr = explode(",", $ids);
            foreach ($arr as $menuid) {
                $rolemenu_models = new Rolemenu();
                $rolemenu_models->role_id = $id;
                $rolemenu_models->menu_id = $menuid;
                $rolemenu_models->save();
            }
            foreach ($arr as $menuid) {
                $num = $rolemenu_model->count("role_id =:role_id ", array('role_id' => $id));
                $menu_infos = $menu_model->findByPk($menuid);
                $i = 0;
                foreach ($rolemenu_info as $rolemenuinfo) {
                    ++$i;
                    if ($menu_infos['parentid'] == $rolemenuinfo['menu_id']) {
                        break;
                    }
                    if ($i == $num) {
                        $rolemenu_models = new Rolemenu();
                        $rolemenu_models->role_id = $id;
                        $rolemenu_models->menu_id = $menu_infos['parentid'];
                        $rolemenu_models->save();
                    }
                }
            }
            $result = "success";
            Yii::app()->user->setFlash('msg', '权限保存成功');
        }
        $this->renderPartial('permission', array('role_info' => $role_info, 'menu_info' => $menu_info, 'rolemenu_info' => $rolemenu_info, 'result' => $result));
    }

}
