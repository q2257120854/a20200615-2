<?php

//新手任务
class NewController extends Controller {
    /*
     * 展示
     */

    function actionShow() {
        $type = 0;
        if (!empty($_GET['type'])) {
            $type = $_GET['type'];
        }
        $this->renderPartial('show', array("type" => $type));
    }

    //任务
    function actionTask() {
        if (Yii::app()->request->isAjaxRequest) {//是否ajax请求
            $id = Yii::app()->request->getParam('id');
            $task_model = Task::model();
            if (empty($id)) {
                $task_id = $task_model->findBySql("select id from {{task}} where valid !=1 order by id limit 1");
                $id = $task_id["id"];
            }
            $task_info = $task_model->findAllBySql("select * from {{task}} where valid !=1 and  task_type=" . $id);
            $mem = $this->show_mem();
            $game_model = Game::model();
            $taskrewards_model = Taskrewards::model();
            $taskdata_model = Taskdata::model();
            foreach ($task_info as $info) {
                $game_info = $game_model->findByPk($info['game_id']);
                if (empty($mem)) {
                    $str.=" <li class='tow'>
                                <div class='db phone' style='background:url(/uploads/img/game/" . $game_info["img"] . ")  #e2f8ff no-repeat top center; background-size: 169px 113px;'><p>" . $info["game_name"] . "游戏达到等级" . $info["grade"] . "</p></div>
                                <a class='ann_1'  href='javascript:'>--</a>
                            </li> ";
                } else {
                    $num = $taskdata_model->countBySql("select count(*) from {{task_data}} where game_id=" . $info['game_id'] . " and grade=" . $info['grade'] . " and mem_id=" . $mem["id"]);
                    if (empty($num)) {
                        $str.=" <li class='tow'>
                                <div class='db phone' style='background:url(/uploads/img/game/" . $game_info["img"] . ")  #e2f8ff no-repeat top center; background-size: 169px 113px;'><p>" . $info["game_name"] . "游戏达到等级" . $info["grade"] . "</p></div>
                                <a class='ann_1 '  href='" . SITE_URL . "game/detail/id/" . $game_info['id'] . "' target='_blank'>立即试玩</a>
                            </li> ";
                    } else {
                        $str.=" <li class='tow'>
                                <div class='db phone' style='background:url(/uploads/img/game/" . $game_info["img"] . ")  #e2f8ff no-repeat top center; background-size: 169px 113px;'><p>" . $info["game_name"] . "游戏达到等级" . $info["grade"] . "</p></div>
                                <a class='ann_1 ann_n'  href='javascript:'>已完成</a>
                            </li> ";
                    }
                }
                $string.=$info['game_id'] . ",";
            }
            if (!empty($mem)) {
                $taskcount = $taskrewards_model->countBySql("select count(*) from {{task_rewards}} where mem_id= " . $mem["id"] . " and type=" . $id);
                if (empty($taskcount)) {
                    $count = $task_model->countBySql("select count(*) from {{task}} where valid !=1 and  task_type=" . $id);
                    $count2 = $taskdata_model->countBySql("select count(*) FROM {{task_data}} where game_id in (" . substr($string, 0, -1) . ")");
                    if (!empty($count) && !empty($count2) && intval($count) == intval($count2)) {
                        $str.="<li class='tow'>
                            <div class='db money'><p>完成所有任务</p></div>
                            <a class='ann_1' href='" . SITE_URL . "new/rewards/type/$id' >立即领奖</a>
                           </li>";
                    } else {
                        $str.="<li class='tow'>
                        <div class='db money'><p>完成所有任务</p></div>
                        <a class='ann_1' href='javascript:'>未完成</a>
                       </li>";
                    }
                } else {
                    $str.="<li class='tow'>
                        <div class='db money'><p>完成所有任务</p></div>
                        <a class='ann_1' href='javascript:'>已领取</a>
                       </li>";
                }
            } else {
                $str.="<li class='tow'>
                        <div class='db money'><p>完成所有任务</p></div>
                        <a class='ann_1' href='javascript:'>--</a>
                       </li>";
            }
            echo $str;
        }
    }

    //完成所有任务触发奖励
    function rewards($type) {
        $mem = $this->show_mem();
        $count = Taskrewards::model()->countBySql("select count(*) from {{task_rewards}} mem_id= " . $mem["id"] . " and type=" . $type);
        if (empty($count)) {
            $taskrewards_model = new Taskrewards();
            $taskrewards_model->mem_id = $mem["id"];
            $taskrewards_model->type = $type;
            $taskrewards_model->save();
            $hlb = $type * 10000;
            $title = "完成" . $type . "元任务!";
            $content = $title . "获得奖励元宝" . $hlb;
            $this->updhlb($hlb, 2, $content, $mem["id"], 0);
            if (!empty($hlb)) {
                $this->sendmessage($title, $content, 1, $mem["id"]);
            }
        }
    }

    //开启宝箱
    function actionChests() {
        if (Yii::app()->request->isAjaxRequest) {//是否ajax请求
            $id = Yii::app()->request->getParam('id');
            $memid = $this->show_mem_id();
            $chests_info = Chests::model()->findByPk($id);
            if (!empty($memid)) {
                $chestinfo_model = Chestsinfo::model();
                $count = $chestinfo_model->countBySql("select count(*) from xm_chestsinfo where  mem_id =" . $memid . " and chests =" . $id);
                if (empty($count)) {
                    $chestsinfo_model = new Chestsinfo();
                    $chestsinfo_model->chests = $id;
                    $chestsinfo_model->mem_id = $memid;
                    $hlb = $chests_info["hlb"];
                    $title = $id . "号宝箱开启!";
                    $content = "新手任务," . $title;
                    $hlb_model = $this->updhlb($hlb, 2, $content, $memid, 0);
                    if (!empty($hlb)) {
                        $this->sendmessage($title, $content, 1, $memid);
                    }
                    $chestsinfo_model->hlb_id = $hlb_model["id"];
                    if ($chestsinfo_model->save()) {
                        echo "恭喜您开启了第" . $id . "个宝箱," . "获得系统奖励" . $hlb . "元宝！";
                    } else {
                        echo $chestsinfo_model->getError("grade");
                    }
                }
            }
        }
    }

}
