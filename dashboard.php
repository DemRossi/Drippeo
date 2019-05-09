
<?php

$dataPoints = array(
    array('label' => 'Limit', 'symbol' => 'O', 'y' => 60),
    array('label' => 'Today', 'symbol' => 'Si', 'y' => 40),
);

?>





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
    <div class='item'></div>
    <div class='item'></div>
    <div class='item'>
      <div id="chartContainer" style="height: 370px; width: 100%;"> </div>
    </div>
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


<?php include_once 'includes/footer.inc.php'; ?>

<script src="js/webNavigation.js"></script>
    
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2",
	animationEnabled: true,
	title: {
		text: "Average Composition of Magma"
	},
	data: [{
		type: "doughnut",
		indexLabel: "{symbol} - {y}",
		yValueFormatString: "#,##0.0\"%\"",
		showInLegend: true,
		legendText: "{label} : {y}",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
