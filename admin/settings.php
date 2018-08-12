<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>Settings &laquo; Admin</title>
    <link rel="stylesheet" href="/template/assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/template/assets/vendors/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/template/assets/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="/template/assets/css/admin.css">
    <script src="/template/assets/vendors/nprogress/nprogress.js"></script>
</head>

<body>
    <script>
        NProgress.start()
    </script>

    <div class="main">
        <nav class="navbar">
            <?php include_once 'include/nav.php'; ?>
        </nav>
        <div class="container-fluid">
            <div class="page-title">
                <h1>网站设置</h1>
            </div>
            <!-- 有错误信息时展示 -->
            <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
            <?php 
      $sql = 'select * from ';
      include_once 'include/mysqli.php';
      $result = mysqli_query($conn, $sql);
      $result_arr = mysqli_fetch_assoc($result);
      ?>
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="site_logo" class="col-sm-2 control-label">网站图标</label>
                    <div class="col-sm-6">
                        <input id="site_logo" name="site_logo" type="hidden">
                        <label class="form-image">
              <input id="logo" type="file">
              <img src="/template/assets/img/logo.png">
              <i class="mask fa fa-upload"></i>
            </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="site_name" class="col-sm-2 control-label">站点名称</label>
                    <div class="col-sm-6">
                        <input id="site_name" name="site_name" class="form-control" type="type" placeholder="站点名称">
                    </div>
                </div>
                <div class="form-group">
                    <label for="site_description" class="col-sm-2 control-label">站点描述</label>
                    <div class="col-sm-6">
                        <textarea id="site_description" name="site_description" class="form-control" placeholder="站点描述" cols="30" rows="6"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="site_keywords" class="col-sm-2 control-label">站点关键词</label>
                    <div class="col-sm-6">
                        <input id="site_keywords" name="site_keywords" class="form-control" type="type" placeholder="站点关键词">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">评论</label>
                    <div class="col-sm-6">
                        <div class="checkbox">
                            <label><input id="comment_status" name="comment_status" type="checkbox" checked>开启评论功能</label>
                        </div>
                        <div class="checkbox">
                            <label><input id="comment_reviewed" name="comment_reviewed" type="checkbox" checked>评论必须经人工批准</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-6">
                        <button type="submit" class="btn btn-primary">保存设置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="aside">
        <?php include_once 'include/aside.php'; ?>
    </div>

    <script src="/template/assets/vendors/jquery/jquery.js"></script>
    <script src="/template/assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script>
        $.post('/template/admin/api/site/getSite.php', function () {
            $('#logo_img').attr('stc', msg.data.site_logo);
            $('#site_name').val(msg.data.site_name);
            $('#site_descripption').val(msg.data.site_descripption);
            $('#site_keuwords').val(msg.data.site_keuwords);
            if (msg.data.site_status == 1) {
                $('#comment_status').attr('checked', 'checked');
            } ;
            if (msg.data.site_reviewed) {
                $('#comment_reciewed').attr('checked', 'checked');
        }, 'json');

        $('.btn-primary').click(function() {
            // 获取表示DOM对象
            var fm = $('form')[0];
            // 实例化FormData对象
            var fd = new FormData(fm);
            $.ajax({
                url: '/template/admin/api/site/getSite.php',
                type: 'post',
                data: fd,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(msg) {
                    console.log(msg);

                }
            })
        })
    </script>
    <script>
        NProgress.done()
    </script>
</body>

</html>