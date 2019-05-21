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
$table = Consumption::limit($_SESSION['user']['id']);
$used = Consumption::tips($_SESSION['user']['id']);
$totalUsed = Consumption::used($_SESSION['user']['id']);

?><!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'includes/head.inc.php'; ?>
    <title>Comsumption</title>
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
  <div class="item"> </div>
  <div class="item">
  </div>
</div>
</div>
</div>

<?php include_once 'includes/footer.inc.php'; ?>
<script src="js/webNavigation.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="js/charts.js"></script>

<script>
  /*
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
    }*/
  </script>
</body>
</html>