<?php

/*
 * 游戏商家
 */

class GamebusController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show', 'add', 'edit'),
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
        $sql = "SELECT * FROM {{game_bus}} where 1=1";
        $sb = '';
        $name = null;
        if (isset($_GET['name']) || isset($_POST['name'])) {
            if (!empty($_POST['name'])) {
                $name = $_POST['name'];
            } else if (!empty($_GET['name'])) {
                $name = $_GET['name'];
            }
            $sb = $sb . " and name like '%" . $name . "%' ";
        }
        $sql = $sql . $sb . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        if (!empty($name)) {
            $pages->params = array('name' => $name);
        }
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
        $gamebus_model = new Gamebus();
        if (isset($_POST['Gamebus'])) {
            foreach ($_POST['Gamebus'] as $_k => $_v) {
                $gamebus_model->$_k = strip_tags(trim($_v));
            }
            $gamebus_model->cid = time();
            if ($gamebus_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('gamebus_model' => $gamebus_model, 'result' => $result));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $gamebus_model = Gamebus::model();
        $gamebus_info = $gamebus_model->findByPk($id);
        if (isset($_POST['Gamebus'])) {
            foreach ($_POST['Gamebus'] as $_k => $_v) {
                $gamebus_info->$_k = strip_tags(trim($_v));
            }
            if ($gamebus_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('gamebus_model' => $gamebus_info, 'result' => $result));
    }

  

}
