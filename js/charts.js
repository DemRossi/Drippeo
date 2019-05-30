// JAARLIJKS: JIJ EN HET GEMIDDELDE
google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'You', 'Average'],
          ['2014', 1000, 400],
          ['2015', 1170, 460],
          ['2016', 660, 1120],
          ['2017', 1030, 540]
        ]);

        var options = {
          chart: {
            title: 'Water use yearly',
            subtitle: 'You and the average: 2014-2017',
          },
          bars: 'vertical',
          vAxis: {format: 'decimal'},
          height: 300,
          width: 300,
          colors: ['#72e0eb', '#f4f4f4', ],
          legend: {
            position: "none"	
          },
        };

        var chart = new google.charts.Bar(document.getElementById('jaarlijks'));

        chart.draw(data, google.charts.Bar.convertOptions(options)); 
      }

// DAAGELIJKS
     

 
