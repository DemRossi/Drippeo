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
    <title>Consume less</title>
</head>
<body>
<?php include_once 'includes/nav.inc.php'; ?>

<div class="container_tips">
<h2>Tips & Tricks</h2>
    <div class="container_item column">
        <h3>Your point this week</h3>
        <h2></h2>
    </div>
    <div class="container_item column">
        <h3>What others do</h3>
        <p> To help you use less water, drippeo will compare your data with others. 
    This way we can let you know how well or how badly you are doing.</p>

    </div>
    <div class="container_item column">
        <h3>Some interesting links</h3>

    </div>
</div>






<?php include_once 'includes/footer.inc.php'; ?>
<script src="js/webNavigation.js"></script>
</body>
</html>