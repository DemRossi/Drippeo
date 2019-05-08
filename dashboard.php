<?php

    //Connectie klasses
  require_once 'bootstrap/bootstrap.php';

  // Controleren of we al ingelogd zijn

  if (isset($_SESSION['user'])) {
      //logged in user
      //echo "😎";
  } else {
      //no logged in user
      header('Location: login.php');
  }

?><!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'includes/head.inc.php'; ?>
<title>Dashboard</title>
</head>
<body>
<?php include_once 'includes/nav.inc.php'; ?>

<div class="dashboard">
  <div class='column'>
    <div class='item'></div>
    <div class='item'></div>
    <div class='item'></div>
  </div>
  <div class='column'>
    <div class='item'></div>
    <div class='item'></div>
    <div class='item'></div>
  </div>
  <div class='column'>
    <div class='item'></div>
    <div class='item'></div>
    <div class='item'></div>
  </div>
</div>


<?php include_once 'includes/footer.inc.php'; ?>

<script src="js/webNavigation.js"></script>
    

</body>
</html>
