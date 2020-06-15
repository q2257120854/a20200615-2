<?php

//账户明细
class ViptradeController extends Controllervip {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('bean', 'gold', 'ticket'),
                'expression' => 'Yii::app()->user->isLogin()',
            ),
            array(
                'deny', //禁止
                'users' => array('*'), //*所有用户
            ),
        );
    }

    /*
     * 元宝明细
     */

    function actionGold() {
        $sql = "SELECT * FROM {{hlb}} where  mem_id  =". $this->show_mem_id();
        $sb = '';
        $start = null;
        $end = null;
        $data = $_GET['data'];
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
        if (!empty($data)) {
            $sb = $sb . " and type  = " . $data;
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
        $pages->params = array('data' => $data, 'start' => $start, 'end' => $end);
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->renderPartial('gold', array('posts' => $posts, 'pages' => $pages),"",$processOutput=TRUE);
    }

    /*
     * 金豆明细
     */

    function actionBean() {
        $sql = "SELECT * FROM {{hld}} where  mem_id=" . $this->show_mem_id();
        $sb = '';
        $start = null;
        $end = null;
        $data = $_GET['data'];
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
        if (!empty($data)) {
            $sb = $sb . " and type  = " . $data;
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
        $pages->params = array('data' => $data, 'start' => $start, 'end' => $end);
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->renderPartial('bean', array('posts' => $posts, 'pages' => $pages),"",$processOutput=TRUE);
    }

    /*
     * 金券明细
     */

    function actionTicket() {
        $sql = "SELECT * FROM {{hlq}} where  mem_id=" . $this->show_mem_id();
        $sb = '';
        $start = null;
        $end = null;
        $data = $_GET['data'];
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
        if (!empty($data)) {
            $sb = $sb . " and type  = " . $data;
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
        $pages->params = array('data' => $data, 'start' => $start, 'end' => $end);
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->renderPartial('ticket', array('posts' => $posts, 'pages' => $pages),"",$processOutput=TRUE);
    }

}
