<?php

/*
 * 广告管理
 */

class AdController extends Controller {
    
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
        $sql = "SELECT * FROM {{ad}} where 1=1";
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
        $adtype_model = Adtype::model();
        $adtype_info = $adtype_model->findAll();
        $adarray = array();
        foreach ($adtype_info as $adtype) {
            $adarray[$adtype['id']] = $adtype['name'];
        }
        $ad_model = new Ad();
        if (isset($_POST['Ad'])) {
            foreach ($_POST['Ad'] as $_k => $_v) {
                $ad_model->$_k = strip_tags(trim($_v));
            }
             $file = CUploadedFile::getInstance($ad_model, 'img');
            if ($file) {
                $newthumb = 'hlz_' . time() . '_' . rand(1, 9999) . '.' . $file->extensionName;
                $file->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/ad/' . $newthumb, FALSE);
                $ad_model->img = $newthumb;
            }
            if ($ad_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('ad_model' => $ad_model, 'result' => $result, 'adarray' => $adarray));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $adtype_model = Adtype::model();
        $adtype_info = $adtype_model->findAll();
        $adarray = array();
        foreach ($adtype_info as $adtype) {
            $adarray[$adtype['id']] = $adtype['name'];
        }

        $ad_model = Ad::model();
        $ad_info = $ad_model->findByPk($id);
        if (isset($_POST['Ad'])) {
            foreach ($_POST['Ad'] as $_k => $_v) {
                $ad_info->$_k = strip_tags(trim($_v));
            }

            $file = CUploadedFile::getInstance($ad_info, 'img');
            if ($file) {
                $newthumb = 'hlz_' . time() . '_' . rand(1, 9999) . '.' . $file->extensionName;
                $file->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/ad/' . $newthumb, FALSE);
                $ad_info->img = $newthumb;
            } else {
                $ad_info->img = $_POST['hideimg'];
            }
            if ($ad_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('ad_model' => $ad_info, 'result' => $result, 'adarray' => $adarray));
    }

    /*
     * 删除
     */

    function actionDel($id) {
        $ad_model = Ad::model();
        $ad_info = $ad_model->findByPk($id);
        unlink(Yii::getPathOfAlias('webroot') . "/uploads/img/ad/" . $ad_info['img']);
        if ($ad_info->delete()) {
            Yii::app()->user->setFlash('msg', '删除成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $ad_model = Ad::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $ad_info = $ad_model->findByPk($id);
            unlink(Yii::getPathOfAlias('webroot') . "/uploads/img/ad/" . $ad_info['img']);
            if ($ad_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
