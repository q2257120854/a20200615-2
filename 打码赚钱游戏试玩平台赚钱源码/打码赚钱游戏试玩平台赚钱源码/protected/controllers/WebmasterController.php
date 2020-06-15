<?php

/*
 * 站长联盟
 */

class WebmasterController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow',
                'actions' => array('captcha', "show", "matter", "join"),
                'users' => array('*'),
            ),
        );
    }

    /*
     * 验证码
     * 视图表单调用（$this->widget('CCaptcha')）
     */

    function actions() {
        return array(
            'captcha' => array(
                'class' => 'application.extensions.MyCaptchaAction',
                'width' => 82,
                'height' => 29,
                'padding' => 0, //文字周边填充大小
                'backColor' => 0xFFFFFF, //背景颜色
                'foreColor' => 0xBD3910, //字体颜色
                'minLength' => 4, //设置最短为6位
                'maxLength' => 4, //设置最长为7位,生成的code在6-7直接rand了
                'transparent' => FALSE, //显示为透明,默认中可以看到为false
                'offset' => 4, //设置字符偏移量
            )
        );
    }

    /*
     * 联盟奖励
     */

    function actionShow() {
        $rank_model = Rank::model();
        $mem_model = Mem::model();
        $hlb_model = Hlb::model();
        $rank_info = $rank_model->findAllBySql("select rewards_hlb from {{rank}} where rank_type=5  and start='已开启' order by grade ");
        $count = $rank_model->countBySql("select count(*) from {{rank}} where rank_type=5 and start='已开启'  order by grade ");
        
        if (date("Y-m") == "2015-04" || date("Y-m") == "2015-05") {
            $sql = "select mem_id , SUM(hlb) as hlbnum from {{hlb}} WHERE  pmem_id !=0 and create_time  between  '2015-04-10 00:00' and '2015-05-31 23:59' GROUP BY mem_id  ORDER BY SUM(hlb) DESC  ";
        } else {
            $sql = "select mem_id , SUM(hlb) as hlbnum from {{hlb}} WHERE  pmem_id !=0 and date_format(create_time,'%Y-%m') between date_format(DATE_SUB(curdate(), INTERVAL 0 MONTH),'%Y-%m')  and date_format(DATE_SUB(curdate(), INTERVAL -1 MONTH),'%Y-%m') GROUP BY mem_id  ORDER BY SUM(hlb) DESC ";
        }
        $data = array();
        foreach ($rank_info as $index => $rankinfo) {
            $num = $index + 1;
            $hlb_info = $hlb_model->findBySql($sql . " limit " . $index . ",1");
            $memname = $mem_model->findByPk($hlb_info["mem_id"])->mem_name;
            $data[$index][0] = $num;
            $data[$index][1] = mb_substr($memname, 0, 4, 'utf-8') . '**';
            $data[$index][2] = number_format(intval($hlb_info["hlbnum"]));
            $data[$index][3] = intval($rankinfo['rewards_hlb'] / 10000);
        }
        $this->renderPartial('show', array('hlb_info' => $hlb_info, "data" => json_encode($data), "count" => intval($count)));
    }

    /*
     * 推广素材
     */

    function actionMatter() {
        $this->renderPartial('matter');
    }

    /*
     * 加入联盟
     */

    function actionJoin() {
        $web_model = new Web();
        if (isset($_POST['Web'])) {
            foreach ($_POST['Web'] as $_k => $_v) {
                $web_model->$_k = strip_tags(trim($_v));
            }
            if ($web_model->save()) {
                Yii::app()->user->setFlash('msg', 'success');
            }
        }
        $this->renderPartial('join', array("web_model" => $web_model), '', $processOutput = TRUE);
    }

}
