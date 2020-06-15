<?php

/*
 * 提现奖励模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Txrewards extends CActiveRecord {
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
        return '{{tx_rewards}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('money', 'required', 'message' => '请填写金额！'),
            array('money', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '金额只能填写数字！'),
            array('rewards', 'required', 'message' => '请填写奖励！'),
            array('rewards', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '奖励只能填写数字！'),
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'money' => '金额',
            'rewards' => '奖励',
        );
    }

}
