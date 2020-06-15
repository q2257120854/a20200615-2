<?php

//玩宝管理
class BadyController extends Controllervip {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是Administrator的用户
                'actions' => array('agree', 'refuse', 'show',"detail"),
                'expression' => 'Yii::app()->admin->isAdmin()',
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
        $sql = "SELECT * FROM {{bady}} where 1=1 ";
        $sb = '';
        $memid = $_POST['memid'];
        if (!empty($_POST['tradetype'])) {
            $tradetype = $_POST['tradetype'];
        } else {
            $tradetype = "转入";
        }
        $status = null;
        if (isset($_GET['status']) || isset($_POST['status'])) {
            if (!empty($_POST['status'])) {
                $status = $_POST['status'];
            } else if (!empty($_GET['status'])) {
                $status = $_GET['status'];
            }
            $sb = $sb . " and status like '%" . $status . "%' ";
        }
        if (!empty($memid)) {
            $sb = $sb . " and mem_id  = " . $memid;
        }
        if (!empty($tradetype)) {
            $sb = $sb . " and trade_type  = '" . $tradetype."'";
        }
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
        $sql = $sql . $sb . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        $pages->params = array('start' => $start, 'end' => $end, 'memid' => $memid, "status" => $status);
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->render('show', array('posts' => $posts, 'pages' => $pages));
    }
    
    
    
    /*
     * 交易明细
     */

    function actionDetail($memid) {
        $sql = "SELECT * FROM {{vipmessage}} where vipmessage_type=1 and mem_id =" . $memid;
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
        $sql = $sql . $sb . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 50;
        $pages->params = array('start' => $start, 'end' => $end, "memid" => $memid);
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->render('detail', array('posts' => $posts, 'pages' => $pages, "memid" => $memid));
    }
    
    
    /*
     * 拒绝提现
     */

    function actionRefuse($id) {
        $badyzc_model = Badyzc::model();
        $badyzc_info = $badyzc_model->findByPk($id);
        if (isset($_POST['Badyzc'])) {
            foreach ($_POST['Badyzc'] as $_k => $_v) {
                $badyzc_info->$_k = strip_tags($_v);
            }
            $title = "存入玩宝被拒绝";
            $content = $title . "原因：" . $badyzc_info["remark"] . "，返还" . ($badyzc_info["hlb"]) . "元宝";
            $hlb_model = $this->updhlb($badyzc_info["hlb"], 25, $content, $badyzc_info["mem_id"], 0);
            $this->sendmessage($title, $content, 1, $badyzc_info["mem_id"]);
            $badyzc_info->status = "已拒绝";
            $badyzc_info->zhlb_id = $hlb_model["id"];
            $badyzc_info->cl_time = date("Y-m-d H:i:s", time());
            if ($badyzc_info->update()) {
                Yii::app()->user->setFlash('msg', '成功拒绝存入玩宝！');
                $result = "success";
            }
        }
        $this->renderPartial('refuse', array('badyzc_model' => $badyzc_info, 'result' => $result));
    }

    /*
     * 同意提现
     */

    function actionAgree($id) {
        $badyzc_model = Badyzc::model();
        $badyzc_info = $badyzc_model->findByPk($id);
        $badyzc_info->status = "已通过";
        $badyzc_info->cl_time = date("Y-m-d H:i:s", time());
        if ($badyzc_info->update()) {
            $this->sendmessage("存入玩宝已通过", "存入玩宝已通过,存入" . $badyzc_info["hlb"] . "元宝!", 1, $badyzc_info["mem_id"]);
            $badyzc_info->update();
            Yii::app()->user->setFlash('msg', '存入玩宝已通过');
            $this->redirect("../../show");
        }
    }

}
