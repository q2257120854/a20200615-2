<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><、后台></title>
        <link href="/style/authority/login_css.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/scripts/jquery/jquery-1.7.1.js"></script>
        <style>
            div .errorMessage{color:red;}
            label .required{color:red;}
        </style>
    </head>
    <?php $this->layout = false; ?>
    <body>
        <div id="login_center">
            <div id="login_area">
                <div id="login_box">
                    <div id="login_form">
                        <?php
                        $form = $this->beginWidget('CActiveForm');
                        ?>
                        <div id="login_tip">
                            <span id="login_err" class="sty_txt2"></span>
                        </div>
                        <div class="kuan">
<!--                             'autocomplete' => 'off',-->
                            <?php echo $form->labelEx($account_login, 'username'); ?>  
                            <?php echo $form->textField($account_login, 'username', array('class' => 'email', 'size' => 15, 'autocomplete' => 'off')); ?>
                            <?php echo $form->error($account_login, 'username'); ?>
                        </div>
                        <div class="kuan">
                            <?php echo $form->labelEx($account_login, 'password'); ?>
                            <?php echo $form->passwordField($account_login, 'password', array('class' => 'pwd',  'size' => 15, 'autocomplete' => 'off')); ?>
                            <?php echo $form->error($account_login, 'password'); ?>
                        </div>
                        <div class="kuan">
                            <?php echo $form->labelEx($account_login, 'verifyCode'); ?>
                            <?php echo $form->textField($account_login, 'verifyCode', array('maxlength' => 4, 'class' => 'verifyCode')); ?>   
                            <?php
                            $this->widget('CCaptcha', array('showRefreshButton' => false,
                                'clickableImage' => true, 'imageOptions' => array('alt' => '点击换图', 'title' => '点击换图',
                                    'style' => 'cursor:pointer;padding:px 0;padding:4px 0;background:#fff;display:inline-block;margin-bottom:3px')));
                            ?>
                            <?php echo $form->error($account_login, 'verifyCode'); ?>
                        </div class="kuan">
                        <div id="btn_area">
                            <button class="login_btn" type="submit">登  录</button>
                        </div>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
        </div>
       </body>
</html>

