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
<form>
    <h2>添加新用户</h2>
    <div class="form-group">
        <label for="email">邮箱</label>
        <input id="email" class="form-control" name="email" type="email" placeholder="邮箱">
    </div>
    <div class="form-group">
        <label for="slug">别名</label>
        <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
    </div>
    <div class="form-group">
        <label for="nickname">昵称</label>
        <input id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称">
    </div>
    <div class="form-group">
        <label for="password">密码</label>
        <input id="password" class="form-control" name="password" type="text" placeholder="密码">
    </div>
    <div class="form-group">
        <label for="state">状态</label>
        <input name="state" type="radio"value="激活">激活
        <input name="state" type="radio"value="禁用">禁用
    </div>
    <div class="form-group">
        <input type="button" value="添加" id="btn">
    </div>
</form>
</div>
<script>
    // 设置页面添加
    // 1. 为添加按钮设置鼠标点击事件
    $('#btn').click(function () {
            // 首先回去页面上的form 标签DOM节点
            var fm =  $('form')[0];
            // 2. 点击后通过formdata 获取 form表单中的所有内容(formdtat 需要传参数, 参数必须为DOM 对象)`
            var fd = new FormData(fm)
            // 3. 通过$.ajax 方法发送到 后端php页面
            $.ajax({
                url: 'addusers_deal.php',//url 为请求后端php路径
                data: fd,// data 为传输的文件;
                type: 'post',// type 为文件传输格式;
                dataType: 'text', // dataType 为接收后端返回格式
                contentType: false,// 只要通过formdata 传输文件必须
                processData: false,// 设置为false的两个属性
                success: function(msg) {// 当 readystate ==4 时执行的回调函数;
                    console.log(msg);
                    // 判断返回的结果 
                    if (msg == 1) {
                        //因为要使用jayer 方法中的弹窗
                        //可以利用prent BMO对象跳转到父级及面中使用该方法
                        // 弹出后通过alert方法的 参数2 回调函数实现关闭整个弹出框
                        parent.layer.alert("管理员信息添加成功", function () {
                            // 通过父级页面中的layer.getFrameIdex(window.name)
                            //  方法获取当前弹出框的index 
                            var index = parent.layer.getFrameIndex(window.name);
                            // 调用 layer 中的close 方法关闭所有的弹出框
                            parent.layer.close(index);
                            // 通过当前弹出框父元素bom方法location.reload使页面重新加载
                            parent.location.reload();
                        })
                    } else {
                        // 6. 当结果为其他情况的时候返回处理失败
                        parent.layer.alert("管理员信息添加失败");
                    };
                },
            });
            
    })
    
</script>