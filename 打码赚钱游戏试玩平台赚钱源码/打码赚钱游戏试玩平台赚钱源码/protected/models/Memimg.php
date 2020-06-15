<?php

class Memimg extends CActiveRecord {
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
        return '{{mem_img}}';
    }


    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'img' => '图片',
           
        );
    }

}
