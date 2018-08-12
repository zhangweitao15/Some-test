<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Comments &laquo; Admin</title>
  <link rel="stylesheet" href="/template/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/template/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/template/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/template/assets/css/admin.css">
  <script src="/template/assets/vendors/nprogress/nprogress.js"></script>
  <script src="/template/assets/vendors/jquery/jquery.js"></script>
  <script src="/template/assets/vendors/layer/template-web.js"></script>

</head>
<body>
  <script>NProgress.start()</script>
<?php
    // 引入session 验证
include_once '../include/session.php' ?>
  <div class="main">
    <nav class="navbar">
      <?php
       include_once '../include/nav.php'?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有评论</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <div class="btn-batch" style="display: none">
          <button class="btn btn-info btn-sm">批量批准</button>
          <button class="btn btn-warning btn-sm">批量拒绝</button>
          <button class="btn btn-danger btn-sm">批量删除</button>
        </div>
        <ul class="pagination pagination-sm pull-right">
          <li><a href="#">上一页</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">下一页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>作者</th>
            <th>评论</th>
            <th>评论在</th>
            <th>提交于</th>
            <th>状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php' ?>
  </div>

  <script src="/template/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script type="text/template" id="tpl" >
    {{if code == 200}}
      {{each data as v }}
      <tr class="danger">
        <td class="text-center"><input type="checkbox"></td>
        <td>{{v.member_name}}</td>
        <td>{{v.cmt_content}}</td>
        <td>{{v.article_title}}</td>
        <td>{{v.cmt_addtime}}</td>
        <td>{{v.cmt_state}}</td>
        <td class="text-center">
          <a href="post-add.html" class="btn btn-info btn-xs">批准</a>
          <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
        </td>
      </tr>
      {{/each}}
    {{else}}
      <tr><td colspan="7" align="center" >{{msg}}</td></tr>
    {{/if}}
  </script>
  <script>NProgress.done()</script>
  <script>
    // 向后端发送ajax请求 获取评论 数据参数1 请求的的后端页面地址, 参数2 传输的数据,因为这里是获取数据后端服务器中的所有数据所以没有数据发送不用写, 参数3 文件传输成功后触发的回调函数,其参数是后端处理页的返回值, 因为大多数的返回值都属json格式 参数4 设置为jso方式接收后端返回的结果
  $.post('/template/admin/api/comments/getCmt.php', function (msg) {
    console.log(msg);
      // 这里data已经是一个json了所以不用包装了l
      // 使用模板引擎将数据添加到页面上
      // 1. 引入模板引擎库文件
      // 2. 定义模板  拼接页面上所需要是结构
      // 3. 调用template方法将模板和后端返回的json字符串融合
      var str = template('tpl', msg);
      // 4. 将将融合后的模板添加大页面上;
      $('tbody').html(str);
  }, 'json')
  </script>
</body>
</html>
