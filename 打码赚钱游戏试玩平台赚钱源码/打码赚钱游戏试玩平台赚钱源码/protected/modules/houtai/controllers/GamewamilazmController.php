<?php

/*
 * 挖米拉游戏墙
 */

class GamewamilazmController extends Controller {

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
        $sql = "SELECT * FROM {{game_wamila_zm}} where 1=1 ";
        $sb = '';
        $mem_id = null;
        if (isset($_GET['mem_id']) || isset($_POST['mem_id'])) {
            if (!empty($_POST['mem_id'])) {
                $mem_id = $_POST['mem_id'];
            } else if (!empty($_GET['mem_id'])) {
                $mem_id = $_GET['mem_id'];
            }
            if (!empty($mem_id)) {
                $sb = $sb . " and mem_id  =" . $mem_id;
            }
        }
        $sql = $sql . $sb . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        if (!empty($mem_id)) {
            $pages->params = array('mem_id' => $mem_id);
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
        $gamezm_model = Gamezm::model();
        $gamezm_info = $gamezm_model->findByPk($id);
        if ($gamezm_info->delete()) {
            Yii::app()->user->setFlash('msg', '删除成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $gamezm_model = Gamezm::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $gamezm_info = $gamezm_model->findByPk($id);
            if ($gamezm_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
