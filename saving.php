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
  $badkamerTips = Consumption::tipsAlgemeen($_SESSION['user']['id']);

?><!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'includes/head.inc.php'; ?>
    <title>Consume less</title>
</head>
<body>
<?php include_once 'includes/nav.inc.php'; ?>

<div class="container_tips">
<div class="column column--title">
<h2>Tips and Tricks</h2>
</div>
    <div class="column">
    <div class='item noBorder'>
        <h3>Some personal tips</h3>
        <ul class="list">
        <li><?php echo $badkamerTips; ?></li>
          <li></li>
          <li></li>
      </ul>
</div>
    </div>

    <div class="column">
    <div class='item noBorder'>
        <h3>Some general tips</h3>
        <ul class="list">
        <li>Try taking less baths. Did you know that with an average shower 
           you use <span class="bold">40 to 55 liters </span>of water. A bathtub can contain up to <span class="bold">150 liters.</span></li>
          <li>Replacing your old tap buttons with saving buttons can also save you a lot of water and money.</li>
          <li>Dishwashers consume a lot of water. So make sure your dishwasher is always well stocked.</li>
      </ul>
</div>
    </div>
    
    
    <div class="column">
    <div class='item noBorder'>
        <h3>Some interesting links</h3>
        <ul class="list">
            <li><a href="https://www.sdgs.be/nl/sdgs" target="_blank">SDGs</a></li>
            <li><a href="https://www.epa.gov/watersense/how-we-use-water" target="_blank">Epa</a></li>
</ul>
        </div>
    </div>
</div>






<?php include_once 'includes/footer.inc.php'; ?>
<script src="js/webNavigation.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="js/charts.js"></script>


</body>
</html>