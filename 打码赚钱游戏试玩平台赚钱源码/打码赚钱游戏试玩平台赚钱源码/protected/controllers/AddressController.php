<?php

//收货地址
class AddressController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show', 'edit', 'del', 'dynamiccity'),
            ),
            array(
                'deny', //禁止
                'users' => array('*'), //*所有用户
            ),
        );
    }

    /*
     * 展示
     */

    function actionShow() {
        $address = Address::model();
        $address_info = $address->findAllBySql("select * from {{address}} where valid=0 and mem_id=".$this->show_mem_id());
        $address_model = new Address();
        $result = null;
        if (isset($_POST['Address'])) {
            foreach ($_POST['Address'] as $_k => $_v) {
                $address_model->$_k = strip_tags($_v);
            }
            if ($address_model->save()) {
                $result = "success";
            } else {
                $result = "error";
            }
        }
        $this->renderPartial('show', array("address_info" => $address_info, "address_model" => $address_model, "result" => $result), '', $processOutput = TRUE);
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $address = Address::model();
        $addinfo = $address->findAllBySql("select * from {{address}} where valid=0 and mem_id=".$this->show_mem_id());
        $address_info = $address->findByPk($id);
      
        $result = null;
        if (isset($_POST['Address'])) {
            foreach ($_POST['Address'] as $_k => $_v) {
                $address_info->$_k = strip_tags($_v);
            }
            if ($address_info->save()) {
                $result = "success";
            } else {
                $result = "error";
            }
        }
        $this->renderPartial('edit', array("addinfo" => $addinfo, "address_info" => $address_info, "result" => $result), '', $processOutput = TRUE);
    }

    /*
     * 删除
     */

    function actionDel() {
        $id = $_POST['id'];
        $address_model = Address::model();
        $address_info = $address_model->findByPk($id);
        if ($address_info->delete()) {
            $data['start'] = "删除成功！";
            echo json_encode($data);
        }
    }

    function actionDynamicCity($pid, $typeid = 0) {
        $model = Address::model()->getCityList($pid, $typeid);
        if ($typeid == 1) {
            $aa = "-请选择市-";
        } else if ($typeid == 2 && $model) {
            $aa = "-请选择区-";
        }
        echo CHtml::tag('option', array('value' => 'empty'), $aa, true);
        foreach ($model as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

}
