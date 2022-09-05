<?php include 'barchartdata.php'; ?>
<html>
    <head>
        <title>Bar Graph</title>
    
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Ward", "Population", { role: "style" } ],
        <?php 
        echo "['Ward 1',".$ro1['one'].", '#b87333'],";
        echo "['Ward 2',".$ro2['two'].", 'silver'],";
        echo "['Ward 3',".$ro3['three'].", 'green'],";
        echo "['Ward 4',".$ro4['four'].", 'gold'],";
        echo "['Ward 5',".$ro5['five'].", 'red'],";
        echo "['Ward 6',".$ro6['six'].", 'blue']";
        ?>
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Population distribution in Wards",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>
  <style>
    #columnchart_values
    {
      position:absolute;
      top:50%;
      left:50%;
    }
    </style>
  </head>
  <body>
<div id="columnchart_values" style="width: 300px; height: 300px;"></div>
</body>
</html>