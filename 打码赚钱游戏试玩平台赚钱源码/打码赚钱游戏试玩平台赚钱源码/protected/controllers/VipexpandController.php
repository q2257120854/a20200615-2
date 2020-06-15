<?php

//推广管理
class VipexpandController extends Controllervip {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('invite', 'rewards', 'friend', 'way'),
                'expression' => 'Yii::app()->user->isLogin()',
            ),
            array(
                'deny', //禁止
                'users' => array('*'), //*所有用户
            ),
        );
    }

    /*
     * 推广福利
     */

    function actionInvite() {
       
        $this->renderPartial('invite');
    }

    /*
     * 收益流水
     */

    function actionWay() {

        $this->renderPartial('way');
    }

    /*
     * 邀请奖励
     */

    function actionRewards() {
        $memid = $this->show_mem_id();
        $time = $_GET['time'];
        $sb = '';
        $start = null;
        $end = null;
        $sql = "SELECT * from {{hlb}} where source=1 and mem_id= " . $memid;
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
        $this->renderPartial('rewards', array('posts' => $posts, 'pages' => $pages), '', $processOutput = TRUE);
    }

    /*
     * 我的好友
     */

    function actionFriend() {
        $memid = $this->show_mem_id();
        $type = $_GET['type'];
        $time = $_GET['time'];
        $sb = '';
        $start = null;
        $end = null;
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
        if (empty($type) || $type != 5) {
            $sql = "SELECT * from {{mem}} where 1=1 ";
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
        if (empty($type)) {
            $sb = $sb . " and INSTR(pid,'$memid,') !=0 and  (length(substring(pid,INSTR(pid,'$memid,')))-length(replace(substring(pid,INSTR(pid,'$memid,')),',','')))=1 ";
        } else if (!empty($type) && $type != 5) {
            $sb = $sb . " and INSTR(pid,'$memid,') !=0 and  (length(substring(pid,INSTR(pid,'$memid,')))-length(replace(substring(pid,INSTR(pid,'$memid,')),',','')))=$type ";
        } else if ($type == 5) {
            $sql = " select * from  {{tx}} as a inner  join (SELECT id from {{mem}} as b where INSTR(pid,'1,') !=0 ) b on a.mem_id=b.id  ";
        }

        if ($type != 5) {
            $sql = $sql . $sb . " order by id desc";
        }
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        if (!empty($type)) {
            $pages->params = array('type' => $type, 'start' => $start, 'end' => $end);
        }
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->renderPartial('friend', array('posts' => $posts, 'pages' => $pages), '', $processOutput = TRUE);
    }

}
