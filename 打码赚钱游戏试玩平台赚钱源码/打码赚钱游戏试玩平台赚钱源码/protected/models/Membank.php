<?php

/*
 * 银行管理模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Membank extends CActiveRecord {

    public $account2;
   

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
        return '{{bank}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('name', 'required', 'message' => '请填写名称！'),
            array('bank', 'required', 'message' => '请填写银行名称！'),
            array('banksub', 'required', 'message' => '请填写支行！'),
            array('account', 'required', 'message' => '请填写账号！'),
            array('account', 'match','pattern'=>'/^[0-9]*$/', 'message' => '账号只能填写数字！'),
            array('account', 'unique', 'message' => '账号已经占用'),
            array('account2', 'required', 'message' => '确认账号必填'),
            array('account2', 'compare', 'compareAttribute' => 'account', 'message' => '两次账号必须一致'),
            
        );
    }


    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'name' => '名称',
            'bank' => '银行名称',
            'banksub' => '支行',
            'account' => '账号',
        );
    }

}
