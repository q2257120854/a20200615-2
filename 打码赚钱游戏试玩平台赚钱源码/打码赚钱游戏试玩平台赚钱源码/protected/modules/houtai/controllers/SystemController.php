<?php

/*
 * 系统设置
 */

class SystemController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show'),
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
        $system_model = System::model();
        $system_info = $system_model->findByPk(1);
        if (isset($_POST['System'])) {
            foreach ($_POST['System'] as $_k => $_v) {
                $system_info->$_k = strip_tags($_v);
            }
            if ($system_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
            }
        }
        $this->render('show', array('system_model' => $system_info));
    }

}
