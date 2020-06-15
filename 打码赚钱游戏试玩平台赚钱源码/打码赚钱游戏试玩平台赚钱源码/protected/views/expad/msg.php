、<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script type="text/javascript">
            window.onload = function() {
                var msg = $('#msg').val();
                if (msg != null) {
                    alert(msg);
                    location.href = '<?php echo SITE_URL . "game/show"; ?>';
                }
            }
        </script>
    </head>
    <body>
        <?php
        if (Yii::app()->user->hasFlash('msg')) {
            ?>
            <input type="hidden" value="<?php echo Yii::app()->user->getFlash('msg') ?>" id="msg" />
        <?php } ?>
    </body>
</html>
