<?php

/*
 * 玩宝收益模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Badymoney extends CActiveRecord {
    
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
        return '{{bady_money}}';
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
            'now_hlb' => '当前元宝',
            'hlb' => '收益元宝',
            'last_hlb' => '收益后元宝',
            'prob' => '收益率',
            'mem_id' => '所属会员',
        );
    }

}
