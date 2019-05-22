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
 $totalUsed = Consumption::calcTotalDay();
 $actions = Consumption::dailyActions($_SESSION['user']['id']);
 $raw = Consumption::dataToday($_SESSION['user']['productcode']);

  if ($table == 0) {
      $noLimit = 'You need to set your limit in settings first before you can use this functionality';
  }

 if ($totalUsed == '') {
     $totalUsed = 0;
 } else {
     $totalUsed = Consumption::calcTotalDay();
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
  <h2>Welcome on your personal dashboard </h2>
</div>
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
 			<?php if (isset($noLimit)) :  ?>
				<h3 class="warning">Warning</h3>
				<h4>Your limit</h4>
				<p><?php echo $noLimit; ?></p>
			<?php else:  ?>
      	<h3 class="warning">Warning</h3>
      	<h4>Your limit</h4>
      	<p>You already used <?php echo  number_format(($totalUsed / $table) * 100, 2, '.', ''); ?>  % of your own limit. </p>
      	<p>  <?php echo  $used; ?></p>
			<?php endif; ?>
    </div>
    <div class="row">
      <a href='saving.php'> <h3>Personal tips & tricks</h3></a>
      
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
    <div class='item'>
    <h3>What did you do today</h3>
    <ul>
        <?php foreach ($actions as $a):?>
          <img src="<?php echo $a['icon']; ?>" class="icon"><p><?php echo $a['name']; ?></p>
        <?php endforeach; ?>
      </ul>
    </div>

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
          ['Rest', 100- <?php echo  $totalUsed; ?> / <?php echo  $table; ?>*100],
          ['Used', <?php echo  $totalUsed; ?> / <?php echo  $table; ?>*100]
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
