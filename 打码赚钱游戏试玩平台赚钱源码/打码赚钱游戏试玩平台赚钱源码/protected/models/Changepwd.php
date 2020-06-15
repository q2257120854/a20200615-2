<?php

class Changepwd extends CActiveRecord {

    public $pwd2;

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
        return '{{mem}}';
    }

    public function rules() {
        return array(
            array('pwd', 'required', 'message' => '密码必填'),
            array('pwd', 'length', 'min' => '6', 'max' => '32', 'tooLong' => '太长了，密码最大只能有32位', 'tooShort' => '太短了了，密码最少需要有6位'),
            array('pwd2', 'required', 'message' => '确认密码必填'),
            array('pwd2', 'compare', 'compareAttribute' => 'pwd', 'message' => '两次密码必须一致'),
        );
    }

    public function attributeLabels() {
        return array(
            'pwd' => '密码',
        );
    }

}
