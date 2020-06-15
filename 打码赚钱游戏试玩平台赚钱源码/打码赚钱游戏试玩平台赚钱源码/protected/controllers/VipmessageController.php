<?php

//全部消息
class VipmessageController extends Controllervip {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show', 'detail', 'del', 'alldel', "allread", "allnoread", "gfdetail"),
                'expression' => 'Yii::app()->user->isLogin()',
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
        $vipmessage_model = Vipmessage::model();
        if ($_GET['type'] == 1) {
            $type = $_GET['type'];
            $sql = "SELECT * FROM {{message}} where is_official=1";
        } else {
            $sql = "SELECT * FROM {{vipmessage}} where mem_id=" . $this->show_mem_id();
            $sb = '';
            if (!empty($_GET['type'])) {
                $type = $_GET['type'];
                $sb = $sb . " and vipmessage_type = " . $type;
            }
            $sql = $sql . $sb . " order by id desc";
        }
        if (isset($_GET['read'])) {
            if ($_GET['read'] == 1) {
                $sql2 = $sql . " and is_read=0"; //查询没有阅读的信息
                $vipmessage_info = $vipmessage_model->findAllBySql($sql2);
                foreach ($vipmessage_info as $info) {
                    $info["is_read"] = 1; //标记为以读
                    $info->update();
                    Yii::app()->user->setFlash('msg', '成功标记所有信息以读');
                }
            }
        }
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        $pages->params = array('type' => $type);
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->renderPartial('show', array('posts' => $posts, 'pages' => $pages), '', $processOutput = TRUE);
    }

    /*
     * 阅读文章
     */

    function actionDetail($id, $pid) {
        if (!empty($id) && !empty($pid)) {
            $vipmessage_info = Vipmessage::model()->findByPk($id);
            $vipmessage_info["is_read"] = 1; //标记为以读
            $vipmessage_info->update();
            $this->renderPartial('detail', array("vipmessage_info" => $vipmessage_info, 'pid' => $pid));
        }
    }

    /*
     * 详细
     */

    function actionGfdetail($id, $pid) {
        if (!empty($id) && !empty($pid)) {
            $message_model = Message::model();
            $message_info = $message_model->findByPk($id);
            $this->renderPartial('gfdetail', array('message_info' => $message_info, 'pid' => $pid, 'type' => 1));
        }
    }

    /*
     * 勾选全部设为已读
     */

    function actionAllread($ids, $type) {
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $vipmessage_info = Vipmessage::model()->findByPk($id);
            if (!empty($vipmessage_info)) {
                $vipmessage_info["is_read"] = 1; //标记为以读
                $vipmessage_info->update();
            }
        }
        Yii::app()->user->setFlash('msg', '选中标记以读成功');
        $this->redirect(SITE_URL . "vipmessage/show/type/" . $type);
    }

    /*
     * 勾选全部设为未读 
     */

    function actionAllnoread($ids, $type) {
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $vipmessage_info = Vipmessage::model()->findByPk($id);
            if (!empty($vipmessage_info)) {
                $vipmessage_info["is_read"] = 0; //标记为未读
                $vipmessage_info->update();
            }
        }
        Yii::app()->user->setFlash('msg', '标记未读成功');
        $this->redirect(SITE_URL . "vipmessage/show/type/" . $type);
    }

    /*
     * 删除
     */

    function actionDel($id, $type) {
        $vipmessage_info = Vipmessage::model()->findByPk($id);
        if ($vipmessage_info->delete()) {
            Yii::app()->user->setFlash('msg', '删除成功');
            $this->redirect(SITE_URL . "vipmessage/show/type/" . $type);
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids, $type) {
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $vipmessage_info = Vipmessage::model()->findByPk($id);
            if (!empty($vipmessage_info)) {
                if ($vipmessage_info->delete()) {
                    Yii::app()->user->setFlash('msg', '删除成功');
                }
            }
        }
        $this->redirect(SITE_URL . "vipmessage/show/type/" . $type);
    }

}
