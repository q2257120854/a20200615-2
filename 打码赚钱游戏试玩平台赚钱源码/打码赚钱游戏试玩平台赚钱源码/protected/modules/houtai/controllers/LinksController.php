<?php

/*
 * 友情链接
 */

class LinksController extends Controller {

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
        $sql = "SELECT * FROM {{links}} where 1=1";
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
        $links_model = new Links();
        if (isset($_POST['Links'])) {
            foreach ($_POST['Links'] as $_k => $_v) {
                $links_model->$_k = strip_tags($_v);
            }
            if ($links_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('links_model' => $links_model, 'result' => $result));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $links_model = Links::model();
        $links_info = $links_model->findByPk($id);
        if (isset($_POST['Links'])) {
            foreach ($_POST['Links'] as $_k => $_v) {
                $links_info->$_k = strip_tags($_v);
            }
            if ($links_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('links_model' => $links_info, 'result' => $result));
    }

    /*
     * 删除
     */

    function actionDel($id) {
        $links_model = Links::model();
        $links_info = $links_model->findByPk($id);
        if ($links_info->delete()) {
            Yii::app()->user->setFlash('msg', '删除成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $links_model = Links::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $links_info = $links_model->findByPk($id);
            if ($links_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
