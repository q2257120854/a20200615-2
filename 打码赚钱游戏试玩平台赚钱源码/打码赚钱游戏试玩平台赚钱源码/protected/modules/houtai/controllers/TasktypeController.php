<?php

/*
 * 任务类型
 */

class TasktypeController extends Controller {

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

    function actionShow() {
        $sql = "SELECT * FROM {{task_type}} where 1=1";
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
        $pages->params = array('name' => $name);
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
        $tasktype_model = new Tasktype();
        if (isset($_POST['Tasktype'])) {
            foreach ($_POST['Tasktype'] as $_k => $_v) {
                $tasktype_model->$_k = strip_tags(trim($_v));
            }
            if ($tasktype_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('tasktype_model' => $tasktype_model, 'result' => $result));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $tasktype_model = Tasktype::model();
        $tasktype_info = $tasktype_model->findByPk($id);
        if (isset($_POST['Tasktype'])) {
            foreach ($_POST['Tasktype'] as $_k => $_v) {
                $tasktype_info->$_k = strip_tags(trim($_v));
            }
            if ($tasktype_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('tasktype_model' => $tasktype_info, 'result' => $result));
    }

    /*
     * 删除
     */

    function actionClose($id) {
        $tasktype_model = Tasktype::model();
        $tasktype_info = $tasktype_model->findByPk($id);
        if (empty($tasktype_info->valid)) {
            $tasktype_info->valid = 1;
        } else {
            $tasktype_info->valid = 0;
        }
        if ($tasktype_info->update()) {
            Yii::app()->user->setFlash('msg', '操作任务类型成功');
            $this->redirect("../../show");
        }
    }

}
