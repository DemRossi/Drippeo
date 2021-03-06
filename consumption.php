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

$actions = Action::dailyActions($_SESSION['user']['id']);
$limit = Consumption::limit($_SESSION['user']['id']);
$used = Consumption::tipsLimit($_SESSION['user']['id']);
$totalUsed = Consumption::calcTotalDay();
$yearTotal = Consumption::calcTotalYear();

$bigSpender = Consumption::bigSpender();
$leastSpender = Consumption::leastSpender();

// var_dump($bigSpender);
// var_dump($leastSpender);
$comment = '';
if (empty($bigSpender) || empty($leastSpender)) {
    //$comment = 'Sorry no other profiles found';
} elseif ($bigSpender['id'] == $_SESSION['user']['id']) {
    $comment = 'Your the biggest water user.';
} elseif ($leastSpender['id'] == $_SESSION['user']['id']) {
    $comment = 'You use the least water';
}

$year = date('Y');

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

<div class='item'>    
    <h3>Your limit</h3>
    <h4><?php echo  $limit; ?> L</h4>
    <div id="limit"></div>
</div>
<div class='item'>    
<h3>Comparison</h3>
  <h4>Year</h4>
  <?php if (empty($bigSpender) && empty($leastSpender)):?>
      <p>Sorry no other profiles found</p>
      <?php else:?>
      <div id="comparison_chart"></div>
      <?php endif; ?>
  <!-- <p><?php //echo $comment;?></p> -->

  

</div>
</div>

  <div class='column'>
  <div class="item">
  <h3>What did you do today</h3>
    <ul class="userList">
        <?php foreach ($actions as $a):?>
            <!--mogelijk nog icon invoegen-->
            <?php
                $timestamp = $a['date'];
                $dateTime = explode(' ', $timestamp);
            ?>
            <li><img class="action_icon"src ="<?php echo $a['icon']; ?>"><?php echo '['.$dateTime[1].'] - '.$a['name'].': '.round($a['total'], 2).' L water '; ?></li>
         
        <?php endforeach; ?>
      </ul>

     </div>
  <div class="item">
  
  <h3>Your yearly consumption</h3>
    <h4>This year: <?php echo  date('Y'); ?> </h4>
    <p>You used: <?php echo round($yearTotal, 2); ?> liter.</p>
    
<div id="barchart_material"> 
</div>
     </div>
</div>
</div>




<?php include_once 'includes/footer.inc.php'; ?>



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="js/charts.js"></script>
<script src="js/webNavigation.js"></script>


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
    // JAAR VERBRUIK
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
          width:300,
          colors: ['#f4f4f4','#72e0eb'],
          legend: {
			    position: "none"	
          },

        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <script>
      // VERGELIJKING
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Person', 'Spends'],
          ['Least spender', <?php echo $leastSpender['verbruik']; ?> ],
          ['You',  <?php echo  $yearTotal; ?>],
          ['Biggest spender', <?php echo $bigSpender['verbruik']; ?>]
        ]);

        var options = {
          
          bars: 'horizontal', // Required for Material Bar Charts.
          hAxis: {format: 'decimal'},
          height: 200,
          colors: ['#72e0eb'],
          legend: {
			    position: "none"	
          },
        };
        var chart = new google.charts.Bar(document.getElementById('comparison_chart'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
       
      </script>
</body>
</html>