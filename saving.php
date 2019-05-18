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
<div class="column column--title">
<h2>Tips and Tricks</h2>
</div>
    <div class="column">
    <div class='item noBorder'>
        <h3>Some personal tips</h3>
        <ul class="list">
        <li></li>
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
            <li><a href="https://www.dewatergroep.be/nl-be/drinkwater/veelgestelde-vragen/waterverbruik">De watergroep</a></li>
            <li><a href="https://www.sdgs.be/nl/sdgs">SDGs</a></li>
            <li><a href="https://www.epa.gov/watersense/how-we-use-water">Epa</a></li>
</ul>
        </div>
    </div>
</div>






<?php include_once 'includes/footer.inc.php'; ?>
<script src="js/webNavigation.js"></script>
</body>
</html>