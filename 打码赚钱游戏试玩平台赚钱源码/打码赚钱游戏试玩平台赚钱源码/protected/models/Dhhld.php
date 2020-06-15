<?php

//兑换金豆
class Dhhld extends CActiveRecord {

    public $jy_pwd; //验证码属性

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
        return '{{hld}}';
    }

    public function rules() {
        return array(
            array('hld', 'required', 'message' => '兑换金豆必填'),
            array('jy_pwd', 'required', 'message' => '交易密码必填'),
            array('jy_pwd', 'authenticate'),
            array('hld', 'authenticate2'),
        );
    }

    public function authenticate($attribute, $params) {
        $mem = Mem::model()->find("email=:email", array(":email" => Yii::app()->user->name));
        if (!empty($mem['jy_pwd'])) {
            if (md5($this->jy_pwd) != $mem['jy_pwd']) {
                $this->addError('jy_pwd', '交易密码不正确！');
            }
        } else {
            $this->addError('jy_pwd', '交易密码未设置无法兑换金豆');
        }
    }

    public function authenticate2($attribute, $params) {
        $mem = Mem::model()->find("email=:email", array(":email" => Yii::app()->user->name));
        $hlbnum = Hlb::model()->countBySql("select sum(hlb) from {{hlb}} where mem_id=" . $mem["id"]); //元宝总数
        if ($hlbnum < $this->hld) {
            $this->addError('hld', '对不起,元宝不足！');
        }
    }
}
