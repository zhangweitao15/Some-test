<?php
header('content-type:text/html;charset=utf-8');
// 接收数据
$eml = $_POST['eml'];
$pwd = $_POST['paw'];
// 验证接收到的数据不为空
if (strlen($eml) == 0) {
    echo 1;
    die;
}
// 判断密码不能为空
if (strlen($pwd) == 0 ) {
    echo 2;
    die;
} 

// 验证邮箱
// 根据 接收到的数据查询
$sql = "select * from ali_admin where admin_email = '$eml'";
include_once 'include/mysqli.php';
// 返回结果只有一条或没有数据;
$result_obj = mysqli_query($conn, $sql);
// 如果有一条数据 则返回关联数组 如果1条数据 返回false
$result = mysqli_fetch_assoc($result_obj);
if (empty($result)) {
    // 邮箱错误;
    echo 3;
} else {
    // 邮箱正确继续验证密码;
    // 使用表单接收到的密码 对比
    // 相等说明正确 正常登陆
    
    if ($pwd == $result['admin_pwd']) {
        // 密码正确
        // 注册session 再跳转
        session_start();
        $_SESSION['id'] = $result['admin_id'];
        $_SESSION['eml'] = $result['admin_email'];
        $_SESSION['name'] = $result['admin_nickname'];
        $_SESSION['pic']      = $result['admin_pic'];
        echo 5;
    } else {
        // 密码错误
        echo 4;
    }
}
// 接收用户名和密码 
// 验证用户名不能为空
// 验证密码不能为空
// 
?>
