<?php

/*
 * 体验广告管理
 */

class ExpadController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show', 'add', 'edit', 'del'),
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
        $sql = "SELECT * FROM {{exp_ad}} where 1=1";
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
        $expadtype_model = Expadtype::model();
        $expadtype_info = $expadtype_model->findAll();
        $expadarray = array();
        foreach ($expadtype_info as $expadtype) {
            $expadarray[$expadtype['id']] = $expadtype['name'];
        }
        $expadbus_model = Expadbus::model();
        $expadbus_info = $expadbus_model->findAll();
        $expadbusarray = array();
        foreach ($expadbus_info as $expadbusinfo) {
            $expadbusarray[$expadbusinfo['id']] = $expadbusinfo['name'];
        }
        $expad_model = new Expad();
        if (isset($_POST['Expad'])) {
            foreach ($_POST['Expad'] as $_k => $_v) {
                $expad_model->$_k = $_v;
            }
            $expad_model->cid = $expadbus_model->findByPk($expad_model["bustype"])->cid;
            $file = CUploadedFile::getInstance($expad_model, 'img');
            if ($file) {
                $newthumb = 'hlz_' . time() . '_' . rand(1, 9999) . '.' . $file->extensionName;
                $file->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/expad/' . $newthumb, FALSE);
                $expad_model->img = $newthumb;
            }
            $file2 = CUploadedFile::getInstance($expad_model, 'image');
            if ($file2) {
                $newthumb2 = 'hlz_' . time() . '_' . rand(1, 9999) . '.' . $file2->extensionName;
                $file2->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/expad/' . $newthumb2, FALSE);
                $expad_model->image = $newthumb2;
            }
            if ($expad_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->render('add', array('expad_model' => $expad_model, 'result' => $result, 'expadarray' => $expadarray, "expadbusarray" => $expadbusarray));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $expadtype_model = Expadtype::model();
        $expadtype_info = $expadtype_model->findAll();
        $expadarray = array();
        foreach ($expadtype_info as $expadtype) {
            $expadarray[$expadtype['id']] = $expadtype['name'];
        }
        $expadbus_model = Expadbus::model();
        $expadbus_info = $expadbus_model->findAll();
        $expadbusarray = array();
        foreach ($expadbus_info as $expadbusinfo) {
            $expadbusarray[$expadbusinfo['id']] = $expadbusinfo['name'];
        }
        $expad_model = Expad::model();
        $expad_info = $expad_model->findByPk($id);
        if (isset($_POST['Expad'])) {
            foreach ($_POST['Expad'] as $_k => $_v) {
                $expad_info->$_k = $_v;
            }
            $expad_info->cid = $expadbus_model->findByPk($expad_info["bustype"])->cid;
            $file = CUploadedFile::getInstance($expad_info, 'img');
            if ($file) {
                $newthumb = 'hlz_' . time() . '_' . rand(1, 9999) . '.' . $file->extensionName;
                $file->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/expad/' . $newthumb, FALSE);
                $expad_info->img = $newthumb;
            } else {
                $expad_info->img = $_POST['hideimg'];
            }
            $file2 = CUploadedFile::getInstance($expad_info, 'image');
            if ($file2) {
                $newthumb2 = 'hlz_' . time() . '_' . rand(1, 9999) . '.' . $file2->extensionName;
                $file2->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/expad/' . $newthumb2, FALSE);
                $expad_info->image = $newthumb2;
            } else {
                $expad_info->image = $_POST['hideimage'];
            }
            if ($expad_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->render('edit', array('expad_model' => $expad_info, 'result' => $result, 'expadarray' => $expadarray, "expadbusarray" => $expadbusarray));
    }

    /*
     * 删除
     */

    function actionDel($id) {
        $expad_model = Expad::model();
        $expad_info = $expad_model->findByPk($id);
        if (!empty($expad_info['img'])) {
            unlink(Yii::getPathOfAlias('webroot') . "/uploads/img/expad/" . $expad_info['img']);
        }
        if (!empty($expad_info['image'])) {
            unlink(Yii::getPathOfAlias('webroot') . "/uploads/img/expad/" . $expad_info['image']);
        }
        $count = $expad_model->countBySql("select count(*) from {{exp_ad_zm}} where exp_ad_id=" . $id);
        if (empty($count)) {
            if ($expad_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
                $this->redirect("../../show");
            }
        } else {
            Yii::app()->user->setFlash('msg', '玩家正在体验,不能删除！');
            $this->redirect("../../show");
        }
    }

}
