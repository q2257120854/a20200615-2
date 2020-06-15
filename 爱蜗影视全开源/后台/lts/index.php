<?php 
error_reporting(0);
ini_set('session.cookie_httponly', 1);
session_start();
if (isset($_SESSION['cn_name'])) {
  $size="none";
  $_val=$_SESSION['cn_name'];
}else{
  $size="block";
  $_val="昵称";
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>在线聊天室</title>
<link type="text/css" href="./assets/css/style.css" rel="stylesheet" />
<script src="./assets/js/jquery.min.js"></script>
  <style>
    body{
      margin: 0px;
      height: 100%;
      background: #ccc;
    }
  </style>
</head>

<body>
  
  <div class="box">
    <div class="box-title">
      <h3>在线聊天室</h3>
    </div>
    
    <div class="box-case">
      
      <div class="case-box">
        <span class="case-time">2019-12-02 14:26:58</span>
        <div class="case-left">
          <img src="./assets/img/icon01.png" />
          <span class="case-name">年轻人</span>
          <div class="case-msg">
            <i class="horn"></i>
            你好！
          </div>
        </div>
      </div>
  
      <div class="case-box">
        <span class="case-time">2019-12-02 14:36:58</span>
        <div class="case-right">
          <img class="case-right-img" src="./assets/img/icon01.png" />
          <span class="case-name2">聊天室</span>
          <div class="case-msg2">
            <i class="horn2"></i>
            <img id="msg2-img" src="http://api.btstu.cn/sjbz/?lx=dongman" width="100%" height="100%">
          </div>
        </div>
      </div>
    
    </div>
    
    <div class="box-inpu">
    
      <textarea class="box-text" style= "resize:none" name="text"></textarea>
      <div class="butt">
        <button id="send">发送</button>
        <button id="Nickname">昵称</button>
        <button id="senimg">图片</button>
        <button id="rid"><input id="rids" type="checkbox" checked/>回车发送</button>

      </div>
    </div>

    <div class="box-tips" id="box-tips" style="display:<?php echo $size;?>;">
      <div class="tips-tit">
        设置我的昵称
      </div>
      <input class="ni" type="text" name="" value="<?php echo $_val;?>">
      <button class="nide">保存昵称</button>
    </div>

    <div class="box-tips" id="cn-img" style="display:none;">
      <div class="tips-tit">
        发送图片
      </div>
      <input class="cn-img" type="text" name="cn_img" value="" placeholder="请输入图片地址（http://）">
      <button class="sends">确定</button>
    </div>
    
  </div>

<script type="text/javascript">
var upok = '设置成功';
var upps = '昵称不能为空！';
/*
源码来源：https://lykep.com/index.php/archives/166/
  By-零艺 2019/3/26
 */
</script>
</body>
</html>
