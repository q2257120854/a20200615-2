<?php

/*
 * 奖品管理
 */

class GiftController extends Controller {

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
        $sql = "SELECT * FROM {{gift}} where 1=1";
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
        $req = Yii::app()->db->createCommand("SELECT id, name,pid FROM {{gift_type}}  GROUP BY id");
        $data = $req->queryAll();
        $gift_model = new Gift();
        if (isset($_POST['Gift'])) {
            foreach ($_POST['Gift'] as $_k => $_v) {
                $gift_model->$_k = $_v;
            }
            $gift_model->gift_type_id = $_POST["Gifttype"]["pid"];
            $file = CUploadedFile::getInstance($gift_model, 'img');
            if ($file) {
                $newthumb = 'hlz_' . time() . '_' . rand(1, 9999) . '.' . $file->extensionName;
                $file->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/gift/' . $newthumb, FALSE);
                $gift_model->img = $newthumb;
            }
            if ($gift_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('gift_model' => $gift_model, 'result' => $result, 'data' => $data));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $req = Yii::app()->db->createCommand("SELECT id, name,pid FROM {{gift_type}}  GROUP BY id");
        $data = $req->queryAll();
        $gift_model = Gift::model();
        $gift_info = $gift_model->findByPk($id);
        if (isset($_POST['Gift'])) {
            foreach ($_POST['Gift'] as $_k => $_v) {
                $gift_info->$_k = $_v;
            }
            $gift_info->gift_type_id = $_POST["Gifttype"]["pid"];
            
            $file = CUploadedFile::getInstance($gift_info, 'img');
            if ($file) {
                $newthumb = 'hlz_' . time() . '_' . rand(1, 9999) . '.' . $file->extensionName;
                $file->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/gift/' . $newthumb, FALSE);
                $gift_info->img = $newthumb;
            } else {
                $gift_info->img = $_POST['hideimg'];
            }
            if ($gift_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('gift_model' => $gift_info, 'result' => $result, 'data' => $data));
    }

    /*
     * 删除
     */

    function actionDel($id) {
        $gift_model = Gift::model();
        $gift_info = $gift_model->findByPk($id);
        unlink(Yii::getPathOfAlias('webroot') . "/uploads/img/gift/" . $gift_info['img']);
        unlink(Yii::getPathOfAlias('webroot') . "/uploads/img/gift/" . $gift_info['image']);
        if ($gift_info->delete()) {
            Yii::app()->user->setFlash('msg', '删除成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $gift_model = Gift::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $gift_info = $gift_model->findByPk($id);
            unlink(Yii::getPathOfAlias('webroot') . "/uploads/img/gift/" . $gift_info['img']);
            unlink(Yii::getPathOfAlias('webroot') . "/uploads/img/gift/" . $gift_info['image']);
            if ($gift_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
