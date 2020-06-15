<?php

/*
 * 51猜猜
 */

class GuessingController extends Controller {

    /*
     * 展示
     */

    function actionShow() {
           $this->renderPartial('show');
    }

    /*
     * 添加
     */

    function actionAdd() {
        $messagetype_model = Messagetype::model();
        $messagetype_info = $messagetype_model->findAll();
        $megarray = array();
        foreach ($messagetype_info as $mesgtype) {
            $megarray[$mesgtype['id']] = $mesgtype['name'];
        }
        $message_model = new Message();
        if (isset($_POST['Message'])) {
            foreach ($_POST['Message'] as $_k => $_v) {
                $message_model->$_k = strip_tags($_v);
            }
            if ($message_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('message_model' => $message_model, 'result' => $result, 'megarray' => $megarray));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $messagetype_model = Messagetype::model();
        $messagetype_info = $messagetype_model->findAll();
        $megarray = array();
        foreach ($messagetype_info as $mesgtype) {
            $megarray[$mesgtype['id']] = $mesgtype['name'];
        }

        $message_model = Message::model();
        $message_info = $message_model->findByPk($id);
        if (isset($_POST['Message'])) {
            foreach ($_POST['Message'] as $_k => $_v) {
                $message_info->$_k = strip_tags($_v);
            }
            if ($message_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('message_model' => $message_info, 'result' => $result, 'megarray' => $megarray));
    }

    /*
     * 删除
     */

    function actionDel($id) {
        $message_model = Message::model();
        $message_info = $message_model->findByPk($id);
        if ($message_info->delete()) {
            Yii::app()->user->setFlash('msg', '删除成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $message_model = Message::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $message_info = $message_model->findByPk($id);
            if ($message_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
