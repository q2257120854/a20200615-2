<?php
include '../../includes/common.php';
if ($islogin != 1)
    exit("<script>window.location.href='./login.php';</script>");

$template = $_GET['template'];

if (empty($template))
    exit("<script>window.location.href='./login.php';</script>");

$template = str_replace('.', '', $template);

if (!is_file('./view/' . $template)) {
    include './view/404.php';
    exit();
}