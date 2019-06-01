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
    <div class='item feedback'>
        <h3>Today's water</h3>
        <div id="chart_div_daily"></div>

    </div>
    <div class='item element_question'>
      <h3>What did you do?</h3>
    <form class="form--dashboard" method="post" action="">

      <label><input type="checkbox" class="action" data-id="1" data-check="0" id="shower" name="Shower" value="Shower">Shower</label>
      <label><input type="checkbox" class="action" data-id="2" data-check="0" name="Bath" value="Bath">Bath </label>
      <label><input type="checkbox" class="action" data-id="3" data-check="0" name="Toilet" value="Toilet">Toilet</label>
      <label><input type="checkbox" class="action" data-id="4" data-check="0" name="Sink" value="Sink">Sink </label>
      <label><input type="checkbox" class="action" data-id="5" data-check="0" name="WashingMachine" value="Washing Machine">Washing Machine</label>
      <label><input type="checkbox" class="action" data-id="6" data-check="0" name="Dishwasher" value="Dishwasher">Dishwasher </label>
      <label><input type="checkbox" class="action" data-id="7" data-check="0" name="OutdoorTap" value="Outdoor tap">Outdoor tap</label>

      <!-- <div class="form--btn">
         <button class="subBtn" type="submit" name="subBtn">Submit!</button>
      </div> -->
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
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
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
	window.onload = ()=>{
		//alert("yo");
		var field = 'time';
		var url = window.location.href;
		//console.log(url);
		if(url.indexOf('?' + field + '=') != -1){
			
			return true;
		}
		else if(url.indexOf('&' + field + '=') != -1){

			let params = (new URL(document.location)).searchParams;
			let time = params.get('time');
			let feedback = `Your selected time is: ${time}`;

			if (time){
				let selected = document.createElement("p");
				selected.innerHTML = feedback;
				let chartCon = document.querySelector('.feedback');
				//console.log(chartCon);
				chartCon.appendChild(selected);

			}
			return true;
		}
		return false
	}
	<?php if ($sensorToday): ?>

		google.charts.load('current', {'packages':['bar']});
		google.charts.setOnLoadCallback(drawStuff);

		function drawStuff() {
			var data = new google.visualization.arrayToDataTable([
				
				['Time of the day', 'Total per liter'],
				<?php foreach ($sensorToday as $data):
                    $timestamp = strtotime($data['date']);
                    $time = date('H:i:s', $timestamp);
                    $total = Consumption::calcTotalMinut($data);
                    echo "['$time', $total],";
                    //   ['14:01:37', '0.1'],
                ?>
				<?php endforeach; ?>
			]);

			var options = {
			legend: { position: 'none' },
			axes: {
				x: {
				0: {  label: 'Time of the day '} // Top x-axis.
				}
			},
			colors: ['#72e0eb'],
			bar: { groupWidth: "40%" }
			};

			var chart = new google.charts.Bar(document.getElementById('chart_div_daily'));

			function selectHandler() {
          		let selectedItem = chart.getSelection()[0];
        		if (selectedItem) {
            		let time = data.getValue(selectedItem.row, 0);
					insertParam("time", time);
          		}
        	}

			google.visualization.events.addListener(chart, 'select', selectHandler); 
			// Convert the Classic options to Material options.
			chart.draw(data, google.charts.Bar.convertOptions(options));
		};
	<?php else: ?>
		let chartContainer = document.getElementById('chart_div_daily');
		let title = document.createElement("h4");
		title.innerHTML = "Congratulations, today you haven't used any water yet!";
		chartContainer.appendChild(title);
	<?php endif; ?>
	
	function insertParam(key, value)
{
    key = encodeURI(key); value = encodeURI(value);

    var kvp = document.location.search.substr(1).split('&');

    var i=kvp.length; var x; while(i--) 
    {
        x = kvp[i].split('=');

        if (x[0]==key)
        {
            x[1] = value;
            kvp[i] = x.join('=');
            break;
        }
    }

    if(i<0) {kvp[kvp.length] = [key,value].join('=');}

    //this will reload the page, it's likely better to store this until finished
    document.location.search = kvp.join('&'); 
}
</script>
<script>
    // if there is a change in the div
    $('.form--dashboard').change((e)=>{
        // if the target has class action
        if(e.target.classList.contains("action")){
            let action = e.target.getAttribute("data-check");
            let searchTime = new URLSearchParams(window.location.search);
            // if parameter time is set
            if(searchTime.has('time')){
                // get necessities
                let time = searchTime.get('time');
                let timestamp = "<?php echo date('Y-m-d'); ?> "+ time;
                let actionId = e.target.getAttribute("data-id");
                
                // start ajax-call
                $.ajax({
                    method: "POST",
                    url: "ajax/save_action.php",
                    data: {
                        actionId: actionId,
                        timestamp: timestamp
                    },
                    dataType: 'json'
                    
                })
                .done( function ( res ){
                    if (res.status == "success"){
                        console.log("😁");
                    }
                });
            }else{
				let selected = document.createElement("p");
				selected.innerHTML = "You need to select a event here first.";
				let chartCon = document.querySelector('.feedback');

				chartCon.appendChild(selected);
            }
            // console.log(searchTime.has('time'));
        }
    });
</script>
</body>
</html>
