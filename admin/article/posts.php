<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>Posts &laquo; Admin</title>
    <link rel="stylesheet" href="/template/assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/template/assets/vendors/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/template/assets/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="/template/assets/css/admin.css">
    <script src="/template/assets/vendors/nprogress/nprogress.js"></script>
    <link href="/template/assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/template/assets/vendors/layer/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="/template/assets/vendors/bootstrap/js/bootstrap.min.js"></script>
    <script src="/template/assets/vendors/twbs-pagination/jquery.twbsPagination.js" type="text/javascript"></script>
    <script src="\template\assets\vendors\layer\template-web.js"></script>
</head>

<body>
    <script>
        NProgress.start()
    </script>

    <div class="main">
        <nav class="navbar">
            <?php include_once '../include/nav.php' ?>
        </nav>
        <div class="container-fluid">
            <div class="page-title">
                <h1>所有文章</h1>
                <a href="post-add.html" class="btn btn-primary btn-xs">写文章</a>
            </div>
            <!-- 有错误信息时展示 -->
            <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
            <div class="page-action">
                <!-- show when multiple checked -->
                <a class="btn dels btn-danger btn-sm" href="javascript:;">批量删除</a>
                <form class="form-inline">
                    <select name="" class="form-control input-sm">
            <option value="">所有分类</option>
            <option value="">未分类</option>
          </select>
                    <select name="" class="form-control input-sm">
            <option value="">所有状态</option>
            <option value="">草稿</option>
            <option value="">已发布</option>
          </select>
                    <button class="btn btn-default btn-sm">筛选</button>
                </form>
                <ul class="pagination pagination-sm pull-right">

                </ul>
            </div>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center" width="40"><input type="checkbox"></th>
                        <th>标题</th>
                        <th>作者</th>
                        <th>分类</th>
                        <th class="text-center">发表时间</th>
                        <th class="text-center">状态</th>
                        <th class="text-center" width="100">操作</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <div class="aside">
        <?php include_once '../include/aside.php'; ?>
    </div>

    <script>
        NProgress.done()
    </script>
    <?php 
        // 计算总页数
        $sql = 'select count(*) num from ali_article';
        include_once '../include/mysqli.php';
        $result_obj = mysqli_query($conn, $sql);
        $arr = mysqli_fetch_assoc($result_obj);
        $count = $arr['num'];
        $pagesize = 3; 
        $total_pages = ceil($count / $pagesize);
    ?>
    <script type="text/template" id="tpl">
        {{each list as value}}
        <tr>
            <td class="text-center"><input type="checkbox" value="{{value.article_id}}"></td>
            <td>{{value.article_title}}</td>
            <td>{{value.admin_nickname}}</td>
            <td>{{value.cate_name}}</td>
            <td class="text-center">{{value.article_addtime}}</td>
            <td class="text-center">{{value.article_state}}</td>
            <td class="text-center">
                <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
                <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
        </tr>
        {{/each}}
    </script>
    <script>
        $('.pagination').twbsPagination({
            totalPages: <?php echo $total_pages; ?>,
            visiblePages: 5,
            first: '首页',
            prev: '上一页',
            next: '下一页',
            last: '末页',
            onPageClick: function(event, page) {
                console.log(page);
                $.post('page.php', {
                    "page": page
                }, function(msg) {
                    console.log(msg);
                    
                    // 接收后端的数据并包装为json
                    var json = {
                        "list": msg
                    };
                    console.log(json);
                    
                    // 调用template 方法页面上的结构跟数据融合
                    var str = template('tpl', json);
                    // 将融合好的内容添加到页面上
                    $('tbody').html(str);
                }, 'json')
            }
        });

         $('.dels').click(function () {
    // 通过复选框的checkbox属性获取到已选中的checked :checkbox:checked;
    var check_list = $(':checkbox:checked');
    // 定义一个空字符串
    var str = '';
    // 调用each方法 each为jquery内置的循环方法 与for each 基本相同
    // 此方法参数1 是以个函数 函参数1为索引  参数2 为绑定的对象
    check_list.each(function (index, elem) {
        // 将获取到的复选框用, 拼接为一个字符串;
      str += elem.value + ',';
    })
    // 通过调用 slice 方法截取字符串末尾多余的 ',';
    str = str.slice(0, -1);
    // 通过post方式发送ajax请求 将 拼接完的字符串传输到后端
    $.post('delsArticle.php', {ids: str}, function (msg) {
      // 判断 当后端返回1时 弹出alert '批量删除成功'
      // 并 将通过each循环页面上 对应的tr的数据全部删除
        console.log(msg);
        
       if (msg == 1) {
        alert('批量删除成功');
        check_list.each(function () {
          $(this).parents('tr').remove();
        })
       } else {
         // 其他情况弹出删除失败
        alert('批量删除失败');
       }
    });
  })
    </script>
</body>

</html>