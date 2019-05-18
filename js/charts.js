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
      google.charts.load('current', {packages: ['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawDualY);
      
      function drawDualY() {
            var data = new google.visualization.DataTable();
            data.addColumn('timeofday', 'Time of Day');
            var product = '';
            data.addColumn('number', product);
            data.addRows([
              [{v: [8, 0, 0], f: '8 am'}, 5],
              [{v: [9, 0, 0], f: '9 am'}, 0],
              [{v: [10, 0, 0], f:'10 am'}, 0],
              [{v: [11, 0, 0], f: '11 am'}, 1],
              [{v: [12, 0, 0], f: '12 pm'}, 2],
              [{v: [13, 0, 0], f: '1 pm'}, 0],
              [{v: [14, 0, 0], f: '2 pm'}, 0],
              [{v: [15, 0, 0], f: '3 pm'}, 1],
              [{v: [16, 0, 0], f: '4 pm'}, 0],
              [{v: [17, 0, 0], f: '5 pm'}, 7],
            ]);
      
            var options = {
              series: {
                0: {axis: 'WaterLevel'},
              
              },
              
              hAxis: {
                title: 'Time of Day',
                format: 'h:mm a',
                viewWindow: {
                  min: [7, 30, 0],
                  max: [17, 30, 0],
                  
                },legend: {
                  position: "none"	
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

 
