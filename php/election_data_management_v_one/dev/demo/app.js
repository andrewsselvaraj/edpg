<script>
// app.js
var app = angular.module('myApp', []);

app.controller('ChartController', function($scope, $http) {
  // Replace 'YOUR_API_ENDPOINT' with your actual API endpoint
  var apiUrl = 'data.json';

  // Fetch data from the API
  $http.get(apiUrl)
    .then(function(response) {
      // Process the API response data
      var data = response.data;

      // Extract labels and values from the API data
      var labels = data.map(function(item) {
        return item.label;
      });

      var values = data.map(function(item) {
        return item.value;
      });

      // Create a bar chart using Chart.js
      var ctx = document.getElementById('myChart').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            label: 'Bar Chart Example',
            data: values,
            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Customize the bar color
            borderColor: 'rgba(75, 192, 192, 1)', // Customize the border color
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    })
    .catch(function(error) {
      console.error('Error fetching data from API:', error);
    });
});
</script>