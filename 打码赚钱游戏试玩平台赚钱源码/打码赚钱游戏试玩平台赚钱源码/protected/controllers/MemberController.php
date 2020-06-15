<?php

/*
 * 会员中心
 */

class MemberController extends Controller {

   
    /*
     * 客服登录
     */

    function actionLogin() {
          $this->renderPartial('show');
    }
    
    /*
     * 欢迎页面
     */

    function actionWelcome() {
        
        $this->renderPartial("welcome"); //调用视图,此方法渲染布局
    }
    
    /*
     * 退出系统
     */

    function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect("./welcome");
    }

}
