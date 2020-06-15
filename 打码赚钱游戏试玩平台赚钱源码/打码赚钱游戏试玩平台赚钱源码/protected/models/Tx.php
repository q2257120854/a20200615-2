<?php

/*
 * 提现模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Tx extends CActiveRecord {

    public $jy_pwd;

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
        return '{{tx}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('way', 'required', 'message' => '请选择收款方式！'),
            array('account', 'required', 'message' => '请填写收款账号！'),
            array('name', 'required', 'message' => '请填写姓名！'),
            array('applymoney', 'required', 'message' => '请填写提现金额！'),
            array('applymoney', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '提现金额只能填写整数！'),
            array('applymoney', 'authenticate1'),
            array('fee', 'required', 'message' => '手续费不能为空！'),
            array('rewards', 'required', 'message' => '奖励不能为空！'),
            array('money', 'required', 'message' => '实付金额不能为空！'),
            array('starts', 'required', 'message' => '状态不能为空！'),
            array('jy_pwd', 'required', 'message' => '交易密码不能为空！'),
            array('jy_pwd', 'authenticate2'),
            
        );
    }

    public function authenticate1($attribute, $params) {
        $mem = Mem::model()->find("email=:email", array(":email" => Yii::app()->user->name));
        $hlbnum = Hlb::model()->countBySql("select sum(hlb) from {{hlb}} where mem_id=" . $mem['id']);
        if (($this->applymoney * 10000) < $hlbnum) {
            if ($this->applymoney < 2) {
                $this->addError('applymoney', '提现金额不能小于2元');
            }
        } else {
            $this->addError('applymoney', '对不起,您的元宝不足，无法提出您想要的金额');
        }
    }

    public function authenticate2($attribute, $params) {
        $mem = Mem::model()->find("email=:email", array(":email" => Yii::app()->user->name));
        if (!empty($mem["jy_pwd"])) {
            if (md5($this->jy_pwd) != $mem["jy_pwd"]) {
                $this->addError('jy_pwd', '交易密码不正确');
            }
        } else {
            $this->addError('jy_pwd', '交易密码未设置，无法提现');
        }
    }
    

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'name' => '收款人',
            'way' => '收款方式', //收款方式 （1为银行 2为支付宝 3为财富通）
            'account' => '收款账号',
            'hlb_id' => 'hlb记录',
            'applymoney' => '提现金额',
            'fee' => '手续费',
            'rewards' => '奖励',
            'money' => '实付金额',
            'starts' => '状态', //状态（未处理，已同意,已拒绝） 
            'remark' => '备注',
            'mem_id' => '会员id',
            'txnum' => '提现次数',
        );
    }

}
