<?php

/*
 * 广告类型
 */

class AdtypeController extends Controller {

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
        $adtype_model = Adtype::model();
        $sql = "SELECT * FROM {{ad_type}} where 1=1";
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
        $adtype_model = new Adtype();
        if (isset($_POST['Adtype'])) {
            foreach ($_POST['Adtype'] as $_k => $_v) {
                $adtype_model->$_k = strip_tags($_v);
            }
            if ($adtype_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('adtype_model' => $adtype_model, 'result' => $result));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $adtype_model = Adtype::model();
        $adtype_info = $adtype_model->findByPk($id);
        if (isset($_POST['Adtype'])) {
            foreach ($_POST['Adtype'] as $_k => $_v) {
                $adtype_info->$_k = strip_tags($_v);
            }
            if ($adtype_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('adtype_model' => $adtype_info, 'result' => $result));
    }

    /*
     * 删除
     */

    function actionDel($id) {
        $adtype_model = Adtype::model();
        $adtype_info = $adtype_model->findByPk($id);
        if ($adtype_info->delete()) {
            Yii::app()->user->setFlash('msg', '删除成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $adtype_model = Adtype::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $adtype_info = $adtype_model->findByPk($id);
            if ($adtype_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
