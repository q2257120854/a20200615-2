<?php

/*
 * 奖品类型
 */

class GifttypeController extends Controller {

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
        $req = Yii::app()->db->createCommand("SELECT create_time,id, name,pid FROM {{gift_type}} GROUP BY id");
        $data = $req->queryAll();
        //var_dump($data);
        $this->render('show', array('data' => $data));
    }

    /*
     * 添加
     */

    function actionAdd() {
        $req = Yii::app()->db->createCommand("SELECT id, name,pid FROM {{gift_type}}  GROUP BY id");
        $data = $req->queryAll();
        $gifttype_model = new Gifttype();
        if (isset($_POST['Gifttype'])) {
            foreach ($_POST['Gifttype'] as $_k => $_v) {
                $gifttype_model->$_k = strip_tags($_v);
            }
            if (empty($_POST['pid'])) {
                $gifttype_model->pid = 0;
            } else {
                $gifttype_model->pid = $_POST['pid'];
            }
            if ($gifttype_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('gifttype_model' => $gifttype_model, 'data' => $data, 'result' => $result));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $req = Yii::app()->db->createCommand("SELECT id, name,pid FROM {{gift_type}}  GROUP BY id");
        $data = $req->queryAll();
        $gifttype_model = Gifttype::model();
        $gifttype_info = $gifttype_model->findByPk($id);
        if (isset($_POST['Gifttype'])) {
            foreach ($_POST['Gifttype'] as $_k => $_v) {
                $gifttype_info->$_k = strip_tags($_v);
            }
            $gifttype_model->pid = $_POST['pid'];
            if ($gifttype_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $this->redirect(SITE_URL . 'houtai/gifttype/show');
            }
        }
        $this->renderPartial('edit', array('gifttype_model' => $gifttype_info, 'data' => $data));
    }

    /*
     * 删除
     */

    function actionDel($id) {
        if (empty($_GET['start'])) {
            $this->redirect(SITE_URL . 'houtai/gifttype/show/start/' . $id);
        } else {
            $gifttype_model = Gifttype::model();
            $num = $gifttype_model->count("pid =:pid ", array('pid' => $id));
            if ($num == 0) {
                $gifttype_info = $gifttype_model->findByPk($id);
                if ($gifttype_info->delete()) {
                    Yii::app()->user->setFlash('msg', '删除成功');
                    $this->redirect(SITE_URL . 'houtai/gifttype/show');
                }
            } else {
                Yii::app()->user->setFlash('msg', '存在下级分类，不能删除');
                $this->redirect(SITE_URL . 'houtai/gifttype/show');
            }
        }
    }

}
