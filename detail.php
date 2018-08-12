<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <?php 
  if (isset($_GET['id'])) {
    $article_id = $_GET['id'];
  } else {
    echo "没有相关文章,3秒后回到首页";
    header('refresh:3;url=index.php');die;
  }
  ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <?php include_once 'left.php';
    $article_di = $_GET['id'];
     $sql =  "select ali_article.*,ali_admin.admin_nickname,
      ali_cate.cate_id,ali_cate.cate_name from ali_article
      join ali_admin on ali_article.article_adminid=ali_admin.admin_id
      join ali_cate on ali_article.article_cateid=ali_cate.cate_id
      where ali_article.article_id=$article_di";
      $result_obj = mysqli_query($conn, $sql);
      $article_info = mysqli_fetch_assoc($result_obj);
    ?>
    <div class="content">
      <div class="article">
        <div class="breadcrumb">
          <dl>
            <dt>当前位置：</dt>
            <dd><a href="javascript:;"><?php echo $article_info['cate_name'] ?></a></dd>
            <dd><?php echo $article_info['article_desc']; ?></dd>
          </dl>
        </div>
        <h2 class="title">
          <a href="javascript:;"><?php echo $article_info['article_title']; ?></a>
        </h2>
        <div class="meta">
          <span><?php echo $article_info['admin_nickname']; ?> 发布于 <?php echo $article_info['article_addtime']; ?></span>
          <span>分类: <a href="list.php<?php $article_info['cate_id']?>"><?php echo $article_info['cate_name'] ?></a></span>
          <span>阅读: (<?php echo $article_info['article_click']; ?>)</span>
          <span>评论: (<?php echo $article_info['article_cmt']; ?>)</span>
        </div>
      </div>
      <div class="panel hots">
        <h3>热门推荐</h3>
        <ul>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_2.jpg" alt="">
              <span>星球大战:原力觉醒视频演示 电影票68</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_3.jpg" alt="">
              <span>你敢骑吗？全球第一辆全功能3D打印摩托车亮相</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_4.jpg" alt="">
              <span>又现酒窝夹笔盖新技能 城里人是不让人活了！</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_5.jpg" alt="">
              <span>实在太邪恶！照亮妹纸绝对领域与私处</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
<?php?>
