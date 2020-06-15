<?php echo TITBB; ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>《<?php echo $game_info['name']; ?>》-试玩平台-chaoyouwan-官方网站</title>
        <meta name="keywords" content="<?php echo $game_info['name']; ?>，<?php echo $game_info['name']; ?>试玩" />
        <meta name="description" content="<?php echo mb_substr(strip_tags($game_info['introduce']), 1, 200, "utf-8"); ?>..." />
        <link rel="shortcut icon" href="/Favicon.ico" type="image/x-icon"/>
        <link href="/style/css.css" rel="stylesheet" type="text/css" />
        <script src="/scripts/jQuery.v1.8.3.js"></script>
        <script src="/scripts/js.js"></script>
        <script src="/scripts/public_js.js"></script>
        <script src="/scripts/zzsc.js"></script>
        <script src="/scripts/page.js"></script>
        <script type="text/javascript">
            $(function() {
                show_time();
            });

            function getLocalTime(nS) {
                return new Date(parseInt(nS) * 1000).getTime();
            }

            function show_time() {
                var time_start = getLocalTime(<?php echo $endtime; ?>);//设定开始时间
                var time_end = new Date().getTime(); //设定结束时间(等于系统当前时间)
                //计算时间差
                var time_distance = time_start - time_end;
                if (time_distance > 0) {
                    // 天时分秒换算
                    var int_day = Math.floor(time_distance / 86400000)
                    time_distance -= int_day * 86400000;

                    var int_hour = Math.floor(time_distance / 3600000)
                    time_distance -= int_hour * 3600000;

                    var int_minute = Math.floor(time_distance / 60000)
                    time_distance -= int_minute * 60000;

                    var int_second = Math.floor(time_distance / 1000)
                    // 时分秒为单数时、前面加零
                    if (int_day < 10) {
                        int_day = "0" + int_day;
                    }
                    if (int_hour < 10) {
                        int_hour = "0" + int_hour;
                    }
                    if (int_minute < 10) {
                        int_minute = "0" + int_minute;
                    }
                    if (int_second < 10) {
                        int_second = "0" + int_second;
                    }
                    // 显示时间
                    $("#DD").html(int_day);
                    $("#HH").html(int_hour);
                    $("#MM").html(int_minute);
                    $("#SS").html(int_second);
                    setTimeout("show_time()", 1000);
                } else {
                    $("#DD").html('00');
                    $("#HH").html('00');
                    $("#MM").html('00');
                    $("#SS").html('00');
                }
            }

            /** 刷新等级数据 **/
            function grade(memid, gid) {
                $("#ref").show();
                $.ajax({
                    type: "POST",
                    data: {"memid": memid, "gid": gid, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken ?>'},
                    url: "<?php echo SITE_URL; ?>game/grade55e5",
                    success: function(json) {
                        location.reload();
                        $("#ref").hide();
                    }
                });
            }
            /** 领取奖励 **/
            function rewards(gameid, memid, level) {
                $.ajax({
                    type: "POST",
                    data: {"gameid": gameid, "memid": memid, "level": level, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken ?>'},
                    url: "<?php echo SITE_URL; ?>game/rewards",
                    success: function(json) {
                        alert(json);
                        location.reload();
                    }
                });
            }
        </script>
    <link rel="shortcut icon" href="/favicon.ico" />
</head>
    <body style=" background:#f4f4f4;">
          <?php include_once("header.php") ?>
		
            <iframe id="iframeId" style="width:100%;height:3000px;background-color:white;overflow:hidden;  position: absolute;
  margin-top: -50px;
  z-index: 2;" scrolling="no"  frameborder="0" src="<?php echo $game_info['networkurl']; ?>&userid=<?php echo $mem['id']; ?>"></iframe> 
		
       
       
    </body>
</html>
