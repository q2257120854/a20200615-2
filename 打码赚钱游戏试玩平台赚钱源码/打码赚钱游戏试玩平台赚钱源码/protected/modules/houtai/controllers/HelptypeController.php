<?php

/*
 * 帮助类型
 */

class HelptypeController extends Controller {

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
        $sql = "SELECT * FROM {{help_type}} where 1=1";
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
        $helptype_model = new Helptype();
        if (isset($_POST['Helptype'])) {
            foreach ($_POST['Helptype'] as $_k => $_v) {
                $helptype_model->$_k = strip_tags($_v);
            }
            if ($helptype_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('helptype_model' => $helptype_model, 'result' => $result));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $helptype_model = Helptype::model();
        $helptype_info = $helptype_model->findByPk($id);
        if (isset($_POST['Helptype'])) {
            foreach ($_POST['Helptype'] as $_k => $_v) {
                $helptype_info->$_k = strip_tags($_v);
            }
            if ($helptype_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('helptype_model' => $helptype_info, 'result' => $result));
    }

    /*
     * 删除
     */

    function actionDel($id) {
        $helptype_model = Helptype::model();
        $helptype_info = $helptype_model->findByPk($id);
        if ($helptype_info->delete()) {
            Yii::app()->user->setFlash('msg', '删除成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $helptype_model = Helptype::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $helptype_info = $helptype_model->findByPk($id);
            if ($helptype_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
