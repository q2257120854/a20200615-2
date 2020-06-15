<?php

/*
 * 资讯类型
 */

class MessagetypeController extends Controller {

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
        $sql = "SELECT * FROM {{message_type}} where 1=1";
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
        $messagetype_model = new Messagetype();
        if (isset($_POST['Messagetype'])) {
            foreach ($_POST['Messagetype'] as $_k => $_v) {
                $messagetype_model->$_k = strip_tags($_v);
            }
            if ($messagetype_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('messagetype_model' => $messagetype_model, 'result' => $result));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $messagetype_model = Messagetype::model();
        $messagetype_info = $messagetype_model->findByPk($id);
        if (isset($_POST['Messagetype'])) {
            foreach ($_POST['Messagetype'] as $_k => $_v) {
                $messagetype_info->$_k = strip_tags($_v);
            }
            if ($messagetype_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('messagetype_model' => $messagetype_info, 'result' => $result));
    }

    /*
     * 删除
     */

    function actionDel($id) {
        $messagetype_model = Messagetype::model();
        $messagetype_info = $messagetype_model->findByPk($id);
        if ($messagetype_info->delete()) {
            Yii::app()->user->setFlash('msg', '删除成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $messagetype_model = Messagetype::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $messagetype_info = $messagetype_model->findByPk($id);
            if ($messagetype_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
