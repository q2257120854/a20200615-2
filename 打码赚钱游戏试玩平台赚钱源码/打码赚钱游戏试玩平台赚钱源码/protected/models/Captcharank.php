<?php

/*
 * 打码排行管理模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Captcharank extends CActiveRecord {
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
        return '{{captcha_rank}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
           
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'rewards_hlb' => '打码收入',
            'rank_rewards' => '排行奖励',
            'mem_name' => '会员昵称',
        );
    }

}
