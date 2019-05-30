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
 $limit = Consumption::limit($_SESSION['user']['id']);
 $used = Consumption::tips($_SESSION['user']['id']);
 $totalUsed = Consumption::calcTotalDay();
 $sensorToday = Consumption::dataToday($_SESSION['user']['productcode']);
 $actions = Consumption::dailyActions($_SESSION['user']['id']);

  if ($limit == 0) {
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
      	<p>You already used <?php echo  number_format(($totalUsed / $limit) * 100, 2, '.', ''); ?>  % of your own limit. </p>
      	<p>  <?php echo  $used; ?></p>
				<br><br>
				<p> Your current consumption is <?php echo round($totalUsed, 2); ?> liter.</p>
				<p> You have <?php echo $limit - round($totalUsed, 2); ?> liter left from your personal limit.</p>
			<?php endif; ?>
    </div>
    <div class="row">
      <a href='saving.php'> <h3>Personal tips & tricks</h3></a>
      
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
<script>
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawDualY);
      
        function drawDualY() {
            var data = new google.visualization.DataTable();
            data.addColumn('timeofday', 'Time of Day');
            var product = '';
            data.addColumn('number', product);
            data.addRows([
                <?php foreach ($sensorToday as $data):
                    $timestamp = strtotime($data['date']);
                    $time = date('H:i:s', $timestamp);
                    $timeVar = explode(':', date('H:i:s', $timestamp));
                    $avg = $data['avg'];
                    //var_dump($time);
                    echo "[{v: [$timeVar[0],$timeVar[1],0], f: '$time'}, $avg],";
                ?>
                <?php endforeach; ?>


            //   [{v: [8, 0, 0], f: '8 am'}, 6],
            //   [{v: [8, 30, 0], f: '8.30 am'}, 5],
            //   [{v: [9, 0, 0], f: '9 am'}, 0],
            //   [{v: [10, 0, 0], f:'10 am'}, 0],
            //   [{v: [11, 0, 0], f: '11 am'}, 1],
            //   [{v: [12, 0, 0], f: '12 pm'}, 2],
            //   [{v: [13, 0, 0], f: '1 pm'}, 0],
            //   [{v: [14, 0, 0], f: '2 pm'}, 0],
            //   [{v: [15, 0, 0], f: '3 pm'}, 1],
            //   [{v: [16, 0, 0], f: '4 pm'}, 0],
            //   [{v: [17, 0, 0], f: '5 pm'}, 7],
            ]);
      
            var options = {
              series: {
                0: {axis: 'WaterLevel'},
              
              },
              legend: {position: 'none'},
              hAxis: {
                title: 'Time of Day',
                format: 'h:mm a',
                viewWindow: {
                  min: [7, 30, 0],
                  max: [17, 30, 0],
                  
                },
              },
              
              colors: ['#72e0eb'],

            };
      
            var materialChart = new google.charts.Bar(document.getElementById('chart_div_daily'));
            materialChart.draw(data, options);
           // google.visualization.events.addListener(materialChart, 'select', selectHandler);

           
          /*  function selectHandler(e) {
                var selection = materialChart.getSelection();
                console.log(selection)
                //var selection = table.setSelection(product);
                var value = document.querySelector('.form--dashboard input').value;
                document.querySelector('.form--btn button').addEventListener("click", function(e){
                    product = value;
                    console.log(change);
                    data.setValue(selection, change)
                    //selection.setValue(product)
                    console.log(product);
                    data.draw(data, options);
                    e.preventDefault();
                  }); 
                  e.preventDefault();
              
            }*/
         
          }
</script>

</body>
</html>
