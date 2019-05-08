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








<?php include_once 'includes/footer.inc.php'; ?>
<script src="js/webNavigation.js"></script>
</body>
</html>