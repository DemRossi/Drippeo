<?php 

  //Connectie klasses
include_once("bootstrap.php");

// Controleren of we al ingelogd zijn
//User::checkLogin();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once("includes/head.inc.php") ;?>
<title>Dashboard</title>
</head>
<body>
<?php include_once("includes/nav.inc.php") ;?>

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






<?php include_once("includes/footer.inc.php") ;?>

<script>

/*---Navigatie---*/
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
    </script>
    

</body>
</html>
