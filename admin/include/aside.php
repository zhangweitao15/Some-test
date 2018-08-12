<?php 
$arr =  explode('/', $_SERVER['PHP_SELF']);
?>
<div class="profile">
    <img class="avatar" src="<?php echo $result['admin_pic'] ?>">
    <h3 class="name">
        <?php echo $_SESSION['name'] ?>
    </h3>
</div>
<ul class="nav">
    <li<?php if ($arr[3]=='index.php' ) echo 'class="active"'; ?>>
        <a href="/template/admin/index.php">
            <i class="fa fa-dashboard"></i>
            仪表盘
        </a>
    </li>
    <li <?php if ($arr[3]=='cate' || $arr[3]=='article' ) echo 'class="active"'; ?>>
        <a href="#menu-posts" <?php if ($arr[3] != 'cate' && $arr[3] != 'article') echo 'class=" collapsed "' ?> data-toggle="collapse">
            <i class="fa fa-thumb-tack"></i>
            文章
            <i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse collapse <?php if ($arr[3] == 'cate' || $arr[3] == 'article') echo 'in'; ?>">
            <li <?php if (isset($arr[4]) && $arr[4]=='posts.php' ) echo 'class="active"'; ?>><a href="/template/admin/article/posts.php">所有文章</a></li>
            <li <?php if (isset($arr[4]) && $arr[4]=='addpost.php' ) echo 'class="active"'; ?>><a href="/template/admin/article/addpost.php">写文章</a></li>
            <li <?php if (isset($arr[4]) && $arr[4]=='categories.php' ) echo 'class="active"'; ?>><a href="/template/admin/cate/categories.php">分类目录</a></li>
            <li <?php if (isset($arr[4]) && $arr[4]=='addcate.php' ) echo 'class="active"'; ?>><a href="/template/admin/cate/addcate.php">添加分类</a></li>
        </ul>
    </li>
    <li <?php if ($arr[3]=='comments' ) echo 'class="active"'; ?>>
        <a href="/template/admin/comments/comments.php">
            <i class="fa fa-comments"></i>
            评论
        </a>
    </li>
    <li <?php if ($arr[3]=='users' ) echo 'class="active"'; ?>>
        <a href="/template/admin/users/users.php" >
            <i class="fa fa-users"></i>用户
        </a>
    </li>
    <li <?php if($arr[3] == 'other' || $arr[3] == 'nav-menus.php' || $arr[3] == 'settings.php') echo 'class="active"';  ?> >
        <a href="#menu-settings" <?php if($arr[3] != 'other' && $arr[3] != 'nav-menus.php' && $arr[3] != 'settings.php') echo 'class= "collapsed"';  ?> data-toggle="collapse">
            <i class="fa fa-cogs"></i>
            设置
            <i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse <?php if($arr[3] == 'other' || $arr[3] == 'nav-menus.php' || $arr[3] == 'settings.php') echo 'in';  ?> ">
            <li <?php if (isset($arr[3]) && $arr[3]=='nav-menus.php' ) echo 'class="active"'; ?> >
                <a href="/template/admin/nav-menus.php">导航菜单</a>
            </li>
            <li <?php if (isset($arr[4]) && $arr[4]=='slides.php' ) echo 'class="active"'; ?> >
                <a href="/template/admin/other/slides.php">图片轮播</a>
            </li>
            <li <?php if (isset($arr[3]) && $arr[3]=='settings.php' ) echo 'class="active"'; ?> >
                <a href="/template/admin/settings.php">网站设置</a>
            </li>
        </ul>
    </li>
</ul>