<?php 
include_once 'include/session.php';
// 接收数据
$id = $_SESSION['id'];
$pic = $_POST['img'];
$slug = $_POST['slug'];
$name = $_POST['nickname'];
$sign = $_POST['sign'];
// 拼接sql 
$sql = "update ali_admin set admin_pic='$pic',admin_sign='$sign', admin_slug='$slug', admin_nickname='$name' where admin_id='$id'"  ;
// 链接服务器 并执行sql
include_once 'include/mysqli.php';
$result = mysqli_query($conn, $sql);
// 将结果返回
if ($result) {
    echo 1;
} else {
    echo 2;
};
?>