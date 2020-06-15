<?php

//任务管理
class ViptaskController extends Controllervip {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('captcha', 'expad', 'game'),
                'expression' => 'Yii::app()->user->isLogin()',
            ),
            array(
                'deny', //禁止
                'users' => array('*'), //*所有用户
            ),
        );
    }

    /*
     * 试玩体验
     */

    function actionGame() {
        $sql2 = "SELECT * FROM {{game_zm}} where mem_id=" . $this->show_mem_id();
        $gamezm_info = Gamezm::model()->findAllBySql($sql2);
        if (!empty($gamezm_info)) {
            foreach ($gamezm_info as $info) {
                $str.=$info['gid'] . ",";
            }
            $sql3 = "SELECT count(*) FROM {{game}} where end_time >= '".date("Y-m-d H:i:s", time())."' and id not in (" . substr($str, 0, -1) . ")";
        } else {
            $sql3 = "SELECT count(*) FROM {{game}} where end_time >= '".date("Y-m-d H:i:s", time())."'  ";
        }
        $count = Game::model()->countBySql($sql3);

        $type = $_GET['type'];
        if (empty($_GET['type'])) {
            $sql = "SELECT * FROM {{game_zm}} where  mem_id=" . $this->show_mem_id();
        } else {
            if (!empty($gamezm_info)) {
                $sql = "SELECT * FROM {{game}} where end_time >= '".date("Y-m-d H:i:s", time())."' and id not in (" . substr($str, 0, -1) . ")";
            } else {
                $sql = "SELECT * FROM {{game}} where end_time >= '".date("Y-m-d H:i:s", time())."' ";
            }
        }
      
        $sql = $sql . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        if (!empty($type)) {
            $pages->params = array('type' => $type);
        }
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->renderPartial('game', array('posts' => $posts, 'pages' => $pages, "count" => $count), '', $processOutput = TRUE);
    }

    /*
     * 广告体验
     */

    function actionExpad() {
        $sql2 = "SELECT * FROM {{exp_ad_zm}} where  mem_id=" . $this->show_mem_id();
        $expadzm_info = Expadzm::model()->findAllBySql($sql2);
        if (!empty($expadzm_info)) {
            foreach ($expadzm_info as $info) {
                $str.=$info['exp_ad_id'] . ",";
            }
            $sql3 = "SELECT count(*) FROM {{exp_ad}} where end_time >= '".date("Y-m-d H:i:s", time())."' and id not in (" . substr($str, 0, -1) . ")";
        } else {
            $sql3 = "SELECT count(*) FROM {{exp_ad}} where end_time >= '".date("Y-m-d H:i:s", time())."'  "; //表示为空
        }
        $count = Expad::model()->countBySql($sql3); //前台显示还未参加的

        $type = $_GET['type'];
        if (empty($_GET['type'])) {
            $sql = "SELECT * FROM {{exp_ad_zm}} where  mem_id=" . $this->show_mem_id();
        } else {
            if (!empty($expadzm_info)) {
                $sql = "SELECT * FROM {{exp_ad}} where end_time >= '".date("Y-m-d H:i:s", time())."' and id not in (" . substr($str, 0, -1) . ")";
            } else {
                $sql = "SELECT * FROM {{exp_ad}} where end_time >= '".date("Y-m-d H:i:s", time())."'  "; //表示为空
            }
        }
        $sql = $sql . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        if (!empty($type)) {
            $pages->params = array('type' => $type);
        }
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->renderPartial('expad', array('posts' => $posts, 'pages' => $pages, "count" => $count), '', $processOutput = TRUE);
    }
    
    /*
     * 打码记录
     */

    function actionCaptcha() {
        $sql2 = "SELECT * FROM {{captcha_zm}} where  mem_id=" . $this->show_mem_id();
        $captchazm_info = Captchazm::model()->findAllBySql($sql2);
        if (!empty($captchazm_info)) {
            foreach ($captchazm_info as $info) {
                $str.=$info['captcha_id'] . ",";
            }
            $sql3 = "SELECT count(*) FROM {{captcha}} where  id not in (" . substr($str, 0, -1) . ")";
        } else {
            $sql3 = "SELECT count(*) FROM {{captcha}}  ";
        }
        $count = Captcha::model()->countBySql($sql3);
        
        $type = $_GET['type'];
        if (empty($_GET['type'])) {
            $sql = "SELECT * FROM {{captcha_zm}} where  mem_id=" . $this->show_mem_id();
        } else {
            if (!empty($captchazm_info)) {
                $sql = "SELECT * FROM {{captcha}} where id not in (" . substr($str, 0, -1) . ")";
            } else {
                $sql = "SELECT * FROM {{captcha}} ";
            }
        }
        $sql = $sql . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        if (!empty($type)) {
            $pages->params = array('type' => $type);
        }
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->renderPartial('captcha', array('posts' => $posts, 'pages' => $pages, "count" => $count), '', $processOutput = TRUE);
    }

}
