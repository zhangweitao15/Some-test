<?php 

header('content-type:text/html;charset=utf-8');
include_once '../include/session.php';
//接收
$id = $_GET['id'];
// 拼接 
$sql = "delete from ali_cate where cate_id=$id";
// 链接服务器
include_once '../include/mysqli.php';
$recutl_obj = mysqli_query($conn, $sql);
// 根据SQL执行结果 判断是否成功
if ($recutl_obj) {
    echo "删除栏目成功";
    header('refresh:2;url=categories.php');
} else {
    echo "删除栏目失败";
    header('refresh:2;url=categories.php');
};

?>