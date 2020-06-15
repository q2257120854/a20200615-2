<?php

class WebUser extends CWebUser {

    //会员登录
    function isLogin() {
        $user = Yii::app()->user->name;
        if ($user != 'Guest') {
            return 1;
        } else {
           return 0;
        }
    }

}
