<?php

/*
 * 合作商家
 */

class BusinessController extends Controller {

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
        $sql = "SELECT * FROM {{business}} where 1=1";
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
        $business_model = new Business();
        if (isset($_POST['Business'])) {
            foreach ($_POST['Business'] as $_k => $_v) {
                $business_model->$_k = strip_tags(trim($_v));
            }

            $file = CUploadedFile::getInstance($business_model, 'img');
            if ($file) {
                $newthumb = 'hlz_' . time() . '_' . rand(1, 9999) . '.' . $file->extensionName;
                $file->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/business/' . $newthumb, FALSE);
                $business_model->img = $newthumb;
            }
            if ($business_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('business_model' => $business_model, 'result' => $result));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $business_model = Business::model();
        $business_info = $business_model->findByPk($id);
        if (isset($_POST['Business'])) {
            foreach ($_POST['Business'] as $_k => $_v) {
                $business_info->$_k = strip_tags(trim($_v));
            }

            $file = CUploadedFile::getInstance($business_info, 'img');
            if ($file) {
                $newthumb = 'hlz_' . time() . '_' . rand(1, 9999) . '.' . $file->extensionName;
                $file->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/business/' . $newthumb, FALSE);
                $business_info->img = $newthumb;
            } else {
                $business_info->img = $_POST['hideimg'];
            }
            if ($business_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('business_model' => $business_info, 'result' => $result));
    }

    /*
     * 删除
     */

    function actionDel($id) {
        $business_model = Business::model();
        $business_info = $business_model->findByPk($id);
        unlink(Yii::getPathOfAlias('webroot') . "/uploads/img/business/" . $business_info['img']);
        if ($business_info->delete()) {
            Yii::app()->user->setFlash('msg', '删除成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $business_model = Business::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $business_info = $business_model->findByPk($id);
            unlink(Yii::getPathOfAlias('webroot') . "/uploads/img/business/" . $business_info['img']);
            if ($business_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
