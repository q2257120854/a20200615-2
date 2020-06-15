<?php

/*
 * 收货地址模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Address extends CActiveRecord {
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
        return '{{address}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('name', 'required', 'message' => '请填写收货人名称！'),
            array('address', 'required', 'message' => '请选择地址！'),
            array('phone', 'required', 'message' => '请填写手机号码！'),
            array('phone', 'match', 'pattern' => '/^1\d{10}$/', 'message' => '手机号码不正确！'),
            array('tel', 'match', 'pattern' => '((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)', 'message' => '手机号码格式不正确'),
            array('memqq', 'required', 'message' => '联系QQ不能为空！'),
            array('memqq', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '联系QQ只能填写数字！'),
            array('province', 'authenticate'),
        );
    }

    public function authenticate($attribute, $params) {
        if (empty($this->province) || $this->city=="empty") {
            $this->addError('province', '请您填写完整的地区信息');
        }
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'name' => '收货人',
            'province' => '省',
            'city' => '市',
            'district' => '县',
            'address' => '地址',
            'memqq' => 'QQ',
            'phone' => '手机号码',
            'tel' => '固定号码',
            'remark' => '备注',
        );
    }

    public function getProvinceList() {
        $model = City::model()->findAllByAttributes(array('pid' => 0));
        return CHtml::listData($model, 'id', 'name');
    }

    public function getCityList($pid, $typeid = 0) {
        $model = City::model()->findAllByAttributes(array('pid' => $pid));
        return CHtml::listData($model, 'id', 'name', $typeid);
    }

    public function getDistrictList($pid) {
        $model = City::model()->findAllByAttributes(array('pid' => $pid));
        return CHtml::listData($model, 'id', 'name');
    }

    public function getCityName($id) {
        $model = City::model()->findByPk($id);
        return $model->name;
    }

}
