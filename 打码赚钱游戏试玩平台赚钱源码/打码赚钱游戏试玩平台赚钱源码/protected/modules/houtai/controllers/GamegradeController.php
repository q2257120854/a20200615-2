<?php

/*
 * 游戏等级
 */

class GamegradeController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show', 'add', 'edit', 'del', 'alldel'),
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
        $gameid = $_GET['gameid'];
        $sql = "SELECT * FROM {{game_grade}} where game_id=" . $gameid . " order by level ";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        if (!empty($gameid)) {
            $pages->params = array('gameid' => $gameid);
        }
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->render('show', array('posts' => $posts, 'pages' => $pages,"gameid"=>$gameid));
    }

    /*
     * 添加
     */

    function actionAdd() {
        $gameid = $_GET['gameid'];
        $gamegrade_model = new Gamegrade();
        if (isset($_POST['Gamegrade'])) {
            foreach ($_POST['Gamegrade'] as $_k => $_v) {
                $gamegrade_model->$_k = strip_tags($_v);
            }
            if ($gamegrade_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('gamegrade_model' => $gamegrade_model, 'result' => $result, "gameid" => $gameid));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $gamegrade_model = Gamegrade::model();
        $gamegrade_info = $gamegrade_model->findByPk($id);
        if (isset($_POST['Gamegrade'])) {
            foreach ($_POST['Gamegrade'] as $_k => $_v) {
                $gamegrade_info->$_k = strip_tags($_v);
            }
            if ($gamegrade_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('gamegrade_model' => $gamegrade_info, 'result' => $result));
    }

    /*
     * 删除
     */

    function actionDel($id) {
        $gameid = $_GET['gameid'];
        $gamegrade_model = Gamegrade::model();
        $gamegrade_info = $gamegrade_model->findByPk($id);
        if ($gamegrade_info->delete()) {
            Yii::app()->user->setFlash('msg', '删除成功');
            $this->redirect(SITE_URL . "houtai/gamegrade/show/gameid/" . $gameid);
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $gameid = $_GET['gameid'];
        $gamegrade_model = Gamegrade::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $gamegrade_info = $gamegrade_model->findByPk($id);
            $gamegrade_info->delete();
        }
        Yii::app()->user->setFlash('msg', '删除成功');
        $this->redirect(SITE_URL . "houtai/gamegrade/show/gameid/" . $gameid);
    }

}
