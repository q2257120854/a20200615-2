<?php

/*
 * 打码招募模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Captchazm extends CActiveRecord {
    
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
        return '{{captcha_zm}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('mem_id', 'required', 'message' => '请填写会员id！'),
            array('mem_id', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '会员id只能填写数字！'),
            array('captcha_id', 'required', 'message' => '请填写打码项目id！'),
            array('captcha_id', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '打码项目id只能填写数字！'),
            array('username', 'required', 'message' => '请填写打码账户！'),
           
        );
    }
    

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'mem_id' => '会员id',
            'username ' => '打码工号',
            'captcha_id' => '打码帐号id',
        );
    }

}
