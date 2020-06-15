<?php

/*
 * 菜单模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Menu extends CActiveRecord {
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
        //ys 前缀去掉
        return '{{menu}}';
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
            'name' => '菜单名称',
            'url' => '链接地址',
        );
    }

}
