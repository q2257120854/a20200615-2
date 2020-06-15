<?php

/*
 * 广告体验手动审核管理
 */

class ExpadauditController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show', 'pass', 'nopass', 'del', 'alldel'),
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
        $sql = "SELECT * FROM {{exp_ad_audit}} where 1=1";
        $sb = '';
        $code = null;
        if (isset($_GET['code']) || isset($_POST['code'])) {
            if (!empty($_POST['code'])) {
                $code = $_POST['code'];
            } else if (!empty($_GET['code'])) {
                $code = $_GET['code'];
            }
            $sb = $sb . " and code like '%" . $code . "%' ";
        }
        $sql = $sql . $sb . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        if (!empty($code)) {
            $pages->params = array('code' => $code);
        }
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->render('show', array('posts' => $posts, 'pages' => $pages));
    }

    /*
     * 通过
     */

    function actionPass($id) {
        $expadaudit_model = Expadaudit::model();
        $expadaudit_info = $expadaudit_model->findByPk($id);
        $expad_info = Expad::model()->findByPk($expadaudit_info['exp_ad_id']);
        //获得元宝
        $hlb_model = new Hlb();
        $hlb_model->hlb = $expadaudit_info['hlb_num'];
        $hlb_model->reason = $expad_info['name'] . "体验广告审核通过";
        $hlb_model->mem_id = $expadaudit_info["mem_id"];
        $hlb_model->source = 4; //来源
        $hlb_model->type = 1; //元宝增加
        $hlb_model->save();
        //审核信息更改
        $expadaudit_info->start = "通过";
        $expadaudit_info->audit_time = date('Y-m-d H:i:s', time());
        $expadaudit_info->hlb_id = $hlb_model['id'];
        if ($expadaudit_info->update()) {
            Yii::app()->user->setFlash('msg', '恭喜您，已通过');
            $this->redirect("../../show");
        }
    }

    /*
     * 不通过
     */

    function actionNopass($id) {
        $expadaudit_model = Expadaudit::model();
        $expadaudit_info = $expadaudit_model->findByPk($id);
        //审核信息更改
        $expadaudit_info->start = "未通过";
        $expadaudit_info->audit_time = date('Y-m-d H:i:s', time());
        if ($expadaudit_info->update()) {
            Yii::app()->user->setFlash('msg', '对不起，未通过');
            $this->redirect("../../show");
        }
    }

    /*
     * 删除
     */

    function actionDel($id) {
        $expadaudit_model = Expadaudit::model();
        $expadaudit_info = $expadaudit_model->findByPk($id);
        if ($expadaudit_info->delete()) {
            Yii::app()->user->setFlash('msg', '删除成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $expadaudit_model = Expadaudit::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $expadaudit_info = $expadaudit_model->findByPk($id);
            if ($expadaudit_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
