<?php
 include 'piechartdata.php'; ?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Gender', 'Population'],
         <?php
          echo "['Male',".$row1['male']."],";
          echo "['Female',".$row2['female']."],";
          echo "['Other',".$row3['other']."],";
          ?>
        ]);

        var options = {
          title: 'Population Distribution'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <style>
        #piechart
        {
            position:absolute;
            left:50%;

        }
        </style>
  </head>
  <body>
    <div id="piechart" style="width: 500px; height: 500px;"></div>
  </body>
</html>