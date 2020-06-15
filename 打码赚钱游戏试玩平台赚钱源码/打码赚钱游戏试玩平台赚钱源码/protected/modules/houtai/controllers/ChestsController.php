<?php

/*
 * 宝箱管理
 */

class ChestsController extends Controller {

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
        $sql = "SELECT * FROM {{chests}} ";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
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
        $chests_model = new Chests();
        if (isset($_POST['Chests'])) {
            foreach ($_POST['Chests'] as $_k => $_v) {
                $chests_model->$_k = strip_tags(trim($_v));
            }
            if ($chests_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('chests_model' => $chests_model, 'result' => $result));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $chests_model = new Chests();
        $chests_info = $chests_model->findByPk($id);
        if (isset($_POST['Chests'])) {
            foreach ($_POST['Chests'] as $_k => $_v) {
                $chests_info->$_k = strip_tags(trim($_v));
            }
            if ($chests_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('chests_model' => $chests_info, 'result' => $result));
    }
   

}
