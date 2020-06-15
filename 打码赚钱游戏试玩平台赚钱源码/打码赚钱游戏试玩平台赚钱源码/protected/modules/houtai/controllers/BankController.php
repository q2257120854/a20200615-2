<?php

/*
 * 银行管理
 */

class BankController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show', 'add', 'edit', 'del', 'alldel'),
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
        $sql = "SELECT * FROM {{bank}} where 1=1";
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
     * 添加
     */

    function actionAdd() {
        $bank_model = new Bank();
        if (isset($_POST['Bank'])) {
            foreach ($_POST['Bank'] as $_k => $_v) {
                $bank_model->$_k = strip_tags(trim($_v));
            }
            if ($bank_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('bank_model' => $bank_model, 'result' => $result));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $bank_model = Bank::model();
        $bank_info = $bank_model->findByPk($id);
        if (isset($_POST['Bank'])) {
            foreach ($_POST['Bank'] as $_k => $_v) {
                $bank_info->$_k = strip_tags(trim($_v));
            }
            if ($bank_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('bank_model' => $bank_info, 'result' => $result));
    }

    /*
     * 删除
     */

    function actionDel($id) {
        $bank_model = Bank::model();
        $bank_info = $bank_model->findByPk($id);
        unlink(Yii::getPathOfAlias('webroot') . "/uploads/img/" . $bank_info['img']);
        if ($bank_info->delete()) {
            Yii::app()->user->setFlash('msg', '删除成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $bank_model = Bank::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $bank_info = $bank_model->findByPk($id);
            unlink(Yii::getPathOfAlias('webroot') . "/uploads/img/" . $bank_info['img']);
            if ($bank_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
