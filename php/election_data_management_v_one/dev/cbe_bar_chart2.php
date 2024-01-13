<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<head>
  <meta charset="UTF-8">
  <title>Coimbatore Bar Chart</title>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
  <style>
    #chart-container {
      width: 80%;
      margin: auto;
    }
  </style>
</head>
<body ng-controller="MainController">

  <div id="chart-container">
    <canvas id="barChart"></canvas>
  </div>

</body>


<script>
var app = angular.module('myApp', []);

app.controller('MainController', function ($scope, $http) {
    var apiUrl = 'cbe_bar_chart_data.php';
    $http.get(apiUrl)
        .then(function (response) {
            var processedData = processData(response.data);
            processedData.forEach(function (polling_station_no_data) {
                createBarChart(polling_station_no_data);
            });
        })
        .catch(function (error) {
            console.error('Error fetching data:', error);
        });

    
    function processData(data) {
        var uniquePollingStationNo = Array.from(new Set(data.map(item => item.Polling_Station_No)));
        var processedData = [];
        uniquePollingStationNo.forEach(function (pollingstationno) {
            var polling_station_no_data = data.filter(item => item.Polling_Station_No === pollingstationno);
            var labels = polling_station_no_data.map(item => item.Candidate_Name);
            var votes = polling_station_no_data.map(item => item.No_of_Votes);
            processedData.push({
                pollingstationno: pollingstationno,
                labels: labels,
                votes: votes
            });
        });
        return processedData;
    }

    function createBarChart(data) {
        var container = document.getElementById('chart-container');
        var chartCanvas = document.createElement('canvas');
        chartCanvas.width = 600;
        chartCanvas.height = 400;
        container.appendChild(chartCanvas);
        var ctx = chartCanvas.getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Polling Station Number - ' + data.pollingstationno,
                    data: data.votes,
                    backgroundColor: '#D81159', 
                    borderColor: '#D81159',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }
});

</script>


</html>
