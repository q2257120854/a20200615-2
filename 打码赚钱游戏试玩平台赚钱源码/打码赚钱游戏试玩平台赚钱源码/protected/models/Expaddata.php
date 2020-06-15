<?php

/*
 * 体验数据模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Expaddata extends CActiveRecord {
    
    public  $hlb;
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
        return '{{exp_ad_data}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('mem_id', 'required', 'message' => '请填写会员id！'),
            array('mem_id', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '会员id只能填写数字！'),
            array('exp_ad_id', 'required', 'message' => '请填写体验广告id！'),
            array('exp_ad_id', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '体验广告id只能填写数字！'),
            array('username', 'required', 'message' => '请填写体验帐号！'),
            array('level', 'required', 'message' => '请填写体验等级！'),
            array('level', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '体验等级只能填写数字！'),
            array('level_jlhlb', 'required', 'message' => '请填写等级奖励！'),
            array('level_jlhlb', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '等级奖励只能填写数字！'),
            array('mem_id', 'authenticate'),
        );
    }

    public function authenticate($attribute, $params) {
        $num = Expaddata::model()->countBySql("select id from {{exp_ad_data}} where  mem_id=" . $this->mem_id . " and exp_ad_id=" . $this->exp_ad_id . " and level=" . $this->level);
        if (!empty($num)) {
            $this->addError('mem_id', '您还未升级,请继续体验');
        }
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'mem_id' => '会员id',
            'exp_ad_id' => '体验广告id',
            'username' => '体验帐号',
            'level' => '体验等级',
            'level_jlhlb' => '体验奖励',
        );
    }

}
