  <?php include './db/dbconnect.php'; ?>
  <?php require('fetch/adm.php'); ?>
  <?php require('template/header.php'); 
  
  if ($_COOKIE['login_status'] == ''){
    header("Location: index.php");
    exit();
  }
  ?>
  <!-- todo users -->
  <div>
      <?php getUserssadmin() ?>
  </div>





  <?php require('template/footer.php'); ?>