<?php 
// 接收前端发送的数据 并将表单中没有的 数据表中需要的数据手动添加上
$title    = $_POST['title'];// 标题
$text     = $_POST['text']; // 文门内容
$desc     = $_POST['desc'];//摘要
$img      = $_POST['img'];//图片文件
$category = $_POST['category'];//所属栏目
$status   = $_POST['status'];//状态
// 开启session 当前作者的id;
session_start();
// 获取当前编辑的作者的id
$adminid = $_SESSION['id'];
// 手动添加 数据表中没有但是后端需要的数据
$time    = date('Y-m-d H:i:s', time()); //提交时间 直接获取时间戳,并转换为年月日时分秒格式
$click   = rand(300, 1000);// 点击量设置为, 300到1000之间的随机数;
$good    = rand(100, 300);// 好评数100~300之间的随机数
$bad     = rand(10, 30);// 差评 10~到30之间随机数
$cmt     = rand(10, 50);// 10 - 50之间的随机数
$focus   = 1; //是否热门
// 编写sql  语句 
$sql = "insert into ali_article values(null, '$title', '$text', $adminid, $category, '$time', '$status', '$img', '$desc', $click, $good, $bad, $cmt, $focus)";
// 链接服务器 并执行SQL
include_once '../include/mysqli.php'; // 链接服务器 
$result_bool = mysqli_query($conn, $sql);// 执行sql 
// 判断返回值并将结果返回给前端
if ($result_bool) {
    echo 1;
} else {
    echo 2;
};
?>