<?php

/*
 * 体验广告招募
 */

class ExpadzmController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show', 'del', 'alldel'),
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
        $sql = "SELECT * FROM {{exp_ad_zm}} where 1=1 ";
        $sb = '';
        $expadid = null;
        if (isset($_GET['expadid']) || isset($_POST['expadid'])) {
            if (!empty($_POST['expadid'])) {
                $expadid = $_POST['expadid'];
            } else if (!empty($_GET['expadid'])) {
                $expadid = $_GET['expadid'];
            }
            if (!empty($expadid)) {
                $sb = $sb . " and exp_ad_id  =" . $expadid;
            }
        }
        $sql = $sql . $sb . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        if (!empty($expadid)) {
            $pages->params = array('expadid' => $expadid);
        }
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->render('show', array('posts' => $posts, 'pages' => $pages));
    }

    /*
     * 删除
     */

    function actionDel($id) {
        $expadzm_model = Expadzm::model();
        $expadzm_info = $expadzm_model->findByPk($id);
        if ($expadzm_info->delete()) {
            Yii::app()->user->setFlash('msg', '删除成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $expadzm_model = Expadzm::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $expadzm_info = $expadzm_model->findByPk($id);
            if ($expadzm_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
