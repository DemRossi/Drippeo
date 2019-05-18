<?php

    //Connectie klasses
  require_once 'bootstrap/bootstrap.php';

  // Controleren of we al ingelogd zijn

  if (isset($_SESSION['user'])) {
      //logged in user
      //echo "😎";
  } else {
      //no logged in user
     // header('Location: login.php');
  }
 $table = Consumption::limit($_SESSION['user']['id']);
 $used = Consumption::tips($_SESSION['user']['id']);
 $totalUsed = Consumption::used($_SESSION['user']['id']);

?><!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'includes/head.inc.php'; ?>
<title>Dashboard</title>
</head>
<body>
<?php include_once 'includes/nav.inc.php'; ?>

<div class="dashboard">
  <h2>Welcome on your personal dashboard </h2>
  <div class='column'>
    <div class='item'>
        <h3>Today's water</h3>
        <div id="chart_div_daily"></div>

    </div>
    <div class='item element_question'>
      <h3>What did you do?</h3>
    <form class="form--dashboard" method="post" action="">
      <input type="radio" name="element"  checked value="Shower">Shower<br>
      <input type="radio" name="element"  checked value="Bath">Bath <br>
      <input type="radio" name="element"  checked value="Toilet">Toilet<br>
      <input type="radio" name="element"  checked value="Sink">Sink <br>
      <input type="radio" name="element"  checked value="Washing Machine">Washing Machine<br>
      <input type="radio" name="element"  checked value="Dishwasher">Dishwasher <br>
      <input type="radio" name="element"  checked value="Outdoor tap">Outdoor tap<br>

      <div class="form--btn">
         <button type="submit" name="submitBtn">Submit!</button>
      </div>
    </form>
    </div>
  
  </div>
  <div class='column'>
  <div class='item--2'>
    <div class="row">
      <h3 class="warning">Warning</h3>
      <h4>Your limit</h4>
      <p>You already used <?php echo  number_format(($totalUsed / $table) * 100, 2, '.', ''); ?>  % of your own limit. </p>
      <p>  <?php echo  $used; ?></p>
    </div>
    <div class="row">
      <a href='saving.php'> <h3>Tips & Tricks</h3></a>
      <ul>
        <li>Try taking less baths. Did you know that with an average shower 
           you use <span class="bold">40 to 55 liters </span>of water. A bathtub can contain up to <span class="bold">150 liters.</span></li>
          <li>Replacing your old tap buttons with saving buttons can also save you a lot of water and money.</li>
          <li>Dishwashers consume a lot of water. So make sure your dishwasher is always well stocked.</li>
      </ul>
    </div>
   
  </div>
  <div class='item'>    
    <h3>Your limit</h3>
    <h4><?php echo  $table; ?> L</h4>
    <div id="limit">
    
    </div>
  </div>
 
  </div>
  <div class='column'>
    <div class='item'></div>
    <div class='item'></div>
    <div class='item'></div>
  </div>
</div>


<?php include_once 'includes/footer.inc.php'; ?>

<script src="js/webNavigation.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="js/charts.js"></script>

<script>
  // YOU LIMIET EN U VERBRUIK
  google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Water limit', 'Liters'],
          ['Rest', 100-80/<?php echo  $table; ?>*100],
          ['Used', 80/<?php echo  $table; ?>*100]
        ]);

        var options = {
          pieSliceTextStyle: {
            color: '#706f6f',
          },
		      pieHole: 0.35,
		      pieSliceBorderColor: "none",
          colors: ['#f4f4f4','#72e0eb' ],
		      legend: {
			    position: "none"	
          },
	};
        var chart = new google.visualization.PieChart(document.getElementById('limit'));
        chart.draw(data, options);
      }


 
    
</script>
</body>
</html>
