<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <?php include_once './include/session.php' ?>
  <title>Dashboard &laquo; Admin</title>
  <link rel="stylesheet" href="/template/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/template/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/template/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/template/assets/css/admin.css">
  <script src="/template/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
    <?php 
    // 将通过id 获取对应的数据卸载nav中 所以就不用在session中存储图片的地址了
    include_once './include/nav.php';
    
    ?>

    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>我的个人资料</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form action="upprofile.php" method="post" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-3 control-label">头像</label>
          <div class="col-sm-6">
            <label class="form-image">
              <input id="avatar" type="file">
              <img id="file_pic" src="<?php echo $result['admin_pic'] ?>">
              <input type="hidden" name="img" id="img">
              <i class="mask fa fa-upload"></i>
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-3 control-label">邮箱</label>
          <div class="col-sm-6">
            <input id="email" class="form-control" name="email" type="type" value="<?php echo $result['admin_email'] ?>" placeholder="邮箱" readonly>
            <p class="help-block">登录邮箱不允许修改</p>
          </div>
        </div>
        <div class="form-group">
          <label for="slug" class="col-sm-3 control-label">别名</label>
          <div class="col-sm-6">
            <input id="slug" class="form-control" name="slug" type="type" value="<?php echo $result['admin_slug'] ?>" placeholder="slug">
          </div>
        </div>
        <div class="form-group">
          <label for="nickname" class="col-sm-3 control-label">昵称</label>
          <div class="col-sm-6">
            <input id="nickname" class="form-control" name="nickname" type="type" value="<?php echo $result['admin_nickname'] ?>" placeholder="昵称">
            <p class="help-block">限制在 2-16 个字符</p>
          </div>
        </div>
        <div class="form-group">
          <label for="bio" class="col-sm-3 control-label">简介</label>
          <div class="col-sm-6">
            <textarea id="bio" name="sign" class="form-control" placeholder="bod" cols="30" rows="6"><?php echo $result['admin_sign'] ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-6">
            <input type="button" class="btn btn-primary"  value="更新">
            <a class="btn btn-link" href="password-reset.html">修改密码</a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once './include/aside.php' ?>
  </div>

  <script src="/template/assets/vendors/layer/jquery-1.12.4.min.js"></script>
  <script src="/template/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/template/assets/vendors/layer/layer.js" ></script>
  <script>NProgress.done()</script>
  <script>
  // 给文件域注册change事件 
      $('#avatar').change(function () {
        // 2. 获取文件对象
        // 用单独取文件的方式
        // 在文件域对象中有files 属性, 该属性以伪数组的形式保存了说有上传的文件
        var file_obj = document.getElementById('avatar').files[0];
        // 实例化一个 空 FormData
        var fd = new FormData();
        // 将文件对象追加到空的FormData中;
        // 参数1 key
        // 参数2 value
        fd.append('f', file_obj);
        // 发送Ajax  并将文件一起发送到后端
        $.ajax({
          url: 'upimg.php',
          data: fd,
          type: 'post',
          dataType: 'text',
          contentType: false,
          processData: false,
          success: function (msg) {
            console.log(msg);
            // 将路径写入到img的src中
            $('#file_pic').attr('src', msg);
            $('#hide').attr('value', msg);
            // 创建一个input隐藏域,name"img" id"img"
            // 获取这个文件域对象
            $('#img').val(msg);
          }
        });
      });
       // 为更新按钮注册鼠标点击事件 
       $('.btn-primary').click(function () {
                // 点击后获取form 表单的DOM对象
                var fm = $('form')[0];
                // 实例化FormData对象将表单对象传入
                var fd = new FormData(fm);
                console.log(fd);
                
                // 发送Ajax请求给后端页面
                $.ajax({
                  url: 'upprofile.php',
                  data: fd,
                  type: 'post',
                  dataType: 'text',
                  contentType: false,
                  processData: false,
                  success: function (msg) {
                    console.log(msg);
                    if (msg == 1) {
                        layer.alert("更新完成",{icon:6}, function (index) {
                          layer.close(index);
                          location.reload();
                        });

                    } else {
                      layer.alert("信息提交失败"),{icon:6};
                      layer.close(index);
                    }
                    
                  } 
                })
                // 接收返回值弹窗提示;
       })

  </script>
</body>
</html>
