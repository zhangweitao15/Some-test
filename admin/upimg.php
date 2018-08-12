<?php
header('content-type:text/html;charset=utf-8');
include_once './include/session.php';
// 1. 重命名文件 
$pos = strrpos($_FILES['f']['name'], '.');//得到图片文件中最后一个点
$ext = substr($_FILES['f']['name'], $pos);// 取出点后边的所有内容
// 新文件名  时间戳 +随机数 + 上边取出的后缀;
$new_file = time() . rand(1000,9999) . $ext;
// 将上传文件从临时路径移动到目标路径
move_uploaded_file($_FILES['f']['tmp_name'], './upload/' . $new_file);
// 3. 将目标路径返回给前端
// 在img的src属性中使用绝对路径最方便
// 将新文件的路径构造为绝对路径在返回给前端;
     echo '/template/admin/upload/' . $new_file;
?>