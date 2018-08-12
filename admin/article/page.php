<?php 
$pageno = $_POST['page'];
$pagesize = 5;
// 运算查询起始点
$start = ($pageno - 1) * $pagesize;
$sql = "select ali_article.*,ali_admin.admin_nickname,ali_cate.cate_name from ali_article 
         join ali_admin on ali_article.article_adminid=ali_admin.admin_id
         join ali_cate on ali_article.article_cateid=ali_cate.cate_id
         limit $start, $pagesize";
include_once '../include/mysqli.php';
$result_obj = mysqli_query($conn, $sql);

//所有多条数据的对象都转为二维数组，再转json返回给前端
$arr = array();
while($row = mysqli_fetch_assoc($result_obj)){
    array_push($arr, $row);
}

echo json_encode($arr);
?>