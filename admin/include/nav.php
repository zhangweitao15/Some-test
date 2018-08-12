<?php include_once 'session.php'?>
<button class="btn btn-default navbar-btn fa fa-bars"></button>
<ul class="nav navbar-nav navbar-right">
    <li><a href="/template/admin/profile.php"><i class="fa fa-user"></i>个人中心</a></li>
    <li><a href="/template/admin/logout.php"><i class="fa fa-sign-out"></i>退出</a></li>
</ul>
<?php 
$admin_id = $_SESSION['id'];
$sql = "select * from ali_admin where admin_id = $admin_id";
include_once 'mysqli.php';
$result_obj = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($result_obj);
?>
