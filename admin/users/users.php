<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">  
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="/template/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/template/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/template/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/template/assets/css/admin.css">
  <script src="/template/assets/vendors/nprogress/nprogress.js"></script>
  <script src="/template/assets/module/dels.js" ></script>
</head>
<body>
  <script>NProgress.start()</script>
<?php include_once '../include/session.php'; ?>
  <div class="main">
    <nav class="navbar">
    <?php include_once '../include/nav.php' ?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>用户</h1>
        <input type="button" value="添加新管理员" id="add_btn">
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
               <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>昵称</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
      <?php include_once '../include/aside.php'; ?>
  </div>
  <script src="/template/assets/vendors/layer/jquery-1.12.4.min.js"></script>
  <script src="/template/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/template/assets/vendors/layer/template-web.js"></script>
  <script type="text/javascript" src="/template/assets/vendors/layer/layer.js"></script>

        <script type="text/template" id="tpl">
              {{each list as v}}
                  <tr>
                    <td class="text-center"><input type="checkbox"></td>
                    <td class="text-center"><img class="avatar" src="/template/assets/img/default.png"></td>
                    <td>{{v.admin_email}}</td>
                    <td>{{v.admin_slug}}</td>
                    <td>{{v.admin_nickname}}</td>
                    <td>{{v.admin_state}}</td>
                    <td class="text-center">
                      <a href="javasctipt:;" data="{{v.admin_id}}" class="btn edit btn-default btn-xs">编辑</a>
                      <a href="javascript:;" data="{{v.admin_id}}" class="btn del btn-danger btn-xs">删除</a>
                    </td>
                  </tr>
              {{/each}}
          </script>
  <script>
    // 参数1 后端地址
    // 参数2 发送的文件
    // 参数3 回调函数
    // 参数4 设置后端的返回值
     $.post('getUserList.php', function (msg) {
       var json = {"list":msg};
       var str = template('tpl', json);
       $('tbody').html(str);
    }, 'json');
    // 添加用户  主页面点击事件
    // 1. 首先在页面上建立一个input button 标签
    // 2. 给添加 标签设置鼠标点击事件;
    // 3. 调用layer插件 设置点击添加后 弹出 表单添加页;
    $('#add_btn').click(function () {
      console.log(1);
          layer.open({
              type: 2,
              title: '添加管理员',
              maxmin: true,
              area: ['400px', '490px'],
              content: 'addusers.php',
          });
    // 4. 新建页面 填入layer方法的content中
    })
    // 删除部分
    require(['../../assets/model/dels'], function () {
      func();
    })
    // 获取删除给页面上的每个删除按钮绑定鼠标点击事件
    // 因为目前的页中的删除按钮都时通过模版引擎动态创建的,
    // 无法直接获取到,所以这里需要事件代理
    // 1. 获取页上的tbody 元素节点, 绑定点击事件并代理到所有的删除按钮上 并将id通过元素的自定义属性添加到 标签中
    // $('tbody').on('click', '.del', function () {
    //   // 点击按钮后通过获取当前按钮通过attr获取自定义属性(id)值
    //   var id = $(this).attr('data');
    //   _this = $(this);
    //   //  发送ajax请求, 并将要删除的元素的id通过ajax发送到后端
    //   layer.confirm("是否确认删除管理员", function () { 
    //   $.get('delusers.php', {id: + id, '_': Math.random()}, function (msg) {
    //     // 
    //       console.log(msg);
    //       //判断当 msg==1 时
    //       if (msg == 1 ) {
    //         // 当msg==1 时说明删除成功 通过layer.alert 弹出删除成功
    //         layer.alert("管理员删除成功");
    //         // 将页面上的对应项(tr)删除,(因为$.get 中的this指向为 $.get需要将this在上面($.get外)转存一下)
    //         // 通过查找父元素将整个tr标签移除;
    //         _this.parent().parent().remove();
    //       } else {
    //         // 当结果不 == 1 的时候 弹出提示 管理员删除失败;
    //         layer.alert("管理员删除失败");
    //       }
    //   })
    // });
    // })
    // 2. 接收返回的结果判断 当msg== 1 时  执行删除成功的代码 
    // 3. 点击删除 弹出选择框 提示"是否确认删除"点击确认继续执行后面的 代码
    
    // 4. 删除失败时执行弹出"删除失败码";

    $('tbody').on('click', '.edit', function () {
      // 1.获取id
      var admin_id = $(this).attr('data');
      // alert(admin_id);
      // 弹出层
    layer.ready(function(){ 
      layer.open({
              type: 2,
              title: '添加管理员',
              maxmin: true,
              area: ['400px', '480px'],
              content: 'editusers.php?id=' + admin_id,
          });
      });
    }) 
  </script>
  <script>NProgress.done()</script>
</body>
</html>
