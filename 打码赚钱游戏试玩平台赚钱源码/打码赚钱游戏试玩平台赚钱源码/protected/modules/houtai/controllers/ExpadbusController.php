<?php

/*
 * 体验商家
 */

class ExpadbusController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show', 'add', 'edit'),
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
        $sql = "SELECT * FROM {{exp_ad_bus}} where 1=1";
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
        $pages->params = array('name' => $name);
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
        $expadbus_model = new Expadbus();
        if (isset($_POST['Expadbus'])) {
            foreach ($_POST['Expadbus'] as $_k => $_v) {
                $expadbus_model->$_k = strip_tags(trim($_v));
            }
            $expadbus_model->cid = time();
            if ($expadbus_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('expadbus_model' => $expadbus_model, 'result' => $result));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $expadbus_model = Expadbus::model();
        $expadbus_info = $expadbus_model->findByPk($id);
        if (isset($_POST['Expadbus'])) {
            foreach ($_POST['Expadbus'] as $_k => $_v) {
                $expadbus_info->$_k = strip_tags(trim($_v));
            }
            if ($expadbus_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('expadbus_model' => $expadbus_info, 'result' => $result));
    }

}
