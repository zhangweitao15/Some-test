<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>Add new post &laquo; Admin</title>
    <link rel="stylesheet" href="/template/assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/template/assets/vendors/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/template/assets/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="/template/assets/css/admin.css">
    <script src="/template/assets/vendors/nprogress/nprogress.js"></script>
    <link href="/template/assets/vendors/ueditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="/template/assets/vendors/ueditor/third-party/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/template/assets/vendors/ueditor/umeditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/template/assets/vendors/ueditor/umeditor.min.js"></script>
    <script type="text/javascript" src="/template/assets/vendors/ueditor/lang/zh-cn/zh-cn.js"></script>
</head>

<body>
    <script>
        NProgress.start()
    </script>

    <div class="main">
        <nav class="navbar">
            <?php include_once '../include/nav.php'; ?>
        </nav>
        <div class="container-fluid">
            <div class="page-title">
                <h1>写文章</h1>
            </div>
            <!-- 有错误信息时展示 -->
            <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
            <form class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="title">标题</label>
                        <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
                    </div>
                    <div class="form-group">
                        <label for="desc">摘要</label>
                        <input id="desc" class="form-control input-lg" name="desc" type="text" placeholder="文章摘要">
                      </div>
                    <div class="form-group">
                        <!-- <label for="content">标题</label> -->
                        <textarea id="content" name="text" class="form-control "></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="slug">别名</label>
                        <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
                        <p class="help-block">https://zce.me/post/<strong>slug</strong></p>
                    </div>
                    <div class="form-group">
                        <label for="feature">特色图像</label>
                        <!-- show when image chose -->
                        <img id="file_pic" class="help-block thumbnail">
                        <input id="feature" class="form-control" name="feature" type="file">
                        <input type="hidden" name="img" id="img" >
                    </div>


                    <?php
          $sql="select * from ali_cate";
          include_once '../include/mysqli.php';
          $result_obj=mysqli_query($conn,$sql);
          ?>
                        <div class="form-group">

                            <label for="category">所属分类</label>

                            <select id="category" class="form-control" name="category">
              <?php while($row=mysqli_fetch_assoc($result_obj)){?>
              <option value="1"><?php echo $row['cate_name']; ?></option>
              <?php } ?>
            </select>

                        </div>
                        <div class="form-group">
                            <label for="created">发布时间</label>
                            <input id="created" class="form-control" name="created" type="datetime-local">
                        </div>
                        <div class="form-group">
                            <label for="status">状态</label>
                            <select id="status" class="form-control" name="status">
              <option value="草稿">草稿</option>
              <option value="已发布">已发布</option>
            </select>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" value="保存" type="button">
                        </div>
                </div>
            </form>
        </div>
    </div>

    <div class="aside">
        <?php include_once '../include/aside.php'?>
    </div>

    <script src="/template/assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script src="\template\assets\vendors\layer\jquery-1.12.4.min.js" ></script>
    <script src="\template\assets\vendors\layer\layer.js" ></script>
    <script>
        var um = UM.getEditor('content', {
            initialFrameWidth: '100%',
            initialFrameHeight: 310
        });
        // 为文件域注册change(改变)事件
        $('#feature').change(function() {
            // 事件触发触发后 通过文件域对象的files方法 提交的文件信息;
            var file_obj = $(this)[0].files[0];
            // 实例化一个FormData空空对象
            var fd = new FormData;
            // 将上面获取的文件对象, 追加到FormData对象中
            fd.append('f',file_obj);
            $.ajax({
                url: 'upimg.php',
                data: fd,
                type: 'post',
                dataType: 'text',
                contentType: false,
                processData: false,
                success: function(msg) {
                    console.log(msg);
                    // 将路径写入到img的src中
                    $('#file_pic').attr('src', msg);
                    // 在文件域的下方创建一个input 隐藏域 用于保存后端返回的文件路径;
                    // 获取这个img文件 将后端返回的 图片路径设置到img文件的value中
                    $('#img').val(msg);
                }
            });
        });
        // 将页面上填入的数据提交到后端处理页面
        // 1. 首先为保存按钮注册点击事件
        $('.btn').click(function () {
          // 2. 点击后获取页面上form表单dom对象
          var fm = $('.row')[0];
          // 因为表单中有文件上传需要使用FormData提交表单数据所以
          // 3. 实例化form表单FormData对象
          var fd = new FormData(fm);
          // 4. 发送ajax请求
          $.ajax({
            url: 'addpost_deal.php',
            type: 'post',
            data: fd,
            dataType: 'text',
            contentType: false,
            processData: false,
            success: function (msg) {
                if (msg == 1) {
                    layer.alert('文章保存成功');
                } else {
                    layer.alert('文章添加失败');
                };
            }
          })
        });
        
    </script>
    <script>
        NProgress.done()
    </script>
</body>

</html>