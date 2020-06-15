<?php

/*
 * 手动审核模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Expadaudit extends CActiveRecord {
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
        return '{{exp_ad_audit}}';
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
            array('start', 'required', 'message' => '请填写体验等级！'),
            array('hlb_num', 'required', 'message' => '请填写奖励元宝！'),
            array('hlb_num', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '奖励元宝只能填写数字！'),
            array('mem_id', 'authenticate'),
        );
    }

    public function authenticate($attribute, $params) {
        $num = Expadaudit::model()->countBySql("select id from {{exp_ad_audit}} where  mem_id=" . $this->mem_id . " and exp_ad_id=" . $this->exp_ad_id);
        if (!empty($num)) {
            $this->addError('mem_id', '您已经提交');
        }
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'code' => '订单号',
            'mem_id' => '会员id',
            'exp_ad_id' => '体验广告id',
            'username' => '体验帐号',
            'start' => '审核状态',
            'hlb_num' => '奖励元宝',
            'hlb_id' => '奖励元宝id',
            'audit_time' => '审批时间',
        );
    }

}
