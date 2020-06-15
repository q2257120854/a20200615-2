<?php

class Updphone extends CActiveRecord {

    public $old_phone; //旧手机号
    public $code; //邮箱验证码
    public $num; //系统邮箱验证码

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
            array('old_phone', 'required', 'message' => '旧手机号必填'),
            array('old_phone', 'match', 'pattern' => '/^1\d{10}$/', 'message' => '旧手机号不正确！'),
            array('phone', 'required', 'message' => '新手机必填'),
            array('phone', 'match', 'pattern' => '/^1\d{10}$/', 'message' => '新手机号不正确！'),
            array('code', 'required', 'message' => '短信验证码必填'),
            array('old_phone', 'authenticate'),
            array('old_phone', 'authenticate2'),
            array('code', 'authenticate3'),
        );
    }

    public function authenticate($attribute, $params) {
        $mem_info = Mem::model()->find("email=:email and phone=:phone", array(":email" => Yii::app()->user->name, ":phone" => $this->old_phone));
        if (empty($mem_info)) {
            $this->addError('old_phone', '旧手机号不对！');
        }
    }

    public function authenticate2($attribute, $params) {
        if ($this->old_phone == $this->phone) {
            $this->addError('phone', '对不起,新手机号与旧手机号不能一样！');
        }
    }

    public function authenticate3($attribute, $params) {
        if ($this->num != $this->code) {
            $this->addError('code', '对不起,验证码不正确！');
        }
    }

    public function attributeLabels() {
        return array(
            'phone' => '手机',
            'emailcode' => '邮箱验证码',
        );
    }

}
