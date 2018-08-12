<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <?php include_once 'left.php'; ?>
    <?php $cate_id = isset($_GET['id']) ? $_GET['id'] : 1;
        $cate_name = isset($_GET['name']) ? $_GET['name'] : '潮科技';
    $sql = "select ali_article.*,ali_admin.admin_nickname from ali_article 
    join ali_admin on ali_article.article_adminid=ali_admin.admin_id
    where article_cateid=$cate_id";
    $result_obj = mysqli_query($conn, $sql);
    
    ?>
    <div class="content">
      <div class="panel new">
        <h3><?php echo $cate_name ?></h3>
      <?php while ($row = mysqli_fetch_assoc($result_obj)) { ?>
        <div class="entry">
          <div class="head">
            <a href="javascript:;"><?php echo $row['article_title']; ?></a>
          </div>
          <div class="main">
            <p class="info"><?php echo $row['admin_nickname']; ?>发表于<?php echo $row['article_addtime']; ?></p>
            <p class="brief"><?php echo $row['article_title'] ?></p>
            <p class="extra">
              <span class="reading">阅读(<?php echo $row['article_click']; ?>)</span>
              <span class="comment">评论(<?php echo $row['article_cmt']; ?>)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?php echo $row['article_good']; ?>)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span>星球大战</span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="<?php echo $row['article_file']; ?>" alt="">
            </a>
          </div>
        </div>
      <?php }?>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
