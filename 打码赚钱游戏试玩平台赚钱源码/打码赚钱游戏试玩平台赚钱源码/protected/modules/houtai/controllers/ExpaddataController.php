<?php

/*
 * 体验数据
 */

class ExpaddataController extends Controller {

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
        $sql = "SELECT * FROM {{exp_ad_data}} where 1=1 ";
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
         $pages->params = array('start' => $start, 'end' => $end, 'expadid' => $expadid);
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
        $expaddata_model = Expaddata::model();
        $expaddata_info = $expaddata_model->findByPk($id);
        if ($expaddata_info->delete()) {
            Yii::app()->user->setFlash('msg', '删除成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $expaddata_model = Expaddata::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $expaddata_info = $expaddata_model->findByPk($id);
            if ($expaddata_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
