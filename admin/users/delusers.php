<?php 
header('content-type:text/html;charset=utf-8');
include_once '../include/session.php';
// 接收数据
$id = $_GET['id'];
// 拼接SQL语句
$sql = "delete from ali_admin where admin_id='$id'";
// 链接SQL语句 并执行sql 
include_once '../include/mysqli.php';
$result_bool = mysqli_query($conn, $sql);
// 对结果进行判断 成功返回1 失败返回2;
if ($result_bool) {
    echo 1;
} else {
    echo 2;
};
?>