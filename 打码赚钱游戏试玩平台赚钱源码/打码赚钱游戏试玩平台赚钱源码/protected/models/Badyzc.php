<?php

/*
 * 玩宝模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Badyzc extends CActiveRecord {

    public $jy_pwd;
     public $hlbsum;

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
        return '{{bady}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('hlb', 'required', 'message' => '请填写转出金额'),
            array('jy_pwd', 'required', 'message' => '交易密码必填'),
            array('jy_pwd', 'authenticate'),
            array('hlb', 'authenticate2'),
        );
    }

    public function authenticate() {
        $mem = Mem::model()->find("email=:email", array(":email" => Yii::app()->user->name));
        if (!empty($mem['jy_pwd'])) {
            if (md5($this->jy_pwd) != $mem['jy_pwd']) {
                $this->addError('jy_pwd', '交易密码不正确！');
            }
        } else {
            $this->addError('jy_pwd', '交易密码未设置');
        }
    }

    public function authenticate2() {
        $mem = Mem::model()->find("email=:email", array(":email" => Yii::app()->user->name));
        $hlbnum = Badyzc::model()->countBySql("select sum(hlb) from {{bady}} where mem_id=" . $mem["id"]); //元宝总数
        if ($this->hlb >= 20000) {
            if ($hlbnum < $this->hlb) {
                $this->addError('hlb', '对不起,玩宝余额不足！');
            } else {
                $this->hlb = -$this->hlb; //扣除余额
            }
        } else {
            $this->addError('hlb', '转出元宝必须≥20,000');
        }
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'hlb' => '操作元宝',
            'trade_type' => '操作类型',
            'mem_id' => '所属会员',
            'remark' => '备注',
            
        );
    }

}
