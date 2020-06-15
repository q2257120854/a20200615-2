<?php

//兑奖管理
class VipexpiryController extends Controllervip {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('delivery', 'show'),
                'expression' => 'Yii::app()->user->isLogin()',
            ),
            array(
                'deny', //禁止
                'users' => array('*'), //*所有用户
            ),
        );
    }

    /*
     * 兑奖明细
     */

    function actionShow() {
        $sql = "SELECT * FROM {{gift_dh}} where mem_id=".$this->show_mem_id();
        $sb = '';
        $start = null;
        $end = null;
        $time = $_GET['time'];
        if (!empty($_POST['end'])) {
            $end = $_POST['end'];
        } else if (!empty($_GET['end'])) {
            $end = $_GET['end'];
        }
        if (!empty($_POST['start'])) {
            $start = $_POST['start'];
        } else if (!empty($_GET['start'])) {
            $start = $_GET['start'];
        }
        if (!empty($end)) {
            if (!empty($start)) {
                $sb = $sb . " and create_time  between  '" . $start . " 00:00' and '" . $end . " 23:59'";
            } else {
                $sb = $sb . " and create_time  between  '" . date("Y-m-d") . " 00:00' and '" . $end . " 23:59'";
            }
        } else {
            if (!empty($start)) {
                $sb = $sb . " and create_time  <= '" . $start . " 23:59'";
            }
        }

        if ($time == 1) {
            $sb = $sb . " and  to_days(create_time)  = to_days(now())";
        }
        if ($time == 7) {
            $sb = $sb . " and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(create_time)";
        }
        if ($time == 30) {
            $sb = $sb . " and DATE_SUB(CURDATE(), INTERVAL 1 MONTH) <= date(create_time) ";
        }
        if ($time == 90) {
            $sb = $sb . " and DATE_SUB(CURDATE(), INTERVAL 3 MONTH) <= date(create_time) ";
        }
        $sql = $sql . $sb . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        $pages->params = array('start' => $start, 'end' => $end);
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->renderPartial('show', array('posts' => $posts, 'pages' => $pages), "", $processOutput = TRUE);
    }

    /*
     * 收货信息
     */

    function actionDelivery() {
        $address_model = Address::model();
        $address_info = $address_model->findAllBySql("select * from {{address}} where valid=0");
        if (isset($_POST['Address'])) {
            foreach ($_POST['Address'] as $_k => $_v) {
                $address_model->$_k = strip_tags($_v);
            }
            if ($address_model->save()) {
                
            }
        }

        $this->renderPartial('delivery', array("address_info" => $address_info), '', $processOutput = TRUE);
    }

}
