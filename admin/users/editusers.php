<?php
header('content-type:text/html;charset=utf-8');
include_once '../include/session.php';
?>
<link rel="stylesheet" href="/template/assets/vendors/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="/template/assets/vendors/font-awesome/css/font-awesome.css">
<link rel="stylesheet" href="/template/assets/vendors/nprogress/nprogress.css">
<link rel="stylesheet" href="/template/assets/css/admin.css">
<script src="/template/assets/vendors/layer/jquery-1.12.4.min.js"></script>
<script src="/template/assets/vendors/layer/layer.js"></script>
<div class="col-md-4">
    <?php 
         $id = $_GET['id'];
        $sql = "select * from ali_admin where admin_id=$id";
        include_once '../include/mysqli.php';
        $result_obj = mysqli_query($conn, $sql);
        $result_arr = mysqli_fetch_assoc($result_obj);
        // print_r($result_arr);
        // die();
    ?>
<form>
    <h2>编辑管理员信息</h2>
    <input type="hidden" name="id" value="<?php echo  $result_arr['admin_id'] ?>">
    <div class="form-group">
        <label for="email">邮箱</label>
        <input value="<?php echo $result_arr['admin_email']; ?>" id="email" class="form-control" name="email" type="email" placeholder="邮箱">
    </div>
    <div class="form-group">
        <label for="slug">别名</label>
        <input value="<?php echo $result_arr['admin_slug']; ?>" id="slug" class="form-control" name="slug" type="text" placeholder="slug">
    </div>
    <div class="form-group">
        <label for="nickname">昵称</label>
        <input value="<?php echo $result_arr['admin_nickname']; ?>" id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称">
    </div>
    <!-- <div class="form-group">
        <label for="password">密码</label>
        <input id="password" class="form-control" name="password" type="text" placeholder="密码">
    </div> -->
    <div class="form-group">
        <label for="state">状态</label>
        <?php if ($result_arr['admin_state'] == '激活') { ?>
        <input name="state" type="radio"value="激活" checked>激活
        <input name="state" type="radio"value="禁用">禁用
        <?php } else { ?>
        <input name="state" type="radio"value="激活">激活
        <input name="state" type="radio"value="禁用" checked>禁用
        <?php } ?>
    </div>
    <div class="form-group">
        <input type="button" value="修改" id="btn">
    </div>
</form>
</div>

<script>
    $('#btn').click(function () {
       var fm = $('form')[0];
       console.log(fm);
       
        var fd = new FormData(fm);
        $.ajax({
            url: 'edituser_deal.php',
            data: fd,
            type: 'post',
            dataType: 'text',
            contentType: false,
            processData: false,
            success: function (msg) {
                console.log(msg);
                if (msg == 1) {
                    parent.layer.alert('修改成功', function () {
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
                        parent.location.reload();
                    })
                } else {
                    parent.layer.alert('修改失败');
                }
            }
        })
    })
</script>




