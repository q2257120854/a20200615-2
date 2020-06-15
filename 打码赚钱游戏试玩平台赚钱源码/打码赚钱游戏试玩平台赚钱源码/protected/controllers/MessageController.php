<?php

/*
 * 网站资讯
 */

class MessageController extends Controller {
    
    /*
     * 展示
     */

    function actionShow() {
        $this->renderPartial('show');
    }

    /*
     * 详细
     */

    function actionDetail($id, $pid) {
        if (!empty($id) && !empty($pid)) {
            $message_model = Message::model();
            $message_info = $message_model->findByPk($id);
            //点击次数累加
            $message_info->click = $message_info->click + 1;
            $message_info->update();
            $this->renderPartial('detail', array('message_info' => $message_info, 'pid' => $pid));
        }
    }

    /*
     * 资讯列表
     */

    function actionList($pid) {
        if (!empty($pid)) {
            $sql = "SELECT id,title,content,create_time,click FROM {{message}} where message_type_id=" . $pid . " order by id desc";
            $criteria = new CDbCriteria();
            $result = Yii::app()->db->createCommand($sql)->query();
            $pages = new CPagination($result->rowCount);
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
            $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
            $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
            $result->bindValue(':limit', $pages->pageSize);
            $posts = $result->query();
            $this->renderPartial('list', array('posts' => $posts, 'pages' => $pages, 'pid' => $pid));
        }
    }

}
