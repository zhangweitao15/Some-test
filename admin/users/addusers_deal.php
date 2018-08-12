<?php
// 接收数据
header('content-type:text/html;charset=utf-8');
include_once '../include/session.php';
$email = $_POST['email'];
$slug = $_POST['slug'];
$nickname = $_POST['nickname'];
$pwd = $_POST['password'];
$state = $_POST['state'];
// 拼接sql
$sql = "insert into ali_admin(admin_id, admin_email, admin_slug, admin_nickname, admin_pwd, admin_state) values(null, '$email', '$slug', '$nickname', '$pwd', '$state')";
// 链接服务器 执行sql
include_once '../include/mysqli.php';
$resutl_bool = mysqli_query($conn, $sql);
// 判断结果返货给前端页面 成功返回1 失败返回2
if ($resutl_bool) {
    echo 1;
} else {
    echo 2;
};

?>