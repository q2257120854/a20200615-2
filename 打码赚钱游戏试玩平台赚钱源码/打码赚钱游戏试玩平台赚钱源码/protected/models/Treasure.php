<?php

/*
 * 财付通管理模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Treasure extends CActiveRecord {

    public $account2;
    public $code; //验证码属性
    public $num; //系统验证码

    /*
     * 返回当前模型对象的静态方法
     */

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /*
     * 返回当前模型的名字
     */

    public function tableName() {
        //xm 前缀去掉
        return '{{treasure}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('name', 'required', 'message' => '请填写名称！'),
            array('account', 'required', 'message' => '请填写账号！'),
            array('account', 'unique', 'message' => '账号已经占用'),
            array('account2', 'required', 'message' => '确认账号必填'),
            array('account2', 'compare', 'compareAttribute' => 'account', 'message' => '两次账号必须一致'),
            array('code', 'required', 'message' => '请填写验证码！'),
            array('code', 'authenticate'),
        );
    }

    public function authenticate($attribute, $params) {
        if ($this->code != $this->num) {
            $this->addError('code', "验证码不正确");
        }
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'name' => '名称',
            'account' => '账号',
            'account2' => '确认账号',
        );
    }

}
