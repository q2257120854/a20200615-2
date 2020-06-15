<?php

/*
 * 游戏招募
 */

class GamezmController extends Controller {

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
        $sql = "SELECT * FROM {{game_zm}} where 1=1 ";
        $sb = '';
        $game_id = null;
        if (isset($_GET['game_id']) || isset($_POST['game_id'])) {
            if (!empty($_POST['game_id'])) {
                $game_id = $_POST['game_id'];
            } else if (!empty($_GET['game_id'])) {
                $game_id = $_GET['game_id'];
            }
            if (!empty($game_id)) {
                $sb = $sb . " and game_id  =" . $game_id;
            }
        }
        $sql = $sql . $sb . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        if (!empty($game_id)) {
            $pages->params = array('game_id' => $game_id);
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
