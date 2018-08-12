<?php
      session_start();
      if (empty($_SESSION['name'])) { ?>
      <script src="/template/assets/vendors/layer/jquery-1.12.4.min.js"></script>
      <script src="/template/assets/vendors/layer/layer.js"></script>
      <script> layer.msg("您尚未登陆, 请登录后继续访问",{icon:3})</script>

<?php 
              header('refresh:3;url=/template/admin/login.php');
              die;
    }  ?>