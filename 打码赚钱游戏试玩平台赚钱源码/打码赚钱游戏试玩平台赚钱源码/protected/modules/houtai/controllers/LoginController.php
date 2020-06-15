<?php

class LoginController extends Controller {

    

    //登录
    function actionShow() {
        $admin = Yii::app()->admin->name;
        if ($admin == "Guest") {
            $account_login = new AccountLoginForm();
            if (isset($_POST['AccountLoginForm'])) {
                $account_login->attributes = $_POST['AccountLoginForm'];
                if ($account_login->validate() && $account_login->login()) {
                    $account_info = Account::model()->find('username=:username', array(':username' => $account_login['username']));
                    ini_set('session.gc_maxlifetime', 3600); //设置时间1小时
                    Yii::app()->session->add('account', $account_info);
                    $this->redirect(SITE_URL . 'houtai/welcome/show');
                }
            }
            $this->render("show", array('account_login' => $account_login));
        } else {
            $this->redirect(SITE_URL . 'houtai/welcome/show');
        }
    }

    /*
     * 退出系统
     */

    function actionLogout() {
        Yii::app()->admin->logout($destroySession = FALSE);
        $this->redirect(SITE_URL . 'houtai/login/show');
    }

//租房
    function actionHouse() {

        $this->renderPartial('house');
    }

//承包方
    function actionLoupan() {

        $this->renderPartial('loupan');
    }

    function actionEdit() {

        $this->renderPartial('edit');
    }

}
