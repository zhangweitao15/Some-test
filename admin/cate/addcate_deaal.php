<?php
header('content-type:text/html;charset=utf-8');
include_once '../include/session.php';
// 接收 
$name = $_POST['name'];
$slug = $_POST['slug'];
$icon= $_POST['icon'];
$show = $_POST['show'];
$time = time();
// 编写sql
$sql = "insert into ali_cate value(null, '$name', '$slug', $time, '$icon', $show)";
// 链接服务器 执行sql
include_once '../include/mysqli.php';
$result_bool = mysqli_query($conn, $sql);

// 判断sql执行结果 提示成功或shibai
if ($result_bool) {
    echo "添加成功";
    header('refresh:2;url=categories.php');
} else {
    echo "添加失败";
    header('refresh:2;url=addcate.php');
}
?>