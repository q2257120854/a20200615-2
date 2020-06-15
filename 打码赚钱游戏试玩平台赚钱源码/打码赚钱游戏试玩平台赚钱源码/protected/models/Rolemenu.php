<?php

/*
 * 菜单模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Rolemenu extends CActiveRecord {
    
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
        return '{{role_menu}}';
    }

   
    /*
     * 对应标签名称
     */

    function attributeLabels() {

        return array(
            'role_id' => '角色id',
            'menu_id' => '菜单id',
        );
    }

}
