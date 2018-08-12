<?php 
header('content-type:text/html;sharset=utf-8');
// 清除 session
session_start();
session_destroy();

// 跳转到 login.html
header('refresh:1;url=/template/admin/login.php');
die();
?>