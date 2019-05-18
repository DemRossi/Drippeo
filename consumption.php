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
    <title>Consumption</title>
</head>
<body>
<?php include_once 'includes/nav.inc.php'; ?>

<div class="dashboard">

  <div class='column'>
    <div class='item'>
      <div id="vergelijking">
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
   // VERGELIJKING
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = google.visualization.arrayToDataTable([
        ['City', '2010 Population',{ role: "style" }],
        ['Your water', 1000,"#72e0eb"],
        ['Similar family', 700,"#f4f4f4"],
        ['Average', 850,"#f4f4f4"]
      ]);

      var options = {
        title: 'Monthly comparison',
        width: 400,
        position:"absolute",
        chartArea: {width: 300},
        hAxis: {
          title: 'Total water use',
          minValue: 0
        },
     legend: { position: "none" },
      };

      var chart = new google.visualization.BarChart(document.getElementById('vergelijking'));

      chart.draw(data, options);
    }
  </script>
</body>
</html>