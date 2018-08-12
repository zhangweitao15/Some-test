define(function () {
  return function (url) {
        $('tbody').on('click', '.del', function () {
            // 点击按钮后通过获取当前按钮通过attr获取自定义属性(id)值
            var id = $(this).attr('data');
            _this = $(this);
            //  发送ajax请求, 并将要删除的元素的id通过ajax发送到后端
            layer.confirm("是否确认删除管理员", function () { 
            $.get(url, {id: + id, '_': Math.random()}, function (msg) {
              // 
                console.log(msg);
                //判断当 msg==1 时
                if (msg == 1 ) {
                  // 当msg==1 时说明删除成功 通过layer.alert 弹出删除成功
                  layer.alert("管理员删除成功");
                  // 将页面上的对应项(tr)删除,(因为$.get 中的this指向为 $.get需要将this在上面($.get外)转存一下)
                  // 通过查找父元素将整个tr标签移除;
                  _this.parent().parent().remove();
                } else {
                  // 当结果不 == 1 的时候 弹出提示 管理员删除失败;
                  layer.alert("管理员删除失败");
                }
            })
          });
          })
    }
})