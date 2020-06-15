<?php
error_reporting(0);
include '../other/pass.php';
ini_set('session.cookie_httponly', 1);
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

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>后台管理中心</title>
    <link rel="stylesheet" href="./vendor/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="./vendor/font-awesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="./css/styles.css">
    <script src="./vendor/jquery/jquery.min.js"></script>

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
                    <a href="" class="dropdown-item" data-toggle="modal" data-target="#edit-1">
                        <i class="fa fa-lock"></i> 改密
                    </a>
                    <a href="?act=1" class="dropdown-item">
                        <i class="fa fa-lock"></i> 退出
                    </a>
                </div>
            </li>
        </ul>
    </nav>

    <div class="modal fade" id="edit-1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">改密</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        	
            <div class="modal-body">
                <label for="name" class="form-control-label">账号</label>
                <input id="name" name="name" class="form-control" value="" placeholder="请输入新账号">
                <label for="passwd" class="form-control-label">旧密码</label>
                <input id="passwd" name="passwd" class="form-control" value="" placeholder="请输入旧密码">
                <label for="pass" class="form-control-label">新密码</label>
                <input id="pass" name="pass" class="form-control" value="" placeholder="请输入新密码">
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">取消</button>
                <button type="button" id="end" data-dismiss="modal" class="btn btn-primary">保存</button>
            </div>
        </div>
    </div>
</div>

    <div class="main-container">
	
		<!--导航开始-->
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-title">基础</li>

                    <li class="nav-item">
                        <a href="index.php" class="nav-link active">
                            <i class="icon icon-speedometer"></i> 首页
                        </a>
                    </li>

					<li class="nav-item">
                        <a href="del.php" class="nav-link">
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

        <!--仪表开始-->
		<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card p-4">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="h4 d-block font-weight-normal mb-2">0</span>
                                    <span class="font-weight-light">会员总数</span>
                                </div>

                                <div class="h2 text-muted">
                                    <i class="icon icon-people"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card p-4">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="h4 d-block font-weight-normal mb-2">0</span>
                                    <span class="font-weight-light">图片数量</span>
                                </div>

                                <div class="h2 text-muted">
                                    <i class="icon icon-wallet"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card p-4">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="h4 d-block font-weight-normal mb-2">0</span>
                                    <span class="font-weight-light">聊天记录</span>
                                </div>

                                <div class="h2 text-muted">
                                    <i class="icon icon-cloud-download"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card p-4">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="h4 d-block font-weight-normal mb-2">0Mb</span>
                                    <span class="font-weight-light">内存占用</span>
                                </div>

                                <div class="h2 text-muted">
                                    <i class="icon icon-compass"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<!--仪表结束-->
				
				<!--信息开始-->
				<div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                服务器信息
                            </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
										<td>服务器系统</td>
                                        <td class="text-nowrap">
                                            <?php $os = explode(" ", php_uname()); echo $os[0];?>
                                              (
                                            <?php if('/'==DIRECTORY_SEPARATOR){echo $os[2];}else{echo $os[1];} ?>
                                              )
                                        </td>
                                        <td>服务器读写权限</td>
                                        <td><?php echo is_writable('../config/webset.php') ? '<span style="color: green;">可写</span>' : '<span style="color: red;">不可写</span>'?></td>
                                    </tr>
                                    <tr>
                                        <td>服务器解释引擎</td>
                                        <td class="text-nowrap"><?php echo $_SERVER['SERVER_SOFTWARE'];?></td>
                                        <td>PHP运行版本</td>
                                        <td><?php echo PHP_VERSION?></td>
                                    </tr>
                                    <tr>
                                        <td>当前版本</td>
                                        <td class="text-nowrap">v1.1</td>
                                        <td>授权类型</td>
                                        <td>影视聊天室</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<!--信息结束-->
			
			<!--广告开始-->
				<div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <a href="http://awys.com" target="_blank">影视后台</a>
                            </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody id="cn-gg">
                                    <tr>
										<td><a href="#" target="_blank">无</a></td>
                                        <td><a href="#" target="_blank">无</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" target="_blank">无</a></td>
                                        <td><a href="#" target="_blank">无</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<!--广告结束-->
			
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
<script src="./vendor/popper.js/popper.min.js"></script>
<script src="./vendor/bootstrap/home.js"></script>
<script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="./vendor/chart.js/chart.min.js"></script>
<script src="./js/carbon.js"></script>
<script src="./js/demo.js"></script>
</body>
</html>
