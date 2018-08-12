<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <?php include_once '../include/session.php' ?>
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href="/template///assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/template///assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/template///assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/template///assets/css/admin.css">
  <script src="/template///assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
     <?php include_once '../include/nav.php' ?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <!-- <h1>分类目录</h1> -->
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-4">
          <?php
          // 接收
          $id = $_GET['id'];
          // SQL语句 
          $sql = "select * from ali_cate where cate_id=$id";
          // 链接服务器执行SQL
          include_once '../include/mysqli.php';
          $recult_obj = mysqli_query($conn, $sql);
          $cate_arr = mysqli_fetch_assoc($recult_obj);
          // 将查询结果填写到表单中
          ?>
          <form action="editcate_deaal.php" method="post">
            <h2>添加目录</h2>
            <input type="hidden" name="id" value="<?php echo $cate_arr['cate_id']; ?>" >
            <div class="form-group">
              <label for="name">名称</label>
              <input value="<?php echo $cate_arr['cate_name'] ?>" id="name" class="form-control" name="name" type="text" placeholder="分类名称">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input value="<?php echo $cate_arr['cate_slug'] ?>" id="slug" class="form-control" name="slug" type="text" placeholder="slug">
            </div>
            <div class="form-group">
              <label for="icon">图标</label>
              <input value="<?php echo $cate_arr['cate_icon'] ?>" id="icon" class="form-control" name="icon" type="text" placeholder="icon">
            </div>
            <div class="form-group">
              <label for="show">是否显示</label>
              <?php if ($cate_arr['cate_show'] == 1) { ?>
              <input name="show" type="radio" value="1" checked >显示
              <input name="show" type="radio" value="2">不显示
              <?php } else { ?>
                <input name="show" type="radio" value="1">显示
                <input name="show" type="radio" value="2" checked>不显示
              <?php } ?>
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">修改</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
   <?php 
   include_once '../include/aside.php';
   ?>
  </div>

  <script src="/template///assets/vendors/jquery/jquery.js"></script>
  <script src="/template///assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
