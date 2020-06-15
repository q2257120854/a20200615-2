<?php

/*
 * 打码数据管理模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Captchadata extends CActiveRecord {

    public $hlb;

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
        return '{{captcha_data}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('mem_id', 'required', 'message' => '请填写会员id！'),
            array('mem_id', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '会员id只能填写数字！'),
            array('num', 'required', 'message' => '请填写打码数量！'),
            array('num', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '打码数量只能填写数字！'),
            array('code', 'required', 'message' => '请填写打码工号！'),
            array('js_id', 'required', 'message' => '请填写结算id！'),
            array('isjldata', 'required', 'message' => '请填写是否是奖励数据！'),
            array('hlb_id', 'required', 'message' => '请填写元宝id！'),
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'mem_id' => '会员id',
            'name' => '打码名称',
            'num' => '打码数量',
            'rewards_hlb' => '获得元宝',
            'code' => '打码工号',
            'code_val' => '码值',
            'type' => '数据更新类型',
            'js_id' => '结算id',
            'dsf_money' => '第三方给我们的钱',
            'isjldata' => '是否是奖励数据',
            'hlb_id' => '奖励元宝id',
            'rankrewards' => '排名奖励'
        );
    }

}
