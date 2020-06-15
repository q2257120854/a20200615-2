<?php

/*
 * 资讯管理
 */

class MessageController extends Controller {

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
        $message_model = Message::model();
        $sql = "SELECT * FROM {{message}} where 1=1";
        $sb = '';
        $title = null;
        if (isset($_GET['title']) || isset($_POST['title'])) {
            if (!empty($_POST['title'])) {
                $title = $_POST['title'];
            } else if (!empty($_GET['title'])) {
                $title = $_GET['title'];
            }
            $sb = $sb . " and title like '%" . $title . "%' ";
        }
        $sql = $sql . $sb . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        if (!empty($title)) {
            $pages->params = array('title' => $title);
        }
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->render('show', array(
            'message_model' => $message_model, 'title' => $title,
            'posts' => $posts,
            'pages' => $pages,
        ));
    }

    /*
     * 添加
     */

    function actionAdd() {
        $messagetype_model = Messagetype::model();
        $messagetype_info = $messagetype_model->findAll();
        $megarray = array();
        foreach ($messagetype_info as $mesgtype) {
            $megarray[$mesgtype['id']] = $mesgtype['name'];
        }
        $message_model = new Message();
        if (isset($_POST['Message'])) {
            foreach ($_POST['Message'] as $_k => $_v) {
                $message_model->$_k = $_v;
            }
            if ($message_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('message_model' => $message_model, 'result' => $result, 'megarray' => $megarray));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $messagetype_model = Messagetype::model();
        $messagetype_info = $messagetype_model->findAll();
        $megarray = array();
        foreach ($messagetype_info as $mesgtype) {
            $megarray[$mesgtype['id']] = $mesgtype['name'];
        }

        $message_model = Message::model();
        $message_info = $message_model->findByPk($id);
        if (isset($_POST['Message'])) {
            foreach ($_POST['Message'] as $_k => $_v) {
                $message_info->$_k = $_v;
            }
            if ($message_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('message_model' => $message_info, 'result' => $result, 'megarray' => $megarray));
    }

    /*
     * 删除
     */

    function actionDel($id) {
        $message_model = Message::model();
        $message_info = $message_model->findByPk($id);
        if ($message_info->delete()) {
            Yii::app()->user->setFlash('msg', '删除成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $message_model = Message::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $message_info = $message_model->findByPk($id);
            if ($message_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
