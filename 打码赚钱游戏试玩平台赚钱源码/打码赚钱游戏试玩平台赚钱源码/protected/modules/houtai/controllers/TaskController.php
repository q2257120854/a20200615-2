<?php

/*
 * 几元任务
 */

class TaskController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show', 'add', 'edit', 'close'),
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

    function actionShow($typeid) {
        $sql = "SELECT * FROM {{task}} where  task_type= " . $typeid;
        $sb = '';
        $game_name = null;
        if (isset($_GET['game_name']) || isset($_POST['game_name'])) {
            if (!empty($_POST['game_name'])) {
                $game_name = $_POST['game_name'];
            } else if (!empty($_GET['game_name'])) {
                $game_name = $_GET['game_name'];
            }
            $sb = $sb . " and game_name like '%" . $game_name . "%' ";
        }
        $sql = $sql . $sb . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        $pages->params = array('game_name' => $game_name, 'typeid' => $typeid);
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->render('show', array('posts' => $posts, 'pages' => $pages));
    }

    /*
     * 添加
     */

    function actionAdd() {
        $typeid = $_GET["typeid"];
        $game_model = Game::model();
        $game_info = $game_model->findAllBySql("SELECT id,name FROM {{game}}");
        $gamearray = array();
        foreach ($game_info as $game) {
            $gamearray[$game['id']] = $game['name'];
        }
        $task_model = new Task();
        if (isset($_POST['Task'])) {
            foreach ($_POST['Task'] as $_k => $_v) {
                $task_model->$_k = strip_tags(trim($_v));
            }
            if (!empty($task_model['game_id'])) {
                $game_info = $game_model->findByPk($task_model['game_id']);
                $task_model->game_name = $game_info["name"];
            }
            if ($task_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('task_model' => $task_model, 'result' => $result, "gamearray" => $gamearray, "typeid" => $typeid));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $typeid = $_GET["typeid"];
        $game_model = Game::model();
        $game_info = $game_model->findAllBySql("SELECT id,name FROM {{game}}");
        $gamearray = array();
        foreach ($game_info as $game) {
            $gamearray[$game['id']] = $game['name'];
        }
        $task_model = Task::model();
        $task_info = $task_model->findByPk($id);
        if (isset($_POST['Task'])) {
            foreach ($_POST['Task'] as $_k => $_v) {
                $task_info->$_k = strip_tags(trim($_v));
            }
            if (!empty($task_info['game_id'])) {
                $game_info = $game_model->findByPk($task_info['game_id']);
                $task_info->game_name = $game_info["name"];
            }
            if ($task_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('task_model' => $task_info, 'result' => $result, "gamearray" => $gamearray, "typeid" => $typeid));
    }

    /*
     * 删除
     */

    function actionClose($typeid, $id) {
        $task_model = Task::model();
        $task_info = $task_model->findByPk($id);
        if (empty($task_info->valid)) {
            $task_info->valid = 1;
        } else {
            $task_info->valid = 0;
        }
        if ($task_info->update()) {
            Yii::app()->user->setFlash('msg', '操作任务类型成功');
            $this->redirect(SITE_URL . "houtai/task/show/typeid/" . $typeid);
        }
    }

}
