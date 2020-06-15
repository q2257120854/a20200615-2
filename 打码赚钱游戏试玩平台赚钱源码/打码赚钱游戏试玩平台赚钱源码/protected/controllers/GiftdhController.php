<?php

//奖品兑换
class GiftdhController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show',  'edit', 'del', 'dynamiccity'),
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

        $this->renderPartial('show');
    }

    

    /*
     * 修改
     */

    function actionEdit($id) {
        $address_model = Address::model();
        $address_info = $address_model->findByPk($id);
        if (isset($_POST['Address'])) {
            foreach ($_POST['Address'] as $_k => $_v) {
                $address_info->$_k = strip_tags($_v);
            }
            if ($address_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('address_model' => $address_info, 'result' => $result));
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
  

}
