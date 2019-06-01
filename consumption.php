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

$actions = Consumption::dailyActions($_SESSION['user']['id']);
$limit = Consumption::limit($_SESSION['user']['id']);
$used = Consumption::tips($_SESSION['user']['id']);
$totalUsed = Consumption::calcTotalDay();
$yearTotal = Consumption::calcTotalYear();
$year = date('Y');

var_dump($yearTotal);

?><!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once 'includes/head.inc.php'; ?>
  <title>Consumption</title>
</head>
<body>
<?php include_once 'includes/nav.inc.php'; ?>

<div class="container_tips">
<div class="column column--title">
<h2>Details</h2>
</div>
<div class="column">
<div class='item--2'>
  <div class="row">
    <h3>What did you do today</h3>
    <ul>
        <?php foreach ($actions as $a):?>
          <img src="<?php echo $a['icon']; ?>" class="icon"><p><?php echo $a['name']; ?></p>
        <?php endforeach; ?>
      </ul>

     </div>
  <div class="row">

    
     </div>
</div>
<div class='item'>    
    <h3>Your limit</h3>
    <h4><?php echo  $limit; ?> L</h4>
    <div id="limit">
    
    </div>
</div>
</div>

<div class='column'>
<div class='item'>    
    <h3>Your yearly consumption</h3>
    <h4>This year: <?php echo  date('Y'); ?></h4>
<div id="barchart_material"> 
</div>

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
          ['Rest', 100- <?php echo  $totalUsed; ?> / <?php echo  $limit; ?>*100],
          ['Used', <?php echo  $totalUsed; ?> / <?php echo  $limit; ?>*100]
        ]);

        var options = {
          pieSliceTextStyle: {
            color: '#706f6f',
          },
		      pieHole: 0.35,
		      pieSliceBorderColor: "none",
          colors: ['#72e0eb','#f4f4f4' ],
		      legend: {
			    position: "none"	
          },
	};
        var chart = new google.visualization.PieChart(document.getElementById('limit'));
        chart.draw(data, options);
      }

</script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Water','Year limit'],
          [' <?php echo  $year; ?>' , <?php echo  $yearTotal; ?>,<?php echo  $limit; ?>*365 ],
          
          
        ]);

        var options = {
          
          bars: 'horizontal', 
          hAxis: {format: 'decimal'},
          height: 100,
          width:400,
          colors: ['#f4f4f4','#72e0eb'],
          legend: {
			    position: "none"	
          },

        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
</body>
</html>