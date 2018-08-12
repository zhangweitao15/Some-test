<?php 
$sql = 'SELECT c.*,a.article_title,m.member_name FROM ali_comment c
 JOIN ali_member m ON c.cmt_memid=m.member_id
 JOIN ali_article a ON c.cmt_articleid=a.article_id';

include_once '../../include/mysqli.php';
$result_obj = mysqli_query($conn, $sql);
//print_r($result_obj);die;

$arr = [];
while ($row = mysqli_fetch_assoc($result_obj)) {
    $arr[] = $row;
}

if (!empty($arr)) {
    $result = [
        'code' => 200,
        'data' => $arr,
        'message' => null
    ];
} else {
    $result = [
        'code' => 201,
        'data' => null,
        'message'  => '没有评论数据'
    ];
}

echo json_encode($result);
?>