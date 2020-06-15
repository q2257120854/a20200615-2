<?php

class Account extends CActiveRecord {

    public $password2;

    /*
     * 返回当前模型对象的静态方法
     * 重写父类CActiveRecord对应的方法
     */

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /*
     * 返回当前数据表的名字
     *  重写父类CActiveRecord对应的方法
     */

    public function tableName() {
        return '{{account}}';
    }

    public function rules() {
        return array(
            array('username', 'required', 'message' => '用户名必填'),
            array('username', 'unique', 'message' => '用户名已经占用'),
            array('username', 'length', 'max' => '20', 'tooLong' => '太长了，用户名最大只能有20个字符'),
            array('password', 'required', 'message' => '密码必填'),
            array('password', 'length', 'min' => '6', 'max' => '32', 'tooLong' => '太长了，密码最大只能有32位', 'tooShort' => '太短了了，密码最少需要有6位'),
            array('password2', 'required', 'message' => '确认密码必填'),
            array('password2', 'compare', 'compareAttribute' => 'password', 'message' => '两次密码必须一致'),
            array('role', 'required', 'message' => '角色必选'),
            array('name', 'required', 'message' => '姓名必填'),
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'username' => '用户名',
            'password' => '用户密码',
            'password2' => '确认密码',
            'role' => '角色',
            'name' => '姓名',
        );
    }

    

}
