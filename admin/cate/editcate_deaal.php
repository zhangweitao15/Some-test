<?php
header('content-type:text/html;charset=utf-8');
include_once '../include/session.php';
// 接收 
$id = $_POST['id'];
$name = $_POST['name'];
$slug = $_POST['slug'];
$icon = $_POST['icon'];
$show = $_POST['show'];
// 拼接SQL
$sql = "update ali_cate set cate_name='$name', cate_slug='$slug', cate_addtime='$icon', cate_show='$show' where cate_id=$id";
// 链接服务器
include_once '../include/mysqli.php';
$result_bool = mysqli_query($conn, $sql);
// 判断结果 提示成功或失败 在进行页面跳转
if ($result_bool) {
    echo "修改完成";
    header('refresh:2;url=categories.php');
} else {
    echo "修该失败";
    header('refresh:2;url=editcate.php?id='. $id);
}

?>