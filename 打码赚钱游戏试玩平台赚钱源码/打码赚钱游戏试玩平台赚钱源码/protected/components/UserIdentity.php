<?php

class UserIdentity extends CUserIdentity {
    
    //前台登录
    public function authenticate() {
        $mem_info = Mem::model()->find("email=:email", array(":email" => $this->username));
//        print_r(Mem::model());
//        print_r($mem_info);
        if ($mem_info == null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            return false;
        } else if ($mem_info->pwd != md5($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
            return false;
        } else if (!isset($mem_info)) {
            return false;
        } else {
            $mem_info->scdl_time = date("Y-m-d H:i:s", time());
            $mem_info->update(); //更改登录时间
            $this->errorCode = self::ERROR_NONE;
            return true;
        }
    }

    //前台登录2
    public function authenticates() {
        $mem_info = Mem::model()->find("email=:email  ", array(":email" => $this->username));  //会员注册和好友会员注册自动登录
        if ($mem_info == null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            return false;
        } else if ($mem_info->pwd != $this->password) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
            return false;
        } else if (!isset($mem_info)) {
            return false;
        } else {
            $mem_info->scdl_time = date("Y-m-d H:i:s", time());
            $mem_info->update(); //更改登录时间
            $this->errorCode = self::ERROR_NONE;
            return true;
        }
    }

    //后台登录
    public function authenticate2() {
        $account_info = Account::model()->find("username=:username ", array(":username" => $this->username));
        if ($account_info == null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            return false;
        } else if ($account_info->password != md5($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
            return false;
        } else if (!isset($account_info)) {
            return false;
        } else {
            $this->errorCode = self::ERROR_NONE;
            return true;
        }
    }

}
