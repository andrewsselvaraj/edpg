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

app.controller('MainController', function($scope, $http) {
 
  var apiUrl = 'cbe_bar_chart_data.php';

  $http.get(apiUrl)
    .then(function(response) {
      var processedData = processData(response.data);
      $scope.data = processedData;
      createBarChart($scope.data);
    })
    .catch(function(error) {
      console.error('Error fetching data:', error);
    });

  function processData(data) {
    var labels = [];
    var votes = [];

    data.forEach(function(item) {
      labels.push(item.Candidate_Name + ' - ' + item.Polling_Station_No);
      votes.push(item.No_of_Votes);
    });

    return {
      labels: labels,
      votes: votes
    };
  }

 
  function createBarChart(data) {
    var ctx = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: data.labels, 
        datasets: [{
          label: 'Coimbatore',
          data: data.votes,
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
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
