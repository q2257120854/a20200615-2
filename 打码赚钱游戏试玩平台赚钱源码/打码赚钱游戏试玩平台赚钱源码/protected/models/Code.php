<?php

//邮件回复码
class Code extends CActiveRecord {

   public $code; //验证码属性
    public $num; //系统验证码

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
            array('code', 'required', 'message' => '验证码必填'),
            array('code', 'authenticate'),
            
        );
    }

    public function authenticate($attribute, $params) {
        if ($this->num != $this->code) {
            $this->addError('code', '对不起,验证码不正确！');
        }
    }

    public function attributeLabels() {
        return array(
            'code' => '验证码',
            'num' => '系统验证码',
        );
    }

}
