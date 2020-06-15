<?php

/*
 * 账号管理
 */

class AccountController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是Administrator的用户
                'actions' => array('off', "on", 'add', 'show', 'edit', 'alldel'),
                'expression' => 'Yii::app()->admin->isAdmin()',
            ),
            array(
                'deny', //禁止
                'users' => array('*'), //*所有用户
            ),
        );
    }

    /*
     * 展示
     */

    function actionShow() {
        $sql = "SELECT * FROM {{account}} where 1=1 ";
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
     * 禁用
     */

    function actionOff($id) {
        $account_model = Account::model();
        $account_info = $account_model->findByPk($id);
        $account_info->valid = 1;
        if ($account_info->update()) {
            Yii::app()->user->setFlash('msg', '禁用成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 启用
     */

    function actionOn($id) {
        $account_model = Account::model();
        $account_info = $account_model->findByPk($id);
        $account_info->valid = 0;
        if ($account_info->update()) {
            Yii::app()->user->setFlash('msg', '启用成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 添加
     */

    function actionAdd() {
        $account_model = new Account();
        if (isset($_POST['Account'])) {
            foreach ($_POST['Account'] as $_k => $_v) {
                $account_model->$_k = strip_tags($_v);
            }
            $account_model->password = md5($account_model['password']);
            $account_model->password2 = md5($account_model['password2']);
            if ($account_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('account_model' => $account_model, 'result' => $result));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $account_model = Account::model();
        $account_info = $account_model->findByPk($id);
        $account_infos = $account_model->findByPk($id);
        if (isset($_POST['Account'])) {
            foreach ($_POST['Account'] as $_k => $_v) {
                $account_info->$_k = strip_tags($_v);
            }
            if (!empty($_POST['Account']['password']) && !empty($_POST['Account']['password2'])) {
                $account_info->password = md5($_POST['Account']['password']);
                $account_info->password2 = md5($_POST['Account']['password2']);
            }else {
                $account_info->password = $account_infos["password"];
                $account_info->password2 = $account_infos["password"];
            }
            if ($account_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('account_model' => $account_info, 'result' => $result));
    }

    /*
     * 删除
     */

    function actionDel($id) {
        $account_model = Account::model();
        $account_info = $account_model->findByPk($id);
        if ($account_info->delete()) {
            Yii::app()->user->setFlash('msg', '删除成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $account_model = Account::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $account_info = $account_model->findByPk($id);
            if ($account_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
