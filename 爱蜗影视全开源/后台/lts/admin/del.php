<?php
error_reporting(0);
include '../other/pass.php';
ini_set('session.cookie_httponly', 1);
date_default_timezone_set('PRC');
session_start();
$item=isset($_GET['act'])?$_GET['act']:'';
if ($_pass!=base64_decode($_SESSION['ly_Admin'])) {
   unset($_SESSION['ly_Admin']);
    $_SESSION = [];
    session_destroy();
    header("location:./login.php");
}
if ($item=='1') {
    unset($_SESSION['ly_Admin']);
    $_SESSION = [];
    session_destroy();
    header("location:./login.php");
}
include "../data.php";
$sql = "SELECT * FROM chatnote";
$stmt = $conn->prepare($sql);
$stmt->execute(array());
$_data = "";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>后台管理中心 - 聊天记录</title>
    <link rel="stylesheet" href="./vendor/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="./vendor/font-awesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body class="sidebar-fixed header-fixed">

<div class="page-wrapper">
    <nav class="navbar page-header">
        <a href="#" class="btn btn-link sidebar-mobile-toggle d-md-none mr-auto">
            <i class="fa fa-bars"></i>
        </a>

        <a class="navbar-brand" href="#">
            <img src="./imgs/logo.png" alt="logo">
        </a>

        <a href="#" class="btn btn-link sidebar-toggle d-md-down-none">
            <i class="fa fa-bars"></i>
        </a>

        <ul class="navbar-nav ml-auto">
          
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="./imgs/avatar-1.png" class="avatar avatar-sm" alt="logo">
                    <span class="small ml-1 d-md-down-none">管理员</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="?act=1" class="dropdown-item">
                        <i class="fa fa-lock"></i> 退出
                    </a>
                </div>
            </li>
        </ul>
    </nav>

    <div class="main-container">
	
		<!--导航开始-->
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-title">基础</li>

                    <li class="nav-item">
                        <a href="index.php" class="nav-link ">
                            <i class="icon icon-speedometer"></i> 首页
                        </a>
                    </li>

					<li class="nav-item">
                        <a href="del.php" class="nav-link active">
                            <i class="icon icon-umbrella"></i> 聊天记录
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../" target="_blank">
                            <i class="icon icon-options"></i> 前往聊天室
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
		<!--导航结束-->

        <div class="content">
            <div class="container-fluid">
				
				<!--列表开始-->
				<div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                聊天列表
                            </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
									<thead>
										<tr>
											<th>ID</th>
											<th>用户名</th>
											<th>用户头像</th>
											<th>消息内容</th>
											<th>消息时间</th>
											<th>操作</th>
										</tr>
                                    </thead>
                                    <tbody id="content">
									<?php 
									$i=0;
									while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
									?>
                                    <tr>
										<td id="cid"><?php echo $row['cn_id'];?></td>
                                        <td class="text-nowrap"><?php echo htmlentities($row['cn_name']);?></td>
                                        <td><?php echo htmlentities($row['cn_icon']);?></td>
                                        <td><?php echo htmlentities($row['cn_text']);?></td>
                                        <td><?php echo date("Y-m-d H:i:s",$row['cn_time']);?></td>
                                        <td>
											<button class="btn btn-outline-primary" data-toggle="modal" data-target="#edit-1">删除</button>
										</td>
                                    </tr>
									<?php $i++;}?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<!--列表结束-->
			<!--版权开始-->
				<div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                © 2018-2019 Zero-Art All Rights Reserved
                            </div>
						</div>
					</div>
				</div>
			<!--版权结束-->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">删除</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
		
            <div class="modal-body">
                <label for="del" class="form-control-label">是否要删除该记录？</label>
            </div>
			
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">取消</button>
                <button type="button" id="dels" class="btn btn-primary" data-dismiss="modal">保存</button>
            </div>
        </div>
    </div>
</div>

<script src="./vendor/jquery/jquery.min.js"></script>
<script src="./vendor/popper.js/popper.min.js"></script>
<script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="./vendor/bootstrap/del.js"></script>
<script src="./vendor/chart.js/chart.min.js"></script>
<script src="./js/carbon.js"></script>
<script src="./js/demo.js"></script>
<script>
var inps = "账号密码错误";
</script>
</body>
</html>
