<?php

/*
 * 帮助中心
 */

class HelpController extends Controller {

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
        $help_model = Help::model();
        $sql = "SELECT * FROM {{help}} where 1=1";
        $sb = '';
        $quiz = null;
        if (isset($_GET['quiz']) || isset($_POST['quiz'])) {
            if (!empty($_POST['quiz'])) {
                $quiz = $_POST['quiz'];
            } else if (!empty($_GET['quiz'])) {
                $quiz = $_GET['quiz'];
            }
            $sb = $sb . " and quiz like '%" . $quiz . "%' ";
        }
        $sql = $sql . $sb . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        if (!empty($quiz)) {
            $pages->params = array('quiz' => $quiz);
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
        $helptype_model = Helptype::model();
        $helptype_info = $helptype_model->findAll();
        $helparray = array();
        foreach ($helptype_info as $helptype) {
            $helparray[$helptype['id']] = $helptype['name'];
        }
        $help_model = new Help();
        if (isset($_POST['Help'])) {
            foreach ($_POST['Help'] as $_k => $_v) {
                $help_model->$_k = $_v;
            }
            if ($help_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('help_model' => $help_model, 'result' => $result, 'helparray' => $helparray));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $helptype_model = Helptype::model();
        $helptype_info = $helptype_model->findAll();
        $helparray = array();
        foreach ($helptype_info as $helptype) {
            $helparray[$helptype['id']] = $helptype['name'];
        }
        $help_model = Help::model();
        $help_info = $help_model->findByPk($id);
        if (isset($_POST['Help'])) {
            foreach ($_POST['Help'] as $_k => $_v) {
                $help_info->$_k = $_v;
            }
            if ($help_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('help_model' => $help_info, 'result' => $result, 'helparray' => $helparray));
    }

    /*
     * 删除
     */

    function actionDel($id) {
        $help_model = Help::model();
        $help_info = $help_model->findByPk($id);
        if ($help_info->delete()) {
            Yii::app()->user->setFlash('msg', '删除成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $help_model = Help::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $help_info = $help_model->findByPk($id);
            if ($help_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
