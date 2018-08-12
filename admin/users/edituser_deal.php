<?php 
header('content-type:text/html;charset=utf-8');
include_once '../include/session.php';
// print_r($_POST);
// die();
$email = $_POST['email'];
$slug = $_POST['slug'];
$nickname = $_POST['nickname'];
$state = $_POST['state'];
$id = $_POST['id'];
$sql = "update ali_admin set admin_email='$email', admin_slug='$slug', admin_nickname='$nickname', admin_state='$state' where admin_id=$id";
include_once '../include/mysqli.php';
$result_bool = mysqli_query($conn, $sql);
if ($result_bool) {
    echo 1;
} else {
    echo 2;
}

?>