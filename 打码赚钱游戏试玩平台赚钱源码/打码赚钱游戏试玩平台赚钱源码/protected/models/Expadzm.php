<?php

/*
 * 体验广告招募模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Expadzm extends CActiveRecord {
    
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
        return '{{exp_ad_zm}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('mem_id', 'required', 'message' => '请填写会员id！'),
            array('mem_id', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '会员id只能填写数字！'),
            array('userid', 'required', 'message' => '请填写账号id！'),
            array('userid', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '账号id只能填写数字！'),
            array('username', 'required', 'message' => '请填写账户名！'),
            array('exp_ad_id', 'required', 'message' => '请填写体验广告id！'),
            array('exp_ad_id', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '体验广告id只能填写数字！'),
            array('mem_id', 'authenticate'),
        );
    }

    //游戏重复注册
    public function authenticate($attribute, $params) {
        $num = Expadzm::model()->countBySql("select id from {{exp_ad_zm}} where  mem_id=" . $this->mem_id . " and exp_ad_id=" . $this->exp_ad_id);
        if (!empty($num)) {
            $this->addError('mem_id', '您已经注册了!');
        }
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'mem_id' => '会员id',
            'userid' => '账号id',
            'username ' => '账户名',
            'exp_ad_id' => '体验广告id',
        );
    }

}
