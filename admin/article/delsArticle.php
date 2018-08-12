<?php 
$ids = $_POST['ids'];
$sql = "delete from ali_article where article_id in ($ids)";
include_once '../include/mysqli.php';
$result_bool = mysqli_query($conn, $sql);
if ($result_bool) {
    echo 1;
} else {
    echo 2;
};
?>