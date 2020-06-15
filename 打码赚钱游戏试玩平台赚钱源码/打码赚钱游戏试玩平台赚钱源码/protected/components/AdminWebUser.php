<?php

class AdminWebUser extends CWebUser {

    //管理员登陆
    function isAdmin() {
        $admin = Yii::app()->admin->name;
        if ($admin != 'Guest') {
            return 1;
        } else {
            return 0;
        }
    }
}
