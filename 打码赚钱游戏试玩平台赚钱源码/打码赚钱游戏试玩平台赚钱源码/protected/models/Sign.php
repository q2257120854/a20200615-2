<?php

/*
 * 签到模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Sign extends CActiveRecord {
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
        return '{{sign}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('mem_id', 'authenticate'),
        );
    }

    public function authenticate($attribute, $params) {
        $num = Sign::model()->countBySql("select count(*) from {{sign}} where TO_DAYS(create_time) = (TO_DAYS(NOW())) and mem_id=" . $this->mem_id);
        if (!empty($num)) {
            $this->addError('mem_id', '今天已签到！');
        }
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'mem_id' => '会员',
        );
    }

}
