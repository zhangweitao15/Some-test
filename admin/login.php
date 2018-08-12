<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="/template/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/template/assets/css/admin.css">
  <script src="/template/assets/vendors/layer/jquery-1.12.4.min.js"></script>
  <script src="/template/assets/vendors/layer/layer.js"></script>
</head>
<body>
  <div class="login">
    <form class="login-wrap">
      <img class="avatar" src="/template/assets/img/default.png">
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong> 用户名或密码错误！
      </div> -->
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" type="email" class="form-control" placeholder="邮箱" autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" type="password" class="form-control" placeholder="密码">
      </div>
      <a class="btn btn-primary btn-block" href="javascript:;">登 录</a>
    </form>
  </div>
</body>
</html>
<script>
  //为登陆按钮注册鼠标点击事件
  $('a').click(function () {
            // 
              var eml = $('#email').val();
              var paw = $('#password').val(); 
  // 2. 通过ajax方法 将内容发送到后端PHP页面
    $.post('login_deal.php', {"eml":eml, "paw":paw}, function (msg) {
      if (msg == 1) {
        layer.alert("账号不能为空");
      } else if (msg == 2) {
        layer.alert("密码不能为空");
      } else if (msg == 3) {
        layer.alert("用户名错误");
      } else if (msg == 4) {
        layer.alert("密码错误");
      } else if (msg == 5) {
        layer.alert("登陆成功", function () {
          // 跳转到 index.php
          location.href = '/template/admin/index.php';
        });
    }
      
      
      // 3. 将返回值通过layer 的方法显示出来 aliert 
      // console.log(msg);
      
      // 4. 在弹出登录成功之前先开启session方法  将邮箱没密码储存在session中
    });
  


  // 开启 session_start
  })
  
</script>
  

