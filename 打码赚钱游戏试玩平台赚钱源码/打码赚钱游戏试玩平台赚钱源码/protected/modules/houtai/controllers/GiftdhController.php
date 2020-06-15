<?php

/*
 * 奖品管理
 */

class GiftdhController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是Administrator的用户
                'actions' => array('agree', 'refuse', 'show', 'remark', 'alldel'),
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
        $sql = "SELECT * FROM {{gift_dh}} where 1=1 ";
        $sb = '';
        $mem_name = null;
        if (isset($_GET['mem_name']) || isset($_POST['mem_name'])) {
            if (!empty($_POST['mem_name'])) {
                $mem_name = $_POST['mem_name'];
            } else if (!empty($_GET['mem_name'])) {
                $mem_name = $_GET['mem_name'];
            }
            $sb = $sb . " and mem_name like '%" . $mem_name . "%' ";
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
        $pages->params = array('start' => $start, 'end' => $end, 'mem_name' => $mem_name);
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->render('show', array('posts' => $posts, 'pages' => $pages));
    }

    /*
     * 添加备注
     */

    function actionRemark($id) {
        $giftdh_model = Giftdh::model();
        $giftdh_info = $giftdh_model->findByPk($id);
        if (isset($_POST['Giftdh'])) {
            foreach ($_POST['Giftdh'] as $_k => $_v) {
                $giftdh_info->$_k = strip_tags($_v);
            }
            if ($giftdh_info->update()) {
                Yii::app()->user->setFlash('msg', '添加备注成功');
                $result = "success";
            }
        }
        $this->renderPartial('remark', array('giftdh_model' => $giftdh_info, 'result' => $result));
    }

    /*
     * 拒绝兑换
     */

    function actionRefuse($id) {
        $giftdh_model = Giftdh::model();
        $giftdh_info = $giftdh_model->findByPk($id);
        $giftdh_info->starts = "已拒绝";
        if ($giftdh_info->update()) {
            Yii::app()->user->setFlash('msg', '已拒绝兑换');
            $this->redirect("../../show");
        }
    }

    /*
     * 同意兑换
     */

    function actionAgree($id) {
        $giftdh_model = Giftdh::model();
        $giftdh_info = $giftdh_model->findByPk($id);
        $giftdh_info->starts = "已兑换";
        if ($giftdh_info->update()) {
            Yii::app()->user->setFlash('msg', '已兑换成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $giftdh_model = Giftdh::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $giftdh_info = $giftdh_model->findByPk($id);
            if ($giftdh_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
