<?php

//玩宝管理
class VipbadyController extends Controllervip {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show', 'trade', 'money'),
                'expression' => 'Yii::app()->user->isLogin()',
            ),
            array('allow',
                'actions' => array('prob'),
                'users' => array('*'),
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
        $memid = $this->show_mem_id();
        //玩宝转入
        $badyzr_model = new Badyzr();
        if (isset($_POST['Badyzr'])) {
//            foreach ($_POST['Badyzr'] as $_k => $_v) {
//                $badyzr_model->$_k = strip_tags(trim($_v));
//            }
//            if ($badyzr_model->save()) {
//                $hlb = $badyzr_model["hlb"];
//                $title = "玩宝转入";
//                $reason = $title . $hlb . "元宝";
//                $this->updhlb(-$hlb, 25, $reason, $memid, 0);
//                $this->sendmessage($title, $reason, 1, $memid);
//                Yii::app()->user->setFlash('badyzr', 'success');
//            } else {
//                Yii::app()->user->setFlash('badyzr', 'error');
//            }
        }
        //玩宝转出
        $badyzc_model = new Badyzc();
        if (isset($_POST['Badyzc'])) {
//            foreach ($_POST['Badyzc'] as $_k => $_v) {
//                $badyzc_model->$_k = strip_tags(trim($_v));
//            }
//            if ($badyzc_model->save()) {
//                $hlb = $badyzc_model["hlb"];
//                $title = "玩宝转出";
//                $reason = $title . $hlb . "元宝";
//                $this->updhlb($hlb, 25, $reason, $memid, 0);
//                $this->sendmessage($title, $reason, 1, $memid);
//                Yii::app()->user->setFlash('badyzc', 'success');
//            } else {
//                Yii::app()->user->setFlash('badyzc', 'error');
//            }
        }
        //获取本周收益率
        $badyprob_info = Badyprob::model()->findAllBySql("select * from xm_bady_prob where date_sub(curdate(), INTERVAL 7 DAY) <= date(create_time)  order by create_time ");
        foreach ($badyprob_info as $model) {
            $str1.='{"i0":' . $model["prob"] * 1000 . ', "i7": 4, "i15": 4, "i30": 4, "i90": 5, "i180": 5},';
            $str2.='"' . date("Y-m-d", strtotime($model["create_time"])) . '",';
            $year = $year + $model["prob"];
        }
        $year = ($year / 7) * 365;
        if (!empty($str1)) {
            $str1 = "[" . substr($str1, 0, -2) . "}]";
        }
        if (!empty($str2)) {
            $str2 = "[" . substr($str2, 0, -1) . "]";
        }
        $this->renderPartial('show', array("badyzc_model" => $badyzc_model, "badyzr_model" => $badyzr_model, 'hlb' => $hlb, "str1" => $str1, "str2" => $str2, "year" => $year));
    }

    /*
     * 收益率
     */

    function actionProb() {
        $badyprob_num = Badyprob::model()->countBySql("select count(*) from {{bady_prob}} where  TO_DAYS(create_time) = (TO_DAYS(NOW())) ");
        if (empty($badyprob_num)) {
            $badyprob_model = new Badyprob();
            $system_info = System::model()->findByPk(1);
            $hlbsum = Badyzc::model()->countBySql("select sum(hlb) from {{bady}} ");
            if ($hlbsum < 5000000) {
                $prob = rand($system_info["bady1"] * 100, $system_info["bady2"] * 100) / 100;
            } else if (5000000 <= $hlbsum && $hlbsum < 10000000) {
                $prob = rand($system_info["bady3"] * 100, $system_info["bady4"] * 100) / 100;
            } else if ($hlbsum > 10000000) {
                $prob = rand($system_info["bady5"] * 100, $system_info["bady6"] * 100) / 100;
            }
            $badyprob_model->prob = $prob;
            $badyprob_model->save();
            $bady_info = Badyzc::model()->findAllBySql("select mem_id,sum(hlb) as hlbsum from {{bady}}  GROUP BY  mem_id");
            foreach ($bady_info as $model) {
                $hlb = $model["hlbsum"] * $prob / 100;
                $badymoney_model = new Badymoney();
                $badymoney_model->now_hlb = $model["hlbsum"];
                $badymoney_model->hlb = $hlb;
                $badymoney_model->last_hlb = $model["hlbsum"] + $hlb;
                $badymoney_model->prob = $prob;
                $badymoney_model->mem_id = $model["mem_id"];
                $badymoney_model->save();
                //获取玩宝收益
                $title = "玩宝收益";
                $reason = $title . $hlb . "元宝";
                $this->updhlb($hlb, 25, $reason, $model["mem_id"], 0);
                $this->sendmessage($title, $reason, 1, $model["mem_id"]);
            }
        } else {
            echo "error";
        }
    }

    /*
     * 收益明细
     */

    function actionMoney() {
        $sql = "SELECT * FROM {{bady_money}} where  mem_id  =" . $this->show_mem_id();
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
        $this->renderPartial('money', array('posts' => $posts, 'pages' => $pages), "", $processOutput = TRUE);
    }

    /*
     * 交易明细
     */

    function actionTrade() {
        $sql = "SELECT * FROM {{bady}} where  mem_id  =" . $this->show_mem_id();
        $sb = '';
        $start = null;
        $end = null;
        $data = $_GET['data'];
        $time = $_GET['time'];
        $tradetype = $_GET['tradetype'];
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
        if (!empty($tradetype)) {
            if($tradetype !="全部"){
                $sb = $sb . " and trade_type  = '" . $tradetype . "'";
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
        $pages->params = array('data' => $data, 'start' => $start, 'end' => $end,'tradetype'=>$tradetype);
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->renderPartial('trade', array('posts' => $posts, 'pages' => $pages), "", $processOutput = TRUE);
    }

}
