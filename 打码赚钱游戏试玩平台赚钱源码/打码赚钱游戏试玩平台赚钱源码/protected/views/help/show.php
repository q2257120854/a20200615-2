<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo Helptype::model()->findByPk($_GET['id'])->name; ?>-<?php echo TIT; ?>官方网站</title>
        <meta name="keywords" content="\" />
              <meta name="description" content="\" />
              <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
            <link href="/style/public.css" rel="stylesheet" type="text/css" />
            <link href="/style/help.css" rel="stylesheet" type="text/css" />
            <script src="/scripts/jQuery.v1.8.3.js"></script>
            <script src="/scripts/public_js.js"></script>
            <script type="text/javascript">
                // 收缩展开效果 
                $(document).ready(function() {
                    $(".main .help .help_right .cont_1 .ul_1 .title").toggle(function() {
                        $(this).next(".p_2").animate({height: 'toggle', opacity: 'toggle'}, "slow");
                    }, function() {
                        $(this).next(".p_2").animate({height: 'toggle', opacity: 'toggle'}, "slow");
                    });
                });
            </script> 
    </head>
    <body>
        <?php include_once("./protected/views/design/header.php") ?>
        <!--主体-->
        <div class="main">
            <div class="help clearfix">
                <div class="help_left">
                    <ul class="ul_1">
                        <?php
                        $helptypeinfo = Helptype::model()->findAll();
                        foreach ($helptypeinfo as $helptype) {
                            ?>
                            <li <?php
                            if ($id == $helptype['id']) {
                                echo "class='hover'";
                            };
                            ?>><a href="<?php echo SITE_URL; ?>help/show/id/<?php echo $helptype['id']; ?>"><?php echo $helptype['name']; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="help_right">
                    <div class="position">
                        <span><a href="<?php echo SITE_URL; ?>">首页</a></span>
                        <i>&nbsp;>&nbsp;</i>
                        <a href="<?php echo SITE_URL; ?>help/show">帮助中心</a>
                        <i>&nbsp;>&nbsp;</i>
                        <a href="<?php echo SITE_URL; ?>help/show/id/<?php echo $id; ?>"><?php echo Helptype::model()->findByPk($id)->name; ?></a>
                    </div>
                    <div class="cont_1">
                        <ul class="ul_1">
                            <?php foreach ($posts as $model) { ?>
                                <li>
                                    <p class="title clearfix" onclick="con(<?php echo $model["id"]; ?>);">
                                        <span class="name"><?php echo $model['quiz']; ?></span>
                                    </p>
                                    <div class="p_2" ><?php echo $model['answer']; ?></div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div style="text-align: center;height: 30px;">
                        <?php
                        if ($pages->itemCount == 0) {
                            echo "当前内容为空！";
                        } else {
                            $this->widget('CLinkPager', array('pages' => $pages));
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
        <?php include_once("./protected/views/design/footer.php") ?>
        <?php include_once("./protected/views/design/kefu.php") ?>
    </body>
</html>