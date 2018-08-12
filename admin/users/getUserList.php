<?php
header('content-type:text/html;charset=utf-8');
include_once '../include/session.php';
include_once '../include/mysqli.php';
$sql = "select * from ali_admin";
$result_obj = mysqli_query($conn, $sql);
$arr = [];
while ($row = mysqli_fetch_assoc($result_obj)) {
    array_push($arr, $row);
};
echo json_encode($arr);
?>